<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class RMMovementModel extends CI_Model
{
	function addtranMovement($postDate)
	{
		 $result=$this->db->insert('tran_rm_movement',$postDate);
		 return $insert_id = $this->db->insert_id();
	}
	function updatetranMovement($updatepostDate,$id)
	{
	    $this->db->where('id', $id);
			$update = $this->db->update('tran_rm_movement', $updatepostDate);
			
	        //$query = $this->db->query("UPDATE `tran_rmrcir_stock` SET `issue_qty`=0,`received_qty`=0 WHERE issue_doc_id='$id' and received_doc_id='$id' and (issue_doc_type='rm_movement' or received_doc_type='rm_movement')");
        	 //echo $this->db->last_query(); die;
        	 return $update;
	}
	
	
}

?>