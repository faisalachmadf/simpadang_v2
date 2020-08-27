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
								<a href="<?= site_url('ketua_tl/home'); ?>"> Home </a>
							</li>
							<li>
								<a href="<?= site_url('ketua_tl/tindak_lanjut'); ?>"> Tindak Lanjut </a>
							</li>
							<li class="active"> Detail Tindak Lanjut </li>
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">

						<div class="page-header">
							<h1>
								Detail Tindak Lanjut
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Melihat rincian data tugas yang diberikan kepada tim tindak lanjut
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
															<dd><?= $tgl_tl; ?></dd>

														<br/>

														<dt> Objek Pengawasan : </dt>
															<dd align="justify"><?= $data->sasaran_peng; ?></dd>

														<br/>

														<dt> Nomor Surat Tugas : </dt>
															<dd><?= $data->no_st; ?></dd>

														<dt> Tangal Surat Tugas : </dt>
															<dd><?= $tgl_surat; ?></dd>

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
																if($row->anggota != NULL)
																{ echo "<dd>$row->nomor. $row->nama</dd>"; }
															}
														?>
													</dl>

													<!-- <h3 class="header">
														<i class="fa fa-book"></i> Laporan Hasil Pemeriksaan (LHP)
													</h3>

													<dl id="dt-list-1" class="dl-horizontal">
														<label> Berikut ini Laporan Hasil Pemeriksaan (LHP) yang akan di tindak lanjut. <br/> Download file LHP untuk keperluan input data tindak lanjut. </label>

														<dt> Download : </dt>
														<dd>
															<a href="<?= site_url('ketua_tl/tindak_lanjut/download_lhp/'. base64_encode($lhp->file_lhp)); ?>" class="btn btn-sm btn-success"><i class="fa fa-download"></i> File LHP </a>
															
														</dd>
													</dl> -->

													<center>
														<a href="<?= site_url('ketua_tl/tindak_lanjut'); ?>" class="btn btn-sm btn-default"><i class="fa fa-arrow-left"></i> Kembali </a>

														<?php if($temuan->input_ketua_tl != '1') { ?>
														<a href="<?= site_url('ketua_tl/tindak_lanjut/tambah_tl/'.$temuan->id_temuan); ?>" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Buat Tindak Lanjut </a>
													<?php } else { ?>

														<?php
														$id  = base64_encode($data->id_tl);
														$id2 = base64_encode($data->id_tim);
														?>

														<a href="<?= site_url('ketua_tl/tindak_lanjut/detail_tugas_tl2/'. $id . '/' . $id2); ?>" class="btn btn-sm btn-primary"><i class="fa fa-list"></i> Detail Tindak Lanjut </a>
													<?php } ?>
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