<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Methods extends CI_Controller
{
  private $error = array();

  function __construct()
  {
	parent::__construct();
   // $this->ci =& get_instance();
    $this->load->library('session');
	$this->load->library('tank_auth');
    //$this->ci->load->database();
   // $this->ci->load->model('scc_model');
   // $this->ci->load->model('load_results_model');
  }
  
  function loadMCC()
  {
	 $this->load->view('partials/main_header');
     $this->load->view('mcc_table/mcc.php');
     $this->load->view('partials/main_footer');
  }
}