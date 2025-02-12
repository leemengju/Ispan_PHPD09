<?php
include("bradapis.php");

$sql="DELETE from client where id= :id";
$stmt= $pdo->prepare($sql);
$stmt->execute([
    ':id'=> '5',
]);
echo $stmt->rowCount();












?>