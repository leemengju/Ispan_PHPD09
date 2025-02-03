<?php

// $_REQUEST 可以同時處理$_POST和$_GET
$account=$_REQUEST['account'];
$passwd=$_REQUEST['passwd'];
$gender=$_REQUEST['gender'];
echo "{$account},{$passwd},{$gender}<br/>";
$hobby=$_REQUEST['hobby'];
var_dump($hobby );

?>