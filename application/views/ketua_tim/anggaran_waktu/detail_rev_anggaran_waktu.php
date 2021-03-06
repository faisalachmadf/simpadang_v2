<?php
//--> include data header
$this->load->view('layout/header'); ?>

<style type="text/css">
	.u {text-decoration: underline}
	.i {font-style: italic}
	.b {font-weight: bold}
	.c {text-align: center}
	.r {text-align: right;}
	.j {text-align: justify}

	.pos-atas {vertical-align: top}

	.pad-3 {padding: 5px}
	.pad-10 {padding: 10px}

	.bg-color  {background-color: #f1f6a3}
	.bg-color2 {background-color: #ef0d0d}
	.bg-color3 {background-color: #cdcdcd}
	.bg-color4 {background-color: #685cdf}
	.bg-color5 {background-color: #1faeff}
	.color-white {color:white;}

	.modal-width {width: 80%}

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
								<a href="<?= site_url('ketua_tim/anggaran_waktu'); ?>"> Anggaran Waktu </a>
							</li>
							<li>
								<a href="<?= site_url('ketua_tim/anggaran_waktu/detail_anggaran_waktu/'.base64_encode($data->rev_agr1)); ?>"> Detail Anggaran Waktu </a>
							</li>
							<li class="active"> Detail Reviu Anggaran Waktu </li>
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">

						<div class="page-header">
							<h1>
								Detail Reviu Anggaran Waktu
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Melihat rincian reviu anggaran waktu audit
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
														<i class="fa fa-file-text"></i> Data Reviu Anggaran Waktu
													</h3>

													<dl id="dt-list-1" class="dl-horizontal">
														<dt> Tanggal Reviu : </dt>
															<dd align="justify"><?= $tgl_rev; ?></dd>

														<dt> Reviu Ke : </dt>
															<dd align="justify"><?= $data->rev_ke; ?></dd>
													</dl>

													<center>
														<a href="<?= site_url('ketua_tim/anggaran_waktu/detail_anggaran_waktu/'.base64_encode($data->rev_agr1)); ?>" class="btn btn-sm btn-default"><i class="fa fa-arrow-left"></i> Kembali </a>
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

														<!-- <tr><td colspan="3"><hr/></td></tr>

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
														</tr> -->
													</table>
												</div>
											</div> <br/>

											<table width="100%" border="1">
												<tr>
													<th width="30%" class="c bg-color pad-10">PERSIAPAN</th>
													<th class="c bg-color pad-10">PELAKSANAAN</th>
													<th width="30%" class="c bg-color pad-10">PENYELESAIAN</th>
												</tr>	

												<tr>
													<td class="c"><?= $tgl1_1; if($data->rev_tgl2_persiapan != NULL) { echo " s/d $tgl2_1"; }?></td>
													<td class="c"><?= $tgl1_2; if($data->rev_tgl2_pelaksanaan != NULL) { echo " s/d $tgl2_2"; }?></td>
													<td class="c"><?= $tgl1_3; if($data->rev_tgl2_penyelesaian != NULL) { echo " s/d $tgl2_3"; }?></td>
												</tr>											
											</table>

											<br/>

											<table width="100%" border="1">
												<tr>
													<th width="5%"></th>
													<th></th>
													<th width="13%"></th>
													<th width="13%"></th>
													<th width="13%"></th>
													<th width="13%"></th>
													<th width="13%"></th>
												</tr>

												<tr>
													<td colspan="2" class="c b bg-color"> JENIS KEGIATAN </td>
													<td class="c b bg-color">WAKIL PENANGGUNG JAWAB <br/> (HP/Jam)</td>
													<td class="c b bg-color">PENGENDALI TEKNIS <br/> (HP/Jam)</td>
													<td class="c b bg-color">KETUA TIM <br/> (HP/Jam)</td>
													<td class="c b bg-color">ANGGOTA TIM <br/> (HP/Jam)</td>
													<td class="c b bg-color">JUMLAH <br/> (HP/Jam)</td>
												</tr>

												<tr><td colspan="7">&nbsp;</td></tr>
												<tr>
													<td colspan="2"><i class='fa fa-circle'></i> PERSIAPAN AUDIT :</td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
												</tr>

												<?php
													$no1 = 1;
													foreach($anggaran as $row)
													{
														$tgl = date('d-m-Y', strtotime($row->tanggal));
														if($row->kategori == "1")
														{
															if($row->tugas_daltu == "aktif")
																{	$daltu = $row->hari_daltu ." ( $row->jam_daltu )"; }
															else
																{	$daltu = "-"; }

															if($row->tugas_dalnis == "aktif")
																{ $dalnis = $row->hari_dalnis ." ( $row->jam_dalnis )"; }
															else
																{ $dalnis = "-"; }

															if($row->tugas_ketua == "aktif")
																{	$ketua = $row->hari_ketua ." ( $row->jam_ketua )"; }
															else
																{ $ketua = "-"; }

															if($row->tugas_anggota == "aktif")
																{ $anggota = $row->hari_anggota ." ( $row->jam_anggota )"; }
															else
																{ $anggota = "-"; }

															echo "
															<tr>
																<td align='center'> $no1). </td>
																<td> $row->jenis_pekerjaan </td>
																<td class='pad-3 c'> $daltu </td>
																<td class='pad-3 c'> $dalnis </td>
																<td class='pad-3 c'> $ketua </td>
																<td class='pad-3 c'> $anggota </td>
																<td class='pad-3 c'> $row->jml_hari ( $row->jml_jam ) </td>
															</tr>
															";
															$no_sub = $row->kategori;

															$sub_hri_daltu1 += $row->hari_daltu;
															$sub_jam1 += $row->jam_daltu;
															$sub_jam_daltu1 = number_format($sub_jam1,2);

															$sub_hri_dalnis1 += $row->hari_dalnis;
															$sub_jam2 += $row->jam_dalnis;
															$sub_jam_dalnis1 = number_format($sub_jam2,2);

															$sub_hri_ketua1 += $row->hari_ketua;
															$sub_jam3 += $row->jam_ketua;
															$sub_jam_ketua1 = number_format($sub_jam3,2);

															$sub_hri_anggota1 += $row->hari_anggota;
															$sub_jam4 += $row->jam_anggota;
															$sub_jam_anggota1 = number_format($sub_jam4,2);
															
															$sub_hri_1 = $sub_hri_daltu1 + $sub_hri_dalnis1 + $sub_hri_ketua1 + $sub_hri_anggota1;
															$sub_jam5  = $sub_jam_daltu1 + $sub_jam_dalnis1 + $sub_jam_ketua1 + $sub_jam_anggota1;
															$sub_jam_1 = number_format($sub_jam5,2);
														}
														$no1++;														
													}

													echo "<tr>
																	<td colspan='2' class='c b bg-color3'> Sub Jumlah $no_sub </td>
																	<td class='c b bg-color4 color-white'> $sub_hri_daltu1 ( $sub_jam_daltu1 ) </td>
																	<td class='c b bg-color4 color-white'> $sub_hri_dalnis1 ( $sub_jam_dalnis1 ) </td>
																	<td class='c b bg-color4 color-white'> $sub_hri_ketua1 ( $sub_jam_ketua1 ) </td>
																	<td class='c b bg-color4 color-white'> $sub_hri_anggota1 ( $sub_jam_anggota1 ) </td>
																	<td class='c b bg-color4 color-white'> $sub_hri_1 ( $sub_jam_1 ) </td>
																</tr>";

													echo "<tr>
																	<td colspan='2'><i class='fa fa-circle'></i> PELAKSANAAN AUDIT :</td>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																</tr>";

													$no2 = 1;
													foreach($anggaran as $row)
													{
														$tgl = date('d-m-Y', strtotime($row->tanggal));
														if($row->kategori == "2")
														{
															if($row->tugas_daltu == "aktif")
																{	$daltu = $row->hari_daltu ." ( $row->jam_daltu )"; }
															else
																{	$daltu = "-"; }

															if($row->tugas_dalnis == "aktif")
																{ $dalnis = $row->hari_dalnis ." ( $row->jam_dalnis )"; }
															else
																{ $dalnis = "-"; }

															if($row->tugas_ketua == "aktif")
																{	$ketua = $row->hari_ketua ." ( $row->jam_ketua )"; }
															else
																{ $ketua = "-"; }

															if($row->tugas_anggota == "aktif")
																{ $anggota = $row->hari_anggota ." ( $row->jam_anggota )"; }
															else
																{ $anggota = "-"; }

															echo "
															<tr>
																<td align='center'> $no2). </td>
																<td> $row->jenis_pekerjaan </td>
																<td class='pad-3 c'> $daltu </td>
																<td class='pad-3 c'> $dalnis </td>
																<td class='pad-3 c'> $ketua </td>
																<td class='pad-3 c'> $anggota </td>
																<td class='pad-3 c'> $row->jml_hari ( $row->jml_jam ) </td>
															</tr>
															";
															$no_sub = $row->kategori;

															$sub_hri_daltu2 += $row->hari_daltu;
															$sub_jam11 += $row->jam_daltu;
															$sub_jam_daltu2 = number_format($sub_jam11,2);

															$sub_hri_dalnis2 += $row->hari_dalnis;
															$sub_jam22 += $row->jam_dalnis;
															$sub_jam_dalnis2 = number_format($sub_jam22,2);

															$sub_hri_ketua2 += $row->hari_ketua;
															$sub_jam33 += $row->jam_ketua;
															$sub_jam_ketua2 = number_format($sub_jam33,2);

															$sub_hri_anggota2 += $row->hari_anggota;
															$sub_jam44 += $row->jam_anggota;
															$sub_jam_anggota2 = number_format($sub_jam44,2);
															
															$sub_hri_2 = $sub_hri_daltu2 + $sub_hri_dalnis2 + $sub_hri_ketua2 + $sub_hri_anggota2;
															$sub_jam6  = $sub_jam_daltu2 + $sub_jam_dalnis2 + $sub_jam_ketua2 + $sub_jam_anggota2;
															$sub_jam_2 = number_format($sub_jam6,2);

															$no2++;
														}																													
													}

													echo "
														<tr>
															<td colspan='2' class='c b bg-color3'> Sub Jumlah $no_sub </td>
															<td class='c b bg-color4 color-white'> $sub_hri_daltu2 ( $sub_jam_daltu2 ) </td>
															<td class='c b bg-color4 color-white'> $sub_hri_dalnis2 ( $sub_jam_dalnis2 ) </td>
															<td class='c b bg-color4 color-white'> $sub_hri_ketua2 ( $sub_jam_ketua2 ) </td>
															<td class='c b bg-color4 color-white'> $sub_hri_anggota2 ( $sub_jam_anggota2 ) </td>
															<td class='c b bg-color4 color-white'> $sub_hri_2 ( $sub_jam_2 ) </td>
														</tr>

														<tr>
															<td colspan='2'><i class='fa fa-circle'></i> PENYELESAIAN AUDIT :</td>
															<td></td>
															<td></td>
															<td></td>
															<td></td>
															<td></td>
														</tr>";

													$no3 = 1;
													foreach($anggaran as $row)
													{
														$tgl = date('d-m-Y', strtotime($row->tanggal));
														if($row->kategori == "3")
														{
															if($row->tugas_daltu == "aktif")
																{	$daltu = $row->hari_daltu ." ( $row->jam_daltu )"; }
															else
																{	$daltu = "-"; }

															if($row->tugas_dalnis == "aktif")
																{ $dalnis = $row->hari_dalnis ." ( $row->jam_dalnis )"; }
															else
																{ $dalnis = "-"; }

															if($row->tugas_ketua == "aktif")
																{	$ketua = $row->hari_ketua ." ( $row->jam_ketua )"; }
															else
																{ $ketua = "-"; }

															if($row->tugas_anggota == "aktif")
																{ $anggota = $row->hari_anggota ." ( $row->jam_anggota )"; }
															else
																{ $anggota = "-"; }

															echo "
															<tr>
																<td align='center'> $no3). </td>
																<td> $row->jenis_pekerjaan </td>
																<td class='pad-3 c'> $daltu </td>
																<td class='pad-3 c'> $dalnis </td>
																<td class='pad-3 c'> $ketua </td>
																<td class='pad-3 c'> $anggota </td>
																<td class='pad-3 c'> $row->jml_hari ( $row->jml_jam ) </td>
															</tr>
															";
															$no_sub = $row->kategori;

															$sub_hri_daltu3 += $row->hari_daltu;
															$sub_jam111 += $row->jam_daltu;
															$sub_jam_daltu3 = number_format($sub_jam111,2);

															$sub_hri_dalnis3 += $row->hari_dalnis;
															$sub_jam222 += $row->jam_dalnis;
															$sub_jam_dalnis3 = number_format($sub_jam222,2);

															$sub_hri_ketua3 += $row->hari_ketua;
															$sub_jam333 += $row->jam_ketua;
															$sub_jam_ketua3 = number_format($sub_jam333,2);

															$sub_hri_anggota3 += $row->hari_anggota;
															$sub_jam444 += $row->jam_anggota;
															$sub_jam_anggota3 = number_format($sub_jam444,2);
															
															$sub_hri_3 = $sub_hri_daltu3 + $sub_hri_dalnis3 + $sub_hri_ketua3 + $sub_hri_anggota3;
															$sub_jam7  = $sub_jam_daltu3 + $sub_jam_dalnis3 + $sub_jam_ketua3 + $sub_jam_anggota3;
															$sub_jam_3 = number_format($sub_jam7,2);

															$no3++;	
														}																														
													} 

													$tot_hri_daltu = $sub_hri_daltu1 + $sub_hri_daltu2 + $sub_hri_daltu3;
													$jm_daltu = $sub_jam_daltu1 + $sub_jam_daltu2 + $sub_jam_daltu3;
													$tot_jam_daltu = number_format($jm_daltu,2);

													$tot_hri_dalnis = $sub_hri_dalnis1 + $sub_hri_dalnis2 + $sub_hri_dalnis3;
													$jm_dalnis = $sub_jam_dalnis1 + $sub_jam_dalnis2 + $sub_jam_dalnis3;
													$tot_jam_dalnis = number_format($jm_dalnis,2);

													$tot_hri_ketua = $sub_hri_ketua1 + $sub_hri_ketua2 + $sub_hri_ketua3;
													$jm_ketua = $sub_jam_ketua1 + $sub_jam_ketua2 + $sub_jam_ketua3;
													$tot_jam_ketua = number_format($jm_ketua,2);

													$tot_hri_anggota = $sub_hri_anggota1 + $sub_hri_anggota2 + $sub_hri_anggota3;
													$jm_anggota = $sub_jam_anggota1 + $sub_jam_anggota2 + $sub_jam_anggota3;
													$tot_jam_anggota = number_format($jm_anggota,2);

													$jml_tot_hri = $tot_hri_daltu + $tot_hri_dalnis + $tot_hri_ketua + $tot_hri_anggota;
													$tot_jam = $tot_jam_daltu + $tot_jam_dalnis + $tot_jam_ketua + $tot_jam_anggota;
													$jml_tot_jam = number_format($tot_jam,2);
												?>

												<tr>
													<td colspan='2' class='c b bg-color3'> <?= "Sub Jumlah ". $no_sub; ?> </td>
													<td class='c b bg-color4 color-white'> <?= $sub_hri_daltu3 ." ( $sub_jam_daltu3 )"; ?> </td>
													<td class='c b bg-color4 color-white'> <?= $sub_hri_dalnis3 ." ( $sub_jam_dalnis3 )"; ?> </td>
													<td class='c b bg-color4 color-white'> <?= $sub_hri_ketua3 ." ( $sub_jam_ketua3 )"; ?> </td>
													<td class='c b bg-color4 color-white'> <?= $sub_hri_anggota3 ." ( $sub_jam_anggota3 )"; ?> </td>
													<td class='c b bg-color4 color-white'> <?= $sub_hri_3 ." ( $sub_jam_3 )"; ?> </td>
												</tr>

												<tr>
													<td colspan="2" class="c b"> JUMLAH HARI/JAM AUDIT YANG DIANGGARKAN </td>
													<td class='c b bg-color2 color-white'> <?= $tot_hri_daltu ." ( $tot_jam_daltu )"; ?> </td>
													<td class='c b bg-color2 color-white'> <?= $tot_hri_dalnis ." ( $tot_jam_dalnis )"; ?> </td>
													<td class='c b bg-color2 color-white'> <?= $tot_hri_ketua ." ( $tot_jam_ketua )"; ?> </td>
													<td class='c b bg-color2 color-white'> <?= $tot_hri_anggota ." ( $tot_jam_anggota )"; ?> </td>
													<td class='c b bg-color2 color-white'> <?= $jml_tot_hri ." ( $jml_tot_jam )"; ?> </td>
												</tr>								
											</table>

										</div>
									</div>
								</div>

								<div id="modal-rev" class="modal fade" tabindex="-1">
									<div class="modal-dialog modal-width">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h4 class="blue bigger"> Reviu Anggaran Waktu</h4>
											</div>

											<div class="modal-body">
												<table width="100%" border="1">
													<tr>
														<th width="30%" class="c bg-color pad-10">PERSIAPAN</th>
														<th class="c bg-color pad-10">PELAKSANAAN</th>
														<th width="30%" class="c bg-color pad-10">PENYELESAIAN</th>
													</tr>	

													<tr>
														<td class="c"><?= $tgl1_1; if($data->tgl2_persiapan != NULL) { echo " s/d $tgl2_1"; }?></td>
														<td class="c"><?= $tgl1_2; if($data->tgl2_pelaksanaan != NULL) { echo " s/d $tgl2_2"; }?></td>
														<td class="c"><?= $tgl1_3; if($data->tgl2_penyelesaian != NULL) { echo " s/d $tgl2_3"; }?></td>
													</tr>											
												</table>

												<br/>

												<table width="100%" border="1">
													<tr>
														<th width="5%"></th>
														<th></th>
														<th width="13%"></th>
														<th width="13%"></th>
														<th width="13%"></th>
														<th width="13%"></th>
														<th width="13%"></th>
													</tr>

													<tr>
														<td colspan="2" class="c b bg-color"> JENIS KEGIATAN </td>
														<td class="c b bg-color">Wakil Penanggung Jawab <br/> (HP/Jam)</td>
														<td class="c b bg-color">PENGENDALI TEKNIS <br/> (HP/Jam)</td>
														<td class="c b bg-color">KETUA TIM <br/> (HP/Jam)</td>
														<td class="c b bg-color">ANGGOTA TIM <br/> (HP/Jam)</td>
														<td class="c b bg-color">JUMLAH <br/> (HP/Jam)</td>
													</tr>

													<tr><td colspan="7">&nbsp;</td></tr>
													<tr>
														<td colspan="2"><i class='fa fa-circle'></i> PERSIAPAN AUDIT :</td>
														<td></td>
														<td></td>
														<td></td>
														<td></td>
														<td></td>
													</tr>

													<?php
														$no1 = 1;
														foreach($anggaran as $row)
														{
															$tgl = date('d-m-Y', strtotime($row->tanggal));
															if($row->kategori == "1")
															{
																if($row->tugas_daltu == "aktif")
																	{	$daltu = $row->hari_daltu ." ( $row->jam_daltu )"; }
																else
																	{	$daltu = "-"; }

																if($row->tugas_dalnis == "aktif")
																	{ $dalnis = $row->hari_dalnis ." ( $row->jam_dalnis )"; }
																else
																	{ $dalnis = "-"; }

																if($row->tugas_ketua == "aktif")
																	{	$ketua = $row->hari_ketua ." ( $row->jam_ketua )"; }
																else
																	{ $ketua = "-"; }

																if($row->tugas_anggota == "aktif")
																	{ $anggota = $row->hari_anggota ." ( $row->jam_anggota )"; }
																else
																	{ $anggota = "-"; }

																echo "
																<tr>
																	<td align='center'> $no1). </td>
																	<td> $row->jenis_pekerjaan </td>
																	<td class='pad-3 c'> $daltu </td>
																	<td class='pad-3 c'> $dalnis </td>
																	<td class='pad-3 c'> $ketua </td>
																	<td class='pad-3 c'> $anggota </td>
																	<td class='pad-3 c'> $row->jml_hari ( $row->jml_jam ) </td>
																</tr>
																";
																$no_sub = $row->kategori;

																$sub_hri_daltu1 += $row->hari_daltu;
																$sub_jam1 += $row->jam_daltu;
																$sub_jam_daltu1 = number_format($sub_jam1,2);

																$sub_hri_dalnis1 += $row->hari_dalnis;
																$sub_jam2 += $row->jam_dalnis;
																$sub_jam_dalnis1 = number_format($sub_jam2,2);

																$sub_hri_ketua1 += $row->hari_ketua;
																$sub_jam3 += $row->jam_ketua;
																$sub_jam_ketua1 = number_format($sub_jam3,2);

																$sub_hri_anggota1 += $row->hari_anggota;
																$sub_jam4 += $row->jam_anggota;
																$sub_jam_anggota1 = number_format($sub_jam4,2);
																
																$sub_hri_1 = $sub_hri_daltu1 + $sub_hri_dalnis1 + $sub_hri_ketua1 + $sub_hri_anggota1;
																$sub_jam5  = $sub_jam_daltu1 + $sub_jam_dalnis1 + $sub_jam_ketua1 + $sub_jam_anggota1;
																$sub_jam_1 = number_format($sub_jam5,2);
															}
															$no1++;														
														}

														echo "<tr>
																		<td colspan='2' class='c b bg-color3'> Sub Jumlah $no_sub </td>
																		<td class='c b bg-color4 color-white'> $sub_hri_daltu1 ( $sub_jam_daltu1 ) </td>
																		<td class='c b bg-color4 color-white'> $sub_hri_dalnis1 ( $sub_jam_dalnis1 ) </td>
																		<td class='c b bg-color4 color-white'> $sub_hri_ketua1 ( $sub_jam_ketua1 ) </td>
																		<td class='c b bg-color4 color-white'> $sub_hri_anggota1 ( $sub_jam_anggota1 ) </td>
																		<td class='c b bg-color4 color-white'> $sub_hri_1 ( $sub_jam_1 ) </td>
																	</tr>";

														echo "<tr>
																		<td colspan='2'><i class='fa fa-circle'></i> PELAKSANAAN AUDIT :</td>
																		<td></td>
																		<td></td>
																		<td></td>
																		<td></td>
																		<td></td>
																	</tr>";

														$no2 = 1;
														foreach($anggaran as $row)
														{
															$tgl = date('d-m-Y', strtotime($row->tanggal));
															if($row->kategori == "2")
															{
																if($row->tugas_daltu == "aktif")
																	{	$daltu = $row->hari_daltu ." ( $row->jam_daltu )"; }
																else
																	{	$daltu = "-"; }

																if($row->tugas_dalnis == "aktif")
																	{ $dalnis = $row->hari_dalnis ." ( $row->jam_dalnis )"; }
																else
																	{ $dalnis = "-"; }

																if($row->tugas_ketua == "aktif")
																	{	$ketua = $row->hari_ketua ." ( $row->jam_ketua )"; }
																else
																	{ $ketua = "-"; }

																if($row->tugas_anggota == "aktif")
																	{ $anggota = $row->hari_anggota ." ( $row->jam_anggota )"; }
																else
																	{ $anggota = "-"; }

																echo "
																<tr>
																	<td align='center'> $no2). </td>
																	<td> $row->jenis_pekerjaan </td>
																	<td class='pad-3 c'> $daltu </td>
																	<td class='pad-3 c'> $dalnis </td>
																	<td class='pad-3 c'> $ketua </td>
																	<td class='pad-3 c'> $anggota </td>
																	<td class='pad-3 c'> $row->jml_hari ( $row->jml_jam ) </td>
																</tr>
																";
																$no_sub = $row->kategori;

																$sub_hri_daltu2 += $row->hari_daltu;
																$sub_jam11 += $row->jam_daltu;
																$sub_jam_daltu2 = number_format($sub_jam11,2);

																$sub_hri_dalnis2 += $row->hari_dalnis;
																$sub_jam22 += $row->jam_dalnis;
																$sub_jam_dalnis2 = number_format($sub_jam22,2);

																$sub_hri_ketua2 += $row->hari_ketua;
																$sub_jam33 += $row->jam_ketua;
																$sub_jam_ketua2 = number_format($sub_jam33,2);

																$sub_hri_anggota2 += $row->hari_anggota;
																$sub_jam44 += $row->jam_anggota;
																$sub_jam_anggota2 = number_format($sub_jam44,2);
																
																$sub_hri_2 = $sub_hri_daltu2 + $sub_hri_dalnis2 + $sub_hri_ketua2 + $sub_hri_anggota2;
																$sub_jam6  = $sub_jam_daltu2 + $sub_jam_dalnis2 + $sub_jam_ketua2 + $sub_jam_anggota2;
																$sub_jam_2 = number_format($sub_jam6,2);

																$no2++;
															}																													
														}

														echo "
															<tr>
																<td colspan='2' class='c b bg-color3'> Sub Jumlah $no_sub </td>
																<td class='c b bg-color4 color-white'> $sub_hri_daltu2 ( $sub_jam_daltu2 ) </td>
																<td class='c b bg-color4 color-white'> $sub_hri_dalnis2 ( $sub_jam_dalnis2 ) </td>
																<td class='c b bg-color4 color-white'> $sub_hri_ketua2 ( $sub_jam_ketua2 ) </td>
																<td class='c b bg-color4 color-white'> $sub_hri_anggota2 ( $sub_jam_anggota2 ) </td>
																<td class='c b bg-color4 color-white'> $sub_hri_2 ( $sub_jam_2 ) </td>
															</tr>

															<tr>
																<td colspan='2'><i class='fa fa-circle'></i> PENYELESAIAN AUDIT :</td>
																<td></td>
																<td></td>
																<td></td>
																<td></td>
																<td></td>
															</tr>";

														$no3 = 1;
														foreach($anggaran as $row)
														{
															$tgl = date('d-m-Y', strtotime($row->tanggal));
															if($row->kategori == "3")
															{
																if($row->tugas_daltu == "aktif")
																	{	$daltu = $row->hari_daltu ." ( $row->jam_daltu )"; }
																else
																	{	$daltu = "-"; }

																if($row->tugas_dalnis == "aktif")
																	{ $dalnis = $row->hari_dalnis ." ( $row->jam_dalnis )"; }
																else
																	{ $dalnis = "-"; }

																if($row->tugas_ketua == "aktif")
																	{	$ketua = $row->hari_ketua ." ( $row->jam_ketua )"; }
																else
																	{ $ketua = "-"; }

																if($row->tugas_anggota == "aktif")
																	{ $anggota = $row->hari_anggota ." ( $row->jam_anggota )"; }
																else
																	{ $anggota = "-"; }

																echo "
																<tr>
																	<td align='center'> $no3). </td>
																	<td> $row->jenis_pekerjaan </td>
																	<td class='pad-3 c'> $daltu </td>
																	<td class='pad-3 c'> $dalnis </td>
																	<td class='pad-3 c'> $ketua </td>
																	<td class='pad-3 c'> $anggota </td>
																	<td class='pad-3 c'> $row->jml_hari ( $row->jml_jam ) </td>
																</tr>
																";
																$no_sub = $row->kategori;

																$sub_hri_daltu3 += $row->hari_daltu;
																$sub_jam111 += $row->jam_daltu;
																$sub_jam_daltu3 = number_format($sub_jam111,2);

																$sub_hri_dalnis3 += $row->hari_dalnis;
																$sub_jam222 += $row->jam_dalnis;
																$sub_jam_dalnis3 = number_format($sub_jam222,2);

																$sub_hri_ketua3 += $row->hari_ketua;
																$sub_jam333 += $row->jam_ketua;
																$sub_jam_ketua3 = number_format($sub_jam333,2);

																$sub_hri_anggota3 += $row->hari_anggota;
																$sub_jam444 += $row->jam_anggota;
																$sub_jam_anggota3 = number_format($sub_jam444,2);
																
																$sub_hri_3 = $sub_hri_daltu3 + $sub_hri_dalnis3 + $sub_hri_ketua3 + $sub_hri_anggota3;
																$sub_jam7  = $sub_jam_daltu3 + $sub_jam_dalnis3 + $sub_jam_ketua3 + $sub_jam_anggota3;
																$sub_jam_3 = number_format($sub_jam7,2);

																$no3++;	
															}																														
														} 

														$tot_hri_daltu = $sub_hri_daltu1 + $sub_hri_daltu2 + $sub_hri_daltu3;
														$jm_daltu = $sub_jam_daltu1 + $sub_jam_daltu2 + $sub_jam_daltu3;
														$tot_jam_daltu = number_format($jm_daltu,2);

														$tot_hri_dalnis = $sub_hri_dalnis1 + $sub_hri_dalnis2 + $sub_hri_dalnis3;
														$jm_dalnis = $sub_jam_dalnis1 + $sub_jam_dalnis2 + $sub_jam_dalnis3;
														$tot_jam_dalnis = number_format($jm_dalnis,2);

														$tot_hri_ketua = $sub_hri_ketua1 + $sub_hri_ketua2 + $sub_hri_ketua3;
														$jm_ketua = $sub_jam_ketua1 + $sub_jam_ketua2 + $sub_jam_ketua3;
														$tot_jam_ketua = number_format($jm_ketua,2);

														$tot_hri_anggota = $sub_hri_anggota1 + $sub_hri_anggota2 + $sub_hri_anggota3;
														$jm_anggota = $sub_jam_anggota1 + $sub_jam_anggota2 + $sub_jam_anggota3;
														$tot_jam_anggota = number_format($jm_anggota,2);

														$jml_tot_hri = $tot_hri_daltu + $tot_hri_dalnis + $tot_hri_ketua + $tot_hri_anggota;
														$tot_jam = $tot_jam_daltu + $tot_jam_dalnis + $tot_jam_ketua + $tot_jam_anggota;
														$jml_tot_jam = number_format($tot_jam,2);
													?>

													<tr>
														<td colspan='2' class='c b bg-color3'> <?= "Sub Jumlah ". $no_sub; ?> </td>
														<td class='c b bg-color4 color-white'> <?= $sub_hri_daltu3 ." ( $sub_jam_daltu3 )"; ?> </td>
														<td class='c b bg-color4 color-white'> <?= $sub_hri_dalnis3 ." ( $sub_jam_dalnis3 )"; ?> </td>
														<td class='c b bg-color4 color-white'> <?= $sub_hri_ketua3 ." ( $sub_jam_ketua3 )"; ?> </td>
														<td class='c b bg-color4 color-white'> <?= $sub_hri_anggota3 ." ( $sub_jam_anggota3 )"; ?> </td>
														<td class='c b bg-color4 color-white'> <?= $sub_hri_3 ." ( $sub_jam_3 )"; ?> </td>
													</tr>

													<tr>
														<td colspan="2" class="c b"> JUMLAH HARI/JAM AUDIT YANG DIANGGARKAN </td>
														<td class='c b bg-color2 color-white'> <?= $tot_hri_daltu ." ( $tot_jam_daltu )"; ?> </td>
														<td class='c b bg-color2 color-white'> <?= $tot_hri_dalnis ." ( $tot_jam_dalnis )"; ?> </td>
														<td class='c b bg-color2 color-white'> <?= $tot_hri_ketua ." ( $tot_jam_ketua )"; ?> </td>
														<td class='c b bg-color2 color-white'> <?= $tot_hri_anggota ." ( $tot_jam_anggota )"; ?> </td>
														<td class='c b bg-color2 color-white'> <?= $jml_tot_hri ." ( $jml_tot_jam )"; ?> </td>
													</tr>								
												</table>
											</div>

											<div class="modal-footer">
												<button class="btn btn-sm" data-dismiss="modal">
													<i class="ace-icon fa fa-arrow-left"></i>
													Kembali
												</button>
											</div>
										</div>
									</div>
								</div><!-- PAGE CONTENT ENDS -->

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