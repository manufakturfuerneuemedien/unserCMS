<?php defined('BASEPATH') OR exit('No direct script access allowed');

class UnserAuth extends UnserRender
{
    protected $user = null;
    
	function __construct()
	{
        parent::__construct();
        $this->user = UnserAuth::getUser();
        if($this->user != null)
            $this->loadLang($this->user->active_lang);
        else
            $this->loadLang(1);
    }	
    
    static function getUser()
    {
        $ci = & get_instance();
        $ci->load->model('Authentication_model', 'am');
        if($ci->session->userdata('user_id') != null)
        {
            return $ci->am->getUserdataByID($ci->session->userdata('user_id'))->row();
        }
        else
        {
            return null;
        } 
            
    }
    
    public function user()
    {
        return $this->user;
    }
    
    public function logged_in()
    {
        return $this->user != null;
    }
    
    public function checkUserLogin()
    {
        if(!$this->logged_in())
        {
            $this->ci->session->set_userdata('frink_redirect', current_url());
            redirect('Authentication/login/user');
        }
    }
    
    public function checkAdminLogin()
    {
        if(!$this->logged_in() || !$this->is_admin())
        {
            $this->ci->session->set_userdata('frink_redirect', current_url());
            redirect('Authentication/login/admin');
        }
    }
    
    public function showLogin($type, $errormessage = '')
    {
        $data['type'] = $type;
        $data['errormessage'] = $errormessage;
        if($type == 'user')
            $this->__render('authentication/login', $data);
        else
            $this->__renderBackend('authentication/login', $data);
    }
    
    public function loginUser()
    {
        $username = $this->ci->input->post('username');
        $pword = $this->ci->input->post('pword');
        $pw = $this->ci->am->getUserPW($username);
        if ($pw->num_rows() > 0)
        {
            $pwcheck = $this->__check_hash($pword, $pw->row()->pword);
            if ($pwcheck)
            {
                $userId = $this->ci->am->getUserdataByUsername($username)->row()->id;
                $this->ci->session->set_userdata('user_id', $userId);
                if($this->ci->session->userdata('frink_redirect') !=  null)
                    redirect($this->ci->session->userdata('frink_redirect'));
                else
                    redirect(site_url());
            }
            else
            {
                //$data['errormessage'] = "Password incorrect";
                //$this->__renderBackend('authentication/login', $data);
                $this->showLogin('user', 'Password incorrect');
            }
        }
        else
        {
            //$data['errormessage'] = "User not found";
            //$this->__render('authentication/login', $data);
            $this->showLogin('user', 'User not found');
        }
    }
    
    public function loginAdmin()
    {
        $username = $this->ci->input->post('username');
        $pword = $this->ci->input->post('pword');
        $pw = $this->ci->am->getAdminPW($username);
        if ($pw->num_rows() > 0)
        {
            $pwcheck = $this->__check_hash($pword, $pw->row()->pword);
            if ($pwcheck)
            {
                $userId = $this->ci->am->getUserdataByUsername($username)->row()->id;
                $this->ci->session->set_userdata('user_id', $userId);
                if($this->ci->session->userdata('frink_redirect') !=  null)
                    redirect($this->ci->session->userdata('frink_redirect'));
                else
                    redirect(site_url());
            }
            else
            {
                //$data['errormessage'] = "Password incorrect";
                //$this->ci->load->view('authentication/userlogin', $data);
                //$this->__renderBackend($view, $content_data);
                $this->showLogin('admin', 'Password incorrect');
            }
        }
        else
        {
            //$data['errormessage'] = "User not found";
            //$this->ci->load->view('authentication/userlogin', $data);
            $this->showLogin('admin', 'User not found');
        }
    }
    
    public function logout()
    {
        $this->ci->session->unset_userdata('user_id');
        $this->ci->session->sess_destroy();
        $this->user = null;
        redirect(site_url(''));
    }
    
    
    public function is_admin()
    {
        return $this->user->is_admin == 1;
    }
    
    public function adminLoginView()
    {
        $data = array();
        $this->ci->load->view('authentication/login', $data);
    }
    
    public function adminLogin()
    {
        $username = $this->ci->input->post('username');
        $pword = $this->ci->input->post('pword');
        $pw = $this->ci->am->getAdminPW($username); 
        if ($pw->num_rows() > 0)
        {
            $pwcheck = $this->__check_hash($pword, $pw->row()->pword);
            if ($pwcheck)
            {
                $userId = $this->ci->am->getAdmindataByUsername($username)->row()->id;
                $this->ci->session->set_userdata('user_id', $userId);
                redirect('backend');
            }
            else
            {
                $data['errormessage'] = "Password incorrect";
                $this->ci->load->view('authentication/login', $data);
            }
        }
        else
        {
            $data['errormessage'] = "User not found";
            $this->ci->load->view('authentication/login', $data);
        }        
    }
    
    public function adminLogout()
    {
        $this->ci->session->unset_userdata('user_id');
        $this->ci->session->sess_destroy();
        $this->ci->load->view('authentication/logout', array());
    }
    
