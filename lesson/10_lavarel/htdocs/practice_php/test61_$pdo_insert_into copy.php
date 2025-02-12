<?php
include("bradapis.php");



$sql = "INSERT INTO client(account,passwd,realname) VALUES (:account,:passwd,:realname)";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    ":account" => "Amy",
    ":passwd" => password_hash("123456", PASSWORD_DEFAULT),
    ":realname" => "Emy",
]);
echo $pdo->lastInsertId();
