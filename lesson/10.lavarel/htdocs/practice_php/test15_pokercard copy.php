<?php
// 洗牌
// 總共52張牌，隨機抽取
$poker = [];
for ($i = 0; $i <= 52; $i++) {
    do{
    $temp = rand(0, 51);

// 檢查機制_去除重複
$isRpeat = false;
for ($j = 0; $j < $i; $j++) {
    // 前面的值與後面相同。
    if ($temp == $spoker[$j]) {
        // 重複了
        $isRpeat = true;
        break;
    }
}
}while($isRpeat);
$poker[]=$temp;
}
// if (!$isRpeat) {
//     $poker[] = $temp;
// } else {
//     $i--;
// }

foreach ($poker as $card) {
    echo "{$card}<br />";
}
// 發牌給四個玩家


// 攤牌



// 理牌
