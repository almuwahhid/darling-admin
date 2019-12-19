<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'controllers/BaseController.php');

class Kendaraan extends BaseController {
	public function __construct() {
        parent::__construct();
        $this->load->helper('url');
				$this->load->model('users_model');
				// load form helper and validation library
				$this->load->helper('form');
				$this->load->library('session');
				$this->load->library('form_validation');
		    $this->load->model('kendaraan_model');
		    $this->load->model('main_model');
		    $this->load->model('tipe_model');

        $this->load->helper('form');
				$this->load->library('form_validation');
	}

	public function index() {
    $page = $this->input->get('p');
		$kendaraan = $this->kendaraan_model->get($page);
		$jumlah = $this->kendaraan_model->totalKendaraan();
    $asd['kendaraan'] = $kendaraan;
    $asd['jumlah'] = $jumlah;
    parent::getView('m_rentcar/listrentcar', 'kendaraan', $asd);
	}

	public function detail($id){
		$kendaraan = $this->kendaraan_model->getDetail($id);
		$album = $this->kendaraan_model->getPhotos($id);
		$model = $this->tipe_model->get();
		$data['id_kendaraan'] = $id;
		$data['album'] = $album;
		$data['model'] = $model;
		$data['kendaraan'] = $kendaraan;

		if(!$kendaraan) {
			echo "kendaraan tidak ada";die();
		}
		parent::getView('m_rentcar/detailrentcar', 'kendaraan', $data);
	}
	public function tambah(){
		$data = $this->tipe_model->get();
		parent::getView('m_rentcar/formlistrentcar', 'kendaraan', $data);
	}

	public function simpan(){
		$merk = $this->input->post('merk');
		$model = $this->input->post('model');
		$tipe = $this->input->post('tipe');
		$plat_nomor = $this->input->post('plat_nomor');
		$tahun_pembuatan = $this->input->post('tahun_pembuatan');
		$isi_silinder = $this->input->post('isi_silinder');
		$nomor_rangka = $this->input->post('nomor_rangka');
		$nomor_mesin = $this->input->post('nomor_mesin');
		$tarif = $this->input->post('tarif');

        $data = array(
            'merk' => $merk,
            'id_model' => $model,
						'plat_nomor' => $plat_nomor,
						'tipe' => $tipe,
						'tahun_pembuatan' => $tahun_pembuatan,
						'isi_silinder' => $isi_silinder,
						'nomor_mesin' => $nomor_mesin,
						'nomor_rangka' => $nomor_rangka,
						'tarif' => $tarif
        );

				if($this->input->post('action') === 'tambah') {
					$insert = $this->kendaraan_model->create_kendaraan($data);
					if ($insert) {
						$this->session->set_flashdata('alert', array('message' => 'Berhasil menambah kendaraan','class' => 'success'));
						redirect('kendaraan');
					}
					else {
						$this->session->set_flashdata('alert', array('message' => 'Gagal menambah kendaraan','class' => 'danger'));
						redirect('kendaraan');
					}
				} else if ( $this->input->post('action') === 'edit' ) {
					$id_kendaraan = $this->input->post('id_kendaraan');

					$insert = $this->main_model->update($data, 'kendaraan', ['id_kendaraan' => $id_kendaraan]);
					if ($insert) {
						$this->session->set_flashdata('alert', array('message' => 'Berhasil mengedit kendaraan','class' => 'success'));
						redirect('kendaraan/detail/'.$id_kendaraan);
					}
					else {
						$this->session->set_flashdata('alert', array('message' => 'Gagal mengedit kendaraan','class' => 'danger'));
						redirect('kendaraan/detail/'.$id_kendaraan);
					}
				}
	}

	public function simpanphoto(){
		$id_kendaraan = $this->input->post('id_kendaraan');
		$photo_name = $id_kendaraan."_".str_replace(" ","_", $_FILES['photo']['name']);

		$data = array(
			'id_kendaraan' => $id_kendaraan,
			'photo' => $photo_name,
		);

		$config['upload_path']          = './datas';
		$config['allowed_types']        = 'jpg|gif|png|jpeg|JPG|PNG';
		$config['max_size']             = 150000;
		$config['file_name']            = $photo_name;

		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if ( ! $this->upload->do_upload('photo') )
		{
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('alert', array('message' => $this->upload->display_errors(),'class' => 'danger'));
			redirect('kendaraan/detail/'.$id_kendaraan);
		} else {
			$insert = $this->kendaraan_model->create_photo($data);
			if ($insert) {
				$this->session->set_flashdata('alert', array('message' => 'Berhasil menambah usaha','class' => 'success'));
				redirect('kendaraan/detail/'.$id_kendaraan);
			}
			else {
				$this->session->set_flashdata('alert', array('message' => 'Gagal menambah usaha','class' => 'danger'));
				redirect('kendaraan/detail/'.$id_kendaraan);
			}
		}
	}

	function deletefoto()
    {
			$id_kendaraan = $this->input->get('id_kendaraan');
			$id = $this->input->get('id');

			$data = array(
				'deleted_at' => date("Y-m-d"),
			);

        $insert = $this->main_model->update($data, 'album_kendaraan', ['id_album' => $id]);

        if ($insert) {
					$this->session->set_flashdata('alert', array('message' => 'Berhasil menghapus foto','class' => 'success'));
					redirect('kendaraan/detail/'.$id_kendaraan);
        } else {
					$this->session->set_flashdata('alert', array('message' => 'Gagal menghapus foto','class' => 'danger'));
					redirect('kendaraan/detail/'.$id_kendaraan);
        }
    }

		function deletekendaraan()
		{
			$id_kendaraan = $this->input->get('id_kendaraan');

			$data = array(
				'deleted_at' => date("Y-m-d"),
			);

			$insert = $this->main_model->update($data, 'kendaraan', ['id_kendaraan' => $id_kendaraan]);

			if ($insert) {
				$this->session->set_flashdata('alert', array('message' => 'Berhasil menghapus kendaraan','class' => 'success'));
				redirect('kendaraan');
			} else {
				$this->session->set_flashdata('alert', array('message' => 'Gagal menghapus kendaraan','class' => 'danger'));
				echo "gagal";
				redirect('kendaraan');
			}
		}
}
