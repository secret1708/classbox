<?php   

        require '../../login_register/conn.php';
        $key = $_GET["keyword"];
        $assgId = $_GET["assgId"];
        $query = "SELECT * FROM student 
        WHERE student.name LIKE '%$key%' OR
        student.reg_number LIKE '%$key%'
        ";
        $students = query($query);
?>
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
        
            <p class="grid num-row"> <?= $i ?>
            <p class="grid"><?= $student["name"]; ?></p>
            <p class="grid"><?= $student["reg_number"]; ?> </p>
            <?php
                if(COUNT($status) == 1){
                    ECHO '<a class="link_assg grid grid-right" href="student_ans.php?assgId='.$assgId.'&studentId='.$student["id"].'"> See Answer </a>';
                    if($status[0]["grade"] != NULL){
                        ECHO '<p class="grid grid-right grade-num">'.$status[0]["grade"].'</p>';
                    } else {
                        ECHO '<p class="grid grid-right grade-num"> Not Graded</p>';
                    }
                } else {
                    ECHO '<p class="grid grid-right"> No Submission</p>';
                    ECHO '<p class="grid grid-right grade-num"> Not Graded</p>';
                }
            ?>
            
        

    <?php $i++; } ?>
    </div>