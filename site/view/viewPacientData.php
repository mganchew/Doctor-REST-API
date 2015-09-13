<?php
require_once 'header.php';
require '../../autoload.php';
$data = $_SESSION;

$request = new Curl("checkFiles", $data);

$json = $request->getResponse();
$response = json_decode($json, true);

?>

<table border="1">
    <tr>
        <td>File</td>
    </tr>
    <?php foreach ($response as $files) { 
    $parts = explode("/", $files['file']);
    $fileName = $parts[7] . "/" . $parts[8];

        ?>
        <tr>

            <td><a href="pdfView.php?file=<?=$fileName?>"><?= $parts[8] ?></a></td>

        </tr>
        <?php
    }
    ?>

</table>