<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Accident extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('HSE_accident_model');
		$this->load->model('HSE_area_model');
		$this->load->library('form_validation', 'session', 'datatables');

		if ($this->session->userdata('hse_factory') == '0228') {
			// $this->schema = 'PCISISSAP';
			$this->schema = 'PCISISQAS200';
			$this->dba = $this->load->database('db_pci', true);
			$this->session->set_userdata('schema', $this->schema);
		} else if ($this->session->userdata('hse_factory') == 'B0CV') {
			// $this->schema = 'PGDSISSAP';
			$this->schema = 'PGDSISQAS200';
			$this->dba = $this->load->database('db_pgd', true);
			$this->session->set_userdata('schema', $this->schema);
		} else if ($this->session->userdata('hse_factory') == 'B0EM') {
			// $this->schema = 'PGSSISSAP';
			$this->schema = 'PGSSISQAS200';
			$this->dba = $this->load->database('db_pgs', true);
			$this->session->set_userdata('schema', $this->schema);
		} else {
			$this->schema = null;
			$this->dba = null;
			$this->session->set_userdata('schema', $this->schema);
		}
	}

	// function index
	public function index()
	{
		if ($this->schema != null && $this->dba != null) {
			$data['hse_accident'] = $this->HSE_accident_model->getByFactory($this->schema, $this->dba);
			$data['hse_current_accident'] = $this->HSE_accident_model->getCurrentAccident($this->schema, $this->dba);
			$data['hse_area'] = $this->HSE_area_model->getByFactory($this->schema, $this->dba);
		}

		$this->load->view('users/process/accident/list', $data);
	}

	// function data area
	public function dataArea()
	{
		if ($this->schema != null && $this->dba != null) {
			$data = $this->HSE_area_model->getByFactory($this->schema, $this->dba);
			echo json_encode($data);
		}
	}

	// function direct to information accident
	public function infoAccident()
	{
		if ($this->schema != null && $this->dba != null) {
			$data['hse_accident'] = $this->HSE_accident_model->getByFactory($this->schema, $this->dba);
			$data['hse_current_accident'] = $this->HSE_accident_model->getCurrentAccident($this->schema, $this->dba);
			$data['hse_max_date'] = $this->HSE_accident_model->getMaxDate($this->schema, $this->dba);
			$data['hse_area'] = $this->HSE_area_model->getByFactory($this->schema, $this->dba);
		}

		$this->load->view('users/info/accident/info', $data);
	}

	// function direct to information accident detail
	public function infoAccidentDetail()
	{
		if ($this->schema != null && $this->dba != null) {
			$data['hse_accident'] = $this->HSE_accident_model->getByFactory($this->schema, $this->dba);
			$data['hse_current_accident'] = $this->HSE_accident_model->getCurrentAccident($this->schema, $this->dba);
			$data['hse_max_date'] = $this->HSE_accident_model->getMaxDate($this->schema, $this->dba);
			$data['hse_area'] = $this->HSE_area_model->getByFactory($this->schema, $this->dba);
		}

		$this->load->view('users/info/accident/detail', $data);
	}

	// function direct to information accident
	public function infoAccidentByArea()
	{
		if ($this->schema != null && $this->dba != null) {
			$data['hse_accident'] = $this->HSE_accident_model->getByFactory($this->schema, $this->dba);
			$data['hse_current_accident'] = $this->HSE_accident_model->getCurrentAccident($this->schema, $this->dba);
			$data['hse_max_date'] = $this->HSE_accident_model->getMaxDate($this->schema, $this->dba);
			$data['hse_area'] = $this->HSE_area_model->getByFactory($this->schema, $this->dba);
		}

		$this->load->view('users/info/accident/info_area', $data);
	}

	// function direct to information accident detail
	public function infoAccidentByAreaDetail()
	{
		if ($this->schema != null && $this->dba != null) {
			$data['hse_accident'] = $this->HSE_accident_model->getByFactory($this->schema, $this->dba);
			$data['hse_current_accident'] = $this->HSE_accident_model->getCurrentAccident($this->schema, $this->dba);
			$data['hse_max_date'] = $this->HSE_accident_model->getMaxDate($this->schema, $this->dba);
			$data['hse_area'] = $this->HSE_area_model->getByFactory($this->schema, $this->dba);
		}

		$this->load->view('users/info/accident/detail_area', $data);
	}

	// function realtime current accident
	function realtimeAccident()
	{
		if ($this->schema != null && $this->dba != null) {
			$data = $this->HSE_accident_model->getCurrentAccident($this->schema, $this->dba);
			echo json_encode($data);
		}
	}

	// get data accident by area and date
	public function getAccident()
	{
		$area_no = $this->input->post('area_no_query', true);
		$datestart = $this->input->post('startdate', true);
		$dateend = $this->input->post('enddate', true);
		if (!isset($area_no, $datestart, $dateend)) {
			$data = $this->HSE_accident_model->getDataAccident($this->schema, $this->dba, null, date('Ymd'), date('Ymd'));
			echo json_encode($data);
		} else {
			$data = $this->HSE_accident_model->getDataAccident($this->schema, $this->dba, $area_no, $datestart, $dateend);
			echo json_encode($data);
		}
	}

	// get data accident by date range
	public function dataAccidentByDate()
	{
		$datestart = $this->input->post('startdate', true);
		$dateend = $this->input->post('enddate', true);

		if (!isset($datestart, $dateend)) {
			$data = $this->HSE_accident_model->getDataAccidentByDate($this->schema, $this->dba, date('Ymd'), date('Ymd'));
			echo json_encode($data);
		} else {
			$data = $this->HSE_accident_model->getDataAccidentByDate($this->schema, $this->dba, $datestart, $dateend);
			echo json_encode($data);
		}
	}

	public function dataAccidentByDateDetail()
	{
		$datestart = $this->input->post('startdate-detail', true);
		$dateend = $this->input->post('enddate-detail', true);

		if ($this->schema != null && $this->dba != null) {
			$data['detail_accident'] = $this->HSE_accident_model->getDataAccidentByDate($this->schema, $this->dba, $datestart, $dateend);
			$data['datestart'] = $datestart;
			$data['dateend'] = $dateend;
			// echo json_encode($data);
		}

		$this->load->view('users/info/accident/detail', $data);
	}

	// get data accident by date range
	public function dataAccidentAreaByDate()
	{
		$datestart = $this->input->post('startdate', true);
		$dateend = $this->input->post('enddate', true);

		if (!isset($datestart, $dateend)) {
			$data = $this->HSE_accident_model->getDataAccidentAreaByDate($this->schema, $this->dba, date('Ymd'), date('Ymd'));
			echo json_encode($data);
		} else {
			$data = $this->HSE_accident_model->getDataAccidentAreaByDate($this->schema, $this->dba, $datestart, $dateend);
			echo json_encode($data);
		}
	}

	public function dataAccidentAreaByDateDetail()
	{
		$datestart = $this->input->post('startdate-detail', true);
		$dateend = $this->input->post('enddate-detail', true);

		if ($this->schema != null && $this->dba != null) {
			$data['detail_accident'] = $this->HSE_accident_model->getDataAccidentAreaByDate($this->schema, $this->dba, $datestart, $dateend);
			$data['datestart'] = $datestart;
			$data['dateend'] = $dateend;
			// echo json_encode($data);
		}

		$this->load->view('users/info/accident/detail_area', $data);
	}

	// function add
	public function add()
	{
		$accident = $this->HSE_accident_model;
		$validation = $this->form_validation;
		$validation->set_rules($accident->rules());

		// condition if validation is ture
		if ($validation->run()) {
			// master input data
			$fact_no = $this->session->userdata('hse_factory');
			$submit_id = 'HSE' . $fact_no . md5(date('YmdHis.u'));
			$submit_user = $this->session->userdata('hse_userno');;
			$submit_date = date('YmdHis');
			$area_no = $this->input->post('area_no', true);
			$area_score = $this->input->post('area_score', true);
			$tot_lti = $this->input->post('tot_lti', true);
			$tot_nlti = $this->input->post('tot_nlti', true);
			$tot_lost_day = $this->input->post('tot_lost_day', true);
			$tot_accident = $this->input->post('tot_accident', true);

			$master_data = array(
				'FACT_NO' => $fact_no,
				'SUBMIT_ID' => $submit_id,
				'SUBMIT_USER' => $submit_user,
				'SUBMIT_DATE' => $submit_date,
				'AREA_NO' => $area_no,
				'AREA_SCORE' => $area_score,
				'TOT_LTI' => $tot_lti,
				'TOT_NLTI' => $tot_nlti,
				'TOT_LOST_DAY' => $tot_lost_day,
				'TOT_ACCIDENT' => $tot_accident
			);

			if ($master_data != null) {
				$data = $accident->save($this->schema, $this->dba, $master_data);
				echo json_encode($data);
			} else {
				echo json_encode(false);
			}
		} else {
			show_404();
		}
	}
}
