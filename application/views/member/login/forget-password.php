<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V1</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="<?php echo base_url(); ?>public/login-register/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/login-register/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/login-register/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/login-register/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/login-register/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/login-register/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/login-register/css/util.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/login-register/css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<!--<div class="login100-pic js-tilt" data-tilt>
					<img src="<?php echo base_url(); ?>public/login-register/images/img-01.png" alt="IMG">
				</div>-->
                
                
						<div class="card">
							<div class="card-body">
								<h4 class="font-22">Reset Your Password</h4>
								<p>Enter your email address and your password will be reset and
									emailed to you.</p>
                                <?=$msg?>
                                <!-- Form -->
                                <?php echo form_open_multipart('member/login/forget_password_process',array("class"=>"form-horizontal")); ?>
                                    <div class="form-group">
									<input type="email" name="email" id="email"
										value="<?php echo ($this->input->post('email') ? $this->input->post('email') : ''); ?>"
										class="form-control password" placeholder="Email address"
										required="">
								</div>
								<div class="btn-area">
									<button type="submit"
										class="btn btn-rounded btn-primary py-2 px-4 btn-block mt-15">Send
										new password</button>
								</div>
                                <?php echo form_close(); ?>
                                <a
									href="<?php echo site_url(); ?>/member/login/index"
									class="text-dark float-right"><span
									class="font-12 text-primary">Back </span></a>
							</div>
						</div>
                        
                        
                        
		  </div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
	<script src="<?php echo base_url(); ?>public/login-register/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url(); ?>public/login-register/vendor/bootstrap/js/popper.js"></script>
	<script src="<?php echo base_url(); ?>public/login-register/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url(); ?>public/login-register/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url(); ?>public/login-register/vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="<?php echo base_url(); ?>public/login-register/js/main.js"></script>

</body>
</html>                     
												