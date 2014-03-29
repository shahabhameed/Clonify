<?php 
require_once(APPPATH . '/controllers/test/Toast.php');

class Invoker_test_class extends Toast
{
	//function My_test_class()
	function __construct()
	{
		parent::__construct();
//		parent::Toast(__FILE__);
		// Remember this
		$this->load->model('invoke_model_test');
		$this->load->model('invoke_model');
	}
	/*
	function test_get_all_languages()
	{
		$result = $this->invoke_model_test->get_all_languages();
		$test_count = count($result);
		$this->_assert_equals($test_count,7);
	}
	
	function test_java_token_numbers()
	{
		$result = $this->invoke_model_test->get_all_language_tokens(1);
		$test_count = count($result);
		$this->_assert_equals($test_count,111);
	}	
	
	function test_cpp_token_numbers()
	{
		$result = $this->invoke_model_test->get_all_language_tokens(2);
		$test_count = count($result);
		$this->_assert_equals($test_count,149);
	}
	
	function test_user_repository()
	{
		$result = $this->invoke_model_test->get_all_user_files(1);
		$test_count = count($result);
		$this->_assert_not_empty($test_count);
	}
	
	function test_notempty_user_repository()
	{
		$result = $this->invoke_model_test->get_all_user_files(1);
		$test_count = count($result);
		$this->_assert_not_equals($test_count,1);
	}
	
	function test_suppressed_tokens_concat()
	{
		$supArr = array(1,2,3,4);
		$result = $this->invoke_model_test->sup($supArr);
		$this->_assert_equals($result,'1,2,3,4');
	}

	function test_equal_tokens_concat()
	{
		$eqArr = array('1=2','3=4','98=99');
		$result = $this->invoke_model_test->eq($eqArr);
		$this->_assert_equals($result,'1=2|3=4|98=99');
	}
	
	function test_equal_tokens_isnotempty()
	{
		$eqArr = array('1=2','3=4','98=99');
		$result = $this->invoke_model_test->eq($eqArr);
		$this->_assert_not_empty($result);
	}
	
	function test_suppressed_tokens_isempty()
	{
		$supArr = '';
		$result = $this->invoke_model_test->sup($supArr);
		$this->_assert_empty($result);
	}
	
	function test_required_fields_notempty()
	{
		$minToks = 30;
		$files = array('D:\xampp\htdocs\abc.java','D:\xampp\htdocs\123.java');
		$result = $this->invoke_model_test->init($minToks,$files);
		$this->_assert_true($result);
	}
	*/
	function test_isInitLanguageBlank()
	{
		//$lang = 1;
		//$result = $this->invoke_model_test->setSelectedLanguage($lang);
		$langS = $this->session->userdata('language');
		echo $langS;
		$this->_assert_empty($langS);
	}
	
	function test_isSelectedLanguageSet()
	{
		$lang = 1;
		$result = $this->invoke_model_test->setSelectedLanguage($lang);
		$langS = $this->session->userdata('language');
		$this->_assert_equals($langS,$lang);
	}
	
	function test_isSelectedLanguageSetOutOfRange()
	{
		$lang = 10;
		$result = $this->invoke_model_test->setSelectedLanguage($lang);
		$langS = $this->session->userdata('language');
		$this->_assert_equals($langS,$lang);
	}
	
	function test_areUserFilesSelectedByLanguage()
	{
		$this->session->set_userdata(array('language'=>1));
		$this->session->set_userdata(array('user_id'=>1));
		$result = $this->invoke_model->get_all_user_files();
		$this->_assert_not_empty($result);
	}
} 

?>