<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class PartsMovementModel extends CI_Model
{
	function addtranPMovement($postDate)
	{
		 $result=$this->db->insert('tran_parts_movement',$postDate);
		 return $insert_id = $this->db->insert_id();
	}
	function updatedtranPMovement($updatepostDate,$id)
	{
	    $this->db->where('id', $id);
		$update = $this->db->update('tran_parts_movement', $updatepostDate);
	    return $update;	
	   //$query = $this->db->query("UPDATE `tran_rmrcir_stock` SET `issue_qty`=0,`received_qty`=0 WHERE issue_doc_id='$id' and received_doc_id='$id' and (issue_doc_type='rm_movement' or received_doc_type='rm_movement')");
       
	}
	
	function AddTranPartsrcirMast($postDate)
	{
		 $result=$this->db->insert('tran_partsrcir_mast',$postDate);
		 return $insert_id = $this->db->insert_id();
	}
	function AddTranPartsrcirDetails($postDate)
	{
		 $result=$this->db->insert('tran_partsrcir_details',$postDate);
		 return $insert_id = $this->db->insert_id();
	}
	
	
}

?>