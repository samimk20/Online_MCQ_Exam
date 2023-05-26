<?php
error_reporting(0);
session_start();
require_once "inc/config.php";
require_once "inc/dbhelper.php";
 
class TestHelper
{
    function saveRegister()
    {
        $id         = $_POST['id'];
        $fname      = $_POST['fname'];
    	$lname      = $_POST['lname'];
    	$username   = $_POST['username'];
    	$password   = $_POST['password'];
    	$email      = $_POST['email'];
    	$phone      = $_POST['phone'];
    	$address    = $_POST['address'];
        $course_id      = $_POST['course_id'];
        $course_year_id = $_POST['course_year_id'];
        $semester_id    = $_POST['semester_id'];
        
        $db = new Database();
        $db->open();
        
        $sql = '';
        if($id)
        {
            $sql = "UPDATE members SET `fname` = '".$fname."', `lname` = '".$lname."', `username` = '".$username."', `password`='".$password."', `email` = '".$email."', `phone`='".$phone."', `address`='".$address."', `course_id`='".$course_id."', `course_year_id`='".$course_year_id."', `semester_id` = '".$semester_id."' WHERE `id` = ".$id;
        }
        else
        {
            $sql = "INSERT INTO members(`id`, `fname`, `lname`, `username`, `password`, `email`, `phone`, `address`, `course_id`, `course_year_id`, `semester_id`) 
                    VALUES(NULL,'".$fname."','".$lname."','".$username."','".$password."','".$email."','".$phone."','".$address."', '".$course_id."','".$course_year_id."', '".$semester_id."')";
        }
        $result=$db->query($sql);
        
        return $result;
    }
    
    function checkUser()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        $db = new Database();
        $db->open();
        
        $sql="SELECT * FROM `members` WHERE `username` ='".$username."' AND `password` ='".$password."'";
        $result=$db->query($sql);
        $row=$db->fetchobject($result);
        
        if($row && $row->status)
        {
            $_SESSION['userid']     = $row->id;
            $_SESSION['username']   = $row->username;
            
           	echo "<script>window.location = 'dashboard.php';</script>";
        }
        else if(!$row->status)
        {
            echo "<script>window.location = 'login.php?error=2';</script>";
        }
        else
        {
            echo "<script>window.location = 'login.php?error=1';</script>";
        } 
    }
    
    function getUser($id)
    {
        $db = new Database();
        $db->open();
        
        $sql="SELECT * FROM `members` WHERE id = ".$id;
        $result=$db->query($sql);
        
        $row = $db->fetcharray($result);
        return $row;
    }
    
    function getCategories()
    {
        $helper = new TestHelper();
        
        $db = new Database();
        $db->open();
        
        $user_info = $helper->getUser($_SESSION['userid']);
        
        $extraSQL = '';
        if($user_info['course_id'])
        {
            $extraSQL .= ' AND a.course_id = '.$user_info['course_id'];
        }
        
        if($user_info['course_year_id'])
        {
            $extraSQL .= ' AND a.course_year_id = '.$user_info['course_year_id'];
        }
        
        if($user_info['semester_id'])
        {
            $extraSQL .= ' AND a.semester_id = '.$user_info['semester_id'];
        }
        
        $sql    = "SELECT a.*, b.course_name FROM `category` as a LEFT JOIN `courses` as b ON a.course_id = b.id WHERE 1 ".$extraSQL;
        $result = $db->query($sql);
        $rows   = array();
        while($row=$db->fetcharray($result))
        {
            $rows[] = $row;
        } 
        return $rows;
    }
    
    
    function getCoursesSelect($id = '')
    {
        $db=new Database();
        $db->open();
        
        $sql = "SELECT * FROM `courses` ORDER BY `id` ASC";
        $result = $db->query($sql);
        ?>
        <select name="course_id" id="course_id" class="form-control input-lg">
            <option value="">Select Course</option>
            <?php
            while($row = $db->fetcharray($result))
            {
                $selected = '';
                if($row['id'] == $id)
                {
                    $selected = 'selected="selected"';
                }
                echo "<option value='".$row['id']."' ".$selected.">".$row['course_name']."</option>";
            }
            ?>
        </select>
        <?php
    }
    
    function getCourseyearsSelect($id = '')
    {
        ?>
        <select name="course_year_id" id="course_year_id" class="form-control input-lg">
            <option value="">Select Course Year</option>
            <option value="1" <?php echo ($id == 1) ? 'selected="selected"' : ''; ?>>First Year</option>
            <option value="2" <?php echo ($id == 2) ? 'selected="selected"' : ''; ?>>Second Year</option>
            <option value="3" <?php echo ($id == 3) ? 'selected="selected"' : ''; ?>>Third Year</option>
            
        </select>
        <?php
    }
    
    
    function getSemestersSelect($id = '')
    {
        ?>
        <select name="semester_id" id="semester_id" class="form-control input-lg">
            <option value="">Select Semester</option>
            <option value="1" <?php echo ($id == 1) ? 'selected="selected"' : ''; ?>>I</option>
            <option value="2" <?php echo ($id == 2) ? 'selected="selected"' : ''; ?>>II</option>
            <option value="3" <?php echo ($id == 3) ? 'selected="selected"' : ''; ?>>III</option>
            <option value="4" <?php echo ($id == 4) ? 'selected="selected"' : ''; ?>>IV</option>
            <option value="5" <?php echo ($id == 5) ? 'selected="selected"' : ''; ?>>V</option>
            <option value="6" <?php echo ($id == 6) ? 'selected="selected"' : ''; ?>>VI</option>
        </select>
        <?php
    }
}
?>