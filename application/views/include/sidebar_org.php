<?php 
$pageName=$_SERVER['REQUEST_URI']; 
//print_r($_SESSION);die;
$role = $_SESSION['role'];
if(empty($_SESSION['role']))
{
    redirect(base_url('signIn'));
}

?>
<style>
    .display-1 {
    font-size: 2rem !important;
}
</style>
<script>
function clearData(){
     if (confirm("Are you sure ?")) {
         window.location='<?php echo base_url('ClearData')?>';
       }
    return false;
}
</script>
<!-- STYLESHEETS -->
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~--- -->

    

        <!-- HEADER -->
        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
        <header class="header">
            <div class="header__inner">

                <!-- Brand -->
                <div class="header__brand">
                    <div class="brand-wrap">

                        <!-- Brand logo -->
                        <a href="./index.html" class="brand-img stretched-link">
                            <!-- <img src="<?php echo base_url() ?>public/assets/img/logo.svg" alt="Nifty Logo" class="Nifty logo" width="40" height="40"> -->

                        </a>

                        <!-- Brand title -->
                        <div class="brand-title">
                            <?php 

                            $CompName=$_SESSION['company_name'];
                                 

                                echo (!empty($CompName)) ? $CompName : "-";
                            ?>
                            
                        
                            </div>

                        <!-- You can also use IMG or SVG instead of a text element. -->

                    </div>
                </div>
                <!-- End - Brand -->

                <div class="header__content">

                    <!-- Content Header - Left Side: -->
                    <div class="header__content-start">

                        <!-- Navigation Toggler -->
                        <button type="button" class="nav-toggler header__btn btn btn-icon btn-sm" aria-label="Nav Toggler">
                            <i class="demo-psi-view-list"></i>
                        </button>

                        <!-- Searchbox -->
                        
                    </div>
                    <!-- End - Content Header - Left Side -->

                    <!-- Content Header - Right Side: -->
                    <div class="header__content-end">

                        
                        <!-- User dropdown -->
                        <div class="dropdown">

                            <!-- Toggler -->
                            <button class="header__btn btn btn-icon btn-sm" type="button" data-bs-toggle="dropdown" aria-label="User dropdown" aria-expanded="false">
                                <i class="demo-psi-male"></i>
                            </button>

                            <!-- User dropdown menu -->
                            <div class="dropdown-menu dropdown-menu-end w-md-450px">

                                <!-- User dropdown header -->
                                <div class="d-flex align-items-center border-bottom px-3 py-2">
                                    <div class="flex-shrink-0">
                                        <img class="img-sm rounded-circle" src="<?php echo base_url() ?>public/assets/img/profile-photos/1.png" alt="Profile Picture" loading="lazy">
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h5 class="mb-0"><?=$_SESSION['name']?></h5>
                                        <span class="text-muted fst-italic"><?=$_SESSION['username']?></span>
                                        <?php //print_r($_SESSION);?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-7">

                                        <!-- Simple widget and reports -->
                                        <div class="list-group list-group-borderless mb-3">
                                            <div class="list-group-item text-center border-bottom mb-3">
                                                <p class="h1 display-1 text-black"><?=$_SESSION['current_year']?></p>
                                                <p class="h6 mb-0"></i> Current Year</p>
                                                
                                            </div>
                                            <div class="list-group-item py-0 d-flex justify-content-between align-items-center">
                                                Today Earning
                                                <small class="fw-bolder">$578</small>
                                            </div>
                                            <div class="list-group-item py-0 d-flex justify-content-between align-items-center">
                                                Tax
                                                <small class="fw-bolder text-danger">- $28</small>
                                            </div>
                                            <div class="list-group-item py-0 d-flex justify-content-between align-items-center">
                                                Total Earning
                                                <span class="fw-bold text-primary">$6,578</span>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-5">

                                        <!-- User menu link -->
                                        <div class="list-group list-group-borderless h-100 py-3">
                                            <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                                <span><i class="demo-pli-mail fs-5 me-2"></i> Messages</span>
                                                <span class="badge bg-danger rounded-pill">14</span>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <i class="demo-pli-male fs-5 me-2"></i> Profile
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <i class="demo-pli-gear fs-5 me-2"></i> Settings
                                            </a>

                                            <a href="#" class="list-group-item list-group-item-action mt-auto">
                                                <i class="demo-pli-computer-secure fs-5 me-2"></i> Lock screen
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <i class="demo-pli-unlock fs-5 me-2"></i> Logout
                                            </a>
                                       
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- End - User dropdown -->


                    </div>
                </div>
            </div>
        </header>
        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
        <!-- END - HEADER -->

        <!-- MAIN NAVIGATION -->
        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
        <nav id="mainnav-container" class="mainnav">
            <div class="mainnav__inner">

                <!-- Navigation menu -->
                <div class="mainnav__top-content scrollable-content pb-5">

                    <!-- Profile Widget -->
                    <div class="mainnav__profile mt-3 d-flex3">

                        <div class="mt-2 d-mn-max"></div>

                        <!-- Profile picture  -->
                        <div class="mininav-toggle text-center py-2">
                            <img class="mainnav__avatar img-md rounded-circle border" src="<?php echo base_url() ?>public/assets/img/profile-photos/1.png" alt="Profile Picture">
                        </div>

                        <div class="mininav-content collapse d-mn-max">
                            <div class="d-grid">

                                <!-- User name and position -->
                                <button class="d-block btn shadow-none p-2" data-bs-toggle="collapse" data-bs-target="#usernav" aria-expanded="false" aria-controls="usernav">
                                    <span class="dropdown-toggle d-flex justify-content-center align-items-center">
                                        <h6 class="mb-0 me-3"><?=$_SESSION['username'];?></h6>
                                    </span>
                                    <h5 class="text-muted"><?=$_SESSION['role_name']." - ".$_SESSION['branch_name']; ?></h5>
                                    <h5 class="text-muted"><?=$_SESSION['current_year']?></h5>
                                   
                                </button>

                                <!-- Collapsed user menu -->
                                <div id="usernav" class="nav flex-column collapse">
                                    
                                    <a href="<?php echo base_url(logout) ?>" class="nav-link">
                                        <i class="demo-pli-unlock fs-5 me-2"></i>
                                        <span class="ms-1">Logout</span>
                                    </a>
                                      <!-- Start of change branch -->
                                          <a href="<?php echo base_url('changeBranch') ?>" class="nav-link" >
                                                <i class="demo-pli-unlock fs-5 me-2" ></i>
                                                <span class="ms-1">Change Branch</span>
                                         </a>
                                         <!-- End of change branch-->
                                </div>

                            </div>
                        </div>

                    </div>
                    <!-- End - Profile widget -->

                    <!-- Navigation Category -->
                    <div class="mainnav__categoriy py-3">
                        <h6 class="mainnav__caption mt-0 px-3 fw-bold">Dashboard</h6>
                        <ul class="mainnav__menu nav flex-column">

                            <!-- Link with submenu -->
                            <li class="nav-item has-sub">

                                <a href="#" class="mininav-toggle nav-link <?php if($pageName=='/MangDashboard'){ echo "active";} ?>"><i class="demo-pli-home fs-5 me-2"></i>
                                    <span class="nav-label ms-1">Dashboard</span>
                                </a>

                                <!-- Dashboard submenu list -->
                                <ul class="mininav-content nav collapse">
                                    <li class="nav-item">
                                        <a href="<?php echo base_url('MangDashboard');?>" class="nav-link <?php if($pageName=='/MangDashboard'){ echo "active";} ?>">Dashboard</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#"  class="nav-link  <?php if($pageName=='/ClearData'){ echo "active";} ?>" onclick="clearData();">Clear Data</a>
                                    </li>

                                </ul>
                                <!-- END : Dashboard submenu list -->

                            </li>
                            <!-- END : Link with submenu -->

                            

                            <!-- END : Regular menu link -->

                        </ul>
                        
                        <ul class="mainnav__menu nav flex-column">
                            <!-- Link with submenu -->
                            
                            <?php if($role != 2 && $role != 3 && $role != 4 && $role != 5 && $role != 6){ ?>
                            <li class="nav-item has-sub">
                                <a href="#" class="mininav-toggle nav-link collapsed  <?php if($pageName=='/users' || $pageName=='/addUser' || $pageName=='/rawMaterial' || $pageName=='/addrawMaterial' || $pageName=='/createRawMaterial' || $pageName=='/qualityChecks' || $pageName=='/addQualityChecks' || $pageName=='/createQualityChecks' || $pageName=='/parts' || $pageName=='/addParts' || $pageName=='/createPart' || $pageName=='/Customers' || $pageName=='/createCustomer' || $pageName=='/createSupplier' || $pageName=='/Supplier' || $pageName=='/addSupplier' || $pageName=='/addCustomers' || $pageName=='/operations' || $pageName=='/addOperations' || $pageName=='/createOperations' || $pageName=='/tools' || $pageName=='/addTools' || $pageName=='/partOperations'  || $pageName=='/createRelParts' || $pageName=='/addOperations' || $pageName=='/updateReOpts' || $pageName=='/viewMachine' || $pageName=='/addMachine' || $pageName=='/createMachine'){ echo "active";} ?>"><i class="demo-pli-split-vertical-2 fs-5 me-2"></i>
                                    <span class="nav-label ms-1">Masters</span>
                                </a>

                                <!-- Layouts submenu list -->
                                <ul class="mininav-content nav collapse">
                                    <li class="nav-item">
                                        <a href="<?php echo base_url();?>users" class="nav-link <?php if($pageName=='/users' || $pageName=='/addUser'){ echo "active";} ?>">Users</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url();?>Supplier" class="nav-link <?php if($pageName=='/Supplier' || $pageName=='/addSupplier'){ echo "active";} ?>">Supplier</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url();?>Customers" class="nav-link <?php if($pageName=='/Customers' || $pageName=='/createCustomer' || $pageName=='/addCustomers'){ echo "active";} ?>">Customers</a>
                                    </li>  
                                    <li class="nav-item">
                                        <a href="<?php echo base_url();?>rawMaterial" class="nav-link <?php if($pageName=='/rawMaterial' || $pageName=='/addrawMaterial' || $pageName=='/createRawMaterial'){ echo "active";} ?>">Raw Material</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url();?>parts" class="nav-link <?php if($pageName=='/parts' || $pageName=='/addParts' || $pageName=='/createPart'){ echo "active";} ?>">Parts</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url();?>operations" class="nav-link <?php if($pageName=='/operations' || $pageName=='/addOperations' || $pageName=='/createOperations'){ echo "active";} ?>">Operations</a>
                                    </li>
                                     <li class="nav-item">
                                        <a href="<?php echo base_url();?>partOperations" class="nav-link <?php if($pageName=='/partOperations' || $pageName=='/createRelParts' || $pageName=='/addOperations' || $pageName=='/updateReOpts'){ echo "active";} ?>">Part Operations</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url();?>qualityChecks" class="nav-link <?php if($pageName=='/qualityChecks' || $pageName=='/addQualityChecks' || $pageName=='/createQualityChecks'){ echo "active";} ?>">Quality Checks</a>
                                    </li>
                                    
                                    <li class="nav-item">
                                        <a href="<?php echo base_url();?>tools" class="nav-link <?php if($pageName=='/tools' || $pageName=='/addTools'){ echo "active";} ?>">Tools</a>
                                    </li>
                                    
                                    <li class="nav-item">
                                        <a href="<?php echo base_url();?>viewMachine" class="nav-link <?php if($pageName=='/viewMachine' || $pageName=='/addMachine' || $pageName=='/createMachine'){ echo "active";} ?>">Machines</a>
                                    </li>
                                    

                                </ul>
                                <!-- END : Layouts submenu list -->

                            </li>
                            <?php } if($role != 3 && $role != 4 && $role != 5 && $role != 6) { ?> 
                            
                            <li class="nav-item has-sub">

                                <a href="#" class="mininav-toggle nav-link collapsed  <?php if($pageName=='/orderAcceptance' || $pageName=='/addOrderAcceptance' || $pageName=='/schedule' || $pageName=='/addSchedule' || $pageName=='/createSchedule' || $pageName=='/schedulePlanning' || $pageName=='/createSchedulePlanning'|| $pageName=='/schedulePlanning1' ||$pageName=='/addProdPlanning' || $pageName=='/addSupplierSchedule' || $pageName=='/partsPurchseOrder'){ echo "active";} ?>"><i class="demo-pli-tactic fs-5 me-2"></i>
                                    <span class="nav-label ms-1">Transactions</span>
                                </a>
                                <ul class="mininav-content nav collapse">
                                    <li class="nav-item">
                                        <a href="<?php echo base_url();?>orderAcceptance" class="nav-link <?php if($pageName=='/orderAcceptance' || $pageName=='/addOrderAcceptance'){ echo "active";} ?>">Order Acceptance</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url();?>schedule" class="nav-link <?php if($pageName=='/schedule' || $pageName=='/addSchedule' || $pageName=='/createSchedule'){ echo "active";} ?>">Schedule</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url();?>schedulePlanning" class="nav-link <?php if($pageName=='/schedulePlanning' || $pageName=='/createSchedulePlanning' || $pageName=='/schedulePlanning1' || $pageName=='/addProdPlanning'){ echo "active";} ?>">Schedule Planning</a>
                                    </li>
                                    
                                   
                                    <li class="nav-item">
                                         <ul id="mainnav" class="mainnav__menu nav flex-column">
                                            <li class="nav-item has-sub">
                                                <a href="#" class="nav-link mininav-toggle collapsed" aria-expanded="false">
                                                    <i class="demo-pli-unlock fs-5 me-2"></i>
                                                    <span class="nav-label ms-1">Raw Matterial</span>
                                                </a>
                                                <ul class="mininav-content nav flex-column collapse">
                                                    <!-- <li class="nav-item">
                                                        <a href="#" class="nav-link">This device only</a>
                                                    </li> -->
                                                        <li class="nav-item">
                                                        <a href="<?php echo base_url();?>rmob" class="nav-link <?php if($pageName=='/rmob'){ echo "active";} ?>">Opening Balance</a>
                                                        </li>
                                                        <li class="nav-item">
                                                        <a href="<?php echo base_url();?>rm-equisition" class="nav-link <?php if($pageName=='/rm-equisition'){ echo "active";} ?>">Requisition</a>
                                                        </li>
                                                        <li class="nav-item">
                                                              <a href="<?php echo base_url();?>rm-equisition-email" class="nav-link <?php if($pageName=='/rm-equisition-email'){ echo "active";} ?>">Requisition Email</a>
                                                          </li>
                                                            <li class="nav-item">
                                                                <a href="<?php echo base_url();?>rm-Purchase-order-data" class="nav-link <?php if($pageName=='/rm-Purchase-order-data'){ echo "active";} ?>">Purchase Order</a>
                                                            </li>
                                                  
                                                        </ul>
                                                    </li>
                                            </ul>
                                        </li> 
                                        <li class="nav-item">
                                         <ul id="mainnav" class="mainnav__menu nav flex-column">
                                            <li class="nav-item has-sub">
                                                <a href="#" class="nav-link mininav-toggle collapsed <?php if($pageName=='/OtherPo' || $pageName=='/addOtherPo' || $pageName=='/createOtherPo' || $pageName=='/supplierSchedule'){ echo "active";} ?>" aria-expanded="false">
                                                    <i class="demo-pli-unlock fs-5 me-2"></i>
                                                    <span class="nav-label ms-1">Parts</span>
                                                </a>
                                                <ul class="mininav-content nav flex-column collapse">
                                                    
                                                    <li class="nav-item">
                                                    <a href="<?php echo base_url();?>OtherPo" class="nav-link <?php if($pageName=='/OtherPo' || $pageName=='/addOtherPo' || $pageName=='/createOtherPo' || $pageName=='/addSupplierSchedule'){ echo "active";} ?>">Parts Po</a>
                                                    </li>
                                                        <li class="nav-item">
                                                    <a href="<?php echo base_url();?>supplierSchedule" class="nav-link <?php if($pageName=='/supplierSchedule'){ echo "active";} ?>">Supplier Schedule</a>
                                                    </li>
                                                     </li>
                                                        <li class="nav-item">
                                                    <a href="<?php echo base_url();?>Incoming" class="nav-link <?php if($pageName=='/Incoming'){ echo "active";} ?>">Incoming</a>
                                                    </li>
                                                     </li>
                                                        <li class="nav-item">
                                                    <a href="<?php echo base_url();?>Inprocess-dpr" class="nav-link <?php if($pageName=='/Inprocess-dpr'){ echo "active";} ?>">In Process (DPR)</a> 
                                                    </li>
                                                 
                                                 
                                                 
                                                  

                                                </ul>
                                                </li>
                                            </ul>
                                        </li> 
                                        
                                        <li class="nav-item">
                                         <ul id="mainnav" class="mainnav__menu nav flex-column">
                                            <li class="nav-item has-sub">
                                                <a href="#" class="nav-link mininav-toggle collapsed " aria-expanded="false">
                                                    <i class="demo-pli-unlock fs-5 me-2"></i>
                                                    <span class="nav-label ms-1">Consumables</span>
                                                </a>
                                                <ul class="mininav-content nav flex-column collapse">
                                                 <li class="nav-item">
                                                <!--<a href="<?php echo base_url();?>partsPurchseOrder" class="nav-link <?php if($pageName=='/partspurchseOrder' || $pageName=='/ConsumablesPO'){ echo "active";} ?>">Purchase Order</a>-->
                                                <a href="<?php echo base_url();?>ConsumablesPO" class="nav-link <?php if($pageName=='/partspurchseOrder' || $pageName=='/ConsumablesPO'){ echo "active";} ?>">Purchase Order</a>
                                                </li>
                                                 
                                                 
                                                  

                                                </ul>
                                                </li>
                                            </ul>
                                        </li> 
                                       <li class="nav-item">
                                         <ul id="mainnav" class="mainnav__menu nav flex-column">
                                            <li class="nav-item has-sub">
                                                <a href="#" class="nav-link mininav-toggle collapsed <?php if($pageName=='/Trantool' || $pageName=='/addTrantool' || $pageName=='/createTrantool' || $pageName=='/updateTrantool'){ echo "active";} ?>" aria-expanded="false">
                                                    <i class="demo-pli-unlock fs-5 me-2"></i>
                                                    <span class="nav-label ms-1">Tools</span>
                                                </a>
                                                <ul class="mininav-content nav flex-column collapse">
                                                 <li class="nav-item">
                                                   <a href="<?php echo base_url();?>Trantool" class="nav-link <?php if($pageName=='/Trantool'){ echo "active";} ?>">Tran Tools</a>
                                                </li>
                                                </ul>
                                                </li>
                                            </ul>
                                     </li> 


                                  
                               
                                </ul>
                            </li>
                            
                            <?php } if($role != 2 && $role != 4 && $role != 5){ ?>
                            <li class="nav-item has-sub">

                                <a href="#" class="mininav-toggle nav-link collapsed  <?php if($pageName=='/Tran-DPR' || $pageName=='/Create-DPR' || $pageName=='/Update-DPR'){ echo "active";} ?>"><i class="demo-pli-tactic fs-5 me-2"></i>
                                    <span class="nav-label ms-1">Daily Prod. Report</span>
                                </a>
                                <ul class="mininav-content nav collapse">
                                    <li class="nav-item">
                                    <a href="<?php echo base_url();?>Tran-DPR" class="nav-link <?php if($pageName=='/Tran-DPR' || $pageName=='/Create-DPR' || $pageName=='/Update-DPR' || $pageName=='/Update-DPR'){ echo "active";} ?>">Daily Prod. Report</a>
                                    </li>
                                </ul>
                            </li>
                            
                            
                            
                            <?php } if($role != 2 && $role != 3 && $role != 4 && $role != 6){ ?>
                            <li class="nav-item has-sub">

                                <a href="#" class="mininav-toggle nav-link collapsed  <?php if($pageName=='/PartsRCIR' || $pageName=='/addPartRCIR' || $pageName=='/RMRCIR' || $pageName=='/addRMRCIR' || $pageName=='/ConsumeRCIR' || $pageName=='/addConsumablesRCIR' || $pageName=='/viewDeliveryC' || $pageName=='/addDeliveryC' || $pageName=='/createDC' || $pageName=='/viewDCOperation' || $pageName=='/addDCOperation' || $pageName=='/viewInvoice' || $pageName=='/addInvoice' || $pageName=='/RMMovement' || $pageName=='/addRMMovement' || $pageName=='/createMovement' || $pageName=='/PartsMovement' || $pageName=='/addPartsMovement' || $pageName=='/createPMovement' || $pageName=='/scrapInvoice' || $pagename=='/addToollife'){ echo "active";} ?>"><i class="demo-pli-data-storage fs-5 me-2"></i>
                                    <span class="nav-label ms-1">Store</span>
                                </a>
                                <ul class="mininav-content nav collapse">
                                    <li class="nav-item">
                                        <a href="<?php echo base_url();?>RMRCIR" class="nav-link <?php if($pageName=='/RMRCIR' || $pageName=='/addRMRCIR' ){ echo "active";} ?>">RM RCIR</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url();?>RMMovement" class="nav-link <?php if($pageName=='/RMMovement' || $pageName=='/addRMMovement' || $pageName=='/createMovement' ){ echo "active";} ?>">RM Movement</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url();?>PartsRCIR" class="nav-link <?php if($pageName=='/PartsRCIR' || $pageName=='/addPartRCIR' ){ echo "active";} ?>">Parts RCIR</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url();?>PartsMovement" class="nav-link <?php if($pageName=='/PartsMovement' || $pageName=='/addPartsMovement' || $pageName=='/createPMovement' ){ echo "active";} ?>">Parts Movement. Branch</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url();?>ConsumeRCIR" class="nav-link <?php if($pageName=='/ConsumeRCIR' || $pageName=='/addConsumablesRCIR' ){ echo "active";} ?>">Consumables RCIR</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url();?>viewDeliveryC" class="nav-link <?php if($pageName=='/viewDeliveryC' || $pageName=='/addDeliveryC' || $pageName=='/createDC' ){ echo "active";} ?>">Delivery Challan</a>
                                    </li>
                                      <li class="nav-item">
                                        <a href="<?php echo base_url();?>PartsMovementSupl" class="nav-link <?php if($pageName=='/PartsMovementsupl' || $pageName=='/updatePMovementsupl' || $pageName=='/createPMovementsupl' || $pageName=='AddPartsMovementSupl'){ echo "active";} ?>">Parts Movement Supplier</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url();?>viewDCOperation" class="nav-link <?php if($pageName=='/viewDCOperation' || $pageName=='/addDCOperation' ){ echo "active";} ?>">DC Operation RCIR</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url();?>viewInvoice" class="nav-link <?php if($pageName=='/viewInvoice' || $pageName=='/addInvoice' ){ echo "active";} ?>">Invoice</a>
                                    </li>
                                      <li class="nav-item">
                                        <a href="<?php echo base_url();?>addScrapInvoice" class="nav-link <?php if($pageName=='/addScrapInvoice'){ echo "active";} ?>">Scrap Invoice</a>
                                    </li>
                                  
                                    
                                </ul>
                                <!--<ul class="mininav-content nav collapse">
                                    <li class="nav-item">
                                        <a href="<?php echo base_url();?>PartsRCIR" class="nav-link <?php if($pageName=='/PartsRCIR' ){ echo "active";} ?>">Parts RCIR</a>
                                    </li>
                                </ul>-->
                            </li>
                            
                            <?php } if($role != 2 && $role != 3 && $role != 5 && $role != 6){ ?>
                            <li class="nav-item has-sub">

                                <a href="#" class="mininav-toggle nav-link collapsed  <?php if($pageName=='/RMQC'){ echo "active";} ?>"><i class="demo-pli-data-storage fs-5 me-2"></i>
                                    <span class="nav-label ms-1">Quality Control</span>
                                </a>
                                <ul class="mininav-content nav collapse">
                                    <li class="nav-item">
                                        <a href="<?php echo base_url();?>RMQC" class="nav-link <?php if($pageName=='/RMQC' ){ echo "active";} ?>">Raw Material</a>
                                    </li>
                                   <!-- <li class="nav-item">
                                        <a href="<?php echo base_url();?>PartsQC" class="nav-link <?php if($pageName=='/PartsQC' ){ echo "active";} ?>">Parts</a>
                                    </li>-->
                                    
                                     <li class="nav-item">
                                         <ul id="mainnav" class="mainnav__menu nav flex-column">
                                            <li class="nav-item has-sub">
                                                <a href="#" class="nav-link mininav-toggle collapsed <?php if($pageName=='/Incoming' || $pageName=='/Inprocess'){ echo "active";} ?>" aria-expanded="false">
                                                    <i class="demo-pli-unlock fs-5 me-2"></i>
                                                    <span class="nav-label ms-1">Parts</span>
                                                </a>
                                                <ul class="mininav-content nav flex-column collapse">
                                                   <li class="nav-item">
                                                <a href="<?php echo base_url();?>Incoming" class="nav-link <?php if($pageName=='/Incoming'){ echo "active";} ?>">Incoming</a>
                                                </li>
                                                    <li class="nav-item">
                                                <a href="<?php echo base_url();?>Inprocess-dpr" class="nav-link <?php if($pageName=='/Inprocess-dpr'){ echo "active";} ?>">Inprocess-DPR</a>
                                                </li>
                                                 
                                                </ul>
                                                </li>
                                            </ul>
                                        </li> 
                                    </ul>
                                <ul class="mininav-content nav collapse">
                                    <li class="nav-item">
                                        <a href="<?php echo base_url();?>PartsRCIR" class="nav-link <?php if($pageName=='/PartsRCIR' ){ echo "active";} ?>">Parts RCIR</a>
                                    </li>
                                </ul>
                            </li>
                            
                            <?php } ?>
                            
                            
                            
                            <li class="nav-item has-sub">

                                <a href="#" class="mininav-toggle nav-link collapsed  <?php if($pageName=='/SchVSDesPatchR' || $pageName=='/ToolLifeR' || $pageName=='/OperPerformanceR' || $pageName=='/RMStockDetails' || $pageName=='/PartStockDetails' || $pageName=='/ScrapStockR' || $pageName=='/InprocessDprQCR' || $pageName=='/RMStockSummary' || $pageName=='/RMConsumptionR' || $pageName=='/RejectionSummaryR' || $pageName=='/SchVSDisPatchByCust'){ echo "active";} ?>"><i class="demo-pli-tactic fs-5 me-2"></i>
                                    <span class="nav-label ms-1">Report</span>
                                </a>
                                <ul class="mininav-content nav collapse">
                                    <li class="nav-item">
                                    <a href="<?php echo base_url();?>SchVSDesPatchR" class="nav-link <?php if($pageName=='/SchVSDesPatchR'){ echo "active";} ?>">Sch. VS Dispatch</a>
                                    </li>
                                     <li class="nav-item">
                                    <a href="<?php echo base_url();?>SchVSDisPatchByCust" class="nav-link <?php if($pageName=='/SchVSDisPatchByCust'){ echo "active";} ?>">Sch. VS Dispatch By Customer</a>
                                    </li>
                                    <li class="nav-item">
                                    <a href="<?php echo base_url();?>ToolLifeR" class="nav-link <?php if($pageName=='/ToolLifeR'){ echo "active";} ?>">Tool Life</a>
                                    </li>
                                    <li class="nav-item">
                                    <!--<a href="<?php echo base_url();?>OperatorPerformanceR" class="nav-link <?php if($pageName=='/OperatorPerformanceR'){ echo "active";} ?>">Operator Performance</a>-->
                                     <a href="<?php echo base_url();?>OperPerformanceR" class="nav-link <?php if($pageName=='/OperPerformanceR'){ echo "active";} ?>">Operator Performance</a>
                                    </li>
                                    <li class="nav-item">
                                     <a href="<?php echo base_url();?>RMStockDetails" class="nav-link <?php if($pageName=='/RMStockDetails'){ echo "active";} ?>">RM Stock Details</a>
                                    </li>
                                     <li class="nav-item">
                                     <a href="<?php echo base_url();?>RMStockSummary" class="nav-link <?php if($pageName=='/RMStockSummary'){ echo "active";} ?>">RM Stock Summary</a>
                                    </li>
                                     <li class="nav-item">
                                     <a href="<?php echo base_url();?>PartStockDetails" class="nav-link <?php if($pageName=='/PartStockDetails'){ echo "active";} ?>">Parts Stock Details</a>
                                    </li>
                                      <li class="nav-item">
                                     <a href="<?php echo base_url();?>ScrapStockR" class="nav-link <?php if($pageName=='/ScrapStockR'){ echo "active";} ?>">Scrap Stock Details</a>
                                    </li>
                                       <li class="nav-item">
                                     <a href="<?php echo base_url();?>InprocessDprQCR" class="nav-link <?php if($pageName=='/InprocessDprQCR'){ echo "active";} ?>">Inprocess DPR QC Report</a>
                                    </li>
                                      <li class="nav-item">
                                     <a href="<?php echo base_url();?>RMConsumptionR" class="nav-link <?php if($pageName=='/RMConsumptionR'){ echo "active";} ?>">RM Consumption Details</a>
                                    </li>
                                    <li class="nav-item">
                                     <a href="<?php echo base_url();?>RejectionSummaryR" class="nav-link <?php if($pageName=='/RejectionSummaryR'){ echo "active";} ?>">Rejection Stock Summary</a>
                                    </li>
                                </ul>
                            </li>






                            <!-- END : Link with submenu -->

                            <!-- END : Regular menu link -->

                        </ul>
                    </div>
                    <!-- END : Navigation Category -->

                    

                </div>
                <!-- End - Navigation menu -->


                <!-- Bottom navigation menu -->
                <div class="mainnav__bottom-content border-top pb-2">
                    <ul id="mainnav" class="mainnav__menu nav flex-column">
                        <li class="nav-item has-sub">
                            <a href="#" class="nav-link mininav-toggle collapsed" aria-expanded="false">
                                <i class="demo-pli-unlock fs-5 me-2"></i>
                                <span class="nav-label ms-1">Logout</span>
                            </a>
                            <ul class="mininav-content nav flex-column collapse">
                                <!-- <li class="nav-item">
                                    <a href="#" class="nav-link">This device only</a>
                                </li> -->
                                <li class="nav-item">
                                    <a href="<?php echo base_url('logout');?>" class="nav-link">All Devices</a>
                                </li>
                                <!-- <li class="nav-item">
                                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Lock screen</a>
                                </li> -->
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- End - Bottom navigation menu -->