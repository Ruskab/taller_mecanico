<html>
<head>

<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="CSS/CSS_Web.css">

  <title></title>
</head>
<body>

<?php session_start();
include("Funciones/sesion.php");
include("Funciones/config.php");
include("Funciones/bbdd_param.php");
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
}else{
      header('Location:../WEB_PRINCIPAL.php'); 
}
?>
<div id="header">
  <h1>MODIFICAR DATOS DE LA FICHA</h1>
</div>

<div id="section">

  <div id="Mbut" >
    
            <a id="btblB" href="FU_MDatos3.php?var1=<?php echo $r['idCar'];?>&type=cliente">cliente</a>
            <a id="btblB" href="FU_MDatos3.php?var1=<?php echo $r['idCar'];?>&type=marca">marca</a>
            <a id="btblB" href="FU_MDatos3.php?var1=<?php echo $r['idCar'];?>&type=matricula">matricula</a>
            <a id="btblB" href="FU_MDatos3.php?var1=<?php echo $r['idCar'];?>&type=matriculacion">matriculacion</a>
            <a id="btblB" href="FU_MDatos3.php?var1=<?php echo $r['idCar'];?>&type=distrib_KMS">distribución KMS</a>
            <a id="btblB" href="FU_MDatos3.php?var1=<?php echo $r['idCar'];?>&type=bastidor">bastidor</a>
            <a id="btblB" href="FU_MDatos3.php?var1=<?php echo $r['idCar'];?>&type=f_revision">fecha revision</a>
            <a id="btblB" href="FU_MDatos3.php?var1=<?php echo $r['idCar'];?>&type=revision_KMS">revisión KMS</a>
            <a id="btblB" href="FU_MDatos3.php?var1=<?php echo $r['idCar'];?>&type=ITV">ITV</a>
            <a id="btblB" href="FU_MDatos3.php?var1=<?php echo $r['idCar'];?>&type=next_ITV">Siguiente ITV</a>
            <a id="btblB" href="FU_MDatos3.php?var1=<?php echo $r['idCar'];?>&type=filtro_aire">Filtro de aire</a>
            <a id="btblB" href="FU_MDatos3.php?var1=<?php echo $r['idCar'];?>&type=filtro_aceite">filtro de aceite</a>
            <a id="btblB" href="FU_MDatos3.php?var1=<?php echo $r['idCar'];?>&type=filtro_combustible">filtro combustible</a>
            <a id="btblB" href="FU_MDatos3.php?var1=<?php echo $r['idCar'];?>&type=aceite_motor">aceite de motor</a>
  </div>

  </form><p>

   <p><a id="orange" class="clas" href="../WEB_PRINCIPAL.php">Volver al menu</a></p>

</div>

</body>
</html>