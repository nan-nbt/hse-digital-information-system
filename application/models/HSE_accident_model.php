<?php
defined('BASEPATH') or exit('No direct script access allowed');

class HSE_accident_model extends CI_Model
{

	// function rules for validation
	public function rules()
	{
		return [
			['field' => 'area_no', 'label' => 'Area', 'rules' => 'required'],
			['field' => 'area_score', 'label' => 'Area Score', 'rules' => 'required'],
			['field' => 'tot_lti', 'label' => 'Total LTI', 'rules' => 'required'],
			['field' => 'tot_nlti', 'label' => 'Total NLTI', 'rules' => 'required'],
			['field' => 'tot_lost_day', 'label' => 'Total Lost Day', 'rules' => 'required'],
			['field' => 'tot_accident', 'label' => 'Total Accident', 'rules' => 'required']
		];
	}

	// function getAll data on the table
	public function getAll($schema, $dba)
	{
		return $dba->get($schema . '.HSE_DATA_ACCIDENT')->result();
	}

	// function get data by factory on the table
	public function getByFactory($schema, $dba)
	{
		$factory = $this->session->userdata('hse_factory');
		$dba->order_by('SUBMIT_DATE', 'DESC');
		return $dba->get_where($schema . '.HSE_DATA_ACCIDENT', ['FACT_NO' => $factory])->result();
	}

	// function getById data on the table
	public function getById($schema, $dba, $fact_no)
	{
		return $dba->get_where($schema . '.HSE_DATA_ACCIDENT', ['FACT_NO' => $fact_no])->result();
	}

	// funtion get current data accident 
	public function getCurrentAccident($schema, $dba)
	{
		$factory = $this->session->userdata('hse_factory');
		$sql = "SELECT A.SUBMIT_ID, A.SUBMIT_DATE, A.SUBMIT_USER, A.AREA_SCORE, A.TOT_LTI, A.TOT_NLTI, A.TOT_LOST_DAY, A.TOT_ACCIDENT, A.AREA_NO, B.AREA_NM  
                FROM $schema.HSE_DATA_ACCIDENT A, $schema.HSE_DATA_AREA B 
                WHERE A.FACT_NO = B.FACT_NO
                AND A.AREA_NO = B.AREA_NO
                AND A.FACT_NO = '$factory'
                AND A.SUBMIT_DATE IN (SELECT SUBMIT_DATE FROM (SELECT AREA_NO, MAX(SUBMIT_DATE) SUBMIT_DATE FROM HSE_DATA_ACCIDENT GROUP BY AREA_NO))
        	    ORDER BY A.AREA_NO ASC";
		return $dba->query($sql)->result();
	}

