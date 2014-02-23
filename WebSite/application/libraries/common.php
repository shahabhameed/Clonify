<?php

  if (!defined('BASEPATH'))
    exit('No direct script access allowed');

  class Common{

    function __construct() {
      $this->ci =& get_instance();
      $this->ci->load->library('StringCompare');
    }

    function extractClonedSubstring($file_path, $start_line, $end_line) {
      $file_contents = file_get_contents($file_path);
      $file_contents = str_replace("\r\n", "\n", $file_contents);
      $file_contents = str_replace("\r", "\n", $file_contents); 
      $file_contents = explode("\n", $file_contents);
      $code = "";
      if ($file_contents):
        for($i = ($start_line-1); $i <= $end_line; $i++):
          $code .= isset($file_contents[$i]) ? $file_contents[$i] : "";
        endfor;        
      endif;
      return $code;
    }

  }
  