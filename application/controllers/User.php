<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'controllers/BaseController.php');
// require(APPPATH.'/libraries/REST_Controller.php');
// use Restserver\Libraries\REST_Controller;

class User extends BaseController {
  public function __construct() {
    parent::__construct();
    $this->load->helper('url');
    // load form helper and validation library
    $this->load->helper('form');
    $this->load->library('session');
    $this->load->library('form_validation');
    $this->load->model('users_model');
    $this->load->model('main_model');

    $this->load->helper('form');
  }

  public function login(){
    $username = $this->input->post('username');
    $password = $this->input->post('password');

    if ($this->users_model->check_login($username, $password)) {
      $user = $this->users_model->get_user($username);
      if($user->aktif == 'N'){
        $data = array(
                    'status'           => "204",
                    'data'          => new stdClass());
      } else {
        $data = array(
                    'status'           => "200",
                    'data'          => $user);
      }
    } else {
      $data = array(
                  'status'           => "404",
                  'data'          => new stdClass());
    }

    echo json_encode($data);
  }



  public function index() {
    $users = $this->users_model->get_users();
    parent::getView('m_konfirmasiuser/listuser', 'user', $users);
  }

  public function detail($id_member){
    $model = $this->users_model->get_detail_user($id_member);


		if(!$model) {
			echo "Wisata tidak ada";die();
		} else {
      $data = $model;
      parent::getView('m_konfirmasiuser/detailuser', 'user', $data);
    }
  }

  public function konfirmasi(){
    $username = $this->input->get('username');
    $data = array(
      'aktif' => 'Y'
    );
    $insert = $this->main_model->update($data, 'users', ['username' => $username]);
    if ($insert) {
      $this->session->set_flashdata('alert', array('message' => 'Berhasil mengkonfirmasi user','class' => 'success'));
      redirect('user');
    }
    else {
      $this->session->set_flashdata('alert', array('message' => 'Gagal mengkonfirmasi user','class' => 'danger'));
      redirect('user');
    }
  }

  public function simpan(){

    $nama_wisata = $this->input->post('nama_wisata');
    $keterangan = $this->input->post('keterangan');
    $biaya = $this->input->post('biaya');
    $data = array(
      'nama_wisata' => $nama_wisata,
      'keterangan' => $keterangan,
      'biaya' => str_replace('.', '', $biaya)
    );


    if($this->input->post('action') === 'tambah') {
      $insert = $this->main_model->create($data, 'wisata');
      if ($insert) {
        $this->session->set_flashdata('alert', array('message' => 'Berhasil menambah wisata '.$biaya,'class' => 'success'));
        redirect('wisata');
      }
      else {
        $this->session->set_flashdata('alert', array('message' => 'Gagal menambah wisata','class' => 'danger'));
        redirect('wisata');
      }
    } else if ( $this->input->post('action') === 'edit' ) {
      $id_wisata = $this->input->post('id_wisata');

      $insert = $this->main_model->update($data, 'wisata', ['id_wisata' => $id_wisata]);
      if ($insert) {
        $this->session->set_flashdata('alert', array('message' => 'Berhasil mengedit Wisata','class' => 'success'));
        redirect('wisata/detail/'.$id_wisata);
      }
      else {
        $this->session->set_flashdata('alert', array('message' => 'Gagal mengedit wisata','class' => 'danger'));
        redirect('wisata/detail/'.$id_model);
      }
    }
  }

  function delete()
  {
    $id_wisata = $this->input->get('id');

    $data = array(
      'deleted_at' => date("Y-m-d"),
    );

    $insert = $this->main_model->update($data, 'wisata', ['id_wisata' => $id_wisata]);

    if ($insert) {
      $this->session->set_flashdata('alert', array('message' => 'Berhasil menghapus wisata','class' => 'success'));
      redirect('wisata');
    } else {
      $this->session->set_flashdata('alert', array('message' => 'Gagal menghapus wisata','class' => 'danger'));
      echo "gagal";
      redirect('wisata');
    }
  }
}
