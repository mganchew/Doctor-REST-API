<?php
require 'vendor/autoload.php';
require 'RestModel.php';
$scriptNameParts = explode('/', $_SERVER['SCRIPT_NAME']);

$obj = new RestModel();

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
$a = json_encode($test);
echo $a;