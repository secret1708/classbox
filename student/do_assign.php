<?php
session_start();
    if(!isset($_SESSION['id'])){
        header("Location: ../login_register/index.php");
        exit;
    }
require '../login_register/conn.php';
$assgId = $_GET["assgId"];

//query informasi assigment
$query2 =  "SELECT daftar_assg.id, daftar_assg.assignment, daftar_assg.description, daftar_subject.subject_name, test_type.type
            FROM daftar_assg
            LEFT JOIN daftar_subject ON daftar_assg.subject_id = daftar_subject.id
            LEFT JOIN test_type ON daftar_assg.test_type = test_type.id
            WHERE daftar_assg.id = '$assgId'
            ";
$infoAssg  = query($query2);

//query soal
$query = "SELECT * FROM daftar_soal
            WHERE  assignment_id = '$assgId'";
$soals = query($query);
$studentId = $_SESSION["id"];  
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
        $title = "Assigment";
        include_once('../navbar/student.php');
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
        </table>
    </div>


    <form action="do_handler.php" method="post" enctype="multipart/form-data">

    <div class="assg-questions">
        <h2>Multiple Choice</h2>
        <div class="mc-container">
            <?php 
            $num = 1;
            foreach ($soals as $soal){ 
            if($soal["type_test"] == 1){   
            ?>
            <div class="multiple-choice">
                <div>
                    <?=$num.'. '.$soal["soal"]?>
                    <div class="answers">
                        <div class="answers-options">
                            <input type="radio" id="a_<?=$num?>" name="answer_<?=$soal["id"]?>" value="a_<?=$soal["id"]?>">
                            <label for="a_<?=$num?>">A. <?= $soal["answer_a"]?></label>
                        </div>
                        <div class="answers-options">
                            <input type="radio" id="b_<?=$num?>" name="answer_<?=$soal["id"]?>" value="b_<?=$soal["id"]?>">
                            <label for="b_<?=$num?>">B. <?= $soal["answer_b"]?></label>
                        </div>
                        <div class="answers-options">
                            <input type="radio" id="c_<?=$num?>" name="answer_<?=$soal["id"]?>" value="c_<?=$soal["id"]?>">
                            <label for="c_<?=$num?>">C. <?= $soal["answer_c"]?></label>
                        </div>
                        <div class="answers-options">
                            <input type="radio" id="d_<?=$num?>" name="answer_<?=$soal["id"]?>" value="d_<?=$soal["id"]?>">
                            <label for="d_<?=$num?>">D. <?= $soal["answer_d"]?></label>
                        </div>
                    </div>
                </div>
            </div>
            <?php 
            $num++;
            }} ?>
            
        <h2>Essay</h2>
        <?php 
        $num2 = 1;
        foreach ($soals as $soal){ 
        if($soal["type_test"] == 2){   
        ?>
            <div class="essay">
                <table>
                    <tr>
                        <td><?= $num2.'.' ?></td>
                        <td><?=' '.$soal["soal"]?></td>
                    </tr>
                </table>
            </div>
            <?php   
        $num2++;
        }}?>
    </div>
    
    <input type="file" name="essay_answer"><br>
    <input type="text" name="assigId" value="<?= $assgId ?>" hidden>
    <input type="text" name="jumlahSoalMP" value="<?= $num-1 ?>" hidden>
    <input type="text" name="studentId" value="<?= $studentId ?>" hidden>
    <button class="btn-grey" type="submit" class="create-assg">Submit</button>

    </form>
       
</body>
</html>