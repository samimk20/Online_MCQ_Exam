<?php
error_reporting(0);
session_start();

require_once "../inc/config.php";
require_once "../inc/dbhelper.php";

class AdminHelper
{
    function checkLogin()
    {
        $username=$_POST['username'];
        $password=$_POST['password'];

        $db=new Database();
        $db->open();
        $sql="SELECT * FROM `admins` WHERE `username` ='$username' and `password`='$password' AND status = 1";
        $result=$db->query($sql);
        $row=$db->fetchobject($result);
        return $row;   
    }
    
    function getUsers()
    {
        $db=new Database();
        $db->open();
        
        $sql = "SELECT a.*, b.course_name FROM `members` as a LEFT JOIN `courses` as b ON a.course_id = b.id ORDER BY a.`id` DESC";
        $result = $db->query($sql);
        ?>
        <table class="table table-bordered"> 
            <tr>
			    <th>First Name</th>                                                             
                <th>Last Name</th>
                <th>Username</th>	
                <th>Email</th>                                                             
                <th>Phone</th>
                <th>Address</th>		
                <th>Course</th>		
                <th>Course Year</th>	
                <th>Semester</th>	
                <th>Status</th>		
                <th>Actions</th>	
            </tr>  
            <?php
            $course_year = array('1'=>'First Year','2'=>'Second Year','3'=>'Third Year');
            $semester = array('1'=>'I','2'=>'II','3'=>'III','4'=>'IV','5'=>'V','6'=>'VI');
            while($row = $db->fetcharray($result))
            {
                ?>
                <tr>
                    <td><?php echo $row['fname'];?></td>
                    <td><?php echo $row['lname'];?></td>
                    <td><?php echo $row['username'];?></td>
                    <td><?php echo $row['email'];?></td>
                    <td><?php echo $row['phone'];?></td>
                    <td><?php echo $row['address'];?></td>
                    <td><?php echo $row['course_name'];?></td>
                    <td><?php echo $course_year[$row['course_year_id']];?></td>
                    <td><?php echo $semester[$row['semester_id']];?></td>
                    <td class="text-center">
                        <?php
                        if($row['status'])
                        {
                            ?>
                            <a class="text-success" href="users.php?id=<?php echo $row['id'];?>&status=0&task=update_status">
                                <i class="fa fa-check"></i>
                            </a>
                            <?php
                        }
                        else
                        {
                            ?>
                            <a class="text-danger" href="users.php?id=<?php echo $row['id'];?>&status=1&task=update_status">
                                <i class="fa fa-circle"></i>
                            </a>
                            <?php
                        }
                        ?>
                    </td>
                    <td>
                        <a class="btn btn-danger btn-sm" href="users.php?id=<?php echo $row['id']; ?>&task=remove">
                            <i class="fa fa-trash-o"></i>
                        </a>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>   
        <?php
    }
    
    function updateUserStatus()
    {
        $db=new Database();
        $db->open();
        
        $id     = $_REQUEST['id'];
        $status = $_REQUEST['status'];
                
        $sql = "UPDATE `members` SET `status` = ".$status." WHERE `id` = ".$id;
        $result = $db->query($sql);
        
        if($result)
        {
            return 'User Status Changed Successfully.';
        }
        else
        {
            return 'User Status Not Changed Successfully.';
        }
    }
    
    function deleteUser()
    {
        $db=new Database();
        $db->open();
        
        $id     = $_REQUEST['id'];
                
        $sql = "DELETE FROM `members` WHERE `id` = ".$id;
        $result = $db->query($sql);
        
        if($result)
        {
            return 'User Removed Successfully.';
        }
        else
        {
            return 'User Not Removed Successfully.';
        } 
    }
    
    function getCategories()
    {
        $db=new Database();
        $db->open();
        
        $sql = "SELECT a.*, b.course_name FROM `category` as a 
                LEFT JOIN `courses` as b ON a.course_id = b.id 
                ORDER BY a.`catid` DESC";
        $result = $db->query($sql);
        ?>
        <table class="table table-bordered"> 
            <tr>
			    <th>Category Name</th>                                                             
                <th>Total Question</th>
                <th>Course</th>		
                <th>Course Year</th>	
                <th>Semester</th>			
                <th>Actions</th>	
            </tr>  
            <?php
            $course_year = array('1'=>'First Year','2'=>'Second Year','3'=>'Third Year');
            $semester = array('1'=>'I','2'=>'II','3'=>'III','4'=>'IV','5'=>'V','6'=>'VI');
            while($row = $db->fetcharray($result))
            {
                ?>
                <tr>
                    <td><?php echo $row['catname'];?></td>
                    <td><?php echo $row['totalque'];?></td>
                    <td><?php echo $row['course_name'];?></td>
                    <td><?php echo $course_year[$row['course_year_id']];?></td>
                    <td><?php echo $semester[$row['semester_id']];?></td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="addcat.php?task=edit&catid=<?php echo $row['catid']; ?>"><i class="fa fa-edit"></i></a>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>   
        <?php
    }
    
    function addCategory()
    {
        $db=new Database();
        $db->open();
        
        $catid          = $_POST['catid'];
        $catname        = $_POST['catname'];
        $totalque       = $_POST['totalque'];
        $course_id      = $_POST['course_id'];
        $course_year_id = $_POST['course_year_id'];
        $semester_id    = $_POST['semester_id'];
        
        $sql = "";
        
        if($catid)
        {
            $sql = "UPDATE `category` SET `catname` ='".$catname."', `totalque` ='".$totalque."', `course_id` ='".$course_id."', `course_year_id` ='".$course_year_id."', `semester_id` ='".$semester_id."' WHERE `catid` =".$catid;   
        }
        else
        {
            $sql = "INSERT INTO `category` (`catid`, `catname`, `totalque`, `course_id`, `course_year_id`, `semester_id`) VALUES (NULL, '".$catname."', '".$totalque."', '".$course_id."','".$course_year_id."', '".$semester_id."');";
             
        }
        //echo $sql;die;
        $result = $db->query($sql);
        
        return $result;       
    }
    
    function getCategory($catid)
    {
        $db = new Database();
        $db->open();
        
        $sql = "SELECT * FROM `category` WHERE catid= ".$catid;
        $result = $db->query($sql);
        
        $row = $db->fetcharray($result);
        
        return $row;
    }
    
    function getCategorySelect($id = '')
    {
        $db=new Database();
        $db->open();
        
        $sql = "SELECT * FROM `category` ORDER BY `catname` ASC";
        $result = $db->query($sql);
        ?>
        <select name="catid" id="catid" class="form-control input-lg">
            <option value="">Select Category</option>
            <?php
            while($row = $db->fetcharray($result))
            {
                $selected = '';
                if($row['catid'] == $id)
                {
                    $selected = 'selected="selected"';
                }
                echo "<option value='".$row['catid']."' ".$selected.">".$row['catname']."</option>";
            }
            ?>
        </select>
        <?php
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
    
    function getQuestions()
    {
        $db=new Database();
        $db->open();
        
        $sql="SELECT a.*,b.catname FROM `question` as a JOIN `category` as b ON a.catid = b.catid";
        $result = $db->query($sql);
        ?>
        <table class="table table-bordered"> 
            <tr>
			    <th>Category Name</th>                                                             
                <th>Photo</th>
                <th>Question</th>
                <th>Opt 1</th>                                                             
                <th>Opt 2</th>
                <th>Opt 3</th>	
                <th>Opt 4</th>
                <th>Answer</th>				
                <th width="9%">Actions</th>	
            </tr>  
            <?php
            while($row = $db->fetcharray($result))
            {
                ?>
                <tr>
                    <td><?php echo $row['catname'];?></td>
                    <td>
                        <?php if(file_exists('images/'.$row['testimage']) && $row['testimage']!=''){ ?> 
                        <img src="images/<?php echo $row['testimage']; ?>" style="width: 90px;height: 50;" />
                        <?php } ?>
                    </td>
                    <td><?php echo $row['question'];?></td>
                    <td><?php echo $row['opt1'];?></td>
                    <td><?php echo $row['opt2'];?></td>
                    <td><?php echo $row['opt3'];?></td>
                    <td><?php echo $row['opt4'];?></td>
                    <td>
                        <?php echo $row['opt'.$row['trueans']];?>
                    </td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="addque.php?task=edit&queid=<?php echo $row['queid']; ?>"><i class="fa fa-edit"></i></a>
                        <a class="btn btn-danger btn-sm" href="viewque.php?queid=<?php echo $row['queid']; ?>&task=remove"><i class="fa fa-trash-o"></i></a>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>   
        <?php
    }
    
    function addQuestion()
    {
        $db = new Database();
        $db->open();
        
        $queid      = $_POST['queid'];
        $catid      = $_POST['catid'];
        $testimage  = $_POST['testimage'];
        $question   = $_POST['question'];
        $opt1       = $_POST['opt1'];
        $opt2       = $_POST['opt2'];
        $opt3       = $_POST['opt3'];
        $opt4       = $_POST['opt4'];
        $trueans    = $_POST['trueans'];
        
        $imagefile = $_POST['imagefile'];
        if($_FILES['testimage']['type']=='image/jpeg' || $_FILES['testimage']['type']=='image/gif' || $_FILES['testimage']['type']=='image/png' || $_FILES['testimage']['type']=='image/jpg')
        {
           
            if($_FILES['testimage']['error']>0)
            {
                echo "Error :".$_FILES['testimage']['error'];
            }        
            else
            {
                $imagepath="images/";
                
                if(!is_dir($imagepath))
                {
                    mkdir($imagepath,0777);
                }
                
                if(is_uploaded_file($_FILES['testimage']['tmp_name']))
                {
                    $filename=$_FILES['testimage']['name'];
                  
                    $filename=substr($filename,0,5);
                
                    $type=$_FILES['testimage']['type'];
                    
                    $newtype=str_replace("image/","",$type);
                    $newfilename=$filename.time().".".$newtype;
                    move_uploaded_file($_FILES['testimage']['tmp_name'],$imagepath.$newfilename);
                    
                }
            }
        }
        else
        {
            $newfilename = $imagefile;
        }
        
        $sql = "";
        
        if($queid)
        {
            $sql = "UPDATE `question` SET catid='".$catid."', testimage='".$newfilename."', question='".$question."',opt1='".$opt1."', opt2='".$opt2."', opt3='".$opt3."', opt4='".$opt4."', trueans='".$trueans."' where queid=".$queid;   
        }
        else
        {
            $sql="INSERT INTO `question` (`queid`, `catid`,`testimage`, `question`, `opt1`, `opt2`,`opt3`, `opt4`,`trueans`) VALUES 
             (NULL, '".$catid."', '".$newfilename."', '".$question."','".$opt1."', '".$opt2."', '".$opt3."','".$opt4."', '".$trueans."');";
        
             
        }
        //echo $sql;die;
        $result = $db->query($sql);
        
        return $result;

    }
    
    function getQuestion($queid)
    {
        $db = new Database();
        $db->open();
        
        $sql = "SELECT * FROM `question` WHERE queid= ".$queid;
        $result = $db->query($sql);
        
        $row = $db->fetcharray($result);
        
        return $row;
    }
    
    function deleteQuestion()
    {
        $db=new Database();
        $db->open();
        
        $queid     = $_REQUEST['queid'];
                
        $sql = "DELETE FROM `question` WHERE `queid` = ".$queid;
        $result = $db->query($sql);
        
        if($result)
        {
            return 'Question Removed Successfully.';
        }
        else
        {
            return 'Question Not Removed Successfully.';
        } 
    }
    
    function getResults()
    {
        $db=new Database();
        $db->open();
        
        $sql    = "SELECT a.`id`, b.`catname`, c.`username`, a.`points`, a.`out_of`, a.`created_date` FROM `quiz_result` as a 
                  JOIN `category` as b ON a.`catid`=b.`catid` 
                  JOIN `members` as c ON a.`userid` = c.`id` ORDER BY a.`id` DESC";
        $result = $db->query($sql);
        ?>
        <table class="table table-bordered"> 
            <tr>
			    <th>#</th>           
			    <th>Category Name</th>                                                             
                <th>User name</th>
                <th>Points</th>		
                <th>Out Of</th>		
            </tr>  
            <?php
            while($row = $db->fetcharray($result))
            {
                ?>
                <tr>
                    <td><?php echo $row['id'];?></td>
                    <td><?php echo $row['catname'];?></td>
                    <td><?php echo $row['username'];?></td>
                    <td><?php echo $row['points'];?></td>
                    <td><?php echo $row['out_of'];?></td>
                </tr>
                <?php
            }
            ?>
        </table>   
        <?php
    }
}