<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pernyataan_model extends CI_Model {
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

   public function getAspek(){
		 $this->db->select('*');
		 $query = $this->db->get('aspek');
		 return $query->result();
 	}

  public function getNilai($id_jenis_pernyataan){
   $this->db->where('id_jenis_pernyataan', $id_jenis_pernyataan);
   $this->db->select('*');
    $query = $this->db->get('nilai_jenis_pernyataan');
		return $query->result();
  }

	public function getIndikator($id_aspek){
		$this->db->where('id_aspek', $id_aspek);
		$this->db->select('*');
		$query = $this->db->get('indikator');
		return $query->result();
	}

	public function getIndikatorModeByIdIndikatorMode($id_indikator_mode){
		$this->db->where('id_indikator_mode', $id_indikator_mode);
		$this->db->select('*');
		$query = $this->db->get('indikator_mode');
		return $query->row();
	}

  public function getAspekIndikator($id_status){
		$this->db->join('aspek', 'aspek.id_aspek = indikator.id_aspek');
		$this->db->where('id_status', $id_status);
		$this->db->join('indikator_mode', 'indikator.id_indikator = indikator_mode.id_indikator');
		$this->db->select('*');
    $query = $this->db->get('indikator');
		return $query->result();
	}

	public function getPernyataan($id_indikator){
		$this->db->order_by('id_pernyataan','RANDOM');
		$this->db->where('id_indikator_mode', $id_indikator);
    $this->db->join('jenis_pernyataan', 'jenis_pernyataan.id_jenis_pernyataan = pernyataan.id_jenis_pernyataan');
		$this->db->select('*');
		$query = $this->db->get('pernyataan');
		return $query->result();
	}

	public function getSamplePernyataan($id_indikator){
		$this->db->where('id_indikator', $id_indikator);
    $this->db->join('jenis_pernyataan', 'jenis_pernyataan.id_jenis_pernyataan = pernyataan.id_jenis_pernyataan');
		$this->db->select('*');
		$this->db->get('pernyataan');
		return $this->db->last_query();
	}

	public function getAspekByIdIndikator($id_indikator){
		$this->db->where('id_indikator', $id_indikator);
		$this->db->select('*');
		$query = $this->db->get('aspek');
		return $query->row();
	}
}
