<a  href="<?php echo site_url('admin/data_key/index'); ?>" class="btn btn-info"><i class="arrow_left"></i> List</a>
<h5 class="font-20 mt-15 mb-1"><?php if($id<0){echo "Save";}else { echo "Update";} echo " "; echo str_replace('_',' ','Data_key'); ?></h5>
<!--Form to save data-->
<?php echo form_open_multipart('admin/data_key/save/'.$data_key['id'],array("class"=>"form-horizontal")); ?>
<div class="card">
   <div class="card-body">    
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
            <option value="<?=$dataArr[$i]['id']?>" <?php if($data_key['service_type_id']==$dataArr[$i]['id']){ echo "selected";} ?>><?=$dataArr[$i]['service_name']?></option> 
            <?php 
             } 
            ?> 
          </select> 
         </div> 
           </div>
<div class="form-group"> 
          <label for="Service Email" class="col-md-4 control-label">Service Email</label> 
          <div class="col-md-8"> 
           <input type="text" name="service_email" value="<?php echo ($this->input->post('service_email') ? $this->input->post('service_email') : $data_key['service_email']); ?>" class="form-control" id="service_email" /> 
          </div> 
           </div>
<div class="form-group"> 
          <label for="Service Password" class="col-md-4 control-label">Service Password</label> 
          <div class="col-md-8"> 
           <input type="text" name="service_password" value="<?php echo ($this->input->post('service_password') ? $this->input->post('service_password') : $data_key['service_password']); ?>" class="form-control" id="service_password" /> 
          </div> 
           </div>
<div class="form-group"> 
                                        <label for="Used" class="col-md-4 control-label">Used</label> 
          <div class="col-md-8"> 
           <?php 
             $enumArr = $this->customlib->getEnumFieldValues('data_key','used'); 
           ?> 
           <select name="used"  id="used"  class="form-control"/> 
             <option value="">--Select--</option> 
             <?php 
              for($i=0;$i<count($enumArr);$i++) 
              { 
             ?> 
             <option value="<?=$enumArr[$i]?>" <?php if($data_key['used']==$enumArr[$i]){ echo "selected";} ?>><?=ucwords($enumArr[$i])?></option> 
             <?php 
              } 
             ?> 
           </select> 
          </div> 
            </div>
<div class="form-group"> 
                                    <label for="Used By Users" class="col-md-4 control-label">Used By Users</label> 
         <div class="col-md-8"> 
          <?php 
             $this->CI =& get_instance(); 
             $this->CI->load->database();  
             $this->CI->load->model('Users_model'); 
             $dataArr = $this->CI->Users_model->get_all_users(); 
          ?> 
          <select name="used_by_users_id"  id="used_by_users_id"  class="form-control"/> 
            <option value="">--Select--</option> 
            <?php 
             for($i=0;$i<count($dataArr);$i++) 
             {  
            ?> 
            <option value="<?=$dataArr[$i]['id']?>" <?php if($data_key['used_by_users_id']==$dataArr[$i]['id']){ echo "selected";} ?>><?=$dataArr[$i]['email']?></option> 
            <?php 
             } 
            ?> 
          </select> 
         </div> 
           </div>
<div class="form-group"> 
          <label for="Used By Activation Key" class="col-md-4 control-label">Used By Activation Key</label> 
          <div class="col-md-8"> 
           <input type="text" name="used_by_activation_key" value="<?php echo ($this->input->post('used_by_activation_key') ? $this->input->post('used_by_activation_key') : $data_key['used_by_activation_key']); ?>" class="form-control" id="used_by_activation_key" /> 
          </div> 
           </div>

   </div>
</div>
<div class="form-group">
    <div class="col-sm-offset-4 col-sm-8">
        <button type="submit" class="btn btn-success"><?php if(empty($data_key['id'])){?>Save<?php }else{?>Update<?php } ?></button>
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