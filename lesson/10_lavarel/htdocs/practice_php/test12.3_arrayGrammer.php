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
// 將array[4]的值指定為3，其他照排
$e = array(1,2,3,4=> 3,4,5,6);
var_dump($e);
// array(7) {
//     [0] => int(1)
//     [1] => int(2)
//     [2] => int(3)
//     [4] => int(3)
//     [5] => int(4)
//     [6] => int(5)
//     [7] => int(6)
//   }
echo '<hr/>';
$f []= 'Brad';
var_dump($f);


?>