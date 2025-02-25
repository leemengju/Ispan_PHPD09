<?php
https://www.dropbox.com/scl/fi/f6w9l0rwngunabq5i19b0/php.txt?rlkey=a66yggoy3zy93hdvcgxwqot19&e=1&st=nz7ktt77&dl=0
    // 底下範例程式碼針對上課使用，請在實際開發時進行調整
    header("Content-type: application/json; charset=UTF-8");
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST');

 
    $mydb = new mysqli('localhost','root','', 'school');
    $mydb->set_charset('utf8');
    $method = $_SERVER["REQUEST_METHOD"];


    // 獲得資料庫的資料有很多種方式；這裡是範例，請比照先前上課方式改寫
    switch($method){
        case "GET":
            $sql = 'SELECT * FROM student';
            $result = $mydb->query($sql);
            $data = [];
            while($row = $result->fetch_object()){
                $data[] = $row;
            }
            echo json_encode($data);
            break;


        case "POST":
            $student_name =  $_POST['student_name'];
            $sql = 'INSERT INTO student (student_name) VALUES (?)';            
            $stmt = $mydb->prepare($sql);
            $stmt->bind_param('s', $student_name);
            $stmt->execute();
            echo json_encode(["sName"=>"insert: " .$mydb -> insert_id . "---" .$student_name]);
            break;
    }


?>


