<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] 			= 'LoginController';
$route['logout']						= "LoginController/logout";
$route['signIn']						= "LoginController/signIn";
$route['checkUserDetails']				= "LoginController/checkUserDetails";
$route['getCurrentYear']				= "LoginController/getCurrentYear";

$route['changeBranch']				    = "LoginController/changeBranch";
$route['getUserRoleBranchbyID']		    = "LoginController/getUserRoleBranchbyID";
$route['signInwithBrRole']				= "LoginController/signInwithBrRole";

$route['MangDashboard']					= "ManagementController/MangDashboard";

$route['ClearData']					    = "ManagementController/ClearData";
$route['DatabaseBackup']				= "ManagementController/databaseBackup";
$route['DBExport']				        = "ManagementController/DBExport";


$route['users']							= "ManagementController/users";
$route['addUser']						= "ManagementController/addUser";
$route['createUser']					= "ManagementController/createUser";
$route['updateUser']					= "ManagementController/updateUser";
$route['deleteRecord']					= "ManagementController/deleteRecord";
$route['changeUserpass']				    = "ManagementController/changeUserpass";
$route['updateUserpass']				= "ManagementController/updateUserpass";




//Operator Operators
$route['Operators']							= "ManagementController/Operators";
$route['addOperators']						= "ManagementController/addOperators";
$route['createOperators']					= "ManagementController/createOperators";
$route['updateOperators']					= "ManagementController/updateOperators";
//$route['deleteRecord']					= "ManagementController/deleteRecord";
$route['getRoleBranchList']				= "ManagementController/getRoleBranchList";
$route['getRoleBranchRList']			= "ManagementController/getRoleBranchRList";


$route['rawMaterial']					= "RawMaterialController/rawMaterial";
$route['addrawMaterial']				= "RawMaterialController/addrawMaterial";
$route['createRawMaterial']				= "RawMaterialController/createRawMaterial";
$route['updateRawMaterial']				= "RawMaterialController/updateRawMaterial";
$route['qualityChecks']					= "QualityChecksController/qualityChecks";
$route['addQualityChecks']				= "QualityChecksController/addQualityChecks";
$route['createQualityChecks']			= "QualityChecksController/createQualityChecks";
$route['updateQualityChecks']			= "QualityChecksController/updateQualityChecks";
$route['parts']							= "PartsController/parts";
$route['addParts']						= "PartsController/addParts";
$route['createPart']					= "PartsController/createPart";
$route['updatePart']					= "PartsController/updatePart";
$route['operations']					= "OperationsController/operations";
$route['addOperations']					= "OperationsController/addOperations";
$route['createOperations']				= "OperationsController/createOperations";
$route['updateOperations']				= "OperationsController/updateOperations";
$route['deleteOptsRecord']				= "OperationsController/deleteOptsRecord";
$route['orderAcceptance']				= "OrderAcceptController/orderAcceptance";
$route['addOrderAcceptance']			= "OrderAcceptController/addOrderAcceptance";
$route['getConsignee']					= "OrderAcceptController/getConsignee";
$route['createOrderAcceptance']			= "OrderAcceptController/createOrderAcceptance";
$route['updateOrderAcceptance']			= "OrderAcceptController/updateOrderAcceptance";
$route['deleteOARecord']	            = "OrderAcceptController/deleteOARecord";
$route['checkPono']	                    = "OrderAcceptController/checkPono";
$route['checkPartExit']	                = "OrderAcceptController/checkPartExit";
$route['schedule']						= "ScheduleController/schedule";
$route['addSchedule']					= "ScheduleController/addSchedule";
$route['createSchedule']				= "ScheduleController/createSchedule";
$route['schedulePlanning']				= "ScheduleController/schedulePlanning";
$route['createSchedulePlanning']		= "ScheduleController/createSchedulePlanning";
$route['schedulePlanning1']				= "ScheduleController/schedulePlanning1";
$route['getRMForPlanning']				= "ScheduleController/getRMForPlanning";
$route['createInhouseProduction']		= "ScheduleController/createInhouseProduction";
$route['createReserveStock']			= "ScheduleController/createReserveStock";
$route['addProdPlanning']				= "ScheduleController/addProdPlanning";
$route['addProdPlanningNew']			= "ScheduleController/addProdPlanningNew";
$route['createFinishedBoughtout']		= "ScheduleController/createFinishedBoughtout";
$route['getPartsByCust']				= "OrderAcceptController/getPartsByCust";

