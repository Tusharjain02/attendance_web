<?php
$path=$_SERVER['DOCUMENT_ROOT'];
require_once $path."/attendance_web/database/database.php";
class faculty_info
{
    public function verifyUser($dbo,$un,$pw)
    {
        $rv=["id"=>-1,"status"=>"ERROR"];
          $c="select faculty_id,password from faculty_info where user_name=:un";
          $s=$dbo->conn->prepare($c);
          try{
             $s->execute([":un"=>$un]);
             if($s->rowCount()>0)
             {
                 $result=$s->fetchAll(PDO::FETCH_ASSOC)[0];
                 if($result['password']==$pw)
                 {
                    //all ok
                    $rv=["faculty_id"=>$result['faculty_id'],"status"=>"ALL OK"];
                 }
                 else{
                    //pw does not match
                    $rv=["faculty_id"=>$result['faculty_id'],"status"=>"Wrong password"];
                 }
             }
             else{
              //user name does not exists
              $rv=["faculty_id"=>-1,"status"=>"USER NAME DOES NOT EXISTS"];
             }
     }
          catch(PDOException $e)
          {

    }
          json_encode ($rv);

    
    }
}   
?>

