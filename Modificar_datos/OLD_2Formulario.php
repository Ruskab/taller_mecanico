<html>
<head>

<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="../CSS/CSS_Web.css">
<link rel="stylesheet" type="text/css" href="../CSS/CSS_Formulario.css">

  <title></title>
</head>
<body>

<?php session_start();
include("../Funciones/sesion.php");
include("../Funciones/config.php");
include("../Funciones/bbdd_param.php");
?>

<?php 
   $localUser= $_SESSION['usr'];
   $localPerf= $_SESSION['prf'];
   $localID=$_SESSION['id'];

//Parametros configuracion bbdd

  //Si se accede a la pagina sin parametros en URL
 if(!empty($_POST['val'])){

      $idF=strtok($_POST['val'], "||");
      $conexio=conexion_mysqli($db_host,$db_user,$db_pass,$database);
      $sql = "SELECT * FROM coche  WHERE idCar=".$idF." ";
      $list = mysqli_query($conexio,$sql);

      if(mysqli_num_rows($list)==0){
          //FICHA NO ENCONTRADA 
          header('Location:1Seleccion.php?var=Ficha no encontrada: '.$idF.'');
          die();
      }else{
       $r=mysqli_fetch_array($list);
       $ficha=$r['idCar'];
       mysqli_close($conexio);
      }


  }elseif(!empty($_POST['d0'])) {

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $vars = array($_POST['d1'],$_POST['d2'],$_POST['d3'],$_POST['d4'],$_POST['d5'],$_POST['d6'],$_POST['d11'],$_POST['d12'],$_POST['d13'],$_POST['d14']);  //<----------------------------------------------

        $length = count($vars);

        for($x = 0; $x < $length; $x++) {
             $name = test_input($vars[$x]);     

             // check if name only contains letters and whitespace
             if (!empty($name) && !preg_match('/^[a-z0-9 .\-]+$/i', $name)) {
                echo $name." solo letras o numeros, sin acentos";
                header('Location:1Seleccion.php?var=['.$name.'] Solo letras o numeros, sin acentos'); 
                die();
             }
          }
        }

        $conexio=conexion_mysqli($db_host,$db_user,$db_pass,$database);
        $sql="UPDATE coche SET cliente='".$_POST['d1']."',`marca`='".$_POST['d2']."',`matricula`='".$_POST['d3']."',`matriculacion`='".$_POST['d4']."',`distrib_KMS`='".$_POST['d5']."',`bastidor`='".$_POST['d6']."',`f_revision`='".$_POST['FREV']."',`revision_KMS`='".$_POST['FKMS']."',`ITV`='".$_POST['FITV']."',`next_ITV`='".$_POST['FNEXT']."',`filtro_aire`='".$_POST['d11']."',`filtro_aceite`='".$_POST['d12']."',`filtro_combustible`='".$_POST['d13']."',`aceite_motor`='".$_POST['d14']."' WHERE idCar='".$_POST['d0']."'";
        #Actualizar un usuario a la base de datos
        mysqli_query($conexio, $sql);
        mysqli_close($conexio);
        header('Location:../WEB_PRINCIPAL.php'); 
  }else{
        header('Location:../WEB_PRINCIPAL.php'); 
  }
    

?>


<div id="header">
  <h1>MODIFICAR DATOS DE UNA FICHA</h1>
</div>

<div id="section">
  
    <form action="2Formulario.php" method="POST" >
  
  <div  class="floatingBox">
    <div class="contenido">
       <div class="campo">
         <p>
                <label for="codi">Nombre del cliente</label>
                <input name="d1" type="text" id="FDatos" required="required" value="<?php echo $r['cliente'] ?>" />       
         </p>
       </div>
      <div class="campo"> 
       <p>
              <label for="codi">Marca de vehiculo</label>
              <input name="d2" type="text" id="FDatos" required="required" value="<?php echo $r['marca'] ?>" />
       </p>
       </div>
       <div class="campo">
       <p>
              <label for="codi">Matricula</label>
              <input name="d3" type="text" id="FDatos" required="required" value="<?php echo $r['matricula'] ?>" />
       </p>
       </div>
       <div class="campo">
       <p>      
              <label for="codi">Fecha de matriculación</label>
              <input name="d4" type="date" id="FDatos"  value="<?php echo $r['matriculacion'] ?>" />
      </p>
      </div>
      <div class="campo">
       <p>
              <label for="codi">Distribución KMS</label>
              <input name="d5" type="text" id="FDatos" value="<?php echo $r['distrib_KMS'] ?>" />
       </p>
       </div>
       <div class="campo">
       <p>
              <label for="codi">Bastidor del vehículo</label>
              <input name="d6" type="text" id="FDatos" value="<?php echo $r['bastidor'] ?>" />
       </p>
       </div>
       <div class="campo">
        <p>
              <label for="codi">Fecha última ITV</label>
              <input name="FITV" type="date" id="FDatos" value="<?php echo $r['ITV'] ?>" />
        </p>
        </div>
    </div>
  </div>

<div  class="floatingBox">
  <div class="contenido">
          
          <div class="campo">
          <p>
          <label for="codi">Filtro de aire</label>
          <input name="d11" type="text" id="FDatos" value="<?php echo $r['filtro_aire'] ?>" />
          </p>
          </div>
          
          <div class="campo">
          <p>
          <label for="codi">Filtro del aceite</label>
          <input name="d12" type="text" id="FDatos" value="<?php echo $r['filtro_aceite'] ?>" />
          </p>
          </div>
          
          <div class="campo">
          <p>
          <label for="codi">filtro del combustible</label>
          <input name="d13" type="text" id="FDatos" value="<?php echo $r['filtro_combustible'] ?>" />
          </p>
          </div>
          
          <div class="campo">
          <p>
          <label for="codi">Aceite en el motor</label>
          <input name="d14" type="text" id="FDatos" value="<?php echo $r['aceite_motor'] ?>" />
          </p>
          </div>
          
          <div class="campo">
            <p>
              <label for="codi">Fecha última revisión</label>
              <input name="FREV" id="FDatos" type="date" id="FDatos" value="<?php echo $r['f_revision'] ?>" />
            </p>          
          </div>
          
          <div class="campo">
            <p>
              <label for="codi">Revisión del KMS</label>
              <input name="FKMS" type="text" id="FDatos" value="<?php echo $r['revision_KMS'] ?>" />
            </p>
          </div>

          <div class="campo">
            <p>
              <label for="codi">Fecha próxima ITV</label>
              <input name="FNEXT" type="date" id="FDatos" value="<?php echo $r['next_ITV'] ?>" />
            </p>
          </div>

  </div>
</div>
          <input name="d0" type="text" hidden value="<?php echo $idF; ?>" /> 
    <div id="boton">
          <input class="btn btn-primary btn-block btn-large" type="submit" value="MODIFICAR">
      </form>       
          <p><a id="orange" class="clas" href="../WEB_PRINCIPAL.php">Volver al menu</a></p>
    </div>
  
  </div>
  
</body>
</html>