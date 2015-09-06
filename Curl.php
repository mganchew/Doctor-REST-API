<?php
/**
 * Created by PhpStorm.
 * User: mladen
 * Date: 15-7-14
 * Time: 10:54
 */

class Curl {

    protected $uri;
    protected $url;
    protected $data;
    protected $rawData;
    protected $postData;
    protected $getMethod;

    public function __construct($uri,$data = []){

        $this->uri = $uri;
        if($data == null){
           $this->getMethod = true;
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

    public function setUrl(){

        $this->url = "127.0.0.111:8081/" . $this->uri;

    }

    public function getUrl(){

        return $this->url;

    }

    public function getResponse(){

        if(!$this->getMethod){
        $this->setPostData();
        }
        $this->setUrl();
        $credentials = base64_encode("");
        $headers = array(

            "Authorization: Basic $credentials"

        );

        $handle = curl_init();
        curl_setopt($handle, CURLOPT_URL, $this->getUrl());
        curl_setopt($handle, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, TRUE);
        if(isset($this->postData)){
        curl_setopt($handle, CURLOPT_POST, true);
        curl_setopt($handle, CURLOPT_POSTFIELDS, $this->getPostData());
        }
        curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($handle);
        curl_close($handle);
        return $response;

    }

}