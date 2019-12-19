<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'controllers/BaseController.php');

class Modelkendaraan extends BaseController {
  public function __construct() {
    parent::__construct();
    $this->load->helper('url');
    // load form helper and validation library
    $this->load->helper('form');
    $this->load->library('session');
    $this->load->library('form_validation');
    $this->load->model('tipe_model');
    $this->load->model('main_model');

    $this->load->helper('form');
  }

  public function index() {
    $tipe = $this->tipe_model->get();
    parent::getView('m_kategori/listkategori', 'model', $tipe);
  }

  public function tambah(){
    $data = $this->tipe_model->get();
    parent::getView('m_kategori/formkategori', 'model', $data);
  }

  public function tracking() {
    $kode = $this->input->get('q');
    $permohonan = $this->main_m->get('permohonan_izin', ['kode_antrian' => $kode]);
    $data = [];
    if(count($permohonan) > 0) {
      $log = $this->main_m->get_log($permohonan[0]->id);
      $data['log'] = $log;
      $data['izin'] = $permohonan[0];
    }
    $this->getHomeView('homepage/perizinan/tracking', $data);
  }

  public function detail($id){
    $model = $this->main_model->getDetail("model", ['id_model' => $id]);
		$data = $model;

		if(!$model) {
			echo "Model tidak ada";die();
		}
		parent::getView('m_kategori/detailkategori', 'model', $data);
  }

  public function simpan(){
    $model = $this->input->post('model');
    $data = array(
      'nama_model' => $model
    );

    if($this->input->post('action') === 'tambah') {
      $insert = $this->tipe_model->create($data);
      if ($insert) {
        $this->session->set_flashdata('alert', array('message' => 'Berhasil menambah kendaraan','class' => 'success'));
        redirect('modelkendaraan');
      }
      else {
        $this->session->set_flashdata('alert', array('message' => 'Gagal menambah kendaraan','class' => 'danger'));
        redirect('modelkendaraan');
      }
    } else if ( $this->input->post('action') === 'edit' ) {
      $id_model = $this->input->post('id_model');

      $insert = $this->main_model->update($data, 'model', ['id_model' => $id_model]);
      if ($insert) {
        $this->session->set_flashdata('alert', array('message' => 'Berhasil mengedit Model Kendaraan','class' => 'success'));
        redirect('modelkendaraan/detail/'.$id_model);
      }
      else {
        $this->session->set_flashdata('alert', array('message' => 'Gagal mengedit model kendaraan','class' => 'danger'));
        redirect('modelkendaraan/detail/'.$id_model);
      }
    }
  }

  function delete()
  {
    $id_model = $this->input->get('id');

    $data = array(
      'deleted_at' => date("Y-m-d"),
    );

    $insert = $this->main_model->update($data, 'model', ['id_model' => $id_model]);

    if ($insert) {
      $this->session->set_flashdata('alert', array('message' => 'Berhasil menghapus model kendaraan','class' => 'success'));
      redirect('modelkendaraan');
    } else {
      $this->session->set_flashdata('alert', array('message' => 'Gagal menghapus kmodel endaraan','class' => 'danger'));
      echo "gagal";
      redirect('modelkendaraan');
    }
  }
}
