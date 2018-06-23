<?php 
session_start(); 
include("../Funciones/sesion.php");
include("../Funciones/config.php");
include("../Funciones/bbdd_param.php");
    //Datos del usuario de la secion
   $localUser= $_SESSION['usr'];
   $localPerf= $_SESSION['prf'];
   $localID= $_SESSION['id'];

  $conexio=conexion_mysqli($db_host,$db_user,$db_pass,$database);

  $sql = "SELECT * FROM intervencion WHERE idMec='".$localID."' AND estado='en curso'";
  $list = mysqli_query($conexio, $sql);

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
  <link rel="stylesheet" href="../CSS/CSS_Personalizado.css">

  <!-- JQUERIS -->
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
</head>

<body>
  <!-- Barra de navegacion -->
  <nav class="navbar navbar-inverse">
    <div class="container-fluid">    
      <div class="navbar-header">
        <a class="navbar-brand" href="#"><p style="color: #ffbf00" class="text-right text-center"><b><?php echo $localUser?></b>  </p></a>
      </div>
      <ul class="nav navbar-nav">      
      
      </ul>          
    </div>
  </nav>

  <div class="container-fluid" >
    <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-10">
        <ul class="breadcrumb">
          <li><a href="../WEB_PRINCIPAL.php">Home</a></li>        
          <li class="active">2 Seleccionar</li>        
        </ul>
      </div>
      <div class="col-md-1"></div>
    </div>
    <div class="row">
      <div class="col-md-1"></div>
      <div class="jumbotron col-md-10" style="">

      <?php 
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
           
        <?php       
        $error="";
         if (!empty($_GET['var'])) { 
            $error=$_GET['var']; ?><div class="alert alert-danger alert-dismissable">  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><Strong>Error:</Strong> Ficha de vehículo <strong>[ <?php echo $error ?> ]</strong>  no encontrada</div> 
        <?php  
        } 
        ?> 
       <form class="form-horizontal" action="nueva2.php" method="POST">
        <div class="form-group">                            
          <div class="input-group">
            <span class="input-group-addon">Ficha:</span>            
            <input name="val" type="text" id="buscar" class="form-control input-lg" placeholder="escriba algo..." required="required"/>              
          </div>
        </div>
        <div class="form-group">            
          <input class="btn btn-primary btn-block btn-lg" type="submit" value="CREAR">
        </div>        
      </form>
      <div class="row" style="">
        <div class="col-md-2"></div>
        <div class="col-md-8">    
          <div class="form-group">                      
            <a class="btn btn-default btn-block btn-lg" href="newFichaInterv.php">NUEVO CLIENTE + CREAR INTERVENCIÓN</a>
          </div>
          
          <div style="text-align: center;" class="form-group">
            <a class="btn btn-default" title="Cafe" href="caffe1.php"><img src="../Imagenes/cafe.png" alt="cafe" height=75 width=75 /></a>           
          </div>


        </div>
    </div>
          <?php
          }else{ ?> 
            <div class="alert alert-danger">
              <strong>Cuidado!</strong> Tienes una reparación en marcha, se ha de acabar antes de iniciar otra.
            </div>
          <?php 
          }
          mysqli_close($conexio);
          ?>
          
      <div class="form-group">            
        <a id="" class="btn btn-warning btn-md btn-block" href="../WEB_PRINCIPAL.php">Volver al menu</a>
      </div>
    <div class="col-md-2"></div>   
  </div>
  </div>
</div>

<!--END CONTAINER -->
</body>
</html>

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