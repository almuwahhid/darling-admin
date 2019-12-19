<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Book_model extends CI_Model {
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
	public function status_book($id_kendaraan) {
    $this->db->where('id_kendaraan', $id_kendaraan);
    $this->db->where('confirmed', 'Y');
    $this->db->where('deleted_at', '');
    $this->db->where("begin_date <= ", date('Y-m-d H:i:s'));
    $this->db->where("due_date >= ", date('Y-m-d H:i:s'));

		$query = $this->db->get('booking');
		return $query->result();
	}

	public function get($page = null){
    if($page!=null){
      $this->db->limit('5', $page);
    } else {
      if($this->totalBooking()>1){
          $this->db->limit('5');
      }
    };
    $this->db->order_by('submit_date', 'desc');
		$this->db->join('member', 'booking.id_member = member.id_member');
		$query = $this->db->get('booking');
		return $query->result();
  }

	public function getDetail($id){
		$this->db->where('id_booking', $id);
		$this->db->join('kendaraan', 'booking.id_kendaraan = kendaraan.id_kendaraan');
		$this->db->join('member', 'booking.id_member = member.id_member');
		$this->db->select('*');
    $this->db->from('booking');
		return $this->db->get()->row();
  }

	public function updateBookAfter60(){
		$this->db->where('submit_date < DATE_SUB(NOW(), INTERVAL 60 MINUTE)', NULL, FALSE);
		$this->db->where('confirmed', 'N');
		$this->db->where('deleted_at', '');
		$this->db->where('confirmation_photo', '');
		return $this->db->update('booking', ['deleted_at' => date('Y-m-d H:i:s'), 'confirmed' => 'Y']);
	}

	public function getFirst(){
		$this->db->join('kendaraan', 'booking.id_kendaraan = kendaraan.id_kendaraan');
		$this->db->join('model', 'model.id_model = kendaraan.id_model');
		$this->db->join('member', 'booking.id_member = member.id_member');
		$this->db->select('*, booking.deleted_at as delete');
		$this->db->order_by('booking.id_booking', 'DESC');
		$this->db->limit('1');
		$this->db->from('booking');
		return $this->db->get()->row();
	}

	public function updatebookconfirm($id){
		$this->db->where('id_booking', $id);
	}

	public function getfromsearch($id_member, $kode_booking){
		$this->db->select('*, booking.deleted_at as delete');
		$this->db->where('id_member', $id_member);
		$this->db->where('kode_booking', $kode_booking);
		$this->db->join('kendaraan', 'booking.id_kendaraan = kendaraan.id_kendaraan');
		$this->db->join('model', 'kendaraan.id_model = model.id_model');
		$this->db->limit('1');
		$this->db->from('booking');
		return $this->db->get()->row();
	}

	public function getfromsearchAll($kode_booking){
		$this->db->select('*, booking.deleted_at as delete');
		$this->db->where('kode_booking', $kode_booking);
		$this->db->join('kendaraan', 'booking.id_kendaraan = kendaraan.id_kendaraan');
		$this->db->join('model', 'kendaraan.id_model = model.id_model');
		$this->db->join('member', 'booking.id_member = member.id_member');
		$this->db->limit('1');
		$this->db->from('booking');
		return $this->db->get()->row();
	}

	public function listBookingUser($id_member){
		$this->db->select('*, booking.deleted_at as delete');
		$this->db->where('id_member', $id_member);
		$this->db->join('kendaraan', 'booking.id_kendaraan = kendaraan.id_kendaraan');
		$this->db->join('model', 'kendaraan.id_model = model.id_model');
		$query = $this->db->get('booking');
		return $query->result();
	}

	public function totalBooking() {
		$this->db->from("booking");
		$this->db->join('kendaraan', 'booking.id_kendaraan = kendaraan.id_kendaraan');
		$this->db->join('member', 'booking.id_member = member.id_member');
		$this->db->where('kendaraan.deleted_at', '');
		return floor($this->db->count_all_results()/5)+1;
	}

	public function allBooking() {
		$this->db->from("booking");
		return $this->db->count_all_results();
	}
}
