	</head>
	<body class="no-skin">
		<div id="navbar" class="navbar navbar-default ace-save-state">
			<div class="navbar-container ace-save-state" id="navbar-container">
				<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
					<span class="sr-only">Toggle sidebar</span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>
				</button>

				<div class="navbar-header pull-left">
					<a class="navbar-brand">
						<small>
							<img src="<?= base_url(); ?>assets/images/logo.png" width="24" height="25">
							PEMERINTAH KOTA PARIAMAN
						</small>
					</a>
				</div>

				<div class="navbar-buttons navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">

						<li class="light-blue dropdown-modal">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<img class="nav-user-photo" src="<?php echo base_url(); ?>assets/images/user.png" alt="Jason's Photo" />
								<span class="user-info">
									<small>Selamat Datang,</small>
									<?php echo $user['username']; ?>
								</span>

								<i class="ace-icon fa fa-caret-down"></i>
							</a>

							<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">

								<!-- profil -->
								<li>
									<a href="<?php echo site_url('log_in/logout'); ?>">
										<i class="ace-icon fa fa-sign-out"></i>
										Logout
									</a>
								</li>

							</ul>
						</li>
					</ul>
				</div>
			</div><!-- /.navbar-container -->
		</div>