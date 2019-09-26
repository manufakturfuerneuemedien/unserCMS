<?php

class User_model extends CI_Model
{
    public function getClients()
    {
        return $this->db->get('client');
    }
    
    public function getClientById($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('client');
    }
    
    function getLanguagesByClientId($id)
    {
        $this->db->select('language.id, language.name');
        $this->db->where('client_id', $id);
        $this->db->from('client_language');
        $this->db->join('language', 'language.id = client_language.language_id');
        return $this->db->get();
    }
    
    function getMetatags()
    {
        return $this->db->get('metatag');
    }
    
    function deleteMenuitems($clientId, $languageId)
    {
        $this->db->where('client_id', $clientId);
        $this->db->where('language_id', $languageId);
        $this->db->delete('menuitem');
    }
    
    function insertMenuitems($batch)
    {
        $this->db->insert_batch('menuitem', $batch);
    }
    
    function getMenuitems($clientId, $languageId)
    {
        $this->db->where('client_id', $clientId);
        $this->db->where('language_id', $languageId);
        return $this->db->get('menuitem');
    }


    public function getUserByID($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('user');
    }
	
	
	public function updateUser($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('user', $data);
    }
}

?>