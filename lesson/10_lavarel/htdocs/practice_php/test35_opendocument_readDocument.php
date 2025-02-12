<?php

$fp=fopen("dir1/file1.csv","r");
while (($line=fgets($fp))!==false) {
 $data= explode(',',$line);
 echo "{$data[2]};{$data[4]};{$data[7]}<br/>"; 
 echo "{$line}<br/>";  
}

fclose($fp);

?>