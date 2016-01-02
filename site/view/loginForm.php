<?php

?>
<div class = "container text-center">
    <div class = "col-md-3">

        <form  method = "POST" action = login.php>

            <label for="email">e-mail адрес</label>
            <input type="email" class = "form-control" name = "email" placeholder="example@gmail.com">



            <label for="password">Парола</label>
            <input type="password" class="form-control" name ="password" placeholder="Password"><br>
            
            
            <label for="password">Парола</label>
            <select class="form-control" name="loginInfo">
                <option value="2">Доктор</option>
                <option value="1">Потребител</option>
            </select><br>
            
            
            <input type="hidden" name="url" value="login">
            
             <button type="submit" class="btn btn-primary"name = "submit">Към началната страница!</button>
            
            
        </form>
    </div>

</div>
