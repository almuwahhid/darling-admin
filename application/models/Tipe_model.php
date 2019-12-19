<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tipe_model extends CI_Model {
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
	public function create($params) {
		$data = array(
			'nama_model' => $params['nama_model']
		);
		return $this->db->insert('model', $data);
	}

  public function get(){
		$this->db->where('deleted_at', '');
		$query = $this->db->get('model');
		return $query->result();
  }

}
