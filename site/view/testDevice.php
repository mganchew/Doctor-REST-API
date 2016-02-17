<?php

header('Access-Control-Allow-Origin: *');
require '../../autoload.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$userId = intval($_POST['userId']);

$fileName = "/dev/rfcomm0";
//if(file_exists($fileName)){
//    echo "ok\n";
//    exit();
//}  else {
//    exit('fileDoesNotExists');
//}

$handle = fopen($fileName, "r");
$binarydata = fread($handle, 500);
$byteArray = unpack("C*", $binarydata);
//var_dump($byteArray);exit();
//$byteArray = [128,90,128,92,128,95];
$arrLenght = count($byteArray);

for ($i = 0; $i < $arrLenght; $i++) {

    if ($byteArray[$i] != 128 && $byteArray[$i - 1] == 128) {
        $heartRate = $byteArray[$i];
        $data = ['heartrate' => $heartRate, 'userId' => $userId];
        $curl = new CurlGoogleFit();
        $curl->setMethod('POST');
        $curl->setPostDataForInsert($data);
        $curl->setUrl('http://appointment.dev/REST.php/insertDataSetInGoogleFit');
        $curl->removeHeaders();
        $response = $curl->getResponse();
    }
}
if (isset($heartRate)) {
    echo json_encode(['msg' => 'ok']);
}
//$heartRate = 77;
//$userId = 1;
//
//echo "<pre>";
//var_dump($response);

//echo json_encode(['msg'=>'ok']);
//$response = ['hearthrate'=>$hearthRate, 'spo'=>$spo];
//
//echo json_encode($response);

//$array = unpack('h22', $binarydata);
//$array = unpack("c17/nhex", $binarydata);
//var_dump($array);
//echo hexdec();

//var_dump(_uint32be($binarydata));

//fclose($fp);
//
////$filename = "myFile.sav";
//$handle = fopen($filename, "rb");
//$fsize = filesize($filename);
//$contents = fread($handle, 22);
//$byteArray = unpack("N*",$contents);
//print_r($byteArray);
//for($n = 0; $n < 16; $n++)
//{
//    echo $byteArray[$n].'<br/>';
//}