<?php
    $mysqli = new mysqli('localhost','root','', 'brad');
    $mysqli->set_charset('utf8');

    $id = 10;
    $sql = 'DELETE FROM gift WHERE id = ?';
    $stmt =  $mysqli->prepare($sql);
    $stmt->bind_param('i', $id);
    if ($stmt->execute()){
        echo 'DELETE success';
    }else{
        echo 'DELETE failure';
    }


?>