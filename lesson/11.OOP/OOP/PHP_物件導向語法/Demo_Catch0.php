<?php

$x = 3;
$y = 0;
echo "<br>test Flag 1";
$result = $x / $y; // Warning and go ahead.
echo "<br>test Flag 2";
throw new Exception("Error!!");  // Fatal error and program stop
echo "<br>test Flag 3";

?>

