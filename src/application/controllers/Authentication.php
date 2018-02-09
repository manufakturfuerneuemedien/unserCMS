<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Authentication extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Authentication_model', 'am');
    }

    public function login($type)
    {
        $this->auth->showLogin($type);
    }
    
    public function loginUser()
    {
        $this->auth->loginUser();
    }
    
    public function loginAdmin()
    {
        $this->auth->loginAdmin();
    }
    
    public function logout()
    {
        $this->auth->logout();
    }
    

    public function adminLogin()
    {
        $this->auth->adminLogin();
    }

    public function adminLogout()
    {
        $this->auth->adminLogout();
    }
    
    public function showAdminLogin()
    {
        $this->auth->adminLoginView();
    }
    
    public function adminsettings($success = false)
    {
        $this->auth->adminSettingsView($success);
    }
    
    public function updateAdmin()
    {
        $this->auth->updateAdmindata();
    }
    
  
    
    
    public function userLogin()
    {
        $this->auth->userLogin();
    }
    
    public function userLogout()
    {
        $this->auth->userLogout();
    }
    
    public function showUserLogin()
    {
        $this->auth->userLoginView();
    }
    
    public function usersettings($success = false)
    {
        $this->auth->userSettingsView($success);
    }
    
    public function updateUser()
    {
        $this->auth->updateUserdata();
    }
    
}

/* End of file authentication.php */
/* Location: ./application/controllers/authentication.php */