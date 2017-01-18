<?php session_start();
//--------------------------------------------------------//
//Parametros configuracion bbdd
include("../Funciones/sesion.php");
include("../Funciones/config.php");
include("../Funciones/bbdd_param.php");
//--------------------------------------------------------//

$localID= $_SESSION['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
$vars = array($_POST['clt'],$_POST['mtr'] ,$_POST['mdl'] );
$length = count($vars);
for($x = 0; $x < $length; $x++) {
     $name = test_input($vars[$x]);     
     // check if name only contains letters and whitespace
     if (!preg_match('/^[a-z0-9 .\-]+$/i', $name)) {
        header('Location:FU_newFichaInterv.php?var=solo letras o numeros, sin acentos'); 
      die();
     }
  }
}
  
  //----------CUANDO HAY DATOS QUE INSERTAR ---------------//
  if(!empty($_POST)){
      $conexio=conexion_mysqli($db_host,$db_user,$db_pass,$database);

      $sql="INSERT INTO coche (cliente, matricula, marca) VALUES ('".$_POST['clt']."','".$_POST['mtr']."', '".$_POST['mdl']."')";
      mysqli_query($conexio, $sql);
      $ID=mysqli_insert_id($conexio);
      $cadena = 'SELECT NOW()';
      $llista = mysqli_query($conexio, $cadena);
      $reg = mysqli_fetch_array($llista);
      $data = $reg['0'];
      #Actualizar un usuario a la base de datos
      $sql="INSERT INTO intervencion (horaIn, estado, idCoche,idMec) VALUES ('".$data."','en curso', '".$ID."','".$localID."')";
      mysqli_query($conexio, $sql);
      mysqli_close($conexio);
      header('Location:../WEB_PRINCIPAL.php'); 
  }

?>
  
