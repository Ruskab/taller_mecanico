<?php session_start();
include("../../Funciones/sesion.php");
include("../../Funciones/config.php");
include("../../Funciones/bbdd_param.php");
?>

<html>
  <head>
  <link rel="stylesheet" type="text/css" href="../../CSS_Web.css">
  <meta charset="UTF-8">

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
        $sql="SELECT ".$_GET['type']." FROM persona WHERE id='".$localID."'";
        $lst=mysqli_query($conexio, $sql);
        $cl=mysqli_fetch_array($lst);
  ?>
    <p>
    <form action="LG_3EncriptarPass.php" method="POST" >
          <p>
          <label for="codi" style="font-weight: bold; font-size: 30px;"><?php echo $_GET['type'].": ".$cl[$_GET['type']]; ?></label>
          </p>

          <input name="dato" type="text" class="Datos" required="required"/>
          <input name="clm" type="text" hidden value="<?php echo $_GET['type']; ?>" />
          <input name="id" type="text" hidden value="<?php echo $localID; ?>" /> 
          <input class="btn btn-primary btn-block btn-large" type="submit" value="MODIFICAR">
    </form>
    <p>

  <?php
      mysqli_close($conexio);
      }
  ?>
      <p><a id="orange" class="clas" href="../../WEB_PRINCIPAL.php">Volver al menu</a></p>
  </div>
</body>
</html>