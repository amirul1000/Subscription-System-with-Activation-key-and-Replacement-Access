<a  href="<?php echo site_url('admin/subscription/index'); ?>" class="btn btn-info"><i class="arrow_left"></i> List</a>
<h5 class="font-20 mt-15 mb-1"><?php echo str_replace('_',' ','Subscription'); ?></h5>
<!--Data display of subscription with id--> 
<?php
	$c = $subscription;
?> 
<table class="table table-striped table-bordered">         
		<tr><td>Users</td><td><?php
									   $this->CI =& get_instance();
									   $this->CI->load->database();	
									   $this->CI->load->model('Users_model');
									   $dataArr = $this->CI->Users_model->get_users($c['users_id']);
									   echo $dataArr['email'];?>
									</td></tr>

<tr><td>Service Type</td><td><?php
									   $this->CI =& get_instance();
									   $this->CI->load->database();	
									   $this->CI->load->model('Service_type_model');
									   $dataArr = $this->CI->Service_type_model->get_service_type($c['service_type_id']);
									   echo $dataArr['service_name'];?>
									</td></tr>

<tr><td>Activation Key</td><td><?php echo $c['activation_key']; ?></td></tr>

<tr><td>Limit Count</td><td><?php echo $c['limit_count']; ?></td></tr>

<tr><td>Used Count</td><td><?php echo $c['used_count']; ?></td></tr>

<tr><td>Expiration Date Time</td><td><?php echo $c['expiration_date_time']; ?></td></tr>

<tr><td>Created At</td><td><?php echo $c['created_at']; ?></td></tr>

<tr><td>Updated At</td><td><?php echo $c['updated_at']; ?></td></tr>


</table>
<!--End of Data display of subscription with id//--> 