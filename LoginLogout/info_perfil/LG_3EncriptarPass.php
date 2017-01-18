<?php session_start();
include("../../Funciones/sesion.php");
include("../../Funciones/config.php");
include("../../Funciones/bbdd_param.php");

    if (!empty($_POST['id'])) {
      
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $vars = array($_POST['dato']);  //<----------------------------------------------
        $length = count($vars);

        for($x = 0; $x < $length; $x++) {
             $name = test_input($vars[$x]);     
             // check if name only contains letters and whitespace
             if (!preg_match('/^[a-z0-9 .\-]+$/i', $name)) {
                echo $name." solo letras o numeros, sin acentos";
                header('Location:FU_MDatos.php'); 
                die();
             }
          }
        }

        $passwordHash = password_hash($_POST['dato'], PASSWORD_DEFAULT);
        echo $passwordHash;

       $conexio=conexion_mysqli($db_host,$db_user,$db_pass,$database);
        $string="UPDATE persona SET password='".$passwordHash."' WHERE id=".$_SESSION['id'];
        mysqli_query($conexio,$string);

        #Actualizar un usuario a la base de datos

        mysqli_close($conexio);
       header('Location:../../WEB_PRINCIPAL.php'); 
    }


?>