	// funtion get max date data accident 
	public function getMaxDate($schema, $dba)
	{
		$factory = $this->session->userdata('hse_factory');
		$sql = "SELECT MAX(SUBMIT_DATE) SUBMIT_DATE FROM (
                    SELECT A.SUBMIT_ID, A.SUBMIT_DATE, A.SUBMIT_USER, A.AREA_SCORE, A.TOT_LTI, A.TOT_NLTI, A.TOT_LOST_DAY, A.TOT_ACCIDENT, A.AREA_NO, B.AREA_NM  
                    FROM $schema.HSE_DATA_ACCIDENT A, $schema.HSE_DATA_AREA B 
                    WHERE A.FACT_NO = B.FACT_NO
                    AND A.AREA_NO = B.AREA_NO
                    AND A.FACT_NO = '$factory'
                    AND A.SUBMIT_DATE IN (SELECT SUBMIT_DATE FROM (SELECT AREA_NO, MAX(SUBMIT_DATE) SUBMIT_DATE FROM HSE_DATA_ACCIDENT GROUP BY AREA_NO))
                    ORDER BY A.AREA_NO ASC
                )";
		return $dba->query($sql)->result();
	}

	// function get data accident by area_no and date
	public function getDataAccident($schema, $dba, $area_no, $datestart, $dateend)
	{
		// get numeric value only
		$datestart = preg_replace("/[^0-9]/", "", $datestart);
		$dateend = preg_replace("/[^0-9]/", "", $dateend);

		$factory = $this->session->userdata('hse_factory');

		$sql  = "SELECT A.*, B.AREA_NM FROM $schema.HSE_DATA_ACCIDENT A, $schema.HSE_DATA_AREA B
					WHERE A.FACT_NO = B.FACT_NO
						AND A.AREA_NO = B.AREA_NO
						AND A.FACT_NO = '$factory'
						AND A.AREA_NO LIKE '%$area_no%'
						AND SUBSTR(A.SUBMIT_DATE,1,8) >= '$datestart'
						AND SUBSTR(A.SUBMIT_DATE,1,8) <= '$dateend'
					ORDER BY A.SUBMIT_DATE DESC";
		return $dba->query($sql)->result();
	}

	// function get data info accident by date range
	public function getDataAccidentByDate($schema, $dba, $datestart, $dateend)
	{
		// get numeric value only
		$datestart = preg_replace("/[^0-9]/", "", $datestart);
		$dateend = preg_replace("/[^0-9]/", "", $dateend);

		$factory = $this->session->userdata('hse_factory');

		$sql = "SELECT AREA_NO, AREA_NM, BUILD_NO, BUILD_NM, LTI, NLTI, LOST_DAY, ACCIDENT, SCORE_SUM/DIVIDE+PENALTY_SUM FINAL_SCORE  
				FROM (
					SELECT AREA_NO, AREA_NM, BUILD_NO, BUILD_NM, SUM(LTI) LTI, SUM(NLTI) NLTI, SUM(LOST_DAY) LOST_DAY, SUM(ACCIDENT) ACCIDENT, 
						AVG(SCORE_SUM) SCORE_SUM, AVG(PENALTY_SUM) PENALTY_SUM, DIVIDE
					FROM (
						SELECT A.SUBMIT_ID, A.CHECK_DATE, A.AREA_NO, C.AREA_NM, A.BUILD_NO, D.BUILD_NM, A.LTI, A.NLTI, A.LOST_DAY, NVL(A.LTI+A.NLTI,0) ACCIDENT, 
							(SELECT SUM(TOTAL) TOTAL 
								FROM HSE_DATA_AUDITD 
								WHERE SUBMIT_ID = A.SUBMIT_ID 
								AND SUBSTR(SASPECT_NO,1,1) <> 'E') SCORE_SUM,
							(SELECT SUM(TOTAL) TOTAL 
								FROM HSE_DATA_AUDITD 
								WHERE SUBMIT_ID = A.SUBMIT_ID 
								AND SUBSTR(SASPECT_NO,1,1) = 'E') PENALTY_SUM,
							(SELECT COUNT(DISTINCT SUBSTR(SASPECT_NO,1,1)) ASPECT 
								FROM HSE_DATA_AUDITD 
								WHERE SUBMIT_ID = A.SUBMIT_ID 
								AND SUBSTR(SASPECT_NO,1,1) <> 'E') DIVIDE
						FROM $schema.HSE_DATA_AUDITM A, $schema.HSE_DATA_AUDITD B, $schema.HSE_DATA_AREA C, $schema.HSE_DATA_BUILDM D
						WHERE A.FACT_NO = B.FACT_NO
							AND A.FACT_NO = C.FACT_NO
							AND A.FACT_NO = D.FACT_NO
							AND A.SUBMIT_ID = B.SUBMIT_ID
							AND A.AREA_NO = C.AREA_NO
							AND A.BUILD_NO = D.BUILD_NO
							AND A.FACT_NO = '$factory'
							AND A.CHECK_DATE >= '$datestart'
							AND A.CHECK_DATE <= '$dateend'
						GROUP BY A.SUBMIT_ID, A.CHECK_DATE, A.AREA_NO, C.AREA_NM, A.BUILD_NO, D.BUILD_NM, A.LTI, A.NLTI, A.LOST_DAY
						ORDER BY A.AREA_NO, A.BUILD_NO
						)
				GROUP BY AREA_NO, AREA_NM, BUILD_NO, BUILD_NM, DIVIDE
				ORDER BY AREA_NO, BUILD_NO
				)";

		return $dba->query($sql)->result();
	}

	// function get data info accident by date range
	public function getDataAccidentAreaByDate($schema, $dba, $datestart, $dateend)
	{
		// get numeric value only
		$datestart = preg_replace("/[^0-9]/", "", $datestart);
		$dateend = preg_replace("/[^0-9]/", "", $dateend);

		$factory = $this->session->userdata('hse_factory');

		$sql = "SELECT AREA_NO, AREA_NM, LTI, NLTI, LOST_DAY, ACCIDENT, SCORE_SUM/DIVIDE+PENALTY_SUM FINAL_SCORE  
				FROM (
					SELECT AREA_NO, AREA_NM, SUM(LTI) LTI, SUM(NLTI) NLTI, SUM(LOST_DAY) LOST_DAY, SUM(ACCIDENT) ACCIDENT, 
						AVG(SCORE_SUM) SCORE_SUM, AVG(PENALTY_SUM) PENALTY_SUM, DIVIDE
					FROM (
						SELECT A.SUBMIT_ID, A.CHECK_DATE, A.AREA_NO, C.AREA_NM, A.LTI, A.NLTI, A.LOST_DAY, NVL(A.LTI+A.NLTI,0) ACCIDENT, 
							(SELECT SUM(TOTAL) TOTAL 
								FROM $schema.HSE_DATA_AUDITD 
								WHERE SUBMIT_ID = A.SUBMIT_ID 
								AND SUBSTR(SASPECT_NO,1,1) <> 'E') SCORE_SUM,
							(SELECT SUM(TOTAL) TOTAL 
								FROM $schema.HSE_DATA_AUDITD 
								WHERE SUBMIT_ID = A.SUBMIT_ID 
								AND SUBSTR(SASPECT_NO,1,1) = 'E') PENALTY_SUM,
							(SELECT COUNT(DISTINCT SUBSTR(SASPECT_NO,1,1)) ASPECT 
								FROM $schema.HSE_DATA_AUDITD 
								WHERE SUBMIT_ID = A.SUBMIT_ID 
								AND SUBSTR(SASPECT_NO,1,1) <> 'E') DIVIDE
						FROM $schema.HSE_DATA_AUDITM A, $schema.HSE_DATA_AUDITD B, $schema.HSE_DATA_AREA C
						WHERE A.FACT_NO = B.FACT_NO
							AND A.FACT_NO = C.FACT_NO
							AND A.SUBMIT_ID = B.SUBMIT_ID
							AND A.AREA_NO = C.AREA_NO
							AND A.FACT_NO = '$factory'
							AND A.CHECK_DATE >= '$datestart'
							AND A.CHECK_DATE <= '$dateend'
						GROUP BY A.SUBMIT_ID, A.CHECK_DATE, A.AREA_NO, C.AREA_NM, A.LTI, A.NLTI, A.LOST_DAY
						ORDER BY A.AREA_NO
					)
				GROUP BY AREA_NO, AREA_NM, DIVIDE
				ORDER BY AREA_NO
				)";

		return $dba->query($sql)->result();
	}

	// function save
	public function save($schema, $dba, $master_data)
	{
		$factory = $this->session->userdata('hse_factory');

		if ($factory != null) {
			return $dba->insert($schema . '.HSE_DATA_ACCIDENT', $master_data);
		} else {
			return false;
		}
	}
}
