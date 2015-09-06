<?php 
require_once 'header.php';
require '../../autoload.php';

$request = new Curl("specs", []);

$json = $request->getResponse();
$response = json_decode($json, true);
?>
<div class="container text-center">
<h1> Добре дошли в сайта за запазване на час при доктор!</h1>
</div>
<div class="text-center">
    <img src="1.jpg" class = "img-circle">
    <h3> Моля избере желаното от вас направление, след което натиснете бутона</h3>
</div>

<form method="POST" action="selectDate.php">
    <div class="container text-center" align="left">
        <select class="form-control" name="specId">
                <?php
                foreach ($response as $spec) {
                    ?>
                    <option value="<?= $spec['id'] ?>"><?= $spec['name'] ?></option>
                    <?php
                }
                ?>
            </select>
    </div>
    <div class="container text-center"><br>
        <input class="btn btn-lg btn-default" type="submit" name="submit" value="Следваща стъпка">
    </div>
</form>

<?php require_once 'footer.php';