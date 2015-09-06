<?php
session_start();
require 'config.php';


$query = "SELECT * FROM registrations";
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
while($row = mysqli_fetch_array($result)){
    if($row['day']==$_POST['day'] && $row['month'] == $_POST['month'] && $row['hour']==$_POST['hour'] && $row['doctor']==$_POST['doctor'] ){
        echo "Избраният от вас час е вече зает моля изберете нов час или друг доктор!";
        echo "<a href=\"home.php\">Обратно към началната страница</a>";
        exit();
    }
        
}

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


if ($client->getAccessToken()) {

    $_SESSION['access_token'] = $client->getAccessToken();
    

    $calendar = $service->calendars->get('primary');
    $mymail = $calendar['id'];
    $query = "SELECT lName FROM users WHERE email = '" . $_POST['doctor'] . "'";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $row = mysqli_fetch_array($result);
    $query = "INSERT INTO registrations(regemail,doctor,month,day,hour,year) VALUES('" . $mymail . "', '" . $row['lName'] . "', " . $_POST['month'] . "," . $_POST['day'] . ", '" .$_POST['hour'] . "'," . $_POST['year'] . ")";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    
    echo $calendar->getSummary();
    if ($_POST) {

        $month = trim($_POST['month']);
        $day = trim($_POST['day']);
        $year = trim($_POST['year']);
        $hour = trim($_POST['hour']);
        $doctor = trim($_POST['doctor']);
        $address =$_POST['address'];


        $event = new Google_Service_Calendar_Event();
        $event->setSummary('Appointment');
        $event->setLocation($address);
        $start = new Google_Service_Calendar_EventDateTime();
        $start->setDateTime($year . '-' . $month . '-' . $day . 'T00:00:00.000-' . $hour);
        $event->setStart($start);
        $end = new Google_Service_Calendar_EventDateTime();
        $end->setDateTime($year . '-' . $month . '-' . $day . 'T00:59:00.000-' . $hour);
        //'2015-03-07T10:25:00.000-07:00'
        $event->setEnd($end);
        $attendee1 = new Google_Service_Calendar_EventAttendee();
        $attendee1->setEmail($doctor);
        // ...
        $attendees = array($attendee1,
                // ...
        );
        $event->attendees = $attendees;
        // $createdEvent = $service->events->insert('primary', $event);
        // 9v1rl81sk4u64fo2mppl05fr6c@group.calendar.google.com

        $createdEvent = $service->events->insert($mymail, $event);

        echo $createdEvent->getId();
        
    }
}
?>

<div class="box">
    <div class="request">
        <?php
        if (isset($authUrl)) {
            echo "<a class='login' href='" . $authUrl . "'>Connect Me!</a>";
        } else {
            echo ("<script>
		window.alert('Успешно запазихте желаният от вас час')
		window.location.href='appointments.php'
		</script>");
        }
        ?>

    </div>
</div>
