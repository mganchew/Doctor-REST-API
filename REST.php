<?php
header('Access-Control-Allow-Origin: *');
require 'vendor/autoload.php';
require 'autoload.php';
$scriptNameParts = explode('/', $_SERVER['REQUEST_URI']);
$data = $_POST;

$obj = new RestModel($data);

switch ($scriptNameParts[2]){

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

    case "getSpecsWithDoctors":
        $response = $obj->getSpecsWithDoctors();
        break;
    
    case "Registration":
        $obj->setDataForRegistration($data);
        $response = $obj->Registration();
        break;
    
    case "selectDoctorsBySpec":
        $response = $obj->selectDoctorsBySpec();
        break;
    
    case "checkFiles":
       
        $response = $obj->checkFiles();
        break;
    
    case "loadProfileInfo":
        $obj->setDataForProfile($data);
        $response = $obj->loadProfileInfo();
        break;
    
    case "updateProfile":
        $obj->loadUpdateInfo($data);
        $response = $obj->updateProfile();
        break;
    
    case "search":
        $obj->loadSearchData($data);
        $response = $obj->search();
        break;
    
    default:
        $response = json_encode("The request URL is missing");


}

echo $response;