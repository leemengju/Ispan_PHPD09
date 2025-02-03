<!-- ------------------------------------------------處理用戶註冊表單的提交。將輸入內容存入database---------------------- -->

<?php
// 檢查是否有提供 account 參數。如果沒有提供(所以加!)，就使用 header() 導向到 test50_login.html（通常是登錄頁面）。
if (!isset($_GET['account'])) header('Location: test50_login.html');
// 取得表單數據。$_REQUEST同時包含$get和$post
$account = $_REQUEST['account'];
$passwd = $_REQUEST['passwd'];
$realname = $_REQUEST['realname'];
// 當用戶上傳文件時，PHP 將文件的信息存儲在 $_FILES 全域變數中。
$icon = $_FILES['icon'];
// <-------------------------------------------icon-------------------->
// 檢查文件上傳是否成功。0 表示沒有錯誤。
if ($icon['error'] == 0) {
    $iconData = file_get_contents($icon['tmp_name']);
    $iconType = $icon['type'];
    $sql = 'INSERT INTO client (account,passwd,realname,icon,icontype)' .
        ' VALUES (?,?,?,?,?)';
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('sssss', $account, $passwd, $realname, $iconData, $iconType);
} else {
    $sql = 'INSERT INTO client (account,passwd,realname) VALUES (?,?,?)';
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('sss', $account, $passwd, $realname);
}

// <-------------------------------------------execute-------------------->
if ($stmt->execute()) {
    header('Location:test52_loginDataBase.php');
} else {
    echo "error:{$mysqli->error}";
}

 ?>