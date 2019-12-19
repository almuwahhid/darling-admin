<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'controllers/BaseAdminController.php');

class Survey extends BaseAdminController {
	public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
				$this->load->model('survey_model');
		    $this->load->model('main_model');
		    $this->load->model('users_model');
	}

	public function index() {
    $page = $this->input->get('p');
		$booking = $this->users_model->get($page);
		$jumlah = $this->users_model->totalUser();
    $asd['user'] = $booking;
    $asd['jumlah'] = $jumlah;
    $asd['page'] = $page;
    parent::getView('m_user/list_user', 'survey', $asd);
	}

	public function detail($id_user){
    $data = array();
		$user = $this->users_model->get_user_by_id($id_user);
		$data['survey'] = $this->survey_model->laporanSurveySaya($id_user, $user->id_status);
    $data['id_user'] = $id_user;
    $data['user'] = $user;
		parent::getView('m_survey/list_survey', 'survey', $data);
	}

	public function pertanyaan($id_survey){
    $data = array();
		$id_user = $this->input->get('id_user');
		$data['survey'] = $this->survey_model->getSurveyById($id_survey);

		$pertanyaan = array();
		foreach ($this->survey_model->getPertanyaanByIdSurvey($id_survey) as $k => $pyt) {
			if($this->survey_model->getSubmitDatePertanyaan($pyt->id_pertanyaan_survey))
				$pyt->tanggal_submit = $this->survey_model->getSubmitDatePertanyaan($pyt->id_pertanyaan_survey)->tanggal_submit;
			else
				$pyt->tanggal_submit = "-";
			array_push($pertanyaan, $pyt);
		}

		$data['detail'] = $pertanyaan;
    $data['id_user'] = $id_user;
		parent::getView('m_survey/detail_survey', 'survey', $data);
	}

	public function taskintervensi($id_pertanyaan){
    $data = array();
		$id_user = $this->input->get('id_user');
		$tanggal_survey = $this->input->get('tanggal_survey');
		$id_survey = $this->input->get('id_survey');
		$data['detail'] = $this->survey_model->getTaskIntervensiByPertanyaan($id_pertanyaan);
    $data['id_user'] = $id_user;
    $data['id_survey'] = $id_survey;
    $data['tanggal_survey'] = $tanggal_survey;
		parent::getView('m_survey/detail_intervensi', 'survey', $data);
	}

	public function konfirmasi(){
		$id_booking = $this->input->get('id');
		$status = $this->input->get('status');

		if($status == '1'){
			$params = array('confirmed' => 'Y');
		} else {
			$params = array('deleted_at' => date('Y-m-d H:i:s'));
		}

		$insert = $this->main_model->update($params, 'booking', ['id_booking' => $id_booking]);
		if ($insert) {
			$this->session->set_flashdata('alert', array('message' => 'Berhasil menghapus foto','class' => 'success'));
			redirect('booking');
		} else {
			$this->session->set_flashdata('alert', array('message' => 'Gagal menghapus foto','class' => 'danger'));
			redirect('booking');
		}
	}


}
