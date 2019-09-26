<?php

class Content_model extends CI_Model
{

    function getItemById($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('items');
    }
    
    function getItems()
    {
        return $this->db->get('items');
    }
    
    function getContent($id, $table)
    {
        $this->db->where('id', $id);
        return $this->db->get($table);
    }
    
    function clone_content($data, $table)
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }
    
    function clone_batch($table, $data)
    {
        $this->db->insert_batch($table, $data);
    }
    
    function getModuleText($contentId)
    {
        $this->db->where('item_id', $contentId);
        return $this->db->get('module_text');
    }
	
	function getModulePdf($contentId)
    {
        $this->db->where('item_id', $contentId);
        return $this->db->get('module_pdf');
    }
	
    function getModuleImage($contentId)
    {
        $this->db->where('item_id', $contentId);
        return $this->db->get('module_image');
    }    
    
    function getModuleVideo($contentId)
    {
        $this->db->where('item_id', $contentId);
        return $this->db->get('module_video');
    }
    
 
    
    
    /*****************************************************************************************************************************************
     * CONTENT MODULES
     *******************************************************************************************************************************************/
    function getModulesText($itemId)
    {
        $this->db->select('module_text.*, "text" as "module_type"');
        $this->db->where('item_id', $itemId);
        return $this->db->get('module_text');
    }
    
    function getModulesImage($itemId)
    {
        $this->db->select('module_image.*, "image" as "module_type"');
        $this->db->where('item_id', $itemId);
        return $this->db->get('module_image');
    }
    
    function getModulesPdf($itemId)
    {
        $this->db->select('module_pdf.*, "pdf" as "module_type"');
        $this->db->where('item_id', $itemId);
        return $this->db->get('module_pdf');
    }
    
    function getModulesHeadline($itemId)
    {
        $this->db->select('module_headline.*, "headline" as "module_type", module_headline.headline_type as htype');
        $this->db->where('item_id', $itemId);
        return $this->db->get('module_headline');
    }
    
    function deleteModules($itemId, $ids, $table)
    {
        $this->db->where('item_id', $itemId);
        $this->db->where_not_in('id', $ids);
        $this->db->delete($table);
    }
    
    function insertModules($data, $table)
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }
    
    function updateModules($data, $id, $table)
    {
        $this->db->where('id', $id);
        $this->db->update($table, $data);
    }
    
    
    
    /*****************************************************************************************************************************************
     * MOSAIC MODULES
     *******************************************************************************************************************************************/
    function getMosaicText($contentId)
    {
        $this->db->select('mosaic_text.*, "text" as "mosaic_type"');
        $this->db->where('item_id', $contentId);
        return $this->db->get('mosaic_text');
    }    
    
    function getMosaicImage($contentId)
    {
        $this->db->select('mosaic_image.*, "image" as "mosaic_type"');
        $this->db->where('item_id', $contentId);
        return $this->db->get('mosaic_image');
    }
    
    
    function deleteMosaicModule($itemId, $ids, $table)
    {
        $this->db->where('item_id', $itemId);
        $this->db->where_not_in('id', $ids);
        $this->db->delete($table);
    }
    
    function insertMosaicModule($data, $table)
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }
    
    function updateMosaicModule($data, $id, $table)
    {
        $this->db->where('id', $id);
        $this->db->update($table, $data);
    }
    
    function cloneMosaicModule($table, $data)
    {
        $this->db->insert_batch($table, $data);
    }
    
     
   


    
    
    
    

    
    
}

?>