<?php session_start();
include("../Funciones/sesion.php");
include("../Funciones/config.php");
include("../Funciones/bbdd_param.php");
include("../Funciones/ddbb_functions.php");
$userName = $_SESSION['usr'];
$pageName = "Consultar Disponibles";
?>
<html>
<head>
    <?php include("../includes/head.php"); ?>
    <title>CONSULTAS DISPONIBLES</title>
</head>

<body>
<div id="header">
    <?php include("../includes/headerBigStatic.php"); ?>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <div class="btn-group btn-group-justified">
                <a class="btn btn-lg btn-primary" href="RevisionITV.php"><h1>PROXIMAS Revisiones ITV</h1></a>
                <a class="btn btn-lg btn-primary" href="RevisionITV2.php"><h1>Revisiones ITV Caducadas</h1></a>
            </div>

            <div class="col-md-12" style="height:25px;"></div>

            <div class="btn-group btn-group-justified">
                <a class="btn btn-lg btn-warning btn-block" href="../WEB_PRINCIPAL.php">Volver al menu</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>