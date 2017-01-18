<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="LG_login.css">
	</head>
<body>

<?php
//Parametros configuracion bbdd
include("../Funciones/config.php");
include("../Funciones/bbdd_param.php");

$conexio=conexion_mysqli($db_host,$db_user,$db_pass,$database);

	$sql = "SELECT nombre FROM persona order by nombre";
	$res = mysqli_query($conexio,$sql);
	$arreglo_php = array();
	if(mysqli_num_rows($res)==0)
	   array_push($arreglo_php, "No hay datos");
	else{
	  while($palabras = mysqli_fetch_array($res)){
	    array_push($arreglo_php, $palabras["nombre"]);
	  }
	}
?>


<div class="login">
	<h1>Login</h1>
    <form action = "LG_verificacion.php" method="post">
    	<input type="text" id="buscar" name="u" placeholder="Username" required="required" />
        <input type="password" name="p" placeholder="Password" required="required" />
        <button type="submit" class="btn btn-primary btn-block btn-large">Acceder.</button>
    </form>
</div>

</body>
</html>

