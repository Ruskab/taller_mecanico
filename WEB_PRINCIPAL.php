<?php 
session_start();
include("Funciones/sesion.php");
include("Funciones/config.php");
include("Funciones/bbdd_param.php");
//conexion a la base de datos  
$conexio=conexion_mysqli($db_host,$db_user,$db_pass,$database);
if (!empty($_GET['mec'])) {
 	$sql = "SELECT * FROM persona WHERE persona.id='".$_GET['mec']."'";
  $list = mysqli_query($conexio, $sql);
  $reg = mysqli_fetch_array($list);
	  $_SESSION['usr']= $reg['nombre'];
  $_SESSION['psw']= $reg['password'];
  $_SESSION['prf']= $reg['id_pf'];
  $_SESSION['id']=$reg['id'];
}

//Añadir comentarios a la internvención   
if (!empty($_POST['c'])) {
  $sql = "UPDATE intervencion SET comentario='".$_POST['c']."' WHERE intervencion.id='".$_POST['idFicha']."'";
  mysqli_query($conexio, $sql);
}
//Añadir titiulo a la intervencion
if (!empty($_POST['t'])) {
  $sql = "UPDATE intervencion SET title='".$_POST['t']."' WHERE intervencion.id='".$_POST['idFicha']."'";
  mysqli_query($conexio, $sql);
}
mysqli_close($conexio);

$localUser= $_SESSION['usr'];
$localPerf= $_SESSION['prf'];
$localID= $_SESSION['id'];
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
  <link rel="stylesheet" href="CSS/CSS_Personalizado.css">

  <!-- JQUERIS -->
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
</head>

    <?php
     $conexio=conexion_mysqli($db_host,$db_user,$db_pass,$database);
     $sql = "SELECT * FROM persona WHERE id_pf='MK'";
     $list = mysqli_query($conexio, $sql);
    ?>

