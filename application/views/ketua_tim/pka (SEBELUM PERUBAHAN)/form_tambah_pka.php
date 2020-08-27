<?php
//--> include data header
$this->load->view('layout/header'); ?>

<style type="text/css">
	.u {text-decoration: underline}
	.b {font-weight: bold}
	.i {font-style: italic}
	.c {text-align: center}
	.r {text-align: right}
	.j {text-align: justify}

	.bor-bot {border-bottom: 1px solid #000}
	.pos-atas {vertical-align: top}

	.pad-3 {padding: 5px}
	.pad-10 {padding: 10px}
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
								<a href="<?= site_url('ketua_tim/home'); ?>"> Home </a>
							</li>
							<li>
								<a href="<?= site_url('ketua_tim/pka'); ?>"> Program Kerja Audit </a>
							</li>
							<li class="active"> Tambah Program Kerja Audit </li>
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">

						<div class="page-header">
							<h1>
								Tambah Program Kerja Audit
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Menambahkan program kerja audit untuk tugas pemeriksaan
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->

								<form id="validasi" class="form-horizontal" role="form" action="<?php site_url('ketua_tim/pka/tambah_pka'); ?>" onsubmit="return cek_username(this)" method="post">
								<div class="row">
									<div class="col-md-12">

										<div class="widget-box">
											<div class="widget-header">
												<h4 class="widget-title">
													<i class="menu-icon fa fa-pencil-square-o"></i>
													Formulir Tambah Program Kerja Audit
												</h4>

												<div class="widget-toolbar">
													<a href="#" data-action="collapse">
														<i class="ace-icon fa fa-chevron-up"></i>
													</a>
												</div>
											</div>

											<div class="widget-body">
												<div class="widget-main">

													<!-- ID PKA -->
			                    <input type="hidden" name="id_pka" value="<?= $id_pka; ?>">
			                    <!-- ID tim -->
			                    <input type="hidden" name="id_tim" value="<?= $data->id_tim; ?>">
			                    <!-- ID tugas (penugasan) -->
			                    <input type="hidden" name="id_tgs" value="<?= $data->id_tugas; ?>">

			                    <!-- Total jenis pekerjaan -->
			                    <input type="hidden" name="jml_jp" value="<?= $total->jml; ?>">

			                    <!-- Penyusun -->
			                    <input type="hidden" name="penyusun" value="<?= $pegawai->id_pegawai; ?>">
			                    <!-- Penyetuju -->
			                    <input type="hidden" name="penyetuju" value="<?= $dalnis->id_pegawai; ?>">

			                    <!-- Waktu pelaksanaan pengawasan -->
			                    <input type="hidden" id="tgl_awal" value="<?= $data->tgl_awal; ?>">
													<input type="hidden" id="tgl_akhir" value="<?= $data->tgl_akhir; ?>">

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Tanggal Penyusunan : </label>
														<div class="col-sm-5">
															<label class="control-label"><?= $tanggal; ?></label>
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Nama Objek Audit : </label>
														<div class="col-sm-9">
															<input type="text" class="col-xs-10 col-sm-8" value="<?= $data->nama_op; ?>" readOnly="" />
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Sasaran : </label>
														<div class="col-sm-9">
															<input type="text" class="col-xs-10 col-sm-8" value="<?= $data->sasaran_peng; ?>" readOnly="" />
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Waktu Pemeriksaan : </label>
														<div class="col-sm-9">
															<input type="text" class="col-xs-10 col-sm-8" value="<?= $tgl_awal . ' s.d. '. $tgl_akhir; ?>" readOnly="" />
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Disusun Oleh [Ketua Tim] : </label>
														<div class="col-sm-9">
															<input type="text" class="col-xs-10 col-sm-6" value="<?= $pegawai->nama; ?>" readOnly="" />
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Disetujui Oleh [DALNIS] : </label>
														<div class="col-sm-9">
															<input type="text" class="col-xs-10 col-sm-6" value="<?= $dalnis->nama; ?>" readOnly="" />
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Disetujui Oleh [DALTU] : </label>
														<div class="col-sm-9">
															<input type="text" class="col-xs-10 col-sm-6" value="<?= $daltu->nama; ?>" readOnly="" />
														</div>
													</div>

													<hr/>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"></label>
														<div class="col-sm-5">
															<h4 class="header center"> Masukan data-data di bawah ini. </h4>
														</div>
													</div>

													<?php
														if($data->stat_sasaran == "pilih")
														{
															foreach($sasaran as $row)
															{
																echo $row->sasaran ."<br/>";
															}
														}
														else
															{ echo "INPUT / tanpa instansi"; }
													?>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Masa yang diperiksa : </label>
														<div class="col-sm-9">
															<input type="text" name="masa_periksa" class="col-xs-10 col-sm-4" placeholder='Tahun anggaran' value="Tahun anggaran <?= date('Y'); ?>" />
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Ref. PKA No. : </label>
														<div class="col-sm-9">
															<input type="text" name="no_ref_pka" class="col-xs-10 col-sm-2" placeholder='Nomor Ref.' />
														</div>
													</div>

													<br/>

													<!-- <a href="<?= site_url('ketua_tim/pengaturan/list_anggaran_waktu') ?>" class="btn btn-xs btn-primary" title="Atur ulang jenis pekerjaan">
														<i class="fa fa-gear"></i>
														Atur Jenis Pekerjaan
													</a> -->

													<table width="100%" border="0">
														<tr>
															<th width="3%"></th>
															<th></th>
															<th width="32%"></th>
															<th width="14%"></th>
															<th width="7%"></th>
															<th width="7%"></th>
														</tr>

														<tr><td colspan='6'><div class="hr hr-double hr-dotted hr18"></div></td></tr>

														<tr>
															<td align="center" colspan="2" class="b u"> U r a i a n </td>
															<td align="center" class="b u"> Dilaksanakan Oleh </td>
															<td align="center" class="b u"> Waktu Pemeriksaan </td>
															<td align="center" class="b u"> No. KKA </td>
															<td align="center" class="b u"> Keterangan </td>
														</tr>

														<!-- Total uraian -->
			                    	<input type="hidden" name="total" id="total" value="<?= $total->jml*2; ?>">
			                    	<!-- Total pelaksana -->
			                    	<input type="hidden" name="total2" id="total2" value="<?= $total->jml*2; ?>">
														<!-- jumlah tujuan pemeriksaan -->
														<input type="hidden" name="jml_tjn" id="f-tjn" value="<?= $total->jml; ?>" />
														<!-- jumlah langkah pemeriksaan -->
														<input type="hidden" name="jml_lkh" id="f-lkh" value="<?= $total->jml; ?>" />
														<!-- jumlah anggota -->
														<input type="hidden" name="jml_agt" id="f-agt" value="<?= $total->jml*2; ?>" />

														<tr><td colspan='6'><div class="hr hr-double hr-dotted hr18"></div></td></tr>
														<tr><td colspan="6"><h4 class='b u'> 1. PERSIAPAN AUDIT : </h4></td></tr>

														<?php
															$no_kat1 = 1;
															foreach($jp as $row)
															{
																if($row->kategori == "1")
																{
																	echo "
																	<input type='hidden' id='abjadT$no_kat1' value='b'>
																	<input type='hidden' id='abjadL$no_kat1' value='b'>
																	<input type='hidden' name='kategori[]' id='kategori-$no_kat1' value='$row->kategori'>
																	<input type='hidden' name='kode_pekerjaan[]' value='$id_pka-$no_kat1'>
																	<input type='hidden' name='jenis_pekerjaan[]' value='$row->jenis_pekerjaan'>
																	<input type='hidden' id='no-uraian-$no_kat1' value='$no_kat1'>

																	<tr>
																		<td class='c pad-3 pos-atas'> $no_kat1). </td>
																		<td class='b pad-3 u' colspan='5'> $row->jenis_pekerjaan </td>
																	</tr>
																	";

																	echo "
																	<tr>
																		<td></td>
																		<td class='i b'> A. Tujuan Pemeriksaan : </td>
																		<td></td>
																		<td></td>
																		<td></td>
																		<td></td>
																	</tr>
																	";

																	echo "
																	<tr>
																		<td colspan='6'>
																			<table width='100%' border='0' id='form_tjn$no_kat1'>
																				<tr class='bor-bot'>
																					<td width='3%'></td>
																					<td>
																						<input type='hidden' name='kode_periksa[]' value='A'>
																						<input type='hidden' name='kode_periksa2[]' value='A'>
																						<input type='hidden' name='no_kat[]' value='$no_kat1'>
																						<input type='hidden' name='no_kka2[]' value='1.$no_kat1.A.a'>

																						<input type='hidden' id='no-$no_kat1-A-a' value='1'>
																						<input type='hidden' name='nomor[]' value='1'>

																						a. <textarea name='nama_periksa[]' rows='2' cols='37' style='color:black;' placeholder='Isi tujuan pemeriksaan'></textarea>
																						<button type='button' class='btn btn-xs btn-warning' onclick='tambahElemenTjn(\"$no_kat1\"); return false;' title='Tambah tujuan pemeriksaan'><i class='fa fa-plus'></i></button>
																					</td>
																					<td width='36%' class='pad-3'>
																						<select name='pelaksana[]'>
																							<option> -- Pilih Pelaksana -- </option>";
																							echo "<option value='$daltu->id_pegawai $no_kat1'> $daltu->nama [DALTU] </option>";
																							echo "<option value='$dalnis->id_pegawai $no_kat1'> $dalnis->nama [DALNIS] </option>";
																							echo "<option value='$pegawai->id_pegawai $no_kat1'> $pegawai->nama [KETUA TIM] </option>";
																							foreach($anggota as $row2)
																							{
																								echo "<option value='$row2->anggota $no_kat1'> $row2->nama [ANGGOTA] </option>"; }
																					echo "</select>
																						<button type='button' class='btn btn-xs btn-warning' onclick='tambahElemenAgt(\"$no_kat1$no_kat1\", \"A\", \"1.$no_kat1.A.a\", \"no-$no_kat1-A-a\"); return false;' title='Tambah pelaksana'><i class='fa fa-plus'></i></button> <br/><br/>

																						<div id='form_agt$no_kat1$no_kat1'></div>
																					</td>
																					<td width='14%' class='pad-3'>
																						<div class='input-group date datepicker'>
																							<input type='text' name='tanggal[]' class='col-xs-10 col-sm-12' placeholder='Tanggal' readonly='' />
																							<span class='input-group-addon' title='Pilih Tanggal'><span class='ace-icon fa fa-calendar bigger-110'></span></span>
																						</div>
																					</td>
																					<td width='7%' class='pad-3'><input type='text' name='no_kka[]' class='col-xs-10 col-sm-12' placeholder='No KKA' value='1.$no_kat1.A.a' readOnly='' /></td>
																					<td width='7%' class='pad-3'><input type='text' name='keterangan[]' class='col-xs-10 col-sm-12' placeholder='Ket' /></td>
																				</tr>
																			</table>
																		</td>
																	</tr>
																	";

																	echo "
																	<tr>
																		<td></td>
																		<td class='i b'> B. Langkah Pemeriksaan : </td>
																		<td></td>
																		<td></td>
																		<td></td>
																		<td></td>
																	</tr>
																	";

																	echo "
																	<tr>
																		<td colspan='6'>
																			<table width='100%' border='0' id='form_lkh$no_kat1'>
																				<tr class='bor-bot'>
																					<td width='3%'></td>
																					<td>
																						<input type='hidden' name='kode_periksa[]' value='B'>
																						<input type='hidden' name='kode_periksa2[]' value='B'>
																						<input type='hidden' name='no_kat[]' value='$no_kat1'>
																						<input type='hidden' name='no_kka2[]' value='1.$no_kat1.B.a'>

																						<input type='hidden' id='no-$no_kat1-B-a' value='1'>
																						<input type='hidden' name='nomor[]' value='1'>

																						a. <textarea name='nama_periksa[]' rows='2' cols='37' style='color:black;' placeholder='Isi langkah pemeriksaan'></textarea>
																						<button type='button' class='btn btn-xs btn-warning' onclick='tambahElemenLkh(\"$no_kat1\"); return false;' title='Tambah langkah pemeriksaan'><i class='fa fa-plus'></i></button>
																					</td>
																					<td width='36%' class='pad-3'>
																						<select name='pelaksana[]'>
																							<option> -- Pilih Pelaksana -- </option>";
																							echo "<option value='$daltu->id_pegawai $no_kat1'> $daltu->nama [DALTU] </option>";
																							echo "<option value='$dalnis->id_pegawai $no_kat1'> $dalnis->nama [DALNIS] </option>";
																							echo "<option value='$pegawai->id_pegawai $no_kat1'> $pegawai->nama [KETUA TIM] </option>";
																							foreach($anggota as $row2)
																							{
																								echo "<option value='$row2->anggota $no_kat1'> $row2->nama [ANGGOTA] </option>"; }
																					echo "</select>
																						<button type='button' class='btn btn-xs btn-warning' onclick='tambahElemenAgt(\"$no_kat1$no_kat1$no_kat1\", \"B\", \"1.$no_kat1.B.a\", \"no-$no_kat1-B-a\"); return false;' title='Tambah pelaksana'><i class='fa fa-plus'></i></button> <br/><br/>

																						<div id='form_agt$no_kat1$no_kat1$no_kat1'></div>
																					</td>
																					<td width='14%' class='pad-3'>
																						<div class='input-group date datepicker'>
																							<input type='text' name='tanggal[]' class='col-xs-10 col-sm-12' placeholder='Tanggal' readonly='' />
																							<span class='input-group-addon' title='Pilih Tanggal'><span class='ace-icon fa fa-calendar bigger-110'></span></span>
																						</div>
																					</td>
																					<td width='7%' class='pad-3'><input type='text' name='no_kka[]' class='col-xs-10 col-sm-12' placeholder='No KKA' value='1.$no_kat1.B.a' readOnly='' /></td>
																					<td width='7%' class='pad-3'><input type='text' name='keterangan[]' class='col-xs-10 col-sm-12' placeholder='Ket' /></td>
																				</tr>
																			</table>
																		</td>
																	</tr>
																	";

																	echo "
																	<tr class='bor-bot'>
																		<td></td>
																		<td class='i b'> C. Buatkan Kesimpulan Dalam Kertas Kerja </td>
																		<td></td>
																		<td></td>
																		<td></td>
																		<td></td>
																	</tr>
																	";

																	$no_kat1++;
																	$no_kat2 = $no_kat1;
																}
															}
															?>

															<tr><td colspan='6'>&nbsp;</td></tr>
															<tr><td colspan="6"><h4 class='b u'> 2. PELAKSANAAN AUDIT : </h4></td></tr>

															<?php
															/*$no_kategori = 1;
															foreach($jp as $row)
															{
																if($row->kategori == "2")
																{
																	echo "
																	<input type='hidden' id='abjadT$no_kat2' value='b'>
																	<input type='hidden' id='abjadL$no_kat2' value='b'>
																	<input type='hidden' name='kategori[]' id='kategori-$no_kat2' value='$row->kategori'>
																	<input type='hidden' name='kode_pekerjaan[]' value='$id_pka-$no_kat2'>
																	<input type='hidden' name='jenis_pekerjaan[]' value='$row->jenis_pekerjaan'>
																	<input type='hidden' id='no-uraian-$no_kat2' value='$no_kategori'>

																	<tr>
																		<td class='c pad-3 pos-atas'> $no_kategori). </td>
																		<td class='b pad-3' colspan='5'> $row->jenis_pekerjaan </td>
																	</tr>
																	";

																	echo "
																	<tr>
																		<td></td>
																		<td class='i b'> A. Tujuan Pemeriksaan : </td>
																		<td></td>
																		<td></td>
																		<td></td>
																		<td></td>
																	</tr>
																	";

																	echo "
																	<tr>
																		<td colspan='6'>
																			<table width='100%' border='0' id='form_tjn$no_kat2'>
																				<tr class='bor-bot'>
																					<td width='3%'></td>
																					<td>
																						<input type='hidden' name='kode_periksa[]' value='A'>
																						<input type='hidden' name='kode_periksa2[]' value='A'>
																						<input type='hidden' name='no_kat[]' value='$no_kat2'>
																						<input type='hidden' name='no_kka2[]' value='2.$no_kategori.A.a'>

																						a. <textarea name='nama_periksa[]' rows='2' cols='37' style='color:black;' placeholder='Isi tujuan pemeriksaan'></textarea>
																						<button type='button' class='btn btn-xs btn-warning' onclick='tambahElemenTjn(\"$no_kat2\"); return false;' title='Tambah tujuan pemeriksaan'><i class='fa fa-plus'></i></button>
																					</td>
																					<td width='36%' class='pad-3'>
																						<select name='pelaksana[]'>
																							<option> -- Pilih Pelaksana -- </option>";
																							echo "<option value='$daltu->id_pegawai $no_kat2'> $daltu->nama [DALTU] </option>";
																							echo "<option value='$dalnis->id_pegawai $no_kat2'> $dalnis->nama [DALNIS] </option>";
																							echo "<option value='$pegawai->id_pegawai $no_kat2'> $pegawai->nama [KETUA TIM] </option>";
																							foreach($anggota as $row2)
																							{
																								echo "<option value='$row2->anggota $no_kat2'> $row2->nama [ANGGOTA] </option>"; }
																					echo "</select>
																						<button type='button' class='btn btn-xs btn-warning' onclick='tambahElemenAgt(\"$no_kat2$no_kat2\", \"A\", \"2.$no_kategori.A.a\", \"no-$no_kategori-A-a\"); return false;' title='Tambah pelaksana'><i class='fa fa-plus'></i></button> <br/><br/>

																						<div id='form_agt$no_kat2$no_kat2'></div>
																					</td>
																					<td width='14%' class='pad-3'>
																						<div class='input-group date datepicker'>
																							<input type='text' name='tanggal[]' class='col-xs-10 col-sm-12' placeholder='Tanggal' readonly='' />
																							<span class='input-group-addon' title='Pilih Tanggal'><span class='ace-icon fa fa-calendar bigger-110'></span></span>
																						</div>
																					</td>
																					<td width='7%' class='pad-3'><input type='text' name='no_kka[]' class='col-xs-10 col-sm-12' placeholder='No KKA' value='2.$no_kategori.A.a' readOnly='' /></td>
																					<td width='7%' class='pad-3'><input type='text' name='keterangan[]' class='col-xs-10 col-sm-12' placeholder='Ket' /></td>
																				</tr>
																			</table>
																		</td>
																	</tr>
																	";

																	echo "
																	<tr>
																		<td></td>
																		<td class='i b'> B. Langkah Pemeriksaan : </td>
																		<td></td>
																		<td></td>
																		<td></td>
																		<td></td>
																	</tr>
																	";

																	echo "
																	<tr>
																		<td colspan='6'>
																			<table width='100%' border='0' id='form_lkh$no_kat2'>
																				<tr class='bor-bot'>
																					<td width='3%'></td>
																					<td>
																						<input type='hidden' name='kode_periksa[]' value='B'>
																						<input type='hidden' name='kode_periksa2[]' value='B'>
																						<input type='hidden' name='no_kat[]' value='$no_kat2'>
																						<input type='hidden' name='no_kka2[]' value='2.$no_kategori.B.a'>

																						a. <textarea name='nama_periksa[]' rows='2' cols='37' style='color:black;' placeholder='Isi langkah pemeriksaan'></textarea>
																						<button type='button' class='btn btn-xs btn-warning' onclick='tambahElemenLkh(\"$no_kat2\"); return false;' title='Tambah langkah pemeriksaan'><i class='fa fa-plus'></i></button>
																					</td>
																					<td width='36%' class='pad-3'>
																						<select name='pelaksana[]'>
																							<option> -- Pilih Pelaksana -- </option>";
																							echo "<option value='$daltu->id_pegawai $no_kat2'> $daltu->nama [DALTU] </option>";
																							echo "<option value='$dalnis->id_pegawai $no_kat2'> $dalnis->nama [DALNIS] </option>";
																							echo "<option value='$pegawai->id_pegawai $no_kat2'> $pegawai->nama [KETUA TIM] </option>";
																							foreach($anggota as $row2)
																							{
																								echo "<option value='$row2->anggota $no_kat2'> $row2->nama [ANGGOTA] </option>"; }
																					echo "</select>
																						<button type='button' class='btn btn-xs btn-warning' onclick='tambahElemenAgt(\"$no_kat2$no_kat2$no_kat2\", \"B\", \"2.$no_kategori.B.a\", \"no-$no_kategori-B-a\"); return false;' title='Tambah pelaksana'><i class='fa fa-plus'></i></button> <br/><br/>

																						<div id='form_agt$no_kat2$no_kat2$no_kat2'></div>
																					</td>
																					<td width='14%' class='pad-3'>
																						<div class='input-group date datepicker'>
																							<input type='text' name='tanggal[]' class='col-xs-10 col-sm-12' placeholder='Tanggal' readonly='' />
																							<span class='input-group-addon' title='Pilih Tanggal'><span class='ace-icon fa fa-calendar bigger-110'></span></span>
																						</div>
																					</td>
																					<td width='7%' class='pad-3'><input type='text' name='no_kka[]' class='col-xs-10 col-sm-12' placeholder='No KKA' value='2.$no_kategori.B.a' readOnly='' /></td>
																					<td width='7%' class='pad-3'><input type='text' name='keterangan[]' class='col-xs-10 col-sm-12' placeholder='Ket' /></td>
																				</tr>
																			</table>
																		</td>
																	</tr>
																	";

																	echo "
																	<tr class='bor-bot'>
																		<td></td>
																		<td class='i b'> C. Buatkan Kesimpulan Dalam Kertas Kerja </td>
																		<td></td>
																		<td></td>
																		<td></td>
																		<td></td>
																	</tr>
																	";

																	$no_kategori++;
																	$no_kat2++;
																	$no_kat3 = $no_kat2;
																}
															}

															echo "
																<tr><td colspan='6'>&nbsp;</td></tr>
																<tr><td colspan='6'><div class='hr hr-double hr-dotted hr18'></div></td></tr>
																<tr><td colspan='6'><h4 class='b u'> 3. PENYELESAIAN AUDIT : </h4></td></tr>
																";

															$no_kategori2 = 1;
															foreach($jp as $row)
															{
																if($row->kategori == "3")
																{
																	echo "
																	<input type='hidden' id='abjadT$no_kat3' value='b'>
																	<input type='hidden' id='abjadL$no_kat3' value='b'>
																	<input type='hidden' name='kategori[]' id='kategori-$no_kat3' value='$row->kategori'>
																	<input type='hidden' name='kode_pekerjaan[]' value='$id_pka-$no_kat3'>
																	<input type='hidden' name='jenis_pekerjaan[]' value='$row->jenis_pekerjaan'>
																	<input type='hidden' id='no-uraian-$no_kat3' value='$no_kategori2'>

																	<tr>
																		<td class='c pad-3 pos-atas'> $no_kategori2). </td>
																		<td class='b pad-3' colspan='5'> $row->jenis_pekerjaan </td>
																	</tr>
																	";

																	echo "
																	<tr>
																		<td></td>
																		<td class='i b'> A. Tujuan Pemeriksaan : </td>
																		<td></td>
																		<td></td>
																		<td></td>
																		<td></td>
																	</tr>
																	";

																	echo "
																	<tr>
																		<td colspan='6'>
																			<table width='100%' border='0' id='form_tjn$no_kat3'>
																				<tr class='bor-bot'>
																					<td width='3%'></td>
																					<td>
																						<input type='hidden' name='kode_periksa[]' value='A'>
																						<input type='hidden' name='kode_periksa2[]' value='A'>
																						<input type='hidden' name='no_kat[]' value='$no_kat3'>
																						<input type='hidden' name='no_kka2[]' value='3.$no_kategori2.A.a'>

																						a. <textarea name='nama_periksa[]' rows='2' cols='37' style='color:black;' placeholder='Isi tujuan pemeriksaan'></textarea>
																						<button type='button' class='btn btn-xs btn-warning' onclick='tambahElemenTjn(\"$no_kat3\"); return false;' title='Tambah tujuan pemeriksaan'><i class='fa fa-plus'></i></button>
																					</td>
																					<td width='36%' class='pad-3'>
																						<select name='pelaksana[]'>
																							<option> -- Pilih Pelaksana -- </option>";
																							echo "<option value='$daltu->id_pegawai $no_kat3'> $daltu->nama [DALTU] </option>";
																							echo "<option value='$dalnis->id_pegawai $no_kat3'> $dalnis->nama [DALNIS] </option>";
																							echo "<option value='$pegawai->id_pegawai $no_kat3'> $pegawai->nama [KETUA TIM] </option>";
																							foreach($anggota as $row2)
																							{
																								echo "<option value='$row2->anggota $no_kat3'> $row2->nama [ANGGOTA] </option>"; }
																					echo "</select>
																						<button type='button' class='btn btn-xs btn-warning' onclick='tambahElemenAgt(\"$no_kat3$no_kat3\", \"A\", \"3.$no_kategori2.A.a\", \"no-$no_kategori2-A-a\"); return false;' title='Tambah pelaksana'><i class='fa fa-plus'></i></button> <br/><br/>

																						<div id='form_agt$no_kat3$no_kat3'></div>
																					</td>
																					<td width='14%' class='pad-3'>
																						<div class='input-group date datepicker'>
																							<input type='text' name='tanggal[]' class='col-xs-10 col-sm-12' placeholder='Tanggal' readonly='' />
																							<span class='input-group-addon' title='Pilih Tanggal'><span class='ace-icon fa fa-calendar bigger-110'></span></span>
																						</div>
																					</td>
																					<td width='7%' class='pad-3'><input type='text' name='no_kka[]' class='col-xs-10 col-sm-12' placeholder='No KKA' value='3.$no_kategori2.A.a' readOnly='' /></td>
																					<td width='7%' class='pad-3'><input type='text' name='keterangan[]' class='col-xs-10 col-sm-12' placeholder='Ket' /></td>
																				</tr>
																			</table>
																		</td>
																	</tr>
																	";

																	echo "
																	<tr>
																		<td></td>
																		<td class='i b'> B. Langkah Pemeriksaan : </td>
																		<td></td>
																		<td></td>
																		<td></td>
																		<td></td>
																	</tr>
																	";

																	echo "
																	<tr>
																		<td colspan='6'>
																			<table width='100%' border='0' id='form_lkh$no_kat3'>
																				<tr class='bor-bot'>
																					<td width='3%'></td>
																					<td>
																						<input type='hidden' name='kode_periksa[]' value='B'>
																						<input type='hidden' name='kode_periksa2[]' value='B'>
																						<input type='hidden' name='no_kat[]' value='$no_kat3'>
																						<input type='hidden' name='no_kka2[]' value='3.$no_kategori2.B.a'>

																						a. <textarea name='nama_periksa[]' rows='2' cols='37' style='color:black;' placeholder='Isi langkah pemeriksaan'></textarea>
																						<button type='button' class='btn btn-xs btn-warning' onclick='tambahElemenLkh(\"$no_kat3\"); return false;' title='Tambah langkah pemeriksaan'><i class='fa fa-plus'></i></button>
																					</td>
																					<td width='36%' class='pad-3'>
																						<select name='pelaksana[]'>
																							<option> -- Pilih Pelaksana -- </option>";
																							echo "<option value='$daltu->id_pegawai $no_kat3'> $daltu->nama [DALTU] </option>";
																							echo "<option value='$dalnis->id_pegawai $no_kat3'> $dalnis->nama [DALNIS] </option>";
																							echo "<option value='$pegawai->id_pegawai $no_kat3'> $pegawai->nama [KETUA TIM] </option>";
																							foreach($anggota as $row2)
																							{
																								echo "<option value='$row2->anggota $no_kat3'> $row2->nama [ANGGOTA] </option>"; }
																					echo "</select>
																						<button type='button' class='btn btn-xs btn-warning' onclick='tambahElemenAgt(\"$no_kat3$no_kat3$no_kat3\", \"B\", \"3.$no_kategori2.B.a\", \"no-$no_kategori2-B-a\"); return false;' title='Tambah pelaksana'><i class='fa fa-plus'></i></button> <br/><br/>

																						<div id='form_agt$no_kat3$no_kat3$no_kat3'></div>
																					</td>
																					<td width='14%' class='pad-3'>
																						<div class='input-group date datepicker'>
																							<input type='text' name='tanggal[]' class='col-xs-10 col-sm-12' placeholder='Tanggal' readonly='' />
																							<span class='input-group-addon' title='Pilih Tanggal'><span class='ace-icon fa fa-calendar bigger-110'></span></span>
																						</div>
																					</td>
																					<td width='7%' class='pad-3'><input type='text' name='no_kka[]' class='col-xs-10 col-sm-12' placeholder='No KKA' value='3.$no_kategori2.B.a' readOnly='' /></td>
																					<td width='7%' class='pad-3'><input type='text' name='keterangan[]' class='col-xs-10 col-sm-12' placeholder='Ket' /></td>
																				</tr>
																			</table>
																		</td>
																	</tr>
																	";

																	echo "
																	<tr class='bor-bot'>
																		<td></td>
																		<td class='i b'> C. Buatkan Kesimpulan Dalam Kertas Kerja </td>
																		<td></td>
																		<td></td>
																		<td></td>
																		<td></td>
																	</tr>
																	";

																	$no_kategori2++;
																	$no_kat3++;
																}
															}*/
														?>
													</table>

													<div align="center" class="clearfix form-actions">
														<a href="javascript:history.back()" class="btn btn-default">
															<i class="fa fa-arrow-left"></i> Kembali
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

		<!-- inline scripts related to this page -->
    <script type="text/javascript">
      $(document).ready(function()
      {
				//$('.mask-money').maskMoney({prefix:'Rp. ', allowNegative: true, thousands:'.', decimal:',', affixesStay: false, precision:0});
      	$('.select2').css('width','310px').select2({allowClear:false});

      	//dalnis
				$('.dalnis').click(function(){
					if($(this).val() == "ya")
					{
						$('#form-dalnis').slideDown('fast');
					}
					else
					{
						$('#form-dalnis').slideUp('fast');
					}
				});

				/* Validasi */
        $('#validasi').validate({
          //-- Aturan karakter input --//
          rules:
          {
						nama_pengguna  : {required: true, maxlength: 50},
						cp_pengguna		 : {required: true},
						status_pengguna: {required: true},
						username			 : {required: true, maxlength: 20},
						password			 : {required: true, maxlength: 20}
          },

          //-- Pesan error --//
          messages:
          {
            nama_pengguna:
            {
              required  : "&nbsp;<label style='color:red' class='control-label'> <i class='fa fa-exclamation-triangle'></i> <i>Tidak boleh kosong</i></label>",
              maxlength : "<div style='color:red'>Tidak boleh lebih dari 50 huruf</div>"
            },
            cp_pengguna:
            {
            	required  : "&nbsp;<label style='color:red' class='control-label'> <i class='fa fa-exclamation-triangle'></i> <i>Tidak boleh kosong</i></label>"
            },
            status_pengguna:
            {
            	required  : "&nbsp;<label style='color:red' class='control-label'> <i class='fa fa-exclamation-triangle'></i> <i>Tidak boleh kosong</i></label>"
            },
            username:
            {
            	required  : "&nbsp;<label style='color:red' class='control-label'> <i class='fa fa-exclamation-triangle'></i> <i>Tidak boleh kosong</i></label>",
            	maxlength : "<div style='color:red'>Tidak boleh lebih dari 20 karakter</div>"
            },
            password:
            {
            	required  : "&nbsp;<label style='color:red' class='control-label'> <i class='fa fa-exclamation-triangle'></i> <i>Tidak boleh kosong</i></label>",
            	maxlength : "<div style='color:red'>Tidak boleh lebih dari 20 karakter</div>"
            }
          },
          submitHandler: function(form) {
            form.submit();
          }
        });
			});

			//Jumlah tujuan pemeriksaan
			function tambahElemenTjn(form_tjn)
			{
				var total   = document.getElementById("total").value;
			  var ftjn    = document.getElementById("f-tjn").value;
			  var fagt    = document.getElementById("f-agt").value;
			  var abjad   = document.getElementById("abjadT"+form_tjn).value;
			  var kat 	  = document.getElementById("kategori-"+form_tjn).value;
			  var no_jen  = document.getElementById("no-uraian-"+form_tjn).value;
			  //var no_urai = document.getElementById("kode-pekerjaan-"+form_tjn).value;
		  	var stre;

		  	if(abjad != '{')
		  	{
		  		stre = "<tr id='tjn_row" + ftjn + "' class='bor-bot'>" +
								 "	<td>"+
								 "		<input type='hidden' name='kode_periksa[]' value='A'>"+
								 "		<input type='hidden' name='no_kat[]' value='"+form_tjn+"'>"+
								 "		<input type='hidden' name='no_kka2[]' value='"+kat+"."+no_jen+".A."+abjad+"'>"+
								 "		<input type='hidden' id='no-"+form_tjn+"-A-"+abjad+"' value='1'>"+
								 "		<input type='hidden' name='nomor[]' value='1'>"+
								 "	</td>" +
								 "	<td>"+ abjad +". <textarea name='nama_periksa[]' rows='2' cols='37' style='color:black;' placeholder='Isi tujuan pemeriksaan'></textarea> <a href='#' onclick='hapusElemenTjn(\"#tjn_row" + ftjn + "\", "+ form_tjn +"); return false;' class='btn btn-xs btn-danger' title='Hapus tujuan pemeriksaan'> <i class='fa fa-minus'></i> </a> </td>" +
								 "	<td class='pad-3'> <select name='pelaksana[]'>" +
								 "		<option> -- Pilih Pelaksana -- </option>" +
								 "		<option value='<?= $daltu->id_pegawai ?> "+ form_tjn +"'> <?= $daltu->nama ?> [DALTU] </option>" +
								 "		<option value='<?= $dalnis->id_pegawai ?> "+ form_tjn +"'> <?= $dalnis->nama ?> [DALNIS] </option>" +
								 "		<option value='<?= $pegawai->id_pegawai ?> "+ form_tjn +"'> <?= $pegawai->nama ?> [KETUA TIM] </option> <?php
											foreach($anggota as $row)
											{ ?>" +
												 "<option value='<?= $row->anggota; ?> "+ form_tjn +"'> <?= $row->nama; ?> [ANGGOTA] </option>" +
							 	 "		<?php } ?>" +
								 "	</select>" +
								 "  <button type='button' class='btn btn-xs btn-warning' onclick='tambahElemenAgt(\""+ form_tjn + ftjn +"\", \"A\", \""+kat+"."+no_jen+".A."+abjad+"\", \"no-"+form_tjn+"-A-"+abjad+"\"); return false;' title='Tambah pelaksana'><i class='fa fa-plus'></i></button> <br/><br/> <div id='form_agt"+ form_tjn + ftjn +"'></div> </td>" +
								 "	<td class='pad-3'> <div class='input-group date datepicker' onclick='tanggal(); return true;'>" +
								 "			<input type='text' name='tanggal[]' class='col-xs-10 col-sm-12' placeholder='Tanggal' readonly='' />" +
								 "		<span class='input-group-addon' title='Pilih Tanggal'><span class='ace-icon fa fa-calendar bigger-110'></span></span>" +
								 "	</div> </td>" +
								  "	<td><input type='text' name='no_kka[]' class='col-xs-10 col-sm-12' placeholder='No KKA' value='"+kat+"."+no_jen+".A."+abjad+"' readOnly='' /></td>" +
								 "	<td class='pad-3'> <input type='text' name='keterangan[]' class='col-xs-10 col-sm-12' placeholder='Ket' /> </td>" +
								 "</tr>";

			  	$("#form_tjn"+form_tjn).append(stre);
			  	ftjn = (ftjn-1) + 2;
			  	document.getElementById("f-tjn").value = ftjn;

			  	total2 = (total-1) + 2;
			  	document.getElementById("total").value = total2;

			  	fagt2 = (fagt-1) + 2;
			  	document.getElementById("f-agt").value = fagt2;

			  	$.ajax({
			  		type 	: "POST",
	          url 	: "<?php echo site_url('ketua_tim/pka/get_abjad') ?>",
	          data 	: {modul:'plus', id:abjad},
						success: function(respond)
						{
							//$("#tes").html(respond);
							document.getElementById("abjadT"+form_tjn).value = respond;
						}
					});
		  	}
			}

			function hapusElemenTjn(id_elemen, no_form)
			{
			  $(id_elemen).remove();

			  var ftjn = document.getElementById("f-tjn").value;
			  ftjn2 = ftjn-1;
			  document.getElementById("f-tjn").value = ftjn2;

			  var total  = document.getElementById("total").value;
			  total2 = total-1;
		  	document.getElementById("total").value = total2;

		  	var fagt  = document.getElementById("f-agt").value;
			  fagt2 = fagt-1;
		  	document.getElementById("f-agt").value = fagt2;

			  var abjad = document.getElementById("abjadT"+no_form).value;
			  $.ajax({
		  		type 	: "POST",
          url 	: "<?php echo site_url('ketua_tim/pka/get_abjad') ?>",
          data 	: {modul:'minus', id:abjad},
					success: function(respond)
					{
						document.getElementById("abjadT"+no_form).value = respond;
					}
				});
			}
			//.jumlah tujuan pemeriksaan

			//Jumlah langkah pemeriksaan
			function tambahElemenLkh(form_lkh)
			{
				var total  = document.getElementById("total").value;
			  var flkh   = document.getElementById("f-lkh").value;
			  var fagt   = document.getElementById("f-agt").value;
			  var abjad  = document.getElementById("abjadL"+form_lkh).value;
			  var kat 	 = document.getElementById("kategori-"+form_lkh).value;
			  var no_jen = document.getElementById("no-uraian-"+form_lkh).value;
			  //var no_urai = document.getElementById("kode-pekerjaan-"+form_lkh).value;
		  	var stre;

		  	if(abjad != '{')
		  	{
					stre = "<tr id='lkh_row" + flkh + "' class='bor-bot'>" +
								 "	<td>"+
								 "		<input type='hidden' name='kode_periksa[]' value='B'>"+
								 "		<input type='hidden' name='no_kat[]' value='"+form_lkh+"'>"+
								 "		<input type='hidden' name='no_kka2[]' value='"+kat+"."+no_jen+".B."+abjad+"'>"+
								 "		<input type='hidden' id='no-"+form_lkh+"-B-"+abjad+"' value='1'>"+
								 "		<input type='hidden' name='nomor[]' value='1'>"+
								 "  </td>"+
								 "	<td>"+ abjad +". <textarea name='nama_periksa[]' rows='2' cols='37' style='color:black;' placeholder='Isi langkah pemeriksaan'></textarea> <a href='#' onclick='hapusElemenLkh(\"#lkh_row" + flkh + "\", "+ form_lkh +"); return false;' class='btn btn-xs btn-danger' title='Hapus langkah pemeriksaan'> <i class='fa fa-minus'></i> </a> </td>" +
								 "	<td class='pad-3'> <select name='pelaksana[]'>" +
								 "		<option> -- Pilih Pelaksana -- </option>" +
								 "		<option value='<?= $daltu->id_pegawai ?> "+ form_lkh +"'> <?= $daltu->nama ?> [DALTU] </option>" +
								 "		<option value='<?= $dalnis->id_pegawai ?> "+ form_lkh +"'> <?= $dalnis->nama ?> [DALNIS] </option>" +
								 "		<option value='<?= $pegawai->id_pegawai ?> "+ form_lkh +"'> <?= $pegawai->nama ?> [KETUA TIM] </option> <?php
											foreach($anggota as $row)
											{ ?>" +
												 "<option value='<?= $row->anggota; ?> "+ form_lkh +"'> <?= $row->nama; ?> [ANGGOTA] </option>" +
							 	 "		<?php } ?>" +
								 "	</select>" +
								 "  <button type='button' class='btn btn-xs btn-warning' onclick='tambahElemenAgt(\""+ form_lkh + form_lkh + flkh +"\", \"B\", \""+kat+"."+no_jen+".B."+abjad+"\", \"no-"+form_lkh+"-B-"+abjad+"\"); return false;' title='Tambah pelaksana'><i class='fa fa-plus'></i></button> <br/><br/> <div id='form_agt"+ form_lkh + form_lkh + flkh +"'></div> </td>" +
								 "	<td class='pad-3'> <div class='input-group date datepicker' onclick='tanggal(); return true;'>" +
								 "			<input type='text' name='tanggal[]' class='col-xs-10 col-sm-12' placeholder='Tanggal' readonly='' />" +
								 "		<span class='input-group-addon' title='Pilih Tanggal'><span class='ace-icon fa fa-calendar bigger-110'></span></span>" +
								 "	</div> </td>" +
								  "	<td><input type='text' name='no_kka[]' class='col-xs-10 col-sm-12' placeholder='No KKA' value='"+kat+"."+no_jen+".B."+abjad+"' readOnly='' /></td>" +
								 "	<td class='pad-3'> <input type='text' name='keterangan[]' class='col-xs-10 col-sm-12' placeholder='Ket' /> </td>" +
								 "</tr>";

			  	$("#form_lkh"+form_lkh).append(stre);
			  	flkh = (flkh-1) + 2;
			  	document.getElementById("f-lkh").value = flkh;

			  	total2 = (total-1) + 2;
			  	document.getElementById("total").value = total2;

			  	fagt2 = (fagt-1) + 2;
			  	document.getElementById("f-agt").value = fagt2;

			  	$.ajax({
			  		type 	: "POST",
	          url 	: "<?php echo site_url('ketua_tim/pka/get_abjad') ?>",
	          data 	: {modul:'plus', id:abjad},
						success: function(respond)
						{
							//$("#tes").html(respond);
							document.getElementById("abjadL"+form_lkh).value = respond;
						}
					});
				}
			}

			function hapusElemenLkh(id_elemen, no_form)
			{
			  $(id_elemen).remove();

			  var flkh = document.getElementById("f-lkh").value;
			  flkh2 = flkh-1;
			  document.getElementById("f-lkh").value = flkh2;

			  var total  = document.getElementById("total").value;
			  total2 = total-1;
		  	document.getElementById("total").value = total2;

		  	var fagt  = document.getElementById("f-agt").value;
			  fagt2 = fagt-1;
		  	document.getElementById("f-agt").value = fagt2;

			  var abjad = document.getElementById("abjadL"+no_form).value;
			  $.ajax({
		  		type 	: "POST",
          url 	: "<?php echo site_url('ketua_tim/pka/get_abjad') ?>",
          data 	: {modul:'minus', id:abjad},
					success: function(respond)
					{
						document.getElementById("abjadL"+no_form).value = respond;
					}
				});
			}
			//.jumlah langkah pemeriksaan

			//Jumlah anggota
			function tambahElemenAgt(form_agt, kode_abjad, kode_kka, kode_no)
			{
			  var fagt = document.getElementById("f-agt").value;
			  var no   = document.getElementById(kode_no).value;
			  noBaru = (no-1) + 2;

		  	var stre;
				stre = "<p id='srow" + fagt + "'>" +
							 "	<input type='hidden' name='kode_periksa2[]' value='"+ kode_abjad +"'>" +
							 "	<input type='hidden' name='no_kka2[]' value='"+ kode_kka +"'>" +
							 "	<input type='hidden' name='nomor[]' value='"+noBaru+"'>" +
							 "	<select name='pelaksana[]'>" +
							 "		<option> -- Pilih Pelaksana -- </option>"+
							 "		<option value='<?= $daltu->id_pegawai ?> "+ form_agt +"'> <?= $daltu->nama ?> [DALTU] </option>" +
							 "		<option value='<?= $dalnis->id_pegawai ?> "+ form_agt +"'> <?= $dalnis->nama ?> [DALNIS] </option>" +
							 "		<option value='<?= $pegawai->id_pegawai ?> "+ form_agt +"'> <?= $pegawai->nama ?> [KETUA TIM] </option> <?php
										foreach($anggota as $row)
										{ ?>" +
											 "<option value='<?= $row->anggota; ?> "+ form_agt +"'> <?= $row->nama; ?> [ANGGOTA] </option>" +
						 	 "		<?php } ?>" +
							 "	</select>" +
							 "  <a href='#' onclick='hapusElemenAgt(\"#srow" + fagt + "\", \""+ kode_no +"\"); return false;' class='btn btn-xs btn-danger' title='Hapus pelaksana'> <i class='fa fa-minus'></i> </a>" +
							 "</p>";

		  	$("#form_agt"+form_agt).append(stre);

		  	fagt = (fagt-1) + 2;
		  	document.getElementById("f-agt").value = fagt;

		  	var total = document.getElementById("total2").value;
		  	total2 = (total-1) + 2;
	  		document.getElementById("total2").value = total2;

	  		document.getElementById(kode_no).value = noBaru;
			}

			function hapusElemenAgt(id_elemen, kode_no)
			{
			  $(id_elemen).remove();

			  var fagt = document.getElementById("f-agt").value;
			  fagt2 = fagt-1;
			  document.getElementById("f-agt").value = fagt2;

			  var total  = document.getElementById("total2").value;
			  total2 = total-1;
		  	document.getElementById("total2").value = total2;

		  	var no  = document.getElementById(kode_no).value;
			  no = no-1;
		  	document.getElementById(kode_no).value = no;
			}
			//.jumlah anggota

			function tanggal()
			{
      	var tgl_awal  = document.getElementById("tgl_awal").value;
      	var tgl_akhir = document.getElementById("tgl_akhir").value;
      	//datepicker
      	$('.datepicker').datetimepicker({
      		language: 'id',
	        todayBtn: 1,
					autoclose: 1,
					todayHighlight: 1,
					startView: 2,
					minView: 2,
					forceParse: 0,
					startDate: tgl_awal,
					endDate: tgl_akhir
			  });
			 }
    </script>

    <script type="text/javascript">
    	var tgl_awal  = document.getElementById("tgl_awal").value;
    	var tgl_akhir = document.getElementById("tgl_akhir").value;
    	//datepicker
    	$('.datepicker').datetimepicker({
    		language: 'id',
        todayBtn: 1,
				autoclose: 1,
				todayHighlight: 1,
				startView: 2,
				minView: 2,
				forceParse: 0,
				startDate: tgl_awal,
				endDate: tgl_akhir
		  });
    </script>

	</body>
</html>
