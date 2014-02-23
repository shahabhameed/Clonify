<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Load_results extends CI_Controller
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
		$this->load->model('load_results_model');
	}

	function index()
	{
		$data['user_name'] = $this->tank_auth->get_username();
		$data['results']=$this->load_results_model->get_all_results();
		
		$this->load->view('partials/main_header');
		$this->load->view('partials/sidebar');
		$this->load->view('update_tokens',$data);
		$this->load->view('partials/main_footer');
	}
	
	function update_results()
	{
		$isUpdated='';
		if(!empty($_POST['count']))
		{
		
			$count = $_POST['count'];
			$isUpdated = false;
			//echo 'this'.$count;
			for ($x=0; $x<$count; $x++)
			{
				$paramId = 'iid'.$x;
				$paramName = 'iname'.$x;
				$paramComments = 'icomments'.$x;
				$iid = $_POST[$paramId];
				$iname = $_POST[$paramName];
				$icomments = $_POST[$paramComments];
				$this->load_results_model->update_result($iid,$iname,$icomments);
				$isUpdated = true;
			}
			
		}
		
		$data['user_name'] = $this->tank_auth->get_username();
		$data['results']=$this->load_results_model->get_all_results();
		$data['isUpdated'] = $isUpdated;
		$data['info_message'] = "Records Updated successfully!";
		$this->load->view('partials/main_header');
		$this->load->view('partials/sidebar');
		$this->load->view('update_tokens', $data);
		$this->load->view('partials/main_footer');	
		
		unlink('./uploads/'.$fileName.'.txt');
	}	
}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */