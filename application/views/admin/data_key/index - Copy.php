<h5 class="font-20 mt-15 mb-1"><?php echo str_replace('_',' ','Data_key'); ?></h5>
<?php
  	echo $this->session->flashdata('msg');
?>


<div class="row">
<div class="col-lg-6">
    <div class="card">
        <div class="card-header">Import</div>
        <div class="card-body">
            <div class="card-title">
                <h3 class="text-center title-2">CSV,XLS,XLSX</h3>
                 <a href="<?php echo base_url(); ?>public/data_key_20230729.csv">Download Sample</a>
            </div>
    
			<?php echo form_open_multipart('admin/data_key/import_excell/',array("class"=>"form-horizontal")); ?>
               
              
              <div class="form-group">
                <label for="import" class="col-md-4 control-label">Import (CSV,XLS,XLSX) Size:<?=ini_get("upload_max_filesize")?></label>
                <div class="col-md-8">
                    <input type="file" name="file" class="form-control" id="file" />
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-4 col-sm-8">
                    <button type="submit" class="btn btn-info">Import Excell</button>
                </div>
            </div>
           
          </div>  
       </div>
    </div>
</div>


<!--Action-->
<div>
	<div class="float_left padding_10">
		<a href="<?php echo site_url('admin/data_key/save'); ?>"
			class="btn btn-success">Add</a>
	</div>
	<div class="float_left padding_10">
		<i class="fa fa-download"></i> Export <select name="xeport_type" class="select"
			onChange="window.location='<?php echo site_url('admin/data_key/export'); ?>/'+this.value">
			<option>Select..</option>
			<option>Pdf</option>
			<option>CSV</option>
		</select>
	</div>
	<div  class="float_right padding_10">
		<ul class="left-side-navbar d-flex align-items-center">
			<li class="hide-phone app-search mr-15">
                <?php echo form_open_multipart('admin/data_key/search/',array("class"=>"form-horizontal")); ?>
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
</div>
<!--End of Action//--> 
   
<!--Data display of data_key-->     
<div style="overflow-x:auto;width:100%;">      
<table class="table table-striped table-bordered">
    <tr>
		<th>Service Type</th>
<th>Activation Key</th>
<th>Status</th>

		<th>Actions</th>
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
<td><?php echo $c['activation_key']; ?></td>
<td><?php echo $c['status']; ?></td>

		<td>
            <a href="<?php echo site_url('admin/data_key/details/'.$c['id']); ?>"  class="action-icon"> <i class="zmdi zmdi-eye"></i></a>
            <a href="<?php echo site_url('admin/data_key/save/'.$c['id']); ?>" class="action-icon"> <i class="zmdi zmdi-edit"></i></a>
            <a href="<?php echo site_url('admin/data_key/remove/'.$c['id']); ?>" onClick="return confirm('Are you sure to delete this item?');" class="action-icon"> <i class="zmdi zmdi-delete"></i></a>
        </td>
    </tr>
	<?php } ?>
</table>
</div>
<!--End of Data display of data_key//--> 

<!--No data-->
<?php
	if(count($data_key)==0){
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
