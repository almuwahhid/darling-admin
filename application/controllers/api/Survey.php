<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'controllers/api/Base_api.php');
require_once(APPPATH.'controllers/util/helper.php');

class Survey extends Base_api {
  public function __construct() {
    parent::__construct();
    $this->load->helper('url');

    $this->load->model('main_model');
    $this->load->model('survey_model');
    $this->load->model('pernyataan_model');
  }

  public function index(){
    $data = json_decode($this->input->post('data'));

    echo json_encode($result);
  }

  public function makeSurvey(){
    $data = json_decode($this->input->post('data'));
    $result = array();
    $datak = array(
                'id_user'           => $data->id_user,
                'tanggal_survey'           => date('Y-m-d H:i:s')
                );
     if($this->survey_model->addSurvey($datak)){
       $result["result"] = "success";
       $result["message"] = "Berhasil membuat survey";
       $result["data"] = $this->survey_model->getLastSurvey($data->id_user);
     } else {
       $result["result"] = "failed";
       $result["message"] = "Ada yang bermasalah dengan server";
     }
    echo json_encode($result);
  }

  public function check(){
    $data = json_decode($this->input->post('data'));
    $jumlahSurvey = $this->survey_model->checkSurvey($data->id_user);

    $result = array();
    if($jumlahSurvey == 0){
      $result["result"] = "new";
      $result["task"] = array();
    } else {
      $result["task"] = array();
      if($jumlahSurvey == 1){
        if($this->isSurveyDone($data->id_user)){
          $result["result"] = "first";
        } else {
          $result["result"] = "survey";
          $result["data"] = $this->survey_model->getLastSurvey($data->id_user);
          $result["intervensi"] = $this->survey_model->getTaskPertanyaanSurvey($result["data"]->id_survey);
        }
      } else if($jumlahSurvey > 1){
        if($this->isSurveyDone($data->id_user)){
          $result["result"] = "second";
        } else {
          $result["result"] = "survey";
          $result["data"] = $this->survey_model->getLastSurvey($data->id_user);
          $result["intervensi"] = $this->survey_model->getTaskPertanyaanSurvey($result["data"]->id_survey);
        }
      }
    }
    echo json_encode($result);
  }

  public function submitPertanyaan(){
    // include_once '../util/helper.php';
    $helper = new Helper();
    $data = json_decode($this->input->post('data'));
    $user = json_decode($this->input->post('user'));
    $pernyataan = json_decode($this->input->post('pernyataan'));
    $result = array();
    $process = $this->survey_model->addPertanyaanSurvey($data);

    $isNeedTask = false;

    if($this->survey_model->getCountTaskIntervensiBySurvey($data->id_survey) < 7){
      if($pernyataan->id_jenis_pernyataan == 1){
        if($data->nilai_pertanyaan <= 2){
          $isNeedTask = true;
        }
      } else {
        if($data->nilai_pertanyaan <= 2){
          $isNeedTask = true;
        }
      }
    }

    if($process){
      $result["indikator"] = false;
      $result["survey"] = false;
      if($isNeedTask){
        $last_pertanyaan = $this->survey_model->getLastPertanyaan($data->id_survey);
        $task_pertanyaan = array(
                    'id_pertanyaan_survey'           => $last_pertanyaan->id_pertanyaan_survey,
                    'tanggal_task'           => $this->survey_model->getLastDateIntervensi($data->id_survey),
                    'status_task'           => 'N'
                    );
        $this->main_model->create($task_pertanyaan, "task_pertanyaan");
        $result["intervensi"] = $this->survey_model->getLastIntervensi($data->id_survey);
      }

      if($this->survey_model->isPertanyaanAsPernyataanIndikator($data->id_survey, $pernyataan->id_indikator_mode)){
        $result["indikator"] = true;

        $countPernyataanByIndikator = $this->survey_model->getCountPernyataanByIndikator($pernyataan->id_indikator_mode);
        $countPertanyaanByIndikator = $this->survey_model->getCountPertanyaanByIndikator($data->id_survey, $pernyataan->id_indikator_mode);
        $nilaiPertanyaanByIndikator = $this->survey_model->getNilaiPertanyaanByIndikator($data->id_survey, $pernyataan->id_indikator_mode);

        if($helper->klasifikasiKomentar($countPernyataanByIndikator, $nilaiPertanyaanByIndikator) == "plus"){
          $result["data_indikator"] = $this->pernyataan_model->getIndikatorModeByIdIndikatorMode($pernyataan->id_indikator_mode)->plus_comment;
        } else if($helper->klasifikasiKomentar($countPernyataanByIndikator, $nilaiPertanyaanByIndikator) == "minus"){
          $result["data_indikator"] = $this->pernyataan_model->getIndikatorModeByIdIndikatorMode($pernyataan->id_indikator_mode)->negative_comment;
        }
      }

      // , $this->pernyataan_model->getAspekByIdIndikator($pernyataan->id_indikator))
      if($this->survey_model->isPertanyaanAsPernyataanAll($data->id_survey, $user->id_status)){
        $result["survey"] = true;
        $aspek = $this->pernyataan_model->getAspek();
        foreach ($aspek as $k => $asp) {
          $nilaiPertanyaanByAspek = $this->survey_model->getNilaiPertanyaanByAspek($data->id_survey, $asp->id_aspek);
          // echo $this->survey_model->getSampleKlasifikasiScoreByScore($asp->id_aspek, $nilaiPertanyaanByAspek);
          $score_identitas_survey = array(
                      'id_survey'           => $data->id_survey,
                      'id_aspek'           => $asp->id_aspek,
                      'score'           => $nilaiPertanyaanByAspek,
                      'type_score'           => $helper->getTypeScore($nilaiPertanyaanByAspek, $asp->median));

          $this->main_model->create($score_identitas_survey, "score_identitas_survey");
        }

        $data_score_identitas_survey = $this->survey_model->getScoreIdentitasSurvey($data->id_survey);

        // echo $this->survey_model->hitungStatusIdentitasReligiusSample($data_score_identitas_survey);
        $hitungStatusIdentitasReligius = $this->survey_model->hitungStatusIdentitasReligius($data_score_identitas_survey, $user->id_status);
        if($hitungStatusIdentitasReligius){
          if($this->survey_model->updateScoreSurvey($hitungStatusIdentitasReligius->id_status_identitas_religius, $data->id_survey)){
            $result["data_survey"] = $hitungStatusIdentitasReligius->deskripsi_status;
          }
        } else {
          if($this->survey_model->updateScoreSurvey("5", $data->id_survey)){
            $result["data_survey"] = "Tidak ada status";
          }
        }
      }

      $result["result"] = "success";
    } else {
      $result["result"] = "failed";
    }
    echo json_encode($result);
  }

