<script type="text/javascript" src="../js/userReg.js"></script>

<form  method = "POST" id="userRegister">

    <div class="form-group">
        <label for = "fName">Име:</label>
        <input type="text" class="form-control" name = "userfName" placeholder="Име">
    </div>

    <div class="form-group">
        <label for = "lName">Фамилия:</label>
        <input type="text" class="form-control" name = "userlName" placeholder="Фамилия">
    </div>

    <div class="form-group">
        <label for="email">E-mail:</label>
        <input type="email" class = "form-control" name = "userEmail"  placeholder="example@gmail.com">
    </div>

    <div class="form-group">
        <label for="password">Парола:</label>
        <input type="password" class="form-control" name ="userPassword"  placeholder="Парола">
    </div>

    <div class="form-group">
        <label for ="cpassword">Повтори парола:</label>
        <input type="password" class="form-control" name = "userCPassword"  placeholder="Повтори парола">
    </div>

    <div class="text-center">
        <button type="submit" id="submitUserReg" class="btn btn-primary">Регистрация</button>
    </div>

</form>
