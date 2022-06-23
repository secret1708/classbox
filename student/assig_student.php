
<?php
    require '../login_register/conn.php';
    session_start();
    if(!isset($_SESSION['id'])){
        header("Location: ../login_register/index.php");
        exit;
    }
    $studentId = $_SESSION["id"];   

    //query daftar assignment
    $query = "SELECT daftar_assg.id, daftar_assg.assignment, daftar_assg.description, daftar_assg.status, daftar_subject.subject_name, test_type.type
     FROM daftar_assg
     LEFT JOIN daftar_subject ON daftar_assg.subject_id = daftar_subject.id
     LEFT JOIN test_type ON daftar_assg.test_type = test_type.id
    ";
    $assignments = query($query);
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

    <?php
        $title = "Assigment";
        include_once('../navbar/student.php');
    ?>

    <!-- search button -->
    
    <form action="" method="post">
        <input type="text" placeholder="Search..." name="cari" id="keyword">
        <button type="submit"><i class="fa fa-search"></i></button>
    </form>

    <section class="subject" id="subject">
    <div id="container">
        
    <div class="boxes">
          
    
    <?php
    foreach($assignments as $assg){
        $assgId = $assg["id"];
        //cek apakah assignment masih terbuka
        if($assg["status"] == "closed"){
            continue;
        }

        //cek apakah sudah dikerjakan atau belum, jika belum maka tampilkan nilai tapi tidak bisa dikerjakan
        $query2 = "SELECT * FROM submitted_assigment
        WHERE student_id= '$studentId' AND
              assigment_id = '$assgId'
        ";
        
        $test = query($query2);
        if( COUNT($test) > 0){
            if($test[0]["status"] == "done"){
                if($test[0]["grade"] == NULL){
                    $grade = "Not Graded";
                } else {
                    $grade = $test[0]["grade"];
                }
                ECHO    '<div class="box">';
                ECHO        '<div class="topic">'.$assg["subject_name"];
                ECHO            '<p class="title">Assignment '.$assg["assignment"].' '.$assg["description"].' </p>';
                ECHO        '</div>';
                ECHO        '<div class="sub-box">';
                ECHO            '<p class="test_type">'.$assg["type"].'<p>';
                ECHO            '<P class="grade"> <b>'.$grade.'</b> </p>';
                ECHO        '</div>';
                ECHO    '</div>';
            }
        } else {
            ECHO    '<a class ="box" href="do_assign.php?assgId='.$assg["id"].'">';
            ECHO        '<div class="topic">'.$assg["subject_name"];
            ECHO            '<p class="title">Assignment '.$assg["assignment"].' '.$assg["description"].' </p>';
            ECHO        '</div>';
            ECHO        '<div class="sub-box">';
            ECHO            '<p class="test_type">'.$assg["type"].'</p>';
            ECHO        '</div>';
            ECHO    '</a>';
        }
    }
    
    ?>
    </div>
    
    <script src="js/script.js"></script>
</body>
</html>