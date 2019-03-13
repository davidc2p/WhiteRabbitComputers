<?php
// include our OAuth2 Server object
require_once __DIR__.'/server.php';

$request = OAuth2\Request::createFromGlobals();
$response = new OAuth2\Response();

// validate the authorize request
if (!$server->validateAuthorizeRequest($request, $response) && !empty($_post)) {
    $response->send();
    die;
}
// display an authorization form
// if (empty($_post)) {
//   exit('
// <form method="post">
//   **<label>username <input type="text" name="username" /></label><br />**
//   **<label>password <input type="password" name="password" /></label><br />**
//   <label>do you authorize testclient?</label><br />
//   <input type="submit" name="authorized" value="yes">
//   <input type="submit" name="authorized" value="no">
// </form>');
// }

// ** Validate User **
function mySatinizeFunction($str) {
    return $str;
}

// Clean input from attack threads
$sanitizedUsername = mySatinizeFunction($_POST['username']);
$sanitizedPassword = mySatinizeFunction($_POST['password']);

// A User credentials storage or any other custom class for validate the input pair.
//$storage = new OAuth2\Storage\Memory(array('user_credentials' => $users));
if (!$storage->checkUserCredentials($sanitizedUsername, $sanitizedPassword)) {
   exit("wrong username/password");
}
// } else {
//     $is_authorized = true;
//     $userDetails = $storage->getUserDetails($sanitizedUsername);
//     $user_id = $userDetails['user_id'];

//     $request = OAuth2\Request::createFromGlobals();
//     $response = new OAuth2\Response();

//     $verif = $server->verifyResourceRequest($request, $response);

//     if (!$verif) {
//         $server->getResponse()->send();
//         die;
//     }
    
//     $token = $server->getAccessTokenData(OAuth2\Request::createFromGlobals());
//     echo "User ID associated with this token is {$token['user_id']}";
// }

// ** Validate User (END) **

// print the authorization code if the user has authorized your client
// $is_authorized = ($_POST['authorized'] === 'yes');
$is_authorized = true;
$userDetails = $storage->getUserDetails($sanitizedUsername);
$user_id = $userDetails['user_id'];
$server->handleAuthorizeRequest($request, $response, $is_authorized, $user_id);
//$server->handleAuthorizeRequest($request, $response, $is_authorized, **$user_id**);
if ($is_authorized) {
  // this is only here so that you get to see your code in the cURL request. Otherwise, we'd redirect back to the client
  $code = substr($response->getHttpHeader('Location'), strpos($response->getHttpHeader('Location'), 'code=')+5, 40);
  exit("SUCCESS! Authorization Code: $code");
}
$response->send();
?> 