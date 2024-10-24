<?php
defined('BASEPATH') or exit('No direct script access allowed');

class HSE_audit_model extends CI_Model
{

	// function rules for validation
	public function rules()
	{
		return [
			['field' => 'checkdate', 'label' => 'Check Date', 'rules' => 'required'],
			['field' => 'area_no', 'label' => 'Area No', 'rules' => 'required'],
			['field' => 'build_no', 'label' => 'Build No', 'rules' => 'required'],
			['field' => 'auditee', 'label' => 'Auditee', 'rules' => 'required'],
			['field' => 'auditor', 'label' => 'Auditor', 'rules' => 'required'],
			['field' => 'lti', 'label' => 'LTI', 'rules' => 'required'],
			['field' => 'nlti', 'label' => 'NLTI', 'rules' => 'required'],
			['field' => 'lostday', 'label' => 'Lost Day', 'rules' => 'required'],
		];
	}

	public function getDataAllAspect($schema, $dba)
	{
		$factory = $this->session->userdata('hse_factory');
		$sql = "SELECT A.SORT_SEQ, A.DIM_SEQ, A.SASPECT_NO, A.SASPECT_NM, A.VAL_WEIGHT,
						B.ASPECT_NO, B.ASPECT_NM,
						C.DIM_NO, C.DIM_NM,
						(SELECT COUNT(Y.ASPECT_NO)
						FROM $schema.HSE_DATA_SUB_ASPECT X, $schema.HSE_DATA_ASPECT Y, $schema.HSE_DATA_DIMENTION Z
						WHERE X.ASPECT_NO = Y.ASPECT_NO
							AND Y.DIM_NO = Z.DIM_NO AND Y.ASPECT_NO = B.ASPECT_NO 
						) RS_ASPECT,
						(SELECT COUNT(Z.DIM_NO)
						FROM $schema.HSE_DATA_SUB_ASPECT X, $schema.HSE_DATA_ASPECT Y, $schema.HSE_DATA_DIMENTION Z
						WHERE X.ASPECT_NO = Y.ASPECT_NO
							AND Y.DIM_NO = Z.DIM_NO AND Z.DIM_NO = C.DIM_NO 
						) RS_DIM
				FROM $schema.HSE_DATA_SUB_ASPECT A, $schema.HSE_DATA_ASPECT B, $schema.HSE_DATA_DIMENTION C
				WHERE A.FACT_NO = B.FACT_NO
					AND B.FACT_NO = C.FACT_NO
					AND A.ASPECT_NO = B.ASPECT_NO
					AND B.DIM_NO = C.DIM_NO  
					AND A.FACT_NO = '$factory'
				ORDER BY A.SORT_SEQ";
		return $dba->query($sql)->result();
	}

