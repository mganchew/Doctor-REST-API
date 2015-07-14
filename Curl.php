<?php
/**
 * Created by PhpStorm.
 * User: mladen
 * Date: 15-7-14
 * Time: 10:54
 */

class Curl {

    protected $url;
    protected $data;
    protected $rawData;
    protected $postData;

    public function __construct($url,$data){

        $this->url = $url;
        if($data == null){
            throw new Exception("The provided data is empty");
        }
        $this->data = $data;

    }

    public function setPostData(){

        foreach ($this->data as $key => $val) {

            $this->rawData .= $key . "=" . $val . "&";

        }
        $this->postData = rtrim($this->rawData, "&");
    }

    public function getPostData(){

        return $this->postData;

    }

    public function getResponse(){

        $this->setPostData();
        $credentials = base64_encode("");
        $headers = array(

            "Authorization: Basic $credentials"

        );

        $handle = curl_init();
        curl_setopt($handle, CURLOPT_URL, $this->url);
        curl_setopt($handle, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($handle, CURLOPT_POST, true);
        curl_setopt($handle, CURLOPT_POSTFIELDS, $this->getPostData());
        curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($handle);
        curl_close($handle);
        return $response;

    }

}