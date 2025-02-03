<?php
?>
<h1>Brad Big Company</h1>
<hr>
<!-- 將表單的輸入內容傳給test06.php -->
 <!-- 加入name，x和y輸入的數值才會呈現在url -->
 <!-- method="get"時,傳送資訊的方式用url;當方法改成method="post"時，資料傳送改用body -->

  
 <!-- 呼叫自己 -->
<form action="test07.php"method="get">
    <input name="x"/>
    <select name="op">
        <option value="1">+</option>
        <option value="2">-</option>
        <option value="3">x</option>
        <option value="4">/</option>
    </select>
    <input  name="y"/>
   <input type="submit" value="="/>
</form>
