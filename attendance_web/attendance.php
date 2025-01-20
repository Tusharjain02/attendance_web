<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/attendance.css">
    <title>Document</title>
</head>
<body>

     <div class="page">
        <div class="header-area">
            <div class="logo-area"> <h2 class="logo">ATTENDANCE_WEB</h2></div>
            <div class="logout-area"><button class="btnlogout" id="btnLogout">LOGOUT</button></div>
        </div>
        <div class="session-area">
              <div class="label-area"><label>SESSION</label></div>
              <div class="dropdown-area">
                <select class="ddlclass" id="ddlclass">
                  <option>SELECT ONE</option>
                    <option>2023 DIVISION_A</option>
                    <option>2023 DIVISION_B</option>
                </select>
              </div>
        </div>

        <div class="classlist-area" id="classlistarea">
          <div class="classcard">201</div>
          <div class="classcard">202</div>
          <div class="classcard">203</div>
          <div class="classcard">204</div>
          <div class="classcard">205</div>
        </div>

        <div class="classdetails-area" id="classdetailsarea">
        <div class="classdetails">
                <div class="code-area">201</div>
                <div class="title-area">Database Management</div>
                <div class="ondate-area">
                    <input type="date">
                </div>
            </div>
        </div>
        <div class="classdetails-area" id="classdetailsarea">
        <div class="classdetails">
                <div class="code-area">202</div>
                <div class="title-area">DATA MINING</div>
                <div class="ondate-area">
                    <input type="date">
                </div>
            </div>
        </div>
        <div class="classdetails-area" id="classdetailsarea">
        <div class="classdetails">
                <div class="code-area">203</div>
                <div class="title-area">Operating system</div>
                <div class="ondate-area">
                    <input type="date">
                </div>
            </div>
        </div>
        <div class="classdetails-area" id="classdetailsarea">
        <div class="classdetails">
                <div class="code-area">204</div>
                <div class="title-area">Computer Networks</div>
                <div class="ondate-area">
                    <input type="date">
                </div>
            </div>
        </div>
        <div class="classdetails-area" id="classdetailsarea">
        <div class="classdetails">
                <div class="code-area">205</div>
                <div class="title-area">Artificial Intelligence</div>
                <div class="ondate-area">
                    <input type="date">
                </div>
            </div>
        </div>
        
        <div class="studentlist-area" id="studentlistarea">
            <div class="studenttlist"><label>STUDENT LIST</label></div>
            <div class="studentdetails">
                <div class="slno-area">001</div>
                <div class="rollno-area">704122001</div>
                <div class="name-area">Aarav sharma</div>
                <div class="checkbox-area">
                    <input type="checkbox">
                </div>
            </div>

            <div class="studentdetails">
                <div class="slno-area">002</div>
                <div class="rollno-area">704122002</div>
                <div class="name-area">Vivaan Verma</div>
                <div class="checkbox-area">
                    <input type="checkbox">
                </div>
            </div>

            <div class="studentdetails">
                <div class="slno-area">003</div>
                <div class="rollno-area">704122003</div>
                <div class="name-area">Aditya</div>
                <div class="checkbox-area">
                    <input type="checkbox">
                </div>
            </div>

            <div class="studentdetails">
                <div class="slno-area">004</div>
                <div class="rollno-area">704122004</div>
                <div class="name-area">Riya</div>
                <div class="checkbox-area">
                    <input type="checkbox">
                </div>
            </div>

            <div class="studentdetails">
                <div class="slno-area">005</div>
                <div class="rollno-area">704122005</div>
                <div class="name-area">Diya</div>
                <div class="checkbox-area">
                    <input type="checkbox">
                </div>
            </div>

            <div class="studentdetails">
                <div class="slno-area">006</div>
                <div class="rollno-area">704122006</div>
                <div class="name-area">Priya</div>
                <div class="checkbox-area">
                    <input type="checkbox">
                </div>
            </div>

            <div class="studentdetails">
                <div class="slno-area">007</div>
                <div class="rollno-area">704122007</div>
                <div class="name-area">Karan</div>
                <div class="checkbox-area">
                    <input type="checkbox">
                </div>
            </div>
        
           
        </div>
     </div>

     <input type="hidden" id="hiddenSelectedCourseID" value=-1>
    <script src="js/jquery.js"></script>
    <script src="js/attendance.js"></script>

</body>
</html>