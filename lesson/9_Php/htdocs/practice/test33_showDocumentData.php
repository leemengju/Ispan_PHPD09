<table width='100%' border="1">
<?php
// open檔案或是顯示"系統在忙"
$dir = @opendir("c:/xampp/htdocs/practice") or die("server busy");

// while true時才會執行，false時才會中斷。所以要寫判斷式判斷是否還有內容
while ($content = readdir($dir) !== false) {
//    宣告content，td才會顯示內容
    $content = readdir($dir);
    echo'<tr>';
    echo"<td>{$content}<td>";
    echo'<tr>';
}

//    關閉檔案才可以節省記憶體。
closedir($dir);
?>
</table>
