<?php session_start(); 
include("../Funciones/sesion.php");
include("../Funciones/config.php");
include("../Funciones/bbdd_param.php");
?>

<head>
  <title>REPARACION</title>
    <link rel="stylesheet" type="text/css" href="../CSS/CSS_Web.css">
</head>
<body>

<?php 
    $conexio=conexion_mysqli($db_host,$db_user,$db_pass,$database);
    $cadena="SELECT * FROM trabajo INNER JOIN coche ON trabajo.idFicha = coche.idCar WHERE trabajo.id='".$_GET['var1']."'";
    $lista = mysqli_query($conexio, $cadena);
    $rec = mysqli_fetch_array($lista);
 ?>

<div id="header">
<h1><?php echo "[ ".$rec['cliente']." ] [ ".$rec['marca']." ] [ ".$rec['matricula']." ]"; ?></h1>
</div>
  <div id="nav">
</div>

<div id="section">
<?php
//Parametros configuracion bbdd

   $trab=$_GET['var1'];
   #añadir un usuario a la base de datos
   $cadena="SELECT title,comentario, cliente, estado, SEC_TO_TIME(TIMESTAMPDIFF(SECOND, horaIn, horaOUT)) TIME, matricula,nombre, horaIn, horaOUT FROM coche INNER JOIN( trabajo INNER JOIN ( intervencion INNER JOIN persona ON intervencion.idMec = persona.id) ON intervencion.idtr = trabajo.id) ON coche.idCar = trabajo.idFicha WHERE trabajo.id='".$_GET['var1']."' ORDER BY persona.nombre ASC";
   $lista = mysqli_query($conexio, $cadena);
   ?>
   <table id="tbl">
      <tr>
        <th id="tbl">Cliente</th>
        <th id="tbl">TITULO</th>
         <th id="tbl">matricula</th>
         <th id="tbl" >mecanico</th>
         <th id="tbl" >inicio</th>
         <th id="tbl" >finalizacion</th>
         <th id="tbl" >TIEMPO</th>
         <th id="tbl" >COMENTARIO</th>
      </tr>
   <?php
   $count=0;
   while ($rec = mysqli_fetch_array($lista)){
   echo "<tr><td>".$rec['cliente']."</td>";
    ?>
         <td>
  <?php 
              if (strlen($rec['title']) != 0) {
              $tit=substr($rec['title'],0,50); 
             //----------------------COLUMNA COMENTARIO------------------------//

?> 
              <ul class="nav1">
                  <li><a href="">TITULO</a>
                    <ul>
                      <li><a style="background-color: #4a77d4;" href=""> <?php echo $tit; ?></a></li>
                    </ul>
                  </li>
              </ul>
<?php 
              }
 ?>           
          </td>
<?php


       echo "<td>".$rec['matricula']."</td>";
       echo "<td>".$rec['nombre']."</td>";
       echo "<td>".$rec['horaIn']."</td>";
       echo "<td>".$rec['horaOUT']."</td>";
       echo "<td>".$rec['TIME']."</td>";
?>
         <td> 
<?php 
              if (strlen($rec['comentario']) != 0) {
              $cmnt=substr($rec['comentario'],0,25); 
             //----------------------COLUMNA COMENTARIO------------------------//
?>
              <ul class="nav1">
                  <li><a href=""><?php echo "COMENTARIO";?></a>
                    <ul>
                      <li><a style="background-color: #4a77d4;" href=""> <?php echo $cmnt; ?></a></li>
                    </ul>
                  </li>
              </ul>
<?php 
              }
?>
          </td></tr>
<?php       
      $count=$count+1;
}
?>
</table>
  <br>
<?php
$cadena="SELECT idMec FROM coche INNER JOIN( trabajo INNER JOIN ( intervencion INNER JOIN persona ON intervencion.idMec = persona.id) ON intervencion.idtr = trabajo.id) ON coche.idCar = trabajo.idFicha WHERE trabajo.id='".$_GET['var1']."' GROUP BY idMec";
$lista = mysqli_query($conexio, $cadena);


while ($rec = mysqli_fetch_array($lista)){
    $cadena="SELECT estado, SEC_TO_TIME(SUM(TIME_TO_SEC(SEC_TO_TIME(TIMESTAMPDIFF(SECOND, horaIn, horaOUT))))) TIME, matricula, nombre, horaIn, horaOUT FROM coche INNER JOIN( trabajo INNER JOIN ( intervencion INNER JOIN persona ON intervencion.idMec = persona.id) ON intervencion.idtr = trabajo.id) ON coche.idCar = trabajo.idFicha WHERE trabajo.id='".$_GET['var1']."' AND idMec = '".$rec['idMec']."'";
    $sql = mysqli_query($conexio, $cadena);
    $r = mysqli_fetch_array($sql);
    echo $r['nombre']." ".$r['TIME'];
    echo "<br>";
}
$cadena="SELECT estado, SEC_TO_TIME(SUM(TIME_TO_SEC(SEC_TO_TIME(TIMESTAMPDIFF(SECOND, horaIn, horaOUT))))) TIME, matricula, nombre, horaIn, horaOUT FROM coche INNER JOIN( trabajo INNER JOIN ( intervencion INNER JOIN persona ON intervencion.idMec = persona.id) ON intervencion.idtr = trabajo.id) ON coche.idCar = trabajo.idFicha WHERE trabajo.id='".$_GET['var1']."'";
    $sql = mysqli_query($conexio, $cadena);
    $r = mysqli_fetch_array($sql);
    echo "TOTAL"." ".$r['TIME'];
    echo "<br>";

mysqli_close($conexio)
?>

  <br>
  <a id="orange" class="clas" href="RFacturadas.php">volver atras</a>
</div>

</body>
</html>