	</head>
	<body class="no-skin">
		<div id="navbar" class="navbar navbar-default navbar-collapse h-navbar ace-save-state">
			<div class="navbar-container ace-save-state" id="navbar-container">

				<div class="navbar-header pull-left">
					<a class="navbar-brand">
						<small>
							<img src="<?php echo base_url(); ?>assets/images/logo.png" width="24" height="25">
							PEMERINTAH KOTA PARIAMAN
						</small>
					</a>

					<button class="pull-right navbar-toggle navbar-toggle-img collapsed" type="button" data-toggle="collapse" data-target=".navbar-buttons,.navbar-menu">
						<span class="sr-only">Toggle user menu</span>

						<img src="assets/images/avatars/user.jpg" alt="Jason's Photo" />
					</button>

					<button class="pull-right navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#sidebar">
						<span class="sr-only">Toggle sidebar</span>

						<span class="icon-bar"></span>

						<span class="icon-bar"></span>

						<span class="icon-bar"></span>
					</button>
				</div>

				<div class="navbar-buttons navbar-header pull-right  collapse navbar-collapse" role="navigation">
					<ul class="nav ace-nav">
						<li class="light-blue dropdown-modal user-min">
							<a href="<?= site_url('log_in'); ?>" title="Login">
								<img class="nav-user-photo" src="<?=base_url()?>assets/images/icon-login.png" alt="Login" />
								&nbsp;Login&nbsp;
							</a>
						</li>
					</ul>
				</div>

				<nav role="navigation" class="navbar-menu pull-left collapse navbar-collapse">

				</nav>
			</div><!-- /.navbar-container -->
		</div>