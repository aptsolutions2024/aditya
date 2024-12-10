<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class RmqcModel extends CI_Model
{
	public function getRMrcirMast($date,$flag)
	{
		$year = $_SESSION['current_year'];
		$data = [];
        if($date == '1970-01'){
                $date='';
            }
		if(!empty($date))
		{
			if($flag == 'all')
			{
				
				$query = $this->db->query("SELECT trm.id,trm.supplier_id,trm.date,trm.challan_no,trm.challan_date,trd.id as det_id,trd.rm_id,trd.qty,trd.qc_remarks,trd.rejected_qty FROM `tran_rmrcir_details` trd inner join tran_rmrcir_mast trm on trd.mast_rmrcir_id  = trm.id where trm.date like '$date%' and trd.isdeleted=0 and trm.isdeleted=0");
				$data  = $query->result_array();
				//	echo $this->db->last_query();
				return $data;
			}else{
				
				$query = $this->db->query("SELECT trd.id,trm.challan_no,trm.challan_date,trd.rm_id,trd.qty,trm.supplier_id FROM `tran_rmrcir_details` trd INNER join tran_rmrcir_mast trm on trd.mast_rmrcir_id  = trm.id where trd.isdeleted = 0 and trm.year = '$year' and trm.date like '$date%' and  trd.id NOT IN (SELECT det_rmrcir_id from tran_rmrcir_quality_checks where isdeleted=0)");

				$data  = $query->result_array();
					//echo $this->db->last_query();exit;
				return $data;
			}
		
		}else{
			if($flag == 'all')
			{
				
			//	$query = $this->db->query("SELECT * from tran_rmrcir_mast where isdeleted=0 order by date limit 100");
		$query = $this->db->query("SELECT trm.id,trm.supplier_id,trm.date,trm.challan_no,trm.challan_date,trd.id as det_id,trd.rm_id,trd.qty,trd.qc_remarks,trd.rejected_qty FROM `tran_rmrcir_details` trd inner join tran_rmrcir_mast trm on trd.mast_rmrcir_id  = trm.id where trd.isdeleted=0 and trm.isdeleted=0 limit 100");
			
				$data  = $query->result_array();
				//	echo $this->db->last_query();exit;
				return $data;
			}else{
				
				$query = $this->db->query("SELECT trd.id,trm.challan_no,trm.challan_date,trd.rm_id,trd.qty,trm.supplier_id FROM `tran_rmrcir_details` trd INNER join tran_rmrcir_mast trm on trd.mast_rmrcir_id  = trm.id where trd.isdeleted = 0 and trm.year = '$year' and  trd.id NOT IN (SELECT det_rmrcir_id from tran_rmrcir_quality_checks where isdeleted=0)");

				$data  = $query->result_array();
					//echo $this->db->last_query();exit;
				return $data;
			}
		}
		 
	}
	public function GetRmQccheck($id)
	{
		$query = $this->db->query("SELECT * from tran_rmrcir_quality_checks where det_rmrcir_id = '$id' and isdeleted = 0");
		$data  = $query->result_array();
		return $data;
	}
	public function getRMrcirDetailbyId($id)
	{
		$query = $this->db->query("SELECT * from tran_rmrcir_details where id = '$id' ");
		$data  = $query->row_array();
	//	echo $this->db->last_query();
		return $data;
	}public function getRMrcirMastbyId($id)
	{
		$query = $this->db->query("SELECT * from tran_rmrcir_mast where id = '$id' ");
		$data  = $query->row_array();
		return $data;
	}

	public function getRidingArr($type)
	{

		$reding = [];
		for ($i = 0; $i < count($type); $i++) 
		{
			if($_POST['type'][$i] == "V")
			{
				$j =  (($i * 2) + 1);
				$reding[] = array(
					'R1' => $_POST['R1'][$j],
					'R2' => $_POST['R2'][$j],
					'R3' => $_POST['R3'][$j],
					'R4' => $_POST['R4'][$j],
					'R5' => $_POST['R5'][$j],

				 );
			} 
			if($_POST['type'][$i] == "C")
			{
				$reding[] = array(
					'R1' => "",
					'R2' => "",
					'R3' => "",
					'R4' => "",
					'R5' => "",
				 );
			}
			if($_POST['type'][$i] == "D")
			{
				
				$j =  ($i * 2);
				$reding[] = array(
					'R1' => $_POST['R1'][$j],
					'R2' => $_POST['R2'][$j],
					'R3' => $_POST['R3'][$j],
					'R4' => $_POST['R4'][$j],
					'R5' => $_POST['R5'][$j],

				 );
			} 
				// echo $i . " - " . ($i * 2) . "," . (($i * 2) + 1) . "<br>";
		}
			
		return $reding;

	}
	public function getRmrcirDetail($id)
	{
	// Removed This condition "and trm.year = '2022 - 23'" and added session year instead(Asharani)
	    $year=$_SESSION['current_year'];
		$query = $this->db->query("SELECT trd.id,trd.rejected_qty,trm.challan_no,trm.challan_date,trd.rm_id,trd.qty,trm.supplier_id FROM `tran_rmrcir_details` trd INNER join tran_rmrcir_mast trm on trd.mast_rmrcir_id  = trm.id  where trd.isdeleted = 0 and trm.id = '$id' and trm.year = '$year'");
		$data  = $query->result_array();
         
		return $data;
		 
	}
	
	
	
}