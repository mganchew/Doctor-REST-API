<?php

require '../../autoload.php';
require_once 'header.php';
$data = $_POST;
$request = new Curl("login", $data);
$json = $request->getResponse();
$response = json_decode($json, true);

$_SESSION['user'] = $response['user'];
$_SESSION['userId'] = $response['userId'];

header("Location:" . $response['redirectPage']);