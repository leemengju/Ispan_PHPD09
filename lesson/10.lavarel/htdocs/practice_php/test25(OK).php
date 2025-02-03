<?php

$img = imagecreatefromjpeg('../img/A_small_cup_of_coffee.JPG');


// imagettftext($img,48,0,100,100,$yellow, '../dashboard/font/12345.ttf','Hello,World');


header('content-type:image/jpeg');
imagejpeg($img);

imagedestroy($img);

?>