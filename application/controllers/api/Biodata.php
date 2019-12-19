<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'controllers/api/Base_api.php');

class Biodata extends Base_api {
  public function __construct() {
    parent::__construct();
    $this->load->helper('url');

    $this->load->model('users_model');
    $this->load->model('main_model');
  }

  public function index(){
    $result = array();
    $result["data"] = array();
    $data = json_decode($this->input->post('data'));
    $datak = array(
      'id_user' => $data->id_user,
      'id_status' => $data->id_status,
      'email' => $data->email,
      'nama' => $data->nama,
      'jenis_kelamin' => $data->jenis_kelamin,
      'tgl_lahir' => $data->tgl_lahir,
      'fakultas' => $data->fakultas,
      'alamat_asal' => $data->alamat_asal,
      'alamat_tinggal' => $data->alamat_tinggal,
      'no_wa' => $data->no_wa
    );
    $update = $this->main_model->update($datak, 'user', ['id_user' => $data->id_user]);

    if($update){
      $result["result"] = "success";
      $result["data"] = $this->users_model->get_user($data->email);

    } else {
      $result["result"] = "failed";
    }

    echo json_encode($result);
  }
}
