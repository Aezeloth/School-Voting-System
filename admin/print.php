<?php include 'includes/session.php'; ?>
<?php include 'includes/slugify.php'; ?>
<?php include 'includes/header.php'; ?>

<body>
<div class="container">
  <h1 class="text-center">📜 Print Report 📜</h1>
  <hr>

  <!-- Dashboard Summary -->
  <h3>Summary</h3>
  <ul>
    <?php
      // Query for Positions
      $sql = "SELECT * FROM positions";
      $query = $conn->query($sql);
      echo "<li><b>Total No. of Positions:</b> ".$query->num_rows."</li>";

      // Query for Candidates
      $sql = "SELECT * FROM candidates";
      $query = $conn->query($sql);
      echo "<li><b>Total No. of Candidates:</b> ".$query->num_rows."</li>";

      // Query for Voters
      $sql = "SELECT * FROM voters";
      $total_voters_query = $conn->query($sql);
      $total_voters = $total_voters_query->num_rows;
      echo "<li><b>Total of Voters:</b> ".$total_voters."</li>";

      // Query for Voters Voted
      $sql = "SELECT * FROM votes GROUP BY voters_id";
      $voters_voted_query = $conn->query($sql);
      $voters_voted = $voters_voted_query->num_rows;

      // Calculate voters who did not vote
      $voters_not_voted = $total_voters - $voters_voted;

      // Display Voters Voted / Total
      echo "<li><b>Counted Votes:</b> $voters_voted</li>";
      echo "<li><b>Voters Did not Vote:</b> $voters_not_voted</li>";
    ?>
  </ul>
  <hr>

  <!-- Votes Tally Section -->
  <h3>Votes Tally</h3>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Position</th>
        <th>Candidate</th>
        <th>Total Votes</th>
      </tr>
    </thead>
    <tbody>
      <?php
        // Query for Positions
        $sql = "SELECT * FROM positions ORDER BY priority ASC";
        $query = $conn->query($sql);

        while($position = $query->fetch_assoc()){
          $position_id = $position['id'];
          $description = $position['description'];

          // Query for Candidates under this position
          $sql = "SELECT * FROM candidates WHERE position_id = '$position_id'";
          $candidates_query = $conn->query($sql);

          $rowspan = $candidates_query->num_rows; // Number of candidates in this position
          $first_row = true;

          while($candidate = $candidates_query->fetch_assoc()){
            $candidate_name = $candidate['firstname'] . ' ' . $candidate['lastname'];
            $candidate_id = $candidate['id'];

            // Query for Votes per Candidate
            $sql = "SELECT * FROM votes WHERE candidate_id = '$candidate_id'";
            $votes_query = $conn->query($sql);
            $total_votes = $votes_query->num_rows;

            echo "<tr>";
            if($first_row){
              echo "<td rowspan='$rowspan'>$description</td>";
              $first_row = false;
            }
            echo "<td>$candidate_name</td>";
            echo "<td>$total_votes</td>";
            echo "</tr>";
          }
        }
      ?>
      
    </tbody>
    
  </table>

  <!-- Buttons -->
  <div class="text-center">
    <button class="btn btn-primary" onclick="window.print()">Print</button>
    <a href="/home.php" class="btn btn-secondary">Return</a>
  </div>
</div>
<!-- Verified By Section -->
<div class="text-right mt-5 print-only">
  <p><strong>Verified By:</strong> ____________________</p>
  <p class="signature">Signature over Printed Name</p>
</div>
</div>

<style>
  body {
    font-family: Arial, sans-serif;
  }
  .container {
    margin: 0 auto;
    max-width: 800px;
    padding: 20px;
    border: 2px solid #ddd;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    width: 100%;
  }
  h1 {
    font-size: 24px;
    text-transform: uppercase;
  }
  ul {
    font-size: 14px;
  }
  table {
    width: 100%;
    border-collapse: collapse;
    font-size: 14px;
    margin-bottom: 20px;
  }
  table th, table td {
    padding: 8px;
    border: 5px solid black;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    text-align: left;
  }
  table th {
    background-color: #007bff;
    color: white;
  }
  table tr:nth-child(even) {
    background-color: #f2f2f2;
  }
  table tr:hover {
    background-color: #e0f7fa;
  }
  .btn {
    padding: 10px 20px;
    font-size: 16px;
    border: none;
    border-radius: 5px;
    margin: 5px;
  }
  .btn-primary {
    background-color: #007bff;
    color: white;
  }
  .btn-primary:hover {
    background-color: #0056b3;
  }
  .btn-secondary {
    background-color: #6c757d;
    color: white;
  }
  .btn-secondary:hover {
    background-color: #5a6268;
  }
  @media print {
    body {
      font-size: 14px;
    }
    .container {
      margin: 0;
      padding: 0;
      width: 100%;
    }
    table {
      font-size: 12px;
    }
    .btn {
      display: none;
    }
  }
  .text-right {
    text-align: right;
    margin-top: 50px;
  }
  .signature {
    margin-top: 2px;
    font-size: 12px;
    font-style: italic;
  }
  /* Hide the element by default */
  .print-only {
    display: none;
  }
  /* Make it visible only when printing */
  @media print {
    .print-only {
      display: block;
      margin-top: 100px;
    }
  }

</body>
</html>
