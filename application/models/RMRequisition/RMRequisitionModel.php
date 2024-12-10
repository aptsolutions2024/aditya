<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class RMRequisitionModel extends CI_Model
{
	public function getTranRequisition($id,$date,$manualqty,$plan_req_qty,$reserve_qty)
	{
	    	$year 			= $_SESSION['current_year'];
	    	$date =date('Y-m',strtotime($date));
	    		$date1 =date('Y-m-01',strtotime($date));
		$query = $this->db->query("SELECT * FROM `tran_requisition` where rm_id = ".$id." and year = '$year' and date like '$date%' and not (isnull(plan_req_qty) or plan_req_qty = 0) and isnull(tran_po_id)");
		$data = $query->row_array();

		if(empty($data))
		{
		   
					$postDate = array(
						'rm_id' => $id,
						'manual_qty' => $manualqty,
						'date' =>date('Y-m-t',strtotime($date1)),
						//'plan_req_qty' => $plan_req_qty,
						'reserve_qty' => $reserve_qty,
						'year' => $year,
						'branch_id' => $_SESSION['branch_id'],
						'created_by ' => $_SESSION['id'],
						'created_on ' => date("Y-m-d H:i:s"),
					);

				$result1 = $this->db->insert('tran_requisition',$postDate);
				return true;

		}else{

			//Update -----------

			$req_id = $data['req_id'];

			$postDate = array(
						// 'rm_id' => $supInsertId,
						'manual_qty' => $manualqty,
						//'plan_req_qty' => $plan_req_qty,
						'reserve_qty'  => $reserve_qty,
						'created_by ' => $_SESSION['id'],
						'updated_by ' => $_SESSION['id'],
						'updated_on ' => date("Y-m-d H:i:s"),
					);

				$v=$this->db->where('rm_id',$id);
				$query=$this->db->update('tran_requisition',$postDate,$v);
		}

		
		

	}
	
	// public function getuserById($id)
	// {
	// 	$query = $this->db->query("SELECT * FROM mast_users where id='$id'");
	// 	$data = $query->row_array();
	// 	return $data;

	// }
	
}