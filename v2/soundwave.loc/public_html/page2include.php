<?php

################################################################################
# ime   : page2include
# opis  : Skripta preko koje se uključuje razni sadržaj u centrali dio
# autor : Benjamin Babić
# datum : 18/08/2023
################################################################################

#0. dohvacanje podataka iz URL
if(isset($_GET["what"]) && $_GET["what"] != "")
{
	$what = $_GET["what"];
}
else
{
	$what = "page-home";
}

#1. stvara putanju i naziv do datoteke
$file = "".trim($what).".php";

if(file_exists($file))
{
	$page2include = $file;
}
else
{
	$page2include = "page-home.php";
}

?>
