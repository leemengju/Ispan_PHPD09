<?php
$a=array() ;
echo gettype($a) ;
$b=[] ;
echo gettype($b) ;
echo '<hr/>';
$c=array(1,2,3,4);
// 一個個確認值的屬性。
var_dump($c);
echo '<hr/>';
$d='brad';
var_dump($d);
echo '<hr/>';
$e = array(1,2,3,4=> 3,4,5,6);
var_dump($e);
echo '<hr/>';
$f []= 'Brad';
var_dump($f);


?>