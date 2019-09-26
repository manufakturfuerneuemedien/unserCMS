<?php

class Settings_model extends CI_Model
{
    function getSubsites()
    {
        $this->db->order_by('name', 'asc');
        return $this->db->get('subsite');
    }
    
    function getMainmenuById($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('mainmenu_item');
    }
}

?>