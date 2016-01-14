<?php

require 'header.php';
$fileName = "/dev/rfcomm0";
if (file_exists($fileName)) {
    ?>
    <script src="../js/hearthrate.js"></script>
    <div class="container text-center">
        <font color="green">
        <span class="glyphicon glyphicon-ok"></span> Nonin device connected and rdy to use!
        </font> 

        <form id="hearthrateForm">

            <h3>Моля поставете устройството.След като устройството започне да отмерва натинете бутона</h3>
            <button type="submit" id="takeHearthrate" name="takeHearthrate" value="submit">Button</button>

        </form>

    </div>
    <?php

}
?>

<?php

require 'footer.php';
?>