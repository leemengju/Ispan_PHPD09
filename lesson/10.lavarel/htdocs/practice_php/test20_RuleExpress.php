<?php
$id="A120504790";
// ^表示第一項
// {}表示前面的條件出現幾次
// $表示結尾，不可以超過。

// preg_match檢查字串是否符合某個模式。後面的$id是否符合$regex的要求和規則。。
$regex="/^[A-Z][12][0-9]{8}$/";
if (preg_match($regex,$id)) {
    echo 'ok';
}else {
    echo'xx';
}



?>