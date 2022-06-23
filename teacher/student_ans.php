<?php
session_start();
require '../login_register/conn.php';
if(!isset($_SESSION['id'])){
    header("Location: ../login_register/index.php");
    exit;
}

if(!isset($_GET["assgId"])){
    header("Location: view_assig.php");
    exit;
}
$assgId = $_GET["assgId"];
$studentId = $_GET["studentId"];   

//query soal
$query = "SELECT * FROM daftar_soal
            WHERE  assignment_id = '$assgId'";
$soals = query($query);


//query informasi assigment
$query2 =  "SELECT daftar_assg.id, daftar_assg.assignment, daftar_assg.description, daftar_subject.subject_name, test_type.type
            FROM daftar_assg
            LEFT JOIN daftar_subject ON daftar_assg.subject_id = daftar_subject.id
            LEFT JOIN test_type ON daftar_assg.test_type = test_type.id
            WHERE daftar_assg.id = '$assgId'
            ";
$infoAssg  = query($query2);

//query informasi siswa
$query5 = "SELECT * FROM student WHERE id = '$studentId'";
$student = query($query5);


if(isset($_POST["grade"])){
    //var_dump($_POST);
    $grade = $_POST["grade"];
    global $conn;
    $query6 = "UPDATE submitted_assigment 
            SET submitted_assigment.grade= '$grade'
            WHERE assigment_id='$assgId' AND student_id='$studentId'";
    mysqli_query($conn, $query6);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classbox</title>
    <link rel="stylesheet" href="../css/navbar.css">
    <link href="css/assgstudent.css" rel="stylesheet">
</head>
<body>
            <?php
            $title = "View Assignment";
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
                <th>Student Name</th>
                <td>:</td>
                <td class="desc"><?= $student[0]["name"]?></td>
            </tr>
            <tr>
                <th>Registration Number</th>
                <td>:</td>
                <td class="desc"><?= $student[0]["reg_number"]?></td>
            </tr>
        </table>
    </div>
    
    <form action="" method="POST">
        <div class="grading">
            <input class="grade" type="number" name="grade" placeholder="0-100">
            <button type="submit" class="btn-grey">Grade</button>
        </div>  
    </form>

    <div class="assg-questions">

    <h2>Multiple Choice</h2> 

    <div class="mc-container">
        <?php 
        $num = 1;
        foreach ($soals as $soal){ 
        if($soal["type_test"] == 1){
            
            //query jawaban
            $soalId = $soal["id"];
            $query3 = "SELECT * FROM daftar_jawaban
                      WHERE soal_id='$soalId' AND
                            student_id='$studentId'";
            $subSoals = query($query3);
            $subSoal = $subSoals[0];
        ?>
        <div class="multiple-choice">
            <div>

            <?=$num.' '.$soal["soal"]?>
            
            <div class="answers">
            <!---- //A ------>
            <div class="answers-options">
            <input disabled type="radio" id="a_<?=$num?>" name="answer_<?=$soal["id"]?>" value="a_<?=$soal["id"]?>"
            <?php if($subSoal["mc_ans"] == "a") ECHO "checked"; ?>
            >
            <label for="a_<?=$num?>">A. <?= $soal["answer_a"]?></label>
            </div>

            <!---- //B ------>
            <div class="answers-options">
            <input disabled type="radio" id="b_<?=$num?>" name="answer_<?=$soal["id"]?>" value="b_<?=$soal["id"]?>"
            <?php if($subSoal["mc_ans"] == "b") ECHO "checked"; ?>
            >
            <label for="b_<?=$num?>">B. <?= $soal["answer_b"]?></label>
            </div>

            <!---- //C ------>
            <div class="answers-options">
            <input disabled type="radio" id="c_<?=$num?>" name="answer_<?=$soal["id"]?>" value="c_<?=$soal["id"]?>"
            <?php if($subSoal["mc_ans"] == "c") ECHO "checked"; ?>
            >
            <label for="c_<?=$num?>">C. <?= $soal["answer_c"]?></label>
            </div>

            <!---- //D ------>
            <div class="answers-options">
            <input disabled type="radio" id="d_<?=$num?>" name="answer_<?=$soal["id"]?>" value="d_<?=$soal["id"]?>"
            <?php if($subSoal["mc_ans"] == "d") ECHO "checked"; ?>
            >
            <label for="d_<?=$num?>">D. <?= $soal["answer_d"]?></label>
            </div>
            </div>

            </div>
        </div>
        <?php 
        $num++;
        }} ?>
    </div>
    <h2>Essay</h2>
    <div class="essay">
    <table>
        <?php 
        $num2 = 1;
        foreach ($soals as $soal){ 
        if($soal["type_test"] == 2){   
        ?>
        <tr>
            <td><?=$num2.'. ' ?></td>
            <td><?= $soal["soal"]?></td>
        </tr>
        <?php   
        $num2++;
        }}?>
        </table>
    </div>
    </div>
        <?php
            //query nama file
            $query4 = "SELECT * FROM daftar_jawaban
            WHERE assigment_id ='$assgId' AND
                  student_id ='$studentId' AND
                  soal_id ='essay'";
            $ansEssay = query($query4);
        ?>
    
    <a href="../submited_assignment/<?=$ansEssay[0]["essay_ans"]?> " download="<?= $infoAssg[0]["description"].'_'.$student[0]["name"] ?>"><button class="download btn-grey ">Download Essay Answer</button></a>
    
</body>
</html>