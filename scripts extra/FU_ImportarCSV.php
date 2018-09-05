<?php session_start(); ?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="CSS/CSS_Web.css">
<style>
</style>
</head>
<body>

<?php 
   $localUser= $_SESSION['usr'];
   $localPerf= $_SESSION['prf'];
?>


<div id="header">
<h1>IMPORTAR DATOS</h1>
</div>

<div id="nav">
<?php
?>
</div>


<div id="section">

<div class="container">
  <div class="header" >
    <h1>AÑADIR DATOS A LA BASE DE DATOS</h1>    
      <h3>Seleccione el archivo a importar</h3>
  </div>
  <div class="body">

<form action="FU_importarCSV2.php"   method="post" enctype="multipart/form-data">
<input type="file" name="archivo" id="archivo" accept=".csv" />

<br>
<br>
<input type="radio" name="tp" value="1" checked>CLIENTES
<input type="radio" name="tp" value="2">BOMBEROS
<br>
<br>

<input type="hidden" name="MAX_FILE_SIZE" value="20000" />

<input  type = "submit" name="enviar" value="Importar"/>
</form>




   <p><a id="orange" class="clas" href="WEB_PRINCIPAL.php">Volver al menu</a></p>
    </div>
    </div>
   </div>
   
<div id="footer">
Copyright taller salo

</div>

</body>
</html>