<!--Left Menu-->
<nav>
    <ul class="sidebar-menu" data-widget="tree">
        <li class="sidemenu-user-profile d-flex align-items-center">
            <div class="user-thumbnail">
                <?php
				  if(is_file(APPPATH.'../public/'.$this->session->userdata['file_picture'])&&file_exists(APPPATH.'../public/'.$this->session->userdata['file_picture']))
				   {
				 ?>
					  <img  src="<?php echo base_url().'public/'.$this->session->userdata['file_picture']?>" alt="">
				<?php
					}
					else
					{
				?>
					  <img class="border-radius-50" src="<?php echo base_url()?>public/uploads/no_image.jpg">
				<?php		
					}
				  ?>
            </div>
            <div class="user-content">
                <h6><?php echo $this->session->userdata['first_name']?> <?php echo $this->session->userdata['last_name']?></h6>
                <!--<span>Pro User</span>-->
            </div>
        </li>
        <li <?php if($this->router->fetch_class()=="homecontroller"){?>
					class="active" <?php }?>><a href="<?php echo site_url('admin/homecontroller'); ?>"><i class="icon_lifesaver"></i> <span>Dashboard</span></a></li>
        <?php
		     $menu_open =  false; 
		     if($this->router->fetch_class()=="profile" ||
			    $this->router->fetch_class()=="country" ||
				$this->router->fetch_class()=="company" ||
				$this->router->fetch_class()=="users" 
			 )
			 {
				$menu_open =  true; 
			 }
		?>
        <li class="treeview <?php if($menu_open==true){?>menu-open<?php }?>">
            <a href="javascript:void(0)"><i class="icon_document_alt"></i> <span>Settings</span> <i class="fa fa-angle-right"></i></a>
            <ul class="treeview-menu" <?php if($menu_open==true){?>style="display: block;"<?php }?>>
                <li <?php if($this->router->fetch_class()=="profile"){?>class="active"<?php }?>><a href="<?php echo site_url('admin/profile/index'); ?>">- Profile</a></li>
                <li <?php if($this->router->fetch_class()=="country"){?>class="active"<?php }?>><a href="<?php echo site_url('admin/country/index'); ?>">- Country</a></li>
                <li <?php if($this->router->fetch_class()=="company"){?>class="active"<?php }?>><a href="<?php echo site_url('admin/company/index'); ?>">- Company</a></li>
                <li <?php if($this->router->fetch_class()=="users"){?>class="active"<?php }?>><a href="<?php echo site_url('admin/users/index'); ?>">- Users</a></li>
            </ul>
        </li> 
        <li <?php if($this->router->fetch_class()=="data_key"){?>class="active"<?php }?>><a href="<?php echo site_url('admin/data_key/index'); ?>"><i class="icon_table"></i>Data Key</a></li>
<li <?php if($this->router->fetch_class()=="service_type"){?>class="active"<?php }?>><a href="<?php echo site_url('admin/service_type/index'); ?>"><i class="icon_table"></i>Service Type</a></li>
<li <?php if($this->router->fetch_class()=="subscription"){?>class="active"<?php }?>><a href="<?php echo site_url('admin/subscription/index'); ?>"><i class="icon_table"></i>Subscription</a></li>
<li <?php if($this->router->fetch_class()=="subscription_history"){?>class="active"<?php }?>><a href="<?php echo site_url('admin/subscription_history/index'); ?>"><i class="icon_table"></i>Subscription History</a></li>

    </ul>
</nav>
<!--End of Left Menu//-->