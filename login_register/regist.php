<?php

require 'conn.php';

if(!isset($_GET["key"])){
    header("Location: index.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classbox</title>
    <link rel="stylesheet" href="css/stylesheet2.css" />
    <style>
        .alertpass{
            color: red;
        }
        .invis{
            display: none;
        }
    </style>
</head>
<body>
    
    <h1>CREATE ACCOUNT</h1>
    <p>(<?=$_GET["key"]?>)</p>

    <form action="register_handler.php" method="post">
        <label for="name">Name</label><br>
        <input required type="text" name="name" id="name"><br>
        <label for="regNum">Reg. Number</label><br>
        <input required type="text" name="regNum" id="regNum"><br>
        <label for="password">Password</label><br>
        <input required type="password" name="password" id="password"><br>
        <label for="password2">Confirm Password</label><br>
        <input required type="password" name="password2" id="password2"><br>
        <p class="alertpass invis" id="alertpass">Password doesn't match!</p>
        
        <?php
            if($_GET["key"] == "Teacher"){
            
                $subjects = query("SELECT * FROM daftar_subject WHERE teacher_id = ' '");
                ECHO '
                <label for="subject">Subject</label>
                <br>
                <select name="subject" id="subject">';
                foreach($subjects as $subject){
                ECHO '<option value="'.$subject["id"].'">'.$subject["subject_name"].'</option>';
                } 
                
                ECHO '
                </select>
                <br>    
                ';
                
            }
        ?>
        <div class="radio-box">
            <input required class="input-radio" type="radio" name="gender" id="male" value="male">
            <label for="male">Male</label>
            <input required class="input-radio" type="radio" name="gender" id="female" value="female">
            <label for="female">Female</label><br>
        </div>
        <input type="text" name="role" value="<?php ECHO $_GET['key']?>" hidden>
        <button type="submit" id="myBtn">Create</button>
    </form>
    <a href="login.php?key=<?= $_GET["key"] ?>">I already have an account</a>
    
    <script>
        var pw1  = document.getElementById("password");  
        var pw2  = document.getElementById("password2"); 
        const alertpass  = document.getElementById("alertpass"); 

        document.addEventListener('keyup', logKey);
        
        function logKey(){
            if(pw2.value != pw1.value && pw2.value != ""){
                console.log("x")
                alertpass.classList.remove("invis");
                document.getElementById("myBtn").disabled = true;
            } else {
                console.log("y")
                alertpass.classList.add("invis");
                document.getElementById("myBtn").disabled = false;
            }
        }
    </script>
</body> 
</html>