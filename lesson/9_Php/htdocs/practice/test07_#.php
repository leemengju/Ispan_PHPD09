<!-- 加減乘除演算器 -->
<?php
// 先將變數全部歸零
$x=$y=$op=$r ='';
// 問變數是否存在
// isset外面要包一層，裡面再包一層。
if  (isset($_POST['x'])){
$x= $_POST['x'];
$y= $_POST['y'];
$op=$_POST['op'];
// 用switch 讓$op選擇改成對應到不同的公式。
// 分別有四種不同的情境，對應到四個case。
switch($op){
    case '1': $r=$x+$y;break;
    case '2': $r=$x-$y;break;
    case '3': $r=$x*$y;break;
    case '4': 
        $r1=(int)($x/$y);
        $r2=$x%$y;
        $r="{$r1}......{$r2}";
        break;
}

}
?>
<h1>Brad Big Company</h1>
<hr>
<!-- 將表單的輸入內容傳給test06.php，並使用方法get -->
 <!-- 加入name，x和y輸入的數值才會呈現在url。任何html都可以加入php -->
 <!-- method="get"時,傳送資訊的方式用url;當方法改成method="post"時，資料傳送改用body -->
  <!-- 此部分為html，單引號和雙引號不影響 -->
<form action="test07_#.php" method="post">
    <input name="x" value="<?php echo $x; ?>"/>
    <select name="op" value="<?php echo $op; ?>">
    <!-- value="1" 表示當使用者選擇這個選項時，提交表單時會將這個選項的值傳遞為 1。並且如果 $op 的值等於 '1'，則輸出 selected，將此選項標記為預選中狀態。 -->
        <option value="1" <?php echo $op=='1'? 'selected':''; ?>>+</option>
        <option value="2"<?php echo $op=='2'? 'selected':''; ?>>-</option>
        <option value="3"<?php echo $op=='3'? 'selected':''; ?>>x</option>
        <option value="4"<?php echo $op=='4'? 'selected':''; ?>>/</option>
    </select>
    <input name="y"  value="<?php echo $y; ?>"/>
   <input type="submit"  value="="/>
   <span><?php echo $r; ?></span>
</form>