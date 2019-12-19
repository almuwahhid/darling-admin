<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model {
	/**
	 * __construct function.
	 *
	 * @access public
	 * @return void
	 */
	public function __construct() {
		parent::__construct();
		$this->load->database();
	}

	/**
	 * create_user function.
	 *
	 * @access public
	 * @param mixed $username
	 * @param mixed $email
	 * @param mixed $password
	 * @return bool true on success, false on failure
	 */

	/**
	 * check_login function.
	 *
	 * @access public
	 * @param mixed $email
	 * @param mixed $password
	 * @return bool true on success, false on failure
	 */
	public function check_login($email, $password) {
		$this->db->select('password');
		$this->db->from('user');
		$this->db->where('email', $email);
		$hash = $this->db->get()->row('password');
		return $this->verify_password_hash($password, $hash);
	}

	public function update_login_by_code($code, $password) {
		$this->db->where("forgot_code", $code);
		return $this->db->update("user", ['password' => $this->hash_password($password), 'forgot_code' => ""]);
	}

	public function update_forgot_password($code, $email) {
		$this->db->where("email", $email);
		return $this->db->update("user", ['forgot_code' => $code]);
	}

	public function get_user_by_code($code) {
		$this->db->from('user');
		$this->db->where('forgot_code', $code);
		return $this->db->get()->row();
	}

	/**
	* check_login_admin function.
	 *
	 * @access public
	 * @param mixed $email
	 * @param mixed $password
	 * @return bool true on success, false on failure
	 */
	public function check_login_admin($uname, $password) {
		$this->db->select('password');
		$this->db->from('admin');
		$this->db->where('username', $uname);
		$hash = $this->db->get()->row('password');
		return $this->verify_password_hash($password, $hash);

	}

	public function check_login_user($uname, $password) {
		$this->db->select('password');
		$this->db->from('users');
		$this->db->where('username', $uname);
		$this->db->where('level', 'user');
		$hash = $this->db->get()->row('password');
		return $this->verify_password_hash($password, $hash);

	}


	/**
	 * get_user_id_from function.
	 *
	 * @access public
	 * @param array $params
	 * @return int the user id
	 */
	public function get_admin_username_from($params) {
		$this->db->select('username');
		$this->db->from('users');
		$this->db->where($params);
		return $this->db->get()->row('username');
	}

	/**
	 * get_user function.
	 *
	 * @access public
	 * @param mixed $user_id
	 * @return object the user object
	 */
	public function get_user($email) {
		$this->db->from('user');
		$this->db->join('status', 'status.id_status = user.id_status');
		$this->db->where('email', $email);
		return (object) $this->db->get()->row();
	}

	public function get_user_by_id($id) {
		$this->db->from('user');
		$this->db->join('status', 'status.id_status = user.id_status');
		$this->db->where('id_user', $id);
		return (object) $this->db->get()->row();
	}

	public function get_users() {
		$this->db->order_by('email', 'ASC');
		$query = $this->db->get('user');
		return $query->result();
	}

	/**
	 * get_admin_id_from function.
	 *
	 * @access public
	 * @param array $params
	 * @return int the user id
	 */
	public function get_admin_id_from($params) {
		$this->db->select('id');
		$this->db->from('admin');
		$this->db->where($params);
		return $this->db->get()->row('id');
	}

	public function check_email($email) {
		$this->db->where('email', $email);

		$query = $this->db->get('user');
		return $query->result();
	}



	/**
	 * check_access function.
	 *
	 * @access public
	 * @param mixed $access
	 * @return bool
	 */
	public function check_access($access){
		return $access === 'admin' ? true : false;
	}

	/**
	 * hash_password function.
	 *
	 * @access private
	 * @param mixed $password
	 * @return string|bool could be a string on success, or bool false on failure
	 */
	public function hash_password($password) {
		return password_hash($password, PASSWORD_BCRYPT);
	}

	/**
	 * verify_password_hash function.
	 *
	 * @access private
	 * @param mixed $password
	 * @param mixed $hash
	 * @return bool
	 */
	private function verify_password_hash($password, $hash) {
		return password_verify($password, $hash);
	}

	public function get($page = null){
    if($page!=null){
      $this->db->limit('5', $page);
    } else {
      if($this->totalUser()>1){
          $this->db->limit('5');
      }
    };
		$this->db->join('status', 'status.id_status = user.id_status');
		$query = $this->db->get('user');
		return $query->result();
  }

	public function totalUser() {
		$this->db->from("user");
		return floor($this->db->count_all_results()/5)+1;
	}

}
