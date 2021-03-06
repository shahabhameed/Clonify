<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class General extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('tank_auth');
        $this->load->model('treemap_model');
    }

    public function index() {
        redirect('/home/');
    }

    public function terms_conditions() {
        $this->load->view('partials/main_header');
        $this->load->view('general/terms_condistions.php');
        $this->load->view('partials/main_footer');
    }

    public function about_us() {
        //$viewData = array();      
        //$viewData['showCloneView'] = true;

        $this->load->view('partials/main_header');
        //$this->load->view('TreeMaps/TreeMap',$viewData);
        $this->load->view('Other/AboutUs');
        $this->load->view('partials/main_footer');
    }

    public function fcs_within_directory() {
        $viewData = array();
        //$invocationId = $this->getInvocationIdFromURL();
        $invocationId = 112;
        $dids = array(0, 1, 2);
        $viewData['showCloneView'] = true;
        $viewData['invocationId'] = $invocationId;

        $viewData['treemapdata'] = $this->treemap_model->get_fcs_within_dir_treemap($invocationId, $dids);

        $this->load->view('partials/main_header');
        //$this->load->view('TreeMaps/fcs_within_directory', $viewData);
        $this->load->view('TreeMaps/TreeMap', $viewData);
        $this->load->view('partials/main_footer');
    }

    public function fcs_across_directory() {
        $viewData = array();
        $invocationId = $this->getInvocationIdFromURL();
        $viewData['showCloneView'] = true;
        $viewData['invocationId'] = $invocationId;

        $this->load->view('partials/main_header');
        $this->load->view('TreeMaps/fcs_across_directory', $viewData);
        $this->load->view('partials/main_footer');
    }

    public function fcs_within_group() {
        $viewData = array();
        $invocationId = $this->getInvocationIdFromURL();
        $viewData['showCloneView'] = true;
        $viewData['invocationId'] = $invocationId;

        $this->load->view('partials/main_header');
        $this->load->view('TreeMaps/fcs_within_group', $viewData);
        $this->load->view('partials/main_footer');
    }

    public function fcs_across_group() {
        $viewData = array();
        $invocationId = $this->getInvocationIdFromURL();
        $viewData['showCloneView'] = true;
        $viewData['invocationId'] = $invocationId;

        $this->load->view('partials/main_header');
        $this->load->view('TreeMaps/fcs_across_group', $viewData);
        $this->load->view('partials/main_footer');
    }

}
