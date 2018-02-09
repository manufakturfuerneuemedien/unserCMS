<?php defined('BASEPATH') OR exit('No direct script access allowed');

class UnserRender
{
	protected $ci = null;
	protected $fm = null;
	
	function __construct()
	{
	    $this->ci = & get_instance();
	    $this->ci->load->model('Frontend_model', 'fm');
	    $this->ci->load->library('user_agent');
	    $this->fm = $this->ci->fm;
    }	
    
    public function index()
    {
        $data = array();
               
        $this->__render('frontend/home', $data);
    }
    

    protected function __render($view , $content_data)
    {
        $this->ci->load->helper('cookie');
        
        $data = array();
		$this->ci->load->view('frontend/head', $data);
        $this->ci->load->view($view, $content_data);
        $this->ci->load->view('frontend/footer', $data);    
    }
    
    public function __renderBackend($view, $content_data)
    {
        $data = array();
        $data['username'] = UnserAuth::getUser() != null ? UnserAuth::getUser()->username : null;
        $data['additional_css'] = isset($content_data['additional_css']) ? $content_data['additional_css'] : array();
        $data['additional_js'] = isset($content_data['additional_js']) ? $content_data['additional_js'] : array();
        
        $this->ci->load->view('backend/head', $data);
        $this->ci->load->view('backend/menu', $data);
        $this->ci->load->view($view, $content_data);
        $this->ci->load->view('backend/footer', $data);        
    }
    
    public function __renderContent($id, $isBackend = false)
    {
        $this->ci->load->model('entities/Content_model', 'cm');
        
        $data['modules'] = array_merge(array(), $this->ci->cm->getModulesText($id)->result_array());
        $data['modules'] = array_merge($data['modules'], $this->ci->cm->getModulesImage($id)->result_array());
        $data['modules'] = array_merge($data['modules'], $this->ci->cm->getModulesPdf($id)->result_array());
        $data['modules'] = array_merge($data['modules'], $this->ci->cm->getModulesHeadline($id)->result_array());
       
        usort($data['modules'], 'module_cmp');
         
        $i = 0;
        $html = array(
            MODULE_PARENT_BIG => '',
            MODULE_PARENT_SMALL => '',
        );
         
         
       
        foreach($data['modules'] as $module)
        {
            switch($module['module_type'])
            {
                case 'text':
                    $html[$module['parent']] .= $this->ci->load->view('modules/text', array('module' => $module, 'i' => $i++, 'isBackend' => $isBackend), true);
                    break;
                case 'image':
                    $html[$module['parent']] .= $this->ci->load->view('modules/image', array('module' => $module, 'i' => $i++, 'isBackend' => $isBackend), true);
                    break;  
                case 'pdf':
                    $html[$module['parent']] .= $this->ci->load->view('modules/pdf', array('module' => $module, 'i' => $i++, 'isBackend' => $isBackend), true);
                    break;
                case 'headline':
                    $html[$module['parent']] .= $this->ci->load->view('modules/headline', array('module' => $module, 'i' => $i++, 'isBackend' => $isBackend), true);
                    break;                 
            }
        }
        
        return $html;
    }
    
       
    public function content($contentId, $pageType, $data = array(), $parent = null)
    {
        $user = UnserAuth::getUser();
        $this->ci->load->model('entities/Content_model', 'cm');
        
        $data['client'] = $this->fm->getClientById($user->client_id)->row();
        $data['user'] = $user;
        $data['contentId'] = ($parent == null ? $contentId : $parent);
        $data['contentType'] = $pageType;
        $data['ga'] = $this->__getTrackerinfo($contentId, $pageType);
        if($this->__isAllowed(($parent == null ? $contentId : $parent), $user->client_id, $pageType))
        {
            $data['modules'] = array_merge(array(), $this->ci->cm->getModulesText($contentId, $user->active_lang, $pageType)->result_array());
            $data['modules'] = array_merge($data['modules'], $this->ci->cm->getModulesImage($contentId, $user->active_lang, $pageType)->result_array());
            $data['modules'] = array_merge($data['modules'], $this->ci->cm->getModulesMultipleChoice4($contentId, $user->active_lang, $pageType)->result_array());
            $data['modules'] = array_merge($data['modules'], $this->ci->cm->getModulesVideo($contentId, $user->active_lang, $pageType)->result_array());
            $data['modules'] = array_merge($data['modules'], $this->ci->cm->getModulesAccordionStart($contentId, $user->active_lang, $pageType)->result_array());
            $data['modules'] = array_merge($data['modules'], $this->ci->cm->getModulesAccordionEnd($contentId, $user->active_lang, $pageType)->result_array());
            $data['modules'] = array_merge($data['modules'], $this->ci->cm->getModulesSequence($contentId, $user->active_lang, $pageType)->result_array());
            $data['modules'] = array_merge($data['modules'], $this->ci->cm->getModulesAssessment($contentId, $user->active_lang, $pageType)->result_array());
            
            usort($data['modules'], 'module_cmp');
        
            $this->__render('frontend/content', $data);
        }
        else
            redirect(site_url());
    }
    
        
}


