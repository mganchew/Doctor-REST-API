<?php
require 'header.php';
$file = $_GET['file'];

?>
<div align="center">
    <embed src="<?=$file?>" width="1000px" height="2100px">
</div>
<?php
require 'footer.php';
?>