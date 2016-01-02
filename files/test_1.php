<?php
var_dump($_FILES);
$target_dir = "uploads/";
if(!is_dir($target_dir)){
    mkdir('uploads',0777);
}
$target_file = $target_dir . basename($_FILES["uploadFile"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["uploadFile"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["uploadFile"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["uploadFile"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}




$target_dir = "uploads/";
      
        if (!is_dir($target_dir)) {
            mkdir('uploads', 0777);
        }
        $target_file = $target_dir . basename($this->fileContent["filename"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

        if (file_exists($target_file)) {

            $response = ['msg' => "Sorry, file already exists."];
            return json_encode($response);
        }


// Check if $uploadOk is set to 0 by an error

        if (move_uploaded_file($this->fileContent["tmp_file"], $target_file)) {
            $response = ['msg' => "The file " . basename($this->fileContent["filename"]) . " has been uploaded."];
            return json_encode($response);
        }

        return json_encode(['msg'=>'fail to upload file for some unknown reason']);