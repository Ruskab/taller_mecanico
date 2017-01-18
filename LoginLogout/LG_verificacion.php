<?php 
include("../Funciones/bbdd_param.php");
include("../Funciones/config.php");

session_start();
$conexio=conexion_mysqli($db_host,$db_user,$db_pass,$database);

$nombre = $_POST['u'];
$password = $_POST['p'];

$nombre = strtolower($nombre);

//Parametros configuracion bbdd

$sql="SELECT * FROM persona WHERE nombre='";
$sql=$sql.$nombre."'";
$list = mysqli_query($conexio,$sql);
$reg = mysqli_fetch_array($list);
mysqli_close($conexio);

if (password_verify($password, $reg['password'])) {
    // Contraseña correcta
      $_SESSION['usr']= $nombre;
      $_SESSION['psw']= $password;
      $_SESSION['prf']= $reg['id_pf'];
      $_SESSION['id']=  $reg['id'];

   //Auto re-direccionado a la pagina principal
      header('Location:../WEB_PRINCIPAL.php');
  }else{
      header('Location:LG_login.php');
  }
?>
