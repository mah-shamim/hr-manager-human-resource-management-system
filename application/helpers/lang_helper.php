<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/*
*
* ---------------how to use-----------------
* ------------------------------------------
* Developed by <sourav.diubd@gmail.com>
*
* $autoload['helper'] =  array('lang');

* display a language
* echo display('helloworld'); 

* display language list
* $lang = languageList(); 
* ------------------------------------------
*
*/


if (!function_exists('display')) {

    function display($text = null)
    {
        $ci =& get_instance();
        $ci->load->database();
        $table  = 'language';
        $phrase = 'phrase';
        $setting_table = 'setting';
        $default_lang  = 'english';

        //set language  
        $data = $ci->db->get($setting_table)->row();
        if (!empty($data->language)) {
            $language = $data->language; 
        } else {
            $language = $default_lang; 
        } 
 
        if (!empty($text)) {

            if ($ci->db->table_exists($table)) { 

                if ($ci->db->field_exists($phrase, $table)) { 

                    if ($ci->db->field_exists($language, $table)) {

                        $row = $ci->db->select($language)
                              ->from($table)
                              ->where($phrase, $text)
                              ->get()
                              ->row(); 

                        if (!empty($row->$language)) {
                            return $row->$language;
                        } else {
                            return false;
                        }

                    } else {
                        return false;
                    }

                } else {
                    return false;
                }

            } else {
                return false;
            }            
        } else {
            return false;
        }  

    }
 
}

if (!function_exists('addActivityLog')) {

    // $status 1=create, 2=update, 3=delete

    function addActivityLog($type, $action_name, $id, $table, $status=0, $data = null){

        $ci =& get_instance();
        $ci->load->database();

        $postData = (empty($_POST))?array():$_POST;
        $actionData = array(
          'user_id'   => $ci->session->userdata('id'),
          'type'      => $type, 
          'action'    => $action_name, 
          'action_id' => $id, 
          'table_name'=>$table,
          'slug'      => uri_string(),
          'form_data' => ($data==null)?json_encode($postData):json_encode($data),
          'status'    => $status
        );

        $ci->db->insert('activity_logs',$actionData);

    }

}