$route['tools']							= "ToolsController/viewTools";
$route['addTools']						= "ToolsController/addTools";
$route['createTool']					= "ToolsController/createTool";
$route['updateTool']					= "ToolsController/updateTool";
$route['deleteToolRecord']				= "ToolsController/deleteToolRecord";

$route['Trantool']				     	= "ToolsController/viewTrantool";
$route['addTrantool']					= "ToolsController/addTrantool";
$route['createTrantool']				= "ToolsController/createTrantool";
$route['updateTrantool']				= "ToolsController/updateTrantool";
$route['deleteTrantoolRec']				= "ToolsController/deleteTrantoolRec";




$route['getOperationsList']				= "OperationsController/getOperationsList";
$route['getOperationsRList']			= "OperationsController/getOperationsRList";
$route['partOperations']				= "OperationsController/partOperations";
$route['createRelParts']				= "OperationsController/createRelParts";
$route['updateReOpts']					= "OperationsController/updateReOpts";

$route['OtherPo']						= "OtherPoController/OtherPo";
$route['addOtherPo']					= "OtherPoController/addOtherPo";
$route['partPOPrint']					= "OtherPoController/partPOPrint";
$route['createOtherPo']					= "OtherPoController/createOtherPo";
$route['updateOtherPo']					= "OtherPoController/updateOtherPo";
$route['getOpByPartId']					= "OtherPoController/getOpByPartId";
$route['deleteOtherDetails']			= "OtherPoController/deleteOtherDetails";
$route['getPartOperationQty']			= "OtherPoController/getPartOpQty";
$route['getPrevPartOperationQty']		= "OtherPoController/getPrevPartOperationQty";


$route['partsPurchseOrder']			    = "PpurchseOrderController/partsPurchseOrder";
$route['addPpurchesorder']			    = "PpurchseOrderController/addPpurchesorder";
$route['GetTranScheduleParts']			= "PpurchseOrderController/GetTranScheduleParts";
$route['showSupplierSch']			    = "PpurchseOrderController/showSupplierSch";
$route['supplierSchedule']			    = "SscheduleController/supplierSchedule";
$route['updateSupplierSchedule']		= "SscheduleController/updateSupplierSchedule";
$route['showSchBySupplierBranch']		= "SscheduleController/showSchBySupplierBranch";
$route['getMailPartsSchedule']		    = "SscheduleController/getMailPartsSchedule";
$route['PartsSendmail']		            = "SscheduleController/PartsSendmail";
$route['getSupplierDetails']		    = "SscheduleController/getSupplierDetails";
$route['addSupplierSchedule']			= "SscheduleController/addSupplierSchedule";
$route['addSupScheduleByBranch']		= "SscheduleController/addSupScheduleByBranch";
$route['addSuppliersProccess']			= "SscheduleController/addSuppliersProccess";
$route['PartsRCIR']			            = "PRCIRController/PartsRCIR";
$route['addPartRCIR']			        = "PRCIRController/addPartRCIR";
$route['createPartRCIR']			    = "PRCIRController/createPartRCIR";
$route['updatePartRCIR']			    = "PRCIRController/updatePartRCIR";
$route['getRCIRQty']			        = "PRCIRController/getRCIRQty";
$route['getPartsRCIRMast']			    = "PRCIRController/getPartsRCIRMast";
$route['getPartsRCIRDetails']			= "PRCIRController/getPartsRCIRDetails";
$route['deleteBookedQty']			    = "PRCIRController/deleteBookedQty";

$route['RMRCIR']			            = "RMRCIRController/RMRCIR";
$route['getRMRCIRQty']			        = "RMRCIRController/getRMRCIRQty";
$route['addRMRCIR']			            = "RMRCIRController/addRMRCIR";
$route['createRMRCIR']			        = "RMRCIRController/createRMRCIR";
$route['updateRMRCIR']			        = "RMRCIRController/updateRMRCIR";
$route['deleteRMQty']			        = "RMRCIRController/deleteRMQty";
$route['RMRCIRDetailsStock']			= "RMRCIRController/RMRCIRDetailsStock";  //added by Asharani-31/-5/2023 for rm_rcir stock details
$route['RMStockAdjustment']			    = "RMRCIRController/RMStockAdjustment";  //added by Asharani-31/-5/2023 for rm_rcir stock adjustment details




$route['addMachine']			        = "MachineController/addMachine";
$route['viewMachine']			        = "MachineController/viewMachine";
$route['createMachine']			        = "MachineController/createMachine";
$route['updateMachine']			        = "MachineController/updateMachine";

