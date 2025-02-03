
<!-- 這段程式碼的功能是讀取一個名為 dir1/ns1hosp.csv 的檔案，將其每一行內容存入陣列 $rows，並透過 foreach 迴圈依序輸出每一行的內容。 -->
<?php
$rows=file('dir1/ns1hosp.csv');
// $k：儲存當前元素的鍵（陣列的索引）。
// $v：儲存當前元素的值（檔案中對應的每一行內容）。
foreach($rows as $k =>$v){
echo"{$k}:{$v}<br/>";
}

?>