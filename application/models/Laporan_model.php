<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_model extends CI_Model {
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

  public function monthlist($param) {
    $this->db->select('DISTINCT EXTRACT(MONTH FROM begin_date) as bulan');
		$this->db->where('EXTRACT(YEAR FROM begin_date) = ', $param);
    $this->db->where('confirmed', 'Y');
    $this->db->where('deleted_at', '');

    $query = $this->db->get('booking');
		return $query->result();
  }

  public function yearList() {
    $this->db->select('DISTINCT EXTRACT(YEAR FROM begin_date) as tahun');
    $this->db->where('confirmed', 'Y');
		$this->db->where('deleted_at', '');

    $query = $this->db->get('booking');
    return $query->result();
  }

	public function monthinYearlist($param){
		$this->db->select('DISTINCT EXTRACT(MONTH FROM begin_date) as bulan');
    $this->db->where('EXTRACT(YEAR FROM begin_date) = ', $param);
    $this->db->where('confirmed', 'Y');
		$this->db->where('deleted_at', '');

    $query = $this->db->get('booking');
		return $query->result();
	}

	public function listLaporan($isYear, $isBulanan = null){
		if($isBulanan != null){
			$this->db->where('EXTRACT(YEAR FROM begin_date) = ', $isYear);
			$this->db->where('EXTRACT(MONTH FROM begin_date) = ', $isBulanan);
		} else {
			$this->db->where('EXTRACT(YEAR FROM begin_date) = ', $isYear);
		}
		$this->db->where('confirmed', 'Y');
		$this->db->where('deleted_at', '');
		$this->db->select('*, booking.deleted_at as delete');
		$this->db->join('kendaraan', 'booking.id_kendaraan = kendaraan.id_kendaraan');
		$this->db->join('member', 'booking.id_member = member.id_member');
		$this->db->join('model', 'kendaraan.id_model = model.id_model');
		$query = $this->db->get('booking');
		return $query->result();
	}

	function getmonth($param){
		switch ($param) {
			case 1:
				return 'Januari';
				break;
				case 2:
					return 'Februari';
					break;
					case 3:
						return 'Maret';
						break;
						case 4:
							return 'April';
							break;
							case 5:
								return 'Mei';
								break;
								case 6:
									return 'Juni';
									break;
									case 7:
										return 'Juli';
										break;
										case 8:
											return 'Agustus';
											break;
											case 9:
												return 'September';
												break;
												case 10:
													return 'Oktober';
													break;
													case 11:
														return 'November';
														break;
														case 12:
															return 'Desember';
															break;

			default:
				return 'Januari';
				break;
		}
	}
}