$route['getPartsByProdFamily']			= "CommonController/getPartsByProdFamily";
$route['ConsumablesPO']			        = "ConsumableController/ConsumablesPO";
$route['consPOPrint']					= "ConsumableController/consPOPrint";
$route['addConsumablesPo']			    = "ConsumableController/addConsumablesPo";
$route['createConsumablesPo']			= "ConsumableController/createConsumablesPo";
$route['updateConsumablesPo']			= "ConsumableController/updateConsumablesPo";
$route['deleteConsumDetails']			= "ConsumableController/deleteConsumDetails";

$route['viewOBDeliveryC']			    = "DeliveryChallanOB/view";
$route['addOBDeliveryC']			    = "DeliveryChallanOB/add";
$route['createDCOB']			        = "DeliveryChallanOB/createDCOB";
$route['updateDCOB']			        = "DeliveryChallanOB/updateDCOB";


$route['viewDeliveryC']			        = "DeliveryCController/view";
$route['addDeliveryC']			        = "DeliveryCController/add";
$route['deleteDCRecord']			    = "DeliveryCController/delete";
$route['createDC']			            = "DeliveryCController/createDC";
$route['updateDC']			            = "DeliveryCController/updateDC";
$route['getPoRateDetails']			    = "DeliveryCController/getPoRateDetails";
$route['getDCOpByPartId']			    = "DeliveryCController/getDCOpByPartId";
$route['dcPrint']			            = "DeliveryCController/dcPrint";
$route['getQtyByKG']			        = "DeliveryCController/getQtyByKG";

$route['PartsMovementSupl']			    = "DeliveryCController/viewPartsMovementSupl";
$route['AddPartsMovementSupl']			= "DeliveryCController/AddPartsMovementSupl";
$route['createPMovementsupl']		    = "DeliveryCController/createPMovementsupl";
$route['getDCRCIRQtyforSupl']			= "DCRCIRController/getDCRCIRQtyforSupl";



$route['viewDCOperation']			    = "DCRCIRController/view";
$route['addDCOperation']			    = "DCRCIRController/add";
$route['createDCRCIR']			        = "DCRCIRController/createDCRCIR";
$route['updateDCRCIR']			        = "DCRCIRController/updateDCRCIR";
$route['getDCListBySuppId']			    = "DCRCIRController/getDCListBySuppId";
$route['getDCRCIRQty']			        = "DCRCIRController/getDCRCIRQty";

$route['viewInvoice']			        = "InvoiceController/viewInvoice";
$route['addInvoice']			        = "InvoiceController/addInvoice";
$route['createInvoice']			        = "InvoiceController/createInvoice";
$route['deleteInvoiceRecord']			= "InvoiceController/deleteInvoiceRecord";

$route['correctInvoice']			    = "InvoiceController/correctInvoice";
$route['updateInvoice']			        = "InvoiceController/updateInvoice";
$route['editInvDetails']                = "InvoiceController/editInvDetails";
$route['addInvQCdetails']               = "InvoiceController/addInvQCdetails";



$route['RMMovement']			        = "RMMovementController/view";
$route['addRMMovement']			        = "RMMovementController/add";
$route['createMovement']			    = "RMMovementController/create";
$route['updateMovement']			    = "RMMovementController/update";
$route['getMovementRMStock']			= "RMMovementController/getStock";
$route['deleteRMMovement']			    = "RMMovementController/deleteRMMovement";
$route['rmMvmtPrint']			    = "RMMovementController/rmMvmtPrint";


$route['PartsMovement']			        = "PartsMovementController/view";
$route['addPartsMovement']			    = "PartsMovementController/add";
$route['createPMovement']			    = "PartsMovementController/create";
$route['updatePMovement']			    = "PartsMovementController/update";
$route['deletePartsMovement']			= "PartsMovementController/deletePartsMovement";
$route['getMoveRateDetails']			= "PartsMovementController/getMoveRateDetails";
$route['getMovementOpByPartId']			= "PartsMovementController/getMovementOpByPartId";
$route['partMvmtPrint']			        = "PartsMovementController/partMvmtPrint";





