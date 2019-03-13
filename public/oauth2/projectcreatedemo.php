<?php

    $data=array(
            'access_token'      => '0fdf2fbf58e89f01a6c92c00d2e933af20ae9bfe',//$auth['access_token'],
            'lang'              => 'en',
            'dev'               => 1,
            'customername'      => 'David le nase',
            'customeraddress'   => 'Rua de je ne sais quoi',
            'customerzip'       => '25000',
            'customercity'      => 'Besançon',
            'taxnumber'         => '123456789',
            'duepayment'        => 30
    );
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL,"http://127.0.0.1:8080/my-oauth2-walkthrough/API/V1/project/index.php");
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response_json = curl_exec($curl);
    curl_close($curl);
    $response=json_decode($response_json, true);

    var_dump($response);
?>