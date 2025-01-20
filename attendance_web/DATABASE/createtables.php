<?php

$path = $_SERVER['DOCUMENT_ROOT'];
require_once $path . "/attendance_web/database/database.php";
function clearTable($dbo,$tabName)
{
    $c="Delete from :tabname";
    $s=$dbo->conn->prepare($c);
    try{
        $s->execute([":tabname"=>$tabName]);
    }
    catch(PDOException $oo){

    }

}

$dbo = new Database();

// Create student_details table
$c = "create table student_info
(
    sap_id int  primary key,
    roll_no varchar(20) unique,
    name varchar(50)
)";
$s = $dbo->conn->prepare($c);
try {
    $s->execute();
    echo("<br>student_info created");
} catch (PDOException $o) {
    echo("<br>student_info not created");
}

// Create course_details table
$c = "create table course_info
(
    course_id int primary key,
    code varchar(20) unique,
    title varchar(50),
    credit int
)";
$s = $dbo->conn->prepare($c);
try {
    $s->execute();
    echo("<br>course_info created");
} catch (PDOException $o) {
    echo("<br>course_info not created");
}

// Create faculty_details table
$c = "create table faculty_info
(
    faculty_id int primary key,
    user_name varchar(20) unique,
    name varchar(100),
    password varchar(50)
)";
$s = $dbo->conn->prepare($c);
try {
    $s->execute();
    echo("<br>faculty_info created");
} catch (PDOException $o) {
    echo("<br>faculty_info not created");
}

// Create session_details table
$c = "create table session_info
(
    session_id int primary key,
    year int,
    term varchar(50),
    unique (year, term)
)";
$s = $dbo->conn->prepare($c);
try {
    $s->execute();
    echo("<br>session_info created");
} catch (PDOException $o) {
    echo("<br>session_info not created");
}

// Create course_registration table
$c = "create table course_regi
(
    student_id int,
    course_id int,
    session_id int,
    primary key (student_id, course_id, session_id)
)";
$s = $dbo->conn->prepare($c);
try {
    $s->execute();
    echo("<br>course_regi created");
} catch (PDOException $o) {
    echo("<br>course_regi not created");
}

// Create course_allotment table
$c = "create table course_view
(
    faculty_id int,
    course_id int,
    session_id int,
    primary key (faculty_id, course_id, session_id)
)";
$s = $dbo->conn->prepare($c);
try {
    $s->execute();
    echo("<br>course_view created");
} catch (PDOException $o) {
    echo("<br>course_view not created");
}

// Create attendance_details table
$c = "create table attendance_info
(
    faculty_id int,
    course_id int,
    session_id int,
    sap_id int,
    on_date date,
    status varchar(10),
    percentage int,
    primary key (faculty_id, course_id, session_id, sap_id)
)";
$s = $dbo->conn->prepare($c);
try {
    $s->execute();
    echo("<br>attendance_info created");
} catch (PDOException $o) {
    echo("<br>attendance_info not created");
}



// Insert data into student_details
$c = "INSERT into student_info (sap_id, roll_no, name) 
values
(7041220001, 1, 'Aarav Sharma'),
(7041220002, 2, 'Vivaan Verma'),
(7041220003, 3, 'Aditya Gupta'),
(7041220004, 4, 'Riya Patel'),
(7041220005, 5, 'Diya Reddy'),
(7041220006, 6, 'Priya Nair'),
(7041220007, 7, 'Karan Iyer'),
(7041220008, 8, 'Sneha Singh'),
(7041220009, 9, 'Aryan Chopra'),
(7041220010, 10, 'Meera Jain'),
(7041220011, 11, 'Ishaan Nair'),
(7041220012, 12, 'Ananya Sharma'),
(7041220013, 13, 'Rohan Verma'),
(7041220014, 14, 'Tanya Gupta'),
(7041220015, 15, 'Vikram Patel'),
(7041220016, 16, 'Aditi Reddy'),
(7041220017, 17, 'Raghav Nair'),
(7041220018, 18, 'Neha Iyer'),
(7041220019, 19, 'Kabir Singh'),
(7041220020, 20, 'Simran Chopra'),
(7041220021, 21, 'Laksh Jain'),
(7041220022, 22, 'Pooja Sharma'),
(7041220023, 23, 'Varun Verma'),
(7041220024, 24, 'Snehal Gupta'),
(7041220025, 25, 'Madhav Patel'),
(7041220026, 26, 'Nisha Reddy'),
(7041220027, 27, 'Rahul Nair'),
(7041220028, 28, 'Ira Iyer'),
(7041220029, 29, 'Manav Singh'),
(7041220030, 30, 'Nidhi Chopra')";
$s = $dbo->conn->prepare($c);
try {
    $s->execute();
    echo("<br>data entered in student_info");
} catch (PDOException $o) {
    echo("<br>duplicate entry: " . $o->getMessage());
}