<body>
  <!-- Barra de navegacion -->
  <nav class="navbar navbar-inverse">
    <div class="container-fluid">    
      <div class="navbar-header">
        <a class="navbar-brand" href="#"><p style="color: #ffbf00" class="text-right text-center"><b><?php echo $localUser?></b>  </p></a>
      </div>
      <ul class="nav navbar-nav">      
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#"><b>Usuarios</b><span class="caret"></span></a>
          <ul class="dropdown-menu">
            <?php 
            while ($reg = mysqli_fetch_array($list)) { $url = "WEB_PRINCIPAL.php?mec=".$reg['id'];?>
              <li><a href=<?php echo $url;?> ><?php echo $reg["nombre"];?> </a></li><?php 
            }
            ?>
          </ul>
        </li>
      </ul>
      <ul class="navbar-nav nav navbar-right">
        <li><a href="LoginLogout/info_perfil/LG_1Dato_modificar.php"><b>Ajustes</b></a></li>                   
        <li><a href="LoginLogout/LG_Logout.php"><b>Salir</b></a></li> 
      </ul>
    </div>
  </nav>

  <div class="container-fluid">  
    <div class="row">
      <div class="row">
        <div class="col-md-1"></div>   
        <div class="col-md-10">
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
            <!-- Grupo de botones con funcionalidades del usuario monitor -->          
          <div class="btn-group btn-group-justified hidden-xs">            
            <?php while ($reg = mysqli_fetch_array($list)) { ?>
            <a class="btn btn-primary btn-lg" href=<?php echo $reg['php'];?> ><b><?php echo $reg['significado'];?></b></a>
            <?php } ?>             
          </div>
          <?php $list = mysqli_query($conexio,$sql); ?>
          <!-- Grupo de botones con funcionalidades del usuario movil -->          
          <div class="btn-group-vertical visible-xs">            
            <?php while ($reg = mysqli_fetch_array($list)) { ?>               
            <a class="btn btn-primary btn-lg" href=<?php echo $reg['php'];?> ><b><?php echo $reg['significado'];?></b></a>
            <?php } ?>             
          </div>
        </div>   
        <div class="col-md-1"></div>   
      </div>
      <!-- INTERNVENCIONES BODY -->
      <br>
      <div class="row">
        <?php
        //--------------------------------INTERVENCION EN MARCHA--------------------------------//
        $sql = "SELECT * FROM intervencion LEFT JOIN coche ON intervencion.idCoche = coche.idCar WHERE intervencion.estado='en curso' AND idMec = '".$localID."'";
        $list = mysqli_query($conexio,$sql);
        $cont = mysqli_num_rows($list);?>        
          <div class="col-md-3"></div>
          <div class="col-md-6">
              <!-- Panel con la internveción -->
            <div class="panel panel-info">
                <!-- Cabecera Internvencion -->
              <div class="panel-heading">          
                <!-- TITULO INTERVENCION -->      
                <?php
                if ($cont >= 1) {$rec = mysqli_fetch_array($list);
                ?>                                
                  <span style="font-size: 18px" class="label label-primary"><small>ID:</small> <?php echo $rec['id']; ?></span>
                  <span style="font-size: 18px" class="label label-primary"><small>INICIO: </small><?php echo $rec['horaIn']; ?></span>
                  <span style="font-size: 18px" class="label label-success"><?php echo $rec['estado']; ?></span>      
                <h4>
                <?php 
                if($rec['tipo']=='cafe'){
                ?>
                  <h3><p><small>Trabajo extra:</small><?php echo $rec['title'];?></p></h3>    
                <?php 
                }else{
                ?> 
                    <p><label><small>Nombre: </small><?php echo $rec['cliente']?></label></p>
                    <p><label><small>Marca: </small><?php echo $rec['marca']?></label></p>
                    <p><label><small>Matrícula: </small><?php echo $rec['matricula']?></label></p>
                <?php
               }
               ?>
                </h4>  

              </div>
              <div class="panel-body">                
                <!-- Panel desplegable con información extra -->
                <div class="panel-group">
                  <div class="panel panel-info">
                    <div class="panel-heading">
                      <h4 class="panel-title" style="text-align: center;">
                        <a data-toggle="collapse" href="#infoCollapse"><b>Información detallada<b></a>
                      </h4>
                    </div>
                    <div id="infoCollapse" class="panel-collapse collapse">
                      <div class="panel-body">
                        <h5><p><small>Reparación: </small><?php echo $rec['title'];?></p></h5>    
                      </div>
                      <div class="panel-body">
                        <h5><p><small>Comentarios: </small><?php echo $rec['comentario'];?></p></h5>    
                      </div>
                    </div>
                  </div>
                </div>
              
                <!-- Boton desplegable para añadir titulo -->
                <div class="panel-group" style="text-align: center;">
                  <button type="button" class="btn btn-default btn-block" data-toggle="collapse" data-target="#titleCollapse">Título</button>
                  <div id="titleCollapse" class="collapse">
                    <form class="form" action = "WEB_PRINCIPAL.php" method="post">
                      <div class="input-group">
                        <input type="text" class="form-control" id="title" required="required" name="t" placeholder="Escribe aquí la repación realizada...">
                        <input name="idFicha" type="text" hidden value="<?php echo $rec['id']; ?>" />  
                        <div class="input-group-btn">
                          <button class="btn btn-default" type="submit" ><i class="glyphicon glyphicon-pencil"></i>
                          </button>
                        </div>                                        
                      </div>
                    </form>
                  </div>
                </div>

                <!-- Boton desplegable para añadir comentarios -->
                <div class="panel-group" style="text-align: center;">
                  <button type="button" class="btn btn-default btn-block" data-toggle="collapse" data-target="#coment">Comentarios</button>
                  <div id="coment" class="collapse">
                    <form class="form-horizontal" action="WEB_PRINCIPAL.php" method="post">
                      <div class="input-group">
                        <textarea class="form-control" required="required" name="c" rows="2" placeholder="Escribe aquí el comentario..."></textarea>
                        <input name="idFicha" type="text" hidden value="<?php echo $rec['id']; ?>" />
                        <div class="input-group-btn">
                          <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-comment">
                          </button>
                        </div>                  
                      </div>
                    </form>
                  </div>
                </div>
                
                <!-- Boton para acabar internvención -->
                <a class="btn btn-primary btn-block btn-lg" href="Intervenciones/finalizar.php?var1=<?php echo $rec['id'];?>"><b>Acabar</b></a>

              </div>              
            </div> <!-- Final de panel internvención -->
              <?php 
              }else if($localPerf == 'MK'){
              ?>
              <h1 class="text-info">NO HAY REPARACIONES EN CURSO</h1>
              <?php
              } mysqli_close($conexio); 
              ?>
          </div>
        </div>
      </div> 
    </div>  
</body>
</html>
