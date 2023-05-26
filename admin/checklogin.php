<?php 
error_reporting(0);
require_once "adminhelper.php";
$helper = new AdminHelper();
if($_POST)
{
    $row = $helper->checkLogin();
    if($row)
    {
        $_SESSION['userid']=$row->id;
        $_SESSION['username']=$row->username;
        $_SESSION['site']='admin';
        header("Location:dashboard.php");
    }
    else
    {
        $_SESSION['userid']     ='';
        $_SESSION['username']   ='';
        $_SESSION['site']       ='';
        header("Location:index.php?error=1");
    }
}
?>