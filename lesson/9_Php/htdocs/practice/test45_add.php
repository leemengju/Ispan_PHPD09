<?php
    $account = 'tony';
    $passwd = password_hash('123456', PASSWORD_DEFAULT) ;
    $realname = 'Tony';
    $sql = 'INSERT INTO cust (account,passwd,realname) VALUES (?,?,?)';

    $mysqli = new mysqli('localhost','root','', 'lance');
    $mysqli->set_charset('utf8');
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('sss', $account, $passwd, $realname);
    if ($stmt->execute()){
        echo 'Add Success';
    }else{
        echo 'Add Failure';
    }

?>