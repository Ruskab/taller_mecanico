<?php 
session_start(); 
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
    //Datos del usuario de la secion
   $localUser= $_SESSION['usr'];
   $localPerf= $_SESSION['prf'];
   $localID= $_SESSION['id'];
?>


<div id="header">
  <h1>NUEVA INTERVENCION A UN COCHE</h1>
</div>

<div id="section">
  <div class="container">
    <div class="header" >
      <h1>CREAR UNA INTERVENCION</h1>    
        <h3>SELECCIONE EL COCHE A REPARAR</h3>
    </div>
    <div class="body">
    <?php
    $conexio=conexion_mysqli($db_host,$db_user,$db_pass,$database);

    $sql = "SELECT * FROM intervencion WHERE idMec='".$localID."' AND estado='en curso'";
    $list = mysqli_query($conexio, $sql);
  
    //Comprobar que no haya intervenciones en marcha
    if(mysqli_num_rows($list)==0){

       $sql = "SELECT idCar,cliente,matricula, marca FROM coche  WHERE 1 ";
       
       $column="cliente";
       $column2="marca";
       $column3="matricula";
       $conexio=conexion_mysqli($db_host,$db_user,$db_pass,$database);
       $res = mysqli_query($conexio,$sql);
       $arreglo_php = array();
       if(mysqli_num_rows($res)==0)
          array_push($arreglo_php, "No hay datos");
      else{ //si hay, meterlos en un array
          while($palabras = mysqli_fetch_array($res)){
              array_push($arreglo_php, $palabras['idCar']."||".$palabras[$column]." ".$palabras[$column2]." ".$palabras[$column3]);
          }
      }
?>

<script>
//-----------------------------------------------------------------------------------------------//
  $(function(){
    var autocompletar = new Array();
    <?php //Esto es un poco de php para obtener lo que necesitamos
    for($p = 0;$p < count($arreglo_php); $p++){ //usamos count para saber cuantos elementos hay ?>
        autocompletar.push('<?php echo $arreglo_php[$p]; ?>');
<?php } ?>
     $("#buscar").autocomplete({ //Usamos el ID de la caja de texto donde lo queremos
       source: autocompletar //Le decimos que nuestra fuente es el arreglo
     });
  });
//-----------------------------------------------------------------------------------------------//
</script>

<?php $error=""; if (!empty($_GET['var'])) { $error=$_GET['var']; } ?> <p style="color: red;"><?php echo "$error" ?></p>

<p>
<form action="nueva2.php" method="POST">
  <p>
    <input name="val" type="text" id="buscar" class="datos" placeholder="FICHA DEL COCHE" required="required"/>
  </p>
  <input class="btn btn-primary btn-block btn-large" type="submit" value="CREAR">
</form>
</p>

<p>
  <a id="btbl" class="clas" href="newFichaInterv.php">NUEVO CLIENTE</a>
</p>
<a title="caffe" href="caffe1.php"><img src="../imagenes/cafe.png" alt="cafe" height=75 width=75 /></a> 
<?php
}else{ //si hay, meterlos en un array?> 
    <p style="color: red;"><b> Tienes un trabajo activo, terminalo antes! </b></p>
<?php }
mysqli_close($conexio);
 ?>
<p><a id="orange" class="clas" href="../WEB_PRINCIPAL.php">Volver al menu</a></p>

      </div>
    </div>
  </div>  
</body>
</html>