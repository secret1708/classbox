
<?php
    require '../login_register/conn.php';

    session_start();

    if(!isset($_SESSION['id'])){
        header("Location: ../login_register/index.php");
        exit;
    }

    $id = $_SESSION["id"];
    $subject_id = $_SESSION["subject_id"];


    $query = "SELECT daftar_assg.id, daftar_assg.assignment, daftar_assg.description, daftar_subject.subject_name, test_type.type
     FROM daftar_assg
     LEFT JOIN daftar_subject ON daftar_assg.subject_id = daftar_subject.id
     LEFT JOIN test_type ON daftar_assg.test_type = test_type.id
     WHERE subject_id = '$subject_id'
    ";
    $assignments = query($query);
    //var_dump($assignments);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classbox</title>
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="css/stylesheet_assignment.css" />
</head>
<body>

    <?php
        $title = "Assignment";
        include_once('../navbar/teacher.php');
    ?>

    <form class="submit" action="new_assign.php">
        <button type="submit">+ Add</button><br>
    </form><br>
 
    <section class="subject" id="subject">
      <div class="content">
        <div class="boxes">
        
    <?php
    
    foreach($assignments as $assg){
        ECHO '<a class="box" href="view_assig.php?assgId='.$assg["id"].'">';
        ECHO '<div class="topic">'.$assg["subject_name"];
        ECHO '<p class="title">Assignment '.$assg["assignment"].' '.$assg["description"].' </p></div>';
        ECHO '<div class="sub-box">';
        ECHO '<p class="test_type">'.$assg["type"].'</p>';
        ECHO '</div>';
        ECHO '</a>';
    }
    ?>

    </div>  
    </div>
    </section>


</body>
</html>