<html>
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../../CSS_Web.css">
    <title></title>
  </head>

<body>

<?php session_start();
include("../../Funciones/sesion.php");
include("../../Funciones/config.php");
include("../../Funciones/bbdd_param.php");
?>

<?php 
   $localUser= $_SESSION['usr'];
   $localPerf= $_SESSION['prf'];
   $localID=$_SESSION['id'];

//Parametros configuracion bbdd
?>

<div id="header">
  <h1>MODIFICAR DATOS DEL MECANICO</h1>
</div>

<div id="section">

  <div id="Mbut" >
    
            <a id="btblB" href="LG_2Formulario.php?type=password">MODIFICAR CONTRASEÑA</a>
  </div>

  </form><p>

   <p><a id="orange" class="clas" href="../../WEB_PRINCIPAL.php">Volver al menu</a></p>

</div>

</body>
</html>