//Customers
$route['Customers']						= "Customer/CustomerController/customers";
$route['addCustomers']					= "Customer/CustomerController/addCustomers";
$route['deleteCustRecord']				= "Customer/CustomerController/deleteCustRecord";
$route['createCustomer']				= "Customer/CustomerController/createCustomer";
$route['updateCustomer']				= "Customer/CustomerController/updateCustomer";
//supplier
$route['Supplier']						= "Supplier/SupplierController/Supplier";
$route['addSupplier']					= "Supplier/SupplierController/addSupplier";
$route['deletesupRecord']				= "Supplier/SupplierController/deletesupRecord";
$route['createSupplier']				= "Supplier/SupplierController/createSupplier";
$route['updateCustomer']				= "Customer/CustomerController/updateCustomer";
$route['updateSupplier']                = "Supplier/SupplierController/updateSupplier";
$route['getoperationname']              = "Supplier/SupplierController/getoperationname";

//TranDPR
$route['Tran-DPR']						= "TranDPR/TranDPRController/index";
$route['Create-DPR']					= "TranDPR/TranDPRController/AddDPR";
$route['Update-DPR']					= "TranDPR/TranDPRController/UpdateDPR";
$route['getProdPart_Id']				= "TranDPR/TranDPRController/getProdPart_Id";
$route['getOperbyPart_Id']				= "TranDPR/TranDPRController/getOperbyPart_Id";
$route['getOperbyPartOp']				= "TranDPR/TranDPRController/getOperbyPartOp";
$route['getToolSucess']					= "TranDPR/TranDPRController/getToolSucess";
$route['getRMByPartId']					= "TranDPR/TranDPRController/getRMByPartId";
$route['getToolbyPartOperation']		= "TranDPR/TranDPRController/getToolbyPartOperation";
$route['deleteDPR']                 	= "TranDPR/TranDPRController/deleteDPR";

$route['totalDispatch']		            = "ReportsController/totalDispatch";
$route['totalDispatchInRS']		        = "ReportsController/totalDispatchInRS";
$route['totalConsumedMaterial']		    = "ReportsController/totalConsumedMaterial";
$route['totalSchCompletion']		    = "ReportsController/totalSchCompletion";


$route['SchVSDesPatchR']		        = "ReportsController/SchVSDesPatchR";

$route['SchVSDisPatchByCust']		    = "ReportsController/SchVSDisPatchByCust";

$route['OperPerformanceR']		        = "ReportsController/OperPerformanceR";
$route['showOPereport']		            = "ReportsController/showOPereport";
$route['preDispatchIR']		            = "ReportsController/predispatchIR";
$route['RMStockDetails']		        = "ReportsController/RMStockDetails";
$route['RMStockSummary']		        = "ReportsController/RMStockSummary";
$route['PartStockDetails']		        = "ReportsController/PartStockDetails";
$route['PartStockDetailsRevision']		= "ReportsController/PartStockDetailsRevision";

$route['ScrapStockR']		            = "ReportsController/ScrapStockR";
$route['ScrapStockSummary']		            = "ReportsController/ScrapStockSummary";

$route['getScrapStkChart']		        = "ReportsController/getScrapStkChart";
$route['printInvDispatchR']		        = "ReportsController/printInvDispatchR";
$route['InprocessDprQCR']		        = "ReportsController/InprocessDprQCR";
$route['IncomingPartQCR']		        = "ReportsController/IncomingPartQCR";
$route['RMConsumptionR']		        = "ReportsController/RMConsumptionR";
$route['RejectionSummaryR']		        = "ReportsController/RejectionSummaryR";
$route['getConsumablePieChart']		    = "ReportsController/getConsumablePieChart";
$route['operatorPersummDashboard']		= "ReportsController/operatorPersummDashboard";
$route['getCSchVSDischart']		        = "ReportsController/getCSchVSDischart";
$route['RejSummaryDashboardR']		    = "ReportsController/RejSummaryDashboardR";
$route['TranToolsDashboardR']		    = "ReportsController/TranToolsDashboardR";
$route['AllPartStockDetails']		    = "ReportsController/AllPartStockDetails";
$route['tranToolDetails']		        = "ReportsController/tranToolDetails";
$route['tranToolDetailReport']		    = "ReportsController/tranToolDetailReport";
$route['invoiceDetailsReport']		    = "ReportsController/invoiceDetailsReport";
$route['toolRepairDetailsReport']		= "ReportsController/toolRepairDetailsReport";


$route['rmob']              		    = "RMOBController/view";
$route['addRMOB']              		    = "RMOBController/add";
$route['createRMOB']              		= "RMOBController/createRMOB";
$route['updateRMOB']              		= "RMOBController/update";
$route['checkRMInStock']              	= "RMOBController/checkRMInStock";

