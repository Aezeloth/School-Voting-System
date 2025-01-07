<header class="main-header" style="background-color:#0c1d88;">
  <nav class="navbar navbar-static-top" style="background-color:#0c1d88;">
    <div class="container" style="background-color:#0c1d88;">
      <div class="navbar-header" style="background-color:#0c1d88;">
        <!-- Hide this text on mobile -->
        <a href="#" class="navbar-brand navbar-title" style="background-color:#0c1d88;color:white; font-size: 22px; font-family:Times;">
          <b>ACLC Commonwealth Online Voting</b>
        </a>
        <button type="button" class="navbar-toggle collapsed" style="background-color:#0c1d88;" data-toggle="collapse" data-target="#navbar-collapse">
          <i class="fa fa-bars"></i>
        </button>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
        <ul class="nav navbar-nav">
          <?php
            if(isset($_SESSION['student'])){
              echo "
                <li><a href='index.php'>HOME</a></li>
                <li><a href='transaction.php'>TRANSACTION</a></li>
              ";
            } 
          ?>
        </ul>
      </div>
      <!-- /.navbar-collapse -->
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="user user-menu">
            <a href="">
              
              <span class="hidden-xs" style="color:white; font-size: 22px; font-family:Times;">
                <?php echo $voter['firstname'].' '.$voter['lastname']; ?>
              </span>
            </a>
          </li>
          <li>
            <a href="logout.php" class="logout-button" style="padding: 7px 15px;">
              <b style="color:white; font-size: 16px; font-family:Times;">
                <i class="fa fa-sign-out"></i> LOGOUT
              </b>
            </a>
          </li>
        </ul>
      </div>
      <!-- /.navbar-custom-menu -->
    </div>
    <!-- /.container-fluid -->
  </nav>
</header>

<style>
/* Hide ACLC Commonwealth Online Voting on small screens */
.navbar-title {
  display: block;
}

@media (max-width: 768px) {
  .navbar-title {
    display: none;
  }
}

/* Style the logout button */
.logout-button {
  border: 2px solid white; /* Black border */
  border-radius: 10px; /* Rounded corners */
margin-top: 6px;
  background-color: #0c1d88; /* Match the navbar background */
  color: white; /* Text color */
}

.logout-button:hover {
  background-color: #2546b0; /* Slightly lighter blue for hover effect */
  color: white; /* Ensure text remains visible */
}
</style>
