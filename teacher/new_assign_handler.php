<?php
require '../login_register/conn.php';

if(!isset($_POST["submit"])){
    header("Location: new_assign.php");
    exit;
}

submitAssg($_POST);

header("Location: assig_teacher.php");
exit;