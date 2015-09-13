<?php

require '../../autoload.php';

$data = $_POST;
$url = $data['url'];
unset($data['url']);
unset($data['submit']);

//var_dump($url);
//var_dump($data);
//$response['status'] = 'ok';
//$response['username'] = 'Mladen';
//$response['redirectPage'] = 'selectDate.php';

//if ($response['status'] == "ok") {

  //  $_SESSION['username'] = 'test';
   
  //  header("Location:" . $response['redirectPage']);
    
//}
//unset($data['url']);
$request = new Curl("login", $data);
$json = $request->getResponse();
$response = json_decode($json, true);
var_dump($response);