    public function adminSettingsView($success)
    {
        $this->ci->load->helper('form');
        $data['success'] = $success;
        $data['user'] = $this->ci->am->getAdmindataByID($this->ci->session->userdata('user_id'))->row();
        $data['username'] = UnserAuth::getUser() != null ? UnserAuth::getUser()->username : null;
        $data['additional_css'] = isset($content_data['additional_css']) ? $content_data['additional_css'] : array();
        $data['additional_js'] = isset($content_data['additional_js']) ? $content_data['additional_js'] : array();
        
        $this->ci->load->view('backend/head', $data);
        $this->ci->load->view('backend/menu', $data);
        $this->ci->load->view('authentication/settings', $data);
        $this->ci->load->view('backend/footer', $data);
    }
    
    public function updateAdmindata()
    {
        $this->ci->load->helper('form');
        $this->ci->load->library('form_validation');
        
        $this->ci->form_validation->set_rules('firstname', 'First name', 'trim|max_length[50]');
        $this->ci->form_validation->set_rules('lastname', 'Last name', 'trim|max_length[50]');
        $this->ci->form_validation->set_rules('email', 'E-Mail', 'trim|max_length[255]|valid_email');
        $this->ci->form_validation->set_rules('pword', 'New password', 'max_length[50]|min_length[8]');
        if($this->ci->input->post('pword') != '' && $this->ci->input->post('pword') != null)
            $this->ci->form_validation->set_rules('pword2', 'Confirm password', 'max_length[50]|matches[pword]|required');
        
        if ($this->ci->form_validation->run() == FALSE)
        {
            $this->ci->load->view('authentication/settings');
        }
        else
        {
            if($this->ci->input->post('userid') == $this->ci->session->userdata('user_id'))
            {
                $user = array(
                    'firstname' => $this->ci->input->post('firstname'),
                    'lastname' => $this->ci->input->post('lastname'),
                    'email' => $this->ci->input->post('email'),
                );
        
                if($this->ci->input->post('pword') != '' &&$this->ci->input->post('pword') != null)
                    $user['pword'] = $this->__createHash($this->ci->input->post('pword'));
                
                $this->ci->am->updateUser($user, $this->ci->session->userdata('user_id'));
        
                $this->adminSettingsView(true);
            }
            else
            {
                $this->adminLogout();
            }
        }
    }
    
    
   
    
    
    public function userLoginView()
    {
        $data = array();
        $this->ci->load->view('authentication/userlogin', $data);
    }
    
    
    
    public function userLogout()
    {
        $this->ci->session->unset_userdata('user_id');
        $this->ci->session->sess_destroy();
        $this->ci->load->view('authentication/logout', array());
    }
    
    public function userSettingsView($success)
    {
        $this->ci->load->helper('form');
        $data['success'] = $success;
        $data['user'] = $this->ci->am->getUserdataByID($this->ci->session->userdata('user_id'))->row();
        $this->ci->load->view('authentication/usersettings', $data);
    }
    
    public function updateUserdata()
    {
        $this->ci->load->helper('form');
        $this->ci->load->library('form_validation');
    
        $this->ci->form_validation->set_rules('firstname', 'First name', 'trim|max_length[50]');
        $this->ci->form_validation->set_rules('lastname', 'Last name', 'trim|max_length[50]');
        $this->ci->form_validation->set_rules('email', 'E-Mail', 'trim|max_length[255]|valid_email');
        $this->ci->form_validation->set_rules('pword', 'New password', 'max_length[50]|min_length[8]');
        if($this->ci->input->post('pword') != '' && $this->ci->input->post('pword') != null)
            $this->ci->form_validation->set_rules('pword2', 'Confirm password', 'max_length[50]|matches[pword]|required');
    
        if ($this->ci->form_validation->run() == FALSE)
        {
            $this->ci->load->view('authentication/usersettings');
        }
        else
        {
            if($this->ci->input->post('userid') == $this->ci->session->userdata('user_id'))
            {
                $user = array(
                    'firstname' => $this->ci->input->post('firstname'),
                    'lastname' => $this->ci->input->post('lastname'),
                    'email' => $this->ci->input->post('email'),
                );
    
                if($this->ci->input->post('pword') != '' &&$this->ci->input->post('pword') != null)
                    $user['pword'] = $this->__createHash($this->ci->input->post('pword'));
    
                $this->ci->am->updateUser($user, $this->ci->session->userdata('user_id'));
    
                $this->userSettingsView(true);
            }
            else
            {
                $this->userLogout();
            }
        }
    }
    
    public function switchLanguage($langId, $echo = true)
    {
        $this->fm->updateUserById($this->user->id, array('active_lang' => $langId));
        $this->user->active_lang = $langId;
        if($echo)
        {
            echo json_encode(array(
                'success' => true,
            ));
        }
    }
    
    public function loadLang($lang)
    {
        switch($lang)
        {
            case 2:
                $this->ci->lang->load('frontend', 'german');
                break;
            case 1:
                $this->ci->lang->load('frontend', 'english');
                break;
            case 3:
                $this->ci->lang->load('frontend', 'french');
                break;
        }
        
    }
    
    
    public function __check_hash($hash, $stored_hash)
    {
        require_once (APPPATH . 'libraries/PasswordHash.php');
        $hasher = new PasswordHash(8, false);
        return $hasher->CheckPassword($hash, $stored_hash);
    }
    
    public function __createHash($hash)
    {
        require_once(APPPATH.'libraries/PasswordHash.php');
        $hasher = new PasswordHash(8, false);
        return $hasher->HashPassword($hash);
    }
    
}


