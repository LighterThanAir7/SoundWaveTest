<?php

################################################################################
# ime   : index.php
# opis  : Početna stranica Aplikacije
# autor : Benjamin Babić
# datum : 18/08/2023
################################################################################

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

session_start();
date_default_timezone_set("Europe/Zagreb");

// detekcija sto se zeli ucitati
include("page2include.php");

// Functions
require('admin/inc/Functions.php');

// instanca klase za komunikaciju sa bazom
$db = MysqlDB::getInstance();

// login provjera
//include("sec/secure.php");

include($page2include);

?>