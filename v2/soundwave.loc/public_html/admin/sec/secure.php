<?php

################################################################################
# ime   : secure.PHP                                                             
# opis  : skripta za konfiguraciju parametara za logiranje  
# autor : Ivan Bozajic                                                        
# datum : srpanj/2013                                                         
################################################################################

$cfgProgDir           = "";
$cfgIndexpage         = 'index.php';
$admEmail             = 'webmaster@web.hr';
$noDetailedMessages   = false;
$strNoAccess          = "Pristup odbijen.";
$strNoPassword        = "Lozinka nije unesena.";
$strPwFalse           = "Korisničko ime i/ili lozinka nije točna.";
$strPwNotFound        = "Lozinka nije nađena u bazi.";
$strUserNotAllowed    = "Nemate dovoljne ovlasti za pristup ovoj stranici.";
$strUserNotExist      = "Uneseni korisnik ne postoji.";


if (getenv("HTTPS") == 'on') 
{
	$cfgUrl = 'https://';
} 
else 
{
	$cfgUrl = 'http://';
}

// if ($message) $messageOld = $message;
// $message = false;

define("LOADED_PROPERLY", true);

include("checklogin.php");

// echo $_GET["logout"];

?>
