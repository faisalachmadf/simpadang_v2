<?php
//--> include data header
$this->load->view('layout/header');
//--> include data top navigasi 
$this->load->view('layout/top_nav_home');
//--> include data sidebar navigasi
$this->load->view('layout/nav_sidebar_home'); 
?>
<div class="main-content">
	<div class="main-content-inner">

		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li class="active">
					<i class="ace-icon fa fa-home home-icon"></i>
					Home
				</li>							
			</ul><!-- /.breadcrumb -->
		</div>

		<div class="page-content">		

			<div class="page-header">
				<h1>
					Home
				</h1>
			</div><!-- /.page-header -->

			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->

					<h5 class="header">									
						Pilih Akses Masuk Sebagai :
					</h5>
					<div class="col-md-12">

						<?php if($ketua_nd) { ?>
						<div class="col-md-3">
							<a href="<?= site_url('home/get/ketua_nd'); ?>">
								<img src="<?= base_url(); ?>assets/images/logo-ketua.png" style="width:250px; height: 250px;">
								<br/>

								<span class="menu-text"><b> Nota Dinas dasar PKPT</b> </span>
							</a>
						</div>
						<?php } ?>


						<?php if($ketua) { ?>
						<div class="col-md-3">
							<a href="<?= site_url('home/get/ketua_tim'); ?>">
								<img src="<?= base_url(); ?>assets/images/logo-ketua.png" style="width:250px; height: 250px;">
								<br/>

								<span class="menu-text"><b> Ketua Tim</b> </span>
							</a>
						</div>
						<?php } ?>
						<?php if($anggota) { ?>
						<div class="col-md-3">
							<a href="<?= site_url('home/get/anggota_tim'); ?>">
								<img src="<?= base_url(); ?>assets/images/logo-anggota.png" style="width:250px; height: 250px;">
								<br/>
								<span class="menu-text"><b> Anggota Tim</b> </span>
							</a>
						</div>
						<?php } ?>

						<?php if($ketua_tl) { ?>
						<div class="col-md-3">
							<a href="<?= site_url('home/get/ketua_tl'); ?>">
								<img src="<?= base_url(); ?>assets/images/logo-ketua.png" style="width:250px; height: 250px;">
								<br/>

								<span class="menu-text"><b> Ketua Tindak Lanjut</b> </span>
							</a>
						</div>
						<?php } ?>

						<?php if($anggota_tl) { ?>
						<div class="col-md-3">
							<a href="<?= site_url('home/get/anggota_tl'); ?>">
								<img src="<?= base_url(); ?>assets/images/logo-anggota.png" style="width:250px; height: 250px;">
								<br/>
								<span class="menu-text"><b> Anggota Tindak Lanjut</b> </span>
							</a>
						</div>
						<?php } ?>
						
					</div>

					<!-- PAGE CONTENT ENDS -->
				</div><!-- /.col -->
			</div><!-- /.row -->

		</div><!-- /.page-content -->
	</div>
</div><!-- /.main-content -->

<!-- include data footer -->
<?php $this->load->view('layout/footer'); ?>

</body>
</html>