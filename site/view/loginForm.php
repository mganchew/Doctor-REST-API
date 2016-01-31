<?php

?>
<script src="../js/login.js"></script>

<form name="loginForm" id="loginForm">

    <div class="form-group">
        <label for="email">Е-mail:</label>
        <input type="email" id="email" class = "form-control big-form-control" name = "email" placeholder="example@gmail.com">
    </div>

    <div class="form-group">
        <label for="password">Парола:</label>
        <input type="password" id="password" class="form-control big-form-control" name ="password" placeholder="Password">
    </div>

    <div class="form-group">
        <label for="loginInfo">Потребител:</label>
        <select class="form-control big-form-control" id="loginInfo" name="loginInfo">
            <option value="2">Доктор</option>
            <option value="1">Пациент</option>
        </select>
    </div>

    <input type="hidden" name="url" value="login">

    <div class="text-center btn-login-container">
        <button type="submit" class="btn btn-lg btn-primary" id="loginBtn" name = "loginBtn">Вход</button>
    </div>

</form>

