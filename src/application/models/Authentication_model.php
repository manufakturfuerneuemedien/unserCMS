<?php

class Authentication_model extends CI_Model
{
    function getAdminPW($username)
    {
        $this->db->where('username', $username);
        $this->db->where('is_admin', 1);
        $this->db->select('pword');
        return $this->db->get('user');
    }

    function getAdmindataByUsername($username)
    {
        $this->db->where('username', $username);
        $this->db->where('is_admin', 1);
        return $this->db->get('user');
    }

    function getAdmindataByID($id)
    {
        $this->db->where('id', $id);
        $this->db->where('is_admin', 1);
        return $this->db->get('user');
    }
    
    function updateUser($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('user', $data);
    }
    
    
    
    function getUserPW($username)
    {
        $this->db->where('username', $username);
        $this->db->select('pword');
        return $this->db->get('user');
    }
    
    function getUserdataByUsername($username)
    {
        $this->db->where('username', $username);
        return $this->db->get('user');
    }
    
    function getUserdataByID($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('user');
    }
    
}

?>