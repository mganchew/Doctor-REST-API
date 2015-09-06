<?php 
session_start();
?>
<!DOCTUPE html>
<html>
		<head>
                    <meta charset="UTF-8">
			<meta name = "viewport" content ="width = device-width , initial-scale=1.0">
			<link href = "css/bootstrap.min.css" rel = "stylesheet">
		</head>
		<body>
				<div class = "navbar navbar-inverse navbar-static-top">
					<div class = "container">
					
					<a href = "home.php" class = "navbar-brand">Курсов проект</a>
					
					<button class = "navbar-toggle" data-toggle = "collapse" data-target = ".navHeaderCollapse">
					
					<span class = "icon-bar"></span>
					<span class = "icon-bar"></span>
					<span class = "icon-bar"></span>
					
					</button>
					
					<div class = "collapse navbar-collapse navHeaderCollapse">
					
							<ul class = "nav navbar-nav navbar-right">
							<li><a href = "home.php">Начало</a></li>
							<li><a href = "appointments.php">Вашите часове</a></li>
                                                        <li><a href=""><?php echo $_SESSION['username']; ?></a></li>
							<li><p class="navbar-btn pull-right"><a href="logout.php">Logout</a></p></li>
							</ul>

					</div>
					
					</div>
				</div>
		
			<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
			<script src="js/bootstrap.js"></script>
		
		</body>
	</html>