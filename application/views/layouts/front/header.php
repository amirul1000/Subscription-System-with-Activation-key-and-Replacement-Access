<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>atshop</title>

<!-- Vendor Stylesheets -->
<link rel="stylesheet"
	href="<?php echo base_url(); ?>public/front/assets/css/plugins/bootstrap.min.css">
<link rel="stylesheet"
	href="<?php echo base_url(); ?>public/front/assets/css/plugins/swiper.min.css">
<!-- Icon Fonts -->
<link rel="stylesheet"
	href="<?php echo base_url(); ?>public/front/assets/fonts/flaticon/flaticon.css">
<link rel="stylesheet"
	href="<?php echo base_url(); ?>public/front/assets/fonts/font-awesome/css/all.min.css">

<!-- Vidlife Style sheet -->
<link rel="stylesheet"
	href="<?php echo base_url(); ?>public/front/assets/css/style.css">
<!-- Favicon -->

</head>

<body class="boxed">

	<!-- Main Wrapper Start -->
	<div class="main-wrapper">

		<!-- Nav Start -->
		<div class="nav-wrapper">

			<div class="navbar-menu">
				<ul>
					<li class="login"><a href="<?php echo site_url('/'); ?>"
						title="Home"><i class="las la-share-square"></i> Home </a></li>
					        
                                     
                    <li class="login"><a
						href="<?php echo site_url('member/login'); ?>" title="Login"><i
							class="las la-share-square"></i> Member Login </a></li>

					<li><a href="<?php echo site_url('admin/login'); ?>"
						title="Create an account"><i class="las la-user"></i> Admin Login</a></li>
                   
				</ul>
			</div>

			<div class="navbar-controls"></div>

		</div>
		<!-- Nav End -->