<div class="row">
    <?php
    $this->CI = & get_instance();
    $this->CI->load->database();
    $this->CI->load->model('Subscription_model');
    $total = $this->CI->Subscription_model->get_count_users_subscription();
    ?> 
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Subscription <a
							href="<?php echo site_url('member/subscription/index'); ?>">View</a></div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$total?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
	
</div>



<div class="row">
<div class="col-lg-6">
    <div class="card">
        <div class="card-header">Activate</div>
        <div class="card-body">
            <div class="card-title">
                <h3 class="text-center title-2">Enter Activation Key</h3>
            </div>
			<?php //echo form_open_multipart('member/homecontroller/replace_key/',array("class"=>"form-horizontal")); ?>
              <div class="form-group"> 
              	<div id="spinner" style="width:100px;"></div>
              </div>
              
              <!--<div class="form-group"> 
                 <label for="Service Type" class="col-md-4 control-label">Activation Key</label> 
                 <div class="col-md-8"> 
                  
                  <input name="activation_key"  id="activation_key"  class="form-control" required/> 
                 </div> 
          	  </div>-->
              
              <div class="form-group"> 
                                    <label for="Service Type" class="col-md-4 control-label">Activation Key</label> 
         <div class="col-md-8"> 
          <?php 
            /* $this->CI =& get_instance(); 
             $this->CI->load->database();  
             $this->CI->load->model('Subscription_model'); 
             $dataArr = $this->CI->Subscription_model->get_all_users_subscription(); */
          ?> 
          <input type="text" name="activation_key"  id="activation_key"  class="form-control"/> 
           
         </div> 
           </div>
              
              
              
              <!--<div class="form-group"> 
                  Email : <span id="service_email_id"></span> <br>
                  Password : <span id="service_password_id"></span> <br>
              </div>-->
              
             <!-- <div class="form-group"> 
                 <label for="Service Type" class="col-md-4 control-label">Service Type</label> 
                 <div class="col-md-8"> 
                   
                  <?php 
                     $this->CI =& get_instance(); 
                     $this->CI->load->database();  
                     $this->CI->load->model('Service_type_model'); 
                     $dataArr = $this->CI->Service_type_model->get_all_service_type(); 
                  ?> 
                  <select name="service_type_id"  id="service_type_id" class="form-control" required/> 
                    <option value="">--Select--</option> 
                    <?php 
                     for($i=0;$i<count($dataArr);$i++) 
                     {  
                    ?> 
                    <option value="<?=$dataArr[$i]['id']?>"><?=$dataArr[$i]['service_name']?></option> 
                    <?php 
                     } 
                    ?> 
                  </select> 
                 </div> 
          	  </div>-->
              <!--
               <div class="form-group"> 
                 <label for="Service Type" class="col-md-4 control-label">Activation Key</label> 
                 <div class="col-md-8"> 
                  
                  <select name="activation_key"  id="activation_key"  class="form-control" required/> 
                    
                  </select> 
                 </div> 
          	  </div>
              
              -->
              
              
            <div class="form-group">
                <div class="col-sm-offset-4 col-sm-8">
                    <button type="submit" class="btn btn-info" onClick="activate_key();">Active</button>
                </div>
            </div>
            <?php //echo form_close(); ?>
          </div>  
       </div>
    </div>
</div>


<script language="javascript">
/*function load_activation_key(service_type_id){
	 objselect = document.getElementById("activation_key");
    objselect.options.length = 0;
    $("#spinner").html('<img src="<?php echo base_url(); ?>public/uploads/images/Loading_icon.gif" alt="Wait" />');
		 $.ajax({
				type: "POST", 
				url: '<?php echo site_url('member/homecontroller/load_activation_key')?>',
				data: { 
						'service_type_id':service_type_id
					  },
				success: function (data, text) {
					    var obj = eval(data);  
						
						 objselect.add(new Option('--select--',''), null);
						  for(var i=0;i<obj.length;i++)
						  {
							 text = obj[i].activation_key;
							 objselect.add(new Option(text,obj[i].activation_key), null);
						  }
						$("#spinner").html('');
						
					}
				});
	}*/
	
function activate_key(){
	 service_type_id = '';//$("#service_type_id").val();
	 subscriptionid = '';//$("#subscriptionid").val();
     activation_key = $("#activation_key").val();
    $("#spinner").html('<img src="<?php echo base_url(); ?>public/uploads/images/Loading_icon.gif" alt="Wait" />');
		 $.ajax({
				type: "POST", 
				url: '<?php echo site_url('member/homecontroller/active_key')?>',
				data: { 
						'service_type_id':service_type_id,
						'subscriptionid':subscriptionid,
						'activation_key':activation_key,
					  },
				success: function (data, text) {
					
					console.log(data);  
					    var obj = eval(data);
						$("#spinner").html(''); 
						alert(obj[0]['msg']);
						if(obj[0]['status']=='success'){
							//service_email = obj[0]['access'][0]['service_email'];
							//service_password  = obj[0]['access'][0]['service_password'];
							//$("#service_email_id").html(service_email);
							//$("#service_password_id").html(service_password);
							window.location.href = '<?php echo site_url('member/subscription/index')?>';
						}
						
					},
					error: function(xhr, status, error) {
						  var err = eval("(" + xhr.responseText + ")");
						  alert(err.Message);
						}
				});
	}
	
	
</script>