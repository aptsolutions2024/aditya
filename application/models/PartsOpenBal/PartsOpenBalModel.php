<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class PartsOpenBalModel extends CI_Model
{
	
	public function getPartopenbalList(){
		$query = $this->db->query("select * from tran_partsrcir_stock where received_doc_type='O.B.'");
		$data = $query->result_array();
		 return $data;
	}
	
    public function getpartsOBbyid($id){

     $query = $this->db->query("select tps.*,mp.prodfamily_id,mp.partno,mp.name as part_name,mo.Name as operation_name from tran_partsrcir_stock tps inner join mast_part mp on tps.part_id=mp.part_id inner join mast_operation mo on tps.op_id=mo.id  where received_doc_type='O.B.' and tps.id='$id'");
	 $data = $query->row_array();
	 return $data;

     }

	 public function deletepartOB($id){

	 }
	
	
	
}