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
								<a href="<?= site_url('ketua_tim/home'); ?>"> Home </a>
							</li>
							<li>
								<a href="<?= site_url('ketua_tim/pka'); ?>"> Program Kerja Audit </a>
							</li>
							<li>
								<a href="<?= site_url('ketua_tim/pka/detail_pka/'.base64_encode($data->rev_pka1)); ?>"> Detail Program Kerja Audit </a>
							</li>
							<li class="active"> Detail Reviu Program Kerja Audit </li>
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">

						<div class="page-header">
							<h1>
								Detail Reviu Program Kerja Audit
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Melihat rincian reviu data program kerja audit (PKA)
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
														<i class="fa fa-file-text"></i> Data Reviu Program Kerja Audit
													</h3>

													<dl id="dt-list-1" class="dl-horizontal">
														<dt> Tanggal Reviu : </dt>
															<dd align="justify"><?= $tgl_rev; ?></dd>

														<dt> Reviu Ke : </dt>
															<dd align="justify"><?= $data->rev_ke; ?></dd>
													</dl>

													<center>
														<a href="<?= site_url('ketua_tim/pka/detail_pka/'.base64_encode($data->rev_pka1)); ?>" class="btn btn-sm btn-default"><i class="fa fa-arrow-left"></i> Kembali </a>
													</center>
												</div>

												<div class="col-sm-6">
													<h3 class="header">
														<i class="fa fa-recycle"></i> Hasil Reviu										
													</h3>

													<table width="100%" border="0">
														<tr>
															<td width="27%" class="pos-atas"> Tanggal Reviu DALNIS </td>
															<td width="3%" class="pos-atas"> : </td>
															<td> <?= $tgl_rev_dn; ?> </td>
														</tr>

														<tr>
															<td class="pos-atas"> Reviu DALNIS </td>
															<td class="pos-atas"> : </td>
															<td> 
																<?php 
																	if($data->rev_dalnis == "-")
																	{ echo "<i class='fa fa-check green'><strong> Tidak ada reviu </strong></i>"; }
																	else
																	{	echo "<span class='red'><strong> $data->rev_dalnis </strong></span>"; }
																?> 
															</td>
														</tr>

														<tr><td colspan="3"><hr/></td></tr>

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
																	if($data->rev_daltu == "-")
																	{ echo "<i class='fa fa-check green'><strong> Tidak ada reviu </strong></i>"; }
																	else
																	{	echo "<span class='red'><strong> $data->rev_daltu </strong></span>"; }
																?> 
															</td>
														</tr>
													</table>
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
													foreach($rev_pka2 as $row)
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
													<td colspan='5'> <h5 class='b u'>PERSIAPAN AUDIT</h5> </td>
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
															foreach($rev_pka2 as $row)
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
																	foreach($rev_pka3 as $row3)
																	{
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
																	foreach($rev_pka3 as $row3)
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
																							foreach($rev_pka4 as $row4)
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
														foreach($rev_pka2 as $row)
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
																foreach($rev_pka3 as $row3)
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
																foreach($rev_pka3 as $row3)
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
																						foreach($rev_pka4 as $row4)
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
															foreach($rev_pka2 as $row)
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
																	foreach($rev_pka3 as $row3)
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
																	foreach($rev_pka3 as $row3)
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
																							foreach($rev_pka4 as $row4)
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
														foreach($rev_pka2 as $row)
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
																foreach($rev_pka3 as $row3)
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
																foreach($rev_pka3 as $row3)
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
																						foreach($rev_pka4 as $row4)
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
															foreach($rev_pka2 as $row)
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
																	foreach($rev_pka3 as $row3)
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
																	foreach($rev_pka3 as $row3)
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
																							foreach($rev_pka4 as $row4)
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
														foreach($rev_pka2 as $row)
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
																foreach($rev_pka3 as $row3)
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
																foreach($rev_pka3 as $row3)
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
																						foreach($rev_pka4 as $row4)
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

	</body>
</html>