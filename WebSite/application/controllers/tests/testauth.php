<?php
require_once(dirname(__FILE__)."/../auth.php");

class TestAuth extends CI_Controller
{    
    function __construct()
    {          
      parent::__construct();
      
      $this->load->library('unit_test');
      $this->load->library('form_validation');
      $this->load->library('security');
      $this->load->library('tank_auth');
      $this->lang->load('tank_auth');		
    }
    
    public function index(){
      $number = rand(100, 100000) . rand(100, 100000);
      $username = "test" . $number;
      $email = $username . "@gmail.com";
      $password = "as123456@";      
      $this->register($username, $email, $password);
      $this->activateUser();
      $this->sendEmail();
      $this->increaseLoginAttempts($username, $email, $password);      
      $this->clearLoginAttempts($username, $email, $password);      
      $this->login($username, $email, $password);
      $this->isLoggedIn();
      $this->checkDataSetInSession();
      $this->createAutoLogin($username, $email, $password);
      $this->changePassword($username, $email, $password);      
      $this->forgotPasswordUserDoesExist($username, $email, $password);
      $this->forgotPasswordUserNotExist();      
      $this->checkNumericPassword();
	  $this->checkRightPassword();
	  $this->checkRightButShortPassword();
      $this->checkAlphaNumericPassword();
	  $this->checkOnlyTextPassword();
	  $this->checkSpecialandNumberPassword();
	  $this->checkSpecialandTextPassword();
	  $this->checkSpecialKeyPassword();
	  // These Should be Last rows of function
      $this->logout();
      $this->checkDataSetInSessionAfterLogout();
      echo $this->unit->report();
    }
    
    private function register($username, $email, $password){      
      $email_activation = false;
      $first_name = "Test";
      $last_name = "Test";
      
      $old_username = $username;
      $old_email = $email;
      $test_result = $this->tank_auth->create_user( $username, $email, $password, $email_activation, 
                                                    $first_name, $last_name );      
      $this->unit->run($test_result, 'is_array', "Register User With Username[$username] Email[$email]");
      
      $number = rand(100, 100000) . rand(100, 100000);
      $username = "test" . $number;
      $test_result = $this->tank_auth->create_user( $username, $old_email, $password, $email_activation, 
                                                    $first_name, $last_name );      
      $this->unit->run($test_result, 'is_null', "Register User With New Username[$username] Duplicate Email[$old_email]");
      
      $number = rand(100, 100000) . rand(100, 100000);
      $email = "test" . $number  . "@gmail.com";      
      $test_result = $this->tank_auth->create_user( $old_username, $email, $password, $email_activation, 
                                                    $first_name, $last_name );
      $this->unit->run($test_result, 'is_null', "Register User With Duplicate Username[$old_username] New Email[$email]");
    }
    
    private function sendEmail(){
      $email = "shahramjaved75@gmail.com";
      $type = "test";
      $data = array();
      $data['site_name'] = $this->config->item('website_name', 'tank_auth');
      $auth = new Auth();
      
      $auth->_send_email($type, $email, $data);
      
      $test_result = true;
      $this->unit->run($test_result, 'is_true', "Send Test Email [$email]");
    }
    
    private function activateUser(){
      $number = rand(100, 100000) . rand(100, 100000);
      $username = "test" . $number;
      $email = $username  . "@gmail.com";
      $password = "123456";
      $email_activation = true;
      $first_name = "Test";
      $last_name = "Test";
      
      $user = $this->tank_auth->create_user( $username, $email, $password, $email_activation, $first_name, $last_name );      
      $user_id = $user['user_id'];
      $new_email_key = $user['new_email_key'];
      $test_result = $this->tank_auth->activate_user($user_id, $new_email_key);
      
      $this->unit->run($test_result, 'is_true', "Register User And Activated Username[$username]");      
    }
    
    private function changePassword($username, $email, $password){
      $test_result = $this->tank_auth->change_password( $password, $password );
      
      $this->unit->run($test_result, 'is_true', "Change Password Username[$username]");
    }
    
    private function login($username, $email, $password){      
      $remember = false;
      $login_by_username = ($this->config->item('login_by_username', 'tank_auth') && $this->config->item('use_username', 'tank_auth'));
      $login_by_email = $this->config->item('login_by_email', 'tank_auth');
                        
      $test_result = $this->tank_auth->login($username, $password, $remember, $login_by_username, $login_by_email);
      
      $this->unit->run($test_result, 'is_true', "Login Test With Correct Username and Password");
      
      $wrong_password = "123";
      $test_result = $this->tank_auth->login($username, $wrong_password, $remember, $login_by_username, $login_by_email);      
      $this->unit->run($test_result, 'is_false', "Login Test With Correct Username and Wrong Password");
      
      $login = "t";      
      $test_result = $this->tank_auth->login($login, $password, $remember, $login_by_username, $login_by_email);      
      $this->unit->run($test_result, 'is_false', "Login Test With Wrong Username and Correct Password");
                        
      $test_result = $this->tank_auth->login($email, $password, $remember, $login_by_username, $login_by_email);
      $this->unit->run($test_result, 'is_true', "Login Test With Email");
    }
    
