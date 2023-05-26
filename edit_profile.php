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

$msg = '';
$class = '';
    
if($_POST)
{
    $result = $helper->saveRegister();
    
    if($result)
    {
        $msg = "Profile Updated.";
        $class = 'success';
    }
    else
    {
        $msg = "Profile Not Updated";
        $class = 'alert';
    }
}

$data = $helper->getUser($_SESSION['userid']);
?>

<script type="text/javascript">
function validate_form()
{
   
    var fname    = document.getElementById("fname").value;
    var lname    = document.getElementById("lname").value;
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    var phone    = document.getElementById("phone").value;
    var email    = document.getElementById("email").value;
    
    var course_id       = document.getElementById("course_id").value;
    var course_year_id  = document.getElementById("course_year_id").value;
    var semester_id     = document.getElementById("semester_id").value;
    
    var validchar = /^[A-Z a-z]+$/;
    if(fname=='')
    {
        alert("Please Enter First Name.");
        return false;
    }
    else if(!validchar.test(fname))
    {
        alert("First Name should not be numeric.");
        return false;
    }
    else if(lname=='')
    {
        alert("Please Enter Last Name.");
        return false;
    }
    else if(!validchar.test(lname))
    {
        alert("Last Name should not be numeric.");
        return false;
    }
    else if(username=='')
    {
        alert("Please Enter User Name.");
        return false;
    }
    else if(password=='')
    {
        alert("Please Enter Password.");
        return false;
    }
    else if(phone=='')
    {
        alert("Please Enter Phone Number.");
        return false;  
    }
    else if(isNaN(phone))
    {
        alert("Phone Number should be numeric.");
        return false;  
    }
    else if(checkInternationalPhone(phone)==false)
    {
        alert("Please Enter a Valid Phone Number");
		return false;
    }
    else if(email=='')
    {
        alert("Please Enter Email Address.");
        return false;
    }
    else if(validateEmail(email))
    {
        alert("Please Enter Valid Email Address.");
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

function validateEmail(email)
{
    var atpos  = email.indexOf("@");   // The indexOf() method returns the position of the first occurrence of a specified value in a string. // Default value of start is 0  
    //alert(atpos);
    var dotpos = email.lastIndexOf(".");  // The lastIndexOf() method returns the position of the last occurrence of a specified value in a string. // Default value of start is 0  
    //alert(dotpos);
    
    if((atpos<1) || (dotpos<(atpos+2)) || (dotpos+2>=email.length))  
    {
        return true;
    }
    else
    {
        return false;
    }
}

// Declaring required variables
var digits = "0123456789";
// non-digit characters which are allowed in phone numbers
var phoneNumberDelimiters = "()- ";
// characters which are allowed in international phone numbers
// (a leading + is OK)
var validWorldPhoneChars = phoneNumberDelimiters + "+";
// Minimum no of digits in an international phone no.
var minDigitsInIPhoneNumber = 10;

function isInteger(s)
{   var i;
    for (i = 0; i < s.length; i++)
    {   
        // Check that current character is number.
        var c = s.charAt(i);
        if (((c < "0") || (c > "9"))) return false;
    }
    // All characters are numbers.
    return true;
}

function trim(s)
{   var i;
    var returnString = "";
    // Search through string's characters one by one.
    // If character is not a whitespace, append to returnString.
    for (i = 0; i < s.length; i++)
    {   
        // Check that current character isn't whitespace.
        var c = s.charAt(i);
        if (c != " ") returnString += c;
    }
    return returnString;
}

function stripCharsInBag(s, bag)
{   var i;
    var returnString = "";
    // Search through string's characters one by one.
    // If character is not in bag, append to returnString.
    for (i = 0; i < s.length; i++)
    {   
        // Check that current character isn't whitespace.
        var c = s.charAt(i);
        if (bag.indexOf(c) == -1) returnString += c;
    }
    return returnString;
}

function checkInternationalPhone(strPhone){
    var bracket=3;
    strPhone=trim(strPhone);
    if(strPhone.indexOf("+")>1) return false;
    if(strPhone.indexOf("-")!=-1)bracket=bracket+1;
    if(strPhone.indexOf("(")!=-1 && strPhone.indexOf("(")>bracket)return false;
    var brchr=strPhone.indexOf("(");
    if(strPhone.indexOf("(")!=-1 && strPhone.charAt(brchr+2)!=")")return false;
    if(strPhone.indexOf("(")==-1 && strPhone.indexOf(")")!=-1)return false;
    s=stripCharsInBag(strPhone,validWorldPhoneChars);
    return (isInteger(s) && s.length >= minDigitsInIPhoneNumber);
}

</script>

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
                <h1>Edit Profile</h1>
              </div>
            </div>
          </div>
        </section>
      </header>
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-md-offset-4">
            <h2><strong>Edit Profile</strong></h2>
            <hr/>
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
              <div class="row">
                <div class="form-group">
                  <div class="col-md-12">
                    <input type="text" name="fname" id="fname" value="<?php echo $data['fname']; ?>"  class="form-control input-lg" placeholder="First Name"/>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="form-group">
                  <div class="col-md-12">
                    <input type="text" name="lname" id="lname" value="<?php echo $data['lname']; ?>"  class="form-control input-lg" placeholder="Last Name"/>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="form-group">
                  <div class="col-md-12">
                    <input type="text" name="username" id="username" value="<?php echo $data['username']; ?>"  class="form-control input-lg" placeholder="Username"/>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="form-group">
                  <div class="col-md-12">
                    <input type="password" name="password" id="password" value="<?php echo $data['password']; ?>"  class="form-control input-lg" placeholder="Password"/>
                  </div>
                </div>
              </div>
               <div class="row">
                <div class="form-group">
                  <div class="col-md-12">
                    <input type="text" name="email" id="email" value="<?php echo $data['email']; ?>"  class="form-control input-lg" placeholder="Email"/>
                  </div>
                </div>
              </div>
            
              <div class="row">
                <div class="form-group">
                  <div class="col-md-12">
                    <input type="text" name="phone" id="phone" value="<?php echo $data['phone']; ?>"  class="form-control input-lg" placeholder="Phone Number" size="10"/>
                  </div>
                </div>
              </div>
             <div class="row">
                <div class="form-group">
                  <div class="col-md-12">
                    <textarea name="address" id="address" class="form-control input-lg" placeholder="Address"><?php echo $data['address']; ?></textarea>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="form-group col-md-12">
                    <?php
                    $helper->getCoursesSelect($data['course_id']);
                    ?>
                </div>
              </div>
              <div class="row">
                <div class="form-group col-md-12">
                    <?php
                    $helper->getCourseyearsSelect($data['course_year_id']);
                    ?>
                </div>
              </div>
              <div class="row">
                <div class="form-group col-md-12">
                    <?php
                    $helper->getSemestersSelect($data['semester_id']);
                    ?>
                </div>
              </div>
              
              <div class="row">
                <div class="form-group">
                  <div class="col-md-12">
                    <input type="hidden" name="id" value="<?php echo $data['id'];?>" />
                    <input type="submit" name="submit" class="btn btn-primary btn-lg" value="Update Profile"/>
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