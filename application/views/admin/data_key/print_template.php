<link rel="stylesheet"
	href="<?php echo base_url(); ?>public/css/custom.css"> 
<h3 class="font-20 mt-15 mb-1"><?php echo str_replace('_',' ','Data_key'); ?></h3>
Date: <?php echo date("Y-m-d");?>
<hr>
<!--*************************************************
*********mpdf header footer page no******************
****************************************************-->
<htmlpageheader name="firstpage" class="hide">
</htmlpageheader>

<htmlpageheader name="otherpages" class="hide">
    <span class="float_left"></span>
    <span  class="padding_5"> &nbsp; &nbsp; &nbsp;
     &nbsp; &nbsp; &nbsp;</span>
    <span class="float_right"></span>         
</htmlpageheader>      
<sethtmlpageheader name="firstpage" value="on" show-this-page="1" />
<sethtmlpageheader name="otherpages" value="on" /> 
   
<htmlpagefooter name="myfooter"  class="hide">                          
     <div align="center">
               <br><span class="padding_10">Page {PAGENO} of {nbpg}</span> 
     </div>
</htmlpagefooter>    

<sethtmlpagefooter name="myfooter" value="on" />
<!--*************************************************
*********#////mpdf header footer page no******************
****************************************************-->
<!--Data display of data_key-->    
<table   cellspacing="3" cellpadding="3" class="table" align="center">
    <tr>
		<th>Service Type</th>
<th>Service Email</th>
<th>Service Password</th>
<th>Used</th>
<th>Used By Users</th>
<th>Used By Activation Key</th>

    </tr>
	<?php foreach($data_key as $c){ ?>
    <tr>
		<td><?php
									   $this->CI =& get_instance();
									   $this->CI->load->database();	
									   $this->CI->load->model('Service_type_model');
									   $dataArr = $this->CI->Service_type_model->get_service_type($c['service_type_id']);
									   echo $dataArr['service_name'];?>
									</td>
<td><?php echo $c['service_email']; ?></td>
<td><?php echo $c['service_password']; ?></td>
<td><?php echo $c['used']; ?></td>
<td><?php
									   $this->CI =& get_instance();
									   $this->CI->load->database();	
									   $this->CI->load->model('Users_model');
									   $dataArr = $this->CI->Users_model->get_users($c['used_by_users_id']);
									   echo $dataArr['email'];?>
									</td>
<td><?php echo $c['used_by_activation_key']; ?></td>

    </tr>
	<?php } ?>
</table>
<!--End of Data display of data_key//--> 