  public function test(){
    // echo strtotime('+1 day', date('Y-m-d H:i:s'));
    // $date = strtotime("+7 day", '2019-06-02 23:42:29');
    // // echo date('2019-06-02 23:42:29', strtotime('+1 day'));
		// echo date('Y-m-d H:i:s', $date);
		// echo date('Y-m-d H:i:s', strtotime('+1 day'));
    // $timestamp = time()-86400;
    $timestamp = strtotime('2019-06-02 23:42:29');

    echo $timestamp;
    $date = strtotime("+1 day", $timestamp);
    echo date('Y-m-d H:i:s', $date);
	}

  public function getAllTaskPertanyaan(){
    echo json_encode($this->main_model->get("task_pertanyaan"));
  }

  public function updateTaskPertanyaan(){
    $result = array();

    $data = json_decode($this->input->post('data'));
    $user = json_decode($this->input->post('user'));
    $data->tanggal_submit = date('Y-m-d H:i:s');
    $datak = array(
                'id_task_pertanyaan'           => $data->id_task_pertanyaan,
                'id_pertanyaan_survey'           => $data->id_pertanyaan_survey,
                'tanggal_task'           => $data->tanggal_task,
                'status_task'           => $data->status_task,
                'tanggal_submit'           => $data->tanggal_submit,
                'komentar_pertanyaan'           => $data->komentar_pertanyaan);

    $insert = $this->main_model->update($datak, 'task_pertanyaan', ['id_task_pertanyaan' => $data->id_task_pertanyaan]);
    $result["done"] = false;
    if($insert){
      $result["result"] = "success";
      $result["data"] = $this->survey_model->getTaskPertanyaan($data->id_task_pertanyaan);
      if($this->isSurveyComplete($user->id_user)){
        $result["done"] = true;
      }
    } else {
      $result["result"] = "failed";
      $result["data"]  = new stdClass();
    }

    echo json_encode($result);
  }

  public function getSurveySaya(){
    $result = array();
    $data = json_decode($this->input->post('data'));
    $surveySaya = $this->survey_model->surveySaya($data->id_user, $data->id_status);
    // echo $this->survey_model->isTaskCompletedBySurveySample($survey->id_survey);
    if($surveySaya){
      $result["result"] = "success";
      $result["data"] = $surveySaya;
    } else {
      $result["result"] = "failed";
    }
    echo json_encode($result);
  }

  public function getDetailSurveySaya(){
    $result = array();
    $data = json_decode($this->input->post('data'));
    $detailSurveySaya = $this->survey_model->detailSurveySaya($data->id_survey);
    // echo $this->survey_model->isTaskCompletedBySurveySample($survey->id_survey);
    if($detailSurveySaya){
      $result["result"] = "success";
      $result["data"] = $detailSurveySaya;
    } else {
      $result["result"] = "failed";
    }
    echo json_encode($result);
  }

  public function getPertanyaan(){
    $result = array();
    $data = json_decode($this->input->post('data'));
    $task_pertanyaan = $this->survey_model->getTaskPertanyaanSurvey($data->id_survey);
    // echo $this->survey_model->isTaskCompletedBySurveySample($survey->id_survey);
    if($task_pertanyaan){
      $result["result"] = "success";
      $result["data"] = $task_pertanyaan;
    } else {
      $result["result"] = "failed";
    }
    echo json_encode($result);
  }

  private function isSurveyComplete($id_user){
    $survey = $this->survey_model->getLastSurvey($id_user);
    // echo $this->survey_model->isTaskCompletedBySurveySample($survey->id_survey);
    if($this->survey_model->isTaskPassedBySurvey($survey->id_survey)){
      return false;
    } else {
      return true;
    }
  }

  private function isSurveyDone($id_user){
    $survey = $this->survey_model->getLastSurvey($id_user);
    // echo $this->survey_model->isTaskCompletedBySurveySample($survey->id_survey);
    if($this->survey_model->isTaskCompletedBySurvey($survey->id_survey)){
      return false;
    } else {
      return true;
    }
  }
}
