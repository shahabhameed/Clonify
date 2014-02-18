<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Ex_cont extends CI_Controller
{
	var $_path = ''; 
	function __construct()
	{
		parent::__construct();
		$this->load->library('tank_auth');
		$this->load->helper('path');
		if (!$this->tank_auth->is_logged_in()) {         // Not logged in
        redirect('/auth/login/');
      	}
      	$username = $this->tank_auth->get_username();
      	$this->_path = set_realpath(FCPATH.'files/'.$username);
      	if (!file_exists($this->_path)) {
		    mkdir($this->_path, 0777, true);
		}
      	// print_r($this->_path);exit;
		//$this->ci->load->library('session');
	}
	function index()
	{
		//elfinder_init();
	}
	function elfinder_init()
	{
		$username = $this->tank_auth->get_username();
		$opts = array(
			// 'debug' => true, 
			'roots' => array(
			array( 
				'driver' => 'LocalFileSystem', 
				'path'   => $this->_path, 
				'URL'    => site_url(),
				'uploadOrder'=> array( 'allow', 'deny'),
				'uploadAllow' => array('text', 'java'),
				'uploadDeny' => array('all'),
				'attributes' => array(
					array(
					'pattern' => '/.tmb/',
					'read' => false,
					'write' => false,
					'hidden' => true,
					'locked' => true
					),
				// more elFinder options here
				) 
			)
			)
		);
		$this->load->library('elfinder_lib', $opts);
	}
	
	function saveFilesToDb()
	{
		$this->load->model('repository_model');
		$this->load->library('session');
		//get/read file names from the user's folder
		//save the file names in db using model
		//load view? - 
		$username = $this->tank_auth->get_username();
		$dir = new RecursiveDirectoryIterator($this->_path,
			FilesystemIterator::SKIP_DOTS);

		// Flatten the recursive iterator, folders come before their files
		$it  = new RecursiveIteratorIterator($dir,
			RecursiveIteratorIterator::SELF_FIRST);

		// Maximum depth is 1 level deeper than the base folder
		//$it->setMaxDepth(2);
		//$user_id= $this->tank_auth->get_username();
		$user_id = $this->session->userdata('user_id');
		
		// Basic loop displaying different messages based on file or folder
		foreach ($it as $fileinfo) {
			if ($fileinfo->isDir()) {
				//printf("Folder - %s\n", $fileinfo->getFilename());
			//	echo  "Folder Name: ".$fileinfo->getFilename()."<br/>";
			} elseif ($fileinfo->isFile()) {
				//printf("File From %s - %s\n", $it->getSubPathName(), $fileinfo->getFilename());
				//echo  $fileinfo->getFilename();
				//echo "FilePath: ".$it->getSubPath()."FileName: ".$fileinfo->getFilename()."<br/>";
				$this->repository_model->insertFileName($user_id, $it->getSubPath(), $fileinfo->getFilename());
			}
		}
		$this->load->view('partials/main_header');
		$this->load->view('dashboard');
		$this->load->view('partials/main_footer');
	}
}
?>