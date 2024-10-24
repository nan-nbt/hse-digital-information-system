<?php
defined('BASEPATH') or exit('No direct script access allowed');

class HSE_users_model extends CI_Model
{

	// function rules for validation
	public function rules()
	{
		return [
			['field' => 'fact_no', 'label' => 'Factory', 'rules' => 'required'],
			['field' => 'user_no', 'label' => 'User NO', 'rules' => 'required'],
		];
	}

	// function getAll data on the table
	public function getAll($schema, $dba)
	{
		return $dba->get($schema . '.USERM')->result();
	}

	// function get data by factory on the table
	public function getByFactory($schema, $dba)
	{
		$factory = $this->session->userdata('hse_factory');
		return $dba->get_where($schema . '.USERM', ['FACT_NO' => $factory])->result();
	}

	// function getById data on the table
	public function getById($schema, $dba, $fact_no, $user_no)
	{
		return $dba->get_where($schema . '.USERM', ['FACT_NO' => $fact_no, 'USER_NO' => $user_no])->result();
	}

	// function update last login time
	public function updateLoginTime($schema, $dba, $user_no, $depart)
	{
		$factory = $this->session->userdata('hse_factory');
		$login_time = date('YmdHis');

		if (!isset($user_no)) {
			show_404();
		}

		$sql = "UPDATE $schema.USERM SET L_LOGIN_TIME = '$login_time' WHERE FACT_NO = '$factory' AND USER_NO = '$user_no' AND DEPART = '$depart'";
		$dba->query($sql);
	}
}
