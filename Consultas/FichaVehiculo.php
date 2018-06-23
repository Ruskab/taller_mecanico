<?php session_start();
include("../Funciones/sesion.php");
include("../Funciones/config.php");
include("../Funciones/bbdd_param.php");
?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="../CSS/CSS_Web.css">

<meta charset="UTF-8">
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
   $localUser= $_SESSION['usr'];
   $localPerf= $_SESSION['prf'];
   $localID= $_SESSION['id'];
?>


<div id="header">
<h1>CONSULTAR FICHA</h1>
</div>

<div id="nav">
<?php
?>
</div>

<div id="section">

<div class="container">
  <div class="header" >

  </div>
  <div class="body">
<?php
//--------------------------------------------------------//
//--------------------------------------------------------//

  
       $sql = "SELECT idCar,cliente, matricula, marca FROM coche  WHERE 1 ";
       
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
      mysqli_close($conexio);
?>

<script>
//------------------------AJAX-------------------------------------------------------
function showUser(str) {
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
        xmlhttp.open("GET","FichaVehiculo2.php?val="+str,true);
        xmlhttp.send();
    }
}
//---------------------------------------------------------------------------------------

//-----------------------------AUTOCOMPLETE----------------------------------------------
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
</script>

  <p>
  <form>
        <label><b style="font-size: 20px;6">FICHAS DE CLIENTES EN LA BASE DE DATOS</b></label>
        <input ondblclick="showUser(this.value)" name="val" type="text" id="buscar" class="Datos" placeholder="Buscar..." required="required"/>
  </form>
  </p>

   <p><a id="orange" class="clas" href="../WEB_PRINCIPAL.php">Volver al menu</a></p>
        

      </div>
    </div>
        <div id="txtHint">
          <b>
            Doble click en el cuadro de texto para ver resultados.     
          </b>
        </div>

  </div>
</body>
</html>