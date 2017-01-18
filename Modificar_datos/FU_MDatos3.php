<?php session_start();
include("Funciones/sesion.php");
include("Funciones/config.php");
include("Funciones/bbdd_param.php");
?>

<html>
  <head>
  <link rel="stylesheet" type="text/css" href="CSS/CSS_Web.css">
  </head>

<body>

<?php 
   $localUser= $_SESSION['usr'];
   $localPerf= $_SESSION['prf'];
   $localID=$_SESSION['id'];
?>

  <div id="header">
  </div>

  <div id="nav">
  </div>

  <div id="section">

  <?php
  //Parametros configuracion bbdd
    $conexio=conexion_mysqli($db_host,$db_user,$db_pass,$database);

    //Si se accede a la pagina sin parametros en URL
   if (!empty($_GET['type'])) {
        $sql="SELECT ".$_GET['type']." FROM coche WHERE idCar='".$_GET['var1']."'";
        $lst=mysqli_query($conexio, $sql);
        $cl=mysqli_fetch_array($lst);
  ?>
    <p>
    <form action="FU_MDatos3.php" method="POST" >
          <p>
          <label for="codi" style="font-weight: bold; font-size: 30px;"><?php echo $_GET['type'].": ".$cl[$_GET['type']]; ?></label>
          </p>
          <input name="dato" type="text" class="Datos" required="required"/>
          <input name="clm" type="text" hidden value="<?php echo $_GET['type']; ?>" />
          <input name="id" type="text" hidden value="<?php echo $_GET['var1']; ?>" /> 
          <input class="btn btn-primary btn-block btn-large" type="submit" value="MODIFICAR">
    </form>
    <p>
  <?php
      mysqli_close($conexio);
      }

    if (!empty($_POST['id'])) {
          //VALIDACION DE INPUTS
          function test_input($data) {
           $data = trim($data);
           $data = stripslashes($data);
           $data = htmlspecialchars($data);
           return $data;
        }

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

        $conexio=conexion_mysqli($db_host,$db_user,$db_pass,$database);
        $sql="UPDATE coche SET ".$_POST['clm']."='".$_POST['dato']."'WHERE idCar='".$_POST['id']."'";
        #Actualizar un usuario a la base de datos

        mysqli_query($conexio, $sql);
        mysqli_close($conexio);
        header('Location:WEB_PRINCIPAL.php'); 
    }
  ?>
      <p><a id="orange" class="clas" href="WEB_PRINCIPAL.php">Volver al menu</a></p>
  </div>
</body>
</html>