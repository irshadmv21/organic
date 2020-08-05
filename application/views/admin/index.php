
<?php
$data['page_title']='Dashboard';
$this->load->view('admin/includes/header',$data);

?>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
             <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Dashboard</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                                    <!-- <li class="breadcrumb-item active" aria-current="page">Library</li> -->
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="container-fluid">
                <div class="">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-3">
                                <div class="bg-dark p-10 text-white text-center">
                                    <i class="fa fa-user m-b-5 font-16"></i>
                                    <h5 class="m-b-0 m-t-5">2540</h5>
                                    <small class="font-light">Total Users</small>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="bg-dark p-10 text-white text-center">
                                    <i class="fa fa-plus m-b-5 font-16"></i>
                                    <h5 class="m-b-0 m-t-5">120</h5>
                                    <small class="font-light">New Users</small>
                                </div>
                            </div>
                            <div class="col-3 ">
                                 <div class="bg-dark p-10 text-white text-center">
                                    <i class="fa fa-cart-plus m-b-5 font-16"></i>
                                    <h5 class="m-b-0 m-t-5">656</h5>
                                    <small class="font-light">Total Shop</small>
                                </div>
                            </div>
                                <div class="col-3 ">
                                <div class="bg-dark p-10 text-white text-center">
                                    <i class="fa fa-tag m-b-5 font-16"></i>
                                    <h5 class="m-b-0 m-t-5">9540</h5>
                                    <small class="font-light">Total Orders</small>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            
<?php
$this->load->view('admin/includes/footer');

?>