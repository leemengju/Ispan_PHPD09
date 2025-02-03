
<?php
include("test37_Object-oriented-programming.php");
session_start();

// 環境部屬:$mysqli 是一個 MySQLi 資料庫連接對象，用來與 MySQL 資料庫進行互動。如果連接成功，$mysqli 就可以用來執行查詢、插入數據、更新記錄等操作。
$mysqli =new mysqli('localhost', 'root', '', 'lance');
$mysqli->set_charset('utf8');





// <------------------------------------------------從資料庫拿資料，並設立分頁上限數------------------------------------------>
$rpp = 10; // rows per page
$sql = 'SELECT count(*) as total FROM gift';
//使用 MySQLi 資料庫連接對象（$mysqli）執行 SQL 查詢（$sql），並將結果存放在 $result 變數中。
$result = $mysqli->query($sql);
// 結果集存儲在 $result 中，接下來需要從中提取資料。fetch_object() 方法從結果集中提取一行，並以物件的形式返回。
$row = $result->fetch_object();
// 將查詢得到的總記錄數賦值給變數 $total。
$total = $row->total;
// ceil無條件進位法 vs floor
$pages = ceil($total / $rpp);


// <------------------------------------------------左右頁遷------------------------------------------>
$page = 1;
if (isset($_GET['page']))$page = $_GET['page'];
$start = $rpp * ($page - 1);
$prev = $page == 1 ? 1 : $page - 1;
$next = $page == $pages ? $page : $page + 1;


// <------------------------------------------------關鍵字模糊搜尋------------------------------------------>
$key = "";
// $sql = 'SELECT id,name,feature,city,town FROM gift LIMIT  ?,?';// 限制每頁有幾筆資料
$sql = 'SELECT id,name,feature,city,town FROM gift'; // 限制每頁有幾筆資料
// 是否有輸入且字串長度需大於0
if (isset($_GET['key']) && strlen($_GET['key']) > 0) {
    $key = $_GET['key'];
    // 將 $key 包裝成適用於 SQL LIKE 語句的格式。
    $skey = "%{$key}%";
    // $sql加上模糊限制。
    $sql .= ' WHERE name LIKE ? OR feature LIKE ? OR city LIKE ? OR town LIKE ?';
    // 使用 MySQLi 的 prepare() 方法準備 SQL 語句，返回一個準備好的語句對象 $stmt。
    $stmt = $mysqli->prepare($sql);
    // bind_param是查尋前，bind_result是查詢後。
    $stmt->bind_param('ssss', $skey, $skey, $skey, $skey);
} else {
    $stmt = $mysqli->prepare($sql);
}
// $stmt->bind_param( "ii",$start,$rpp);
?>

<!-- ----------------------------------html--------------------------------------- -->
<meta charset='UTF-8'>
<h1>Brad Big Company</h1>
<hr />





<a href="logout.php">Logout</a>
<hr />
<a href="?page=<?php echo $prev; ?>">Prev</a> | <a href="?page=<?php echo $next; ?>">Next</a>
<hr />

<form>
    Keyword: <input name="key" value="<?php echo $key; ?>"/>
    <input type="submit" value="Search" />
</form>
<hr />
<!-- ---------------------------------------------------- 執行這段 SQL 查詢----------------------------- -->
<?php
// 執行這段 SQL 查詢
if ($stmt->execute()) {
    // 把查詢結果的每一列對應到 PHP 變數
    $stmt->bind_result($id, $name, $feature, $city, $town);
?>
<!-- ----------------------------------表格--------------------------------------- -->
    <table width='100%' border='1'>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Feature</th>
            <th>City</th>
            <th>Town</th>
        </tr>
        <!-- -------------------------表格內內容-------------------------- -->
        <?php
        // 逐行提取查詢結果。$stmt->fetch() 的功能是抓取資料庫查詢結果的「下一行」，並將數據填充到之前用 $stmt->bind_result() 綁定的變數中。
        while ($stmt->fetch()) {
            echo '<tr>';
            echo "<td>{$id}</td>";
            echo "<td>{$name}</td>";
            echo "<td>{$feature}</td>";
            echo "<td>{$city}</td>";
            echo "<td>{$town}</td>";
            echo '</tr>';
        }
        ?>
    </table>
 <!-- -------------------------灌好表格內內容後，再來確認是否有資料-------------------------- -->
<?php
} else {
    echo '查無資料';
}
?>