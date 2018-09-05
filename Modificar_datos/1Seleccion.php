<?php
session_start();
include("../Funciones/sesion.php");
include("../Funciones/config.php");
include("../Funciones/bbdd_param.php");
include("../Funciones/ddbb_functions.php");

//Datos del usuario de la sesion
$userName = $_SESSION['usr'];
$pageName = "FICHAS DE VEHICULOS";
$errorMessage = "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Modificar Fichas: Seleccion </title>
    <?php include('../includes/head.php'); ?>
</head>

<body>
<?php
include("../includes/headerBigStatic.php");
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-1"></div>
        <div class="jumbotron col-md-10" style="">
            <?php
            if (!empty($_GET['var'])) {
                //Show error message
                $errorMessage = $_GET['var']; ?>
                <div class="alert alert-danger alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <Strong>Error:</Strong>Ficha de vehículo <strong>[ <?php echo $errorMessage ?> ]</strong> no
                    encontrada
                </div>
            <?php } ?>
            <form class="form-horizontal" action="2Formulario.php" method="POST">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">Ficha:</span>
                        <input name="val" type="text" id="buscar" class="form-control input-lg"
                               placeholder="escriba algo..." required="required"/>
                    </div>
                </div>
                <div class="form-group">
                    <input class="btn btn-primary btn-block btn-lg" type="submit" value="MODIFICAR">
                </div>
            </form>
        </div>
        <div class="col-md-2"></div>
    </div>
    <div class="row" style="">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="form-group">
                <a id="" class="btn btn-default btn-block btn-lg" href="../FichasVehiculo/nueva.php">NUEVA FICHA</a>
            </div>
            <div class="form-group">
                <a id="" class="btn btn-warning btn-md btn-block" href="../WEB_PRINCIPAL.php">Volver al menu</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>

<?php
//obtener los datos de autocompletado
$fichasAutocompletado = getAutocompleteData($db_host, $db_user, $db_pass, $database);
?>

<script>
    //-----------------------------------------------------------------------------------------------//
    $(function () {
        var autocompletar = new Array();
        <?php //Esto es un poco de php para obtener lo que necesitamos
        for($p = 0;$p < count($fichasAutocompletado); $p++){ //usamos count para saber cuantos elementos hay ?>
        autocompletar.push('<?php echo $fichasAutocompletado[$p]; ?>');
        <?php } ?>
        $("#buscar").autocomplete({ //Usamos el ID de la caja de texto donde lo queremos
            source: autocompletar //Le decimos que nuestra fuente es el arreglo
        });
    });
    //-----------------------------------------------------------------------------------------------//
</script>