// Insert data into faculty_details
$c = "INSERT into faculty_info (faculty_id, user_name, password, name) values
    (11, 'rakesh.sharma', 'pass1631', 'Dr. Rakesh Sharma'),
    (12, 'anjali.verma', 'pass9199', 'Dr. Anjali Verma'),
    (13, 'neeraj.gupta', 'pass5012', 'Dr. Neeraj Gupta'),
    (14, 'kavita.patel', 'pass9431', 'Prof. Kavita Patel'),
    (15, 'amit.reddy', 'pass8319', 'Prof. Amit Reddy'),
    (16, 'seema.nair', 'pass5695', 'Dr. Seema Nair'),
    (17, 'rohit.iyer', 'pass4285', 'Prof. Rohit Iyer'),
    (18, 'priya.singh', 'pass4476', 'Dr. Priya Singh'),
    (19, 'arvind.chopra', 'pass5517', 'Prof. Arvind Chopra'),
    (110, 'meena.jain', 'pass2109', 'Dr. Meena Jain')";
$s = $dbo->conn->prepare($c);
try {
    $s->execute();
    echo("<br>data entered in faculty_info");
} catch (PDOException $o) {
    echo("<br>duplicate entry");
}


// Insert data into session_details
$c = "INSERT into session_info (session_id, year, term) values
    (101, 2024, 'DIVISION_A'),
    (102, 2024, 'DIVISION_B')";
$s = $dbo->conn->prepare($c);
try {
    $s->execute();
    echo("<br>data entered in session_info");
} catch (PDOException $o) {
    echo("<br>duplicate entry");
}

// Insert data into course_details
$c = "INSERT into course_info (course_id, title, code, credit) values
    (201, 'Database Management System', 'DBMS1', 4),
    (202, 'Data Mining', 'DM1', 4),
    (203, 'Operating Systems', 'OS1', 3),
    (204, 'Computer Networks', 'CN1', 3),
    (205, 'Artificial Intelligence', 'AI1', 4),
    (206, 'Machine Learning', 'ML1', 4),
    (207, 'Software Engineering', 'SE1', 4), 
    (208, 'Web Technologies', 'WT1', 3),
    (209, 'Cyber Security', 'CS1', 4),
    (210, 'Cloud Computing', 'CC1', 4)";
$s = $dbo->conn->prepare($c);
try {
    $s->execute();
    echo("<br>Data entered in course_info");
} catch (PDOException $o) {
    echo("<br>Duplicate entry: " . $o->getMessage());
}

clearTable($dbo,"course_regi");
$c="INSERT into course_regi (sap_id,course_id,session_id) values
(:sid,:cid,:sessid)";
    $s=$dbo->conn->prepare($c);

//to randomly choose courses for every student
for ($i=1;$i<=30;$i++)
{
    for($j=0;$j<3;$j++)
    {
        $cid=rand(201,210);
        //insert selected course into cousre_regi 
        try{
            $s->execute([":sid"=>$i,":cid"=>$cid,":sessid"=>1]);
        }
        catch(PDOException $pe){

        }
    

//for session2

        $cid=rand(201,210);
        //insert selected course into cousre_regi 
        try{
            $s->execute([":sid"=>$i,":cid"=>$cid,":sessid"=>2]);
        }
        catch(PDOException $pe){

        }
    }
}

clearTable($dbo,"course_view");
$c="INSERT into course_view (faculty_id,course_id,session_id) values
(:fid,:cid,:sessid)";
    $s=$dbo->conn->prepare($c);

//to randomly choose courses for every faculty(10)
for ($i=1;$i<=10;$i++)
{
    for($j=0;$j<2;$j++)
    {
        $cid=rand(201,210);
        //insert selected course into cousre_view
        try{
            $s->execute([":fid"=>$i,":cid"=>$cid,":sessid"=>1]);
        }
        catch(PDOException $pe){

        }
    

//for session2

        $cid=rand(201,210);
        //insert selected course into cousre_view
        try{
            $s->execute([":fid"=>$i,":cid"=>$cid,":sessid"=>2]);
        }
        catch(PDOException $pe){

        }
    }
}

    
    ?>

