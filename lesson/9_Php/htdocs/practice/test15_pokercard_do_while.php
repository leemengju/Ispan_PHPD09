<?php
// 洗牌
// 總共52張牌，隨機抽取

// 功能：初始化一個空陣列，用來存放生成的撲克牌數值。
$poker = [];
for ($i = 0; $i < 52; $i++) {

    // 內層 do...while 迴圈
    do {
        $temp = rand(0, 51);

        // 檢查機制_去除重複
        $isRpeat = false;
        // 設定一個假設的j值。
        for ($j = 0; $j < $i; $j++) {
            // 前面的值與後面相同。
            if ($temp == $poker[$j]) {
                // 重複了
                $isRpeat = true;
                break;
            }
        }
    // 功能：如果檢查發現 $temp 已經存在於 $poker 陣列中，則重新生成一個隨機數，直到生成的數字不重複為止。
    } while ($isRpeat);
    $poker[] = $temp;
}
// if (!$isRpeat) {
//     $poker[] = $temp;
// } else {
//     $i--;
// }


// 發牌給四個玩家


// 攤牌



// 理牌
