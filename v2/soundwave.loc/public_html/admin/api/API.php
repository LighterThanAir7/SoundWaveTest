<?php

################################################################################
# ime   : API Main Program
# opis  : Main program that initialize class and run constructor
# autor : Ivan Bozajic
# datum : 10/2021
################################################################################

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

session_start();

// env vars
include ("../sw-config/env.php");

require_once('../inc/Functions.php');

require_once('api.class.php');

// Requests from the same server don't have a HTTP_ORIGIN header
if (!array_key_exists('HTTP_ORIGIN', $_SERVER)) 
{
	$_SERVER['HTTP_ORIGIN'] = $_SERVER['SERVER_NAME'];
}

// Try to run API class
try 
{                           
	$API = new API($_REQUEST['request'], $_SERVER['HTTP_ORIGIN']);
} 
catch (Exception $e) 
{
	echo json_encode(Array('error' => $e->getMessage()));
}

?>