<?php



session_start();

// 1.
unset($_SESSION['lottery']);
// 2.
session_destroy();

