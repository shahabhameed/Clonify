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
          
	public function terms_conditions()
	{
        $this->load->view('partials/main_header');
	    $this->load->view('general/terms_condistions.php');
	    $this->load->view('partials/main_footer');
	}
          
    public function tree_map()
	{
		//$viewData = array();      
	    //$viewData['showCloneView'] = true;
	    		
        $this->load->view('partials/main_header');
	    //$this->load->view('TreeMaps/TreeMap',$viewData);
		$this->load->view('TreeMaps/TreeMap');
	    $this->load->view('partials/main_footer');
    }
	
	public function fcs_within_directory()
	{
		$viewData = array();      
	    $invocationId = $this->getInvocationIdFromURL();
		$viewData['showCloneView'] = true;
	    $viewData['invocationId'] = $invocationId;
		
        $this->load->view('partials/main_header');
	    $this->load->view('TreeMaps/fcs_within_directory', $viewData);
	    $this->load->view('partials/main_footer');
    }
	
	public function fcs_across_directory()
	{
		$viewData = array();      
	    $invocationId = $this->getInvocationIdFromURL();
		$viewData['showCloneView'] = true;
	    $viewData['invocationId'] = $invocationId;
		
        $this->load->view('partials/main_header');
	    $this->load->view('TreeMaps/fcs_across_directory', $viewData);
	    $this->load->view('partials/main_footer');
    }
	
	public function fcs_within_group()
	{
		$viewData = array();      
	    $invocationId = $this->getInvocationIdFromURL();
		$viewData['showCloneView'] = true;
	    $viewData['invocationId'] = $invocationId;
		
        $this->load->view('partials/main_header');
	    $this->load->view('TreeMaps/fcs_within_group', $viewData);
	    $this->load->view('partials/main_footer');
    }
	
	public function fcs_across_group()
	{
		$viewData = array();      
	    $invocationId = $this->getInvocationIdFromURL();
		$viewData['showCloneView'] = true;
	    $viewData['invocationId'] = $invocationId;
		
        $this->load->view('partials/main_header');
	    $this->load->view('TreeMaps/fcs_across_group', $viewData);
	    $this->load->view('partials/main_footer');
    }

}
