<?php
// <----------------------------------------------將SQL轉成php碼--------------------------------------------->
if ($icon['error'] == 0) {
    // 1.將文件從地端找出來
    // 1.1找文件$icon['tmp_name'] 是文件的臨時存儲路徑。
    $iconData = file_get_contents($icon['tmp_name']);
    // 1.2.存型態
    $iconType = $icon['type'];
    // 2.將文件從地端找出來|環境部屬
    $mysqli = new mysqli('localhost', 'root', '', 'lance');
    $mysqli->set_charset('utf8');
    // 3.建立指令。將icon相關的數據一起存進數據庫
    $sql = 'INSERT INTO client (account,passwd,realname,icon,icontype)' .
        ' VALUES (?,?,?,?,?)';
    // 4.建立變數。執行prepare指令時，將內容存入該變數中。(比$result=$mysqli->query($sql安全)
    $stmt = $mysqli->prepare($sql);
    // 5.並將變數綁定參數。
    $stmt->bind_param('sssss', $account, $passwd, $realname, $iconData, $iconType);
} else {
    $sql = 'INSERT INTO client (account,passwd,realname) VALUES (?,?,?)';
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('sss', $account, $passwd, $realname);
}

// <----------------------------------------------執行$stmt變數--------------------------------------------->
// 1.執行起始
if ($stmt->execute()) {
    header('Location:test52_loginDataBase.php');
} else {
    echo "error:{$mysqli->error}";
}
// 2.儲存結果
$stmt->store_result();
//3.綁定結果
$stmt->bind_result($id, $lastname, $total);
// 4.印製結果
$rank = 1;
while ($stmt->fetch()) {
    echo '<tr>';
    echo "<td>{$rank}</td>";
    echo "<td>{$id}</td>";
    echo "<td>{$lastname}</td>";
    echo "<td>{$total}</td>";
    echo '</tr>';
    $rank++;
}
