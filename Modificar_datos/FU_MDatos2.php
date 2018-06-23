<?php session_start();
include("Funciones/sesion.php");
include("Funciones/config.php");
include("Funciones/bbdd_param.php");

 $localUser= $_SESSION['usr'];
 $localPerf= $_SESSION['prf'];
 $localID=$_SESSION['id'];

  //Si se accede a la pagina sin parametros en URL
if(!empty($_POST['val'])){
    $idF=strtok($_POST['val'], "||");
    $conexio=conexion_mysqli($db_host,$db_user,$db_pass,$database);
    $sql = "SELECT * FROM coche  WHERE idCar=".$idF." ";
    $list = mysqli_query($conexio,$sql);

    if(mysqli_num_rows($list)==0){
      //FICHA NO ENCONTRADA 
      header('Location:1Seleccion.php?var=Ficha no encontrada: '.$idF.'');
      die();
    }else{
      $r=mysqli_fetch_array($list);
      $ficha=$r['idCar'];
      mysqli_close($conexio);
    }
    }else{
      header('Location:../WEB_PRINCIPAL.php'); 
}
?>
