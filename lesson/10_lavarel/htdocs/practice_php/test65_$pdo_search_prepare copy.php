<?php
include("bradapis.php");

// 模糊查詢關鍵字
$sql="SELECT * from gift where name like :key";
$stmt= $pdo->prepare($sql);
$stmt->execute([
    ":key"=> "%禮盒%",
]);
// fetchAll()
// fetchAll() 是 PDO 提供的方法，用來一次性地取得查詢結果的所有資料。
// 它會根據指定的模式，將資料庫中的結果轉換成某種格式並返回。

// PDO::FETCH_OBJ
// 這個常數是 fetchAll() 的一個選項，表示將每一筆資料的結果轉換成物件形式。
// 返回的每筆記錄將是一個匿名物件，物件的屬性名稱會對應到資料庫表中的欄位名稱。
$gifts=$stmt->fetchAll(PDO:: FETCH_OBJ);


// 應用前面的function，回傳gift名稱。
foreach($gifts as $gift){
    echo"{$gift['name']}<br/>";
}







?>