<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Frontend extends MY_Controller 
{
    function __construct()
    {
        parent::__construct();
        
        $this->load->model('Frontend_model', 'fm');
        $this->load->helper('besc_helper');
        
    }    
    
	public function index()
	{
        $this->render->index(); 
	}
    
}

