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
          
          public function terms_conditions(){
            $this->load->view('partials/main_header');
	    $this->load->view('general/terms_condistions.php');
	    $this->load->view('partials/main_footer');
          }
          
          public function test(){
            $this->load->view('partials/main_header');
            $this->load->view('partials/sidebar');
	    $this->load->view('test');
	    $this->load->view('partials/main_footer');
          }
}
