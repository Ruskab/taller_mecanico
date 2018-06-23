<?php session_start(); 
include("../Funciones/sesion.php");
include("../Funciones/config.php");
include("../Funciones/bbdd_param.php");

     $Nused = ($_GET['used']*60);
     $Nnew = ($_GET['new']*60);
     
     $facturadas = $_GET['fact'];
     $idCoche = $_GET['id'];
     $client=$_GET['client'];

     //horas de la nevera en minutos
      $conexio=conexion_mysqli($db_host,$db_user,$db_pass,$database);

      $sql="SELECT nevera FROM coche Where cliente='".$client."'";
      $lista=mysqli_query($conexio, $sql);
      $n=mysqli_fetch_array($lista);
      //echo ($n['nevera']/60)."<br>";
      $Nactual=$n['nevera']-$Nused+$Nnew;
      //echo ($Nactual/60)."<br>";
      
      $cadena="UPDATE coche SET nevera='".$Nactual."' WHERE cliente='".$client."'";
  	  //echo $cadena."<br>";
      mysqli_query($conexio, $cadena);
  	  
      //Coger data actual
      $timezone = new DateTimeZone('Europe/Madrid');
      $data = new DateTime('now', $timezone);

      //CREAR UN NUEVO TRABAJO
    	$cadena="INSERT INTO trabajo (idFicha, facturado, h_facturadas, nevera) VALUES ('".$idCoche."','".$data->format('Y-m-d H:i:s')."','".($facturadas*60)."','".$Nused."') ";
    	//echo $cadena."<br>";
  	  mysqli_query($conexio,$cadena);
    	$TRID=mysqli_insert_id($conexio);
      #Actualizar un usuario a la base de datos
    	echo "REALIZADO CON EXITO";
  	
  	  $cadena="UPDATE intervencion SET estado='facturado' , idtr='".$TRID."' WHERE idCoche='".$idCoche."' AND estado='finalizado' ";
      //echo $cadena."<br>";
  	  mysqli_query($conexio,$cadena);
      mysqli_close($conexio);
      header('Location:../WEB_PRINCIPAL.php'); 
