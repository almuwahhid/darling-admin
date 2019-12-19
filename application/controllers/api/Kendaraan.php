<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'controllers/api/Base_api.php');

class Kendaraan extends Base_api {
  public function __construct() {
    parent::__construct();
    $this->load->helper('url');

    $this->load->model('kendaraan_model');
    $this->load->model('main_model');
    $this->load->model('book_model');
  }

  public function index(){
    $kendaraan = $this->kendaraan_model->getAll();
    $kendaraans = array();

    if($kendaraan){
      foreach ($kendaraan as $k => $knd) {
        $datak = array(
                    'id_kendaraan'           => $knd->id_kendaraan,
                    'id_model'           => $knd->id_model,
                    'nama_model'           => $knd->nama_model,
                    'plat_nomor'           => $knd->plat_nomor,
                    'merk'           => $knd->merk,
                    'tipe'           => $knd->tipe,
                    'tahun_pembuatan'           => $knd->tahun_pembuatan,
                    'isi_silinder'           => $knd->isi_silinder,
                    'nomor_rangka'           => $knd->nomor_rangka,
                    'nomor_mesin'           => $knd->nomor_mesin,
                    'tarif'           => $knd->tarif
                    );
        if($this->book_model->status_book($knd->id_kendaraan)){
          $datak['available'] = false;
        } else {
          $datak['available'] = true;
        }
        $data_album = array();
        $album = $this->kendaraan_model->getAlbum($knd->id_kendaraan);
        foreach ($album as $k => $albm) {
          $album_d = $this->config->base_url().'datas/'.$albm->photo;
          array_push($data_album, $album_d);
        }
        $datak['photos'] = $data_album;
        array_push($kendaraans, $datak);
      }
      $data = array(
                  'status'           => "200",
                  'message'           => "Kendaraan Tersedia",
                  'data'          => $kendaraans);
    } else {
      $data = array(
                  'status'           => "204",
                  'message'           => "Kendaraan tidak tersedia",
                  'data'          => $kendaraans);
    }
    echo json_encode($data);
  }
}
