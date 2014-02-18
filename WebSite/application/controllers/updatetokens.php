<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Updatetokens extends CI_Controller
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
		
		$this->load->helper(array('form', 'url'));
		$this->load->model('update_tokens_model');
		
	}

	function index()
	{
		$data['languages']=$this->update_tokens_model->get_all_languages();
		$this->load->view('partials/main_header');
		$this->load->view('update_tokens',$data);
		$this->load->view('partials/main_footer');		
	}
	
	function update()
	{
		$this->update_tokens_model->get_all_languages();
		
		$user_id = $this->session->userdata('user_id');
		$language = $_POST['language'];
		
		$fileName = $user_id.'_'.$language;
		
		$config['upload_path'] = './uploads/';		
		$config['allowed_types'] = 'txt';
		$config['max_size']	= '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
		$config['file_name']  = $fileName;

		$this->load->library('upload', $config);
		
		if ( ! $this->upload->do_upload())
		{
			$result = 'Some error occured';
			$error = array('error' => $this->upload->display_errors());
			$result = $error['error'];
		}
		else
		{
			$result = array('upload_data' => $this->upload->data());
			$result = 'Successfull';
		}
		$this->update_tokens_model->update($fileName);
	
		$data['languages']=$this->update_tokens_model->get_all_languages();		
		$data['results']= $result;
		
		$this->load->view('partials/main_header');
		$this->load->view('update_tokens', $data);
		$this->load->view('partials/main_footer');	
		
		
		unlink('./uploads/'.$fileName.'.txt');
	}	
}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */