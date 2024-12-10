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
pre {
font-family: var(--bs-body-font-family);
font-size: 15px;
text-transform: uppercase;
}
</style>
<script>
function clearData(){
     if (confirm("Are you sure ?")) {
         window.location='<?php echo base_url('ClearData')?>';
       }
    return false;
}
function takeBackup(routename) {
    
    if(prompt("Please enter your password","") == "123"){
            
             window.location = "<?php echo base_url();?>"+routename;  
      }else{
           alert("wrong password..");
      }
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
                               <span class="fst-italic"><?=$_SESSION['username']." - ".$_SESSION['role_name']." - ( ".$_SESSION['current_year']." ) - ".$_SESSION['branch_name'];?></span>
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
                                            <a href="<?=base_url('logout');?>" class="list-group-item list-group-item-action">
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
                                    
                                    <a href="<?php echo base_url('logout'); ?>" class="nav-link">
                                        <i class="demo-pli-unlock fs-5 me-2"></i>
                                        <span class="ms-1">Logout</span>
                                    </a>
                                      <!-- Start of change branch -->
                                          <a href="<?php echo base_url('changeBranch') ?>" class="nav-link" >
                                                <i class="demo-pli-unlock fs-5 me-2" ></i>
                                                <span class="ms-1">Change Branch</span>
                                         </a>
                                         <!-- End of change branch-->
                                          <!-- Start of user credentials -->
                                          <a href="<?php echo base_url('changeUserpass') ?>" class="nav-link" >
                                                <i class="demo-pli-unlock fs-5 me-2" ></i>
                                                <span class="ms-1">Change Password</span>
                                         </a>
                                         <!-- End of credentials-->
                                </div>

                            </div>
                        </div>

                    </div>
                    <!-- End - Profile widget -->

                    <!-- Navigation Category -->
                    <div class="mainnav__categoriy py-3">
                                    <?php if($role ==1 ){ ?>
                        <h6 class="mainnav__caption mt-0 px-3 fw-bold">Dashboard</h6>
                        <ul class="mainnav__menu nav flex-column">

                            <!-- Link with submenu -->
                            <li class="nav-item has-sub">

                                <a href="#" class="mininav-toggle nav-link <?php if($pageName=='/MangDashboard'){ echo "active";} ?>"><i class="demo-pli-home fs-5 me-2" onclick="<?php $_SESSION['dashboard']=1; ?>"></i>
                                    <span class="nav-label ms-1">Dashboard</span>
                                </a>

                                <!-- Dashboard submenu list -->
                                <ul class="mininav-content nav collapse">
                                    <li class="nav-item">
                                        <a href="<?php echo base_url('MangDashboard');?>" class="nav-link <?php if($pageName=='/MangDashboard'){ echo "active";} ?>">Dashboard</a>
                                    </li>
                             
                                    <!--<li class="nav-item">-->
                                    <!--    <a href="#"  class="nav-link  <?php if($pageName=='/ClearData'){ echo "active";} ?>" onclick="clearData();">Clear Data</a>-->
                                    <!--</li>-->
                                     <li class="nav-item">
                                        <a herf="#" class="nav-link" onclick="takeBackup('DatabaseBackup');">Database Backup</a>
                                    </li>  
                                    <!--<li class="nav-item">-->
                                    <!--    <a href="#" class="nav-link" onclick="takeBackup('DBExport');">Database Export(Codeigniter)</a>-->
                                    <!--</li>-->
                        

                                </ul>
                                <!-- END : Dashboard submenu list -->

                            </li>
                            <!-- END : Link with submenu -->

                            

                            <!-- END : Regular menu link -->

                        </ul>
                                    <?php } ?>
                        <ul class="mainnav__menu nav flex-column">
                            <!-- Link with submenu -->
                            
                            <?php if($role ==1 ){ ?>
                            <li class="nav-item has-sub">
                                <a href="#" class="mininav-toggle nav-link collapsed  <?php if($pageName=='/addUpdatecompany' || $pageName=='/users' || $pageName=='/addUser' || 
                                $pageName=='/rawMaterial' || $pageName=='/addrawMaterial' || $pageName=='/createRawMaterial' || 
                                $pageName=='/qualityChecks' || $pageName=='/addQualityChecks' || $pageName=='/createQualityChecks' || 
                                $pageName=='/parts' || $pageName=='/addParts' || $pageName=='/createPart' || $pageName=='/Customers' ||
                                $pageName=='/createCustomer' || $pageName=='/createSupplier' || $pageName=='/Supplier' || 
                                $pageName=='/addSupplier' || $pageName=='/addCustomers' || $pageName=='/Operators' || 
                                $pageName=='/createOperators' || $pageName=='/addOperators' || $pageName=='/operations' || 
                                $pageName=='/addOperations' || $pageName=='/createOperations' || $pageName=='/tools' || $pageName=='/addTools' ||
                                $pageName=='/partOperations'  || $pageName=='/createRelParts' || $pageName=='/addOperations' || 
                                $pageName=='/updateReOpts' || $pageName=='/viewMachine' || $pageName=='/addMachine' ||
                                $pageName=='/createMachine' || $pageName=='/rmob' || $pageName=='/createRMOB' ||
                                $pageName=='/viewToolMaker' || $pageName=='/addToolMaker'){ echo "active";} ?>"><i class="demo-pli-split-vertical-2 fs-5 me-2"></i>
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
                                        <a href="<?php echo base_url();?>Operators" class="nav-link <?php if($pageName=='/Operators' || $pageName=='/createOperators' || $pageName=='/addOperators'){ echo "active";} ?>">Operators</a>
                                    </li> 
                                    <li class="nav-item">
                                        <a href="<?php echo base_url();?>rawMaterial" class="nav-link <?php if($pageName=='/rawMaterial' || $pageName=='/addrawMaterial' || $pageName=='/createRawMaterial'){ echo "active";} ?>">Raw Material</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url();?>rmob" class="nav-link <?php if($pageName=='/rmob' || $pageName=='/createRMOB'){ echo "active";} ?>">Raw Material OB</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url();?>parts" class="nav-link <?php if($pageName=='/parts' || $pageName=='/addParts' || $pageName=='/createPart'){ echo "active";} ?>">Parts</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url();?>operations" class="nav-link <?php if($pageName=='/operations' || $pageName=='/addOperations' || $pageName=='/createOperations'){ echo "active";} ?>">Operations</a>
                                    </li>
                                     <li class="nav-item">
                                        <a href="<?php echo base_url();?>partOperations" class="nav-link <?php if($pageName=='/partOperations' || $pageName=='/createRelParts' || $pageName=='/updateReOpts'){ echo "active";} ?>">Part Operations</a>
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
                                    <li class="nav-item">
                                        <a href="<?php echo base_url();?>viewToolMaker" class="nav-link <?php if($pageName=='/viewToolMaker' || $pageName=='/addToolMaker' || $pageName=='/createToolMaker' || $pageName=='/updateToolMaker'){ echo "active";} ?>">Tool Maker</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url();?>addUpdatecompany" class="nav-link <?php if($pageName=='/company' || $pageName=='/addUpdatecompany'){ echo "active";} ?>">Company</a>
                                    </li>
                                </ul>
                                <!-- END : Layouts submenu list -->

                            </li>
                            <?php }
                            
                            
                            if($role == 1 || $role==2) { ?> 
                    ====================
                            <li class="nav-item has-sub">

                                <a href="#" class="mininav-toggle nav-link collapsed  <?php if($pageName=='/rm-equisition' || $pageName=='/rm-equisition-email' || $pageName=='/rm-Purchase-order'|| $pageName=='/rm-Purchase-order-data' || $pageName=='/addOtherPo'|| $pageName=='/OtherPo'|| $pageName=='/createOtherPo' || $pageName=='/supplierSchedule' || $pageName=='/showSchBySupplierBranch' || $pageName=='/addSupplierSchedule'|| $pageName=='/ConsumablesPO' || $pageName=='/addConsumablesPo')
                                { echo "active";} ?>"><i class="demo-pli-tactic fs-5 me-2"></i>
                                    <span class="nav-label ms-1">Suppliers</span>
                                </a>
                                <ul class="mininav-content nav collapse">
                                    <li class="nav-item">
                                        <a href="<?php echo base_url();?>rm-equisition" class="nav-link <?php if($pageName=='/rm-equisition' || $pageName=='/rm-equisition'){ echo "active";} ?>">RM Requisition</a>
                                    </li>
                                    <li class="nav-item">
                                      <a href="<?php echo base_url();?>rm-equisition-email" class="nav-link <?php if($pageName=='/rm-equisition-email'){ echo "active";} ?>">Requisition Email</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url();?>rm-Purchase-order-data" class="nav-link <?php if($pageName=='/rm-Purchase-order-data' || $pageName=='/rm-Purchase-order'){ echo "active";} ?>">RM PO</a>
                                    </li>
                                     
                                     <li class="nav-item">
                                       <a href="<?php echo base_url();?>OtherPo" class="nav-link <?php if($pageName=='/OtherPo' || $pageName=='/addOtherPo' || $pageName=='/createOtherPo' ){ echo "active";} ?>">Parts Po</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url();?>supplierSchedule" class="nav-link <?php if($pageName=='/showSchBySupplierBranch' || $pageName=='/addSupplierSchedule' ){ echo "active";} ?>">Supplier Schedule</a>
                                    </li>
                                    <li class="nav-item">
                                      <a href="<?php echo base_url();?>ConsumablesPO" class="nav-link <?php if($pageName=='/ConsumablesPO' || $pageName=='/addConsumablesPo'){ echo "active";} ?>">Consumables PO</a>
                                   </li>
                               </ul>                            
                         </li>
                   ====================      <?php }
                         
                            if($role == 1 || $role==2) { ?> 
                         
                                   <li class="nav-item has-sub">

                                <a href="#" class="mininav-toggle nav-link collapsed  <?php if($pageName=='/orderAcceptance' || $pageName=='/addOrderAcceptance' || $pageName=='/schedule' || $pageName=='/addSchedule' || $pageName=='/createSchedule' ){ echo "active";} ?>"><i class="demo-pli-tactic fs-5 me-2"></i>
                                    <span class="nav-label ms-1">Customers</span>
                                </a>
                        
                                <ul class="mininav-content nav collapse">
                             <li class="nav-item">
                                        <a href="<?php echo base_url();?>orderAcceptance" class="nav-link <?php if($pageName=='/orderAcceptance' || $pageName=='/addOrderAcceptance'){ echo "active";} ?>">Order Acceptance</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url();?>schedule" class="nav-link <?php if($pageName=='/schedule' || $pageName=='/addSchedule' || $pageName=='/createSchedule'){ echo "active";} ?>">Schedule</a>
                                    </li>
                            </ul>
                            </li>
                        ====================
                        <?php }
                         
                            if($role == 1 || $role==2 || $role==3) { ?> 
                         
                           <li class="nav-item has-sub">

                                <a href="#" class="mininav-toggle nav-link collapsed  <?php if($pageName=='/schedulePlanning' || $pageName=='/createSchedulePlanning'|| $pageName=='/schedulePlanning1' ||$pageName=='/addProdPlanning' || $pageName=='/Tran-DPR' || $pageName=='/Create-DPR' || $pageName=='/Update-DPR'  ){ echo "active";} ?>"><i class="demo-pli-tactic fs-5 me-2"></i>
                                    <span class="nav-label ms-1">Production</span>
                                </a>
                        
                                <ul class="mininav-content nav collapse">
                                    <li class="nav-item">
                                        <a href="<?php echo base_url();?>schedulePlanning" class="nav-link <?php if($pageName=='/schedulePlanning' || $pageName=='/createSchedulePlanning' || $pageName=='/schedulePlanning1' || $pageName=='/addProdPlanning'){ echo "active";} ?>">Schedule Planning</a>
                                    </li>
                                    <li class="nav-item">
                                       <a href="<?php echo base_url();?>Tran-DPR" class="nav-link <?php if($pageName=='/Tran-DPR' || $pageName=='/Create-DPR' || $pageName=='/Update-DPR' || $pageName=='/Update-DPR'){ echo "active";} ?>">Daily Prod. Report</a>
                                    </li>
                 
                                 
                                </ul>
                            </li>
                        ====================
                                <?php }
                         
                            if($role == 1 || $role==2 || $role ==5) { ?> 
                        <li class="nav-item has-sub">

                                <a href="#" class="mininav-toggle nav-link collapsed  <?php if($pageName=='/RMRCIR' || $pageName=='/addRMRCIR' || $pageName=='/RMMovement' || 
                                $pageName=='/addRMMovement' || $pageName=='/createMovement' || $pageName=='/PartsRCIR' || $pageName=='/addPartRCIR' || 
                                $pageName=='/PartsMovement' || $pageName=='/addPartsMovement' || $pageName=='/createPMovement' || 
                                $pageName=='/PartsMovementSupl' || $pageName=='/updatePMovementsupl' || $pageName=='/createPMovementsupl' || 
                                $pageName=='/AddPartsMovementSupl' || $pageName=='/ConsumeRCIR' || $pageName=='/addConsumablesRCIR' || 
                                $pageName=='/viewDeliveryC' || $pageName=='/addDeliveryC' || $pageName=='/createDC' || 
                                $pageName=='/viewDCOperation' || $pageName=='/addDCOperation' || $pageName=='/addOBDeliveryC' || 
                                $pageName=='/viewOBDeliveryC' ){ echo "active";} ?>"><i class="demo-pli-tactic fs-5 me-2"></i>
                                    <span class="nav-label ms-1">Stores</span>
                                </a>
                        
                                <ul class="mininav-content nav collapse">
                                 <li class="nav-item">
                                        <a href="<?php echo base_url();?>RMRCIR" class="nav-link <?php if($pageName=='/RMRCIR' || $pageName=='/addRMRCIR' ){ echo "active";} ?>">RM RCIR</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url();?>RMMovement" class="nav-link <?php if($pageName=='/RMMovement' || $pageName=='/addRMMovement' || $pageName=='/createMovement' ){ echo "active";} ?>">RM Movement</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url();?>PartsRCIR" class="nav-link <?php if($pageName=='/PartsRCIR' || $pageName=='/addPartRCIR' ){ echo "active";} ?>">Parts (Bought Out) RCIR</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url();?>PartsMovement" class="nav-link <?php if($pageName=='/PartsMovement' || $pageName=='/addPartsMovement' || $pageName=='/createPMovement' ){ echo "active";} ?>">Parts Move. Branch</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url();?>PartsMovementSupl" class="nav-link <?php if($pageName=='/PartsMovementSupl' || $pageName=='/updatePMovementsupl' || $pageName=='/createPMovementsupl' || $pageName=='/AddPartsMovementSupl'){ echo "active";} ?>">Parts Move. Supplier</a>
                                    </li>
                                   <!--<li class="nav-item">-->
                                   <!--     <a href="<?php echo base_url();?>PartsStkAdjustment" class="nav-link <?php if($pageName=='/PartsStkAdjustment' || $pageName=='/updatePartsStkAdj'){ echo "active";} ?>">Parts Stock Adjustment</a>-->
                                   <!-- </li>-->
                                
                                    <li class="nav-item">
                                        <a href="<?php echo base_url();?>ConsumeRCIR" class="nav-link <?php if($pageName=='/ConsumeRCIR' || $pageName=='/addConsumablesRCIR' ){ echo "active";} ?>">Consumables RCIR</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url();?>viewDeliveryC" class="nav-link <?php if($pageName=='/viewDeliveryC' || $pageName=='/addDeliveryC' || $pageName=='/createDC' ){ echo "active";} ?>">Delivery Challan</a>
                                    </li>
                                    <!-- <li class="nav-item">-->
                                    <!--    <a href="<?php echo base_url();?>viewOBDeliveryC" class="nav-link <?php if($pageName=='/viewOBDeliveryC' || $pageName=='/addOBDeliveryC'){ echo "active";} ?>">Delivery Challan OB</a>-->
                                    <!--</li>-->
                                    <li class="nav-item">
                                        <a href="<?php echo base_url();?>viewDCOperation" class="nav-link <?php if($pageName=='/viewDCOperation' || $pageName=='/addDCOperation' ){ echo "active";} ?>">DC Operation RCIR</a>
                                    </li>
                                   
                                   </ul>
                            </li>
                          ====================   
                        <li class="nav-item has-sub">

                                <a href="#" class="mininav-toggle nav-link collapsed  <?php if($pageName=='/PMovementRCIRdetailsReport' || $pageName=='/PartsStkAdjustment'  || $pageName=='/updatePartsStkAdj' ||$pageName=='/getDPRDetailsReport' || $pageName=='/getDCRCIRDetailsReport' || $pageName=='/getDCDetailsReport'){ echo "active";} ?>"><i class="demo-pli-tactic fs-5 me-2"></i>
                                    <span class="nav-label ms-1">Stock Adj</span>
                                </a>
                                <ul class="mininav-content nav collapse">
                                    <li class="nav-item">
                                        <a href="<?php echo base_url();?>PartsStkAdjustment" class="nav-link <?php if($pageName=='/PartsStkAdjustment' || $pageName=='/updatePartsStkAdj'){ echo "active";} ?>">Overall Adjustment</a>
                                    </li>
                                    <li class="nav-item">
                                     <a href="<?php echo base_url();?>getDCDetailsReport" class="nav-link <?php if($pageName=='/getDCDetailsReport'){ echo "active";} ?>">DC Details Report</a>
                                    </li>
                                    <li class="nav-item">
                                     <a href="<?php echo base_url();?>getDCRCIRDetailsReport" class="nav-link <?php if($pageName=='/getDCRCIRDetailsReport'){ echo "active";} ?>">RCIR Details Report</a>
                                    </li>
                                    <li class="nav-item">
                                     <a href="<?php echo base_url();?>getDPRDetailsReport" class="nav-link <?php if($pageName=='/getDPRDetailsReport'){ echo "active";} ?>">DPR Details Report</a>
                                    </li>
                                    <li class="nav-item">
                                     <a href="<?php echo base_url();?>PMovementRCIRdetailsReport" class="nav-link <?php if($pageName=='/PMovementRCIRdetailsReport'){ echo "active";} ?>">P_Movement Details Report</a>
                                    </li>
                                   </ul>
                            </li>
                            ====================    
                                        <?php }
                         
                            if($role == 1 || $role==2  || $role == 6) { ?> 
                           <li class="nav-item has-sub">

                                <a href="#" class="mininav-toggle nav-link collapsed  <?php if($pageName=='/viewInvoice' || $pageName=='/addInvoice' || $pageName=='/addScrapInvoice' || $pageName=='/scrapInvoice'){ echo "active";} ?>"><i class="demo-pli-tactic fs-5 me-2"></i>
                                    <span class="nav-label ms-1">Dispatch</span>
                                </a>
                        
                                <ul class="mininav-content nav collapse">
                                    <li class="nav-item">
                                        <a href="<?php echo base_url();?>viewInvoice" class="nav-link <?php if($pageName=='/viewInvoice' || $pageName=='/addInvoice' ){ echo "active";} ?>">Invoice</a>
                                    </li>
                                      <li class="nav-item">
                                        <a href="<?php echo base_url();?>scrapInvoice" class="nav-link <?php if($pageName=='/addScrapInvoice'  || $pageName=='/scrapInvoice'){ echo "active";} ?>">Scrap Invoice / Adj. </a>
                                    </li>
                                  
                            
                                </ul>
                            </li>
                        ====================
                        
                           <?php }
                         
                            if($role == 1 || $role==4) { ?> 
                               <li class="nav-item has-sub">

                              <a href="#" class="mininav-toggle nav-link collapsed  <?php if($pageName=='/viewToolRepair' || $pageName=='/addToolRepair' || $pageName=='/viewDefectRegiModule' || $pageName=='/addDefectRegiModule' || $pageName=='/RMQC' ||$pageName=='/addRMQC' || $pageName=='/Incoming'|| $pageName=='/addIncoming'|| $pageName=='/Inprocess-dpr'|| $pageName=='/Add-Inprocessdpr' ||  $pageName=='/Trantool'){ echo "active";} ?>"><i class="demo-pli-data-storage fs-5 me-2"></i>
                                    <span class="nav-label ms-1">Quality Control</span>
                                </a>
                                <ul class="mininav-content nav collapse">
                                    <li class="nav-item">
                                        <a href="<?php echo base_url();?>RMQC" class="nav-link <?php if($pageName=='/RMQC' ||$pageName=='/addRMQC'  ){ echo "active";} ?>">Raw Material</a>
                                    </li>
                                   <li class="nav-item">
                                                <a href="<?php echo base_url();?>Incoming" class="nav-link <?php if($pageName=='/Incoming' || $pageName=='/addIncoming'){ echo "active";} ?>">Parts Incoming </a>
                                    </li>
                                    <li class="nav-item">
                                            <a href="<?php echo base_url();?>Inprocess-dpr" class="nav-link <?php if($pageName=='/Inprocess-dpr' || $pageName=='/Add-Inprocessdpr'){ echo "active";} ?>">Inprocess-DPR</a>
                                    </li>
                                       <li class="nav-item">
                                                   <a href="<?php echo base_url();?>Trantool" class="nav-link <?php if($pageName=='/Trantool'){ echo "active";} ?>">Tool Maintain.</a>
                                    </li>
                                       <li class="nav-item">
                                        <a href="<?php echo base_url();?>viewDefectRegiModule" class="nav-link <?php if($pageName=='/viewDefectRegiModule' || $pageName=='/addDefectRegiModule' ){ echo "active";} ?>">Defect Reg. Module</a>
                                    </li>
                                     <li class="nav-item">
                                        <a href="<?php echo base_url();?>viewToolRepair" class="nav-link <?php if($pageName=='/viewToolRepair' || $pageName=='/addToolRepair'){ echo "active";} ?>">Tool Repair</a>
                                    </li>
                                                 
                                </ul>
                                  ====================
                                   
    
                            
                            
                            <?php } if($role == 1 || $role == 2  || $role == 3  || $role == 6){ ?>
                            
                            
                            
                            <li class="nav-item has-sub">

                                <a href="<?php echo base_url();?>Reports" class="nav-link collapsed  <?php if($pageName=='ScrapStockSummary' || $pageName=='/Reports' || $pageName=='toolRepairDetailsReport'  || $pageName=='/PartMvmtDatewiseDetails' || $pageName=='/SchVSDesPatchR' || $pageName=='/ToolLifeR' || $pageName=='/OperPerformanceR' || $pageName=='/RMStockDetails' || $pageName=='/PartStockDetails' || $pageName=='/ScrapStockR' || $pageName=='/InprocessDprQCR' || $pageName=='/IncomingPartQCR' || $pageName=='/RMStockSummary' || $pageName=='/RMConsumptionR' || $pageName=='/RejectionSummaryR' || $pageName=='/SchVSDisPatchByCust' || $pageName=='/AllPartStockDetails' || $pageName=='/tranToolDetailReport' || $pageName=='/tranToolDetails' || $pageName=='PartStockDetailsRevision' || $pagename=='/invoiceDetailsReport'){ echo "active";} ?>"><i class="demo-pli-tactic fs-5 me-2"></i>
                                    <span class="nav-label ms-1">Reports</span>
                                </a>
                              
                            </li>

 <?php } ?>
                           


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