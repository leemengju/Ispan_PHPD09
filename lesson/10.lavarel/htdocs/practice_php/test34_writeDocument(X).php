<?php

$fp=fopen("dir1/file1.txt","w");
fwrite($fp,"Hello world");
fclose($fp);

?>