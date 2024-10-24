<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Audit extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('HSE_accident_model');
		$this->load->model('HSE_audit_model');
		$this->load->model('HSE_area_model');
		$this->load->model('HSE_build_model');
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
			$data['hse_audit'] = $this->HSE_audit_model->getDataAllAspect($this->schema, $this->dba);
		}

		$this->load->view('users/process/audit/list', $data);
	}

	public function dataAllAspect()
	{
		if ($this->schema != null && $this->dba != null) {
			$data = $this->HSE_audit_model->getDataAllAspect($this->schema, $this->dba);
			echo json_encode($data);
		}
	}

	public function dataAllAspectBySubmitId()
	{
		$submit_id = $this->input->post('submit_id', true);

		if ($this->schema != null && $this->dba != null) {
			$data = $this->HSE_audit_model->getDataAllAspectBySubmitId($this->schema, $this->dba, $submit_id);
			echo json_encode($data);
		}
	}

	public function dataArea()
	{
		if ($this->schema != null && $this->dba != null) {
			$data = $this->HSE_area_model->getByFactory($this->schema, $this->dba);
			echo json_encode($data);
		}
	}

	public function dataBuild()
	{
		$area_no = $this->input->post('area_no', true);

		if ($this->schema != null && $this->dba != null) {
			$data = $this->HSE_build_model->getByArea($this->schema, $this->dba, $area_no);
			echo json_encode($data);
		}
	}

	public function dataRecAudit()
	{
		$area_no = $this->input->post('area_no_query', true);
		$datestart = $this->input->post('startdate', true);
		$dateend = $this->input->post('enddate', true);

		if (!isset($area_no, $datestart, $dateend)) {
			$data = $this->HSE_audit_model->getRecAudit($this->schema, $this->dba, null, date('Ymd'), date('Ymd'));
			echo json_encode($data);
		} else {
			$data = $this->HSE_audit_model->getRecAudit($this->schema, $this->dba, $area_no, $datestart, $dateend);
			echo json_encode($data);
		}
	}

	public function dataRecAuditDetail()
	{
		$submit_id = $this->input->post('submit_id', true);

		if (!isset($submit_id)) {
			$data = $this->HSE_audit_model->getDataAllAspectBySubmitId($this->schema, $this->dba, null);
			echo json_encode($data);
		} else {
			$data = $this->HSE_audit_model->getDataAllAspectBySubmitId($this->schema, $this->dba, $submit_id);
			echo json_encode($data);
		}
	}

	public function infoAudit()
	{
		if ($this->schema != null && $this->dba != null) {
			$data['hse_accident'] = $this->HSE_accident_model->getByFactory($this->schema, $this->dba);
			$data['hse_current_accident'] = $this->HSE_accident_model->getCurrentAccident($this->schema, $this->dba);
			$data['hse_max_date'] = $this->HSE_accident_model->getMaxDate($this->schema, $this->dba);
			$data['hse_area'] = $this->HSE_area_model->getByFactory($this->schema, $this->dba);
			$data['hse_audit'] = $this->HSE_audit_model->getDataAllAspect($this->schema, $this->dba);
		}

		$this->load->view('users/info/audit/info', $data);
	}

	public function infoAuditByArea()
	{
		if ($this->schema != null && $this->dba != null) {
			$data['hse_accident'] = $this->HSE_accident_model->getByFactory($this->schema, $this->dba);
			$data['hse_current_accident'] = $this->HSE_accident_model->getCurrentAccident($this->schema, $this->dba);
			$data['hse_max_date'] = $this->HSE_accident_model->getMaxDate($this->schema, $this->dba);
			$data['hse_area'] = $this->HSE_area_model->getByFactory($this->schema, $this->dba);
			$data['hse_audit'] = $this->HSE_audit_model->getDataAllAspect($this->schema, $this->dba);
		}

		$this->load->view('users/info/audit/info_area', $data);
	}

	public function dataAuditLayout()
	{
		$indate = $this->input->post('indate', true);
		$area_no = $this->input->post('area_no', true);
		$build_no = $this->input->post('build_no', true);

		if ($this->schema != null && $this->dba != null) {
			$data = $this->HSE_audit_model->getDataAuditLayout($this->schema, $this->dba, $indate, $area_no, $build_no);
			echo json_encode($data);
		}
	}

	public function dataAuditLayoutArea()
	{
		$indate = $this->input->post('indate', true);
		$area_no = $this->input->post('area_no', true);

		if ($this->schema != null && $this->dba != null) {
			$data = $this->HSE_audit_model->getDataAuditLayoutArea($this->schema, $this->dba, $indate, $area_no);
			echo json_encode($data);
		}
	}

	public function dataAuditLayoutDetail()
	{
		$indate = $this->input->post('indate-detail', true);
		$area_no = $this->input->post('area-detail', true);
		$build_no = $this->input->post('build-detail', true);

		if ($this->schema != null && $this->dba != null) {
			$data['detail_audit'] = $this->HSE_audit_model->getDataAuditLayout($this->schema, $this->dba, $indate, $area_no, $build_no);
			// echo json_encode($data);
		}

		$this->load->view('users/info/audit/detail', $data);
	}

	public function dataAuditLayoutDetailArea()
	{
		$indate = $this->input->post('indate-detail', true);
		$area_no = $this->input->post('area-detail', true);

		if ($this->schema != null && $this->dba != null) {
			$data['detail_audit_area'] = $this->HSE_audit_model->getDataAuditLayoutArea($this->schema, $this->dba, $indate, $area_no);
			// echo json_encode($data);
		}

		$this->load->view('users/info/audit/detail_area', $data);
	}

	public function add()
	{
		$audit = $this->HSE_audit_model;
		$validation = $this->form_validation;
		$validation->set_rules($audit->rules());

		// condition if validation is ture
		if ($validation->run()) {
			// master data input
			$fact_no = $this->session->userdata('hse_factory');
			$submit_id = 'HSE' . $fact_no . md5(date('YmdHis.u'));
			$submit_user = $this->session->userdata('hse_userno');;
			$submit_date = date('YmdHis');
			$check_date = preg_replace("/[^0-9]/", "", $this->input->post('checkdate', true));
			$area_no = $this->input->post('area_no', true);
			$build_no = $this->input->post('build_no', true);
			$auditee = $this->input->post('auditee', true);
			$auditor = $this->input->post('auditor', true);
			$nlti = $this->input->post('nlti', true);
			$ltil3 = $this->input->post('ltil3', true);
			$ltim3 = $this->input->post('ltim3', true);
			$lostday = $this->input->post('lostday', true);
			$aparo1 = $this->input->post('aparo1', true);
			$aparm1 = $this->input->post('aparm1', true);
			$lti = (int)$ltil3 + (int)$ltim3;

			// detail data input
			$submit_seq = $this->input->post('submit_seq', true);
			$saspect = $this->input->post('saspect', true);
			$weight = $this->input->post('weight', true);
			$score = $this->input->post('score', true);
			$issue = $this->input->post('issue', true);
			$remark = $this->input->post('remark', true);

			// set parameters
			$master_data = array(
				'FACT_NO' => $fact_no,
				'SUBMIT_ID' => $submit_id,
				'SUBMIT_USER' => $submit_user,
				'SUBMIT_DATE' => $submit_date,
				'CHECK_DATE' => $check_date,
				'AREA_NO' => $area_no,
				'BUILD_NO' => $build_no,
				'AUDITEE' => $auditee,
				'AUDITOR' => $auditor,
				'LTI' => $lti,
				'NLTI' => $nlti,
				'LOST_DAY' => $lostday,
				'LTI_L3' => $ltil3,
				'LTI_M3' => $ltim3,
				'APAR_O1' => $aparo1,
				'APAR_M1' => $aparm1,
			);

			// method to insert detail data when master data have defect QTY > 0
			if ($submit_seq != null) {
				// set parameters
				$detail_data = array();
				$index = 0;

				foreach ($submit_seq as $sequence) {
					if ($saspect[$index] == 'E101') {
						if ($score[$index] == 0) {
							$total = 0;
						} else {
							$total = -30.00;
						}
					} else if ($saspect[$index] == 'E102') {
						if ($score[$index] == 0) {
							$total = 0;
						} else {
							$total = -45.00;
						}
					} else if ($saspect[$index] == 'E103') {
						if ($score[$index] == 0) {
							$total = 20.00;
						} else {
							$total = 0;
						}
					} else {
						$total = (float)$weight[$index] * (float)$score[$index] / 2;
					}

					array_push($detail_data, array(
						'FACT_NO' => $fact_no,
						'SUBMIT_ID' => $submit_id,
						'SUBMIT_SEQ' => $sequence,
						'SASPECT_NO' => $saspect[$index],
						'SCORE' => (float)$score[$index],
						'TOTAL' => $total,
						'DESC_ISSUE' => $issue[$index],
						'REMARK' => $remark[$index]
					));

					$index++;
				}
			} else {
				$detail_data = null;
			}

			if ($detail_data != null) {
				// call function save in model using parameter
				$data = $audit->save($this->schema, $this->dba, $master_data, $detail_data);
				echo json_encode($data);
			} else {
				echo json_encode(false);
			}
		} else {
			show_404();
		}
	}

	public function edit()
	{
		// master data input
		$fact_no = $this->session->userdata('hse_factory');
		$submit_id = $this->input->post('submit_id', true);
		// $submit_user = $this->session->userdata('hse_userno');;
		// $submit_date = date('YmdHis');
		$check_date = preg_replace("/[^0-9]/", "", $this->input->post('checkdate', true));
		$area_no = $this->input->post('area_no', true);
		$build_no = $this->input->post('build_no', true);
		$auditee = $this->input->post('auditee', true);
		$auditor = $this->input->post('auditor', true);
		$nlti = $this->input->post('nlti', true);
		$ltil3 = $this->input->post('ltil3', true);
		$ltim3 = $this->input->post('ltim3', true);
		$lostday = $this->input->post('lostday', true);
		$aparo1 = $this->input->post('aparo1', true);
		$aparm1 = $this->input->post('aparm1', true);
		$modify_date = date('YmdHis');
		$modify_user = $this->session->userdata('hse_userno');
		$lti = (int)$ltil3 + (int)$ltim3;

		// detail data input
		$submit_seq = $this->input->post('submit_seq', true);
		$saspect = $this->input->post('saspect', true);
		$weight = $this->input->post('weight', true);
		$score = $this->input->post('score', true);
		$issue = $this->input->post('issue', true);
		$remark = $this->input->post('remark', true);

		// check id variable
		if ($submit_id == null && $submit_seq == null && $score == null) {
			echo json_encode(false);
		}

		$audit = $this->HSE_audit_model;
		$validation = $this->form_validation;
		$validation->set_rules($audit->rules());

		// condition if validation is ture
		if ($validation->run()) {
			// set parameters
			$master_data = array(
				'FACT_NO' => $fact_no,
				'SUBMIT_ID' => $submit_id,
				// 'SUBMIT_USER' => $submit_user,
				// 'SUBMIT_DATE' => $submit_date,                        
				'CHECK_DATE' => $check_date,
				'AREA_NO' => $area_no,
				'BUILD_NO' => $build_no,
				'AUDITEE' => $auditee,
				'AUDITOR' => $auditor,
				'MODIFY_DATE' => $modify_date,
				'MODIFY_USER' => $modify_user,
				'LTI' => $lti,
				'NLTI' => $nlti,
				'LOST_DAY' => $lostday,
				'LTI_L3' => $ltil3,
				'LTI_M3' => $ltim3,
				'APAR_O1' => $aparo1,
				'APAR_M1' => $aparm1,
			);

			// method to insert detail data when master data have defect QTY > 0
			if ($submit_seq != null) {
				// set parameters
				$detail_data = array();
				$index = 0;

				foreach ($submit_seq as $sequence) {
					if ($saspect[$index] == 'E101') {
						if ($score[$index] == 0) {
							$total = 0;
						} else {
							$total = -30.00;
						}
					} else if ($saspect[$index] == 'E102') {
						if ($score[$index] == 0) {
							$total = 0;
						} else {
							$total = -45.00;
						}
					} else if ($saspect[$index] == 'E103') {
						if ($score[$index] == 0) {
							$total = 20.00;
						} else {
							$total = 0;
						}
					} else {
						$total = (float)$weight[$index] * (float)$score[$index] / 2;
					}

					array_push($detail_data, array(
						'FACT_NO' => $fact_no,
						'SUBMIT_ID' => $submit_id,
						'SUBMIT_SEQ' => $sequence,
						'SASPECT_NO' => $saspect[$index],
						'SCORE' => $score[$index],
						'TOTAL' => $total,
						'DESC_ISSUE' => $issue[$index],
						'REMARK' => $remark[$index]
					));

					$index++;
				}
			} else {
				$detail_data = null;
			}

			if ($detail_data != null) {
				// call function update in model using parameter
				$data = $audit->update($this->schema, $this->dba, $master_data, $detail_data, $submit_id);
				echo json_encode($data);
			} else {
				echo json_encode(false);
			}
		} else {
			show_404();
		}
	}

	// function delete
	public function delete($id = null)
	{
		if (!isset($id)) {
			show_404();
		}

		$data = $this->HSE_audit_model->delete($this->schema, $this->dba, $id);
		echo json_encode($data);
	}
}
