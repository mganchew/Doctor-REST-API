<?php
require 'vendor/autoload.php';
require 'RestModel.php';
$scriptNameParts = explode('/', $_SERVER['SCRIPT_NAME']);
$data = $_POST;

$obj = new RestModel($data);

switch ($scriptNameParts[1]){

    case "appointment":

        $test = $obj->appointment();
        break;

    case "checkAppointments":
        $test = $obj->checkAppointment();
        break;

    case "register":

        //TODO: enter code for registration

}

echo $test;