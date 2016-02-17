<?php
/*
 * This code is an adaptation of Google API URL Shortener example from Google PHP API github.
 * This was modified to work with Google Fit.
 * This example will count steps from a logged in user.
 */

// I created an Autoloader to load Google API classes
require_once('../vendor/autoload.php');

$APIKey = 'AIzaSyALcVEmzI3X7-J8v3bp_8QKkVRQh71GtZ0';
$client_id = '319250874787-vkrl5tm6bhq2c56ae141u7jnbjea4jel.apps.googleusercontent.com';
$client_secret = 'srNQw14TnKWvt9bI3bz0m2v5';
$redirect_uri = 'http://appointment.dev/site';

//This template is nothing but some HTML. You can find it on github Google API example. 
//include_once "templates/base.php";
//Start your session.
session_start();

$client = new Google_Client();
$client->setApplicationName('google-fit');
$client->setAccessType('online');
$client->setApprovalPrompt("auto");
$client->setClientId($client_id);
$client->setClientSecret($client_secret);
$client->setRedirectUri($redirect_uri);

$client->addScope(Google_Service_Fitness::FITNESS_ACTIVITY_READ);
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
    echo "GOT IT";
    echo "<pre>";

    // Same code as yours
    $token = json_decode($_SESSION['access_token'],true)['access_token'];
    //var_dump($token);
    ?>

<input type="hidden" id="accessToken" value="<?=$token?>">
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="js/googleAPI.js"></script>

    <?php
    $dataSources = $service->users_dataSources;
    $dataSets = $service->users_dataSources_datasets;
    $listDataSources = $dataSources->listUsersDataSources("me");
//    $timezone = "GMT+0100";
//    $today = date("Y-m-d");
//    $endTime = strtotime($today.' 00:00:00 '.$timezone);
//    $startTime = strtotime('-1 day', $endTime);
//    var_dump($listDataSources);
//    while($listDataSources->valid()) {
//        
//        $dataSourceItem = $listDataSources->next();
//        if ($dataSourceItem['dataType']['name'] == "com.google.step_count.delta") {
//            $dataStreamId = $dataSourceItem['dataStreamId'];
//            $listDatasets = $dataSets->get("me", $dataStreamId, $startTime.'000000000'.'-'.$endTime.'000000000');
//
//            $step_count = 0;
//            while($listDatasets->valid()) {
//                $dataSet = $listDatasets->next();
//                $dataSetValues = $dataSet['value'];
//
//                if ($dataSetValues && is_array($dataSetValues)) {
//                    foreach($dataSetValues as $dataSetValue) {
//                        $step_count += $dataSetValue['intVal'];
//                    }
//                }
//            }
//            
//            echo("STEP: ".$step_count."<br />");
//        };
//    }
//    echo "</pre>";
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
<div class="box">
    <div class="request">
        <?php
        if (isset($authUrl)) {
            echo "<a class='login' href='" . $authUrl . "'>Connect Me!</a>";
        } else {
            echo <<<END
    <form id="url" method="GET" action="{$_SERVER['PHP_SELF']}">
      <input name="url" class="url" type="text">
      <input type="submit" value="Shorten">
    </form>
    <a class='logout' href='?logout'>Logout</a>
END;
        }
        ?>
    </div>

    <div class="shortened">
        <?php
        if (isset($short)) {
            var_dump($short);
        }
        ?>
    </div>
</div>