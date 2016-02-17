<?php
session_start();
error_reporting(0);

if (!$_SESSION['user'] && $_SERVER['SCRIPT_NAME'] != "/site/view/index.php") {
    header("Location:index.php");
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

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    <!-- Custom Style  -->
    <link rel="stylesheet" type="text/css" href="../css/style.css">

</head>
<body>
<div class = "navbar navbar-inverse navbar-static-top api-top-nav">
    <div class = "container">

        <a href = "uploadFileForm.php" class = "navbar-brand logo"></a>
        <input type="hidden" id="userId" value="<?=$_SESSION['userId']?>">
        <input type="hidden" id="userInfo" value="<?=$_SESSION['userInfo']?>">

        <button class = "navbar-toggle" data-toggle = "collapse" data-target = ".navHeaderCollapse">

            <span class = "icon-bar"></span>
            <span class = "icon-bar"></span>
            <span class = "icon-bar"></span>

        </button>

        <div class = "collapse navbar-collapse navHeaderCollapse">

            <ul class = "nav navbar-nav navbar-right">

                <?php if ($_SESSION['userInfo'] == "Доктор") { ?>
                    <li><a href = "appointments.php">Начало</a></li>
                    <?php
                } else {
                    ?>
                    <li><a href = "selectDate.php"><span class="glyphicon glyphicon-home"></span>Начало</a></li>
                <?php } ?>
                <li><a href = "appointments.php"><span class="glyphicon glyphicon-time"></span>Вашите часове</a></li>
                <?php if (isset($_SESSION['user'])) { ?>
                <?php
                     if($_SESSION['userInfo'] != '2'){ ?>
                    <li>
                        <a href="profile.php?user=<?=$_SESSION['user']?>&type=<?=$_SESSION['userInfo']?>"><span class="glyphicon glyphicon-heart"></span>
                            Показатели
                        </a>
                    </li>
                     <?php } ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <span class="glyphicon glyphicon-user"></span>
                            Моят Профил<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="profile.php?user=<?=$_SESSION['user']?>&type=<?=$_SESSION['userInfo']?>">
                                    <span class="glyphicon glyphicon-user"></span>
                                    Профил
                                </a>
                            </li>

                            <li>
                                <a href="profile.php?user=<?=$_SESSION['user']?>&editable=1&type=<?=$_SESSION['userInfo']?>">
                                    <span class="glyphicon glyphicon-pencil"></span>
                                    Редакция
                                </a>
                            </li>

                            <li role="separator" class="divider"></li>
                            <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Изход</a></p></li>
                        </ul>
                    </li>

                    <div class="nav navbar-nav navbar-right">
                        <script type="text/javascript" src="../js/search.js"></script>
                        <form class="navbar-form navbar-left" role="search" id="search">
                            <div class="form-group">
                                <input type="text" id="searchField" name="searchField" class="form-control" placeholder="Търси доктор по фамилия">
                            </div>
                            <button type="submit" id="searchBtn" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span></button>
                        </form>
                    </div>

                <?php } ?>

            </ul>

        </div>

    </div>
</div>


