<!DOCTYPE html>


<?php session_start(); 
include("../Funciones/sesion.php");
include("../Funciones/config.php");
include("../Funciones/bbdd_param.php");
?>
<html>
<head>
  <title>CONSULTAS DISPONIBLES</title>
  <link rel="stylesheet" type="text/css" href="../CSS/CSS_Web.css">
  <meta charset="UTF-8">
</head>

<body>
    <div id="header">
      <h1>CONSULTAS DISPONIBLES</h1>
    </div>
    <div id="section">
      <div id="Mbut" >
                <a id="btblB" href="RevisionITV.php">PROXIMAS Revisiones ITV</a>
                <a id="btblB" href="RevisionITV2.php">Revisiones ITV Caducadas</a>
                
      </div>
        <p>
          <a id="orange" class="clas" href="../WEB_PRINCIPAL.php">Volver al menu</a>
        </p>
    </div>
  </body>
</html>