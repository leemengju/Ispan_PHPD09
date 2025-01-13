<?php
$i=0;
// 起始值;判斷式;執行
for(printBrad();$i<10;printline()){
    echo "{$i}<br/>";
    $i++;
}

function printBrad(){
    echo 'brad<br/>';
}

function printline(){
    echo 'brad<hr/>';
}

?>