<?php

define('width', '400');
define('height', '20');

$rate=50;
if (isset($GET['rate'])) {
    $rate=$GET['rate']; //50%
}


// 1.畫布
$img=imagecreate(width,height);


// 2.作畫
$yellow=imagecolorallocate($img,255,255,0);
imagefill($img,0,0,$yellow);
$red=imagecolorallocate($img,255,0,0);
imagefilledrectangle($img,0,0, (int)(width*$rate/100),20,$red);

// 3.輸出(1.Browser; 2.File)
// 表示以下輸出內容為影像資料。
header('content-type:image/jpeg');
imagejpeg($img);



// 4.清除
// 不清除就會在server佔很多記憶體。
imagedestroy($img);


?>