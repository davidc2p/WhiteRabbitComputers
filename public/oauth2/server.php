<?php
require_once '../db/db_config.php';
$dsn      = 'mysql:dbname='.DB_DATABASE.';host='.DB_SERVER;
$username = DB_USER;
$password = DB_PASSWORD;

// error reporting (this is a demo, after all!)
ini_set('display_errors',1);error_reporting(E_ALL);

// Autoloading (composer is preferred, but for this example let's just do this)
require_once('oauth2-server-php/src/OAuth2/Autoloader.php');
OAuth2\Autoloader::register();

// $dsn is the Data Source Name for your database, for exmaple "mysql:dbname=2207508_wrc;host=127.0.0.1"
$storage = new OAuth2\Storage\Pdo(array('dsn' => $dsn, 'username' => $username, 'password' => $password));

// Pass a storage object or array of storage objects to the OAuth2 server class
$server = new OAuth2\Server($storage, array(
    'refresh_token_lifetime'         => 2419200)
);

// Add the "Client Credentials" grant type (it is the simplest of the grant types)
$server->addGrantType(new OAuth2\GrantType\ClientCredentials($storage));

// Add the "Authorization Code" grant type (this is where the oauth magic happens)
$server->addGrantType(new OAuth2\GrantType\AuthorizationCode($storage));

// Add the "UserCredentials" grant type (this is where the oauth magic happens)
$server->addGrantType(new OAuth2\GrantType\UserCredentials($storage));

// Add the "Refresh Token" grant type (this is where the oauth magic happens)
$server->addGrantType(new OAuth2\GrantType\RefreshToken($storage, array(
    'always_issue_new_refresh_token' => true
    ))
);
?>