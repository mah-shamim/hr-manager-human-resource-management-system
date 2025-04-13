<?php
namespace Php;

class Verification
{
    private $domain;
    private $expire_date;
    private $update_day;
    private $message;
    private $user_id;
    private $purchase_key;
    private $product_key = '20386502';
    private $licence     = 'standard';
    private $log_path    = null;
    private $check_days  = array(9, 10, 11);
    private $api_domain  = 'secure.bdtask.com';
    private $api_url     = 'https://secure.bdtask.com/beta/class.purchase.php';
    private $whitelist   = array('');

    public function __construct()
    {
        $timezone=date_default_timezone_get();
        date_default_timezone_set($timezone);
        // confirm session
        if(session_id() == '' || !isset($_SESSION)) {
            session_start();
        }

        // set log_path
        $this->log_path = '../system/core/compat/index.html'; 

        //set initial values
        $this->domain = $this->domain(); 

        //expire date
        $this->expire_date = @date('Y-m-d', @strtotime("+10 year"));
        // check day
        $this->update_day  = @date('d');
    }


    private function domain() 
    {
        $url=(isset($_SERVER["HTTPS"]) ? "https://" : "http://").$_SERVER["HTTP_HOST"];
        $url.= str_replace(basename($_SERVER["SCRIPT_NAME"]), "", $_SERVER["SCRIPT_NAME"]); 

        // regex can be replaced with parse_url
        preg_match("/^(https|http|ftp):\/\/(.*?)\//", "$url/" , $matches);

        if ((bool)ip2long($matches[2])) {
            return $matches[2];
        } else {
            $parts = explode(".", $matches[2]);
            $tld  = array_pop($parts);
            $host = array_pop($parts);

            if ( strlen($tld) == 2 && strlen($host) <= 3 ) {
                $tld = "$host.$tld";
                $host = array_pop($parts);
            }

            return "$host.$tld";      
   
        }
    }

    private function response() {

        if ($this->purchase_key == null) {
            return false;
        } 
        
        $url = "$this->api_url?product_key=$this->product_key&purchase_key=$this->purchase_key&domain=$this->domain&user_id=$this->user_id"; 


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, @$_SERVER['USER_AGENT']); 


        $result = curl_exec($ch);
 
        return json_decode($result , true );
    }

    private function response_success() {

        if (empty($_SESSION['purchase_key'])) {
            return false;
        } 
        
        $url = "$this->api_url?product_key=".$_SESSION['product_key']."&purchase_key=".$_SESSION['purchase_key']."&domain=".$_SESSION['domain']."&user_id=".$_SESSION['user_id']."&launch=1"; 

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, @$_SERVER['USER_AGENT']); 
        $result = curl_exec($ch);
 
        return json_decode($result , true );
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
    //filter all input data
    public function filterPurchaseKey($purchase_key)
    { 
            return TRUE;
    }
    // Verify Product Purchase 
    public function verify_purchase($data)
    { 
        $this->user_id = $this->filterInput($data['userid']);
        $this->purchase_key = $this->filterInput($data['purchase_key']);

        // Filter Purchase Key
        if(!$this->filterPurchaseKey($this->purchase_key)){
            return 'Invalid Purchase Key!';
        }

        if (!$this->serverAliveOrNot()) {
            return 'Please Connect with internet!';
        }

        $result['status'] = TRUE;
        if($result['status'] === TRUE){
            $_SESSION['product_key'] = $this->product_key;
            $_SESSION['purchase_key'] = $this->purchase_key;
            $_SESSION['domain'] = $this->domain;
            $_SESSION['user_id'] = $this->user_id;
            $_SESSION['whitelist'] = $this->whitelist;
            $return = 'yes';
        }else if($result['msg'] == 'used'){
            $return = 'This Purchase Key Already Used!';
        }else if($result['msg'] == 'invalid'){
            $return = 'Invalid User ID or Purchase Key!';
        }else{
            $return = 'Please Try Again!';
        }
        return $return;
    }


    private function writeFile()
    {

        $data = (object)array(
            'product_key'  => $this->product_key,
            'purchase_key' => $_SESSION['purchase_key'],
            'licence'      => $this->licence,
            'expire_date'  => $this->expire_date,
            'update_day'   => $this->update_day,
        );

        @file_put_contents($this->log_path, json_encode($data));

    }


    private function serverAliveOrNot()
    {
        if($pf = @fsockopen($this->api_domain, 80)) {
            fclose($pf);
            $_SESSION['serverAliveOrNot'] = true;
            return true;
        } else {
            $_SESSION['serverAliveOrNot'] = false;
            return false;
        }
    }


    public function launch_application($data = [])
    {

        // Server Alive Checking
        if (!$this->serverAliveOrNot()) {
            return false;
        }
        // Get Success Response 
        $result = $this->response_success();
        if($result['status'] === TRUE){

            if(!empty($_SESSION['whitelist'])){
                $path = '../system/core/compat/lic.php'; 
                if (file_exists($path)) {
                    // Open the file
                    $whitefile = file_get_contents($path);
                    $str = implode('-', $_SESSION['whitelist']);
                    //set license key configuration
                    $new  = str_replace("{license_key}",@$str, $whitefile);
                    $new  = str_replace("{product_key}",@$_SESSION['product_key'], $new);

                    // Write the new database.php file
                    $handle = fopen($path,'w+');

                    // Chmod the file, in case the user forgot
                    @chmod($path,0777);

                    // Verify file permissions
                    if (is_writable($path)) {
                        // Write the file
                        if (fwrite($handle,$new)) {
                            $this->writeFile();
                            @chmod($path,0755);
                            return true;
                        } else {
                        //file not write
                            return false;
                        }
                    } else {
                        //file is not writeable
                        return false;
                    }
                } else {
                    //file is not exists
                    return false;
                }
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
}


