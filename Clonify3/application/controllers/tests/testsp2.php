<?php
require_once(dirname(__FILE__)."/../auth.php");

class TestSP2 extends CI_Controller
{    
    function __construct()
    {          
      parent::__construct();
      
      $this->load->library('unit_test');
      $this->load->library('form_validation');
      $this->load->library('security');
      $this->load->library('SyntaxHighlighter');
      $this->load->library('StringCompare');	
    }
    
    public function index(){
      $this->testDifferenceBetweenStrings();
      echo $this->unit->report();
    }
    
    private function testDifferenceBetweenStrings(){      
      $string1 = "private string testfunction()";
      $string2 = "private int testfunction()";
      
      $obj =  new StringCompare();
      
      $test_result = $obj->getDifferenceBetweenStrings($string1, $string2);      
      $data = implode(", ", $test_result);
      $this->unit->run($data, 'is_string', "testDifferenceBetweenStrings Difference Strings Separated by Comma [$data] Input Strings S1[$string1] S2[$string2]");
    }

}
   