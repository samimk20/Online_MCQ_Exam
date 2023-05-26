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
<link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
<link href="css/style.css" rel="stylesheet" type="text/css"/>
<link href="plugins/prettyphoto/css/prettyPhoto.css" rel="stylesheet" type="text/css"/>
<link href="plugins/owl-carousel/css/owl.carousel.css" rel="stylesheet" type="text/css"/>
<link href="plugins/owl-carousel/css/owl.theme.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="plugins/rs-plugin/css/settings.css" media="screen" />
<!--[if lte IE 8]><link rel="stylesheet" type="text/css" href="css/ie8.css" media="screen" /><![endif]-->
<!-- Color Style -->
<link class="alt" href="colors/purple.css" rel="stylesheet" type="text/css">
<!-- SCRIPTS
  ================================================== -->
<script src="js/modernizr.js"></script><!-- Modernizr -->


<?php
require_once "testhelper.php";
$helper = new TestHelper();

if(!$_SESSION['userid'])
{
    echo "<script>window.location = 'login.php';</script>";
}

$categories = $helper->getCategories();
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
                <h1>Dashboard</h1>
              </div>
            </div>
          </div>
        </section>
      </header>
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            
            <h1>Welcome <?php echo $_SESSION['username']; ?></h1>
            
            <table class="table table-striped">
              <thead>
                <tr>
                    <th> # </th>
                    <th>Category Name</th>                                                             
                    <th>Total Question</th>
                    <th>Course</th>		
                    <th>Course Year</th>	
                    <th>Semester</th>
                    <th>Actions</th>	
                </tr>
              </thead>
              <tbody>
                <?php   
                $course_year = array('1'=>'First Year','2'=>'Second Year','3'=>'Third Year');
                $semester = array('1'=>'I','2'=>'II','3'=>'III','4'=>'IV','5'=>'V','6'=>'VI');
                 foreach($categories as $row)
                 {
                   ?>
                    <tr>
                        <td><?php echo $row['catid'];?></td>
                        <td><?php echo $row['catname'];?></td>
                        <td><?php echo $row['totalque'];?></td>
                        <td><?php echo $row['course_name'];?></td>
                        <td><?php echo $course_year[$row['course_year_id']];?></td>
                        <td><?php echo $semester[$row['semester_id']];?></td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="runquiz.php?catid=<?php echo $row['catid']; ?>&limit=<?php echo $row['totalque'];?>"><strong>Take Test</strong></a>
                        </td>
                    </tr> 
                   <?php
                 }  
                 ?> 
              </tbody>
            </table>
            
            <h4 class="spaced"></h4>
           
        </div>
      </div>
    </div>
  </div>
  </div> 
  
  <?php
    require_once "footer.php";
  ?>
</div> 
<!-- End Body Container --> 
<script src="js/jquery-latest.min.js"></script> <!-- Jquery Library Call --> 
<script src="plugins/prettyphoto/js/prettyphoto.js"></script>
<script src="plugins/prettyphoto/js/prettyphoto.js"></script>  
<script src="plugins/owl-carousel/js/owl.carousel.min.js"></script> 
<script src="plugins/page-scroller/jquery.pagescroller.js"></script> 
<script src="js/helper-plugins.js"></script> <!-- Plugins --> 
<script src="js/bootstrap.js"></script> <!-- UI --> 
<script src="js/init.js"></script> <!-- All Scripts --> 
<!-- End Js --> 
</body>
</html>