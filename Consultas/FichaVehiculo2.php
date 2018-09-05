<?php session_start();
include("../Funciones/sesion.php");
include("../Funciones/config.php");
include("../Funciones/bbdd_param.php");
   $localUser= $_SESSION['usr'];
   $localPerf= $_SESSION['prf'];
   $localID= $_SESSION['id'];
  
    if (!empty($_GET['val'])) {
      $q = strtok($_GET['val'], "||");
      echo is_int($q);
      $conexio=conexion_mysqli($db_host,$db_user,$db_pass,$database);
      
      $sql = "SELECT * FROM coche  WHERE idCar=".$q." ";

      if ($list = mysqli_query($conexio,$sql)){

      if(mysqli_num_rows($list)==0)
        echo "No hay datos";
      else{
        $ficha = mysqli_fetch_array($list)
        ?>
        <table id="tbl">
        <tr>
            <th id="tbl">cliente</th>
            <th id="tbl">marca</th>
            <th id="tbl">matricula</th>
            <th id="tbl">matriculacion</th>
            <th id="tbl">distribucion KMS</th>
            <th id="tbl">bastidor</th>
            <th id="tbl">fecha revision</th>
            <th id="tbl">revision KMS</th>
            <th id="tbl">ITV</th>
            <th id="tbl">Siguiente ITV</th>
            <th id="tbl">filtro de aire</th>
            <th id="tbl">filtro de aceite</th>
            <th id="tbl">filtro combustible</th>
            <th id="tbl">filtro de motor</th>
        </tr>
           <?php
            echo "<tr><td>".$ficha['cliente']."</td>";
            echo "<td>".$ficha['marca']."</td>";
            echo "<td>".$ficha['matricula']."</td>";
            echo "<td>".$ficha['matriculacion']."</td>";
            echo "<td>".$ficha['distrib_KMS']."</td>";
            echo "<td>".$ficha['bastidor']."</td>";
            echo "<td>".$ficha['f_revision']."</td>";
            echo "<td>".$ficha['revision_KMS']."</td>";
            echo "<td>".$ficha['ITV']."</td>";
            echo "<td>".$ficha['next_ITV']."</td>";
            echo "<td>".$ficha['filtro_aire']."</td>";
            echo "<td>".$ficha['filtro_aceite']."</td>";
            echo "<td>".$ficha['filtro_combustible']."</td>";
            echo "<td>".$ficha['aceite_motor']."</td></tr>";
        }
        mysqli_close($conexio)
        ?>
        </table>
        <?php
      }
      }
    ?>
  </div>
</body>
</html>