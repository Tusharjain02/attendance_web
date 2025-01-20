<?php
$path=$_SERVER['DOCUMENT_ROOT'];
require_once $path."/attendance_web/database/database.php";
require_once $path."/attendance_web/database/sessioninfo.php";
require_once $path."/attendance_web/database/facultyinfo.php";
require_once $path."/attendance_web/database/courseRegiinfo.php";
require_once $path."/attendance_web/database/attendance.php";
function createCSVReport($list,$filename)
{
    $error=0;
    $path=$_SERVER['DOCUMENT_ROOT'];
    $finalFileName=$path.$filename;
    try{
        $fp=fopen($finalFileName,"w");
        foreach($list as $line)
        {
            fputcsv($fp,$line);
        }
    }
    catch(Exception $e)
    {
         $error=1;
    }
}
if(isset($_REQUEST['action']))
{
    $action=$_REQUEST['action'];
    if($action=="getSession")
    {
        
         $dbo=new Database();
         $sobj=new SessionDetails();
         $rv=$sobj->getSessions($dbo);
         
         echo json_encode($rv);
    }
    
    if($action=="getFacultyCourses")
    {
        
         $facid=$_POST['facid'];
         $sessionid=$_POST['sessionid'];
         $dbo=new Database();
         $fo=new faculty_details();
         $rv=$fo->getCoursesInASession($dbo,$sessionid,$facid);
         
         echo json_encode($rv);
    }

    if($action=="getStudentList")
    {
       
         $classid=$_POST['classid'];
         $sessionid=$_POST['sessionid'];
         $facid=$_POST['facid'];
         $ondate=$_POST['ondate'];
         $dbo=new Database();
        $crgo=new CourseRegistrationDetails();
        $allstudents=$crgo->getRegisteredStudents($dbo,$sessionid,$classid);
       
        $ado=new attendanceDetails();
        $presentStudents=$ado->getPresentListOfAClassByAFacOnADate($dbo,$sessionid,$classid,$facid,$ondate);
        
        for($i=0;$i<count($allstudents);$i++)
        {
            $allstudents[$i]['isPresent']='NO';//by default NO
            for($j=0;$j<count($presentStudents);$j++)
            {
                if($allstudents[$i]['id']==$presentStudents[$j]['student_id'])
                {
                    $allstudents[$i]['isPresent']='YES';
                    break;
                }
            }
        }
         //$rv=[];
         echo json_encode($allstudents);
    }

    if($action=="saveattendance")
    {
  
         $courseid=$_POST['course_id'];
         $sessionid=$_POST['session_id'];
         $studentid=$_POST['sap_id'];
         $facultyid=$_POST['faculty_id'];
         $ondate=$_POST['ondate'];
         $status=$_POST['ispresent'];
         $dbo=new Database();
        $ado=new attendanceDetails();
        $rv=$ado->saveAttendance($dbo,$sessionid,$courseid,$facultyid,$studentid,$ondate,$status);
         //$rv=[];
         echo json_encode($rv);
    }


    if($action=="downloadReport")
    {

         $course_id=$_POST['classid'];
         $session_id=$_POST['sessionid'];
         $faculty_id=$_POST['facid'];
        
         $dbo=new Database();
        $ado=new attendanceDetails();
        
         $list=[
            [1,"MCJ21001",20.00],
            [2,"BBM21002",30.00],
            [3,"COM21003",40.00]
         ];
         $list=$ado->getAttenDanceReport($dbo,$sessionid,$courseid,$facultyid);
        
         $filename="/attendanceapp/report.csv";
         $rv=["filename"=>$filename];
         createCSVReport($list,$filename);
         echo json_encode($rv);
    }
}
?>