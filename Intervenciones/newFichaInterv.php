<html>
<head>
<link rel="stylesheet" type="text/css" href="../CSS/CSS_Web.css">
<meta charset="UTF-8">

</head>
<body>

<?php 
session_start(); 
include("../Funciones/sesion.php");
?>

<div id="header">
  <h1>NUEVO CLIENTE</h1>
</div>

<div id="section">

<div class="container">
  <div class="header" >
    <h1>AÑADIR DATOS DEL CLIENTE</h1>    
      <h3>rellene obligatoriamente las 3 casillas</h3>
  </div>

  <div class="body">

<?php $error=""; if (!empty($_GET['var'])) { $error=$_GET['var']; } ?> <p style="color: red;"><?php echo "$error" ?></p>

  <form action="newFichaInterv2.php" method="POST" >
        <p><input id="inLarge" name="clt" type="text" id="buscar" placeholder="cliente" required="required"/></p>
        <p><input id="inLarge" name="mtr" type="text" id="buscar" placeholder="matricula" required="required"/></p>
        <p><input id="inLarge" name="mdl" type="text" id="buscar" placeholder="modelo" required="required"/></p>
        <input class="btn btn-primary btn-block btn-large" type="submit" value="Aceptar">
  </form>

   <p><a id="orange" class="clas" href="../WEB_PRINCIPAL.php">Volver al menu</a></p>
   
      </div>
    </div>
  </div>
   
</body>
</html>