<?php
 
function test1($a) {
    echo "test1 is working <br>";
    return $a + 1;
}
 
function test10($a) {
    echo "test10 is working <br>";
    return $a + 10;
}
 

// 呼叫結帳方法 
$s = "test10";
$return = $s(100);
echo "result: " . $return;


/*
 
  $s = textbox1.value;  // ltn.com.tw/ctrlName/actionName/param
  //                                           $s
  if ($s == "breakingNews") {
    breakingNews();
  }
  else if ($s == "sport") {
    sport();
  }  
  else if ($s == "music") {
    music();
  }
 
*/
 
 


