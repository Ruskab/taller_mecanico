<?php session_start();
include("../Funciones/sesion.php");
include("../Funciones/bbdd_param.php");
include("../DDBB/DatabaseManager.php");
include("../DDBB/Car.php");

//Declaracion de variables
$userName = $_SESSION['usr'];
$pageName = "Consultar Vehiculos";
$htmlPanelHeading = "";
$htmlPanelBody = "";

try {
    $fichasAutocompletado = generateAutocompleteData();

    //si peticion de consulta realizada
    if (hasInputFromGet()) {
        $idCar = getIdFromInputValue();
        $car = new Car($idCar);
        $car->setInfoFromDatabase($idCar);

        $htmlPanelHeading = (!empty($car->idCar)) ? addCarMainInfo($car) : addNoDataInfo();
        $htmlPanelBody = (!empty($car->idCar)) ? addCarExtraTableInfo($car) : "";
    }

} catch (Exception $e) {
    echo $e->getMessage();
}
?>

<html>
<head>
<<<<<<< HEAD
    <?php include('../includes/head.php'); ?>
</head>
<body>
<?php
//Header que es igual para todas las páginas
include('../Includes/headerStatic.php');
?>

<div class="container-fluid">
    <?php
    //Bara de navegacion Indice
    $breadcrumbItems = '<li>Consultar</li>';
    include('../includes/breadcrumb.php');
    ?>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="jumbotron col-md-10" style="">
            <form class="form-horizontal" action="FichaVehiculo.php" method="POST">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">Ficha:</span>
                        <input name="inputValue" type="text" id="buscar" class="form-control input-lg"
                               placeholder="escriba algo..." required="required"/>
                    </div>
                </div>
                <div class="form-group">
                    <input class="btn btn-primary btn-block btn-lg" type="submit" value="CONSULTAR">
                </div>
            </form>
            <div class="row" style="">
                <div class="col-md-2"></div>
                <div class="col-md-8">

                    <div class="form-group">
                        <a id="" class="btn btn-warning btn-md btn-block" href="../WEB_PRINCIPAL.php">Volver al menu</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>
<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <!-- Panel con la ficha-->
        <div class="panel panel-info">
            <div class="panel-heading">
                <?php
                echo $htmlPanelHeading
                ?>
            </div>
            <div class="panel-body">
                <?php
                echo $htmlPanelBody
                ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>

<?php
//Abs 2
function generateAutocompleteData()
{
    global $db_host, $db_user, $db_pass, $database;
    $DBManager = new DatabaseManager($db_host, $db_user, $db_pass, $database);
    $query = "SELECT idCar,cliente, matricula, marca FROM coche  WHERE 1 ;";
    $result = $DBManager->getDataFromDDBB($query);

    return giveFormatAutocompleteData($result);
}
//Abs 3
function giveFormatAutocompleteData($fichasVehiculo)
{
    $fichasAutocompletado = array();
    foreach ($fichasVehiculo as $ficha) {
        array_push($fichasAutocompletado, $ficha['idCar'] . "||" . $ficha['cliente'] . " " . $ficha['marca'] . " " . $ficha['matricula']);
    }
    return $fichasAutocompletado;
}
//Abs 2
function addCarMainInfo($car)
{
    return sprintf('
<div class="row">
<div class="col-md-4"/> <label><small>nombre</small></label><h4>%s</h4></div>
<div class="col-md-4"/> <label><small>marca</small></label><h4>%s</h4></div> 
<div class="col-md-4"/> <label><small>matricula</small></label><h4>%s</h4></div>
</div>'
        , $car->cliente, $car->marca, $car->matricula);
}
//Abs 2
function addNoDataInfo()
{
    return sprintf("
<div class=\"row\">
    <div class=\"col-md-5\"/> </div>
    <div class=\"col-md-3\"/> <h3>No hay información</h3></div> 
    <div class=\"col-md-4\"/> </div>
</div>");
}
//Abs 2
function addCarExtraTableInfo(Car $car)
{
    return sprintf('
        <table class="table">
        <thead>
              <tr>
                <th>matric</th>
                <th>distrib_KMS</th>
                <th>bastidor</th>
                <th>f_revision</th>
              </tr>
            </thead>
             <tbody>
              <tr>
                <td>%s</td>
                <td>%s</td>
                <td>%s</td>
                <td>%s</td>
              </tr>
        
        ', $car->matriculacion, $car->distrib_KMS, $car->bastidor, $car->f_revision);
}
//Abs 2
function hasInputFromGet()
{
    if (!empty($_POST['inputValue']))
        return true;
    else
        return false;
}

function getIdFromInputValue()
{
    return strtok($_POST['inputValue'], "||");
}

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
