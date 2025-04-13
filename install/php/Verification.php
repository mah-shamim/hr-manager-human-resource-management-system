<?php
namespace Php;
require_once __DIR__.'/Helper.php'; //Include helper
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
    private $api_url     = 'https://secure.bdtask.com/alpha/class.purchasev3.php';
    private $whitelist   = array();

    public function __construct()
    {
        $timezone=date_default_timezone_get();
        date_default_timezone_set($timezone);

        // set log_path
        $this->log_path = '../system/core/compat/index.html'; 

        //set initial values
        $this->domain = $this->domain();
        $this->full_domain = $this->full_domain();
        $this->is_https = is_https() ? "1" : "0";

        //expire date
        $this->expire_date = @date('Y-m-d', @strtotime("+10 year"));
        // check day
        $this->update_day  = @date('d');
    }

    private function domain() 
    {

        $url = (is_https() ? "https://" : "http://").$_SERVER["HTTP_HOST"];
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

    private function full_domain() 
    {
        $url = (is_https() ? "https://" : "http://").$_SERVER["HTTP_HOST"];
        $url.= str_replace(basename($_SERVER["SCRIPT_NAME"]), "", $_SERVER["SCRIPT_NAME"]);
        
        $details = parse_url($url);
        $sub_folders = explode('/',$details['path']);
        
        $full_url = "";
        
        // if install in subfolder then take full_domian with that sub-folder
        if(sizeof($sub_folders) >= 2){
            if($sub_folders[1] == "install"){
                $full_url = $_SERVER["HTTP_HOST"].'/';
            }else{
                $full_url = $_SERVER["HTTP_HOST"].$details['path'];
                $full_url = str_replace("install/","",$full_url);
            }
        }else{
            $full_url = $_SERVER["HTTP_HOST"].'/';
        }

        return $full_url;
    }

    private function response() {

        if ($this->purchase_key == null) {
            return false;
        }
        $url = "$this->api_url?product_key=$this->product_key&purchase_key=$this->purchase_key&domain=$this->domain&full_domain=$this->full_domain&user_id=$this->user_id&http_check=$this->is_https"; 

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_USERAGENT, @$_SERVER['USER_AGENT']); 
        $result = curl_exec($ch);
 
        return json_decode($result , true );
    }

    private function response_success() {

        if (empty(get_purchase_data('flag','purchase_key'))) {
            return false;
        }
        
        $url = "$this->api_url?product_key=".get_purchase_data('flag','product_key')."&purchase_key=".get_purchase_data('flag','purchase_key')."&domain=".get_purchase_data('flag','domain')."&full_domain=".get_purchase_data('flag','full_domain')."&user_id=".get_purchase_data('flag','user_id')."&http_check=".$this->is_https."&launch=1";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_USERAGENT, @$_SERVER['USER_AGENT']); 
        $result = curl_exec($ch);
 
        return json_decode($result , true );
    }

    //filter all input data
    public function filterPurchaseKey($purchase_key)
    { 
		return TRUE;
    }
    // Verify Product Purchase 
    public function verify_purchase($data)
    { 
        $this->user_id = filterInput($data['userid']);
        $this->purchase_key = filterInput($data['purchase_key']);

        set_purchase_data('flag','product_key',$this->product_key);
        set_purchase_data('flag','purchase_key',$this->purchase_key);
        set_purchase_data('flag','domain',$this->domain);
        set_purchase_data('flag','full_domain',$this->full_domain);
        set_purchase_data('flag','user_id',$this->user_id);

        $str_whitelist = implode('-', $this->whitelist);
        set_purchase_data('flag','whitelist',$str_whitelist);

        $return = 'yes';
        return $return;
    }


    private function writeFile()
    {

        $data = (object)array(
            'product_key'  => $this->product_key,
            'purchase_key' => get_purchase_data('flag','purchase_key'),
            'licence'      => $this->licence,
            'expire_date'  => $this->expire_date,
            'update_day'   => $this->update_day,
        );

        @file_put_contents($this->log_path, json_encode($data));

    }


    private function serverAliveOrNot()
    {
        set_purchase_data('flag','serverAliveOrNot',true);
        return true;
    }

    public function get_product_key(){
        return $this->product_key;
    }


    public function launch_application($data = [])
    {
		return true;
    }
}


