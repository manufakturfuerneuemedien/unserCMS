<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Backend extends MY_Controller 
{
	protected $user;
	protected $base_url;
	protected $module_tables = array();
	

    function __construct()
    {
        parent::__construct();
        
        date_default_timezone_set('Europe/Vienna');
        
		$this->auth->checkAdminLogin();
		
    	$this->load->model('Authentication_model');
    	$this->user = $this->Authentication_model->getAdmindataByID($this->session->userdata('user_id'))->row();
    	$this->load->library('Besc_crud');
    	$this->load->model('Backend_model', 'bm');
    		
    }  

	public function index()
	{
	    $this->render->__renderBackend('backend/home', array());
	}

	/***********************************************************************************
	 * DISPLAY FUNCTIONS
	 **********************************************************************************/	
	
    
    public function uploadFile()
    {
        $filename = $this->input->post('filename');
        $upload_path = $this->input->post('uploadpath');
         
        $error = move_uploaded_file($_FILES['data']['tmp_name'], getcwd() . "/$upload_path/$filename");
         
        echo json_encode
        (
            array
            (
                'error' => $error,
                'success' => true,
                'filename' => $filename
            )
        );
    }
    
    public function upload_image()
    {
        $this->load->helper('besc_helper');
         
        $filename = $_POST['filename'];
        $upload_path = $_POST['uploadpath'];
        if(substr($upload_path, -1) != '/')
            $upload_path .= '/';
         
        $rnd = rand_string(12);
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $serverFile = time() . "_" . $rnd . "." . $ext;
    
        $error = move_uploaded_file($_FILES['data']['tmp_name'], getcwd() . "/$upload_path/$serverFile");
    
        echo json_encode(array('success' => true,
            'path' => getcwd() . "/$upload_path/$serverFile",
            'filename' => $serverFile));
    }
    
	public function upload_pdf()
    {
        $this->load->helper('besc_helper');
         
        $filename = $_POST['filename'];
        $upload_path = $_POST['uploadpath'];
        if(substr($upload_path, -1) != '/')
            $upload_path .= '/';
         
        $rnd = rand_string(12);
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
      //  $serverFile = $filename;
    	$serverFile = time() . "_" . $rnd . "." . $ext;
    	
        $error = move_uploaded_file($_FILES['data']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . $upload_path . $serverFile);
    
        
        echo json_encode(array(
            'success' => true,
            'path' => getcwd() . "/$upload_path/$serverFile",
            'filename' => $serverFile));
    }
	
	
    public function crop_image()
    {
        $filename = $this->input->post('filename');
        $col = $this->input->post('col');
        $ratio = $this->input->post('ratio');
        
        $x1 = intval($this->input->post('x1') * $ratio);
        $y1 = intval($this->input->post('y1') * $ratio);
        $x2 = intval($this->input->post('x2') * $ratio);
        $y2 = intval($this->input->post('y2') * $ratio);
        
        
        $uploadpath = $this->input->post('uploadpath');
         
        if(substr($uploadpath, -1) != '/')
            $uploadpath .= '/';
        
        $width = $x2-$x1;
        $height = $y2-$y1;
         
        $new_img = imagecreatetruecolor( $width, $height );
        $col=imagecolorallocatealpha($new_img,255,255,255,127);
        imagefill($new_img, 0, 0, $col);
         
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
         
        switch($ext)
        {
            case 'png':
                $img = imagecreatefrompng(getcwd() . '/' . $uploadpath . $filename);
                break;
            case 'jpg':
            case 'jpeg':
                $img = imagecreatefromjpeg(getcwd() . '/' . $uploadpath . $filename);
                break;
        }
         
        imagecopyresampled($new_img, $img, 0, 0, $x1, $y1, $width, $height, $width, $height);
        imagepng($new_img, getcwd() . '/' . "$uploadpath/$filename");
         
        echo json_encode(array(
            'success' => true,
            'filename' => $filename,
        ));
    }

}
