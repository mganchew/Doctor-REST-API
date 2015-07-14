<?php
require 'autoload.php';
$data = ["user" => "m.ganchew@gmail.com", "hour" => "10:00", "doctor" => "asdqwe@asda", "spec" => "123asd", "location" => "Plovdiv"];

$request = new Curl("checkAppointments",$data);
$json = $request->getResponse();
$response = json_decode($json,true);
var_dump($response);