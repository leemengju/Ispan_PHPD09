<?php

//如果需要儲存資料，存在session
session_start();

$lottery= rand(1,49);
echo $lottery ;
// 陣列處理方式
$_SESSION['lottery']=$lottery;


$ary=[1,2,3,4];
$_SESSION['ary']=$ary;


$ary[0]=100;




