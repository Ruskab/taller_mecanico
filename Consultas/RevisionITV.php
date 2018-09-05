<!DOCTYPE html>


<?php session_start(); 
include("../Funciones/sesion.php");
include("../Funciones/config.php");
include("../Funciones/bbdd_param.php");

?>

<head>
  <title>Consultar revisiones</title>
  <link rel="stylesheet" type="text/css" href="../CSS/CSS_Web.css">
  <meta charset="UTF-8">

</head>

<body>

  <div id="header">
    <h1>REVISIONES ITV PENDIENTES EN LOS PROXIMOS 3 MESES</h1>
  </div>

<div id="section">

    <?php
    $timezone = new DateTimeZone('Europe/Madrid');

    //Sacar todos los trabajos en estado Facturar tengan o no intervenciones
    $data = new DateTime('now', $timezone);
    
    $actual = new DateTime('now', $timezone);
    
    date_add($data, date_interval_create_from_date_string('3 month'));
    

    $sql = "SELECT * FROM `coche` where next_ITV  >= '".$actual->format('Y-m-d')."' AND next_ITV <='".$data->format('Y-m-d')."' ORDER BY next_ITV ASC";
    $conexio=conexion_mysqli($db_host,$db_user,$db_pass,$database);
    $lista = mysqli_query($conexio,$sql);
    /*
UPDATE `table`
SET `column` = str_to_date( `column`, '%d-%m-%Y' );
    */
?>


  <table id="tbl">
      <tr>
        <th id="tbl">CLIENTE</th>
        <th id="tbl">MATRICULA</th>
        <th id="tbl">MARCA</th>
        <th id="tbl">Siguiete ITV</th>
        <th id="tbl" >ITV pasada el</th>
      </tr>
   <?php

   while ($rec = mysqli_fetch_array($lista)){

      echo "<tr><td>".$rec['cliente']."</td>";
      echo "<td>".$rec['matricula']."</td>";
      echo "<td>".$rec['marca']."</td>";
      echo "<td>".$rec['next_ITV']."</td>";
      echo "<td>".$rec['ITV']."</td></tr>";
   ?>
  
<?php  
}
mysqli_close($conexio);
?>

</table>
  <br>
  <a id="orange" class="clas" href="CONSULTAS.php">Volver atras</a>
</div>

</body>
</html>