<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'controllers/api/Base_api.php');

class Wisata extends Base_api {
  public function __construct() {
    parent::__construct();
    $this->load->helper('url');

    $this->load->model('kendaraan_model');
    $this->load->model('main_model');
    $this->load->model('wisata_model');
  }

  public function index(){
    $wisata = $this->wisata_model->get();

    if($wisata){
      $data = array(
                  'status'           => "200",
                  'message'           => "Wisata Tersedia",
                  'data'          => $wisata);
    } else {
      $data = array(
                  'status'           => "204",
                  'message'           => "Wisata tidak tersedia",
                  'data'          => $wisata);
    }
    echo json_encode($data);
  }
}
