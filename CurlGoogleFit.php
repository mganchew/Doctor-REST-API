<?php

/**
 * Created by PhpStorm.
 * User: mladen
 * Date: 15-7-14
 * Time: 10:54
 */
class CurlGoogleFit
{

    protected $uri;
    protected $url;
    protected $data;
    protected $rawData;
    protected $postData;
    protected $method;


    public function setPostData($postData)
    {

        $this->postData = $postData;

    }

    public function setMethod($method)
    {

        $this->method = $method;

    }

    public function getMethod(){

        return $this->method;

    }

    public function getPostData()
    {

        return $this->postData;

    }

    public function setUrl($url)
    {

        $this->url = $url;

    }

    public function getUrl()
    {

        return $this->url;

    }

    public function getResponse()
    {

        $credentials = 'ya29.cQKywEmCtBZYNTRI3foCUVWcigxs_oYWIch7naxuKtshRAcBt4afZq4doKxic19Uk74Xlw';
        $headers = array(

            "Authorization: Bearer $credentials",
            "Content-Type: application/json;encoding=utf-8"

        );

        $handle = curl_init();
        curl_setopt($handle, CURLOPT_URL, $this->getUrl());
        curl_setopt($handle, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, TRUE);
        if (isset($this->postData)) {
            curl_setopt($handle, CURLOPT_CUSTOMREQUEST, $this->getMethod());
            curl_setopt($handle, CURLOPT_POSTFIELDS, $this->getPostData());
        }else{
            curl_setopt($handle, CURLOPT_CUSTOMREQUEST, 'GET');
        }
        curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($handle);
        curl_close($handle);
        return $response;

    }

}
//
//$response = new CurlGoogleFit();
////$response->setUrl('https://www.googleapis.com/fitness/v1/users/me/dataSources/derived:com.example.myapp.mycustomtype:319250874787:Example%20Manufacturer:ExampleTablet:1000002:hearthbeat123/datasets/1397513334728708316-1453282751243623929');
//$response->setUrl('https://www.googleapis.com/fitness/v1/users/me/dataSources/derived:com.example.myapp.mycustomtype:319250874787:Example%20Manufacturer:ExampleTablet:1000002:hearthbeat123/datasets/0-0');
//$data = '{
//        "dataSourceId": "derived:com.example.myapp.mycustomtype:319250874787:Example Manufacturer:ExampleTablet:1000002:hearthbeat123",
//        "maxEndTimeNs": 1397515179728708316,
//        "minStartTimeNs": 1397513334728708316,
//        "point": [
//            {
//                "dataTypeName": "com.example.myapp.mycustomtype",
//                "endTimeNanos": 1397513365565713993,
//                "originDataSourceId": "",
//                "startTimeNanos": 1397513334728708316,
//                "value": [
//                    {
//                        "intVal": 21
//                    }
//                ]
//            }
//        ]
//    }';
////var_dump(json_decode($data));
//$response->setPostData($data);
//$response->setMethod("PATCH");
//$response->setUrl('https://www.googleapis.com/fitness/v1/users/me/dataSources');
//$data1 = json_decode($response->getResponse());
//var_dump($data1);
////var_dump($data1->point[0]->value[0]->intVal);
////foreach ($data1 as $key => $value) {
////
////
////
////}
////var_dump(json_decode($response->getResponse(),true)['point'][0]);
////var_dump(json_decode($response->getResponse(),true));
//echo($response->getResponse());