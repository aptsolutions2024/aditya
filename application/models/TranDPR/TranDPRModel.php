<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class TranDPRModel extends CI_Model
{
	//tran_rmrcir_stock
	function updateTranRmrcirStock($updateDate)
	{
		$rm_id 			= $updateDate['rm_id'];

		$array = array('rm_id' => $rm_id, 'branch_id' => $_SESSION['branch_id'], 'year' => $_SESSION['current_year']);
		
		$this->db->where($array); 
		$update = $this->db->update('tran_rmrcir_stock', $updateDate);
		return ($update == true) ? true : false;
	}


	
}

?>