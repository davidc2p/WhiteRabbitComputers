<?php
/*
    $data=array(
        'grant_type'    => 'client_credentials',
        'client_id'     => 'testclient',
        'client_secret' => 'testpass'
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
    $auth=json_decode($auth_resp, true);
    curl_close ($curl);
*/
    $data=array(
            'access_token'      => '0fdf2fbf58e89f01a6c92c00d2e933af20ae9bfe',//$auth['access_token'],
            'lang'              => 'en',
            'dev'               => 1,
            //'customerid'        => 17,
            'pagenumber'        => 1, 
            'itemsperpage'      => 2
    );
    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL,"http://127.0.0.1:8080/my-oauth2-walkthrough/API/V1/customer/index.php?".http_build_query($data));
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response_json = curl_exec($curl);
    curl_close($curl);
    $response=json_decode($response_json, true);

    var_dump($response);
?>