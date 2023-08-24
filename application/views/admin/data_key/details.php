<a  href="<?php echo site_url('admin/data_key/index'); ?>" class="btn btn-info"><i class="arrow_left"></i> List</a>
<h5 class="font-20 mt-15 mb-1"><?php echo str_replace('_',' ','Data_key'); ?></h5>
<!--Data display of data_key with id--> 
<?php
	$c = $data_key;
?> 
<table class="table table-striped table-bordered">         
		<tr><td>Service Type</td><td><?php
									   $this->CI =& get_instance();
									   $this->CI->load->database();	
									   $this->CI->load->model('Service_type_model');
									   $dataArr = $this->CI->Service_type_model->get_service_type($c['service_type_id']);
									   echo $dataArr['service_name'];?>
									</td></tr>

<tr><td>Service Email</td><td><?php echo $c['service_email']; ?></td></tr>

<tr><td>Service Password</td><td><?php echo $c['service_password']; ?></td></tr>

<tr><td>Used</td><td><?php echo $c['used']; ?></td></tr>

<tr><td>Used By Users</td><td><?php
									   $this->CI =& get_instance();
									   $this->CI->load->database();	
									   $this->CI->load->model('Users_model');
									   $dataArr = $this->CI->Users_model->get_users($c['used_by_users_id']);
									   echo $dataArr['email'];?>
									</td></tr>

<tr><td>Used By Activation Key</td><td><?php echo $c['used_by_activation_key']; ?></td></tr>

<tr><td>Created At</td><td><?php echo $c['created_at']; ?></td></tr>

<tr><td>Updated At</td><td><?php echo $c['updated_at']; ?></td></tr>


</table>
<!--End of Data display of data_key with id//--> 