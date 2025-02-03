<?php
$r ='';
if  (isset($_GET['x'])){
$x= $_GET['x'];
$y= $_GET['y'];
$op=$_GET['op'];
$c=$x+$y;
switch($op){
    case '1': $r=$x+$y;break;
    case '2': $r=$x-$y;break;
    case '3': $r=$x*$y;break;
    case '4': $r=$x/$y;break;
}

}
?>