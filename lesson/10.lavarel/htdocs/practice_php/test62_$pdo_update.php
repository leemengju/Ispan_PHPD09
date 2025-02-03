<?php
include("bradapis.php");

$sql="UPDATE client set realname=:realname where id= :id";
$stmt= $pdo->prepare($sql);
$stmt->execute([
    ':realname'=> 'Jose',
    ':id'=> '5',
]);
echo $stmt->rowCount();






?>