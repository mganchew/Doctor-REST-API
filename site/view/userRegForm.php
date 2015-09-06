<div class = "container text-center">
            <div class = "col-md-3">

                <form  method = "POST" action = register.php>

                    <label for = "fName">Име</label>
                    <input type="text" class="form-control" name = "fName"placeholder="First Name">



                    <label for = "lName">Фамилия</label>
                    <input type="text" class="form-control" name = "lName"placeholder="Last Name">


                    <label for="email">e-mail адрес</label>
                    <input type="email" class = "form-control" name = "email" placeholder="example@gmail.com">



                    <label for="password">Парола</label>
                    <input type="password" class="form-control" name ="password" placeholder="Password">

                    
                    <label for ="cpassword">Повторете своята парола</label>
                    <input type="password" class="form-control" name = "cpassword" placeholder="Confirm password"><br>


                    <button type="submit" class="btn btn-primary">Register</button>

                </form>
            </div>

        </div>