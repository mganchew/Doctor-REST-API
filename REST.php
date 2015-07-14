<?php
require 'vendor/autoload.php';
require 'RestModel.php';

$scriptNameParts = explode('/', $_SERVER['SCRIPT_NAME']);
$data = $_POST;

$obj = new RestModel($data);

switch ($scriptNameParts[1]){

    case "appointment":

        $response = $obj->appointment();
        break;

    case "checkAppointments":
        $response = $obj->checkAppointment();
        break;

    default:
        $response = json_encode("The request URL is missing");



}

echo $response;