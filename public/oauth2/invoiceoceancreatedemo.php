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
            'access_token'      => '2d86755d9f29232e346474ba74753004a388b6f9',//$auth['access_token'],
            'lang'              => 'en',
            'dev'               => true,
            'companyid'         => 'bddf238a-2c29-11e7-8b6f-4c348855fb5d',
            'api_token'         => '03CEkXTyXwMNUukSkdhh/whiterabbitservice',
            'companyurl'        => 'whiterabbitservice'
    );
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL,"http://127.0.0.1:8080/my-oauth2-walkthrough/API/V1/invoiceocean/index.php");
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response_json = curl_exec($curl);
    curl_close($curl);
    $response=json_decode($response_json, true);

    var_dump($response);
?>