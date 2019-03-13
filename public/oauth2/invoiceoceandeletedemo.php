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
            'access_token'      => '34b9f291d2fec7af95b9337b68c0d01c361280b7',//$auth['access_token'],
            'lang'              => 'en',
            'dev'               => 1,
            'companyid'         => 'bddf238a-2c29-11e7-8b6f-4c348855fb5d'
    );
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL,"http://127.0.0.1:8080/my-oauth2-walkthrough/API/V1/invoiceocean/index.php");
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response_json = curl_exec($curl);
    curl_close($curl);
    $response=json_decode($response_json, true);

    var_dump($response);
?>