<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'controllers/api/Base_api.php');

class Laporan extends Base_api {
  public function __construct() {
    parent::__construct();
    $this->load->helper('url');

    $this->load->model('main_model');
    $this->load->model('survey_model');
    $this->load->model('pernyataan_model');
  }

  public function index(){
    // $result = array();
    // $result["data"] = array();
    // $indikators = $this->pernyataan_model->getAspekIndikator();
    // if($indikators){
    //   $result["result"] = "success";
    //   foreach ($indikators as $k => $ind) {
    //     $aspek = $ind;
    //     $pernyataan = array();
    //     // echo $this->pernyataan_model->getSamplePernyataan($ind->id_indikator);
    //     foreach ($this->pernyataan_model->getPernyataan($ind->id_indikator) as $k => $pyt) {
    //       $pyt->nilai = $this->pernyataan_model->getNilai($pyt->id_jenis_pernyataan);
    //       array_push($pernyataan, $pyt);
    //     }
    //     $aspek->pernyataan = $pernyataan;
    //     array_push($result["data"], $aspek);
    //   }
    // }
    // echo json_encode($result);
  }

  public function getNilaiSurvey(){
    $result = array();
    $result["data"] = array();
    $data = json_decode($this->input->post('data'));

    $surveySaya = $this->survey_model->surveySaya($data->id_user, $data->id_status);
    if($surveySaya){
      $result["result"] = "success";
      foreach ($surveySaya as $k => $survey) {
        $survey->nilai = $this->survey_model->getNilaiPertanyaanBySurvey($survey->id_survey);
        array_push($result["data"], $survey);
      }
    } else {
      $result["result"] = "failed";
    }
    echo json_encode($result);
    // getNilaiPertanyaanBySurvey
  }


  public function getNilaiSurveyByAspek(){
    $result = array();
    $result["data"] = array();
    $data = json_decode($this->input->post('data'));

    foreach ($this->pernyataan_model->getAspek() as $k => $aspek) {
      $surveySaya = $this->survey_model->surveySaya($data->id_user, $data->id_status);
      $aspek->survey = array();
      if($surveySaya){
        $result["result"] = "success";
        foreach ($surveySaya as $k => $survey) {
          $survey->nilai = $this->survey_model->getNilaiPertanyaanByAspek($survey->id_survey, $aspek->id_aspek);
          array_push($aspek->survey, $survey);
        }
      } else {
        $result["result"] = "failed";
      }
      array_push($result["data"], $aspek);
    }
    echo json_encode($result);
    // getNilaiPertanyaanBySurvey
  }


}
