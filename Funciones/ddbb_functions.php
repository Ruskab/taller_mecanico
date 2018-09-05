<?php
include ("bbdd_param.php");
/**
 * Created by PhpStorm.
 * User: ilyak
 * Date: 21/08/2018
 * Time: 14:18
 */

function getDataFromDatabase($query, &$conection)
{
    $results = mysqli_query($conection, $query);
    if (mysqli_num_rows($results) == 0)
        array_push($registro, "No hay datos");
    else { //si hay, meterlos en un array

        for($i = 0; $registro[$i] = mysqli_fetch_assoc($results); $i++) ;
        array_pop($registro);
        }
    return $registro;
}

function getOneRegisterFromDatabase($query, &$conection)
{
    if ($results = mysqli_query($conection, $query)) {
        if (mysqli_num_rows($results) >= 1)
            return mysqli_fetch_array($results);
    }
}

function getAutocompleteData ( $db_host, $db_user, $db_pass, $database){
    $query = "SELECT idCar,cliente, matricula, marca FROM coche  WHERE 1 ;";
    $conection = conexion_mysqli($db_host, $db_user, $db_pass, $database);
    $fichasVehiculo = getDataFromDatabase($query, $conection);
    mysqli_close($conection);

    //Formateado para Autocompletado
    $fichasAutocompletado = array();
    foreach ($fichasVehiculo as $ficha) {
        array_push($fichasAutocompletado, $ficha['idCar'] . "||" . $ficha['cliente'] . " " . $ficha['marca'] . " " . $ficha['matricula']);
    }
    return $fichasAutocompletado;
}