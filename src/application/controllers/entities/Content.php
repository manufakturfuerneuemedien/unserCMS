<?php defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH.'controllers/Backend.php');

class Content extends Backend 
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('entities/Content_model', 'em');
    }  

	public function items()
	{
		$bc = new besc_crud();
		$bc->table('items');
		$bc->primary_key('id');
		$bc->title('Item');
		
		$bc->custom_buttons(array(
		    array(
		        'name' => 'Edit content',
                'icon' => site_url('items/backend/img/icon_editcontent.png'),
                'add_pk' => true,
                'url' => 'edit_item'),	   	    
		));
		
				
		$visibleOptions = array(
            array('key' => 0, 'value' => 'Visible'),  
            array('key' => 1, 'value' => 'Hidden'),  
		);

		
		$bc->list_columns(array('name', 'visible'));
		$bc->filter_columns(array('name', 'visible'));

		
		$bc->columns(array
	    (
	        'name' => array
	        (  
	            'db_name' => 'name',
				'type' => 'text',
				'display_as' => 'Name',
	            'validation' => 'required',
	        ),
	        
	        'description' => array
	        (  
	            'db_name' => 'description',
				'type' => 'multiline',
				'height' => 300,
				'display_as' => 'Description',
	        ),
	     
	        'img' => array(
	            'db_name' => 'img',
	            'type' => 'image',
	            'display_as' => 'Test image',
	            'col_info' => 'filetypes: .png, .jpg, .jpeg<br/>1200x500 px',
	            'accept' => '.png,.jpg,.jpeg',
	            'uploadpath' => 'items/uploads/filemanager',
	            'crop' => array(
	                'ratio' => '1200:500',
	                'minWidth' => 600,
	                'minHeight' => 250,
	                'maxWidth' => 2400,
	                'maxHeight' => 1000,
	            ),
	        ),

	        'visible' => array(
	            'db_name' => 'visible',
	            'type' => 'select',
	            'display_as' => 'Visibility',
	            'options' => $visibleOptions,
	        ),

	    ));
		
		$data['crud_data'] = $bc->execute();
		$this->render->__renderBackend('backend/crud', $data);
	}
	
	
	
	
	

	/********************************************************************************************************************************************************************
	 * CONTENT
	 *******************************************************************************************************************************************************************/
	public function edit_item($contentId)
	{
	    $data['content'] = $this->em->getItemById($contentId)->row();
	    $data['module_html'] = $this->render->__renderContent($contentId, true);
	    
	    $data['module_templates']['text'] = $this->load->view('modules/text', array('module' => array('content' => '', 'ordering' => 0, 'id' => 0), 'i' => 0, 'isBackend' => true, ), true);
	    
	    $data['module_templates']['headline'] = $this->load->view('modules/headline', array('module' => array('content' => '', 'ordering' => 0, 'id' => 0, 'htype' => 'small', 'section' => '', 'display_text' => ''), 'i' => 0, 'isBackend' => true, ), true);
	    
	    $data['module_templates']['image'] = $this->load->view('modules/image', array('module' => array('ordering' => 0, 'id' => 0, 'filepath' => '/items/uploads/filemanager/placeholder2.png', 'caption' => '', 'stretch' => true, 'align' => 'center'), 'i' => 0, 'isBackend' => true, ), true);
	     $data['module_templates']['pdf'] = $this->load->view('modules/pdf', array('module' => array('ordering' => 0, 'id' => 0, 'fname' => '', 'text' => '', 'align' => 'center'), 'i' => 0, 'isBackend' => true, ), true);
		
	    $data['crud_data'] = $this->load->view('backend/contenteditor', $data, true);
	    $this->render->__renderBackend('backend/crud', $data);
	}
	
	
	
	
	
}

