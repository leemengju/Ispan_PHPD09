<?php
include("bradapis.php");






$sql="INSERT INTO client(account,passwd,realname) VALUES (:account,:passwd,:realname)";
// $mysqli換成$pdo
$stmt= $pdo->prepare($sql);
$stmt->execute([
":account"=>"amy",
":passwd"=>password_hash("123456",PASSWORD_DEFAULT),
":realname"=>"Amy",
]);
// 呼叫最新的id
echo $pdo->lastInsertId();












?>