<?php
/**
 * Created by PhpStorm.
 * User: ilyak
 * Date: 29/08/2018
 * Time: 20:17
 */
include ("../DDBB/DBCore.php");
include("DBRecords.php");
//DTO
class Car extends DBRecords
{
    public $cliente;
    public $marca;
    public $matricula;
    public $matricua;
    public $matriculacion;
    public $distrib_KMS;
    public $bastidor;
    public $f_revision;
    public $ITV;
    public $next_ITV;
    public $filtro_aire;
    public $filtro_aceite;
    public $filtro_combustible;
    public $aceite_motor;
    public $tipoCar;
    public $nevera;

    function setInfoFromDatabase($idCar){

        $this->DBManager->select("coche",array("idCar"=>$idCar));
        $result = $this->DBManager->object_result();
        if (!empty($result)){
            $this->id = $result->idCar;
            $this->cliente = $result->cliente;
            $this->marca = $result->marca;
            $this->matricula = $result->matricula;
            $this->matricua = $result->matricula;
            $this->matriculacion = $result->matriculacion;
            $this->distrib_KMS = $result->distrib_KMS;
            $this->bastidor = $result->bastidor;
            $this->f_revision = $result->f_revision;
            $this->ITV = $result->ITV;
            $this->next_ITV = $result->next_ITV;
            $this->filtro_aire = $result->filtro_aire;
            $this->filtro_aceite = $result->filtro_aceite;
            $this->filtro_combustible = $result->filtro_combustible;
            $this->aceite_motor = $result->aceite_motor;
            $this->tipoCar = $result->tipoCar;
            $this->nevera = $result->nevera;
        }
    }
}