<?php
// 宣告為0
$p1=$p2=$p3=$p4=$p5=$p6=$p0=0;
// 執一百次，
for ($i=0; $i <100; $i++) { 
    $point=rand(1,6);
    switch($point){
        case '1': $p1++;break;
        case '2': $p2++;break;
        case '3': $p3++;break;
        case '4': $p4++;break;
        case '5': $p5++;break;
        case '6': $p6++;break;
        default :$p0++;
    }

}
if($p0==0){
    echo"一點出現{$p1}次<br/>";
    echo"兩點出現{$p2}次<br/>";
    echo"三點出現{$p3}次<br/>";
    echo"四點出現{$p4}次<br/>";
    echo"五點出現{$p5}次<br/>";
    echo"六點出現{$p6}次<br/>";
}

?>