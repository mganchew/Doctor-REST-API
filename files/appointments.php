<?php 
require_once 'navbar.php';
require 'config.php';
$query = "SELECT * FROM registrations WHERE regemail = '" . $_SESSION['username'] . "' ";
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
$mail = explode("@", $_SESSION['username']);
?>

<!DOCTYPE html>
<html>
	<head>
                        <meta charset="UTF-8">
			<meta name = "viewport" content ="width = device-width , initial-scale=1.0">
			<link href = "css/bootstrap-social.css" rel = "stylesheet">
			<link href = "css/bootstrap.min.css" rel = "stylesheet">
			<link href = "css/style.css" rel = "stylesheet">
		</head>
	<body>
			
			<h1> Тук може да прегледате своите часове!</h1>
			
			<div class = "text-center">
                            <?php
                            $src = "https://www.google.com/calendar/embed?src=" . $mail[0] . "%40gmail.com&ctz=Europe/Sofia";
                            echo '<iframe src=' . $src . ' style = "border: 0" width="800" height="600" frameborder="0" scrolling="no"></iframe>';
                            ?>
			</div>
                        <br>
                        <div class="container">
                            <?php
                            while($row = mysqli_fetch_array($result)){
                            $year = $row['year'];
                            $month = $row['month'];
                            $day = $row['day'];
                            $now = time();
                            $timestamp = strtotime("$year-$month-$day");
                            if($timestamp > $now){
                                ?>
                            <p><i>На <?=$row['month']?>:<?=$row['day']?> от <?=$row['hour']?> часа имате запазен час при доктор <?=$row['doctor']?></i></p>
                            <?php
                            }
                            }
                            ?>
                        </div>
			
	</body>

</html>

