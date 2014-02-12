<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Invoke extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->library('security');
		$this->load->library('tank_auth');
		$this->lang->load('tank_auth');
		$this->form_validation->set_error_delimiters('', '');
		
		$this->load->model('invoke_model');
	}

	function index()
	{
	
		$this->session->set_userdata(array('scc_min_sim'=>'','method_analysis'=>'','grouping_choice'=>'','files'=>'','language'=>'','supTokens'=>'','eqTokens'=>''));
		$data['usrfiles']=$this->invoke_model->get_all_user_files();
		$data['languages']=$this->invoke_model->get_all_languages();
		$this->open_view('invoke_init',$data);
/*		if ($message = $this->session->flashdata('message')) {
					echo '1';					
                  $this->load->view('partials/main_header');
                  $this->load->view('invoke_init',$data);
                  $this->load->view('partials/main_footer');
		} else {
			echo '2';
                  redirect('/auth/login/');
		}
*/		
	}

	/**
	 * Login user on the site
	 *
	 * @return void
	 */
	function invoke_init()
	{
    	//echo "in invoke";
		//$this->load->model('invoke_model');
		//$this->invoke_model->new_invocation();
		$this->invoke_model->init();
		$data['tokens']=$this->invoke_model->get_all_language_tokens();
		$this->open_view('invoke_sup',$data);//loading success view
	}
	
	function invoke_sup()
	{
    	//echo "in invoke";
		//$this->load->model('invoke_model');
		//$this->invoke_model->new_invocation();
		$this->invoke_model->sup();
		$data['tokens']=$this->invoke_model->get_all_language_tokens();
		$this->open_view('invoke_eq',$data);//loading success view
	}
	
	function invoke_eq()
	{
    	//echo "in invoke";
		//$this->load->model('invoke_model');
		//$this->invoke_model->new_invocation();
		$this->invoke_model->eq();
		$this->open_view('dashboard',NULL);//loading success view
	}
	
	function open_view($pagename,$data){
		$this->load->view('partials/main_header');
		$this->load->view($pagename,$data);
		$this->load->view('partials/main_footer');		
	}  
}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */