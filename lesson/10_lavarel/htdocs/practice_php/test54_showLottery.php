<?php

session_start();

$lottery =$_SESSION['lottery'];
echo $lottery;
$array =$_SESSION['ary'];
var_dump($array);

echo'<hr>';

$member =$_SESSION['member'];
echo $member->getRealname();    


?>
<!-- logout通常會把session全部destroy掉 -->
<a href="test55.php">logout</a>