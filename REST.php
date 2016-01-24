<?php
header('Access-Control-Allow-Origin: *');
require 'vendor/autoload.php';
require 'autoload.php';
$scriptNameParts = explode('/', $_SERVER['REQUEST_URI']);

$data = $_POST;

$obj = new RestModel($data);

switch ($scriptNameParts[2]) {

    case "appointment":

        $response = $obj->appointment();
        break;

    case "checkAppointments":
        $obj->setDataForAppointmentCheck($data);
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

    case "setRating":
        $obj->setDataForRating($data);
        $response = $obj->setDoctorRating();
        break;

    case "getRating":
        $obj->getDataForRating($data);
        $response = $obj->getDoctorRating();
        break;

    case "search":
        $obj->loadSearchData($data);
        $response = $obj->search();
        break;

    case "getUserRatingInfoForDoctor":
        $obj->setUserDataForRating($data);
        $response = $obj->getUserRatingInfoForDoctor();
        break;

    case "checkAndCreateResources":

        $obj->setDataForGoogleFit($data);
        $response = $obj->checkAndCreateResources();
        break;

    case "getAllDataSetsForUser":
        //$obj->setDataForGoogleFit($data);
        $response = $obj->getAllDataSetsForUser();
        break;

    case "insertDataSetInGoogleFit":
        $obj->setDataForGoogleFitInsert($data);
        $response = $obj->insertDataSetInGoogleFit();
        break;
    
    case "getAllDataSetsForUserFromDB":
        $obj->prepareDataForMeasurements;
        $response = $obj->getAllDataSetsForUserFromDB();
        break;

    default:
        $response = json_encode("The request URL is missing");

}

echo $response;