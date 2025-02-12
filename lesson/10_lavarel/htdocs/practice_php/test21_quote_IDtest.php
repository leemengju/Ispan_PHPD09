<?php
include('test18_IDtest.php');
// if (checkTWID('A130504370')) {
//     echo 'ok';
// } else {
//     echo 'xx';
// }

echo createTWIDByArea("B")."<br/>";
echo createTWIDByGender(false)."<br/>";
echo createTWIDByRandom( )."<br/>";
echo createTWIDByBoth("K",true)."<br/>";


?>
