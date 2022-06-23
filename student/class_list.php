<?php
    session_start();
    if(!isset($_SESSION['id'])){
        header("Location: ../login_register/index.php");
        exit;
    }
    require '../login_register/conn.php';
    $list = query("SELECT daftar_subject.subject_name, daftar_subject.logo, teacher.id, teacher.name FROM daftar_subject
    LEFT JOIN teacher ON daftar_subject.teacher_id = teacher.id
    ");
    //var_dump($list);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/classlist.css">
    <title>Classbox</title>
    <link rel="stylesheet" href="../css/navbar.css">
</head>
<body>
<?php
        $title = "Class List";
        include_once('../navbar/student.php');
    ?>
    <div class="container-sementara">
    <div class="cardcontainer">
        <?php foreach ($list as $row) : 
            if($row["id"] == NULL){
                continue;
            }    
        ?>
        <div class="classlist-card">
            <h3 class="subject-name"><?=$row["subject_name"]?></h3>
            <p><?=$row["name"]?></p>
            <img class="class-logo" src="../img/<?= $row["logo"] ?>" alt="">
        </div>
        <?php endforeach; ?>

    </div>
        </div>
</body>
</html>