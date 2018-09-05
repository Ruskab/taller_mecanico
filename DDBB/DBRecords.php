<?php
/**
 * Created by PhpStorm.
 * User: ilyak
 * Date: 30/08/2018
 * Time: 22:02
 */

Abstract class DBRecords
{
    protected $id;
    protected $DBManager;

    function __construct()
    {
        $this->DBManager = new DBCore();
    }



    abstract function setInfoFromDatabase($id);

    //Todo Hacer un desctructor


}

