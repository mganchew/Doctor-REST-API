<?php
require 'config.php';
$specs = array(1 => 'Ортопедия', 2 => 'Кардиология', 3 => 'Дерматология', 4 => 'Вътрешни болести', 5 => 'Гастроентерология', 6 => 'ПЕдиатрия', 7 => 'Неврология', 8 => 'Акушерство и генекология', 9 => 'Урология');


foreach ($specs as $value){
    $query = "INSERT INTO spec(name) VALUES('" . $value . "')";
    mysqli_query($conn, $query) or die(mysqli_error($conn));
}

echo "good";