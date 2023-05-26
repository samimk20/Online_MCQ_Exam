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
<style>.correct{color: green !important;}.answer_given{color: red;}</style>
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
                <h1>Result</h1>
              </div>
            </div>
          </div>
        </section>
      </header>
      <div class="container">
        <div class="row">
          <div class="col-md-9">
            <h2><strong>Result</strong></h2>
            <hr/>
             <?php
                             
            $marks=0;
            $question_ans=array();
            //var_dump($_POST);die;
            
            foreach($_POST as $key => $value) {
                //do something with your $key and $value;
               // echo  $value . ' ' . $key . ' <br/>';
                
                $id =end(explode("_",$key));
                
                //echo 'Question ID : '. end(explode("_",$key)).' And Answer : '.$value . ' <br/>';
                
                $sql = "SELECT queid FROM `question` WHERE `queid`=".$id." AND `trueans`='".$value."'";
                $res = $db->query($sql);
                $row = $db->fetchobject($res);
                
                if($row->queid)
                {
                    $marks = $marks + 1;
                }
                else
                {
                    $marks = $marks + 0;
                }
                
                $question_ans[]=$id.":".$value;
                //echo $marks;
                
            }
            
            $out_of       = count($question_ans);
            $question_ans = implode(",",$question_ans);
            
            echo " You got ".$marks . " points out of ".$out_of." in Test.";
            
            $query      = "INSERT INTO `quiz_result` (`id`, `catid`, `userid`, `answer`, `points`, `out_of`, `created_date`) 
                          VALUES (NULL, '".$_REQUEST['catid']."', '".$_SESSION['userid']."', '".$question_ans."', '".$marks."', '".$out_of."', now());";
            $r          = $db->query($query);
            $result_id  = $db->insertID();
            
            $query          = "SELECT `answer` FROM `quiz_result` WHERE `id`=".$result_id;
            $answers_given  = $db->query($query);
            
            $questions_id=array();
            $answers_id=array();
            $j = 1; 
            $html = '';
            while($row=$db->fetcharray($answers_given))
            {
                $question_answers=explode(",",$row['answer']);
                
                $html .=  '<hr/><ul>';
                foreach($question_answers as $question_ans)
                {
                    $final=explode(":",$question_ans);
                    
                    $questions_id[] = $final[0];
                    $answers_id[]   = $final[1];
                    
                    
                    $sql="SELECT * FROM `question` WHERE `queid`=".$final[0];
                    $r2 = $db->query($sql);
                    
                    $list=$db->fetchAssoc();
                    
                    $html .=  '<li>
                            <p>'.$j.") ".$list['question'].'
                            <br />';
                           if($list['testimage'] !='')
                           {  
                            $html .=  '<br /><img src="admin/images/'.$list['testimage'].'" width="450" /><br />';
                           } 
                            $html .=  '</p>
                            <ul class="options chevrons">';
                             for($i=1;$i<=4;$i++)
                             {
                                $selected="";
                                if($i==$list['trueans'])
                                {
                                    $selected=" correct";
                                }
                                else
                                {
                                    $selected=" ";
                                }
                                
                                $status="";
                                
                                if($i==$final[1])
                                {
                                    $status=" answer_given";
                                }
                                else
                                {
                                    $status="";
                                }
                                
                                $html .=  '<li class="'.$selected.' '.$status.'">'.$list["opt$i"].'</li>';
                                
                             }   
                                    
                            $html .=  '</ul>
                        </li><li><hr/></li>';
                        
                      $j = $j + 1; 
                    
                }
                
                 
                
                $html .= '</ul>';
                
                
            }
            
            
            echo $html;
            
           ?>
            
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
<!-- End Js --> 
</body>
</html>