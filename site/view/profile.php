<?php
require_once 'header.php';
$_SESSION['user'] = 'test';
$_SESSION['userInfo'] = "Доктор";
$editable = '';
if (!isset($_GET['editable'])) {
    $editable = "disabled";
}
?>

<div class="container">

    <div class="row">
        <div class="col-xs-6 col-md-3">
            <a href="#" class="thumbnail">
                <img src="1.jpg" alt="...">
            </a>
            <div class="caption text-center">
                <h3>Кратко описание</h3>
                <p>...</p>
            </div>
        </div>


        <div class="col-md-6 text-center" >
            <form method="POST" name="profileEdit">
                <div>
                    <label for="firstName">Име</label>
                </div>
                <div>
                    <input type="text" name="firstName"<?= $editable ?>>
                </div><br>

                <div>
                    <label for="lastName">Фамилия</label>
                </div>
                <div>
                    <input type="text" name="lastName"<?= $editable ?>>
                </div><br>
                <div>
                    <label for="email">Имейл</label>
                </div>
                <div>
                    <input type="text" name="email"<?= $editable ?>>
                </div><br>
                <?php if ($_SESSION['userInfo'] == "Доктор") { ?>
                    <div>
                        <label for="email">Направление</label>
                    </div>
                    <div>
                        <input type="text" name="email"<?= $editable ?>>
                    </div><br>
                    <div>
                        <label for="email">Адрес на месторабота</label>
                    </div>
                    <div>
                        <input type="text" name="email"<?= $editable ?>>
                    </div><br>
                <?php } ?>
                <?php
                if ($editable == '') {
                    ?>
                    <div>
                        <label for="shortDescription">Кратко описание</label>
                    </div>
                    <div>
                        <textarea style="width: 286px; height: 162px;" name="shortDescription"<?= $editable ?>></textarea>
                    </div><br>

                    <div>
                        <button type="submit" name="submit" id="submit"  class="btn btn-success">Update</button>
                    </div>
                    <?php
                }
                ?>



            </form>
        </div>

        <div class="col-md-3 text-center" >
            <h3>INFO FROM FITBIT!!!!</h3>
        </div>

    </div>


</div>




<?php
require_once 'footer.php';
?>