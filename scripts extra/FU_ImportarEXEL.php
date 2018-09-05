<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>jQuery UI Autocomplete - Default functionality</title>

  <!-- Estilo del autocompletado -->
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <!-- JQUERIS -->
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>


</head>
<body>
<?php
  //Parametros configuracion bbdd
  include("config.php");

  //conseguir los datos del autocompletado
  $sql = "SELECT cliente FROM coche order by cliente";
  $res = mysql_query($sql);
  $arreglo_php = array();
  //si no hay datos
  if(mysql_num_rows($res)==0)
     array_push($arreglo_php, "No hay datos");
  else{ //si hay, meterlos en un array
    while($palabras = mysql_fetch_array($res)){
      array_push($arreglo_php, $palabras["cliente"]);
    }
  }
?>
<script>
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
<input type="text" id="buscar" />

</body>
</html>