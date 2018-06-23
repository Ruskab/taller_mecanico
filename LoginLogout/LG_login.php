
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login Page </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
   <link rel="stylesheet" href="../CSS/LG_login.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
<div class="container">
	<div class="wrapper">		
		<form class="form-signin" name="Login_Form" action = "LG_verificacion.php" method="get">
	 		<h2 class="form-signin-heading"><b>Talleres AGRIM</b></h2>
				<hr class=""><br>	 	
		  	<div class="form-group">
			    <label class="control-label" for="Username">Usuario:</label>
			    <input type="text" class="form-control" name="Username" placeholder="Usuario" required="" autofocus="" id="user">
		  	</div>
		  	<div class="form-group">
			    <label for="pwd">Contraseña:</label>
			    <input type="password" class="form-control" name="Password" placeholder="Constraseña" required="" id="pwd">
		  	</div> 
		  	<button value="Login" name="Acceder" type="submit" class="btn btn-lg btn-primary btn-block">Acceder</button>
	 	</form>
	</div>			
</div>
</body>
</html>

