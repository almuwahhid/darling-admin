<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main_model extends CI_Model {
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

  public function updateData($params, $where){
    $this->db->where($where)->update($table, $data);

        if ($this->db->affected_rows()) {
            $result['status']  = TRUE;
            $result['message'] = "success";
        } else {
            $result['status']  = FALSE;
            $result['message'] = $this->db->error();
        }
        return $result;
  }

  function delete($table, $where){
    $this->db->where($where)->update($table, ['deleted_at' => date("Y-m-d") ]);

    if ($this->db->affected_rows()) {
      $result['status']  = TRUE;
      $result['message'] = "success";
    } else {
      $result['status']  = FALSE;
      $result['message'] = $this->db->error();
    }
    return $result;
  }

  function get($table,$where = null, $order = null, $limit = null, $group = null,$select = null){
    if($where != null) $this->db->where($where);
    if($order != null) $this->db->order_by($order);
    if($group != null) $this->db->group_by($group);
    if($limit != null) $this->db->limit($limit);
    if($select != null) $this->db->select($select);

    $query = $this->db->get($table);
    return $query->result();
  }

	public function update($params, $table, $where){
		$this->db->where($where);
		return $this->db->update($table, $params);
  }

	public function create($params, $table) {
		return $this->db->insert($table, $params);
	}

	public function getDetail($table, $where){
		$this->db->where($where);
		$this->db->select('*');
    $this->db->from($table);
		return $this->db->get()->row();
  }

}
