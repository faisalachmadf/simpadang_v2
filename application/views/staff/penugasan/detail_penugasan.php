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
								<a href="<?= site_url('staff/penugasan'); ?>"> Penugasan </a>
							</li>
							<li class="active"> Detail Penugasan </li>
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">

						<div class="page-header">
							<h1>
								Detail Penugasan
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Melihat rincian data tugas yang diberikan kepada tim pemeriksa
								</small>
							</h1>
						</div><!-- /.page-header -->

						<!-- notifikasi -->
						<div><?= $this->session->flashdata("smsgateway"); ?></div>
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
														<i class="fa fa-file-text"></i> Data Tugas
													</h3>

													<dl id="dt-list-1" class="dl-horizontal">
														<dt> Tanggal Penugasan : </dt>
															<dd><?= $tgl_tugas; ?></dd>

														<dt> Kegiatan Pengawasan : </dt>
															<dd align="justify"><?= $data->nama_kp; ?></dd>

														<br/>

														<dt> Objek Pengawasan : </dt>
															<dd align="justify"><?= $data->nama_op; ?></dd>

														<dt> Alamat Kantor : </dt>
															<dd align="justify"><?= $data->alamat_kantor; ?></dd>

														<dt> Nomor Telepon : </dt>
															<dd><?= $data->no_tlp; ?></dd>

														<br/>

														<dt> Program Pengawasan : </dt>
															<dd align="justify"><?= $data->program_peng; ?></dd>

														<dt> Sasaran Pengawasan : </dt>
															<dd align="justify"><?= $data->sasaran_peng; ?></dd>

														<dt> Tujuan Pengawasan : </dt>
															<dd align="justify"><?= $data->tujuan_peng; ?></dd>

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

														<br/>

														<dt>Dasar Surat : </dt>
															<dd align='justify'><?= $data->dasar_surat; ?></dd>

														<br/>

														<dt> Sasaran : </dt>
														<?php
															foreach($sasaran as $row)
															{
																if($row->sasaran != NULL)
																{ echo "<dd>$row->nomor. $row->sasaran</dd>"; }
															}
														?>

														<br/>

														<dt> Tembusan Surat : </dt>
														<?php
															foreach($tembusan as $row)
															{
																echo "<dd>$row->nomor. $row->tembusan</dd>";
															}
														?>
													</dl>
												</div>

												<div class="col-sm-6">
													<h3 class="header">
														<i class="fa fa-users"></i> Tim Pemeriksa
													</h3>

													<dl id="dt-list-1" class="dl-horizontal">
														<dt> Wakil Penanggung Jawab : </dt>
															<dd><?= $daltu->nama ." | ". $daltu->jabatan; ?></dd>

														<?php if($data->dalnis != NULL){ ?>
														<dt> Pengendali Teknis : </dt>
															<dd><?= $dalnis->nama; ?></dd>
															<br/>
														<?php } ?>

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

													<h3 class="header">
														<i class="fa fa-recycle"></i> Hasil Reviu
													</h3>

													<table width="100%" border="0">
														<tr>
															<td width="22%" style="vertical-align:top"> Reviu ADUM </td>
															<td width="3%" style="vertical-align:top"> : </td>
															<td>
																<?php
																	if($data->reviu_adum == NULL)
																	{ echo "<i class='fa fa-spinner fa-pulse orange'></i> <strong class='orange i'> Belum Direviu </strong>"; }
																	elseif($data->reviu_adum == "-")
																	{ echo "<i class='fa fa-check green'><strong> Tidak ada reviu </strong></i>"; }
																	else
																	{	echo "<span class='red'><strong> $data->reviu_adum </strong></span>"; }
																?>
															</td>
														</tr>

														<tr>
															<td width="22%" style="vertical-align:top"> Reviu Sekretaris </td>
															<td width="3%" style="vertical-align:top"> : </td>
															<td>
																<?php
																	if($data->reviu_sekretaris == NULL)
																	{ echo "<i class='fa fa-spinner fa-pulse orange'></i> <strong class='orange i'> Belum Direviu </strong>"; }
																	elseif($data->reviu_sekretaris == "-")
																	{ echo "<i class='fa fa-check green'><strong> Tidak ada reviu </strong></i>"; }
																	else
																	{	echo "<span class='red'><strong> $data->reviu_sekretaris </strong></span>"; }
																?>
															</td>
														</tr>

														<?php
														if($data->reviu_adum != NULL && $data->reviu_sekretaris != NULL) {
															if($data->persetujuan == "reviu") {
														?>
														<tr>
															<td colspan="3" class="center"><a href="<?= site_url('staff/penugasan/reviu_penugasan/'.base64_encode($data->id_tugas) .'/'.base64_encode($data->id_tim)) ?>" class="btn btn-sm btn-success"><i class='fa fa-edit'></i> Reviu Penugasan</a></td>
														</tr>
														<?php } } ?>
													</table>

													<?php if($cek_rev > 0) { ?>
													<h3 class="header">
														<i class="fa fa-retweet"></i> Riwayat Reviu
													</h3>

													<table width="100%" border="1">
														<tr>
															<th class="bg-color5 c" width="6%"> No </th>
															<th class="bg-color5 c"> Tanggal Reviu </th>
															<th class="bg-color5 c" width="16%"> Reviu Ke </th>
															<th class="bg-color5 c" width="12%"> ADUM </th>
															<th class="bg-color5 c" width="12%"> Sekretaris </th>
															<th class="bg-color5 c" width="10%"> Aksi </th>
														</tr>

														<?php
															$no = 1;
															foreach($data_rev as $row)
															{
																$tgl_rev = date('d', strtotime($row->rev_tgl_penugasan)) ." ".
																					 get_nama_bulan(date('m', strtotime($row->rev_tgl_penugasan))) ." ".
																					 date('Y', strtotime($row->rev_tgl_penugasan)) ." | ". date('H:i:s', strtotime($row->rev_tgl_penugasan));

																if($row->rev_adum == "-")
																{ $rev_adum = "<i class='fa fa-check bigger-130 green' title='Tidak ada reviu'></i>"; }
																else
																{	$rev_adum = "<i class='fa fa-times bigger-130 red' title='Terdapat reviu'></i>"; }

																if($row->rev_sekretaris == "-")
																{ $rev_sekretaris = "<i class='fa fa-check bigger-130 green' title='Tidak ada reviu'></i>"; }
																else
																{	$rev_sekretaris = "<i class='fa fa-times bigger-130 red' title='Terdapat reviu'></i>"; }

																echo "
																<tr>
																	<td class='c'> $no </td>
																	<td class='c'> $tgl_rev </td>
																	<td class='c'> $row->rev_ke </td>
																	<td class='c'> $rev_adum </td>
																	<td class='c'> $rev_sekretaris </td>
																	<td class='c'>
																		<a href='". site_url('staff/penugasan/detail_reviu/'.base64_encode($row->rev_tugas1).'/'.base64_encode($row->rev_ke))."' title='Detail Reviu'> <i class='fa fa-eye bigger-130'></i> </a>
																	</td>
																</tr>
																";
																$no++;
															}
														?>
													</table> <br/>
													<?php } ?>

													<center>
														<a href="<?= site_url('staff/penugasan'); ?>" class="btn btn-sm btn-default"><i class="fa fa-arrow-left"></i> Kembali </a>

														&nbsp;&nbsp;

														<?php if($data->tgl_persetujuan == NULL) { ?>
														<a href="#" class="btn btn-sm btn-danger" title="Tidak dapat mencetak surat tugas" disabled><i class="fa fa-print"></i> Cetak Surat Tugas </a>
														<?php } else { ?>
														<a href="<?= site_url('staff/data_surat/cetak_surat_tugas/'.base64_encode($data->no_st).'/'.base64_encode($data->id_tim)); ?>" class="btn btn-sm btn-danger" target="_blank"><i class="fa fa-print"></i> Cetak Surat Tugas </a>
														<?php } ?>

														<?php 
															$cek1 = $this->db->query("SELECT * FROM tb_lhp WHERE fk_tgs = '$data->id_tugas'")->num_rows();
															if($cek1 > 0)
															{
																$cek = $this->db->get_where('tb_lhp', array('fk_tgs' => $data->id_tugas))->row(); 
																if($cek->keputusan_lhp == "selesai")
																{
																	echo "
																	&nbsp;&nbsp;
																	<a href='". site_url('staff/tindak_lanjut/tambah_tl/'.base64_encode($data->id_tugas)) ."' class='btn btn-sm btn-success'><i class='fa fa-send-o'></i> Buat Tindak Lanjut </a>";
																}
															}															
														?>
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