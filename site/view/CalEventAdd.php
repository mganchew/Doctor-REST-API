<?php
require '../../autoload.php';

$data = $_POST;

$request = new Curl("appointment", $data);
$json = $request->getResponse();

$response = json_decode($json, true);

header("Location:" . $response['redirectPage'] . "?msg=" . $response['msg']);

