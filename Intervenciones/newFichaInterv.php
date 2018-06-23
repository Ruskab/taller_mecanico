
<?php 
session_start(); 
include("../Funciones/sesion.php");
include("../Funciones/config.php");
include("../Funciones/bbdd_param.php");
$localUser= $_SESSION['usr'];
$localPerf= $_SESSION['prf'];
$localID=$_SESSION['id'];

$timezone = new DateTimeZone('Europe/Madrid');
$data = new DateTime('now', $timezone);

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
$vars = array($_POST['clt'],$_POST['mtr'] ,$_POST['mdl'] );
$length = count($vars);
for($x = 0; $x < $length; $x++) {
     $name = test_input($vars[$x]);     
     // check if name only contains letters and whitespace
     if (!preg_match('/^[a-z0-9 .\-]+$/i', $name)) {
          $error = "(".$name.") Solo letras o números, sin acentos y no usar comas"; 
      
     }
  }
}

  //----------CUANDO HAY DATOS QUE INSERTAR ---------------//
  if($error == "" && $_SERVER["REQUEST_METHOD"] == "POST"){
      $conexio=conexion_mysqli($db_host,$db_user,$db_pass,$database);

      $sql="INSERT INTO coche (cliente, matricula, marca) VALUES ('".$_POST['clt']."','".$_POST['mtr']."', '".$_POST['mdl']."')";
      mysqli_query($conexio, $sql);
      $ID=mysqli_insert_id($conexio);

      #Actualizar un usuario a la base de datos
      $sql="INSERT INTO intervencion (horaIn, estado, idCoche,idMec) VALUES ('".$data->format('Y-m-d H:i:s')."','en curso', '".$ID."','".$localID."')";
      mysqli_query($conexio, $sql);
      mysqli_close($conexio);
      header('Location:../WEB_PRINCIPAL.php'); 
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <style type="text/css">/* tamaño del autocompleto que salga el scroll */.ui-autocomplete { height: 200px; overflow-y: scroll; overflow-x: hidden;}</style>
  <!-- Estilo del autocompletado -->
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <!-- JQUERIS -->
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
</head>

<body>
  <div class="container-fluid" >
    <div class="row">
    <!-- NAV BAR -->
      <div class="jumbotron" style="background-color: #4c4d4f !important; padding-bottom:1%; padding-top: 1%">          
            <div class="col-md-2"></div>      
            <div class="col-md-8">
                <ul class="breadcrumb" >
                <li><a href="../WEB_PRINCIPAL.php">Home</a></li>
                <li><a href="nueva1.php">2 Seleccionar</a></li>                
                <li class="active">3 Nuevo cliente</li>            
              </ul>
            </div>
              <p  style="color: #ffbf00" class="text-right"><b><?php echo $localUser?></b></p>                  
      </div>
    </div>          
    <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-10">
        <!-- Nuevo cliente -->              
        <div class="jumbotron">
          <form class="form-horizontal" action="newFichaInterv.php" method="POST" >
            <div class="form-group">                        
            <?php           
                //--------------------MOSTRAR EL ERROR-----------------------//
             if (!empty($error)) { 
              ?><div class="alert alert-danger alert-dismissable">  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><Strong>Error: </Strong><strong> <?php echo $error ?> </strong></div> <?php ; } ?> 
            </div>
            <h2 style="text-align: center;"><b>NUEVO CLIENTE</b></h2>
            <div class="form-group">
              <label for="name">Cliente:</label>
              <input class="form-control input-lg" name="clt" type="text" placeholder="Nombre y Apellido" required="required"/>
            </div>            
            <div class="form-group">                
              <label for="name">Matricula:</label>
              <input class="form-control input-lg" name="mtr" type="text" placeholder="Matricula del vehículo" required="required"/>
            </div>
            <div class="form-group">                
              <label for="name">Modelo del coche:</label>
              <input class="form-control input-lg" name="mdl" type="text" placeholder="Modelo del vehículo" required="required"/>
            </div>
              <input class="btn btn-primary btn-block btn-large" type="submit" value="Aceptar">                
          </form>
           <br>
           <a class="btn btn-warning btn-md btn-block" href="../WEB_PRINCIPAL.php">Volver al menu</a>     
        </div>
      </div>
    </div>
  </div>
</body>
</html>

