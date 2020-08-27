<?php
//--> include data header
$this->load->view('layout/header');
//--> include data top navigasi
$this->load->view('layout/top_nav');
//--> include data sidebar navigasi
$this->load->view('layout/nav_sidebar');

function Terbilang($x)
{
  $bil = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
  if ($x < 12)
    return "" . $bil[$x];
  elseif ($x < 20)
    return Terbilang($x - 10) . "belas";
  elseif ($x < 100)
    return Terbilang($x / 10) . " puluh" . Terbilang($x % 10);
  elseif ($x < 200)
    return " seratus" . Terbilang($x - 100);
  elseif ($x < 1000)
    return Terbilang($x / 100) . " ratus" . Terbilang($x % 100);
  elseif ($x < 2000)
    return " seribu" . Terbilang($x - 1000);
  elseif ($x < 1000000)
    return Terbilang($x / 1000) . " ribu" . Terbilang($x % 1000);
  elseif ($x < 1000000000)
    return Terbilang($x / 1000000) . " juta" . Terbilang($x % 1000000);
}
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
								<a href="<?= site_url('staff/data_surat'); ?>"> Surat Tugas </a>
							</li>
							<li class="active"> Detail Surat Tugas </li>
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">

						<div class="page-header">
							<h1>
								Detail Surat Tugas
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Melihat rincian data surat tugas yang diberikan kepada tim audit
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
														<i class="fa fa-file-text"></i> Data Surat Tugas
													</h3>

													<dl id="dt-list-1" class="dl-horizontal">
														<dt> Tangal Surat Tugas : </dt>
															<dd><?= $tgl_surat; ?></dd>

														<dt> Nomor Surat Tugas : </dt>
															<dd><?= $data->no_surat; ?></dd>

														<br/>

														<dt> Dasar Surat : </dt>
															<dd align="justify"><?= $data->dasar_surat; ?></dd>

														<br/>

														<dt> Perihal : </dt>
															<dd><?= $data->untuk; ?></dd>
																													
														<br/>

														<dt> Sasaran : </dt>
															<dd align="justify"><?= $data->sasaran_peng; ?></dd>

														<?php if($kategori == "Tim Pemeriksa") { ?>
														<br/>

														<dt> &nbsp; </dt>
														<?php 
															foreach($sasaran as $row)
															{
																if($row->sasaran != NULL)
																{ echo "<dd>$row->nomor. $row->sasaran</dd>"; }
															}
														}
														?>														

														<br/>

														<?php $lma = Terbilang($lama_wkt); $lama = ucwords($lma) ?>

														<dt> Waktu Pelaksanaan : </dt>
															<dd>Tanggal <?= $tgl_awal ." - ". $tgl_akhir ." | $lama_wkt ($lama) "; ?> Hari Kerja.</dd>

															<br/>

														<dt> Tembusan : </dt>
														<?php
															foreach($tembusan as $row)
															{
																if($row->tembusan != NULL)
																{ echo "<dd>$row->nomor. $row->tembusan</dd>"; }
															}
														?>

													</dl>
												</div>

												<div class="col-sm-6">
													<h3 class="header">
														<i class="fa fa-users"></i> Tim Pemeriksa														
													</h3>

													<dl id="dt-list-1" class="dl-horizontal">
														<?php if($kategori == "Tim Pemeriksa") { ?>
														<dt> Wakil Penanggung Jawab : </dt>
															<dd><?= $daltu->nama ." | ". $daltu->jabatan; ?></dd>
															
														<?php if($cek_tim->dalnis != NULL){ ?>
														<dt> Pengendali Teknis : </dt>
															<dd><?= $dalnis->nama; ?></dd>
															<br/>
														<?php } } ?>

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

													<center>
														<a href="<?= site_url('staff/data_surat'); ?>" class="btn btn-sm btn-default"><i class="fa fa-arrow-left"></i> Kembali </a>
														
														&nbsp;&nbsp;

														<?php 
															if($data->kategori_surat == "Tim Pemeriksa") 
															{	$link = "cetak_surat_tugas"; }
															else { $link = "cetak_surat_tugas_tl"; } 
														?>

														<?php if($data->tgl_persetujuan == NULL) { ?>
														<a href="#" class="btn btn-sm btn-danger" title="Tidak dapat mencetak surat tugas" disabled><i class="fa fa-print"></i> Cetak Surat Tugas </a>
														<?php } else { ?>
														<a href="<?= site_url('staff/data_surat/'.$link.'/'.base64_encode($data->no_st).'/'.base64_encode($data->id_tim)); ?>" class="btn btn-sm btn-danger" target="_blank"><i class="fa fa-print"></i> Cetak Surat Tugas </a>
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