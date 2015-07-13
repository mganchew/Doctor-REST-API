<?php
function getResponse($url, $data)
{
    $rawData = "";
    if ($_POST != "") {

        foreach ($data as $key => $val) {

            $rawData .= $key . "=" . $val . "&";

        }
        $postData = rtrim($rawData, "&");
    }
    date_default_timezone_get('UTC');
    $credentials = base64_encode("");
    $headers = array(

        "Authorization: Basic $credentials"

    );

    $handle = curl_init();
    curl_setopt($handle, CURLOPT_URL, $url);
    curl_setopt($handle, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($handle, CURLOPT_POST, true);
    curl_setopt($handle, CURLOPT_POSTFIELDS, $postData);
    curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, FALSE);

    $response = curl_exec($handle);
    $code = curl_getinfo($handle, CURLINFO_HTTP_CODE);
    curl_close($handle);
    return $response;

}

$data = ["user" => "m.ganchew@gmail.com", "hour" => "10:00", "doctor" => "asdqwe@asda", "spec" => "123asd", "location" => "Plovdiv"];
$test = getResponse("127.0.0.2:8081/checkAppointments", $data);
$test1 = json_decode($test,true);
var_dump($test1);