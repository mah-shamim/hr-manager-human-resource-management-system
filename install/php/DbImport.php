<?php
namespace Php;

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
        // Connect to the database
        @$mysqli = new \mysqli($data['hostname'], $data['username'], $data['password'], '');

        // Check for errors
        if (mysqli_connect_errno()){
            return false;
        }

        // Create the prepared statement
        $createDb = $mysqli->query("CREATE DATABASE IF NOT EXISTS ".$data['database']);

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
        // Connect to the database
        @$mysqli = new \mysqli(
            $data['hostname'],
            $data['username'],
            $data['password'],
            $data['database']
        );

        // Check for errors
        if (mysqli_connect_errno())
            return false;

        // Open the default SQL file
        $query = file_get_contents('sql/install.sql');

        // Execute a multi query
        $multi_query = $mysqli->multi_query($query);
        sleep(5);

        // Close the connection
        $mysqli->close();

         // Store Database information into session
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['hostname'] = $data['hostname'];
        $_SESSION['username'] = $data['username'];
        $_SESSION['password'] = $data['password'];
        $_SESSION['database'] = $data['database'];

        if ($multi_query){
            return true;
        } else {
            return false;
        }
    }

    //filter all input data
    public function filterInput($data = null)
    { 
        //if not empty posted data
        if (!empty($data)) { 
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        return false;
    }

    // Insert Login info
    function insert_login($data = [])
    {

        $email = $this->filterInput($data['email']);
        $password = $this->filterInput($data['password']);

        // Connect to the database
        @$mysqli = new \mysqli(
            $_SESSION['hostname'],
            $_SESSION['username'],
            $_SESSION['password'],
            $_SESSION['database']
        );

        // Check for errors
        if (mysqli_connect_errno())
            return false;

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

}
    