<?php
require_once 'header.php';
require '../../autoload.php';
$user = $_SESSION['user'];
$mail = explode('@', $user);
$data = $_SESSION;
$request = new Curl("checkAppointments", $data);
$json = $request->getResponse();
$response = json_decode($json, true);
?>

<div class="container text-center">
    <h4 class="text-center ">
        <?php
        $color = "green";
        if (isset($_GET['msg'])) {
            if ($_GET['msg'] == "Избраният от вас час е вече зает.Моля изберете нов час или различен доктор") {
                $color = "red";
            }
            ?>
            <font color="<?= $color ?>">
            <?php
            echo $_GET['msg'];
        }
        ?>
        </font></h4>
</div>

<div class="container text-center">
    <h1> Тук може да прегледате своите часове!</h1>
</div>

<div class = "text-center">
    <?php
    $src = "https://www.google.com/calendar/embed?src=" . $mail[0] . "%40gmail.com&ctz=Europe/Sofia";
    echo '<iframe id="doctorCalendar" src=' . $src . ' style = "border: 0" width="800" height="600" frameborder="0" scrolling="no"></iframe>';
    ?>
</div>
<br>
<div class="container">
    <?php
    foreach($response as $appointment){
        $date = $appointment['time'];

        $doctor = $appointment['doctor'];
        $now = time();
        $HRNow = date('d/m/y-h:i');

        if (strcmp($date,$HRNow) > 0) {
            ?>
    <p><i><font color="green"> На <?= $date ?> часа имате запазен час при доктор <?= $doctor ?></font></i></p>
            <?php
        }
    }
    ?>
</div>

<?php 
require 'footer.php'; 
?>

