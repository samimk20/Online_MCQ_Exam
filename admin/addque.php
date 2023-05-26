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
    var catid    = document.getElementById("catid").value;
    var question = document.getElementById("question").value;
    var opt1     = document.getElementById("opt1").value;
    var opt2     = document.getElementById("opt2").value;
    var opt3     = document.getElementById("opt3").value;
    var opt4     = document.getElementById("opt4").value;
    var trueans  = document.querySelector('input[name="trueans"]:checked'); 
    //document.getElementById("trueans").checked;
    
    var validchar = /^[A-Z a-z]+$/;
    if(catid=='')
    {
        alert("Please select Category Name.");
        return false;
        
    }
    else if(question=='')
    {
        alert("Please Enter Question.");
        return false;
    }
     else if(opt1=='')
    {
        alert("Please Enter option 1.");
        return false;
        
    }
     else if(opt2=='')
    {
        alert("Please Enter option 2.");
        return false;
        
    }
     else if(opt3=='')
    {
        alert("Please Enter option 3.");
        return false;
    }
     else if(opt4=='')
    {
        alert("Please Enter option 4.");
        return false;
    }
     else if(trueans==null)
    {
        alert("Please Select Answer by clicking on radio button.");
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


$queid = $_REQUEST['queid'];
$msg = "";
$class = '';
if($_POST)
{
    $r = $helper->addQuestion();
    if($r)
    {
        $st = ($queid) ? 'Updated' : 'Added';
        $msg='<p>Question '.$st.'.</p>';
              
        $class = 'success';
    }
    else
    {
        $msg = "Question not added.";
        $class = 'alert';
    }
    
}

$data   = array();
if($queid)
{
    $data   = $helper->getQuestion($queid);   
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
                <h1>Add Question</h1>
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
            
            <form method="post" action="" onsubmit="return validate_form();" enctype="multipart/form-data">
             <div class="col-md-6">
             <div class="row">
                <div class="form-group">
                   <?php
                   $helper->getCategorySelect($data['catid']);
                   ?>
                </div>
              </div>
             <div class="row">
                <div class="form-group">   
                    <input type="file" name="testimage" id="testimage" value=""  class="form-control input-lg" placeholder="Upload Image"/>
                    <input type="hidden" name="imagefile" value="<?php echo $data['testimage']; ?>" />  
                </div>
              </div>
              <div class="row">
                <div class="form-group">
                    <input type="text" name="question" id="question" value="<?php echo $data['question']; ?>"  class="form-control input-lg" placeholder="Enter Question"/>
                </div>
              </div>
              <div class="row">
                <div class="form-group">
                  <input type="text" name="opt1" id="opt1" value="<?php echo $data['opt1']; ?>"  class="form-control input-lg" placeholder="Enter Option 1"/>
                </div>
              </div>
              <div class="col-md-4" >
              <div class="row">
                <div class="form-group">
                 <input type="radio"  class="radio" value="1" <?php echo ($data['trueans'] == "1")? "checked='checked'" : "";  ?> id="trueans" name="trueans" />
                </div>
              </div>
              </div>
               <div class="row">
                <div class="form-group">
                  <input type="text" name="opt2" id="opt2" value="<?php echo $data['opt2']; ?>"  class="form-control input-lg" placeholder="Enter Option 2"/>  
                </div>
              </div>
               <div class="col-md-4" >
              <div class="row">
                <div class="form-group">
                  <input type="radio"  class="radio" value="2" <?php echo ($data['trueans'] == "2")? "checked='checked'" : "";  ?> id="trueans" name="trueans" />
                </div>
              </div>
              </div>
               <div class="row">
                <div class="form-group">
                  <input type="text" name="opt3" id="opt3" value="<?php echo $data['opt3']; ?>"  class="form-control input-lg" placeholder="Enter Option 3"/>
                </div>
              </div>
               <div class="col-md-4" >
              <div class="row">
                <div class="form-group">
                  <input type="radio"  class="radio" value="3" <?php echo ($data['trueans'] == "3")? "checked='checked'" : "";  ?> id="trueans" name="trueans" />
                </div>
              </div>
              </div>
               <div class="row">
                <div class="form-group">
                  <input type="text" name="opt4" id="opt4" value="<?php echo $data['opt4']; ?>"  class="form-control input-lg" placeholder="Enter Option 4"/>
                </div>
              </div>
              <div class="col-md-4" >
              <div class="row">
                <div class="form-group">
                  <input type="radio"  class="radio" value="4" <?php echo ($data['trueans'] == "4")? "checked='checked'" : "";  ?> id="trueans" name="trueans" />
                </div>
              </div>
              </div>
              <div class="row">
                <div class="form-group">
                  <div class="">
                    <input type="hidden" name="queid" id="queid" value="<?php echo $data['queid']; ?>"/>
                    <input type="submit" name="submit" class="btn btn-primary btn-lg" value="<?php echo ($data['queid']) ? "Update" : "Add";?> Question"/>
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