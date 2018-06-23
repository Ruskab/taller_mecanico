<?php session_start();
include("../Funciones/sesion.php");
include("../Funciones/config.php");
include("../Funciones/bbdd_param.php");

   $localUser= $_SESSION['usr'];
   $localPerf= $_SESSION['prf'];
   $localID=$_SESSION['id'];

//Parametros configuracion bbdd

  //Si se accede a la pagina sin parametros en URL
 if(!empty($_POST['val'])){

      $conexio=conexion_mysqli($db_host,$db_user,$db_pass,$database);
      $sql = "UPDATE coche SET nevera = nevera + ".$_POST['nev']." WHERE cliente='".$_POST['val']."' ";
      $list = mysqli_query($conexio,$sql);
      header('Location:1Formulario.php'); 
}else{
      header('Location:../WEB_PRINCIPAL.php'); 
}
?>