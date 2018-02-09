<?php defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH.'controllers/Backend.php');

class Menu extends Backend 
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('entities/Settings_model', 'em');
    }  

	public function mainmenu()
	{
	    $bc = new besc_crud();
	    $bc->table('mainmenu_item');
	    $bc->primary_key('id');
	    $bc->title('Mainmenu');
	    
	    $bc->list_columns(array('name', 'image', 'pretty_url'));
	    $bc->filter_columns(array('name'));
	    
	    $bc->where('pos = ' . MENU_TOP);
		$bc->ordering(array(
            'ordering' => 'priority',
		    'value' => 'name',
		));
		
		$bc->custom_buttons(array(
		    array(
		        'name' => 'Edit submenu',
		        'icon' => site_url('items/backend/img/icon_editcontent.png'),
		        'add_pk' => true,
		        'url' => 'submenu'),
		));
		
		$subsites = $this->em->getSubsites()->result();
		$subsites_array = array();
		
		foreach($subsites as $sub)
		{
			$subsites_array[] = array('key' => $sub->prettyurl, 'value' => $sub->name);
		}
		
		$bc->unset_add();
		$bc->unset_delete();
	    $bc->columns(array
        (
            'name' => array
            (
                'db_name' => 'name',
                'type' => 'text',
                'display_as' => 'Name',
                'validation' => 'required',
            ),
            
            'image' => array(
                'db_name' => 'image',
                'type' => 'image',
                'display_as' => 'Menu image',
                'col_info' => 'filetypes: .png, .jpg, .jpeg<br/>600x500 px',
                'accept' => '.png,.jpg,.jpeg',
                'uploadpath' => 'items/uploads/menu',
                'validation' => 'required',
                'crop' => array(
                    'ratio' => '600:500',
                    'minWidth' => 600,
                    'minHeight' => 500,
                    'maxWidth' => 1200,
                    'maxHeight' => 1000,
                ),
            ),
            
            'pretty_url' => array(
	            'db_name' => 'pretty_url',
	            'type' => 'select',
	            'display_as' => 'Link to',
	            'options' => $subsites_array,
	        ),
             
        ));
	    
	    
	
	    $data['crud_data'] = $bc->execute();
		$this->render->__renderBackend('backend/crud', $data);
	}
	
	
	public function submenu($mainmenu_id)
	{
	    $subsites = array();
	    foreach($this->em->getSubsites()->result() as $s)
	    {
	        $subsites[] = array(
	            'key' => $s->id,
	            'value' => $s->name,
	        );
	    }
	    
	    $bc = new besc_crud();
	    $bc->table('submenu_item');
	    $bc->primary_key('id');
	    $bc->title('Submenu: ' . $this->em->getMainmenuById($mainmenu_id)->row()->name);
	     
	    $bc->list_columns(array('name', 'isHeadline'));
	    $bc->filter_columns(array('name'));
	     
	    $bc->where('mainmenu_id = ' . $mainmenu_id);
	    $bc->ordering(array(
	        'ordering' => 'pos',
	        'value' => 'name',
	    ));
	
	    $bc->columns(array
        (
            'name' => array
            (
                'db_name' => 'name',
                'type' => 'text',
                'display_as' => 'Name',
                'validation' => 'required',
            ),
            
            'subsite_id' => array
            (
                'db_name' => 'subsite_id',
                'type' => 'select',
                'display_as' => 'Subsite',
                'options' => $subsites,
            ),
			
			'section_link' => array
            (
                'db_name' => 'section_link',
                'type' => 'text',
                'display_as' => 'Section link',

            ),
			
            'isHeadline' => array
            (
                'db_name' => 'isHeadline',
                'type' => 'select',
                'display_as' => 'is Headline',
                'options' => array(
                    array('key' => 0, 'value' => 'No'),
                    array('key' => 1, 'value' => 'Yes'),
                ),
            ),
            
            'mainmenu_id' => array
            (
                'db_name' => 'mainmenu_id',
                'type' => 'hidden',
                'value' => $mainmenu_id,
            ),
             
        ));
	     
	     
	
	    $data['crud_data'] = $bc->execute();
	    $this->render->__renderBackend('backend/crud', $data);
	}	
	
	public function footermenu()
	{
	    $bc = new besc_crud();
	    $bc->table('mainmenu_item');
	    $bc->primary_key('id');
	    $bc->title('Mainmenu');
	     
	    $bc->list_columns(array('name', 'image'));
	    $bc->filter_columns(array('name'));
	     
	    $bc->where('pos = ' . MENU_BOTTOM);
	    $bc->ordering(array(
	        'ordering' => 'priority',
	        'value' => 'name',
	    ));
	
	    $bc->custom_buttons(array(
	        array(
	            'name' => 'Edit submenu',
	            'icon' => site_url('items/backend/img/icon_editcontent.png'),
	            'add_pk' => true,
	            'url' => 'footermenu_submenu'),
	    ));
	
	
	    $bc->columns(array
	        (
	            'name' => array
	            (
	                'db_name' => 'name',
	                'type' => 'text',
	                'display_as' => 'Name',
	                'validation' => 'required',
	            ),
	            
	            'text' => array
	            (
	                'db_name' => 'text',
	                'type' => 'multiline',
	                'display_as' => 'Text',
	                'height' => 60,
	            ),
	             
	        ));
	     
	     
	
	    $data['crud_data'] = $bc->execute();
	    $this->render->__renderBackend('backend/crud', $data);
	}
	
	public function footermenu_submenu($mainmenu_id)
	{
	    $subsites = array();
	    foreach($this->em->getSubsites()->result() as $s)
	    {
	        $subsites[] = array(
	            'key' => $s->id,
	            'value' => $s->name,
	        );
	    }
	     
	    $bc = new besc_crud();
	    $bc->table('submenu_item');
	    $bc->primary_key('id');
	    $bc->title('Submenu: ' . $this->em->getMainmenuById($mainmenu_id)->row()->name);
	
	    $bc->list_columns(array('name', 'isHeadline'));
	    $bc->filter_columns(array('name'));
	
	    $bc->where('mainmenu_id = ' . $mainmenu_id);
	    $bc->ordering(array(
	        'ordering' => 'pos',
	        'value' => 'name',
	    ));
	
	    $bc->columns(array
	        (
	            'name' => array
	            (
	                'db_name' => 'name',
	                'type' => 'text',
	                'display_as' => 'Name',
	                'validation' => 'required',
	            ),
	
	            'subsite_id' => array
	            (
	                'db_name' => 'subsite_id',
	                'type' => 'select',
	                'display_as' => 'Subsite',
	                'options' => $subsites,
	            ),
	
	            'isHeadline' => array
	            (
	                'db_name' => 'isHeadline',
	                'type' => 'select',
	                'display_as' => 'is Headline',
	                'options' => array(
	                    array('key' => 0, 'value' => 'No'),
	                    array('key' => 1, 'value' => 'Yes'),
	                ),
	            ),
	
	            'mainmenu_id' => array
	            (
	                'db_name' => 'mainmenu_id',
	                'type' => 'hidden',
	                'value' => $mainmenu_id,
	            ),
	             
	        ));
	
	
	
	    $data['crud_data'] = $bc->execute();
	    $this->render->__renderBackend('backend/crud', $data);
	}	
}
