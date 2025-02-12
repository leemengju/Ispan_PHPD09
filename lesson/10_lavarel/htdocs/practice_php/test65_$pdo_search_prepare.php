<?php
include("bradapis.php");

// 模糊查詢關鍵字
$sql="SELECT * form gift where $name like ':name'";
$stmt=$pdo->prepare($sql);    
$stmt->execute([
    ":name"=>"%禮盒%",
]);


$result=$stmt->fetchAll(PDO::FETCH_ASSOC);

foreach($gifts as $gift){
echo"{$gift['name']}<br/>";
}



?>