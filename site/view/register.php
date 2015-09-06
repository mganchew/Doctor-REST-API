<?php

require '../../autoload.php';
$data = $_POST;

if ($data['password'] != $data['cpassword']) {

    header("Location:startPage.php?msg=Password mismatch!");
    exit();
}

$request = new Curl("Registration", $data);
$json = $request->getResponse();
$response = json_decode($json, true);

header("Location:startPage.php?msg=" . $response['msg']);
