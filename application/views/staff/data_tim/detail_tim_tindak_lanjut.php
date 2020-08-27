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
								<a href="<?= site_url('adum/home'); ?>"> Home </a>
							</li>
							<li>
								<a href="<?= site_url('adum/data_tim'); ?>"> Data Tim </a>
							</li>
							<li class="active"> Detail Tim Tindak Lanjut </li>
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">

						<div class="page-header">
							<h1>
								Detail Tim Tindak Lanjut
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Melihat rincian data tim tindak lanjut
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
														<i class="fa fa-users"></i> Tim Tindak Lanjut
													</h3>

													<dl id="dt-list-1" class="dl-horizontal">
														<dt> Ketua Tim : </dt>
															<dd><?= $data->ketua_tim; ?></dd>

														<dt> Anggota : </dt>
														<?php
															foreach($tim as $row)
															{
																if($row->anggota != NULL)
																{ echo "<dd>$row->nomor. $row->anggota</dd>"; }
															}
														?>

														<div class="hr hr-double dotted"></div>

														<dt> Sasaran : </dt>
														<?php
															foreach($tim as $row)
															{
																if($row->sasaran != NULL)
																{
																	if($jml_sas->jml < 2)
																	{ $no = ""; } else { $no = $row->nomor ."."; }
																	echo "<dd>$no $row->sasaran</dd>";
																}
															}
														?>
													</dl>
												</div>

												<div class="col-sm-6">
													<h3 class="header">
														<i class="fa fa-file-text"></i> Surat Tim Tindak Lanjut
													</h3>

													<dl id="dt-list-1" class="dl-horizontal">
														<dt> Tanggal Surat : </dt>
															<dd><?= $tgl_surat; ?></dd>

														<dt> Nomor Surat : </dt>
															<dd><?= $data->no_surat; ?></dd>

															<br/>

														<dt> Dasar : </dt>
														<?php
															foreach($surat as $row)
															{
																if($row->dasar != NULL)
																{ echo "<dd>$row->dasar</dd>"; }
															}
														?>

														<br/>

														<dt> Perihal : </dt>
															<dd><?= $data->untuk; ?></dd>

															<?php $lma = Terbilang($lama_wkt); $lama = ucwords($lma) ?>

														<dt> Waktu Pelaksanaan : </dt>
															<dd>Tanggal <?= $tgl_awal ." - ". $tgl_akhir ." $lama_wkt ($lama) "; ?> Hari Kerja.</dd>

														<dt> Tembusan : </dt>
														<?php
															foreach($surat as $row)
															{
																if($row->tembusan != NULL)
																{ echo "<dd>$row->nomor. $row->tembusan</dd>"; }
															}
														?>
													</dl>

													<center>
														<a href="<?= site_url('adum/data_tim'); ?>" class="btn btn-sm btn-default"><i class="fa fa-arrow-left"></i> Kembali </a>
														&nbsp;&nbsp;
														<a href="<?= site_url('adum/data_tim/cetak_surat_tindak/'.base64_encode($data->id_tim)); ?>" class="btn btn-sm btn-danger" target="_blank"><i class="fa fa-print"></i> Cetak Surat Tindak Lanjut </a>
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