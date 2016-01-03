<script type="text/javascript" src="../js/doctorReg.js"></script>

<div class = "container text-center">
    <div class = "col-md-3">
       
        <form  method = "POST" id="doctorRegister">

            <label for = "fName">Име</label>
            <input type="text" class="form-control" name = "docfName" id="docfName" placeholder="First Name">



            <label for = "lName">Фамилия</label>
            <input type="text" class="form-control" name = "doclName" id="doclName" placeholder="Last Name">



            <label for = "spec">Направление</label>
            <select class="form-control" name="specId" id="specName">
               <option selected disabled>Изберете направление от списъка</option>
            </select>

            <label for="email">e-mail адрес</label>
            <input type="email" class = "form-control" name = "docEmail" id="docEmail" placeholder="example@gmail.com">



            <label for="password">Парола</label>
            <input type="password" class="form-control" name ="docPass" id="docPass" placeholder="Password">



            <label for ="cpassword">Повторете своята парола</label>
            <input type="password" class="form-control" name = "docCPass" id="docCPass" placeholder="Confirm password"><br>


            <button type="submit" name="submitDoctorReg" id="submitDoctorReg" class="btn btn-primary">Register</button>

        </form>
    </div>

</div>