<?php
include('test37_Object-oriented-programming.php');

$myScooter = new Scooter();

echo "Speed: {$myScooter->getSpeed()}<br />";
$myScooter->upSpeed();
$myScooter->upSpeed();
$myScooter->upSpeed();
$myScooter->upSpeed();
echo  $myScooter->getSpeed() . "<br/>";
