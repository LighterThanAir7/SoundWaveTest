<?php

################################################################################
# ime   : Page2Include                                                         
# opis  : skripta preko koje se ukljucuje razni sadrzaj u centrali dio         
# autor : Ivan Bozajic                                                         
# datum : 02/2023                                                        
################################################################################

#0. dohvacanje podataka iz URL
if(isset($_GET["what"]) && $_GET["what"] != "")
{
	$what = $_GET["what"];
}
else
{
	$what = "homepage";	
}

#1. stvar putanju i naziv do datoteke
$file = "mod/".trim($what).".php";

if(file_exists($file))
{
    $page2include = $file;
}
else
{
    $page2include = "mod/default.php";
}

?>
