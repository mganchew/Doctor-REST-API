<!DOCTYPE html>
<html>
	<head>
            <meta charset="UTF-8">
			<meta name = "viewport" content ="width = device-width , initial-scale=1.0">
			<link href = "css/bootstrap-social.css" rel = "stylesheet">
			<link href = "css/bootstrap.min.css" rel = "stylesheet">
			<link href = "css/style.css" rel = "stylesheet">
			<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
			<script src="js/bootstrap.js"></script>
			<script src = "js/datepicker.js"></script>
		</head>
	<body>
	
	<div class = "container text-center">
		<div class = "col-md-3">
		
		<form  method = "POST" action = login.php>


				

				<label for="email">e-mail адрес</label>
					<input type="email" class = "form-control" name = "email" placeholder="e-mail -> example@gmail.com">

						

				<label for="password">Парола</label>
					<input type="password" class="form-control" name ="password" placeholder="Password">

				
				<button type="submit" class="btn btn-primary"name = "submit">Към началната страница!</button>
				
			</form>
		</div>

	</div>
	
	
			
	</body>

</html>	