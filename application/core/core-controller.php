<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
	public function __construct() {
        parent::__construct();
    }

    public function getView($content, $params){

    }

    public function getDashboardView($content, $params = null){
    	$this->load->view('layouts/header-homepage');
    	$this->load->view($content, $params);
    	$this->load->view('layouts/footer-homepage');
    }

}
