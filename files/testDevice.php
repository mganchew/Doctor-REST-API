<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$fileName = "/dev/rfcomm0";

$handle = fopen($fileName, "r");
$binarydata = fread($handle, 80);
$byteArray = unpack("C*",$binarydata);

$arrLenght = count($byteArray);

for($i = 0; $i < $arrLenght; $i++){
    
    if($byteArray[$i] != 128 && $byteArray[$i -1] == 128){
        $hearthRate[] = $byteArray[$i];
    }
    
    if($byteArray[$i] == 36){
        $spo[] = $byteArray[$i -1];
    }
    
}
echo "HearthRate collection from last use:\n";
print_r($hearthRate);

echo "SPO collection from last use:\n";
print_r($spo);
var_dump($byteArray);
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