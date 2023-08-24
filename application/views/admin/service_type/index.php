<h5 class="font-20 mt-15 mb-1"><?php echo str_replace('_',' ','Service_type'); ?></h5>
<?php
  	echo $this->session->flashdata('msg');
?>
<!--Action-->
<div>
	<div class="float_left padding_10">
		<a href="<?php echo site_url('admin/service_type/save'); ?>"
			class="btn btn-success">Add</a>
	</div>
	<div class="float_left padding_10">
		<i class="fa fa-download"></i> Export <select name="xeport_type" class="select"
			onChange="window.location='<?php echo site_url('admin/service_type/export'); ?>/'+this.value">
			<option>Select..</option>
			<option>Pdf</option>
			<option>CSV</option>
		</select>
	</div>
	<div  class="float_right padding_10">
		<ul   style="list-style-type: none;"  class="left-side-navbar d-flex align-items-center">
			<li class="hide-phone app-search mr-15">
                <?php echo form_open_multipart('admin/service_type/search/',array("class"=>"form-horizontal")); ?>
                    <!--<input name="key" type="text"
				value="<?php echo isset($key)?$key:'';?>" placeholder="Search..."
				class="form-control">
				<button type="submit" class="mr-0">
					<i class="fa fa-search"></i>
				</button>-->
                <div class="input-group">
                    <input name="key" type="text"
				value="<?php echo isset($key)?$key:'';?>" placeholder="Search..."
				class="form-control">
                    <div class="input-group-append">
                      <button type="submit" class="btn btn-secondary">
                        <i class="fa fa-search"></i>
                      </button>
                    </div>
                  </div>
                <?php echo form_close(); ?>
            </li>
		</ul>
	</div>
</div>
<!--End of Action//--> 
   
<!--Data display of service_type-->     
<div style="overflow-x:auto;width:100%;">      
<table class="table table-striped table-bordered">
    <tr>
		<th>Service Name</th>

		<th>Actions</th>
    </tr>
	<?php foreach($service_type as $c){ ?>
    <tr>
		<td><?php echo $c['service_name']; ?></td>

		<td>
            <a href="<?php echo site_url('admin/service_type/details/'.$c['id']); ?>"  class="action-icon"> <i class="fa fa-eye"></i></a>
            <a href="<?php echo site_url('admin/service_type/save/'.$c['id']); ?>" class="action-icon"> <i class="fa fa-edit"></i></a>
            <a href="<?php echo site_url('admin/service_type/remove/'.$c['id']); ?>" onClick="return confirm('Are you sure to delete this item?');" class="action-icon"> <i class="fa fa-trash"></i></a>
        </td>
    </tr>
	<?php } ?>
</table>
</div>
<!--End of Data display of service_type//--> 

<!--No data-->
<?php
	if(count($service_type)==0){
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
