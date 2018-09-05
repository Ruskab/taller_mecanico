<!DOCTYPE html>


<?php session_start(); 
include("../Funciones/sesion.php");
include("../Funciones/config.php");
include("../Funciones/bbdd_param.php");

?>

<head>
  <title>Consultar Trabajos por coche</title>
  <link rel="stylesheet" type="text/css" href="../CSS/CSS_Web.css">
  <meta charset="UTF-8">

</head>

<body>

  <div id="header">
    <h1>REPARACIONES SIN FACTURAR</h1>
  </div>

<div id="section">

    <?php
    //Sacar todos los trabajos en estado Facturar tengan o no intervenciones
    $sql = "SELECT COUNT( DISTINCT persona.id) AS mek, COUNT(intervencion.id) AS INTERV, cliente, matricula,idCoche, nombre, intervencion.estado, intervencion.id";
    $sql = $sql.",SEC_TO_TIME(SUM(TIME_TO_SEC(SEC_TO_TIME(TIMESTAMPDIFF(SECOND, horaIn, horaOUT))))) HORAS ";
    $sql = $sql."FROM persona INNER JOIN( intervencion INNER JOIN coche ";
    $sql = $sql."ON intervencion.idCoche = coche.idCar) ON persona.id = intervencion.idMec ";
    $sql = $sql." WHERE intervencion.estado='finalizado' GROUP BY idCoche ORDER BY idCoche ASC";
    
    $conexio=conexion_mysqli($db_host,$db_user,$db_pass,$database);
    $lista = mysqli_query($conexio,$sql);
?>

  <table id="tbl">
      <tr>
        <th id="tbl">CLIENTE</th>
        <th id="tbl">MATRICULA</th>
        <th id="tbl">MECANICOS</th>
        <th id="tbl">INTERVENCIONES</th>
        <th id="tbl" >TIEMPO</th>
        <th id="tbl">CONSULTA</th>
        <th id="tbl">FACTURACION</th>
      </tr>
   <?php

   while ($rec = mysqli_fetch_array($lista)){

      echo "<tr><td>".$rec['cliente']."</td>";
      echo "<td>".$rec['matricula']."</td>";
      echo "<td>".$rec['mek']."</td>";
      echo "<td>".$rec['INTERV']."</td>";
      echo "<td>".$rec['HORAS']."</td>";
   ?>
   <td> <a id="btbl" href="Reparaciones2.php?var1=<?php echo $rec['idCoche'];?>">Ver</a></td>
   <td> <a id="btbl" href="../Facturar/1Formulario.php?var1=<?php echo $rec['idCoche'];?>&var2=<?php echo $rec['HORAS'];?>">Facturar</a></td></tr>
<?php  
}
mysqli_close($conexio);
?>

</table>
  <br>
  <a id="btbl" href="RFacturadas.php">FACTURADOS</a>
  <a id="orange" class="clas" href="../WEB_PRINCIPAL.php">Volver al inicio</a>
</div>

</body>
</html>