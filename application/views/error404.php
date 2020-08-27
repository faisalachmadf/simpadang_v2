<?php
//--> include data header
$this->load->view('layout/header_public');
//--> include data top navigasi 
$this->load->view('layout/top_nav_public');
//--> include data navigasi
//$this->load->view('layout/nav_public'); 
?>
		<div class="main-content">
			<div class="main-content-inner">
				<div class="page-content">


					<div class="row">
						<div class="col-xs-12">
							<!-- PAGE CONTENT BEGINS -->
							
							<div class="error-container">
									<div class="well">
										<h1 class="grey lighter smaller">
											<span class="red bigger-125">
												<i class="ace-icon fa fa-sitemap"></i>
												404
											</span>
											Halaman Tidak Ditemukan
										</h1>

										<hr />
										<h3 class="lighter smaller">Mohon maaf, mungkin ada beberapa permasalahan!</h3>

										<div>
											<div class="space"></div>
											<h4 class="smaller">Coba perhatikan hal-hal berikut ini :</h4>

											<ul class="list-unstyled spaced inline bigger-110 margin-15">
												<li>
													<i class="ace-icon fa fa-hand-o-right blue"></i>
													Program yang dituju kemungkinan belum selesai
												</li>

												<li>
													<i class="ace-icon fa fa-hand-o-right blue"></i>
													Cek ulang URL yang dituju
												</li>

												<li>
													<i class="ace-icon fa fa-hand-o-right blue"></i>
													Jaringan internet tersambung atau tidak
												</li>

												<li>
													<i class="ace-icon fa fa-hand-o-right blue"></i>
													Coba kembali ke menu sebelumnya atau tekan tombol 'Kembali'
												</li>
											</ul>
										</div>

										<hr />
										<div class="space"></div>

										<div class="center">
											<a href="javascript:history.back()" class="btn btn-grey">
												<i class="ace-icon fa fa-arrow-left"></i>
												Kembali
											</a>

											&nbsp;&nbsp;

											<a href="<?= site_url('publik'); ?>" class="btn btn-primary">
												<i class="ace-icon fa fa-tachometer"></i>
												Menu Utama
											</a>
										</div>
									</div>
								</div>

							<!-- PAGE CONTENT ENDS -->
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.page-content -->
			</div>
		</div><!-- /.main-content -->

<!-- include data footer -->
<?php $this->load->view('layout/footer_public'); ?>

	</body>
</html>