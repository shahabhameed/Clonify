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
		$user_name = $this->tank_auth->get_username();
		$this->session->set_userdata(array('user_name'=>$user_name));
	
		$this->session->set_userdata(array('scc_min_sim'=>'','method_analysis'=>'','grouping_choice'=>'','files'=>'','language'=>'','supTokens'=>'','eqTokens'=>''));
		$this->session->set_userdata(array('language'=>'1'));
		
		$data['usrfiles']=$this->invoke_model->get_all_user_files();
		$data['languages']=$this->invoke_model->get_all_languages();
		$data['alltokens']=$this->invoke_model->get_all_language_tokens();
		$prev_invo_params = $this->invoke_model->get_latest_user_invocation_tokens_by_language();
		$data['prev_sup_tokens']=$this->invoke_model->get_all_prev_sup_tokens($prev_invo_params);
		$data['tokens']=$this->invoke_model->get_all_language_tokens_sup($prev_invo_params);
		$data['minSimToks']=$this->invoke_model->get_prev_minSim($prev_invo_params);

		
		$this->open_view('test',$data);
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
	function test(){
            
		$data['usrfiles']=$this->invoke_model->get_all_user_files();
		$data['languages']=$this->invoke_model->get_all_languages();
		$data['tokens']=$this->invoke_model->get_all_language_tokens();
		$this->open_view('test',$data);//loading success view
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
		$this->open_view('dashboard',NULL, false);//loading success view
	}
	
	function open_view($pagename,$data, $loadSidebar=true){
		$this->load->view('partials/main_header');
                if ($loadSidebar){
                  $this->load->view('partials/sidebar');
                }
		$this->load->view($pagename,$data);
		$this->load->view('partials/main_footer');		
	}  
}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */