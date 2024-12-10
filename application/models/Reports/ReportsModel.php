<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ReportsModel extends CI_Model
{
	
    public function getScheduleQty($Part_Id,$fromDate,$toDate)
	{
	    $query = $this->db->query("select CONCAT(MONTHNAME(to_date),' ',YEAR(to_date)) as to_date,sum(scheduled_qty) as scheduled_qty from tran_schedule where to_date>= '$fromDate' and to_date <= '$toDate' and part_id ='$Part_Id' group by to_date order by to_date");
		$data = $query->result_array();
		//echo $this->db->last_query(); 
	 	return $data;

	}	
    public function getInvoiceQty($Part_Id,$fromDate,$toDate)
	{
	    $query = $this->db->query("select CONCAT(MONTHNAME(tim.date),' ',YEAR(tim.date)) as to_date,sum(tid.qty) as invqty from tran_invoice_details tid inner join tran_invoice_mast tim on tim.id=tid.mast_inv_id where tim.date>= '$fromDate' and tim.date <= '$toDate' and part_id ='$Part_Id'  group by month(tim.date) order by tim.date");
		$data = $query->result_array();
		//echo $this->db->last_query(); 
	 	return $data;

	}
	public function getScheduleQtyInvoiceQtyAll($fromDate,$toDate)
	{
	    $query = $this->db->query("select sch.customer_id,sch.to_date,sch.part_id,sum(scheduled_qty) as scheduled_qty,sum(inv.invqty) as inv_qty from tran_schedule sch left join (select tim.date,part_id,sum(tid.qty) as invqty from tran_invoice_details tid left join tran_invoice_mast tim on tim.id=tid.mast_inv_id where tim.date>= '$fromDate' and tim.date <= '$toDate' group by part_id) inv on sch.part_id = inv.part_id and month(inv.date)=month(sch.to_date) where sch.to_date>= '$fromDate' and to_date <= '$toDate' group by sch.part_id,sch.to_date order by sch.to_date,sch.part_id");
	    $data = $query->result_array();
		//echo $this->db->last_query(); 
			 	return $data;

	}
	
	
}

?>