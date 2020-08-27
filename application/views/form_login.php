<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<link rel="icon" type="image/png" href="<?php echo base_url(); ?>assets/images/icon.png">

		<title>Login</title>

		<meta name="description" content="User login page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/font-awesome/4.5.0/css/font-awesome.min.css" />

		<!-- text fonts -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/fonts.googleapis.com.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/ace.min.css" />
		
		<style type="text/css">
			.my-container {
		    position: relative;
		    overflow: hidden;
			}

			.my-container:before {
		    content: ' ';
		    display: block;
		    position: absolute;
		    left: 0;
		    top: 0;
		    width: 100%;
		    height: 120%;
		    z-index: 1;
		    opacity: 0.4;
		    background-image: url("<?= base_url(); ?>assets/images/cianjur.jpg");
		    background-repeat: no-repeat;
		    background-position: 50% 0;
		    -ms-background-size: cover;
		    -o-background-size: cover;
		    -moz-background-size: cover;
		    -webkit-background-size: cover;
		    background-size: cover;
			}
			
			.my-container .main-container {
		    text-align: center;
		    z-index: 2;
		    position: relative;
		    color: #fff;
			} 

			.b {font-weight: bold}
		</style>
	</head>

	<body class="login-layout my-container" onload="document.login.username.focus()">
		<div class="main-container">
			<div class="main-content">
				<div class="row">
					<div class="col-sm-10 col-sm-offset-1">
						<div class="login-container">

							<div class="center">
								<h3>
									<img src="<?php echo base_url(); ?>assets/images/logo.png" width="70" height="75">
									<br/>

									<span class="white">
										Sistem Informasi <br/>
									 	Inspektorat Kota Pariaman
									</span>
								</h3>

								<h4>
									<span class="red b" id="id-text2">PEMERINTAH KOTA PARIAMAN</span>
								</h4>
							</div>

							<div class="space-6"></div>

							<div class="position-relative">
								<!-- login box -->
								<div id="login-box" class="login-box visible widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header blue lighter bigger">
												<i class="ace-icon fa fa-key"></i>
												LOGIN
											</h4>

											<div class="space-6"></div>

											<p class="login-box-msg"><?php echo $not_level; ?> </p>
											<p class="login-box-msg"><?php echo $wrong; ?> </p>
              				<p class="login-box-msg"><?php echo $empty; ?> </p>

											<form name="login" action="<?php echo site_url('log_in/cek_login'); ?>" method="post">
												<fieldset>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" name="username" class="form-control" placeholder="Username" />
															<i class="ace-icon fa fa-user"></i>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" name="password" class="form-control" placeholder="Password" />
															<i class="ace-icon fa fa-lock"></i>
														</span>
													</label>

													<div class="space"></div>

													<div class="clearfix">
														<input type="submit" value="Masuk" class="width-35 pull-right btn btn-sm btn-success" ></input>
													</div>

													<div class="space-4"></div>
												</fieldset>
											</form>

										</div><!-- /.widget-main -->

										<div class="toolbar clearfix">
											<div>
												<a href="<?= site_url('publik'); ?>" class="user-signup-link">
													<i class="ace-icon fa fa-arrow-left"></i>
													Kembali ke Beranda
												</a>
												&nbsp;
											</div>
										</div>

									</div><!-- /.widget-body -->
								</div><!-- /.login-box -->

								<!-- forget box -->
								<!-- <div id="forgot-box" class="forgot-box widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header red lighter bigger">
												<i class="ace-icon fa fa-key"></i>
												Pemulihan Password
											</h4>

											<div class="space-6"></div>
											<p>
												Hubungi Administrator di bawah ini!
											</p>

											<form>
												<fieldset>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="email" class="form-control" value="LOKET #" readonly="" />
															<i class="ace-icon fa fa-phone"></i>
														</span>
													</label>
												</fieldset>
											</form>
										</div> --><!-- /.widget-main -->

										<!-- <div class="toolbar center">
											<a href="#" data-target="#login-box" class="back-to-login-link">
												Login
												<i class="ace-icon fa fa-arrow-right"></i>
											</a>
										</div> -->
									<!-- </div> --><!-- /.widget-body -->
								<!--</div> /.forgot-box -->
							<!--</div><!-- /.position-relative -->

							<div class="center">
								<h1 class="blue" id="id-company-text">
									<img src="<?php echo base_url(); ?>assets/images/logo-jago2.png" width="120" height="75">
								</h1>
							</div>

						</div>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.main-content -->
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script src="<?php echo base_url(); ?>assets/js/jquery-2.1.4.min.js"></script>

		<!-- <![endif]-->

		<!--[if IE]>
		<script src="assets/js/jquery-1.11.3.min.js"></script>
		<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo base_url(); ?>assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
			 $(document).on('click', '.toolbar a[data-target]', function(e) {
				e.preventDefault();
				var target = $(this).data('target');
				$('.widget-box.visible').removeClass('visible');//hide others
				$(target).addClass('visible');//show target
			 });
			});

		</script>
	</body>
</html>
