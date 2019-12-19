<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() {
        parent::__construct();
				$this->load->helper('url');
				$this->load->model('users_model');
				// load form helper and validation library
				$this->load->helper('form');
				$this->load->library('session');
				$this->load->library('form_validation');
    }

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$res = new stdClass();
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
			// redirect('admin');
		}

		// set validation rules
		// $this->form_validation->set_rules('email', 'email', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('login');
		} else {
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			if ($this->users_model->check_login_admin($username, $password)) {
				// $user_id = $this->users_model->get_admin_id_from(['email'=>$email]);
				// $user    = $this->users_model->get_user($user_id);

				// set session user data
				$_SESSION['logged_in']	= (bool)true;
				$data = array();
				$_SESSION['username_admin']	= (string)$username;

				$data['logged_in']	= (bool)true;
				$data['username_admin']	= (string)$username;
				$this->session->set_userdata($data);
				// $_SESSION['is_admin']	= false;
				// user login ok

				// echo "success ".$_SESSION['logged_in'];
				redirect('admin');
				$this->load->view('login', $res);
			} else {
				// login failed
				$res->error = 'Username atau password salah.';
				// send error to the view
				$this->load->view('login', $res);
			}
		}
	}
}
?>
