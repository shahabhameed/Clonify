<?php

  if (!defined('BASEPATH'))
    exit('No direct script access allowed');

  class Common{

    function __construct() {
      $this->ci =& get_instance();
      $this->ci->load->library('StringCompare');
    }

    function extractClonedSubstring($file_path, $start_line, $end_line, $start_col, $end_col) {
      $file_contents = file_get_contents($file_path);
      $file_contents = str_replace("\r\n", "\n", $file_contents);
      $file_contents = str_replace("\r", "\n", $file_contents); 
      $file_contents = explode("\n", $file_contents);
      $code = "";
      if ($file_contents):
        for($i = ($start_line-1); $i <= $end_line; $i++):
//          if ($i == ($start_line-1))
//            $file_contents[$i] = substr($file_contents[$i], $start_col, strlen($file_contents[$i]));
//          else if ($i == $end_line)
//            $file_contents[$i] = substr($file_contents[$i], 0, $end_col);
          $code .= isset($file_contents[$i]) ? trim($file_contents[$i]) : "";
        endfor;        
      endif;      
      return trim($code);
    }
    
    function extractFirstAndLastLine($file_path, $start_line, $end_line){
      $file_contents = file_get_contents($file_path);
      $file_contents = str_replace("\r\n", "\n", $file_contents);
      $file_contents = str_replace("\r", "\n", $file_contents); 
      $file_contents = explode("\n", $file_contents);
      $start_line = $file_contents[$start_line-1];
      $end_line = $file_contents[$end_line-1];
      if (false !== strpos($start_line, "\t")) {
        $start_line = str_replace("\t", "    ", $start_line);
      }
      if (false !== strpos($end_line, "\t")) {
        $end_line = str_replace("\t", "    ", $end_line);
      }
      return $result = array($start_line, $end_line);
    }

  }
  