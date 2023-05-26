<style>#content {min-height: 525px;}</style>
<!-- Start Header -->
  <div class="topbar hidden-sm hidden-xs">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <nav class="secondary-menu">
            <ul class="pull-left">
              <li><a href="#"><i class="fa fa-phone"></i> +91 1234567890</a></li>
              <li><a href="#"><i class="fa fa-envelope"></i> info@onlinetest.com</a></li>
            </ul>
          </nav>
        </div>
        <div class="col-md-6">
          <nav class="secondary-menu">
            <ul class="pull-right">
                <?php
                if($_SESSION['userid']!='')
                {
                    ?>
                    <li class="dropdown pull-right">
                        <a data-toggle="dropdown"> Welcome <?php echo $_SESSION['username']; ?> <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                          <li class="dropdown"><a href="logout.php">Logout</a></li>
                          
                        </ul>
                     </li>    
                    <?php
                }
                else
                {
                    ?>
                    <li class=""><a href="admin">Admin Login</a></li>    
                    <?php
                }
                ?>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </div>
  <!-- Start Header -->
  <header class="site-header" id="sticky-nav">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <h1 class="logo"> <a href="index.php">Online Test</a> </h1>
        </div>
        <div class="col-md-9">
          <button class="mmenu-toggle"><i class="fa fa-bars fa-lg"></i></button>
          <nav class="main-menu">
            <ul class="sf-menu" id="main-menu">
                <li><a href="index.php">Home</a></li>
                <li><a href="aboutus.php">About Us</a></li>
                <?php
                    if($_SESSION['userid']=='')
                    {
                        ?>
                        <li><a href="login.php">Login</a></li> 
                         <li><a href="register.php">Register</a></li>       
                        <?php
                    }
                    else
                    {
                        ?>
                         <li>
                            <a href="dashboard.php">Dashboard</a>
                            <ul class="dropdown">
                                <li><a href="dashboard.php">Dashboard</a></li>
                                <li><a href="edit_profile.php">Edit Profile</a></li>
                                <li><a href="logout.php">Logout</a></li>
                            </ul>
                        </li>
                        <?php
                    }
                ?>
                
                
               
                <li><a href="contactus.php">Contact Us</a></li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
    <nav class="mobile-menu">
      <div class="container">
        <div class="row"></div>
      </div>
    </nav>
  </header>