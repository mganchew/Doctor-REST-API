<?php
require_once 'header.php';
require '../../autoload.php';

if (!isset($_GET['long'])) {
    $_SESSION['specId'] = $_POST['specId'];
}

// (?)
$data = $_SESSION;
?>

<script type="text/javascript" src="../js/appointments.js"></script>


<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>

<script type="text/javascript" src="../js/geolocation.js"></script>


<?php
// BEGIN // GET GEOLOCATION ADDRESS

$lat = (isset($_GET['lat'])) ? $_GET['lat'] : '';
$long = (isset($_GET['long'])) ? $_GET['long'] : '';
$address = "https://maps.googleapis.com/maps/api/geocode/json?latlng=$lat,$long&key=AIzaSyAIFri_MjyZdspmiztvm_CMBLs5nBcEnT8";
$data = file_get_contents($address);
$rawData = json_decode($data, TRUE);
?>

<!-- // END // GET GEOLOCATION ADDRESS -->

<div class="container text-center">
    <h1> Добре дошли в сайта за запазване на час при доктор!</h1>
</div>


<div class="text-center">

    <img <?php
if (isset($_GET['long'])) {
    echo "";
} else {
    echo "onload=\"getLocation()\"";
}
?> src="1.jpg" class = "img-circle">

    <h3> Моля избере желаното от вас направление:</h3>

    <div class="container text-center" align="left">

        <select class="form-control text-center" name="specId" id="specName">
            <option selected disabled>Изберете направление от списъка</option>
        </select>
    </div>

</div>

<div class="text-center">

    <h3> Моля избере желаната от вас дата , час и доктор след което натиснете бутона "Запазване на час"</h3>

</div>




<?php
$months = array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');
$days = array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31');
$years = array('2015', '2016', '2017', '2018', '2019', '2020', '2021', '2022', '2023', '2024', '2025', '2026');
$hours = array('08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00');
?>

<div class = "container">
    <form id="myForm" method = "POST" action = "CalEventAdd.php">
        <div class = "text-center">
            <div class = "row">
                <div class = "col-md-2">

                    <div class="form-group">
                        <label for="sel1">Месец</label>
                        <select class="form-control" name="month">
<?php
foreach ($months as $value) {
    echo '<option value ="' . $value . '">' . $value . '</option>';
}
?>
                        </select>
                    </div>
                </div>

                <div class = "col-md-1">
                    <div class="form-group">
                        <label for="sel1">Ден</label>
                        <select class="form-control" name="day">
<?php
foreach ($days as $value) {
    echo '<option value ="' . $value . '">' . $value . '</option>';
}
?>
                        </select>
                    </div>
                </div>

                <div class = "col-md-2">
                    <div class="form-group">
                        <label for="sel1">Година</label>
                        <select class="form-control" name="year">
<?php
foreach ($years as $value) {
    echo '<option value ="' . $value . '">' . $value . '</option>';
}
?>
                        </select>
                    </div>
                </div>

                <div class = "col-md-2">
                    <div class="form-group">
                        <label for="sel1">Час</label>
                        <select class="form-control" name="hour">
<?php
foreach ($hours as $value) {
    echo '<option value ="' . $value . '">' . $value . '</option>';
}
?>
                        </select>
                    </div>
                </div>

                <div class = "col-md-2">
                    <div class="form-group">

                        <label for="sel1">Доктор</label>

                        <select class="form-control" name="doctor" id="doctorName" disabled>

                            <option selected disabled>Моля, изберете първо направление</option>

                        </select>
                    </div>
                </div>

            </div>
        </div>

        <div>
            <input type="hidden" name="address" value="<?= $rawData['results'][2]['formatted_address'] ?>">
            <input type="hidden" name="userId" value="<?= $_SESSION['userId'] ?>">
            <input type="hidden" name="file" value="<?= $_SESSION['file'] ?>">
        </div>
        
        <div class="text-center">
            <iframe id="doctorCalendar" src='' style = "border: 0" width="800" height="600" frameborder="0" scrolling="no"></iframe>
        </div>

        <div class = "text-center">
            <button type="submit" id="saveBtn" class="btn btn-lg btn-default"> <i class="fa fa-google-plus"></i>Запазване на час!</button>  
        </div>
    </form>

</div>

<?php
require 'footer.php';
