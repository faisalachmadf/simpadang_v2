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
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="<?= site_url('adm/home'); ?>">Home</a>
							</li>
							<li>
								<a href="<?= site_url('adm/pengaturan'); ?>"> Golongan & Jabatan Pegawai </a>
							</li>
							<li class="active"> Tambah Jabatan Pegawai </li>
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">

						<div class="page-header">
							<h1>
								Tambah Jabatan Pegawai
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Menambahkan Jabatan Pegawai
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->

								<form id="validasi" class="form-horizontal" role="form" action="<?php site_url('adm/pengaturan/tambah_jbt'); ?>" method="post">
								<div class="row">
									<div class="col-md-12">

										<div class="widget-box">
											<div class="widget-header">
												<h4 class="widget-title">
													<i class="menu-icon fa fa-pencil-square-o"></i>
													Formulir Tambah Jabatan Pegawai
												</h4>

												<div class="widget-toolbar">
													<a href="#" data-action="collapse">
														<i class="ace-icon fa fa-chevron-up"></i>
													</a>
												</div>
											</div>

											<div class="widget-body">
												<div class="widget-main">

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Nama Jabatan </label>
														<div class="col-sm-9">
															<input type="text" name="jabatan" class="col-xs-10 col-sm-3" placeholder="Jabatan" />
														</div>
													</div>

													<div align="center" class="clearfix form-actions">
														<a href="<?= site_url('adm/pengaturan'); ?>" class="btn">
															<i class="ace-icon fa fa-arrow-left"></i>
															Kembali
														</a>

														&nbsp; &nbsp;

														<button class="btn btn-danger" type="reset">
															<i class="ace-icon fa fa-undo bigger-110"></i>
															Bersihkan
														</button>

														&nbsp; &nbsp;

														<input class="btn btn-info" type="submit" name="submit" value="Tambahkan"></input>
													</div>

												</div>
											</div>
										</div>
									</div><!-- /.col -->
								</div><!-- /.row -->
								</form>

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
