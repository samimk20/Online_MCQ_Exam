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
    var catname         = document.getElementById("catname").value;
    var totalque        = document.getElementById("totalque").value;
    var course_id       = document.getElementById("course_id").value;
    var course_year_id  = document.getElementById("course_year_id").value;
    var semester_id     = document.getElementById("semester_id").value;
    
    var validchar = /^[A-Za-z]+$/;
    var validnum = /^[0-9]+$/;
    
    if(catname=='')
    {
        alert("Please Enter Category Name.");
        return false;
    }
    else if(!validchar.test(catname))
    {
        alert("Category Name should not be numeric or space.");
        return false;
    }  
    else if(totalque=='')
    {
        alert("Please Enter Total Questions.");
        return false;
    }
    else if(!validnum.test(totalque))
    {
        alert("Total Questions should be numeric no alphabets and space.");
        return false;
    } 
    else if(course_id=='')
    {
        alert("Please Select Course.");
        return false;
    }
    else if(course_year_id=='')
    {
        alert("Please Select Course Year.");
        return false;
    }
    else if(semester_id=='')
    {
        alert("Please Select Semester.");
        return false;
    }
}
</script>

<?php
require_once "adminhelper.php";
$helper = new AdminHelper();

if($_SESSION['userid']=='')
{
    header("Location:index.php");
}

if($_SESSION['site']==='admin'){}
else
{
    header("Location:index.php");
}


$catid = $_REQUEST['catid'];
$msg = "";
$class= "";
if($_POST)
{
    $r = $helper->addCategory();
    if($r)
    {
        $st = ($catid) ? 'Updated' : 'Added';
        $msg='Category '.$st.'.';
        $class= "success";
    }
    
}

$data   = array();
if($catid)
{
    $data   = $helper->getCategory($catid);   
}

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
                <h1><?php echo ($catid) ? 'Edit' : 'Add';?> Category</h1>
              </div>
            </div>
          </div>
        </section>
      </header>
      <div class="container">
        <div class="row">
          <div class="col-md-9">
            <?php
            if($msg!='')
            {
                ?>
                <div class="alert alert-success fade in"> 
                    <a href="#" data-dismiss="alert" class="close">&times;</a>
                    <?php echo $msg;?>
                </div>
                <?php
            }
            ?>
                
            <form method="post" action="" onsubmit="return validate_form();">
             <div class="col-md-6">
             <div class="row">
                <div class="form-group">   
                    <input type="text" name="catname" id="catname" value="<?php echo $data['catname']; ?>" class="form-control input-lg" placeholder="Enter Category Name"/>  
                </div>
              </div>
              <div class="row">
                <div class="form-group">
                    <input type="text" name="totalque" id="totalque" value="<?php echo $data['totalque']; ?>" class="form-control input-lg" placeholder="Enter Total Questions" maxlength="2"/>
                </div>
              </div>
              <div class="row">
                <div class="form-group">
                    <?php
                    $helper->getCoursesSelect($data['course_id']);
                    ?>
                </div>
              </div>
              <div class="row">
                <div class="form-group">
                    <?php
                    $helper->getCourseyearsSelect($data['course_year_id']);
                    ?>
                </div>
              </div>
              <div class="row">
                <div class="form-group">
                    <?php
                    $helper->getSemestersSelect($data['semester_id']);
                    ?>
                </div>
              </div>
              <div class="row">
                <div class="form-group">
                  <div class="">
                   <input type="hidden" name="catid" id="catid" value="<?php echo $data['catid']; ?>"/>
                    <input type="submit" name="submit" class="btn btn-primary btn-lg" value="<?php echo ($data['catid']) ? "Update" : "Add";?> Category"/>
                  </div>
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