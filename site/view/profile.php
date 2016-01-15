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

            <div class="caption text-center" id="userRating">
                <h3>Рейтинг:</h3>
                <p><strong><span id="rating"></span></strong></p>

                <input type="hidden" id="userId" name="userId" value="<?php echo $_SESSION['userId']; ?>" />

                <a href="#" id="vote" class="btn btn-primary">Гласувай</a>
            </div>
        </div>

        <div class="col-md-1 text-center" ></div>

        <div class="col-md-3 text-center" >
            <form method="POST" name="profileEdit" id="profileEdit">
                <div>
                    <label for="firstName">Име</label>
                </div>
                <div>
                    <input type="text" class="form-control text-center" id="fName" name="fName"<?= $editable ?>>
                </div><br>

                <div>
                    <label for="lastName">Фамилия</label>
                </div>
                <div>
                    <input type="text" class="form-control text-center" id="lName" name="lName"<?= $editable ?>>
                </div><br>
                <div>
                    <label for="email">Имейл</label>
                </div>
                <div>
                    <input type="text" class="form-control text-center" id="email" name="email"<?= $editable ?>>
                </div><br>
                <?php if ($_GET['type'] == 2) { ?>
                    <div>
                        <label for="spec">Направление</label>
                    </div>
                    <div>
                        <select class="form-control text-center" name="specId" id="specName"<?= $editable ?>>
                            <option selected disabled>Изберете направление от списъка</option>
                        </select>
                    </div><br>
                    <div>
                        <label for="workAddress">Адрес на месторабота</label>
                    </div>
                    <div>
                        <input type="text" class="form-control text-center" name="workAddress"<?= $editable ?>>
                    </div><br>
                    <input type="hidden" id="currentUserInfo" value="<?= $_SESSION['userInfo'] ?>">
                <?php } ?>
                <?php
                if ($editable == '') {
                    ?>
                    <div>
                        <label for="shortDescription">Кратко описание</label>
                    </div>
                    <div class="text-center">
                        <textarea class="form-control text-center" style="width: 362px; height: 165px;"id="userInfo" name="userInfo"<?= $editable ?>></textarea>
                    </div><br>

                    <div>
                        <button type="submit" name="submitProfile" id="submitProfile"  class="btn btn-success">Update</button>
                    </div>
                    <?php
                }
                ?>



            </form>
        </div>

        <div class="col-md-1 text-center" ></div>
        
        <div class="col-md-4 text-center" >
            <label for="googleFitData">Показатели</label>
            <table class="table table-bordered text-center" name="googleFitData" id="googleFitData">
                <thead>
                    <tr>
                        <th width="200" class="text-center">Пулс</th>
                        <th width="200" class="text-center">Кислородно насищане</th>

                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>

    </div>


</div>




<?php
require_once 'footer.php';
?>