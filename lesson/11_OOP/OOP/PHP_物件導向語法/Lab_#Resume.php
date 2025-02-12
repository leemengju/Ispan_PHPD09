<?php

// How to resume next when error occured?
//在迴圈中執行 foo($i)，並處理可能發生的錯誤，同時決定是否要繼續執行迴圈或中斷。

$result = "";

// foo($i) 會回傳一個狀態：
// "Yes" → 正常執行，繼續下一個迴圈。
// "No" → 繼續下一個迴圈。
// "fatal error" → 中斷迴圈 (break)。

for ($i = 1; $i <= 9; $i++) {
    $status = foo($i);
    if ($status == "No") {
        continue; // 繼續下一次迴圈
    } else if ($status == "fatal error") {
        break;
    }
}


// 每次呼叫 foo($i)：
// 印出當前的 $i (echo $i . "<br>";)。
// 當 $i == 4，會建立一個 Exception，然後 throw 這個錯誤。
// 這個錯誤會被 catch 捕獲，並回傳 "No"，然後進入下一個迴圈。

function foo($i)
{
    echo $i . "<br>";
    global $result;

    try {
        if ($i == 4) {
            $err = new Exception("An Error occured!!!!!!!!!!");
            echo $err->getMessage(), "<br>";
            throw $err;
        }
        $result .= "$i <br>";
        return 'Yes';
    } catch (Exception $err) {

        // 在 PHP 中，Exception 物件不能直接用 echo 輸出，因為 Exception 是一個物件，而 echo 只能處理字串、數字等基本類型。
        // 所以要加上getMessage()，取得exception的資訊。
        echo $err->getMessage(), "<br>";
        return "No";
    }
}
