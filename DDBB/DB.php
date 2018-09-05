<?php

abstract class DB extends mysqli{

    private static $db_instance;

    protected $result;

    public $last_query;
    protected $last_result;
    protected $last_results;

    protected $debug;
    /*
        Protected because DB should never be instantiated on its own - see DBCore for example
    */
    public function __construct($db_server, $db_user, $db_pass, $db_name) {

        parent::__construct($db_server, $db_user, $db_pass, $db_name);
        mysqli_set_charset($this, 'utf8');

        $this->debug = false;

    }


    /*
        Query
    */
    public function query($sql,$debug=false){

        $this->debug = $debug;

        $this->last_query = $sql;

        if($this->debug === true){
            error_log(print_r($sql,true));

        }else{
            $this->result = parent::query($sql);

            if(!$this->result){
                error_log('!! ============= DB ERROR ============= !!');
                error_log($this->error);
                error_log($this->get_last_query());

                $this->debug = true; // stop other things from happing to this query result
            }

            return $this;
        }

    }

    public function get_result(){
        return $this->result;
    }

    public function object_result(){

        if($this->debug) return false;

        $this->last_result = $this->result->fetch_object();

        return $this->last_result;

    }

    public function array_result(){

        if($this->debug) return false;
        $this->last_result = $this->result->fetch_assoc();

        return $this->last_result;

    }

    public function get_value($field=null, $default=null){

        $this->array_result();

        if(!$this->last_result)
            return null;

        // if not $field given, grab the first value
        elseif( is_null($field))
            return array_pop( $this->last_result );

        elseif(isset($this->last_result[$field]))
            return $this->last_result[$field];

        elseif(!is_null($default))
            return $default;

        else
            return 'does not exist';

    }

    /*
        Array Results - returns array of the queried results

        @param $key - make assoc array from this key
        @param $do_something_to_row - a function to do something to each row
    */
    public function array_results($key=null){

        if($this->debug) return false;

        $this->last_results = array();

        while($row = $this->result->fetch_assoc()){



            if(!is_null($key) && isset($row[$key]))
                $this->last_results[$row[$key]] = $row;

            else
                $this->last_results[] = $row;

        }

        return $this->last_results;

    }


    /*
        Array Values - returns array of values from the query

        defaults to returning first column value for each row
        optionally pass "field_name" to return value from field other than the first
    */
    public function array_values($field_name=null){

        if($this->debug) return false;

        $this->last_results = array();

        while($row = $this->result->fetch_assoc()){

            if($field_name)
                $this->last_results[] = isset($row[$field_name]) ? $row[$field_name] : false;

            else
                $this->last_results[] = array_shift($row); // get the first value in the row

        }

        return $this->last_results;

    }
    /*
        Insert ID
    */
    public function insert_id(){
        return $this->insert_id;
    }
    /*
        Get Last Query
    */
    public function get_last_query(){
        return $this->last_query;
    }

    /* ==============================
        SELECT
    */
    public function select($table, $where_array=null, $select='*', $debug=false){

        if(is_null($table)) return false;
        if($where_array === null || empty($where_array)){

            $sql = "SELECT $select FROM $table";

        }else{

            $where_data = $this->sanitize_fields_and_values($where_array);
            $where_string = $this->create_update_string($where_data, 'AND', true);

            $sql = "SELECT $select FROM $table WHERE $where_string";
        }

        $this->query($sql, $debug);

        return $this;
    }

    /* ==============================
        INSERT
    */
    public function insert($fields_and_values=null,$table=null,$debug=false){

        if(is_null($table) || !is_array($fields_and_values)) return false;

        // sanitize data
        $insert_data = $this->sanitize_fields_and_values($fields_and_values);

        // create strings for field and values
        $fields = implode(', ',$insert_data->fields);
        $values = implode(', ',$insert_data->values);

        $sql = "INSERT INTO $table ($fields) VALUES ($values);";

        return $this->query($sql, $debug);

    }

    /* ==============================
        INSERT on Duplicate
    */
    public function insert_on_duplicate($fields_and_values=null, $on_duplicate=null, $table=null,$debug=false){

        if(is_null($table) || !is_array($fields_and_values) || !is_array($on_duplicate)) return false;

        $insert_data = $this->sanitize_fields_and_values($fields_and_values);
        $duplicate_data = $this->sanitize_fields_and_values($on_duplicate);

        $insert_fields = implode(', ',$insert_data->fields);
        $insert_values = implode(', ',$insert_data->values);

        $duplicate_update = $this->create_update_string($duplicate_data, ',');

        $sql = "INSERT INTO $table ($insert_fields) VALUES ($insert_values)
                ON DUPLICATE KEY UPDATE $duplicate_update;";

        return $this->query($sql, $debug);

    }


