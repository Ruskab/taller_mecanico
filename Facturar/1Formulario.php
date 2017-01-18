<!DOCTYPE html>


<?php session_start(); 
include("../Funciones/sesion.php");
include("../Funciones/config.php");
include("../Funciones/bbdd_param.php");
?>

<head>
<meta charset="UTF-8">

  <title>FACTURAR TRABAJO</title>
  <link rel="stylesheet" type="text/css" href="../CSS/CSS_Web.css">
</head>

<body>

  <div id="header">
      <h1>TRABAJO</h1>
  </div>

  <div id="section">
  <?php
  //Parametros configuracion bbdd

  $trab=$_GET['var1'];
  $horas=$_GET['var2'];
  $conexio=conexion_mysqli($db_host,$db_user,$db_pass,$database);

  #Mostrar datos de la ficha del trabajo
  $cadena="SELECT marca,comentario, cliente, estado, SEC_TO_TIME(TIMESTAMPDIFF(SECOND, horaIn, horaOUT)) TIME, matricula, nombre, horaIn, horaOUT FROM coche INNER JOIN ( intervencion INNER JOIN persona ON intervencion.idMec = persona.id) ON intervencion.idCoche = coche.idCar WHERE coche.idCar='".$_GET['var1']."'";
  $lista = mysqli_query($conexio, $cadena);
  $rec=mysqli_fetch_array($lista);
  ?>

  <div class="container" style="background-color: #A0A0A0; padding: 15px;">
      <div class="header" style="background-color: #B0B0B0" >
        <h1> <?php echo $rec['cliente']; ?> </h1>        
        <h3> <?php echo $rec['marca']." ".$horas; ?> </h3>
      </div>

  <?php 
        $sql="SELECT nevera FROM coche WHERE cliente='".$rec['cliente']."'";
        $lst=mysqli_query($conexio,$sql);
        $r=mysqli_fetch_array($lst);
        mysqli_close($conexio);
  ?>

        <form action="2Facturado.php" method="GET">
            <div style="background-color: #C0C0C0; padding: 4px;  margin: 4px;">              
                <label><b>NEVERA <?php echo "[".($r['nevera']/60)."]"." HORAS"; ?></b></label>    
                <p>usar de la nevera   
                <input name="used" value="0" type="number" step="0.25" min="0.00" max="100" maxlength="3" size="1"></p>
                <p> <?php echo "añadir a la nevera"; ?>
                <input name="new" value="0" type="number" step="0.25" min="0.00" max="100" maxlength="3" size="1"></p>
            </div>
            
            <div style="background-color: #C0C0C0; padding: 4px; margin: 4px;">  
                <p> HORAS A FACTURAR 
                <input name="fact" value="0" type="number" step="0.25" min="0.00" max="100">
                </p>    
                <input name="id" type="text" hidden value="<?php echo $_GET['var1']; ?>" />
                <input name="client" type="text" hidden value="<?php echo $rec['cliente']; ?>" />
            </div>

            <input class="btn btn-primary btn-block btn-large" type="submit" value="FACTURAR">
        </form>

  <br>
  <a id="orange" class="clas" href="../Consultas/Reparaciones.php">volver atras</a>
</div>

</body>
</html>