<?php
//--> include data header
$this->load->view('layout/header'); ?>

<style type="text/css">
	.u {text-decoration: underline}
	.b {font-weight: bold}
	.i {font-style: italic}
	.c {text-align: center}
	.r {text-align: right;}
	.j {text-align: justify}

	.pad-3 {padding: 5px}
	.bot-bor {border-bottom: 1px black solid}

	.bg-color  {background-color: #f1f6a3}
	.bg-color5 {background-color: #1faeff}

	td {padding: 5px}
</style>

<?php
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
								<a href="<?= site_url('staff/home'); ?>"> Home </a>
							</li>
							<li>
								<a href="<?= site_url('staff/tindak_lanjut'); ?>"> Tindak Lanjut </a>
							</li>
							<li>
								<a href="<?= site_url('staff/tindak_lanjut/detail_tl/'. base64_encode($data->rev_tl). '/'. base64_encode($data->rev_id_tim)); ?>"> Detail Tindak Lanjut </a>
							</li>
							<li class="active"> Detail Reviu Tindak Lanjut </li>
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">

						<div class="page-header">
							<h1>
								Detail Tindak Lanjut
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Melihat rincian data reviu tugas yang diberikan kepada tim tindak lanjut
								</small>
							</h1>
						</div><!-- /.page-header -->

						<!-- notifikasi -->
						<div><?= $this->session->flashdata("sukses"); ?></div>

						<div class="row">
							<div class="col-xs-12">
							<!-- PAGE CONTENT BEGINS -->

								<div class="widget-box">
									<div class="widget-body">
										<div class="widget-main">

											<div class="row">

												<div class="col-sm-6">
													<h3 class="header">
														<i class="fa fa-file-text"></i> Data Tindak Lanjut
													</h3>

													<dl id="dt-list-1" class="dl-horizontal">
														<dt> Tanggal : </dt>
															<dd><?= $tgl_tugas; ?></dd>												

														<br/>

														<dt> Objek Pengawasan : </dt>
															<dd align="justify"><?= $data->rev_sasaran_peng; ?></dd>

														<br/>

														<dt> Nomor Surat Tugas : </dt>
															<dd><?= $data->rev_no_st; ?></dd>

														<dt> Direncanakan Mulai Tgl : </dt>
															<dd><?= $tgl_awal; ?></dd>

														<dt> Direncanakan Selesai Tgl : </dt>
															<dd><?= $tgl_akhir; ?></dd>

														<dt>Realisasi Tgl Pelaksanaan : </dt>
															<dd><?= $tgl_awal ." s/d ". $tgl_akhir; ?></dd>

													</dl>
												</div>

												<div class="col-sm-6">
													<h3 class="header">
														<i class="fa fa-users"></i> Tim Tindak Lanjut
													</h3>

													<dl id="dt-list-1" class="dl-horizontal">
														
														<dt> Ketua Tim : </dt>
															<dd><?= $ketua_tim->nama; ?></dd>

														<dt> Anggota : </dt>
														<?php
															foreach($tim as $row)
															{
																if($row->rev_anggota != NULL)
																{ echo "<dd>$row->rev_nomor. $row->nama</dd>"; }
															}
														?>
													</dl>

													<h3 class="header">
														<i class="fa fa-recycle"></i> Hasil Reviu
													</h3>

													<table width="100%" border="0">
														<tr>
															<td width="22%" style="vertical-align:top"> Reviu ADUM </td>
															<td width="3%" style="vertical-align:top"> : </td>
															<td>
																<?php
																	if($data->rev_adum == NULL)
																	{ echo "<i class='fa fa-spinner fa-pulse orange'></i> <strong class='orange i'> Belum Direviu </strong>"; }
																	elseif($data->rev_adum == "-")
																	{ echo "<i class='fa fa-check green'><strong> Tidak ada reviu </strong></i>"; }
																	else
																	{	echo "<span class='red'><strong> $data->rev_adum </strong></span>"; }
																?>
															</td>
														</tr>

														<tr>
															<td width="22%" style="vertical-align:top"> Reviu Sekretaris </td>
															<td width="3%" style="vertical-align:top"> : </td>
															<td>
																<?php
																	if($data->rev_sekretaris == NULL)
																	{ echo "<i class='fa fa-spinner fa-pulse orange'></i> <strong class='orange i'> Belum Direviu </strong>"; }
																	elseif($data->rev_sekretaris == "-")
																	{ echo "<i class='fa fa-check green'><strong> Tidak ada reviu </strong></i>"; }
																	else
																	{	echo "<span class='red'><strong> $data->rev_sekretaris </strong></span>"; }
																?>
															</td>
														</tr>
													</table>													

													<center>
														<a href="<?= site_url('staff/tindak_lanjut/detail_tl/'. base64_encode($data->rev_tl). '/'. base64_encode($data->rev_id_tim)); ?>" class="btn btn-sm btn-default"><i class="fa fa-arrow-left"></i> Kembali </a>											
													</center>

												</div>
											</div>

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