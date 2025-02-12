<?php

$x = 3;
$y = 0;
try
{
	echo "<br>test Flag 1";
	$result = $x / $y; // Warning and go ahead.
	echo "<br>test Flag 2";
	throw new Exception("Error!!");  // Fatal error and program stop
}
catch (Exception $err)
{
	echo "<br>trap into CATCH block.";
	echo "<br>" . $err->getMessage();
}
echo "<br>test Flag 3";

?>

