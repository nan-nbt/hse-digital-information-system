<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('HSE_accident_model');
		$this->load->model('HSE_area_model');
		$this->load->model('HSE_build_model');
		$this->load->model('HSE_dimention_model');
		$this->load->model('HSE_aspect_model');
		$this->load->model('HSE_subaspect_model');
		$this->load->library('form_validation', 'session');

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

	public function index($id = null)
	{
		if ($this->schema != null && $this->dba != null) {
			$data['hse_accident'] = $this->HSE_accident_model->getByFactory($this->schema, $this->dba);
			$data['hse_current_accident'] = $this->HSE_accident_model->getCurrentAccident($this->schema, $this->dba);
			$data['hse_area'] = $this->HSE_area_model->getByFactory($this->schema, $this->dba);
		}

		$this->load->view('layouts/dashboard', $data);
	}

	public function basicDataArea()
	{
		if ($this->schema != null && $this->dba != null) {
			$data['hse_area'] = $this->HSE_area_model->getByFactory($this->schema, $this->dba);
		}

		$this->load->view('users/basic/area/list', $data);
	}

	public function basicDataBuild()
	{
		if ($this->schema != null && $this->dba != null) {
			$data['hse_build'] = $this->HSE_build_model->getByFactory($this->schema, $this->dba);
		}

		$this->load->view('users/basic/building/list', $data);
	}

	public function basicDataDim()
	{
		if ($this->schema != null && $this->dba != null) {
			$data['hse_dim'] = $this->HSE_dimention_model->getByFactory($this->schema, $this->dba);
		}

		$this->load->view('users/basic/dimention/list', $data);
	}

	public function basicDataAspect()
	{
		if ($this->schema != null && $this->dba != null) {
			$data['hse_aspect'] = $this->HSE_aspect_model->getByFactory($this->schema, $this->dba);
		}

		$this->load->view('users/basic/aspect/list', $data);
	}

	public function basicDataSubAspect()
	{
		if ($this->schema != null && $this->dba != null) {
			$data['hse_subaspect'] = $this->HSE_subaspect_model->getByFactory($this->schema, $this->dba);
		}

		$this->load->view('users/basic/subaspect/list', $data);
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
		if ($this->schema != null && $this->dba != null) {
			$data = $this->HSE_build_model->getByFactory($this->schema, $this->dba);
			echo json_encode($data);
		}
	}

	public function dataDimention()
	{
		if ($this->schema != null && $this->dba != null) {
			$data = $this->HSE_dimention_model->getByFactory($this->schema, $this->dba);
			echo json_encode($data);
		}
	}

	public function dataAspect()
	{
		if ($this->schema != null && $this->dba != null) {
			$data = $this->HSE_aspect_model->getByFactory($this->schema, $this->dba);
			echo json_encode($data);
		}
	}

	public function dataSubAspect()
	{
		if ($this->schema != null && $this->dba != null) {
			$data = $this->HSE_subaspect_model->getByFactory($this->schema, $this->dba);
			echo json_encode($data);
		}
	}
}
