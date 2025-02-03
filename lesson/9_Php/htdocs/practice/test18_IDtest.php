<!-- test18為function，test21印出來 -->


<?php
// <-------------------------------------------驗證身分證碼--------------------------------------------------------------->
function checkTWID($id)
{
    $isRight = false;
    

    // ^表示第一項
    // {}表示前面的條件出現幾次
    // $表示結尾，不可以超過。
    $regex = "/^[A-Z][12][0-9]{8}$/";
    // preg_match 通常用來檢查字串是否符合某個模式。
    if (preg_match($regex, $id)) {
        $c1 = substr($id, 0, 1);
        $letters = 'ABCDEFGHJKLMNPQRSTUVWXYZIO';
        $a12 = strpos($letters, $c1) + 10;
        $a1 = (int)($a12 / 10);
        $a2 = $a12 % 10;
        $n1 = substr($id, 1, 1);
        $n2 = substr($id, 2, 1);
        $n3 = substr($id, 3, 1);
        $n4 = substr($id, 4, 1);
        $n5 = substr($id, 5, 1);
        $n6 = substr($id, 6, 1);
        $n7 = substr($id, 7, 1);
        $n8 = substr($id, 8, 1);
        $n9 = substr($id, 9, 1);
        $sum = $a1 * 1 + $a2 * 9 + $n1 * 8 + $n2 * 7 + $n3 * 6 + $n4 * 5 + $n5 * 4 + $n6 * 3 + $n7 * 2 + $n8 * 1 + $n9 * 1;

        $isRight = $sum % 10 == 0;
    }
    return $isRight;
}


// <-------------------------------------------生成身分證碼--------------------------------------------------------------->
function createTWIdByRandom(){
//     比較 rand(0, 1) 的結果是否等於 0：
// 如果結果是 0，則 $isMale 會被設定為 false（代表女性）。
// 如果結果是 1，則 $isMale 會被設定為 true（代表男性）。


// 執行流程
// rand(0, 1) 隨機決定性別（0 或 1）。
// 將隨機性別傳遞給 createTWIdByGender。
// createTWIdByGender 返回根據指定性別生成的台灣身分證字號。
// createTWIdByRandom 返回這個隨機生成的身分證字號。
    $isMale = rand(0,1) == 0;
    return createTWIdByGender($isMale);
}
function createTWIdByArea($area){
    $isMale = rand(0,1) == 0;
    return createTWIdByBoth($area, $isMale); 
}
function createTWIdByGender($isMale = true){
    $letters = 'ABCDEFGHJKLMNPQRSTUVWXYZIO';
    $area = substr($letters, rand(0,25), 1);
    return createTWIdByBoth($area, $isMale);
}

function createTWIdByBoth($area, $isMale){
    $id = $area;// 初始化身分證字號，以地區代碼開頭
    $id .= $isMale?'1':'2';
    for ($i=0; $i<7; $i++) {
        $id .= rand(0,9);
    }// 生成隨機7碼，並附加到身分證字號後，總共生成9碼了

    for ($i=0; $i<10; $i++){// 第10碼是檢查碼，用來驗證整個身分證字號的合法性。
        if (checkTWId($id . $i)){// 將當前完整的身分證字號傳入檢查函式
            $id .= $i; // 如果通過檢查，將這一碼加到身分證字號中
            break;
        }
    }
    return $id; // 返回生成的有效身分證字號
}

?>