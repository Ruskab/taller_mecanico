<?php session_start();
include("../Funciones/sesion.php");
include("../Funciones/config.php");
include("../Funciones/bbdd_param.php");

$localID=$_SESSION['id'];

$timezone = new DateTimeZone('Europe/Madrid');

  //Si se accede a la pagina sin parametros en URL
  if(!empty($_POST['val'])){
      $idF=strtok($_POST['val'], "||");
      $conexio=conexion_mysqli($db_host,$db_user,$db_pass,$database);
      $sql = "SELECT * FROM coche  WHERE idCar=".$idF." ";
      $list = mysqli_query($conexio,$sql);

      if(mysqli_num_rows($list)==0){
        //FICHA NO ENCONTRADA 
        header('Location:nueva1.php?var=Ficha no encontrada: '.$idF.'');
        die();

      }else{
          $r=mysqli_fetch_array($list);   

          // crear un objeto de fecha/hora a partir de un string de tiempo válido
          // también podría ser un DATETIME de MySQL, p.ej: '2013-09-30 13:14:46'
 
          $data = new DateTime('now', $timezone);
 
          #Actualizar un usuario a la base de datos
          $sql="INSERT INTO intervencion (horaIn, estado, idCoche,idMec) VALUES ('".$data->format('Y-m-d H:i:s')."','en curso', '".$idF."','".$localID."')";
           mysqli_query($conexio, $sql);
           mysqli_close($conexio);
           
           header('Location:../WEB_PRINCIPAL.php'); 
      }
  }
?>
