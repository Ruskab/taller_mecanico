<?php session_start(); ?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="CSS/CSS_Web.css">
<style>


</style>
</head>
<body>

<?php 
   $localUser= $_SESSION['usr'];
   $localPerf= $_SESSION['prf'];
?>


<div id="header">
<h1>IMPORTAR DATOS</h1>
</div>

<div id="nav">
<?php
?>
</div>


<div id="section">
<?php

//Parametros configuracion bbdd
include("config.php");

  //obtenemos el archivo .csv
  $tipo = $_FILES['archivo']['type'];
  $tamanio = $_FILES['archivo']['size'];
  $archivotmp = $_FILES['archivo']['tmp_name'];
  //cargamos el archivo
  $lineas = file($archivotmp);
  //inicializamos variable a 0, esto nos ayudará a indicarle que no lea la primera línea
  $i=0;

$matriculacion="";
$distrib_KMS="";
$bastidor="";
$f_revision="";
$revision_KMS="";
$ITV="";
$next_ITV="";
$filtro_aire="";
$filtro_aceite="";
$filtro_combustible="";
$aceite_motor="";


  //Recorremos un bucle para leer línea por línea
  foreach ($lineas as $linea_num => $linea) {
//abrimos bucle
  /*si es diferente a 0 significa que no se encuentra en la primera línea (con los títulos de las columnas) y por lo tanto puede leerla*/
    if($i != 0){
    //abrimos condición, solo entrará en la condición a partir de la segunda pasada del bucle.
    //La funcion explode nos ayuda a delimitar los campos, por lo tanto irá leyendo hasta que encuentre un ;
    $datos = explode(";",$linea);
    //Almacenamos los datos que vamos leyendo en una variable
    $cliente = trim($datos[0]);
    $marca = trim($datos[1]);
    $matricula = trim($datos[2]);
    if ($_POST['tp'] == 1) {
    $matriculacion = trim($datos[3]);
    $distrib_KMS = trim($datos[4]);
    $bastidor = trim($datos[5]);
    $f_revision = trim($datos[6]);
    $revision_KMS = trim($datos[7]);
    $ITV = trim($datos[8]);
    $next_ITV = trim($datos[9]);
    $filtro_aire = trim($datos[10]);
    $filtro_aceite = trim($datos[11]);
    $filtro_combustible = trim($datos[12]);
    $aceite_motor = trim($datos[13]);
    }
//guardamos en base de datos la línea leida
  mysql_query("INSERT INTO coche(cliente,marca,matricula,matriculacion,distrib_KMS,bastidor,f_revision,revision_KMS,ITV,next_ITV,filtro_aire,filtro_aceite,filtro_combustible,aceite_motor,tipoCar) VALUES('".$cliente."','".$marca."','".$matricula."','".$matriculacion."','".$distrib_KMS."','".$bastidor."','".$f_revision."','".$revision_KMS."','".$ITV."','".$next_ITV."','".$filtro_aire."','".$filtro_aceite."','".$filtro_combustible."','".$aceite_motor."','CLA')");

  //$cadena="INSERT INTO coche(cliente,marca,matricula,matriculacion,distrib_KMS,bastidor,f_revision,revision_KMS,ITV,next_ITV,filtro_aire,filtro_aceite,filtro_combustible,aceite_motor) VALUES('".$cliente."','".$marca."','".$matricula."','".$matriculacion."','".$distrib_KMS."','".$bastidor."','".$f_revision."','".$revision_KMS."','".$ITV."','".$next_ITV."','".$filtro_aire."','".$filtro_aceite."','".$filtro_combustible."','".$aceite_motor."')";
  //echo $cadena;
  //
  //cerramos condición
  //echo $cadena;
  }
  /*Cuando pase la primera pasada se incrementará nuestro valor y a la siguiente pasada ya entraremos en la condición, de esta manera conseguimos que no lea la primera línea.*/
  $i++;
//cerramos bucle
  }
?>
   <p><a id="orange" class="clas" href="WEB_PRINCIPAL.php">Volver al menu</a></p>
  
   <?php
   ?>
   </div>
   

</body>
</html>