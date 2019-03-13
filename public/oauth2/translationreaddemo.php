<?php
    $data=array(
            'access_token'      => 'd9ad5399eafe9c4f5468130466a5f94573ec5cd4',//$auth['access_token'],
            'lang'              => 'en',
            'dev'               => 1,
            //'langid'	   		    => 'en',
            'page'	    		    => 'model'
    );
    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL,"http://127.0.0.1:8080/my-oauth2-walkthrough/API/V1/translation/index.php?".http_build_query($data));
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response_json = curl_exec($curl);
    curl_close($curl);
    $response=json_decode($response_json, true);

    var_dump($response);
?>