<?php
session_start();

// Redirect to appropriate pages based on session
if (isset($_SESSION['admin'])) {
    header('location: admin/home.php');
    exit();
}

if (isset($_SESSION['voter'])) {
    header('location: home.php');
    exit();
}

// Include header
include 'includes/header.php';
?>
<body class="hold-transition login-page" 
      style="background-color: white; background-image: url('/images/voterbg.jpg'); 
             background-position: center; background-repeat: no-repeat; background-size: cover;">

<div class="login-box glass-effect" 
     style="color: white; font-size: 18px; font-family: Times;">
    
    <div class="login-logo" 
         style="color: white; font-size: 26px; font-family: Times; margin-bottom: 0;">
        <br>
        <img src="/images/nobgaclc.png" style="height: 200px;" />
        <br>
        <b>ACLC College<br>Online Voting</b>
    </div>

    <div class="login-box-body glass-effect" 
         style="color: white; font-size: 22px; font-family: Times;">
        <p class="login-box-msg" 
           style="color: white; font-size: 16px; font-family: system-ui;">
            Sign in to start your voting session
        </p>

        <form action="login.php" method="POST">
            <div class="form-group has-feedback">
                <input type="text" class="form-control" name="voter" placeholder="Voter's ID" maxlength="15" required />
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
                <input type="password" class="form-control" name="password" placeholder="Password" maxlength="6" required />
                <span class="glyphicon glyphicon-lock form-control-feedback" 
                      onclick="togglePasswordVisibility(this)" 
                      style="cursor: pointer;"></span>
            </div>

            <div class="row">
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-curve" 
                            style="background-color: #4682B4; color: white; font-size: 12px; font-family: Times;" 
                            name="login">
                        <i class="fa fa-sign-in"></i> Sign In
                    </button>
                </div>
            </div>
            <br>
        </form>

        <?php
        // Display error message if present
        if (isset($_SESSION['error'])) {
            echo "<div class='callout callout-danger text-center mt20'>
                    <p>" . htmlspecialchars($_SESSION['error']) . "</p>
                  </div>";
            unset($_SESSION['error']);
        }
        ?>
    </div>
</div>

<style>
/* Apply glass effect styles */
.glass-effect {
    background-color: rgba(25.5, 41.2, 88.2, 0.5); /* Semi-transparent background */
    backdrop-filter: blur(20px);                   /* Blur effect */
    border: 1px solid #2692ff;                       /* 1px white border */
    border-radius: 15px;                           /* Rounded corners */
    box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);     /* Subtle shadow for depth */
    padding: 20px;                                 /* Padding for internal spacing */
    margin: 20px auto;                             /* Center align with margins */
    max-width: 400px;                              /* Constrain the box width */
}
.login-page {
	margin-top: 50px;
}
</style>

<?php include 'includes/scripts.php'; ?>

<script>
// Toggles password visibility
function togglePasswordVisibility(element) {
    const passwordField = element.parentElement.querySelector('input');
    if (passwordField.type === 'password') {
        passwordField.type = 'text';
    } else {
        passwordField.type = 'password';
    }
}
</script>
</body>
</html>