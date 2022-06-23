<?php  
        require '../../login_register/conn.php';
        session_start();
        $studentId =  $_SESSION['id'];
        $key = $_GET["keyword"];
        $query = "SELECT daftar_assg.id, daftar_assg.assignment, daftar_assg.description, daftar_assg.status, daftar_subject.subject_name, test_type.type
        FROM daftar_assg
        LEFT JOIN daftar_subject ON daftar_assg.subject_id = daftar_subject.id
        LEFT JOIN test_type ON daftar_assg.test_type = test_type.id
        WHERE daftar_assg.description LIKE '%$key%' OR
            daftar_subject.subject_name LIKE '%$key%' OR
            test_type.type LIKE '%$key%'
        ";
        $assignments = query($query);
?>
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
        WHERE student_id='$studentId' AND
              assigment_id = '$assgId'
        ";
        $test = query($query2);
        if( COUNT($test) > 0){
            //var_dump($test);
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
            //ECHO    '<div class="box" >';
            ECHO        '<div class="topic">'.$assg["subject_name"];
            ECHO            '<p class="title">Assignment '.$assg["assignment"].' '.$assg["description"].' </p>';
            ECHO        '</div>';
            ECHO        '<div class="sub-box">';
            ECHO            '<p class="test_type">'.$assg["type"].'<p>';
            ECHO        '</div>';
            //ECHO    '</div>';
            ECHO    '</a>';
        }
    }

?>

</div>  