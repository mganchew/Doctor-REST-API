<?php
session_start();
if (!$_SESSION['user'] && $_SERVER['SCRIPT_NAME'] != "/startPage.php") {
    header("Location:startPage.php");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name = "viewport" content ="width = device-width , initial-scale=1.0">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    </head>
    <body>
        <div class = "navbar navbar-inverse navbar-static-top">
            <div class = "container">

                <a href = "home.php" class = "navbar-brand">Курсов проект</a>

                <button class = "navbar-toggle" data-toggle = "collapse" data-target = ".navHeaderCollapse">

                    <span class = "icon-bar"></span>
                    <span class = "icon-bar"></span>
                    <span class = "icon-bar"></span>

                </button>

                <div class = "collapse navbar-collapse navHeaderCollapse">

                    <ul class = "nav navbar-nav navbar-right">
                        <li><a href = "home.php">Начало</a></li>
                        <li><a href = "appointments.php">Вашите часове</a></li>
                        <?php if (isset($_SESSION['user'])) { ?>
                            <li><a href="">
                                    <?php
                                    echo $_SESSION['user'];
                                    ?>
                                </a></li>
                            <li><p class="navbar-btn pull-right"><a href="logout.php">Logout</a></p></li>
                            <?php } ?>
                    </ul>

                </div>

            </div>
        </div>


