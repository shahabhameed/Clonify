<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Ex_cont extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('tank_auth');
		//$this->ci->load->library('session');
	}
	function index()
	{
		//elfinder_init();
	}
	function elfinder_init()
	{
	//$this->ci->load->library('session');
	//$this->load->library('tank_auth');
	//$this->lang->load('tank_auth');
	$this->load->helper('path');
	$username = $this->tank_auth->get_username();
	$opts = array(
		// 'debug' => true, 
		'roots' => array(
		array( 
			'driver' => 'LocalFileSystem', 
			'path'   => set_realpath('C:\xampp\htdocs\Team2\Clonify3\files\\'.$username), 
			'URL'    => site_url('http://203.135.63.151/Team2/Clonify3') . '/'
			// more elFinder options here
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
		$dir = new RecursiveDirectoryIterator('C:\xampp\htdocs\Team2\Clonify3\files\\'.$username,
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