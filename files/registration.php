<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name = "viewport" content ="width = device-width , initial-scale=1.0">
        <link href = "css/bootstrap-social.css" rel = "stylesheet">
        <link href = "css/bootstrap.min.css" rel = "stylesheet">
        <link href = "css/style.css" rel = "stylesheet">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src = "js/datepicker.js"></script>
    </head>
    <body>
        <?php
        require_once 'config.php';
        if ($_POST) {
            $fName = trim($_POST['fName']);
            $lName = trim($_POST['lName']);
            $spec = trim ($_POST['spec']);
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);
            $cpassword = trim($_POST['cpassword']);
            $error = false;
            if (mb_strlen($fName) < 4) {
                echo '<p>Името е прекалено късо</p>';
                $error = true;
            }
            if (mb_strlen($lName) < 4) {
                echo '<p>Името е прекалено късо</p>';
                $error = true;
            }
            if ($password != $cpassword) {
                echo "Моля въведете една и съща парова в двете полета";
            }
            if (!$error) {
                $sql = 'INSERT INTO users(fName, 
lName,spec,email,password) VALUES ("' . $fName . '", "' . $lName . '", "' . $spec . '","' . $email . '", "' . $password . '")';
                if (mysqli_query($conn, $sql)) {
                    echo "Успешно създадохте своя акаунт";
                } else {
                    echo "e-mail adrres already in use";
                }
            }
        }
        ?>
        <a class="btn btn-lg btn-default" href="index.php">Към началната страница!</a>
    </body>

</html>	