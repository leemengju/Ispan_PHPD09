<?php
// 先將變數全部歸零
$x=$y=$op=$r ='';
// 問變數是否存在
if  (isset($_GET['x'])){
$x= $_GET['x'];
$y= $_GET['y'];
$op=$_GET['op'];
$c=$x+$y;
// 用switch 讓選擇改成對應到不同的公式。
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
<!-- 將表單的輸入內容傳給test06.php -->
 <!-- 加入name，x和y輸入的數值才會呈現在url -->
 <!-- method="get"時,傳送資訊的方式用url;當方法改成method="post"時，資料傳送改用body -->
  <!-- 此部分為html，單引號和雙引號不影響 -->
<form action="test07.php" method="get">
    <input name="x" value="<?php echo $x; ?>"/>
    <select name="op" value="<?php echo $op; ?>">
        <option value="1" <?php echo $op=='1'? 'selected':''; ?>>+</option>
        <option value="2"<?php echo $op=='2'? 'selected':''; ?>>-</option>
        <option value="3"<?php echo $op=='3'? 'selected':''; ?>>x</option>
        <option value="4"<?php echo $op=='4'? 'selected':''; ?>>/</option>
    </select>
    <input name="y"  value="<?php echo $y; ?>"/>
   <input type="submit"  value="="/>
   <span><?php echo $r; ?></span>
</form>