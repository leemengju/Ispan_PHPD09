<?php
$mysqli = new mysqli('localhost', 'root', '', 'lance');
$mysqli->set_charset('utf8');

$id = 10;
$feature = '很好吃';
//     這是一條 SQL 更新語句：
    // UPDATE gift：更新 gift 表格。
    // SET feature = ?：將 feature 欄位的值設為一個參數（用 ? 表示）。
    // WHERE id = ?：只更新 id 等於一個參數的資料列。
    // 注意：SQL 語句中的 ? 是佔位符，用於防止 SQL 注入攻擊。
$sql = 'UPDATE gift SET feature = ? WHERE id = ?';
// prepare 的作用：

// 將 SQL 語句發送到資料庫伺服器。
// 資料庫檢查語句的結構是否正確。
// 返回一個預備語句物件，供後續的參數綁定和執行。
$stmt =  $mysqli->prepare($sql);
// 這行程式碼用於將值綁定到 SQL 語句中的佔位符（?）。
// 第一個參數 'si'：定義了佔位符的資料型別。

    // 's'：代表第一個參數（$feature）是 string（字串）。
    // 'i'：代表第二個參數（$id）是 integer（整數）。
// 後面的參數：提供具體的值。

    // $feature：用來替換 SQL 語句中第一個 ?。
    // $id：用來替換 SQL 語句中第二個 ?。
$stmt->bind_param('si', $feature, $id);
if ($stmt->execute()) {
    echo 'UPDATE success';
} else {
    echo 'UPDATE failure';
}
