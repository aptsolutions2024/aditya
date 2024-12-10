<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class InvoiceModel extends CI_Model
{
	
	function AddTranInvoiceMast($postDate)
	{
		$result=$this->db->insert('tran_invoice_mast',$postDate);
		return $insert_id = $this->db->insert_id();
	}
	function AddTranInvoiceDetails($postDate)
	{
		$result=$this->db->insert('tran_invoice_details',$postDate);
		return $insert_id = $this->db->insert_id();
	}
	function AddtranRequisition($reqDate)
	{
		$result=$this->db->insert('tran_requisition',$reqDate);
		return $insert_id = $this->db->insert_id();
	}
	function updateRawMaterial($postDate,$editId)
	{
		if($postDate && $editId) {
			$this->db->where('rm_id', $editId);
			$update = $this->db->update('mast_rm', $postDate);
			return ($update == true) ? true : false;
		}

	}
	function updateRMStock($updateDate,$rm_id)
	{
		$array = array('rm_id' => $rm_id, 'branch_id' => 1, 'year' => $_SESSION['current_year']);
		$this->db->where($array); 
		$update = $this->db->update('rm_stock', $updateDate);
		return ($update == true) ? true : false;


	}
	
	function UpdateTranSchedule($updateDate,$schedule_msg)
	{
		$array = array('id' => $schedule_msg);
		$this->db->where($array); 
		$update = $this->db->update('tran_schedule', $updateDate);
		return ($update == true) ? true : false;


	}
	
	
	
	function updatePartStock($updateDate,$partId,$branchId)
	{
		$array = array('part_id' => $partId, 'branch_id' => $branchId, 'year' => $_SESSION['current_year']);
		$this->db->where($array); 
		$update = $this->db->update('part_stock', $updateDate);
		return ($update == true) ? true : false;


	}
	function deleteRMRecord($postDate)
	{
		$id=$_POST['editId'];
		$this->db->where("rm_id",$id);
        $update = $this->db->update('mast_rm', $postDate);
        return true;
    }
    public function countProdPlanning($toDate,$schedule_id,$year,$ptype,$branchId)
	{
		$query = $this->db->query("SELECT * FROM `tran_prod_planning` WHERE `year` LIKE '$year' AND `date` = '$toDate' AND `schedule_id` = $schedule_id  AND `branch_id` = $branchId AND `prod_type` = '$ptype'");
		$data = $query->result_array();
	 	return $data;

	}
	function updateTranProdPlanning($updatepostDate,$tppId)
	{
		$array = array('id' => $tppId);
		$this->db->where($array); 
		$update = $this->db->update('tran_prod_planning', $updatepostDate);
		//echo $this->db->last_query();die;
		return ($update == true) ? true : false;


	}
	function insertTranRmrcirStock($TranRmrcirDate)
	{
		$result=$this->db->insert('tran_rmrcir_stock',$TranRmrcirDate);
		return $insert_id = $this->db->insert_id();
	}
	public function getInvoiceMast(){
	    $Customer_Id	=$_POST['Customer_Id'];
		$schedule_date 	=$_POST['schedule_date'];
		$toDate 		=date("Y-m-t", strtotime($schedule_date)); 
	  $query = "SELECT tm.`id`, tm.`customer_id`, tm.`date`, tm.`invoice_no`, tm.`amount`, tm.`inv_amt` FROM `tran_invoice_mast` tm WHERE month(date)=month('$toDate') ";
	  if($Customer_Id !='')
	  {
	  $query .= " and customer_id='$Customer_Id' ";
	  
	  }
	  $query .= " order by id desc  ";
	  $querys = $this->db->query($query);
	 //echo $this->db->last_query();die;
	 
	 $data = $querys->result_array();
	 return $data;
	}
	public function getInvDetails($id)
	{
		$Customer_Id	=$_POST['Customer_Id'];
		$schedule_date 	=$_POST['schedule_date'];
		$toDate 		=date("Y-m-t", strtotime($schedule_date)); 
	  $query = "SELECT td.id,td.part_id,td.qty FROM `tran_invoice_mast` tm INNER JOIN tran_invoice_details td ON tm.id = td.mast_inv_id  WHERE month(date)=month('$toDate') and mast_inv_id='$id'";
	  if($Customer_Id !='')
	  {
	  $query .= " and customer_id='$Customer_Id' ";
	  
	  }
	  $query .= " order by id desc  ";
	  $querys = $this->db->query($query);
	 //echo $this->db->last_query();die;
	 
	 $data = $querys->result_array();
	 return $data;

	}


	
}

?>