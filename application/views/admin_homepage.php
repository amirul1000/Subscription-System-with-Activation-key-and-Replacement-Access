 <!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
</div>

<!-- Content Row -->
<div class="row">
	<?php
    $this->CI = & get_instance();
    $this->CI->load->database();
    $this->CI->load->model('Users_model');
    $total = $this->CI->Users_model->get_count_users();
    ?> 
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Users <a
							href="<?php echo site_url('admin/users/index'); ?>">View</a></div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$total?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
     <?php
    $this->CI = & get_instance();
    $this->CI->load->database();
    $this->CI->load->model('Subscription_model');
    $total = $this->CI->Subscription_model->get_count_subscription();
    ?> 
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Subscription <a
							href="<?php echo site_url('admin/subscription/index'); ?>">View</a></div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$total?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

   <?php
    $this->CI = & get_instance();
    $this->CI->load->database();
    $this->CI->load->model('Data_key_model');
    $total = $this->CI->Data_key_model->get_count_data_key();
    ?> 
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Data key <a
        href="<?php echo site_url('admin/data_key/index'); ?>">View</a></div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$total?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    
    
    <?php
    $this->CI = & get_instance();
    $this->CI->load->database();
    $this->CI->load->model('Service_type_model');
    $total = $this->CI->Service_type_model->get_count_service_type();
    ?> 
     <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Service type <a
        href="<?php echo site_url('admin/service_type/index'); ?>">View</a></div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$total?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
                    
     
</div>