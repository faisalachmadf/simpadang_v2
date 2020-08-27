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
								<a href="<?= site_url('adum/home'); ?>"> Home </a>
							</li>
							<li>
								<a href="<?= site_url('adum/penugasan'); ?>"> Penugasan </a>
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
									Melihat rincian data tugas yang diberikan kepada tim audit
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

														<div class="hr hr-double dotted"></div>													
													</dl>
													
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
																		<a href='". site_url('adum/penugasan/detail_reviu/'.base64_encode($row->rev_tugas1).'/'.base64_encode($row->rev_ke))."' title='Detail Reviu'> <i class='fa fa-eye bigger-130'></i> </a>
																	</td>
																</tr>
																";
																$no++;
															}
														?>
													</table> <br/>
													<?php } ?>

													<?php if($data->reviu_adum == NULL) { ?>
													<form class="form-horizontal" role="form" action="<?= site_url('adum/penugasan/persetujuan/'. base64_encode($data->id_tugas)); ?>" method="post">
													<input type="hidden" name="id_tim" value="<?= $data->id_tim; ?>" />
													<dl id="dt-list-1" class="dl-horizontal">
														<dt> Keputusan<label style="color:red">*</label> : </dt>
															<dd>
																<label>
																	<input type="radio" name="reviu" class="ace rev" value="setujui" checked="" />
																	<span class="lbl"> Setujui </span>
																</label>

																&nbsp;&nbsp; | &nbsp;&nbsp;

																<label>
																	<input type="radio" name="reviu" class="ace rev" value="reviu" />
																	<span class="lbl"> Direviu </span>
																</label>
															</dd>

														<div id="rev">
														<dt> Reviu : </dt>
															<dd align="justify"><textarea name="catatan" cols="40" rows="3"></textarea></dd>
														</div>
													</dl>

													<p style="color:red; font-style:italic">* Berikan keputusan Setujui atau terdapat reviu dari rencana penugasan.</p>

													<center>
														<a href="<?= site_url('adum/penugasan'); ?>" class="btn btn-sm btn-default"><i class="fa fa-arrow-left"></i> Kembali </a>		

														&nbsp;&nbsp;

														<input type="submit" name="submit" class="btn btn-sm btn-primary" value="OK" />
													</center>
													</form>

													<?php } else { ?>
													<div class="alert alert-block alert-success">
														<p>
															<i class='ace-icon fa fa-check'></i> Penugsan Pengawasan Telah Di Reviu.
														</p>
													</div>

													<?php 
														if($data->reviu_adum != "-")
														{
															echo "<p> Terdapat Reviu : </p> <label class='red'><strong> $data->reviu_adum </strong></label>";
														}
														else
														{
															echo "<center class='green'><i class='fa fa-check'><i> TIDAK ADA REVIU </i></i></center>";
														}
													?> <br/>												

													<center>
														<a href="<?= site_url('adum/penugasan'); ?>" class="btn btn-sm btn-default"><i class="fa fa-arrow-left"></i> Kembali </a>
													</center>
													<?php } ?>

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

		<script type="text/javascript">
			$('#rev').hide();
			//dalnis
			$('.rev').click(function(){
				if($(this).val() == "reviu")
				{
					$('#rev').slideDown('fast');
				}
				else
				{
					$('#rev').slideUp('fast');
				}
			});
		</script>

	</body>
</html>