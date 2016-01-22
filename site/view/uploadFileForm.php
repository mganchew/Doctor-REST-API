<?php
require 'header.php';

/*
 * This code is an adaptation of Google API URL Shortener example from Google PHP API github.
 * This was modified to work with Google Fit.
 * This example will count steps from a logged in user.
 */

// I created an Autoloader to load Google API classes
require_once('../../vendor/autoload.php');

$APIKey = 'AIzaSyALcVEmzI3X7-J8v3bp_8QKkVRQh71GtZ0';
$client_id = '319250874787-vkrl5tm6bhq2c56ae141u7jnbjea4jel.apps.googleusercontent.com';
$client_secret = 'srNQw14TnKWvt9bI3bz0m2v5';
$redirect_uri = 'http://appointment.dev/site/view/uploadFileForm.php';

//This template is nothing but some HTML. You can find it on github Google API example. 
//include_once "templates/base.php";
//Start your session.

$client = new Google_Client();
$client->setApplicationName('google-fit');
$client->setAccessType('online');
$client->setApprovalPrompt("auto");
$client->setClientId($client_id);
$client->setClientSecret($client_secret);
$client->setRedirectUri($redirect_uri);

$client->addScope([
    Google_Service_Fitness::FITNESS_ACTIVITY_READ,
    Google_Service_Fitness::FITNESS_ACTIVITY_WRITE,
    Google_Service_Fitness::FITNESS_BODY_READ,
    Google_Service_Fitness::FITNESS_BODY_WRITE,
    Google_Service_Fitness::FITNESS_LOCATION_READ,
    Google_Service_Fitness::FITNESS_LOCATION_WRITE
]);
$service = new Google_Service_Fitness($client);

/* * **********************************************
  If we're logging out we just need to clear our
  local access token in this case
 * ********************************************** */
if (isset($_REQUEST['logout'])) {
    unset($_SESSION['access_token']);
}
/* * **********************************************
  If we have a code back from the OAuth 2.0 flow,
  we need to exchange that with the authenticate()
  function. We store the resultant access token
  bundle in the session, and redirect to ourself.
 * ********************************************** */
if (isset($_GET['code'])) {
    $client->authenticate($_GET['code']);
    $_SESSION['access_token'] = $client->getAccessToken();
    $redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
    header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
    echo "EXCHANGE";
}

/* * **********************************************
  If we have an access token, we can make
  requests, else we generate an authentication URL.
 * ********************************************** */
if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
    $client->setAccessToken($_SESSION['access_token']);
    ?>
    <div class="container text-center">
        <font color="green">
        <h3>Успешно се свързахте с вашият Google Fit Профил</h3><br>
        </font>
    </div>
    <?php
    $token = json_decode($_SESSION['access_token'], true)['access_token'];
    //var_dump($token);
    ?>

    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="../js/googleAPI.js"></script>

    <?php
} else {
    $authUrl = $client->createAuthUrl();
}

/* * **********************************************
  If we're signed in and have a request to shorten
  a URL, then we create a new URL object, set the
  unshortened URL, and call the 'insert' method on
  the 'url' resource. Note that we re-store the
  access_token bundle, just in case anything
  changed during the request - the main thing that
  might happen here is the access token itself is
  refreshed if the application has offline access.
 * ********************************************** */
if ($client->getAccessToken() && isset($_GET['url'])) {
    $_SESSION['access_token'] = $client->getAccessToken();
}

//Dumb example. You don't have to use the code below.
//echo pageHeader("User Query - URL Shortener");
//if (strpos($client_id, "googleusercontent") == false) {
//    echo missingClientSecretsWarning();
//    exit;
//}
?>
<div class="container text-center">
    <div class="container">
        <?php
        if (isset($authUrl)) {
            ?>
            <a class='btn btn-primary' href='<?= $authUrl ?>'>Свързване с GoogleFit!</a>
            <?php
        } else {
            ?>
            <label for="logoutFromGoogleFit">За прекъсване на връзката натиснете бутона</label><br>
            <font color="red">
            <span class="glyphicon glyphicon-exclamation-sign"></span>
            <input type="hidden" id="accessToken" name="accessToken" value="<?= $token ?>">
            <?php var_dump($token) ?>
            Ако прекънете връзката стойностите от вашето устройсвто няма да бъдат записани.
            </font>
            <div>
                <a class='btn btn-danger' href='?logout'id="logoutFromGoogleFit">Прекъсване на връзка</a>
            </div>
            <?php
        }
        ?>
    </div>
</div>
<?php
$fileName = "/dev/rfcomm0";
if (file_exists($fileName)) {
    ?>
    <script src="../js/hearthrate.js"></script>
    <div class="container text-center">
        <font color="green">
        <span class="glyphicon glyphicon-ok"></span> Nonin device connected and rdy to use!
        </font> 

        <form id="hearthrateForm">

            <h3>Моля поставете устройството.След като устройството започне да отмерва натинете бутона</h3>

            <button type="submit" id="takeHearthrate" name="takeHearthrate" value="submit">Button</button>

        </form>

    </div>
    <?php
}
?>

<?php
require 'footer.php';
?>