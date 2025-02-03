<?php




$v= sum(1,2,3,4,5,6);
function sum(){
// echo func_num_args(); //count($args)
// $args =func_get_args(); // $args[3]
// 用來獲取傳遞給函數的所有參數，並返回一個數組。
$args =func_get_args();
var_dump($args);

 // 初始化加總的變數
$sum=0;
// 使用 foreach 迴圈遍歷參數數組 $args，逐一累加到 $sum
foreach($args as $v){
    $sum +=$v;
}
 // 返回累加的結果
return $sum;

 
}
// 輸出函數的返回值
echo $v;

?>

