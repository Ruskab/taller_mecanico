<?php
/**
 * Created by PhpStorm.
 * User: ilyak
 * Date: 30/08/2018
 * Time: 17:19
 */
include("../DDBB/Car.php");

require_once ('PHPUnit/Autoload.php');

use PHPUnit\Framework\TestCase;


class CarTest extends TestCase
{
    public function testSetInfoFromDatabase()
    {
        $car = new Car();
        $car->setInfoFromDatabase('4663');
        $this->assertNotNull($car->matricula);

    }


}
