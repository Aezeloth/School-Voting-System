<aside class="main-sidebar glass-main-sidebar" style="background-color: #0c1d88;">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar glass-sidebar" style="background-color:rgb(15, 29, 117)">
    <!-- Sidebar user panel -->
    <div class="user-panel" style="height: 60px;">
      <div class="pull-left image">
        <img src="<?php echo (!empty($user['photo'])) ? '../images/'.$user['photo'] : '../images/profile.jpg'; ?>" class="img-square" alt="User Image">
      </div>
      <div class="pull-left info">
        <p style="color: white; font-size: 15px; font-family: Times;"><?php echo $user['firstname'].' '.$user['lastname']; ?></p>
        <a><i class="fa fa-circle text-success"></i> <b style="color: white; font-size: 15px; font-family: Times;">Online</b></a>
      </div>
    </div>

    <!-- Sidebar menu: style can be found in sidebar.less -->
    <ul class="sidebar-menu glass-sidebar-menu" data-widget="tree" style="background-color: rgb(47, 47, 170); color: white; font-size: 15px; font-family: Times;">
      <li class="header hmain glass-hmain" style="background-color: rgba(255, 0, 0, 0.5); color:white;">
        REPORTS
      </li>
      <li class=""><a href="home.php"><i class="fa fa-dashboard"></i> <span style="color:white;">Dashboard</span></a></li>
      <li class=""><a href="votes.php"><span class="glyphicon glyphicon-lock"></span> <span style="color:white;">Votes</span></a></li>
      <li class="header hmain glass-hmain" style="background-color: rgba(255, 0, 0, 0.5); color:white;">
        MANAGE
      </li>
      <li class=""><a href="voters.php"><i class="fa fa-users"></i> <span style="color:white;">Voters</span></a></li>
      <li class=""><a href="positions.php"><i class="fa fa-tasks"></i> <span style="color:white;">Positions</span></a></li>
      <li class=""><a href="candidates.php"><i class="fa fa-black-tie"></i> <span style="color:white;">Candidates</span></a></li>
      <li class="header hmain glass-hmain" style="background-color: rgba(255, 0, 0, 0.5); color:white;">
        SETTINGS
      </li>
      <li class=""><a href="ballot.php"><i class="fa fa-file-text"></i> <span style="color:white;">Ballot Position</span></a></li>
      <li class=""><a href="#config" data-toggle="modal"><i class="fa fa-cogs"></i> <span style="color:white;">Election Title</span></a></li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
<?php include 'config_modal.php'; ?>

<style>
/* Glass effect for main-sidebar */
.glass-main-sidebar {
  background-color: rgba(100, 99, 251); /* Semi-transparent background */
  backdrop-filter: blur(20px);               /* Blur effect */
  border: 1px solid #2692ff;                /* Border */
  border-radius: 15px;                      /* Rounded corners */
  box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
}

/* Glass effect for sidebar section */
.glass-sidebar {
  background-color: rgba(100, 99, 251, 0.5); /* Semi-transparent background */
  backdrop-filter: blur(20px);               /* Blur effect */
  border: 1px solid #2692ff;                /* Border */
  border-radius: 15px;                      /* Rounded corners */
  box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
}

/* Glass effect for sidebar menu */
.glass-sidebar-menu {
  background-color: rgba(100, 99, 251, 0.5); /* Semi-transparent background */
  backdrop-filter: blur(20px);               /* Blur effect */
  border-radius: 15px;                      /* Rounded corners */
}

/* Glass effect for hmain headers */
.glass-hmain {
  background-color: rgba(255, 0, 0, 0.5); /* Semi-transparent red background */
  backdrop-filter: blur(50px);            /* Intense blur effect */
  border: 1px solid #2692ff;             /* Border */
  border-radius: 15px;                   /* Rounded corners */
  padding: 10px;                         /* Padding for spacing */
  text-align: center;                    /* Centered text alignment */
}
</style>
