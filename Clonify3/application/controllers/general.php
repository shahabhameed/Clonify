<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class General extends CI_Controller {

	public function __construct()
       {
          parent::__construct();
          $this->load->library('tank_auth');
       }
       
        public function index()
	  {    
            redirect('/home/');
	  }
          
          public function terms_condistions(){
            $this->load->view('partials/main_header');
	    $this->load->view('terms_condistions.php');
	    $this->load->view('partials/main_footer');
          }
}
