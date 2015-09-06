<?php
session_start();

include_once "google-api-php-client/examples/templates/base.php";

require_once 'google-api-php-client/autoload.php';

/* * **********************************************
  ATTENTION: Fill in these values! Make sure
  the redirect URI is to this page, e.g:
  http://localhost:8080/user-example.php
 * ********************************************** */
$client_id = '1000870633707-s8ds90qoviss2knnifra7tt8ktdc09dv.apps.googleusercontent.com';
$client_secret = 'brxqaI5VUHycmsfrDVRIExo3';
$redirect_uri = 'http://localhost/kursova/';

/* * **********************************************
  Make an API request on behalf of a user. In
  this case we need to have a valid OAuth 2.0
  token for the user, so we need to send them
  through a login flow. To do this we need some
  information from our API console project.
 * ********************************************** */
$client = new Google_Client();
$client->setClientId($client_id);
$client->setClientSecret($client_secret);
$client->setRedirectUri($redirect_uri);
$client->addScope("https://www.googleapis.com/auth/calendar");

/* * **********************************************
  We are going to create Calendar
  service, and query both.
 * ********************************************** */
$service = new Google_Service_Calendar($client);

/* * **********************************************
  Boilerplate auth management - see
  user-example.php for details.
 * ********************************************** */

if (isset($_REQUEST['logout'])) {
    unset($_SESSION['access_token']);
}
if (isset($_GET['code'])) {
    $client->authenticate($_GET['code']);
    $_SESSION['access_token'] = $client->getAccessToken();
    $redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
    header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
}

if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
    $client->setAccessToken($_SESSION['access_token']);
} else {
    $authUrl = $client->createAuthUrl();
}

/* * **********************************************
  If we're signed in, retrieve channels from YouTube
  and a list of files from Drive.
 * ********************************************** */
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name = "viewport" content ="width = device-width , initial-scale=1.0">
        <link href = "css/bootstrap-social.css" rel = "stylesheet">
        <link href = "css/bootstrap.min.css" rel = "stylesheet">
        <link href = "css/style.css" rel = "stylesheet">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src = "js/datepicker.js"></script>

    </head>

    <body>
        <div class ="row text-center">
            <div class ="col-xs-8 col-sm-12">
            <h1>Добре дошли в системата за регистрация на час при доктор!</h1>
            <h3>Моля влезте в системата ,регистрираите се</h3>
            </div>
        </div>
        <div class ="row">
            <div class ="col-xs-8 col-sm-6">
                <?php
                require_once 'loginForm.php';
                ?>
            </div>

            <div class ="col-xs-8 col-sm-6">
                <?php
                require_once 'test.php';
                ?>
            </div>

        </div>
        <div class ="row text-center">
            <div class ="col-xs-8 col-sm-12">
            <h3>или влезте с вашият Google акаунт тук!</h3>
            <img src="image\3.png">
            <div class="box">
                <div class="request">

                    <?php
                    
                    
                    if (isset($authUrl)) {
                        echo "<a class='btn btn-lg btn-primary' href='" . $authUrl . "'>Connect Me!</a>";
                    } else {
                        $calendar = $service->calendars->get('primary');
                        $mymail = $calendar['id'];
                        $_SESSION['username'] = $mymail;
                        echo ("<script>
		window.alert('Успешно влезнахте в системата')
		window.location.href='home.php'
		</script>");
                    }
                    ?>

                </div>
            </div>
            </div>
        </div>
    </body>
</html>
