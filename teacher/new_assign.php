<?php 
require '../login_register/conn.php';
session_start();
//$id = $_SESSION["id"];
//$role = $_SESSION["role"];

if(!isset($_SESSION['id'])){
    header("Location: ../login_register/index.php");
    exit;
}

$subject_id = $_SESSION["subject_id"];

//query subject
$query = "SELECT * FROM daftar_subject
        WHERE id = '$subject_id'";
$subject_infos = query($query);
$subject_info = $subject_infos[0];

$num1 = 0;
$num2 = 0;

if(isset($_POST["jumlahMP"])){
    $num1 = $_POST["jumlahMP"];
    $num2 = $_POST["jumlahEssay"];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/navbar.css">
    <link href="css/assgteacher.css" rel="stylesheet">
</head>
<body>
    <?php
    $title = "New Assignment";
    include_once('../navbar/teacher.php');
    ?>  

    <div class="newassgform" >
        <form action="" method="post">
            <p>Multiple choice</p>
            <input type="number" name="jumlahMP" id="jumlahMP" value="<?= $num1?>">
            <p>Essay</p>
            <input type="number" name="jumlahEssay" id="jumlahEssay" value="<?= $num2?>"><br>
            <button type="Submit" class="btn-white">Submit</button>
        </form>
    </div>


    <form action="new_assign_handler.php" method="post">
        
    <div class="newassg">
        <table>
            <tr>
                <th>Subject</th>
                <td>:</td>
                <td><?= $subject_info["subject_name"] ?></td>
            </tr>
            <tr>
                <th rowspan="2">Description</th>
                <td>:</td>
                <td class="desc"><input name="desc" class="field" type="text" value="" placeholder="Describe the assignment" required>
            </tr>


        </table>
    </div>

    <input type="text" name="subjectID" value="<?= $subject_id ?>" hidden>
    <input type="text" name="jumlahSoalMP" value="<?= $num1 ?>" hidden>
    <input type="text" name="jumlahSoalEssay" value="<?= $num2 ?>" hidden>


    <div class="assg-questions">
        <h2>Multiple Choice</h2>
        <div class="mc-container">
            <?php for($i = 1;$i <= $num1;$i++){?>
            <div class="multiple-choice">
                <div>
                    <?=$i?>. <input class="multiple-choice-questions" type="text" name="soalmp[<?= $i ?>][0]" required>
                    <div class="answers">
                        <div class="answers-options"><label for="jawaba[<?=$i?>][1]">A. </label><input type="text" name="jawaba[<?=$i?>][1]" required></div>
                        <div class="answers-options"><label for="jawabb[<?=$i?>][2]">B. </label><input type="text" name="jawabb[<?=$i?>][2]" required></div>
                        <div class="answers-options"><label for="jawabc[<?=$i?>][3]">C. </label><input type="text" name="jawabc[<?=$i?>][3]" required></div>
                        <div class="answers-options"><label for="jawabd[<?=$i?>][4]">D. </label><input type="text" name="jawabd[<?=$i?>][4]" required></div>
                    </div>
                </div>
            </div>
            <?php } ?>

        </div>
        <h2>Essay</h2>
        <div class="essay">
            <table>
                <?php for($i = 1;$i <= $num2;$i++){?>
                <tr>
                    <td><label for="essay[<?=$i?>][0]"><b><?=$i?>. </b></label></td>
                    <td class="essay-td"> <input class="essay-questions" type="text" name="essay[<?=$i?>][0]" required></td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>
    <button class="create-assg" type="submit" name="submit" value="submit">Create Assignment</button>

    </form>
</body>
</html>