	public function getDataAllAspectBySubmitId($schema, $dba, $submit_id)
	{
		$factory = $this->session->userdata('hse_factory');
		$sql = "SELECT A.SORT_SEQ, A.DIM_SEQ, A.SASPECT_NO, A.SASPECT_NM, A.VAL_WEIGHT, D.SCORE, D.TOTAL, D.DESC_ISSUE, D.REMARK,
						B.ASPECT_NO, B.ASPECT_NM,
						C.DIM_NO, C.DIM_NM,
						(SELECT COUNT(Y.ASPECT_NO)
						FROM $schema.HSE_DATA_SUB_ASPECT X, $schema.HSE_DATA_ASPECT Y, $schema.HSE_DATA_DIMENTION Z
						WHERE X.ASPECT_NO = Y.ASPECT_NO
							AND Y.DIM_NO = Z.DIM_NO AND Y.ASPECT_NO = B.ASPECT_NO 
						) RS_ASPECT,
						(SELECT COUNT(Z.DIM_NO)
						FROM $schema.HSE_DATA_SUB_ASPECT X, $schema.HSE_DATA_ASPECT Y, $schema.HSE_DATA_DIMENTION Z
						WHERE X.ASPECT_NO = Y.ASPECT_NO
							AND Y.DIM_NO = Z.DIM_NO AND Z.DIM_NO = C.DIM_NO 
						) RS_DIM,
						(SELECT SUM(W.TOTAL)
						FROM $schema.HSE_DATA_AUDITD W, $schema.HSE_DATA_SUB_ASPECT X, $schema.HSE_DATA_ASPECT Y, $schema.HSE_DATA_DIMENTION Z
						WHERE W.SASPECT_NO = X.SASPECT_NO
							AND X.ASPECT_NO = Y.ASPECT_NO AND Y.DIM_NO = Z.DIM_NO 
							AND Z.DIM_NO = C.DIM_NO AND W.SUBMIT_ID = D.SUBMIT_ID 
						) DIM_SUM,
						(SELECT SUM(W.TOTAL)
						FROM $schema.HSE_DATA_AUDITD W, $schema.HSE_DATA_SUB_ASPECT X, $schema.HSE_DATA_ASPECT Y, $schema.HSE_DATA_DIMENTION Z
						WHERE W.SASPECT_NO = X.SASPECT_NO
							AND X.ASPECT_NO = Y.ASPECT_NO AND Y.DIM_NO = Z.DIM_NO 
							AND W.SUBMIT_ID = D.SUBMIT_ID AND Z.DIM_NO = 'E'
						) PEN_SUM,
						(SELECT SUM(W.TOTAL)
						FROM $schema.HSE_DATA_AUDITD W, $schema.HSE_DATA_SUB_ASPECT X, $schema.HSE_DATA_ASPECT Y, $schema.HSE_DATA_DIMENTION Z
						WHERE W.SASPECT_NO = X.SASPECT_NO
							AND X.ASPECT_NO = Y.ASPECT_NO AND Y.DIM_NO = Z.DIM_NO 
							AND W.SUBMIT_ID = D.SUBMIT_ID AND Z.DIM_NO <> 'E'
						) OVERALL_SUM,
						(SELECT COUNT(DISTINCT Z.DIM_NO)
						FROM $schema.HSE_DATA_AUDITD W, $schema.HSE_DATA_SUB_ASPECT X, $schema.HSE_DATA_ASPECT Y, $schema.HSE_DATA_DIMENTION Z
						WHERE W.SASPECT_NO = X.SASPECT_NO
							AND X.ASPECT_NO = Y.ASPECT_NO AND Y.DIM_NO = Z.DIM_NO 
							AND W.SUBMIT_ID = D.SUBMIT_ID AND Z.DIM_NO <> 'E'
						) DIV_DIM
				FROM $schema.HSE_DATA_SUB_ASPECT A, $schema.HSE_DATA_ASPECT B, $schema.HSE_DATA_DIMENTION C, $schema.HSE_DATA_AUDITD D
				WHERE A.FACT_NO = B.FACT_NO
					AND B.FACT_NO = C.FACT_NO
					AND A.FACT_NO = D.FACT_NO
					AND A.ASPECT_NO = B.ASPECT_NO
					AND	A.SASPECT_NO = D.SASPECT_NO	  
					AND B.DIM_NO = C.DIM_NO  
					AND A.FACT_NO = '$factory'
					AND D.SUBMIT_ID = '$submit_id'
				ORDER BY A.SORT_SEQ";
		return $dba->query($sql)->result();
	}

