<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Survey_model extends CI_Model {
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

	public function checkSurvey($id_user){
		$this->db->where('id_user', $id_user);
		$this->db->select('*');
    $this->db->from('survey');
		return $this->db->count_all_results();
	}

	public function getTaskPertanyaanSurvey($id_survey){
		$this->db->where('id_survey', $id_survey);
		$this->db->join('pertanyaan_survey', 'pertanyaan_survey.id_pertanyaan_survey = task_pertanyaan.id_pertanyaan_survey');
		$this->db->join('pernyataan', 'pernyataan.id_pernyataan = pertanyaan_survey.id_pernyataan');
		$this->db->select('*');
		$query = $this->db->get('task_pertanyaan');
		return $query->result();
	}

	public function getSurvey($id_user){
		$this->db->where('id_user', $id_user);
		$this->db->select('*');
		$query = $this->db->get('survey');
		return $query->result();
	}

	public function getSurveyById($id_survey){
		$this->db->where('id_survey', $id_survey);
		$this->db->select('*');
		$query = $this->db->get('survey');
		// return $query->result();
		return $query->row();
	}

	public function addSurvey($params){
		return $this->db->insert("survey", $params);
	}

	public function totalNilaiIntervensi($id_user){
		$this->db->where('user.id_user', $id_user);
		$this->db->join('pertanyaan_survey', 'pertanyaan_survey.id_pertanyaan_survey = task_pertanyaan.id_pertanyaan_survey');
		$this->db->join('survey', 'pertanyaan_survey.id_survey = survey.id_survey');
		$this->db->join('user', 'user.id_user = survey.id_user');
		$this->db->select('nilai');
		$pertanyaan = $this->db->get('task_pertanyaan')->result();

		$nilai = 0;
		foreach ($pertanyaan as $k => $pty) {
			$nilai = $nilai+$pty->nilai;
		}

		return $nilai;
	}

	public function getLastSurvey($id_user){
		$this->db->order_by('id_survey', 'desc');
		$this->db->where('id_user', $id_user);
		$query = $this->db->get('survey');
		return $query->row();
	}

	public function getLastPertanyaan($id_survey){
		$this->db->order_by('id_pertanyaan_survey', 'desc');
		$this->db->where('id_survey', $id_survey);
		$query = $this->db->get('pertanyaan_survey');
		return $query->row();
	}

	public function getLastDateIntervensi($id_survey){
		$this->db->order_by('id_task_pertanyaan', 'desc');
		$this->db->where('id_survey', $id_survey);
		$this->db->join('pertanyaan_survey', 'pertanyaan_survey.id_pertanyaan_survey = task_pertanyaan.id_pertanyaan_survey');
		$query = $this->db->get('task_pertanyaan')->row();
		if($query){
			$timestamp = strtotime($query->tanggal_task);
			$date = strtotime("+1 day", $timestamp);
			return date('Y-m-d H:i:s', $date);
		} else {
			return date('Y-m-d H:i:s', strtotime('+1 day'));
		}
	}

	public function getLastIntervensi($id_survey){
		$this->db->order_by('id_task_pertanyaan', 'desc');
		$this->db->where('id_survey', $id_survey);
		$this->db->join('pertanyaan_survey', 'pertanyaan_survey.id_pertanyaan_survey = task_pertanyaan.id_pertanyaan_survey');
		return $this->db->get('task_pertanyaan')->row();
	}

	public function getIntervensiByDate($data){
		$this->db->join('pertanyaan_survey', 'pertanyaan_survey.id_pertanyaan_survey = task_pertanyaan.id_pertanyaan_survey');
		$this->db->where('tanggal_task', $data->date);
		$this->db->where('id_survey', $data->id_survey);
		return $this->db->get('task_pertanyaan')->row();
	}

	public function addPertanyaanSurvey($params){
		return $this->db->insert("pertanyaan_survey", $params);
	}

	// ======================================================================== //

	public function isPertanyaanAsPernyataanIndikator($id_survey, $id_indikator_mode){
		if($this->getCountPertanyaanByIndikator($id_survey, $id_indikator_mode) == $this->getCountPernyataanByIndikator($id_indikator_mode)){
			return true;
		} else {
			return false;
		}
	}

	public function getNilaiPertanyaanByIndikator($id_survey, $id_indikator_mode){
		$this->db->where('id_indikator_mode', $id_indikator_mode);
		$this->db->where('id_survey', $id_survey);
		$this->db->join('pernyataan', 'pertanyaan_survey.id_pernyataan = pernyataan.id_pernyataan');
		$this->db->select('*');
		$pertanyaan_survey = $this->db->get('pertanyaan_survey')->result();

		$jumlah = 0;
		foreach ($pertanyaan_survey as $k => $pty) {
			$jumlah = $jumlah+$pty->nilai_pertanyaan;
		}
		return $jumlah;
	}

	public function getCountPertanyaanByIndikator($id_survey, $id_indikator_mode){
		$this->db->where('id_indikator_mode', $id_indikator_mode);
		$this->db->where('id_survey', $id_survey);
		$this->db->join('pernyataan', 'pertanyaan_survey.id_pernyataan = pernyataan.id_pernyataan');
		$this->db->select('*');
		$this->db->from('pertanyaan_survey');
		return $this->db->count_all_results();
	}

	public function getCountPernyataanByIndikator($id_indikator_mode){
		$this->db->where('id_indikator_mode', $id_indikator_mode);
		$this->db->select('*');
    $this->db->from('pernyataan');
		return $this->db->count_all_results();
	}

	public function isPertanyaanAsPernyataanAll($id_survey, $id_status){
		if($this->getCountPertanyaanBySurvey($id_survey) == $this->getCountPernyataan($id_status)){
			return true;
		} else {
			return false;
		}
	}

	public function getCountPertanyaanBySurvey($id_survey){
		$this->db->where('id_survey', $id_survey);
		$this->db->select('*');
		$this->db->from('pertanyaan_survey');
		return $this->db->count_all_results();
	}

	public function getCountPernyataan($id_status){
		$this->db->select('*');
		$this->db->where('id_status', $id_status);
    $this->db->from('pernyataan');
		$this->db->join('indikator_mode', 'indikator_mode.id_indikator_mode = pernyataan.id_indikator_mode');
		return $this->db->count_all_results();
	}

	// =================================== //
	// Pencarian skore identitas religius

	public function getCountPernyataanByAspek($id_aspek){
		$this->db->where('id_aspek', $id_aspek);
		$this->db->join('indikator', 'indikator.id_aspek = aspek.id_aspek');
		$this->db->join('pernyataan', 'indikator.id_indikator = pernyataan.id_indikator');
		$this->db->select('*');
    $this->db->from('pernyataan');
		return $this->db->count_all_results();
	}

	public function getNilaiPertanyaanByAspek($id_survey, $id_aspek){
		$this->db->where('id_survey', $id_survey);
		$this->db->where('id_aspek', $id_aspek);
		$this->db->join('pernyataan', 'pertanyaan_survey.id_pernyataan = pernyataan.id_pernyataan');
		$this->db->join('indikator_mode', 'pernyataan.id_indikator_mode = indikator_mode.id_indikator_mode');
		$this->db->join('indikator', 'indikator.id_indikator = indikator_mode.id_indikator');
		$this->db->select('*');
		$pertanyaan_survey = $this->db->get('pertanyaan_survey')->result();

		$jumlah = 0;
		foreach ($pertanyaan_survey as $k => $pty) {
			$jumlah = $jumlah + (int)$pty->nilai_pertanyaan;
		}
		return $jumlah;
	}

	// public function getNilaiPertanyaanBySurvey($id_survey){
	// 	$this->db->where('id_survey', $id_survey);
	// 	$this->db->join('pernyataan', 'pertanyaan_survey.id_pernyataan = pernyataan.id_pernyataan');
	// 	$this->db->join('indikator_mode', 'pernyataan.id_indikator_mode = indikator_mode.id_indikator_mode');
	// 	$this->db->join('indikator', 'pernyataan.id_indikator = indikator.id_indikator');
	// 	$this->db->select('*');
	// 	$pertanyaan_survey = $this->db->get('pertanyaan_survey')->result();
	//
	// 	$jumlah = 0;
	// 	foreach ($pertanyaan_survey as $k => $pty) {
	// 		$jumlah = $jumlah + (int)$pty->nilai_pertanyaan;
	// 	}
	// 	return $jumlah;
	// }

	public function getKlasifikasiScoreByScore($id_aspek, $score){
		$this->db->where('id_aspek', $id_aspek);
		$this->db->where('begin_range <=', $score);
		$this->db->where('due_range >=', $score);
		$this->db->select('*');
		return $this->db->get('klasifikasi_score_identitas')->row();
	}

	public function getSampleKlasifikasiScoreByScore($id_aspek, $score){
		$this->db->where('id_aspek', $id_aspek);
		$this->db->where('begin_range >=', $score);
		$this->db->where('due_range <=', $score);
		$this->db->select('*');
		$this->db->get('klasifikasi_score_identitas');
		return $this->db->last_query();
	}

	public function hitungStatusIdentitasReligius($datas, $id_status){
		$id_klasifikasi_score_identitas = "";
		foreach ($datas as $k => $data) {
			$id_klasifikasi_score_identitas = $id_klasifikasi_score_identitas.$data->type_score.",";
		}
		$this->db->where('type_status_identitas_religius', $id_klasifikasi_score_identitas);
		$this->db->where('id_status', $id_status);
		$this->db->join('desc_status_identitas_religius', 'status_identitas_religius.id_status_identitas_religius = desc_status_identitas_religius.id_status_identitas_religius');
		$this->db->select('*');
		return $this->db->get('status_identitas_religius')->row();
	}

	public function hitungStatusIdentitasReligiusSample($datas){
		$id_klasifikasi_score_identitas = "";
		foreach ($datas as $k => $data) {
			$id_klasifikasi_score_identitas = $id_klasifikasi_score_identitas.$data->type_score.",";
		}
		$this->db->where('type_status_identitas_religius', $id_klasifikasi_score_identitas);
		$this->db->where('id_status', $id_status);
		$this->db->join('desc_status_identitas_religius', 'status_identitas_religius.id_status_identitas_religius = desc_status_identitas_religius.id_status_identitas_religius');
		$this->db->select('*');
		$this->db->get('status_identitas_religius')->row();
		return $this->db->last_query();
	}

	public function getScoreIdentitasSurvey($id_survey){
		$this->db->where('id_survey', $id_survey);
		$this->db->select('*');
		return $this->db->get('score_identitas_survey')->result();
	}

	public function getCountTaskIntervensiBySurvey($id_survey){
		$this->db->where('id_survey', $id_survey);
    $this->db->join('pertanyaan_survey', 'pertanyaan_survey.id_pertanyaan_survey = task_pertanyaan.id_pertanyaan_survey');
		$this->db->select('*');
		$this->db->from('task_pertanyaan');
		return $this->db->count_all_results();
	}

	public function updateScoreSurvey($id_status_identitas_religius, $id_survey){
		$this->db->where("id_survey", $id_survey);
		return $this->db->update("survey", ['id_status_identitas_religius' => $id_status_identitas_religius]);
	}

	public function getTaskPertanyaan($id_intervensi){
		$this->db->where('id_task_pertanyaan', $id_intervensi);
		return $this->db->get('task_pertanyaan')->row();
	}

	public function isTaskCompletedBySurvey($id_survey){
		$this->db->where('id_survey', $id_survey);
		$this->db->where("tanggal_task >= ", date('Y-m-d'));
		$this->db->join('pertanyaan_survey', 'pertanyaan_survey.id_pertanyaan_survey = task_pertanyaan.id_pertanyaan_survey');
		$this->db->select('*');
		return $this->db->get('task_pertanyaan')->result();
	}

	public function isTaskPassedBySurvey($id_survey){
		$this->db->where('id_survey', $id_survey);
		$this->db->where("tanggal_task >= ", date('Y-m-d', strtotime(date('Y-m-d') . "+1 days")));
		$this->db->join('pertanyaan_survey', 'pertanyaan_survey.id_pertanyaan_survey = task_pertanyaan.id_pertanyaan_survey');
		$this->db->select('*');
		return $this->db->get('task_pertanyaan')->result();
	}

	public function isTaskCompletedBySurveySample($id_survey){
		$this->db->where('id_survey', $id_survey);
		$this->db->where("tanggal_task >= ", date('Y-m-d'));
		$this->db->join('pertanyaan_survey', 'pertanyaan_survey.id_pertanyaan_survey = task_pertanyaan.id_pertanyaan_survey');
		$this->db->select('*');
		$this->db->get('task_pertanyaan');
		return $this->db->last_query();
	}

	public function surveySaya($id_user, $id_status){
		$this->db->where('id_user', $id_user);
		$this->db->where('id_status', $id_status);
		$this->db->join('status_identitas_religius', 'survey.id_status_identitas_religius = status_identitas_religius.id_status_identitas_religius');
		$this->db->join('desc_status_identitas_religius', 'desc_status_identitas_religius.id_status_identitas_religius = status_identitas_religius.id_status_identitas_religius');
		$this->db->select('*');
		return $this->db->get('survey')->result();
	}

	public function detailSurveySaya($id_survey){
		$this->db->where('id_survey', $id_survey);
		$this->db->join('pernyataan', 'pernyataan.id_pernyataan = pertanyaan_survey.id_pernyataan');
		$this->db->select('*');
		return $this->db->get('pertanyaan_survey')->result();
	}

	public function scoreIdentitasBySurvey($id_survey){
		$this->db->where('id_survey', $id_survey);
		// $this->db->join('klasifikasi_score_identitas', 'score_identitas_survey.id_klasifikasi_score_identitas = klasifikasi_score_identitas.id_klasifikasi_score_identitas');
		$this->db->select('*');
		return $this->db->get('score_identitas_survey')->result();
	}

	public function laporanSurveySaya($id_user, $id_status){
		$result = array();
		$this->db->where('id_user', $id_user);
		$this->db->where('id_status', $id_status);
		$this->db->join('status_identitas_religius', 'survey.id_status_identitas_religius = status_identitas_religius.id_status_identitas_religius');
		$this->db->join('desc_status_identitas_religius', 'desc_status_identitas_religius.id_status_identitas_religius = status_identitas_religius.id_status_identitas_religius');
		$this->db->select('*');
		$survey = $this->db->get('survey')->result();
		foreach ($survey as $k => $srv) {
			$srv->identitas_survey = $this->scoreIdentitasBySurvey($srv->id_survey);
			array_push($result, $srv);
		}
		return $result;
  }
	public function getPertanyaanByIdSurvey($id_survey){
		$this->db->where('survey.id_survey', $id_survey);
		$this->db->join('pertanyaan_survey', 'survey.id_survey = pertanyaan_survey.id_survey');
		$this->db->join('pernyataan', 'pernyataan.id_pernyataan = pertanyaan_survey.id_pernyataan');
		$this->db->select('*');
		return $this->db->get('survey')->result();
	}

	public function getSubmitDatePertanyaan($id_pertanyaan){
		$this->db->where('id_pertanyaan_survey', $id_pertanyaan);
		$this->db->select('*');
		return $this->db->get('task_pertanyaan')->row();
	}

	public function getTaskIntervensiByPertanyaan($id_pertanyaan){
		$this->db->where('task_pertanyaan.id_pertanyaan_survey', $id_pertanyaan);
		$this->db->select('*');
		$this->db->join('pertanyaan_survey', 'pertanyaan_survey.id_pertanyaan_survey = task_pertanyaan.id_pertanyaan_survey');
		$this->db->join('pernyataan', 'pertanyaan_survey.id_pernyataan = pernyataan.id_pernyataan');
		return $this->db->get('task_pertanyaan')->row();
	}

	public function checkIntervensiToday($id_user){
		$this->db->where('id_user', $id_user);
		$this->db->where('date_format(tanggal_task,"%Y-%m-%d")', "CURDATE()", FALSE);
		$this->db->join('pertanyaan_survey', 'pertanyaan_survey.id_survey = survey.id_survey');
		$this->db->join('task_pertanyaan', 'task_pertanyaan.id_pertanyaan_survey = task_pertanyaan.id_pertanyaan_survey');
		$this->db->distinct();
		$this->db->select('task_pertanyaan.tanggal_task');
		return $this->db->get('survey')->result();
	}

	public function checkIntervensiTodaySample($id_user){
		$this->db->where('id_user', $id_user);
		$this->db->where('date_format(tanggal_task,"%Y-%m-%d")', "CURDATE()", FALSE);
		$this->db->join('pertanyaan_survey', 'pertanyaan_survey.id_survey = survey.id_survey');
		$this->db->join('task_pertanyaan', 'task_pertanyaan.id_pertanyaan_survey = task_pertanyaan.id_pertanyaan_survey');
		$this->db->distinct();
		$this->db->select('task_pertanyaan.tanggal_task');
		$this->db->get('survey');
		return $this->db->last_query();
	}

	public function getNilaiPertanyaanBySurvey($id_survey){
		$this->db->where('id_survey', $id_survey);
		$this->db->join('pernyataan', 'pertanyaan_survey.id_pernyataan = pernyataan.id_pernyataan');
		$this->db->join('indikator_mode', 'pernyataan.id_indikator_mode = indikator_mode.id_indikator_mode');
		$this->db->join('indikator', 'indikator.id_indikator = indikator_mode.id_indikator');
		$this->db->select('*');
		$pertanyaan_survey = $this->db->get('pertanyaan_survey')->result();

		$jumlah = 0;
		foreach ($pertanyaan_survey as $k => $pty) {
			$jumlah = $jumlah + (int)$pty->nilai_pertanyaan;
		}
		return $jumlah;
	}

	// public function detailSurveySaya($id_survey){
	// 	$this->db->where('id_survey', $id_survey);
	// 	$this->db->join('pernyataan', 'pernyataan.id_pernyataan = pertanyaan_survey.id_pernyataan');
	// 	$this->db->select('*');
	// 	return $this->db->get('pertanyaan_survey')->result();
	// }

}