//Requisition
$route['rm-equisition']                	= "RMRequisition/RMRequisitionController/index";
$route['rm-equisition-email']           = "RMRequisition/RMRequisitionController/rqemail";
$route['updateEquisition']              = "RMRequisition/RMRequisitionController/updateEquisition";
$route['updateEquisitionNew']              = "RMRequisition/RMRequisitionController/updateEquisitionNew";
$route['mailformat']              		= "RMRequisition/RMRequisitionController/mailformat";
$route['Sendmail']              		= "RMRequisition/RMRequisitionController/Sendmail";


$route['rm-Purchase-order-data']        = "RMPurchesOrder/RMPurchesOrderController/index";
$route['rm-Purchase-order']             = "RMPurchesOrder/RMPurchesOrderController/rmpurchesorder";
$route['rmPOPrint']             = "RMPurchesOrder/RMPurchesOrderController/rmPOPrint";

$route['AddRmPurchesOrder']              	= "RMPurchesOrder/RMPurchesOrderController/AddRmPurchesOrder";
$route['UpdateRmPurchesOrder']              = "RMPurchesOrder/RMPurchesOrderController/UpdateRmPurchesOrder";
$route['getOrdermast']              		= "RMPurchesOrder/RMPurchesOrderController/getOrdermast";
$route['getOrderDetails']              		= "RMPurchesOrder/RMPurchesOrderController/getOrderDetails";
$route['deleteRmOrder']              		= "RMPurchesOrder/RMPurchesOrderController/deleteRmOrder";

// $route['RMQC']							= "RMQC/RMQCController/index";
$route['Create-RMQC']					= "RMQC/RMQCController/AddRMQC";
$route['getRMBySupplId']				= "RMQC/RMQCController/getRMBySupplId";
$route['getRmDatatable']				= "RMQC/RMQCController/getRmDatatable";
$route['CreateRMQC']				    = "RMQC/RMQCController/CreateRMQC";

$route['RMQC']							= "RMQC/RMQCController/index";
$route['GetRMQCData']					= "RMQC/RMQCController/GetRMQCData";
$route['getRmrcirDetail']				= "RMQC/RMQCController/getRmrcirDetail";
$route['ViewAddRMQC']					= "RMQC/RMQCController/ViewAddRMQC";
$route['addRMQC']						= "RMQC/RMQCController/addRMQC";
$route['getRMQualityCheck']				= "RMQC/RMQCController/getRMQualityCheck";
$route['deleteRecordRMQC']				= "RMQC/RMQCController/deleteRecordRMQC";


$route['ConsumeRCIR']				    = "ConsumeRCIRController/ConsumeRCIR";
$route['addConsumablesRCIR']			= "ConsumeRCIRController/addConsumablesRCIR";
$route['createConsumRCIR']				= "ConsumeRCIRController/createConsumRCIR";


//Inprocess-dpr
$route['Inprocess-dpr']              		= "TranDPR/InprocessController/index";
$route['Add-Inprocessdpr']              	= "TranDPR/InprocessController/AddInprocessdpr";
$route['getQualityCheck']              		= "TranDPR/InprocessController/getQualityCheck";
$route['deleteRecordInprocess']              		= "TranDPR/InprocessController/deleteRecord";

//Incoming
$route['Incoming']              			= "Incoming/IncomingController/Incoming";
$route['GetIncomingData']              		= "Incoming/IncomingController/GetIncomingData";
$route['getPartsrcirDetail']              	= "Incoming/IncomingController/getPartsrcirDetail";
$route['addIncoming']              			= "Incoming/IncomingController/addIncoming";
$route['ViewAddIncoming']              			= "Incoming/IncomingController/ViewAddIncoming";
$route['deleteRecord1']              			= "Incoming/IncomingController/deleteRecord1";


//Parts Opening balance (Asharani Madane)
$route['PartsOpeningBal']			        = "PartsOpenBalController/PartsOpeningBal";
$route['addPartsOpenBal']			        = "PartsOpenBalController/add";
$route['createPartsOpenBal']			    = "PartsOpenBalController/create";
$route['updatePartsOpenBal']                = "PartsOpenBalController/update";

$route['getPartsBySearch']			        = "CommonController/getPartsBySearch";
//$route['getPartOperationQty']			    = "OtherPoController/getPartOpQty";
$route['deleteDCDetails']			        = "DeliveryCController/deleteDCDetails";
$route['SchedulePlanningR']                 = "ReportsController/SchedulePlanningR";

