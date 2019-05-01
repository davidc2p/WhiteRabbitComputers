<?php
/*
 * All database connection variables
 */
if ($_SERVER['HTTP_HOST'] == 'localhost' || substr($_SERVER['HTTP_HOST'], 0, 9) == '127.0.0.1')
{
	define('DB_USER', "root"); 											// db user
	define('DB_PASSWORD', ""); 											// db password (mention your db password here)
	define('DB_DATABASE', "2207508_wrc");								// database name
	define('DB_SERVER', "127.0.0.1"); 									// db server
	//define('APPPATH', "C:\\Users\\David Domingues\\Dropbox\\www\\WhiteRabbit\\");
	define('APPPATH', "C:\\Users\\0101046\\Dropbox\\www\\WhiteRabbitComputers\\");
	define('WEBPATH', "http://127.0.0.1:8080/Vue/WhiteRabbitComputers/");
	define('APIPATH', "http://127.0.0.1:8080/Vue/WhiteRabbitComputers/public/");
	define('TIMEZONE', "Europe/Moscow");
	error_reporting(E_ALL);
} else {	
	// define('DB_USER', "EasyDeliveryDev"); 							// db user
	// define('DB_PASSWORD', "Biggui69!"); 								// db password (mention your db password here)
	// define('DB_DATABASE', "EasyDeliveryDev");						// database name
	// define('DB_SERVER', "68.178.217.9"); 							// db server
	
	define('DB_USER', "2207508_wrc"); 									// db user
	define('DB_PASSWORD', "Biggui69"); 									// db password (mention your db password here)
	define('DB_DATABASE', "2207508_wrc");								// database name
	define('DB_SERVER', "pdb10.freehostingeu.com"); 					// db server
	define('APPPATH', "/home/www/whiterabbitcomputer.com/");
	define('WEBPATH', "https://www.whiterabbitcomputers.com/");
	define('APIPATH', "https://www.whiterabbitcomputers.com/");
	define('TIMEZONE', "Europe/Lisbon");
	}
?>