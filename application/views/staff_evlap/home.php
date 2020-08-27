<?php
//--> include data header
$this->load->view('layout/header');
//--> include data top navigasi 
$this->load->view('layout/top_nav');
//--> include data sidebar navigasi
$this->load->view('layout/nav_sidebar'); 
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

								

								<h1>Selamat Datang!</h1>
								<h3>Di Sistem Informasi Pengawasan Dan Tindak Lanjut Inspektorat Kota Pariaman.</h3>
								<h5>Anda berada di halaman <strong style="color:red">Kasubag Evaluasi dan Pelaporan.</strong> <small>Gunakan sistem ini dengan bijak, dan gunakan data dengan sebaik-baiknya.</small></h5>
								
								<br/>
								<p>Login sebagai : <strong><?=$user['username']; ?></strong></p>

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