//New Scrap Controller created by Asharani

$route['scrapInvoice']			        = "ScrapController/scrapInvoice";
$route['addScrapInvoice']			    = "ScrapController/addScrapInvoice";
$route['createScrapInvoice']			= "ScrapController/createScrapInvoice";
$route['updateScrapInvoice']			= "ScrapController/updateScrapInvoice";
$route['getScrapbyvalue']			    = "ScrapController/getScrapbyvalue";

//Part Stock Adjustment (Asharani Madane) - 13 Dec 2023
$route['PartsStkAdjustment']			    = "PartStockAdjController/view";
$route['addPartStkAdjustment']			    = "PartStockAdjController/add";
$route['updatePartsStkAdj']			        = "PartStockAdjController/updatePartsStkAdj";

//Datewise Document (Asharani Madane) - 20 Dec 2023
$route['PartMvmtDatewiseDetails']		    = "ReportsController/PartMvmtDatewiseDetails";

//DC Details (Asharani Madane) - 12 March 2024
$route['getDCDetailsReport']		    = "ReportsController/getDCDetailsReport";
$route['getDCDetails']		            = "ReportsController/getDCDetails";
$route['saveStockAdjDCdetails']		    = "ReportsController/saveStockAdjDCdetails";


//DCRCIR Details (Asharani Madane) - 15 March 2024
$route['getDCRCIRDetailsReport']		    = "ReportsController/getDCRCIRDetailsReport";
$route['saveStockAdjDCrcir']		        = "ReportsController/saveStockAdjDCrcir";

//DefectRegiModuleController added on - 18 March 2024
$route['viewDefectRegiModule']		    = "DefectRegiModuleController/view";
$route['addDefectRegiModule']		    = "DefectRegiModuleController/add";
$route['getLocationType']		        = "DefectRegiModuleController/getLocationType";
$route['getOpByPartIdType']			    = "DefectRegiModuleController/getDCOpByPartId";
$route['createDefectReg']			    = "DefectRegiModuleController/createDefectReg";
$route['updateDefectReg']			    = "DefectRegiModuleController/updateDefectReg";
$route['deleteDefregDetails']		    = "DefectRegiModuleController/deleteDefregDetails";
$route['defregPrint']		            = "DefectRegiModuleController/defregPrint";


//DCRCIR Details (Asharani Madane) - 19 March 2024
$route['getDPRDetailsReport']		    = "ReportsController/getDPRDetailsReport";
$route['saveStockAdjDPRdetails']		= "ReportsController/saveStockAdjDPRdetails";


//Tool Repair - 25 March 2024
$route['viewToolRepair']		        = "ToolRepairController/view";
$route['addToolRepair']		            = "ToolRepairController/add";
$route['createToolRepair']		        = "ToolRepairController/createToolRepair";
$route['updateToolRepair']		        = "ToolRepairController/updateToolRepair";
$route['toolRepairPrint']		        = "ToolRepairController/toolRepairPrint";


//Tool Repair - 25 March 2024
$route['viewToolMaker']		            = "ToolMakerController/view";
$route['addToolMaker']		            = "ToolMakerController/add";
$route['createToolMaker']		        = "ToolMakerController/createToolMaker";
$route['updateToolMaker']		        = "ToolMakerController/updateToolMaker";
$route['delToolMakerRecord']		   = "ToolMakerController/delToolMakerRecord";

//added on 24-05-2024
$route['Reports']		               = "ReportsController/Reports";

//RM Details (Asharani Madane) -10 June 2024
$route['RMtraceability']		       = "ReportsController/RMtraceability";

//Forgot Password (Asharani Madane) -11 June 2024
$route['forgot-password']		        = "LoginController/forgot_password";
$route['reset-password']		        = "LoginController/reset_password";
$route['updateResetUserpass']			= "LoginController/updateResetUserpass";

//Forgot Password (Asharani Madane) -12 June 2024
$route['addUpdatecompany']			= "ManagementController/addUpdatecompany";
$route['createupdateCompany']		= "ManagementController/createupdateCompany";

$route['PMovementRCIRdetailsReport']		    = "ReportsController/PMovementRCIRdetailsReport";
$route['saveStockAdjPmovercir']		    = "ReportsController/saveStockAdjPmovercir";

$route['RMPODetailsReport']		    = "ReportsController/RMPODetailsReport";


$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
