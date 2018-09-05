<?php session_start();
include("../Funciones/sesion.php");
include("../Funciones/config.php");
include("../Funciones/bbdd_param.php");

$timezone = new DateTimeZone('Europe/Madrid');

   $localUser= $_SESSION['usr'];
   $localPerf= $_SESSION['prf'];
   $localID=$_SESSION['id'];
 //Parametros configuracion bbdd
  
   $intr=$_GET['var1'];

  $conexio=conexion_mysqli($db_host,$db_user,$db_pass,$database);
   //DATA ACTUAL
  $data = new DateTime('now', $timezone);
 
  #Actualizar un usuario a la base de datos
  $sql="UPDATE intervencion SET horaOUT='".$data->format('Y-m-d H:i:s')."', estado='finalizado' WHERE id='".$intr."'";
  mysqli_query($conexio, $sql);
  mysqli_close($conexio);
  header('Location:../WEB_PRINCIPAL.php'); 
?>