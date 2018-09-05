<?php
/**
 * Created by PhpStorm.
 * User: ilyak
 * Date: 29/08/2018
 * Time: 10:19
 */


//Objeto
class DatabaseManager
{
    private $servername;
    private $username;
    private $password;
    private $database;
    private $connection;

    public function __construct($serverName, $username, $password, $database)
    {
        $this->servername = $serverName;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
    }

    public function generateSelect($table, $where_array=null, $select='*'){

        if(is_null($table)) return false;
        if($where_array === null || empty($where_array)){
            $sql = "SELECT $select FROM $table";
        }else{
            $where_data = $this->sanitize_fields_and_values($where_array);
            $where_string = $this->create_update_string($where_data, 'AND', true);
            $sql = "SELECT $select FROM $table WHERE $where_string";
        }
        $this->query($sql);
        return $this;
    }

    public function sanitize_fields_and_values($fields_and_values){

        $fields = array();
        $values = array();

        foreach($fields_and_values as $field => $val){
            $fields[] = $this->sanitize_field($field);
            $values[] = $this->sanitize_value($val);
        }

        return (object) array('fields' => $fields, 'values'=>$values);
    }

    function getDataFromDDBB($query)
    {
        $this->create_connection();
        $results = $this->select_data($query);
        $this->close_connection();
        return $results;
    }

    private function create_connection()
    {
        try {
            $this->connection = new mysqli($this->servername, $this->username, $this->password, $this->database);

        } catch (mysqli_sql_exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    private function close_connection()
    {
        try {
            $this->connection->close();

        } catch (mysqli_sql_exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    private function insert_data($query)
    {
        try {
            $this->connection->query($query);

        } catch (mysqli_sql_exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    private function delete_data($query)
    {
        try {
            $this->connection->query($query);

        } catch (mysqli_sql_exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    private function select_data($query)
    {
        try {
            $registro = array();

            if ($results = $this->connection->query($query)) {
                if (mysqli_num_rows($results) > 0) {
                    for ($i = 0; $registro[$i] = mysqli_fetch_assoc($results); $i++) ;
                    array_pop($registro);
                }
            }
            return $registro;

        } catch (mysqli_sql_exception $e) {
            throw new Exception($e->getMessage());
        }
    }

}