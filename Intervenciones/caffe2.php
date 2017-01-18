<?php session_start(); 
include("../Funciones/sesion.php");
include("../Funciones/config.php");
include("../Funciones/bbdd_param.php");

$localID=$_SESSION['id'];
//Parametros configuracion bbdd

  //Si se accede a la pagina sin parametros en URL
  if(empty($_GET['t'])){
      header('Location:../WEB_PRINCIPAL.php'); 
  }else{
      $time= $_GET['t'];
      // select TIME_TO_SEC(TIME(NOW())) as hora
      $conexio=conexion_mysqli($db_host,$db_user,$db_pass,$database);

       $sql = "SELECT NOW()";
       $list = mysqli_query($conexio, $sql);
       $reg = mysqli_fetch_array($list);
       $dataInit = $reg['0'];
    
      #Actualizar un usuario a la base de datos
      $sql="INSERT INTO intervencion (horaIn,estado,idMec,tipo,title) VALUES ('".$dataInit."','en curso','".$localID."','cafe','".$_GET['t']."' )";
      mysqli_query($conexio, $sql);
      mysqli_close($conexio);      
      header('Location:../WEB_PRINCIPAL.php'); 
  }
?>