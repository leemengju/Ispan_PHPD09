<?php
// 初始化 52 張撲克牌，數字 0~51 代表每張牌
$poker = range(0, 51);

// 洗牌邏輯：隨機選一張牌，移到牌組的最後
for ($i = 0; $i < 51; $i++) {
    // 隨機選擇索引
    $randomIndex = rand(0, 51);

    // 取出隨機選中的牌
    $selectedCard = $poker[$randomIndex];

    // 移除該牌
    array_splice($poker, $randomIndex, 1);

    // 將該牌加到陣列的最後
    array_push($poker, $selectedCard);
    //相同的意思 $poker[] = $selectedCard;
}

// 輸出洗牌結果

// $array

// 這是你要迭代的陣列。在這段程式中，$poker 是陣列，表示已經洗好的撲克牌。
// as

// 關鍵字，用於將陣列中的每個元素賦值給變數（這裡是 $card）。
// $value（此處是 $card）

// 表示當前迭代的元素值。在每次迴圈中，$card 將取得 $poker 陣列中的下一個元素值。
echo "洗牌後的撲克牌順序：<br>";
foreach ($poker as $card) {
    echo $card . " ";
}