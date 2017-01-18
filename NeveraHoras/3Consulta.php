<?php session_start();
include("../Funciones/sesion.php");
include("../Funciones/config.php");
include("../Funciones/bbdd_param.php");

   $localUser= $_SESSION['usr'];
   $localPerf= $_SESSION['prf'];
   $localID=$_SESSION['id'];

//Parametros configuracion bbdd

  //Si se accede a la pagina sin parametros en URL
 if(!empty($_GET['cl'])){
      $conexio=conexion_mysqli($db_host,$db_user,$db_pass,$database);
      $sql = "SELECT nevera FROM coche  WHERE cliente='".$_GET['cl']."' GROUP BY cliente";
      $list = mysqli_query($conexio,$sql);
    if ($list = mysqli_query($conexio,$sql)){
      if(mysqli_num_rows($list)==0){
        echo "No hay datos";
      }else{
        $ficha = mysqli_fetch_array($list);
        echo $ficha['nevera']." HORAS ";  
        mysqli_close($conexio);
      
      }
    }
}

?>