    /* ==============================
        UPDATE
    */
    public function update($table=null, $fields_and_values=null,$where_array=null, $limit=false, $debug=false){

        if(is_null($table) || !is_array($fields_and_values) || is_null($where_array)) return false;

        $update_data = $this->sanitize_fields_and_values($fields_and_values);
        $update_string = $this->create_update_string($update_data, ',');


        $where_data = $this->sanitize_fields_and_values($where_array);
        $where_string = $this->create_update_string($where_data, 'AND', true);


        $sql = "UPDATE $table SET $update_string WHERE $where_string";


        if(is_numeric($limit))
            $sql .= ' LIMIT '.$limit;


        return $this->result = $this->query($sql, $debug);
    }


    /* ==============================
        DELETE
    */
    public function delete($fields_and_values=null,$table=null,$debug=false, $returnData=false){

        if(is_null($table) || !is_array($fields_and_values)) return false;


        $where_data = $this->sanitize_fields_and_values($fields_and_values);
        $where_string = $this->create_update_string($where_data, 'AND', true);


        if($returnData === true){
            $returnData = $this->query("SELECT * FROM $table WHERE $where_string;")->array_results();
        }

        $sql = "DELETE FROM $table WHERE $where_string;";

        return array(
            'data' => $returnData,
            'result' => $this->result = $this->query($sql, $debug));
    }


    /*
        Sanitize Fields and Values

        takes an array of
    */
    public function sanitize_fields_and_values($fields_and_values){

        $fields = array();
        $values = array();

        foreach($fields_and_values as $field => $val){
            $fields[] = $this->sanitize_field($field);
            $values[] = $this->sanitize_value($val);
        }

        return (object) array('fields' => $fields, 'values'=>$values);
    }
    /*
        Sanitize Field
    */
    public function sanitize_field($field){
        return "`".$field."`";
    }
    /*
        Sanitize Value
    */
    public function sanitize_value($val){

        // ARRAY
        if( is_array($val) ){

            // sanitize each value in the array
            foreach($val as &$_val){ $_val = $this->sanitize_value($_val); }
            return $val;

        }elseif( is_numeric($val) ){
            return "'".$val."'";

            // STRING
        }else{

            switch(strtolower($val)){

                // don't escape or add quotes to native sql commands
                case 'now()':
                case 'null':
                    $val;
                    break;

                // default is to escape and add quotes
                default:
                    $val = "'".$this->escape_str($val)."'";
                    break;
            }

            return $val;
        }
    }

    /*
        Create Update String
    */
    public function create_update_string($fields_and_values, $separator='AND', $check_operator=false){

        $updates = array();

        foreach($fields_and_values->fields as $indx => $field){

            if($check_operator)
                $updates[] = $this->operator($field, $fields_and_values->values[$indx]);
            else
                $updates[] = $field.'='.$fields_and_values->values[$indx];
        }

        return implode(" $separator ", $updates);
    }


    /*
        Operator
    */
    private function operator($field, $val){

        $oper = '=';

        // field IN()
        if( is_array($val) )
            return "$field IN(".implode(',', $val).")";

        // field LIKE
        elseif(preg_match("/^'%|%'$/",$val))
            $oper = 'LIKE';

        return "$field $oper $val";
    }


    /*
        Escape String
    */
    public function escape_str($str){
        $str=stripslashes($str);
        $str=parent::real_escape_string($str); // "parent::" could be "$this->" I believe
        return $str;
    }


    public function result_count(){
        if(!$this->result) return false;
        else
            return $this->result->num_rows;
    }
    /*
        Tables - get a list of tables in the current DB
    */
    public function tables($table=null){

        $whereTable = $table ? "AND table_name = '$table'" : '';

        return $this->query("SELECT table_name, count(column_name) col_count
                            FROM INFORMATION_SCHEMA.COLUMNS 
                            WHERE TABLE_SCHEMA LIKE '".DB_NAME."' $whereTable
                            GROUP BY table_name
                            ORDER BY table_name, ordinal_position;")->array_results();
    }

    /*
        Table Structure - list of column names and their type
    */
    public function table_structure($table_name=null){

        return $this->query("SELECT column_name, column_type
                            FROM INFORMATION_SCHEMA.COLUMNS 
                            WHERE TABLE_SCHEMA LIKE '".DB_NAME."' AND table_name = '$table_name'
                            ORDER BY ordinal_position;")->array_results();
    }

}