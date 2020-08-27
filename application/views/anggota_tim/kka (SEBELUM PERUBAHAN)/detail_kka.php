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

	.pos-atas {vertical-align: top}

	.pad-3 {padding: 5px}
	.bot-bor {border-bottom: 1px black solid}

	.bg-color  {background-color: #f1f6a3}
	.bg-color5 {background-color: #1faeff}

	td {padding: 5px}
	th {padding: 5px}

	.modal-width {width: 70%}
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
								<a href="<?= site_url('anggota_tim/home'); ?>"> Home </a>
							</li>
							<li>
								<a href="<?= site_url('anggota_tim/kka'); ?>"> Kertas Kerja Audit </a>
							</li>
							<li class="active"> Detail Kertas Kerja Audit </li>
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">

						<div class="page-header">
							<h1>
								Detail Kertas Kerja Audit
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Melihat rincian data KKA anggota tim
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
												</div>

												<div class="col-sm-6">
													<h3 class="header">
														<i class="fa fa-bars"></i> Aksi Pilihan
													</h3>

													<center>
														<a href="<?= site_url('anggota_tim/kka'); ?>" class="btn btn-sm btn-default"><i class="fa fa-arrow-left"></i> Kembali </a>
													</center>

												</div>
											</div>

											<h3 class="header">
												<i class="fa fa-file-text-o"></i> Daftar Kertas Kerja Audit (KKA)
											</h3>

											<table width="100%" border="1">
												<tr>
													<th width="3%" class="c b bg-color"> No. </th>
													<th width="20%" class="c b bg-color"> Jenis Pekerjaan </th>
													<th width="7%" class="c b bg-color"> No. KKA </th>
													<th class="c b bg-color"> Uraian </th>
													<th width="13%" class="c b bg-color"> KKA </th>
													<th width="11%" class="c b bg-color"> Aksi </th>
													<th width="8%" class="c b bg-color"> Keputusan </th>
												</tr>

												<tr>
													<td> <h6 class='b'>1.</h6> </td>
													<td colspan='6'> <h6 class='b u'>PERSIAPAN AUDIT</h6> </td>
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
																<td class='r'><h6 class='b'> $abj_ins1). </h6></td>
																<td colspan='6'><h6 class='b'> $key->nama_instansi </h6></td>
															</tr>";
														}
													}


												 	$no=1;
													foreach($kka as $row)
													{
														//--> mengambil jumlah KKA di setiap jenis pekerjaan
														$cek1 = $this->db->select('*, count(*) as jml_kka')
																						->from('sub_pka3')
																						->join('sub_pka2', 'sub_pka2.no_kka = sub_pka3.sub_no_kka')
																						->where('kode_pekerjaan', $row->kode_pekerjaan)
																						->where('jbtn_tim', 'Anggota Tim')
																						->like('kode_uraian', 'B')
																						->get()->row();

														//--> mengambil jumlah KKA yang telah selesai (TIDAK ADA REVIU) di setiap jenis pekerjaan
														$cek2 = $this->db->select('*, count(*) as jml_kka_selesai')
																						->from('sub_pka3')
																						->join('sub_pka2', 'sub_pka2.no_kka = sub_pka3.sub_no_kka')
																						->where('kode_pekerjaan', $row->kode_pekerjaan)
																						->like('kode_uraian', 'B')
																						->where('keputusan_kka', 'selesai')
																						->get()->row();

														if($row->kategori == "1")
														{
															echo "
															<tr>
																<td class='r'> $no). </td>
																<td> $row->jenis_pekerjaan </td>
																<td class='c'> $row->sub_no_kka </td>
																<td> $row->uraian </td>
																<td class='c'>";
																	if($row->hasil_kka == NULL)
																	{
																		echo "<a href='".site_url('anggota_tim/kka/download_format_kka/'.base64_encode($data->id_tgs).'/'.base64_encode($row->sub_pka3).'/'.base64_encode($row->sub_no_kka).'/'.base64_encode($row->pelaksana))."' class='btn btn-sm btn-danger' title='Download format KKA'><i class='fa fa-file-text-o'></i> Format KKA </a>";
																	}
																	else
																	{
																		if($row->bukti_kka != NULL || $row->bukti_kka != "")
																		{
																			echo "
																			<div class='btn-group'>
																				<button data-toggle='dropdown' class='btn btn-sm btn-primary dropdown-toggle'>
																					<i class='fa fa-cloud-download'></i> Download
																					<i class='ace-icon fa fa-angle-down icon-on-right'></i>
																				</button>

																				<ul class='dropdown-menu dropdown-primary'>
																					<li>
																						<a href='".site_url('anggota_tim/kka/download_kka/'.base64_encode($row->hasil_kka))."' title='Download KKA'> Kertas Kerja Audit (KKA)</a>
																					</li>

																					<li>
																						<a href='".site_url('anggota_tim/kka/download_bukti_kka/'.base64_encode($row->bukti_kka))."' title='Download Bukti KKA'> Bukti Pendukung KKA</a>
																					</li>
																				</ul>
																			</div>";
																		}
																		else
																		{
																			echo "<a href='".site_url('anggota_tim/kka/download_kka/'.base64_encode($row->hasil_kka))."' class='btn btn-sm btn-primary' title='Download KKA'><i class='fa fa-cloud-download'></i> Download KKA </a>";
																		}
																	}
																echo "
																</td>
																<td class='c'>";
																	if(($row->reviu_kka_ketua == NULL) && ($row->reviu_kka_dalnis == NULL) && ($row->reviu_kka_daltu == NULL))
																	{
																		echo "
																		<a href='#modal-upload-kka' role='button' class='btn btn-sm btn-success' data-toggle='modal' data-id1='$row->sub_pka3' data-id2='$row->sub_no_kka' data-id3='$row->pelaksana' data-id4='$cek1->jml_kka' data-id5='$cek2->jml_kka_selesai' data-id6='$data->id_tgs' title='Upload hasil KKA'><i class='fa fa-cloud-upload'></i> Hasil KKA </a>";
																	}
																	else
																	{
																		echo "
																		<a href='#modal-detail-kka' role='button' class='btn btn-sm btn-warning' data-toggle='modal' data-id1='$row->sub_pka3' data-id2='$row->sub_no_kka' data-id3='$row->pelaksana' data-id4='$cek1->jml_kka' data-id5='$cek2->jml_kka_selesai' data-id6='$data->id_tgs' title='Detail KKA'><i class='fa fa-list'></i> Detail KKA </a>";
																	}
																echo "
																</td>
																<td class='c'>";
																	if($row->keputusan_kka == 'belum')
																		{ echo "-"; }
																	elseif($row->keputusan_kka == 'proses')
																		{ echo "<label class='orange' title='Sedang diproses'><i class='fa fa-spinner fa-pulse bigger-130'></i> Proses </label>"; }
																	elseif($row->keputusan_kka == 'reviu')
																		{ echo "<a href='#modal-reviu' role='button' data-toggle='modal' data-id1='$row->sub_pka3' data-id2='$row->sub_no_kka' data-id3='$row->pelaksana' title='Aksi reviu' class='red'><i class='fa fa-times bigger-130'></i> Reviu </a> "; }
																	else
																		{ echo "<label class='green' title='Selesai'><i class='fa fa-check bigger-130'></i> Selesai </label>"; }
																echo "
																</td>
															</tr>
															";
															$no++;
														}
													}

													echo "
													<tr>
														<td> <h6 class='b'>2.</h6> </td>
														<td colspan='6'> <h6 class='b'>PELAKSANAAN AUDIT</h6> </td>
													</tr>";

													$no2=1;
													foreach($kka as $row)
													{
														//--> mengambil jumlah KKA di setiap jenis pekerjaan
														$cek1 = $this->db->select('*, count(*) as jml_kka')
																						->from('sub_pka3')
																						->join('sub_pka2', 'sub_pka2.no_kka = sub_pka3.sub_no_kka')
																						->where('kode_pekerjaan', $row->kode_pekerjaan)
																						->where('jbtn_tim', 'Anggota Tim')
																						->like('kode_uraian', 'B')
																						->get()->row();

														//--> mengambil jumlah KKA yang telah selesai (TIDAK ADA REVIU) di setiap jenis pekerjaan
														$cek2 = $this->db->select('*, count(*) as jml_kka_selesai')
																						->from('sub_pka3')
																						->join('sub_pka2', 'sub_pka2.no_kka = sub_pka3.sub_no_kka')
																						->where('kode_pekerjaan', $row->kode_pekerjaan)
																						->like('kode_uraian', 'B')
																						->where('keputusan_kka', 'selesai')
																						->get()->row();

														if($row->kategori == "2")
														{
															echo "
															<tr>
																<td class='r'> $no2). </td>
																<td> $row->jenis_pekerjaan </td>
																<td class='c'> $row->sub_no_kka </td>
																<td> $row->uraian </td>
																<td class='c'>";
																	if($row->hasil_kka == NULL)
																	{
																		echo "<a href='".site_url('anggota_tim/kka/download_format_kka/'.base64_encode($data->id_tgs).'/'.base64_encode($row->sub_pka3).'/'.base64_encode($row->sub_no_kka).'/'.base64_encode($row->pelaksana))."' class='btn btn-sm btn-danger' title='Download format KKA'><i class='fa fa-file-text-o'></i> Format KKA </a>";
																	}
																	else
																	{
																		if($row->bukti_kka != NULL || $row->bukti_kka != "")
																		{
																			echo "
																			<div class='btn-group'>
																				<button data-toggle='dropdown' class='btn btn-sm btn-primary dropdown-toggle'>
																					<i class='fa fa-cloud-download'></i> Download
																					<i class='ace-icon fa fa-angle-down icon-on-right'></i>
																				</button>

																				<ul class='dropdown-menu dropdown-primary'>
																					<li>
																						<a href='".site_url('anggota_tim/kka/download_kka/'.base64_encode($row->hasil_kka))."' title='Download KKA'> Kertas Kerja Audit (KKA)</a>
																					</li>

																					<li>
																						<a href='".site_url('anggota_tim/kka/download_bukti_kka/'.base64_encode($row->bukti_kka))."' title='Download Bukti KKA'> Bukti Pendukung KKA</a>
																					</li>
																				</ul>
																			</div>";
																		}
																		else
																		{
																			echo "<a href='".site_url('anggota_tim/kka/download_kka/'.base64_encode($row->hasil_kka))."' class='btn btn-sm btn-primary' title='Download KKA'><i class='fa fa-cloud-download'></i> Download KKA </a>";
																		}
																	}
																echo "
																</td>
																<td class='c'>";
																	if(($row->reviu_kka_ketua == NULL) && ($row->reviu_kka_dalnis == NULL) && ($row->reviu_kka_daltu == NULL))
																	{
																		echo "
																		<a href='#modal-upload-kka' role='button' class='btn btn-sm btn-success' data-toggle='modal' data-id1='$row->sub_pka3' data-id2='$row->sub_no_kka' data-id3='$row->pelaksana' data-id4='$cek1->jml_kka' data-id5='$cek2->jml_kka_selesai' data-id6='$data->id_tgs' title='Upload hasil KKA'><i class='fa fa-cloud-upload'></i> Hasil KKA </a>";
																	}
																	else
																	{
																		echo "
																		<a href='#modal-detail-kka' role='button' class='btn btn-sm btn-warning' data-toggle='modal' data-id1='$row->sub_pka3' data-id2='$row->sub_no_kka' data-id3='$row->pelaksana' data-id4='$cek1->jml_kka' data-id5='$cek2->jml_kka_selesai' data-id6='$data->id_tgs' title='Detail KKA'><i class='fa fa-list'></i> Detail KKA </a>";
																	}
																echo "
																</td>
																<td class='c'>";
																	if($row->keputusan_kka == 'belum')
																		{ echo "-"; }
																	elseif($row->keputusan_kka == 'proses')
																		{ echo "<label class='orange' title='Sedang diproses'><i class='fa fa-spinner fa-pulse bigger-130'></i> Proses </label>"; }
																	elseif($row->keputusan_kka == 'reviu')
																		{ echo "<a href='#modal-reviu' role='button' data-toggle='modal' data-id1='$row->sub_pka3' data-id2='$row->sub_no_kka' data-id3='$row->pelaksana' title='Aksi reviu' class='red'><i class='fa fa-times bigger-130'></i> Reviu </a> "; }
																	else
																		{ echo "<label class='green' title='Selesai'><i class='fa fa-check bigger-130'></i> Selesai </label>"; }
																echo "
																</td>
															</tr>
															";
															$no2++;
														}
													}

													echo "
													<tr>
														<td> <h6 class='b'>3.</h6> </td>
														<td colspan='6'> <h6 class='b'>PENYELESAIAN AUDIT</h6> </td>
													</tr>";

													$no3=1;
													foreach($kka as $row)
													{
														//--> mengambil jumlah KKA di setiap jenis pekerjaan
														$cek1 = $this->db->select('*, count(*) as jml_kka')
																						->from('sub_pka3')
																						->join('sub_pka2', 'sub_pka2.no_kka = sub_pka3.sub_no_kka')
																						->where('kode_pekerjaan', $row->kode_pekerjaan)
																						->where('jbtn_tim', 'Anggota Tim')
																						->like('kode_uraian', 'B')
																						->get()->row();

														//--> mengambil jumlah KKA yang telah selesai (TIDAK ADA REVIU) di setiap jenis pekerjaan
														$cek2 = $this->db->select('*, count(*) as jml_kka_selesai')
																						->from('sub_pka3')
																						->join('sub_pka2', 'sub_pka2.no_kka = sub_pka3.sub_no_kka')
																						->where('kode_pekerjaan', $row->kode_pekerjaan)
																						->like('kode_uraian', 'B')
																						->where('keputusan_kka', 'selesai')
																						->get()->row();

														if($row->kategori == "3")
														{
															echo "
															<tr>
																<td class='r'> $no3). </td>
																<td> $row->jenis_pekerjaan </td>
																<td class='c'> $row->sub_no_kka </td>
																<td> $row->uraian </td>
																<td class='c'>";
																	if($row->hasil_kka == NULL)
																	{
																		echo "<a href='".site_url('anggota_tim/kka/download_format_kka/'.base64_encode($data->id_tgs).'/'.base64_encode($row->sub_pka3).'/'.base64_encode($row->sub_no_kka).'/'.base64_encode($row->pelaksana))."' class='btn btn-sm btn-danger' title='Download format KKA'><i class='fa fa-file-text-o'></i> Format KKA </a>";
																	}
																	else
																	{
																		if($row->bukti_kka != NULL || $row->bukti_kka != "")
																		{
																			echo "
																			<div class='btn-group'>
																				<button data-toggle='dropdown' class='btn btn-sm btn-primary dropdown-toggle'>
																					<i class='fa fa-cloud-download'></i> Download
																					<i class='ace-icon fa fa-angle-down icon-on-right'></i>
																				</button>

																				<ul class='dropdown-menu dropdown-primary'>
																					<li>
																						<a href='".site_url('anggota_tim/kka/download_kka/'.base64_encode($row->hasil_kka))."' title='Download KKA'> Kertas Kerja Audit (KKA)</a>
																					</li>

																					<li>
																						<a href='".site_url('anggota_tim/kka/download_bukti_kka/'.base64_encode($row->bukti_kka))."' title='Download Bukti KKA'> Bukti Pendukung KKA</a>
																					</li>
																				</ul>
																			</div>";
																		}
																		else
																		{
																			echo "<a href='".site_url('anggota_tim/kka/download_kka/'.base64_encode($row->hasil_kka))."' class='btn btn-sm btn-primary' title='Download KKA'><i class='fa fa-cloud-download'></i> Download KKA </a>";
																		}
																	}
																echo "
																</td>
																<td class='c'>";
																	if(($row->reviu_kka_ketua == NULL) && ($row->reviu_kka_dalnis == NULL) && ($row->reviu_kka_daltu == NULL))
																	{
																		echo "
																		<a href='#modal-upload-kka' role='button' class='btn btn-sm btn-success' data-toggle='modal' data-id1='$row->sub_pka3' data-id2='$row->sub_no_kka' data-id3='$row->pelaksana' data-id4='$cek1->jml_kka' data-id5='$cek2->jml_kka_selesai' data-id6='$data->id_tgs' title='Upload hasil KKA'><i class='fa fa-cloud-upload'></i> Hasil KKA </a>";
																	}
																	else
																	{
																		echo "
																		<a href='#modal-detail-kka' role='button' class='btn btn-sm btn-warning' data-toggle='modal' data-id1='$row->sub_pka3' data-id2='$row->sub_no_kka' data-id3='$row->pelaksana' data-id4='$cek1->jml_kka' data-id5='$cek2->jml_kka_selesai' data-id6='$data->id_tgs' title='Detail KKA'><i class='fa fa-list'></i> Detail KKA </a>";
																	}
																echo "
																</td>
																<td class='c'>";
																	if($row->keputusan_kka == 'belum')
																		{ echo "-"; }
																	elseif($row->keputusan_kka == 'proses')
																		{ echo "<label class='orange' title='Sedang diproses'><i class='fa fa-spinner fa-pulse bigger-130'></i> Proses </label>"; }
																	elseif($row->keputusan_kka == 'reviu')
																		{ echo "<a href='#modal-reviu' role='button' data-toggle='modal' data-id1='$row->sub_pka3' data-id2='$row->sub_no_kka' data-id3='$row->pelaksana' title='Aksi reviu' class='red'><i class='fa fa-times bigger-130'></i> Reviu </a> "; }
																	else
																		{ echo "<label class='green' title='Selesai'><i class='fa fa-check bigger-130'></i> Selesai </label>"; }
																echo "
																</td>
															</tr>
															";
															$no3++;
														}
													}
												?>
											</table> <br/>

											<h3 class="header col-sm-7">
												<i class="fa fa-file-text-o"></i> Daftar Kertas Kerja Audit (KKA) Ikhtisar
											</h3>

											<table width="64%" border="1">
												<tr>
													<th width="3%" class="c b bg-color"> No. </th>
													<th class="c b bg-color"> Jenis Pekerjaan </th>
													<th width="26%" class="c b bg-color"> KKA Ikhtisar </th>
													<th width="11%" class="c b bg-color"> Aksi </th>
													<th width="11%" class="c b bg-color"> Keputusan </th>
												</tr>

												<tr>
													<td> <h6 class='b'>1.</h6> </td>
													<td colspan='4'> <h6 class='b'>PERSIAPAN AUDIT</h6> </td>
												</tr>

												<?php
												 	$no=1;
													foreach($kka_ikhtisar as $row)
													{
														//--> mengambil jumlah KKA di setiap jenis pekerjaan
														$cek1 = $this->db->select('*, count(*) as jml_kka')
																						->from('sub_pka3')
																						->join('sub_pka2', 'sub_pka2.no_kka = sub_pka3.sub_no_kka')
																						->where('kode_pekerjaan', $row->kode_pekerjaan)
																						->where('jbtn_tim', 'Anggota Tim')
																						->like('kode_uraian', 'B')
																						->get()->row();

														//--> mengambil jumlah KKA yang telah selesai (TIDAK ADA REVIU) di setiap jenis pekerjaan
														$cek2 = $this->db->select('*, count(*) as jml_kka_fix')
																						->from('sub_pka3')
																						->join('sub_pka2', 'sub_pka2.no_kka = sub_pka3.sub_no_kka')
																						->where('kode_pekerjaan', $row->kode_pekerjaan)
																						->like('kode_uraian', 'B')
																						->where('keputusan_kka', 'selesai')
																						->get()->row();

														if($row->kategori == "1")
														{
															echo "
															<tr>
																<td class='r'> $no). </td>
																<td> $row->jenis_pekerjaan </td>
																<td class='c'>";
																	if($cek1->jml_kka == $cek2->jml_kka_fix)
																	{
																		if($row->kka_ikhtisar == NULL)
																		{
																			echo "<a href='".site_url('anggota_tim/kka/download_format_kka_ikhtisar/'.base64_encode($data->id_tgs).'/'.base64_encode($row->sub_pka3).'/'.base64_encode($row->kode_pekerjaan))."' class='btn btn-sm btn-danger' title='Download format KKA Ikhtisar'><i class='fa fa-file-text-o'></i> Format KKA Ikhtisar </a>";
																		}
																		else
																		{
																			echo "<a href='".site_url('anggota_tim/kka/download_kka_ikhtisar/'.base64_encode($row->kka_ikhtisar))."' class='btn btn-sm btn-primary' title='Download KKA Ikhtisar'><i class='fa fa-cloud-download'></i> Download KKA Ikhtisar </a>";
																		}
																	}
																	else
																	{
																		echo "<span class='orange control-label'><i class='fa fa-spinner fa-pulse bigger-130'></i> KKA Pendukung $cek2->jml_kka_fix dari $cek1->jml_kka </span>";
																	}
																echo "
																</td>
																<td class='c'>";
																	if($cek1->jml_kka == $cek2->jml_kka_fix)
																	{
																		if(($row->reviu_ketua == NULL) && ($row->reviu_dalnis == NULL) && ($row->reviu_daltu == NULL))
																		{
																			echo "
																			<a href='#modal-upload-kka-ikhtisar' role='button' class='btn btn-sm btn-success' data-toggle='modal' data-id1='$row->sub_pka3' data-id2='$row->kode_pekerjaan' title='Upload KKA Ikhtisar'><i class='fa fa-cloud-upload'></i> Hasil KKA </a>";
																		}
																		else
																		{
																			echo "
																			<a href='#modal-detail-kka-ikhtisar' role='button' class='btn btn-sm btn-warning' data-toggle='modal' data-id1='$row->sub_pka3' data-id2='$row->kode_pekerjaan' title='Detail KKA Ikhtisar'><i class='fa fa-list'></i> Detail KKA </a>";
																		}
																	}
																	else
																	{
																		echo "-";
																	}
																echo "
																</td>
																<td class='c'>";
																	if($row->keputusan_kka_ikhtisar == 'belum')
																		{ echo "-"; }
																	elseif($row->keputusan_kka_ikhtisar == 'proses')
																		{ echo "<label class='orange' title='Sedang diproses'><i class='fa fa-spinner fa-pulse bigger-130'></i> Proses </label>"; }
																	elseif($row->keputusan_kka_ikhtisar == 'reviu')
																		{ echo "<a href='#modal-reviu-ikhtisar' role='button' data-toggle='modal' data-id1='$row->sub_pka3' data-id2='$row->kode_pekerjaan' title='Aksi reviu kka ikhtisar' class='red'><i class='fa fa-times bigger-130'></i> Reviu </a> "; }
																	else
																		{ echo "<label class='green' title='Selesai'><i class='fa fa-check bigger-130'></i> Selesai </label>"; }
																echo "
																</td>
															</tr>
															";
															$no++;
														}
													}

													echo "
													<tr>
														<td> <h6 class='b'>2.</h6> </td>
														<td colspan='4'> <h6 class='b'>PELAKSANAAN AUDIT</h6> </td>
													</tr>";

													$no=1;
													foreach($kka_ikhtisar as $row)
													{
														//--> mengambil jumlah KKA di setiap jenis pekerjaan
														$cek1 = $this->db->select('*, count(*) as jml_kka')
																						->from('sub_pka3')
																						->join('sub_pka2', 'sub_pka2.no_kka = sub_pka3.sub_no_kka')
																						->where('kode_pekerjaan', $row->kode_pekerjaan)
																						->where('jbtn_tim', 'Anggota Tim')
																						->like('kode_uraian', 'B')
																						->get()->row();

														//--> mengambil jumlah KKA yang telah selesai (TIDAK ADA REVIU) di setiap jenis pekerjaan
														$cek2 = $this->db->select('*, count(*) as jml_kka_fix')
																						->from('sub_pka3')
																						->join('sub_pka2', 'sub_pka2.no_kka = sub_pka3.sub_no_kka')
																						->where('kode_pekerjaan', $row->kode_pekerjaan)
																						->like('kode_uraian', 'B')
																						->where('keputusan_kka', 'selesai')
																						->get()->row();

														if($row->kategori == "2")
														{
															echo "
															<tr>
																<td class='r'> $no). </td>
																<td> $row->jenis_pekerjaan </td>
																<td class='c'>";
																	if($cek1->jml_kka == $cek2->jml_kka_fix)
																	{
																		if($row->kka_ikhtisar == NULL)
																		{
																			echo "<a href='".site_url('anggota_tim/kka/download_format_kka_ikhtisar/'.base64_encode($data->id_tgs).'/'.base64_encode($row->sub_pka3).'/'.base64_encode($row->kode_pekerjaan))."' class='btn btn-sm btn-danger' title='Download format KKA Ikhtisar'><i class='fa fa-file-text-o'></i> Format KKA Ikhtisar </a>";
																		}
																		else
																		{
																			echo "<a href='".site_url('anggota_tim/kka/download_kka_ikhtisar/'.base64_encode($row->kka_ikhtisar))."' class='btn btn-sm btn-primary' title='Download KKA Ikhtisar'><i class='fa fa-cloud-download'></i> Download KKA Ikhtisar </a>";
																		}
																	}
																	else
																	{
																		echo "<span class='orange control-label'><i class='fa fa-spinner fa-pulse bigger-130'></i> KKA Pendukung $cek2->jml_kka_fix dari $cek1->jml_kka </span>";
																	}
																echo "
																</td>
																<td class='c'>";
																	if($cek1->jml_kka == $cek2->jml_kka_fix)
																	{
																		if(($row->reviu_ketua == NULL) && ($row->reviu_dalnis == NULL) && ($row->reviu_daltu == NULL))
																		{
																			echo "
																			<a href='#modal-upload-kka-ikhtisar' role='button' class='btn btn-sm btn-success' data-toggle='modal' data-id1='$row->sub_pka3' data-id2='$row->kode_pekerjaan' title='Upload KKA Ikhtisar'><i class='fa fa-cloud-upload'></i> Hasil KKA </a>";
																		}
																		else
																		{
																			echo "
																			<a href='#modal-detail-kka-ikhtisar' role='button' class='btn btn-sm btn-warning' data-toggle='modal' data-id1='$row->sub_pka3' data-id2='$row->kode_pekerjaan' title='Detail KKA Ikhtisar'><i class='fa fa-list'></i> Detail KKA </a>";
																		}
																	}
																	else
																	{
																		echo "-";
																	}
																echo "
																</td>
																<td class='c'>";
																	if($row->keputusan_kka_ikhtisar == 'belum')
																		{ echo "-"; }
																	elseif($row->keputusan_kka_ikhtisar == 'proses')
																		{ echo "<label class='orange' title='Sedang diproses'><i class='fa fa-spinner fa-pulse bigger-130'></i> Proses </label>"; }
																	elseif($row->keputusan_kka_ikhtisar == 'reviu')
																		{ echo "<a href='#modal-reviu-ikhtisar' role='button' data-toggle='modal' data-id1='$row->sub_pka3' data-id2='$row->kode_pekerjaan' title='Aksi reviu kka ikhtisar' class='red'><i class='fa fa-times bigger-130'></i> Reviu </a> "; }
																	else
																		{ echo "<label class='green' title='Selesai'><i class='fa fa-check bigger-130'></i> Selesai </label>"; }
																echo "
																</td>
															</tr>
															";
															$no++;
														}
													}

													echo "
													<tr>
														<td> <h6 class='b'>3.</h6> </td>
														<td colspan='4'> <h6 class='b'>PENYELESAIAN AUDIT</h6> </td>
													</tr>";

													$no=1;
													foreach($kka_ikhtisar as $row)
													{
														//--> mengambil jumlah KKA di setiap jenis pekerjaan
														$cek1 = $this->db->select('*, count(*) as jml_kka')
																						->from('sub_pka3')
																						->join('sub_pka2', 'sub_pka2.no_kka = sub_pka3.sub_no_kka')
																						->where('kode_pekerjaan', $row->kode_pekerjaan)
																						->where('jbtn_tim', 'Anggota Tim')
																						->like('kode_uraian', 'B')
																						->get()->row();

														//--> mengambil jumlah KKA yang telah selesai (TIDAK ADA REVIU) di setiap jenis pekerjaan
														$cek2 = $this->db->select('*, count(*) as jml_kka_fix')
																						->from('sub_pka3')
																						->join('sub_pka2', 'sub_pka2.no_kka = sub_pka3.sub_no_kka')
																						->where('kode_pekerjaan', $row->kode_pekerjaan)
																						->like('kode_uraian', 'B')
																						->where('keputusan_kka', 'selesai')
																						->get()->row();

														if($row->kategori == "3")
														{
															echo "
															<tr>
																<td class='r'> $no). </td>
																<td> $row->jenis_pekerjaan </td>
																<td class='c'>";
																	if($cek1->jml_kka == $cek2->jml_kka_fix)
																	{
																		if($row->kka_ikhtisar == NULL)
																		{
																			echo "<a href='".site_url('anggota_tim/kka/download_format_kka_ikhtisar/'.base64_encode($data->id_tgs).'/'.base64_encode($row->sub_pka3).'/'.base64_encode($row->kode_pekerjaan))."' class='btn btn-sm btn-danger' title='Download format KKA Ikhtisar'><i class='fa fa-file-text-o'></i> Format KKA Ikhtisar </a>";
																		}
																		else
																		{
																			echo "<a href='".site_url('anggota_tim/kka/download_kka_ikhtisar/'.base64_encode($row->kka_ikhtisar))."' class='btn btn-sm btn-primary' title='Download KKA Ikhtisar'><i class='fa fa-cloud-download'></i> Download KKA Ikhtisar </a>";
																		}
																	}
																	else
																	{
																		echo "<span class='orange control-label'><i class='fa fa-spinner fa-pulse bigger-130'></i> KKA Pendukung $cek2->jml_kka_fix dari $cek1->jml_kka </span>";
																	}
																echo "
																</td>
																<td class='c'>";
																	if($cek1->jml_kka == $cek2->jml_kka_fix)
																	{
																		if(($row->reviu_ketua == NULL) && ($row->reviu_dalnis == NULL) && ($row->reviu_daltu == NULL))
																		{
																			echo "
																			<a href='#modal-upload-kka-ikhtisar' role='button' class='btn btn-sm btn-success' data-toggle='modal' data-id1='$row->sub_pka3' data-id2='$row->kode_pekerjaan' title='Upload KKA Ikhtisar'><i class='fa fa-cloud-upload'></i> Hasil KKA </a>";
																		}
																		else
																		{
																			echo "
																			<a href='#modal-detail-kka-ikhtisar' role='button' class='btn btn-sm btn-warning' data-toggle='modal' data-id1='$row->sub_pka3' data-id2='$row->kode_pekerjaan' title='Detail KKA Ikhtisar'><i class='fa fa-list'></i> Detail KKA </a>";
																		}
																	}
																	else
																	{
																		echo "-";
																	}
																echo "
																</td>
																<td class='c'>";
																	if($row->keputusan_kka_ikhtisar == 'belum')
																		{ echo "-"; }
																	elseif($row->keputusan_kka_ikhtisar == 'proses')
																		{ echo "<label class='orange' title='Sedang diproses'><i class='fa fa-spinner fa-pulse bigger-130'></i> Proses </label>"; }
																	elseif($row->keputusan_kka_ikhtisar == 'reviu')
																		{ echo "<a href='#modal-reviu-ikhtisar' role='button' data-toggle='modal' data-id1='$row->sub_pka3' data-id2='$row->kode_pekerjaan' title='Aksi reviu kka ikhtisar' class='red'><i class='fa fa-times bigger-130'></i> Reviu </a> "; }
																	else
																		{ echo "<label class='green' title='Selesai'><i class='fa fa-check bigger-130'></i> Selesai </label>"; }
																echo "
																</td>
															</tr>
															";
															$no++;
														}
													}
												?>
											</table>

										</div>
									</div>
								</div>

								<div id="modal-upload-kka" class="modal fade" tabindex="-1">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h4 class="green bigger"> <i class="fa fa-cloud-upload"></i> Upload Hasil Kertas Kerja Audit (KKA)</h4>
											</div>

											<div class="modal-body">
												<div class="isi-data"></div>
											</div>

											<div class="modal-footer">
											</div>
										</div>
									</div>
								</div>

								<div id="modal-upload-kka-ikhtisar" class="modal fade" tabindex="-1">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h4 class="green bigger"> <i class="fa fa-cloud-upload"></i> Upload Hasil Kertas Kerja Audit (KKA) Ikhtisar</h4>
											</div>

											<div class="modal-body">
												<div class="isi2-data"></div>
											</div>

											<div class="modal-footer">
											</div>
										</div>
									</div>
								</div>

								<div id="modal-detail-kka" class="modal fade" tabindex="-1">
									<div class="modal-dialog"> <!-- simpan class disini untuk mengatur width modal : modal-width -->
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h4 class="orange bigger"> <i class="fa fa-list"></i> Detail Kertas Kerja Audit (KKA)</h4>
											</div>

											<div class="modal-body">
												<div class="detail-data"></div>
											</div>

											<div class="modal-footer">
												<button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><i class="fa fa-arrow-left"></i> Kembali </button>
											</div>
										</div>
									</div>
								</div>

								<div id="modal-detail-kka-ikhtisar" class="modal fade" tabindex="-1">
									<div class="modal-dialog"> <!-- simpan class disini untuk mengatur width modal : modal-width -->
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h4 class="orange bigger"> <i class="fa fa-list"></i> Detail Kertas Kerja Audit (KKA) Ikhtisar</h4>
											</div>

											<div class="modal-body">
												<div class="detail2-data"></div>
											</div>

											<div class="modal-footer">
												<button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><i class="fa fa-arrow-left"></i> Kembali </button>
											</div>
										</div>
									</div>
								</div>

								<div id="modal-reviu" class="modal fade" tabindex="-1">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h4 class="red bigger"> <i class="fa fa-recycle"></i> Reviu Kertas Kerja Audit (KKA)</h4>
											</div>

											<div class="modal-body">
												<div class="reviu-data"></div>
											</div>

											<div class="modal-footer">
												<button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><i class="fa fa-arrow-left"></i> Kembali </button>
											</div>
										</div>
									</div>
								</div>

								<div id="modal-reviu-ikhtisar" class="modal fade" tabindex="-1">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h4 class="red bigger"> <i class="fa fa-recycle"></i> Reviu Kertas Kerja Audit (KKA) Ikhtisar</h4>
											</div>

											<div class="modal-body">
												<div class="reviu2-data"></div>
											</div>

											<div class="modal-footer">
												<button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><i class="fa fa-arrow-left"></i> Kembali </button>
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
			/*jQuery(function($)
			{
				$('.id-input-file-2').ace_file_input({
					no_file:'Tidak ada File ...',
					btn_choose:'Pilih',
					btn_change:'Ubah',
					droppable:false,
					onchange:null,
					thumbnail:false, //| true | large
					//whitelist:'doc|docx',
					//blacklist:'exe|php'
					//onchange:''
					//
				});
			});*/

			$('#modal-upload-kka').on('show.bs.modal', function(e)
			{
        var id1 = $(e.relatedTarget).data('id1');
        var id2 = $(e.relatedTarget).data('id2');
        var id3 = $(e.relatedTarget).data('id3');
        var id4 = $(e.relatedTarget).data('id4');
        var id5 = $(e.relatedTarget).data('id5');
        var id6 = $(e.relatedTarget).data('id6');

        //menggunakan fungsi ajax untuk pengambilan data
        $.ajax({
            type : 'post',
            url  : "<?= site_url('anggota_tim/kka/form_upload_kka'); ?>",
            data : {id1:id1, id2:id2, id3:id3, id4:id4, id5:id5, id6:id6}, //'rowid='+ rowid,
            success : function(data)
            {
            	$('.isi-data').html(data); //menampilkan data ke dalam modal
            }
        });
	    });

	    $('#modal-upload-kka-ikhtisar').on('show.bs.modal', function(e)
			{
        var id1 = $(e.relatedTarget).data('id1');
        var id2 = $(e.relatedTarget).data('id2');

        //menggunakan fungsi ajax untuk pengambilan data
        $.ajax({
            type : 'post',
            url  : "<?= site_url('anggota_tim/kka/form_upload_kka_ikhtisar'); ?>",
            data : {id1:id1, id2:id2}, //'rowid='+ rowid,
            success : function(data)
            {
            	$('.isi2-data').html(data); //menampilkan data ke dalam modal
            }
        });
	    });

	    $('#modal-detail-kka').on('show.bs.modal', function(e)
			{
        var id1 = $(e.relatedTarget).data('id1');
        var id2 = $(e.relatedTarget).data('id2');
        var id3 = $(e.relatedTarget).data('id3');
        var id4 = $(e.relatedTarget).data('id4');
        var id5 = $(e.relatedTarget).data('id5');
        var id6 = $(e.relatedTarget).data('id6');

        //menggunakan fungsi ajax untuk pengambilan data
        $.ajax({
            type : 'post',
            url  : "<?= site_url('anggota_tim/kka/detail_sub_kka'); ?>",
            data : {id1:id1, id2:id2, id3:id3, id4:id4, id5:id5, id6:id6}, //'rowid='+ rowid,
            success : function(data)
            {
            	$('.detail-data').html(data); //menampilkan data ke dalam modal
            }
        });
	    });
	    
	    $('#modal-detail-kka-ikhtisar').on('show.bs.modal', function(e)
			{
        var id1 = $(e.relatedTarget).data('id1');
        var id2 = $(e.relatedTarget).data('id2');

        //menggunakan fungsi ajax untuk pengambilan data
        $.ajax({
            type : 'post',
            url  : "<?= site_url('anggota_tim/kka/detail_sub_kka_ikhtisar'); ?>",
            data : {id1:id1, id2:id2}, //'rowid='+ rowid,
            success : function(data)
            {
            	$('.detail2-data').html(data); //menampilkan data ke dalam modal
            }
        });
	    });

	    $('#modal-reviu').on('show.bs.modal', function(e)
			{
        var id1 = $(e.relatedTarget).data('id1');
        var id2 = $(e.relatedTarget).data('id2');
        var id3 = $(e.relatedTarget).data('id3');
        //menggunakan fungsi ajax untuk pengambilan data
        $.ajax({
            type : 'post',
            url  : "<?= site_url('anggota_tim/kka/detail_reviu'); ?>",
            data : {id1:id1, id2:id2, id3:id3},
            success : function(data)
            {
            	$('.reviu-data').html(data); //menampilkan data ke dalam modal
            }
        });
	    });
	    
	    $('#modal-reviu-ikhtisar').on('show.bs.modal', function(e)
			{
        var id1 = $(e.relatedTarget).data('id1');
        var id2 = $(e.relatedTarget).data('id2');
        //menggunakan fungsi ajax untuk pengambilan data
        $.ajax({
            type : 'post',
            url  : "<?= site_url('anggota_tim/kka/detail_reviu_ikhtisar'); ?>",
            data : {id1:id1, id2:id2},
            success : function(data)
            {
            	$('.reviu2-data').html(data); //menampilkan data ke dalam modal
            }
        });
	    });

			/*$('#rev').hide();
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
			});*/
		</script>
	</body>
</html>