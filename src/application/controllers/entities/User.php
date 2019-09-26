<?php defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH.'controllers/Backend.php');

class User extends Backend 
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('entities/User_model', 'em');
    }  

	public function items()
	{
	    $bc = new besc_crud();
	    $bc->table('user');
	    $bc->primary_key('id');
	    $bc->title('User');
	    
	    
	    $bc->order_by_field('username');
	    $bc->order_by_direction('asc');
	    
	    $bc->list_columns(array('username', 'firstname', 'lastname', 'email'));
	    $bc->filter_columns(array('username', 'firstname', 'lastname', 'email'));
	    
		$bc->custom_buttons(array(
		    array(
		        'name' => 'Send new password',
                'icon' => site_url('items/backend/img/icon_editcontent.png'),
                'add_pk' => true,
                'url' => 'send_password'),
		        
		));
			   
	    
	    $bc->columns(array
	        (
	           
	            
	            'username' => array(
	                'db_name' => 'username',
	                'type' => 'text',
	                'display_as' => 'Username',
	                'validation' => 'required|is_unique[user.username]|max_length[255]',
	            ),
	             
	            'firstname' => array(
	                'db_name' => 'firstname',
	                'type' => 'text',
	                'display_as' => 'Firstname',
	                'validation' => 'max_length[255]',
	            ),
	             
	            'lastname' => array(
	                'db_name' => 'lastname',
	                'type' => 'text',
	                'display_as' => 'Lastname',
	                'validation' => 'max_length[255]',
	            ),
	             
	            'email' => array(
	                'db_name' => 'email',
	                'type' => 'text',
	                'display_as' => 'E-mail',
	                'validation' => 'required|is_unique[user.email]|valid_email|max_length[255]',
	            ),
	            
	            'client_id' => array(
	                'db_name' => 'client_id',
	                'type' => 'hidden',
	                'display_as' => 'Client',
	                'validation' => 'required',
	                'value' => 2,
	            ),
	            
	            'is_admin' => array(
	                'db_name' => 'is_admin',
	                'type' => 'hidden',
	                'value' => 1,
	            ),
	             
	            
	            
	            'active_lang' => array(
	                'db_name' => 'active_lang',
	                'type' => 'hidden',
	                'value' => 1,
	            ),
	             
	        ));
	    
	    $data['crud_data'] = $bc->execute();
		$this->render->__renderBackend('backend/crud', $data);
	}	
	public function user()
	{
	    $bc = new besc_crud();
	    $bc->table('user');
	    $bc->primary_key('id');
	    $bc->title('User');
	    
	    $bc->where('is_admin = 0');
	    
	    $bc->order_by_field('username');
	    $bc->order_by_direction('asc');
	    
	    $bc->list_columns(array('username', 'firstname', 'lastname', 'email', 'client_id'));
	    $bc->filter_columns(array('username', 'firstname', 'lastname', 'email', 'client_id'));
	    
	    $clients = array();
	    foreach($this->em->getClients()->result() as $client)
	    {
	        $clients[] = array(
                'key' => $client->id,
	            'value' => $client->name,    
	        );
	    }
	    
	    $bc->columns(array
	        (
	           
	            
	            'username' => array(
	                'db_name' => 'username',
	                'type' => 'text',
	                'display_as' => 'Username',
	                'validation' => 'required|is_unique[user.username]|max_length[255]',
	            ),
	             
	            'firstname' => array(
	                'db_name' => 'firstname',
	                'type' => 'text',
	                'display_as' => 'Firstname',
	                'validation' => 'max_length[255]',
	            ),
	             
	            'lastname' => array(
	                'db_name' => 'lastname',
	                'type' => 'text',
	                'display_as' => 'Lastname',
	                'validation' => 'max_length[255]',
	            ),
	             
	            'email' => array(
	                'db_name' => 'email',
	                'type' => 'text',
	                'display_as' => 'E-mail',
	                'validation' => 'required|is_unique[user.email]|valid_email|max_length[255]',
	            ),
	            
	            'client_id' => array(
	                'db_name' => 'client_id',
	                'type' => 'combobox',
	                'display_as' => 'Client',
	                'options' => $clients,
	                'validation' => 'required',
	            ),
	            
	            'is_admin' => array(
	                'db_name' => 'is_admin',
	                'type' => 'hidden',
	                'value' => 0,
	            ),
	             
	            'pword' => array(
	                'db_name' => 'pword',
	                'type' => 'hidden',
	                'value' => $this->auth->__createHash('start'),
	            ),
	            
	            'active_lang' => array(
	                'db_name' => 'active_lang',
	                'type' => 'hidden',
	                'value' => 0,
	            ),
	             
	        ));
	    
	    $data['crud_data'] = $bc->execute();
		$this->render->__renderBackend('backend/crud', $data);
	}
	
	public function admin()
	{
	    $bc = new besc_crud();
	    $bc->table('user');
	    $bc->primary_key('id');
	    $bc->title('Administrator');
	     
	    $bc->where('is_admin = 1');
	     
	    $bc->order_by_field('username');
	    $bc->order_by_direction('asc');
	    
	    $bc->list_columns(array('username', 'firstname', 'lastname', 'email', 'client_id'));
	    $bc->filter_columns(array('username', 'firstname', 'lastname', 'email', 'client_id'));
	     
	    $clients = array();
	    foreach($this->em->getClients()->result() as $client)
	    {
	        $clients[] = array(
	            'key' => $client->id,
	            'value' => $client->name,
	        );
	    }
	     
	    $bc->columns(array
	        (
	            
	            
	            'username' => array(
	                'db_name' => 'username',
	                'type' => 'text',
	                'display_as' => 'Username',
	                'validation' => 'required|is_unique[user.username]|max_length[255]',
	            ),
	            
	            
	
	            'firstname' => array(
	                'db_name' => 'firstname',
	                'type' => 'text',
	                'display_as' => 'Firstname',
	                'validation' => 'max_length[255]',
	            ),
	
	            'lastname' => array(
	                'db_name' => 'lastname',
	                'type' => 'text',
	                'display_as' => 'Lastname',
	                'validation' => 'max_length[255]',
	            ),
	
	            'email' => array(
	                'db_name' => 'email',
	                'type' => 'text',
	                'display_as' => 'E-mail',
	                'validation' => 'required|is_unique[user.email]|valid_email|max_length[255]',
	            ),
	             
	            'client_id' => array(
	                'db_name' => 'client_id',
	                'type' => 'combobox',
	                'display_as' => 'Client',
	                'options' => $clients,
	                'validation' => 'required',
	            ),
	            
	            'is_admin' => array(
	                'db_name' => 'is_admin',
	                'type' => 'hidden',
	                'value' => 1,
	            ),
	            
	            'pword' => array(
	                'db_name' => 'pword',
	                'type' => 'hidden',
	                'value' => $this->auth->__createHash('start'),
	            ),
	             
	            'active_lang' => array(
	                'db_name' => 'active_lang',
	                'type' => 'hidden',
	                'value' => 0,
	            ),

	            
	
	        ));
	     
	    $data['crud_data'] = $bc->execute();
		$this->render->__renderBackend('backend/crud', $data);
	}
	
	
	public function edit_menu($clientId, $language = NULL)
	{
	    $data['client'] =  $this->em->getClientById($clientId)->row();
	    $data['languages'] = $this->em->getLanguagesByClientId($clientId);
	    $data['currentLang'] = $language == NULL ? $data['languages']->row()->id : $language;
	    $data['metatags'] = $this->em->getMetatags();
	    $data['menuItems'] = $this->em->getMenuitems($clientId, $data['currentLang']);
	    $data['clients'] = $this->em->getClients();
	    
	    $data['crud_data'] = $this->load->view('backend/edit_menu', $data, true);
	    $this->render->__renderBackend('backend/crud', $data);
	}
	
	public function save_menu()
	{
	    $clientId = $this->input->post('client_id');
	    $languageId = $this->input->post('language_id');
	    
	    $this->em->deleteMenuitems($clientId, $languageId);
	    
	    if($this->input->post('menuitems') != null)
	    {
	        $batch = array();
	        foreach($this->input->post('menuitems') as $menuitem)
	        {
	            $batch[] = array(
                    'client_id' => $clientId,
	                'language_id' => $languageId,
	                'metatag_id' => $menuitem['metatag_id'] == 0 ? null : $menuitem['metatag_id'],
	                'name' => $menuitem['name'],
	                'ordering' => $menuitem['ordering'],
	            );
	        }
	        
	        $this->em->insertMenuitems($batch);
	    }
	    
	    echo json_encode(
	        array(
	            'success' => true,
	        )
	    );
	}
	
	public function getLanguages()
	{
	    $clientId = $this->input->post('client_id');
	    $lang = array();
	    foreach($this->em->getLanguagesByClientId($clientId)->result() as $l)
	    {
	        $lang[] = array(
                'key' => $l->id,
	            'value' => $l->name,
	        );
	    }
	    echo json_encode(
	        array(
	            'success' => true,
	            'langs' => $lang,
	        )
	    );
	}
	
	public function copyMenu()
	{
	    $clientId = $this->input->post('client_id');
	    $languageId = $this->input->post('language_id');
	    $srcClientId = $this->input->post('src_client_id');
	    $srcLanguageId = $this->input->post('src_language_id');

	    $this->em->deleteMenuitems($clientId, $languageId);
	    
	    $batch = array();
	    foreach($this->em->getMenuitems($srcClientId, $srcLanguageId)->result() as $menuitem)
	    {
	        $batch[] = array(
	            'client_id' => $clientId,
	            'language_id' => $languageId,
	            'metatag_id' => $menuitem->metatag_id,
	            'name' => $menuitem->name,
	            'ordering' => $menuitem->ordering,
	        );
	    }
	    $this->em->insertMenuitems($batch);

	    echo json_encode(
	        array(
	            'success' => true,
	        )
	    );
	}
	


	public function send_password($contentId)
	{
		$user = $this->em->getUserByID($contentId)->row();
		
		$data['user'] = $user;
		
		$this->render->__renderBackend('backend/user', $data);
	}
	
        public function send_pw()
	{
	    $contentId = $_POST['uid'];	    
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < 10; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    $pw =  $randomString;
		
		$hashed = $this->auth->__createHash($pw);	
		
		$user = $this->em->getUserByID($contentId)->row();
				
		$data = array('pword' => $hashed);	
		
		$this->em->updateUser($contentId, $data);
		
	    $this->load->library('My_phpmailer');
        
        $mail = new PHPMailer();
        //$mail->IsSMTP(); // we are going to use SMTP
        $mail->SMTPAuth   = false; // enabled SMTP authentication
        $mail->SMTPSecure = "ssl";  // prefix for secure protocol to connect to the server 
        $mail->SMTPDebug = 2;  // prefix for secure protocol to connect to the server 
        $mail->Host       = "mail.stanna.at";      // setting SMTP server
        $mail->Port       = 465;                   // SMTP port to connect to 
        $mail->Username   = "istvan.szilagyi";  // user email address
        $mail->Password   = "MLV294$";            // password 
       
        $mail->SetFrom('noreply@stanna.com', 'St. Anna Kinderspital');  //Who is sending the email
        $mail->AddReplyTo('noreply@stanna.com', 'St. Anna Kinderspital');  //email address that receives the response
        $mail->CharSet = 'UTF-8';

		

		$body = "You have been registered to access the St. Anna Kinderspital Backend!<br/><br/>You can log in at: <a href='".site_url()."backend'>".site_url()."backend</a><br/><br/>Username: ".$user->username."<br/>Password: ".$pw;
        $mail->Subject    = "St. Anna Kinderspital Backend Access";
		$mail->Body      =  $body;
		
		$email = $user->email;
        //$email = "junior.developer@istvanszilagyi.com";
		
		$mail->IsHTML(true);
		
        $mail->AddAddress($email);
		//$mail->Send();
        if(!$mail->Send()) {
           // echo "Error: " . $mail->ErrorInfo;
            echo '<script type="text/javascript">alert("Error: "' . $mail->ErrorInfo.'");window.location= "'.site_url().'entities/User/items"; </script>';
        } else {
           // echo "Message sent correctly!";
           echo 'OK';			
        }
       //return $data['message'];
	}
	
}
