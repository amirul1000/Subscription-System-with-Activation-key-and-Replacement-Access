<a  href="<?php echo site_url('admin/service_type/index'); ?>" class="btn btn-info"><i class="arrow_left"></i> List</a>
<h5 class="font-20 mt-15 mb-1"><?php echo str_replace('_',' ','Service_type'); ?></h5>
<!--Data display of service_type with id--> 
<?php
	$c = $service_type;
?> 
<table class="table table-striped table-bordered">         
		<tr><td>Service Name</td><td><?php echo $c['service_name']; ?></td></tr>

<tr><td>Created At</td><td><?php echo $c['created_at']; ?></td></tr>

<tr><td>Updated At</td><td><?php echo $c['updated_at']; ?></td></tr>


</table>
<!--End of Data display of service_type with id//--> 