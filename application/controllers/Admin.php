<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'controllers/BaseAdminController.php');

class Admin extends BaseAdminController {
  public function __construct() {
	parent::__construct();
		// $this->load->model('user_model');
		// $this->load->model('main_m');
		// $this->is_admin = parent::is_admin();
	}

  public function index(){
    parent::getView('admin/dashboard', 'dashboard');
  }

  public function ubahpassword(){
    parent::getView('m_profile/profile', 'dashboard');
  }

  public function logout(){
    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
      // remove session datas
      foreach ($_SESSION as $key => $value) {
        unset($_SESSION[$key]);
      }
      redirect('/');

    } else {
      redirect('/');
    }
  }

}
?>
