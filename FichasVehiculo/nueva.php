<?php session_start();
include("../Funciones/sesion.php");
include("../Funciones/config.php");
include("../Funciones/bbdd_param.php");
$localUser= $_SESSION['usr'];
$localPerf= $_SESSION['prf'];
$localID=$_SESSION['id'];

//Error codes
$error = "";
$idF= "";

if (!empty($_GET['var'])) {
  $error = $_GET['var'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Modificar Fichas: Seleccion </title>
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
  <div class="container-fluid">
    
    <div class="row">
      <div class="jumbotron" style="background-color: #4c4d4f !important; padding-bottom:1%; padding-top: 1%">          
        <div class="col-md-2"></div>      
        <div class="col-md-8">
            <ul class="breadcrumb" >
            <li><a href="../WEB_PRINCIPAL.php">Home</a></li>
            <li><a href="../Modificar_datos/1Seleccion.php">2 Buscar</a></li>                
            <li class="active">3 Nueva</li>            
          </ul>
        </div>
        <div>
          <p  style="color: #ffbf00" class="text-right"><?php echo $localUser?></p>                  
        </div>          
      </div>
    </div>
    
    <div class="row">   
      <div class="col-md-1"></div>
      <div class="col-md-10">      
      <div class="jumbotron">
        <?php //Show Error message 
        if (!empty($error)) { 
        ?><div class="alert alert-danger alert-dismissable">  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><Strong>Error: </Strong><strong> <?php echo $error ?> </strong></div> <?php ; } ?>              
        
        <form class="form-horizontal" action="nueva2.php" method="POST" >
          <div class="form-group">                        
           <div class="row">
              <div class="col-md-3"> 
                <div class="form-group ">
                  <label for="name"><p class="text-primary">Nombre del cliente:</p></label>
                  <input id="name" class="form-control input" name="v1" type="text" required="required"/>             
                </div>
                <div class="form-group ">
                  <label for="codi"><p class="text-primary">Marca del vehículo:</p></label>
                  <input class="form-control input"  name="v2" type="text" required="required" />
                </div>  
                <div class="form-group ">
                  <label for="codi"><p class="text-primary">Matricula:</p></label>
                  <input class="form-control input" name="v3" type="text" required="required" />
                </div>
                <div class="form-group ">
                  <label for="codi">Fecha de la matriculación:</label>
                  <input class="form-control input" name="v4" type="date"  />
                </div>
             </div>
             <div class="col-md-1"></div>
             <div class="col-md-3">
               <div class="form-group ">
                  <label for="codi">Distribución KMS:</label>
                  <input class="form-control input" name="v5" type="text" />
              </div>
              <div class="form-group ">
                <label for="codi">Bastidor del vehículo:</label>
                <input class="form-control input" name="v6" type="text" />
              </div>
              <div class="form-group ">
                <label for="codi">Fecha última ITV:</label>
                <input class="form-control input" name="FITV" type="date" />
              </div>
               <div class="form-group ">
                <label for="codi">Filtro del aire:</label>
                <input class="form-control input" name="v11" type="text" />
              </div>
              <div class="form-group ">
                <label for="codi">Filtro del aceite:</label>
                <input class="form-control input" name="v12" type="text" />
              </div>

             </div>
             <div class="col-md-1"></div>                         
             <div class="col-md-3">                         
              <div class="form-group ">
                <label for="codi">Filtro del combustible:</label>
                <input class="form-control input" name="v13" type="text" />
              </div>
              <div class="form-group ">
                <label for="codi">Aceite en el motor:</label>
                <input class="form-control input" name="v14" type="text" />
              </div>
              <div class="form-group ">
                <label for="codi">Fecha última revisión:</label>
                <input class="form-control input" name="FREV" type="date" />
              </div>
              <div class="form-group ">
                <label for="codi">Revisión del KMS:</label>
                <input class="form-control input" name="FKMS" type="text" />
              </div>
              <div class="form-group ">
                <label for="codi">Fecha próxima ITV:</label>
                <input class="form-control input" name="FNEXT" type="date" />
                <input name="v0" type="text" hidden value="<?php echo $idF; ?>" />
                <input name="idFicha" type="text" hidden value="<?php echo $idF; ?>" />  
              </div>    
             </div>


           </div>
          </div>
            <div class="row">     
              <div class="col-md-3"></div>
              <div class="col-md-6">
                <div class="form-group">      
                  <input class="btn btn-primary btn-block btn-large" type="submit" value="INSERTAR">
                </div>      
                <div class="form-group">
                  <a class="btn btn-warning btn-md btn-block" href="../WEB_PRINCIPAL.php">Volver al menu</a>     
                </div>
              </div>    
              <div class="col-md-3"></div>
             </div>
        </form>
      </div>
      </div>
    </div>      
  </div>  
</body>
</html>            