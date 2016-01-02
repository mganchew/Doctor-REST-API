<?php
require_once 'header.php';
$_SESSION['user'] = 'test';
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
                <h3>Short Description</h3>
                <p>...</p>
            </div>
        </div>


        <div class="col-md-6 text-center" >
            <form method="POST" name="profileEdit">
                <div>
                    <label for="firstName">First Name:</label>
                    <input type="text" name="firstName"<?= $editable ?>>
                </div><br>

                <div>
                    <label for="lastName">Last Name:</label>
                    <input type="text" name="lastName"<?= $editable ?>>
                </div><br>
                <div>
                    <label for="email">Email:</label>
                    <input type="text" name="email"<?= $editable ?>>
                </div><br>
                <div>
                    <label for="email">Email:</label>
                    <input type="text" name="email"<?= $editable ?>>
                </div><br>
                <div>
                    <label for="email">Email:</label>
                    <input type="text" name="email"<?= $editable ?>>
                </div><br>
                <div>
                    <label for="email">Email:</label>
                    <input type="text" name="email"<?= $editable ?>>
                </div><br>
                <?php
                if ($editable == '') {
                    ?>
                    <div>
                        <label for="shortDescription">Short Description:</label>
                        <textarea style="width: 286px; height: 162px;" name="shortDescription"<?= $editable ?>></textarea>
                    </div><br>
                    <?php
                }
                ?>

                <div>
                    <button type="submit" name="submit" id="submit"  class="btn btn-success">Update</button>
                </div>

            </form>
        </div>

        <div class="col-md-3 text-center" >
            
        </div>

    </div>


</div>




<?php
require_once 'footer.php';
?>