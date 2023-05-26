<?php
require_once "adminhelper.php";
$helper = new AdminHelper();
?>
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
                    <li class=""><a href="../index.php">Back to Portal</a></li>    
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
        <div class="col-md-2">
          <h1 class="logo"> <a href="index.php">Online Test</a> </h1>
        </div>
        <div class="col-md-10">
          <button class="mmenu-toggle"><i class="fa fa-bars fa-lg"></i></button>
          <nav class="main-menu">
            <ul class="sf-menu" id="main-menu">
                <?php
                
                    if($_SESSION['userid']!='')
                    {
                        ?>
                        <li><a href="dashboard.php">Home</a></li>
                        <li><a href="users.php">Users</a></li>
                        <li>
                            <a href="#">Categories</a>
                            <ul class="dropdown">
                                <li><a href="addcat.php">Add Category</a></li>
                                <li><a href="categories.php">View Categories</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">Question</a>
                            <ul class="dropdown">
                                <li><a href="addque.php">Add Question</a></li>
                                <li><a href="viewque.php">View Questions</a></li>
                            </ul>
                        </li>
                        <li><a href="viewresult.php">View Result</a></li>
                        <?php
                    }
                    
                ?>
                
              
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