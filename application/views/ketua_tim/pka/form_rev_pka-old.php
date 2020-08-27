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
							<li>
								<a href="<?= site_url('ketua_tim/pka/detail_pka/'.base64_encode($data->id_pka)); ?>"> Detail Program Kerja Audit </a>
							</li>
							<li class="active"> Reviu Program Kerja Audit </li>
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">

						<div class="page-header">
							<h1>
								Reviu Program Kerja Audit
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Mengubah program kerja audit untuk tugas pemeriksaan
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->

								<form id="validasi" class="form-horizontal" role="form" action="<?php site_url('ketua_tim/pka/reviu_pka'); ?>" onsubmit="return cek_username(this)" method="post">
								<div class="row">
									<div class="col-md-12">

										<div class="widget-box">
											<div class="widget-header">
												<h4 class="widget-title">
													<i class="menu-icon fa fa-pencil-square-o"></i>
													Formulir Reviu Program Kerja Audit
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
			                    <input type="hidden" name="id_pka" value="<?= $data->id_pka; ?>">
			                    <!-- ID tim -->
			                    <input type="hidden" name="id_tim" value="<?= $data->id_tim; ?>">
			                    <!-- ID tugas (penugasan) -->
			                    <input type="hidden" name="id_tgs" value="<?= $data->id_tugas; ?>">
			                    <!-- Nomor reviu ke -->
			                    <input type="hidden" name="rev_ke" value="<?= $rev_ke; ?>">
			                     <!-- tgl pka -->
			                    <input type="hidden" name="tgl_pka" value="<?= $data->tgl_pka; ?>">

			                    <!-- Waktu pelaksanaan pengawasan -->
			                    <input type="hidden" id="tgl_awal" value="<?= $data->tgl_awal; ?>">
													<input type="hidden" id="tgl_akhir" value="<?= $data->tgl_akhir; ?>">

													<h3 class="header">
														<i class="fa fa-recycle"></i> Hasil Reviu
													</h3>

													<table width="100%" border="0">
														<tr>
															<td width="15%" class="pos-atas"> Tanggal Reviu Ketua Tim </td>
															<td width="2%" class="pos-atas"> : </td>
															<td> <?= $tanggal; ?> </td>
														</tr>

														<tr><td colspan="3">&nbsp;</td></tr>

														<tr>
															<td class="pos-atas"> Tanggal Reviu DALNIS </td>
															<td class="pos-atas"> : </td>
															<td> <?= $tgl_rev_dn; ?> </td>
														</tr>

														<tr>
															<td class="pos-atas"> Reviu DALNIS </td>
															<td class="pos-atas"> : </td>
															<td>
																<?php
																	if($data->reviu_dalnis == "-")
																	{ echo "<i class='fa fa-check green'><strong> Tidak ada reviu </strong></i>"; }
																	else
																	{	echo "<span class='red'><strong> $data->reviu_dalnis </strong></span>"; }
																?>
															</td>
														</tr>

														<!-- <tr><td colspan="3">&nbsp;</td></tr>

														<tr>
															<td class="pos-atas"> Tanggal Reviu DALTU </td>
															<td class="pos-atas"> : </td>
															<td> <?= $tgl_rev_dt; ?> </td>
														</tr>

														<tr>
															<td class="pos-atas"> Reviu DALTU </td>
															<td class="pos-atas"> : </td>
															<td>
																<?php
																	if($data->reviu_daltu == "-")
																	{ echo "<i class='fa fa-check green'><strong> Tidak ada reviu </strong></i>"; }
																	else
																	{	echo "<span class='red'><strong> $data->reviu_daltu </strong></span>"; }
																?>
															</td>
														</tr> -->
													</table>

													<hr/>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Masa yang diperiksa : </label>
														<div class="col-sm-9">
															<input type="text" name="masa_periksa" class="col-xs-10 col-sm-4" placeholder='Tahun anggaran' value="<?= $data->masa_periksa; ?>" />
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Ref. PKA No. : </label>
														<div class="col-sm-9">
															<input type="text" name="no_ref_pka" class="col-xs-10 col-sm-2" placeholder='Nomor Ref.' value="<?= $data->no_ref_pka; ?>" />
														</div>
													</div>

													<input type="hidden" name="jml_tjnPKA" id="tjnPKA" value="<?= $total_tjnPKA->jml+1; ?>" />

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Tujuan Program Kerja Audit : </label>
														<div class="col-sm-9">
															<?php
																foreach($sub1 as $row)
																{
																	if($row->tujuan_pka != NULL)
																	{
																		if($row->nomor == 1)
																		{
																			echo "
																			<textarea name='tjn_pka[]' rows='3' cols='60' placeholder='Isi tujuan PKA'>$row->tujuan_pka</textarea>
																			<button type='button' class='btn btn-xs btn-warning' onclick='tambahElemenTjnPKA(); return false;' title='Tambah tujuan'><i class='fa fa-plus'></i></button> <br/><br/>";
																		}
																		else
																		{
																			echo " <p id='tjnPKAminus-$row->nomor'>
																			<textarea name='tjn_pka[]' rows='3' cols='60' placeholder='Isi tujuan PKA'>$row->tujuan_pka</textarea>
																			<button type='button' class='btn btn-xs btn-danger' onclick='hapusElemenTjnPKA(\"#tjnPKAminus-$row->nomor\"); return false;' title='Hapus tujuan $row->nomor'><i class='fa fa-minus'></i></button> </p>";
																		}
																	}																	
																}
															?>

															<div id="form_tjnPKA"></div>
														</div>
													</div>

													<table width="100%" border="0">
														<tr>
															<th width="3%"></th>
															<th></th>
															<th width="36%"></th>
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
														
														<?php
															if(count($sasaran) == 0)
																{	$jml_ins = 1; }
															else
																{ $jml_ins = count($sasaran); }
														?>
														
														<!-- Total instansi -->
			                    	<input type="hidden" name="jml_ins" value=" <?= $jml_ins; ?>">
			                    	<!-- Total jenis pekerjaan -->
			                   		<input type="hidden" name="jml_jp" value="<?= $total_jp->jml; ?>">
														<!-- jumlah tujuan pemeriksaan -->
														<input type="hidden" name="jml_tjn" id="f-tjn" value="<?= $total_tjn->jml; ?>" />
														<!-- jumlah langkah pemeriksaan -->
														<input type="hidden" name="jml_lkh" id="f-lkh" value="<?= $total_lkh->jml; ?>" />
														<!-- jumlah anggota -->
														<input type="hidden" name="jml_agt" id="f-agt" value="<?= $total_plk->jml; ?>" />

														<tr><td colspan='6'><div class="hr hr-double hr-dotted hr18"></div></td></tr>
														<tr><td colspan="6"><h4 class='b u'> 1. PERSIAPAN AUDIT : </h4></td></tr>

														<?php
															//-> KONDISI LEBIH DARI 1 INSTANSI
															if(count($sasaran) != 0)
															{
																$abj_ins1 = 'A';
																$no_ins1  = 1;
																foreach($ins as $key)
																{
																	echo "
																	<tr>
																		<td class='c pad-3 pos-atas'><h5 class='b'> $abj_ins1). </h5></td>
																		<td class='pad-3' colspan='5'><h5 class='b u'> $key->nama_instansi </h5></td>
																	</tr>";

																	$no_kat1 = 1;
																	foreach($sub1 as $row)
																	{
																		if($row->kategori == "1" && $row->nama_instansi == $key->nama_instansi)
																		{
																			echo "
																			<input type='hidden' name='kategori[]' id='kategori-$no_kat1' value='$row->kategori'>
																			<input type='hidden' name='kode_pekerjaan[]' value='$row->kode_pekerjaan'>
																			<input type='hidden' name='jenis_pekerjaan[]' value='$row->jenis_pekerjaan'>
																			<input type='hidden' name='nama_instansi[]' value='$row->nama_instansi'>
																			<input type='hidden' id='no-uraian-$no_kat1' value='$no_kat1'>

																			<tr>
																				<td class='c pad-3 pos-atas'> $no_kat1). </td>
																				<td class='b pad-3 u' colspan='5'> $row->jenis_pekerjaan </td>
																			</tr>
																			
																			<tr>
																				<td></td>
																				<td class='i b'> A. Tujuan Pemeriksaan : </td>
																				<td></td>
																				<td></td>
																				<td></td>
																				<td></td>
																			</tr>
																			
																			<tr>
																				<td colspan='6'>
																					<table width='100%' border='0' id='form_tjn$no_ins1$no_kat1'>";
																					foreach($sub2 as $row3)
																					{
																						if($row3->kode_uraian == "$no_ins1-$no_kat1-A")
																						{
																							if($row3->no_kka == "a")
																							{
																								$abjadNext = 'b';

																								echo "
																								<tr class='bor-bot'>
																									<td width='3%'></td>
																									<td>
																										<input type='hidden' name='kode_periksa[]' value='A'>
																										<input type='hidden' name='no_ins[]' value='$no_ins1'>
																										<input type='hidden' name='no_kat[]' value='$no_kat1'>

																										a. <textarea name='nama_periksa[]' rows='2' cols='37' style='color:black;' placeholder='Isi tujuan pemeriksaan'>$row3->uraian</textarea>
																										<button type='button' class='btn btn-xs btn-warning' onclick='tambahElemenTjn(\"$no_kat1\", \"$no_ins1\", \"$no_ins1$no_kat1\"); return false;' title='Tambah tujuan pemeriksaan'><i class='fa fa-plus'></i></button>
																									</td>
																									<td width='36%' class='pad-3'> </td>
																									<td width='14%' class='pad-3'> <input type='hidden' name='tanggal[]' value='-' /> </td>
																									<td width='7%' class='pad-3'> <input type='hidden' name='no_kka[]' value='a' /> </td>
																									<td width='7%' class='pad-3'> <input type='hidden' name='keterangan[]' value='-' /> </td>
																								</tr>";
																							}
																							else
																							{
																								$abjad = substr($row3->no_kka,-1);
																								$abjadNext = chr(ord($abjad)+1);

																								echo "
																								<tr id='ttjn_row-$no_ins1$no_kat1' class='bor-bot'>
																									<td width='3%'></td>
																									<td>
																										<input type='hidden' name='kode_periksa[]' value='A'>
																										<input type='hidden' name='no_ins[]' value='$no_ins1'>
																										<input type='hidden' name='no_kat[]' value='$no_kat1'>
																										
																										$abjad. <textarea name='nama_periksa[]' rows='2' cols='37' style='color:black;' placeholder='Isi tujuan pemeriksaan'>$row3->uraian</textarea>
																										<button type='button' class='btn btn-xs btn-danger' onclick='hapusElemenTjn(\"#ttjn_row-$no_ins1$no_kat1\", \"$no_ins1$no_kat1\"); return false;' title='Hapus tujuan pemeriksaan'><i class='fa fa-minus'></i></button>
																									</td>
																									<td width='36%' class='pad-3'> </td>
																									<td width='14%' class='pad-3'> <input type='hidden' name='tanggal[]' value='-' /> </td>
																									<td width='7%' class='pad-3'> <input type='hidden' name='no_kka[]' value='$row3->no_kka' /> </td>
																									<td width='7%' class='pad-3'> <input type='hidden' name='keterangan[]' value='-' /> </td>
																								</tr>";
																							}
																						}
																					}
																					echo "
																					</table>
																				</td>
																			</tr>

																			<input type='hidden' id='abjadT$no_ins1$no_kat1' value='$abjadNext'>
																			
																			<tr>
																				<td></td>
																				<td class='i b'> B. Langkah Pemeriksaan : </td>
																				<td></td>
																				<td></td>
																				<td></td>
																				<td></td>
																			</tr>
																			
																			<tr>
																				<td colspan='6'>
																					<table width='100%' border='0' id='form_lkh$no_ins1$no_kat1'>";
																					foreach($sub2 as $row3)
																					{
																						if($row3->kode_uraian == "$no_ins1-$no_kat1-B")
																						{
																							if($row3->no_kka == "$row->kategori.$abj_ins1.$no_kat1.a")
																							{
																								echo "
																								<tr class='bor-bot'>
																									<td width='3%'></td>
																									<td>
																										<input type='hidden' name='kode_periksa[]' value='B'>
																										<input type='hidden' name='no_ins[]' value='$no_ins1'>
																										<input type='hidden' name='no_kat[]' value='$no_kat1'>
																										
																										a. <textarea name='nama_periksa[]' rows='2' cols='37' style='color:black;' placeholder='Isi langkah pemeriksaan'>$row3->uraian</textarea>
																										<button type='button' class='btn btn-xs btn-warning' onclick='tambahElemenLkh(\"$no_kat1\", \"$abj_ins1\", \"$no_ins1\", \"$no_ins1$no_kat1\"); return false;' title='Tambah langkah pemeriksaan'><i class='fa fa-plus'></i></button>
																									</td>
																									<td width='36%' class='pad-3'>";
																										foreach($sub3 as $row4)
																										{
																											if($row4->sub_no_kka == $row3->no_kka)
																											{
																												if($row4->nomor == 1)
																												{
																													$sub_kka = substr($row4->sub_no_kka, -1);
																													$pelaksana = $row4->pelaksana;

																													echo "
																													<input type='hidden' name='no_kka2[]' value='1.$abj_ins1.$no_kat1.$sub_kka'>
																													<input type='hidden' name='nomor[]' value='$row4->nomor'>
																													<select name='pelaksana[]'>
																														<option> -- Pilih Pelaksana -- </option>";
																														echo "<option value='$daltu->id_pegawai $no_kat1'"; if($pelaksana == $daltu->id_pegawai){ echo 'selected'; } echo "> $daltu->nama [DALTU] </option>";
																														echo "<option value='$dalnis->id_pegawai $no_kat1'"; if($pelaksana == $dalnis->id_pegawai){ echo 'selected'; } echo "> $dalnis->nama [DALNIS] </option>";
																														echo "<option value='$pegawai->id_pegawai $no_kat1'"; if($pelaksana == $pegawai->id_pegawai){ echo 'selected'; } echo "> $pegawai->nama [KETUA TIM] </option>";
																														foreach($anggota as $row2)
																														{	echo "<option value='$row2->anggota $no_kat1'"; if($pelaksana == $row2->anggota){ echo 'selected'; } echo "> $row2->nama [ANGGOTA] </option>"; }
																													echo "</select>

																													<button type='button' class='btn btn-xs btn-warning' onclick='tambahElemenAgt(\"$no_ins1$no_kat1-B-$sub_kka\", \"1.$abj_ins1.$no_kat1.a\", \"no-$no_ins1$no_kat1-B-a\"); return false;' title='Tambah pelaksana'><i class='fa fa-plus'></i></button> <br/><br/>
																													";
																												}
																												else
																												{
																													$sub_kka = substr($row4->sub_no_kka, -1);
																													$pelaksana = $row4->pelaksana;

																													echo "
																													<span id='ssrow-$no_ins1$no_kat1-B-$sub_kka-$row4->nomor'>
																													<input type='hidden' name='no_kka2[]' value='1.$abj_ins1.$no_kat1.$sub_kka'>
																													<input type='hidden' name='nomor[]' value='$row4->nomor'>
																													<select name='pelaksana[]'>
																														<option> -- Pilih Pelaksana -- </option>";
																														echo "<option value='$daltu->id_pegawai $no_kat1'"; if($pelaksana == $daltu->id_pegawai){ echo 'selected'; } echo "> $daltu->nama [DALTU] </option>";
																														echo "<option value='$dalnis->id_pegawai $no_kat1'"; if($pelaksana == $dalnis->id_pegawai){ echo 'selected'; } echo "> $dalnis->nama [DALNIS] </option>";
																														echo "<option value='$pegawai->id_pegawai $no_kat1'"; if($pelaksana == $pegawai->id_pegawai){ echo 'selected'; } echo "> $pegawai->nama [KETUA TIM] </option>";
																														foreach($anggota as $row2)
																														{	echo "<option value='$row2->anggota $no_kat1'"; if($pelaksana == $row2->anggota){ echo 'selected'; } echo "> $row2->nama [ANGGOTA] </option>"; }
																													echo "</select>

																													<button type='button' class='btn btn-xs btn-danger' onclick='hapusElemenAgt(\"#ssrow-$no_ins1$no_kat1-B-$sub_kka-$row4->nomor\", \"no-$no_ins1$no_kat1-B-a\"); return false;' title='Hapus pelaksana'><i class='fa fa-minus'></i></button> <br/><br/>
																													</span>
																													";
																												}
																												$noAkhir = $row4->nomor;
																											}
																										}
																										echo "
																										<div id='form_agt$no_ins1$no_kat1-B-$sub_kka'></div>
																										<input type='hidden' id='no-$no_ins1$no_kat1-B-a' value='$noAkhir'>
																									</td>
																									<td width='14%' class='pad-3'>
																										<div class='input-group date datepicker'>
																											<input type='text' name='tanggal[]' class='col-xs-10 col-sm-12' placeholder='Tanggal' readonly='' value='$row3->tgl_kerja' />
																											<span class='input-group-addon' title='Pilih Tanggal'><span class='ace-icon fa fa-calendar bigger-110'></span></span>
																										</div>
																									</td>
																									<td width='7%' class='pad-3'><input type='text' name='no_kka[]' class='col-xs-10 col-sm-12' placeholder='No KKA' value='$row3->no_kka' readOnly='' /></td>
																									<td width='7%' class='pad-3'><input type='text' name='keterangan[]' class='col-xs-10 col-sm-12' placeholder='Ket' value='$row3->keterangan' /></td>
																								</tr>";
																							}
																							else
																							{
																								$abjad = substr($row3->no_kka,-1);
																								$abjadNext = chr(ord($abjad)+1);
																								echo "
																								<tr id='llkh_row-$no_ins1$no_kat1' class='bor-bot'>
																									<td width='3%'></td>
																									<td>
																										<input type='hidden' name='kode_periksa[]' value='B'>
																										<input type='hidden' name='no_ins[]' value='$no_ins1'>
																										<input type='hidden' name='no_kat[]' value='$no_kat1'>
																										
																										$abjad. <textarea name='nama_periksa[]' rows='2' cols='37' style='color:black;' placeholder='Isi langkah pemeriksaan'>$row3->uraian</textarea>
																										<button type='button' class='btn btn-xs btn-danger' onclick='hapusElemenLkh(\"#llkh_row-$no_ins1$no_kat1\", \"$no_ins1$no_kat1\"); return false;' title='Hapus langkah pemeriksaan'><i class='fa fa-minus'></i></button>
																									</td>
																									<td width='36%' class='pad-3'>";
																										foreach($sub3 as $row4)
																										{
																											if($row4->sub_no_kka == $row3->no_kka)
																											{
																												if($row4->nomor == 1)
																												{
																													$sub_kka = substr($row4->sub_no_kka, -1);
																													$pelaksana = $row4->pelaksana;

																													echo "
																													<input type='hidden' name='no_kka2[]' value='1.$abj_ins1.$no_kat1.$sub_kka'>
																													<input type='hidden' name='nomor[]' value='$row4->nomor'>
																													<select name='pelaksana[]'>
																														<option> -- Pilih Pelaksana -- </option>";
																														echo "<option value='$daltu->id_pegawai $no_kat1'"; if($pelaksana == $daltu->id_pegawai){ echo 'selected'; } echo "> $daltu->nama [DALTU] </option>";
																														echo "<option value='$dalnis->id_pegawai $no_kat1'"; if($pelaksana == $dalnis->id_pegawai){ echo 'selected'; } echo "> $dalnis->nama [DALNIS] </option>";
																														echo "<option value='$pegawai->id_pegawai $no_kat1'"; if($pelaksana == $pegawai->id_pegawai){ echo 'selected'; } echo "> $pegawai->nama [KETUA TIM] </option>";
																														foreach($anggota as $row2)
																														{	echo "<option value='$row2->anggota $no_kat1'"; if($pelaksana == $row2->anggota){ echo 'selected'; } echo "> $row2->nama [ANGGOTA] </option>"; }
																													echo "</select>

																													<button type='button' class='btn btn-xs btn-warning' onclick='tambahElemenAgt(\"$no_ins1$no_kat1-B-$sub_kka\", \"1.$abj_ins1.$no_kat1.$sub_kka\", \"no-$no_ins1$no_kat1-B-$abjad\"); return false;' title='Tambah pelaksana'><i class='fa fa-plus'></i></button> <br/><br/>
																													";
																												}
																												else
																												{
																													$sub_kka = substr($row4->sub_no_kka, -1);
																													$pelaksana = $row4->pelaksana;

																													echo "
																													<span id='ssrow-$no_ins1$no_kat1-B-$sub_kka-$row4->nomor'>
																													<input type='hidden' name='no_kka2[]' value='1.$abj_ins1.$no_kat1.$sub_kka'>
																													<input type='hidden' name='nomor[]' value='$row4->nomor'>
																													<select name='pelaksana[]'>
																														<option> -- Pilih Pelaksana -- </option>";
																														echo "<option value='$daltu->id_pegawai $no_kat1'"; if($pelaksana == $daltu->id_pegawai){ echo 'selected'; } echo "> $daltu->nama [DALTU] </option>";
																														echo "<option value='$dalnis->id_pegawai $no_kat1'"; if($pelaksana == $dalnis->id_pegawai){ echo 'selected'; } echo "> $dalnis->nama [DALNIS] </option>";
																														echo "<option value='$pegawai->id_pegawai $no_kat1'"; if($pelaksana == $pegawai->id_pegawai){ echo 'selected'; } echo "> $pegawai->nama [KETUA TIM] </option>";
																														foreach($anggota as $row2)
																														{	echo "<option value='$row2->anggota $no_kat1'"; if($pelaksana == $row2->anggota){ echo 'selected'; } echo "> $row2->nama [ANGGOTA] </option>"; }
																													echo "</select>

																													<button type='button' class='btn btn-xs btn-danger' onclick='hapusElemenAgt(\"#ssrow-$no_ins1$no_kat1-B-$sub_kka-$row4->nomor\", \"no-$no_ins1$no_kat1-B-$abjad\"); return false;' title='Hapus pelaksana'><i class='fa fa-minus'></i></button> <br/><br/>
																													</span>
																													";
																												}
																												$noAkhir = $row4->nomor;
																											}
																										}
																										echo "
																										<div id='form_agt$no_ins1$no_kat1-B-$sub_kka'></div>
																										<input type='hidden' id='no-$no_ins1$no_kat1-B-$abjad' value='$noAkhir'>
																									</td>
																									<td width='14%' class='pad-3'>
																										<div class='input-group date datepicker'>
																											<input type='text' name='tanggal[]' class='col-xs-10 col-sm-12' placeholder='Tanggal' readonly='' value='$row3->tgl_kerja' />
																											<span class='input-group-addon' title='Pilih Tanggal'><span class='ace-icon fa fa-calendar bigger-110'></span></span>
																										</div>
																									</td>
																									<td width='7%' class='pad-3'><input type='text' name='no_kka[]' class='col-xs-10 col-sm-12' placeholder='No KKA' value='$row3->no_kka' readOnly='' /></td>
																									<td width='7%' class='pad-3'><input type='text' name='keterangan[]' class='col-xs-10 col-sm-12' placeholder='Ket' value='$row3->keterangan' /></td>
																								</tr>";
																							}
																						}
																					}
																					echo "
																					</table>
																				</td>
																			</tr>

																			<input type='hidden' id='abjadL$no_ins1$no_kat1' value='$abjadNext'>
																			";

																			$no_kat1++;
																			$no_kat2 = $no_kat1;
																		}
																	}

																	echo "
																	<tr><td colspan='6'>&nbsp;</td></tr>
																	<tr><td colspan='6'><div class='hr hr-double hr-dotted hr18'></div></td></tr>
																	";

																	$abj_ins1 = chr(ord($abj_ins1)+1);
																	$no_ins1++;
																}
															}

															//-> KONDISI 1 INSTANSI
															else
															{
																$no_kat1 = 1;
																foreach($sub1 as $row)
																{
																	if($row->kategori == "1")
																	{
																		echo "
																		<input type='hidden' name='kategori[]' id='kategori-$no_kat1' value='$row->kategori'>
																		<input type='hidden' name='kode_pekerjaan[]' value='$row->kode_pekerjaan'>
																		<input type='hidden' name='jenis_pekerjaan[]' value='$row->jenis_pekerjaan'>
																		<input type='hidden' id='no-uraian-$no_kat1' value='$no_kat1'>

																		<tr>
																			<td class='c pad-3 pos-atas'> $no_kat1). </td>
																			<td class='b pad-3 u' colspan='5'> $row->jenis_pekerjaan </td>
																		</tr>
																		
																		<tr>
																			<td></td>
																			<td class='i b'> A. Tujuan Pemeriksaan : </td>
																			<td></td>
																			<td></td>
																			<td></td>
																			<td></td>
																		</tr>
																		
																		<tr>
																			<td colspan='6'>
																				<table width='100%' border='0' id='form_tjn$no_kat1'>";
																				foreach($sub2 as $row3)
																				{
																					if($row3->kode_uraian == "$no_kat1-A")
																					{
																						if($row3->no_kka == "a")
																						{
																							$abjadNext = 'b';

																							echo "
																							<tr class='bor-bot'>
																								<td width='3%'></td>
																								<td>
																									<input type='hidden' name='kode_periksa[]' value='A'>
																									<input type='hidden' name='no_ins[]' value='-'>
																									<input type='hidden' name='no_kat[]' value='$no_kat1'>

																									a. <textarea name='nama_periksa[]' rows='2' cols='37' style='color:black;' placeholder='Isi tujuan pemeriksaan'>$row3->uraian</textarea>
																									<button type='button' class='btn btn-xs btn-warning' onclick='tambahElemenTjn(\"$no_kat1\", \"$no_ins1\", \"$no_kat1\"); return false;' title='Tambah tujuan pemeriksaan'><i class='fa fa-plus'></i></button>
																								</td>
																								<td width='36%' class='pad-3'> </td>
																								<td width='14%' class='pad-3'> <input type='hidden' name='tanggal[]' value='-' /> </td>
																								<td width='7%' class='pad-3'> <input type='hidden' name='no_kka[]' value='a' /> </td>
																								<td width='7%' class='pad-3'> <input type='hidden' name='keterangan[]' value='-' /> </td>
																							</tr>";
																						}
																						else
																						{
																							$abjad = substr($row3->no_kka,-1);
																							$abjadNext = chr(ord($abjad)+1);

																							echo "
																							<tr id='ttjn_row-$no_kat1' class='bor-bot'>
																								<td width='3%'></td>
																								<td>
																									<input type='hidden' name='kode_periksa[]' value='A'>
																									<input type='hidden' name='no_ins[]' value='-'>
																									<input type='hidden' name='no_kat[]' value='$no_kat1'>
																									
																									$abjad. <textarea name='nama_periksa[]' rows='2' cols='37' style='color:black;' placeholder='Isi tujuan pemeriksaan'>$row3->uraian</textarea>
																									<button type='button' class='btn btn-xs btn-danger' onclick='hapusElemenTjn(\"#ttjn_row-$no_kat1\", \"$no_kat1\"); return false;' title='Hapus tujuan pemeriksaan'><i class='fa fa-minus'></i></button>
																								</td>
																								<td width='36%' class='pad-3'> </td>
																								<td width='14%' class='pad-3'> <input type='hidden' name='tanggal[]' value='-' /> </td>
																								<td width='7%' class='pad-3'> <input type='hidden' name='no_kka[]' value='$row3->no_kka' /> </td>
																								<td width='7%' class='pad-3'> <input type='hidden' name='keterangan[]' value='-' /> </td>
																							</tr>";
																						}
																					}
																				}
																				echo "
																				</table>
																			</td>
																		</tr>

																		<input type='hidden' id='abjadT$no_kat1' value='$abjadNext'>
																		
																		<tr>
																			<td></td>
																			<td class='i b'> B. Langkah Pemeriksaan : </td>
																			<td></td>
																			<td></td>
																			<td></td>
																			<td></td>
																		</tr>
																		
																		<tr>
																			<td colspan='6'>
																				<table width='100%' border='0' id='form_lkh$no_kat1'>";
																				foreach($sub2 as $row3)
																				{
																					if($row3->kode_uraian == "$no_kat1-B")
																					{
																						if($row3->no_kka == "$row->kategori.$no_kat1.a")
																						{
																							echo "
																							<tr class='bor-bot'>
																								<td width='3%'></td>
																								<td>
																									<input type='hidden' name='kode_periksa[]' value='B'>
																									<input type='hidden' name='no_ins[]' value='-'>
																									<input type='hidden' name='no_kat[]' value='$no_kat1'>
																									
																									a. <textarea name='nama_periksa[]' rows='2' cols='37' style='color:black;' placeholder='Isi langkah pemeriksaan'>$row3->uraian</textarea>
																									<button type='button' class='btn btn-xs btn-warning' onclick='tambahElemenLkh(\"$no_kat1\", \"$abj_ins1\", \"$no_ins1\", \"$no_kat1\"); return false;' title='Tambah langkah pemeriksaan'><i class='fa fa-plus'></i></button>
																								</td>
																								<td width='36%' class='pad-3'>";
																									foreach($sub3 as $row4)
																									{
																										if($row4->sub_no_kka == $row3->no_kka)
																										{
																											if($row4->nomor == 1)
																											{
																												$sub_kka = substr($row4->sub_no_kka, -1);
																												$pelaksana = $row4->pelaksana;

																												echo "
																												<input type='hidden' name='no_kka2[]' value='1.$no_kat1.$sub_kka'>
																												<input type='hidden' name='nomor[]' value='$row4->nomor'>
																												<select name='pelaksana[]'>
																													<option> -- Pilih Pelaksana -- </option>";
																													echo "<option value='$daltu->id_pegawai $no_kat1'"; if($pelaksana == $daltu->id_pegawai){ echo 'selected'; } echo "> $daltu->nama [DALTU] </option>";
																													echo "<option value='$dalnis->id_pegawai $no_kat1'"; if($pelaksana == $dalnis->id_pegawai){ echo 'selected'; } echo "> $dalnis->nama [DALNIS] </option>";
																													echo "<option value='$pegawai->id_pegawai $no_kat1'"; if($pelaksana == $pegawai->id_pegawai){ echo 'selected'; } echo "> $pegawai->nama [KETUA TIM] </option>";
																													foreach($anggota as $row2)
																													{	echo "<option value='$row2->anggota $no_kat1'"; if($pelaksana == $row2->anggota){ echo 'selected'; } echo "> $row2->nama [ANGGOTA] </option>"; }
																												echo "</select>

																												<button type='button' class='btn btn-xs btn-warning' onclick='tambahElemenAgt(\"$no_kat1-B-$sub_kka\", \"1.$no_kat1.a\", \"no-$no_kat1-B-a\"); return false;' title='Tambah pelaksana'><i class='fa fa-plus'></i></button> <br/><br/>
																												";
																											}
																											else
																											{
																												$sub_kka = substr($row4->sub_no_kka, -1);
																												$pelaksana = $row4->pelaksana;

																												echo "
																												<span id='ssrow-$no_kat1-B-$sub_kka-$row4->nomor'>
																												<input type='hidden' name='no_kka2[]' value='1.$no_kat1.$sub_kka'>
																												<input type='hidden' name='nomor[]' value='$row4->nomor'>
																												<select name='pelaksana[]'>
																													<option> -- Pilih Pelaksana -- </option>";
																													echo "<option value='$daltu->id_pegawai $no_kat1'"; if($pelaksana == $daltu->id_pegawai){ echo 'selected'; } echo "> $daltu->nama [DALTU] </option>";
																													echo "<option value='$dalnis->id_pegawai $no_kat1'"; if($pelaksana == $dalnis->id_pegawai){ echo 'selected'; } echo "> $dalnis->nama [DALNIS] </option>";
																													echo "<option value='$pegawai->id_pegawai $no_kat1'"; if($pelaksana == $pegawai->id_pegawai){ echo 'selected'; } echo "> $pegawai->nama [KETUA TIM] </option>";
																													foreach($anggota as $row2)
																													{	echo "<option value='$row2->anggota $no_kat1'"; if($pelaksana == $row2->anggota){ echo 'selected'; } echo "> $row2->nama [ANGGOTA] </option>"; }
																												echo "</select>

																												<button type='button' class='btn btn-xs btn-danger' onclick='hapusElemenAgt(\"#ssrow-$no_kat1-B-$sub_kka-$row4->nomor\", \"no-$no_kat1-B-a\"); return false;' title='Hapus pelaksana'><i class='fa fa-minus'></i></button> <br/><br/>
																												</span>
																												";
																											}
																											$noAkhir = $row4->nomor;
																										}
																									}
																									echo "
																									<div id='form_agt$no_kat1-B-$sub_kka'></div>
																									<input type='hidden' id='no-$no_kat1-B-a' value='$noAkhir'>
																								</td>
																								<td width='14%' class='pad-3'>
																									<div class='input-group date datepicker'>
																										<input type='text' name='tanggal[]' class='col-xs-10 col-sm-12' placeholder='Tanggal' readonly='' value='$row3->tgl_kerja' />
																										<span class='input-group-addon' title='Pilih Tanggal'><span class='ace-icon fa fa-calendar bigger-110'></span></span>
																									</div>
																								</td>
																								<td width='7%' class='pad-3'><input type='text' name='no_kka[]' class='col-xs-10 col-sm-12' placeholder='No KKA' value='$row3->no_kka' readOnly='' /></td>
																								<td width='7%' class='pad-3'><input type='text' name='keterangan[]' class='col-xs-10 col-sm-12' placeholder='Ket' value='$row3->keterangan' /></td>
																							</tr>";
																						}
																						else
																						{
																							$abjad = substr($row3->no_kka,-1);
																							$abjadNext = chr(ord($abjad)+1);
																							echo "
																							<tr id='llkh_row-$no_kat1' class='bor-bot'>
																								<td width='3%'></td>
																								<td>
																									<input type='hidden' name='kode_periksa[]' value='B'>
																									<input type='hidden' name='no_ins[]' value='-'>
																									<input type='hidden' name='no_kat[]' value='$no_kat1'>
																									
																									$abjad. <textarea name='nama_periksa[]' rows='2' cols='37' style='color:black;' placeholder='Isi langkah pemeriksaan'>$row3->uraian</textarea>
																									<button type='button' class='btn btn-xs btn-danger' onclick='hapusElemenLkh(\"#llkh_row-$no_kat1\", \"$no_kat1\"); return false;' title='Hapus langkah pemeriksaan'><i class='fa fa-minus'></i></button>
																								</td>
																								<td width='36%' class='pad-3'>";
																									foreach($sub3 as $row4)
																									{
																										if($row4->sub_no_kka == $row3->no_kka)
																										{
																											if($row4->nomor == 1)
																											{
																												$sub_kka = substr($row4->sub_no_kka, -1);
																												$pelaksana = $row4->pelaksana;

																												echo "
																												<input type='hidden' name='no_kka2[]' value='1.$no_kat1.$sub_kka'>
																												<input type='hidden' name='nomor[]' value='$row4->nomor'>
																												<select name='pelaksana[]'>
																													<option> -- Pilih Pelaksana -- </option>";
																													echo "<option value='$daltu->id_pegawai $no_kat1'"; if($pelaksana == $daltu->id_pegawai){ echo 'selected'; } echo "> $daltu->nama [DALTU] </option>";
																													echo "<option value='$dalnis->id_pegawai $no_kat1'"; if($pelaksana == $dalnis->id_pegawai){ echo 'selected'; } echo "> $dalnis->nama [DALNIS] </option>";
																													echo "<option value='$pegawai->id_pegawai $no_kat1'"; if($pelaksana == $pegawai->id_pegawai){ echo 'selected'; } echo "> $pegawai->nama [KETUA TIM] </option>";
																													foreach($anggota as $row2)
																													{	echo "<option value='$row2->anggota $no_kat1'"; if($pelaksana == $row2->anggota){ echo 'selected'; } echo "> $row2->nama [ANGGOTA] </option>"; }
																												echo "</select>

																												<button type='button' class='btn btn-xs btn-warning' onclick='tambahElemenAgt(\"$no_kat1-B-$sub_kka\", \"1.$no_kat1.$sub_kka\", \"no-$no_kat1-B-$abjad\"); return false;' title='Tambah pelaksana'><i class='fa fa-plus'></i></button> <br/><br/>
																												";
																											}
																											else
																											{
																												$sub_kka = substr($row4->sub_no_kka, -1);
																												$pelaksana = $row4->pelaksana;

																												echo "
																												<span id='ssrow-$no_kat1-B-$sub_kka-$row4->nomor'>
																												<input type='hidden' name='no_kka2[]' value='1.$no_kat1.$sub_kka'>
																												<input type='hidden' name='nomor[]' value='$row4->nomor'>
																												<select name='pelaksana[]'>
																													<option> -- Pilih Pelaksana -- </option>";
																													echo "<option value='$daltu->id_pegawai $no_kat1'"; if($pelaksana == $daltu->id_pegawai){ echo 'selected'; } echo "> $daltu->nama [DALTU] </option>";
																													echo "<option value='$dalnis->id_pegawai $no_kat1'"; if($pelaksana == $dalnis->id_pegawai){ echo 'selected'; } echo "> $dalnis->nama [DALNIS] </option>";
																													echo "<option value='$pegawai->id_pegawai $no_kat1'"; if($pelaksana == $pegawai->id_pegawai){ echo 'selected'; } echo "> $pegawai->nama [KETUA TIM] </option>";
																													foreach($anggota as $row2)
																													{	echo "<option value='$row2->anggota $no_kat1'"; if($pelaksana == $row2->anggota){ echo 'selected'; } echo "> $row2->nama [ANGGOTA] </option>"; }
																												echo "</select>

																												<button type='button' class='btn btn-xs btn-danger' onclick='hapusElemenAgt(\"#ssrow-$no_kat1-B-$sub_kka-$row4->nomor\", \"no-$no_kat1-B-$abjad\"); return false;' title='Hapus pelaksana'><i class='fa fa-minus'></i></button> <br/><br/>
																												</span>
																												";
																											}
																											$noAkhir = $row4->nomor;
																										}
																									}
																									echo "
																									<div id='form_agt$no_kat1-B-$sub_kka'></div>
																									<input type='hidden' id='no-$no_kat1-B-$abjad' value='$noAkhir'>
																								</td>
																								<td width='14%' class='pad-3'>
																									<div class='input-group date datepicker'>
																										<input type='text' name='tanggal[]' class='col-xs-10 col-sm-12' placeholder='Tanggal' readonly='' value='$row3->tgl_kerja' />
																										<span class='input-group-addon' title='Pilih Tanggal'><span class='ace-icon fa fa-calendar bigger-110'></span></span>
																									</div>
																								</td>
																								<td width='7%' class='pad-3'><input type='text' name='no_kka[]' class='col-xs-10 col-sm-12' placeholder='No KKA' value='$row3->no_kka' readOnly='' /></td>
																								<td width='7%' class='pad-3'><input type='text' name='keterangan[]' class='col-xs-10 col-sm-12' placeholder='Ket' value='$row3->keterangan' /></td>
																							</tr>";
																						}
																					}
																				}
																				echo "
																				</table>
																			</td>
																		</tr>

																		<input type='hidden' id='abjadL$no_kat1' value='$abjadNext'>
																		";

																		$no_kat1++;
																		$no_kat2 = $no_kat1;
																	}
																}
															}

															##########################################
															//--> BATAS KATEGORI
															##########################################

															echo "
															<tr><td colspan='6'>&nbsp;</td></tr>
															<tr><td colspan='6'><h4 class='b u'> 2. PELAKSANAAN AUDIT : </h4></td></tr>";

															//-> KONDISI LEBIH DARI 1 INSTANSI
															if(count($sasaran) != 0)
															{
																$abj_ins2 = 'A';
																$no_ins2  = 1;
																foreach($ins as $key)
																{
																	echo "
																	<tr>
																		<td class='c pad-3 pos-atas'><h5 class='b'> $abj_ins2). </h5></td>
																		<td class='pad-3' colspan='5'><h5 class='b u'> $key->nama_instansi </h5></td>
																	</tr>";

																	$no_kategori = 1;
																	foreach($sub1 as $row)
																	{
																		if($row->kategori == "2" && $row->nama_instansi == $key->nama_instansi)
																		{
																			echo "
																			<input type='hidden' name='kategori[]' id='kategori-$no_kat2' value='$row->kategori'>
																			<input type='hidden' name='kode_pekerjaan[]' value='$row->kode_pekerjaan'>
																			<input type='hidden' name='jenis_pekerjaan[]' value='$row->jenis_pekerjaan'>
																			<input type='hidden' name='nama_instansi[]' value='$row->nama_instansi'>
																			<input type='hidden' id='no-uraian-$no_kat2' value='$no_kategori'>

																			<tr>
																				<td class='c pad-3 pos-atas'> $no_kategori). </td>
																				<td class='b pad-3 u' colspan='5'> $row->jenis_pekerjaan </td>
																			</tr>
																			
																			<tr>
																				<td></td>
																				<td class='i b'> A. Tujuan Pemeriksaan : </td>
																				<td></td>
																				<td></td>
																				<td></td>
																				<td></td>
																			</tr>
																			
																			<tr>
																				<td colspan='6'>
																					<table width='100%' border='0' id='form_tjn$no_ins2$no_kat2'>";
																					foreach($sub2 as $row3)
																					{
																						if($row3->kode_uraian == "$no_ins2-$no_kat2-A")
																						{
																							if($row3->no_kka == "a")
																							{
																								$abjadNext = 'b';

																								echo "
																								<tr class='bor-bot'>
																									<td width='3%'></td>
																									<td>
																										<input type='hidden' name='kode_periksa[]' value='A'>
																										<input type='hidden' name='no_ins[]' value='$no_ins2'>
																										<input type='hidden' name='no_kat[]' value='$no_kat2'>

																										a. <textarea name='nama_periksa[]' rows='2' cols='37' style='color:black;' placeholder='Isi tujuan pemeriksaan'>$row3->uraian</textarea>
																										<button type='button' class='btn btn-xs btn-warning' onclick='tambahElemenTjn(\"$no_kat2\", \"$no_ins2\", \"$no_ins2$no_kat2\"); return false;' title='Tambah tujuan pemeriksaan'><i class='fa fa-plus'></i></button>
																									</td>
																									<td width='36%' class='pad-3'> </td>
																									<td width='14%' class='pad-3'> <input type='hidden' name='tanggal[]' value='-' /> </td>
																									<td width='7%' class='pad-3'> <input type='hidden' name='no_kka[]' value='a' /> </td>
																									<td width='7%' class='pad-3'> <input type='hidden' name='keterangan[]' value='-' /> </td>
																								</tr>";
																							}
																							else
																							{
																								$abjad = substr($row3->no_kka,-1);
																								$abjadNext = chr(ord($abjad)+1);

																								echo "
																								<tr id='ttjn_row-$no_ins2$no_kat2' class='bor-bot'>
																									<td width='3%'></td>
																									<td>
																										<input type='hidden' name='kode_periksa[]' value='A'>
																										<input type='hidden' name='no_ins[]' value='$no_ins2'>
																										<input type='hidden' name='no_kat[]' value='$no_kat2'>
																										
																										$abjad. <textarea name='nama_periksa[]' rows='2' cols='37' style='color:black;' placeholder='Isi tujuan pemeriksaan'>$row3->uraian</textarea>
																										<button type='button' class='btn btn-xs btn-danger' onclick='hapusElemenTjn(\"#ttjn_row-$no_ins2$no_kat2\", \"$no_ins2$no_kat2\"); return false;' title='Hapus tujuan pemeriksaan'><i class='fa fa-minus'></i></button>
																									</td>
																									<td width='36%' class='pad-3'> </td>
																									<td width='14%' class='pad-3'> <input type='hidden' name='tanggal[]' value='-' /> </td>
																									<td width='7%' class='pad-3'> <input type='hidden' name='no_kka[]' value='$row3->no_kka' /> </td>
																									<td width='7%' class='pad-3'> <input type='hidden' name='keterangan[]' value='-' /> </td>
																								</tr>";
																							}
																						}
																					}
																					echo "
																					</table>
																				</td>
																			</tr>

																			<input type='hidden' id='abjadT$no_ins2$no_kat2' value='$abjadNext'>
																			
																			<tr>
																				<td></td>
																				<td class='i b'> B. Langkah Pemeriksaan : </td>
																				<td></td>
																				<td></td>
																				<td></td>
																				<td></td>
																			</tr>
																			
																			<tr>
																				<td colspan='6'>
																					<table width='100%' border='0' id='form_lkh$no_ins2$no_kat2'>";
																					foreach($sub2 as $row3)
																					{
																						if($row3->kode_uraian == "$no_ins2-$no_kat2-B")
																						{
																							if($row3->no_kka == "$row->kategori.$abj_ins2.$no_kategori.a")
																							{
																								echo "
																								<tr class='bor-bot'>
																									<td width='3%'></td>
																									<td>
																										<input type='hidden' name='kode_periksa[]' value='B'>
																										<input type='hidden' name='no_ins[]' value='$no_ins2'>
																										<input type='hidden' name='no_kat[]' value='$no_kat2'>
																										
																										a. <textarea name='nama_periksa[]' rows='2' cols='37' style='color:black;' placeholder='Isi langkah pemeriksaan'>$row3->uraian</textarea>
																										<button type='button' class='btn btn-xs btn-warning' onclick='tambahElemenLkh(\"$no_kat2\", \"$abj_ins2\", \"$no_ins2\", \"$no_ins2$no_kat2\"); return false;' title='Tambah langkah pemeriksaan'><i class='fa fa-plus'></i></button>
																									</td>
																									<td width='36%' class='pad-3'>";
																										foreach($sub3 as $row4)
																										{
																											if($row4->sub_no_kka == $row3->no_kka)
																											{
																												if($row4->nomor == 1)
																												{
																													$sub_kka = substr($row4->sub_no_kka, -1);
																													$pelaksana = $row4->pelaksana;

																													echo "
																													<input type='hidden' name='no_kka2[]' value='2.$abj_ins2.$no_kategori.$sub_kka'>
																													<input type='hidden' name='nomor[]' value='$row4->nomor'>
																													<select name='pelaksana[]'>
																														<option> -- Pilih Pelaksana -- </option>";
																														echo "<option value='$daltu->id_pegawai $no_kat2'"; if($pelaksana == $daltu->id_pegawai){ echo 'selected'; } echo "> $daltu->nama [DALTU] </option>";
																														echo "<option value='$dalnis->id_pegawai $no_kat2'"; if($pelaksana == $dalnis->id_pegawai){ echo 'selected'; } echo "> $dalnis->nama [DALNIS] </option>";
																														echo "<option value='$pegawai->id_pegawai $no_kat2'"; if($pelaksana == $pegawai->id_pegawai){ echo 'selected'; } echo "> $pegawai->nama [KETUA TIM] </option>";
																														foreach($anggota as $row2)
																														{	echo "<option value='$row2->anggota $no_kat2'"; if($pelaksana == $row2->anggota){ echo 'selected'; } echo "> $row2->nama [ANGGOTA] </option>"; }
																													echo "</select>

																													<button type='button' class='btn btn-xs btn-warning' onclick='tambahElemenAgt(\"$no_ins2$no_kat2-B-$sub_kka\", \"2.$abj_ins2.$no_kategori.a\", \"no-$no_ins2$no_kat2-B-a\"); return false;' title='Tambah pelaksana'><i class='fa fa-plus'></i></button> <br/><br/>
																													";
																												}
																												else
																												{
																													$sub_kka = substr($row4->sub_no_kka, -1);
																													$pelaksana = $row4->pelaksana;

																													echo "
																													<span id='ssrow-$no_ins2$no_kat2-B-$sub_kka-$row4->nomor'>
																													<input type='hidden' name='no_kka2[]' value='2.$abj_ins2.$no_kategori.$sub_kka'>
																													<input type='hidden' name='nomor[]' value='$row4->nomor'>
																													<select name='pelaksana[]'>
																														<option> -- Pilih Pelaksana -- </option>";
																														echo "<option value='$daltu->id_pegawai $no_kat2'"; if($pelaksana == $daltu->id_pegawai){ echo 'selected'; } echo "> $daltu->nama [DALTU] </option>";
																														echo "<option value='$dalnis->id_pegawai $no_kat2'"; if($pelaksana == $dalnis->id_pegawai){ echo 'selected'; } echo "> $dalnis->nama [DALNIS] </option>";
																														echo "<option value='$pegawai->id_pegawai $no_kat2'"; if($pelaksana == $pegawai->id_pegawai){ echo 'selected'; } echo "> $pegawai->nama [KETUA TIM] </option>";
																														foreach($anggota as $row2)
																														{	echo "<option value='$row2->anggota $no_kat2'"; if($pelaksana == $row2->anggota){ echo 'selected'; } echo "> $row2->nama [ANGGOTA] </option>"; }
																													echo "</select>

																													<button type='button' class='btn btn-xs btn-danger' onclick='hapusElemenAgt(\"#ssrow-$no_ins2$no_kat2-B-$sub_kka-$row4->nomor\", \"no-$no_ins2$no_kat2-B-a\"); return false;' title='Hapus pelaksana'><i class='fa fa-minus'></i></button> <br/><br/>
																													</span>
																													";
																												}
																												$noAkhir = $row4->nomor;
																											}
																										}
																										echo "
																										<div id='form_agt$no_ins2$no_kat2-B-$sub_kka'></div>
																										<input type='hidden' id='no-$no_ins2$no_kat2-B-a' value='$noAkhir'>
																									</td>
																									<td width='14%' class='pad-3'>
																										<div class='input-group date datepicker'>
																											<input type='text' name='tanggal[]' class='col-xs-10 col-sm-12' placeholder='Tanggal' readonly='' value='$row3->tgl_kerja' />
																											<span class='input-group-addon' title='Pilih Tanggal'><span class='ace-icon fa fa-calendar bigger-110'></span></span>
																										</div>
																									</td>
																									<td width='7%' class='pad-3'><input type='text' name='no_kka[]' class='col-xs-10 col-sm-12' placeholder='No KKA' value='$row3->no_kka' readOnly='' /></td>
																									<td width='7%' class='pad-3'><input type='text' name='keterangan[]' class='col-xs-10 col-sm-12' placeholder='Ket' value='$row3->keterangan' /></td>
																								</tr>";
																							}
																							else
																							{
																								$abjad = substr($row3->no_kka,-1);
																								$abjadNext = chr(ord($abjad)+1);
																								echo "
																								<tr id='llkh_row-$no_ins2$no_kat2' class='bor-bot'>
																									<td width='3%'></td>
																									<td>
																										<input type='hidden' name='kode_periksa[]' value='B'>
																										<input type='hidden' name='no_ins[]' value='$no_ins2'>
																										<input type='hidden' name='no_kat[]' value='$no_kat2'>
																										
																										$abjad. <textarea name='nama_periksa[]' rows='2' cols='37' style='color:black;' placeholder='Isi langkah pemeriksaan'>$row3->uraian</textarea>
																										<button type='button' class='btn btn-xs btn-danger' onclick='hapusElemenLkh(\"#llkh_row-$no_ins2$no_kat2\", \"$no_ins2$no_kat2\"); return false;' title='Hapus langkah pemeriksaan'><i class='fa fa-minus'></i></button>
																									</td>
																									<td width='36%' class='pad-3'>";
																										foreach($sub3 as $row4)
																										{
																											if($row4->sub_no_kka == $row3->no_kka)
																											{
																												if($row4->nomor == 1)
																												{
																													$sub_kka = substr($row4->sub_no_kka, -1);
																													$pelaksana = $row4->pelaksana;

																													echo "
																													<input type='hidden' name='no_kka2[]' value='2.$abj_ins2.$no_kategori.$sub_kka'>
																													<input type='hidden' name='nomor[]' value='$row4->nomor'>
																													<select name='pelaksana[]'>
																														<option> -- Pilih Pelaksana -- </option>";
																														echo "<option value='$daltu->id_pegawai $no_kat2'"; if($pelaksana == $daltu->id_pegawai){ echo 'selected'; } echo "> $daltu->nama [DALTU] </option>";
																														echo "<option value='$dalnis->id_pegawai $no_kat2'"; if($pelaksana == $dalnis->id_pegawai){ echo 'selected'; } echo "> $dalnis->nama [DALNIS] </option>";
																														echo "<option value='$pegawai->id_pegawai $no_kat2'"; if($pelaksana == $pegawai->id_pegawai){ echo 'selected'; } echo "> $pegawai->nama [KETUA TIM] </option>";
																														foreach($anggota as $row2)
																														{	echo "<option value='$row2->anggota $no_kat2'"; if($pelaksana == $row2->anggota){ echo 'selected'; } echo "> $row2->nama [ANGGOTA] </option>"; }
																													echo "</select>

																													<button type='button' class='btn btn-xs btn-warning' onclick='tambahElemenAgt(\"$no_ins2$no_kat2-B-$sub_kka\", \"2.$abj_ins2.$no_kategori.$sub_kka\", \"no-$no_ins2$no_kat2-B-$abjad\"); return false;' title='Tambah pelaksana'><i class='fa fa-plus'></i></button> <br/><br/>
																													";
																												}
																												else
																												{
																													$sub_kka = substr($row4->sub_no_kka, -1);
																													$pelaksana = $row4->pelaksana;

																													echo "
																													<span id='ssrow-$no_ins2$no_kat2-B-$sub_kka-$row4->nomor'>
																													<input type='hidden' name='no_kka2[]' value='2.$abj_ins2.$no_kategori.$sub_kka'>
																													<input type='hidden' name='nomor[]' value='$row4->nomor'>
																													<select name='pelaksana[]'>
																														<option> -- Pilih Pelaksana -- </option>";
																														echo "<option value='$daltu->id_pegawai $no_kat2'"; if($pelaksana == $daltu->id_pegawai){ echo 'selected'; } echo "> $daltu->nama [DALTU] </option>";
																														echo "<option value='$dalnis->id_pegawai $no_kat2'"; if($pelaksana == $dalnis->id_pegawai){ echo 'selected'; } echo "> $dalnis->nama [DALNIS] </option>";
																														echo "<option value='$pegawai->id_pegawai $no_kat2'"; if($pelaksana == $pegawai->id_pegawai){ echo 'selected'; } echo "> $pegawai->nama [KETUA TIM] </option>";
																														foreach($anggota as $row2)
																														{	echo "<option value='$row2->anggota $no_kat2'"; if($pelaksana == $row2->anggota){ echo 'selected'; } echo "> $row2->nama [ANGGOTA] </option>"; }
																													echo "</select>

																													<button type='button' class='btn btn-xs btn-danger' onclick='hapusElemenAgt(\"#ssrow-$no_ins2$no_kat2-B-$sub_kka-$row4->nomor\", \"no-$no_ins2$no_kat2-B-$abjad\"); return false;' title='Hapus pelaksana'><i class='fa fa-minus'></i></button> <br/><br/>
																													</span>
																													";
																												}
																												$noAkhir = $row4->nomor;
																											}
																										}
																										echo "
																										<div id='form_agt$no_ins2$no_kat2-B-$sub_kka'></div>
																										<input type='hidden' id='no-$no_ins2$no_kat2-B-$abjad' value='$noAkhir'>
																									</td>
																									<td width='14%' class='pad-3'>
																										<div class='input-group date datepicker'>
																											<input type='text' name='tanggal[]' class='col-xs-10 col-sm-12' placeholder='Tanggal' readonly='' value='$row3->tgl_kerja' />
																											<span class='input-group-addon' title='Pilih Tanggal'><span class='ace-icon fa fa-calendar bigger-110'></span></span>
																										</div>
																									</td>
																									<td width='7%' class='pad-3'><input type='text' name='no_kka[]' class='col-xs-10 col-sm-12' placeholder='No KKA' value='$row3->no_kka' readOnly='' /></td>
																									<td width='7%' class='pad-3'><input type='text' name='keterangan[]' class='col-xs-10 col-sm-12' placeholder='Ket' value='$row3->keterangan' /></td>
																								</tr>";
																							}
																						}
																					}
																					echo "
																					</table>
																				</td>
																			</tr>

																			<input type='hidden' id='abjadL$no_ins2$no_kat2' value='$abjadNext'>
																			";

																			$no_kategori++;
																			$no_kat2++;
																			$no_kat3 = $no_kat2;
																		}
																	}

																	echo "
																	<tr><td colspan='6'>&nbsp;</td></tr>
																	<tr><td colspan='6'><div class='hr hr-double hr-dotted hr18'></div></td></tr>
																	";

																	$abj_ins2 = chr(ord($abj_ins2)+1);
																	$no_ins2++;
																}
															}

															//-> KONDISI 1 INSTANSI
															else
															{
																$no_kategori = 1;
																foreach($sub1 as $row)
																{
																	if($row->kategori == "2")
																	{
																		echo "
																		<input type='hidden' name='kategori[]' id='kategori-$no_kat2' value='$row->kategori'>
																		<input type='hidden' name='kode_pekerjaan[]' value='$row->kode_pekerjaan'>
																		<input type='hidden' name='jenis_pekerjaan[]' value='$row->jenis_pekerjaan'>
																		<input type='hidden' id='no-uraian-$no_kat2' value='$no_kategori'>

																		<tr>
																			<td class='c pad-3 pos-atas'> $no_kategori). </td>
																			<td class='b pad-3 u' colspan='5'> $row->jenis_pekerjaan </td>
																		</tr>
																		
																		<tr>
																			<td></td>
																			<td class='i b'> A. Tujuan Pemeriksaan : </td>
																			<td></td>
																			<td></td>
																			<td></td>
																			<td></td>
																		</tr>
																		
																		<tr>
																			<td colspan='6'>
																				<table width='100%' border='0' id='form_tjn$no_kat2'>";
																				foreach($sub2 as $row3)
																				{
																					if($row3->kode_uraian == "$no_kat2-A")
																					{
																						if($row3->no_kka == "a")
																						{
																							$abjadNext = 'b';

																							echo "
																							<tr class='bor-bot'>
																								<td width='3%'></td>
																								<td>
																									<input type='hidden' name='kode_periksa[]' value='A'>
																									<input type='hidden' name='no_ins[]' value='-'>
																									<input type='hidden' name='no_kat[]' value='$no_kat2'>

																									a. <textarea name='nama_periksa[]' rows='2' cols='37' style='color:black;' placeholder='Isi tujuan pemeriksaan'>$row3->uraian</textarea>
																									<button type='button' class='btn btn-xs btn-warning' onclick='tambahElemenTjn(\"$no_kat2\", \"$no_ins2\", \"$no_kat2\"); return false;' title='Tambah tujuan pemeriksaan'><i class='fa fa-plus'></i></button>
																								</td>
																								<td width='36%' class='pad-3'> </td>
																								<td width='14%' class='pad-3'> <input type='hidden' name='tanggal[]' value='-' /> </td>
																								<td width='7%' class='pad-3'> <input type='hidden' name='no_kka[]' value='a' /> </td>
																								<td width='7%' class='pad-3'> <input type='hidden' name='keterangan[]' value='-' /> </td>
																							</tr>";
																						}
																						else
																						{
																							$abjad = substr($row3->no_kka,-1);
																							$abjadNext = chr(ord($abjad)+1);

																							echo "
																							<tr id='ttjn_row-$no_kat2' class='bor-bot'>
																								<td width='3%'></td>
																								<td>
																									<input type='hidden' name='kode_periksa[]' value='A'>
																									<input type='hidden' name='no_ins[]' value='-'>
																									<input type='hidden' name='no_kat[]' value='$no_kat2'>
																									
																									$abjad. <textarea name='nama_periksa[]' rows='2' cols='37' style='color:black;' placeholder='Isi tujuan pemeriksaan'>$row3->uraian</textarea>
																									<button type='button' class='btn btn-xs btn-danger' onclick='hapusElemenTjn(\"#ttjn_row-$no_kat2\", \"$no_kat2\"); return false;' title='Hapus tujuan pemeriksaan'><i class='fa fa-minus'></i></button>
																								</td>
																								<td width='36%' class='pad-3'> </td>
																								<td width='14%' class='pad-3'> <input type='hidden' name='tanggal[]' value='-' /> </td>
																								<td width='7%' class='pad-3'> <input type='hidden' name='no_kka[]' value='$row3->no_kka' /> </td>
																								<td width='7%' class='pad-3'> <input type='hidden' name='keterangan[]' value='-' /> </td>
																							</tr>";
																						}
																					}
																				}
																				echo "
																				</table>
																			</td>
																		</tr>

																		<input type='hidden' id='abjadT$no_kat2' value='$abjadNext'>
																		
																		<tr>
																			<td></td>
																			<td class='i b'> B. Langkah Pemeriksaan : </td>
																			<td></td>
																			<td></td>
																			<td></td>
																			<td></td>
																		</tr>
																		
																		<tr>
																			<td colspan='6'>
																				<table width='100%' border='0' id='form_lkh$no_kat2'>";
																				foreach($sub2 as $row3)
																				{
																					if($row3->kode_uraian == "$no_kat2-B")
																					{
																						if($row3->no_kka == "$row->kategori.$no_kategori.a")
																						{
																							echo "
																							<tr class='bor-bot'>
																								<td width='3%'></td>
																								<td>
																									<input type='hidden' name='kode_periksa[]' value='B'>
																									<input type='hidden' name='no_ins[]' value='-'>
																									<input type='hidden' name='no_kat[]' value='$no_kat2'>
																									
																									a. <textarea name='nama_periksa[]' rows='2' cols='37' style='color:black;' placeholder='Isi langkah pemeriksaan'>$row3->uraian</textarea>
																									<button type='button' class='btn btn-xs btn-warning' onclick='tambahElemenLkh(\"$no_kat2\", \"$abj_ins2\", \"$no_ins2\", \"$no_kat2\"); return false;' title='Tambah langkah pemeriksaan'><i class='fa fa-plus'></i></button>
																								</td>
																								<td width='36%' class='pad-3'>";
																									foreach($sub3 as $row4)
																									{
																										if($row4->sub_no_kka == $row3->no_kka)
																										{
																											if($row4->nomor == 1)
																											{
																												$sub_kka = substr($row4->sub_no_kka, -1);
																												$pelaksana = $row4->pelaksana;

																												echo "
																												<input type='hidden' name='no_kka2[]' value='2.$no_kategori.$sub_kka'>
																												<input type='hidden' name='nomor[]' value='$row4->nomor'>
																												<select name='pelaksana[]'>
																													<option> -- Pilih Pelaksana -- </option>";
																													echo "<option value='$daltu->id_pegawai $no_kat2'"; if($pelaksana == $daltu->id_pegawai){ echo 'selected'; } echo "> $daltu->nama [DALTU] </option>";
																													echo "<option value='$dalnis->id_pegawai $no_kat2'"; if($pelaksana == $dalnis->id_pegawai){ echo 'selected'; } echo "> $dalnis->nama [DALNIS] </option>";
																													echo "<option value='$pegawai->id_pegawai $no_kat2'"; if($pelaksana == $pegawai->id_pegawai){ echo 'selected'; } echo "> $pegawai->nama [KETUA TIM] </option>";
																													foreach($anggota as $row2)
																													{	echo "<option value='$row2->anggota $no_kat2'"; if($pelaksana == $row2->anggota){ echo 'selected'; } echo "> $row2->nama [ANGGOTA] </option>"; }
																												echo "</select>

																												<button type='button' class='btn btn-xs btn-warning' onclick='tambahElemenAgt(\"$no_kat2-B-$sub_kka\", \"2.$no_kategori.a\", \"no-$no_kat2-B-a\"); return false;' title='Tambah pelaksana'><i class='fa fa-plus'></i></button> <br/><br/>
																												";
																											}
																											else
																											{
																												$sub_kka = substr($row4->sub_no_kka, -1);
																												$pelaksana = $row4->pelaksana;

																												echo "
																												<span id='ssrow-$no_kat2-B-$sub_kka-$row4->nomor'>
																												<input type='hidden' name='no_kka2[]' value='2.$no_kategori.$sub_kka'>
																												<input type='hidden' name='nomor[]' value='$row4->nomor'>
																												<select name='pelaksana[]'>
																													<option> -- Pilih Pelaksana -- </option>";
																													echo "<option value='$daltu->id_pegawai $no_kat2'"; if($pelaksana == $daltu->id_pegawai){ echo 'selected'; } echo "> $daltu->nama [DALTU] </option>";
																													echo "<option value='$dalnis->id_pegawai $no_kat2'"; if($pelaksana == $dalnis->id_pegawai){ echo 'selected'; } echo "> $dalnis->nama [DALNIS] </option>";
																													echo "<option value='$pegawai->id_pegawai $no_kat2'"; if($pelaksana == $pegawai->id_pegawai){ echo 'selected'; } echo "> $pegawai->nama [KETUA TIM] </option>";
																													foreach($anggota as $row2)
																													{	echo "<option value='$row2->anggota $no_kat2'"; if($pelaksana == $row2->anggota){ echo 'selected'; } echo "> $row2->nama [ANGGOTA] </option>"; }
																												echo "</select>

																												<button type='button' class='btn btn-xs btn-danger' onclick='hapusElemenAgt(\"#ssrow-$no_kat2-B-$sub_kka-$row4->nomor\", \"no-$no_kat2-B-a\"); return false;' title='Hapus pelaksana'><i class='fa fa-minus'></i></button> <br/><br/>
																												</span>
																												";
																											}
																											$noAkhir = $row4->nomor;
																										}
																									}
																									echo "
																									<div id='form_agt$no_kat2-B-$sub_kka'></div>
																									<input type='hidden' id='no-$no_kat2-B-a' value='$noAkhir'>
																								</td>
																								<td width='14%' class='pad-3'>
																									<div class='input-group date datepicker'>
																										<input type='text' name='tanggal[]' class='col-xs-10 col-sm-12' placeholder='Tanggal' readonly='' value='$row3->tgl_kerja' />
																										<span class='input-group-addon' title='Pilih Tanggal'><span class='ace-icon fa fa-calendar bigger-110'></span></span>
																									</div>
																								</td>
																								<td width='7%' class='pad-3'><input type='text' name='no_kka[]' class='col-xs-10 col-sm-12' placeholder='No KKA' value='$row3->no_kka' readOnly='' /></td>
																								<td width='7%' class='pad-3'><input type='text' name='keterangan[]' class='col-xs-10 col-sm-12' placeholder='Ket' value='$row3->keterangan' /></td>
																							</tr>";
																						}
																						else
																						{
																							$abjad = substr($row3->no_kka,-1);
																							$abjadNext = chr(ord($abjad)+1);
																							echo "
																							<tr id='llkh_row-$no_kat2' class='bor-bot'>
																								<td width='3%'></td>
																								<td>
																									<input type='hidden' name='kode_periksa[]' value='B'>
																									<input type='hidden' name='no_ins[]' value='-'>
																									<input type='hidden' name='no_kat[]' value='$no_kat2'>
																									
																									$abjad. <textarea name='nama_periksa[]' rows='2' cols='37' style='color:black;' placeholder='Isi langkah pemeriksaan'>$row3->uraian</textarea>
																									<button type='button' class='btn btn-xs btn-danger' onclick='hapusElemenLkh(\"#llkh_row-$no_kat2\", \"$no_kat2\"); return false;' title='Hapus langkah pemeriksaan'><i class='fa fa-minus'></i></button>
																								</td>
																								<td width='36%' class='pad-3'>";
																									foreach($sub3 as $row4)
																									{
																										if($row4->sub_no_kka == $row3->no_kka)
																										{
																											if($row4->nomor == 1)
																											{
																												$sub_kka = substr($row4->sub_no_kka, -1);
																												$pelaksana = $row4->pelaksana;

																												echo "
																												<input type='hidden' name='no_kka2[]' value='2.$no_kategori.$sub_kka'>
																												<input type='hidden' name='nomor[]' value='$row4->nomor'>
																												<select name='pelaksana[]'>
																													<option> -- Pilih Pelaksana -- </option>";
																													echo "<option value='$daltu->id_pegawai $no_kat2'"; if($pelaksana == $daltu->id_pegawai){ echo 'selected'; } echo "> $daltu->nama [DALTU] </option>";
																													echo "<option value='$dalnis->id_pegawai $no_kat2'"; if($pelaksana == $dalnis->id_pegawai){ echo 'selected'; } echo "> $dalnis->nama [DALNIS] </option>";
																													echo "<option value='$pegawai->id_pegawai $no_kat2'"; if($pelaksana == $pegawai->id_pegawai){ echo 'selected'; } echo "> $pegawai->nama [KETUA TIM] </option>";
																													foreach($anggota as $row2)
																													{	echo "<option value='$row2->anggota $no_kat2'"; if($pelaksana == $row2->anggota){ echo 'selected'; } echo "> $row2->nama [ANGGOTA] </option>"; }
																												echo "</select>

																												<button type='button' class='btn btn-xs btn-warning' onclick='tambahElemenAgt(\"$no_kat2-B-$sub_kka\", \"2.$no_kategori.$sub_kka\", \"no-$no_kat2-B-$abjad\"); return false;' title='Tambah pelaksana'><i class='fa fa-plus'></i></button> <br/><br/>
																												";
																											}
																											else
																											{
																												$sub_kka = substr($row4->sub_no_kka, -1);
																												$pelaksana = $row4->pelaksana;

																												echo "
																												<span id='ssrow-$no_kat2-B-$sub_kka-$row4->nomor'>
																												<input type='hidden' name='no_kka2[]' value='2.$no_kategori.$sub_kka'>
																												<input type='hidden' name='nomor[]' value='$row4->nomor'>
																												<select name='pelaksana[]'>
																													<option> -- Pilih Pelaksana -- </option>";
																													echo "<option value='$daltu->id_pegawai $no_kat2'"; if($pelaksana == $daltu->id_pegawai){ echo 'selected'; } echo "> $daltu->nama [DALTU] </option>";
																													echo "<option value='$dalnis->id_pegawai $no_kat2'"; if($pelaksana == $dalnis->id_pegawai){ echo 'selected'; } echo "> $dalnis->nama [DALNIS] </option>";
																													echo "<option value='$pegawai->id_pegawai $no_kat2'"; if($pelaksana == $pegawai->id_pegawai){ echo 'selected'; } echo "> $pegawai->nama [KETUA TIM] </option>";
																													foreach($anggota as $row2)
																													{	echo "<option value='$row2->anggota $no_kat2'"; if($pelaksana == $row2->anggota){ echo 'selected'; } echo "> $row2->nama [ANGGOTA] </option>"; }
																												echo "</select>

																												<button type='button' class='btn btn-xs btn-danger' onclick='hapusElemenAgt(\"#ssrow-$no_kat2-B-$sub_kka-$row4->nomor\", \"no-$no_kat2-B-$abjad\"); return false;' title='Hapus pelaksana'><i class='fa fa-minus'></i></button> <br/><br/>
																												</span>
																												";
																											}
																											$noAkhir = $row4->nomor;
																										}
																									}
																									echo "
																									<div id='form_agt$no_kat2-B-$sub_kka'></div>
																									<input type='hidden' id='no-$no_kat2-B-$abjad' value='$noAkhir'>
																								</td>
																								<td width='14%' class='pad-3'>
																									<div class='input-group date datepicker'>
																										<input type='text' name='tanggal[]' class='col-xs-10 col-sm-12' placeholder='Tanggal' readonly='' value='$row3->tgl_kerja' />
																										<span class='input-group-addon' title='Pilih Tanggal'><span class='ace-icon fa fa-calendar bigger-110'></span></span>
																									</div>
																								</td>
																								<td width='7%' class='pad-3'><input type='text' name='no_kka[]' class='col-xs-10 col-sm-12' placeholder='No KKA' value='$row3->no_kka' readOnly='' /></td>
																								<td width='7%' class='pad-3'><input type='text' name='keterangan[]' class='col-xs-10 col-sm-12' placeholder='Ket' value='$row3->keterangan' /></td>
																							</tr>";
																						}
																					}
																				}
																				echo "
																				</table>
																			</td>
																		</tr>

																		<input type='hidden' id='abjadL$no_kat2' value='$abjadNext'>
																		";

																		$no_kategori++;
																		$no_kat2++;
																		$no_kat3 = $no_kat2;
																	}
																}
															}

															##########################################
															//--> BATAS KATEGORI
															##########################################

															echo "
															<tr><td colspan='6'>&nbsp;</td></tr>
															<tr><td colspan='6'><h4 class='b u'> 3. PENYELESAIAN AUDIT : </h4></td></tr>
															";

															//-> KONDISI LEBIH DARI 1 INSTANSI
															if(count($sasaran) != 0)
															{
																$abj_ins3 = 'A';
																$no_ins3  = 1;
																foreach($ins as $key)
																{
																	echo "
																	<tr>
																		<td class='c pad-3 pos-atas'><h5 class='b'> $abj_ins3). </h5></td>
																		<td class='pad-3' colspan='5'><h5 class='b u'> $key->nama_instansi </h5></td>
																	</tr>";

																	$no_kategori2 = 1;
																	foreach($sub1 as $row)
																	{
																		if($row->kategori == "3" && $row->nama_instansi == $key->nama_instansi)
																		{
																			echo "
																			<input type='hidden' name='kategori[]' id='kategori-$no_kat3' value='$row->kategori'>
																			<input type='hidden' name='kode_pekerjaan[]' value='$row->kode_pekerjaan'>
																			<input type='hidden' name='jenis_pekerjaan[]' value='$row->jenis_pekerjaan'>
																			<input type='hidden' name='nama_instansi[]' value='$row->nama_instansi'>
																			<input type='hidden' id='no-uraian-$no_kat3' value='$no_kategori2'>

																			<tr>
																				<td class='c pad-3 pos-atas'> $no_kategori2). </td>
																				<td class='b pad-3 u' colspan='5'> $row->jenis_pekerjaan </td>
																			</tr>
																			
																			<tr>
																				<td></td>
																				<td class='i b'> A. Tujuan Pemeriksaan : </td>
																				<td></td>
																				<td></td>
																				<td></td>
																				<td></td>
																			</tr>
																			
																			<tr>
																				<td colspan='6'>
																					<table width='100%' border='0' id='form_tjn$no_ins3$no_kat3'>";
																					foreach($sub2 as $row3)
																					{
																						if($row3->kode_uraian == "$no_ins3-$no_kat3-A")
																						{
																							if($row3->no_kka == "a")
																							{
																								$abjadNext = 'b';

																								echo "
																								<tr class='bor-bot'>
																									<td width='3%'></td>
																									<td>
																										<input type='hidden' name='kode_periksa[]' value='A'>
																										<input type='hidden' name='no_ins[]' value='$no_ins3'>
																										<input type='hidden' name='no_kat[]' value='$no_kat3'>

																										a. <textarea name='nama_periksa[]' rows='2' cols='37' style='color:black;' placeholder='Isi tujuan pemeriksaan'>$row3->uraian</textarea>
																										<button type='button' class='btn btn-xs btn-warning' onclick='tambahElemenTjn(\"$no_kat3\", \"$no_ins3\", \"$no_ins3$no_kat3\"); return false;' title='Tambah tujuan pemeriksaan'><i class='fa fa-plus'></i></button>
																									</td>
																									<td width='36%' class='pad-3'> </td>
																									<td width='14%' class='pad-3'> <input type='hidden' name='tanggal[]' value='-' /> </td>
																									<td width='7%' class='pad-3'> <input type='hidden' name='no_kka[]' value='a' /> </td>
																									<td width='7%' class='pad-3'> <input type='hidden' name='keterangan[]' value='-' /> </td>
																								</tr>";
																							}
																							else
																							{
																								$abjad = substr($row3->no_kka,-1);
																								$abjadNext = chr(ord($abjad)+1);

																								echo "
																								<tr id='ttjn_row-$no_ins3$no_kat3' class='bor-bot'>
																									<td width='3%'></td>
																									<td>
																										<input type='hidden' name='kode_periksa[]' value='A'>
																										<input type='hidden' name='no_ins[]' value='$no_ins3'>
																										<input type='hidden' name='no_kat[]' value='$no_kat3'>
																										
																										$abjad. <textarea name='nama_periksa[]' rows='2' cols='37' style='color:black;' placeholder='Isi tujuan pemeriksaan'>$row3->uraian</textarea>
																										<button type='button' class='btn btn-xs btn-danger' onclick='hapusElemenTjn(\"#ttjn_row-$no_ins3$no_kat3\", \"$no_ins3$no_kat3\"); return false;' title='Hapus tujuan pemeriksaan'><i class='fa fa-minus'></i></button>
																									</td>
																									<td width='36%' class='pad-3'> </td>
																									<td width='14%' class='pad-3'> <input type='hidden' name='tanggal[]' value='-' /> </td>
																									<td width='7%' class='pad-3'> <input type='hidden' name='no_kka[]' value='$row3->no_kka' /> </td>
																									<td width='7%' class='pad-3'> <input type='hidden' name='keterangan[]' value='-' /> </td>
																								</tr>";
																							}
																						}
																					}
																					echo "
																					</table>
																				</td>
																			</tr>

																			<input type='hidden' id='abjadT$no_ins3$no_kat3' value='$abjadNext'>
																			
																			<tr>
																				<td></td>
																				<td class='i b'> B. Langkah Pemeriksaan : </td>
																				<td></td>
																				<td></td>
																				<td></td>
																				<td></td>
																			</tr>
																			
																			<tr>
																				<td colspan='6'>
																					<table width='100%' border='0' id='form_lkh$no_ins3$no_kat3'>";
																					foreach($sub2 as $row3)
																					{
																						if($row3->kode_uraian == "$no_ins3-$no_kat3-B")
																						{
																							if($row3->no_kka == "$row->kategori.$abj_ins3.$no_kategori2.a")
																							{
																								echo "
																								<tr class='bor-bot'>
																									<td width='3%'></td>
																									<td>
																										<input type='hidden' name='kode_periksa[]' value='B'>
																										<input type='hidden' name='no_ins[]' value='$no_ins3'>
																										<input type='hidden' name='no_kat[]' value='$no_kat3'>
																										
																										a. <textarea name='nama_periksa[]' rows='2' cols='37' style='color:black;' placeholder='Isi langkah pemeriksaan'>$row3->uraian</textarea>
																										<button type='button' class='btn btn-xs btn-warning' onclick='tambahElemenLkh(\"$no_kat3\", \"$abj_ins3\", \"$no_ins3\", \"$no_ins3$no_kat3\"); return false;' title='Tambah langkah pemeriksaan'><i class='fa fa-plus'></i></button>
																									</td>
																									<td width='36%' class='pad-3'>";
																										foreach($sub3 as $row4)
																										{
																											if($row4->sub_no_kka == $row3->no_kka)
																											{
																												if($row4->nomor == 1)
																												{
																													$sub_kka = substr($row4->sub_no_kka, -1);
																													$pelaksana = $row4->pelaksana;

																													echo "
																													<input type='hidden' name='no_kka2[]' value='3.$abj_ins3.$no_kategori2.$sub_kka'>
																													<input type='hidden' name='nomor[]' value='$row4->nomor'>
																													<select name='pelaksana[]'>
																														<option> -- Pilih Pelaksana -- </option>";
																														echo "<option value='$daltu->id_pegawai $no_kat3'"; if($pelaksana == $daltu->id_pegawai){ echo 'selected'; } echo "> $daltu->nama [DALTU] </option>";
																														echo "<option value='$dalnis->id_pegawai $no_kat3'"; if($pelaksana == $dalnis->id_pegawai){ echo 'selected'; } echo "> $dalnis->nama [DALNIS] </option>";
																														echo "<option value='$pegawai->id_pegawai $no_kat3'"; if($pelaksana == $pegawai->id_pegawai){ echo 'selected'; } echo "> $pegawai->nama [KETUA TIM] </option>";
																														foreach($anggota as $row2)
																														{	echo "<option value='$row2->anggota $no_kat3'"; if($pelaksana == $row2->anggota){ echo 'selected'; } echo "> $row2->nama [ANGGOTA] </option>"; }
																													echo "</select>

																													<button type='button' class='btn btn-xs btn-warning' onclick='tambahElemenAgt(\"$no_ins3$no_kat3-B-$sub_kka\", \"3.$abj_ins3.$no_kategori2.a\", \"no-$no_ins3$no_kat3-B-a\"); return false;' title='Tambah pelaksana'><i class='fa fa-plus'></i></button> <br/><br/>
																													";
																												}
																												else
																												{
																													$sub_kka = substr($row4->sub_no_kka, -1);
																													$pelaksana = $row4->pelaksana;

																													echo "
																													<span id='ssrow-$no_ins3$no_kat3-B-$sub_kka-$row4->nomor'>
																													<input type='hidden' name='no_kka2[]' value='3.$abj_ins3.$no_kategori2.$sub_kka'>
																													<input type='hidden' name='nomor[]' value='$row4->nomor'>
																													<select name='pelaksana[]'>
																														<option> -- Pilih Pelaksana -- </option>";
																														echo "<option value='$daltu->id_pegawai $no_kat3'"; if($pelaksana == $daltu->id_pegawai){ echo 'selected'; } echo "> $daltu->nama [DALTU] </option>";
																														echo "<option value='$dalnis->id_pegawai $no_kat3'"; if($pelaksana == $dalnis->id_pegawai){ echo 'selected'; } echo "> $dalnis->nama [DALNIS] </option>";
																														echo "<option value='$pegawai->id_pegawai $no_kat3'"; if($pelaksana == $pegawai->id_pegawai){ echo 'selected'; } echo "> $pegawai->nama [KETUA TIM] </option>";
																														foreach($anggota as $row2)
																														{	echo "<option value='$row2->anggota $no_kat3'"; if($pelaksana == $row2->anggota){ echo 'selected'; } echo "> $row2->nama [ANGGOTA] </option>"; }
																													echo "</select>

																													<button type='button' class='btn btn-xs btn-danger' onclick='hapusElemenAgt(\"#ssrow-$no_ins3$no_kat3-B-$sub_kka-$row4->nomor\", \"no-$no_ins3$no_kat3-B-a\"); return false;' title='Hapus pelaksana'><i class='fa fa-minus'></i></button> <br/><br/>
																													</span>
																													";
																												}
																												$noAkhir = $row4->nomor;
																											}
																										}
																										echo "
																										<div id='form_agt$no_ins3$no_kat3-B-$sub_kka'></div>
																										<input type='hidden' id='no-$no_ins3$no_kat3-B-a' value='$noAkhir'>
																									</td>
																									<td width='14%' class='pad-3'>
																										<div class='input-group date datepicker'>
																											<input type='text' name='tanggal[]' class='col-xs-10 col-sm-12' placeholder='Tanggal' readonly='' value='$row3->tgl_kerja' />
																											<span class='input-group-addon' title='Pilih Tanggal'><span class='ace-icon fa fa-calendar bigger-110'></span></span>
																										</div>
																									</td>
																									<td width='7%' class='pad-3'><input type='text' name='no_kka[]' class='col-xs-10 col-sm-12' placeholder='No KKA' value='$row3->no_kka' readOnly='' /></td>
																									<td width='7%' class='pad-3'><input type='text' name='keterangan[]' class='col-xs-10 col-sm-12' placeholder='Ket' value='$row3->keterangan' /></td>
																								</tr>";
																							}
																							else
																							{
																								$abjad = substr($row3->no_kka,-1);
																								$abjadNext = chr(ord($abjad)+1);
																								echo "
																								<tr id='llkh_row-$no_ins3$no_kat3' class='bor-bot'>
																									<td width='3%'></td>
																									<td>
																										<input type='hidden' name='kode_periksa[]' value='B'>
																										<input type='hidden' name='no_ins[]' value='$no_ins3'>
																										<input type='hidden' name='no_kat[]' value='$no_kat3'>
																										
																										$abjad. <textarea name='nama_periksa[]' rows='2' cols='37' style='color:black;' placeholder='Isi langkah pemeriksaan'>$row3->uraian</textarea>
																										<button type='button' class='btn btn-xs btn-danger' onclick='hapusElemenLkh(\"#llkh_row-$no_ins3$no_kat3\", \"$no_ins3$no_kat3\"); return false;' title='Hapus langkah pemeriksaan'><i class='fa fa-minus'></i></button>
																									</td>
																									<td width='36%' class='pad-3'>";
																										foreach($sub3 as $row4)
																										{
																											if($row4->sub_no_kka == $row3->no_kka)
																											{
																												if($row4->nomor == 1)
																												{
																													$sub_kka = substr($row4->sub_no_kka, -1);
																													$pelaksana = $row4->pelaksana;

																													echo "
																													<input type='hidden' name='no_kka2[]' value='3.$abj_ins3.$no_kategori2.$sub_kka'>
																													<input type='hidden' name='nomor[]' value='$row4->nomor'>
																													<select name='pelaksana[]'>
																														<option> -- Pilih Pelaksana -- </option>";
																														echo "<option value='$daltu->id_pegawai $no_kat3'"; if($pelaksana == $daltu->id_pegawai){ echo 'selected'; } echo "> $daltu->nama [DALTU] </option>";
																														echo "<option value='$dalnis->id_pegawai $no_kat3'"; if($pelaksana == $dalnis->id_pegawai){ echo 'selected'; } echo "> $dalnis->nama [DALNIS] </option>";
																														echo "<option value='$pegawai->id_pegawai $no_kat3'"; if($pelaksana == $pegawai->id_pegawai){ echo 'selected'; } echo "> $pegawai->nama [KETUA TIM] </option>";
																														foreach($anggota as $row2)
																														{	echo "<option value='$row2->anggota $no_kat3'"; if($pelaksana == $row2->anggota){ echo 'selected'; } echo "> $row2->nama [ANGGOTA] </option>"; }
																													echo "</select>

																													<button type='button' class='btn btn-xs btn-warning' onclick='tambahElemenAgt(\"$no_ins3$no_kat3-B-$sub_kka\", \"3.$abj_ins3.$no_kategori2.$sub_kka\", \"no-$no_ins3$no_kat3-B-$abjad\"); return false;' title='Tambah pelaksana'><i class='fa fa-plus'></i></button> <br/><br/>
																													";
																												}
																												else
																												{
																													$sub_kka = substr($row4->sub_no_kka, -1);
																													$pelaksana = $row4->pelaksana;

																													echo "
																													<span id='ssrow-$no_ins3$no_kat3-B-$sub_kka-$row4->nomor'>
																													<input type='hidden' name='no_kka2[]' value='3.$abj_ins3.$no_kategori2.$sub_kka'>
																													<input type='hidden' name='nomor[]' value='$row4->nomor'>
																													<select name='pelaksana[]'>
																														<option> -- Pilih Pelaksana -- </option>";
																														echo "<option value='$daltu->id_pegawai $no_kat3'"; if($pelaksana == $daltu->id_pegawai){ echo 'selected'; } echo "> $daltu->nama [DALTU] </option>";
																														echo "<option value='$dalnis->id_pegawai $no_kat3'"; if($pelaksana == $dalnis->id_pegawai){ echo 'selected'; } echo "> $dalnis->nama [DALNIS] </option>";
																														echo "<option value='$pegawai->id_pegawai $no_kat3'"; if($pelaksana == $pegawai->id_pegawai){ echo 'selected'; } echo "> $pegawai->nama [KETUA TIM] </option>";
																														foreach($anggota as $row2)
																														{	echo "<option value='$row2->anggota $no_kat3'"; if($pelaksana == $row2->anggota){ echo 'selected'; } echo "> $row2->nama [ANGGOTA] </option>"; }
																													echo "</select>

																													<button type='button' class='btn btn-xs btn-danger' onclick='hapusElemenAgt(\"#ssrow-$no_ins3$no_kat3-B-$sub_kka-$row4->nomor\", \"no-$no_ins3$no_kat3-B-$abjad\"); return false;' title='Hapus pelaksana'><i class='fa fa-minus'></i></button> <br/><br/>
																													</span>
																													";
																												}
																												$noAkhir = $row4->nomor;
																											}
																										}
																										echo "
																										<div id='form_agt$no_ins3$no_kat3-B-$sub_kka'></div>
																										<input type='hidden' id='no-$no_ins3$no_kat3-B-$abjad' value='$noAkhir'>
																									</td>
																									<td width='14%' class='pad-3'>
																										<div class='input-group date datepicker'>
																											<input type='text' name='tanggal[]' class='col-xs-10 col-sm-12' placeholder='Tanggal' readonly='' value='$row3->tgl_kerja' />
																											<span class='input-group-addon' title='Pilih Tanggal'><span class='ace-icon fa fa-calendar bigger-110'></span></span>
																										</div>
																									</td>
																									<td width='7%' class='pad-3'><input type='text' name='no_kka[]' class='col-xs-10 col-sm-12' placeholder='No KKA' value='$row3->no_kka' readOnly='' /></td>
																									<td width='7%' class='pad-3'><input type='text' name='keterangan[]' class='col-xs-10 col-sm-12' placeholder='Ket' value='$row3->keterangan' /></td>
																								</tr>";
																							}
																						}
																					}
																					echo "
																					</table>
																				</td>
																			</tr>

																			<input type='hidden' id='abjadL$no_ins3$no_kat3' value='$abjadNext'>
																			";

																			$no_kategori2++;
																			$no_kat3++;
																		}
																	}

																	echo "
																	<tr><td colspan='6'>&nbsp;</td></tr>
																	<tr><td colspan='6'><div class='hr hr-double hr-dotted hr18'></div></td></tr>
																	";

																	$abj_ins3 = chr(ord($abj_ins3)+1);
																	$no_ins3++;
																}
															}

															//-> KONDISI 1 INSTANSI
															else
															{
																$no_kategori2 = 1;
																foreach($sub1 as $row)
																{
																	if($row->kategori == "3")
																	{
																		echo "
																		<input type='hidden' name='kategori[]' id='kategori-$no_kat3' value='$row->kategori'>
																		<input type='hidden' name='kode_pekerjaan[]' value='$row->kode_pekerjaan'>
																		<input type='hidden' name='jenis_pekerjaan[]' value='$row->jenis_pekerjaan'>
																		<input type='hidden' id='no-uraian-$no_kat3' value='$no_kategori2'>

																		<tr>
																			<td class='c pad-3 pos-atas'> $no_kategori2). </td>
																			<td class='b pad-3 u' colspan='5'> $row->jenis_pekerjaan </td>
																		</tr>
																		
																		<tr>
																			<td></td>
																			<td class='i b'> A. Tujuan Pemeriksaan : </td>
																			<td></td>
																			<td></td>
																			<td></td>
																			<td></td>
																		</tr>
																		
																		<tr>
																			<td colspan='6'>
																				<table width='100%' border='0' id='form_tjn$no_kat3'>";
																				foreach($sub2 as $row3)
																				{
																					if($row3->kode_uraian == "$no_kat3-A")
																					{
																						if($row3->no_kka == "a")
																						{
																							$abjadNext = 'b';

																							echo "
																							<tr class='bor-bot'>
																								<td width='3%'></td>
																								<td>
																									<input type='hidden' name='kode_periksa[]' value='A'>
																									<input type='hidden' name='no_ins[]' value='-'>
																									<input type='hidden' name='no_kat[]' value='$no_kat3'>

																									a. <textarea name='nama_periksa[]' rows='2' cols='37' style='color:black;' placeholder='Isi tujuan pemeriksaan'>$row3->uraian</textarea>
																									<button type='button' class='btn btn-xs btn-warning' onclick='tambahElemenTjn(\"$no_kat3\", \"$no_ins3\", \"$no_kat3\"); return false;' title='Tambah tujuan pemeriksaan'><i class='fa fa-plus'></i></button>
																								</td>
																								<td width='36%' class='pad-3'> </td>
																								<td width='14%' class='pad-3'> <input type='hidden' name='tanggal[]' value='-' /> </td>
																								<td width='7%' class='pad-3'> <input type='hidden' name='no_kka[]' value='a' /> </td>
																								<td width='7%' class='pad-3'> <input type='hidden' name='keterangan[]' value='-' /> </td>
																							</tr>";
																						}
																						else
																						{
																							$abjad = substr($row3->no_kka,-1);
																							$abjadNext = chr(ord($abjad)+1);

																							echo "
																							<tr id='ttjn_row-$no_kat3' class='bor-bot'>
																								<td width='3%'></td>
																								<td>
																									<input type='hidden' name='kode_periksa[]' value='A'>
																									<input type='hidden' name='no_ins[]' value='-'>
																									<input type='hidden' name='no_kat[]' value='$no_kat3'>
																									
																									$abjad. <textarea name='nama_periksa[]' rows='2' cols='37' style='color:black;' placeholder='Isi tujuan pemeriksaan'>$row3->uraian</textarea>
																									<button type='button' class='btn btn-xs btn-danger' onclick='hapusElemenTjn(\"#ttjn_row-$no_kat3\", \"$no_kat3\"); return false;' title='Hapus tujuan pemeriksaan'><i class='fa fa-minus'></i></button>
																								</td>
																								<td width='36%' class='pad-3'> </td>
																								<td width='14%' class='pad-3'> <input type='hidden' name='tanggal[]' value='-' /> </td>
																								<td width='7%' class='pad-3'> <input type='hidden' name='no_kka[]' value='$row3->no_kka' /> </td>
																								<td width='7%' class='pad-3'> <input type='hidden' name='keterangan[]' value='-' /> </td>
																							</tr>";
																						}
																					}
																				}
																				echo "
																				</table>
																			</td>
																		</tr>

																		<input type='hidden' id='abjadT$no_kat3' value='$abjadNext'>
																		
																		<tr>
																			<td></td>
																			<td class='i b'> B. Langkah Pemeriksaan : </td>
																			<td></td>
																			<td></td>
																			<td></td>
																			<td></td>
																		</tr>
																		
																		<tr>
																			<td colspan='6'>
																				<table width='100%' border='0' id='form_lkh$no_kat3'>";
																				foreach($sub2 as $row3)
																				{
																					if($row3->kode_uraian == "$no_kat3-B")
																					{
																						if($row3->no_kka == "$row->kategori.$no_kategori2.a")
																						{
																							echo "
																							<tr class='bor-bot'>
																								<td width='3%'></td>
																								<td>
																									<input type='hidden' name='kode_periksa[]' value='B'>
																									<input type='hidden' name='no_ins[]' value='-'>
																									<input type='hidden' name='no_kat[]' value='$no_kat3'>
																									
																									a. <textarea name='nama_periksa[]' rows='2' cols='37' style='color:black;' placeholder='Isi langkah pemeriksaan'>$row3->uraian</textarea>
																									<button type='button' class='btn btn-xs btn-warning' onclick='tambahElemenLkh(\"$no_kat3\", \"$abj_ins3\", \"$no_ins3\", \"$no_kat3\"); return false;' title='Tambah langkah pemeriksaan'><i class='fa fa-plus'></i></button>
																								</td>
																								<td width='36%' class='pad-3'>";
																									foreach($sub3 as $row4)
																									{
																										if($row4->sub_no_kka == $row3->no_kka)
																										{
																											if($row4->nomor == 1)
																											{
																												$sub_kka = substr($row4->sub_no_kka, -1);
																												$pelaksana = $row4->pelaksana;

																												echo "
																												<input type='hidden' name='no_kka2[]' value='3.$no_kategori2.$sub_kka'>
																												<input type='hidden' name='nomor[]' value='$row4->nomor'>
																												<select name='pelaksana[]'>
																													<option> -- Pilih Pelaksana -- </option>";
																													echo "<option value='$daltu->id_pegawai $no_kat3'"; if($pelaksana == $daltu->id_pegawai){ echo 'selected'; } echo "> $daltu->nama [DALTU] </option>";
																													echo "<option value='$dalnis->id_pegawai $no_kat3'"; if($pelaksana == $dalnis->id_pegawai){ echo 'selected'; } echo "> $dalnis->nama [DALNIS] </option>";
																													echo "<option value='$pegawai->id_pegawai $no_kat3'"; if($pelaksana == $pegawai->id_pegawai){ echo 'selected'; } echo "> $pegawai->nama [KETUA TIM] </option>";
																													foreach($anggota as $row2)
																													{	echo "<option value='$row2->anggota $no_kat3'"; if($pelaksana == $row2->anggota){ echo 'selected'; } echo "> $row2->nama [ANGGOTA] </option>"; }
																												echo "</select>

																												<button type='button' class='btn btn-xs btn-warning' onclick='tambahElemenAgt(\"$no_kat3-B-$sub_kka\", \"3.$no_kategori2.a\", \"no-$no_kat3-B-a\"); return false;' title='Tambah pelaksana'><i class='fa fa-plus'></i></button> <br/><br/>
																												";
																											}
																											else
																											{
																												$sub_kka = substr($row4->sub_no_kka, -1);
																												$pelaksana = $row4->pelaksana;

																												echo "
																												<span id='ssrow-$no_kat3-B-$sub_kka-$row4->nomor'>
																												<input type='hidden' name='no_kka2[]' value='3.$no_kategori2.$sub_kka'>
																												<input type='hidden' name='nomor[]' value='$row4->nomor'>
																												<select name='pelaksana[]'>
																													<option> -- Pilih Pelaksana -- </option>";
																													echo "<option value='$daltu->id_pegawai $no_kat3'"; if($pelaksana == $daltu->id_pegawai){ echo 'selected'; } echo "> $daltu->nama [DALTU] </option>";
																													echo "<option value='$dalnis->id_pegawai $no_kat3'"; if($pelaksana == $dalnis->id_pegawai){ echo 'selected'; } echo "> $dalnis->nama [DALNIS] </option>";
																													echo "<option value='$pegawai->id_pegawai $no_kat3'"; if($pelaksana == $pegawai->id_pegawai){ echo 'selected'; } echo "> $pegawai->nama [KETUA TIM] </option>";
																													foreach($anggota as $row2)
																													{	echo "<option value='$row2->anggota $no_kat3'"; if($pelaksana == $row2->anggota){ echo 'selected'; } echo "> $row2->nama [ANGGOTA] </option>"; }
																												echo "</select>

																												<button type='button' class='btn btn-xs btn-danger' onclick='hapusElemenAgt(\"#ssrow-$no_kat3-B-$sub_kka-$row4->nomor\", \"no-$no_kat3-B-a\"); return false;' title='Hapus pelaksana'><i class='fa fa-minus'></i></button> <br/><br/>
																												</span>
																												";
																											}
																											$noAkhir = $row4->nomor;
																										}
																									}
																									echo "
																									<div id='form_agt$no_kat3-B-$sub_kka'></div>
																									<input type='hidden' id='no-$no_kat3-B-a' value='$noAkhir'>
																								</td>
																								<td width='14%' class='pad-3'>
																									<div class='input-group date datepicker'>
																										<input type='text' name='tanggal[]' class='col-xs-10 col-sm-12' placeholder='Tanggal' readonly='' value='$row3->tgl_kerja' />
																										<span class='input-group-addon' title='Pilih Tanggal'><span class='ace-icon fa fa-calendar bigger-110'></span></span>
																									</div>
																								</td>
																								<td width='7%' class='pad-3'><input type='text' name='no_kka[]' class='col-xs-10 col-sm-12' placeholder='No KKA' value='$row3->no_kka' readOnly='' /></td>
																								<td width='7%' class='pad-3'><input type='text' name='keterangan[]' class='col-xs-10 col-sm-12' placeholder='Ket' value='$row3->keterangan' /></td>
																							</tr>";
																						}
																						else
																						{
																							$abjad = substr($row3->no_kka,-1);
																							$abjadNext = chr(ord($abjad)+1);
																							echo "
																							<tr id='llkh_row-$no_kat3' class='bor-bot'>
																								<td width='3%'></td>
																								<td>
																									<input type='hidden' name='kode_periksa[]' value='B'>
																									<input type='hidden' name='no_ins[]' value='-'>
																									<input type='hidden' name='no_kat[]' value='$no_kat3'>
																									
																									$abjad. <textarea name='nama_periksa[]' rows='2' cols='37' style='color:black;' placeholder='Isi langkah pemeriksaan'>$row3->uraian</textarea>
																									<button type='button' class='btn btn-xs btn-danger' onclick='hapusElemenLkh(\"#llkh_row-$no_kat3\", \"$no_kat3\"); return false;' title='Hapus langkah pemeriksaan'><i class='fa fa-minus'></i></button>
																								</td>
																								<td width='36%' class='pad-3'>";
																									foreach($sub3 as $row4)
																									{
																										if($row4->sub_no_kka == $row3->no_kka)
																										{
																											if($row4->nomor == 1)
																											{
																												$sub_kka = substr($row4->sub_no_kka, -1);
																												$pelaksana = $row4->pelaksana;

																												echo "
																												<input type='hidden' name='no_kka2[]' value='3.$no_kategori2.$sub_kka'>
																												<input type='hidden' name='nomor[]' value='$row4->nomor'>
																												<select name='pelaksana[]'>
																													<option> -- Pilih Pelaksana -- </option>";
																													echo "<option value='$daltu->id_pegawai $no_kat3'"; if($pelaksana == $daltu->id_pegawai){ echo 'selected'; } echo "> $daltu->nama [DALTU] </option>";
																													echo "<option value='$dalnis->id_pegawai $no_kat3'"; if($pelaksana == $dalnis->id_pegawai){ echo 'selected'; } echo "> $dalnis->nama [DALNIS] </option>";
																													echo "<option value='$pegawai->id_pegawai $no_kat3'"; if($pelaksana == $pegawai->id_pegawai){ echo 'selected'; } echo "> $pegawai->nama [KETUA TIM] </option>";
																													foreach($anggota as $row2)
																													{	echo "<option value='$row2->anggota $no_kat3'"; if($pelaksana == $row2->anggota){ echo 'selected'; } echo "> $row2->nama [ANGGOTA] </option>"; }
																												echo "</select>

																												<button type='button' class='btn btn-xs btn-warning' onclick='tambahElemenAgt(\"$no_kat3-B-$sub_kka\", \"3.$no_kategori2.$sub_kka\", \"no-$no_kat3-B-$abjad\"); return false;' title='Tambah pelaksana'><i class='fa fa-plus'></i></button> <br/><br/>
																												";
																											}
																											else
																											{
																												$sub_kka = substr($row4->sub_no_kka, -1);
																												$pelaksana = $row4->pelaksana;

																												echo "
																												<span id='ssrow-$no_kat3-B-$sub_kka-$row4->nomor'>
																												<input type='hidden' name='no_kka2[]' value='3.$no_kategori2.$sub_kka'>
																												<input type='hidden' name='nomor[]' value='$row4->nomor'>
																												<select name='pelaksana[]'>
																													<option> -- Pilih Pelaksana -- </option>";
																													echo "<option value='$daltu->id_pegawai $no_kat3'"; if($pelaksana == $daltu->id_pegawai){ echo 'selected'; } echo "> $daltu->nama [DALTU] </option>";
																													echo "<option value='$dalnis->id_pegawai $no_kat3'"; if($pelaksana == $dalnis->id_pegawai){ echo 'selected'; } echo "> $dalnis->nama [DALNIS] </option>";
																													echo "<option value='$pegawai->id_pegawai $no_kat3'"; if($pelaksana == $pegawai->id_pegawai){ echo 'selected'; } echo "> $pegawai->nama [KETUA TIM] </option>";
																													foreach($anggota as $row2)
																													{	echo "<option value='$row2->anggota $no_kat3'"; if($pelaksana == $row2->anggota){ echo 'selected'; } echo "> $row2->nama [ANGGOTA] </option>"; }
																												echo "</select>

																												<button type='button' class='btn btn-xs btn-danger' onclick='hapusElemenAgt(\"#ssrow-$no_kat3-B-$sub_kka-$row4->nomor\", \"no-$no_kat3-B-$abjad\"); return false;' title='Hapus pelaksana'><i class='fa fa-minus'></i></button> <br/><br/>
																												</span>
																												";
																											}
																											$noAkhir = $row4->nomor;
																										}
																									}
																									echo "
																									<div id='form_agt$no_kat3-B-$sub_kka'></div>
																									<input type='hidden' id='no-$no_kat3-B-$abjad' value='$noAkhir'>
																								</td>
																								<td width='14%' class='pad-3'>
																									<div class='input-group date datepicker'>
																										<input type='text' name='tanggal[]' class='col-xs-10 col-sm-12' placeholder='Tanggal' readonly='' value='$row3->tgl_kerja' />
																										<span class='input-group-addon' title='Pilih Tanggal'><span class='ace-icon fa fa-calendar bigger-110'></span></span>
																									</div>
																								</td>
																								<td width='7%' class='pad-3'><input type='text' name='no_kka[]' class='col-xs-10 col-sm-12' placeholder='No KKA' value='$row3->no_kka' readOnly='' /></td>
																								<td width='7%' class='pad-3'><input type='text' name='keterangan[]' class='col-xs-10 col-sm-12' placeholder='Ket' value='$row3->keterangan' /></td>
																							</tr>";
																						}
																					}
																				}
																				echo "
																				</table>
																			</td>
																		</tr>

																		<input type='hidden' id='abjadL$no_kat3' value='$abjadNext'>
																		";

																		$no_kategori2++;
																		$no_kat3++;
																	}
																}
															}															
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

														<input class="btn btn-info" type="submit" name="submit" value="Ubah"></input>
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
			function tambahElemenTjn(form_tjn, no_ins, kode_tbl)
			{
				//var total   = document.getElementById("total").value;
			  var ftjn    = document.getElementById("f-tjn").value;
			  //var fagt    = document.getElementById("f-agt").value;
			  var abjad   = document.getElementById("abjadT"+kode_tbl).value;
			  var kat 	  = document.getElementById("kategori-"+form_tjn).value;
			  var no_jen  = document.getElementById("no-uraian-"+form_tjn).value;
			  //var no_urai = document.getElementById("kode-pekerjaan-"+form_tjn).value;
		  	var stre;

		  	if(abjad != '{')
		  	{
		  		stre = "<tr id='tjn_row" + ftjn + "' class='bor-bot'>" +
		  					 "	<td>"+
								 "		<input type='hidden' name='kode_periksa[]' value='A'>"+
								 "    <input type='hidden' name='no_ins[]' value='"+no_ins+"'>"+
								 "		<input type='hidden' name='no_kat[]' value='"+form_tjn+"'>"+
								 "	</td>" +
								 "	<td>"+ abjad +". <textarea name='nama_periksa[]' rows='2' cols='37' style='color:black;' placeholder='Isi tujuan pemeriksaan'></textarea> <a href='#' onclick='hapusElemenTjn(\"#tjn_row" + ftjn + "\", "+ kode_tbl +"); return false;' class='btn btn-xs btn-danger' title='Hapus tujuan pemeriksaan'> <i class='fa fa-minus'></i> </a> </td>" +
								 "	<td class='pad-3'> </td>" +
								 "	<td class='pad-3'> <input type='hidden' name='tanggal[]' value='-' /> </td>" +
								  "	<td class='pad-3'> <input type='hidden' name='no_kka[]' value='"+abjad+"' /> </td>" +
								 "	<td class='pad-3'> <input type='hidden' name='keterangan[]' value='-' /> </td>" +
								 "</tr>";

			  	$("#form_tjn"+kode_tbl).append(stre);
			  	ftjn = (ftjn-1) + 2;
			  	document.getElementById("f-tjn").value = ftjn;

			  	/*total2 = (total-1) + 2;
			  	document.getElementById("total").value = total2;*/

			  	/*fagt2 = (fagt-1) + 2;
			  	document.getElementById("f-agt").value = fagt2;*/

			  	$.ajax({
			  		type 	: "POST",
	          url 	: "<?php echo site_url('ketua_tim/pka/get_abjad') ?>",
	          data 	: {modul:'plus', id:abjad},
						success: function(respond)
						{
							//$("#tes").html(respond);
							document.getElementById("abjadT"+kode_tbl).value = respond;
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

			  /*var total  = document.getElementById("total").value;
			  total2 = total-1;
		  	document.getElementById("total").value = total2;*/

		  	/*var fagt  = document.getElementById("f-agt").value;
			  fagt2 = fagt-1;
		  	document.getElementById("f-agt").value = fagt2;*/

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
			function tambahElemenLkh(form_lkh, kode_ins, no_ins, kode_tbl)
			{
				//var total  = document.getElementById("total").value;
			  var flkh   = document.getElementById("f-lkh").value;
			  var fagt   = document.getElementById("f-agt").value;
			  var abjad  = document.getElementById("abjadL"+kode_tbl).value;
			  var kat 	 = document.getElementById("kategori-"+form_lkh).value;
			  var no_jen = document.getElementById("no-uraian-"+form_lkh).value;
			  //var no_urai = document.getElementById("kode-pekerjaan-"+form_lkh).value;
		  	var stre;

		  	if(abjad != '{')
		  	{
					stre = "<tr id='lkh_row" + flkh + "' class='bor-bot'>" +
								 "	<td>"+
								 "		<input type='hidden' name='kode_periksa[]' value='B'>"+
								 "    <input type='hidden' name='no_ins[]' value='"+no_ins+"'>"+
								 "		<input type='hidden' name='no_kat[]' value='"+form_lkh+"'>"+
								 "		<input type='hidden' name='no_kka2[]' value='"+kat+"."+kode_ins+"."+no_jen+"."+abjad+"'>"+
								 "		<input type='hidden' id='no-"+no_ins+form_lkh+"-B-"+abjad+"' value='1'>"+
								 "		<input type='hidden' name='nomor[]' value='1'>"+
								 "  </td>"+								 
								 "	<td>"+ abjad +". <textarea name='nama_periksa[]' rows='2' cols='37' style='color:black;' placeholder='Isi langkah pemeriksaan'></textarea> <a href='#' onclick='hapusElemenLkh(\"#lkh_row" + flkh + "\", "+ kode_tbl +"); return false;' class='btn btn-xs btn-danger' title='Hapus langkah pemeriksaan'> <i class='fa fa-minus'></i> </a> </td>" +
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
								 "  <button type='button' class='btn btn-xs btn-warning' onclick='tambahElemenAgt(\""+ form_lkh + form_lkh + flkh +"\", \""+kat+"."+kode_ins+"."+no_jen+"."+abjad+"\", \"no-"+no_ins+form_lkh+"-B-"+abjad+"\"); return false;' title='Tambah pelaksana'><i class='fa fa-plus'></i></button> <br/><br/> <div id='form_agt"+ form_lkh + form_lkh + flkh +"'></div> </td>" +
								 "	<td class='pad-3'> <div class='input-group date datepicker' onclick='tanggal(); return true;'>" +
								 "			<input type='text' name='tanggal[]' class='col-xs-10 col-sm-12' placeholder='Tanggal' readonly='' />" +
								 "		<span class='input-group-addon' title='Pilih Tanggal'><span class='ace-icon fa fa-calendar bigger-110'></span></span>" +
								 "	</div> </td>" +
								 "	<td class='pad-3'><input type='text' name='no_kka[]' class='col-xs-10 col-sm-12' placeholder='No KKA' value='"+kat+"."+kode_ins+"."+no_jen+"."+abjad+"' readOnly='' /></td>" +
								 "	<td class='pad-3'> <input type='text' name='keterangan[]' class='col-xs-10 col-sm-12' placeholder='Ket' /> </td>" +
								 "</tr>";

			  	$("#form_lkh"+kode_tbl).append(stre);
			  	flkh = (flkh-1) + 2;
			  	document.getElementById("f-lkh").value = flkh;

			  	/*total2 = (total-1) + 2;
			  	document.getElementById("total").value = total2;*/

			  	fagt2 = (fagt-1) + 2;
			  	document.getElementById("f-agt").value = fagt2;

			  	$.ajax({
			  		type 	: "POST",
	          url 	: "<?php echo site_url('ketua_tim/pka/get_abjad') ?>",
	          data 	: {modul:'plus', id:abjad},
						success: function(respond)
						{
							//$("#tes").html(respond);
							document.getElementById("abjadL"+kode_tbl).value = respond;
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

			 /* var total  = document.getElementById("total").value;
			  total2 = total-1;
		  	document.getElementById("total").value = total2;*/

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
			function tambahElemenAgt(form_agt, kode_kka, kode_no)
			{
			  var fagt = document.getElementById("f-agt").value;
			  var no   = document.getElementById(kode_no).value;
			  noBaru = (no-1) + 2;

		  	var stre;
				stre = "<p id='srow" + fagt + "'>" +
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

		  	document.getElementById(kode_no).value = noBaru;
			}

			function hapusElemenAgt(id_elemen, kode_no)
			{
			  $(id_elemen).remove();

			  var fagt = document.getElementById("f-agt").value;
			  fagt2 = fagt-1;
			  document.getElementById("f-agt").value = fagt2;

			  var no  = document.getElementById(kode_no).value;
			  no = no-1;
		  	document.getElementById(kode_no).value = no;
			}
			//.jumlah anggota

			function tambahElemenTjnPKA() {
		  	var no = document.getElementById("tjnPKA").value;

		  	var stre;
				stre = "<p id='tjnPKArow" + no + "'> <textarea name='tjn_pka[]' rows='3' cols='60' placeholder='Isi tujuan PKA'></textarea> <a href='#' onclick='hapusElemenTjnPKA(\"#tjnPKArow" + no + "\"); return false;' class='btn btn-xs btn-danger' title='Hapus tujuan "+ no +"'> <i class='fa fa-minus'></i> </a> </p>";
		  	$("#form_tjnPKA").append(stre);
		  	no = (no-1) + 2;
		  	document.getElementById("tjnPKA").value = no;
		  }

			function hapusElemenTjnPKA(no)
			{
			  $(no).remove();

			  var no1 = document.getElementById("tjnPKA").value;
			  no2 = no1-1;
			  document.getElementById("tjnPKA").value = no2;
			}
			//.Tembusan	

			function tanggal()
			{
      	var tgl_awal  = document.getElementById("tgl_awal").value;
      	var tgl_akhir = document.getElementById("tgl_akhir").value;
      	//datepicker
      	$('.datepicker').datetimepicker({
      		weekStart: 1,
					daysOfWeekDisabled: [0,6],
					language: 'id',
	        todayBtn: 1,
					autoclose: 1,
					todayHighlight: 1,
					startView: 2,
					minView: 2,
					forceParse: 0
					//startDate: tgl_awal,
					//endDate: tgl_akhir
			  });
			 }
    </script>

    <script type="text/javascript">
    	var tgl_awal  = document.getElementById("tgl_awal").value;
    	var tgl_akhir = document.getElementById("tgl_akhir").value;
    	//datepicker
    	$('.datepicker').datetimepicker({
    		weekStart: 1,
				daysOfWeekDisabled: [0,6],
				language: 'id',
        todayBtn: 1,
				autoclose: 1,
				todayHighlight: 1,
				startView: 2,
				minView: 2,
				forceParse: 0
				//startDate: tgl_awal,
				//endDate: tgl_akhir
		  });
    </script>

	</body>
</html>
