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
            
            
            
						
									
									  <?php echo form_open_multipart('member/login/register_process',array("class"=>"form-horizontal")); ?>
										<div class="row">
                                           
                                           <div class="form-group col-lg-12">
                                                <h4 class="font-24 mt-0">Free Sign Up</h4>
                                                <p class="text-muted mb-4">Create a new account</p>
										    </div>
                                        <?=$msg?>
                                           
                                            <div class="form-group col-lg-12">
											<label for="fullname">First Name</label> <input
												class="form-control" type="text" name="first_name"
												id="first_name"
												value="<?php echo ($this->input->post('first_name') ? $this->input->post('first_name') : ''); ?>"
												placeholder="Enter first name"  required>
										</div>

										<div class="form-group col-lg-12">
											<label for="fullname">Full Name</label> <input
												class="form-control" type="text" name="last_name"
												id="last_name"
												value="<?php echo ($this->input->post('last_name') ? $this->input->post('last_name') : ''); ?>"
												placeholder="Enter last name" required>
										</div>

										<div class="form-group col-lg-12">
											<label for="emailaddress">Email address</label> <input
												class="form-control" type="email" name="email" id="email"
												value="<?php echo ($this->input->post('email') ? $this->input->post('email') : ''); ?>"
												required placeholder="Enter your email">
										</div>

										<div class="form-group col-lg-12">
											<label for="emailaddress">Phone no</label> <input
												class="form-control" type="phone_no" name="phone_no"
												id="phone_no"
												value="<?php echo ($this->input->post('phone_no') ? $this->input->post('phone_no') : ''); ?>"
												required placeholder="Enter your phone no">
										</div>

										<div class="form-group col-lg-12">
											<label for="password">Password</label> <input
												class="form-control" type="password" name="password"
												id="password"
												value="<?php echo ($this->input->post('password') ? $this->input->post('password') : ''); ?>"
												required placeholder="Enter your password">
										</div>

										<div class="form-group col-lg-12">
											<label for="password">Retype Password</label> <input
												class="form-control" type="password" name="re_password"
												id="re_password" value="" required
												placeholder="Enter your password" onBlur="checkPassword()">
										</div>

										<div class="form-group col-lg-12">
											<div class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input"
													id="customCheck1"> <label class="custom-control-label"
													for="customCheck1"><span class="font-16">I accept <a
														href="" class="text-muted">Terms and Conditions</a></span></label>
											</div>
										</div>

										<div class="form-group col-lg-12 mb-0 text-center">
											<button class="btn btn-primary btn-block" type="submit">Sign
												Up</button>
										</div>

                                       
                                        <div class="form-group col-lg-12">
                                        <a
											href="<?php echo site_url(); ?>/member/login/index"
											class="text-dark float-right"><span
											class="font-12 text-primary">Back </span></a>
                                       </div>    
                                     
									 
									</div>
								
                        <?php echo form_close(); ?>
                                     
                                       
                                       
                        
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
									                        
					
<script language="javascript">
	  function checkPassword(){
		  password = $("#password").val();
		  re_password = $("#re_password").val();  
		  if(password!=re_password){
			  alert("Password has been mismatched");
			  $("#re_password").focus();
		  }
		  
	  }
	</script>