<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>

        <button onclick="getLocation()">Try It</button>
        <p id="demo"></p>
        <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
        <script>
           var x = document.getElementById("demo");
           function getLocation() {
               if (navigator.geolocation) {
                   navigator.geolocation.getCurrentPosition(showPosition);
                   navigator.geolocation.getCurrentPosition(redirectToPosition);
               } else {
                   x.innerHTML = "Geolocation is not supported by this browser.";
               }
           }
           /**
            * showing the position on the web browser.
            * Probably we dont need this function.
            * @param {type} position
            * @returns {undefined}
            */
           function showPosition(position) {
               x.innerHTML = "Latitude: " + position.coords.latitude +
                       "<br>Longitude: " + position.coords.longitude;
           }
           /**
            * passing the latitude and longitude via GET method so we can assing them as variables later.
            * @param {type} position
            * @returns {undefined}
            */
           function redirectToPosition(position) {
                window.location = 'testGeo.php?lat=' + position.coords.latitude + '&long=' + position.coords.longitude;
            }
        </script>
        <?php
        $lat = (isset($_GET['lat'])) ? $_GET['lat'] : '';
        $long = (isset($_GET['long'])) ? $_GET['long'] : '';
        $a[] = $lat . " - " . $long;
        file_put_contents("test.txt", $a);
        var_dump($lat);
        echo "<br>";
        echo "<pre>";
        var_dump($long);
        $address = "https://maps.googleapis.com/maps/api/geocode/json?latlng=$lat,$long&key=AIzaSyAIFri_MjyZdspmiztvm_CMBLs5nBcEnT8";
        $data = file_get_contents($address);
        $rawData = json_decode($data,TRUE);
        var_dump($rawData);
        //print_r($rawData);
        //fopen("test.txt","w+");
        //file_put_contents("test.txt", $rawData);
        //exit();
        //var_dump($address);
        ?>
    </body>
</html>