<?php  session_start();
//--------------------------------------------------------//
//Parametros configuracion bbdd
include("../Funciones/sesion.php");
include("../Funciones/config.php");
include("../Funciones/bbdd_param.php");
//--------------------------------------------------------//

if ($_SERVER["REQUEST_METHOD"] == "POST") {

$vars = array($_POST['v1'],$_POST['v2'] ,$_POST['v3']);
$length = count($vars);
for($x = 0; $x < $length; $x++) {
     $name = test_input($vars[$x]);     
     // check if name only contains letters and whitespace
     if (!preg_match('/^[a-z0-9 .\-]+$/i', $name)) {
        header('Location:nueva.php?var=solo letras o numeros, sin acentos'); 
      die();
     }
  }
}

if(!empty($_POST)){
    $conexio=conexion_mysqli($db_host,$db_user,$db_pass,$database);
    $sql="INSERT INTO coche (cliente,marca,matricula,matriculacion,distrib_KMS,bastidor,f_revision,revision_KMS,ITV,next_ITV,filtro_aire,filtro_aceite,filtro_combustible,aceite_motor) VALUES ('".$_POST['v1']."','".$_POST['v2']."','".$_POST['v3']."','".$_POST['v4']."','".$_POST['v5']."','".$_POST['v6']."','".$_POST['v7']."','".$_POST['v8']."','".$_POST['v9']."','".$_POST['v10']."','".$_POST['v11']."','".$_POST['v12']."','".$_POST['v13']."','".$_POST['v14']."')";
    mysqli_query($conexio, $sql);
    mysqli_close($conexio);
    header('Location:../WEB_PRINCIPAL.php'); 
}
?>
   
