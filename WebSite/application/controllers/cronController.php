<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

Class CronController extends CI_Controller
{
    function __construct()
	{
		parent::__construct();
		
		$this->load->library('security');
		$this->load->library('tank_auth');
		
		$this->load->model('cronModel');
	}
	
	function index()
    {
		$user_name = $this->tank_auth->get_username();
		$this->session->set_userdata(array('user_name'=>$user_name));

		for(;;){
		
			echo "checking again <br />";
			
			$listOfInvocationsForEmails = $this->cronModel->getUserInvocationsToBeEmailed();

			$type = 'invocationComplete';
			
			foreach($listOfInvocationsForEmails as $result){
				$data = json_decode(json_encode($result), true);
				echo $data['email'] . "<br/>" . $data['status'] . "<br/>" . $data['invoked_time'] . "<br/>" . $data['invocation_name'] . "<br/><br/>";
				
				$this->load->library('email');
				$this->email->from($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
				$this->email->reply_to($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
				$this->email->to($data['email']);
				$this->email->subject('Invocation Finished ['. $data['invocation_name'] . ']');
				$this->email->message($this->load->view('email/'.$type.'-html', $data, TRUE));
				$this->email->set_alt_message($this->load->view('email/'.$type.'-txt', $data, TRUE));
				$this->email->send();
				
				$this->cronModel->setUserInvocationsEmailSentFlag($data['id']);
			}
			
			sleep(5);
		}
   }

}