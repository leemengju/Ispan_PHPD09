<?php
include("test37_Object-oriented-programming.php");
session_start();
// if (!isset($_GET['member'])) header('Location: test50_register.html');
// <----------------------------------------------檢查是否已有帳號，如果有就返回--------------------------------------------->
// 判斷 $_GET['account'] 是否未被設定。
// 如果沒有設定（例如用戶沒有透過 URL 提交帳號），則直接結束程式執行（return）。
if (!isset($_GET['account'])) return;
$account = $_GET['account'];
$sql = 'SELECT account FROM client WHERE account = ?';
$mysqli = new mysqli('localhost', 'root', '', 'lance');
$mysqli->set_charset('utf8');

$stmt =  $mysqli->prepare($sql);
$stmt->bind_param('s', $account);
if ($stmt->execute()) {
    if ($stmt->num_rows() > 0) {
        echo 'Account EXIST!';
    }
}


if (isset($_POST['account'])){
    $account = $_POST['account']; $passwd = $_POST['passwd']; 

    $mysqli = new mysqli('localhost','root','', 'brad');
    $mysqli->set_charset('utf8');
    $sql = 'SELECT id,account,passwd,realname,icon,icontype ' . 
            'FROM client WHERE account = ?';
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('s', $account);
    if ($stmt->execute()){
        $stmt->store_result();
        if ($stmt->num_rows() > 0){
            $stmt->bind_result($id,$account,$hashPasswd,$realname,$icon,$icontype);
            $stmt->fetch();
            if (password_verify($passwd, $hashPasswd)){
                $member=new Member($id, $account, $realname, $icon, $icontype);
                $_SESSION['member']=$member;
                header('Location: test50_register.html');

            }else{
                // Password ERROR
                echo'debug1';
            }
        }else{
            // Account NOT EXIST
            echo'debug2';
        }

    }


}
?>
<meta charset="UTF-8" />
<h1>Login Page</h1>
<hr />
<form action="brad52.php" method="post" >
    Account: <input name="account" /><br />
    Password: <input type="password" name="passwd" /><br />
    <input type="submit" value="Login" />
</form>