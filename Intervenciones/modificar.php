<?php session_start();
include("../Funciones/sesion.php");
include("../Funciones/config.php");
include("../Funciones/bbdd_param.php");
 ?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="../CSS/CSS_Web.css">
  <meta charset="utf-8">
<style type="text/css">
    /* tamaño del autocompleto que salga el scroll */
    .ui-autocomplete { height: 200px; overflow-y: scroll; overflow-x: hidden;}
</style>
    <!-- Estilo del autocompletado -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <!-- JQUERIS -->
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

</head>
<body>

<?php 
   $localUser= $_SESSION['usr'];
   $localPerf= $_SESSION['prf'];
   $localID= $_SESSION['id'];
?>


<div id="header">
<h1>MODIFICAR DATOS DE lA INTERVENCION</h1>
</div>

<div id="section">

  <div class="container">
    <div class="header" >
      <h1></h1>    
        <h3>Introduzca la modificacion</h3>
    </div>
    <div class="body">

<?php
//--------------------------------------------------------//

  if(!empty($_GET['type'])){
?>
      <form action = "modificar.php" method="get">
<?php
//-----------------------FECHA INICIO---------------------//
      if ($_GET['type']==1) { 
      ?>
          <div>
            <label for="datetime">Fecha inicio</label>
            <input name="dato" id="datetime" type="datetime-local">
            <input name="upd" type="text" hidden value="horaIn"/></input>
          </div>
      <?php  
//---------------------FECHA FINALIZACION-----------------//
      }else if ($_GET['type']==2) {
      ?>
          <div>
            <label for="datetime">Fecha final</label>
            <input name="dato" id="datetime" type="datetime-local">
            <input name="upd" type="text" hidden value="horaOUT" /></input>
          </div>
      <?php  
  //-------------------COMENTARIO---------------------------//
  }else if ($_GET['type']==3) {
?>
          <div>
              <p>
              <textarea  required="required" name="dato" rows="4" cols="50" placeholder="Comentarios para Salo"></textarea>
              </p>
               <input name="upd" type="text" hidden value="comentario" /></input>
          </div>
<?php    
  }
?>
  <input name="idInt" type="text" hidden value="<?php echo $_GET['var1'] ?>" /></input>    
  <input class="btn btn-primary btn-block btn-large" type="submit" value="Aceptar">
  </form><p>
<?php
  }
//---------------------ACTUALIZAR EL DATO-----------------//
  if(!empty($_GET['dato'])){
        $conexio=conexion_mysqli($db_host,$db_user,$db_pass,$database);
        $sql="UPDATE intervencion SET ".$_GET['upd']."='".$_GET['dato']."' WHERE id='".$_GET['idInt']."'";
        mysqli_query($conexio, $sql);
        mysqli_close($conexio);
        header('Location:../Consultas/IntervencionesMec.php');
  }
?>
<p><a id="orange" class="clas" href="../Consultas/IntervencionesMec.php">Volver atras</a></p> 
      </div>
    </div>
  </div>
</body>
</html>