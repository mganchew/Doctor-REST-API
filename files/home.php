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
        <?php require_once 'navbar.php';
        $specs = array(1 => 'Ортопедия', 2 => 'Кардиология', 3 => 'Дерматология', 4 => 'Вътрешни болести', 5 => 'Гастроентерология', 6 => 'Педиатрия', 7 => 'Неврология', 8 => 'Акушерство и гинекология', 9 => 'Урология');
        ?>
        <h1> Добре дошли в сайта за запазване на час при доктор!</h1>
        <div class="text-center">
            <img src="image\1.jpg" class = "img-circle">
            <h3> Моля избере желаното от вас направление, след което натиснете бутона</h3>
        </div>

        <form method="POST" action="selectDate.php">
                <div class="container text-center" align="left">
                    <?php
                    $link = mysqli_connect("localhost", "root", "", "kursova");
                    $query = "SELECT * FROM spec";
                    $result = mysqli_query($link, $query) or die(mysqli_error($link));
                    while ($row = mysqli_fetch_array($result)) {
                        ?>
                        
                    <input  type="radio" name="spec" value="<?= $row['id'] ?>"><?= $row['name'] ?>

                        <?php
                    }
                    ?>
                </div>
            <div class="container text-center"><br>
            <input class="btn btn-lg btn-default" type="submit" name="submit" value="Следваща стъпка">
            </div>
        </form>

    </body>

</html>	



