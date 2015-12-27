<?php
require 'header.php';

?>
<div>
    <form method="post" enctype="multipart/form-data" action="upload.php">

        Моля качете вашият медицински картон <input type="file" name="uploadFile"><br>
        <button type="submit" name="submit" value="submit">Button</button>

    </form>
</div>

<?php
require 'footer.php';
?>