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


<div class="container-fluid medi-bg">
    <div class="container">
        <div class ="tabs-main-container">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#login" aria-controls="login" role="tab" data-toggle="tab">Вход</a></li>
                    <li role="presentation"><a href="#register-user" aria-controls="register-user" role="tab" data-toggle="tab">Регистрация за пациент</a></li>
                    <li role="presentation"><a href="#register-doctor" aria-controls="register-doctor" role="tab" data-toggle="tab">Регистрация за лекар</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <!-- LOGIN -->
                    <div role="tabpanel" class="tab-pane active" id="login">
                        <?php require_once 'loginForm.php'; ?>
                    </div>

                    <!-- REGISTRATION FOR PATIENT -->
                    <div role="tabpanel" class="tab-pane" id="register-user">
                        <?php require_once 'userRegForm.php'; ?>
                    </div>

                    <!-- REGISTRATION FOR DOCTOR -->
                    <div role="tabpanel" class="tab-pane" id="register-doctor">
                        <?php require_once 'registrationForm.php'; ?>
                    </div>

                </div>
        </div>
    </div>
</div>

<div class="container-fluid copyright">
    <div class="container text-center">
        <p class="text-center">MediSys ©</p>
        <p class="text-center">Copyright 2016 Mladen Ganchev</p>
    </div>
</div>

</body>

<?php
require_once 'footer.php';
?>