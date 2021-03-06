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

        $this->url = "http://appointment.dev/REST.php/" . $this->uri;

    }

    public function getUrl(){

        return $this->url;

    }

    public function getResponse(){

        //var_dump($this->postData);
        if(!$this->getMethod || !$this->postData){
        $this->setPostData();
        }
        $this->setUrl();
        $handle = curl_init();
        curl_setopt($handle, CURLOPT_URL, $this->getUrl());
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