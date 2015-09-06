<?php
//site specific configuration declartion
define('BASE_PATH', 'http://localhost/kursova/index.php');
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'kursova');


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kursova";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//Google App Details
define('GOOGLE_APP_NAME', 'kursova');
define('GOOGLE_OAUTH_CLIENT_ID', '1000870633707-s8ds90qoviss2knnifra7tt8ktdc09dv.apps.googleusercontent.com');
define('GOOGLE_OAUTH_CLIENT_SECRET', 'brxqaI5VUHycmsfrDVRIExo3');
define('GOOGLE_OAUTH_REDIRECT_URI', 'http://localhost/kursova/');
define("GOOGLE_SITE_NAME", 'http://localhost/');

function __autoload($class) {
    $parts = explode('_', $class);
    $path = implode(DIRECTORY_SEPARATOR, $parts);
    require_once $path . '.php';
}
