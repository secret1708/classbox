<?php   
session_start();

if(!isset($_SESSION['id'])){
    header("Location: ../login_register/index.php");
    exit;
}
require '../login_register/conn.php';
if(!isset($_GET["assgId"])){
    header("Location: assig_teacher.php");
    exit;
}

$assgId = $_GET["assgId"];

//change assignment status
if(isset($_POST["setStatus"])){
    changeStatus($_POST);
}

//data student
$query = "SELECT * FROM student";
$students = query($query);
$query3 =  "SELECT daftar_assg.id, daftar_assg.status, daftar_assg.assignment, daftar_assg.description, daftar_subject.subject_name, test_type.type
            FROM daftar_assg
            LEFT JOIN daftar_subject ON daftar_assg.subject_id = daftar_subject.id
            LEFT JOIN test_type ON daftar_assg.test_type = test_type.id
            WHERE daftar_assg.id = '$assgId'
            ";
$infoAssg  = query($query3);

//data submitted assignment
$query4 = "SELECT * FROM submitted_assigment
            WHERE assigment_id = '$assgId'";
$submitted = query($query4);

//change assignment status
$jumlah_submit = COUNT($submitted);
$jumlah_murid = COUNT($students);
$belum_submit = $jumlah_murid - $jumlah_submit;
$statusAssg = $infoAssg[0]["status"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classbox</title>
    <link href="css/submittedassg.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/navbar.css">
    <style>
        li {
            display : flex;
            justify-content: space-around ;
        }
    </style>
</head>
<body>
        <?php
        $title = "View Answer";
        include_once('../navbar/teacher.php');
        ?>
        
        <div class="newassg">   
            <table>
                <tr>
                    <th>Subject</th>
                    <td>:</td>
                    <td><?= $infoAssg[0]["subject_name"] ?></td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td>:</td>
                    <td class="desc">Assigment <?= $infoAssg[0]["assignment"].' '.$infoAssg[0]["description"]?></td>
                </tr>
                <tr>
                    <th>Test Type</th>
                    <td>:</td>
                    <td class="desc"><?= $infoAssg[0]["type"] ?></td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>:</td>
                    <td class="desc"><?php if ($statusAssg == "active") ECHO 'Active'; else ECHO 'Closed'; ?></td>
                </tr>
            </table>
        </div>

        <div class="mid">
        <div class="left"><input  class="searchbar" type="text" name="cari" id="keyword" placeholder="Search" ></div>
        <div class="right">
            <div>
            <form action="" method="post">
            <button class="<?php if ($statusAssg == "active") ECHO 'closesub'; else ECHO 'opensub'; ?>" type="submit"><?php if ($statusAssg == "active") ECHO 'Close Assignment'; else ECHO 'Open Assignment'; ?></button>
            <input type="text" name="assgID" value="<?= $assgId?>" hidden>
            <input type="text" name="setStatus" value="<?php if ($statusAssg == "active") ECHO 'closed'; else ECHO 'active'; ?>" hidden>
            </form>
            </div>
            <div class="numsubs">
                <div class="submit">
                    <p><?= $jumlah_submit ?></p>
                </div>
                <div class="notsubmit">
                    <p><?= $belum_submit ?></p>
                </div>
            </div>
        </div>
        </div>

        <input id="assign_id_ajax" type="text" value="<?=$assgId?>" disable hidden>

        <div id="container">
        <div class="student-subs grid-container">

        <?php   
            $i = 1;
            foreach($students as $student){
            $studentID = $student["id"];
            $query2 = "SELECT * FROM submitted_assigment
            WHERE student_id = '$studentID' AND
            assigment_id = '$assgId'";
            $status = query($query2);
        ?>

        
            <p class="grid num-row"><?= $i ?> </p>
            <p class="grid"><?= $student["name"]; ?></p>
            <p class="grid"><?= $student["reg_number"]; ?></p>
            

            <?php
                if(COUNT($status) == 1){
                    ECHO '<a class="link_assg grid grid-right" href="student_ans.php?assgId='.$assgId.'&studentId='.$student["id"].'"> See Answer</a>';
                    if($status[0]["grade"] != NULL){
                        ECHO '<p class="grid grid-right grade-num border-bottom">'.$status[0]["grade"].'</p>';
                    } else {
                        ECHO '<p class="grid grid-right grade-num border-bottom"> Not Graded</p>';
                    }
                } else {
                    ECHO '<p class="grid grid-right" > No Submission</p>';
                    ECHO '<p class="grid grid-right grade-num border-bottom"> Not Graded</p>';
                }
            ?>
            
        

    <?php $i++; } ?>

    </div>
    </div>
<script src="js/script.js"></script>
    
</body>
</html>