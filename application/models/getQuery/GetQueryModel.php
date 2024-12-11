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
	public function getPartsOrderByFamily()
	{
	 $query = $this->db->query("SELECT mp.part_id ,mp.prodfamily_id ,mp.partno, mp.name ,mpf.name as pfName from mast_part mp,mast_productfamily mpf where mp.prodfamily_id=mpf.id and mp.isdeleted=0 order by mpf.name,mp.partno");
	 	$data = $query->result_array();
	 // echo $this->db->last_query(); 
	 return $data;

	}
	public function getPartsById($id)
	{
	    
	 $query = $this->db->query("SELECT `part_id`, `prodfamily_id`, `customer_id`, `partno`, `name`, `uom`, `netweight`, `hsncode`, `bin_qty`, `is_assembly` FROM mast_part where part_id='$id'  and isdeleted=0 ");
	 $data = $query->row_array();
	 return $data;

	}
	
	public function getNetWeightByPartId($id)
	{
	    
	 $query = $this->db->query("SELECT `part_id`,`netweight` FROM mast_part where part_id='$id' and isdeleted=0 ");
	 $data = $query->row_array();
	 return $data;

	}
	
	public function getrawMaterialById($id)
	{
	 $query = $this->db->query("SELECT `id`, `part_id`, `rm_id`, `grossweight`, `assembly_part_id`, `assembly_part_qty`, `scrap_normal`, `scrap_ss`, `scrap_tikli`, `is_tikli_reusable` FROM rel_part_rm where part_id='$id' and (rm_id > 0 || assembly_part_id>0)  and isdeleted=0");
	 $data = $query->result_array();
	 return $data;

	}
	public function getOperationById($id)
	{
	 $query = $this->db->query("SELECT `id`, `part_id`, `op_id`, `sequence_no`,`nosperkg` FROM rel_part_operation where part_id='$id' and isdeleted=0 order by sequence_no ");
	 $data = $query->result_array();
	 //echo "<br>". $this->db->last_query();
	 return $data;
	}
	
	public function getOperationCountById($id)
	{
	 $query = $this->db->query("SELECT `op_id` FROM rel_part_operation where part_id='$id'   and isdeleted=0 ");
	 $data = $query->num_rows();
	 return $data;

	}
	public function getQCById($id)
	{
	 //$query = $this->db->query("SELECT `ID`, `part_id`, `inspection_stage`, `qualityID`, `std_value`, `min_value`, `max_value`, `no_of_samples` FROM rel_part_qc where part_id='$id' ");
	 $query = $this->db->query("SELECT reqc.`ID`, reqc.`part_id`, reqc.`inspection_stage`,'reqc.std_value', reqc.`qualityID`, reqc.`std_value`, reqc.`min_value`, reqc.`max_value`, reqc.`no_of_samples`, qc.`name` as quality_name,qc.`numof_decimal` FROM rel_part_qc reqc inner join mast_quality_checks qc on reqc.`qualityID`= qc.`id`  where part_id='$id' and reqc.isdeleted=0 order by qc.id");
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
	 $query = $this->db->query("SELECT id,name FROM mast_customer  where  isdeleted=0 order by id desc");
	 $data = $query->result_array();
	 return $data;

	}
	public function getConsignee($custId)
	{
	 $query = $this->db->query("SELECT id,name FROM mast_consignee where cust_id='$custId'  and isdeleted=0 order by id desc");
	 $data = $query->result_array();
	 return $data;

	}
	public function getConsigneeById($Id)
	{
	 $query = $this->db->query("SELECT id,name FROM mast_consignee where id='$Id'  and isdeleted=0 ");
	 $data = $query->row_array();
	 return $data;

	}
	public function getPartName()
	{
	 $query = $this->db->query("SELECT part_id ,name,partno FROM mast_part where isdeleted=0 order by part_id desc");
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
	 $query = $this->db->query("SELECT id ,name FROM mast_quality_checks where  isdeleted=0 order by id desc");
	 $data = $query->result_array();
	 return $data;

	}
	public function getQualityChecksByType($type)
	{
	 $query = $this->db->query("SELECT id ,name FROM mast_quality_checks where inspection_stage='$type'  and isdeleted=0 order by id desc");
	 $data = $query->result_array();
	 return $data;

	}

	public function getSequenceNo($partId,$opId)
	{
        $getseq=$this->db->query("select sequence_no as seq from rel_part_operation where part_id='$partId' and op_id='$opId' and isdeleted=0");
	  	$getseq1 = $getseq->row_array();
	  //	echo $this->db->last_query();
	  	return $getseq1['seq'];
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
	
	 $query = $this->db->query("SELECT `rm_id`, `company_id`, `matcode`, `type`, `grade`, `name`, `length`, `width`, `thickness`, `hardness`, `uom`, `hsnCode`, `reorderQty`, `remarks`, `created_on`, `created_by`, `updated_on`, `updated_by` FROM mast_rm where rm_id='$id'  and isdeleted=0 ");
	 $data = $query->row_array();
	 return $data;

	}
	public function getrmId()
	{
	 $query = $this->db->query("SELECT rm_id FROM `mast_rm`  where  isdeleted=0 ORDER BY `rm_id` DESC LIMIT 1;");
	 $data = $query->row_array();
	 return $data;

	}
	


	/*------------------------Operations---------------------------------*/
	public function getOperation($id)
	{
	 $query = $this->db->query("SELECT id,name,carriedOut,rmConsumption FROM mast_operation where id='$id'  and isdeleted=0 order by id desc");
	 $data = $query->row_array();
	 return $data;

	}
	
	public function getOperations()
	{
	 $query = $this->db->query("SELECT mo.id, mo.Name, mo.carriedOut, mo.rmConsumption,mog.name as groName,mo.qc_requiredfor_dpr FROM mast_operation mo,mast_op_group mog where mog.id=mo.op_group_id and  mo.isdeleted=0  order by mo.op_group_id,mo.id  ");
	 $data = $query->result_array();
	 return $data;

	}
	public function getOperationsById($id1)
	{ //echo  "  $$$ ".$id1;
	 $query = $this->db->query("SELECT `id`, `op_group_id`, `Name`, `carriedOut`, `rmConsumption`, qc_requiredfor_dpr FROM mast_operation where id='$id1' and isdeleted=0 ");
	 $data = $query->row_array();
//	 echo $this->db->last_query(); die;
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
	 $query = $this->db->query("SELECT `id`, `mast_oa_id`, `part_id`, `op_id`, `qty`, `rate`, `with_effect_from`, `igst`, `cgst`, `sgst` FROM `tran_oa_details` where mast_oa_id='$id'    order by id asc");
	 $data = $query->result_array();
	 return $data;
	}
	//added by Asharani at  21-10-2023
	public function getInvQtybyOAdetId($id,$cid){
	    
	 $query = $this->db->query("SELECT sum(td.qty) as invqty FROM tran_invoice_details td inner join tran_invoice_mast tm where td.oa_det_id='$id' and td.isdeleted=0 and tm.customer_id='$cid'");
	 $data = $query->row_array();
	 //echo $this->db->last_query(); die;
	 return $data; 
	 
	}
	public function getSchedule()
	{
	  $query = $this->db->query("SELECT `id`, `year`, `oa2_id`, `part_id`, `customer_id`, `from_date`, `to_date`, `weekno`, `scheduled_qty`, `dispatched_qty` FROM `tran_schedule` where  isdeleted=0  order by id desc ");
	 $data = $query->result_array();
	 return $data;

	}public function getScheduleById($id)
	{
	  $query = $this->db->query("SELECT `id`, `year`, `oa2_id`, `part_id`, `customer_id`, `from_date`, `to_date`, `weekno`, `scheduled_qty`, `dispatched_qty` FROM `tran_schedule` where id='$id'  and isdeleted=0  ");
	 $data = $query->result_array();
	 return $data;

	}public function getScheduleByOA2Id($id)
	{
	  $query = $this->db->query("SELECT `id` FROM `tran_schedule` where oa2_id='$id'  and isdeleted=0 ");
	 $data = $query->num_rows();
	 return $data;

	}public function getSchedulePartMonth($part_id,$to_date)
	{
	 $msg="";
	 $query = $this->db->query("SELECT `id`, `year`, `oa2_id`, `part_id`, `customer_id`, `from_date`, `to_date`, `weekno`, `scheduled_qty`, `dispatched_qty` FROM `tran_schedule` where part_id = '$part_id' and to_date = '$to_date'   and isdeleted=0 order by id desc ");
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
	 
	 $query = $this->db->query("SELECT `part_id`, `name` FROM mast_part where partno='$partno'  and isdeleted=0 ");
	 $data = $query->row_array();
	 return $data;

	}
	public function getCustomersbyid($id)
	{
	 $query = $this->db->query("SELECT * FROM mast_customer where id='$id'  and isdeleted=0 ");
	 $data = $query->row_array();
	 return $data;

	}
	public function getOAbypartNoCust($ScreenCustomerId,$excPartId,$current_year)
	{
	 $query = $this->db->query("SELECT od.id, od.mast_oa_id, od.part_id, od.op_id, od.qty, od.rate, od.with_effect_from, od.igst, od.cgst, od.sgst, od.scheduled_qty FROM tran_oa_details od INNER JOIN tran_oa_mast om ON om.id=od.mast_oa_id WHERE od.part_id='$excPartId' and om.customer_id='$ScreenCustomerId'");
	 //om.year='$current_year' and
	 $data = $query->result_array();
	 //echo "<br>". $this->db->last_query();
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
		 $query = "SELECT ts.id, ts.part_id, ts.to_date, ts.scheduled_qty, ts.customer_id, ps.stock FROM tran_schedule ts left join ( select part_id, SUM(received_qty - issue_qty - inprocess_loss_qty - rejected_qty) as stock from tran_partsrcir_stock group by part_id )ps on ps.part_id = ts.part_id WHERE ts.to_date = '$toDate' and year= '$_SESSION[current_year]'";
    		
    		 if($custId != '')
    		 {
    		    $query .= " and ts.customer_id='$custId'";
    		 }
    		 $query .= "  order by ts.id desc";
		     $querys = $this->db->query($query);
	     	 $data = $querys->result_array();
		// echo "<br>". $this->db->last_query();
		 return $data;

	}
	
	public function getBranch()
	{
	   // $year=$_SESSION['current_year'];
	 $query = $this->db->query("SELECT DISTINCTROW id,name FROM mast_branch order by id ");
	 $data = $query->result_array();
	 return $data;

	}
	public function getrawMaterialByPartId($partId)
	{
		$query = $this->db->query("SELECT `id`, `part_id`, `rm_id`, `grossweight`, `assembly_part_id`, `assembly_part_qty`, `scrap_normal`, `scrap_ss`, `scrap_tikli` FROM rel_part_rm where part_id='$partId' and isdeleted=0");
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
	 $query = $this->db->query("SELECT id, name, ideal_qty, ob, grinded_on, owner_branch_id, location_branch_id,grinding_frequency,remarks FROM mast_tools where isdeleted=0 ");
	 $data = $query->result_array();
	 return $data;

	}
	public function getToolById($id)
	{
	 $query = $this->db->query("SELECT id, name, ideal_qty, ob, grinded_on, owner_branch_id, location_branch_id,grinding_frequency FROM mast_tools where id='$id' and isdeleted=0");
	 $data = $query->row_array();
	 return $data;

	}
	
	public function getTrantool()
	{
	 $query = $this->db->query("SELECT tt.*,mt.name FROM tran_tools tt inner join mast_tools mt on tt.tool_id=mt.id  where mt.isdeleted=0  order by tt.grinded_on");
	 $data = $query->result_array();
	 return $data;

	}
	public function getTrantoolbyID($id){
	  $query = $this->db->query("SELECT * FROM tran_tools where id='$id'");
	 $data = $query->row_array();
	 return $data;
	}
	
	public function getToolDPRQtyById($id){
	   // $query = $this->db->query("select sum(dpr.qty) as dpr_qty,max(tt.grinded_on) as grinded_on from tran_dpr dpr inner join tran_tools tt on dpr.tool_id=tt.tool_id where dpr.dpr_date>(select max(grinded_on) from tran_tools where tool_id='$id') and dpr.tool_id='$id'");
	 $query = $this->db->query("select sum(dpr.qty) as dpr_qty,temp.grinded_on from tran_dpr dpr 
	 inner join (select max(grinded_on) as grinded_on,tool_id from tran_tools where tool_id='$id') temp on dpr.tool_id=temp.tool_id where dpr.tool_id='$id' and dpr.dpr_date>temp.grinded_on");
	 $data = $query->row_array();
	 //echo $this->db->last_query();
	 return $data;  
	}
	public function getToolTotalQtyById($id){
	
	    $query = $this->db->query("select sum(dpr.qty) as dpr_qty,tt.ob from tran_dpr dpr inner join mast_tools tt on dpr.tool_id=tt.id  where tt.id='$id' and tt.isdeleted=0 and dpr.isdeleted=0");
	 $data = $query->row_array();
//	 echo $this->db->last_query();
	 return $data;  
	}
	public function getRemToollife(){
     //remaining tool life
     $id=$_POST['Tool_Name'];
     $from_date=date('Y-m-d',strtotime($_POST['from_date']));
	 $query = $this->db->query("select sum(ob) as ob from (select sum(dpr.qty) as ob from tran_dpr dpr where dpr.tool_id='$id' and dpr.dpr_date<'$from_date' and dpr.isdeleted=0 UNION select ob from mast_tools where id='$id' and isdeleted=0) a");
	 $data = $query->row_array();
	 //echo $this->db->last_query();
	 return $data;  
	}
	
	public function getToolDetails(){
	   $fd = date('Y-m-d',strtotime($_POST['from_date']));
	   $td = date('Y-m-d',strtotime($_POST['to_date']));
	   $tool_id = $_POST['Tool_Name'];
	   
	   $query = $this->db->query("select * from (select dpr_date as date,part_id,qty,remarks as remark ,'P' as type,tool_id,machine_id  from tran_dpr dpr where dpr.isdeleted=0 and dpr_date between '$fd' and '$td' and tool_id='$tool_id' and qty!=0
UNION ALL select grinded_on as date,'' as part_id ,0 as qty,remark,type,tool_id,'' as machine_id from tran_tools where grinded_on BETWEEN '$fd' and '$td' and tool_id='$tool_id') a ORDER by date");
	 
	 $data = $query->result_array();
	 // echo $this->db->last_query();
	 return $data;   
	}
	public function getConToolParts(){
	   $fd = date('Y-m-d',strtotime($_POST['from_date']));
	   $td = date('Y-m-d',strtotime($_POST['to_date']));
	   $tool_id = $_POST['Tool_Name'];
	   
	   $query = $this->db->query("select group_concat(distinct(part_id) separator ',') as part_id from tran_dpr dpr where dpr.isdeleted=0 and dpr_date between '$fd' and '$td' and tool_id='$tool_id' and qty!=0 ORDER by dpr_date");
	 
	 $data = $query->result_array();
	 //echo $this->db->last_query();
	 return $data;   
	}
	public function getOperationsNotforPart($editpartId)
	{
	 $query = $this->db->query("SELECT mo.id, mo.Name, mo.carriedOut, mo.rmConsumption,mog.name as groName FROM mast_operation mo,mast_op_group mog where mog.id=mo.op_group_id and  mo.isdeleted=0 and mo.id NOT IN(SELECT `op_id` FROM rel_part_operation where part_id='$editpartId' and isdeleted=0) order by mo.op_group_id,mo.id");
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
       // $query = $this->db->query("select branch_id,sum(received_qty-rejected_qty-issue_qty-booked_qty-inprocess_loss_qty) as current_stock from tran_rmrcir_stock where rm_id='$id' and year = '$year'  group by branch_id");
  
  //and year = '$year'
        $query = $this->db->query("select branch_id,sum(received_qty-rejected_qty-issue_qty-inprocess_loss_qty) as current_stock from tran_rmrcir_stock where rm_id='$id'   group by branch_id");
   
   // echo $this->db->last_query();
	 $data = $query->result_array();
	 return $data;

	}
public function getPlanQtyDetailbyid($id,$setdate)
	{
	    $date=date("Y-m");
	    if($setdate){
			$date 	   = date("Y-m", strtotime($setdate)); 
	    }
	  	   $query = $this->db->query("SELECT tran_schedule.scheduled_qty,tran_schedule.to_date,mp.partno,treq.branch_id FROM `tran_requisition` as treq inner join tran_prod_planning tpp on treq.prod_plan_id =  tpp.id inner join tran_schedule on tpp.schedule_id =  tran_schedule.id inner join mast_part mp on tran_schedule.part_id = mp.part_id
		    WHERE treq.`year` = '$_SESSION[current_year]' and treq.date like '$date%' and treq.`rm_id` = '$id' and (isnull(treq.`tran_po_id`) or treq.`tran_po_id` = 0 )  and treq.plan_req_qty > 0");
	   

		 $data = $query->result_array();
		// echo $this->db->last_query();
		 return $data;
	}
	public function getrmPlanManuQtybyid($rmid,$setdate)
	{
        $date=date("Y-m");
        if($setdate){
    		$date 	   = date("Y-m", strtotime($setdate)); 
        }
        
    	 $query = $this->db->query("SELECT round(sum(`plan_req_qty`),3) as plan_req_qty,round(`manual_qty`,3) as manual_qty,round(`reserve_qty`,3) as reserve_qty FROM `tran_requisition` WHERE `year` = '$_SESSION[current_year]' and date like '$date%' and `rm_id` = '$rmid' and (isnull(`tran_po_id`) or `tran_po_id` = 0 )");
    
    	 $data = $query->row_array();
    	 
    	 //echo $this->db->last_query();die;
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
		/* $query = $this->db->query("SELECT tpd.`id`, tpd.`mast_po_id`, tpd.`rm_id`, tpd.`part_id`, tpd.`operation_id`, tpd.`ordered_qty`, tpd.`received_qty`, tpd.`accepted_qty`, tpd.`returned_qty`, tpd.`rate`, tpd.`sgst`, tpd.`cgst`, tpd.`igst`, tpd.`branch_id`, tpd.`open_status`,mr.name as rm_name FROM `tran_po_details` tpd 
		                            inner join mast_rm mr on mr.rm_id=tpd.rm_id  where tpd.mast_po_id ='$id' and tpd.isdeleted=0 and mr.isdeleted=0 order by id desc");*/
		                            
	/*	$query = $this->db->query("SELECT tpd.`id`, tpd.`mast_po_id`, tpd.`rm_id`, tpd.`part_id`, tpd.`operation_id`, tpd.`ordered_qty`, sum(trd.`qty`) as received_qty , if(trd.qc_remarks='ACCEPTED',sum(trd.`rejected_qty`),0) as accepted_qty , tpd.`returned_qty`, tpd.`rate`, tpd.`sgst`, tpd.`cgst`, tpd.`igst`, tpd.`branch_id`, tpd.`open_status`,mr.name as rm_name FROM `tran_po_details` tpd inner join tran_rmrcir_details trd on tpd.id=trd.tran_rmpo_det_id 
		                            inner join mast_rm mr on mr.rm_id=tpd.rm_id  where tpd.mast_po_id ='$id' and tpd.isdeleted=0 and mr.isdeleted=0  group by id order by id desc");
		                            */
	$query = $this->db->query("SELECT tpd.`id`, tpd.`mast_po_id`, tpd.`rm_id`, tpd.`part_id`, tpd.`operation_id`, tpd.`ordered_qty`, tpd.`returned_qty`, tpd.`rate`, tpd.`sgst`, tpd.`cgst`, tpd.`igst`, tpd.`branch_id`, tpd.`open_status`,mr.name as rm_name FROM `tran_po_details` tpd  inner join mast_rm mr on mr.rm_id=tpd.rm_id  where tpd.mast_po_id ='$id' and tpd.isdeleted=0 and mr.isdeleted=0  group by id order by id desc");
		 $data = $query->result_array();
	//	 echo $this->db->last_query();
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
	 $query = $this->db->query("SELECT *,(accepted_qty - issue_qty - booked_qty) as available_qty FROM `tran_partsgrr_details` WHERE `part_id` = $part_id and (accepted_qty - issue_qty  > 0 ) and year  = '$year' and isdeleted=0 order by id");
	 $data = $query->result_array();
	 return $data;

	}
	public function getTranRmgrrAvailQty($rm_id,$year)
	{
	 $branch_id     =$_SESSION['branch_id'];
	 $query = $this->db->query("SELECT DISTINCTROW trs.mast_rmrcir_id,trs.det_rmrcir_id,tmp.available_qty FROM tran_rmrcir_stock trs INNER JOIN (select branch_id,mast_rmrcir_id,det_rmrcir_id , sum(received_qty - issue_qty  - inprocess_loss_qty - rejected_qty) as available_qty FROM `tran_rmrcir_stock`  WHERE `rm_id` = $rm_id  and year  = '$year' and branch_id ='$branch_id'  and isdeleted=0 GROUP BY det_rmrcir_id) tmp ON trs.mast_rmrcir_id=tmp.mast_rmrcir_id and trs.det_rmrcir_id = tmp.det_rmrcir_id WHERE tmp.available_qty > 0 and tmp.branch_id='$branch_id'");
	 	$data = $query->result_array();
	 	return $data;
	}
	public function getRMUsedQty($det_rmcrcir_id)
	{
	 $branch_id     =$_SESSION['branch_id'];
	 $query = $this->db->query("select sum(issue_qty) as used_qty FROM `tran_rmrcir_stock`  WHERE `det_rmrcir_id` = '$det_rmcrcir_id'");
	 	$data = $query->row_array();
	 	return $data['used_qty'];
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
				$query = $this->db->query("SELECT `id`, `name`,`supl_type` FROM mast_supplier where supl_type in( $type ) and isdeleted=0  order by id desc");
		}
	 $data = $query->result_array();
	 return $data;

	}

    public function getSupplierById($id)
	{
	 $query = $this->db->query("SELECT `id`, `name`, `email_id`,`address`,`contact_person_details`,gst_no FROM `mast_supplier` where id='$id' ");
	 $data = $query->row_array();
	 return $data;

	}
	public function getOperationByPart($id,$Supplier_Id)
	{
	 $query = $this->db->query("SELECT mo.id,mo.Name,rpo.sequence_no from rel_part_operation rpo, mast_operation mo where rpo.part_id = $id and rpo.op_id=mo.id and rpo.isdeleted=0 and FIND_IN_SET (op_id , (select GROUP_CONCAT(op_id,',') from rel_supplier_operation where supplier_id = $Supplier_Id))>0 order by rpo.sequence_no ");
	 $data = $query->result_array();
	// echo $this->db->last_query(); die;
	 return $data;

	}
	public function getDCOperationByPart($partid,$Supplier_Id)
	{
	 $query = $this->db->query("SELECT distinct tpd.op_id FROM `tran_partspo_details` tpd INNER JOIN tran_partspo_mast tpm on tpm.id=tpd.mast_partspo_id INNER JOIN rel_part_operation rpo on tpd.part_id=rpo.part_id and tpd.op_id=rpo.op_id  WHERE tpd.part_id='$partid' and tpm.supplier_id='$Supplier_Id' and tpm.year='$_SESSION[current_year]' and tpd.isdeleted=0 and rpo.isdeleted=0 order by rpo.sequence_no");
	 $data = $query->result_array();
	// echo $this->db->last_query(); die;
	 return $data;

	}
	public function getToolbyPartOperation($partid,$opid)
	{
	 $query = $this->db->query("SELECT mt.id,mt.name FROM mast_tools mt WHERE mt.id IN (select tool_id1 as tool_id from rel_part_operation WHERE part_id = $partid and op_id = $opid UNION ALL select tool_id2 as tool_id from rel_part_operation WHERE part_id = $partid and op_id = $opid UNION ALL select 25 as tool_id)");
	 $data = $query->result_array();
	 
	 
     return $data;

	}
	
	
	
	public function getOtherPo()
	{
	 $query = $this->db->query("SELECT `id`, `date`, `supplier_id`, `year`, `Payment_terms`, `remarks` FROM `tran_partspo_mast` where year='$_SESSION[current_year]' order by id desc");
	 $data = $query->result_array();
	 return $data;

	}
	public function getOtherpoById($id)
	{
	 $query = $this->db->query("SELECT `id`, `date`, `supplier_id`, `year`, `Payment_terms`, `remarks`, `wef_date` FROM `tran_partspo_mast` where id='$id' ");
	 $data = $query->row_array();
	 return $data;

	}
	public function getOtherpoDetails($id)
	{
	  $query = $this->db->query("SELECT `id`, `mast_partspo_id`, `part_id`, `op_id`, `part_remark`, `qty`, `qty_in_kgs` , `rate`, `uom`, `igst`, `cgst`, `sgst` FROM `tran_partspo_details` where mast_partspo_id='$id' and isdeleted=0 order by id asc");
	 $data = $query->result_array();
	 return $data;

	}

	public function getConsumablepoById($id)
	{
	 $query = $this->db->query("SELECT `id`, `year`, `date`, `supplier_id`, `payment_terms`, `remarks` FROM `tran_consumpo_mast` where id='$id' ");
	 $data = $query->row_array();
	 return $data;

	}
	public function getConsumablepoDetails($id)
	{
	  $query = $this->db->query("SELECT `id`, `mast_consumpo_id`, `description`, `qty`, `rate`, `uom`, `remarks`, `igst`, `cgst`, `sgst` FROM `tran_consumpo_details` where mast_consumpo_id='$id' and isdeleted=0 order by id asc");
	 $data = $query->result_array();
	 return $data;

	}
	/*public function getCountPartStock()
	{
		$query = $this->db->query("SELECT count(id) as ctn FROM `part_stock` ");
		$data = $query->num_rows();
	 	return $data;

	}*/
	public function GetOperationsGroup()
	{
	    
		$query = $this->db->query("SELECT msgroup.id as grp_is,msgroup.name as group_name,msop.id as operation_id,msop.Name as operation_Name
		FROM mast_op_group as msgroup
		INNER JOIN mast_operation as msop
		ON msgroup.id = msop.op_group_id and msop.id > 2 and msop.carriedOut IN(2,3) and msop.isdeleted=0 order by group_name");
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
		$query = $this->db->query(" select `id`, `name`, `branch_id`, `type` from mast_machines where id='$id' and isdeleted=0 ");
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
	   // echo $this->db->last_query(); die;
	    return $data;
	}
	public function getPartsSupplierSchedule()
	{
	    
	    $supplierId 	=$_POST['Supplier_Id'];
	    $schedule_date 	=$_POST['schedule_date'];
	    $toDate 		=date("Y-m-t", strtotime($schedule_date)); 
		$sql = "SELECT * FROM `tran_supplier_schedule` WHERE  to_date='$toDate' ";
		if($supplierId)
		{
		    $sql .= " and supplier_id='$supplierId'";
		}
		$query = $this->db->query($sql);
		 $data = $query->result_array();
		 //echo $this->db->last_query(); 
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
	 $query = $this->db->query("SELECT * from tran_dpr where id= '$id' ");
	 $data = $query->row_array();
	 //echo $this->db->last_query();die;
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
	    //Removed branch_id = '$branch_id' and
		$query = $this->db->query("SELECT `id`, `name`, `branch_id`, `type`, `isdeleted`, `created_by`, `created_on`, `updated_by`, `updated_on` FROM `mast_machines` WHERE isdeleted = 0 and branch_id = '$branch_id'");
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
	 $branch_id=$_SESSION['branch_id'];
	 // removed "and branch_id='$branch_id'"
//	 $query = $this->db->query("SELECT DISTINCTROW id,planning_qty,booked_qty,part_id FROM `tran_prod_planning` WHERE Month(date) = Month('$date') and year(date) = year('$date')   and (planning_qty+booked_qty) > 0");
	 $query = $this->db->query("SELECT DISTINCTROW id,planning_qty,booked_qty,tran_prod_planning.part_id FROM `tran_prod_planning` inner join mast_part on  tran_prod_planning.part_id = mast_part.part_id WHERE Month(date) = Month('$date') and year(date) = year('$date') order by mast_part.partno");
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
			 $query = $this->db->query("SELECT * from rel_part_operation WHERE part_id = '$partId' and op_id IN(select op_id from mast_operation WHERE carriedOut IN(1,3) and op_id!=48 and isdeleted = 0) and  isdeleted = 0 order by sequence_no");
	
		//}
		 $data = $query->result_array();
		// echo "##########".$this->db->last_query();
		 return $data;
	}
	public function getTranRmgrrTotAvailQty($rm_id,$year,$branch_id)
	{
	 
	 $query = $this->db->query("SELECT det_rmrcir_id,sum(received_qty - issue_qty - inprocess_loss_qty - rejected_qty) as available_qty FROM  tran_rmrcir_stock WHERE `rm_id` = $rm_id and (received_qty - issue_qty - inprocess_loss_qty - rejected_qty > 0 ) and branch_id = $branch_id and year = '$year' and isdeleted=0 ");
	 $data = $query->row_array();
	 return $data;

	}
	public function getToolSucess($date,$toolid)
	{
	  $res = $this->getToolById($toolid);
	  $grinding_frequency=$res['grinding_frequency'];
	 
	  $query1 = $this->db->query("select max(grinded_on) as grinded_on,tool_id from tran_tools where tool_id='$toolid'");
	  $res2 = $query1->row_array();
	  if($res2['grinded_on']){
	        $query2 = $this->db->query("select sum(dpr.qty) as dpr_qty from tran_dpr dpr where dpr.tool_id='$toolid' and dpr.dpr_date>'$res2[grinded_on]' and dpr.isdeleted=0");
	  
	  }else{
	      $query3 = $this->db->query("select sum(dpr.qty) as dpr_qty from tran_dpr dpr where dpr.tool_id='$toolid' and dpr.isdeleted=0"); 
	  }
	   $res3 = $query3->row_array();
	 $qty=0;
      $qty=$grinding_frequency-$res3['dpr_qty'];

     return $qty;

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
		
        $date 	= date('Y-m',strtotime($_POST['date']));
       // $query = $this->db->query("select ss.id,ss.part_id,ss.qty as ordered_qty,sum(tpd.qty) as rec_qty,(ss.qty-if(tpd.qty,tpd.qty,0)) as bal_qty,ss.tran_partspo_det_id,ss.to_date,if(tpd.op_id,tpd.op_id,tpo.op_id) as op_id from tran_supplier_schedule ss left join (select supp_schedule_id,op_id,sum(qty) as qty from tran_partsrcir_details group by supp_schedule_id ) as tpd on tpd.supp_schedule_id = ss.id left JOIN tran_partspo_details tpo ON ss.tran_partspo_det_id=tpo.id  where ss.year= '$year' and ss.receiving_branch_id = '$branch_id' and ss.supplier_id = '$supId'  and ss.qty-if(tpd.qty,tpd.qty,0)>0");
        $query = $this->db->query("select ss.id,ss.part_id,ss.qty as ordered_qty,0 as rec_qty,0 as bal_qty,ss.tran_partspo_det_id,DATE_FORMAT(ss.to_date,'%b %Y') as to_date,ss.receiving_branch_id as branch_id,tpo.op_id as op_id from tran_supplier_schedule ss left JOIN tran_partspo_details tpo ON ss.tran_partspo_det_id=tpo.id  where ss.year= '$year' and ss.supplier_id = '$supId' and ss.to_date like '$date%' order by ss.part_id,ss.receiving_branch_id");
        //and ss.receiving_branch_id = '$branch_id'
       
        $data = $query->result_array();
    //  echo "****".$this->db->last_query();
        return $data;
    
    }
    public function getPartsRecivedQty($id)
    {
        $sql =  $this->db->query("select if(sum(qty),sum(qty),0) as qty from tran_partsrcir_details  where supp_schedule_id = '$id' and isdeleted = 0"); 
        $data = $sql->row_array();
        //$this->db->last_query();
        return $data['qty'];
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
	public function getPartRCIR($type)
	{
	    if($_POST['date']){
	     	$scheduleDate  = $_POST['date'];
			$date 	   = date("Y-m", strtotime($scheduleDate));
	           $query = $this->db->query("SELECT tpm.id,tpm.challan_no,tpm.challan_date,tpm.isdeleted,tpm.year,ms.name FROM tran_partsrcir_mast tpm ,mast_supplier ms WHERE tpm.supplier_id=ms.id and tpm.branch_id='$_SESSION[branch_id]' and tpm.isdeleted=0 and ms.supl_type='$type' and tpm.date like '$date%' order by tpm.date desc");
	    }else{
	         $date=date("Y-m");
	         $query = $this->db->query("SELECT tpm.id,tpm.challan_no,tpm.challan_date,tpm.isdeleted,tpm.year,ms.name FROM tran_partsrcir_mast tpm ,mast_supplier ms WHERE tpm.supplier_id=ms.id and tpm.branch_id='$_SESSION[branch_id]' and tpm.isdeleted=0 and ms.supl_type='$type' and tpm.date like '$date%' order by tpm.date desc limit 10");

        }
     //echo $this->db->last_query();
	 $data = $query->result_array();
	 return $data;
	}
	public function getRMRCIRQty($suppId)
	{
	    $branch_id 	= $_SESSION['branch_id'];
		$year 		= $_SESSION['current_year'];
        //$query = $this->db->query("SELECT tpd.* FROM tran_po_details tpd INNER JOIN tran_po_mast tpm ON tpd.mast_po_id=tpm.id WHERE tpm.supplier_id='$suppId' and tpd.branch_id='$branch_id' and tpm.year='$year' and tpd.isdeleted=0 and (tpd.ordered_qty-tpd.received_qty) > 0");
        $query = $this->db->query("select tpm.id as mast_po_id,tpd.*,tpd.id,tpd.ordered_qty,if(isnull(temp.rej_qty),0,temp.rej_qty) as rej_qty,if(isnull(temp.rec_qty),0,temp.rec_qty)as rec_qty from tran_po_details tpd INNER JOIN tran_po_mast tpm ON tpd.mast_po_id=tpm.id left join (select tran_rmpo_det_id,sum(received_qty) as rec_qty,sum(rejected_qty) as rej_qty from tran_rmrcir_stock group by tran_rmpo_det_id ) temp on temp.tran_rmpo_det_id= tpd.id or temp.tran_rmpo_det_id is null WHERE tpm.supplier_id='$suppId' and tpd.branch_id='$branch_id' and tpm.year='$year' and tpd.isdeleted=0 and tpd.open_status='1' and (tpd.ordered_qty-if(isnull(temp.rec_qty),0,temp.rec_qty)-if(isnull(temp.rej_qty),0,temp.rej_qty)) > 0 and tpd.year='$year'");
          $data = $query->result_array();
           // echo $this->db->last_query();
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
	
	 $query = $this->db->query("SELECT * FROM `tran_partsrcir_details` where mast_partsrcir_id='$id' and qty > 0 and id!=0 order by id asc");
	 $data = $query->result_array();
	 //echo $this->db->last_query();
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
    	if($_POST['date']){
	     	$scheduleDate  = $_POST['date'];
			$date 	   = date("Y-m", strtotime($scheduleDate)); 
		//	$query = $this->db->query("SELECT tpm.id,tpm.challan_no,tpm.challan_date,tpm.isdeleted,tpm.year,ms.name FROM tran_rmrcir_mast tpm ,mast_supplier ms WHERE tpm.supplier_id=ms.id and tpm.branch_id='$_SESSION[branch_id]' and tpm.date like '$date%' and tpm.isdeleted=0 order by tpm.challan_date desc");
         	$query = $this->db->query("SELECT tpm.id,tpm.challan_no,tpm.challan_date,tpm.isdeleted,tpm.year,tpm.supplier_id,trd.rm_id,trd.qty,trd.rejected_qty as rej_qty,trd.id as det_id FROM tran_rmrcir_mast tpm,tran_rmrcir_details trd WHERE tpm.id=trd.mast_rmrcir_id and tpm.branch_id='$_SESSION[branch_id]' and tpm.date like '$date%' and tpm.isdeleted=0 order by tpm.challan_date desc");
	    }else{
	        
	        $mindate = getMinDate(); 
	        $maxdate = getMaxDate();
	        //$query = $this->db->query("SELECT tpm.id,tpm.challan_no,tpm.challan_date,tpm.isdeleted,tpm.year,ms.name FROM tran_rmrcir_mast tpm ,mast_supplier ms WHERE tpm.supplier_id=ms.id and tpm.branch_id='$_SESSION[branch_id]' and tpm.isdeleted=0 and tpm.date like '$date%' order by tpm.challan_date desc limit 10");
	 	   $query = $this->db->query("SELECT tpm.id,tpm.challan_no,tpm.challan_date,tpm.isdeleted,tpm.year,tpm.supplier_id,trd.rm_id,trd.qty,trd.rejected_qty as rej_qty,trd.id as det_id FROM tran_rmrcir_mast tpm,tran_rmrcir_details trd WHERE tpm.id=trd.mast_rmrcir_id and tpm.branch_id='$_SESSION[branch_id]' and tpm.isdeleted=0 and tpm.date between '$mindate' and '$maxdate' order by tpm.challan_date desc");
	 
	    }
	 //  echo $this->db->last_query(); 
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
	  $query = $this->db->query("SELECT * FROM `tran_rmrcir_details` where mast_rmrcir_id='$id' and isdeleted=0 and qty >0  order by id asc");
	 $data = $query->result_array();
	// echo $this->db->last_query(); die;
	 return $data;

	}
	
	/*------------------Delivery Challan------------------*/
	   public function getTrandcmastOB()
	{
	    if($_POST['date']){
	     	$scheduleDate  = $_POST['date'];
			$date 	   = date("Y-m", strtotime($scheduleDate)); 
            $query = $this->db->query("SELECT tdm.`id`, tdm.`date`, tdm.`year`, tdm.`supplier_id`, tdm.`branch_id`, tdm.`dc_type`, tdm.`dc_no`, tdm.`remarks`,tdd.qty FROM tran_dc_mast tdm,mast_supplier ms,tran_dc_details tdd WHERE tdd.mast_dc_id=tdm.id and tdm.supplier_id=ms.id and tdm.branch_id='$_SESSION[branch_id]' and tdm.date like '$date%' and tdm.remarks like 'Opening Balance As On%' and tdd.isdeleted=0 order by tdm.date desc");
	    }else{
	        $date=date("Y-m");
	        $query = $this->db->query("SELECT tdm.`id`, tdm.`date`, tdm.`year`, tdm.`supplier_id`, tdm.`branch_id`, tdm.`dc_type`, tdm.`dc_no`, tdm.`remarks`,tdd.qty FROM tran_dc_mast tdm,mast_supplier ms,tran_dc_details tdd WHERE tdd.mast_dc_id=tdm.id and tdm.supplier_id=ms.id and tdm.branch_id='$_SESSION[branch_id]' and tdm.date like '$date%' and tdm.remarks like 'Opening Balance As On%' and tdd.isdeleted=0 order by tdm.date desc"); 
	      
	    }
	 $data = $query->result_array();
	 return $data;

	}
    public function getTrandcmast()
	{
	    if($_POST['date']){
	     	$scheduleDate  = $_POST['date'];
			$date 	   = date("Y-m", strtotime($scheduleDate)); 
            $query = $this->db->query("SELECT tdm.`id`, tdm.`date`, tdm.`year`, tdm.`supplier_id`, tdm.`branch_id`, tdm.`dc_type`, tdm.`dc_no`, tdm.`remarks` FROM tran_dc_mast tdm,mast_supplier ms WHERE tdm.supplier_id=ms.id and tdm.branch_id='$_SESSION[branch_id]' and tdm.date like '$date%' order by tdm.date desc");
	    }else{
	        $date=date("Y-m");
	        $query = $this->db->query("SELECT tdm.`id`, tdm.`date`, tdm.`year`, tdm.`supplier_id`, tdm.`branch_id`, tdm.`dc_type`, tdm.`dc_no`, tdm.`remarks` FROM tran_dc_mast tdm,mast_supplier ms WHERE tdm.supplier_id=ms.id and tdm.branch_id='$_SESSION[branch_id]' and tdm.date like '$date%' order by tdm.date desc limit 50"); 
	      
	    }
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
 //echo $this->db->last_query();
	 return $data;

	}
	public function getPoBalQty($det_poid){
	  $query = $this->db->query("SELECT (tppd.qty-sum(tpd.qty)) as bal_qty from tran_partspo_details tppd 
	  INNER join tran_dc_details tpd on tpd.parts_po_det_id=tppd.id and tpd.isdeleted=0 and tppd.id='$det_poid'");
	 $data = $query->row_array();
	// echo $this->db->last_query();die;
	 return $data['bal_qty'];
	}
	public function getDCRCIRQty($supId)
    {
		$branch_id 	= $_SESSION['branch_id'];
		$year 		= $_SESSION['current_year'];
        $query = $this->db->query("select ss.id,ss.part_id,ss.qty as ordered_qty,sum(tpd.qty) as rec_qty,(ss.qty-sum(tpd.qty)) as bal_qty,ss.tran_partspo_det_id,tpo.op_id from tran_supplier_schedule ss left join tran_partsrcir_details tpd on tpd.supp_schedule_id = ss.id left JOIN tran_partspo_details tpo ON ss.tran_partspo_det_id=tpo.id where ss.year= '$year' and ss.receiving_branch_id = '$branch_id' and ss.supplier_id = '$supId' group by ss.id");
        $data = $query->result_array();
     //  echo $this->db->last_query(); 
        return $data;
    
    }
    
      public function getPrevOpQty($partId,$opId)
	{
	      $branch_id     =$_SESSION['branch_id'];
	    
	    $getseq=$this->db->query("select sequence_no as seq from rel_part_operation where part_id='$partId' and op_id='$opId' and isdeleted=0");
	  	$getseq1 = $getseq->row_array();
	  	$sequence_no = $getseq1['seq'];
		
	    $sqlquery=$this->db->query("select assembly_part_id from rel_part_rm where part_id='$partId' and isdeleted=0 and assembly_part_id>0");
	    $isAssemblyPartId = $sqlquery->row_array();
	   
	     if(!empty($isAssemblyPartId[assembly_part_id]) && $sequence_no==2){
	     
	          $partId=$isAssemblyPartId[assembly_part_id];
	          $query = $this->db->query("select op_id from rel_part_operation where part_id ='$partId' and sequence_no= (select max(sequence_no) from rel_part_operation where part_id='$partId' and isdeleted=0) and isdeleted = 0");
       	      $PreOPIds = $query->row_array();
       	     
	     }else{
    	    $query = $this->db->query("select op_id from rel_part_operation where part_id ='$partId' and sequence_no= (select sequence_no-1 from rel_part_operation where part_id='$partId' and op_id='$opId' and isdeleted=0) and isdeleted = 0");
           	$PreOPIds = $query->row_array();
	     }
       	
      	$PreOPId = $PreOPIds['op_id'];
        $totalStock = $this->getCurrentOpQty($partId,$PreOPId);
       // echo "<br>".$this->db->last_query();
		return $totalStock;
	}
	
	//New Query
    public function getPrevOpQtyQCDPR($partId,$opId)
	{
	    $branch_id     =  $_SESSION['branch_id'];
	    
	    $getseq=$this->db->query("select sequence_no as seq from rel_part_operation where part_id='$partId' and op_id='$opId' and isdeleted=0");
	  	$getseq1 = $getseq->row_array();
	  	$sequence_no = $getseq1['seq'];
		
	    $sqlquery=$this->db->query("select assembly_part_id from rel_part_rm where part_id='$partId' and isdeleted=0 and assembly_part_id>0");
	    $isAssemblyPartId = $sqlquery->row_array();
           
	     if(!empty($isAssemblyPartId['assembly_part_id']) && $sequence_no==2){
	  
	         $partId=$isAssemblyPartId['assembly_part_id'];
	          $query = $this->db->query("select op_id from rel_part_operation where part_id ='$partId' and sequence_no= (select max(sequence_no) from rel_part_operation where part_id='$partId' and isdeleted=0) and isdeleted = 0");
       	      $PreOPIds = $query->row_array();
       	 
	     }else{
    	    $query = $this->db->query("select op_id from rel_part_operation where part_id ='$partId' and sequence_no= (select sequence_no-1 from rel_part_operation where part_id='$partId' and op_id='$opId' and isdeleted=0) and isdeleted = 0");
           	$PreOPIds = $query->row_array();
	     }
       	
         $PreOPId = $PreOPIds['op_id'];
      	
      	 $query = $this->db->query("SELECT qc_requiredfor_dpr FROM mast_operation where id='$PreOPId' and isdeleted=0 ");
	     $Opdata = $query->row_array();
      	 $qc_requiredfor_dpr=$Opdata['qc_requiredfor_dpr'];
      		$totalStock = 0;
        	if($qc_requiredfor_dpr==0){
        	  //  echo "*****************";
        	   	$query = $this->db->query("select sum(received_qty-issue_qty-inprocess_loss_qty-rejected_qty) as max_qty from tran_dpr_stock where mast_dpr_id!='9999999' and part_id = '$partId' and operation_id ='$PreOPId' and year = '$_SESSION[current_year]' and branch_id ='$branch_id'
                           union all select sum(received_qty-issue_qty-inprocess_loss_qty-rejected_qty) as max_qty from tran_partsrcir_stock where det_partsrcir_id!='9999999' and part_id='$partId' and op_id='$PreOPId' and branch_id ='$branch_id' and year = '$_SESSION[current_year]' and (received_qty+issue_qty+inprocess_loss_qty+rejected_qty)!=0 and det_partsrcir_id!=0"); 
                           //or  ( det_partsrcir_id in (select det_partsrcir_id FROM `tran_partsrcir_stock` where part_id='$partId' and op_id='$PreOPId' and branch_id ='$branch_id' and year = '$_SESSION[current_year]'  and (received_doc_type='p_movement' or received_doc_type='supl_pmovement' or received_doc_type='stock_adj' or issue_doc_type='stock_adj' or received_doc_type='O.B.')))");
        	    	
        	    $data = $query->result_array();
            		if(!empty($data))
            		{
            			foreach ($data as $key => $value) {
            			    //echo $value['max_qty']."**<br>";
            				$totalStock += $value['max_qty'];
            			}
            		}
        	}else{
        //	    echo "#################";
                $totalStock = $this->getCurrentOpQty($partId,$PreOPId);
             }
 	//echo "<br>".$this->db->last_query();

		return $totalStock;
	}
      public function getCurrentOpQty($partId,$PreOPId,$branch_id=null)
		{
		   if($branch_id==null){
				  $branch_id     =$_SESSION['branch_id'];
		   }
		   
		   
			$query = $this->db->query("SELECT qc_requiredfor_dpr FROM mast_operation where id='$PreOPId' and isdeleted=0 ");
			$Opdata = $query->row_array();
			  $qc_requiredfor_dpr=$Opdata['qc_requiredfor_dpr'];
			  $totalStock = 0;
				if($qc_requiredfor_dpr==0){
				   // echo "$$$$$$$$$$$$$";
				  $query = $this->db->query("select sum(received_qty-issue_qty-inprocess_loss_qty-rejected_qty) as max_qty from tran_dpr_stock where mast_dpr_id!='9999999' and part_id = '$partId' and operation_id ='$PreOPId' and year = '$_SESSION[current_year]' and branch_id ='$branch_id'
								   union all select sum(received_qty-issue_qty-inprocess_loss_qty-rejected_qty) as max_qty from tran_partsrcir_stock where det_partsrcir_id!='9999999' and part_id='$partId' and op_id='$PreOPId' and branch_id ='$branch_id' and year = '$_SESSION[current_year]' and (received_qty+issue_qty+rejected_qty)!=0 and det_partsrcir_id!=0");
								   //+inprocess_loss_qty
								  // or  ( det_partsrcir_id in (select det_partsrcir_id FROM `tran_partsrcir_stock` where part_id='$partId' and op_id='$PreOPId' and branch_id ='$branch_id' and year = '$_SESSION[current_year]'  and (received_doc_type='p_movement' or received_doc_type='supl_pmovement' or received_doc_type='stock_adj' or issue_doc_type='stock_adj' or received_doc_type='O.B.')))");
				   
				 }
				 else
		   {
			 // echo "@@@@@@@@@@@";
			   $query = $this->db->query("select sum(received_qty-issue_qty-inprocess_loss_qty-rejected_qty) as max_qty from tran_dpr_stock where mast_dpr_id!='9999999' and part_id = '$partId' and operation_id ='$PreOPId' and year = '$_SESSION[current_year]' and branch_id ='$branch_id' and mast_dpr_id in(select dpr_id from tran_dpr_quality_checks where year = '$_SESSION[current_year]')  
				   union all select sum(received_qty-issue_qty-inprocess_loss_qty-rejected_qty) as max_qty from tran_partsrcir_stock where det_partsrcir_id!='9999999' and part_id='$partId' and op_id='$PreOPId' and branch_id ='$branch_id' and year = '$_SESSION[current_year]' and (received_qty+issue_qty+rejected_qty)!=0 and (det_partsrcir_id in(SELECT det_partsrcir_id FROM `tran_partsrcir_quality_checks` where year = '$_SESSION[current_year]'  union all select det_partsrcir_id FROM `tran_partsrcir_stock` where part_id='$partId' and op_id='$PreOPId' and branch_id ='$branch_id' and year = '$_SESSION[current_year]'  and (received_doc_type='p_movement' or received_doc_type='supl_pmovement' or issue_doc_type='p_movement' or issue_doc_type='supl_pmovement' or received_doc_type='stock_adj' or issue_doc_type='stock_adj' or received_doc_type='O.B.')) )");
			  }
			  //+inprocess_loss_qty
			  $data = $query->result_array();
			 //  echo "<br>".$this->db->last_query();
		$totalStock = 0;
		if(!empty($data))
		{
		foreach ($data as $key => $value) {
		$totalStock += $value['max_qty'];
		}
		}
		return $totalStock;
		}
	public function getTranPartStkAdjCurrQty($partId,$PreOPId,$type,$bsid,$to_date){
	    
    if($type=='B'){
		$branch_id=$bsid;
		$totalStock=$this->getCurrentOpQty($partId,$PreOPId,$branch_id);
		return $totalStock;

    }elseif($type=='S'){
      $where="supplier_id=".$bsid;
	
		$query = $this->db->query("select sum(temp.max_qty) as qty,tdd.part_id from tran_dc_details tdd 
		inner join tran_dc_mast tdm on tdm.id = tdd.mast_dc_id 
		inner join (select det_dc_id, sum(issue_qty-received_qty-rejected_qty-inprocess_loss_qty) as max_qty from tran_dc_stock where part_id='$partId' and op_id='$PreOPId' and year = '$_SESSION[current_year]' group by det_dc_id ) temp on tdd.id = temp.det_dc_id 
		where tdm.supplier_id = '$bsid' and temp.max_qty>0  and tdd.part_id='$partId' and tdd.op_id='$PreOPId' and tdd.isdeleted=0 order by tdd.id,tdd.part_id,tdm.dc_no");
 	//and year = '$_SESSION[current_year]' //and tdm.year = '$_SESSION[current_year]'
		$data = $query->row_array();
	//	echo "<br>".$this->db->last_query();
	 	return $data['qty'];
    }
   }
	public function getCurrentDCAvailableQty($partId,$opId)
	{
	   $branch_id     =$_SESSION['branch_id'];
		$query = $this->db->query("select id,sum(issue_qty-inprocess_loss_qty-rejected_qty-received_qty) as max_qty from tran_dc_stock where part_id = '$partId' and operation_id ='$opId' and year = '$_SESSION[current_year]' and issue_qty-inprocess_loss_qty-rejected_qty-received_qty > 0 and branch_id ='$branch_id' GROUP BY det_dc_id ");
		$data = $query->result_array();
	 	return $data;
	}
	
	 public function getAllstageQty($partId,$opId=null)
	{
			$year      =$_SESSION['current_year'];
	        $getFirstOperaion = $this->getQueryModel->getFirstOperaion($partId);
      // if ($getFirstOperaion['op_id']==1 || $getFirstOperaion['op_id']==2  )
       // if ($getFirstOperaion['op_id']!=3)   {
            
            if($opId == 47) //47- Packing
        	  {
        	     
    	     //$query = $this->db->query("select sum(received_qty) as max_qty from tran_dpr_stock where part_id = '$partId' and operation_id in(47) and year = '$year' and (received_doc_type='tran_dpr') union all select sum(issue_qty)*-1 as max_qty from tran_dpr_stock where part_id = '$partId' and operation_id in(47) and year = '$year' and (issue_doc_type='invoice') union all select sum(received_qty) as max_qty from tran_partsrcir_stock where part_id = '$partId' and op_id in(47) and (received_doc_type='O.B.')")  ;
    	        $query = $this->db->query("select part_id,doc_type,doc_id,sequence_no,sum(qty) as max_qty,move_from,move_to,branch_id,op_id FROM(SELECT tran_dc_stock.part_id,'DC' as doc_type,det_dc_id as doc_id,move_from,move_to,rpo.sequence_no,sum(-received_qty-rejected_qty+issue_qty-inprocess_loss_qty) as qty,tran_dc_stock.branch_id,tran_dc_stock.op_id FROM `tran_dc_stock` inner join rel_part_operation rpo on rpo.part_id=tran_dc_stock.part_id and rpo.op_id=tran_dc_stock.op_id inner join tran_dc_mast on tran_dc_stock.`mast_dc_id` = tran_dc_mast.id  WHERE tran_dc_stock.part_id = '$partId' and tran_dc_stock.year = '$year'  and (received_qty+issue_qty)>0  and tran_dc_stock.op_id in(47,48) group by tran_dc_stock.det_dc_id,tran_dc_stock.op_id
                                        union all
                                        SELECT tran_dpr_stock.part_id,'DPR' as doc_type,mast_dpr_id as doc_id,move_from,move_to,rpo.sequence_no,sum(received_qty-tran_dpr_stock.rejected_qty-issue_qty-inprocess_loss_qty) as max_qty,tran_dpr_stock.branch_id,tran_dpr_stock.operation_id as op_id FROM tran_dpr_stock inner join rel_part_operation rpo on rpo.part_id=tran_dpr_stock.part_id and rpo.op_id=tran_dpr_stock.operation_id inner JOIN tran_dpr on tran_dpr.id = tran_dpr_stock.mast_dpr_id WHERE tran_dpr_stock.part_id = '$partId' and tran_dpr_stock.year = '$year'  and (received_qty+tran_dpr_stock.rejected_qty+issue_qty+inprocess_loss_qty+booked_qty)>0 and tran_dpr_stock.operation_id in(47,48) group by tran_dpr_stock.mast_dpr_id,tran_dpr_stock.operation_id
                                        union all
                                        SELECT tran_partsrcir_stock.part_id,'RCIR' as doc_type,det_partsrcir_id as doc_id,move_from,move_to,rpo.sequence_no,sum(received_qty-rejected_qty-issue_qty-inprocess_loss_qty) as max_qty,tran_partsrcir_stock.branch_id,tran_partsrcir_stock.op_id FROM `tran_partsrcir_stock` inner join rel_part_operation rpo on rpo.part_id=tran_partsrcir_stock.part_id and rpo.op_id=tran_partsrcir_stock.op_id inner join tran_partsrcir_mast on tran_partsrcir_stock.mast_partsrcir_id = tran_partsrcir_mast.id WHERE tran_partsrcir_stock.part_id = '$partId' and tran_partsrcir_stock.year = '$year' and (received_qty+issue_qty)>0 and tran_partsrcir_stock.op_id in(47,48) group by tran_partsrcir_stock.det_partsrcir_id,tran_partsrcir_stock.op_id
                                   order by sequence_no) a GROUP by doc_type,op_id order by sequence_no");
    	       }else{
    	            
    	        
    	            //$query = $this->db->query("select sum(received_qty) as max_qty from tran_dpr_stock where part_id = '$partId' and operation_id not in(47) and (received_doc_type='tran_dpr') union all select sum(-received_qty) as max_qty from tran_dpr_stock where part_id = '$partId' and operation_id not in(47) and (received_doc_type='tran_dpr') union all select sum(received_qty) as max_qty from tran_partsrcir_stock where part_id = '$partId' and op_id not in(47) and (received_doc_type='O.B.') ");
    	            // union all select sum(inprocess_loss_qty+rejected_qty)*-1 as max_qty from tran_partsrcir_stock where part_id='$partId'  and year = '$year'
    	              $query = $this->db->query("select part_id,doc_type,doc_id,sequence_no,sum(qty) as max_qty,move_from,move_to,branch_id,op_id FROM(SELECT tran_dc_stock.part_id,'DC' as doc_type,det_dc_id as doc_id,move_from,move_to,rpo.sequence_no,sum(-received_qty-rejected_qty+issue_qty-inprocess_loss_qty) as qty,tran_dc_stock.branch_id,tran_dc_stock.op_id FROM `tran_dc_stock` inner join rel_part_operation rpo on rpo.part_id=tran_dc_stock.part_id and rpo.op_id=tran_dc_stock.op_id inner join tran_dc_mast on tran_dc_stock.`mast_dc_id` = tran_dc_mast.id  WHERE tran_dc_stock.part_id = '$partId' and tran_dc_stock.year = '$year'  and (received_qty+issue_qty)>0  and tran_dc_stock.op_id not in(47,48) group by tran_dc_stock.det_dc_id,tran_dc_stock.op_id
                                        union all
                                        SELECT tran_dpr_stock.part_id,'DPR' as doc_type,mast_dpr_id as doc_id,move_from,move_to,rpo.sequence_no,sum(received_qty-tran_dpr_stock.rejected_qty-issue_qty-inprocess_loss_qty) as max_qty,tran_dpr_stock.branch_id,tran_dpr_stock.operation_id as op_id FROM tran_dpr_stock inner join rel_part_operation rpo on rpo.part_id=tran_dpr_stock.part_id and rpo.op_id=tran_dpr_stock.operation_id inner JOIN tran_dpr on tran_dpr.id = tran_dpr_stock.mast_dpr_id WHERE tran_dpr_stock.part_id = '$partId' and tran_dpr_stock.year = '$year'  and (received_qty+tran_dpr_stock.rejected_qty+issue_qty+inprocess_loss_qty+booked_qty)>0 and tran_dpr_stock.operation_id not in(47,48) group by tran_dpr_stock.mast_dpr_id,tran_dpr_stock.operation_id
                                        union all
                                        SELECT tran_partsrcir_stock.part_id,'RCIR' as doc_type,det_partsrcir_id as doc_id,move_from,move_to,rpo.sequence_no,sum(received_qty-rejected_qty-issue_qty-inprocess_loss_qty) as max_qty,tran_partsrcir_stock.branch_id,tran_partsrcir_stock.op_id FROM `tran_partsrcir_stock` inner join rel_part_operation rpo on rpo.part_id=tran_partsrcir_stock.part_id and rpo.op_id=tran_partsrcir_stock.op_id inner join tran_partsrcir_mast on tran_partsrcir_stock.mast_partsrcir_id = tran_partsrcir_mast.id WHERE tran_partsrcir_stock.part_id = '$partId' and tran_partsrcir_stock.year = '$year' and (received_qty+issue_qty)>0 and tran_partsrcir_stock.op_id not in(47,48) group by tran_partsrcir_stock.det_partsrcir_id,tran_partsrcir_stock.op_id
                                   order by sequence_no) a GROUP by doc_type,op_id order by sequence_no");
    	        }
        
   
		$data = $query->result_array();
		//	echo "------Getallstage<br>".$this->db->last_query();	
	//	echo "/n";
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
	/* $query=$this->db->query("SELECT dc.id, dc.mast_dc_id, dc.part_id,dc.qty_in_kgs, dc.qty,dc.max_qty, dc.rcir_id, dc.op_id, dc.parts_po_det_id, dc.remarks,po.qty as part_qty,po.part_remark as partpo_remark,po.rate as part_rate,po.uom,mp.name as part_name,mp.partno,mp.hsncode,round(po.qty*po.rate) as total_amount 
	 FROM tran_dc_details as dc 
	 inner join tran_partspo_details as po on po.id = dc.parts_po_det_id 
	 INNER JOIN mast_part mp on po.part_id = mp.part_id  where dc.mast_dc_id='$id' and dc.isdeleted=0 order by dc.id asc");*/
	  $query=$this->db->query("SELECT dc.id, dc.mast_dc_id, dc.part_id,dc.qty_in_kgs, dc.qty,dc.max_qty,  dc.op_id, dc.parts_po_det_id, dc.remarks,po.qty as part_qty,po.part_remark as partpo_remark,po.rate as part_rate,po.uom,round(po.qty*po.rate) as total_amount 
	 FROM tran_dc_details as dc left join tran_partspo_details as po on po.id = dc.parts_po_det_id   where dc.mast_dc_id='$id' and dc.isdeleted=0 order by dc.id asc");
	 $data = $query->result_array();
	 	//echo "<br>".$this->db->last_query();
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
	    
	    $branch_id     =$_SESSION['branch_id'];
		$query = $this->db->query("SELECT rm_id,grossweight,scrap_normal,scrap_ss FROM `rel_part_rm` WHERE part_id = '$partId' and rm_id>0 and isdeleted=0");
		$data = $query->row_array();
//		print_r($data);
//		 	echo "<br>".$this->db->last_query();

		$query1 = $this->db->query("SELECT branch_id,sum(received_qty - rejected_qty - issue_qty  - inprocess_loss_qty) as stock from tran_rmrcir_stock where rm_id='$data[rm_id]'  and branch_id = '$branch_id' and (det_rmrcir_id IN( select det_rmrcir_id from tran_rmrcir_quality_checks) OR received_doc_type='O.B.' OR det_rmrcir_id=0) "); //AND year = '$_SESSION[current_year]' 
	//	UNION ALL select branch_id,sum(booked_qty) from tran_rmrcir_stock where branch_id ='$branch_id' and (det_rmrcir_id IN( select det_rmrcir_id from tran_rmrcir_quality_checks ) OR det_rmrcir_id=0)");
//booked_doc_type  = 'prod_plan' AND booked_doc_id  = '$booked_doc_id' and 
		$data1 = $query1->result_array();
		
     //	echo "<br>".$this->db->last_query();
		if(!empty($data1))
		{
			$totalStock = "";
			foreach ($data1 as $key => $value) {
				$totalStock += $value['stock'];
			}
		}
      
        $scrap_normal=$data['scrap_normal'];
        $scrap_ss=$data['scrap_ss'];
           
		$arrayName = array('stock' => $totalStock,'grossweight' => $data['grossweight'],'scrap_normal' => $scrap_normal,'scrap_ss' => $scrap_ss, );

		return $arrayName;
	}
	
	public function getRmBookedRec($prod_plan_id)
	{
		$query = $this->db->query("SELECT *,sum(booked_qty-issue_qty) as sum_booked_qty from tran_rmrcir_stock where booked_doc_type = 'prod_plan' and booked_doc_id = $prod_plan_id and isdeleted=0 group by det_rmrcir_id");

		$PreOPIds23 = $query->result_array();
	//	echo $this->db->last_query(); die;
		return $PreOPIds23;
		 
	}
	public function getRmAvailStock($rm_id)
	{
	//	$query = $this->db->query("SELECT mrmrd.id as det_id,mrmro.date,mrmro.id as mast_id,temp.max_qty from tran_rmrcir_details mrmrd INNER JOIN tran_rmrcir_mast mrmro on mrmro.id = mrmrd.mast_rmrcir_id inner join (select det_rmrcir_id,sum(received_qty)-sum(issue_qty)-sum(inprocess_loss_qty)-sum(rejected_qty)-sum(booked_qty) as max_qty from tran_rmrcir_stock where rm_id='$rm_id' and  branch_id = '$_SESSION[branch_id]' and year='$_SESSION[current_year]' group by det_rmrcir_id) temp on temp.det_rmrcir_id= mrmrd.id where temp.max_qty > 0 ORDER By date");
	                           // SELECT branch_id,sum(received_qty - rejected_qty - issue_qty - booked_qty - inprocess_loss_qty) as stock from tran_rmrcir_stock where rm_id='$data[rm_id]' AND year = '$_SESSION[current_year]'  and branch_id = '$branch_id'
		$query = $this->db->query("SELECT mrmrd.id as det_id,mrmro.date,mrmro.id as mast_id,temp.max_qty,temp.doc_year from tran_rmrcir_details mrmrd INNER JOIN tran_rmrcir_mast mrmro on mrmro.id = mrmrd.mast_rmrcir_id inner join (select doc_year,det_rmrcir_id,sum(received_qty-issue_qty-inprocess_loss_qty-rejected_qty) as max_qty from tran_rmrcir_stock where rm_id='$rm_id' and  branch_id = '$_SESSION[branch_id]'  group by det_rmrcir_id) temp on temp.det_rmrcir_id= mrmrd.id where temp.max_qty > 0 ORDER By date");//and year='$_SESSION[current_year]'
	  
		$PreOPIds23 = $query->result_array();
	//	echo $this->db->last_query(); 
		return $PreOPIds23;
		 
	}
	public function updatePartOpStock($partId,$opId)
 	{
 	    $branch_id     =$_SESSION['branch_id'];
 	 
 	    $query1111111=$this->db->query("select sequence_no as seq from rel_part_operation where part_id='$partId' and op_id='$opId' and isdeleted=0");
	  	$PreOPIdsass = $query1111111->row_array();
		$PreOPId111 = $PreOPIdsass['seq'];
		
	    $sqlquery=$this->db->query("select assembly_part_id from rel_part_rm where part_id='$partId' and isdeleted=0 and assembly_part_id>0");
	     $isAssemblyPartId = $sqlquery->row_array();
	    // echo "***********".$this->db->last_query();
	     if(!empty($isAssemblyPartId[assembly_part_id]) && $PreOPId111==2){
	         
	         $partId=$isAssemblyPartId[assembly_part_id];
	          $query = $this->db->query("select op_id from rel_part_operation where part_id ='$partId' and sequence_no= (select max(sequence_no) from rel_part_operation where part_id='$partId' and isdeleted=0) and isdeleted = 0");
       	      $PreOPIds = $query->row_array();
       	      
	     }else{
    	    $query = $this->db->query("select op_id from rel_part_operation where part_id ='$partId' and sequence_no= (select sequence_no-1 from rel_part_operation where part_id='$partId' and op_id='$opId' and isdeleted=0) and isdeleted = 0");
           	$PreOPIds = $query->row_array();
	     }
		
		$op_id = $PreOPIds['op_id'];
		
 		$query = $this->db->query("SELECT temp.det_rmrcir_id,mprd.id,mprd.id as mast_id, mprd.mast_partsrcir_id as mast_partsrcir_id,mpro.date,'partrcir' as doc,temp.op_id as op_id,temp.part_id,temp.max_qty FROM tran_partsrcir_details mprd INNER JOIN tran_partsrcir_mast mpro on mpro.id = mprd.mast_partsrcir_id inner join (select part_id,op_id,det_partsrcir_id,sum(received_qty)-sum(issue_qty)-sum(inprocess_loss_qty)-sum(rejected_qty) as max_qty,group_concat(det_rmrcir_id SEPARATOR ',') as det_rmrcir_id from tran_partsrcir_stock where part_id='$partId' and op_id='$op_id' and branch_id ='$branch_id' and year = '$_SESSION[current_year]' group by det_partsrcir_id) temp on temp.det_partsrcir_id= mprd.id where temp.max_qty >0 
 		union all SELECT temp.det_rmrcir_id,tran_dpr_stock.id,tran_dpr_stock.mast_dpr_id as mast_id,'1' as mast_partsrcir_id,tran_dpr.dpr_date as date, 'dpr' as doc,temp.operation_id as op_id ,temp.part_id ,temp.max_qty from tran_dpr_stock INNER JOIN tran_dpr on tran_dpr.id = tran_dpr_stock.mast_dpr_id inner join (select part_id,operation_id,mast_dpr_id,sum(received_qty)-sum(issue_qty)-sum(inprocess_loss_qty)-sum(rejected_qty) as max_qty,group_concat(det_rmrcir_id SEPARATOR ',') as det_rmrcir_id from tran_dpr_stock where part_id='$partId' and operation_id='$op_id' and year = '$_SESSION[current_year]' and branch_id ='$branch_id' group by mast_dpr_id) temp on temp.mast_dpr_id= tran_dpr.id where temp.max_qty >0 GROUP BY tran_dpr_stock.mast_dpr_id order by date");

		//echo $this->db->last_query(); 
		$PreOPIds2 = $query->result_array();
	
		return $PreOPIds2;
 		
 	}
 	//added - 25-01-2024 for invoice Stock Adj
 	public function updateInvoiceAdj($partId,$op_id)
 	{
 	    $branch_id     =$_SESSION['branch_id'];
		
 		$query = $this->db->query("SELECT temp.det_rmrcir_id,mprd.id,mprd.id as mast_id, mprd.mast_partsrcir_id as mast_partsrcir_id,mpro.date,'partrcir' as doc,temp.op_id as op_id,temp.part_id,temp.max_qty FROM tran_partsrcir_details mprd INNER JOIN tran_partsrcir_mast mpro on mpro.id = mprd.mast_partsrcir_id inner join (select part_id,op_id,det_partsrcir_id,sum(received_qty)-sum(issue_qty)-sum(inprocess_loss_qty)-sum(rejected_qty) as max_qty,group_concat(det_rmrcir_id SEPARATOR ',') as det_rmrcir_id from tran_partsrcir_stock where part_id='$partId' and op_id='$op_id' and branch_id ='$branch_id' and year = '$_SESSION[current_year]' group by det_partsrcir_id) temp on temp.det_partsrcir_id= mprd.id where temp.max_qty >0 
 		union all SELECT temp.det_rmrcir_id,tran_dpr_stock.id,tran_dpr_stock.mast_dpr_id as mast_id,'1' as mast_partsrcir_id,tran_dpr.dpr_date as date, 'dpr' as doc,temp.operation_id as op_id ,temp.part_id ,temp.max_qty from tran_dpr_stock INNER JOIN tran_dpr on tran_dpr.id = tran_dpr_stock.mast_dpr_id inner join (select part_id,operation_id,mast_dpr_id,sum(received_qty)-sum(issue_qty)-sum(inprocess_loss_qty)-sum(rejected_qty) as max_qty,group_concat(det_rmrcir_id SEPARATOR ',') as det_rmrcir_id from tran_dpr_stock where part_id='$partId' and operation_id='$op_id' and year = '$_SESSION[current_year]' and branch_id ='$branch_id' group by mast_dpr_id) temp on temp.mast_dpr_id= tran_dpr.id where temp.max_qty >0 GROUP BY tran_dpr_stock.mast_dpr_id order by date");

		$PreOPIds2 = $query->result_array();
	//	echo $this->db->last_query(); 
		return $PreOPIds2;
 		
 	}
 		//added - 30-03-2024 for invoice Stock Adj
 	public function updateInvoiceAdjPMovement($partId,$op_id,$branch_id)
 	{
		
 		$query = $this->db->query("SELECT temp.det_rmrcir_id,mprd.id,mprd.id as mast_id, mprd.mast_partsrcir_id as mast_partsrcir_id,mpro.date,'partrcir' as doc,temp.op_id as op_id,temp.part_id,temp.max_qty FROM tran_partsrcir_details mprd INNER JOIN tran_partsrcir_mast mpro on mpro.id = mprd.mast_partsrcir_id inner join (select part_id,op_id,det_partsrcir_id,sum(received_qty)-sum(issue_qty)-sum(inprocess_loss_qty)-sum(rejected_qty) as max_qty,group_concat(det_rmrcir_id SEPARATOR ',') as det_rmrcir_id from tran_partsrcir_stock where part_id='$partId' and op_id='$op_id' and branch_id ='$branch_id' and year = '$_SESSION[current_year]' group by det_partsrcir_id) temp on temp.det_partsrcir_id= mprd.id where temp.max_qty >0 
 		union all SELECT temp.det_rmrcir_id,tran_dpr_stock.id,tran_dpr_stock.mast_dpr_id as mast_id,'1' as mast_partsrcir_id,tran_dpr.dpr_date as date, 'dpr' as doc,temp.operation_id as op_id ,temp.part_id ,temp.max_qty from tran_dpr_stock INNER JOIN tran_dpr on tran_dpr.id = tran_dpr_stock.mast_dpr_id inner join (select part_id,operation_id,mast_dpr_id,sum(received_qty)-sum(issue_qty)-sum(inprocess_loss_qty)-sum(rejected_qty) as max_qty,group_concat(det_rmrcir_id SEPARATOR ',') as det_rmrcir_id from tran_dpr_stock where part_id='$partId' and operation_id='$op_id' and year = '$_SESSION[current_year]' and branch_id ='$branch_id' group by mast_dpr_id) temp on temp.mast_dpr_id= tran_dpr.id where temp.max_qty >0 GROUP BY tran_dpr_stock.mast_dpr_id order by date");

		$PreOPIds2 = $query->result_array();
	//	echo $this->db->last_query(); 
		return $PreOPIds2;
 		
 	}
 		public function getAssemblyPartScrapStock($partId)
 	{
         	     $sqlquery=$this->db->query("select assembly_part_id from rel_part_rm where part_id='$partId' and isdeleted=0 and assembly_part_id>0");
        	     $isAssemblyPartId = $sqlquery->row_array();
        	     //echo $this->db->last_query();
        	     return $isAssemblyPartId[assembly_part_id];
		
 	}
 	public function getAssemblyPart($partId,$opId)
 	{
 	     $query1111111=$this->db->query("select sequence_no as seq from rel_part_operation where part_id='$partId' and op_id='$opId' and isdeleted=0");
	  	 $PreOPIdsass = $query1111111->row_array();
		 $PreOPId111 = $PreOPIdsass['seq'];
		  if($PreOPId111==2){
 	    
         	     $sqlquery=$this->db->query("select assembly_part_id from rel_part_rm where part_id='$partId' and isdeleted=0 and assembly_part_id>0");
        	     $isAssemblyPartId = $sqlquery->row_array();
        	     //echo $this->db->last_query();
        	     return $isAssemblyPartId[assembly_part_id];
		  }else{
		      return null;
		  }
 	}
 	
		public function updatePartOpStockSuplMvmt($partId,$opId)
 	{
 	    $branch_id     =$_SESSION['branch_id'];
 	    $query = $this->db->query("select op_id from rel_part_operation where part_id ='$partId' and sequence_no= (select sequence_no-1 from rel_part_operation where part_id='$partId' and op_id='$opId' ) and isdeleted = 0");
		$PreOPIds = $query->row_array();
		
		$op_id = $PreOPIds['op_id'];
		
 		$query = $this->db->query("SELECT mprd.id,mprd.id as mast_id, mprd.mast_partsrcir_id as mast_partsrcir_id,mpro.date,'partrcir' as doc,temp.op_id as op_id,temp.max_qty FROM tran_partsrcir_details mprd 
 		                         INNER JOIN tran_partsrcir_mast mpro on mpro.id = mprd.mast_partsrcir_id inner join (select op_id,det_partsrcir_id,sum(received_qty)-sum(issue_qty)-sum(inprocess_loss_qty)-sum(rejected_qty) as max_qty from tran_partsrcir_stock where part_id='$partId' and op_id='$op_id' and branch_id ='$branch_id' and received_doc_type='supl_pmovement' group by det_partsrcir_id) temp on temp.det_partsrcir_id= mprd.id where temp.max_qty >0  order by date");


		$PreOPIds2 = $query->result_array();	
		//	echo $this->db->last_query(); die;
	
		return $PreOPIds2;
 		
 	}


	public function updatePartOpBookedStockSupplMvmt($partId,$opId)
 	{
 	    $branch_id     =$_SESSION['branch_id'];
 	    $query = $this->db->query("select op_id from rel_part_operation where part_id ='$partId' and sequence_no= (select sequence_no-1 from rel_part_operation where part_id='$partId' and op_id='$opId' ) and isdeleted = 0");
		$PreOPIds = $query->row_array();
		
		$op_id = $PreOPIds['op_id'];
		
 		$query = $this->db->query("SELECT temp.id,temp.det_partsrcir_id as det_id,mprd.id as mast_id, mprd.mast_partsrcir_id as mast_partsrcir_id,mpro.date,'partrcir' as doc,mprd.op_id as op_id,temp.max_qty,temp.booked_doc_type,temp.booked_doc_id FROM tran_partsrcir_details mprd INNER JOIN tran_partsrcir_mast mpro on mpro.id = mprd.mast_partsrcir_id inner join (select id,det_partsrcir_id,(booked_qty) as max_qty,booked_doc_type,booked_doc_id from tran_partsrcir_stock where part_id='$partId' and op_id='$op_id' and branch_id ='$branch_id' and booked_qty >0 group by det_partsrcir_id) temp on temp.det_partsrcir_id= mprd.id where temp.max_qty >0 union all SELECT temp.id,tran_dpr_stock.mast_dpr_id as det_id,tran_dpr_stock.mast_dpr_id as mast_id,'1' as mast_partsrcir_id,tran_dpr.dpr_date as date, 'dpr' as doc,tran_dpr.operation_id as op_id ,temp.max_qty,temp.booked_doc_type,temp.booked_doc_id from tran_dpr_stock INNER JOIN tran_dpr on tran_dpr.id = tran_dpr_stock.mast_dpr_id inner join (select id,mast_dpr_id,(booked_qty) as max_qty,booked_doc_type,booked_doc_id from tran_dpr_stock where part_id='$partId' and operation_id='$op_id' and year = '$_SESSION[current_year]' and branch_id ='$branch_id'   and booked_qty >0 group by mast_dpr_id) temp on temp.mast_dpr_id= tran_dpr.id where temp.max_qty >0 GROUP BY tran_dpr_stock.mast_dpr_id order by date");

	//	echo $this->db->last_query(); die;
		$PreOPIds2 = $query->result_array();
	
		return $PreOPIds2;
 		
 	}

	public function updatePartOpBookedStock($partId,$opId)
 	{
 	    $branch_id     =$_SESSION['branch_id'];
 	    $query = $this->db->query("select op_id from rel_part_operation where part_id ='$partId' and sequence_no= (select sequence_no-1 from rel_part_operation where part_id='$partId' and op_id='$opId' ) and isdeleted = 0");
		$PreOPIds = $query->row_array();
		
		$op_id = $PreOPIds['op_id'];
		
 		$query = $this->db->query("SELECT temp.id,temp.det_partsrcir_id as det_id,mprd.id as mast_id, mprd.mast_partsrcir_id as mast_partsrcir_id,mpro.date,'partrcir' as doc,mprd.op_id as op_id,temp.max_qty,temp.booked_doc_type,temp.booked_doc_id FROM tran_partsrcir_details mprd INNER JOIN tran_partsrcir_mast mpro on mpro.id = mprd.mast_partsrcir_id inner join (select id,det_partsrcir_id,(booked_qty) as max_qty,booked_doc_type,booked_doc_id from tran_partsrcir_stock where part_id='$partId' and op_id='$op_id' and branch_id ='$branch_id' and booked_qty >0 group by det_partsrcir_id) temp on temp.det_partsrcir_id= mprd.id where temp.max_qty >0 union all SELECT temp.id,tran_dpr_stock.mast_dpr_id as det_id,tran_dpr_stock.mast_dpr_id as mast_id,'1' as mast_partsrcir_id,tran_dpr.dpr_date as date, 'dpr' as doc,tran_dpr.operation_id as op_id ,temp.max_qty,temp.booked_doc_type,temp.booked_doc_id from tran_dpr_stock INNER JOIN tran_dpr on tran_dpr.id = tran_dpr_stock.mast_dpr_id inner join (select id,mast_dpr_id,(booked_qty) as max_qty,booked_doc_type,booked_doc_id from tran_dpr_stock where part_id='$partId' and operation_id='$op_id' and year = '$_SESSION[current_year]' and branch_id ='$branch_id'   and booked_qty >0 group by mast_dpr_id) temp on temp.mast_dpr_id= tran_dpr.id where temp.max_qty >0 GROUP BY tran_dpr_stock.mast_dpr_id order by date");

	//	echo $this->db->last_query(); die;
		$PreOPIds2 = $query->result_array();
	
		return $PreOPIds2;
 		
 	}

   //removed booked_qty fron getDCRCIR($Supp_Id) function 
	public function getDCRCIR($Supp_Id)
 	{
 		$query = $this->db->query("select tdd.id,tdd.parts_po_det_id,tdd.qty as ordered_qty,tdd.part_id,tdm.supplier_id,tdm.id as dc_mast_id,tdm.dc_no,tdm.date,tdd.op_id from tran_dc_details tdd inner join tran_dc_mast tdm on tdm.id = tdd.mast_dc_id inner join ( select det_dc_id, sum(issue_qty-received_qty-rejected_qty-inprocess_loss_qty) as max_qty from tran_dc_stock where year = '$_SESSION[current_year]' group by det_dc_id ) temp on tdd.id = temp.det_dc_id where tdm.supplier_id = '$Supp_Id' and temp.max_qty>0 and tdd.isdeleted = 0  order by tdd.id,tdd.part_id,tdm.dc_no"); //and tdm.year = '$_SESSION[current_year]'
 	
      	$PreOPIds2 = $query->result_array();
       	//	echo $this->db->last_query(); 
      	return $PreOPIds2;
 		
 	}
    public function getSuplMovemtqty($Supp_Id,$partId,$opId)
 	{
 	    error_reporting(0);
 	    $query = $this->db->query("select op_id from rel_part_operation where part_id ='$partId' and sequence_no= (select sequence_no-1 from rel_part_operation where part_id='$partId' and op_id='$opId' ) and isdeleted = 0");
       	$PreOPIds1 = $query->row_array();
    	//	echo $this->db->last_query();
		$PreOPIds=$PreOPIds1['op_id'];
		
 		$query = $this->db->query("select tdd.id,tdd.parts_po_det_id,tdd.qty as ordered_qty,tdd.part_id,tdm.supplier_id,tdm.id as dc_mast_id,tdm.dc_no,tdm.date,tdd.op_id from tran_dc_details tdd 
 		inner join tran_dc_mast tdm on tdm.id = tdd.mast_dc_id 
 		inner join ( select det_dc_id, sum(issue_qty-received_qty-rejected_qty-inprocess_loss_qty) as max_qty from tran_dc_stock where part_id='$partId' and op_id='$PreOPIds' and year='$_SESSION[current_year]' group by det_dc_id ) temp on tdd.id = temp.det_dc_id 
 		where tdm.supplier_id = '$Supp_Id' and tdd.part_id='$partId' and tdd.op_id='$PreOPIds' and  temp.max_qty>0 and tdd.isdeleted = 0 order by tdd.id,tdd.part_id,tdm.dc_no");
      // and year='$_SESSION[current_year]'
        $PreOPIds2 = $query->result_array();
        	
      	//	echo "******<br>".$this->db->last_query(); die;
		return $PreOPIds2;
 		
 	}
 	public function getDCPartId($Supp_Id)
 	{
 		$query = $this->db->query("select distinct(tdd.part_id),mp.name as pname,mp.partno from tran_dc_details tdd 
 		inner join mast_part mp on tdd.part_id=mp.part_id 
 		inner join tran_dc_mast tdm on tdm.id = tdd.mast_dc_id 
 		inner join (select det_dc_id, sum(issue_qty-received_qty-rejected_qty-inprocess_loss_qty) as max_qty,year from tran_dc_stock 
 		group by det_dc_id ) temp on tdd.id = temp.det_dc_id where tdm.supplier_id = '$Supp_Id' and temp.max_qty>0 and temp.year='$_SESSION[current_year]' and mp.isdeleted=0 and tdd.isdeleted=0 order by tdd.part_id,tdm.dc_no");
 	
		$PreOPIds2 = $query->result_array();

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
		// $query = $this->db->query("SELECT sum(qty) as rec_qty FROM `tran_partsrcir_details` WHERE dc_det_id='$id' ");
		$query = $this->db->query("SELECT sum(qty) as rec_qty,sum(inprocess_loss_qty) as loss_qty FROM `tran_partsrcir_details` WHERE dc_det_id='$id' and isdeleted=0");
		 $data = $query->row_array();
		 return $data;
	}
	public function getSchudaleIdByDate($oaId,$Date)
	{
		 $query = $this->db->query("SELECT sch.id,pp.id as prod_plan_id FROM `tran_schedule` sch INNER JOIN tran_prod_planning pp on pp.schedule_id=sch.id WHERE sch.oa2_id='$oaId' and month(sch.to_date)=month('$Date') and year(sch.to_date)=year('$Date')");
		 $data = $query->row_array();
		 //echo "<br>". $this->db->last_query(); 
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
	 $query = $this->db->query("SELECT * from tran_dpr_quality_checks where dpr_id= '$id' and isdeleted = 0 order by reading,qc_id");
	 $data = $query->result_array();
	// echo "<br>". $this->db->last_query(); 
	 return $data;

	}
	public function getQualityChecksbyId($id)
	{
	 $query = $this->db->query("SELECT id ,name,qc_type FROM mast_quality_checks where id=$id order by id asc");
	 $data = $query->row_array();
	 return $data;

	}
	public function getDprRecByDate($date){
	    //	$query = $this->db->query("select * from tran_dpr where dpr_date like '$date%' and qty>0 and branch_id='$_SESSION[branch_id]'");
	    $query = $this->db->query("select * from tran_dpr where dpr_date like '$date%' and branch_id='$_SESSION[branch_id]' and isdeleted=0");
				$data  = $query->result_array();
			//	echo $this->db->last_query();die;	
				return $data;
	}
	public function getDprbyDate($date,$flag)
	{
	    	$branch_id = $_SESSION[branch_id];
     	$data = [];
        if($date == '1970-01'){
            $date='';
        }
		if(!empty($date))
		{
			if($flag == 'all')
			{
			  
				$query = $this->db->query("select dpr.* from tran_dpr dpr inner join mast_operation mo where dpr.dpr_date like '$date%' and dpr.operation_id!='47' and dpr.isdeleted=0 and dpr.branch_id='$branch_id' and mo.qc_requiredfor_dpr=1 and mo.isdeleted=0 order by dpr_date desc,id desc");
				$data  = $query->result_array();
				//echo $this->db->last_query();die;
				
				return $data;
			}else{
				
			//	$query = $this->db->query("select * from tran_dpr where isnull(qc_checked_by) and dpr_date like '$date%' and operation_id!='47' and isdeleted=0 and branch_id='$branch_id' order by dpr_date desc,id desc");
				$query = $this->db->query("select dpr.* from tran_dpr dpr inner join mast_operation mo on dpr.operation_id=mo.id where isnull(qc_checked_by) and dpr_date like '$date%' and operation_id!='47' and dpr.isdeleted=0 and branch_id='$branch_id' and mo.qc_requiredfor_dpr=1 and mo.isdeleted=0 order by dpr_date desc,id desc;");
			
			
				$data  = $query->result_array();
			//	echo $this->db->last_query();die;
				return $data;
			}
		}else{
		    	if($flag == 'all')
			{
			  
				//$query = $this->db->query("select * from tran_dpr where operation_id!='47' and isdeleted=0 and branch_id='$branch_id' order by dpr_date desc,id desc");
				$query = $this->db->query("select dpr.* from tran_dpr dpr inner join mast_operation mo where dpr.operation_id!='47' and dpr.isdeleted=0 and dpr.branch_id='$branch_id' and mo.qc_requiredfor_dpr=1 and mo.isdeleted=0 order by dpr_date desc,id desc");
			
				$data  = $query->result_array();
				//echo $this->db->last_query();die;
				return $data;
			}else{
				
				$query = $this->db->query("select dpr.* from tran_dpr dpr inner join mast_operation mo on dpr.operation_id=mo.id where isnull(qc_checked_by) and operation_id!='47' and dpr.isdeleted=0 and branch_id='$branch_id' and mo.qc_requiredfor_dpr=1 and mo.isdeleted=0 order by dpr_date desc,id desc;");
				$data  = $query->result_array();
			//	echo $this->db->last_query();die;
				return $data;
			}
		}
//	echo $this->db->last_query();die;
	}
	
     public function getPartsrcirMast($date,$flag)
	{
	   $branch_id = $_SESSION['branch_id'];
	
		$data = [];
          if($date == '1970-01'){
            $date='';
        }           
		if(!empty($date))
		{
		    $seldate=date('Y-m',strtotime($date));
			if($flag == 'all')
			{
			/*	$query = $this->db->query("SELECT DISTINCTROW tran_partsrcir_mast.* from tran_partsrcir_mast 
				inner join tran_partsrcir_details on tran_partsrcir_details.mast_partsrcir_id=tran_partsrcir_mast.id 
				where tran_partsrcir_mast.challan_no != 'supl_pmovement' and tran_partsrcir_mast.challan_no != 'p_movement' and date like '$date%' and tran_partsrcir_mast.isdeleted=0 and tran_partsrcir_details.tran_partspo_det_id!=0 and tran_partsrcir_mast.branch_id='$branch_id' 
				order by date desc,id desc");*/
			
				$query = $this->db->query("SELECT tran_partsrcir_mast.id as mast_id,tran_partsrcir_mast.`supplier_id`, tran_partsrcir_mast.`date`, tran_partsrcir_mast.`challan_no`, tran_partsrcir_mast.`challan_date`,tran_partsrcir_details.* from tran_partsrcir_details 
				inner join tran_partsrcir_mast on tran_partsrcir_details.mast_partsrcir_id=tran_partsrcir_mast.id 
				where tran_partsrcir_details.isdeleted=0 and tran_partsrcir_details.tran_partspo_det_id!=0 and tran_partsrcir_mast.branch_id='$branch_id' and tran_partsrcir_mast.date like '$seldate%' order by tran_partsrcir_details.id desc");
			
				$data  = $query->result_array();
				//	echo $this->db->last_query();
				return $data;
			}else{
				
				$query = $this->db->query("SELECT tran_partsrcir_details.* from tran_partsrcir_details inner join tran_partsrcir_mast on tran_partsrcir_details.mast_partsrcir_id=tran_partsrcir_mast.id where isnull(tran_partsrcir_details.qc_checked_by) and tran_partsrcir_details.isdeleted=0 and tran_partsrcir_details.tran_partspo_det_id!=0 and tran_partsrcir_mast.branch_id='$branch_id'  and tran_partsrcir_mast.date like '$seldate%' order by id desc");
				$data  = $query->result_array();
					//echo $this->db->last_query();
				return $data;
			}
		}else{
			if($flag == 'all')
			{
			  
				$query = $this->db->query("SELECT DISTINCTROW tran_partsrcir_mast.* from tran_partsrcir_mast inner join tran_partsrcir_details on tran_partsrcir_details.mast_partsrcir_id=tran_partsrcir_mast.id where tran_partsrcir_mast.challan_no != 'supl_pmovement' and tran_partsrcir_mast.challan_no != 'p_movement' and tran_partsrcir_mast.isdeleted=0 and tran_partsrcir_details.tran_partspo_det_id!=0 and tran_partsrcir_mast.branch_id='$branch_id' order by date desc,id desc limit 100");
				$data  = $query->result_array();
				//	echo $this->db->last_query();
				return $data;
				
			}else{
				
				//$query = $this->db->query("SELECT * from tran_partsrcir_details where isnull(qc_checked_by) and isdeleted=0 order by id desc");
				$query = $this->db->query("SELECT  tpd.* from tran_partsrcir_details tpd inner join tran_partsrcir_mast tpm on tpm.id = tpd.mast_partsrcir_id where isnull(tpd.qc_checked_by) and tpd.qty>0 and tpd.isdeleted=0 and tpm.challan_no != 'supl_pmovement' and tpm.challan_no != 'p_movement' and tpm.isdeleted=0 and tpd.tran_partspo_det_id!=0 and tpm.branch_id='$branch_id' order by tpd.id desc");
			
				$data  = $query->result_array();
				//	echo $this->db->last_query();
				return $data;
			}
		}
	
		 
	}
	public function getPartsrcirDetail($id)
	{
		$query = $this->db->query("SELECT * from tran_partsrcir_details where mast_partsrcir_id = '$id' ");
		$data  = $query->result_array();
		return $data;
		 
	}
		public function getPartsrcirDetailForPendingQC($id)
	{
		$query = $this->db->query("SELECT tran_partsrcir_details.* from tran_partsrcir_details inner join tran_partsrcir_mast on tran_partsrcir_mast.id = tran_partsrcir_details.mast_partsrcir_id where mast_partsrcir_id = '$id' and tran_partsrcir_mast.challan_no != 'supl_pmovement' order by id desc");
		$data  = $query->result_array();
		//echo $this->db->last_query();die;
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
	 $query = $this->db->query("SELECT * from tran_partsrcir_quality_checks where det_partsrcir_id= '$id' and isdeleted = 0  and year='$_SESSION[current_year]'");
	 $data = $query->result_array();
	 return $data;

	}
	public function getRMMovement()
	{
	 $query = $this->db->query("SELECT `id`, `rm_id`, `qty`, `from_branch_id`, `to_branch_id`, `date` FROM `tran_rm_movement` order by id desc");
	 $data = $query->result_array();
	 return $data;

	}
   public function getRMMovementbyID($id)
	{
	 $query = $this->db->query("SELECT `id`, `rm_id`, `qty`, `from_branch_id`, `to_branch_id`, `date` FROM `tran_rm_movement` where id='$id' order by id desc");
	 $data = $query->row_array();
	 return $data;

	}
	
	public function getMovementRMStock($rm_id)
	{
		$branch_id = $_SESSION[branch_id];
	    $query1 = $this->db->query("SELECT sum(received_qty - rejected_qty - issue_qty) as stock from tran_rmrcir_stock where rm_id='$rm_id' and branch_id = '$branch_id'");  //AND year = '$_SESSION[current_year]'
        $data = $query1->row_array();
   // echo $this->db->last_query();
        return $data;
	}
	public function getMoveOperationByPart($id)
	{
	 $query = $this->db->query("SELECT mo.id,mo.Name,rpo.sequence_no from rel_part_operation rpo, mast_operation mo where rpo.part_id = $id and rpo.op_id=mo.id and rpo.isdeleted=0 order by rpo.sequence_no ");
	 $data = $query->result_array();
	 //echo $this->db->last_query();
	 return $data;

	}
    public function getPartsMovement()
	{
	 $query = $this->db->query("SELECT `id`, `part_id`, `op_id`, `qty`, `from_branch_id`, `to_branch_id`, `date` FROM `tran_parts_movement` where  year = '$_SESSION[current_year]' order by id desc");
	 $data = $query->result_array();
	 return $data;

	}
	public function getPartsSuplMovement()
	{
	 /*	 $query = $this->db->query("SELECT tpm.id as rcir_id,tpd.`part_id`,tpd.op_id as from_operation,tpd.qty,tdm.id as dc_id,tdc.op_id as for_operation,tdm.supplier_id as to_supplier,tpm.supplier_id as from_supplier,tpm.challan_date 
	 FROM tran_partsrcir_details tpd 
	 inner join tran_partsrcir_mast tpm on tpd.mast_partsrcir_id=tpm.id 
	 inner join tran_dc_details tdc on tpd.id=tdc.supl_movement_id 
	 inner join tran_dc_mast tdm on tdc.mast_dc_id=tdm.id 
	 where tpd.qc_remarks='supl_pmovement' and tpd.qc_checked_by='999999' and tdc.remarks='supl_pmovement' and tpd.isdeleted=0 and tdc.isdeleted=0 and tpd.year='$_SESSION[current_year]' order by tpm.id,tpd.id");
	 */
	 $query = $this->db->query("SELECT `id`, `part_id`, `tran_date`, `rcir_op_id`, `dc_op_id`, `rcir_id`, `dc_id`, `rcir_supl_id`, `dc_supl_id`, `rcir_qty`, `dc_qty`, `branch_id`, `year`, `created_by`, `created_on`, `updated_by`, `updated_on` FROM `tran_supplier_movement` WHERE year='$_SESSION[current_year]'");
	 $data = $query->result_array();

     //  echo $this->db->last_query();
       	 return $data;
	}
	public function getMoveRateDetails()
	{
	 $query = $this->db->query("SELECT  tppd.`part_id`, tppd.`op_id`, tppd.`qty` FROM `tran_partspo_details` tppd INNER JOIN tran_partspo_mast tppm ON tppm.id=tppd.mast_partspo_id WHERE tppd.part_id='$_POST[Part_Id]' and tppd.op_id='$_POST[Op_Id]' and tppd.isdeleted=0 ORDER BY tppd.id desc LIMIT 1");
	 $data = $query->row_array();
	// echo "************".$this->db->last_query();die;
	 return $data;

	}
	public function getPartOperationStock($partId,$op_id)
	{
		 $branch_id     =$_SESSION['branch_id'];
    	 $query = $this->db->query("SELECT temp.det_rmrcir_id,mprd.id,mprd.id as mast_id, mprd.mast_partsrcir_id as mast_partsrcir_id,mpro.date,'partrcir' as doc,temp.op_id as op_id,temp.max_qty FROM tran_partsrcir_details mprd INNER JOIN tran_partsrcir_mast mpro on mpro.id = mprd.mast_partsrcir_id inner join (select group_concat(det_rmrcir_id SEPARATOR ',') as det_rmrcir_id,det_partsrcir_id,sum(received_qty-issue_qty-inprocess_loss_qty-rejected_qty) as max_qty,op_id from tran_partsrcir_stock where part_id='$partId' and op_id='$op_id' and branch_id ='$branch_id' and year = '$_SESSION[current_year]' group by det_partsrcir_id) temp on temp.det_partsrcir_id= mprd.id where temp.max_qty >0 
    	 union all SELECT temp.det_rmrcir_id,tran_dpr_stock.id,tran_dpr_stock.mast_dpr_id as mast_id,'1' as mast_partsrcir_id,tran_dpr.dpr_date as date, 'dpr' as doc,tran_dpr.operation_id as op_id ,temp.max_qty from tran_dpr_stock INNER JOIN tran_dpr on tran_dpr.id = tran_dpr_stock.mast_dpr_id inner join (select group_concat(det_rmrcir_id SEPARATOR ',') as det_rmrcir_id,mast_dpr_id,sum(received_qty-issue_qty-inprocess_loss_qty-rejected_qty) as max_qty from tran_dpr_stock where part_id='$partId' and operation_id='$op_id' and year = '$_SESSION[current_year]' and branch_id ='$branch_id' group by mast_dpr_id) temp on temp.mast_dpr_id= tran_dpr.id where temp.max_qty >0 GROUP BY tran_dpr_stock.mast_dpr_id order by date");
         $data = $query->result_array();
    //	 echo $this->db->last_query();die;
    	 return $data;
	}
	//new additionon 21/04/2023 for stock booking while schedule  planning
	public function getPartOperationStockNoBranch($partId,$op_id)
	{
	    
	    if($op_id==47)
	        {
	               	   //	$query = $this->db->query("select sum(received_qty-issue_qty-inprocess_loss_qty-rejected_qty) as max_qty from tran_dpr_stock where part_id = '$partId' and operation_id ='47' and year = '$_SESSION[current_year]' 
                    //       union all select sum(received_qty-issue_qty-inprocess_loss_qty-rejected_qty) as max_qty from tran_partsrcir_stock where part_id='$partId' and op_id='47' and year = '$_SESSION[current_year]' and (received_qty+issue_qty+inprocess_loss_qty+rejected_qty)!=0"); 
     
	            
$query = $this->db->query("SELECT mprd.id as det_id, mprd.mast_partsrcir_id as mast_id,mpro.date,'partrcir' as doc,mprd.op_id as op_id,temp.max_qty FROM tran_partsrcir_details mprd INNER JOIN tran_partsrcir_mast mpro on mpro.id = mprd.mast_partsrcir_id inner join (select det_partsrcir_id,sum(received_qty-issue_qty-inprocess_loss_qty-rejected_qty) as max_qty from tran_partsrcir_stock where part_id='$partId' and op_id='$op_id' and year='$_SESSION[current_year]'  group by det_partsrcir_id) temp on temp.det_partsrcir_id= mprd.id where temp.max_qty !=0 
		        union all SELECT tran_dpr_stock.id as det_id,tran_dpr_stock.mast_dpr_id as mast_id,tran_dpr.dpr_date as date, 'dpr' as doc,tran_dpr.operation_id as op_id ,temp.max_qty from tran_dpr_stock INNER JOIN tran_dpr on tran_dpr.id = tran_dpr_stock.mast_dpr_id inner join (select mast_dpr_id,sum(received_qty-issue_qty-inprocess_loss_qty-rejected_qty) as max_qty from tran_dpr_stock where part_id='$partId' and operation_id='$op_id' and year = '$_SESSION[current_year]'   group by mast_dpr_id) temp on temp.mast_dpr_id= tran_dpr.id where temp.max_qty !=0 
		        GROUP BY tran_dpr_stock.mast_dpr_id order by date");
	        }
	    else
	    {
	       	   //	$query = $this->db->query("select sum(received_qty-issue_qty-inprocess_loss_qty-rejected_qty) as max_qty from tran_dpr_stock where part_id = '$partId' and operation_id !='47' and year = '$_SESSION[current_year]' 
            //               union all select sum(received_qty-issue_qty-inprocess_loss_qty-rejected_qty) as max_qty from tran_partsrcir_stock where part_id='$partId' and op_id != '47' and year = '$_SESSION[current_year]' and (received_qty+issue_qty+inprocess_loss_qty+rejected_qty)!=0"); 
     
		  $query = $this->db->query("SELECT mprd.id as det_id, mprd.mast_partsrcir_id as mast_id,mpro.date,'partrcir' as doc,mprd.op_id as op_id,temp.max_qty FROM tran_partsrcir_details mprd INNER JOIN tran_partsrcir_mast mpro on mpro.id = mprd.mast_partsrcir_id inner join (select det_partsrcir_id,sum(received_qty-issue_qty-inprocess_loss_qty-rejected_qty) as max_qty from tran_partsrcir_stock where part_id='$partId' and op_id!='47' and year='$_SESSION[current_year]' and det_partsrcir_id!=0 group by det_partsrcir_id) temp on temp.det_partsrcir_id= mprd.id where temp.max_qty !=0 
		        union all SELECT mprd.id as det_id, mprd.mast_dc_id as mast_id,mpro.date,'dc' as doc,mprd.op_id as op_id,temp.max_qty FROM tran_dc_details mprd INNER JOIN tran_dc_mast mpro on mpro.id = mprd.mast_dc_id inner join (select det_dc_id,sum(-received_qty+issue_qty-inprocess_loss_qty-rejected_qty) as max_qty from tran_dc_stock where part_id='$partId' and op_id!='47' and year='$_SESSION[current_year]'  group by det_dc_id) temp on temp.det_dc_id= mprd.id where temp.max_qty !=0 
		        union all SELECT tran_dpr_stock.id as det_id,tran_dpr_stock.mast_dpr_id as mast_id,tran_dpr.dpr_date as date, 'dpr' as doc,tran_dpr.operation_id as op_id ,temp.max_qty from tran_dpr_stock INNER JOIN tran_dpr on tran_dpr.id = tran_dpr_stock.mast_dpr_id inner join (select mast_dpr_id,sum(received_qty-issue_qty-inprocess_loss_qty-rejected_qty) as max_qty from tran_dpr_stock where part_id='$partId' and operation_id!='47' and year = '$_SESSION[current_year]'   group by mast_dpr_id) temp on temp.mast_dpr_id= tran_dpr.id where temp.max_qty !=0 
		        GROUP BY tran_dpr_stock.mast_dpr_id order by date");
	    }
         $data = $query->result_array();
    //	echo "  ***********  ";
	//echo $this->db->last_query();
    		$totalStock = 0;
		if(!empty($data))
		{
			foreach ($data as $key => $value) {
				$totalStock += $value['max_qty'];
			}
		}
		return $totalStock;
    	 //return $data[0]['max_qty'];

	}
		public function getBookedPartforInvoice($prodplanID)
	{
	    
		$query = $this->db->query("SELECT mprd.id,mprd.id as mast_id, mprd.mast_partsrcir_id as mast_partsrcir_id,mpro.date,'partrcir' as doc,mprd.op_id as op_id,temp.max_qty FROM tran_partsrcir_details mprd INNER JOIN tran_partsrcir_mast mpro on mpro.id = mprd.mast_partsrcir_id inner join (select det_partsrcir_id,booked_qty as max_qty from tran_partsrcir_stock where booked_doc_type='prod_plan' and booked_doc_id='$prodplanID' and op_id='47'  group by det_partsrcir_id) temp on temp.det_partsrcir_id= mprd.id where temp.max_qty >0 union all SELECT tran_dpr_stock.id,tran_dpr_stock.mast_dpr_id as mast_id,'1' as mast_partsrcir_id,tran_dpr.dpr_date as date, 'dpr' as doc,tran_dpr.operation_id as op_id ,temp.max_qty from tran_dpr_stock INNER JOIN tran_dpr on tran_dpr.id = tran_dpr_stock.mast_dpr_id inner join (select mast_dpr_id,booked_qty as max_qty from tran_dpr_stock where  booked_doc_type='prod_plan' and booked_doc_id='$prodplanID' and operation_id='47' and year = '$_SESSION[current_year]'  group by mast_dpr_id) temp on temp.mast_dpr_id= tran_dpr.id where temp.max_qty >0 GROUP BY tran_dpr_stock.mast_dpr_id order by date");
	    $data = $query->result_array();
    	// echo $this->db->last_query();die;
    	 return $data;

	}
// end of addition
	public function getRecQtyInRCIRStock($tran_rmpo_det_id)
	{
	 $query = $this->db->query("SELECT sum(received_qty) as received_qty FROM `tran_rmrcir_stock` WHERE tran_rmpo_det_id='$tran_rmpo_det_id' ");
     $data = $query->row_array();
	return $data;

	}
	public function getPOStatusInRequ($rmid)
	{
	 $query = $this->db->query("SELECT open_status from `tran_po_details` tpd where open_status = '1' and rm_id = '$rmid' and isdeleted = 0");
     $data = $query->row_array();
	return $data;

	}
	
	public function getRMOB()
	{
	    $branch_id     =$_SESSION['branch_id'];
		$year          =$_SESSION['current_year'];
    	 $query = $this->db->query("SELECT if(isnull(pob.ob),0,pob.ob) as ob,pob.id as obid, rm.rm_id, rm.name FROM mast_rm rm left join (select id,rm_id,received_qty as ob from tran_rmrcir_stock WHERE year = '$year' and received_doc_type='O.B.' and branch_id ='$branch_id') pob on pob.rm_id = rm.rm_id where rm.isdeleted=0 order by rm.rm_id desc");
    	 $data = $query->result_array();
    //	 echo $this->db->last_query(); die;
    	 return $data;

	}
	
	public function getRMOBById($id)
	{
		$branch_id     =$_SESSION['branch_id'];
		$year          =$_SESSION['current_year'];
	 $query = $this->db->query("SELECT `id`, `rm_id`, `doc_year`, `received_qty` FROM `tran_rmrcir_stock` where id = '$id' and branch_id ='$branch_id' and year='$year'");
	 $data = $query->row_array();
	 return $data;

	}
	public function checkRMYearInStock($rm_id,$year)
	{
	 $branch_id     =$_SESSION['branch_id'];
	 $query = $this->db->query("SELECT `id` FROM `tran_rmrcir_stock` where rm_id = '$rm_id' and doc_year='$year' and received_doc_type ='O.B' and branch_id ='$branch_id'");
	 $data = $query->num_rows();
	 return $data;

	}
	
	public function getYearByBranchBy($branchName)
	{
	 $query = $this->db->query("SELECT DISTINCT(current_year) as current_year FROM `mast_branch` WHERE `name` LIKE '$branchName' order by current_year desc");
	 $data = $query->result_array();
	 //echo $this->db->last_query(); die;
	 return $data;

	}
	public function getRMStockDetails()
	{
	   	   $fd = date('Y-m-d',strtotime($_POST['from_date']));
	   $td = date('Y-m-d',strtotime($_POST['to_date']));
	   $branch_id =$_POST['branch_id'];
	   
	   $rm_id = $_POST['rm_id'];
	   $checkrm='';
	   if($rm_id){
	       $checkrm=" and a.rm_id=$rm_id";
	   }
	  
	  $query = $this->db->query("select a.branch_id,a.rm_id,a.tran_date,a.issue_qty,a.issue_doc_type,a.issue_doc_id,a.rejected_qty,a.rejected_doc_type,a.rejected_doc_id,a.received_qty,a.received_doc_type,a.received_doc_id,a.booked_qty,a.booked_doc_type,a.booked_doc_id,c.challan_no,c.challan_date,c.date,c.supplier_id from tran_rmrcir_stock a 
	  INNER JOIN tran_rmrcir_details b ON b.id=a.det_rmrcir_id 
	  INNER JOIN tran_rmrcir_mast c ON b.mast_rmrcir_id=c.id WHERE a.tran_date BETWEEN '$fd' and '$td' and a.branch_id ='$branch_id' $checkrm and a.booked_qty=0 ORDER BY a.det_rmrcir_id");
	  
	 $data = $query->result_array();
	 //echo $this->db->last_query();
	 return $data;

	}
	 public function getRMStockSummary($todate,$rmid){
   //	  $query = $this->db->query("SELECT temp.rm_id,trms.branch_id,temp.qty as qty ,temp.amount as amount from tran_rmrcir_stock trms 
	 // inner join (select trs.branch_id,trs.rm_id,sum(trs.received_qty-trs.issue_qty-trs.rejected_qty)as qty,round((sum(trs.received_qty-trs.issue_qty-trs.rejected_qty)),2) as amount FROM `tran_rmrcir_stock` trs inner join tran_rmrcir_details trd on trs.det_rmrcir_id=trd.id inner join tran_rmrcir_mast trm on trm.id=trs.mast_rmrcir_id where trs.year='$_SESSION[current_year]' and trs.tran_date<='$todate' and trs.rm_id=$rmid and trm.isdeleted=0 group by trs.branch_id) temp on temp.branch_id = trms.branch_id where trms.year='$_SESSION[current_year]' and trms.rm_id=$rmid group by trms.branch_id order by trms.branch_id");

	  $query = $this->db->query("SELECT temp.rm_id,trms.branch_id,temp.qty as qty ,temp.amount as amount from tran_rmrcir_stock trms 
	  inner join (select trs.branch_id,trs.rm_id,sum(trs.received_qty-trs.issue_qty-trs.rejected_qty)as qty,0 as amount FROM `tran_rmrcir_stock` trs inner join tran_rmrcir_details trd on trs.det_rmrcir_id=trd.id inner join tran_rmrcir_mast trm on trm.id=trs.mast_rmrcir_id where  trs.tran_date<='$todate' and trs.rm_id=$rmid and trm.isdeleted=0 group by trs.branch_id) temp on temp.branch_id = trms.branch_id where  trms.rm_id=$rmid group by trms.branch_id order by trms.branch_id");
      //round((sum(trs.received_qty-trs.issue_qty-trs.rejected_qty)),2) as amount
	 
	 $data = $query->result_array();
//	 echo "<br>". $this->db->last_query(); 
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
	    
	     if($opID){
	        $query = $this->db->query("SELECT dpr.operator_id,mopr.fname,mopr.lanme,dpr.dpr_date,dpr.part_id,dpr.operation_id,dpr.work_hours,dpr.qty,round(dpr.qty/dpr.work_hours,0) as operator_qty_per_hour ,rpo.nosperhour as ideal_qty,round ( 100*round(dpr.qty/dpr.work_hours,0) /rpo.nosperhour,02) as performance_percentage ,mp.partno,mp.name as part_name,mop.Name as operation_name FROM `tran_dpr` as dpr inner join rel_part_operation rpo on rpo.part_id = dpr.part_id and rpo.op_id = dpr.operation_id INNER JOIN mast_part mp on rpo.part_id = mp.part_id INNER JOIN mast_operation mop on rpo.op_id = mop.id inner join mast_users mopr on dpr.operator_id=mopr.id where qty>0 and $between AND operator_id='$opID' and year='$_SESSION[current_year]'  ORDER BY dpr_date,part_id,operation_id");
	 
	     }else{
	         $query = $this->db->query("SELECT dpr.operator_id,mopr.fname,mopr.lanme,dpr.dpr_date,dpr.part_id,dpr.operation_id,dpr.work_hours,dpr.qty,round(dpr.qty/dpr.work_hours,0) as operator_qty_per_hour ,rpo.nosperhour as ideal_qty,round ( 100*round(dpr.qty/dpr.work_hours,0) /rpo.nosperhour,02) as performance_percentage ,mp.partno,mp.name as part_name,mop.Name as operation_name FROM `tran_dpr` as dpr inner join rel_part_operation rpo on rpo.part_id = dpr.part_id and rpo.op_id = dpr.operation_id INNER JOIN mast_part mp on rpo.part_id = mp.part_id INNER JOIN mast_operation mop on rpo.op_id = mop.id inner join mast_users mopr on dpr.operator_id=mopr.id where qty>0 and year='$_SESSION[current_year]' and $between  ORDER BY dpr_date,part_id,operation_id");
	
	     }

		 	  $data = $query->result_array();
		   //echo $this->db->last_query();die;
	      return $data;
    
	}
		public function getPerformDataPartWiseSummary($opID,$frm_date,$to_date){
		$between=1;
		if($frm_date!="" && $to_date!=""){
		 	$between =" dpr_date BETWEEN '$frm_date' AND '$to_date' ";
	     }elseif($frm_date!="" && $to_date==NULL){
             $between=" dpr_date >='$frm_date' ";
	     }elseif($frm_date=="" && $to_date!=NULL){
             $between=" dpr_date <='$to_date' ";
	     }
	    
	     if($opID){
	        $query = $this->db->query("SELECT dpr.operator_id,mopr.fname,mopr.lanme,dpr.dpr_date,dpr.part_id,dpr.operation_id,sum(dpr.work_hours) as work_hours,sum(dpr.qty) as qty,round(sum(dpr.qty)/sum(dpr.work_hours),0) as operator_qty_per_hour ,rpo.nosperhour as ideal_qty,round ( 100*round(sum(dpr.qty)/sum(dpr.work_hours),0) /rpo.nosperhour,02) as performance_percentage ,mp.partno,mp.name as part_name,mop.Name as operation_name FROM `tran_dpr` as dpr inner join rel_part_operation rpo on rpo.part_id = dpr.part_id and rpo.op_id = dpr.operation_id INNER JOIN mast_part mp on rpo.part_id = mp.part_id INNER JOIN mast_operation mop on rpo.op_id = mop.id inner join mast_users mopr on dpr.operator_id=mopr.id where qty>0 and $between AND operator_id='$opID' and year='$_SESSION[current_year]' group by part_id,operation_id ORDER BY dpr_date,part_id,operation_id");
	 
	     }else{
	         $query = $this->db->query("SELECT dpr.operator_id,mopr.fname,mopr.lanme,dpr.dpr_date,dpr.part_id,dpr.operation_id,sum(dpr.work_hours) as work_hours,sum(dpr.qty) as qty,round(sum(dpr.qty)/sum(dpr.work_hours),0) as operator_qty_per_hour ,rpo.nosperhour as ideal_qty,round ( 100*round(sum(dpr.qty)/sum(dpr.work_hours),0) /rpo.nosperhour,02) as performance_percentage ,mp.partno,mp.name as part_name,mop.Name as operation_name FROM `tran_dpr` as dpr inner join rel_part_operation rpo on rpo.part_id = dpr.part_id and rpo.op_id = dpr.operation_id INNER JOIN mast_part mp on rpo.part_id = mp.part_id INNER JOIN mast_operation mop on rpo.op_id = mop.id inner join mast_users mopr on dpr.operator_id=mopr.id where qty>0 and year='$_SESSION[current_year]' and $between group by operator_id,part_id,operation_id  ORDER BY dpr_date,operator_id,part_id,operation_id");
	
	     }

		 	  $data = $query->result_array();
		 // echo $this->db->last_query();
		   //die;
	      return $data;
    
	}
	public function getPerformDataOperatorSummary($opID,$frm_date,$to_date){
			 
		$between=1;
		if($frm_date!="" && $to_date!=""){
		 	$between =" dpr_date BETWEEN '$frm_date' AND '$to_date' ";
	     }elseif($frm_date!="" && $to_date==NULL){
             $between=" dpr_date >='$frm_date' ";
	     }elseif($frm_date=="" && $to_date!=NULL){
             $between=" dpr_date <='$to_date' ";
	     }
	    
	   if($opID){
	     	$query=$this->db->query("SELECT dpr.operator_id,mopr.fname,mopr.lanme,avg(temp.performance_percentage) as performance FROM `tran_dpr` as dpr inner join (SELECT dpr1.operator_id,round(100*round(sum(dpr1.qty)/sum(dpr1.work_hours),0) /rpo.nosperhour,02) as performance_percentage FROM `tran_dpr` as dpr1 inner join rel_part_operation rpo on rpo.part_id = dpr1.part_id and rpo.op_id = dpr1.operation_id where qty>0 and year='$_SESSION[current_year]' and operator_id='$opID' and $between group by operator_id) as temp on temp.operator_id=dpr.operator_id inner join mast_users mopr on dpr.operator_id=mopr.id where qty>0 and year='$_SESSION[current_year]' and dpr.operator_id='$opID' and $between group by dpr.operator_id ORDER BY dpr.operator_id");

	     }else{
	      $query=$this->db->query("SELECT dpr.operator_id,mopr.fname,mopr.lanme,avg(temp.performance_percentage) as performance FROM `tran_dpr` as dpr inner join (SELECT dpr1.operator_id,round(100*round(sum(dpr1.qty)/sum(dpr1.work_hours),0) /rpo.nosperhour,02) as performance_percentage FROM `tran_dpr` as dpr1 inner join rel_part_operation rpo on rpo.part_id = dpr1.part_id and rpo.op_id = dpr1.operation_id where qty>0 and year='$_SESSION[current_year]' and $between group by operator_id) as temp on temp.operator_id=dpr.operator_id inner join mast_users mopr on dpr.operator_id=mopr.id where qty>0 and year='$_SESSION[current_year]' and $between group by dpr.operator_id ORDER BY dpr.operator_id");
	     }
 
		 	  $data = $query->result_array();
		 	   // echo $this->db->last_query(); 
		
	      return $data;
    
	}
	public function getOperPerSummDashboard(){
			 
	    $date=date('Y-m');
	  	$between =" dpr_date like '$date%' ";
	      $query=$this->db->query("SELECT dpr.operator_id,mopr.fname,mopr.lanme,avg(temp.performance_percentage) as performance FROM `tran_dpr` as dpr inner join (SELECT dpr1.operator_id,round(100*round(sum(dpr1.qty)/sum(dpr1.work_hours),0) /rpo.nosperhour,02) as performance_percentage FROM `tran_dpr` as dpr1 inner join rel_part_operation rpo on rpo.part_id = dpr1.part_id and rpo.op_id = dpr1.operation_id where qty>0 and year='$_SESSION[current_year]' and $between group by operator_id) as temp on temp.operator_id=dpr.operator_id inner join mast_users mopr on dpr.operator_id=mopr.id where qty>0 and year='$_SESSION[current_year]' and $between group by operator_id ORDER BY operator_id");
	      $data = $query->result_array();
	       //echo $this->db->last_query(); 
	      return $data;
    
	}
	public function getPartsStockDetails()
	{
	   $fd = $_POST['from_date'];
	   $td = $_POST['to_date'];
       $branch_id     =$_SESSION['branch_id'];
	   $between='WHERE c.date = date(NOW())';
		if($fd!="" && $td!=""){
		 	$between =" WHERE c.date BETWEEN '$fd' AND '$td' ";
	     }elseif($fd!="" && $td==NULL){
             $between=" WHERE c.date >='$fd' ";
	     }elseif($fd=="" && $td!=NULL){
             $between=" WHERE c.date <='$td' ";
	     }

	 $query = $this->db->query("select a.part_id,a.issue_qty,a.issue_doc_type,a.issue_doc_id,a.received_qty,a.received_doc_type,a.received_doc_id,a.booked_qty,a.booked_doc_type,a.booked_doc_id,c.challan_no,c.challan_date,c.date,c.supplier_id from tran_partsrcir_stock a INNER JOIN tran_partsrcir_details b ON b.id=a.det_partsrcir_id INNER JOIN tran_partsrcir_mast c ON b.mast_partsrcir_id=c.id $between and a.branch_id ='$branch_id' ORDER BY a.det_partsrcir_id");
	 $data = $query->result_array();
	 //echo $this->db->last_query(); die;
	 return $data;

	}
	
 	//get Company details
 	
	public function companyDetails(){
   	$query = $this->db->query("SELECT `id`, `name`, `address`, `email_id`, `contact_no`, `gst_no`, `state_code`, `tann_no`, `pan_no`, `bank_name`, `IFSCCode`, `short_name`, `bank_acno`, `defect_reg`, `tool_repair` FROM `mast_company`");
	 $data = $query->row_array();
	 return $data;
   }
   
   //get RelParts by part Id with Opening Bal from tran_partsrcir_stock table
   	public function getRelPartsbyIdOBal()
	{
		 $partId 		=$_POST['part_id'];
		 $year          =$_SESSION['current_year'];  
		 $branch_id     =$_SESSION['branch_id'];
		 $query = $this->db->query("SELECT rpo.id,rpo.part_id,rpo.op_id,rpo.nosperkg,rpo.nosperhour,rpo.tool_id1,rpo.tool_id2,mo.Name,if(isnull(pob.ob),0,pob.ob) as ob,pob.id as obid FROM rel_part_operation rpo 
		 inner join mast_operation mo on rpo.op_id=mo.id left join (select id,op_id,received_qty as ob from tran_partsrcir_stock WHERE part_id='$partId' and year = '$year' and received_doc_type='O.B.' and branch_id ='$branch_id') pob on pob.op_id = rpo.op_id where rpo.part_id='$partId' and rpo.isdeleted=0 order by rpo.sequence_no");
       // echo $this->db->last_query();
		 $data = $query->result_array();
		 return $data;

	}
	
    public function getPartsBySearchval($search)
   {  	     
       
     $query = $this->db->query("SELECT part_id,name,partno,prodfamily_id FROM `mast_part` where partno like '%$search%' OR name like '%$search%' and isdeleted=0 order by partno,name");
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
 	public function getPartOpQty()
	{
     $partId = $_POST['Part_Id'];
	 $opId = $_POST['Op_Id'];
	 $query = $this->db->query("SELECT `id`, `nosperkg` FROM rel_part_operation where part_id='$partId' and op_id='$opId' and isdeleted=0 order by sequence_no ");
	 $data = $query->row_array();
	 return $data;
	}

	public function getPartOpQty_new($partId,$opId)
	{
	 $query = $this->db->query("SELECT `id`, `nosperkg` FROM rel_part_operation where part_id='$partId' and op_id='$opId' and isdeleted=0 order by sequence_no ");
	 $data = $query->row_array();
	 return $data;
	}
    public function getDcRCIRDetails($dcid){
        $year= $_SESSION['current_year'];
		$query=$this->db->query("SELECT * FROM `tran_partsrcir_details` where dc_det_id='$dcid' and year='$year' and isdeleted=0");
		$data = $query->row_array();
	    return $data;
	}
	
	public function getDCDetailsStkAdj($detid){
	   $query = $this->db->query("select tdd.id,tdm.dc_no from tran_dc_details tdd inner join tran_dc_mast tdm on tdm.id = tdd.mast_dc_id where tdd.id = '$detid' and tdd.isdeleted=0");	
	    $data = $query->row_array();
	    return $data;
	}

	public function getPoDCDetails($poid){
        $query=$this->db->query("SELECT parts_po_det_id FROM `tran_dc_details` where parts_po_det_id='$poid' and isdeleted=0");
		$data = $query->row_array();
	    return $data;
	}
	public function getSuplSchedule($poid){
        $query=$this->db->query("SELECT tran_partspo_det_id FROM `tran_supplier_schedule` where tran_partspo_det_id='$poid' and isdeleted=0");
		$data = $query->row_array();
	    return $data;
	}
	
	public function getSchAvailableQty($partID,$custID){
	    $query=$this->db->query("SELECT (tod.qty-if(isnull(sum(tsh.scheduled_qty)),0,sum(tsh.scheduled_qty))) as available_qty FROM tran_oa_details tod LEFT JOIN tran_schedule tsh ON tod.id=tsh.oa2_id INNER JOIN tran_oa_mast tom on tom.id=tod.mast_oa_id where tod.part_id='$partID' and tom.customer_id='$custID' and if (isnull(tsh.isdeleted),1,tsh.isdeleted=0)");
		$data = $query->row_array();
	//	echo $this->db->last_query();die;
	    return $data;
	   }
   public function getSupplierProdPlanning(){  	//by Asharani
		$prodID=base64_decode($_GET['ID']);
		$query = $this->db->query("SELECT tpp.branch_id,tpp.part_id, tpp.schedule_id, tpp.date, tpp.planning_qty, tpp.prod_type,ms.name as supplier_name,mo.Name as op_name,tss.qty as Sqty,tss.id as suppSID,tss.to_date as SDate FROM tran_prod_planning tpp INNER JOIN tran_supplier_schedule tss on tpp.id=tss.prod_plan_id INNER JOIN mast_supplier ms on tss.supplier_id=ms.id INNER JOIN mast_operation mo on tpp.op_id=mo.id WHERE tpp.id=$prodID and tss.isdeleted=0");
		$data = $query->result_array();
		return $data;
	}

	public function getSSchRCIRDetails($id){   	//by Asharani
     $query = $this->db->query("SELECT tps.id as prcir_id,tps.qty as recQty,tps.inprocess_loss_qty,tpm.date  from tran_partsrcir_details tps INNER JOIN tran_partsrcir_mast tpm on tps.mast_partsrcir_id=tpm.id  where tps.supp_schedule_id =$id and tps.isdeleted=0");
	    $data = $query->result_array();
	    return $data;
	}

    public function getSchDCDetails($partID){    	//by Asharani  ,$rcirID,$dprID
     $query=$this->db->query("SELECT dc.id as dcid, dc.mast_dc_id, dc.part_id, dc.qty,dc.max_qty, dc.rcir_id, dc.op_id, dc.parts_po_det_id,dc.op_id,dcm.supplier_id,dcm.date FROM tran_dc_details dc INNER JOIN tran_dc_mast dcm on dc.mast_dc_id = dcm.id Where dc.part_id='$partID' and dc.isdeleted=0 order by dc.id asc");
    // echo $this->db->last_query();die;
	 $data = $query->result_array();
	 return $data;
    }

    public function getSchDcRCIRDetails($dcID){  //by Asharani
    	$query = $this->db->query("SELECT tps.id as prcir_id,tps.qty as recQty,tps.inprocess_loss_qty,tpm.date  from tran_partsrcir_details tps INNER JOIN tran_partsrcir_mast tpm on tps.mast_partsrcir_id=tpm.id  where tps.dc_det_id ='$dcID' and tps.isdeleted=0");
    	 // echo $this->db->last_query();die;
    	 $data = $query->result_array();
	 return $data;
    }
    
    public function getTranDPRbyPartID(){
       $pID = $_POST['Part_Id'];
	   $fd = $_POST['from_date'];
	   $td = $_POST['to_date'];
        $branch_id  =$_POST['branch_id'];
	   $between='WHERE c.dpr_date = date(NOW())';
		if($fd!="" && $td!=""){
		 	$between =" WHERE c.dpr_date BETWEEN '$fd' AND '$td' ";
	     }elseif($fd!="" && $td==NULL){
             $between=" WHERE c.dpr_date >='$fd' ";
	     }elseif($fd=="" && $td!=NULL){
             $between=" WHERE c.dpr_date <='$td' ";
	     }
	 $query = $this->db->query("select c.id as mast_id,a.operation_id,a.issue_qty,a.issue_doc_type,a.issue_doc_id,a.received_qty,a.received_doc_type,a.received_doc_id,
	 a.booked_qty,a.booked_doc_type,a.booked_doc_id,a.rejected_qty,a.rejected_doc_type,a.rejected_doc_id,a.inprocess_loss_qty,c.dpr_date,c.operator_id ,c.prod_plan_id ,tp.supplier_id
	 from tran_dpr_stock a 	 INNER JOIN  tran_dpr c ON c.id=a.mast_dpr_id  INNER JOIN tran_prod_planning tp ON c.prod_plan_id = tp.id
	 $between and a.branch_id ='$branch_id' and a.part_id='$pID' and a.isdeleted=0 and c.isdeleted=0 ORDER BY a.id");
	 $data = $query->result_array();
	 
	 return $data;
    }
    
 public function getPRCIRbyPartID(){
      $pID = $_POST['Part_Id'];
	  $fd = $_POST['from_date'];
	   $td = $_POST['to_date'];
       $branch_id    =$_POST['branch_id'];
	   $between='WHERE c.date = date(NOW())';
		if($fd!="" && $td!=""){
		 	$between =" WHERE c.date BETWEEN '$fd' AND '$td' ";
	     }elseif($fd!="" && $td==NULL){
             $between=" WHERE c.date >='$fd' ";
	     }elseif($fd=="" && $td!=NULL){
             $between=" WHERE c.date <='$td' ";
	     }

	 $query = $this->db->query("select b.id as mast_id,a.op_id,a.issue_qty,a.issue_doc_type,a.issue_doc_id,a.received_qty,a.received_doc_type,a.received_doc_id,a.booked_qty,
	 a.booked_doc_type,a.booked_doc_id,c.date,c.supplier_id 
	 from tran_partsrcir_stock a 
	 INNER JOIN tran_partsrcir_details b ON b.id=a.det_partsrcir_id 
	 INNER JOIN tran_partsrcir_mast c ON b.mast_partsrcir_id=c.id 
	 $between and a.branch_id ='$branch_id' and a.part_id='$pID'  and a.isdeleted=0 and b.isdeleted=0 and c.isdeleted=0 ORDER BY a.det_partsrcir_id");
	 $data = $query->result_array();
	 //echo $this->db->last_query(); die;
	 return $data;
    }
   public function getDCDetbyPartID(){
      $pID = $_POST['Part_Id'];
	  $fd = $_POST['from_date'];
	   $td = $_POST['to_date'];
       $branch_id  = $_POST['branch_id'];
	   $between='WHERE c.date = date(NOW())';
		if($fd!="" && $td!=""){
		 	$between =" WHERE c.date BETWEEN '$fd' AND '$td' ";
	     }elseif($fd!="" && $td==NULL){
             $between=" WHERE c.date >='$fd' ";
	     }elseif($fd=="" && $td!=NULL){
             $between=" WHERE c.date <='$td' ";
	     }


	 $query = $this->db->query("select b.id as mast_id,a.op_id,a.issue_qty,a.issue_doc_type,a.issue_doc_id,a.received_qty,a.received_doc_type,a.received_doc_id,a.booked_qty,
	 a.booked_doc_type,a.booked_doc_id,c.date,c.supplier_id 
	 from tran_dc_stock a 
	 INNER JOIN tran_dc_details b ON b.id=a.det_dc_id 
	 INNER JOIN tran_dc_mast c ON b.mast_dc_id=c.id 
	 $between and a.branch_id ='$branch_id' and a.part_id='$pID' and a.isdeleted=0 and b.isdeleted=0 ORDER BY a.det_dc_id");
	 $data = $query->result_array();
	 //echo $this->db->last_query(); die;
	 return $data;
    }
    
     public function getRMRCIRbyPartID($rmarray){
         
    $rmlist = implode(",",$rmarray);
    //echo $rmlist."<br>";
      $pID = $_POST['Part_Id'];
	  $fd = $_POST['from_date'];
	   $td = $_POST['to_date'];
       $branch_id  =$_POST['branch_id'];
	   $between='WHERE c.date = date(NOW())';
		if($fd!="" && $td!=""){
		 	$between =" WHERE c.date BETWEEN '$fd' AND '$td' ";
	     }elseif($fd!="" && $td==NULL){
             $between=" WHERE c.date >='$fd' ";
	     }elseif($fd=="" && $td!=NULL){
             $between=" WHERE c.date <='$td' ";
	     }


	 $query = $this->db->query("select b.id as mast_id,a.issue_qty,a.issue_doc_type,a.issue_doc_id,a.received_qty,a.received_doc_type,a.received_doc_id,a.booked_qty,
	 a.booked_doc_type,a.booked_doc_id,c.date,c.supplier_id,a.prod_plan_id 
	 from tran_rmrcir_stock a 
	 INNER JOIN tran_rmrcir_details b ON b.id=a.det_rmrcir_id 
	 INNER JOIN tran_rmrcir_mast c ON b.mast_rmrcir_id=c.id 
	 $between and a.branch_id ='$branch_id' and b.rm_id in('$rmlist') and a.isdeleted=0 and b.isdeleted=0 and c.isdeleted=0 ORDER BY a.det_rmrcir_id");
	 $data = $query->result_array();
	// echo $this->db->last_query(); die;
	 return $data;
    }
    
   	//new not added
	public function getTranInvMastbyId($id)
	{
		 $query = $this->db->query("SELECT `id`, `customer_id`, `date`, `invoice_no` FROM `tran_invoice_mast`  where id='$id' order by id desc");
		 $data = $query->row_array();
		 return $data;

	}
	//new not added
    public function getTranInvDetailsbyId($id)
	{
		 $query = $this->db->query("SELECT `id` as invdet_id, `mast_inv_id`, `schedule_id`, `part_id`, `prod_plan_id`, `oa_det_id`, `qty` FROM `tran_invoice_details` where mast_inv_id ='$id' and isdeleted=0 order by id desc");
		 $data = $query->result_array();
	//	 echo $this->db->last_query(); die;
		 return $data;

	}
	//added by Asharani 15-05-2023
	public function getQCByInvDetId($invdet_id){
	     $query = $this->db->query("SELECT * FROM `tran_invoice_pdr` where det_inv_id ='$invdet_id' order by quality_id");
		 $data = $query->result_array();
		 //echo $this->db->last_query(); 
		 return $data;
	}
	public function getIssueQtybyDprID($id){
	     $query = $this->db->query("SELECT sum(issue_qty) as issue_qty FROM `tran_dpr_stock` where mast_dpr_id ='$id'");
		 $data = $query->row_array();
		 return $data;
	}
	
	//added by Asharani 19-05-2023
	public function getUsedQty($id){
	     $query = $this->db->query("SELECT sum(issue_qty) as issue_qty FROM `tran_partsrcir_stock` where det_partsrcir_id ='$id'");
		 $data = $query->row_array();
		 return $data['issue_qty'];
	}
	
	//added by Asharani 23-05-2023	 for scrap stock report
    public function getScrapStockDet(){

	    $year     =$_SESSION['current_year'];
	    $between='WHERE c.date = date(NOW())';
	    
          if(!empty($_POST['schedule_from_date']) || !empty($_POST['schedule_to_date'])){
              
            $fromd      = $_POST['schedule_from_date'];
            if($fromd){  $fd 	= date("Y-m-d", strtotime($fromd)); }
            $tod        = $_POST['schedule_to_date'];
            if($tod){ $td 	= date("Y-m-d", strtotime($tod));}else{ $td = date("Y-m-d");  }
            
          
        	if($fd!="" && $td!=""){
        	 	$between =" WHERE c.date BETWEEN '$fd' AND '$td' ";
             }elseif($fd!="" && $td==NULL){
                 $between=" WHERE c.date >='$fd' ";
             }elseif($fd=="" && $td!=NULL){
                 $between=" WHERE c.date <='$td' ";
             }
          }
	  
	  $query =$this->db->query("SELECT rm_id,date,branch_id,type ,issue_qty,issue_doc_type,issue_doc_id,received_qty,received_doc_type,received_doc_id FROM scrap_stock c  $between and year='$year' order by date");
	  $data = $query->result_array();
	  //	echo $this->db->last_query(); 
	  return $data;
   }
   	//added by Asharani 23-06-2024	 for scrap stock report
    public function getScrapStockDetSummary(){
	 //   $year     =$_SESSION['current_year'];
	    
          if(!empty($_POST['schedule_to_date'])){
            $tod        = $_POST['schedule_to_date'];
            $fd = getMinDate();
            if($tod){ $td 	= date("Y-m-d", strtotime($tod));}else{ $td = date("Y-m-d");  }
               $between =" WHERE c.date BETWEEN '$fd' AND '$td' ";
        /*	if($fd!="" && $td!=""){
        	 	$between =" WHERE c.date BETWEEN '$fd' AND '$td' ";
             }elseif($fd!="" && $td==NULL){
                 $between=" WHERE c.date >='$fd' ";
             }elseif($fd=="" && $td!=NULL){
                 $between=" WHERE c.date <='$td' ";
             }*/
          }
	 // echo "SELECT branch_id,type ,sum(issue_qty) as issue_qty,sum(received_qty) as received_qty FROM scrap_stock c $between  group by branch_id,type";
	  //$query =$this->db->query("SELECT rm_id,date,branch_id,type ,sum(issue_qty) as issue_qty,issue_doc_type,issue_doc_id,sum(received_qty) as received_qty,received_doc_type,received_doc_id FROM scrap_stock c  $between and year='$year' group by rm_id,branch_id,type order by date");
	  $query =$this->db->query("SELECT branch_id,type ,sum(issue_qty) as issue_qty,sum(received_qty) as received_qty FROM scrap_stock c $between  group by branch_id,type");
	  $data = $query->result_array();
	 
	  return $data;
   }
  public function getScrapfromTranscrapInv(){
      
      $date=($_POST['date'])?date('Y-m',strtotime($_POST['date'])):date('Y-m');
      $query =$this->db->query("SELECT * from  tran_scrap_invoice where invoice_date like '$date%' and branch_id='$_SESSION[branch_id]'");
	  $data = $query->result_array(); 
	  //	echo $this->db->last_query();
	  		  return $data;
  } 
   
   public function getScrapData(){
       
            $date = $this->input->post('date');
            $invoice_no = $this->input->post('invoice_no');
            $branch_id= $this->input->post('branch_id');
            $type = $this->input->post('type');
            
        $query =$this->db->query("SELECT ss.id, ss.received_doc_id, ss.rm_id,ss.date,ss.type,if((isnull(temp.issue_qty)||temp.issue_qty=0 ),ss.received_qty, ss.received_qty-temp.issue_qty ) as scrap_qty FROM `scrap_stock`ss 
        LEFT join ( select issue_doc_id,sum(issue_qty) as issue_qty  from scrap_stock where issue_qty >0 and branch_id='$branch_id')temp on temp.issue_doc_id=ss.received_doc_id where ss.received_qty >0 and ss.branch_id='$branch_id'");
	    $data = $query->result_array();
	    //	echo $this->db->last_query(); 
	     return $data;
   }
   public function getTranScrapInv($id){
         $query =$this->db->query("SELECT * from tran_scrap_invoice where id='$id'");
         $data = $query->row_array();
         // echo $this->db->last_query(); 
         	 return $data;
   }
  public function getScrapDataforInvoice(){
      
        $branch_id= $this->input->post('branch_id');
        $type = $this->input->post('type');
        $date=date('Y-m-d',strtotime($this->input->post('date')));
        // $query =$this->db->query("SELECT rm_id,round(sum(received_qty-issue_qty-rejected_qty-inprocess_loss_qty),3) as max_qty from scrap_stock where year='$_SESSION[current_year]' and type='$type' and branch_id='$branch_id' group by rm_id");
        // $data = $query->result_array();
         $query =$this->db->query("SELECT round(sum(received_qty-issue_qty-rejected_qty-inprocess_loss_qty),3) as max_qty from scrap_stock where year='$_SESSION[current_year]'  and date<='$date' and type='$type' and branch_id='$branch_id'");
        $data = $query->row_array();
       // echo $this->db->last_query(); 
        return $data['max_qty'];
  
   }
	public function getRMRCIRDetailsStock($id)              //created on 31/05/2023  - by Asharani
	{
	// $query = $this->db->query("select a.id,a.rm_id,a.issue_qty,a.issue_doc_type,a.issue_doc_id,a.received_qty,a.received_doc_type,a.received_doc_id,a.booked_qty,a.booked_doc_type,a.booked_doc_id,a.rejected_qty,a.rejected_doc_type,a.rejected_doc_id,c.challan_no,c.challan_date,c.date,c.supplier_id,a.det_rmrcir_id,a.mast_rmrcir_id,a.tran_rmpo_det_id from tran_rmrcir_stock a INNER JOIN tran_rmrcir_details b ON b.id=a.det_rmrcir_id INNER JOIN tran_rmrcir_mast c ON b.mast_rmrcir_id=c.id WHERE a.det_rmrcir_id ='$id' and a.isdeleted=0 and (a.issue_doc_type!='stock_adj' OR a.received_doc_type!='stock_adj' OR a.rejected_doc_type!='stock_adj') ORDER BY a.id");
     $query = $this->db->query("select a.id,a.rm_id,a.issue_qty,a.issue_doc_type,a.issue_doc_id,a.received_qty,a.received_doc_type,a.received_doc_id,a.booked_qty,a.booked_doc_type,a.booked_doc_id,a.rejected_qty,a.rejected_doc_type,a.rejected_doc_id,c.challan_no,c.challan_date,c.date,c.supplier_id,a.det_rmrcir_id,a.mast_rmrcir_id,a.tran_rmpo_det_id,a.branch_id from tran_rmrcir_stock a INNER JOIN tran_rmrcir_details b ON b.id=a.det_rmrcir_id INNER JOIN tran_rmrcir_mast c ON b.mast_rmrcir_id=c.id WHERE a.det_rmrcir_id ='$id' and a.isdeleted=0 ORDER BY a.id");
	 $data = $query->result_array();
	 return $data;

	}
	
	public function rmstockAdjustDet($id)              //created on 31/05/2023  - by Asharani
	{
	 $query = $this->db->query("select a.id,a.rm_id,a.issue_qty,a.issue_doc_type,a.issue_doc_id,a.received_qty,a.received_doc_type,a.received_doc_id,a.booked_qty,a.booked_doc_type,a.booked_doc_id,a.rejected_qty,a.rejected_doc_type,a.rejected_doc_id,a.det_rmrcir_id,a.mast_rmrcir_id,a.tran_rmpo_det_id from tran_rmrcir_stock a INNER JOIN tran_rmrcir_details b ON b.id=a.det_rmrcir_id INNER JOIN tran_rmrcir_mast c ON b.mast_rmrcir_id=c.id WHERE a.det_rmrcir_id ='$id' and a.isdeleted=0 and (a.issue_doc_type='stock_adj' OR a.received_doc_type='stock_adj' OR a.rejected_doc_type='stock_adj') ORDER BY a.id");
	 $data = $query->row_array();
	 return $data;

	}
	public function getStockAdjcnt($mast_rmrcir_id){
	 $query = $this->db->query("select count(DISTINCT(a.det_rmrcir_id)) as stk_adj_cnt from tran_rmrcir_stock a INNER JOIN tran_rmrcir_details b ON b.id=a.det_rmrcir_id INNER JOIN tran_rmrcir_mast c ON b.mast_rmrcir_id=c.id WHERE a.mast_rmrcir_id ='$mast_rmrcir_id' and a.isdeleted=0 and (a.issue_doc_type='stock_adj' OR a.received_doc_type='stock_adj' OR a.rejected_doc_type='stock_adj')");
	 $data = $query->row_array();
	 return $data;  
	}

	public function getNOStockAdjcnt($mast_rmrcir_id){
	 $query = $this->db->query("select count(DISTINCT(a.det_rmrcir_id)) as no_stk_adj_cnt from tran_rmrcir_stock a INNER JOIN tran_rmrcir_details b ON b.id=a.det_rmrcir_id INNER JOIN tran_rmrcir_mast c ON b.mast_rmrcir_id=c.id WHERE a.mast_rmrcir_id ='$mast_rmrcir_id' and a.isdeleted=0 and a.det_rmrcir_id NOT IN(select DISTINCT(a.det_rmrcir_id) from tran_rmrcir_stock a INNER JOIN tran_rmrcir_details b ON b.id=a.det_rmrcir_id INNER JOIN tran_rmrcir_mast c ON b.mast_rmrcir_id=c.id WHERE a.mast_rmrcir_id ='$mast_rmrcir_id' and a.isdeleted=0 and (a.issue_doc_type='stock_adj' OR a.received_doc_type='stock_adj' OR a.rejected_doc_type='stock_adj'))");
	 $data = $query->row_array();
	 //echo $this->db->last_query(); die;
	 return $data;  
	}
//Created by Asharani for Part Movement update : 23-06-2023
	public function getPartMovement($id){
	$query = $this->db->query("SELECT `id`, `part_id`, `op_id`, `qty`, `from_branch_id`, `to_branch_id`, `date` FROM `tran_parts_movement` where id='$id' order by id desc");
	 $data = $query->row_array();
	 return $data;  
	}
	
	//Created by Asharani for Part Movement update : 23-06-2023
	
	public function getInvDetailsforReport($id){
	   $query = $this->db->query("SELECT tid.mast_inv_id , tim.date , tim.invoice_no ,cust.name as cust_name , tid.qty from tran_invoice_details tid inner join tran_invoice_mast tim on tid.mast_inv_id=tim.id inner join mast_customer cust on tim.customer_id=cust.id where tid.id='$id' and tid.isdeleted=0 and cust.isdeleted=0");
	 	 $data = $query->row_array();
//	 echo $this->db->last_query(); die;
	 return $data;
	}
	public function getInvoiceDetailsWithMast(){
	    $Customer_Id	=$_POST['Customer_Id'];
		$schedule_date 	=$_POST['schedule_date'];
		$toDate 		=date("Y-m-t", strtotime($schedule_date)); 
	  $query = "SELECT tm.`id`, tm.`customer_id`, tm.`date`, tm.`invoice_no`, tm.`amount`, tm.`inv_amt`, tid.`id` as inv_det_id, tid.`part_id`, tid.`qty`,tid.branch_id FROM `tran_invoice_mast` tm inner join tran_invoice_details tid on tm.id=tid.mast_inv_id WHERE month(tm.date)=month('$toDate') and tm.year='$_SESSION[current_year]' and tid.isdeleted=0";
	 // and tid.branch_id='$_SESSION[branch_id]'
	 
	  if($Customer_Id !='')
	  {
	  $query .= " and customer_id='$Customer_Id' ";
	  
	  }
	  $query .= " order by id desc  ";
	  $querys = $this->db->query($query);
	 //echo $this->db->last_query();die;
	 
	 $data = $querys->result_array();
	 return $data;
	}
	public function	getQCPDRByInvDetId($id){
	 $query = $this->db->query("SELECT tip.id , tip.std_value , tip.quality_id , tip.`min_value`, tip.`max_value`, tip.reading1, tip.reading2 , tip.reading3, tip.reading4, tip.reading5 ,tip.final_reading,tip.remark, qc.`name` as quality_name , qc.`numof_decimal` FROM tran_invoice_pdr tip inner join tran_invoice_details tid on tip.det_inv_id=tid.id inner join tran_invoice_mast tim on tid.mast_inv_id=tim.id inner join mast_quality_checks qc on tip.`quality_id`= qc.`id`  where tip.det_inv_id='$id' order by qc.id");
	 $data = $query->result_array();
//	 echo $this->db->last_query(); die;
	 return $data;
	}
	
  //added by Asharani 28-06-2023 for scrap stock Bar Chart
    public function getScrapStkForBChart(){
	    $year     =$_SESSION['current_year'];
	    $mindate=getMinDate();
	    $current_date=date('Y-m-d');
	  $query =$this->db->query("SELECT brch.name as br,round(sum(if(type = 'NORMAL',(received_qty - issue_qty  - rejected_qty),0)),2) as ms,round(sum(if(type = 'SS',(received_qty - issue_qty  - rejected_qty),0)),2) as ss FROM scrap_stock sc inner join mast_branch brch on sc.branch_id=brch.id where sc.year='$year' and sc.date between '$mindate' and '$current_date' and brch.current_year='$year' group by sc.branch_id order by sc.date");
	  $data = $query->result_array();
	  //echo $this->db->last_query();die; 
	  return $data;
   }
   
   public function getProdPlanQty($id){
    
	 $query = $this->db->query("SELECT id,planning_qty FROM `tran_prod_planning` WHERE id='$id'");
	 $data = $query->row_array();
	 return $data;
   }


   public function partStockSummary($flag){
        $year= $_SESSION['current_year'];
        $y=explode("-",$year);
        $allparts=array();
        $data=[];
        if($flag!='ALL'){
           $allparts[0] = $_POST['Part_Id'];
        }else{
           $allparts = $this->getPartsOrderByFamily();  
        }
	    $fd = getMinDate();
	    $td = $_POST['to_date'];
	    //$view_year= trim($y[0])."_".trim($y[1]);
	     foreach($allparts as $part){
	         
	        if($flag=='ALL'){
               $pid=$part['part_id']; 
              }else{
                $pid=$part;  
              }  
            // $query = $this->db->query("select sum(received_qty-issue_qty-inprocess_loss_qty-rejected_qty) as max_qty from tran_dpr_stock where part_id = '$partId' and operation_id ='$PreOPId' and year = '$_SESSION[current_year]' and branch_id ='$branch_id' and mast_dpr_id in(select dpr_id from tran_dpr_quality_checks where year = '$_SESSION[current_year]')  
    	        //union all select sum(received_qty-issue_qty-inprocess_loss_qty-rejected_qty) as max_qty from tran_partsrcir_stock where part_id='$partId' and op_id='$PreOPId' and branch_id ='$branch_id' and year = '$_SESSION[current_year]' and (received_qty+issue_qty+inprocess_loss_qty+rejected_qty)!=0 and (det_partsrcir_id in(SELECT det_partsrcir_id FROM `tran_partsrcir_quality_checks` where year = '$_SESSION[current_year]'  union all select det_partsrcir_id FROM `tran_partsrcir_stock` where part_id='$partId' and op_id='$PreOPId' and branch_id ='$branch_id' and year = '$_SESSION[current_year]'  and (received_doc_type='p_movement' or received_doc_type='supl_pmovement' or issue_doc_type='p_movement' or issue_doc_type='supl_pmovement' or received_doc_type='stock_adj' or issue_doc_type='stock_adj' or received_doc_type='O.B.')) )");    
              
       /* $query = $this->db->query("select part_id,doc_type,received_doc_type,doc_id,sequence_no,sum(qty) as qty,move_from,move_to,branch_id,op_id FROM(
                                    SELECT tran_dc_stock.part_id,'DC' as doc_type,received_doc_type,det_dc_id as doc_id,move_from,move_to,rpo.sequence_no,sum(received_qty-rejected_qty-issue_qty-inprocess_loss_qty) as qty,tran_dc_stock.branch_id,tran_dc_stock.op_id FROM `tran_dc_stock` inner join rel_part_operation rpo on rpo.part_id=tran_dc_stock.part_id and rpo.op_id=tran_dc_stock.op_id inner join tran_dc_mast on tran_dc_stock.`mast_dc_id` = tran_dc_mast.id  WHERE tran_dc_stock.part_id = '$pid' and tran_dc_stock.year = '$year' and tran_dc_stock.tran_date between '$fd' and '$td' and (tran_dc_stock.received_qty>0 or tran_dc_stock.issue_qty>0 or tran_dc_stock.rejected_qty>0 or tran_dc_stock.inprocess_loss_qty >0) group by tran_dc_stock.det_dc_id,tran_dc_stock.op_id
                                    union all
                                    SELECT tran_dpr_stock.part_id,'DPR' as doc_type,received_doc_type,mast_dpr_id as doc_id,move_from,move_to,rpo.sequence_no,sum(received_qty-tran_dpr_stock.rejected_qty-issue_qty-inprocess_loss_qty) as qty,tran_dpr_stock.branch_id,tran_dpr_stock.operation_id as op_id FROM tran_dpr_stock inner join rel_part_operation rpo on rpo.part_id=tran_dpr_stock.part_id and rpo.op_id=tran_dpr_stock.operation_id inner JOIN tran_dpr on tran_dpr.id = tran_dpr_stock.mast_dpr_id WHERE tran_dpr_stock.part_id = '$pid' and tran_dpr_stock.year = '$year'  and tran_dpr_stock.tran_date between '$fd' and '$td' and (tran_dpr_stock.received_qty>0 or tran_dpr_stock.issue_qty>0 or tran_dpr_stock.rejected_qty>0 or tran_dpr_stock.inprocess_loss_qty >0) group by tran_dpr_stock.mast_dpr_id,tran_dpr_stock.operation_id
                                    union all
                                    SELECT tran_partsrcir_stock.part_id,'RCIR' as doc_type,received_doc_type,det_partsrcir_id as doc_id,move_from,move_to,rpo.sequence_no,sum(received_qty-rejected_qty-issue_qty-inprocess_loss_qty) as qty,tran_partsrcir_stock.branch_id,tran_partsrcir_stock.op_id FROM `tran_partsrcir_stock` inner join rel_part_operation rpo on rpo.part_id=tran_partsrcir_stock.part_id and rpo.op_id=tran_partsrcir_stock.op_id inner join tran_partsrcir_mast on tran_partsrcir_stock.mast_partsrcir_id = tran_partsrcir_mast.id WHERE tran_partsrcir_stock.part_id = '$pid' and tran_partsrcir_stock.year = '$year' and tran_partsrcir_stock.tran_date between '$fd' and '$td' and (tran_partsrcir_stock.received_qty>0 or tran_partsrcir_stock.issue_qty>0 or tran_partsrcir_stock.rejected_qty>0 or tran_partsrcir_stock.inprocess_loss_qty >0) group by tran_partsrcir_stock.det_partsrcir_id,tran_partsrcir_stock.op_id
                               order by sequence_no) a GROUP by branch_id,op_id order by sequence_no");*/
                               //doc_type,doc_id
        $query = $this->db->query("select part_id,doc_type,received_doc_type,doc_id,sequence_no,sum(qty) as qty,move_from,move_to,branch_id,op_id FROM(
                                    SELECT tran_dc_stock.part_id,'DC' as doc_type,received_doc_type,det_dc_id as doc_id,move_from,move_to,rpo.sequence_no,sum(received_qty-rejected_qty-issue_qty-inprocess_loss_qty) as qty,tran_dc_stock.branch_id,tran_dc_stock.op_id FROM `tran_dc_stock` inner join rel_part_operation rpo on rpo.part_id=tran_dc_stock.part_id and rpo.op_id=tran_dc_stock.op_id  WHERE tran_dc_stock.part_id = '$pid' and tran_dc_stock.year = '$year' and tran_dc_stock.tran_date between '$fd' and '$td' and (tran_dc_stock.received_qty>0 or tran_dc_stock.issue_qty>0 or tran_dc_stock.rejected_qty>0 or tran_dc_stock.inprocess_loss_qty >0) group by tran_dc_stock.det_dc_id,tran_dc_stock.op_id
                                    union all
                                    SELECT tran_dpr_stock.part_id,'DPR' as doc_type,received_doc_type,mast_dpr_id as doc_id,move_from,move_to,rpo.sequence_no,sum(received_qty-tran_dpr_stock.rejected_qty-issue_qty-inprocess_loss_qty) as qty,tran_dpr_stock.branch_id,tran_dpr_stock.operation_id as op_id FROM tran_dpr_stock inner join rel_part_operation rpo on rpo.part_id=tran_dpr_stock.part_id and rpo.op_id=tran_dpr_stock.operation_id WHERE tran_dpr_stock.part_id = '$pid' and tran_dpr_stock.year = '$year'  and tran_dpr_stock.tran_date between '$fd' and '$td' and (tran_dpr_stock.received_qty>0 or tran_dpr_stock.issue_qty>0 or tran_dpr_stock.rejected_qty>0 or tran_dpr_stock.inprocess_loss_qty >0) group by tran_dpr_stock.mast_dpr_id,tran_dpr_stock.operation_id
                                    union all
                                    SELECT tran_partsrcir_stock.part_id,'RCIR' as doc_type,received_doc_type,det_partsrcir_id as doc_id,move_from,move_to,rpo.sequence_no,sum(received_qty-rejected_qty-issue_qty-inprocess_loss_qty) as qty,tran_partsrcir_stock.branch_id,tran_partsrcir_stock.op_id FROM `tran_partsrcir_stock` inner join rel_part_operation rpo on rpo.part_id=tran_partsrcir_stock.part_id and rpo.op_id=tran_partsrcir_stock.op_id  WHERE tran_partsrcir_stock.part_id = '$pid' and tran_partsrcir_stock.year = '$year' and tran_partsrcir_stock.tran_date between '$fd' and '$td' and (tran_partsrcir_stock.received_qty>0 or tran_partsrcir_stock.issue_qty>0 or tran_partsrcir_stock.rejected_qty>0 or tran_partsrcir_stock.inprocess_loss_qty >0) group by tran_partsrcir_stock.det_partsrcir_id,tran_partsrcir_stock.op_id
                               order by sequence_no) a GROUP by branch_id,op_id order by sequence_no");
    
         $res = $query->result_array();
         	 // echo "<br>". $this->db->last_query(); 
              if($flag!='ALL'){
                return $res;  
              }
             if(!empty($res)){
                  $data[]=$res;
             }
	     }
      
//	  echo "<br>". $this->db->last_query(); 
	    return $data;
   }
   public function PartStockDetailsRevision($flag){
        $year= $_SESSION['current_year'];
        $y=explode("-",$year);
        $allparts=array();
        $data=[];
        if($flag!='ALL'){
           $allparts[0] = $_POST['Part_Id'];
        }else{
           $allparts = $this->getPartsOrderByFamily();  
        }
	    $fd = getMinDate();
	    $td = $_POST['to_date'];
	    //$view_year= trim($y[0])."_".trim($y[1]);
	     foreach($allparts as $part){
	         
	        if($flag=='ALL'){
               $pid=$part['part_id']; 
              }else{
                $pid=$part;  
              }  
           //  $query = $this->db->query("select sum(received_qty-issue_qty-inprocess_loss_qty-rejected_qty) as max_qty from tran_dpr_stock where part_id = '$pid' and operation_id ='$PreOPId' and year = '$_SESSION[current_year]' and branch_id ='$branch_id' and mast_dpr_id in(select dpr_id from tran_dpr_quality_checks where year = '$_SESSION[current_year]')  
    	  //  union all select sum(received_qty-issue_qty-inprocess_loss_qty-rejected_qty) as max_qty from tran_partsrcir_stock where part_id='$pid' and op_id='$PreOPId' and branch_id ='$branch_id' and year = '$_SESSION[current_year]' and (received_qty+issue_qty+inprocess_loss_qty+rejected_qty)!=0 and (det_partsrcir_id in(SELECT det_partsrcir_id FROM `tran_partsrcir_quality_checks` where year = '$_SESSION[current_year]'  union all select det_partsrcir_id FROM `tran_partsrcir_stock` where part_id='$partId' and op_id='$PreOPId' and branch_id ='$branch_id' and year = '$_SESSION[current_year]'  and (received_doc_type='p_movement' or received_doc_type='supl_pmovement' or issue_doc_type='p_movement' or issue_doc_type='supl_pmovement' or received_doc_type='stock_adj' or issue_doc_type='stock_adj' or received_doc_type='O.B.')) )");    
              
        $query = $this->db->query("select part_id,doc_type,received_doc_type,doc_id,sequence_no,sum(qty) as qty,move_from,move_to,branch_id,op_id FROM( SELECT tran_dpr_stock.part_id,'DPR' as doc_type,received_doc_type,mast_dpr_id as doc_id,move_from,move_to,rpo.sequence_no,sum(received_qty-tran_dpr_stock.rejected_qty-issue_qty-inprocess_loss_qty) as qty,tran_dpr_stock.branch_id,tran_dpr_stock.operation_id as op_id FROM tran_dpr_stock inner join rel_part_operation rpo on rpo.part_id=tran_dpr_stock.part_id and rpo.op_id=tran_dpr_stock.operation_id inner JOIN tran_dpr on tran_dpr.id = tran_dpr_stock.mast_dpr_id WHERE tran_dpr_stock.mast_dpr_id!='9999999' and tran_dpr_stock.part_id = '$pid' and tran_dpr_stock.year = '$year'  and tran_dpr_stock.tran_date between '$fd' and '$td' and (tran_dpr_stock.received_qty>0 or tran_dpr_stock.issue_qty!=0 or tran_dpr_stock.rejected_qty>0 or tran_dpr_stock.inprocess_loss_qty >0) group by tran_dpr_stock.mast_dpr_id,tran_dpr_stock.operation_id
                                     having qty != 0 
                                     union all
                                    SELECT tran_partsrcir_stock.part_id,'RCIR' as doc_type,received_doc_type,det_partsrcir_id as doc_id,move_from,move_to,rpo.sequence_no,sum(received_qty-rejected_qty-issue_qty-inprocess_loss_qty) as qty,tran_partsrcir_stock.branch_id,tran_partsrcir_stock.op_id FROM `tran_partsrcir_stock` inner join rel_part_operation rpo on rpo.part_id=tran_partsrcir_stock.part_id and rpo.op_id=tran_partsrcir_stock.op_id inner join tran_partsrcir_mast on tran_partsrcir_stock.mast_partsrcir_id = tran_partsrcir_mast.id WHERE tran_partsrcir_stock.det_partsrcir_id!='9999999' and tran_partsrcir_stock.part_id = '$pid' and tran_partsrcir_stock.year = '$year' and tran_partsrcir_stock.tran_date between '$fd' and '$td' and (tran_partsrcir_stock.received_qty!=0 or tran_partsrcir_stock.issue_qty!=0 or tran_partsrcir_stock.rejected_qty!=0 or tran_partsrcir_stock.inprocess_loss_qty !=0) and det_partsrcir_id!=0 and (tran_partsrcir_stock.received_qty+ tran_partsrcir_stock.issue_qty+ tran_partsrcir_stock.rejected_qty!=0)  group by tran_partsrcir_stock.det_partsrcir_id,tran_partsrcir_stock.op_id
                                having qty != 0 order by sequence_no) a GROUP by branch_id,op_id order by sequence_no");
                               //doc_type,doc_id
                               
        //
    
         $res = $query->result_array();
        	  echo "<br>". $this->db->last_query(); 
              if($flag!='ALL'){
                return $res;  
              }
             if(!empty($res)){
                  $data[]=$res;
             }
	     }
      
	   echo "<br>". $this->db->last_query(); 
	    return $data;
   }
      public function AllPartStockDetailsRevision($pid){
        $year= $_SESSION['current_year'];
        $fd = getMinDate();
	    $td = $_POST['to_date'];
        $query = $this->db->query("select part_id,doc_type,received_doc_type,doc_id,sequence_no,sum(qty) as qty,move_from,move_to,branch_id,op_id FROM( SELECT tran_dpr_stock.part_id,'DPR' as doc_type,received_doc_type,mast_dpr_id as doc_id,move_from,move_to,rpo.sequence_no,sum(received_qty-tran_dpr_stock.rejected_qty-issue_qty-inprocess_loss_qty) as qty,tran_dpr_stock.branch_id,tran_dpr_stock.operation_id as op_id FROM tran_dpr_stock inner join rel_part_operation rpo on rpo.part_id=tran_dpr_stock.part_id and rpo.op_id=tran_dpr_stock.operation_id inner JOIN tran_dpr on tran_dpr.id = tran_dpr_stock.mast_dpr_id WHERE tran_dpr_stock.mast_dpr_id!='9999999' and tran_dpr_stock.part_id = '$pid' and tran_dpr_stock.year = '$year'  and tran_dpr_stock.tran_date between '$fd' and '$td' and (tran_dpr_stock.received_qty>0 or tran_dpr_stock.issue_qty!=0 or tran_dpr_stock.rejected_qty>0 or tran_dpr_stock.inprocess_loss_qty >0) group by tran_dpr_stock.mast_dpr_id,tran_dpr_stock.operation_id
                                     having qty != 0
                                     union all
                                    SELECT tran_partsrcir_stock.part_id,'RCIR' as doc_type,received_doc_type,det_partsrcir_id as doc_id,move_from,move_to,rpo.sequence_no,sum(received_qty-rejected_qty-issue_qty-inprocess_loss_qty) as qty,tran_partsrcir_stock.branch_id,tran_partsrcir_stock.op_id FROM `tran_partsrcir_stock` inner join rel_part_operation rpo on rpo.part_id=tran_partsrcir_stock.part_id and rpo.op_id=tran_partsrcir_stock.op_id inner join tran_partsrcir_mast on tran_partsrcir_stock.mast_partsrcir_id = tran_partsrcir_mast.id WHERE tran_partsrcir_stock.det_partsrcir_id!='9999999' and tran_partsrcir_stock.part_id = '$pid' and tran_partsrcir_stock.year = '$year' and tran_partsrcir_stock.tran_date between '$fd' and '$td' and (tran_partsrcir_stock.received_qty!=0 or tran_partsrcir_stock.issue_qty!=0 or tran_partsrcir_stock.rejected_qty!=0 or tran_partsrcir_stock.inprocess_loss_qty !=0) and det_partsrcir_id!=0 and (tran_partsrcir_stock.received_qty+ tran_partsrcir_stock.issue_qty+ tran_partsrcir_stock.rejected_qty!=0)   group by tran_partsrcir_stock.det_partsrcir_id,tran_partsrcir_stock.op_id
                               having qty != 0  order by sequence_no) a GROUP by branch_id,op_id order by sequence_no");
                               
         /*$query = $this->db->query("select  c.part_id,c.doc_type,sum(c.qty) as qty,c.doc_id,c.branch_id,c.op_id,c.move_from,c.move_to,rpo.sequence_no from (select a.part_id,a.doc_type,sum(a.qty) as qty,a.doc_id,a.branch_id,a.op_id,s2.move_from,s2.move_to from (SELECT dprs.part_id,'DPR' as doc_type,mast_dpr_id as doc_id,sum(received_qty-dprs.rejected_qty-issue_qty-inprocess_loss_qty) as qty,dprs.branch_id,dprs.operation_id as op_id FROM tran_dpr_stock dprs inner JOIN tran_dpr on tran_dpr.id = dprs.mast_dpr_id WHERE dprs.mast_dpr_id!='9999999' and dprs.part_id = '$pid' and dprs.year = '$year' and dprs.tran_date between '$fd' and '$td' and (dprs.received_qty!=0 or dprs.issue_qty!=0 or dprs.rejected_qty!=0 or dprs.inprocess_loss_qty!=0) group by dprs.mast_dpr_id,dprs.operation_id having qty!=0) a INNER join tran_dpr_stock s2 on a.doc_id=s2.mast_dpr_id where s2.received_qty!=0
                                 group by s2.move_to,op_id union all 
                                select b.part_id,b.doc_type,sum(b.qty) as qty,b.doc_id,b.branch_id,b.op_id,s2.move_from,s2.move_to from (SELECT rcirs.part_id,'RCIR' as doc_type,det_partsrcir_id as doc_id,sum(received_qty-rejected_qty-issue_qty-inprocess_loss_qty) as qty,rcirs.branch_id,rcirs.op_id FROM `tran_partsrcir_stock` rcirs inner join tran_partsrcir_mast on rcirs.mast_partsrcir_id = tran_partsrcir_mast.id WHERE rcirs.det_partsrcir_id!='9999999' and rcirs.part_id = '$pid' and rcirs.year = '$year' and rcirs.tran_date between '$fd' and '$td' and (rcirs.received_qty!=0 or rcirs.issue_qty!=0 or rcirs.rejected_qty!=0 or (rcirs.inprocess_loss_qty !=0 and received_qty>0)) and det_partsrcir_id!=0 group by rcirs.det_partsrcir_id,rcirs.op_id having qty!=0) b INNER join tran_partsrcir_stock s2 on b.doc_id=s2.det_partsrcir_id where s2.received_qty!=0  group by s2.move_to,op_id) c inner join rel_part_operation rpo on c.part_id=rpo.part_id and c.op_id=rpo.op_id group by op_id,move_to order by sequence_no");
                               //doc_type,doc_id*/
    
         $res = $query->result_array();
	 //  echo "<br>". $this->db->last_query(); 
	    return $res;
   }
   
     public function AllPartStockDetailsRevisionDc($pid){
        $year= $_SESSION['current_year'];
        $fd = getMinDate();
	    $td = $_POST['to_date'];
      
        $query = $this->db->query("select part_id,doc_type,received_doc_type,doc_id,sequence_no,sum(qty) as qty,move_from,move_to,branch_id,op_id FROM(
                                    SELECT tran_dc_stock.part_id,'DC' as doc_type,received_doc_type,det_dc_id as doc_id,move_from,move_to,rpo.sequence_no,sum(-issue_qty+inprocess_loss_qty+received_qty+rejected_qty) as qty,tran_dc_stock.branch_id,tran_dc_stock.op_id FROM `tran_dc_stock` inner join rel_part_operation rpo on rpo.part_id=tran_dc_stock.part_id and rpo.op_id=tran_dc_stock.op_id WHERE tran_dc_stock.part_id = '$pid' and tran_dc_stock.year = '$year' and tran_dc_stock.tran_date between '$fd' and '$td' and (tran_dc_stock.received_qty!=0 or tran_dc_stock.issue_qty>0 or tran_dc_stock.rejected_qty>0 or tran_dc_stock.inprocess_loss_qty >0) group by tran_dc_stock.det_dc_id,tran_dc_stock.op_id
                                ) a GROUP by branch_id,op_id,move_to order by sequence_no");
                               //doc_type,doc_id
    
         $res = $query->result_array();
        // echo "<br><br><br>****". $this->db->last_query(); 
         
	    return $res;
   }
   public function partStockSummary03_04_24(){
        $year= $_SESSION['current_year'];
        $fd = getMinDate();
	    $td = $_POST['to_date'];
	    $pid=$_POST['Part_Id'];
      $query = $this->db->query("select  c.part_id,c.doc_type,sum(c.qty) as qty,c.doc_id,c.branch_id,c.op_id,c.move_from,c.move_to,rpo.sequence_no from (select a.part_id,a.doc_type,sum(a.qty) as qty,a.doc_id,a.branch_id,a.op_id,s2.move_from,s2.move_to from (SELECT dprs.part_id,'DPR' as doc_type,mast_dpr_id as doc_id,sum(received_qty-dprs.rejected_qty-issue_qty-inprocess_loss_qty) as qty,dprs.branch_id,dprs.operation_id as op_id FROM tran_dpr_stock dprs  WHERE dprs.mast_dpr_id!='9999999' and dprs.part_id = '$pid' and dprs.year = '$year' and dprs.tran_date between '$fd' and '$td' and (dprs.received_qty!=0 or dprs.issue_qty!=0 or dprs.rejected_qty!=0 or dprs.inprocess_loss_qty!=0) group by dprs.mast_dpr_id,dprs.operation_id having qty!=0) a INNER join tran_dpr_stock s2 on a.doc_id=s2.mast_dpr_id where s2.received_qty!=0
                                 group by s2.move_to,op_id union all 
                                select b.part_id,b.doc_type,sum(b.qty) as qty,b.doc_id,b.branch_id,b.op_id,s3.move_from,s3.move_to from (SELECT rcirs.part_id,'RCIR' as doc_type,det_partsrcir_id as doc_id,sum(received_qty-rejected_qty-issue_qty-inprocess_loss_qty) as qty,rcirs.branch_id,rcirs.op_id FROM `tran_partsrcir_stock` rcirs WHERE rcirs.det_partsrcir_id!='9999999' and rcirs.part_id = '$pid' and rcirs.year = '$year' and rcirs.tran_date between '$fd' and '$td' and (rcirs.received_qty!=0 or rcirs.issue_qty!=0 or rcirs.rejected_qty!=0 or (rcirs.inprocess_loss_qty !=0 and received_qty>0)) and det_partsrcir_id!=0 group by rcirs.det_partsrcir_id,rcirs.op_id having qty!=0) b INNER join tran_partsrcir_stock s3 on b.doc_id=s3.det_partsrcir_id where s3.received_qty!=0  group by s3.move_to,op_id) c inner join rel_part_operation rpo on c.part_id=rpo.part_id and c.op_id=rpo.op_id group by op_id,move_to order by sequence_no");
  
    $res = $query->result_array();
         echo "<br>*****". $this->db->last_query(); 
	    return $res;
   }
    public function PartStockDetailsRevisionDc($flag){
        $year= $_SESSION['current_year'];
        $y=explode("-",$year);
        $allparts=array();
        $data=[];
        if($flag!='ALL'){
           $allparts[0] = $_POST['Part_Id'];
        }else{
           $allparts = $this->getPartsOrderByFamily();  
        }
	    $fd = getMinDate();
	    $td = $_POST['to_date'];
	    //$view_year= trim($y[0])."_".trim($y[1]);
	     foreach($allparts as $part){
	         
	        if($flag=='ALL'){
               $pid=$part['part_id']; 
              }else{
                $pid=$part;  
              }  
            // $query = $this->db->query("select sum(received_qty-issue_qty-inprocess_loss_qty-rejected_qty) as max_qty from tran_dpr_stock where part_id = '$partId' and operation_id ='$PreOPId' and year = '$_SESSION[current_year]' and branch_id ='$branch_id' and mast_dpr_id in(select dpr_id from tran_dpr_quality_checks where year = '$_SESSION[current_year]')  
    	        //union all select sum(received_qty-issue_qty-inprocess_loss_qty-rejected_qty) as max_qty from tran_partsrcir_stock where part_id='$partId' and op_id='$PreOPId' and branch_id ='$branch_id' and year = '$_SESSION[current_year]' and (received_qty+issue_qty+inprocess_loss_qty+rejected_qty)!=0 and (det_partsrcir_id in(SELECT det_partsrcir_id FROM `tran_partsrcir_quality_checks` where year = '$_SESSION[current_year]'  union all select det_partsrcir_id FROM `tran_partsrcir_stock` where part_id='$partId' and op_id='$PreOPId' and branch_id ='$branch_id' and year = '$_SESSION[current_year]'  and (received_doc_type='p_movement' or received_doc_type='supl_pmovement' or issue_doc_type='p_movement' or issue_doc_type='supl_pmovement' or received_doc_type='stock_adj' or issue_doc_type='stock_adj' or received_doc_type='O.B.')) )");    
 $query = $this->db->query("select part_id,doc_type,received_doc_type,doc_id,sequence_no,sum(qty) as qty,move_from,move_to,branch_id,op_id FROM(
                                    SELECT tran_dc_stock.part_id,'DC' as doc_type,received_doc_type,det_dc_id as doc_id,move_from,move_to,rpo.sequence_no,sum(-issue_qty+inprocess_loss_qty+received_qty+rejected_qty) as qty,tran_dc_stock.branch_id,tran_dc_stock.op_id FROM `tran_dc_stock` inner join rel_part_operation rpo on rpo.part_id=tran_dc_stock.part_id and rpo.op_id=tran_dc_stock.op_id WHERE tran_dc_stock.part_id = '$pid' and tran_dc_stock.year = '$year' and tran_dc_stock.tran_date between '$fd' and '$td' and (tran_dc_stock.received_qty!=0 or tran_dc_stock.issue_qty>0 or tran_dc_stock.rejected_qty>0 or tran_dc_stock.inprocess_loss_qty >0) group by tran_dc_stock.det_dc_id,tran_dc_stock.op_id
                                ) a GROUP by branch_id,op_id,move_to order by sequence_no");
                               //doc_type,doc_id
    
         $res = $query->result_array();
         	   echo "********************************<br><br>". $this->db->last_query(); 
              if($flag!='ALL'){
                return $res;  
              }
             if(!empty($res)){
                  $data[]=$res;
             }
	     }
      
	  // echo "<br>". $this->db->last_query(); 
	    return $data;
   }
   public function allPartStockSummary(){
       
        $year= $_SESSION['current_year'];
	    $fd=getMinDate();
	    $td = $_POST['to_date'];
        $data=[];
        $allparts=$this->getPartsOrderByFamily();
      //  print_r($allparts);exit; 
        foreach($allparts as $part){
       
         $pid = $part['part_id']; 
     
         $query = $this->db->query("select part_id,doc_type,doc_id,sequence_no,sum(qty) as qty,move_from,move_to,branch_id,op_id FROM(SELECT tran_dc_stock.part_id,'DC' as doc_type,det_dc_id as doc_id,move_from,move_to,rpo.sequence_no,sum(received_qty-rejected_qty-issue_qty-inprocess_loss_qty) as qty,tran_dc_stock.branch_id,tran_dc_stock.op_id FROM `tran_dc_stock` inner join rel_part_operation rpo on rpo.part_id=tran_dc_stock.part_id and rpo.op_id=tran_dc_stock.op_id inner join tran_dc_mast on tran_dc_stock.`mast_dc_id` = tran_dc_mast.id  WHERE tran_dc_stock.part_id = '$pid' and tran_dc_stock.year = '$year' and tran_dc_mast.date between '$fd' and '$td' and (received_qty+issue_qty)>0 group by tran_dc_stock.det_dc_id,tran_dc_stock.op_id
                                    union all
                                    SELECT tran_dpr_stock.part_id,'DPR' as doc_type,mast_dpr_id as doc_id,move_from,move_to,rpo.sequence_no,sum(received_qty-tran_dpr_stock.rejected_qty-issue_qty-inprocess_loss_qty) as qty,tran_dpr_stock.branch_id,tran_dpr_stock.operation_id as op_id FROM tran_dpr_stock inner join rel_part_operation rpo on rpo.part_id=tran_dpr_stock.part_id and rpo.op_id=tran_dpr_stock.operation_id inner JOIN tran_dpr on tran_dpr.id = tran_dpr_stock.mast_dpr_id WHERE tran_dpr_stock.part_id = '$pid' and tran_dpr_stock.year = '$year'  and tran_dpr.dpr_date between '$fd' and '$td' and (received_qty+tran_dpr_stock.rejected_qty+issue_qty+inprocess_loss_qty+booked_qty)>0 group by tran_dpr_stock.mast_dpr_id,tran_dpr_stock.operation_id
                                    union all
                                    SELECT tran_partsrcir_stock.part_id,'RCIR' as doc_type,det_partsrcir_id as doc_id,move_from,move_to,rpo.sequence_no,sum(received_qty-rejected_qty-issue_qty-inprocess_loss_qty) as qty,tran_partsrcir_stock.branch_id,tran_partsrcir_stock.op_id FROM `tran_partsrcir_stock` inner join rel_part_operation rpo on rpo.part_id=tran_partsrcir_stock.part_id and rpo.op_id=tran_partsrcir_stock.op_id inner join tran_partsrcir_mast on tran_partsrcir_stock.mast_partsrcir_id = tran_partsrcir_mast.id WHERE tran_partsrcir_stock.part_id = '$pid' and tran_partsrcir_stock.year = '$year' and tran_partsrcir_mast.date between '$fd' and '$td' and (received_qty+issue_qty)>0 group by tran_partsrcir_stock.det_partsrcir_id,tran_partsrcir_stock.op_id
                               order by sequence_no) a GROUP by branch_id,doc_type,op_id order by sequence_no");
        
        
         $res= $query->result_array();
         if(!empty($res)){
              $data[]=$res;
         }
          
        }
       //print_r($data);
	   //echo "<br>". $this->db->last_query(); 
	    return $data;
   }
   
   public function getPrevOperRCIR($mast_rcir_id,$det_partsrcir_id){
         $query=$this->db->query("select op_id from tran_partsrcir_stock where mast_partsrcir_id='$mast_rcir_id' and det_partsrcir_id='$det_partsrcir_id'");
	     $data = $query->row_array();
	     return $data['op_id'];
   }
   
   public function getDPRByDatefrto(){
        $fd = date("Y-m-d",strtotime($_POST['from_date']));
	    $td = date("Y-m-d",strtotime($_POST['to_date']));
	    $branch_id=$_POST['branch_id'];
        //$query = $this->db->query("SELECT dpr_date FROM `tran_dpr` where dpr_date between '$fd' and '$td'");
        $query=$this->db->query("select td.dpr_date,td.`branch_id`, td.`part_id`, td.`operation_id`,td.qc_remark,tqc.*
                                 from tran_dpr_quality_checks tqc 
                                 inner join tran_dpr td on tqc.dpr_id=td.id 
                                 where td.dpr_date between '$fd' and '$td' and td.branch_id='$branch_id' 
                                 order by tqc.dpr_id,tqc.reading,tqc.qc_id");

	    $data = $query->result_array();
	    	  // echo "<br>". $this->db->last_query(); 
	    return $data; 
   }
    public function getIncomingQCDatefrto(){
        $fd = date("Y-m-d",strtotime($_POST['from_date']));
	    $td = date("Y-m-d",strtotime($_POST['to_date']));
	    $branch_id=$_POST['branch_id'];
        //$query = $this->db->query("SELECT dpr_date FROM `tran_dpr` where dpr_date between '$fd' and '$td'");
        $query=$this->db->query("select tpd.mast_partspo_id,tm.id as mast_id,tm.supplier_id, tm.date, tm.year, tm.challan_no, tm.challan_date, tm.date, tm.`branch_id`, td.`part_id`,td.tran_partspo_det_id, td.qty , td.`op_id`,td.qc_remarks,tqc.* 
                                 from tran_partsrcir_quality_checks tqc 
                                 inner join tran_partsrcir_details td on tqc.det_partsrcir_id=td.id 
                                 inner join tran_partspo_details tpd on td.tran_partspo_det_id=tpd.id 
                                 inner join tran_partsrcir_mast tm on td.mast_partsrcir_id=tm.id
                                 where tm.date between '$fd' and '$td' and tm.branch_id='$branch_id' 
                                 order by tqc.det_partsrcir_id,tqc.reading,tqc.qc_id");

	    $data = $query->result_array();
	    	//   echo "<br>". $this->db->last_query(); 
	    return $data; 
   }
   	public function RMConsumpDetails()
	{
	   $fd = $_POST['from_date'];
	   $td = $_POST['to_date'];
	   // $fd = date("Y-m-d", strtotime($_POST['from_date']));
	   //$td = date("Y-m-d", strtotime($_POST['to_date']));
	   //$branch_id =$_POST['branch_id'];
	   //$rm_id = $_POST['rm_id'];
	  
	  $query = $this->db->query("SELECT UPPER(mr.grade) as grade,ROUND(sum(trs.issue_qty)) as issue_qty from tran_rmrcir_stock trs inner JOIN tran_rmrcir_mast trm on trs.mast_rmrcir_id=trm.id inner join 
	  mast_rm mr on mr.rm_id=trs.rm_id where trm.date between '$fd' and '$td' and trs.year='$_SESSION[current_year]' group by mr.grade");
	  
	 $data = $query->result_array();
	// echo "<br>". $this->db->last_query(); 
	 return $data;

	}
	public function RMConsumpDetailsforPie(){
	  $current_month = date('Y-m');
	  $query = $this->db->query("SELECT mr.grade,sum(trs.issue_qty) as issue_qty from tran_rmrcir_stock trs inner JOIN tran_rmrcir_mast trm on trs.mast_rmrcir_id=trm.id inner join 
	  mast_rm mr on mr.rm_id=trs.rm_id where trm.date like '$current_month%' and trs.year='$_SESSION[current_year]' group by mr.grade");
	  
	 $data = $query->result_array();
	 // echo "<br>". $this->db->last_query(); 
	 return $data;
	}

	
	public function getScheduleQtyInvoiceQtyAll_ByCust($custId,$month){
	    $sql = "select CONCAT(mp.partno, '-', mp.name) As partno,sch.customer_id,sch.to_date,sch.part_id,if(isnull(sum(sch.scheduled_qty)),0,sum(sch.scheduled_qty)) as scheduled_qty,if(isnull(inv.invqty),0,inv.invqty) as inv_qty from tran_schedule sch 
	    inner join (select tim.customer_id,tim.date,part_id,if(isnull(sum(tid.qty)),0,sum(tid.qty)) as invqty from tran_invoice_details tid 
	    left join tran_invoice_mast tim on tim.id=tid.mast_inv_id where tim.date like '$month%' and tid.isdeleted=0 group by part_id) inv on sch.customer_id = inv.customer_id inner join mast_part mp on sch.part_id=mp.part_id and inv.part_id=mp.part_id where sch.to_date like '$month%' ";
	    
	     if($custId){
 		     $sql.=" and sch.customer_id= '$custId'  ";
 		 }
 		 $sql.=" group by sch.part_id";
    	 $query = $this->db->query($sql);
	    $data = $query->result_array();
	//	echo $this->db->last_query(); 
	 	return $data; 
	}
	public function getCSchVSDischart(){
	  $month=date('Y-m');
	  //cust.name as cfname
	  $query = $this->db->query("select sch.customer_id,CONCAT_WS(' ',
    SUBSTRING_INDEX(cust.name, ' ', 1),
    CASE WHEN LENGTH(cust.name)-LENGTH(REPLACE(cust.name,' ',''))>2 THEN
      CONCAT(LEFT(SUBSTRING_INDEX(cust.name, ' ', -4), 1), '.')
    END,
    CASE WHEN LENGTH(cust.name)-LENGTH(REPLACE(cust.name,' ',''))>2 THEN
      CONCAT(LEFT(SUBSTRING_INDEX(cust.name, ' ', -3), 1), '.')
    END,
    CASE WHEN LENGTH(cust.name)-LENGTH(REPLACE(cust.name,' ',''))>1 THEN
      CONCAT(LEFT(SUBSTRING_INDEX(cust.name, ' ', -2), 1), '.')
    END,
    CASE WHEN LENGTH(cust.name)-LENGTH(REPLACE(cust.name,' ',''))>0 THEN
      CONCAT(LEFT(SUBSTRING_INDEX(cust.name, ' ', -1), 1), '.')
    END) name,if(isnull(sum(scheduled_qty)),0,sum(scheduled_qty)) as scheduled_qty,inv.invqty as inv_qty from tran_schedule sch 
	  inner join (select tim.customer_id,tim.date,if(isnull(sum(tid.qty)),0,sum(tid.qty)) as invqty from tran_invoice_details tid left join tran_invoice_mast tim on tim.id=tid.mast_inv_id where tim.date like '$month%' and tid.isdeleted=0 group by customer_id) inv on sch.customer_id = inv.customer_id inner join mast_customer cust on sch.customer_id=cust.id  where sch.to_date like '$month%' group by sch.customer_id");
	  $data = $query->result_array();
	 // echo $this->db->last_query(); 
	  return $data; 
	}	
	
	public function totalDispatch(){
    	  $month=date('Y-m');
    	  $query = $this->db->query("select tim.date,round(sum(tid.qty),0) as inv_qty from tran_invoice_details tid 
    	  left join tran_invoice_mast tim on tim.id=tid.mast_inv_id where tim.date like '$month%' and tid.isdeleted=0");
    	  $current_month_total = $query->row_array();
    	  // echo $this->db->last_query(); 
        	   $data['current_month_total']=0;
        	   if($current_month_total['inv_qty']){
        	       $data['current_month_total']=number_format($current_month_total['inv_qty'],0,".",","); 
        	   }
    	   
     
    	  $query1 = $this->db->query("select tim.date,round(sum(tid.qty),0) as inv_qty from tran_invoice_details tid 
    	  left join tran_invoice_mast tim on tim.id=tid.mast_inv_id where tim.year='$_SESSION[current_year]' and tid.isdeleted=0");
    	  $overall = $query1->row_array();
    	  //echo "<br>". $this->db->last_query();
        	  $data['overall']=0;
        	  if($overall['inv_qty']){
        	         $data['overall']=number_format($overall['inv_qty'],0,".",","); 
        	  }
    	  return $data; 
	}
	public function totalDispatchInRS(){
    	    $month=date('Y-m');
    	   	$mindate=getMinDate();
    	    $current_date=date('Y-m-d');
    	    $data['current_month_total']=0;
        	$data['overall']=0;
    	    
    	  $query = $this->db->query("SELECT round(sum(inv.qty*tod.rate)) as inv_qty_rs FROM tran_invoice_details inv 
                                	  inner join tran_invoice_mast invm on inv.mast_inv_id=invm.id 
                                	  inner join tran_oa_details tod on inv.oa_det_id=tod.id and inv.part_id=tod.part_id 
                                	  WHERE invm.year='$_SESSION[current_year]' and invm.date like '$month%' and inv.isdeleted=0");
    	  $current_month_total = $query->row_array();
    	   //echo $this->db->last_query(); 
        
        	   if($current_month_total['inv_qty']){
        	       $data['current_month_total']=number_format($current_month_total['inv_qty'],0,".",","); 
        	   }
  
    	 $query1 = $this->db->query("SELECT round(sum(inv.qty*tod.rate)) as inv_qty FROM tran_invoice_details inv 
                                	  inner join tran_invoice_mast invm on inv.mast_inv_id=invm.id 
                                	  inner join tran_oa_details tod on inv.oa_det_id=tod.id and inv.part_id=tod.part_id 
                                	  WHERE invm.year='$_SESSION[current_year]' and invm.date between '$mindate' and '$current_date' and inv.isdeleted=0");
    	  $overall = $query1->row_array();
    	  //echo "<br>". $this->db->last_query();
        	 
        	  if($overall['inv_qty']){
        	         $data['overall']=number_format($overall['inv_qty'],0,".",","); 
        	  }
    	  return $data; 
	}
	
	public function totalConsumedMaterial(){
	    $current_month = date('Y-m');
        $mindate=getMinDate();
        $current_date=date('Y-m-d');
        $data['current_month_total']=0;
        $data['overall']=0;
	   
    	  $query = $this->db->query("SELECT round(sum(trs.issue_qty),2) as consumed_qty from tran_rmrcir_stock trs inner JOIN tran_rmrcir_mast trm on trs.mast_rmrcir_id=trm.id inner join 
    	  mast_rm mr on mr.rm_id=trs.rm_id where trm.date like '$current_month%' and trs.year='$_SESSION[current_year]'");
    	  $current_month_total = $query->row_array();
    	  
        	   if($current_month_total['consumed_qty']){
        	       $data['current_month_total']=number_format($current_month_total['consumed_qty'],0,".",","); 
        	   }
    	 $query1 = $this->db->query("SELECT round(sum(trs.issue_qty),2) as consumed_qty from tran_rmrcir_stock trs inner JOIN tran_rmrcir_mast trm on trs.mast_rmrcir_id=trm.id inner join 
    	  mast_rm mr on mr.rm_id=trs.rm_id where trm.date between '$mindate' and '$current_date' and trs.year='$_SESSION[current_year]'");
    	  $overall = $query1->row_array();
    	 
    	  if($overall['consumed_qty']){
    	         $data['overall']=number_format($overall['consumed_qty'],0,".",","); 
    	  }
	  return $data;
	}
		public function totalSchCompletion(){
    	  $month=date('Y-m');
    	   $query = $this->db->query("select (sum(inv.invqty)/sum(scheduled_qty)*100) as scheduled_per from tran_schedule sch 
	                            left join 
	                            (select tim.date,sum(tid.qty) as invqty,tid.part_id from tran_invoice_details tid 
	                            left join
	                            tran_invoice_mast tim on tim.id=tid.mast_inv_id where tim.date like '$month%' and tid.isdeleted=0) inv on sch.part_id = inv.part_id 
	                            where sch.to_date like '$month%'");
    	  $current_month_total = $query->row_array();
    	   //echo $this->db->last_query(); 
        	   $data['current_month_total']=0;
        	   if($current_month_total['scheduled_per']){
        	       $data['current_month_total']=round($current_month_total['scheduled_per'],2); 
        	   }
    	   	$mindate=getMinDate();
    	    $current_date=date('Y-m-d');
     
    	  $query1 = $this->db->query("select (sum(inv.invqty)/sum(scheduled_qty)*100) as scheduled_per from tran_schedule sch 
	                            left join 
	                            (select tim.date,sum(tid.qty) as invqty,tid.part_id  from tran_invoice_details tid 
	                            left join
	                            tran_invoice_mast tim on tim.id=tid.mast_inv_id where tim.date between '$mindate' and '$current_date' and tid.isdeleted=0) inv on sch.part_id = inv.part_id 
	                            where sch.to_date between '$mindate' and '$current_date'");
    	  $overall = $query1->row_array();
    	  //echo "<br>". $this->db->last_query();
        	  $data['overall']=0;
        	  if($overall['scheduled_per']){
        	         $data['overall']=round($overall['scheduled_per'],2); 
        	  }
    	  return $data; 
	}
	/*public function totalScheduleCompletion(){
	    $current_month = date('Y-m');
        $mindate=getMinDate();
        $current_date=date('Y-m-d');
        $data['current_month_total']=0;
        $data['overall']=0;
	   
    	  $query = $this->db->query("SELECT round(sum(trs.issue_qty),2) as consumed_qty from tran_rmrcir_stock trs inner JOIN tran_rmrcir_mast trm on trs.mast_rmrcir_id=trm.id inner join 
    	  mast_rm mr on mr.rm_id=trs.rm_id where trm.date like '$current_month%' and trs.year='$_SESSION[current_year]'");
    	  $current_month_total = $query->row_array();
    	  
        	   if($current_month_total['consumed_qty']){
        	       $data['current_month_total']=round($current_month_total['consumed_qty'],2); 
        	   }
    	 $query1 = $this->db->query("SELECT round(sum(trs.issue_qty),2) as consumed_qty from tran_rmrcir_stock trs inner JOIN tran_rmrcir_mast trm on trs.mast_rmrcir_id=trm.id inner join 
    	  mast_rm mr on mr.rm_id=trs.rm_id where trm.date between '$mindate' and '$current_date' and trs.year='$_SESSION[current_year]'");
    	  $overall = $query1->row_array();
    	 
    	  if($overall['consumed_qty']){
    	         $data['overall']=round($overall['consumed_qty'],2); 
    	  }
	  return $data;
	}*/
	
	public function getRejDPRSummary()
	{
	  
	   $fd = $_POST['from_date'];
	   $td = $_POST['to_date'];
	   $cust_id =$_POST['Customer_Id'];
	   $pid = $_POST['Part_Id'];
	   //$branch_id  =$_SESSION['branch_id'];
	   $year= $_SESSION['current_year'];
        // $query = $this->db->query("SELECT 'tran_dpr',tran_dpr.prod_plan_id,rpo.sequence_no,tran_dpr_stock.rejected_qty,tran_dpr_stock.branch_id,tran_dpr_stock.operation_id as op_id FROM tran_dpr_stock inner join rel_part_operation rpo on rpo.part_id=tran_dpr_stock.part_id and rpo.op_id=tran_dpr_stock.operation_id inner JOIN tran_dpr on tran_dpr.id = tran_dpr_stock.mast_dpr_id WHERE tran_dpr_stock.part_id = '$pid' and tran_dpr_stock.year = '$year' and tran_dpr.dpr_date between '$fd' and '$td' and tran_dpr_stock.rejected_qty>0
        //                             union
        //                             SELECT 'partsrcir',tran_partsrcir_stock.prod_plan_id,rpo.sequence_no,tran_partsrcir_stock.rejected_qty,tran_partsrcir_stock.branch_id,tran_partsrcir_stock.op_id FROM `tran_partsrcir_stock` inner join rel_part_operation rpo on rpo.part_id=tran_partsrcir_stock.part_id and rpo.op_id=tran_partsrcir_stock.op_id inner join tran_partsrcir_mast on tran_partsrcir_stock.mast_partsrcir_id = tran_partsrcir_mast.id WHERE tran_partsrcir_stock.part_id = '$pid' and tran_partsrcir_stock.year = '$year' and tran_partsrcir_mast.date between '$fd' and '$td' and tran_partsrcir_stock.rejected_qty>0 
        //                             order by sequence_no");
	  	   /* $query = $this->db->query("SELECT tdqc.`id`, tdqc.`dpr_id`, tdqc.`qc_id`, tdqc.`year`, tdqc.`time`, tdqc.`ideal_value`, tdqc.`tolerance`, tdqc.`piece_selection`, tdqc.`reading1`, tdqc.`reading2`, tdqc.`reading3`, tdqc.`reading4`, tdqc.`reading5`, tdqc.`reading`,tran_dpr.qc_remark,rpo.sequence_no,tran_dpr.rejected_qty,tran_dpr.branch_id,tran_dpr.operation_id as op_id,tran_dpr.`tool_id`, tran_dpr.`machine_id`, tran_dpr.`operator_id` 
                            	    FROM tran_dpr_quality_checks tdqc 
                            	    inner JOIN tran_dpr on tran_dpr.id = tdqc.dpr_id 
                            	    inner join rel_part_operation rpo on rpo.part_id=tran_dpr.part_id and rpo.op_id=tran_dpr.operation_id
                            	    inner join tran_oa_details tod on tod.part_id=tran_dpr.part_id
                            	    inner join tran_oa_mast tom on tod.mast_oa_id=tom.id
                            	    WHERE tom.customer_id='$cust_id' and tran_dpr.part_id = '$pid' and tran_dpr.year = '$year' and tran_dpr.dpr_date between '$fd' and '$td' and tran_dpr.rejected_qty>0 and tdqc.isdeleted=0 and tran_dpr.isdeleted=0 
                            	    order by sequence_no");*/
          $query = $this->db->query("SELECT tran_dpr.id as dpr_id, tran_dpr.dpr_date,tran_dpr.qc_remark,rpo.sequence_no,tran_dpr.rejected_qty,tran_dpr.branch_id,tran_dpr.operation_id as op_id,tran_dpr.`tool_id`, tran_dpr.`machine_id`, tran_dpr.`operator_id` FROM tran_dpr 
          inner join rel_part_operation rpo on rpo.part_id=tran_dpr.part_id and rpo.op_id=tran_dpr.operation_id 
          inner join tran_oa_details tod on tod.part_id=tran_dpr.part_id 
          inner join tran_oa_mast tom on tod.mast_oa_id=tom.id 
          WHERE tom.customer_id='$cust_id' and tran_dpr.part_id = '$pid' and tran_dpr.dpr_date between '$fd' and '$td' and tran_dpr.rejected_qty>0 and tran_dpr.isdeleted=0 and tran_dpr.rejected_qty>0 order by rpo.sequence_no");                    	    
        
	    $data = $query->result_array();
	    //echo "<br>". $this->db->last_query(); 
	    return $data;

	}
	public function getRejRCIRSummaryDetails(){
	   $fd = $_POST['from_date'];
	   $td = $_POST['to_date'];
	   $cust_id =$_POST['Customer_Id'];
	   $pid = $_POST['Part_Id'];
	   $year= $_SESSION['current_year'];

	  /*  $query = $this->db->query("SELECT tpqc.`id`, tpqc.`det_partsrcir_id`, tpqc.`qc_id`, tpqc.`year`, tpqc.`time`, tpqc.`ideal_value`, tpqc.`tolerance`, tpqc.`piece_selection`, tpqc.`reading1`, tpqc.`reading2`, tpqc.`reading3`, tpqc.`reading4`, tpqc.`reading5`, tpqc.`reading`,tpd.qc_remarks,rpo.sequence_no,tpd.rejected_qty,tpm.branch_id,tpd.op_id,tpm.supplier_id
                            	    FROM tran_partsrcir_quality_checks tpqc 
                            	    inner JOIN tran_partsrcir_details tpd on tpd.id = tpqc.det_partsrcir_id 
                            	    inner join tran_partsrcir_mast tpm on tpm.id=tpd.mast_partsrcir_id
                            	    inner join rel_part_operation rpo on rpo.part_id=tpd.part_id and rpo.op_id=tpd.op_id  
                            	    inner join tran_oa_details tod on tod.part_id=tpd.part_id
                            	    inner join tran_oa_mast tom on tod.mast_oa_id=tom.id
                            	    WHERE tom.customer_id='$cust_id' and tpd.part_id = '$pid' and tpm.year = '$year' and tpm.date between '$fd' and '$td' and tpd.rejected_qty>0 and tpqc.isdeleted=0 and tpm.isdeleted=0  and tpd.isdeleted=0
                            	    order by sequence_no");*/
        $query = $this->db->query("SELECT tpd.id as det_id,tpm.date,tpd.qc_remarks,rpo.sequence_no,tpd.rejected_qty,tpm.branch_id,tpd.op_id,tpm.supplier_id FROM tran_partsrcir_details tpd 
        inner join tran_partsrcir_mast tpm on tpm.id=tpd.mast_partsrcir_id 
        inner join rel_part_operation rpo on rpo.part_id=tpd.part_id and rpo.op_id=tpd.op_id 
        inner join tran_oa_details tod on tod.part_id=tpd.part_id 
        inner join tran_oa_mast tom on tod.mast_oa_id=tom.id 
        WHERE tom.customer_id='$cust_id' and tpd.part_id = '$pid' and tpm.date between '$fd' and '$td' and tpd.rejected_qty>0  and tpm.isdeleted=0 and tpd.isdeleted=0 order by sequence_no");
          
	    $data = $query->result_array();
	  //  echo "<br>". $this->db->last_query(); 
	    return $data;
	}
	
public function rejSummaryDashboardR(){
	  
	   $year= $_SESSION['current_year'];
       $month=date('Y-m');
	    $query = $this->db->query("select name as customer,sum(rejected_qty) as rejected_qty,part_id from (SELECT tom.customer_id,cust.name,tran_dpr.rejected_qty,tran_dpr.branch_id,tran_dpr.operation_id as op_id,tran_dpr.part_id 
                            	    FROM tran_dpr_quality_checks tdqc 
                            	    inner JOIN tran_dpr on tran_dpr.id = tdqc.dpr_id 
                            	    inner join rel_part_operation rpo on rpo.part_id=tran_dpr.part_id and rpo.op_id=tran_dpr.operation_id
                            	    inner join tran_oa_details tod on tod.part_id=tran_dpr.part_id
                            	    inner join tran_oa_mast tom on tod.mast_oa_id=tom.id
                            	    inner join mast_customer cust on tom.customer_id=cust.id
                            	    WHERE tran_dpr.year = '$year' and tran_dpr.dpr_date like '$month%' and tran_dpr.rejected_qty>0 and tdqc.isdeleted=0 and tran_dpr.isdeleted=0
	                               union all
	                                SELECT tom.customer_id,cust.name,tpd.rejected_qty,tpm.branch_id,tpd.op_id,tpd.part_id
                            	    FROM tran_partsrcir_quality_checks tpqc 
                            	    inner JOIN tran_partsrcir_details tpd on tpd.id = tpqc.det_partsrcir_id 
                            	    inner join tran_partsrcir_mast tpm on tpm.id=tpd.mast_partsrcir_id
                            	    inner join rel_part_operation rpo on rpo.part_id=tpd.part_id and rpo.op_id=tpd.op_id  
                            	    inner join tran_oa_details tod on tod.part_id=tpd.part_id
                            	    inner join tran_oa_mast tom on tod.mast_oa_id=tom.id
                            	     inner join mast_customer cust on tom.customer_id=cust.id
                            	    WHERE tpm.year = '$year' and tpm.date like '$month%' and tpd.rejected_qty>0 and tpqc.isdeleted=0 and tpm.isdeleted=0  and tpd.isdeleted=0
                            	    ) a group by customer_id");
	    $data = $query->result_array();
	    //echo "<br>". $this->db->last_query(); 
	    return $data;
}
public function tranToolsDashboardR(){
     $year= $_SESSION['current_year'];
     $query = $this->db->query("SELECT distinct(tt.tool_id),tt.`grinded_on`,mt.name,mt.ideal_qty FROM tran_tools tt inner join mast_tools mt on tt.tool_id=mt.id where isdeleted=0 group by tool_id order by grinded_on desc");
	 $data = $query->result_array();
	 $resultset=[];
	 foreach($data as $val){
	    $query = $this->db->query("SELECT sum(qty) as max_qty ,tool_id FROM tran_dpr where tool_id='$val[tool_id]' and dpr_date > '$val[grinded_on]' and year='$year' and isdeleted=0 group by tool_id");
	    $res = $query->row_array(); 
	    if($res['max_qty']){
	    $resultset[]=array('ideal_qty'=>$val['ideal_qty'],'max_qty'=>$res['max_qty'],'tname'=>$val['name']);
	    }
	 }
	 return $resultset;
}
	public function getLatestYear(){
    $query=$this->db->query("select year from tran_schedule order by year desc limit 1");
    $res = $query->row_array(); 
    return $res;
}
public function partStockDatewiseDetails(){
        $year= $_SESSION['current_year'];
        $y=explode("-",$year);
        $pid = $_POST['Part_Id'];

	    $view= "view".trim($y[0])."_".trim($y[1]);
	    
	      $between=$view.'.dpr_date <= date(NOW())';
	    
          if(!empty($_POST['schedule_from_date']) || !empty($_POST['schedule_to_date'])){
              
            $fromd      = $_POST['schedule_from_date'];
            if($fromd){  $fd 	= date("Y-m-d", strtotime($fromd)); }
            $tod        = $_POST['schedule_to_date'];
            if($tod){ $td 	= date("Y-m-d", strtotime($tod));}else{ $td = date("Y-m-d");  }
          
        	if($fd!="" && $td!=""){
        	 	$between =$view.".dpr_date BETWEEN '$fd' AND '$td' ";
             }elseif($fd!="" && $td==NULL){
                 $between=$view.".dpr_date >='$fd' ";
             }elseif($fd=="" && $td!=NULL){
                 $between=$view.".dpr_date <='$td' ";
             }
          }
	    
	   $query = $this->db->query("SELECT part_id,branch_id,move_from,move_to,received_doc_type,dpr_date,type,det_id,op_id,mast_operation.Name,mast_id,issue_qty,issue_doc_type,issue_doc_id,received_qty,received_doc_type,received_doc_id ,inprocess_loss_qty 
	   FROM $view inner join mast_operation on $view.op_id=mast_operation.id where part_id='$pid' and $between and ((type='dc' AND issue_qty>0) OR (type='RCIR' and received_qty+inprocess_loss_qty!=0) OR (type='DPR' and received_qty>0) OR (type='DPR' and issue_qty!=0 and issue_doc_type='invoice') OR (type='RCIR' and issue_qty!=0 and issue_doc_type='invoice') ) ORDER by dpr_date,type,det_id");
        $data = $query->result_array();
	   //echo "<br>". $this->db->last_query(); 
	    return $data;
   }
   
  public function getMastInvNoById($detid){
     $query = $this->db->query("SELECT tm.invoice_no,tm.date as inv_date FROM tran_invoice_details td inner join tran_invoice_mast tm  on td.mast_inv_id=tm.id where td.id='$detid' and td.isdeleted=0");
	 $data = $query->row_array();
	 return $data;  
  }
   
   public function getSupBranchByPart($pid,$type){
	
	$year=$_SESSION['current_year'];
    if($type=='B'){
      $branch_id=$_POST['branch_id'];
   
        $query=$this->db->query("select distinct mast_branch.id as id,part_id,op_id ,'B' as type,sequence_no from mast_branch,rel_part_operation 
        where part_id ='$pid' and  mast_branch.id='$branch_id' and isdeleted = 0 and current_year='$_SESSION[current_year]' and op_id not in (1,2) order by sequence_no,id,op_id");
    
    }elseif($type=='S'){
     
     $query=$this->db->query("SELECT tpm.supplier_id as id,tpd.part_id,tpd.op_id,tpd.id as parts_po_det_id,'S' as type,rpo.sequence_no FROM `tran_partspo_details` tpd 
        inner join tran_partspo_mast tpm on tpm.id=tpd.mast_partspo_id 
        inner join rel_part_operation rpo on tpd.part_id=rpo.part_id and tpd.op_id=rpo.op_id 
        where tpd.part_id='$pid' and tpd.isdeleted = 0 and rpo.isdeleted=0 and tpm.year='$_SESSION[current_year]' order by sequence_no,id,op_id");
   
    }
     $res = $query->result_array(); 
  // echo "<br>". $this->db->last_query();
    return $res;
 }

public function getTranPartStockAdjView(){
 
     if($_POST['date']){
	     	$scheduleDate  = $_POST['date'];
			$date 	   = date("Y-m", strtotime($scheduleDate)); 
			
			 $query=$this->db->query("SELECT `id`, `date`, `branch_id`, `supplier_id`, `part_id`, `op_id`, `qty`,remarks  FROM tran_part_stockadj where year='$_SESSION[current_year]' and date like '$date%' order by date desc");
           
	    }else{
	        $date=date("Y-m");
	       $query=$this->db->query("SELECT `id`, `date`, `branch_id`, `supplier_id`, `part_id`, `op_id`, `qty`,remarks  FROM tran_part_stockadj where year='$_SESSION[current_year]'  and date like '$date%' order by date desc limit 10");
	      
	    }
	 $data = $query->result_array();
	 return $data;
}

public function getTranPartAdjQty($part_id,$op_id,$bsid,$type,$date){
    $where='';
    if($type=='B'){
      $where="branch_id=".$bsid;
    }elseif($type=='S'){
      $where="supplier_id=".$bsid;  
    }
    $query=$this->db->query("SELECT * FROM `tran_part_stockadj` WHERE part_id='$part_id' and op_id='$op_id' and date='$date' and year='$_SESSION[current_year]' and $where");
    $res = $query->row_array(); 
   // echo "<br>". $this->db->last_query(); 
    return $res;
    
}
public function getTranPartAdjUsedQty($type,$id){
   
    if($type=='B'){
       $query=$this->db->query("SELECT det_partsrcir_id FROM `tran_partsrcir_stock` WHERE received_doc_type='stock_adj' and received_doc_id='$id'");
       $res = $query->row_array(); 
       
       $count=0;
       if(!empty($res['det_partsrcir_id'])){
        $query1=$this->db->query("SELECT count(det_partsrcir_id) as count FROM `tran_partsrcir_stock` WHERE det_partsrcir_id='$res[det_partsrcir_id]'");
        $res1 = $query1->row_array(); 
        $count=$res1['count'];
       }
       return $count;
       
    }elseif($type=='S'){
        $query=$this->db->query("SELECT det_dc_id FROM `tran_dc_stock` WHERE issue_doc_type='stock_adj' and issue_doc_id='$id'");
        $res = $query->row_array(); 
       
       $count=0;
       if(!empty($res['det_dc_id'])){
        $query1=$this->db->query("SELECT count(det_dc_id) as count FROM `tran_dc_stock` WHERE det_dc_id='$res[det_dc_id]'");
        $res1 = $query1->row_array(); 
        $count=$res1['count'];
       }
       return $count;
    }
}

/*public function getTranPartAdjQtyCnt($part_id,$op_id,$bsid,$type,$date){
    $where='';
    if($type=='B'){
      $where="branch_id=".$bsid;
    }elseif($type=='S'){
      $where="supplier_id=".$bsid;  
    }
    $query=$this->db->query("SELECT id  FROM `tran_part_stockadj` 
    WHERE part_id='$part_id' and op_id='$op_id' and date='$date'  and $where");
    $res = $query->num_rows(); 
   // echo "<br>". $this->db->last_query(); 
    return $res;
    
}*/


    public function getInvDetailsforCorrection()
    {
    $query=$this->db->query("select tid.*,tim.date from tran_invoice_details tid inner join tran_invoice_mast tim on tim.id = tid.mast_inv_id where tid.id in(93,117,191,195,213,217,223,233,236,240,246,252,305,306) and tid.isdeleted=0  order by tid.id");
    $res = $query->result_array(); 
    return $res;
 
    }
    
    public function getPackingQty($partId,$branch_id)
	{
		 $query = $this->db->query("SELECT mprd.id as det_id, mprd.mast_partsrcir_id as mast_id,mpro.date,'partrcir' as doc,mprd.op_id as op_id,temp.max_qty FROM tran_partsrcir_details mprd INNER JOIN tran_partsrcir_mast mpro on mpro.id = mprd.mast_partsrcir_id inner join (select det_partsrcir_id,sum(received_qty-issue_qty-inprocess_loss_qty-rejected_qty) as max_qty from tran_partsrcir_stock where part_id='$partId' and op_id='47' and year='$_SESSION[current_year]' and branch_id='$_SESSION[branch_id]'  group by det_partsrcir_id) temp on temp.det_partsrcir_id= mprd.id where temp.max_qty >0 
		        union all SELECT tran_dpr_stock.id as det_id,tran_dpr_stock.mast_dpr_id as mast_id,tran_dpr.dpr_date as date, 'dpr' as doc,tran_dpr.operation_id as op_id ,temp.max_qty from tran_dpr_stock INNER JOIN tran_dpr on tran_dpr.id = tran_dpr_stock.mast_dpr_id inner join (select mast_dpr_id,sum(received_qty-issue_qty-inprocess_loss_qty-rejected_qty) as max_qty from tran_dpr_stock where part_id='$partId' and operation_id='47' and year = '$_SESSION[current_year]' and branch_id='$_SESSION[branch_id]' group by mast_dpr_id) temp on temp.mast_dpr_id= tran_dpr.id where temp.max_qty >0 
		        GROUP BY tran_dpr_stock.mast_dpr_id order by date");
         $data = $query->result_array();
    	 //echo $this->db->last_query();
    	 return $data;

	}
	
	  public function getInvAvailableQty()
	{
	     $query = $this->db->query("SELECT part_id,sum(qty) as qty from tab_inv group by part_id");
         $data = $query->result_array();
    	 //echo $this->db->last_query();
    	 $msg='';
    	 foreach($data as $data1){
    	     	$query1 = $this->db->query("Select if(sum(max_qty),sum(max_qty),0) as max_qty from(SELECT temp.max_qty FROM tran_partsrcir_details mprd INNER JOIN tran_partsrcir_mast mpro on mpro.id = mprd.mast_partsrcir_id inner join (select det_partsrcir_id,sum(received_qty-issue_qty-inprocess_loss_qty-rejected_qty) as max_qty from tran_partsrcir_stock where part_id='$data1[part_id]' and op_id='47' and year='$_SESSION[current_year]' and branch_id='$_SESSION[branch_id]' group by det_partsrcir_id) temp on temp.det_partsrcir_id= mprd.id where temp.max_qty >0 
		        union all SELECT temp.max_qty from tran_dpr_stock INNER JOIN tran_dpr on tran_dpr.id = tran_dpr_stock.mast_dpr_id inner join (select mast_dpr_id,sum(received_qty-issue_qty-inprocess_loss_qty-rejected_qty) as max_qty from tran_dpr_stock where part_id='$data1[part_id]' and operation_id='47' and year = '$_SESSION[current_year]' and branch_id='$_SESSION[branch_id]' group by mast_dpr_id) temp on temp.mast_dpr_id= tran_dpr.id where temp.max_qty >0 
		        GROUP BY tran_dpr_stock.mast_dpr_id) a");
                  $res = $query1->row_array();
                  //echo $this->db->last_query(); die;
                  if($data1['qty']>$res['max_qty']){
                      $pdata=$this->getPartsById($data1['part_id']);
                      $bdata=$this->getBranchbyId($_SESSION['branch_id']);
                    $msg.=" Insufficient Qty  @".$bdata['name']."   &nbsp;&nbsp;&nbsp;for Part_id : ".$data1['part_id']."-".$pdata['partno']." - ".$pdata['name']."    &nbsp;&nbsp;&nbsp; Available Qty - ".$res['max_qty']."       &nbsp;&nbsp;&nbsp;Total Invoice Qty - ".$data1['qty']."\n";  
                  }
    	 }
    	 return $msg;

	}
public function getPartRmbyid($rmid)
	{
	 $query = $this->db->query("SELECT part_id FROM rel_part_rm where rm_id='$rmid' and isdeleted=0");
	 $data = $query->result_array();
	 return $data;
	}
	
	  //********************** 22-02-2024 ********************************
    public function getReworkOpQty($partId,$opId)
	{
	      $branch_id     =$_SESSION['branch_id'];
	  
    	  $query = $this->db->query("select op_id from rel_part_operation where part_id ='$partId' and sequence_no= (select sequence_no-1 from rel_part_operation where part_id='$partId' and op_id='$opId' and isdeleted=0) and isdeleted = 0");
          $PreOPIds = $query->row_array();
       	
        $PreOPId = $PreOPIds['op_id'];
        
	    if($branch_id==null){
	           $branch_id     =$_SESSION['branch_id'];
	    }
	    
	     $query = $this->db->query("SELECT qc_requiredfor_dpr FROM mast_operation where id='$PreOPId' and isdeleted=0 ");
	     $Opdata = $query->row_array();
      	 $qc_requiredfor_dpr=$Opdata['qc_requiredfor_dpr'];
      	 $totalStock = 0;
        if($qc_requiredfor_dpr==0){
           // echo "$$$$$$$$$$$$$";
        	   	$query = $this->db->query("select sum(received_qty-issue_qty-inprocess_loss_qty-rejected_qty) as max_qty from tran_dpr_stock where part_id = '$partId' and operation_id ='$PreOPId' and year = '$_SESSION[current_year]' and branch_id ='$branch_id' and mast_dpr_id in(select mast_dpr_id from tran_dpr_stock where received_doc_type='qc_rework')
                           union all 
                           select sum(received_qty-issue_qty-inprocess_loss_qty-rejected_qty) as max_qty from tran_partsrcir_stock where part_id='$partId' and op_id='$PreOPId' and branch_id ='$branch_id' and year = '$_SESSION[current_year]' and (received_qty+issue_qty+inprocess_loss_qty+rejected_qty)!=0 and det_partsrcir_id!=0 and det_partsrcir_id in(select det_partsrcir_id from tran_partsrcir_stock where received_doc_type='qc_rework')"); 
                          // or  ( det_partsrcir_id in (select det_partsrcir_id FROM `tran_partsrcir_stock` where part_id='$partId' and op_id='$PreOPId' and branch_id ='$branch_id' and year = '$_SESSION[current_year]'  and (received_doc_type='p_movement' or received_doc_type='supl_pmovement' or received_doc_type='stock_adj' or issue_doc_type='stock_adj' or received_doc_type='O.B.')))");
        	    	
         }
         else
	    {
	      // echo "@@@@@@@@@@@";
    	    $query = $this->db->query("select sum(received_qty-issue_qty-inprocess_loss_qty-rejected_qty) as max_qty from tran_dpr_stock where part_id = '$partId' and operation_id ='$PreOPId' and year = '$_SESSION[current_year]' and branch_id ='$branch_id' and mast_dpr_id in(select dpr_id from tran_dpr_quality_checks where year = '$_SESSION[current_year]')  
    	        union all select sum(received_qty-issue_qty-inprocess_loss_qty-rejected_qty) as max_qty from tran_partsrcir_stock where part_id='$partId' and op_id='$PreOPId' and branch_id ='$branch_id' and year = '$_SESSION[current_year]' and (received_qty+issue_qty+inprocess_loss_qty+rejected_qty)!=0 and (det_partsrcir_id in(SELECT det_partsrcir_id FROM `tran_partsrcir_quality_checks` where year = '$_SESSION[current_year]'  union all select det_partsrcir_id FROM `tran_partsrcir_stock` where part_id='$partId' and op_id='$PreOPId' and branch_id ='$branch_id' and year = '$_SESSION[current_year]'  and (received_doc_type='p_movement' or received_doc_type='supl_pmovement' or issue_doc_type='p_movement' or issue_doc_type='supl_pmovement' or received_doc_type='stock_adj' or issue_doc_type='stock_adj' or received_doc_type='O.B.')) )");
     	}
     	$data = $query->result_array();
     	//	echo "<br>".$this->db->last_query();
		$totalStock = 0;
		if(!empty($data))
		{
			foreach ($data as $key => $value) {
				$totalStock += $value['max_qty'];
			}
		}
		return $totalStock;
	
	}
	 //********************** 22-02-2024 ********************************
   	public function GetQcPartsrcirIssueQty($id)
	{
	 $query = $this->db->query("SELECT sum(issue_qty) as issue_qty from tran_partsrcir_stock where det_partsrcir_id= '$id' and isdeleted = 0  and year='$_SESSION[current_year]'");
	 $data = $query->row_array();
	 return $data;
	}
	public function GetQcDprIssueQty($id)
	{
	 $query = $this->db->query("SELECT sum(issue_qty) as issue_qty from tran_dpr_stock where mast_dpr_id= '$id' and isdeleted = 0  and year='$_SESSION[current_year]'");
	 $data = $query->row_array();
	 return $data;
	}
    //added on 24-02-2024
    public function getPrevPartOperationQty()
	{
     $partId = $_POST['Part_Id'];
	 $opId = $_POST['Op_Id'];
	 
	 //get previous op_id
	  $query = $this->db->query("select op_id from rel_part_operation where part_id ='$partId' and sequence_no= (select sequence_no-1 from rel_part_operation where part_id='$partId' and op_id='$opId' and isdeleted=0) and isdeleted = 0");
      $PreOPIds = $query->row_array();
      
      $popid=$PreOPIds['op_id'];
	 
	 $query = $this->db->query("SELECT `id`, `nosperkg` FROM rel_part_operation where part_id='$partId' and op_id='$popid' and isdeleted=0 order by sequence_no");
	 $data = $query->row_array();
	 return $data;
	}
	
	public function invoiceDetailsReport(){
	 //error_reporting(E_ALL);
	     // $td =date('Y-m-d',strtotime($_POST['to_date']));
	      $branch_id =$_POST['branch_id'];
	  
	  $query = $this->db->query("select issue_qty,part_id,issue_doc_id,tran_date,name,partno from (SELECT tds.issue_qty,tds.part_id,tds.issue_doc_id,tds.tran_date,ms.partno,ms.name from tran_dpr_stock tds 
	  inner join mast_part ms on tds.part_id=ms.part_id 
	  where tds.branch_id='$branch_id' and issue_doc_type='invoice' and mast_dpr_id='9999999' and issue_qty!=0
	  Union All
	  SELECT tds.issue_qty,tds.part_id,tds.issue_doc_id,tds.tran_date,ms.partno,ms.name from tran_partsrcir_stock tds 
	  inner join mast_part ms on tds.part_id=ms.part_id 
	  where tds.branch_id='$branch_id' and issue_doc_type='invoice' and det_partsrcir_id='9999999' and issue_qty!=0) a order by tran_date,partno");
	  $data = $query->result_array();
	  //echo "<br>". $this->db->last_query(); 
	 return $data;
	}
	
	//created on 11-03-2024
		public function getDCDetailsbydocId($det_id){
		   $query = $this->db->query("select concat(mast_id,' - ',det_id,' Qty ',received_qty) as dc_details from view2023_24 where received_doc_id = '$det_id' and type= 'DC'");
	       $data = $query->row_array(); 
	       	 return $data;
		}
		
	public function getDCDetailsRCIR()
 	{
 	     $supId =$this->input->post('Supplier_Id');
 	     $fd    = $_POST['from_date'];
	     $td    = $_POST['to_date'];
	     $partid=$this->input->post('Part_Id');
	     $Op_Id=$this->input->post('Op_Id');
	     $partnm=$this->input->post('Part_Search');
 	
    	 /* $sql = "select tdd.id,tdd.qty as ordered_qty,tdd.part_id,tdm.supplier_id,tdm.id as dc_mast_id,tdm.dc_no,tdm.date,tdd.op_id from tran_dc_details tdd 
 		 inner join tran_dc_mast tdm on tdm.id = tdd.mast_dc_id 
 		 where tdm.supplier_id = '$supId'  and tdd.isdeleted = 0 and tdm.year = '$_SESSION[current_year]' and tdm.date between '$fd' and '$td'";*/
 		 
 		   $sql = "select tdd.id,tdd.qty as ordered_qty,tdd.part_id,tdm.supplier_id,tdm.id as dc_mast_id,tdm.dc_no,tdm.date,tdd.op_id,tdm.branch_id from tran_dc_details tdd  
 		 inner join tran_dc_mast tdm on tdm.id = tdd.mast_dc_id inner join tran_dc_stock tds on tdd.id=tds.det_dc_id
 		 where tdm.supplier_id = '$supId'  and tdd.isdeleted = 0  and ((tdm.year = '$_SESSION[current_year]' and tdm.date between '$fd' and '$td') OR tds.tran_date between '$fd' and '$td')";
 		 
 		 if($partid && $partnm){
 		     $sql.=" and tdd.part_id = '$partid' ";
 		         if($Op_Id){
 		           $sql.=" and tdd.op_id = '$Op_Id' ";
 		      }
 		 }
 		 $sql.=" group by tdd.id order by tdd.part_id,tdd.id";
    	 $query = $this->db->query($sql);
    	 $PreOPIds2 = $query->result_array();
       	//	echo $this->db->last_query(); 
		return $PreOPIds2;
 	}
 	
 	
		
	public function getDCRCIRReceivedQtyByDCId($id)
	{
		 /*$query = $this->db->query("SELECT sum(tpd.qty) as rec_qty,sum(tpd.inprocess_loss_qty) as loss_qty ,tpm.date , tpd.id as rcir_id,tpm.challan_no as rec_challan_no,tpm.branch_id FROM `tran_partsrcir_details` tpd 
		 inner join tran_partsrcir_mast tpm on tpd.mast_partsrcir_id=tpm.id WHERE tpd.dc_det_id='$id' group by tpd.id,tpd.mast_partsrcir_id having (rec_qty+loss_qty)!=0");
		 */
		 $query= "select rcird.id,dcs.received_qty as rec_qty,dcs.inprocess_loss_qty as loss_qty,dcs.tran_date as date,dcs.received_doc_type ,concat(rcird.mast_partsrcir_id,'-',rcird.id) as rcir_id,rcirm.challan_no as rec_challan_no,dcs.received_doc_type from tran_dc_stock dcs inner join tran_partsrcir_details rcird on dcs.received_doc_id = rcird.id inner join tran_partsrcir_mast rcirm  on rcird.mast_partsrcir_id =rcirm.id where dcs.det_dc_id = '$id' and dcs.issue_qty=0";
		 $data1 = $this->db->query($query);
		 $data = $data1->result_array();
		// echo "<br>". $this->db->last_query(); 
		 return $data;
	}
	
	
    public function getRCIRDetails()
 	{
 	     $supId =$this->input->post('Supplier_Id');
 	     $fd    = $_POST['from_date'];
	     $td    = $_POST['to_date'];
	     $partid=$this->input->post('Part_Id');
	     $Op_Id=$this->input->post('Op_Id');
	     $partnm=$this->input->post('Part_Search');
 	
    	$sql = "select tdd.id,tdd.qty as rcir_qty,tdd.rejected_qty,tdd.inprocess_loss_qty,tdd.part_id,tdm.supplier_id,tdm.id as rcir_mast_id,tdm.challan_no,tdm.challan_date,tdm.date,tdd.op_id,tdm.branch_id from tran_partsrcir_details tdd 
 		 inner join tran_partsrcir_mast tdm on tdm.id = tdd.mast_partsrcir_id 
 		 where (tdm.supplier_id in ('$supId',0))  and tdd.isdeleted = 0 and tdm.year = '$_SESSION[current_year]' and tdm.date between '$fd' and '$td'";
 		// or tdm.challan_no='p_movement'
 		
 		 if($partid && $partnm){
 		     $sql.=" and tdd.part_id = '$partid' ";
 		      if($Op_Id){
 		           $sql.=" and tdd.op_id = '$Op_Id' ";
 		      }
 		     
 		 }
 		 $sql.=" group by tdd.id order by tdd.part_id,tdd.id";
    	 $query = $this->db->query($sql);
    	 $PreOPIds2 = $query->result_array();
       	//	echo $this->db->last_query(); 
		return $PreOPIds2;
 	}
 	
 	public function getRCIRIssueQtyById($id)
	{
		 
		 $query= "select rejected_qty,rejected_doc_id,rejected_doc_type,issue_doc_id,issue_qty,issue_doc_type,move_to,tran_date,branch_id,updated_on from tran_partsrcir_stock where det_partsrcir_id='$id' and received_qty<=0 and (issue_qty!=0 or rejected_qty!=0)";
		 $data1 = $this->db->query($query);
		 $data = $data1->result_array();
	// echo "<br>". $this->db->last_query(); 
		 return $data;
	}
	
  //---- Defect Registration Module - 18-03-2024 ----
  
	public function getDefectregistration(){
	    
        $date=($_POST['date'])?date("Y-m", strtotime($_POST['date'])):date("Y-m");
        $query = $this->db->query("SELECT *  FROM `defect_registation` WHERE date like '$date%' and isdeleted=0");
        $data = $query->result_array();
          // echo "<br>". $this->db->last_query(); 
        return $data;
	}


	public function getDefregMastById($id)
	{
    	 $query = $this->db->query("SELECT * FROM `defect_registation` where id='$id' ");
    	 $data = $query->row_array();
    	 return $data;
	}

	
	//created on 19 March 2024
	public function getDPRDetails()
 	{
 	     $branch_id =$this->input->post('branch_id');
 	     $fd    = $_POST['from_date'];
	     $td    = $_POST['to_date'];
	     $partid=$this->input->post('Part_Id');
	     $Op_Id=$this->input->post('Op_Id');
	     $partnm=$this->input->post('Part_Search');
 	
    		$sql = "select dprs.id,dprs.mast_dpr_id,dprs.part_id,dprs.operation_id,dprs.received_qty,dprs.inprocess_loss_qty,dprs.tran_date,dprs.branch_id from tran_dpr_stock dprs
    		where dprs.received_qty>0 and dprs.branch_id='$branch_id' and dprs.year = '$_SESSION[current_year]' and dprs.tran_date between '$fd' and '$td'";
 
 		 if($partid && $partnm){
 		     $sql.=" and dprs.part_id = '$partid' ";
 		     if($Op_Id){
 		           $sql.=" and dprs.operation_id = '$Op_Id' ";
 		      }
 		 }
 		 $sql.=" group by dprs.id order by dprs.part_id,dprs.id";
    	 $query = $this->db->query($sql);
    	 $PreOPIds2 = $query->result_array();
       	//echo $this->db->last_query(); 
		return $PreOPIds2;
 	}
 	
 		public function getDPRReceivedQtyById($id)
	{
	    error_reporting(0);
		 $query= "select dprs.branch_id,dprs.issue_qty,dprs.issue_doc_id,dprs.issue_doc_type,dprs.tran_date,tid.id as det_id,tid.mast_inv_id as mast_id from tran_dpr_stock dprs inner join tran_invoice_details tid on dprs.issue_doc_id=tid.id
		 where dprs.issue_doc_type='invoice' and dprs.issue_qty!=0 and dprs.mast_dpr_id='$id' UNION ALL 
		 select dprs.branch_id,dprs.issue_qty,dprs.issue_doc_id,dprs.issue_doc_type,dprs.tran_date,tid.id as det_id,tid.mast_dc_id as mast_id from tran_dpr_stock dprs inner join tran_dc_details tid on dprs.issue_doc_id=tid.id
		 where dprs.issue_doc_type='tran_dc' and dprs.issue_qty!=0 and dprs.mast_dpr_id='$id'  UNION ALL 
		 select dprs.branch_id,dprs.issue_qty,dprs.issue_doc_id,dprs.issue_doc_type,dprs.tran_date,dprs.mast_dpr_id as det_id,dprs.mast_dpr_id as mast_id from tran_dpr_stock dprs 
		 where (dprs.issue_doc_type='tran_dpr' or dprs.issue_doc_type='stock_adj' or dprs.issue_doc_type='p_movement') and dprs.issue_qty!=0 and dprs.mast_dpr_id='$id'";
		 $data1 = $this->db->query($query);
		 $data = $data1->result_array();
		 //echo "<br>". $this->db->last_query(); 
		 return $data;
	}
	
	//25 March 2024
	public function getToolRepairDetails(){
	    
       // $date=($_POST['date'])?date("Y-m", strtotime($_POST['date'])):date("Y-m");
       $status=$_POST['status'];
       $tool_maker=$_POST['tool_maker'];
          
      
           $sql="SELECT `id`, `tool_id`, `tool_name`, `remarks`, identified_on ,`issue_date`, `estimated_amt`, `advance_amt`, `supplier_id`, `tool_maker`, `received_date`, `tot_amt_paid`,new_development  FROM `tool_repair`";
           
               if($status=='received'){
                            $sql.=" where  received_date!=''";  
                       } 
               else if($status=='issued'){
                    $sql.="  where  issue_date!='' and (received_date='' || isnull(received_date))";  
               }   
               else if($status=='identified'){
                       $sql.="  where identified_on!='' and (issue_date='' || isnull(issue_date)) and (received_date='' || isnull(received_date))";  
               }
               
               if($tool_maker && $status!=''){
                       $sql.="  and supplier_id='$tool_maker'"; 
               }else if($tool_maker && $status==NULL){
                    $sql.="  where supplier_id='$tool_maker'"; 
               }
          //echo $sql;
        $query = $this->db->query($sql);
        $data = $query->result_array();
       
          // echo "<br>". $this->db->last_query(); 
        return $data;
	}
	
	public function getToolRepairDetailsById($id)
	{
    	 $query = $this->db->query("SELECT * FROM `tool_repair` where id='$id' ");
    	 $data = $query->row_array();
    	 return $data;
	}

//29 March 2024
	public function getToolMaker()
	{
	    
		$query = $this->db->query(" select `id`, `name`, `address`, `gstno` from mast_tool_maker where isdeleted=0 order by id desc");
	    $data = $query->result_array();
	    return $data;
		
	}
	public function getToolMakerById($id)
	{
		$query = $this->db->query(" select * from mast_tool_maker where id='$id'");
	    $data = $query->row_array();
	    return $data;
		
	}
	
	
		public function getRMBalQty($det_rmcrcir_id)
	{
	
	 $query = $this->db->query("select sum(received_qty-issue_qty-rejected_qty) as bal_qty  FROM `tran_rmrcir_stock`  WHERE `det_rmrcir_id` = '$det_rmcrcir_id'");
	 	$data = $query->row_array();
	 	return $data['bal_qty'];
	}


     public function YearlyClsoing($pid){
        $year= $_SESSION['current_year'];
        $fd = getMinDate();
	    $td = $_POST['to_date'];
        $query = $this->db->query("select part_id,doc_type,received_doc_type,doc_id,sequence_no,sum(qty) as qty,move_from,move_to,branch_id,op_id FROM( SELECT tran_dpr_stock.part_id,'DPR' as doc_type,received_doc_type,mast_dpr_id as doc_id,move_from,move_to,rpo.sequence_no,sum(received_qty-tran_dpr_stock.rejected_qty-issue_qty-inprocess_loss_qty) as qty,tran_dpr_stock.branch_id,tran_dpr_stock.operation_id as op_id FROM tran_dpr_stock inner join rel_part_operation rpo on rpo.part_id=tran_dpr_stock.part_id and rpo.op_id=tran_dpr_stock.operation_id inner JOIN tran_dpr on tran_dpr.id = tran_dpr_stock.mast_dpr_id WHERE tran_dpr_stock.mast_dpr_id!='9999999' and tran_dpr_stock.part_id = '$pid' and tran_dpr_stock.year = '$year'  and tran_dpr_stock.tran_date between '$fd' and '$td' and (tran_dpr_stock.received_qty>0 or tran_dpr_stock.issue_qty>0 or tran_dpr_stock.rejected_qty>0 or tran_dpr_stock.inprocess_loss_qty >0) group by tran_dpr_stock.mast_dpr_id,tran_dpr_stock.operation_id
                                    union all
                                    SELECT tran_partsrcir_stock.part_id,'RCIR' as doc_type,received_doc_type,det_partsrcir_id as doc_id,move_from,move_to,rpo.sequence_no,sum(received_qty-rejected_qty-issue_qty-inprocess_loss_qty) as qty,tran_partsrcir_stock.branch_id,tran_partsrcir_stock.op_id FROM `tran_partsrcir_stock` inner join rel_part_operation rpo on rpo.part_id=tran_partsrcir_stock.part_id and rpo.op_id=tran_partsrcir_stock.op_id inner join tran_partsrcir_mast on tran_partsrcir_stock.mast_partsrcir_id = tran_partsrcir_mast.id WHERE tran_partsrcir_stock.det_partsrcir_id!='9999999' and tran_partsrcir_stock.part_id = '$pid' and tran_partsrcir_stock.year = '$year' and tran_partsrcir_stock.tran_date between '$fd' and '$td' and (tran_partsrcir_stock.received_qty!=0 or tran_partsrcir_stock.issue_qty!=0 or tran_partsrcir_stock.rejected_qty!=0 or tran_partsrcir_stock.inprocess_loss_qty !=0) and det_partsrcir_id!=0 group by tran_partsrcir_stock.det_partsrcir_id,tran_partsrcir_stock.op_id
                               order by sequence_no) a GROUP by branch_id,op_id order by sequence_no");
                               //doc_type,doc_id
    
         $res = $query->result_array();
         foreach ($res as $res1)
         
         {
             if($res1[qty]!=0)
             {
         $query1=" INSERT INTO `tran_partsrcir_mast`( `supplier_id`, `branch_id`, `date`, `year`,   `challan_no`, `challan_date`, `remarks`, `isdeleted`, `created_on`, `created_by`, `updated_on`, `updated_by`) 
                                                VALUES ('0',$res1[branch_id],'2024-04-01','2024 - 25','O.B.',     '2024-04-01',   'O.B.',     '0',        now(),          '1',            now(),      '1')";
            $query=$this->db->query($query1);                                        
             $mast_id= $this->db->insert_id();
            
            $query2=" INSERT INTO `tran_partsrcir_details`( `mast_partsrcir_id`, `tran_partspo_det_id`, `supp_schedule_id`, `dc_det_id`, `part_id`, `op_id`,        `year`,      `qty`,       `isdeleted`, `created_by`, `created_on`, `updated_by`, `updated_on`)
                                                        VALUES ('$mast_id',               0,                  0,                  0,       '$pid', '$res1[op_id]','2024 - 25','$res1[qty]',         0,     1,now(),1,now())";
              $query=$this->db->query($query2);                                        
             $det_id= $this->db->insert_id();
      
            $query3="INSERT INTO `tran_partsrcir_stock`( `year`,    `doc_year`, `tran_date`, `branch_id`,    `mast_partsrcir_id`, `det_partsrcir_id`, `move_from`, `move_to`, `part_id`, `op_id`,      `received_qty`, `received_doc_type`, `received_doc_id`,  `det_rmrcir_id`, `created_on`, `isdeleted`, `created_by`, `updated_by`, `updated_on`) 
                                                VALUES ('2024 - 25','2023-24',  '2024-04-01','$res1[branch_id]','$mast_id',             '$det_id',  '$res1[move_from]','$res1[move_to]',     '$pid','$res1[op_id]','$res1[qty]',     'O.B.',             '$det_id',         0,                     now(),          0,          1,          1   ,           now())";
            
              $query=$this->db->query($query3);                                        
             $det_id= $this->db->insert_id();
             
             }

         }
	  // return ;
   }
   
      public function YearlyClsoingDc($pid){
        $year= $_SESSION['current_year'];
        $fd = getMinDate();
	    $td = $_POST['to_date'];
      
      $query1= "  insert into tran_dc_stock (year, doc_year, tran_date, mast_dc_id, det_dc_id,branch_id,op_id,  part_id,move_from,move_to,
                                            issue_qty,issue_doc_type,issue_doc_id,det_rmrcir_id,created_on,created_by,updated_by,updated_on)
    
                        SELECT '2024 - 25', '2023 - 24', '2024-04-01', `mast_dc_id`, `det_dc_id`,branch_id,op_id,  part_id,move_from,move_to
                        ,sum(-issue_qty+inprocess_loss_qty+received_qty+rejected_qty)*-1 as issue_qty,issue_doc_type,issue_doc_id,det_rmrcir_id,
                        now(),'1','1',now() FROM `tran_dc_stock` 
                    
                        WHERE part_id = '$pid' and year = '$year' and tran_date between '$fd' and '$td' and (received_qty>0 or issue_qty>0 or rejected_qty>0 or inprocess_loss_qty >0)
                        group by det_dc_id having issue_qty !=0;";
        
	         $query=$this->db->query($query1);                                        
       echo "<br><br><br>". $this->db->last_query(); 
	   
	    return;
   }

      public function YearlyClsoingPartsPO(){
   
        $query1= "select * from tran_partspo_mast where year = '2023 - 24'";
        $query=$this->db->query($query1);   
        $res = $query->result_array();
        foreach ($res as $res1)
         
       { 
             $query_mast="INSERT INTO `tran_partspo_mast`( `year`, `date`, `wef_date`, `supplier_id`, `Payment_terms`, `remarks`, `created_on`, `created_by`, `updated_on`, `updated_by`) 
                                                    select  '2024 - 25', '2024-04-01', '2024-04-01','$res1[supplier_id]','$res1[Payment_terms]','$res1[remarks]',now(),'1',now(),'1'";
             
              $query=$this->db->query($query_mast);                                        
                 $mast_id= $this->db->insert_id();
              
            
             $query_det = "INSERT INTO `tran_partspo_details`( `mast_partspo_id`, `part_id`, `op_id`, `qty`, `qty_in_kgs`, `rate`, `uom`, `part_remark`, `igst`, `cgst`, `sgst`, `isdeleted`, `created_by`, `created_on`, `updated_by`, `updated_on`) 
                                                 select '$mast_id',`part_id`, `op_id`, `qty`, `qty_in_kgs`, `rate`, `uom`, `part_remark`, `igst`, `cgst`, `sgst`, `isdeleted`, '1', now(), '1', now() from tran_partspo_details where mast_partspo_id = '$res1[id]' and isdeleted = 0"; 
                            
              $query=$this->db->query($query_det);                                        
              echo "<br><br><br>". $this->db->last_query(); 
	        }
        return;
        }
        
        public function getRMtraceability($partid,$invoice_no){
            
            $query1= "SELECT td.`id`, td.`mast_inv_id`, td.`schedule_id`, td.`prod_plan_id`, td.`oa_det_id`, td.`branch_id`, td.`part_id`, td.`qty`,tm.date,tm.invoice_no,tm.customer_id FROM `tran_invoice_mast` tm inner join tran_invoice_details td on tm.id=td.mast_inv_id where tm.invoice_no = '$invoice_no' and td.part_id='$partid'";
            $query=$this->db->query($query1);   
            $res = $query->result_array(); 
            //  echo "<br><b>Report  - ************************</b><br>". $this->db->last_query(); 
            // echo "<pre>"; print_r($res); echo "</pre>";
            return  $res ;
        }
        
        //created on 11-06-2024
        public function userDetailsbyEmailid($email_id)
    	{
    		$query = $this->db->query("SELECT * FROM `mast_users` where email_id='$email_id'");
    	    $data = $query->row_array();
    	       //  echo "<br><br><br>". $this->db->last_query(); 
    	    return $data;
    		
    	}
		   public function getPmovementRCIRDetails()
 	{
 	     $branch_id =$this->input->post('branch_id');
 	     $fd    = $_POST['from_date'];
	     $td    = $_POST['to_date'];
	     $partid=$this->input->post('Part_Id');
	     $Op_Id = $this->input->post('Op_Id');
	     $partnm=$this->input->post('Part_Search');
 	
    	$sql = "select tdd.id,tdd.qty as rcir_qty,tdd.inprocess_loss_qty,tdd.part_id,tdm.supplier_id,tdm.id as rcir_mast_id,tdm.challan_no,tdm.challan_date,tdm.date,tdd.op_id,tdm.branch_id from tran_partsrcir_details tdd 
 		 inner join tran_partsrcir_mast tdm on tdm.id = tdd.mast_partsrcir_id 
 		 where (tdm.branch_id in ('$branch_id'))  and tdd.isdeleted = 0 and tdm.year = '$_SESSION[current_year]' and tdm.date between '$fd' and '$td' and (tdm.challan_no='p_movement' or tdm.challan_no='stock_adj' or tdm.challan_no='O.B.')";
 		// or tdm.challan_no='p_movement'
 		
 		 if($partid && $partnm){
 		     $sql.=" and tdd.part_id = '$partid' ";
 		     if($Op_Id){
 		           $sql.=" and tdd.op_id = '$Op_Id' ";
 		      }
 		 }
 		 $sql.=" group by tdd.id order by tdd.part_id,tdd.id";
    	 $query = $this->db->query($sql);
    	 $PreOPIds2 = $query->result_array();
       		echo $this->db->last_query(); 
		return $PreOPIds2;
 	}
 	//added on 11-07-2024
      public function printRMTracebility($doc_id,$received_doc_type,$mindate){
        //     if($received_doc_type=='p_movement'){
 	      //       $query1= "SELECT if(issue_doc_type = 'p_movement',det_partsrcir_id,received_doc_id) as doc_id,op_id as op_id,received_qty,received_doc_type,issue_qty,issue_doc_type,issue_doc_id, 'RCIR' as type,tran_date,created_by FROM tran_partsrcir_stock where (received_qty>0 or issue_doc_id='$doc_id') and det_partsrcir_id in(select det_partsrcir_id from tran_partsrcir_stock where issue_doc_id in ('$doc_id') and issue_doc_type = '$received_doc_type') 
        //         union all SELECT if(issue_doc_type = 'p_movement',mast_dpr_id,received_doc_id) as doc_id,operation_id as op_id,received_qty,received_doc_type,issue_qty,issue_doc_type,issue_doc_id,'DPR' as type,tran_date,created_by FROM tran_dpr_stock where (received_qty>0 or issue_doc_id='$doc_id') and mast_dpr_id in( select mast_dpr_id from tran_dpr_stock where issue_doc_id in ('$doc_id') and issue_doc_type = '$received_doc_type')";
 	      //    $query=$this->db->query($query1);   
        //       $res = $query->row_array(); 
 	      //     $doc_id=$res['doc_id'];
 	      // }
 	      $query1= "SELECT  if(issue_doc_type = 'p_movement',det_partsrcir_id,received_doc_id) as doc_id ,op_id as op_id,received_qty,received_doc_type,issue_qty,issue_doc_type,issue_doc_id, 'RCIR' as type,tran_date,created_by FROM tran_partsrcir_stock where (received_qty>0 or issue_doc_id='$doc_id') and det_partsrcir_id in(select det_partsrcir_id from tran_partsrcir_stock where issue_doc_id in ('$doc_id') and issue_doc_type = '$received_doc_type') 
                                   union all SELECT  if(issue_doc_type = 'p_movement',mast_dpr_id,received_doc_id) as doc_id,operation_id as op_id,received_qty,received_doc_type,issue_qty,issue_doc_type,issue_doc_id,'DPR' as type,tran_date,created_by FROM tran_dpr_stock where (received_qty>0 or issue_doc_id='$doc_id') and mast_dpr_id in( select mast_dpr_id from tran_dpr_stock where issue_doc_id in ('$doc_id') and issue_doc_type = '$received_doc_type')
                                    union all SELECT if(received_doc_type = 'p_movement',det_dc_id,issue_doc_id) as doc_id,op_id as op_id,issue_qty as received_qty,issue_doc_type as received_doc_type,received_qty as issue_qty,received_doc_type as issue_doc_type,issue_doc_id,'DC' as type,tran_date,created_by FROM tran_dc_stock where (issue_qty>0 and tran_date!='$mindate') and det_dc_id in( select det_dc_id from tran_dc_stock where received_doc_id in ('$doc_id') and received_doc_type ='$received_doc_type')";
            $query=$this->db->query($query1);   
            $res = $query->result_array(); 
              //	echo "<br>____________________________________________".$this->db->last_query(); 
            return  $res ;
 	}
 	
 	   public function printRMStockTracebility($doc_id,$received_doc_type,$mindate){
 	       if($received_doc_type=='p_movement'){
 	             $query1= "SELECT if(issue_doc_type = 'p_movement',det_partsrcir_id,received_doc_id) as doc_id,op_id as op_id,received_qty,received_doc_type,issue_qty,issue_doc_type,issue_doc_id, 'RCIR' as type,tran_date,created_by FROM tran_partsrcir_stock where (received_qty>0 or issue_doc_id='$doc_id') and det_partsrcir_id in(select det_partsrcir_id from tran_partsrcir_stock where issue_doc_id in ('$doc_id') and issue_doc_type = '$received_doc_type') 
                union all SELECT if(issue_doc_type = 'p_movement',mast_dpr_id,received_doc_id) as doc_id,operation_id as op_id,received_qty,received_doc_type,issue_qty,issue_doc_type,issue_doc_id,'DPR' as type,tran_date,created_by FROM tran_dpr_stock where (received_qty>0 or issue_doc_id='$doc_id') and mast_dpr_id in( select mast_dpr_id from tran_dpr_stock where issue_doc_id in ('$doc_id') and issue_doc_type = '$received_doc_type')";
 	          $query=$this->db->query($query1);   
              $res = $query->row_array(); 
 	           $doc_id=$res['doc_id'];
 	       }
 	          $query1= "SELECT received_doc_id as doc_id ,'-' as op_id,received_qty,received_doc_type,issue_qty,issue_doc_type,issue_doc_id, 'RM-RCIR' as type,tran_date,created_by FROM tran_rmrcir_stock where (received_qty>0 or issue_doc_id='$doc_id') and det_rmrcir_id in(select det_rmrcir_id from tran_rmrcir_stock where issue_doc_id in ('$doc_id') and issue_doc_type = 'tran_dpr')";

 	     
         
          $query=$this->db->query($query1);   
            $res = $query->result_array(); 
          //  echo "<br><b>RM STOCK TRACEBILITY***********************</b><br>". $this->db->last_query(); 
            
            return  $res ;
 	}
 	
 	//added on 12 july 2024
    public function getDocumentIssueQty($doc_id,$received_doc_type,$mindate){
 	     $query1= "select sum(issue_qty) as issue_qty,tran_date from (SELECT sum(issue_qty) as issue_qty,tran_date FROM tran_partsrcir_stock where (issue_qty>0 and issue_doc_id='$doc_id') and det_partsrcir_id in(select det_partsrcir_id from tran_partsrcir_stock where issue_doc_id in ('$doc_id') and issue_doc_type = '$received_doc_type') 
        union all SELECT sum(issue_qty) as issue_qty,tran_date FROM tran_dpr_stock where (issue_qty>0 and issue_doc_id='$doc_id') and mast_dpr_id in( select mast_dpr_id from tran_dpr_stock where issue_doc_id in ('$doc_id') and issue_doc_type = '$received_doc_type')
        union all SELECT sum(issue_qty) as issue_qty,tran_date FROM tran_dc_stock where (issue_qty>0 and tran_date!='$mindate') and det_dc_id in( select det_dc_id from tran_dc_stock where received_doc_id in ('$doc_id') and received_doc_type ='$received_doc_type')) a";
            $query=$this->db->query($query1);   
            $res = $query->row_array(); 
             //echo "<br><b>Document Issue Qty***********************</b><br>". $this->db->last_query(); 
            return  $res ;
 	}
 	
 	//added on 03-08-2024
 	public function getScrapStockbyID($doc_type,$det_rmrcir_id){
 	        $query1= "SELECT * FROM `scrap_stock` where received_doc_type='$doc_type' and received_doc_id='$det_rmrcir_id'";
            $query=$this->db->query($query1);   
            $res = $query->row_array();
            return  $res ;
 	    
 	}
 	
 		public function getOperationByPartId($pid)
	{
	 $query = $this->db->query("SELECT `id`, `part_id`, `op_id`, `sequence_no` FROM rel_part_operation where part_id='$pid' and isdeleted=0 order by sequence_no desc");
	 $data = $query->result_array();
	 //echo "<br>". $this->db->last_query();
	 return $data;
	}
	
	public function getUserNameById($id)
	{
		$query = $this->db->query("SELECT `fullname`, concat(`fname`,' ', `mname`) as name, `lanme` FROM `mast_users` where id='$id'");
	    $data = $query->row_array();
	    return $data;
	}
	
	public function getOperatorSupplierQC($doc_type,$doc_id){
	      if($doc_type=='rm_rcir'){
	          $rmids=explode('/',$doc_id);
	          $query = $this->db->query("SELECT trm.id, trm.supplier_id, trm.branch_id FROM `tran_rmrcir_details` trd INNER join tran_rmrcir_mast trm on trd.mast_rmrcir_id  = trm.id where trd.id = '$rmids[1]'"); 
        	  $res = $query->row_array();
    		 return $res; 
	      }
	    elseif($doc_type=='tran_dpr'){
	        
    	     $query = $this->db->query("select `id`, `dpr_date`,part_id, `operator_id`,branch_id from tran_dpr dpr where dpr.id='$doc_id' "); 
        	  $res = $query->row_array();
    		 return $res;
	    }elseif($doc_type=='dc_rcir'){
	        
        	 $query = $this->db->query("select tdd.id,tdd.part_id,tdm.supplier_id,tdm.id as rcir_mast_id,tdm.date,tdm.branch_id from tran_partsrcir_details tdd 
     		 inner join tran_partsrcir_mast tdm on tdm.id = tdd.mast_partsrcir_id where  tdd.id='$doc_id'");
     		  $res = $query->row_array();
    		 return $res;
    	
	    }elseif($doc_type=='supl_pmovement' || $doc_type=='tran_dc'){
	        
        	$query = $this->db->query("select tdd.id,tdd.part_id,tdm.supplier_id,tdm.id as dc_mast_id,tdd.op_id,tdm.branch_id from tran_dc_details tdd  
 		 inner join tran_dc_mast tdm on tdm.id = tdd.mast_dc_id	 where tdd.id = '$doc_id'");
    		 $res = $query->row_array();
    		 return $res;
	    }

        	
		
	}
	public function getQCCreatedBy($doc_type,$doc_id){
	      if($doc_type=='rm_rcir'){
	          $rmids=explode('/',$doc_id);
	          $query = $this->db->query("SELECT id,created_by FROM `tran_rmrcir_quality_checks` where det_rmrcir_id = '$rmids[1]'"); 
        	  $res = $query->row_array();
        	  //	echo "____________".$this->db->last_query(); 
    		  return $res; 
	      }
	    elseif($doc_type=='tran_dpr'){
	       
	         $query = $this->db->query("SELECT id,created_by FROM `tran_dpr_quality_checks` where dpr_id='$doc_id'");
        	 $res = $query->row_array();
    		 return $res;
	    }elseif($doc_type=='dc_rcir'){
	       
	         $query = $this->db->query("SELECT id,created_by FROM `tran_partsrcir_quality_checks` where det_partsrcir_id='$doc_id'");
        	 $res = $query->row_array();
    		 return $res;
	    }
	}
	//added on 30-09-2024
	public function RMPODetailsReport($date){
	     $query = $this->db->query("SELECT tpd.`id`,tpm.id as po_mast_id,tpm.date,tpm.supplier_id, tpd.`mast_po_id`, tpd.`rm_id`, tpd.`part_id`, tpd.`operation_id`, tpd.`ordered_qty`, tpd.`returned_qty`, tpd.`rate`, tpd.`sgst`, tpd.`cgst`, tpd.`igst`, tpd.`branch_id`, tpd.`open_status`,mr.name as rm_name FROM `tran_po_details` tpd  inner join tran_po_mast tpm on tpd.mast_po_id=tpm.id inner join mast_rm mr on mr.rm_id=tpd.rm_id  where tpm.date like '$date%' and tpd.isdeleted=0 and mr.isdeleted=0 order by tpm.supplier_id");
		 $data = $query->result_array();
		 //echo $this->db->last_query();
		 return $data;
	}
	public function getRMRCIRByPoId($id){
	 $query = $this->db->query("SELECT * FROM `tran_rmrcir_details` where tran_rmpo_det_id='$id' and isdeleted=0 and qty >0  order by id asc");
	 $data = $query->row_array();
	// echo $this->db->last_query();
	 return $data;
	}
	
	public function getDprDeletedEntries(){
        $fromd      = $_POST['schedule_from_date'];
        if($fromd){  $fd 	= date("Y-m-d", strtotime($fromd)); }
        $tod        = $_POST['schedule_to_date'];
        if($tod){ $td 	= date("Y-m-d", strtotime($tod));}else{ $td = date("Y-m-d");  }
        $query =$this->db->query("select tran_dpr.id,tran_dpr.dpr_date,tran_dpr.qty_in_kgs,tran_dpr.remarks,mast_operation.Name as operation_name,tran_dpr.created_by,cr.fullname as createdByName,tran_dpr.created_on,tran_dpr.updated_by,up.fullname as updatedByName,tran_dpr.updated_on,mast_part.partno,mast_part.name as part_name from tran_dpr 
                                inner join mast_part on mast_part.part_id=tran_dpr.part_id
                                inner join mast_operation on mast_operation.id=tran_dpr.operation_id
                                inner join mast_users cr on cr.id=tran_dpr.created_by
                                inner join mast_users up on up.id=tran_dpr.updated_by
                                where tran_dpr.isdeleted = 1 and tran_dpr.dpr_date BETWEEN '$fd' AND '$td' ");
	     $data = $query->result_array();
	    return $data;
	}
}

?>