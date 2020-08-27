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
	.pos-atas {vertical-align: top}
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
							<li>
								<a href="<?= site_url('ketua_tl/tindak_lanjut/detail_tl/'. base64_encode($data->sub_tl1) .'/'. base64_encode($data->fk_tim)); ?>"> Detail Tindak Lanjut </a>
							</li>
							<li class="active"> Detail Tugas TL </li>
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">

						<div class="page-header">
							<h1>
								Detail Tugas Tindak Lanjut
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
														<dt> Tanggal Tindak Lanjut : </dt>
															<dd><?= $tgl_tl; ?></dd>

														<br/>

														<dt> Nomor LHP : </dt>
															<dd><?= $data->fk_no_lhp; ?></dd>

														<dt> Jumlah Temuan : </dt>
															<dd><?= $data->jml_temuan; ?></dd>

														<dt> Jumlah Rekomendasi : </dt>
															<dd><?= $data->jml_rekomendasi; ?></dd>

															<br/>

														<table width="100%" border="1">
															<tr>
																<td rowspan='4' class="bg-color"> Kategori Tindak Lanjut </td>
																<td class="bg-color"> Selesai (S) </td>
																<td width="10%" class="c"> <?php if($data->jml_s == NULL) { echo "<i class='ace-icon fa fa-spinner fa-pulse orange' title='Belum diperiksa'></i>"; } else { echo "$data->jml_s"; } ?> </td>
															</tr>
															<tr>
																<td class="bg-color"> Dalam Proses (DP) </td>
																<td class="c"> <?php if($data->jml_dp == NULL) { echo "<i class='ace-icon fa fa-spinner fa-pulse orange' title='Belum diperiksa'></i>"; } else { echo "$data->jml_dp"; } ?> </td>
															</tr>
															<tr>
																<td class="bg-color"> Belum (B) </td>
																<td class="c"> <?php if($data->jml_b == NULL) { echo "<i class='ace-icon fa fa-spinner fa-pulse orange' title='Belum diperiksa'></i>"; } else { echo "$data->jml_b"; } ?> </td>
															</tr>
															<tr>
																<td class="bg-color"> Cacat Rekomendasi (CR) </td>
																<td class="c"> <?php if($data->jml_cr == NULL) { echo "<i class='ace-icon fa fa-spinner fa-pulse orange' title='Belum diperiksa'></i>"; } else { echo "$data->jml_cr"; } ?> </td>
															</tr>
														</table> <br/>

														<table width="100%" border="1">
															<tr>
																<td rowspan="2" class="bg-color"> Kode Temuan </td>
																<td class="c bg-color"> 101 </td>
																<td class="c bg-color"> 102 </td>
																<td class="c bg-color"> 103 </td>
																<td class="c bg-color"> 104 </td>
																<td class="c bg-color"> 105 </td>
																<td class="c bg-color"> 201 </td>
																<td class="c bg-color"> 202 </td>
																<td class="c bg-color"> 203 </td>
																<td class="c bg-color"> 301 </td>
																<td class="c bg-color"> 302 </td>
																<td class="c bg-color"> 303 </td>
																<td class="bg-color"> Jumlah </td>
															</tr>

															<tr>
																<td class="c"> <?= $data->jml_tm_101; ?> </td>
																<td class="c"> <?= $data->jml_tm_102; ?> </td>
																<td class="c"> <?= $data->jml_tm_103; ?> </td>
																<td class="c"> <?= $data->jml_tm_104; ?> </td>
																<td class="c"> <?= $data->jml_tm_105; ?> </td>
																<td class="c"> <?= $data->jml_tm_201; ?> </td>
																<td class="c"> <?= $data->jml_tm_202; ?> </td>
																<td class="c"> <?= $data->jml_tm_203; ?> </td>
																<td class="c"> <?= $data->jml_tm_301; ?> </td>
																<td class="c"> <?= $data->jml_tm_302; ?> </td>
																<td class="c"> <?= $data->jml_tm_303; ?> </td>
																<td class="c"> <?= $data->jml_tm; ?> </td>
															</tr>
														</table>

															<br/>

														<table width="100%" border="1">
															<tr>
																<td rowspan="2" class="bg-color"> Kode Rekomendasi </td>
																<td class="c bg-color"> 00 </td>
																<td class="c bg-color"> 01 </td>
																<td class="c bg-color"> 02 </td>
																<td class="c bg-color"> 03 </td>
																<td class="c bg-color"> 04 </td>
																<td class="c bg-color"> 05 </td>
																<td class="c bg-color"> 06 </td>
																<td class="c bg-color"> 07 </td>
																<td class="c bg-color"> 08 </td>
																<td class="c bg-color"> 09 </td>
																<td class="c bg-color"> 10 </td>
																<td class="c bg-color"> 11 </td>
																<td class="c bg-color"> 12 </td>
																<td class="c bg-color"> 13 </td>
																<td class="c bg-color"> 14 </td>
																<td class="bg-color"> Jumlah </td>
															</tr>

															<tr>
																<td class="c"> <?= $data->jml_rk_00; ?> </td>
																<td class="c"> <?= $data->jml_rk_01; ?> </td>
																<td class="c"> <?= $data->jml_rk_02; ?> </td>
																<td class="c"> <?= $data->jml_rk_03; ?> </td>
																<td class="c"> <?= $data->jml_rk_04; ?> </td>
																<td class="c"> <?= $data->jml_rk_05; ?> </td>
																<td class="c"> <?= $data->jml_rk_06; ?> </td>
																<td class="c"> <?= $data->jml_rk_07; ?> </td>
																<td class="c"> <?= $data->jml_rk_08; ?> </td>
																<td class="c"> <?= $data->jml_rk_09; ?> </td>
																<td class="c"> <?= $data->jml_rk_10; ?> </td>
																<td class="c"> <?= $data->jml_rk_11; ?> </td>
																<td class="c"> <?= $data->jml_rk_12; ?> </td>
																<td class="c"> <?= $data->jml_rk_13; ?> </td>
																<td class="c"> <?= $data->jml_rk_14; ?> </td>
																<td class="c"> <?= $data->jml_rk; ?> </td>
															</tr>
														</table>

													</dl>
												</div>

												<div class="col-sm-6">
													<h3 class="header">
														 &nbsp;
													</h3>

													<table width="100%" border="1">
														<tr>
															<td colspan="3" class="c bg-color"> Penyetoran Ke Rekening Kas Negara (Pajak) </td>
														</tr>
														<tr>
															<td class="c bg-color"> Jumlah </td>
															<td class="c bg-color"> Disetor </td>
															<td class="c bg-color"> Sisa </td>
														</tr>
														<tr>
															<td class="c"> Rp. <?= number_format($data->jml_kas_negara, '0', ',', '.'); ?> </td>
															<td class="c"> Rp. <?= number_format($data->str_kas_negara, '0', ',', '.'); ?> </td>
															<td class="c"> Rp. <?= number_format($data->sis_kas_negara, '0', ',', '.'); ?> </td>
														</tr>
													</table> <br/>

													<table width="100%" border="1">
														<tr>
															<td colspan="3" class="c bg-color"> Pengembalian Ke Rekening Kas Daerah </td>
														</tr>
														<tr>
															<td class="c bg-color"> Jumlah </td>
															<td class="c bg-color"> Disetor </td>
															<td class="c bg-color"> Sisa </td>
														</tr>
														<tr>
															<td class="c"> Rp. <?= number_format($data->jml_kas_daerah, '0', ',', '.'); ?> </td>
															<td class="c"> Rp. <?= number_format($data->str_kas_daerah, '0', ',', '.'); ?> </td>
															<td class="c"> Rp. <?= number_format($data->sis_kas_daerah, '0', ',', '.'); ?> </td>
														</tr>
													</table> <br/>

													<table width="100%" border="1">
														<tr>
															<td colspan="3" class="c bg-color"> Pengembalian Ke Rekening Kas Desa / Sekolah </td>
														</tr>
														<tr>
															<td class="c bg-color"> Jumlah </td>
															<td class="c bg-color"> Disetor </td>
															<td class="c bg-color"> Sisa </td>
														</tr>
														<tr>
															<td class="c"> Rp. <?= number_format($data->jml_kas_desa, '0', ',', '.'); ?> </td>
															<td class="c"> Rp. <?= number_format($data->str_kas_desa, '0', ',', '.'); ?> </td>
															<td class="c"> Rp. <?= number_format($data->sis_kas_desa, '0', ',', '.'); ?> </td>
														</tr>
													</table> <br/>

													<center>
														<a href="<?= site_url('ketua_tl/tindak_lanjut/detail_tl/'. base64_encode($data->sub_tl1) .'/'. base64_encode($data->fk_tim)); ?>" class="btn btn-sm btn-default"><i class="fa fa-arrow-left"></i> Kembali </a>

														<!-- &nbsp;&nbsp;

														<a href="<?= site_url('ketua_tl/tindak_lanjut/detail_tl/'. base64_encode($data->sub_tl1) .'/'. base64_encode($data->fk_no_lhp)); ?>" class="btn btn-sm btn-danger"><i class="fa fa-print"></i> Cetak Tindak Lanjut </a>

														&nbsp;&nbsp;

														<?php 
															if($data->semua_kat == "selesai")
																{ $hsl = ""; }
															else
																{ $hsl = "disabled"; }
														?>
														<a href="<?= site_url('ketua_tl/tindak_lanjut/cetak_tl/'. base64_encode($data->sub_tl1) .'/'. base64_encode($data->fk_no_lhp)); ?>" class="btn btn-sm btn-danger" <?= $hsl; ?>><i class="fa fa-print"></i> Cetak Berita Acara </a> -->
													</center>
												</div>

												<div class="col-sm-12">
													<div class="hr hr-double hr-dotted hr18"></div>

													<center>
														<h5> TINDAK LANJUT HASIL PEMERIKSAAN </h5>
														<label> No. LHP : <?= $data->fk_no_lhp; ?> Tgl. <?= $tgl_lhp; ?> </label>
													</center>

													<table width="100%" border="1">
														<tr>
															<td rowspan="3" width="3%" class="c bg-color"> No. </td>
															<td colspan="2" class="b c bg-color"> TEMUAN </td>
															<td colspan="2" class="b c bg-color"> REKOMENDASI </td>
															<td colspan="5" class="b c bg-color"> TINDAK LANJUT </td>
															<td rowspan="3" width="4%" class="c bg-color"> KET </td>
														</tr>

														<tr>
															<td rowspan="2" class="c bg-color"> URAIAN </td>
															<td rowspan="2" width="4%" class="c bg-color"> KODE </td>
															<td rowspan="2" class="c bg-color"> URAIAN </td>
															<td rowspan="2" width="4%" class="c bg-color"> KODE </td>
															<td rowspan="2" class="c bg-color"> URAIAN </td>
															<td colspan="4" class="c bg-color"> KATEGORI </td>
														</tr>

														<tr>
															<td width="3%" class="c bg-color"> S </td>
															<td width="3%" class="c bg-color"> DP </td>
															<td width="3%" class="c bg-color"> B </td>
															<td width="3%" class="c bg-color"> CR </td>
														</tr>

														<?php 
															$no=1;
															foreach($sub_tl2 as $row)
															{
																echo "
																<tr>
																	<td class='c pos-atas'> $no </td>
																	<td class='pos-atas'> $row->uraian_tm </td>
																	<td class='c pos-atas'> $row->kode_tm </td>
																	<td class='pos-atas'> $row->uraian_rk </td>
																	<td class='c pos-atas'> $row->kode_rk </td>
																	<td class-'pos-atas'> $row->uraian_tl </td>";
																	if($row->kategori == NULL)
																	{
																		echo "
																		<td> </td>
																		<td> </td>
																		<td> </td>
																		<td> </td>";
																	}
																	elseif($row->kategori == 'S')
																	{
																		echo "
																		<td class='c 'pos-atas'> &#10004; </td>
																		<td> </td>
																		<td> </td>
																		<td> </td>";
																	}
																	elseif($row->kategori == 'DP')
																	{
																		echo "
																		<td> </td>
																		<td class='c 'pos-atas'> &#10004; </td>
																		<td> </td>
																		<td> </td>";
																	}
																	elseif($row->kategori == 'B')
																	{
																		echo "
																		<td> </td>
																		<td> </td>
																		<td class='c 'pos-atas'> &#10004; </td>
																		<td> </td>";
																	}
																	elseif($row->kategori == 'CR')
																	{
																		echo "
																		<td> </td>
																		<td> </td>
																		<td> </td>
																		<td class='c 'pos-atas'> &#10004; </td>";
																	}

																echo "
																	<td class='pos-atas'> $row->keterangan </td>
																</tr>
																";

																$no++;
															}
														?>
													</table>
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