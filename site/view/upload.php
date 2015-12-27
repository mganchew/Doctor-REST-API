<?php


require '../../autoload.php';
require 'header.php';
$target_dir = __DIR__ . "/uploads/";
$target_file = $target_dir . $_FILES['uploadFile']['name'];
move_uploaded_file($_FILES['uploadFile']['tmp_name'], $target_file);

$_SESSION['file'] = $target_file;
header("Location:selectDate.php");