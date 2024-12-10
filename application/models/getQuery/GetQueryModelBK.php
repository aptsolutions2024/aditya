<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class GetQueryModel extends CI_Model
{
	public function getParts()
	{
	 $query = $this->db->query("SELECT mp.part_id, mp.company_id, mp.prodfamily_id, mp.customer_id, mp.partno, mp.name, mp.uom, mp.netweight, mp.hsncode, mp.is_assembly, mp.created_on, mp.created_by, mp.updated_on, mp.updated_by, mp.bin_qty,mpf.name as pfName from mast_part mp,mast_productfamily mpf where mp.prodfamily_id=mpf.id and mp.isdeleted=0 order by mp.part_id desc");
	 	$data = $query->result_array();
	 
	 return $data;

	}
	public function getPartsById($id)
	{
	    
	 $query = $this->db->query("SELECT `part_id`, `prodfamily_id`, `customer_id`, `partno`, `name`, `uom`, `netweight`, `hsncode`, `bin_qty`, `is_assembly` FROM mast_part where part_id='$id' ");
	 $data = $query->row_array();
	 return $data;

	}
	public function getNetWeightByPartId($id)
	{
	    
	 $query = $this->db->query("SELECT `part_id`,`netweight` FROM mast_part where part_id='$id' ");
	 $data = $query->row_array();
	 return $data;

	}
	public function getrawMaterialById($id)
	{
	 $query = $this->db->query("SELECT `id`, `part_id`, `rm_id`, `grossweight`, `assembly_part_id`, `assembly_part_qty`, `scrap_normal`, `scrap_ss`, `scrap_tikli`, `is_tikli_reusable` FROM rel_part_rm where part_id='$id' and rm_id > 0 ");
	 $data = $query->result_array();
	 return $data;

	}
	public function getOperationById($id)
	{
	 $query = $this->db->query("SELECT `id`, `part_id`, `op_id`, `sequence_no` FROM rel_part_operation where part_id='$id' and isdeleted=0 order by sequence_no ");
	 $data = $query->result_array();
	 return $data;

	}
	public function getOperationCountById($id)
	{
	 $query = $this->db->query("SELECT `op_id` FROM rel_part_operation where part_id='$id' ");
	 $data = $query->num_rows();
	 return $data;

	}
	public function getQCById($id)
	{
	 //$query = $this->db->query("SELECT `ID`, `part_id`, `inspection_stage`, `qualityID`, `std_value`, `min_value`, `max_value`, `no_of_samples` FROM rel_part_qc where part_id='$id' ");
	 $query = $this->db->query("SELECT reqc.`ID`, reqc.`part_id`, reqc.`inspection_stage`, reqc.`qualityID`, reqc.`std_value`, reqc.`min_value`, reqc.`max_value`, reqc.`no_of_samples`, qc.`name` as quality_name,qc.`numof_decimal` FROM rel_part_qc reqc inner join mast_quality_checks qc on reqc.`qualityID`= qc.`id`  where part_id='$id' and reqc.isdeleted=0");
	 $data = $query->result_array();
	 return $data;

	}
	public function getProductfamily()
	{
	 $query = $this->db->query("SELECT id,name FROM mast_productfamily order by id desc");
	 $data = $query->result_array();
	 return $data;

	}
	public function getCustName()
	{
	 $query = $this->db->query("SELECT id,name FROM mast_customer order by id desc");
	 $data = $query->result_array();
	 return $data;

	}
	public function getConsignee($custId)
	{
	 $query = $this->db->query("SELECT id,name FROM mast_consignee where cust_id='$custId' order by id desc");
	 $data = $query->result_array();
	 return $data;

	}
	public function getConsigneeById($Id)
	{
	 $query = $this->db->query("SELECT id,name FROM mast_consignee where id='$Id'");
	 $data = $query->row_array();
	 return $data;

	}
	public function getPartName()
	{
	 $query = $this->db->query("SELECT part_id ,name,partno FROM mast_part order by part_id desc");
	 $data = $query->result_array();
	 return $data;

	}
	public function getOperationName()
	{
	 $query = $this->db->query("SELECT id ,Name FROM mast_operation where isdeleted=0 order by id desc");
	 $data = $query->result_array();
	 return $data;

	}
	public function getQualityChecks()
	{
	 $query = $this->db->query("SELECT id ,name FROM mast_quality_checks order by id desc");
	 $data = $query->result_array();
	 return $data;

	}
	public function getQualityChecksByType($type)
	{
	 $query = $this->db->query("SELECT id ,name FROM mast_quality_checks where inspection_stage='$type' order by id desc");
	 $data = $query->result_array();
	 return $data;

	}

	/*------------------------Raw Material---------------------------------*/

	public function getRawMaterial()
	{
	 $query = $this->db->query("SELECT `rm_id`, `company_id`, `matcode`, `name`, `length`, `width`, `thickness`, `hardness`, `uom`, `hsnCode`, `reorderQty`, `remarks`, `created_on`, `created_by`, `updated_on`, `updated_by` FROM mast_rm where isdeleted=0 order by rm_id desc");
	 $data = $query->result_array();
	 return $data;

	}
	public function getRawMaterialbyrmid($id) //new
	{
		 $query = $this->db->query("SELECT `rm_id`, `company_id`, `matcode`, `name`, `length`, `width`, `thickness`, `hardness`, `uom`, `hsnCode`, `reorderQty`, `remarks`, `created_on`, `created_by`, `updated_on`, `updated_by` FROM mast_rm where isdeleted=0 and rm_id = '$id' order by rm_id desc");
		 $data = $query->row_array();
		 return $data;

	}
	public function getRawMaterialNameId()
	{
	 $query = $this->db->query("SELECT `rm_id`, `name`, `uom` FROM mast_rm where isdeleted=0 order by rm_id desc");
	 $data = $query->result_array();
	 return $data;

	}
	public function getrmById($id)
	{
	 $query = $this->db->query("SELECT `rm_id`, `company_id`, `matcode`, `type`, `grade`, `name`, `length`, `width`, `thickness`, `hardness`, `uom`, `hsnCode`, `reorderQty`, `remarks`, `created_on`, `created_by`, `updated_on`, `updated_by` FROM mast_rm where rm_id='$id'");
	 $data = $query->row_array();
	 return $data;

	}
	public function getrmId()
	{
	 $query = $this->db->query("SELECT rm_id FROM `mast_rm` ORDER BY `rm_id` DESC LIMIT 1;");
	 $data = $query->row_array();
	 return $data;

	}
	


	/*------------------------Operations---------------------------------*/
	public function getOperation($id)
	{
	 $query = $this->db->query("SELECT id,name,carriedOut,rmConsumption FROM mast_operation where id='$id' order by id desc");
	 $data = $query->row_array();
	 return $data;

	}
	
	public function getOperations()
	{
	 $query = $this->db->query("SELECT mo.id, mo.Name, mo.carriedOut, mo.rmConsumption,mog.name as groName FROM mast_operation mo,mast_op_group mog where mog.id=mo.op_group_id and  mo.isdeleted=0  order by mo.op_group_id,mo.id  ");
	 $data = $query->result_array();
	 return $data;

	}
	public function getOperationsById($id)
	{
	 $query = $this->db->query("SELECT `id`, `op_group_id`, `Name`, `carriedOut`, `rmConsumption` FROM mast_operation where id='$id' and isdeleted=0 ");
	 $data = $query->row_array();
	 return $data;

	}


	/*------------------------Operations Groups---------------------------------*/

	public function getOperationsGroups()
	{
	 $query = $this->db->query("SELECT `id`,`name` FROM mast_op_group order by id desc ");
	 $data = $query->result_array();
	 return $data;

	}


	/*------------------------Transactions---------------------------------*/

	public function getOrderAcceptance()
	{
	 $query = $this->db->query("SELECT tom.id, tom.year, tom.consignee_id, tom.cust_pono, tom.cust_podate, tom.labour_po, tom.amendment_details, tom.payment_terms,mcust.name as custName FROM tran_oa_mast tom, mast_customer mcust where tom.customer_id=mcust.id and tom.isdeleted=0  order by id desc");
	 $data = $query->result_array();
	 //echo $this->db->last_query(); die;
	 return $data;

	}
	public function getOrdAcceptById($id)
	{
	 $query = $this->db->query("SELECT `id`, `company_id`, `customer_id`, `consignee_id`, `year`, `cust_pono`, `cust_podate`, `labour_po`, `amendment_details`, `payment_terms` FROM `tran_oa_mast` where id='$id' ");
	 $data = $query->row_array();
	 return $data;

	}
	public function getOADetailsById($id)
	{
	  $query = $this->db->query("SELECT `id`, `mast_oa_id`, `part_id`, `op_id`, `qty`, `rate`, `with_effect_from`, `igst`, `cgst`, `sgst` FROM `tran_oa_details` where mast_oa_id='$id' order by id asc");
	 $data = $query->result_array();
	 return $data;

	}public function getSchedule()
	{
	  $query = $this->db->query("SELECT `id`, `year`, `oa2_id`, `part_id`, `customer_id`, `from_date`, `to_date`, `weekno`, `scheduled_qty`, `dispatched_qty` FROM `tran_schedule` order by id desc ");
	 $data = $query->result_array();
	 return $data;

	}public function getScheduleById($id)
	{
	  $query = $this->db->query("SELECT `id`, `year`, `oa2_id`, `part_id`, `customer_id`, `from_date`, `to_date`, `weekno`, `scheduled_qty`, `dispatched_qty` FROM `tran_schedule` where id='$id' ");
	 $data = $query->result_array();
	 return $data;

	}public function getScheduleByOA2Id($id)
	{
	  $query = $this->db->query("SELECT `id` FROM `tran_schedule` where oa2_id='$id' ");
	 $data = $query->num_rows();
	 return $data;

	}public function getSchedulePartMonth($part_id,$to_date)
	{
	 $msg="";
	 $query = $this->db->query("SELECT `id`, `year`, `oa2_id`, `part_id`, `customer_id`, `from_date`, `to_date`, `weekno`, `scheduled_qty`, `dispatched_qty` FROM `tran_schedule` where part_id = '$part_id' and to_date = '$to_date' order by id desc ");
	 $data = $query->row_array();
	 $schedule_id= $data['id'];
	 if($schedule_id >0)
	 {
        	 $query = $this->db->query("SELECT `id` from tran_prod_planning where schedule_id = '$schedule_id'");
        	 $data = $query->result_array();
        	 if (sizeof($data))
        	  { $msg="Planning is done against this part for this month. Please delete the Item from excel file.";}
        	 else
        	 {$msg=$schedule_id;}
     }
	 return $msg;

	}
	
	
	public function getProdPlanBySchId($schedule_id)
	{
	 
	 $query = $this->db->query("SELECT `id`, `schedule_id`, `branch_id`, `supplier_id`,`planning_qty` from tran_prod_planning where schedule_id = '$schedule_id'");
     $data = $query->row_array();
	 return $data;

	}
	public function getPartBypartno($partno)
	{
	 
	 $query = $this->db->query("SELECT `part_id`, `name` FROM mast_part where partno='$partno' ");
	 $data = $query->row_array();
	 return $data;

	}
	public function getCustomersbyid($id)
	{
	 $query = $this->db->query("SELECT * FROM mast_customer where id='$id' ");
	 $data = $query->row_array();
	 return $data;

	}
	public function getOAbypartNoCust($ScreenCustomerId,$excPartId,$current_year)
	{
	 $query = $this->db->query("SELECT od.id, od.mast_oa_id, od.part_id, od.op_id, od.qty, od.rate, od.with_effect_from, od.igst, od.cgst, od.sgst, od.scheduled_qty FROM tran_oa_details od INNER JOIN tran_oa_mast om ON om.id=od.mast_oa_id WHERE om.year='$current_year' and od.part_id='$excPartId' and om.customer_id='$ScreenCustomerId'");
	 $data = $query->result_array();
	 //echo $this->db->last_query();die;
	 return $data;

	}
	public function getBranchbyId($id)
	{
	  $year=$_SESSION['current_year'];
	 $query = $this->db->query("SELECT DISTINCTROW id,name FROM mast_branch where id = '$id' and current_year='$year'");
	 $data = $query->row_array();
	 return $data;
	}
	public function getSchedulePlanning()
	{
		 $custId 		=$_POST['Customer_Id'];
		 $scheduleDate  =$_POST['schedule_date'];
		 $toDate 	    =date("Y-m-t", strtotime($scheduleDate));
		
		 // $query = "SELECT ts.id, ts.part_id, ts.to_date, ts.scheduled_qty, ts.customer_id,0 as ob,SUM(ps.received_qty) as receipt,SUM(ps.issue_qty+ps.inprocess_loss_qty+ps.rejected_qty) as issue ,SUM(ps.booked_qty) as reserve_qty FROM tran_schedule ts,tran_partsrcir_stock ps WHERE ts.to_date='$toDate'  and ps.year='$_SESSION[current_year]' and ps.part_id=ts.part_id ";
		 $query = "SELECT ts.id, ts.part_id, ts.to_date, ts.scheduled_qty, ts.customer_id, ps.stock FROM tran_schedule ts left join ( select part_id, SUM(received_qty - issue_qty - inprocess_loss_qty - rejected_qty - booked_qty) as stock from tran_partsrcir_stock group by part_id )ps on ps.part_id = ts.part_id WHERE ts.to_date = '$toDate' and year= '$_SESSION[current_year]' ";
    		
    		 if($custId != '')
    		 {
    		    $query .= " and ts.customer_id='$custId'";
    		 }
    		 $query .= " group by ts.part_id ";
    		 
		 $querys = $this->db->query($query);
		 
		 $data = $querys->result_array();
		 
        
// 		 if(empty($data[0]['id']))
// 		 {
		   
// 		   $query = "SELECT ts.id, ts.part_id, ts.to_date, ts.scheduled_qty, ts.customer_id,0 as stock FROM tran_schedule ts WHERE ts.to_date='$toDate'";
// 		   if($custId != '')
//     		 {
//     		   $query .= " and ts.customer_id='$custId'";
//     		 }
// 		 $querys1 = $this->db->query($query);
// 		   $data = $querys1->result_array();  
// 		  }
		 //echo $this->db->last_query();die;
		 return $data;

	}
	
	public function getBranch()
	{
	   // $year=$_SESSION['current_year'];
	 $query = $this->db->query("SELECT DISTINCTROW id,name FROM mast_branch order by id  ");
	 $data = $query->result_array();
	 return $data;

	}
	public function getrawMaterialByPartId($partId)
	{
		$query = $this->db->query("SELECT `id`, `part_id`, `rm_id`, `grossweight`, `assembly_part_id`, `assembly_part_qty`, `scrap_normal`, `scrap_ss`, `scrap_tikli` FROM rel_part_rm where part_id='$partId' ");
		$data = $query->result_array();
	 	return $data;

	}
	public function getRMStock($branch_id,$rm_id)
	{
		$query = $this->db->query("SELECT * FROM `rm_stock` WHERE `branch_id` = '$branch_id' and year='$_SESSION[current_year]' and rm_id='$rm_id'");
		$data = $query->row_array();
	 	return $data;

	}
	public function getPartStock($branch_id,$part_id)
	{
		$query = $this->db->query("SELECT * FROM `part_stock` WHERE `branch_id` = '$branch_id' and year='$_SESSION[current_year]' and part_id='$part_id'");
		$data = $query->row_array();
	 	return $data;

	}
	public function getBS($scheduleId,$type,$branch_id,$toDate)
	{
		$query = $this->db->query("SELECT * FROM `tran_prod_planning` WHERE `schedule_id` = '$scheduleId' and prod_type='$type' and branch_id='$branch_id' and date='$toDate'");
		$data = $query->row_array();
		//echo $this->db->last_query();die;
		//print_r($data);die;
	 	return $data;

	}
	public function getIP($scheduleId,$type)
	{
		$query = $this->db->query("SELECT tpp.id,tpp.planning_qty,mb.name,mb.id as branchId FROM tran_prod_planning tpp, mast_branch mb WHERE tpp.branch_id=mb.id and tpp.schedule_id=$scheduleId and tpp.prod_type='$type' ");
		$data = $query->result_array();
		return $data;

	}
	public function getProdPlanningById($id)
	{
		$query = $this->db->query("SELECT tpp.branch_id, tpp.schedule_id, tpp.date, tpp.planning_qty, tpp.prod_type,tsch.part_id FROM tran_prod_planning tpp ,tran_schedule tsch WHERE tpp.id=$id and tsch.id=tpp.schedule_id;");
		$data = $query->row_array();
		return $data;

	}
	
	public function getPartsByCust($custId)
	{
	 $query = $this->db->query("SELECT part_id,name FROM mast_part where customer_id='$custId'");
	 $data = $query->result_array();
	 return $data;

	}
	public function getTools()
	{
	 $query = $this->db->query("SELECT id, name, ideal_qty, ob, grinded_on, owner_branch_id, location_branch_id, remarks FROM mast_tools ");
	 $data = $query->result_array();
	 return $data;

	}
	public function getToolById($id)
	{
	 $query = $this->db->query("SELECT id, name, ideal_qty, ob, grinded_on, owner_branch_id, location_branch_id FROM mast_tools where id='$id'");
	 $data = $query->row_array();
	 return $data;

	}
	public function getOperationsNotforPart($editpartId)
	{
	 $query = $this->db->query("SELECT mo.id, mo.Name, mo.carriedOut, mo.rmConsumption,mog.name as groName FROM mast_operation mo,mast_op_group mog where mog.id=mo.op_group_id and  mo.isdeleted=0 and mo.id NOT IN(SELECT `op_id` FROM rel_part_operation where part_id='$editpartId' and isdeleted=0) order by mo.op_group_id,mo.id  ");
	 $data = $query->result_array();
	 //echo $this->db->last_query();die;
	 return $data;

	}
	public function getPartsByProdFamilyId($prod_family_id)
	{
	 $query = $this->db->query("SELECT part_id,name,partno FROM `mast_part` where prodfamily_id=$prod_family_id");
	 $data = $query->result_array();
	 //echo $this->db->last_query();die;
	 return $data;

	}
    public function getRelPartsById()
	{
		 $partId 		=$_POST['part_id'];
		 $query = $this->db->query("SELECT rpo.id,rpo.op_id,rpo.nosperkg,rpo.nosperhour,rpo.tool_id1,rpo.tool_id2,mo.Name FROM rel_part_operation rpo, mast_operation mo WHERE rpo.op_id=mo.id and rpo.part_id='$partId' and rpo.isdeleted=0 order by rpo.sequence_no");
		 $data = $query->result_array();
		 return $data;

	}
	/*
	----Use getPartsByProdFamilyId this function----
	public function getPartNameByProdFIDCustId($Prod_Family_Id)
	{
	 $query = $this->db->query("SELECT part_id ,partno,name FROM `mast_part` WHERE prodfamily_id='$Prod_Family_Id' ");
	 $data = $query->result_array();
	 //echo $this->db->last_query();die;
	 return $data;

	}*/
	
// 	------------------------------spplier------------------------

public function getSupRelation($supId)
	{
	 $query = $this->db->query("SELECT * FROM rel_supplier_operation where supplier_id='$supId' order by id desc");
	 $data = $query->result_array();
	 return $data;

	}
// 	-------------------------------------requisition------------------------

public function getRmStockbyid($id,$year)
	{
	// $query = $this->db->query("SELECT `id`,`rm_id`,`year`, `branch_id`, `ob`,`reserve_qty`,`receipt`,`issue`,`scrap_tikli`,`scrap_ss`,`scrap_normal` FROM `rm_stock` where rm_id='$id' AND year = '$year' order by branch_id");
        $query = $this->db->query("select branch_id,sum(received_qty-rejected_qty-issue_qty-booked_qty-inprocess_loss_qty) as current_stock from tran_rmrcir_stock where rm_id='$id' AND year = '$year'  group by branch_id");
        //echo $this->db->last_query();
	 $data = $query->result_array();
	 return $data;

	}
public function getPlanQtyDetailbyid($id,$year)
	{
		$query = $this->db->query("SELECT tran_schedule.scheduled_qty,tran_schedule.to_date,mp.partno,treq.branch_id FROM `tran_requisition` as treq inner join tran_prod_planning tpp on treq.prod_plan_id =  tpp.id inner join tran_schedule on tpp.schedule_id =  tran_schedule.id inner join mast_part mp on tran_schedule.part_id = mp.part_id
		WHERE treq.`year` = '$year' and treq.`rm_id` = '$id' and (isnull(treq.`tran_po_id`) or treq.`tran_po_id` = 0 )  and treq.plan_req_qty > 0");

		 $data = $query->result_array();
		 return $data;

	}
	public function getrmPlanManuQtybyid($rmid,$year)
	{
	 $query = $this->db->query("SELECT round(sum(`plan_req_qty`),3) as plan_req_qty,round(`manual_qty`,3) as manual_qty,round(`reserve_qty`,3) as reserve_qty FROM `tran_requisition` WHERE `year` = '$year' and `rm_id` = '$rmid' and (isnull(`tran_po_id`) or `tran_po_id` = 0 )");

	 $data = $query->row_array();
	 return $data;
                                               

	}
	//new not added
	public function getTranPoMastbyId($id)
	{
		 $query = $this->db->query("SELECT `id`, `year`, `is_open_po`, `type`, `date`, `supplier_id`, `payment_terms`, `Remarks`, `created_by`, `created_on`, `updated_by`, `updated_on` FROM `tran_po_mast`  where id='$id' order by id desc");
		 $data = $query->row_array();
		 return $data;

	}
	//new not added
public function getTranPoDetailsbyId($id)
	{
		 $query = $this->db->query("SELECT `id`, `mast_po_id`, `rm_id`, `part_id`, `operation_id`, `ordered_qty`, `received_qty`, `accepted_qty`, `returned_qty`, `rate`, `sgst`, `cgst`, `igst`, `branch_id`, `open_status` FROM `tran_po_details`  where mast_po_id ='$id' and isdeleted=0 order by id desc");
		 $data = $query->result_array();
		 return $data;

	}
	
public function getTranPoMast()
	{
	 $query = $this->db->query("SELECT tpmo.*,sup.name as supName FROM `tran_po_mast` tpmo,mast_supplier sup where tpmo.supplier_id=sup.id order by tpmo.id desc");
	 $data = $query->result_array();
	 return $data;

	}
	public function getFirstOperaion($part_id)
	{
	 $query = $this->db->query("SELECT op_id FROM `rel_part_operation` where part_id = $part_id and op_id IN (1,2,3) and isdeleted = 0;");
	 $data = $query->row_array();
	 return $data;

	}
	public function getTranPartsgrrAvailQty($part_id,$year)
	{
	 $query = $this->db->query("SELECT *,(accepted_qty - issue_qty - booked_qty) as available_qty FROM `tran_partsgrr_details` WHERE `part_id` = $part_id and (accepted_qty - issue_qty - booked_qty > 0 ) and year  = '$year' and isdeleted=0 order by id");
	 $data = $query->result_array();
	 return $data;

	}
	public function getTranRmgrrAvailQty($rm_id,$year)
	{
	 $query = $this->db->query("SELECT DISTINCTROW trs.mast_rmrcir_id,trs.det_rmrcir_id,tmp.available_qty FROM tran_rmrcir_stock trs INNER JOIN (select  mast_rmrcir_id,det_rmrcir_id , sum(received_qty - issue_qty - booked_qty - inprocess_loss_qty - rejected_qty) as available_qty FROM `tran_rmrcir_stock`  WHERE `rm_id` = $rm_id  and year  = '$year' and isdeleted=0 GROUP BY det_rmrcir_id) tmp ON trs.mast_rmrcir_id=tmp.mast_rmrcir_id and trs.det_rmrcir_id = tmp.det_rmrcir_id WHERE tmp.available_qty > 0");
	 	$data = $query->result_array();
	 	return $data;
	}
	public function getScheduleByCustIdDate()
	{
		$Customer_Id	=$_POST['Customer_Id'];
		$schedule_date 	=$_POST['schedule_date'];
		$year=$_SESSION['current_year'];
		$toDate 		=date("Y-m-t", strtotime($schedule_date)); 
	  $query = "SELECT `id`, `year`, `oa2_id`, `part_id`, `customer_id`, `from_date`, `to_date`, `weekno`, `scheduled_qty`, `dispatched_qty`  FROM `tran_schedule` where to_date='$toDate' and year='$year'";
	  if($Customer_Id !='')
	  {
	  $query .= " and customer_id='$Customer_Id' ";
	  
	  }
	  $query .= " order by id desc  ";
	  $querys = $this->db->query($query);
	 
	 
	 $data = $querys->result_array();
	 return $data;

	}
	
	
	
/*public function getSupplier()
	{
	 $query = $this->db->query("SELECT `id`, `name`,`supl_type` FROM `mast_supplier` ");
	 $data = $query->result_array();
	 return $data;

	}
*/
public function getSupplier($type=null)
	{
		if($type == 0)
		{
	 		$query = $this->db->query("SELECT `id`, `name`,`supl_type` FROM mast_supplier where isdeleted=0 order by id desc");
		}else{
				$query = $this->db->query("SELECT `id`, `name`,`supl_type` FROM mast_supplier where supl_type = $type and isdeleted=0 order by id desc");
		}
	 $data = $query->result_array();
	 return $data;

	}

public function getSupplierById($id)
	{
	 $query = $this->db->query("SELECT `id`, `name`, `email_id`,`address`,`contact_person_details` FROM `mast_supplier` where id='$id' ");
	 $data = $query->row_array();
	 return $data;

	}
	public function getOperationByPart($id,$Supplier_Id)
	{
	 $query = $this->db->query("SELECT mo.id,mo.Name,rpo.sequence_no from rel_part_operation rpo, mast_operation mo where rpo.part_id = $id and rpo.op_id=mo.id and FIND_IN_SET (op_id , (select GROUP_CONCAT(op_id,',') from rel_supplier_operation where supplier_id = $Supplier_Id))>0 order by rpo.sequence_no ");
	 $data = $query->result_array();
	 //echo $this->db->last_query(); die;
	 return $data;

	}
	public function getDCOperationByPart($partid,$Supplier_Id)
	{
	 $query = $this->db->query("SELECT op_id FROM `tran_partspo_details` tpd INNER JOIN tran_partspo_mast tpm on tpm.id=tpd.mast_partspo_id WHERE tpd.part_id='$partid' and tpm.supplier_id='$Supplier_Id' and tpm.year='$_SESSION[current_year]' and tpd.isdeleted=0 ");
	 $data = $query->result_array();
// 	 echo $this->db->last_query(); die;
	 return $data;

	}
	public function getToolbyPartOperation($partid,$opid)
	{
	 $query = $this->db->query("SELECT mt.id,mt.name FROM mast_tools mt WHERE mt.id IN (select tool_id1 as tool_id from rel_part_operation WHERE part_id = $partid and op_id = $opid UNION select tool_id2 as tool_id from rel_part_operation WHERE part_id = $partid and op_id = $opid )");
	 $data = $query->result_array();
	 
	 
     return $data;

	}
	
	
	
	public function getOtherPo()
	{
	 $query = $this->db->query("SELECT `id`, `date`, `supplier_id`, `year`, `Payment_terms`, `remarks` FROM `tran_partspo_mast` ");
	 $data = $query->result_array();
	 return $data;

	}
	public function getOtherpoById($id)
	{
	 $query = $this->db->query("SELECT `id`, `date`, `supplier_id`, `year`, `Payment_terms`, `remarks`, `wef_date` FROM `tran_partspo_mast` where id='$id' ");
	 $data = $query->row_array();
	 return $data;

	}public function getOtherpoDetails($id)
	{
	  $query = $this->db->query("SELECT `id`, `mast_partspo_id`, `part_id`, `op_id`, `part_remark`, `qty`, `rate`, `uom`, `igst`, `cgst`, `sgst` FROM `tran_partspo_details` where mast_partspo_id='$id' and isdeleted=0 order by id asc");
	 $data = $query->result_array();
	 return $data;

	}
	public function getCountPartStock()
	{
		$query = $this->db->query("SELECT count(id) as ctn FROM `part_stock` ");
		$data = $query->num_rows();
	 	return $data;

	}
	public function GetOperationsGroup()
	{
	    
		$query = $this->db->query("SELECT msgroup.id as grp_is,msgroup.name as group_name,msop.id as operation_id,msop.Name as operation_Name
		FROM mast_op_group as msgroup
		INNER JOIN mast_operation as msop
		ON msgroup.id = msop.op_group_id and msop.id > 3 and msop.carriedOut IN(2,3) order by group_name");
	 $data = $query->result_array();
	 return $data;

	}
	public function GetRMPOMailData($po_id)
	{
		$query = $this->db->query("select * from tran_po_details tpo INNER join tran_po_mast mpo on mpo.id = tpo.mast_po_id  where tpo.mast_po_id = $po_id and tpo.isdeleted = 0");
	 $data = $query->result_array();
	 return $data;
		
	}
	


	public function getTranSupplierSchedule()
	{
		$supplierId 	=$_POST['Supplier_Id'];
		$scheduleDate 	=$_POST['schedule_date'];
		$toDate 	    =date("Y-m-t", strtotime($scheduleDate));
		if($toDate!='1970-01-31')
		{
			$query = $this->db->query("SELECT * FROM `tran_supplier_schedule` WHERE supplier_id='$supplierId' AND to_date='$toDate' ");
		 $data = $query->result_array();
		 //echo $this->db->last_query(); die;
		 return $data;
		}
		
		
	}
	public function addSupplierSchedule()
	{
	    //print_r($_POST);
		$supplierId 	=$_POST['Supplier_Id'];
		$query = $this->db->query("SELECT * FROM `tran_requisition` WHERE supplier_id='$supplierId' and ISNULL(tran_po_id)");
		 $data = $query->result_array();
		 //echo $this->db->last_query(); die;
		 return $data;
	}
	public function getMachinesData()
	{
		$query = $this->db->query(" select `id`, `name`, `branch_id`, `type` from mast_machines order by id desc");
	    $data = $query->result_array();
	    return $data;
		
	}
	public function getMachineById($id)
	{
		$query = $this->db->query(" select `id`, `name`, `branch_id`, `type` from mast_machines where id='$id' ");
	    $data = $query->row_array();
	    return $data;
		
	}
	public function checkUserDetails()
	{
	    $username = $_POST['username'];
	    $password = $_POST['password'];
		$query = $this->db->query("SELECT id FROM `mast_users` where username='$username' and psw='$password' ");
	    $data = $query->row_array();
	    return $data;
		
	}
	public function getPartsRCIRQty($tran_partsrcir_id,$part_id)
	{
	    $query = $this->db->query("select qty from tran_partsrcir_details where id = '$tran_partsrcir_id' and part_id = '$part_id' ");
	    $data = $query->row_array();
	    //echo $this->db->last_query(); die;
	    return $data;
		
	}
	public function getPartsRCIRQty1($suppId)
	{
	    $query = $this->db->query("SELECT SUM(qty) as recqty FROM `tran_partsrcir_details` WHERE supp_schedule_id='$suppId' ");
	    $data = $query->row_array();
	    //echo $this->db->last_query(); die;
	    return $data;
		
	}
	public function checkOASchedule($oaId)
	{
	    $query = $this->db->query("select tsch.id from tran_schedule tsch inner join tran_oa_details tod on tod.id=tsch.oa2_id inner join tran_oa_mast tom on tod.mast_oa_id = tom.id where tom.id = '$oaId' ");
	    $data = $query->num_rows();
	    return $data;
	}
	public function checkOA($partId,$custId)
	{
	    $query = $this->db->query("select tom.id from tran_oa_mast tom inner join tran_oa_details tod on tod.mast_oa_id = tom.id where tom.customer_id='$custId' and tod.part_id= '$partId' ");
	    $data = $query->num_rows();
	    //echo $this->db->last_query(); die;
	    return $data;
	}
	public function getPartsSupplierSchedule()
	{
	    $supplierId 	=$_POST['Supplier_Id'];
	    $schedule_date 	=$_POST['schedule_date'];
	    $toDate 		=date("Y-m-t", strtotime($schedule_date)); 
		$sql = "SELECT * FROM `tran_supplier_schedule` WHERE  to_date='$toDate' ";
		if($supplierId != '')
		{
		    $sql = $sql." and supplier_id='$supplierId'";
		}
		$query = $this->db->query($sql);
		 $data = $query->result_array();
		 //echo $this->db->last_query(); die;
		 return $data;
	}


 
    public function getPoQtybyRmId($rm_id,$year)
	{
	//	$query = $this->db->query("SELECT sum(ordered_qty) as pending_qty FROM `tran_po_details` where rm_id = '$rm_id' and (ordered_qty - received_qty > 0) and year  = '$year' ");
	  	$query = $this->db->query("SELECT sum(ordered_qty) as pending_qty FROM `tran_po_details` where rm_id = '$rm_id' and (ordered_qty - received_qty > 0) and year  = '$year' ");
	  
	    $data = $query->row_array();
	    return $data;
		
	}
    public function getPoQtybyTranRMPoId($rm_id,$year)
	{
		$query = $this->db->query("SELECT (sum(tpd.ordered_qty) - if(isnull(temp.received_qty),0,temp.received_qty)) as po_qty FROM `tran_po_details` tpd left JOIN (SELECT td.open_status,sum(received_qty) as received_qty,ts.tran_rmpo_det_id FROM tran_rmrcir_stock ts inner join tran_rmrcir_details td on td.id = ts.det_rmrcir_id  where td.qty>0 GROUP BY tran_rmpo_det_id ) temp ON tpd.id=temp.tran_rmpo_det_id WHERE   (temp.open_status = '1')   and tpd.rm_id='$rm_id' and tpd.year='$year' group by tpd.id ");
	    $data = $query->row_array();
        //echo $this->db->last_query();die;
	    return $data;
		
	}
	//new added
	public function getDprData()
	{
	   
		$branch_id = $_SESSION['branch_id'];
		$year = $_SESSION['current_year'];

	 $query = $this->db->query("SELECT  DISTINCT(dpr_date),count(id) as Count FROM `tran_dpr` where year  = '$year' and isdeleted = 0 and branch_id = $branch_id group by dpr_date order by dpr_date DESC");

	 $data = $query->result_array();
	 
	 return $data;

	}
    public function GetDPRById($id)
	{
	// $query = $this->db->query("SELECT * from tran_dpr where id= '$id' ");
	 $query = $this->db->query("SELECT * from tran_dpr where dpr_date= '$id' ");
	 $data = $query->row_array();
	 return $data;

	}
	public function Getusers($branch_id,$role)
	{
	 //$query = $this->db->query("SELECT `id`, `fullname`, `fname`, `mname`, `lanme`,`role` from mast_users where branch_id = $branch_id and role = $role");
	 $query = $this->db->query("SELECT m.`id`, `fullname`, `fname`, `mname`, `lanme`,`role` from mast_users m inner join rel_user_role r on m.id=r.user_id  where r.branch_id = $branch_id and r.role_id = $role and r.isdeleted=0 and m.isdeleted=0");
	 $data = $query->result_array();
	 return $data;

	}
	public function Getmachine($branch_id)
	{
		$query = $this->db->query("SELECT `id`, `name`, `branch_id`, `type`, `isdeleted`, `created_by`, `created_on`, `updated_by`, `updated_on` FROM `mast_machines` WHERE branch_id = '$branch_id' and isdeleted = 0");
	 $data = $query->result_array();
	 return $data;

	}
	public function GetMastTools()
	{
			$query = $this->db->query("SELECT `id`, `name`, `ideal_qty`, `grinded_on`, `owner_branch_id`, `location_branch_id`, `remarks`, `created_by`, `created_on`, `updated_by`, `updated_on`, `company_id`, `isdeleted` FROM `mast_tools` WHERE isdeleted = 0");
			$data = $query->result_array();
			return $data;

	}
	public function GetTranScheduleParts($supplierId)
	{
			$query = $this->db->query("SELECT * FROM `tran_supplier_schedule` WHERE supplier_id='$supplierId' and (tran_partsrcir_id=0 or isnull(tran_partsrcir_id)) and isdeleted=0");
			$data = $query->result_array();
			return $data;

	}
	public function getProdPart_Id($date)
	{
		$query = $this->db->query("SELECT DISTINCTROW id,planning_qty,part_id FROM `tran_prod_planning` WHERE Month(date) = Month('$date') and year(date) = year('$date')  and planning_qty > 0");
	 $data = $query->result_array();
	 return $data;

	}
	public function GetuserById($id)
	{
	 $query = $this->db->query("SELECT `id`, `fullname`, `fname`, `mname`, `lanme`, `supplier_id` from mast_users where id= '$id' ");
	 $data = $query->row_array();
	 return $data;

	}
	public function getOperbyPart_Id($partId,$type,$branch_id=null)
	{
	   
// 		if($type == 6)
// 		{
// 		 	$query = $this->db->query("SELECT * FROM `rel_part_operation` where part_id = '$partId' and op_id IN(select op_id FROM rel_supplier_operation where supplier_id = '$branch_id' and isdeleted = 0 ) and isdeleted = 0 order by sequence_no");
// 		}else{
			 $query = $this->db->query("SELECT * from rel_part_operation WHERE part_id = '$partId' and op_id IN(select op_id from mast_operation WHERE carriedOut IN(1,3) and isdeleted = 0) and  isdeleted = 0 order by sequence_no");
	
		//}
		
		
		 $data = $query->result_array();
		 
	
		 return $data;
	}
	public function getTranRmgrrTotAvailQty($rm_id,$year,$branch_id)
	{
	 
	 $query = $this->db->query("SELECT det_rmrcir_id,sum(received_qty - issue_qty - inprocess_loss_qty - rejected_qty) as available_qty FROM  tran_rmrcir_stock WHERE `rm_id` = $rm_id and (received_qty - issue_qty - inprocess_loss_qty - rejected_qty > 0 ) and branch_id = $branch_id and year = '$year' and isdeleted=0 ");
	 $data = $query->row_array();
	 return $data;

	}
	public function getToolSucess($date)
	{
	 $query = $this->db->query("SELECT sum(qty) as qty from tran_dpr where tool_id = 1 and dpr_date > '$date' and isdeleted = 0");
	 $data = $query->row_array();

	 return (!empty($data['qty'])) ? $data['qty'] : 0;;

	}
	
	public function getConsumpoById($id)
	{
	 $query = $this->db->query("SELECT `id`, `date`, `supplier_id`, `year`, `payment_terms`, `remarks` FROM `tran_consumpo_mast` where id='$id' ");
	 $data = $query->row_array();
	 return $data;

	}
    public function getConsumpoPo()
	{
	 $query = $this->db->query("SELECT `id`, `date`, `supplier_id`, `year`, `payment_terms`, `remarks` FROM `tran_consumpo_mast` ");
	 $data = $query->result_array();
	 return $data;

	}
public function getConsumpoDetails($id)
	{
	  $query = $this->db->query("SELECT `id`, `mast_consumpo_id`, `description`, `remarks`, `qty`, `rate`, `uom`, `igst`, `cgst`, `sgst` FROM `tran_consumpo_details` where mast_consumpo_id='$id' and isdeleted=0 order by id asc");
	 $data = $query->result_array();
	 return $data;

	}
    public function getRCIRQty($supId)
    {
		$branch_id 	= $_SESSION['branch_id'];
		$year 		= $_SESSION['current_year'];
        
        $query = $this->db->query("select ss.id,ss.part_id,ss.qty as ordered_qty,sum(tpd.qty) as rec_qty,(ss.qty-if(tpd.qty,tpd.qty,0)) as bal_qty,ss.tran_partspo_det_id,tpd.op_id from tran_supplier_schedule ss left join (select supp_schedule_id,op_id,sum(qty) as qty from tran_partsrcir_details group by supp_schedule_id ) as tpd on tpd.supp_schedule_id = ss.id left JOIN tran_partspo_details tpo ON ss.tran_partspo_det_id=tpo.id  where ss.year= '$year' and ss.receiving_branch_id = '$branch_id' and ss.supplier_id = '$supId'  and ss.qty-if(tpd.qty,tpd.qty,0) >0");
       //echo $this->db->last_query(); die;
        $data = $query->result_array();
        return $data;
    
    }
    public function getRmrcirDetails()
	{
	 $query = $this->db->query("SELECT * FROM `tran_rmrcir_details` where isdeleted = 0 ");
	 $data = $query->result_array();
	 return $data;

	}
	public function getRMBymaterialType($type)
	{
	 $query = $this->db->query("SELECT id ,name,inspection_method,qc_type FROM mast_quality_checks where material='$type' order by id desc");
	 
	 $data = $query->result_array();
	 return $data;

	}
	public function getRMBySupplId($id)
	{
	 $query = $this->db->query("SELECT trd.rm_id,trd.qty FROM `tran_rmrcir_details` trd INNER join tran_rmrcir_mast trm on trd.mast_rmrcir_id  = trm.id where trd.isdeleted = 0 and trm.year = '$_SESSION[current_year]' and trm.supplier_id = $id and trd.id NOT IN (SELECT rmrcir_det_id from tran_rmqc_check)");
	 
	 $data = $query->result_array();
	 return $data;

	}
	public function getPartRCIR()
	{
	 $query = $this->db->query("SELECT tpm.id,tpm.challan_no,tpm.challan_date,tpm.isdeleted,tpm.year,ms.name FROM tran_partsrcir_mast tpm ,mast_supplier ms WHERE tpm.supplier_id=ms.id and tpm.branch_id='$_SESSION[branch_id]' and tpm.isdeleted=0 order by tpm.id desc");
	 $data = $query->result_array();
	 return $data;

	}
	public function getRMRCIRQty($suppId)
	{
	    $branch_id 	= $_SESSION['branch_id'];
		$year 		= $_SESSION['current_year'];
//	$query = $this->db->query("SELECT tpd.* FROM tran_po_details tpd INNER JOIN tran_po_mast tpm ON tpd.mast_po_id=tpm.id WHERE tpm.supplier_id='$suppId' and tpd.branch_id='$branch_id' and tpm.year='$year' and tpd.isdeleted=0 and (tpd.ordered_qty-tpd.received_qty) > 0");
      $query = $this->db->query("select tpd.*,tpd.id,tpd.ordered_qty,if(isnull(temp.rej_qty),0,temp.rej_qty) as rej_qty,if(isnull(temp.rec_qty),0,temp.rec_qty)as rec_qty from tran_po_details tpd INNER JOIN tran_po_mast tpm ON tpd.mast_po_id=tpm.id left join (select tran_rmpo_det_id,sum(received_qty) as rec_qty,sum(rejected_qty) as rej_qty from tran_rmrcir_stock group by tran_rmpo_det_id ) temp on temp.tran_rmpo_det_id= tpd.id or temp.tran_rmpo_det_id is null WHERE tpm.supplier_id='$suppId' and tpd.branch_id='$branch_id' and tpm.year='$year' and tpd.isdeleted=0 and tpd.open_status='1' and (tpd.ordered_qty-if(isnull(temp.rec_qty),0,temp.rec_qty)-if(isnull(temp.rej_qty),0,temp.rej_qty)) > 0");
	//echo $this->db->last_query(); die;
	 $data = $query->result_array();
	 return $data;

	}
	
	//New Addition By Aparna
    public function getConsumpoDetailsBySupl($supl_id)
	{
	  $query = $this->db->query("SELECT tpd.`id`, tpd.`mast_consumpo_id`, tpd.`description`, tpd.`remarks`, tpd.`qty`, tpd.`rate`, tpd.`uom`, tpd.`igst`, tpd.`cgst`, tpd.`sgst` FROM `tran_consumpo_details`tpd inner join tran_consumpo_mast tpm on tpm.id = tpd.mast_consumpo_id where tpm.supplier_id='$supl_id' and tpd.isdeleted=0 and tpd.qty>0 order by tpd.id asc");
	 $data = $query->result_array();
	 return $data;

	}
	public function getPartRCIRDetailsByID($id)
	{
	  $query = $this->db->query("SELECT * FROM `tran_partsrcir_details` where mast_partsrcir_id='$id' and qty > 0 order by id asc");
	 $data = $query->result_array();
	 return $data;

	}
	public function getPartRCIRMastByID($id)
	{
	  $query = $this->db->query("SELECT * FROM `tran_partsrcir_mast` where id='$id' order by id asc");
	 $data = $query->row_array();
	 return $data;

	}
	public function getRMRCIR()
	{
	 $query = $this->db->query("SELECT tpm.id,tpm.challan_no,tpm.challan_date,tpm.isdeleted,tpm.year,ms.name FROM tran_rmrcir_mast tpm ,mast_supplier ms WHERE tpm.supplier_id=ms.id and tpm.branch_id='$_SESSION[branch_id]' and tpm.isdeleted=0 order by tpm.id desc");
	 $data = $query->result_array();
	 return $data;

	}
	public function getRMRCIRMastByID($id)
	{
	  $query = $this->db->query("SELECT * FROM `tran_rmrcir_mast` where id='$id' order by id asc");
	 $data = $query->row_array();
	 return $data;

	}
	public function getRMRCIRDetailsByID($id)
	{
	  $query = $this->db->query("SELECT * FROM `tran_rmrcir_details` where mast_rmrcir_id='$id' and qty >0 order by id asc");
	 $data = $query->result_array();
	// echo $this->db->last_query(); die;
	 return $data;

	}
	
	/*------------------Delivery Challan------------------*/
    public function getTrandcmast()
	{
	 $query = $this->db->query("SELECT `id`, `date`, `year`, `supplier_id`, `branch_id`, `dc_type`, `dc_no`, `remarks` FROM `tran_dc_mast` ");
	 $data = $query->result_array();
	 return $data;

	}
    public function getDCListBySuppId($Supp_Id)
	{
	 $query = $this->db->query("SELECT `id` , `dc_no` FROM `tran_dc_mast` where year='$_SESSION[current_year]' and supplier_id='$Supp_Id' and branch_id='$_SESSION[branch_id]' ");
	 $data = $query->result_array();
	 //echo $this->db->last_query();
	 return $data;

	}
    public function getPoRateDetails()
	{
	 $query = $this->db->query("SELECT tppd.`id`,tppd. `mast_partspo_id`, tppd.`part_id`, tppd.`op_id`, tppd.`qty`, tppd.`rate`, tppd.`uom`, tppd.`part_remark`, tppd.`igst`, tppd.`cgst`, tppd.`sgst`, tppd.`isdeleted` FROM `tran_partspo_details` tppd INNER JOIN tran_partspo_mast tppm ON tppm.id=tppd.mast_partspo_id WHERE tppd.part_id='$_POST[Part_Id]' and tppd.op_id='$_POST[Op_Id]' and tppm.supplier_id='$_POST[Supplier_Id]' and tppd.isdeleted=0 ORDER BY tppd.id desc LIMIT 1");
	 $data = $query->row_array();
	 //echo $this->db->last_query();die;
	 return $data;

	}
	public function getDCRCIRQty($supId)
    {
		$branch_id 	= $_SESSION['branch_id'];
		$year 		= $_SESSION['current_year'];
        $query = $this->db->query("select ss.id,ss.part_id,ss.qty as ordered_qty,sum(tpd.qty) as rec_qty,(ss.qty-sum(tpd.qty)) as bal_qty,ss.tran_partspo_det_id,tpo.op_id from tran_supplier_schedule ss left join tran_partsrcir_details tpd on tpd.supp_schedule_id = ss.id left JOIN tran_partspo_details tpo ON ss.tran_partspo_det_id=tpo.id where ss.year= '$year' and ss.receiving_branch_id = '$branch_id' and ss.supplier_id = '$supId' group by ss.id");
       //echo $this->db->last_query(); 
        $data = $query->result_array();
        return $data;
    
    }
    public function getPrevOpQty($partId,$opId)
	{
	  
		$query = $this->db->query("select op_id from rel_part_operation where part_id ='$partId' and sequence_no= (select sequence_no-1 from rel_part_operation where part_id='$partId' and op_id='$opId' ) and isdeleted = 0");
		$PreOPIds = $query->row_array();
		
		$PreOPId = $PreOPIds['op_id'];
		$query = $this->db->query("select sum(received_qty-issue_qty-inprocess_loss_qty-rejected_qty) as max_qty from tran_dpr_stock where part_id = '$partId' and operation_id ='$PreOPId' and year = '$_SESSION[current_year]' union select (received_qty-issue_qty-inprocess_loss_qty-rejected_qty) as max_qty from tran_partsrcir_stock where part_id='$partId' and op_id='$PreOPId' ");
		$data = $query->result_array();
	   
		$totalStock = "";
		if(!empty($data))
		{
			foreach ($data as $key => $value) {
				$totalStock += $value['max_qty'];
			}
		}

		return $totalStock;
	}
    public function getCurrentOpQty($partId,$opId)
	{
	  
		$query = $this->db->query("select id,sum(received_qty-issue_qty-inprocess_loss_qty-rejected_qty) as max_qty from tran_dpr_stock where part_id = '$partId' and operation_id ='$opId' and year = '$_SESSION[current_year]' and received_qty-issue_qty-inprocess_loss_qty-rejected_qty > 0 GROUP BY mast_dpr_id union select id,(received_qty-issue_qty-inprocess_loss_qty-rejected_qty) as max_qty from tran_partsrcir_stock where part_id='$partId' and op_id='$opId' and received_qty-issue_qty-inprocess_loss_qty-rejected_qty > 0 GROUP BY det_partsrcir_id ");
		$data = $query->result_array();
	   echo $this->db->last_query(); die;
		$totalStock = "";
		if(!empty($data))
		{
			foreach ($data as $key => $value) {
				$totalStock += $value['max_qty'];
			}
		}

		return $totalStock;
	}
	 public function getAllstageQty($partId,$opId=null)
	{
	  if($opId == 17)
	  {
	     
	      $query = $this->db->query("select sum(received_qty-issue_qty-inprocess_loss_qty-rejected_qty) as max_qty from tran_dpr_stock where part_id = '$partId' and operation_id = '$opId'  and year = '$_SESSION[current_year]' union select (received_qty-issue_qty-inprocess_loss_qty-rejected_qty) as max_qty from tran_partsrcir_stock where part_id='$partId' and op_id='$opId' ");
		$data = $query->result_array();
	      
	  }else{
	      
	     $query = $this->db->query("select sum(received_qty-issue_qty-inprocess_loss_qty-rejected_qty) as max_qty from tran_dpr_stock where part_id = '$partId' and operation_id != 17  and year = '$_SESSION[current_year]' union select (received_qty-issue_qty-inprocess_loss_qty-rejected_qty) as max_qty from tran_partsrcir_stock where part_id='$partId' and op_id != 17 ");
		 $data = $query->result_array(); 
	  }
		
		$totalStock = "";
		if(!empty($data))
		{
			foreach ($data as $key => $value) {
				$totalStock += $value['max_qty'];
			}
		}
	
		return round($totalStock,3);
	}
    
	public function getDCDetails($id)
	{
	  //$query = $this->db->query("SELECT `id`, `mast_dc_id`, `part_id`, `qty`, `max_qty`, `dpr_id`, `rcir_id`, `op_id`, `parts_po_det_id`, `remarks` FROM `tran_dc_details` where mast_dc_id='$id' and isdeleted=0 order by id asc");
	 $query=$this->db->query("SELECT dc.id, dc.mast_dc_id, dc.part_id, dc.qty,dc.max_qty, dc.dpr_id, dc.rcir_id, dc.op_id, dc.parts_po_det_id, dc.remarks,po.qty as part_qty,po.rate as part_rate,mp.name as part_name,mp.hsncode,round(po.qty*po.rate) as total_amount FROM tran_dc_details as dc inner join tran_partspo_details as po on po.id = dc.parts_po_det_id INNER JOIN mast_part mp on po.part_id = mp.part_id  where dc.mast_dc_id='$id' and dc.isdeleted=0 order by dc.id asc");
	 $data = $query->result_array();
	 return $data;

	}
	public function getDCMastById($id)
	{
	 $query = $this->db->query("SELECT `id`, `date`, `year`, `supplier_id`, `branch_id`, `dc_type`, `dc_no`, `remarks`, `transporter_name`, `vehicle_no` FROM `tran_dc_mast` where id='$id' ");
	 $data = $query->row_array();
	 return $data;

	}
	public function getPossibleQty($op_id,$partId,$booked_doc_id)
	{
	    
	    
		$query = $this->db->query("SELECT rm_id,grossweight,scrap_normal,scrap_ss FROM `rel_part_rm` WHERE part_id = '$partId' ");
		$data = $query->row_array();
		 

		$query1 = $this->db->query("SELECT branch_id,sum(received_qty - rejected_qty - issue_qty - booked_qty - inprocess_loss_qty) as stock from tran_rmrcir_stock where rm_id='$data[rm_id]' AND year = '$_SESSION[current_year]'  and branch_id = '$_SESSION[branch_id]' UNION select branch_id,sum(booked_qty) from tran_rmrcir_stock where booked_doc_type  = 'prod_plan' AND booked_doc_id  = '$booked_doc_id' ");

		$data1 = $query1->result_array();
		

		if(!empty($data1))
		{
			$totalStock = "";
			foreach ($data1 as $key => $value) {
				$totalStock += $value['stock'];
			}
		}

		$arrayName = array('stock' => $totalStock,'grossweight' => $data['grossweight'],'scrap_normal' => $data['scrap_normal'],'scrap_ss' => $data['scrap_ss'], );

		return $arrayName;
	}
	public function getRmBookedRec($prod_plan_id)
	{
		$query = $this->db->query("SELECT * from tran_rmrcir_stock where booked_doc_type = 'prod_plan' and booked_doc_id = $prod_plan_id");

		$PreOPIds23 = $query->result_array();
		return $PreOPIds23;
		 
	}
	public function getRmAvailStock($rm_id)
	{
		$query = $this->db->query("SELECT mrmrd.id as det_id,mrmro.date,mrmro.id as mast_id,temp.max_qty from tran_rmrcir_details mrmrd INNER JOIN tran_rmrcir_mast mrmro on mrmro.id = mrmrd.mast_rmrcir_id inner join (select det_rmrcir_id,(received_qty-issue_qty-inprocess_loss_qty-rejected_qty) as max_qty from tran_rmrcir_stock where rm_id='$rm_id' and  branch_id = '$_SESSION[branch_id]' group by det_rmrcir_id) temp on temp.det_rmrcir_id= mrmrd.id where temp.max_qty > 0 ORDER By date");

		$PreOPIds23 = $query->result_array();
		return $PreOPIds23;
		 
	}
	public function updatePartOpStock($partId,$opId)
 	{
 	    
 	    $query = $this->db->query("select op_id from rel_part_operation where part_id ='$partId' and sequence_no= (select sequence_no-1 from rel_part_operation where part_id='$partId' and op_id='$opId' ) and isdeleted = 0");
		$PreOPIds = $query->row_array();
		
		$op_id = $PreOPIds['op_id'];
		
 		$query = $this->db->query("SELECT mprd.id,mprd.id as mast_id, mprd.mast_partsrcir_id as mast_partsrcir_id,mpro.date,'partrcir' as doc,mprd.op_id as op_id,temp.max_qty FROM tran_partsrcir_details mprd INNER JOIN tran_partsrcir_mast mpro on mpro.id = mprd.mast_partsrcir_id inner join (select det_partsrcir_id,(received_qty-issue_qty-inprocess_loss_qty-rejected_qty) as max_qty from tran_partsrcir_stock where part_id='$partId' and op_id='$op_id' group by det_partsrcir_id) temp on temp.det_partsrcir_id= mprd.id where temp.max_qty >0 union SELECT tran_dpr_stock.id,tran_dpr_stock.mast_dpr_id as mast_id,'1' as mast_partsrcir_id,tran_dpr.dpr_date as date, 'dpr' as doc,tran_dpr.operation_id as op_id ,temp.max_qty from tran_dpr_stock INNER JOIN tran_dpr on tran_dpr.id = tran_dpr_stock.mast_dpr_id inner join (select mast_dpr_id,(received_qty-issue_qty-inprocess_loss_qty-rejected_qty) as max_qty from tran_dpr_stock where part_id='$partId' and operation_id='$op_id' and year = '$_SESSION[current_year]' group by mast_dpr_id) temp on temp.mast_dpr_id= tran_dpr.id where temp.max_qty >0 GROUP BY tran_dpr_stock.mast_dpr_id order by date");;

	//	echo $this->db->last_query(); die;
		$PreOPIds2 = $query->result_array();
	
		return $PreOPIds2;
 		
 	}
	
	public function getDCRCIR($Supp_Id)
 	{
 		$query = $this->db->query("select tdd.id,tdd.parts_po_det_id,tdd.qty as ordered_qty,tdd.part_id,tdm.supplier_id,tdd.op_id from tran_dc_details tdd inner join tran_dc_mast tdm on tdm.id = tdd.mast_dc_id inner join ( select det_dc_id, sum(issue_qty-received_qty-rejected_qty-inprocess_loss_qty-booked_qty) as max_qty from tran_dc_stock group by det_dc_id ) temp on tdd.id = temp.det_dc_id where tdm.supplier_id = '$Supp_Id' and temp.max_qty>0");

		$PreOPIds2 = $query->result_array();
		//echo $this->db->last_query(); die;
		return $PreOPIds2;
 		
 	}
 	public function GetScheduleProdPlanIdById($id)
	{
			$query = $this->db->query("SELECT * FROM `tran_supplier_schedule` WHERE id= '$id' and isdeleted=0");
			$data = $query->row_array();
			return $data;
	}
	public function getpartPodetById($id)
	{
		 $query = $this->db->query("SELECT * FROM tran_partspo_details where id ='$id' ");
		 $data = $query->row_array();
		 return $data;
	}
	public function getReceivredQtyById($id)
	{
		 $query = $this->db->query("SELECT sum(qty) as rec_qty FROM `tran_partsrcir_details` WHERE dc_det_id='$id' ");
		 $data = $query->row_array();
		 return $data;
	}
	public function getSchudaleIdByDate($oaId,$Date)
	{
		 $query = $this->db->query("SELECT id FROM `tran_schedule` WHERE oa2_id='$oaId' and month(to_date)=month('$Date') and year(to_date)=year('$Date')");
		 $data = $query->row_array();
		 //echo $this->db->last_query(); die;
		 return $data;
	}
	public function getDprbyDate($date)
	{

	 $query = $this->db->query("select * from tran_dpr where dpr_date ='".$date."'");
	 $data = $query->result_array();
	 return $data;

	}
	public function getPartBypartid($id)
	{
	 
	 $query = $this->db->query("SELECT `partno`,`part_id`, `customer_id`, `name` FROM mast_part where part_id='$id' ");
	 $data = $query->row_array();
	 return $data;

	}
	public function GetQcDPRById($id)
	{
	 $query = $this->db->query("SELECT * from tran_dpr_quality_checks where dpr_id= '$id' and isdeleted = 0 ");
	 $data = $query->result_array();
	
	 
	 return $data;

	}
	public function getQualityChecksbyId($id)
	{
	 $query = $this->db->query("SELECT id ,name,qc_type FROM mast_quality_checks where id=$id order by id desc");
	 $data = $query->row_array();
	 return $data;

	}
public function getPartsrcirMast($date,$flag)
	{
	
		$data = [];

		if(!empty($date))
		{
			if($flag == 'all')
			{
			  
				$query = $this->db->query("SELECT * from tran_partsrcir_mast where date like '$date%' ");
				$data  = $query->result_array();
				
				return $data;
			}else{
				
				$query = $this->db->query("SELECT * from tran_partsrcir_details where isnull(rejected_qty) ");
				$data  = $query->result_array();
				return $data;
			}
		}else{
			return $data;
		}
		 
	}
	public function getPartsrcirDetail($id)
	{
		$query = $this->db->query("SELECT * from tran_partsrcir_details where mast_partsrcir_id = '$id' ");
		$data  = $query->result_array();
		return $data;
		 
	}
	public function getPartsrcirDetailbyId($id)
	{
		$query = $this->db->query("SELECT * from tran_partsrcir_details where id = '$id' ");
		$data  = $query->row_array();
		return $data;
		 
	}
	public function getPartsrcirMastbyId($id)
	{
		$query = $this->db->query("SELECT * from tran_partsrcir_mast where id = '$id' ");
		$data  = $query->row_array();
		return $data;
		 
	}
	public function GetQcPartsrcirById($id)
	{
	 $query = $this->db->query("SELECT * from tran_partsrcir_quality_checks where det_partsrcir_id= '$id' and isdeleted = 0 ");
	 $data = $query->result_array();
	 return $data;

	}
	public function getRMMovement()
	{
	 $query = $this->db->query("SELECT `id`, `rm_id`, `qty`, `from_branch_id`, `to_branch_id`, `date` FROM `tran_rm_movement` order by id desc");
	 $data = $query->result_array();
	 return $data;

	}
	
	
	public function getMovementRMStock($rm_id)
	{
	    $query1 = $this->db->query("SELECT sum(received_qty - rejected_qty - issue_qty - booked_qty - inprocess_loss_qty) as stock from tran_rmrcir_stock where rm_id='$rm_id' AND year = '$_SESSION[current_year]'  and branch_id = '$_SESSION[branch_id]'  ");
        $data = $query1->row_array();
        //echo $this->db->last_query();
        return $data;
	}
	public function getMoveOperationByPart($id)
	{
	 $query = $this->db->query("SELECT mo.id,mo.Name,rpo.sequence_no from rel_part_operation rpo, mast_operation mo where rpo.part_id = $id and rpo.op_id=mo.id  order by rpo.sequence_no ");
	 $data = $query->result_array();
	 //echo $this->db->last_query();
	 return $data;

	}
    public function getPartsMovement()
	{
	 $query = $this->db->query("SELECT `id`, `part_id`, `op_id`, `qty`, `from_branch_id`, `to_branch_id`, `date` FROM `tran_parts_movement` order by id desc");
	 $data = $query->result_array();
	 return $data;

	}
	public function getMoveRateDetails()
	{
	 $query = $this->db->query("SELECT  tppd.`part_id`, tppd.`op_id`, tppd.`qty` FROM `tran_partspo_details` tppd INNER JOIN tran_partspo_mast tppm ON tppm.id=tppd.mast_partspo_id WHERE tppd.part_id='$_POST[Part_Id]' and tppd.op_id='$_POST[Op_Id]' and tppd.isdeleted=0 ORDER BY tppd.id desc LIMIT 1");
	 $data = $query->row_array();
	 //echo $this->db->last_query();die;
	 return $data;

	}
	public function getPartOperationStock($partId,$op_id)
	{
    	 $query = $this->db->query("SELECT mprd.id,mprd.id as mast_id, mprd.mast_partsrcir_id as mast_partsrcir_id,mpro.date,'partrcir' as doc,mprd.op_id as op_id,temp.max_qty FROM tran_partsrcir_details mprd INNER JOIN tran_partsrcir_mast mpro on mpro.id = mprd.mast_partsrcir_id inner join (select det_partsrcir_id,(received_qty-issue_qty-inprocess_loss_qty-rejected_qty) as max_qty from tran_partsrcir_stock where part_id='$partId' and op_id='$op_id' group by det_partsrcir_id) temp on temp.det_partsrcir_id= mprd.id where temp.max_qty >0 union SELECT tran_dpr_stock.id,tran_dpr_stock.mast_dpr_id as mast_id,'1' as mast_partsrcir_id,tran_dpr.dpr_date as date, 'dpr' as doc,tran_dpr.operation_id as op_id ,temp.max_qty from tran_dpr_stock INNER JOIN tran_dpr on tran_dpr.id = tran_dpr_stock.mast_dpr_id inner join (select mast_dpr_id,(received_qty-issue_qty-inprocess_loss_qty-rejected_qty) as max_qty from tran_dpr_stock where part_id='$partId' and operation_id='$op_id' and year = '$_SESSION[current_year]' group by mast_dpr_id) temp on temp.mast_dpr_id= tran_dpr.id where temp.max_qty >0 GROUP BY tran_dpr_stock.mast_dpr_id order by date");
         $data = $query->result_array();
    	 echo $this->db->last_query();die;
    	 return $data;

	}
	public function getRecQtyInRCIRStock($tran_rmpo_det_id)
	{
	 $query = $this->db->query("SELECT sum(received_qty) as received_qty FROM `tran_rmrcir_stock` WHERE tran_rmpo_det_id='$tran_rmpo_det_id' ");
     $data = $query->row_array();
	return $data;

	}
	public function getPOStatusInRequ($rmid)
	{
	 $query = $this->db->query("SELECT open_status from `tran_po_details` tpd where open_status = '1' and rm_id = '$rmid'");
     $data = $query->row_array();
	return $data;

	}
	
	public function getRMOB()
	{
	 $query = $this->db->query("SELECT `id`, `rm_id`, `doc_year`, `received_qty` FROM `tran_rmrcir_stock` where received_doc_type = 'O.B' order by id desc");
	 $data = $query->result_array();
	 return $data;

	}
	
	public function getRMOBById($id)
	{
	 $query = $this->db->query("SELECT `id`, `rm_id`, `doc_year`, `received_qty` FROM `tran_rmrcir_stock` where id = '$id'");
	 $data = $query->row_array();
	 return $data;

	}
	public function checkRMYearInStock($rm_id,$year)
	{
	 $query = $this->db->query("SELECT `id` FROM `tran_rmrcir_stock` where rm_id = '$rm_id' and doc_year='$year' and received_doc_type ='O.B' ");
	 $data = $query->num_rows();
	 return $data;

	}
	
	public function getYearByBranchBy($branchName)
	{
	 $query = $this->db->query("SELECT DISTINCT(current_year) as current_year FROM `mast_branch` WHERE `name` LIKE '$branchName' ");
	 $data = $query->result_array();
	 //echo $this->db->last_query(); die;
	 return $data;

	}
	public function getRMStockDetails($branchName)
	{
	   $fd = $_POST['from_date'];
	   $td = $_POST['to_date'];
	 $query = $this->db->query("select a.rm_id,a.issue_qty,a.issue_doc_type,a.issue_doc_id,a.received_qty,a.received_doc_type,a.received_doc_id,a.booked_qty,a.booked_doc_type,a.booked_doc_id,c.challan_no,c.challan_date,c.date,c.supplier_id from tran_rmrcir_stock a INNER JOIN tran_rmrcir_details b ON b.id=a.det_rmrcir_id INNER JOIN tran_rmrcir_mast c ON b.mast_rmrcir_id=c.id WHERE c.date BETWEEN '$fd' and '$td' ORDER BY a.det_rmrcir_id");
	 $data = $query->result_array();
	 return $data;

	}
	   
	//Operator Performance Report query(Asharani)
	
    public function GetusersOperator(){
    	
	 //$query = $this->db->query("SELECT `id`, `fullname`, `fname`, `mname`, `lanme`,`role` from mast_users where branch_id = $branch_id and role = $role");
	 $query = $this->db->query("SELECT m.`id`, m.`fullname`, m.`fname`, m.`mname`, m.`lanme`,m.`role` from mast_users m inner join rel_user_role r on m.id=r.user_id  where r.role_id = '7' and r.isdeleted=0 and m.isdeleted=0");
	 $data = $query->result_array();
	  return $data;

	}
	public function getPerformData($opID,$frm_date,$to_date){
		$between=1;
		if($frm_date!="" && $to_date!=""){
		 	$between =" dpr_date BETWEEN '$frm_date' AND '$to_date' ";
	     }elseif($frm_date!="" && $to_date==NULL){
             $between=" dpr_date >='$frm_date' ";
	     }elseif($frm_date=="" && $to_date!=NULL){
             $between=" dpr_date <='$to_date' ";
	     }

		 $query = $this->db->query("SELECT dpr.dpr_date,dpr.part_id,dpr.operation_id,dpr.work_hours,dpr.qty,round(dpr.qty/dpr.work_hours,0) as operator_qty_per_hour ,rpo.nosperhour as ideal_qty,round ( 100*round(dpr.qty/dpr.work_hours,0) /rpo.nosperhour,02) as performance_percentage ,mp.partno,mp.name as part_name,mop.Name as operation_name FROM `tran_dpr` as dpr inner join rel_part_operation rpo on rpo.part_id = dpr.part_id and rpo.op_id = dpr.operation_id INNER JOIN mast_part mp on rpo.part_id = mp.part_id INNER JOIN mast_operation mop on rpo.op_id = mop.id  where qty>0 and $between AND operator_id='$opID'  ORDER BY part_id,operation_id,dpr_date");
		  $data = $query->result_array();
		   //echo $this->db->last_query();
		   //die;
	      return $data;
    
	}
	public function getPartsStockDetails()
	{
	   $fd = $_POST['from_date'];
	   $td = $_POST['to_date'];

	   $between='WHERE c.date = date(NOW())';
		if($fd!="" && $td!=""){
		 	$between =" WHERE c.date BETWEEN '$fd' AND '$td' ";
	     }elseif($fd!="" && $td==NULL){
             $between=" WHERE c.date >='$fd' ";
	     }elseif($fd=="" && $td!=NULL){
             $between=" WHERE c.date <='$td' ";
	     }

	 $query = $this->db->query("select a.part_id,a.issue_qty,a.issue_doc_type,a.issue_doc_id,a.received_qty,a.received_doc_type,a.received_doc_id,a.booked_qty,a.booked_doc_type,a.booked_doc_id,c.challan_no,c.challan_date,c.date,c.supplier_id from tran_partsrcir_stock a INNER JOIN tran_partsrcir_details b ON b.id=a.det_partsrcir_id INNER JOIN tran_partsrcir_mast c ON b.mast_partsrcir_id=c.id $between ORDER BY a.det_partsrcir_id");
	 $data = $query->result_array();
	 //echo $this->db->last_query(); die;
	 return $data;

	}
	
 	//get Company details
 	
	public function companyDetails(){
   	$query = $this->db->query("SELECT `id`, `name`, `address`, `email_id`, `gst_no`,`state_code` FROM `mast_company`");
	 $data = $query->row_array();
	 return $data;
   }
   
   //get RelParts by part Id with Opening Bal from tran_partsrcir_stock table
   	 public function getRelPartsbyIdOBal()
	{
		 $partId 		=$_POST['part_id'];
		 $year          =$_SESSION['current_year'];  
		 $branch_id     =$_SESSION['branch_id'];
		 $query = $this->db->query("SELECT rpo.id,rpo.part_id,rpo.op_id,rpo.nosperkg,rpo.nosperhour,rpo.tool_id1,rpo.tool_id2,mo.Name,if(isnull(pob.ob),0,pob.ob) as ob,pob.id as obid FROM rel_part_operation rpo inner join mast_operation mo on rpo.op_id=mo.id left join (select id,op_id,received_qty as ob from tran_partsrcir_stock WHERE part_id='$partId' and year = '$year' and received_doc_type='O.B.' and branch_id ='$branch_id') pob on pob.op_id = rpo.op_id where rpo.part_id='$partId' and rpo.isdeleted=0 order by rpo.sequence_no");
      //  echo $this->db->last_query();die;
		 $data = $query->result_array();
		 return $data;

	}
	
    public function getPartsBySearchval($search)
   {  	     
       
     $query = $this->db->query("SELECT part_id,name,partno,prodfamily_id FROM `mast_part` where partno like '%$search%' OR name like '%$search%' order by partno,name");
	 $data = $query->result_array();
	 //echo $this->db->last_query();die;
	 return $data;
   }
   public function getPartForInvoice($partId,$op_id)
	{
	    $branch_id     =$_SESSION['branch_id'];
    	 $query = $this->db->query("SELECT tran_dpr_stock.id,tran_dpr_stock.mast_dpr_id as mast_id,'1' as mast_partsrcir_id,tran_dpr.dpr_date as date, 'dpr' as doc,tran_dpr.operation_id as op_id ,temp.max_qty from tran_dpr_stock INNER JOIN tran_dpr on tran_dpr.id = tran_dpr_stock.mast_dpr_id inner join (select mast_dpr_id,(received_qty-issue_qty-inprocess_loss_qty-rejected_qty) as max_qty from tran_dpr_stock where part_id='$partId' and operation_id='$op_id' and year = '$_SESSION[current_year]' and branch_id ='$branch_id' group by mast_dpr_id) temp on temp.mast_dpr_id= tran_dpr.id where temp.max_qty >0 and tran_dpr_stock.branch_id ='$branch_id' GROUP BY tran_dpr_stock.mast_dpr_id order by date");
         $data = $query->result_array();
    	 return $data;

	}

}

?>