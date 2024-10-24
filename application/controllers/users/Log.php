<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Log extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('HSE_accident_model');
		$this->load->model('HSE_area_model');
		$this->load->model('HSE_factory_model');
		$this->load->model('HSE_users_model');
		$this->load->library('form_validation', 'session');
	}

	// function index
	public function index()
	{
		// $data['tra_factory'] = $this->Tra_factory_model->getAll();
		$this->load->view('users/log/login');
	}

	// function check login session
	public function login()
	{
		$fact_no = $this->input->post('fact_no', true);
		$user_no = $this->input->post('user_no', true);
		$pass = $this->input->post('password', true);

		if ($fact_no == '0228') {
			// $schema = 'PCISISSAP';
			$schema = 'PCISISQAS200';
			$dba = $this->load->database('db_pci', true);
			$this->session->set_userdata('schema', $schema);
		} else if ($fact_no == 'B0CV') {
			// $schema = 'PGDSISSAP';
			$schema = 'PGDSISQAS200';
			$dba = $this->load->database('db_pgd', true);
			$this->session->set_userdata('schema', $schema);
		} else if ($fact_no == 'B0EM') {
			// $schema = 'PGSSISSAP';
			$schema = 'PGSSISQAS200';
			$dba = $this->load->database('db_pgs', true);
			$this->session->set_userdata('schema', $schema);
		} else {
			$this->schema = null;
			$this->dba = null;
			$this->session->set_userdata('schema', $this->schema);
		}

		$data_factory = $this->HSE_factory_model->getById($schema, $dba, $fact_no);
		$data_user = $this->HSE_users_model->getById($schema, $dba, $fact_no, $user_no);

		if (count($data_factory) > 0 && count($data_user) > 0) {
			foreach ($data_factory as $factory) {
				foreach ($data_user as $user) {
					// echo "$user_no == $user->USER_NO && $pass == $user->USER_PSWD && $fact_no == $factory->FACT_NO && $user->FACT_NO == $factory->FACT_NO && $user->DEPART == HSE";
					if ($user_no == trim($user->USER_NO) && $pass == trim($user->USER_PSWD) && $fact_no == $factory->FACT_NO && $user->FACT_NO == $factory->FACT_NO && $user->DEPART == 'HSE') {
						$this->session->set_userdata('hse_factory', $factory->FACT_NO);
						$this->session->set_userdata('hse_sap_factory', $factory->SAP_FACT_NO);
						$this->session->set_userdata('hse_factory_name', $factory->FACT_NAME);
						$this->session->set_userdata('hse_userno', $user->USER_NO);
						$this->session->set_userdata('hse_username', $user->USER_NM);
						$this->session->set_userdata('hse_level', $user->USER_MK);
						$this->HSE_users_model->updateLoginTime($schema, $dba, $user->USER_NO, $user->DEPART);
						redirect(base_url());
					} else {
						$this->session->set_flashdata('warning', 'Incorrect user NO or password! please contact IT if you forget account!');
						redirect(base_url('users/Log'));
					}
				}
			}
		} else {
			$this->session->set_flashdata('warning', 'Account not found in ' . $fact_no . ' factory!');
			redirect(base_url('users/Log'));
		}
	}

	// direct login
	public function directLogin()
	{
		$fact_no = $this->input->post('user_fact_no', true);

		if ($fact_no == '0228') {
			// $schema = 'PCISISSAP';
			$schema = 'PCISISQAS200';
			$dba = $this->load->database('db_pci', true);
			$this->session->set_userdata('schema', $schema);
		} else if ($fact_no == 'B0CV') {
			// $schema = 'PGDSISSAP';
			$schema = 'PGDSISQAS200';
			$dba = $this->load->database('db_pgd', true);
			$this->session->set_userdata('schema', $schema);
		} else if ($fact_no == 'B0EM') {
			// $schema = 'PGSSISSAP';
			$schema = 'PGSSISQAS200';
			$dba = $this->load->database('db_pgs', true);
			$this->session->set_userdata('schema', $schema);
		} else {
			$this->schema = null;
			$this->dba = null;
			$this->session->set_userdata('schema', $this->schema);
		}

		$data_factory = $this->HSE_factory_model->getById($schema, $dba, $fact_no);

		if (count($data_factory) > 0) {
			foreach ($data_factory as $factory) {
				if ($fact_no == $factory->FACT_NO) {
					$this->session->set_userdata('hse_factory', $factory->FACT_NO);
					$this->session->set_userdata('hse_factory_name', $factory->FACT_NAME);
					redirect(base_url());
					// redirect(base_url('users/Accident/infoAccident'));
				} else {
					$this->session->set_flashdata('warning', 'selected data factory not found!');
					redirect(base_url('users/Log'));
				}
			}
		} else {
			$this->session->set_flashdata('warning', 'database connection not found for this factory!');
			redirect(base_url('users/Log'));
		}
	}

	// function logout session
	public function logout()
	{
		$this->session->unset_userdata('hse_factory');
		$this->session->unset_userdata('hse_sap_factory');
		$this->session->unset_userdata('hse_factory_name');
		$this->session->unset_userdata('hse_userno');
		$this->session->unset_userdata('hse_username');
		$this->session->unset_userdata('hse_level');
		redirect(base_url('users/Log'));
	}

	// check session expired
	public function session_check()
	{
		if ($this->session->userdata('hse_factory') == null) {
			echo json_encode(false);
		} else {
			echo json_encode(true);
		}
	}
}
