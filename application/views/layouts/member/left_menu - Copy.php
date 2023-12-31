<!--Left Menu-->
<nav>
	<ul class="sidebar-menu" data-widget="tree">
		<li class="sidemenu-user-profile d-flex align-items-center">
			<div class="user-thumbnail">
                <?php
                if (is_file(APPPATH . '../public/' . $this->session->userdata['file_picture']) && file_exists(APPPATH . '../public/' . $this->session->userdata['file_picture'])) {
                    ?>
					  <img
					src="<?php echo base_url().'public/'.$this->session->userdata['file_picture']?>"
					alt="">
				<?php
                } else {
                    ?>
					  <img class="border-radius-50"
					src="<?php echo base_url()?>public/uploads/no_image.jpg">
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
			class="active" <?php }?>><a
			href="<?php echo site_url('member/homecontroller'); ?>"><i
				class="icon_lifesaver"></i> <span>Dashboard</span></a></li>
        <?php
        $menu_open = false;
        if ($this->router->fetch_class() == "profile") {
            $menu_open = true;
        }
        ?>
        <li
			class="treeview <?php if($menu_open==true){?>menu-open<?php }?>"><a
			href="javascript:void(0)"><i class="icon_document_alt"></i> <span>Settings</span>
				<i class="fa fa-angle-right"></i></a>
			<ul class="treeview-menu" <?php if($menu_open==true){?>
				style="display: block;" <?php }?>>
				<li <?php if($this->router->fetch_class()=="profile"){?>
					class="active" <?php }?>><a
					href="<?php echo site_url('member/profile/index'); ?>">- Profile</a></li>
			</ul></li>
		<li <?php if($this->router->fetch_class()=="subscriber"){?>
			class="active" <?php }?>><a
			href="<?php echo site_url('member/subscription/index'); ?>"><i
				class="icon_table"></i>Subscription</a></li>

	</ul>
</nav>
<!--End of Left Menu//-->