<?php

?>
<script src="../js/login.js"></script>
<div class = "container text-center">
    <div class = "col-md-3">

        <form name="loginForm" id="loginForm">

            <label for="email">e-mail адрес</label>
            <input type="email" id="email" class = "form-control" name = "email" placeholder="example@gmail.com">

            <label for="password">Парола</label>
            <input type="password" id="password" class="form-control" name ="password" placeholder="Password"><br>
            
            
            <label for="loginInfo">Вид Потребител</label>
            <select class="form-control" id="loginInfo" name="loginInfo">
                <option value="2">Доктор</option>
                <option value="1">Пациент</option>
            </select><br>
            
            <input type="hidden" name="url" value="login">
            
            <button type="submit" class="btn btn-primary" id="loginBtn" name = "loginBtn">Към началната страница!</button>
            
            
        </form>
    </div>

</div>
