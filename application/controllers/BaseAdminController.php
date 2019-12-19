<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
  date_default_timezone_set('Asia/Bangkok');

  class BaseAdminController extends CI_Controller {

	public function __construct() {
        parent::__construct();

        $this->load->library('session');
        $this->load->helper('url');

        if(isset($_SESSION['logged_in'])){
          if($_SESSION['logged_in'] !== true){
            redirect(base_url('login'));
            // echo "string ".$this->session->userdata('logged_in');
          }
        } else {
          redirect(base_url('login'));
        }
    }

    public function getView($view, $header = null, $data = array()){
        $data_header['username'] = $this->session->userdata('username_admin');
        $data_header['page'] = $header;
        // echo "string "+$this->session->userdata('username_admin');
        // echo "string "+$this->session->logged_in;
        // $data['is_admin'] = $this->is_admin();
        $this->load->view('bodyview/header', $data_header);
        $this->load->view($view, ['data' => $data]);
        $this->load->view('bodyview/footer');
    }

    public function userdata(){
    	$user = $this->session->userdata();
    	return $user;
    }
}
?>
