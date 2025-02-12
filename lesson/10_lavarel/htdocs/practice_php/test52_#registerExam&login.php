<?php
include("test37_Object-oriented-programming.php");
session_start();
// if (!isset($_GET['member'])) header('Location: test50_register.html');
// <----------------------------------------------註冊驗證:檢查是否已有帳號，如果有就返回--------------------------------------------->
$mysqli = new mysqli('localhost', 'root', '', 'lance');
$mysqli->set_charset('utf8');
// 判斷 $_GET['account'] 是否未被設定。
// 1.如果沒有設定（例如用戶沒有透過 URL 提交帳號），則直接結束程式執行（return）。
if (!isset($_GET['account'])) return;
// 2.如果有帳號就抓帳號。
$account = $_GET['account'];
// 3.建立指令。
$sql = 'SELECT account FROM client WHERE account = ?';
// 4.執行方法。將結果儲存在變數中
$stmt =  $mysqli->prepare($sql);
// 5.綁定參數。
$stmt->bind_param('s', $account);

// <----------------------------------------------執行--------------------------------------------->
if ($stmt->execute()) {
    if ($stmt->num_rows() > 0) {
        echo 'Account EXIST!';
    }
}

// <----------------------------------------------登錄驗證:取出帳號和密碼和使用者輸入內容進行比對--------------------------------------------->
// 1.取資料
if (isset($_POST['account'])) {
    // 2.建變數
    $account = $_POST['account'];
    $passwd = $_POST['passwd'];
// 3.環境部屬
    $mysqli = new mysqli('localhost', 'root', '', 'lance');
    $mysqli->set_charset('utf8');
    // 4.建指令
    $sql = 'SELECT id,account,passwd,realname,icon,icontype ' .
        'FROM client WHERE account = ?';
        // 5.執行方法，存變數
    $stmt = $mysqli->prepare($sql);
    // 6.綁定參數
    $stmt->bind_param('s', $account);
}
// <----------------------------------------------執行--------------------------------------------->
if ($stmt->execute()) {
    // 1將查詢結果存儲到 $stmt 中，以便後續操作。
    $stmt->store_result();
    // 2如果找到記錄（num_rows > 0），進行後續處理。
    if ($stmt->num_rows() > 0) {
        // 3.綁定結果，才能顯現
        $stmt->bind_result($id, $account, $hashPasswd, $realname, $icon, $icontype);
        // 4.提取結果：將查詢結果的第一條記錄取出並賦值給綁定的變數。
        $stmt->fetch();
        // 5.驗證
        if (password_verify($passwd, $hashPasswd)) {
        //  6. 建立member的資訊，並存入session
            $member = new Member($id, $account, $realname, $icon, $icontype);
            $_SESSION['member'] = $member;
            //  7.跳轉到內頁
            header('Location: test48#BlurSearch.html');
        } else {
            // Password ERROR
            echo 'debug1';
        }
    } else {
        // Account NOT EXIST
        echo 'debug2';
    }
}



?>
<!-- <----------------------------------------------html---------------------------------------------> -->
<meta charset="UTF-8" />
<h1>Login Page</h1>
<hr />
<form action="test52_#registerExam&login.php" method="post">
    Account: <input name="account" /><br />
    Password: <input type="password" name="passwd" /><br />
    <input type="submit" value="Login" />
</form>