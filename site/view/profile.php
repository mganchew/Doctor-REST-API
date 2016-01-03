<?php
require_once 'header.php';
$editable = '';
if (!isset($_GET['editable'])) {
    $editable = "disabled";
}
?>
<script type="text/javascript" src="../js/profile.js"></script>
<?php if ($_GET['msg']) { ?>
    <div class="container text-center">
        <h4 class="text-center ">
            <?php
            $color = "green";
            ?>
            <font color="<?= $color ?>">
            <?php
            echo $_GET['msg'];
            ?>
            </font></h4>
    </div> 
<?php } ?>


<div class="container">

    <div class="row">
        <div class="col-xs-6 col-md-3">
            <a href="#" class="thumbnail">
                <img src="1.jpg" alt="...">
            </a>
            <div class="caption text-center" id="userInfo">
                <h3>Кратко описание</h3>
                <p></p>
            </div>
        </div>


        <div class="col-md-6 text-center" >
            <form method="POST" name="profileEdit" id="profileEdit">
                <div>
                    <label for="firstName">Име</label>
                </div>
                <div>
                    <input type="text" id="fName" name="fName"<?= $editable ?>>
                </div><br>

                <div>
                    <label for="lastName">Фамилия</label>
                </div>
                <div>
                    <input type="text" id="lName" name="lName"<?= $editable ?>>
                </div><br>
                <div>
                    <label for="email">Имейл</label>
                </div>
                <div>
                    <input type="text" id="email" name="email"<?= $editable ?>>
                </div><br>
                <?php if ($_GET['type'] == 2) { ?>
                    <div>
                        <label for="spec">Направление</label>
                    </div>
                    <div>
                        <select class="form-control" name="specId" id="specName"<?= $editable ?>>
                            <option selected disabled>Изберете направление от списъка</option>
                        </select>
                    </div><br>
                    <div>
                        <label for="workAddress">Адрес на месторабота</label>
                    </div>
                    <div>
                        <input type="text" name="workAddress"<?= $editable ?>>
                    </div><br>
                <?php } ?>
                <?php
                if ($editable == '') {
                    ?>
                    <div>
                        <label for="shortDescription">Кратко описание</label>
                    </div>
                    <div>
                        <textarea style="width: 286px; height: 162px;"id="userInfo" name="userInfo"<?= $editable ?>></textarea>
                    </div><br>

                    <div>
                        <button type="submit" name="submitProfile" id="submitProfile"  class="btn btn-success">Update</button>
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