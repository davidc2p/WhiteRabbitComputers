<?php
    $data=array(
        //'access_token' => '9260540c38620628e562ecc78aa3262e202298ac',
        'refresh_token' => '7001aaeb271a04be19f08018fe50bd75a90b10ec',
        'grant_type'    => 'refresh_token',
        'client_id'     => '1',
        'client_secret' => 'thisismysecret'
    );
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL,"http://127.0.0.1:8080/my-oauth2-walkthrough/token.php");
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);    
    // $headers = [
    //     'Content-Type: application/json',
    //     'Cache-Control: no-store',
    //     'Pragma: no-cache'
    // ];
    
    // curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);    
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $auth_resp = curl_exec ($curl);
    // $response=json_decode($auth_resp, true);

    curl_close ($curl);
    // if (isset($response['access_token'])) {
    //     print $response['access_token'];
    // } else {
    //     print_r($response);
    // }

    print_r($auth_resp);
?>