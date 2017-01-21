<!DOCTYPE html>

<head>
  <title>PAGINA PRINCIPAL</title>
  <link rel="stylesheet" type="text/css" href="CSS/CSS_Web.css">
  <meta charset="ISO-8859-1">
</head>

<!--PENDIENTE DE IMPLEMENTAR CRONOMETRO TIEMPO REAL -->
<script src="scriptCronometro.js"></script>

<body>

  <?php 
  session_start();
  include("Funciones/sesion.php");
  include("Funciones/config.php");
  include("Funciones/bbdd_param.php");

  //conexion a la base de datos
    //-----------------------------------------------------------------------
  
  //Actualizar perfil de usuario en el menu principal//
   if (!empty($_GET['mec'])) {

      $conexio=conexion_mysqli($db_host,$db_user,$db_pass,$database);
     	$sql = "SELECT * FROM persona WHERE persona.id='".$_GET['mec']."'";
      $list = mysqli_query($conexio, $sql);
  	  $reg = mysqli_fetch_array($list);

   	  $_SESSION['usr']= $reg['nombre'];
      $_SESSION['psw']= $reg['password'];
      $_SESSION['prf']= $reg['id_pf'];
      $_SESSION['id']=$reg['id'];
      mysqli_close($conexio);
   }
  //-----------------------------------------------------------------------

   $localUser= $_SESSION['usr'];
   $localPerf= $_SESSION['prf'];
   $localID= $_SESSION['id'];
?>

<!--   <<<<<<<<<<<<<<<<CABECERA>>>>>>>>>>>>>>>>>>>>   -->  
<div id="header">
      
    <h1><b style="color:green; font-size: 75px;"><?php echo "".$localUser.""; ?></b></h1>
    
    
    <!-- NOMBRE DE USUARIO y BOTON SALIR --> 
    <div style="

            position: absolute;
            top: 0%;
            left: 85%;
            width: 10%;
            height: 100%;
           ">
            <h4><?php echo $localUser;?></h4>
            <form action="LoginLogout/LG_Logout.php" method="GET" >
            <input class="btn btn-primary btn-block" type="submit" value="  salir  ">
            </form>
           
          <form action="LoginLogout/info_perfil/LG_1Dato_modificar.php" method="GET" >
             <input class="btn btn-primary " type="submit" value="cambiar contraseña">
          </form>

    </div>

    <!-- CAMBIAR DE USUARIO Y BOTTON --> 
    <div style="
          position: absolute;
          top: 0%;
          right: 85%;
          width: 10%;
          height: 100%;
         ">
          <p><form action="WEB_PRINCIPAL.php" method="GET" >
          <?php
            $conexio=conexion_mysqli($db_host,$db_user,$db_pass,$database);
             $sql = "SELECT * FROM persona WHERE id_pf='MK'";
             $list = mysqli_query($conexio, $sql);
          ?>
             <select name='mec' action="WEB_PRINCIPAL.php" method="GET">
          <?php 
              while ($registre = mysqli_fetch_array($list)) {
          ?>
                  <option value= <?php echo $registre["id"]; ?> > <?php echo $registre["nombre"]; ?></option>
          <?php
              }
          ?>
             </select></p>
             <input class="btn btn-primary " type="submit" value="Iniciar sesion">
          </form>

    </div>

</div>
                <!--   <<<<<<<<<<<<<<<< CONTENIDO PRINCIPAL >>>>>>>>>>>>>>>>>>>>   -->  
<div id="section" style="background: $localUser">
<?php
    //FUNCIONES DE UN MECANICO
  	$sql = "SELECT funciones.significado, funciones.php, perfil.idperfil FROM ";
  	$sql = $sql."perfil INNER JOIN ";
  	$sql = $sql."(permisos INNER JOIN ";
  	$sql = $sql."funciones ";
  	$sql = $sql."ON funciones.php = permisos.php) ";
	  $sql = $sql."ON permisos.idperfil = perfil.idperfil ";
	  $sql = $sql."WHERE perfil.idperfil='".$localPerf."'";
	  $list = mysqli_query($conexio,$sql);
?>
	  <ul id="menu">
<?php
    while ($registre = mysqli_fetch_array($list)) {
?>
  		  <li>
          <a id="btblM" href=<?php echo $registre['php'];?> ><b><?php echo $registre['significado'];?></b></a>
        </li>
<?php
    }
?>
	 </ul>

<?php
// --------------------------------INTERVENCION EN MARCHA--------------------------------//
    $sql = "SELECT * FROM intervencion LEFT JOIN coche ON intervencion.idCoche = coche.idCar WHERE intervencion.estado='en curso' AND idMec = '".$localID."'";
    $list = mysqli_query($conexio,$sql);
    $cont = mysqli_num_rows($list);
    
    if ($cont >= 1) {
      $rec = mysqli_fetch_array($list);
?>
    <div class="container">
        <div class="header" style="background-color: #d1d1d1;" >
            <!-- TITULO INTERVENCION -->
            <form action = "WEB_PRINCIPAL.php" method="post">
                <p><textarea style="margin-top: 10px;" required="required" name="t" rows="1" cols="40" placeholder="Titulo intervencion"></textarea>
                <input class="btn btn-primary" type="submit" value="titular"></p>
            </form>

            <h3><?php if($rec['tipo']=='cafe'){
              echo $rec['title'];
              }else{ echo " | ".$rec['cliente']." | ".$rec['marca']." | ".$rec['matricula']." | ";  } ?></h3>    
        </div>

        <table id="tbl" style="
        border-collapse: separate;
        border-spacing: 10px 50px;      
        ">
<?php
        echo "<tr><td>".$rec['id']."</td>";
        echo "<td>".$rec['horaIn']."</td>";
        echo "<td>".$rec['estado']."</td>";
?>
              <td><a id="btbl" href="intervenciones/finalizar.php?var1=<?php echo $rec['id'];?>">acabar</a></td></tr>
        </table>

              <!--   ///////////////////     COMENTARIOS AL JEFE    \\\\\\\\\\\\\\\\\        -->

  <form action = "WEB_PRINCIPAL.php" method="post">
      <p><textarea  required="required" name="c" rows="4" cols="50" placeholder="Comentarios para Salo"></textarea></p>
         <p><input class="btn btn-primary btn-block btn-large" type="submit" value="comentar"></p>
  </form>

</div>

<?php 
      //Añadir comentario a la intervencion
      if (!empty($_POST['c'])) {
          $sql = "UPDATE intervencion SET comentario='".$_POST['c']."' WHERE intervencion.id='".$rec['id']."'";
          $list = mysqli_query($conexio, $sql);
      }

      //Añadir comentario a la intervencion
      if (!empty($_POST['t'])) {
          $sql = "UPDATE intervencion SET title='".$_POST['t']."' WHERE intervencion.id='".$rec['id']."'";
          $list = mysqli_query($conexio, $sql);
      }
?>

<?php
    
    }else if($localPerf == 'MK'){?>

      <h1 style="font-size: 50px; color:#4a77d4;">NO HAY REPARACIONES EN CURSO</h1>

<?php }
    
      mysqli_close($conexio);
?>

    </div>

  </body>
</html>

