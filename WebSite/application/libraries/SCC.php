<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class SCC
{
  private $error = array();

  function __construct()
  {
    $this->ci =& get_instance();
    $this->ci->load->library('session');
    $this->ci->load->database();
    $this->ci->load->model('scc_model');    
  }
  
  function getAllSCCRows($invocationId=3){
    $userId = $this->ci->tank_auth->get_user_id();
    
    return $this->ci->scc_model->getAllSCCRows($invocationId, $userId);    
  }
}
