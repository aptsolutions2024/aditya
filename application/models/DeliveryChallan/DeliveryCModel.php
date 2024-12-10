<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class DeliveryCModel extends CI_Model
{
	function AddTrandcMast($postDate)
	{
		 $result=$this->db->insert('tran_dc_mast',$postDate);
		 return $insert_id = $this->db->insert_id();
	}
	function AddTrandcDetails($postDate)
	{
		 $result=$this->db->insert('tran_dc_details',$postDate);
		//echo $this->db->last_query();die;
		 return $insert_id = $this->db->insert_id();
	}
	function AddDCTranStock($postDate)
	{
		 $result=$this->db->insert('tran_dc_stock',$postDate);
		 return $insert_id = $this->db->insert_id();
	}
	
	
	function UpdateTrandcMast($postDate,$editId)
	{
		if($postDate && $editId) {
			$this->db->where('id', $editId);
			$update = $this->db->update('tran_dc_mast', $postDate);
			//echo $this->db->last_query(); die;
			return ($update == true) ? true : false;
		}

	}
	function UpdateTrandcDetails($postDate,$editId)
	{
		if($postDate && $editId) {
			$this->db->where('id', $editId);
			$update = $this->db->update('tran_dc_details', $postDate);
			//echo $this->db->last_query(); die;
			return ($update == true) ? true : false;
		}

	}

	function deleteOtherDetails($postDate)
	{
		$id=$_POST['editId'];
		$this->db->where("id",$id);
        $update = $this->db->update('tran_partspo_details', $postDate);
        return true;
    }
    
    function deleteDcDetails($postDate)
	{
		$id=$_POST['editId'];
		$this->db->where("id",$id);
        $update = $this->db->update('tran_dc_details', $postDate);
       
    }
    function UpdateDCStock($postDate,$det_dc_id){
        //dc_stock
    	$where = array('det_dc_id' => $det_dc_id,'issue_doc_id' 	=> $det_dc_id);
    	if($det_dc_id) {
			$this->db->where($where);
			$update = $this->db->update('tran_dc_stock', $postDate);
		//	return ($update == true) ? true : false;
		}
		
		
		//dpr_stock && RCIR Stock
		$where1 = array('issue_doc_type' => 'tran_dc','issue_doc_id' => $det_dc_id);
    	if($det_dc_id) {
			$this->db->where($where1);
			$update = $this->db->update('tran_dpr_stock', $postDate);
		
			$this->db->where($where1);
			$update = $this->db->update('tran_partsrcir_stock', $postDate);
		}
		
		return ($update == true) ? true : false;	
    }
    


	
}

?>