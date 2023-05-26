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

$db = new Database();
$db->open();
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
                <h1>Test</h1>
              </div>
            </div>
          </div>
        </section>
      </header>
      <div class="container">
        <div class="row">
          <div class="col-md-9">
            <h2><strong>Test</strong></h2>
            <hr/>
            
            <link href="css/smart_wizard.css" rel="stylesheet" type="text/css"/>
            <!-- <script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>-->
           
           <?php
           $catid = $_REQUEST['catid'];
           $limit = $_REQUEST['limit'];
           
           $questions=array();
           $sql="SELECT * FROM `question` WHERE `catid`=".$catid." ORDER BY rand() LIMIT 0,$limit";
           $result_set=$db->query($sql);
    	   
        
           while($row=$db->fetcharray($result_set))
           {
                $questions[]=$row;
           }
           
           
           ?>
           <form action="submit.php?catid=<?php echo $catid;?>" method="POST">
           <div id="wizard" class="swMain col-8">
           <ul>
                <?php
                for($i=0;$i<count($questions);$i++)
                {
                    ?>
                    <li>
                        <a href="#step-<?php echo $i+1;?>">
                            <span class="stepNumber"><?php echo $i+1;?></span>
                        </a>
                    </li>
                    <?php 
                }
                ?>
           </ul>
           <?php
           
            for($i=0;$i<count($questions);$i++)
            {
                $question=$questions[$i];
                ?>
                <div id="step-<?php echo $i+1;?>">	
                    <?php
                    echo $question['question'];
                    ?>  
                    <br />
                    <br />
                    <?php if($question['testimage']!=''){ ?>
                    <img src="<?php echo 'admin/images/'.$question['testimage'];?>" width="450" /><br />
                    <?php } ?>
                    <input type="radio" name="question_<?php echo $question['queid'];?>" value="1"  /><?php echo $question['opt1'];?><br />			
                    <input type="radio" name="question_<?php echo $question['queid'];?>" value="2"  /><?php echo $question['opt2'];?><br />
                    <input type="radio" name="question_<?php echo $question['queid'];?>" value="3"  /><?php echo $question['opt3'];?><br />
                    <input type="radio" name="question_<?php echo $question['queid'];?>" value="4"  /><?php echo $question['opt4'];?><br />
                </div>
                <?php 
            }
            ?>
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
<script src="js/jquery-latest.min.js"></script> <!-- Jquery Library Call --> 
<script src="plugins/prettyphoto/js/prettyphoto.js"></script>
<script src="plugins/prettyphoto/js/prettyphoto.js"></script>  
<script src="plugins/owl-carousel/js/owl.carousel.min.js"></script> 
<script src="plugins/page-scroller/jquery.pagescroller.js"></script> 
<script src="js/helper-plugins.js"></script> <!-- Plugins --> 
<script src="js/bootstrap.js"></script> <!-- UI --> 
<script src="js/init.js"></script> <!-- All Scripts --> 

<script type="text/javascript" src="js/jquery.smartWizard-2.0.js"></script>

<script type="text/javascript">
   $(document).ready(function(){
    	$('#wizard').smartWizard({transitionEffect:'slideleft',onFinish:onFinishCallback,enableFinishButton:true});

        function leaveAStepCallback(obj){
            var step_num= obj.attr('rel');
            //return validateSteps(step_num);
        }
        
        function onFinishCallback(){
            $('form').submit();
        }
    });

</script>

<!-- End Js --> 
</body>
</html>