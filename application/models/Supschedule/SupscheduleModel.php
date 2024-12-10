<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class SupscheduleModel extends CI_Model
{
	function updateSupplierSchedule()
	{
	   
		$branch_id=$_POST['branch_id'];
		$SupId=$_POST['SupId'];
		$SchDate=$_POST['SchDate'];
		$subject=$_POST['subject'];
		$toDate 	    =date("Y-m-t", strtotime($SchDate));
		$checkedvals=$_POST['checkedvals'];
		$part1 = explode(",", $checkedvals);
	
		$schedule_date = date("M Y",strtotime($SchDate));

        $count=0;
        $msg ='';
        //echo "<pre>";print_r($part1);die;
		foreach($part1 as $row)
		{
		 
		    $count ++;
			$pt2 = explode("#", $row);
			$req_id 	    = $pt2[0];
			$part_id 	    = $pt2[1];
			$prod_plan_id 	= $pt2[2];
			$part_qty 	    = $pt2[3];
			
			$query = $this->db->query("select tpd.id from tran_partspo_details tpd inner join tran_partspo_mast tpm on tpm.id = tpd.mast_partspo_id where tpm.year ='$_SESSION[current_year]' and part_id= '$part_id' and supplier_id ='$SupId' ");
	        $data = $query->row_array();
	       
	        $partspo_det_id = $data['id'];
            if($partspo_det_id > 0)
            {
                
    			$postDate = array(
    				'year' 			=> $_SESSION['current_year'],
    				'tran_partspo_det_id' => $partspo_det_id,
    				'prod_plan_id' => $prod_plan_id,
    				'req_id' 		=> $req_id,
    				'part_id' 		=> $part_id,
    				'supplier_id' 	=> $SupId,
    				'receiving_branch_id' => $branch_id,
    				'to_date' 		=> $toDate,
    				'qty' 			=> $part_qty,
    				'created_by ' 	=> $_SESSION['id'],
    				'created_on ' 	=> date("Y-m-d"),
    				);
    
    
               $insert = $this->db->insert('tran_supplier_schedule', $postDate);
               $tran_po_id = $this->db->insert_id();
    
    			$ReqpostDate = array(
    				'tran_po_id' 	=> $tran_po_id,
    				);
    			$this->db->where('req_id', $req_id);
    			$update = $this->db->update('tran_requisition', $ReqpostDate);
    			
    			$msg = $msg."\n Supplier Schedule added successfully for pard_id ".$part_id;
    			
            }else
            {
                $msg = $msg."\n Parts Purchase Order Details are not found for pard_id ".$part_id;
            }
			
			
			
            
			
		}
		echo $msg;
		
		
		return ($update == true) ? true : false;
	}
}