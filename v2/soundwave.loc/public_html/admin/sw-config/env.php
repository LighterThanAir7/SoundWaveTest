<?php

define("SITE_URL", "https://localhost/soundwave.loc/public_html/");
define("ROOT_URL", "");
define("SERVER_ROOT", realpath(__DIR__ . '/..') );

define("DB_HOST", "localhost");
define("DB_PORT", "");
define("DB_DATABASE", "scotchbox");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "root");

define("MAIL_DRIVER", "isMail");	// isMail, isSMTP
define("MAIL_HOST", "127.0.0.1");
define("MAIL_PORT", "25");			// 25, 465, 587
define("MAIL_AUTH", false);			// true, false
define("MAIL_USERNAME", "");
define("MAIL_PASSWORD", "");
define("MAIL_ENCRYPTION", ""); 		// ssl, tls
define("MAIL_DEBUG", "0");			// 0 - off, 2 - on

define("EUR_EXCHANGE_RATE", "7.53450");

?>