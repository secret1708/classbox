<?php

$conn = mysqli_connect("localhost", "root", "", "classbox");

//to make a query
function query($query){
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}

// input data student ke tabel student saat regist
function registStudent($data){
    global $conn;
    $name = $data["name"];
    $regNum = $data["regNum"];
    $password = $data["password"];
    $gender = $data["gender"];

    $query = "INSERT INTO student VALUE ('', '$name', '$regNum', '$password', '$gender')";
    mysqli_query($conn, $query);
    
    return mysqli_affected_rows($conn);
}

// input data saat regist teacher
function registTeacher($data){
    global $conn;
    $name = $data["name"];
    $regNum = $data["regNum"];
    $password = $data["password"];
    $subject = $data["subject"];
    $gender = $data["gender"]; 

    // input data ke table teacher
    $query = "INSERT INTO teacher VALUE ('', '$name', '$regNum', '$password', '$subject', '$gender')";
    mysqli_query($conn, $query);
    $result = mysqli_affected_rows($conn);
    $teacher = query("SELECT * FROM teacher WHERE reg_number ='$regNum'");
    $teacherId = $teacher[0]["id"];
    $teacherSubject = $teacher[0]["subject_name"];

    // input data id teacher ke table subject
    $query2 = "UPDATE daftar_subject SET teacher_id = '$teacherId' WHERE id = '$teacherSubject'";
    mysqli_query($conn, $query2);

    return $result;
}

// cek regnum dan password saat login
function loginStudent($data){
    global $conn;
    $regNum = $data["regNum"];
    $password = $data["password"];

    $query = " SELECT * FROM student WHERE
                reg_number = '$regNum' AND
                student.password = '$password'";

    $result = mysqli_query($conn, $query);

    return mysqli_num_rows($result);
}

// cek regnum dan password saat login
function loginTeacher($data){
    global $conn;
    $regNum = $data["regNum"];
    $password = $data["password"];

    $query = " SELECT * FROM teacher WHERE
                reg_number = '$regNum' AND
                password = '$password'";

    $result = mysqli_query($conn, $query);

    return mysqli_num_rows($result);
}

//untuk submit jawaban multiple choice
function submitMP($datas){
    global $conn;
    $banyakSoal = $datas["jumlahSoalMP"];
    $studentId = $datas["studentId"];
    $assignId = $datas["assigId"];
    $i = 1;
    foreach($datas as $data){
        if($i <= $banyakSoal){
            $sub = explode('_', $data);
            $answer = $sub[0];
            $soalId = $sub[1]; 
        $query = "INSERT INTO daftar_jawaban
                    VALUE ('', '$studentId', '$assignId',
                    '$soalId', '$answer', '')";
        mysqli_query($conn, $query);
        }
        
        $i++;
    }
}

//untuk submit jawaban essay
function submitEssay($data, $data2){
    global $conn;
    $studentId = $data2["studentId"];
    $assignId = $data2["assigId"];
    $tmpName = $data["tmp_name"];
    $gambar = $data["name"];
    $lastName = explode('.', $gambar);
    $fileEks = strtolower(end($lastName));
    $newName = $studentId.'_'.$assignId;
    $newName .= '.';
    $newName .= $fileEks;
    $query = "INSERT INTO daftar_jawaban VALUES ('', '$studentId', '$assignId',
    'essay', '', '$newName')";
    mysqli_query($conn, $query);
    move_uploaded_file($tmpName, '../submited_assignment/'.$newName);//cara memindahkan file
    return mysqli_affected_rows($conn);
}

//untuk menandai assignment yang sudah dikerjakan
function finishAssgin($data){
    global $conn;
    $studentId = $data["studentId"];
    $assignId = $data["assigId"];
    $query = "INSERT INTO submitted_assigment VALUE ('', '$studentId', '$assignId', 'done', '')";
    mysqli_query($conn, $query);
}

function submitAssg($data){
    global $conn;
    $subjectID = $data["subjectID"];
    $desc = $data["desc"];
    $soalMP = $data["jumlahSoalMP"];
    $soalEssay = $data["jumlahSoalEssay"];

    //menentukan jenis soal
    $test_type;
    if($soalMP > 0){
        if($soalEssay > 0){
                $test_type = 3;
        } else {
            $test_typw = 1;
        }
    } else {
        $test_type = 2;
    }
    //cari assigment terakhir
    $query = "SELECT MAX(assignment) FROM daftar_assg
              WHERE subject_id = '$subjectID'";
    $result = query($query);
    $lastAssg = $result[0];

    $lastAssg = $lastAssg["MAX(assignment)"] + 1;
    //query insert assignment to talbe daftar_assg
    $query1 = "INSERT INTO daftar_assg value('', '$subjectID', '$lastAssg', '$desc', '$test_type', 'active')";
    mysqli_query($conn, $query1);

    //cari id dari assignment yang diinput
    $query2 = "SELECT id from daftar_assg
               WHERE daftar_assg.description = '$desc' AND
               assignment = '$lastAssg'";
    $result2 = query($query2);

    $assignId = $result2[0]["id"];

    //loop untuk insert mulitple choice soal satu persatu
    for($i = 1; $i <= $soalMP; $i++){
        $soal = $data["soalmp"][$i][0];
        $jawaba = $data["jawaba"][$i][1];
        $jawabb = $data["jawabb"][$i][2];
        $jawabc = $data["jawabc"][$i][3];
        $jawabd = $data["jawabd"][$i][4];

        $query3 = "INSERT INTO daftar_soal value ('', '$assignId', '1', '$soal', '$jawaba', '$jawabb', '$jawabc', '$jawabd')";
        mysqli_query($conn, $query3);
    }

    //loop untuk insert soal essay
    for($i = 1; $i <= $soalMP; $i++){
        $soal = $data["essay"][$i][0];
        $query4 = "INSERT INTO daftar_soal value ('', '$assignId', '2', '$soal', '', '', '', '')";
        mysqli_query($conn, $query4);
    }
}

function changeStatus($data){
    global $conn;
    $assgId = $data["assgID"];
    $setStatus = $data["setStatus"]; 
    $query = "UPDATE daftar_assg set daftar_assg.status = '$setStatus'
            WHERE id = '$assgId '";
    mysqli_query($conn, $query);
}
