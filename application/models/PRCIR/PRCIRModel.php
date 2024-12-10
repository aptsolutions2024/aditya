<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class PRCIRModel extends CI_Model
{
	function AddTranRcirMast($postDate)
	{
		 $result=$this->db->insert('tran_partsrcir_mast',$postDate);
		 return $insert_id = $this->db->insert_id();
	}
	
	function UpdateTranRcirMast($postDate,$editId)
	{
		if($postDate && $editId) {
			$this->db->where('id', $editId);
			$update = $this->db->update('tran_partsrcir_mast', $postDate);
			return ($update == true) ? true : false;
		}

	}
	function AddTranRcirDetails($postDate)
	{
		 $result=$this->db->insert('tran_partsrcir_details',$postDate);
		 return $insert_id = $this->db->insert_id();
	}
	
	function UpdateTranRcirDetails($postDate,$editId)
	{
		if($postDate && $editId) {
			$this->db->where('id', $editId);
			$update = $this->db->update('tran_partsrcir_details', $postDate);
			//echo $this->db->last_query(); die;
			return ($update == true) ? true : false;
		}

	}
	
	public function UpdateTranRcirStock($id)
	{
	  $query = $this->db->query("UPDATE `tran_partsrcir_stock` SET `inprocess_loss_qty`=0,`booked_qty`=0,`received_qty`=0 WHERE det_partsrcir_id='$id' and (booked_doc_type='prod_plan' or received_doc_type='p_rcir')");
	 //echo $this->db->last_query(); die;
	 return $insert_id = $this->db->insert_id();

	}
	public function UpdateTranRcirStockDC($id)
	{
	  $query = $this->db->query("UPDATE `tran_partsrcir_stock` SET `inprocess_loss_qty`=0,`booked_qty`=0,`received_qty`=0 WHERE det_partsrcir_id='$id' and received_doc_type='dc_rcir' ");
	  $query2 = $this->db->query("UPDATE `tran_dc_stock` SET `inprocess_loss_qty`=0,`booked_qty`=0,`received_qty`=0 WHERE received_doc_id='$id' and received_doc_type='dc_rcir' ");

	 return $insert_id = $this->db->insert_id();

	}
	function AddPTranRcirStock($postDate)
	{
		 $result=$this->db->insert('tran_partsrcir_stock',$postDate);
	// echo $this->db->last_query(); die;
		 return $insert_id = $this->db->insert_id();
	}
	
	
}

?>