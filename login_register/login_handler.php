<?php
session_start();
require 'conn.php';
if(!isset($_POST)){
    header("Location: login.php");
    exit;
}

$role = $_POST["role"];
$regnum = $_POST["regNum"];

if($role == "Student"){
    if(loginStudent($_POST) === 1){
        $query = "SELECT * FROM student
                WHERE reg_number = '$regnum'";
        $user = query($query);
        var_dump($user);
        $_SESSION['id'] = $user[0]["id"];
        $_SESSION['role'] = $role;
        header("Location: ../student/dashboard.php");
        exit;
    } else {
        echo "
            <script> 
                alert('User not found');
                document.location.href='login.php?key=$role';
            </script>
            ";
    }
} else {
    if(loginTeacher($_POST) === 1){
        $query = "SELECT * FROM teacher
                WHERE reg_number = '$regnum'";
        $user = query($query);
        $_SESSION['id'] = $user[0]["id"];
        $_SESSION['role'] = $role;
        $_SESSION["subject_id"] = $user[0]["subject_name"]; 
        header("Location: ../teacher/dashboard.php");
        exit;
    } else {
        echo "
            <script> 
                alert('User not found');
                document.location.href='login.php?key=$role';
            </script>
            ";
    }
}

