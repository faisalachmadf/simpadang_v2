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
	.bg-color5 {background-color: #1faeff}
	.bg-color  {background-color: #f1f6a3}

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
								<a href="<?= site_url('daltu/home'); ?>"> Home </a>
							</li>
							<li>
								<a href="<?= site_url('daltu/pka'); ?>"> Program Kerja Audit </a>
							</li>
							<li class="active"> Detail Program Kerja Audit </li>
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">

						<div class="page-header">
							<h1>
								Detail Program Kerja Audit
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Melihat rincian data program kerja audit (PKA)
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
														<i class="fa fa-file-text"></i> Data Program Kerja Audit
													</h3>

													<dl id="dt-list-1" class="dl-horizontal">
														<dt> Nama Objek Audit : </dt>
															<dd align="justify"><?= $data->nama_op; ?></dd>

														<dt> Sasaran : </dt>
															<dd align="justify"><?= $data->sasaran_peng; ?></dd>

														<dt> Masa yang diperiksa : </dt>
															<dd align="justify"><?= $data->masa_periksa; ?></dd>

														<dt> Waktu Pemeriksaan : </dt>
															<dd align="justify"><?= $tgl_awal ." s.d. ". $tgl_akhir; ?></dd>

														<dt> No. Ref. PKA : </dt>
															<dd align="justify"><?= $data->no_ref_pka; ?></dd>
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
															<th class="bg-color5 c" width="12%"> Dalnis </th>
															<th class="bg-color5 c" width="12%"> Daltu </th>
															<th class="bg-color5 c" width="10%"> Aksi </th>
														</tr>

														<?php 
															$no = 1;
															foreach($data_rev as $row)
															{
																$tgl_rev = date('d', strtotime($row->tgl_reviu)) ." ".
																					 get_nama_bulan(date('m', strtotime($row->tgl_reviu))) ." ".
																					 date('Y', strtotime($row->tgl_reviu)) ." | ". date('H:i:s', strtotime($row->tgl_reviu));

																if($row->rev_dalnis == "-")
																{ $rev_dalnis = "<i class='fa fa-check bigger-130 green' title='Tidak ada reviu'></i>"; }
																else
																{	$rev_dalnis = "<i class='fa fa-times bigger-130 red' title='Terdapat reviu'></i>"; }

																if($row->rev_daltu == "-")
																{ $rev_daltu = "<i class='fa fa-check bigger-130 green' title='Tidak ada reviu'></i>"; }
																else
																{	$rev_daltu = "<i class='fa fa-times bigger-130 red' title='Terdapat reviu'></i>"; }

																echo "
																<tr>
																	<td class='c'> $no </td>
																	<td class='c'> $tgl_rev </td>
																	<td class='c'> $row->rev_ke </td>
																	<td class='c'> $rev_dalnis </td>
																	<td class='c'> $rev_daltu </td>
																	<td class='c'>
																		<a href='". site_url('daltu/pka/detail_reviu/'.base64_encode($row->rev_pka1).'/'.base64_encode($row->rev_ke))."' title='Detail Reviu'> <i class='fa fa-eye bigger-130'></i> </a>
																	</td>
																</tr>
																";
																$no++;
															}
														?>
													</table>
													<?php } ?>
												</div>

												<div class="col-sm-6">
													<h3 class="header">
														<i class="fa fa-bars"></i> Pendapat Program Kerja Audit
													</h3>

													<?php if($data->reviu_daltu == NULL) { ?>
													<form class="form-horizontal" role="form" action="<?= site_url('daltu/pka/persetujuan/'. base64_encode($data->id_pka)); ?>" method="post">
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

													<p style="color:red; font-style:italic">* Berikan keputusan setujui atau terdapat reviu.</p>

													<center>
														<input type="submit" name="submit" class="btn btn-sm btn-primary" value="OK" />
													</center>
													</form>

													<?php } else { ?>
													<div class="alert alert-block alert-success">
														<p>
															<i class='ace-icon fa fa-check'></i> Rencana Program Kerja Audit Telah Di Reviu.
														</p>
													</div>

													<center>												

													<?php 
														if($data->keputusan_pka == "selesai") 
														{ 
															echo " &nbsp;&nbsp;
															<a href='". site_url('daltu/pka/kka/'.base64_encode($data->id_pka)) ."' class='btn btn-sm btn-primary'>
																<i class='fa fa-file-text-o'></i> Kertas Kerja Audit (KKA)
															</a>";
														}
														echo "</center>";
													}
													?>

													<h3 class="header">
														<i class="fa fa-recycle"></i> Hasil Reviu PKA
													</h3>

													<table width="100%" border="0">
														<tr>
															<td width="19%" class="pos-atas"> Reviu DALNIS </td>
															<td width="3%" class="pos-atas"> : </td>
															<td>
																<?php
																	
																		if($data->reviu_dalnis == NULL)
																		{ echo "<i class='fa fa-spinner fa-pulse orange'></i> <strong class='orange i'> Belum Direviu </strong>"; }
																		elseif($data->reviu_dalnis == "-")
																		{ echo "<i class='fa fa-check green'><strong> Tidak ada reviu </strong></i>"; }
																		else
																		{	echo "<span class='red'><strong> $data->reviu_dalnis </strong></span>"; }
																	
																?>
															</td>
														</tr>

														<tr>
															<td class="pos-atas"> Reviu DALTU </td>
															<td class="pos-atas"> : </td>
															<td>
																<?php
																	
																		if($data->reviu_daltu == NULL)
																		{ echo "<i class='fa fa-spinner fa-pulse orange'></i> <strong class='orange i'> Belum Direviu </strong>"; }
																		elseif($data->reviu_daltu == "-")
																		{ echo "<i class='fa fa-check green'><strong> Tidak ada reviu </strong></i>"; }
																		else
																		{	echo "<span class='red'><strong> $data->reviu_daltu </strong></span>"; }
																	
																?>
															</td>
														</tr>
													</table>

													<br/>

													<center>
														<a href="<?= site_url('daltu/pka'); ?>" class="btn btn-sm btn-default"><i class="fa fa-arrow-left"></i> Kembali </a>			
													</center>

												</div>
											</div> <br/>

											<table width="100%" border="1">
												<tr>
													<th width="3%"></th>
													<th></th>
													<th width="35%"></th>
													<th width="9%"></th>
													<th width="9%"></th>
													<th width="13%"></th>
												</tr>

												<tr>
													<td class="c b bg-color"> No. </td>
													<td class="c b bg-color"> Uraian </td>
													<td class="c b bg-color"> Dilaksanakan Oleh </td>
													<td class="c b bg-color"> Waktu Pemeriksaan </td>
													<td class="c b bg-color"> No. KKA </td>
													<td class="c b bg-color"> Ket</td>
												</tr>
												
												<tr>
													<td > <h5 class='b'></h5> </td>
													<td colspan='5'> <h5 class='b u'> TUJUAN PROGRAM KERJA AUDIT</h5> </td>
												</tr>

												<?php 
													$no = 1;
													foreach($sub1 as $row)
													{
														if($row->tujuan_pka != NULL)
														{
															echo "
															<tr>
																<td class='r'> $no. </td>
																<td colspan='5'> $row->tujuan_pka </td>
															</tr>";
															$no++;
														}														
													}
												?>
												
												<tr>
													<td >  </td>
													<td colspan='5'> &nbsp; </td>
												</tr>

												<tr>
													<td > <h5 class='b'>1.</h5> </td>
													<td colspan='5'> <h5 class='b'>PERSIAPAN AUDIT</h5> </td>
												</tr>

												<?php
													//-> KONDISI LEBIH DARI 1 INSTANSI
													if(count($sasaran) != 0)
													{
														$abj_ins1 = 'A';
														$no_ins1  = 1;
														foreach ($ins as $key)
														{
															echo "
															<tr>
																<td class='r'><h5 class='b'> $abj_ins1). </h5></td>
																<td colspan='5'><h5 class='b'> $key->nama_instansi </h5></td>
															</tr>";

															$no1 = 1;
															foreach($sub1 as $row)
															{
																if($row->kategori == "1" && $row->nama_instansi == $key->nama_instansi)
																{
																	echo "
																	<tr>
																		<td class='r'> $no1). </td>
																		<td class='b' colspan='5'> $row->jenis_pekerjaan </td>
																	</tr>

																	<tr>
																		<td></td>
																		<td class='i'> A. Tujuan Pemeriksaan </td>
																		<td></td>
																		<td></td>
																		<td></td>
																		<td></td>
																	</tr>
																	";

																	$abjadA = 'a';
																	foreach($sub2 as $row3)
																	{
																		//$tgl = date('d-m-Y', strtotime($row3->tgl_kerja));
																		if($row3->kode_uraian == "$no_ins1-$no1-A")
																		{
																			echo "
																			<tr>
																				<td colspan='6'>
																				<table width='100%'>
																					<tr>
																						<td width='6%' class='r'> $abjadA. </td>
																						<td> $row3->uraian </td>
																						<td width='35%'>  </td>
																						<td width='9%' class='c'> </td>
																						<td width='9%' class='c'> </td>
																						<td width='13%'> </td>
																					</tr>
																				</table>
																				</td>
																			</tr>
																			";
																			$abjadA = chr(ord($abjadA)+1);
																		}
																	}

																	echo "
																	<tr>
																		<td></td>
																		<td class='i'> B. Langkah Pemeriksaan </td>
																		<td></td>
																		<td></td>
																		<td></td>
																		<td></td>
																	</tr>
																	";

																	$abjadB = 'a';
																	foreach($sub2 as $row3)
																	{
																		$tgl = date('d-m-Y', strtotime($row3->tgl_kerja));
																		if($row3->kode_uraian == "$no_ins1-$no1-B")
																		{
																			echo "
																			<tr>
																				<td colspan='6'>
																				<table width='100%'>
																					<tr>
																						<td width='6%' class='r'> $abjadB. </td>
																						<td> $row3->uraian </td>
																						<td width='35%'>";
																							$no_plk = 1;
																							foreach($sub3 as $row4)
																							{
																								if($row4->sub_no_kka == $row3->no_kka)
																								{
																									echo "$no_plk. $row4->nama [$row4->jbtn_tim] <br/>";
																									$no_plk++;
																								}
																							}
																						echo " </td>
																						<td width='9%' class='c'> $tgl </td>
																						<td width='9%' class='c'> $row3->no_kka </td>
																						<td width='13%'> $row3->keterangan </td>
																					</tr>
																				</table>
																				</td>
																			</tr>
																			";
																			$abjadB = chr(ord($abjadB)+1);
																		}
																	}

																	echo "
																	<tr>
																		<td></td>
																		<td class='i'> C. Buatkan kesimpulan dalam kertas kerja </td>
																		<td></td>
																		<td></td>
																		<td></td>
																		<td></td>
																	</tr>
																	";

																	$no1++;
																	$no2 = $no1;
																}
															}

															echo "<tr><td colspan='6'>&nbsp;</td></tr>";

															$abj_ins1 = chr(ord($abj_ins1)+1);
															$no_ins1++;
														}
													}

													//-> KONDISI 1 INSTANSI
													else
													{
														$no1 = 1;
														foreach($sub1 as $row)
														{
															if($row->kategori == "1")
															{
																echo "
																<tr>
																	<td class='r'> $no1). </td>
																	<td class='b' colspan='5'> $row->jenis_pekerjaan </td>
																</tr>

																<tr>
																	<td></td>
																	<td class='i'> A. Tujuan Pemeriksaan </td>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																</tr>
																";

																$abjadA = 'a';
																foreach($sub2 as $row3)
																{
																	if($row3->kode_uraian == "$no1-A")
																	{
																		echo "
																		<tr>
																			<td colspan='6'>
																			<table width='100%'>
																				<tr>
																					<td width='6%' class='r'> $abjadA. </td>
																					<td> $row3->uraian </td>
																					<td width='35%'>  </td>
																					<td width='9%' class='c'> </td>
																					<td width='9%' class='c'> </td>
																					<td width='13%'> </td>
																				</tr>
																			</table>
																			</td>
																		</tr>
																		";
																		$abjadA = chr(ord($abjadA)+1);
																	}
																}

																echo "
																<tr>
																	<td></td>
																	<td class='i'> B. Langkah Pemeriksaan </td>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																</tr>
																";

																$abjadB = 'a';
																foreach($sub2 as $row3)
																{
																	$tgl = date('d-m-Y', strtotime($row3->tgl_kerja));
																	if($row3->kode_uraian == "$no1-B")
																	{
																		echo "
																		<tr>
																			<td colspan='6'>
																			<table width='100%'>
																				<tr>
																					<td width='6%' class='r'> $abjadB. </td>
																					<td> $row3->uraian </td>
																					<td width='35%'>";
																						$no_plk = 1;
																						foreach($sub3 as $row4)
																						{
																							if($row4->sub_no_kka == $row3->no_kka)
																							{
																								echo "$no_plk. $row4->nama [$row4->jbtn_tim] <br/>";
																								$no_plk++;
																							}
																						}
																					echo " </td>
																					<td width='9%' class='c'> $tgl </td>
																					<td width='9%' class='c'> $row3->no_kka </td>
																					<td width='13%'> $row3->keterangan </td>
																				</tr>
																			</table>
																			</td>
																		</tr>
																		";
																		$abjadB = chr(ord($abjadB)+1);
																	}
																}

																echo "
																<tr>
																	<td></td>
																	<td class='i'> C. Buatkan kesimpulan dalam kertas kerja </td>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																</tr>
																";

																$no1++;
																$no2 = $no1;
															}
														}
													}

													##########################################
													//--> BATAS KATEGORI
													##########################################

													echo "
													<tr><td colspan='6'><div class='hr hr-double hr-dotted hr18'></div></td></tr>
													<tr>
														<td > <h5 class='b'>2.</h5> </td>
														<td colspan='5'> <h5 class='b u'>PELAKSANAAN AUDIT</h5> </td>
													</tr>";

													//-> KONDISI LEBIH DARI 1 INSTANSI
													if(count($sasaran) != 0)
													{
														$abj_ins1 = 'A';
														$no_ins1  = 1;
														foreach ($ins as $key)
														{
															echo "
															<tr>
																<td class='r'><h5 class='b'> $abj_ins1). </h5></td>
																<td colspan='5'><h5 class='b'> $key->nama_instansi </h5></td>
															</tr>";

															$no1 = 1;
															foreach($sub1 as $row)
															{
																if($row->kategori == "2" && $row->nama_instansi == $key->nama_instansi)
																{
																	echo "
																	<tr>
																		<td class='r'> $no1). </td>
																		<td class='b' colspan='5'> $row->jenis_pekerjaan </td>
																	</tr>

																	<tr>
																		<td></td>
																		<td class='i'> A. Tujuan Pemeriksaan </td>
																		<td></td>
																		<td></td>
																		<td></td>
																		<td></td>
																	</tr>
																	";

																	$abjadA = 'a';
																	foreach($sub2 as $row3)
																	{
																		//$tgl = date('d-m-Y', strtotime($row3->tgl_kerja));
																		if($row3->kode_uraian == "$no_ins1-$no2-A")
																		{
																			echo "
																			<tr>
																				<td colspan='6'>
																				<table width='100%'>
																					<tr>
																						<td width='6%' class='r'> $abjadA. </td>
																						<td> $row3->uraian </td>
																						<td width='35%'>  </td>
																						<td width='9%' class='c'> </td>
																						<td width='9%' class='c'> </td>
																						<td width='13%'> </td>
																					</tr>
																				</table>
																				</td>
																			</tr>
																			";
																			$abjadA = chr(ord($abjadA)+1);
																		}
																	}

																	echo "
																	<tr>
																		<td></td>
																		<td class='i'> B. Langkah Pemeriksaan </td>
																		<td></td>
																		<td></td>
																		<td></td>
																		<td></td>
																	</tr>
																	";

																	$abjadB = 'a';
																	foreach($sub2 as $row3)
																	{
																		$tgl = date('d-m-Y', strtotime($row3->tgl_kerja));
																		if($row3->kode_uraian == "$no_ins1-$no2-B")
																		{
																			echo "
																			<tr>
																				<td colspan='6'>
																				<table width='100%'>
																					<tr>
																						<td width='6%' class='r'> $abjadB. </td>
																						<td> $row3->uraian </td>
																						<td width='35%'>";
																							$no_plk = 1;
																							foreach($sub3 as $row4)
																							{
																								if($row4->sub_no_kka == $row3->no_kka)
																								{
																									echo "$no_plk. $row4->nama [$row4->jbtn_tim] <br/>";
																									$no_plk++;
																								}
																							}
																						echo " </td>
																						<td width='9%' class='c'> $tgl </td>
																						<td width='9%' class='c'> $row3->no_kka </td>
																						<td width='13%'> $row3->keterangan </td>
																					</tr>
																				</table>
																				</td>
																			</tr>
																			";
																			$abjadB = chr(ord($abjadB)+1);
																		}
																	}

																	echo "
																	<tr>
																		<td></td>
																		<td class='i'> C. Buatkan kesimpulan dalam kertas kerja </td>
																		<td></td>
																		<td></td>
																		<td></td>
																		<td></td>
																	</tr>
																	";

																	$no1++;
																	$no2++;
																	$no3 = $no2;
																}
															}

															echo "<tr><td colspan='6'>&nbsp;</td></tr>";

															$abj_ins1 = chr(ord($abj_ins1)+1);
															$no_ins1++;
														}
													}

													//-> KONDISI 1 INSTANSI
													else
													{
														$no1 = 1;
														foreach($sub1 as $row)
														{
															if($row->kategori == "2")
															{
																echo "
																<tr>
																	<td class='r'> $no1). </td>
																	<td class='b' colspan='5'> $row->jenis_pekerjaan </td>
																</tr>

																<tr>
																	<td></td>
																	<td class='i'> A. Tujuan Pemeriksaan </td>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																</tr>
																";

																$abjadA = 'a';
																foreach($sub2 as $row3)
																{
																	if($row3->kode_uraian == "$no2-A")
																	{
																		echo "
																		<tr>
																			<td colspan='6'>
																			<table width='100%'>
																				<tr>
																					<td width='6%' class='r'> $abjadA. </td>
																					<td> $row3->uraian </td>
																					<td width='35%'>  </td>
																					<td width='9%' class='c'> </td>
																					<td width='9%' class='c'> </td>
																					<td width='13%'> </td>
																				</tr>
																			</table>
																			</td>
																		</tr>
																		";
																		$abjadA = chr(ord($abjadA)+1);
																	}
																}

																echo "
																<tr>
																	<td></td>
																	<td class='i'> B. Langkah Pemeriksaan </td>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																</tr>
																";

																$abjadB = 'a';
																foreach($sub2 as $row3)
																{
																	$tgl = date('d-m-Y', strtotime($row3->tgl_kerja));
																	if($row3->kode_uraian == "$no2-B")
																	{
																		echo "
																		<tr>
																			<td colspan='6'>
																			<table width='100%'>
																				<tr>
																					<td width='6%' class='r'> $abjadB. </td>
																					<td> $row3->uraian </td>
																					<td width='35%'>";
																						$no_plk = 1;
																						foreach($sub3 as $row4)
																						{
																							if($row4->sub_no_kka == $row3->no_kka)
																							{
																								echo "$no_plk. $row4->nama [$row4->jbtn_tim] <br/>";
																								$no_plk++;
																							}
																						}
																					echo " </td>
																					<td width='9%' class='c'> $tgl </td>
																					<td width='9%' class='c'> $row3->no_kka </td>
																					<td width='13%'> $row3->keterangan </td>
																				</tr>
																			</table>
																			</td>
																		</tr>
																		";
																		$abjadB = chr(ord($abjadB)+1);
																	}
																}

																echo "
																<tr>
																	<td></td>
																	<td class='i'> C. Buatkan kesimpulan dalam kertas kerja </td>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																</tr>
																";

																$no1++;
																$no2++;
																$no3 = $no2;
															}
														}
													}													

													##########################################
													//--> BATAS KATEGORI
													##########################################

													echo "
													<tr><td colspan='6'><div class='hr hr-double hr-dotted hr18'></div></td></tr>
													<tr>
														<td> <h5 class='b'>3.</h5> </td>
														<td colspan='5'> <h5 class='b u'>PENYELESAIAN AUDIT</h5> </td>
													</tr>";

													//-> KONDISI LEBIH DARI 1 INSTANSI
													if(count($sasaran) != 0)
													{
														$abj_ins1 = 'A';
														$no_ins1  = 1;
														foreach ($ins as $key)
														{
															echo "
															<tr>
																<td class='r'><h5 class='b'> $abj_ins1). </h5></td>
																<td colspan='5'><h5 class='b'> $key->nama_instansi </h5></td>
															</tr>";

															$no1 = 1;
															foreach($sub1 as $row)
															{
																if($row->kategori == "3" && $row->nama_instansi == $key->nama_instansi)
																{
																	echo "
																	<tr>
																		<td class='r'> $no1). </td>
																		<td class='b' colspan='5'> $row->jenis_pekerjaan </td>
																	</tr>

																	<tr>
																		<td></td>
																		<td class='i'> A. Tujuan Pemeriksaan </td>
																		<td></td>
																		<td></td>
																		<td></td>
																		<td></td>
																	</tr>
																	";

																	$abjadA = 'a';
																	foreach($sub2 as $row3)
																	{
																		//$tgl = date('d-m-Y', strtotime($row3->tgl_kerja));
																		if($row3->kode_uraian == "$no_ins1-$no3-A")
																		{
																			echo "
																			<tr>
																				<td colspan='6'>
																				<table width='100%'>
																					<tr>
																						<td width='6%' class='r'> $abjadA. </td>
																						<td> $row3->uraian </td>
																						<td width='35%'>  </td>
																						<td width='9%' class='c'> </td>
																						<td width='9%' class='c'> </td>
																						<td width='13%'> </td>
																					</tr>
																				</table>
																				</td>
																			</tr>
																			";
																			$abjadA = chr(ord($abjadA)+1);
																		}
																	}

																	echo "
																	<tr>
																		<td></td>
																		<td class='i'> B. Langkah Pemeriksaan </td>
																		<td></td>
																		<td></td>
																		<td></td>
																		<td></td>
																	</tr>
																	";

																	$abjadB = 'a';
																	foreach($sub2 as $row3)
																	{
																		$tgl = date('d-m-Y', strtotime($row3->tgl_kerja));
																		if($row3->kode_uraian == "$no_ins1-$no3-B")
																		{
																			echo "
																			<tr>
																				<td colspan='6'>
																				<table width='100%'>
																					<tr>
																						<td width='6%' class='r'> $abjadB. </td>
																						<td> $row3->uraian </td>
																						<td width='35%'>";
																							$no_plk = 1;
																							foreach($sub3 as $row4)
																							{
																								if($row4->sub_no_kka == $row3->no_kka)
																								{
																									echo "$no_plk. $row4->nama [$row4->jbtn_tim] <br/>";
																									$no_plk++;
																								}
																							}
																						echo " </td>
																						<td width='9%' class='c'> $tgl </td>
																						<td width='9%' class='c'> $row3->no_kka </td>
																						<td width='13%'> $row3->keterangan </td>
																					</tr>
																				</table>
																				</td>
																			</tr>
																			";
																			$abjadB = chr(ord($abjadB)+1);
																		}
																	}

																	echo "
																	<tr>
																		<td></td>
																		<td class='i'> C. Buatkan kesimpulan dalam kertas kerja </td>
																		<td></td>
																		<td></td>
																		<td></td>
																		<td></td>
																	</tr>
																	";

																	$no1++;
																	$no3++;
																}
															}

															echo "<tr><td colspan='6'>&nbsp;</td></tr>";

															$abj_ins1 = chr(ord($abj_ins1)+1);
															$no_ins1++;
														}
													}

													//-> KONDISI 1 INSTANSI
													else
													{
														$no1 = 1;
														foreach($sub1 as $row)
														{
															if($row->kategori == "3")
															{
																echo "
																<tr>
																	<td class='r'> $no1). </td>
																	<td class='b' colspan='5'> $row->jenis_pekerjaan </td>
																</tr>

																<tr>
																	<td></td>
																	<td class='i'> A. Tujuan Pemeriksaan </td>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																</tr>
																";

																$abjadA = 'a';
																foreach($sub2 as $row3)
																{
																	if($row3->kode_uraian == "$no3-A")
																	{
																		echo "
																		<tr>
																			<td colspan='6'>
																			<table width='100%'>
																				<tr>
																					<td width='6%' class='r'> $abjadA. </td>
																					<td> $row3->uraian </td>
																					<td width='35%'>  </td>
																					<td width='9%' class='c'> </td>
																					<td width='9%' class='c'> </td>
																					<td width='13%'> </td>
																				</tr>
																			</table>
																			</td>
																		</tr>
																		";
																		$abjadA = chr(ord($abjadA)+1);
																	}
																}

																echo "
																<tr>
																	<td></td>
																	<td class='i'> B. Langkah Pemeriksaan </td>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																</tr>
																";

																$abjadB = 'a';
																foreach($sub2 as $row3)
																{
																	$tgl = date('d-m-Y', strtotime($row3->tgl_kerja));
																	if($row3->kode_uraian == "$no3-B")
																	{
																		echo "
																		<tr>
																			<td colspan='6'>
																			<table width='100%'>
																				<tr>
																					<td width='6%' class='r'> $abjadB. </td>
																					<td> $row3->uraian </td>
																					<td width='35%'>";
																						$no_plk = 1;
																						foreach($sub3 as $row4)
																						{
																							if($row4->sub_no_kka == $row3->no_kka)
																							{
																								echo "$no_plk. $row4->nama [$row4->jbtn_tim] <br/>";
																								$no_plk++;
																							}
																						}
																					echo " </td>
																					<td width='9%' class='c'> $tgl </td>
																					<td width='9%' class='c'> $row3->no_kka </td>
																					<td width='13%'> $row3->keterangan </td>
																				</tr>
																			</table>
																			</td>
																		</tr>
																		";
																		$abjadB = chr(ord($abjadB)+1);
																	}
																}

																echo "
																<tr>
																	<td></td>
																	<td class='i'> C. Buatkan kesimpulan dalam kertas kerja </td>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																</tr>
																";

																$no1++;
																$no3++;
															}
														}
													}
												?>							
											</table>

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
			//daltu
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