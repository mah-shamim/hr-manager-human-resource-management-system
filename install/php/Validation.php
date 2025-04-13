<?php 
namespace Php;
class Validation  
{

    //validate post data
    public function run($data = [])
    {  

        $message = null;
        $token   = false;

        //server requiest post
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if (hash_equals($this->get_purchase_data('flag','_token'), $_POST['_token'])) {
                $token = true; //set token is true
            } else {
                $message .= "<li>Mismatch token!</li>";
            }

            // validation for each posted data
            $database = $this->filterInput('Database Name', $data['database']);
            $username = $this->filterInput('Username', $data['username']);
            $password = $this->filterPassword('Password', $data['password']);
            $hostname = $this->requiredInput('Host Name', $data['hostname']);

            //if $database, $username, $password and $hostname contain string data then set it as error message
            if (is_string($database)) {
                $message .= "<li>$database</li>";
            }
            if (is_string($username)) {
                $message .= "<li>$username</li>";
            }
            if (is_string($password)) {
                $message .= "<li>$password</li>";
            }
            if (is_string($hostname)) {
                $message .= "<li>$hostname</li>";
            }

            //if return true 
            if ($database === true 
                && $username === true 
                && $password === true 
                && $hostname === true
                && $token    === true
            ) { 
                return true;
            } 

        } else {
            $message .= "<li>Please fillup all required fields*</li>";
        }
        return $message;
    }

    //validate get data
    public function validate($data = [])
    {  

        $message = null;
        $token   = false;

        //server requiest post
        if ($_SERVER["REQUEST_METHOD"] == "GET") {

            // Csrf token validation
            if (hash_equals($this->get_purchase_data('flag','_token'), $_GET['_token'])) {
                $token = true; //set token is true
            } else {
                $message .= "<li>Mismatch token!</li>";
            }

            // validation for each posted data
            $userid = $this->filterInput('User ID', $data['userid']);
            $purchase_key = $this->filterInput('Purchase Key', $data['purchase_key']);


            if (is_string($userid)) {
                $message .= "<li>$userid</li>";
            }
            if (is_string($purchase_key)) {
                $message .= "<li>$purchase_key</li>";
            }


            if($userid && $purchase_key && $token === TRUE){
                $message = true;
            }

        } else {
            $message .= "<li>Please fillup all required fields*</li>";
        }
        return $message;
    }

    //validate login data
    public function validate_login($data = [])
    {  

        $message = null;
        $token = null;

        //server requiest post
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

             // Csrf token validation
            if (hash_equals($this->get_purchase_data('flag','_token'), $_POST['_token'])) {
                $token = true; //set token is true
            } else {
                $message .= "<li>Mismatch token!</li>";
            }

            // validation for each posted data
            $email = $this->filterInput('Email ', $data['email']);
            $password = $this->filterInput('Password', $data['password']);


            if (is_string($email)) {
                $message .= "<li>$email</li>";
            }
            if (is_string($password)) {
                $message .= "<li>$password</li>";
            }


            if($email && $password && $token === TRUE){
                $message = true;
            }

        } else {
            $message .= "<li>Please fillup all required fields*</li>";
        }
        return $message;
    }


    //filter all input data
    public function filterInput($title = null, $data = null)
    { 
        //if not empty posted data
        if (!empty($data)) { 
            $data = trim($data);
            $data = filter_var($data, FILTER_SANITIZE_STRING);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);

            // check if name only contains letters and numbers
            if (!preg_match("/^[A-Za-z0-9_-]+$/", $data)) {
                return "{$title} only alphabet, numbers and underscores may have";
            }else{
                //check first letter is number
                if (is_numeric(substr($data, 0, 1))) {
                    return "{$title} first letter must be a character";
                } else {
                    //if first letter is character
                    return true;
                }
            }   
        } else {
            return "This fields are required";
        }
    } 

    //filter all input data
    public function requiredInput($title = null, $data = null)
    { 
        //if not empty posted data
        if (!empty($data)) {  
                return true;
        } else {
            return "$title is required";
        }
    } 

    //filter password with $title and $data
    public function filterPassword($title = null, $data = null)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);  

        //check passwod containt <script> tag
        if (preg_match('<script>', $data)) {
            return "{$title} contains script tag";
        } else {
            return true;
        }
    }


    //check file exists
    public function checkFileExists($file_path = null)
    {
        //check file is exists
        if (file_exists($file_path)) {
            return true;
        } else {
            return false;
        }
    }

    //check .env file exists in Flag direcotry
    public function checkEnvFileExists()
    {
        //check flag/env file is exists
        if (file_exists('flag/env')) {
            //create application launch url
            $root=(isset($_SERVER['HTTPS']) ? "https://" : "http://").$_SERVER['HTTP_HOST'];
            $root.= str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
            $root = str_replace('/install/', '', $root);
            //redirect to application
            header('location: '.$root.'/installer');
        } else {
            //if env file is not exists in sql directory
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
