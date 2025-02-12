<?php
include("bradapis.php");




$sql="UPDATE client Set realname =:realname where id=:id ";
$stmt=$pdo->prepare($sql);
$stmt->execute([
    ":realname"=> "Jose",
    ":id"=> "6",
]);
echo $stmt->rowCount(); // 輸出查詢到的行數





?>