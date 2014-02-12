<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
       {
            parent::__construct();
            $this->load->library('tank_auth');
            if (!$this->tank_auth->is_logged_in()) {									// Not logged in
              redirect('/auth/login/');
            }
       }
	  public function index()
	  {    
            $data['user_id'] = $this->tank_auth->get_user_id();
            $data['username'] = $this->tank_auth->get_username();            
            $this->load->view('partials/main_header', $data);
	    $this->load->view('dashboard.php');
	    $this->load->view('partials/main_footer');
	  }
          
          public function terms_condistions(){
            $this->load->view('partials/header');
	    $this->load->view('terms_condistions.php');
	    $this->load->view('partials/footer');
          }
}
