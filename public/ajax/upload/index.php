<?php
    // required headers
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    header("Content-Type: application/json; charset=UTF-8");


    $request_method=$_SERVER["REQUEST_METHOD"];

    switch($request_method)
    {
        //Testing pre-flight conditions
        case 'OPTIONS': {
                header("Access-Control-Allow-Origin: *");
                header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
                header("Access-Control-Allow-Methods: PUT, POST, GET");
                header("Content-Type: application/json; charset=UTF-8");
                return 200;
            }
        break;

        case 'POST':
            foreach($_FILES as $file => $details) {   
                // Move each file from its temp directory to $ROOT
                $temp = $details['tmp_name'];
                $target = $details['name'];
            
                if (move_uploaded_file($temp, "../../img/component/".$target)) {
                    $orderinfo->error['success'] = 0;
                    $orderinfo->error['message'] = 'Upload ok';
                } else {
                    $orderinfo->error['success'] = 1;
                    $orderinfo->error['message'] = 'Upload failed';
                }
            }

            header('Content-Type: application/json');
            print json_encode($orderinfo->error);
        break;

        default:
            // Invalid Request Method
            header("HTTP/1.0 405 Method Not Allowed");
            $orderinfo->error['success'] = 1;
            $orderinfo->error['message'] = 'Invalid transaction';
          exit;
        break;
    }
?>