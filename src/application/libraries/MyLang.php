<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MyLang
{
    public static function langString($string_identifier)
    {
        $ci = & get_instance();
        $ci->load->model('Lang_model');
        $lang = MyAuth::getUser() != null ? MyAuth::getUser()->active_lang : 1;
        return $ci->Lang_model->getLangString($string_identifier, $lang)->row_array()[$string_identifier];
    }
}


