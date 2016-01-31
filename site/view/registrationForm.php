<script type="text/javascript" src="../js/doctorReg.js"></script>

<form  method = "POST" id="doctorRegister">

    <div class="form-group">
        <label for = "fName">Име:</label>
        <input type="text" class="form-control" name = "docfName" id="docfName" placeholder="Име">
    </div>

    <div class="form-group">
        <label for = "lName">Фамилия:</label>
        <input type="text" class="form-control" name = "doclName" id="doclName" placeholder="Фамилия">
    </div>

    <div class="form-group">
        <label for = "spec">Направление:</label>
        <select class="form-control" name="specId" id="specName">
            <option selected disabled>Изберете направление от списъка</option>
        </select>
    </div>

    <div class="form-group">
        <label for="email">E-mail:</label>
        <input type="email" class = "form-control" name = "docEmail" id="docEmail" placeholder="example@gmail.com">
    </div>

    <div class="form-group">
        <label for="password">Парола:</label>
        <input type="password" class="form-control" name ="docPass" id="docPass" placeholder="Парола">
    </div>

    <div class="form-group">
        <label for ="cpassword">Повтори парола:</label>
        <input type="password" class="form-control" name = "docCPass" id="docCPass" placeholder="Повтори парола"><br>
    </div>

    <div class="text-center">
        <button type="submit" name="submitDoctorReg" id="submitDoctorReg" class="btn btn-primary">Регистрация</button>
    </div>

</form>
