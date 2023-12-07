<?php
setlocale(LC_ALL, 'hr_HR.utf8');
date_default_timezone_set('Europe/Zagreb');

if (!isset($_SESSION)) { session_start(); }

require_once 'config/env.php';
require_once 'config/functions.php';

// DB Connection
// $conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
// $conn->set_charset("utf8");


// Custom global variables
$cacheBuster = time();
?>
