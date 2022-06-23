<?php

require 'conn.php';

if(!isset($_POST)){
    header("Location: regist.php");
    exit;
}

$role = $_POST['role'];

if($role == "Student"){
        if(registStudent($_POST) > 0){
            echo "
                <script> 
                    alert('Regist berhasil');
                    document.location.href='index.php';
                </script>
                ";
        } else {
            echo "
                <script> 
                    alert('Regist gagal');
                    document.location.href='regist.php?key=$role';
                </script>
                ";
        }
} else {
    if(registTeacher($_POST) > 0){
        echo "
            <script> 
                alert('Regist berhasil');
                document.location.href='index.php';   
            </script>
            ";
    } else {
        echo "
            <script> 
                alert('Regist gagal');
                document.location.href='regist.php?key=$role';
            </script>
            ";
    }
}


?>