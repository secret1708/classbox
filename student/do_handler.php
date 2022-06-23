<?php
require '../login_register/conn.php';
session_start();
    if(!isset($_SESSION['id'])){
        header("Location: ../login_register/index.php");
        exit;
    }
if(!isset($_POST) || !isset($_FILES)){
    header("Location: /assig_student.php");
    exit;
}

submitEssay($_FILES["essay_answer"], $_POST);
submitMP($_POST);
finishAssgin($_POST);

ECHO "
<script> 
    alert('Submitted for grading');
    document.location.href='assig_student.php';
</script>
";