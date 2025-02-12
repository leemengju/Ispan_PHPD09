<?php

// strpos:選擇的字串是否存在於被選擇的字串裡，如果有就會報位置，沒有就會報false
$s1='ABCDEFG';
$s2='A';

if (strpos($s1,$s2)!==false){
    echo 'ok';
}else{
    echo 'xx';
}
?>