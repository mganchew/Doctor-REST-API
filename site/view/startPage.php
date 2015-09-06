<?php
require_once 'header.php';
?>
<body>
    <div class="container text-center">
        <h4 class="text-center ">
                 <?php
                 $color = "green";
        if (isset($_GET['msg'])){
            if($_GET['msg']== "Password mismatch!") {
                 $color = "red";
        }
            ?>
            <font color="<?=$color?>">
            <?php
            
            echo $_GET['msg'];

        }
        ?>
            </font></h4>
    </div>
    <div class ="row text-center">
        <div class ="col-xs-8 col-sm-12">
            
            <h1>Добре дошли в системата за регистрация на час при доктор!</h1>
            <h3>Моля влезте в системата или се регистрирайте!</h3><br><br>
            
        </div>
    </div>
    <div class ="row">
        <div class ="col-xs-8 col-sm-6">
            <div class="col-xs-8 col-sm-2 text-center" ></div>
            
            <div class="col-xs-8 col-sm-2"id="1">
                <?php
                require_once 'userRegForm.php';
                ?>
            </div>
            <div class="col-xs-8 col-sm-2"></div>
        </div>

        <div class ="col-xs-8 col-sm-6">
            <div class="col-xs-8 col-sm-2"></div>
            <div class="col-xs-8 col-sm-2">
                <?php
                require_once 'registrationForm.php';
                ?>
            </div>
            <div class="col-xs-8 col-sm-2"></div>
        </div>
    </div>
    <div class="container text-center"><h1>Влезте в системата</h1></div>
    <div class="container text-center">
        <div class ="col-xs-8 col-sm-4"></div>
        <div class ="col-xs-8 col-sm-2">
            <?php require_once 'loginForm.php';
            ?>
        </div>
    </div>
    <div class ="col-xs-8 col-sm-5"></div>
</body>

<?php
require_once 'footer.php';
?>