  <?php 
  session_start(); 
  include("../Funciones/sesion.php");
  ?>
  
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="../CSS/CSS_Web.css">

<meta charset="utf-8">

<style type="text/css">
      /* tamaño del autocompleto que salga el scroll */
      .ui-autocomplete { height: 200px; overflow-y: scroll; overflow-x: hidden;}

    body { 
      padding: 10px 10px 0 10px;
      background-color: #f8f8f8;
    }

    input {
      padding: 5px;
      width: 240px;
      max-width: 100%;
      font-size: 1.2em;
      margin-bottom: 10px;
    }

    label {
      display: inline-block;
      width: 25%;
    }

    body, input {
      font-family: sans-serif;
    }

    </style>

    </head>
<body>

<?php 
   $localUser= $_SESSION['usr'];
   $localPerf= $_SESSION['prf'];
   $localID= $_SESSION['id'];
?>

<div id="header">
    <h1>DESCANSO</h1>
</div>

<div id="section">

<div class="container">
  <div class="header" >
    <h1>TAREAS EXTRA o DESCANSO</h1>    
  </div>

  <div class="body">
    <form action = "caffe2.php" method="get">
          
        <div>
        <p><textarea style="margin-top: 10px;" required="required" name="t" rows="3" cols="43" placeholder="tiempo dedicado a..."></textarea></p>
        </div>

        <input class="btn btn-primary btn-block btn-large" type="submit" value="descansar">
    </form>

   <p><a id="orange" class="clas" href="../WEB_PRINCIPAL.php">Volver al menu</a></p>
      </div>
    </div>
  </div>
   
</body>
</html>