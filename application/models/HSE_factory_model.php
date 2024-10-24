<?php
defined('BASEPATH') or exit('No direct script access allowed');

class HSE_factory_model extends CI_Model
{

	// function rules for validation
	public function rules()
	{
		return [
			['field' => 'fact_no', 'label' => 'Factory', 'rules' => 'required']
		];
	}

	// function getAll data on the table
	public function getAll($schema, $dba)
	{
		return $dba->get($schema . '.FACTORY')->result();
	}

	// function get data by factory on the table
	public function getByFactory($schema, $dba)
	{
		$factory = $this->session->userdata('hse_factory');
		$dba->order_by('FACT_NO', 'DESC');
		return $dba->get_where($schema . '.FACTORY', ['FACT_NO' => $factory])->result();
	}

	// function getById data on the table
	public function getById($schema, $dba, $fact_no)
	{
		return $dba->get_where($schema . '.FACTORY', ['FACT_NO' => $fact_no])->result();
	}
}
