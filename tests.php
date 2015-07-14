<?php
require 'Curl.php';
$data = ["user" => "m.ganchew@gmail.com", "hour" => "10:00", "doctor" => "asdqwe@asda", "spec" => "123asd", "location" => "Plovdiv"];

$request = new Curl("127.0.0.111:8081/checkAppointments",$data);
$json = $request->getResponse();
$response = json_decode($json,true);
var_dump($response);