    private function checkDataSetInSession(){ // Check if Data Set In Session After Login
      $userId = $this->tank_auth->get_user_id();
      $userName = $this->tank_auth->get_username();
      
      $test_result = $userId && $userName;
      
      $this->unit->run($test_result, 'is_true', "Check If Data Set In Session");
    }
    
    private function checkDataSetInSessionAfterLogout(){ // Check if Data Set In Session After Login
      $userId = $this->tank_auth->get_user_id();
      $userName = $this->tank_auth->get_username();
      
      $test_result = $userId && $userName;
      
      $this->unit->run($test_result, 'is_false', "Check If Data Set In Session After Logout");
    }
    
    private function logout(){
      $this->tank_auth->logout();
    }
    
    private function isLoggedIn(){      
      $test_result = $this->tank_auth->is_logged_in();
      $this->unit->run($test_result, 'is_true', "Is User LoggedIn");
    }
    
    private function forgotPasswordUserNotExist(){
      $login = "aliksdhgsjh";
      $test_result = $this->tank_auth->forgot_password($login);
      $this->unit->run($test_result, 'is_null', "Forgot Password User Not Exist");
    }
	
    private function forgotPasswordUserDoesExist($username, $email, $password){      
      $test_result = $this->tank_auth->forgot_password($username);
      $this->unit->run($test_result, 'is_array', "ForgotPassword User Does Exist");
    }        
    
    private function createAutoLogin($username, $email, $password){
      $data = $this->tank_auth->get_user_by_login($username);
      
      $test_result = false;
      if ($data){        
        $userId = $data->id;
        $test_result = $this->tank_auth->create_autologin($userId);
      }
      
      $this->unit->run($test_result, 'is_true', "Create Auto Login Cookie for UserName[$username]");
    }
    
    private function maxAttemptsOnLogin($username, $email, $password){      
      $test_result = $this->tank_auth->is_max_login_attempts_exceeded($username);
      $this->unit->run($test_result, 'is_false', "Max Wrong Password Attempts Exceeded UserName[$username]");
    }
    
    private function increaseLoginAttempts($username, $email, $password){      
      $test_result = $this->tank_auth->increase_login_attempt($username);
      $this->unit->run($test_result, 'is_true', "Increase Login Attempts UserName[$username]");
    }
    
    private function clearLoginAttempts($username, $email, $password){      
      $test_result = $this->tank_auth->clear_login_attempts($username);
      $this->unit->run($test_result, 'is_true', "Clear Login Attempts UserName[$username]");
    }
    
    private function checkNumericPassword()
   {
   $password = "123456";
   $auth = new Auth();
   $data = $auth->_check_password($password);
   $this->unit->run($data,'is_false',"Check if number only password works");
   } 

    private function checkRightPassword()
   {
   $password = "1A%bsdfsfb";
   $auth = new Auth();
   $data = $auth->_check_password($password);
   $this->unit->run($data,'is_true',"Check if alpha-numeric Special key password is accepted");
   } 

   private function checkRightButShortPassword()
   {
   $password = "1A%";
   $auth = new Auth();
   $data = $auth->_check_password($password);
   $this->unit->run($data,'is_false',"Check if alpha-numeric Special key password accepted if its short less than 6 characters");
   }

	 private function checkAlphaNumericPassword()
   {
   $password = "1Aeferf3234bsdd34";
   $auth = new Auth();
   $data = $auth->_check_password($password);
   $this->unit->run($data,'is_false',"Check if alpha-numeric password is accepted");
   }

	 private function checkOnlyTextPassword()
   {
   $password = "abcdesdsf";
   $auth = new Auth();
   $data = $auth->_check_password($password);
   $this->unit->run($data,'is_false',"Check if text password is accepted");
   }
	 private function checkSpecialKeyPassword()
   {
   $password = "$%^$#$%";
   $auth = new Auth();
   $data = $auth->_check_password($password);
   $this->unit->run($data,'is_false',"Check if Special Key password is accepted");
   }

    private function checkSpecialandTextPassword()
   {
   $password = "$%^$#$%affsfsf";
   $auth = new Auth();
   $data = $auth->_check_password($password);
   $this->unit->run($data,'is_false',"Check if Special Key and Text password is accepted");
   }
   
   
    private function checkSpecialandNumberPassword()
   {
   $password = "$%^$#$%1243543";
   $auth = new Auth();
   $data = $auth->_check_password($password);
   $this->unit->run($data,'is_false',"Check if Special Key and Number password is accepted");
   }

	
	










}

   