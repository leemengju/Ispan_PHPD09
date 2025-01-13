<?php
// 排序一的index變成1。
$p0=0;$p=array(1=>0,0,0,0,0,0);

// 原本是執骰子，現在改成骰子加鉛，將骰到七八九時減三。
for ($i=0; $i <100; $i++) { 
    $point=rand(1,9);
    if($point>=1 && $point<= 9){
        $p[$point>6? $point-3:$point]++;
    }else {
        $p0++;
    }

}
if($p0==0){
    for ($i=1; $i <=6; $i++) { 
    echo"{$i}點出現{$p[$i]}次<br/>";
}
}else{
    echo "Error:{$p0}";
}
    

?>