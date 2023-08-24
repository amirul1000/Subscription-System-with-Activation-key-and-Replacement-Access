<h5 class="font-20 mt-15 mb-1"><?php echo str_replace('_',' ','Subscription'); ?></h5>
<?php
  	echo $this->session->flashdata('msg');
?>
<!--Action-->
<!--<div>
	<div class="float_left padding_10">
		<a href="<?php echo site_url('admin/subscription/save'); ?>"
			class="btn btn-success">Add</a>
	</div>
	<div class="float_left padding_10">
		<i class="fa fa-download"></i> Export <select name="xeport_type" class="select"
			onChange="window.location='<?php echo site_url('admin/subscription/export'); ?>/'+this.value">
			<option>Select..</option>
			<option>Pdf</option>
			<option>CSV</option>
		</select>
	</div>
	<div  class="float_right padding_10">
		<ul class="left-side-navbar d-flex align-items-center">
			<li class="hide-phone app-search mr-15">
                <?php echo form_open_multipart('admin/subscription/search/',array("class"=>"form-horizontal")); ?>
                    <input name="key" type="text"
				value="<?php echo isset($key)?$key:'';?>" placeholder="Search..."
				class="form-control">
				<button type="submit" class="mr-0">
					<i class="fa fa-search"></i>
				</button>
                <?php echo form_close(); ?>
            </li>
		</ul>
	</div>
</div>-->
<!--End of Action//--> 
   
<!--Data display of subscription-->  
<div id="spinner"></div>   
<div style="overflow-x:auto;width:100%;">      
<table class="table table-striped table-bordered">
    <tr>
		<th>Users</th>
        <th>Service Type</th>
        <th>Activation Key</th>
        <th>Limit Count</th>
        <th>Used Count</th>
        <th>Expiration Date Time</th>
        <th>Data</th>
    </tr>
	<?php foreach($subscription as $c){ ?>
    <tr>
		<td><?php
		   $this->CI =& get_instance();
		   $this->CI->load->database();	
		   $this->CI->load->model('Users_model');
		   $dataArr = $this->CI->Users_model->get_users($c['users_id']);
		   echo $dataArr['email'];?>
		</td>
        <td><?php
           $this->CI =& get_instance();
           $this->CI->load->database();	
           $this->CI->load->model('Service_type_model');
           $dataArr = $this->CI->Service_type_model->get_service_type($c['service_type_id']);
           echo $dataArr['service_name'];?>
        </td>
        <td><?php echo $c['activation_key']; ?></td>
        <td><?php echo $c['limit_count']; ?></td>
        <td><?php echo $c['used_count']; ?></td>
        <td><?php echo $c['expiration_date_time']; ?></td>
        
        <td>
                 <a href="javascript:void();" onClick="replace(<?=$c['id']?>,<?=$c['service_type_id']?>);" class="btn btn-primary btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-flag"></i>
                                        </span>
                                        <span class="text">Replace</span>
                                    </a>
                 
                  <?php
				        $this->db->order_by('id', 'desc');
						$this->db->where('used_by_users_id', $c['users_id']);
						$this->db->where('used_by_activation_key', $c['activation_key']);
						$data_key = $this->db->get('data_key')->result_array();
						$db_error = $this->db->error();
						if (!empty($db_error['code'])){
							echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
							exit;
						}
				  ?>   
                     
                     <table class="table table-striped table-bordered">
                        <tr>
                            <th>Email</th>
                            <th>Password</th>
                        </tr>
						<?php foreach($data_key as $c){ ?>
                        <tr>
                           
                    <td><?php echo $c['service_email']; ?></td>
                    <td><?php echo $c['service_password']; ?></td>
                    
                        </tr>
					<?php } ?>
                    </table>
                     
        </td>

		<!--<td>
            <a href="<?php echo site_url('admin/subscription/details/'.$c['id']); ?>"  class="action-icon"> <i class="zmdi zmdi-eye"></i></a>
            <a href="<?php echo site_url('admin/subscription/save/'.$c['id']); ?>" class="action-icon"> <i class="zmdi zmdi-edit"></i></a>
            <a href="<?php echo site_url('admin/subscription/remove/'.$c['id']); ?>" onClick="return confirm('Are you sure to delete this item?');" class="action-icon"> <i class="zmdi zmdi-delete"></i></a>
        </td>-->
    </tr>
	<?php } ?>
</table>
</div>
<!--End of Data display of subscription//--> 

<!--No data-->
<?php
	if(count($subscription)==0){
?>
 <div align="center"><h3>Data does not exists</h3></div>
<?php
	}
?>
<!--End of No data//-->

<!--Pagination-->
<?php
	echo $link;
?>
<!--End of Pagination//-->
<script language="javascript">
 function replace(id,service_type_id){
	 if(confirm('Are you sure to replace your key')){
    $("#spinner").html('<img src="<?php echo base_url(); ?>public/uploads/images/Loading_icon.gif" alt="Wait" />');
		 $.ajax({
				type: "POST", 
				url: '<?php echo site_url('member/homecontroller/replace_key')?>',
				data: { 
				        'id':id,
						'service_type_id':service_type_id,
						
					  },
				success: function (data, text) {
					console.log(data);  
					    var obj = eval(data);
						$("#spinner").html(''); 
						alert(obj[0]['msg']);
						if(obj[0]['status']=='success'){
							
							window.location.href = '<?php echo site_url('member/subscription/index')?>';
						}
						
					},
					error: function(xhr, status, error) {
						  var err = eval("(" + xhr.responseText + ")");
						  alert(err.Message);
						}
				});
				
	 }
 }

</script>