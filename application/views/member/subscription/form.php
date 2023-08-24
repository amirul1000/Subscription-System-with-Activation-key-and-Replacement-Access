<a  href="<?php echo site_url('admin/subscription/index'); ?>" class="btn btn-info"><i class="arrow_left"></i> List</a>
<h5 class="font-20 mt-15 mb-1"><?php if($id<0){echo "Save";}else { echo "Update";} echo " "; echo str_replace('_',' ','Subscription'); ?></h5>
<!--Form to save data-->
<?php echo form_open_multipart('admin/subscription/save/'.$subscription['id'],array("class"=>"form-horizontal")); ?>
<div class="card">
   <div class="card-body">    
        <div class="form-group"> 
                                    <label for="Users" class="col-md-4 control-label">Users</label> 
         <div class="col-md-8"> 
          <?php 
             $this->CI =& get_instance(); 
             $this->CI->load->database();  
             $this->CI->load->model('Users_model'); 
             $dataArr = $this->CI->Users_model->get_all_users(); 
          ?> 
          <select name="users_id"  id="users_id"  class="form-control"/> 
            <option value="">--Select--</option> 
            <?php 
             for($i=0;$i<count($dataArr);$i++) 
             {  
            ?> 
            <option value="<?=$dataArr[$i]['id']?>" <?php if($subscription['users_id']==$dataArr[$i]['id']){ echo "selected";} ?>><?=$dataArr[$i]['email']?></option> 
            <?php 
             } 
            ?> 
          </select> 
         </div> 
           </div>
<div class="form-group"> 
                                    <label for="Service Type" class="col-md-4 control-label">Service Type</label> 
         <div class="col-md-8"> 
          <?php 
             $this->CI =& get_instance(); 
             $this->CI->load->database();  
             $this->CI->load->model('Service_type_model'); 
             $dataArr = $this->CI->Service_type_model->get_all_service_type(); 
          ?> 
          <select name="service_type_id"  id="service_type_id"  class="form-control"/> 
            <option value="">--Select--</option> 
            <?php 
             for($i=0;$i<count($dataArr);$i++) 
             {  
            ?> 
            <option value="<?=$dataArr[$i]['id']?>" <?php if($subscription['service_type_id']==$dataArr[$i]['id']){ echo "selected";} ?>><?=$dataArr[$i]['service_name']?></option> 
            <?php 
             } 
            ?> 
          </select> 
         </div> 
           </div>
<div class="form-group"> 
          <label for="Activation Key" class="col-md-4 control-label">Activation Key</label> 
          <div class="col-md-8"> 
           <input type="text" name="activation_key" value="<?php echo ($this->input->post('activation_key') ? $this->input->post('activation_key') : $subscription['activation_key']); ?>" class="form-control" id="activation_key" /> 
          </div> 
           </div>
<div class="form-group"> 
          <label for="Limit Count" class="col-md-4 control-label">Limit Count</label> 
          <div class="col-md-8"> 
           <input type="text" name="limit_count" value="<?php echo ($this->input->post('limit_count') ? $this->input->post('limit_count') : $subscription['limit_count']); ?>" class="form-control" id="limit_count" /> 
          </div> 
           </div>
<div class="form-group"> 
          <label for="Used Count" class="col-md-4 control-label">Used Count</label> 
          <div class="col-md-8"> 
           <input type="text" name="used_count" value="<?php echo ($this->input->post('used_count') ? $this->input->post('used_count') : $subscription['used_count']); ?>" class="form-control" id="used_count" /> 
          </div> 
           </div>
<div class="form-group"> 
                                       <label for="Expiration Date Time" class="col-md-4 control-label">Expiration Date Time</label> 
          <div class="col-md-8"> 
           <input type="text" name="expiration_date_time"  id="expiration_date_time"  value="<?php echo ($this->input->post('expiration_date_time') ? $this->input->post('expiration_date_time') : $subscription['expiration_date_time']); ?>" class="form-control-static datepicker"/> 
          </div> 
           </div>

   </div>
</div>
<div class="form-group">
    <div class="col-sm-offset-4 col-sm-8">
        <button type="submit" class="btn btn-success"><?php if(empty($subscription['id'])){?>Save<?php }else{?>Update<?php } ?></button>
    </div>
</div>
<?php echo form_close(); ?>
<!--End of Form to save data//-->	
<!--JQuery-->
<script>
	$( ".datepicker" ).datepicker({
		dateFormat: "yy-mm-dd", 
		changeYear: true,
		changeMonth: true,
		showOn: 'button',
		buttonText: 'Show Date',
		buttonImageOnly: true,
		buttonImage: '<?php echo base_url(); ?>public/datepicker/images/calendar.gif',
	});
</script>  			