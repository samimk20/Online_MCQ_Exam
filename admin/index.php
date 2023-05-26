<!DOCTYPE HTML>
<html class="no-js">
<head>
<!-- Basic Page Needs
  ================================================== -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>Online Test</title>
<!-- Mobile Specific Metas
  ================================================== -->
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<meta name="format-detection" content="telephone=no"/>
<!-- CSS
  ================================================== -->
<link href="../css/bootstrap.css" rel="stylesheet" type="text/css"/>
<link href="../css/style.css" rel="stylesheet" type="text/css"/>
<link href="../plugins/prettyphoto/css/prettyPhoto.css" rel="stylesheet" type="text/css"/>
<link href="../plugins/owl-carousel/css/owl.carousel.css" rel="stylesheet" type="text/css"/>
<link href="../plugins/owl-carousel/css/owl.theme.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="../plugins/rs-plugin/css/settings.css" media="screen" />
<!--[if lte IE 8]><link rel="stylesheet" type="text/css" href="css/ie8.css" media="screen" /><![endif]-->
<!-- Color Style -->
<link class="alt" href="../colors/purple.css" rel="stylesheet" type="text/css">
<!-- SCRIPTS
  ================================================== -->
<script src="js/modernizr.js"></script><!-- Modernizr -->

<script type="text/javascript">
function validate_form()
{
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    
    if(username=='')
    {
        alert("Please Enter User Name.");
        return false;
        
    }
    else if(password=='')
    {
        alert("Please Enter Password.");
        return false;
        
    }
}
</script>

<?php
require_once "adminhelper.php";
$helper = new AdminHelper();
?>

</head>
<body>
<!-- Start Body Container -->
<div class="body"> 
  <!-- Start Header -->
  <?php
    require_once "header.php";
  ?>
  <!-- End Header --> 
  
  <!-- Start Content -->
  <div class="main" role="main">
    <div id="content" class="content page-content full">
      <header class="page-header flexible parallax text-align-center parallax-overlay">
        <section>
          <div class="container">
            <div class="row">
              <div class="col-md-12">
                <h1>Login</h1>
              </div>
            </div>
          </div>
        </section>
      </header>
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-md-offset-4">
            <h2><strong>Login</strong></h2>
            <hr/>
            <?php
            if($_GET['error'])
            {
                ?>
                <div class="alert alert-error fade in"> 
                    <a href="#" data-dismiss="alert" class="close">&times;</a>
                    <?php echo "Invalid Details";?>
                </div>
                <?php
            }
            ?>
            
            
            <form name="adminlogin" id="adminlogin" action="checklogin.php" method="post" onsubmit="return validate_form();" >
              <div class="row">
                <div class="form-group">
                  <div class="col-md-12">
                    <input type="text" placeholder="Username" class="form-control input-lg" name="username" id="username">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="form-group">
                  <div class="col-md-12">
                    <input type="password" placeholder="Password" class="form-control input-lg" name="password" id="password">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="form-group">
                  <div class="col-md-12">
                    <input type="submit" value="Login" class="btn btn-primary btn-lg" name="submit">
                  </div>
                </div>
              </div>
            </form>
          </div>
          <!-- Start Sidebar -->
          <aside class="col-md-3 sidebar right-sidebar">
            
            
          </aside>
        </div>
      </div>
    </div>
  </div>
  
  <?php
    require_once "footer.php";
  ?>
</div>  
<!-- End Body Container --> 
<script src="../js/jquery-latest.min.js"></script> <!-- Jquery Library Call --> 
<script src="../plugins/prettyphoto/js/prettyphoto.js"></script>
<script src="../plugins/prettyphoto/js/prettyphoto.js"></script>  
<script src="../plugins/owl-carousel/js/owl.carousel.min.js"></script> 
<script src="../plugins/page-scroller/jquery.pagescroller.js"></script> 
<script src="../js/helper-plugins.js"></script> <!-- Plugins --> 
<script src="../js/bootstrap.js"></script> <!-- UI --> 
<script src="../js/init.js"></script> <!-- All Scripts --> 
<!-- End Js --> 
</body>
</html>