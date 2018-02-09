<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller 
{
    protected $is_mobile = NULL;
    protected $is_ipad = NULL;
    protected $auth = NULL;
    public $render = null;
    	
    function __construct()
    {
        parent::__construct();

        $this->load->library('session');
        date_default_timezone_set('Europe/Vienna');
        
        $this->load->helper('besc_helper');
        
        require_once (APPPATH . 'libraries/UnserRender.php');
        require_once (APPPATH . 'libraries/UnserAuth.php');
        
        $this->render = new unserRender();
        $this->auth = new unserAuth();
    }  

   

    private function _setDocumentRoot()
    {
        
         $this->documentRoot = $_SERVER['DOCUMENT_ROOT'];
    }
    
    protected function logged_in()
    {
        return (bool) $this->session->userdata('user_id');
    }

}
