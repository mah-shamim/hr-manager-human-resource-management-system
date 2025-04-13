<?php
namespace Php;
require_once __DIR__.'/Helper.php'; //Include helper

class DbImport 
{ 
     private $table_name = 'user';      //Login Table Name
    private $table_fields = array('email', 'password','is_admin','status'); // Table Field Names
    private $field_values = array('{input}', '{input}',1,1); // Table Field Values

    /* 
    Intruction : 
    ============
    IF YOU HAVE MORE COLUMNS,ADD THE FILED IT IN $table_fields AND THE VALUE IN $field_values BY THE SEQUENCE OF FIELDS.e.g. 
    
    private $table_fields = array('username', 'password', 'user_type', 'status'); 
    private $field_values = array('{input}', '{input}', 1, 1); 

    */
    // Function to the database and tables and fill them with the default data
    function createDatabase($data = [])
    {
        $hostname = filterInput($data['hostname']);
        $username = filterInput($data['username']);
        $password = filterInput($data['password']);
        $database = filterInput($data['database']);

        // Connect to the database
        @$mysqli = new \mysqli($hostname, $username, $password, '');

        // Check for errors
        if (mysqli_connect_errno()){
            return false;
        }
        $database = $mysqli->real_escape_string($database);
        // Create the prepared statement
        $createDb = $mysqli->query("CREATE DATABASE IF NOT EXISTS ".$database);

        // Close the connection
        $mysqli->close();

        if($createDb) {
            return true;
        } else {
            return false;
        }
    }

    // Function to create the tables and fill them with the default data
    function createTables($data = [])
    {
        $hostname = filterInput($data['hostname']);
        $username = filterInput($data['username']);
        $password = filterInput($data['password']);
        $database = filterInput($data['database']);

        // Connect to the database
        @$mysqli = new \mysqli(
            $hostname,
            $username,
            $password,
            $database
        );

        // Check for errors
        if (mysqli_connect_errno())
            return false;

        // Open the default SQL file
        $query = file_get_contents('sql/install.sql');

        // Execute a multi query
        $multi_query = $mysqli->multi_query($query);

        // Close the connection
        $mysqli->close();

         // Store Database information into session
        $this->set_purchase_data('flag','hostname',$data['hostname']);
        $this->set_purchase_data('flag','username',$data['username']);
        $this->set_purchase_data('flag','password',$data['password']);
        $this->set_purchase_data('flag','database',$data['database']);

        if ($multi_query){
            return true;
        } else {
            return false;
        }
    }

    // Insert Login info
    function insert_login($data = [])
    {

        $email = filterInput($data['email']);
        $password = filterInput($data['password']);


        // Connect to the database
        @$mysqli = new \mysqli(
            $this->get_purchase_data('flag','hostname'),
            $this->get_purchase_data('flag','username'),
            $this->get_purchase_data('flag','password'),
            $this->get_purchase_data('flag','database')
        );

        // Check for errors
        if (mysqli_connect_errno())
            return false;

        $email = $mysqli->real_escape_string($email);
        $password = $mysqli->real_escape_string($password);
        $password = md5($password);

        $fields_num = count($this->table_fields);
        $fields = '';
        $values = '';
        for($i=0; $i<$fields_num; $i++){

            $fields .= "`".$this->table_fields[$i]."`,"; // set field values

            if($i==0){

                $values .= "'".$email."',"; // Set Email values

            }else if($i==1){

                 $values .= "'".$password."',"; // Set Password Values

            }else{

                 $values .= ((gettype($this->field_values[$i])=='integer')?$this->field_values[$i]:"'".$this->field_values[$i]."'").",";

            }
        }

        // Make Query
        $query = "INSERT INTO `$this->table_name` (".rtrim($fields,',').") VALUES (".rtrim($values,',').")";
        

        // Run Query
        $insert_query = $mysqli->query($query);

        // Close the connection
        $mysqli->close();

        if ($insert_query){
            return true;
        } else {
            return false;
        }
    }

    function set_purchase_data($path_info = '',$key = '',$value = '') {
        $filePath = $path_info.'/purchase_info.json';
        $infoArray = openJsonFile($filePath);
        if (array_key_exists($key, $infoArray)) {
            $infoArray[$key] = $value;
        } else {
            $infoArray[$key] = $value;
        }

        $jsonData = json_encode($infoArray, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        $respo = file_put_contents($filePath, stripslashes($jsonData));

        return $infoArray[$key];
    }

    function get_purchase_data($path_info = '',$key = '') {
        $filePath = $path_info.'/purchase_info.json';
        $infoArray = openJsonFile($filePath);

        if (array_key_exists($key, $infoArray)) {
            return $infoArray[$key];
        }
        return false;
    }


    function clear_purchase_data($path_info = '') {
        $filePath = $path_info.'/purchase_info.json';
        $infoArray = openJsonFile($filePath);
        
        $infoArray = ['sl' => 1];
        $jsonData = json_encode($infoArray, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        $respo = file_put_contents($filePath, stripslashes($jsonData));
        if($respo){
            return true;
        }
        return false;
    }


    function openJsonFile($filePath)
    {
        @chmod($filePath,0777);
        $jsonString = [];
        if (file_exists($filePath)) {
            $jsonString = file_get_contents($filePath);
            $jsonString = json_decode($jsonString, true);
        }
        return $jsonString;
    }


}
    