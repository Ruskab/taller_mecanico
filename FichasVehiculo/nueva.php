<html>
  <head>
  <meta charset="UTF-8">

    <link rel="stylesheet" type="text/css" href="../CSS/CSS_Web.css">
  </head>

  <body>
  <?php 
  session_start(); 
  include("../Funciones/sesion.php");
  ?>

  <div id="header">
    <h1>NUEVA FICHA DE VEHICULO</h1>
  </div>

  <div id="section">

      <div class="container">
        <div class="header" >
          <h1>DATOS DEL VEHICULO</h1>    
            <h3>Introduzca los datos [cliente-matricula-marca] obligatorio</h3>
        </div>

        <div class="body">

        <?php $error=""; if (!empty($_GET['var'])) { $error=$_GET['var']; } ?> <p style="color: red;"><?php echo "$error" ?></p>
  
        <p><form action="nueva2.php" method="POST" >

           <p><input id="inLarge" name="v1" type="text" placeholder="cliente obligatorio" required="required"/>
              <input id="inLarge" name="v2" type="text" placeholder="modelo obligatorio" required="required"/>
              <input id="inLarge" name="v3" type="text" placeholder="matricula obligatorio" required="required"/>
              <input id="inLarge" name="v4" type="text" placeholder="matriculacion" />
              <input id="inLarge" name="v5" type="text" placeholder="distribucion KMS"/>
              <input id="inLarge" name="v6" type="text" placeholder="bastidor" />
              <input id="inLarge" name="v7" type="date" placeholder="fecha revision" />
              <input id="inLarge" name="v8" type="date" placeholder="revision KMS" />
              <input id="inLarge" name="v9" type="date" placeholder="ITV" />
              <input id="inLarge" name="v10" type="date" placeholder="Siguiente ITV" />
              <input id="inLarge" name="v11" type="text" placeholder="filtro aire" />
              <input id="inLarge" name="v12" type="text" placeholder="filtro aceite" />
              <input id="inLarge" name="v13" type="text" placeholder="filtro combustible" />
              <input id="inLarge" name="v14" type="text" placeholder="aceite motor" />
              <input id="inLarge" name="v15" type="text" hidden placeholder="aceite motor" /></p>
              
              <input class="btn btn-primary btn-block btn-large" type="submit" value="INSERTAR">
        </form></p>

           <p><a id="orange" class="clas" href="../WEB_PRINCIPAL.php">Volver al menu</a></p>
   
      </div>
    </div>
  </div>
   
</body>
</html>