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
				<div class="login100-pic js-tilt" data-tilt>
					<img src="<?php echo base_url(); ?>public/login-register/images/img-01.png" alt="IMG">
				</div>
                
                
                
                

									<div class="col-md-6">
										<!-- Logo -->
										<div class="card-body-login mb-30">
                                            <?php
                                            $this->CI = & get_instance();
                                            $this->CI->load->database();
                                            $this->CI->load->model('Company_model');
                                            $dataArr = $this->CI->Company_model->get_all_company();
                                            $file_company_logo = $dataArr[0]['file_company_logo'];
                                            if (is_file(APPPATH . '../public/' . $file_company_logo) && file_exists(APPPATH . '../public/' . $file_company_logo)) {
                                                ?>
												 <img
												src="<?php echo base_url(); ?>public/<?=$file_company_logo?>"
												alt="">
											<?php
                                            } else {
                                                ?>
												 <img src="<?php echo base_url(); ?>public/uploads/logo.png"
												alt="">
											<?php
                                            }
                                            ?>
                                        </div>
                                         <?=$msg?>
                                        <h4 class="font-22 mb-30">Sign
											In</h4>

                                         <?php echo form_open_multipart('member/login/login_process',array("class"=>"form-horizontal")); ?>
   
                                            <div class="form-group">
											<label class="float-left" for="emailaddress">Email address</label>
											<input class="form-control" type="email" name="email"
												id="email"
												value="<?php echo ($this->input->post('email') ? $this->input->post('email') : ''); ?>"
												required="" placeholder="Enter your email">
										</div>

										<div class="form-group">
											<a
												href="<?php echo site_url(); ?>/member/login/forget_password"
												class="text-dark float-right"><span
												class="font-12 text-primary">Forgot your password?</span></a>
											<label class="float-left" for="password">Password</label> <input
												class="form-control" type="password" name="password"
												id="password"
												value="<?php echo ($this->input->post('password') ? $this->input->post('password') : ''); ?>"
												required="" placeholder="Enter your password">
										</div>

										<div class="form-group mb-3">
											<div class="custom-control custom-checkbox pl-0">
												<div class="custom-control custom-checkbox">
													<input type="checkbox" class="custom-control-input"
														id="customCheck1"> <label class="custom-control-label"
														for="customCheck1"><span class="font-16">Remember me</span></label>
												</div>
											</div>
										</div>

										<div class="form-group mb-0 text-center">
											<button class="btn btn-primary btn-block" type="submit">Log
												In</button>
										</div>

                                        <?php echo form_close(); ?>

                                        <a
											href="<?php echo site_url(); ?>/member/login/register"
											class="text-dark float-right"><span
											class="font-12 text-primary">Create a new account </span></a>
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
									