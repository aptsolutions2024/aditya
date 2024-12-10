<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="generator" content="Hugo 0.87.0" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="Nifty is a responsive admin dashboard template based on Bootstrap 5 framework. There are a lot of useful components.">
    <title>Dashboard | Aditya</title>
   
   <!-- Fonts [ OPTIONAL ] -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS [ REQUIRED ] -->
    <link rel="stylesheet" href="<?php echo base_url() ?>public/assets/css/bootstrap.min.css">

    <!-- Nifty CSS [ REQUIRED ] -->
    <link rel="stylesheet" href="<?php echo base_url() ?>public/assets/css/nifty.min.css">

    <!-- Nifty Demo Icons [ OPTIONAL ] -->
    <link rel="stylesheet" href="<?php echo base_url() ?>public/assets/css/demo-purpose/demo-icons.min.css">

   

</head>

<body class="jumping">

    <!-- PAGE CONTAINER -->
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <div id="root" class="root mn--max hd--expanded">

        <!-- CONTENTS -->
        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
        <section id="content" class="content">
            <div class="content__header content__boxed overlapping">
                <div class="content__wrap">

                    <!-- Page title and information -->
                    <h1 class="page-title mb-2">Dashboard</h1>
                    <h2 class="h5">Welcome back to the Dashboard.</h2>
                    <p>Scroll down to see quick links and overviews of your Server, To do list<br> Order status or get some Help using Nifty.</p>
                    <!-- END : Page title and information -->

                </div>

            </div>

            <div class="content__boxed">
                <div class="content__wrap">
                    <div class="row">
                        
                        <div class="col-xl-12">
                            <div class="row">
                                <div class="col-sm-6">

                                    <!-- Tile - HDD Usage -->
                                    <div class="card bg-success text-white overflow-hidden mb-3">
                                        <div class="p-3 pb-2">
                                            <h5 class="mb-3"><i class="demo-psi-data-storage text-reset text-opacity-75 fs-3 me-2"></i> HDD Usage</h5>
                                            <ul class="list-group list-group-borderless">
                                                <li class="list-group-item p-0 text-reset d-flex justify-content-between align-items-start">
                                                    <div class="me-auto">Free Space</div>
                                                    <span class="fw-bold">132Gb</span>
                                                </li>
                                                <li class="list-group-item p-0 text-reset d-flex justify-content-between align-items-start">
                                                    <div class="me-auto">Used space</div>
                                                    <span class="fw-bold">1,45Gb</span>
                                                </li>
                                            </ul>
                                        </div>

                                        <!-- Area Chart -->
                                        <div class="py-0" style="height: 70px; margin: 0 -5px -5px;">
                                            <canvas id="_dm-hddChart"></canvas>
                                        </div>
                                        <!-- END : Area Chart -->

                                    </div>
                                    <!-- END : Tile - HDD Usage -->

                                </div>
                                <div class="col-sm-6">

                                    <!-- Tile - Earnings -->
                                    <div class="card bg-info text-white overflow-hidden mb-3">
                                        <div class="p-3 pb-2">
                                            <h5 class="mb-3"><i class="demo-psi-coin text-reset text-opacity-75 fs-2 me-2"></i> Earning</h5>
                                            <ul class="list-group list-group-borderless">
                                                <li class="list-group-item p-0 text-reset d-flex justify-content-between align-items-start">
                                                    <div class="me-auto">Today</div>
                                                    <span class="fw-bold">$764</span>
                                                </li>
                                                <li class="list-group-item p-0 text-reset d-flex justify-content-between align-items-start">
                                                    <div class="me-auto">Last 7 Day</div>
                                                    <span class="fw-bold">$1,332</span>
                                                </li>
                                            </ul>
                                        </div>

                                        <!-- Line Chart -->
                                        <div class="py-0" style="height: 70px; margin: 0 -5px -5px;">
                                            <canvas id="_dm-earningChart"></canvas>
                                        </div>
                                        <!-- END : Line Chart -->

                                    </div>
                                    <!-- END : Tile - Earnings -->

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">

                                    <!-- Tile - Sales -->
                                    <div class="card bg-purple text-white overflow-hidden mb-3">
                                        <div class="p-3 pb-2">
                                            <h5 class="mb-3"><i class="demo-psi-basket-coins text-reset text-opacity-75 fs-2 me-2"></i> Sales</h5>
                                            <ul class="list-group list-group-borderless">
                                                <li class="list-group-item p-0 text-reset d-flex justify-content-between align-items-start">
                                                    <div class="me-auto">Today</div>
                                                    <span class="fw-bold">$764</span>
                                                </li>
                                                <li class="list-group-item p-0 text-reset d-flex justify-content-between align-items-start">
                                                    <div class="me-auto">Last 7 Day</div>
                                                    <span class="fw-bold">$1,332</span>
                                                </li>
                                            </ul>
                                        </div>

                                        <!-- Bar Chart -->
                                        <div class="py-0" style="height: 70px">
                                            <canvas id="_dm-salesChart"></canvas>
                                        </div>
                                        <!-- END : Bar Chart -->

                                    </div>
                                    <!-- END : Tile - Sales -->

                                </div>
                                <div class="col-sm-6">

                                    <!-- Tile - Task Progress -->
                                    <div class="card bg-warning text-white overflow-hidden mb-3">
                                        <div class="p-3 pb-2">
                                            <h5 class="mb-3"><i class="demo-psi-basket-coins text-reset text-opacity-75 fs-2 me-2"></i> Task Progress</h5>
                                            <ul class="list-group list-group-borderless">
                                                <li class="list-group-item p-0 text-reset d-flex justify-content-between align-items-start">
                                                    <div class="me-auto">Completed</div>
                                                    <span class="fw-bold">34</span>
                                                </li>
                                                <li class="list-group-item p-0 text-reset d-flex justify-content-between align-items-start">
                                                    <div class="me-auto">Total</div>
                                                    <span class="fw-bold">79</span>
                                                </li>
                                            </ul>
                                        </div>

                                        <!-- Horizontal Bar Chart -->
                                        <div class="py-0 pb-2" style="height: 70px">
                                            <canvas id="_dm-taskChart"></canvas>
                                        </div>
                                        <!-- END : Horizontal Bar Chart -->

                                    </div>
                                    <!-- END : Tile - Task Progress -->

                                </div>
                            </div>

                            <!-- Simple state widget -->
                            <div class="card">
                                <div class="card-body text-center">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0 p-3">
                                            <div class="h3 display-3">95</div>
                                            <span class="h6">New Friends</span>
                                        </div>
                                        <div class="flex-grow-1 text-center ms-3">
                                            <p class="text-muted">Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p>
                                            <button class="btn btn-sm btn-danger">View Details</button>

                                            <!-- Social media statistics -->
                                            <div class="mt-4 pt-3 d-flex justify-content-around border-top">
                                                <div class="text-center">
                                                    <h4 class="mb-1">1,345</h4>
                                                    <small class="text-muted">Following</small>
                                                </div>
                                                <div class="text-center">
                                                    <h4 class="mb-1">23k</h4>
                                                    <small class="text-muted">Followers</small>
                                                </div>
                                                <div class="text-center">
                                                    <h4 class="mb-1">278</h4>
                                                    <small class="text-muted">Posts</small>
                                                </div>
                                            </div>
                                            <!-- END : Social media statistics -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END : Simple state widget -->

                        </div>
                    </div>

                </div>
            </div>
            
            
           <?php  $this->load->view('/include/footer'); ?>

        </section>

        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
        <!-- END - CONTENTS -->


    <?php  $this->load->view('/include/sidebar'); ?>

               

            </div>
        </nav>
        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
        <!-- END - MAIN NAVIGATION -->

        

    </div>
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <!-- END - PAGE CONTAINER -->

    <!-- SCROLL TO TOP BUTTON -->
    <div class="scroll-container">
        <a href="#root" class="scroll-page rounded-circle ratio ratio-1x1" aria-label="Scroll button"></a>
    </div>
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <!-- END - SCROLL TO TOP BUTTON -->

    

    <!-- JAVASCRIPTS -->
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

    <!-- Popper JS [ OPTIONAL ] -->
    <script src="<?php echo base_url() ?>public/assets/vendors/popperjs/popper.min.js" defer></script>

    <!-- Bootstrap JS [ OPTIONAL ] -->
    <script src="<?php echo base_url() ?>public/assets/vendors/bootstrap/bootstrap.min.js" defer></script>

    <!-- Nifty JS [ OPTIONAL ] -->
    <script src="<?php echo base_url() ?>public/assets/js/nifty.js" defer></script>

    <!-- Nifty Settings [ DEMO ] -->
    <script src="<?php echo base_url() ?>public/assets/js/demo-purpose-only.js" defer></script>

    <!-- Chart JS Scripts [ OPTIONAL ] -->
    <script src="<?php echo base_url() ?>public/assets/vendors/chart.js/chart.min.js" defer></script>

    <!-- Initialize [ SAMPLE ] -->
    <script src="<?php echo base_url() ?>public/assets/pages/dashboard-1.js" defer></script>



</body>

</html>