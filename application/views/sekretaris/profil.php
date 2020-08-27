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
								<i class="ace-icon fa fa-home home-icon"></i> Home
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">

						<div class="page-header">
							<h1>
								Profil Pegawai
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									<?=$pegawai->nama; ?>
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->

								<div class="row">
									<div class="col-sm-12">


										<div class="tabbable">
											<ul class="nav nav-tabs" id="myTab">
												<li class="active">
													<a data-toggle="tab" href="#profil">
														<i class="green ace-icon fa fa-user bigger-120"></i>
														Profil
													</a>
												</li>

												<li>
													<a data-toggle="tab" href="#password">
														<i class="red ace-icon fa fa-key bigger-120"></i>
														Username & Password
													</a>
												</li>
											</ul>


											<form class="form-horizontal" role="form" action="<?=site_url('sekretaris/home/setting_ubah/'. base64_encode($pegawai->id_pegawai)); ?>" method="post">
											<div class="tab-content">

												<div id="profil" class="tab-pane fade in active">
													<div class="row">

														<div class="col-sm-6">
															<div class="form-group">
																<label class="col-sm-3 control-label no-padding-right"> NIP : </label>
																<div class="col-sm-9">
																	<label class="control-label"> <?php if($pegawai->nip == NULL) { echo "-"; } else { echo $pegawai->nip; } ?> </label>
																</div>
															</div>

															<div class="form-group">
																<label class="col-sm-3 control-label no-padding-right"> Nama : </label>
																<div class="col-sm-9">
																	<label class="control-label"> <?= $pegawai->nama; ?> </label>
																</div>
															</div>

															<div class="form-group">
																<label class="col-sm-3 control-label no-padding-right"> Pangkat : </label>
																<div class="col-sm-9">
																	<label class="control-label"> <?php if($pegawai->pangkat == NULL) { echo "-"; } else { echo $pegawai->pangkat; } ?> </label>
																</div>
															</div>

															<div class="form-group">
																<label class="col-sm-3 control-label no-padding-right"> Golongan : </label>
																<div class="col-sm-9">
																	<label class="control-label"> <?php if($pegawai->golongan == NULL) { echo "-"; } else { echo $pegawai->golongan; } ?> </label>
																</div>
															</div>

															<div class="form-group">
																<label class="col-sm-3 control-label no-padding-right"> Jabatan : </label>
																<div class="col-sm-9">
																	<label class="control-label"> <?=$pegawai->jabatan; ?> </label>
																</div>
															</div>

															<div class="form-group">
																<label class="col-sm-3 control-label no-padding-right"> Contact Person : </label>
																<div class="col-sm-7">
																	<label class="control-label"> <?php if($pegawai->no_tlp == NULL) { echo "-"; } else { echo $pegawai->no_tlp; } ?> </label>
																</div>
															</div>

														</div><!-- /.col -->

														<div class="col-sm-6">
															<div class="clearfix form-actions">
																<div align="center">
																	<a href="javascript:history.back()" class="btn">
																		<i class="ace-icon fa fa-arrow-left"></i>
																		Kembali
																	</a>
																</div>
															</div>
														</div>

													</div>
												</div><!-- /.profil -->

												<div id="password" class="tab-pane fade">
													<div class="row">

														<br/>

														<div class="col-sm-6">
															<div class="form-group">
																<label class="col-sm-3 control-label no-padding-right"> Username </label>
																<div class="col-sm-9">
																	<input type="text" name="username" class="col-sm-5" value="<?=$pegawai->username; ?>" />
																</div>
															</div>

															<div class="form-group">
																<label class="col-sm-3 control-label no-padding-right"> Password </label>
																<div class="col-sm-9">
																	<input type="text" name="password" class="col-sm-5" value="<?= base64_decode($pegawai->password); ?>" />
																</div>
															</div>

															<div class="clearfix form-actions">
																<div align="center">
																	<a href="javascript:history.back()" class="btn">
																		<i class="ace-icon fa fa-arrow-left"></i>
																		Kembali
																	</a>

																	&nbsp; &nbsp;

																	<input class="btn btn-info" type="submit" name="submit" value="Ubah"></input>
																</div>
															</div>
														</div>

													</div>
												</div><!-- /.password -->

											</div>
											</form>
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
<?php $this->load->view('layout/footer'); ?>

	</body>
</html>
