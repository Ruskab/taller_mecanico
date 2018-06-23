  <?php 
  session_start(); 
  include("../Funciones/sesion.php");
  include("../Funciones/config.php");
  include("../Funciones/bbdd_param.php");

 $localUser= $_SESSION['usr'];
 $localPerf= $_SESSION['prf'];
 $localID=$_SESSION['id'];
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
          <li><a a href="nueva1.php">2 Seleccionar</a></li>
          <li class="active">3 Tareas extra</li>    
        </ul>
      </div>
      <div class="col-md-1"></div>
    </div>
    <div class="row">
      <div class="col-md-1"></div>
      <div class="jumbotron col-md-10" style="">
        <h2 style="text-align: center;"><b>TAREAS EXTRA o DESCANSO</b></h2>   
        <form class="form-horizontal" action = "caffe2.php" method="get">         
          <div class="form-group">
            <textarea class="form-control" required="required" name="t" rows="2" placeholder="Tiempo dedicado a..."></textarea>
            <button class="btn btn-primary btn-block btn-large" type="submit">Empezar</button>
          </div>
        </form>
        <a  class="btn btn-warning btn-block btn-large" href="../WEB_PRINCIPAL.php">Volver al menu</a></p>
      </div>
    </div>
  </div>
</body>
</html>
