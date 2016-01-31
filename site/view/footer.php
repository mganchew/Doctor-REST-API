<?php
if($_SESSION['userInfo']){
    ?>

<table class="table table-bordered" name="doctorsFromSearch" id="doctorsFromSearch">
    <thead>
        <tr>
      <th width="100">Име</th>
      <th width="100">Фамилия</th>
      <th width="100">Имейл</th>
      <th width="200">Адрес на месторабота</th>
      <th width="200">Направление</th>
      <th width="100">Профил на доктор</th>
      
    </tr>
    </thead>
    <tbody></tbody>
</table>

<br><br><br><br><nav class="navbar navbar-inverse navbar-fixed-bottom">
    <div class="container">
        <p class="navbar-text">Created by Mladen Ganchev</p>
    </div>
</nav>
<?php }
?>
</body>
</html>	