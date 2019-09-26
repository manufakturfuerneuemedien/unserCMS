<?php defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH.'controllers/Backend.php');

class Settings extends Backend 
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('entities/Settings_model', 'em');
    }  

	public function home()
	{
	    $subsites = array();
	    $subsites[] = array(
	        'key' => -1,
	        'value' => 'No link',
	    );
	    foreach($this->em->getSubsites()->result() as $s)
	    {
	        $subsites[] = array(
	            'key' => $s->id,
	            'value' => $s->name,
	        );
	    }
	    
	    $bc = new besc_crud();
		$bc->table('home');
		$bc->primary_key('id');
		$bc->title('Landing page settings');
		$bc->unset_add();
		$bc->unset_delete();
		$bc->columns(array
	    (
	     
	        
	        'slider_timer' => array(
	            'db_name' => 'slider_timer',
	            'type' => 'text',
	            'col_info' => 'Auto scroll timer in seconds. Set to 0 for no auto scrolling',
	            'display_as' => 'Slider timer',
	        ),
	        
	        'tip1_text' => array(
	            'db_name' => 'tip1_text',
	            'type' => 'ckeditor',
	            'display_as' => 'Header text',
	            'height' => 200,
	        ),
	        
	        'tip1_subsite' => array
	        (
	            'db_name' => 'tip1_subsite',
	            'type' => 'select',
	            'display_as' => 'Header subsite link',
	            'options' => $subsites,
	        ),
	        
	        'tip2_text' => array(
	            'db_name' => 'tip2_text',
	            'type' => 'ckeditor',
	            'display_as' => 'Header text',
	            'height' => 200,
	        ),
	         
	        'tip2_subsite' => array
	        (
	            'db_name' => 'tip2_subsite',
	            'type' => 'select',
	            'display_as' => 'Header subsite link',
	            'options' => $subsites,
	        ),
	        
	        'tip3_text' => array(
	            'db_name' => 'tip3_text',
	            'type' => 'ckeditor',
	            'display_as' => 'Header text',
	            'height' => 200,
	        ),
	         
	        'tip3_subsite' => array
	        (
	            'db_name' => 'tip3_subsite',
	            'type' => 'select',
	            'display_as' => 'Header subsite link',
	            'options' => $subsites,
	        ),	        
	        
		));
		
		$data['crud_data'] = $bc->execute();
		$this->render->__renderBackend('backend/crud', $data);
	}
	
	
	
	public function slider()
	{
	    $subsites = array();
	    $subsites[] = array(
	        'key' => -1,
	        'value' => 'No link',
	    );
	    foreach($this->em->getSubsites()->result() as $s)
	    {
	        $subsites[] = array(
	            'key' => $s->prettyurl,
	            'value' => $s->name,
	        );
	    }
	    
	    $selector = array();
	    $selector[] = array(
	        'key' => 0,
	        'value' => 'NO',
	    );
	    
	    $selector[] = array(
	        'key' => 1,
	        'value' => 'YES',
	    );
	    
	    $bc = new besc_crud();
		$bc->table('slider_items');
		$bc->primary_key('id');
		$bc->title('Slide');
		
		$bc->columns(array
	    (
	        'image' => array(
	            'db_name' => 'image',
	            'type' => 'image',
	            'display_as' => 'Header image',
	            'col_info' => 'filetypes: .png, .jpg, .jpeg<br/>770x500 px',
	            'accept' => '.png,.jpg,.jpeg',
	            'uploadpath' => 'items/uploads/header',
	            'validation' => 'required',
	            'crop' => array(
	                'ratio' => '770:500',
	                'minWidth' => 770,
	                'minHeight' => 500,
	                'maxWidth' => 1540,
	                'maxHeight' => 1000,
	            ),
	        ),
	        
	        'text' => array(
	            'db_name' => 'text',
	            'type' => 'ckeditor',
	            'display_as' => 'Header text',
	            'height' => 400,
	        ),
	        
	        'link' => array
	        (
	            'db_name' => 'link',
	            'type' => 'select',
	            'display_as' => 'Subsite link',
	            'options' => $subsites,
	        ),
	        
	        'link_text' => array(
	            'db_name' => 'link_text',
	            'type' => 'text',
	            'display_as' => 'Subsite text',
	        ),
	        
	        'visible' => array
	        (
	            'db_name' => 'visible',
	            'type' => 'select',
	            'display_as' => 'Visible',
	            'options' => $selector,
	        ),
	        
	        'ordering' => array(
	            'db_name' => 'ordering',
	            'type' => 'text',
	            'display_as' => 'Ordering',
	        ),
	         
	        
		));
		
		$data['crud_data'] = $bc->execute();
		$this->render->__renderBackend('backend/crud', $data);
	}
}
