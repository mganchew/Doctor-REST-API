<?php

require '../../autoload.php';
require_once 'header.php';

$_SESSION['user'] = $_POST['user'];
$_SESSION['userId'] = $_POST['userId'];
$_SESSION['userInfo'] = $_POST['userInfo'];