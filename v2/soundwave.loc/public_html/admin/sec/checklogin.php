<?php

################################################################################
# ime   : checklogin.PHP                                                             
# opis  : skripta za provjeru login podataka    
# autor : Ivan Bozajic                                                        
# datum : 02/2023                                                    
################################################################################

if ($noDetailedMessages == true) 
{
	$strUserNotExist = $strUserNotAllowed = $strPwNotFound = $strPwFalse = $strNoPassword = $strNoAccess;
}

// Check if secure.php has been loaded correctly
if ( !defined("LOADED_PROPERLY") || isset($_GET['cfgProgDir']) || isset($_POST['cfgProgDir'])) 
{
	echo "Parsing of secure logon has been halted!";
	exit();
}

// echo '<pre>', print_r($_POST) , '</pre>';
// echo '<pre>', print_r($_SESSION) , '</pre>';


// check if login is necesary
if (!isset($_POST['vis_username']) && !isset($_POST['vis_password'])) 
{
	$login       = isset($_SESSION['admin_login']) ? $_SESSION['admin_login'] : null;
	$secpassword = isset($_SESSION['admin_passwd']) ? $_SESSION['admin_passwd'] : null;	
}
else 
{
	$entered_login = trim($_POST['vis_username']);
	$entered_password = trim($_POST['vis_password']);	

	unset($_SESSION['admin_login']);
	unset($_SESSION['admin_passwd']);

	$update_login=1;
	
	// encrypt entered login & password
	$login = $entered_login;
	$secpassword = md5($entered_password."imanekatajnaveza");

	$_SESSION['admin_login'] = $login;
	$_SESSION['admin_passwd'] = $secpassword;
}

if (!isset($login) || $login == "") 
{
	// no login available
	$message = $strUserNotExist . '(E10)';
	include($cfgProgDir . "interface.php");
	exit;
}

if (!isset($secpassword) || $secpassword == "") 
{
	// no password available
	$message = $strNoPassword . '(E11)';
	include($cfgProgDir . "interface.php");
	exit;
}

	$login = mysqli_real_escape_string($db->link, $login);

	$query = "SELECT id, id_type, username, password, firstname, lastname FROM users WHERE username=? AND status='1'";

	$bind_param = array();
	$bind_param[] = array("type" => "s", "param" => $login);

	$userQuery = $db->Query($query, $bind_param);

	// check user and password
	if (mysqli_num_rows($userQuery) != 0) 
	{
		// user exist --> continue
		$userArray = mysqli_fetch_array($userQuery);
		
		if ($login != $userArray["username"]) 
		{
			// Case sensative user not present in database
			$message = $strPwFalse." (1)";
			// include($cfgProgDir . "logout.php");
			include($cfgProgDir . "interface.php");
			exit;
		}	
	}
	else 
	{
		// user not present in database
		$message = $strPwFalse." (2)";
		// include($cfgProgDir . "logout.php");
		include($cfgProgDir . "interface.php");
		exit;
	}

	if (!$userArray["password"]) 
	{
		// password not present in database for this user
		$message = $strPwNotFound  . '(E12)';
		include($cfgProgDir . "interface.php");
		exit;
	}

	if (stripslashes($userArray["password"]) != $secpassword) 
	{
		// password is wrong
		$message = $strPwFalse." (3)";
		include($cfgProgDir . "interface.php");
		exit;
	}
    
	$user_id = stripslashes($userArray["id"]);
	$user_type = $userArray["id_type"];
	$user_name = $login;
	$user_firstname = $userArray["firstname"];
	$user_lastname = $userArray["lastname"];
	$user_account = $userArray["id_type"];
	
	$_SESSION["user_id"] = $user_id;
	$_SESSION["user_type"] = $user_type;
	$_SESSION["firstname"] = $userArray["firstname"];
	$_SESSION["lastname"] = $userArray["lastname"];

	$user_id = mysqli_real_escape_string($db->link, $user_id);

	$result_last_login = $db->Query("UPDATE users SET last_login=NOW() WHERE id='".(int)$user_id."'");
?>
