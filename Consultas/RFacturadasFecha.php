<!DOCTYPE html>


<?php session_start(); 
include("../Funciones/sesion.php");
include("../Funciones/config.php");
include("../Funciones/bbdd_param.php");
?>

<head>
<meta charset="UTF-8">

  <title>Consultar Trabajos por coche</title>
  <link rel="stylesheet" type="text/css" href="../CSS/CSS_Web.css">
</head>

<body>

  <div id="header">
    <h1>REPARACIONES FACTURADAS</h1>
  </div>

<div id="section">

    <?php
      $conexio=conexion_mysqli($db_host,$db_user,$db_pass,$database);

    //Sacar todos los trabajos en estado Facturar tengan o no intervenciones
    $sql = "SELECT trabajo.id, cliente, matricula, facturado, h_facturadas, trabajo.nevera ";
    $sql = $sql."FROM trabajo LEFT JOIN( intervencion INNER JOIN coche ";
    $sql = $sql."ON intervencion.idCoche = coche.idCar) ON trabajo.id = intervencion.idtr ";
    $sql = $sql."WHERE facturado BETWEEN '".$_GET['in']."' AND '".$_GET['out']."' GROUP BY idtr ORDER BY facturado DESC";
    $lista = mysqli_query($conexio,$sql);
?>

  <table id="tbl">
      <tr>
        <th id="tbl">TRABAJO</th>
        <th id="tbl">CLIENTE</th>
        <th id="tbl">MATRICULA</th>
        <th id="tbl">FECHA FACTURA</th>
        <th id="tbl" >HORAS FACT.</th>
        <th id="tbl">NEVERA USADAS</th>
        <th id="tbl">TOTAL</th>
        
        <th id="tbl">VER</th>
      </tr>
   <?php

   while ($rec = mysqli_fetch_array($lista)){

      echo "<tr><td>".$rec['id']."</td>";
      echo "<td>".$rec['cliente']."</td>";
      echo "<td>".$rec['matricula']."</td>";
      echo "<td>".$rec['facturado']."</td>";
      echo "<td>".($rec['h_facturadas']/60)."h"."</td>";
      echo "<td>".($rec['nevera']/60)."h"."</td>";
      echo "<td>".(($rec['nevera']/60)+($rec['h_facturadas']/60))."h"."</td>";
   ?>
   <td> <a id="btbl" href="RFacturadas2.php?var1=<?php echo $rec['id'];?>">Ver</a></td></tr>
<?php  
}
mysqli_close($conexio)
?>

</table>
  <br>
  <a id="orange" class="clas" href="RFacturadas.php">Volver atras</a>
</div>

</body>
</html>