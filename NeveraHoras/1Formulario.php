<?php 
session_start(); 
include("../Funciones/sesion.php");
include("../Funciones/config.php");
include("../Funciones/bbdd_param.php");

?>

<html>
  <head>
  <link rel="stylesheet" type="text/css" href="../CSS/CSS_Web.css">

  <meta charset="utf-8">
    <style type="text/css">
    /* tamaño del autocompleto que salga el scroll */
    .ui-autocomplete { height: 200px; overflow-y: scroll; overflow-x: hidden;}
    </style>
    <!-- Estilo del autocompletado -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <!-- JQUERIS -->
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  </head>

  <body>
<?php 
    //Datos del usuario de la secion
   $localUser= $_SESSION['usr'];
   $localPerf= $_SESSION['prf'];
   $localID= $_SESSION['id'];
?>
  <div id="header">
    <h1>NEVERA DE HORAS </h1>
  </div>

<div id="section">
  <div class="container">
    <div class="header" >
      <h1>CLIENTES</h1>    
        <h3>busque al cliente...</h3>
          <div style="color: #4a77d4; font-weight: bold;" id="txtHint">
            doble click en el cuadro de texto para ver resultados
          </div>

    </div>
    
    <div class="body">
    <?php
    $conexio=conexion_mysqli($db_host,$db_user,$db_pass,$database);

    //Comprobar que no haya intervenciones en marcha

       $sql = "SELECT * FROM coche GROUP BY cliente";       
       $column="cliente";
       $conexio=conexion_mysqli($db_host,$db_user,$db_pass,$database);
       $res = mysqli_query($conexio,$sql);
       $arreglo_php = array();
       if(mysqli_num_rows($res)==0)
          array_push($arreglo_php, "No hay datos");
      else{ //si hay, meterlos en un array
          while($palabras = mysqli_fetch_array($res)){
              array_push($arreglo_php, $palabras[$column]);
          }
      }
?>

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

//------------------------AJAX-------------------------------------------------------
function showNevera(str) {
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET","3Consulta.php?cl="+str,true);
        xmlhttp.send();
    }
}
//---------------------------------------------------------------------------------------
</script>

<?php $error=""; if (!empty($_GET['var'])) { $error=$_GET['var']; } ?> <p style="color: red;"><?php echo "$error" ?></p>

<p>
  <form action="2Registro.php" method="POST">
    <p>
      <input ondblclick="showNevera(this.value)" name="val" type="text" id="buscar" class="Datos" placeholder="Buscar..." required="required"/>
    </p>
    
    <p style="font-weight: bold;">+
      <input style="  width: 80px;
          margin-bottom: 8px;
          border: none;
          outline: none;
          padding: 10px;
          font-size: 12px;
          font-family: 'Arial Black';
          border: 1px solid rgba(0, 0, 0, 0.3);
          border-radius: 4px;"
          name="nev" value="0" placeholder="HORAS NEVERA" type="number" step="0.25" min="-100" max="100" maxlength="3" size="1"> 
    HORAS</p>

    <input class="btn btn-primary btn-block btn-large" type="submit" value="MODIFICAR HORAS">
  </form>
</p>
  <?php
  mysqli_close($conexio);
  ?>
  <p>
    <a id="orange" class="clas" href="../WEB_PRINCIPAL.php">Volver al menu</a>
  </p>
        </div>
      </div>
    </div>  
  </body>
</html>