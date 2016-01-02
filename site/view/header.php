<?php
session_start();
error_reporting(0);

if (!$_SESSION['user'] && $_SERVER['SCRIPT_NAME'] != "/site/view/startPage.php") {
    header("Location:startPage.php");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name = "viewport" content ="width = device-width , initial-scale=1.0">

        <!-- jQuery 1.11.3 lib  -->
        <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>

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

                <a href = "uploadFileForm.php" class = "navbar-brand">Курсов проект</a>
                

                <button class = "navbar-toggle" data-toggle = "collapse" data-target = ".navHeaderCollapse">

                    <span class = "icon-bar"></span>
                    <span class = "icon-bar"></span>
                    <span class = "icon-bar"></span>

                </button>

                <div class = "collapse navbar-collapse navHeaderCollapse">

                    <ul class = "nav navbar-nav navbar-right">

                        <?php if ($_SESSION['userInfo'] == "Доктор") { ?>
                            <li><a href = "viewPacientData.php">Начало</a></li>
                            <?php
                        } else {
                            ?>
                            <li><a href = "uploadFileForm.php">Начало</a></li>
                        <?php } ?>
                        <li><a href = "appointments.php">Вашите часове</a></li>
                        <?php if (isset($_SESSION['user'])) { ?>

                            <li><a href="profile.php?user=<?=$_SESSION['user']?>&type=<?=$_SESSION['userInfo']?>"><span class="glyphicon glyphicon-user"></span>
                                    <?php
                                    echo $_SESSION['user'];
                                    ?>
                                </a>
                            </li>
                            <li>
                                <a href="profile.php?user=<?=$_SESSION['user']?>&editable=1&type=<?=$_SESSION['userInfo']?>"><span class="glyphicon glyphicon-pencil"></span> Edit Profile</a>
                            </li>

                            <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></p></li>
                            <?php } ?>
                    </ul>

                </div>

            </div>
        </div>


