<?php
include("test37_Object-oriented-programming.php");
session_start();

if (!isset($_SESSION["member"])) header("Location:test52_registerExam&login.php");
$member = $_SESSION['member'];
if (isset($_POST["realname"])) {
    $passwd = $_POST['passwd'];
    $realname = $_POST['realname'];
    $icon = $_FILES['icon'];

    $mysqli = new mysqli('localhost', 'root', '', 'lance');
    $mysqli->set_charset('utf8');

    if ($icon['error'] == 0) {
        $iconData = file_get_contents($icon['tmp_name']);
        $iconType = $icon['type'];
        $sql = 'UPDATE cust SET passwd = ?, realname = ?, icon = ?, icontype = ?' .
            ' WHERE id = ?';
        $stmt = $mysqli->prepare($sql);
        $id = $member->getId();
        $stmt->bind_param('ssssi', $passwd, $realname, $iconData, $iconType, $id);
    } else {
        $sql = 'UPDATE cust SET passwd = ?, $realname = ? WHERE id = ?';
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('ssi', $passwd, $realname, $member->getId());
    }

    if ($stmt->execute()) {
        header('Location: test48#BlurSearch.php');
    } else {
        echo "ERROR: {$mysqli->error}";
    }
}

?>
<form action="test51_registerToDataBase.php" method="post" enctype="multipart/form-data">

    Password:
    <input type="password" name="passwd"><br>
    Realname:
    <input type="text" name="realname"><br>
    Icon: <input type="file" name="icon" /><br />
    <button type="submit">update</button>
</form>