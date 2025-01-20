<?php
$path=$_SERVER['DOCUMENT_ROOT'];
require_once $path."/attendance_web/database/database.php";
require_once $path."/attendance_web/database/facultyDetails.php";
$action=$_REQUEST["action"];
if(!empty($action))
{
    if($action=="verifyUser")
    {      
        //retrieve what was sent
          $un=$_POST["user_name"];
          $pw=$_POST["password"];
          //$rv=["un"=>$un,"pw"=>$pw];
          //echo json_encode($rv);
          //check if exists in database
          $dbo=new Database();
          $fdo=new faculty_info();
          $rv=$fdo->verifyUser($dbo,$un,$pw);
          if($rv['status']=="ALL OK")
          {
            session_start();
            $_SESSION['current_user']=$rv['faculty_id'];
          }
          for($i=0;$i<100000;$i++)
          {
            for($j=0;$j<2000;$j++)
            {
              
            }
          }
          //send response
          echo json_encode($rv);
    }
}
?>