	public function getDataAuditLayout($schema, $dba, $indate, $area_no, $build_no)
	{
		// get numeric value only
		$indate = preg_replace("/[^0-9]/", "", $indate);

		$factory = $this->session->userdata('hse_factory');
		$sql = "SELECT A.SUBMIT_ID, A.SUBMIT_USER, A.CHECK_DATE, A.AREA_NO, B.AREA_NM, A.BUILD_NO, C.BUILD_NM, A.AUDITEE, A.AUDITOR, 
						A.LTI, A.NLTI, A.LOST_DAY, A.LTI_L3, A.LTI_M3, A.APAR_O1, A.APAR_M1
					FROM $schema.HSE_DATA_AUDITM A, $schema.HSE_DATA_AREA B, $schema.HSE_DATA_BUILDM C
					WHERE A.FACT_NO = B.FACT_NO
						AND A.FACT_NO = C.FACT_NO
						AND A.AREA_NO = B.AREA_NO
						AND A.BUILD_NO = C.BUILD_NO
						AND A.FACT_NO = '$factory'
						AND A.CHECK_DATE = '$indate'
						AND A.AREA_NO = '$area_no'
						AND A.BUILD_NO = '$build_no'";
		return $dba->query($sql)->result();
	}

	public function getDataAuditLayoutArea($schema, $dba, $indate, $area_no)
	{
		// get numeric value only
		$indate = preg_replace("/[^0-9]/", "", $indate);

		$factory = $this->session->userdata('hse_factory');
		// $sql = "SELECT DISTINCT A.CHECK_DATE, D.AREA_NO, D.AREA_NM, C.SORT_SEQ, C.BUILD_NO, C.BUILD_NM,
		// 				(SELECT SUM(W.TOTAL)
		// 				FROM $schema.HSE_DATA_AUDITD W, $schema.HSE_DATA_SUB_ASPECT X, $schema.HSE_DATA_ASPECT Y, $schema.HSE_DATA_DIMENTION Z
		// 				WHERE W.SASPECT_NO = X.SASPECT_NO
		// 					AND X.ASPECT_NO = Y.ASPECT_NO AND Y.DIM_NO = Z.DIM_NO 
		// 					AND W.SUBMIT_ID = B.SUBMIT_ID AND Z.DIM_NO <> 'E'
		// 				) TOTAL, 
		// 				(SELECT SUM(W.TOTAL)
		// 				FROM $schema.HSE_DATA_AUDITD W, $schema.HSE_DATA_SUB_ASPECT X, $schema.HSE_DATA_ASPECT Y, $schema.HSE_DATA_DIMENTION Z
		// 				WHERE W.SASPECT_NO = X.SASPECT_NO
		// 					AND X.ASPECT_NO = Y.ASPECT_NO AND Y.DIM_NO = Z.DIM_NO 
		// 					AND W.SUBMIT_ID = B.SUBMIT_ID AND Z.DIM_NO = 'E'
		// 				) PENALTY,
		// 				(SELECT COUNT(DISTINCT Z.DIM_NO)
		// 				FROM $schema.HSE_DATA_AUDITD W, $schema.HSE_DATA_SUB_ASPECT X, $schema.HSE_DATA_ASPECT Y, $schema.HSE_DATA_DIMENTION Z
		// 				WHERE W.SASPECT_NO = X.SASPECT_NO
		// 					AND X.ASPECT_NO = Y.ASPECT_NO AND Y.DIM_NO = Z.DIM_NO 
		// 					AND W.SUBMIT_ID = B.SUBMIT_ID AND Z.DIM_NO <> 'E'
		// 				) DIVIDE		
		// 		FROM $schema.HSE_DATA_AUDITM A, $schema.HSE_DATA_AUDITD B, $schema.HSE_DATA_BUILDM C, $schema.HSE_DATA_AREA D
		// 		WHERE A.FACT_NO = B.FACT_NO
		// 			AND A.FACT_NO = C.FACT_NO
		// 			AND A.FACT_NO = D.FACT_NO
		// 			AND A.SUBMIT_ID = B.SUBMIT_ID
		// 			AND A.AREA_NO = C.AREA_NO
		// 			AND A.BUILD_NO = C.BUILD_NO
		// 			AND A.AREA_NO = D.AREA_NO
		// 			AND A.FACT_NO = '$factory'
		// 			AND A.CHECK_DATE = '$indate'
		// 			AND A.AREA_NO = '$area_no'
		// 		ORDER BY C.SORT_SEQ, C.BUILD_NO";

		$sql = "SELECT Y.CHECK_DATE, X.AREA_NO, X.AREA_NM, X.SORT_SEQ, X.BUILD_NO, X.BUILD_NM, Y.TOTAL, Y.PENALTY, Y.DIVIDE
				FROM (SELECT A.BUILD_NO, A.BUILD_NM, B.AREA_NO, B.AREA_NM, A.SORT_SEQ
							FROM $schema.HSE_DATA_BUILDM A, $schema.HSE_DATA_AREA B
							WHERE A.FACT_NO = B.FACT_NO AND A.AREA_NO = B.AREA_NO) X,
					(SELECT DISTINCT A.CHECK_DATE, D.AREA_NO, D.AREA_NM, C.SORT_SEQ, C.BUILD_NO, C.BUILD_NM,
									(SELECT SUM(W.TOTAL)
									FROM $schema.HSE_DATA_AUDITD W, $schema.HSE_DATA_SUB_ASPECT X, $schema.HSE_DATA_ASPECT Y, $schema.HSE_DATA_DIMENTION Z
									WHERE W.SASPECT_NO = X.SASPECT_NO
										AND X.ASPECT_NO = Y.ASPECT_NO AND Y.DIM_NO = Z.DIM_NO 
										AND W.SUBMIT_ID = B.SUBMIT_ID AND Z.DIM_NO <> 'E'
									) TOTAL, 
									(SELECT SUM(W.TOTAL)
									FROM $schema.HSE_DATA_AUDITD W, $schema.HSE_DATA_SUB_ASPECT X, $schema.HSE_DATA_ASPECT Y, $schema.HSE_DATA_DIMENTION Z
									WHERE W.SASPECT_NO = X.SASPECT_NO
										AND X.ASPECT_NO = Y.ASPECT_NO AND Y.DIM_NO = Z.DIM_NO 
										AND W.SUBMIT_ID = B.SUBMIT_ID AND Z.DIM_NO = 'E'
									) PENALTY,
									(SELECT COUNT(DISTINCT Z.DIM_NO)
									FROM $schema.HSE_DATA_AUDITD W, $schema.HSE_DATA_SUB_ASPECT X, $schema.HSE_DATA_ASPECT Y, $schema.HSE_DATA_DIMENTION Z
									WHERE W.SASPECT_NO = X.SASPECT_NO
										AND X.ASPECT_NO = Y.ASPECT_NO AND Y.DIM_NO = Z.DIM_NO 
										AND W.SUBMIT_ID = B.SUBMIT_ID AND Z.DIM_NO <> 'E'
									) DIVIDE		
							FROM $schema.HSE_DATA_AUDITM A, $schema.HSE_DATA_AUDITD B, $schema.HSE_DATA_BUILDM C, $schema.HSE_DATA_AREA D
							WHERE A.FACT_NO = B.FACT_NO
								AND A.FACT_NO = C.FACT_NO
								AND A.FACT_NO = D.FACT_NO
								AND A.SUBMIT_ID = B.SUBMIT_ID
								AND A.AREA_NO = C.AREA_NO
								AND A.BUILD_NO = C.BUILD_NO
								AND A.AREA_NO = D.AREA_NO
								AND A.FACT_NO = '$factory'
								AND A.CHECK_DATE = '$indate'
								-- AND A.AREA_NO = '$area_no') Y
								AND A.AREA_NO IN ($area_no)) Y
				WHERE X.AREA_NO = Y.AREA_NO(+) 
				AND X.BUILD_NO = Y.BUILD_NO(+) 
				-- AND X.AREA_NO = '$area_no'
				AND X.AREA_NO IN ($area_no)
				ORDER BY X.SORT_SEQ, X.BUILD_NO";
		return $dba->query($sql)->result();
	}

	public function getRecAudit($schema, $dba, $area_no, $datestart, $dateend)
	{
		// get numeric value only
		$datestart = preg_replace("/[^0-9]/", "", $datestart);
		$dateend = preg_replace("/[^0-9]/", "", $dateend);

		$factory = $this->session->userdata('hse_factory');

		$sql = "SELECT A.*, B.AREA_NM, C.BUILD_NM 
				FROM $schema.HSE_DATA_AUDITM A, $schema.HSE_DATA_AREA B, $schema.HSE_DATA_BUILDM C
				WHERE A.FACT_NO = B.FACT_NO
					AND A.FACT_NO = C.FACT_NO
					AND A.AREA_NO = B.AREA_NO
					AND A.BUILD_NO = C.BUILD_NO
					AND A.FACT_NO = '$factory'
					AND A.AREA_NO LIKE '%$area_no%'
					AND SUBSTR(A.CHECK_DATE,1,8) >= '$datestart' 
					AND SUBSTR(A.CHECK_DATE,1,8) <= '$dateend'
				ORDER BY A.SUBMIT_DATE DESC";
		return $dba->query($sql)->result();
	}

	public function save($schema, $dba, $master_data, $detail_data)
	{
		$factory = $this->session->userdata('hse_factory');

		// check data detail collection by check_date, area_no, build_no
		$dba->where(array('FACT_NO' => $factory, 'CHECK_DATE' => $master_data['CHECK_DATE'], 'AREA_NO' => $master_data['AREA_NO'], 'BUILD_NO' => $master_data['BUILD_NO']));
		$res = $dba->count_all_results($schema . '.HSE_DATA_AUDITM');

		if ($res == 0) {
			// execute insert master data
			$master = $dba->insert($schema . '.HSE_DATA_AUDITM', $master_data);

			if ($detail_data != null) {
				if ($master) {
					// execute insert multiple detail data
					return $dba->insert_batch($schema . '.HSE_DATA_AUDITD', $detail_data);
					// return $master;
				}
			} else {
				return $master;
			}
		} else {
			return false;
		}
	}

	// function update
	public function update($schema, $dba, $master_data, $detail_data, $submit_id)
	{
		$factory = $this->session->userdata('hse_factory');

		// execute update master data
		$master = $dba->update($schema . '.HSE_DATA_AUDITM', $master_data, array('FACT_NO' => $factory, 'SUBMIT_ID' => $submit_id));

		// check data detail collection by submit ID
		$dba->where(array('FACT_NO' => $factory, 'SUBMIT_ID' => $submit_id));
		$res = $dba->count_all_results($schema . '.HSE_DATA_AUDITD');

		// delete records when found old data
		if ($res > 0) {
			$dba->delete($schema . '.HSE_DATA_AUDITD', array('FACT_NO' => $factory, 'SUBMIT_ID' => $submit_id));
		}

		if ($detail_data != null) {
			if ($master) {
				// execute insert new multiple detail data
				return $dba->insert_batch($schema . '.HSE_DATA_AUDITD', $detail_data);
				// return $master;
			}
		} else {
			return $master;
		}
	}

	// funtion delete
	public function delete($schema, $dba, $id)
	{
		$factory = $this->session->userdata('hse_factory');

		// check data detail collection by submit ID
		$res = $dba->count_all_results($schema . '.HSE_DATA_AUDITD', array('FACT_NO' => $factory, 'SUBMIT_ID' => $id));

		// delete records when found old data
		if ($res > 0) {
			$dba->delete($schema . '.HSE_DATA_AUDITD', array('FACT_NO' => $factory, 'SUBMIT_ID' => $id));
		}

		return $dba->delete($schema . '.HSE_DATA_AUDITM', array('FACT_NO' => $factory, 'SUBMIT_ID' => $id));
	}
}
