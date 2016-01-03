<script type="text/javascript" src="../js/userReg.js"></script>

<div class = "container text-center">
            <div class = "col-md-3">

                <form  method = "POST" id="userRegister">

                    <label for = "fName">Име</label>
                    <input type="text" class="form-control" name = "userfName"placeholder="First Name">



                    <label for = "lName">Фамилия</label>
                    <input type="text" class="form-control" name = "userlName"placeholder="Last Name">


                    <label for="email">e-mail адрес</label>
                    <input type="email" class = "form-control" name = "userEmail" placeholder="example@gmail.com">



                    <label for="password">Парола</label>
                    <input type="password" class="form-control" name ="userPassword" placeholder="Password">

                    
                    <label for ="cpassword">Повторете своята парола</label>
                    <input type="password" class="form-control" name = "userCPassword" placeholder="Confirm password"><br>


                    <button type="submit" id="submitUserReg" class="btn btn-primary">Register</button>

                </form>
            </div>

        </div>