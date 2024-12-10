<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class DCRCIRModel extends CI_Model
{
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
	function AddPTranRcirStock($postDate)
	{
		 $result=$this->db->insert('tran_partsrcir_stock',$postDate);
		 return $insert_id = $this->db->insert_id();
	}
	function updateTranPartsrcirMast($postDate,$mast_dc_id)
	{
		if($postDate && $mast_dc_id) {
			$this->db->where('id', $mast_dc_id);
			$update = $this->db->update('tran_partsrcir_mast', $postDate);
			//echo $this->db->last_query(); die;
			return ($update == true) ? true : false;
		}

	}
	function UpdateTranRcirDetails($postDate,$mast_partsrcir_id)
	{
		if($postDate && $mast_partsrcir_id) {
			$this->db->where('id', $mast_partsrcir_id);
			$update = $this->db->update('tran_partsrcir_details', $postDate);
			//echo $this->db->last_query(); 
			return ($update == true) ? true : false;
		}

	}
	
	
	
	
}

?>