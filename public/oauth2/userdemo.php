<?php
    $data=array(
        'grant_type'    => 'client_credentials',
        //'grant_type'    => 'authorization_code',
        'client_id'     => 'bddf238a-2c29-11e7-8b6f-4c348855fb5d', // em casa '1'
        'client_secret' => 'thisismysecret'

        // 'code'          => '0f32d1293d30c85c3407b745b15930c1dc7186ef',
        // 'redirect_uri'  => 'http://127.0.0.1:8080/my-oauth2-walkthrough/error.php',
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