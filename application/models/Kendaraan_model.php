<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kendaraan_model extends CI_Model {
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
	public function create_kendaraan($params) {

		$data = array(
			'id_model' => $params['id_model'],
			'plat_nomor' => $params['plat_nomor'],
			'merk' => $params['merk'],
			'tipe' => $params['tipe'],
			'tahun_pembuatan' => $params['tahun_pembuatan'],
			'isi_silinder' => $params['isi_silinder'],
			'nomor_rangka' => $params['nomor_rangka'],
			'nomor_mesin' => $params['nomor_mesin'],
			'tarif' => $params['tarif']
		);
		return $this->db->insert('kendaraan', $data);
	}
	public function create_photo($params) {

		$data = array(
			'id_kendaraan' => $params['id_kendaraan'],
			'photo' => $params['photo']
		);
		return $this->db->insert('album_kendaraan', $data);
	}

	public function totalKendaraan() {
		$this->db->where('deleted_at', '');
		$this->db->from("kendaraan");
		return floor($this->db->count_all_results()/5)+1;
	}

	public function getAlbum($id_kendaraan){
		$this->db->where('id_kendaraan', $id_kendaraan);
		$this->db->where('deleted_at', '');
		$query = $this->db->get('album_kendaraan');
		return $query->result();
	}

	public function getAll(){
    $this->db->order_by('merk', 'asc');
		$this->db->join('model', 'model.id_model = kendaraan.id_model');
		$this->db->where('kendaraan.deleted_at', '');
		$this->db->where('model.deleted_at', '');
		$query = $this->db->get('kendaraan');
		return $query->result();
	}

  public function get($page = null){

    if($page!=null){
      $this->db->limit('5', $page);
    } else {
      if($this->totalKendaraan()>1){
          $this->db->limit('5');
      }
    };
		$this->db->where('deleted_at', '');
    $this->db->order_by('merk', 'asc');
		$query = $this->db->get('kendaraan');
		return $query->result();
  }

	public function getDetail($id){
		$this->db->where('id_kendaraan', $id);
		$this->db->select('*');
    $this->db->from('kendaraan');
		return $this->db->get()->row();
  }

	public function getBiaya($id){
		$this->db->where('id_kendaraan', $id);
		$this->db->select('tarif');
    $this->db->from('kendaraan');
		return $this->db->get()->row();
  }

	public function getPhotos($id){
		$this->db->where('deleted_at', '');
		$this->db->where('id_kendaraan', $id);
		$query = $this->db->get('album_kendaraan');
		return $query->result();
	}

}
