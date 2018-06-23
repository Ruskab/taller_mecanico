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
//Parametros configuracion bbdd

  ////Si viene de 1Seleccion.php
   if(!empty($_POST['val'])){

      $idF=strtok($_POST['val'], "||");
      $conexio=conexion_mysqli($db_host,$db_user,$db_pass,$database);
      $sql = "SELECT * FROM coche  WHERE idCar=".$idF." ";
      $list = mysqli_query($conexio,$sql);

      if(mysqli_num_rows($list)==0){
          //FICHA NO ENCONTRADA 
          header('Location:1Seleccion.php?var='.$idF.'');
          die();
      }else{
       $r=mysqli_fetch_array($list);
       $ficha=$r['idCar'];
       mysqli_close($conexio);
    }

    }elseif(!empty($_POST['d0'])) {
        //Si viene de la misma página
        if (!empty($_POST['idFicha'])) {  
          $idF = $_POST['idFicha'];
          $conexio=conexion_mysqli($db_host,$db_user,$db_pass,$database);
          $sql = "SELECT * FROM coche  WHERE idCar=".$idF." ";
          $list = mysqli_query($conexio,$sql);
          if(mysqli_num_rows($list)==0){
          //FICHA NO ENCONTRADA 
            die();
            header('Location:1Seleccion.php?var='.$idF.'');
        }else{
            $r=mysqli_fetch_array($list);
            $ficha=$r['idCar'];
            mysqli_close($conexio);
          }
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $vars = array($_POST['d1'],$_POST['d2'],$_POST['d3'],$_POST['d4'],$_POST['d5'],$_POST['d6'],$_POST['d11'],$_POST['d12'],$_POST['d13'],$_POST['d14']);  

        $length = count($vars);

        for($x = 0; $x < $length; $x++) {
             $name = test_input($vars[$x]);     
             // check if name only contains letters and whitespace
             if (!empty($name) && !preg_match('/^[a-z0-9 .\-]+$/i', $name)) {
                
                $error = "(".$name.") Solo letras o números, sin acentos y no usar comas"; 
                
             }
          }
        }
        
        if ($error == "") {        
        $conexio=conexion_mysqli($db_host,$db_user,$db_pass,$database);
        $sql="UPDATE coche SET cliente='".$_POST['d1']."',`marca`='".$_POST['d2']."',`matricula`='".$_POST['d3']."',`matriculacion`='".$_POST['d4']."',`distrib_KMS`='".$_POST['d5']."',`bastidor`='".$_POST['d6']."',`f_revision`='".$_POST['FREV']."',`revision_KMS`='".$_POST['FKMS']."',`ITV`='".$_POST['FITV']."',`next_ITV`='".$_POST['FNEXT']."',`filtro_aire`='".$_POST['d11']."',`filtro_aceite`='".$_POST['d12']."',`filtro_combustible`='".$_POST['d13']."',`aceite_motor`='".$_POST['d14']."' WHERE idCar='".$_POST['d0']."'";
        #Actualizar un usuario a la base de datos
        mysqli_query($conexio, $sql);
        mysqli_close($conexio);
        header('Location:../WEB_PRINCIPAL.php'); 
        }
  }else{
                
        header('Location:../WEB_PRINCIPAL.php'); 
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

  <style type="text/css">/* tamaño del autocompleto que salga el scroll */.ui-autocomplete { height: 200px; overflow-y: scroll; overflow-x: hidden;</style>
  <!-- Estilo del autocompletado -->
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <!-- JQUERIS -->
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
</head>

<body>
   

      <div class="container-fluid" >
        <div class="row">
          <div class="jumbotron" style="background-color: #4c4d4f !important; padding-bottom:1%; padding-top: 1%">          
            <div class="col-md-2"></div>      
            <div class="col-md-8">
                <ul class="breadcrumb" >
                <li><a href="../WEB_PRINCIPAL.php">Home</a></li>
                <li><a href="../Modificar_datos/1Seleccion.php">2 Buscar</a></li>                
                <li class="active">3 Modificar</li>            
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
            <form class="form-horizontal" action="2Formulario.php" method="POST" >
              <div class="form-group">                        
                 <div class="row">
                            <?php           
      //--------------------MOSTRAR EL ERROR-----------------------//
                   if (!empty($error)) { 
                      ?><div class="alert alert-danger alert-dismissable">  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><Strong>Error: </Strong><strong> <?php echo $error ?> </strong></div> <?php ; } ?> 
             
                    <div class="col-md-5">            
                      <div class="form-group">
                        <label for="name">Nombre del cliente:</label>
                          <input id="name" class="form-control input-lg" name="d1" type="text" required="required" value="<?php echo $r['cliente'] ?>"/>             
                      </div>
                      <div class="form-group">
                        <label for="codi">Marca del vehículo:</label>
                        <input class="form-control input-lg"  name="d2" type="text" required="required" value="<?php echo $r['marca'] ?>" />
                      </div>
                      <div class="form-group">
                        <label for="codi">Matricula:</label>
                        <input class="form-control input-lg" name="d3" type="text" required="required" value="<?php echo $r['matricula'] ?>" />
                      </div>
                      <div class="form-group">
                        <label for="codi">Fecha de la matriculación:</label>
                        <input class="form-control input-lg" name="d4" type="date"  value="<?php echo $r['matriculacion'] ?>" />
                      </div>
                      <div class="form-group">
                        <label for="codi">Distribución KMS:</label>
                        <input class="form-control input-lg" name="d5" type="text" value="<?php echo $r['distrib_KMS'] ?>" />
                      </div>
                      <div class="form-group">
                        <label for="codi">Bastidor del vehículo:</label>
                        <input class="form-control input-lg" name="d6" type="text" value="<?php echo $r['bastidor'] ?>" />
                      </div>
                      <div class="form-group">
                        <label for="codi">Fecha última ITV:</label>
                        <input class="form-control input-lg" name="FITV" type="date" value="<?php echo $r['ITV'] ?>" />
                      </div>
                    </div> 
                      
                          <div class="col-md-2"></div>

                          <div class="col-md-5">
                              <div class="form-group">
                                            <label for="codi">Filtro del aire:</label>
                                            <input class="form-control input-lg" name="d11" type="text" value="<?php echo $r['filtro_aire'] ?>" />
                                </div>
                                <div class="form-group">
                                            <label for="codi">Filtro del aceite:</label>
                                            <input class="form-control input-lg" name="d12" type="text" value="<?php echo $r['filtro_aceite'] ?>" />
                                </div>
                                <div class="form-group">
                                            <label for="codi">Filtro del combustible:</label>
                                            <input class="form-control input-lg" name="d13" type="text" value="<?php echo $r['filtro_combustible'] ?>" />
                                </div>
                                <div class="form-group">
                                            <label for="codi">Aceite en el motor:</label>
                                            <input class="form-control input-lg" name="d14" type="text" value="<?php echo $r['aceite_motor'] ?>" />
                                </div>
                                <div class="form-group">
                                            <label for="codi">Fecha última revisión:</label>
                                            <input class="form-control input-lg" name="FREV" type="date" value="<?php echo $r['f_revision'] ?>" />
                                </div>
                              <div class="form-group">
                                            <label for="codi">Revisión del KMS:</label>
                                            <input class="form-control input-lg" name="FKMS" type="text" value="<?php echo $r['revision_KMS'] ?>" />
                                </div>
                              <div class="form-group">
                                            <label for="codi">Fecha próxima ITV:</label>
                                            <input class="form-control input-lg" name="FNEXT" type="date" value="<?php echo $r['next_ITV'] ?>" />
                                            <input name="d0" type="text" hidden value="<?php echo $idF; ?>" />
                                            <input name="idFicha" type="text" hidden value="<?php echo $idF; ?>" />  
                              </div>
                        </div>                 
                   </div>
                        </div>
                   
                   <div class="row">     
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                      <div class="form-group">      
                          <input class="btn btn-primary btn-block btn-lg" type="submit" value="MODIFICAR">
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
    <div class="col-md-1"></div>
            
          </div>    
      </div>
</body>
</html>