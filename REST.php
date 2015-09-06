<?php
require 'vendor/autoload.php';
require 'autoload.php';

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
    
    case "login":
        $response = $obj->login();
        break;
    
    case "specs":
        $response = $obj->getAllSpecs();
        break;
    
    case "Registration":
        $response = $obj->Registration();
        break;
    
    case "selectDoctorsBySpec":
        $response = $obj->selectDoctorsBySpec();
        break;

    default:
        $response = json_encode("The request URL is missing");



}

echo $response;