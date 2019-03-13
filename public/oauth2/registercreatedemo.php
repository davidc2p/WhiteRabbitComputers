<?php
    $data=array(
            'access_token'      => '8f7ec3a1c02d1550d7ddefad431c018122aa958f',//$auth['access_token'],
            'lang'              => 'en',
            'dev'               => true,
            'email'				=> 'test@gmail.com',
            'username'			=> 'David Domingues',
            'companyname'		=> 'Tesco',
            'companyaddress'	=> 'Rua de por ai',
            'companyzip'		=> 'zipcode',
            'companycity'		=> 'Valongo',
            'hidindustry'		=> 3,
            'latitude'			=> 15.275,
            'longitude'			=> 74.121245
    );
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL,"http://127.0.0.1:8080/my-oauth2-walkthrough/API/V1/register/index.php");
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response_json = curl_exec($curl);
    curl_close($curl);
    $response=json_decode($response_json, true);

    var_dump($response);
?>