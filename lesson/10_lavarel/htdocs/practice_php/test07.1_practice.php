<?php
$x=$y=$op=$r="";

if (isset($_POST["x"])){
    $x=$_POST["x"];
    $y=$_POST["y"];
    $op=$_POST["op"];
}
switch ($op) {
    case '1':
        $r=$x+$y;
        break;
    case '2':
        $r=$x-$y;
        break;
    case '3':
        $r=$x*$y;
        break;
    case '4':
        $r1=(int)($x/$y);  
        $r2=$x%$y;
        $r="{$r1}......{$r2}";
        break;
    
   
}

?>
<h2>company</h2>
<hr>
<form action="test07.1_practice.php" method="post">
<input name='x'type="text" value="<?php echo $x; ?>">
<select name="op" value="<?php echo $op; ?>" >
    <option value="1"<?php echo $op=='1'? 'selected':''; ?>>+</option>
    <option value="2"<?php echo $op=='2'? 'selected':''; ?>>-</option>
    <option value="3"<?php echo $op=='3'? 'selected':''; ?>>*</option>
    <option value="4"<?php echo $op=='4'? 'selected':''; ?>>/</option>
</select>
<input name='y'type="text" value="<?php echo $y; ?>">
<input type="submit" value="=">
<span><?php echo $r; ?></span>
</form>