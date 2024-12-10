<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class RMRCIRModel extends CI_Model
{
	function AddRMTranRcirMast($postDate)
	{
		 $result=$this->db->insert('tran_rmrcir_mast',$postDate);
		 return $insert_id = $this->db->insert_id();
	}
	function AddRMTranRcirDetails($postDate)
	{
		 $result=$this->db->insert('tran_rmrcir_details',$postDate);
		 return $insert_id = $this->db->insert_id();
	}
	function AddRMTranRcirStock($postStockDetails)
	{
		 $result=$this->db->insert('tran_rmrcir_stock',$postStockDetails);
		 return $insert_id = $this->db->insert_id();
	}
	
	function UpdateRMTranRcirDetails($postDate,$editId)
	{
		if($postDate && $editId) {
			$this->db->where('id', $editId);
			$update = $this->db->update('tran_rmrcir_details', $postDate);
		//	echo $this->db->last_query(); die;
			return ($update == true) ? true : false;
		}

	}
	
	public function UpdateTranRMRcirStock($id)
	{
	  $query = $this->db->query("UPDATE `tran_rmrcir_stock` SET `booked_qty`=0,`received_qty`=0,booked_doc_type='',booked_doc_id=0 , isdeleted=1 WHERE det_rmrcir_id='$id' and (booked_doc_type='prod_plan' or received_doc_type='rm_rcir')");
	 //echo $this->db->last_query(); die;
	 return $insert_id = $this->db->insert_id();

	}
	
	
	function UpdateRMTranRcirStockReceivedQty($postDate,$editId)
	{
		if($postDate && $editId) {
		    $array = array('det_rmrcir_id' => $editId, 'received_doc_id' => $editId, 'received_doc_type' => rm_rcir);
			$this->db->where($array); 
			$update = $this->db->update('tran_rmrcir_stock', $postDate);
			//echo $this->db->last_query(); die;
			return ($update == true) ? true : false;
		}

	}
	

	function UpdateRMTranRcirStockBookedQty($postDate,$editId)
	{
		if($postDate && $editId) {
		  //  $bookeddoctype ='prod_plan';
		    $array = array('det_rmrcir_id' => $editId,  'booked_doc_type' => 'prod_plan');
			$this->db->where($array); 
			$update = $this->db->update('tran_rmrcir_stock', $postDate);
			//echo $this->db->last_query(); die;
			return ($update == true) ? true : false;
		}

	}
	
	
	
	function updateRMTranRcirMast($postDate,$editId)
	{
		if($postDate && $editId) {
			$this->db->where('id', $editId);
			$update = $this->db->update('tran_rmrcir_mast', $postDate);
			//echo $this->db->last_query(); die;
			return ($update == true) ? true : false;
		}

	}
	

	function updatetranPODetails($postDate,$editId)
	{
		if($postDate && $editId) {
			$this->db->where('id', $editId);
			$update = $this->db->update('tran_po_details', $postDate);
			//echo $this->db->last_query(); die;
			return ($update == true) ? true : false;
		}

	}

	
}

?>