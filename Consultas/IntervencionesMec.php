<!DOCTYPE html>
<?php session_start();
include("../Funciones/sesion.php");
include("../Funciones/config.php");
include("../Funciones/bbdd_param.php");
?>

<head>
  <title>Consultar Intervenciones</title>
<meta charset="UTF-8">

<link rel="stylesheet" type="text/css" href="../CSS/CSS_Web.css">

    <style type="text/css">
      
      * {
        margin:0px;
        padding:0px;
      }

    </style>

</head>
<body>

<div id="header">
<h1>consultar intervenciones</h1>
</div>

<div id="section" style="overflow: auto;">
            
          <form action = "IntervencionesFecha.php" method="get">
            <label for="datetime">desde...</label>
            <input name="in" id="datetime" required="required" type="datetime-local">
            <label for="datetime">hasta...</label>
            <input name="out" id="datetime" required="required" type="datetime-local">
            <button type="submit" class="btn btn-primary btn-block btn-large">CONSULTAR</button>
            <br>
            <br>
          </form>

<?php
     $localUser= $_SESSION['usr'];
     $localPerf= $_SESSION['prf'];
     $localID= $_SESSION['id'];

    $string = "SELECT tipo,title,comentario,cliente, matricula ,marca,cliente,intervencion.id,intervencion.estado,idCoche,horaIn,horaOUT,SEC_TO_TIME(TIMESTAMPDIFF(SECOND, horaIn, horaOUT)) HORAS FROM intervencion LEFT JOIN coche ON coche.idCar = intervencion.idCoche WHERE idMec = '".$localID."' ORDER BY horaIn DESC ,intervencion.estado ASC";
    $conexio=conexion_mysqli($db_host,$db_user,$db_pass,$database);
    $lista = mysqli_query($conexio,$string);
?>
  
  <table id="tbl">
      <tr>
         <th id="tbl" >N. Trabajo</th>
         <th id="tbl" >TITULO</th>
         <th id="tbl" >cliente</th>
         <th id="tbl" >marca</th>
         <th id="tbl" >Matricula</th>
         <th id="tbl" >Iniciada en</th>
         <th id="tbl" >Acabada el</th>
         <th id="tbl">Tiempo invertido</th>
         <th id="tbl">nota</th>
         <th id="tbl">Estado</th>
         <th id="tbl">modificar Tiempo</th> 
      </tr>
   <?php

   while ($rec = mysqli_fetch_array($lista)){
      echo "<tr><td>".$rec['id']."</td>";
?>
         <td>
<?php 
              if (strlen($rec['title']) != 0) {
              $tit=substr($rec['title'],0,50); 
             //----------------------COLUMNA COMENTARIO------------------------//
?> 
              <ul class="nav1">
                  <li><a style="background-color: #4a77d4;" href="">TITULO</a>
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
if ($rec['tipo'] == 'cafe') {
      echo "<td> feina taller </td>";
}else{echo "<td>".substr($rec['cliente'],0,20)."</td>";}
      echo "<td>".$rec['marca']."</td>";
      echo "<td>".$rec['matricula']."</td>";
      echo "<td>".$rec['horaIn']."</td>";
      echo "<td>".$rec['horaOUT']."</td>";
      echo "<td>".$rec['HORAS']."</td>";
        
?>
         <td> 
<?php 
              if (strlen($rec['comentario']) != 0) {
              $cmnt=substr($rec['comentario'],0,25); 
             //----------------------COLUMNA COMENTARIO------------------------//
?>
              <ul class="nav1">
                  <li><a style="background-color: #4a77d4;" href=""><?php echo "VER";?></a>
                    <ul>
                      <li><a style="background-color: #4a77d4;" href=""> <?php echo $cmnt; ?></a></li>
                    </ul>
                  </li>
              </ul>
<?php 
              }
 ?>
          </td>
<?php
   //-----------------------------------------------------------------//

    //----------------------COLUMNA MODIFICACION------------------------// 
      echo "<td>".$rec['estado']."</td>";
 ?>          
          <td>
<?php 
           if ($rec['tipo'] != 'cafe') {
           ?>
           <ul class="nav1">
                  <li><a  href="">Modificar</a>
                    <ul>
                      <li><a href="../Intervenciones/modificar.php?var1=<?php echo $rec['id'];?>&type=1">Iniciada en...</a></li>
                      <li><a href="../Intervenciones/modificar.php?var1=<?php echo $rec['id'];?>&type=2">Acabado el...</a></li>
                      <li><a href="../Intervenciones/modificar.php?var1=<?php echo $rec['id'];?>&type=3">Comentario</a></li>
                    </ul>
                  </li>
                  </ul>
<?php 
           }
 ?>
                </td>
              </tr>
<?php  
//-----------------------------------------------------------------//
}
mysqli_close($conexio)
?>
</table>
  <br>
  <br>
  <a id="orange" class="clas" href="../WEB_PRINCIPAL.php">Volver al inicio</a>
  <br>
</div>
</body>
</html>