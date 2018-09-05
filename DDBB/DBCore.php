<?php
/**
 * Created by PhpStorm.
 * User: ilyak
 * Date: 30/08/2018
 * Time: 19:38
 */

include("../Funciones/bbdd_param.php");
require_once dirname(__FILE__).'/DB.php';
class DBCore extends DB {



    private static $db_instance;

    public static function get_instance(){
        if (!self::$db_instance){
            self::$db_instance = new DBCore();
        }
        return self::$db_instance;
    }


    public function __construct(){
        global $db_host, $db_user, $db_pass, $database;
        parent::__construct( $db_host, $db_user, $db_pass, $database);
    }

    // overload clone so it can't be called
    protected function __clone(){}

}
// convenience function
function DBCore(){
    return DBCore::get_instance();
}

