<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH . '/controllers/test/Toast.php');

class Repository_Test extends Toast
{
	//function My_test_class()
	function __construct()
	{
		parent::__construct();
		//parent::Toast('login_attempts/get_attempts_num'); // Remember this
		
		
		$this->load->model('repository_model_test');
	}
	
	function test_isExistFileName()
	{
		$newId = 43;
		$fileName = 'DSC_0594.jpg';
		$result = $this->repository_model_test->isExistFileName($newId, $fileName );
		$this->_assert_false($result);
	}
	
	function test_isExistDirectoryName()
	{
		$dirPath = ".tmb/";
		$id = 2;
		$result = $this->repository_model_test->isExistDirectoryName($dirPath, $id);
		$this->_assert_false($result);
	}
	
	function test_getDirectoryId()
	{
		$dirPath = ".tmb/";
		$id = 2;
		$result = $this->repository_model_test->getDirectoryId($dirPath, $id);
		$this->_assert_not_equals($result, 0);
	}
	
	function  test_insertFileName()
	{
		$user_id = 1;
		$dirPath = ".tmb";
		$fileName = 'DSC_0594.jpg';
		$result = $this->repository_model_test->insertFileName($user_id, $dirPath, $fileName);
		$this->_assert_true($result);
	}
	
	function  test_getIdFromUserRepository()
	{
		$user_id = 1;
		$result = $this->repository_model_test->getIdFromUserRepository($user_id);
		$this->_assert_not_empty($result);
	}
	
	
} 

?>