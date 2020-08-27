<?php
error_reporting(E_ALL^(E_WARNING|E_NOTICE));
//--> include data header
$this->load->view('layout/header');
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
					<a href="<?= site_url('evlap/home'); ?>">Home</a>
				</li>
				<li class="active"> Detail Temuan </li>
			</ul><!-- /.breadcrumb -->
		</div>

		<div class="page-content">
			<div class="page-header">
				<h1>Tambah Temuan
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						Detail data
					</small>
				</h1>
			</div><!-- /.page-header -->

			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->
					<form id="validasi" class="form-horizontal" role="form" action="<?php site_url('ketua_tim/tindak_lanjut/tambah'); ?>" method="post">
						<div class="row">
							<div class="col-md-12">

								<div class="widget-box">
									<div class="widget-header">
										<h4 class="widget-title">
											<i class="menu-icon fa fa-pencil-square-o"></i>
											Detail Temuan
										</h4>

										<div class="widget-toolbar">
											<a href="#" data-action="collapse">
												<i class="ace-icon fa fa-chevron-up"></i>
											</a>
										</div>
									</div>

									<div class="widget-body">
										<div class="widget-main">

											<div class="form-group">
												<label class="col-sm-3 control-label no-padding-right"></label>
												<div class="col-sm-5">
													<h4 class="header center"> Detail temuan </h4>
												</div>
											</div>


											<div class="form-group">
												<label class="col-sm-3 control-label no-padding-right"> Objek :</label>
												<div class="col-sm-9">
													<label class="control-label"> <?= $temuan->instansi; ?></label>
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-3 control-label no-padding-right"> Kategori :</label>
												<div class="col-sm-9">
													<label class="control-label"> <?= $temuan->kategori_lhp; ?> </label>
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-3 control-label no-padding-right"> Kategori :</label>
												<div class="col-sm-9">
													<label class="control-label"> <?= $temuan->kategori_lhp; ?> </label>
												</div>
											</div>
											
											<div class="form-group">
												<label class="col-sm-3 control-label no-padding-right"> No LHP :</label>
												<div class="col-sm-5">
													<label class="control-label"> <?= $temuan->no_lhp; ?> </label>
												</div>
											</div>


											<div class="form-group">
												<label class="col-sm-3 control-label no-padding-right"> Tanggal LHP :</label>
												<div class="col-sm-5">
													<label class="control-label"> <?= $temuan->tgl_lhp; ?> </label>
												</div>
											</div>

											<br>
											<br>
											<div class="tabbable">
												<ul class="nav nav-tabs padding-12 tab-color-blue background-blue" id="myTab4">
													<li class="active">
														<a data-toggle="tab" href="#tab_spi" aria-expanded="true">Sistem Pengendalian Internal</a>
													</li>
													<li class="">
														<a data-toggle="tab" href="#tab_e3" aria-expanded="false">Efektif, Efisien, Ekonomis</a>
													</li>
													<li class="">
														<a data-toggle="tab" href="#tab_kepatuhan" aria-expanded="false">Kepatuhan Terhadap UU</a>
													</li>
												</ul>

												<div class="tab-content">
													<div id="tab_spi" class="tab-pane active">
														<!-- st tab -->
														<!-- SPI -->
<div class="kategori">
	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right"></label>
		<div class="col-sm-5">
			<h3 class="header left">Sistem Pengendalian Internal (SPI)</h3>
		</div>
	</div>
	<?php $no_spi = 1;
	foreach ($aspek as $spi)
	{
		$id  = $spi->id_temuan;

		if($spi->aspek == "spi")
		{
			echo "<div class='well'>";
			echo "
				<div class='form-group'>
					<label class='col-sm-3 control-label no-padding-right'>Kode Temuan :</label>
					<div class='col-sm-5'>
						<label class='control-label'> $spi->kode_temuan </label>
					</div>
				</div>

				<div class='form-group'>
					<label class='col-sm-3 control-label no-padding-right'>Temuan :</label>
					<div class='col-sm-5'>
						<label class='control-label'> $spi->judul </label>
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-3 control-label no-padding-right'>Nilai :</label>
					<div class='col-sm-5'>
						<label class='control-label'> $spi->nilai </label>
					</div>
				</div>
				<div class='form-group'><label class='col-sm-3 control-label no-padding-right'></label><div class='col-sm-5'><b>PEJABAT TERKAIT</b></div></div>
				<div class='form-group'>
					<label class='col-sm-3 control-label no-padding-right'>Nama :</label>
					<div class='col-sm-5'>
						<label class='control-label'> $spi->nm_pejabat </label>
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-3 control-label no-padding-right'>NIP :</label>
					<div class='col-sm-5'>
						<label class='control-label'> $spi->nip </label>
					</div>
				</div>
			";

			echo "
			<div class='form-group'><label class='col-sm-3 control-label no-padding-right'></label><div class='col-sm-5'><b>REKOMENDASI</b></div></div>
			";
			$no_spi_rek = 1;

			foreach ($temuan_rekomendasi as $rek_spi)
			{
				$id  = $rek_spi->id_temuan;

				if($rek_spi->aspek == "spi" && $spi->id_temuan_aspek == $rek_spi->id_temuan_aspek)
				{
					echo "
					<div class='form-group'>
						<label class='col-sm-3 control-label no-padding-right'>Kode Rekomendasi :</label>
						<div class='col-sm-5'>
							<label class='control-label'> $rek_spi->kode_rekomendasi </label>
						</div>
					</div>

					<div class='form-group'>
						<label class='col-sm-3 control-label no-padding-right'>Uraian :</label>
						<div class='col-sm-5'>
							<label class='control-label'> $rek_spi->uraian </label>
						</div>
					</div>
					<div class='form-group'>
						<label class='col-sm-3 control-label no-padding-right'>Nilai :</label>
						<div class='col-sm-5'>
							<label class='control-label'> $rek_spi->nilai</label>
						</div>
					</div>
					";
				}

				$no_spi_rek++;
			}
			echo "</div>";
		}
		$no_spi++;
	} ?>
</div>
														<!-- ed tab -->
													</div>

													<div id="tab_e3" class="tab-pane">
														<!-- 3E -->
<div class="kategori">
	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right"></label>
		<div class="col-sm-5">
			<h3 class="header left">Efektif, Efisien & Ekonomis</h3>
		</div>
	</div>
	<?php $no_e3 = 1;
	foreach ($aspek as $e3)
	{
		$id  = $e3->id_temuan;

		if($e3->aspek == "e3")
		{
			echo "<div class='well'>";
			echo "
				<div class='form-group'>
					<label class='col-sm-3 control-label no-padding-right'>Kode Temuan :</label>
					<div class='col-sm-5'>
						<label class='control-label'> $e3->kode_temuan </label>
					</div>
				</div>

				<div class='form-group'>
					<label class='col-sm-3 control-label no-padding-right'>Temuan :</label>
					<div class='col-sm-5'>
						<label class='control-label'> $e3->judul </label>
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-3 control-label no-padding-right'>Nilai :</label>
					<div class='col-sm-5'>
						<label class='control-label'> $e3->nilai </label>
					</div>
				</div>
				<div class='form-group'><label class='col-sm-3 control-label no-padding-right'></label><div class='col-sm-5'><b>PEJABAT TERKAIT</b></div></div>
				<div class='form-group'>
					<label class='col-sm-3 control-label no-padding-right'>Nama :</label>
					<div class='col-sm-5'>
						<label class='control-label'> $e3->nm_pejabat </label>
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-3 control-label no-padding-right'>NIP :</label>
					<div class='col-sm-5'>
						<label class='control-label'> $e3->nip </label>
					</div>
				</div>
			";

			echo "
			<div class='form-group'><label class='col-sm-3 control-label no-padding-right'></label><div class='col-sm-5'><b>REKOMENDASI</b></div></div>
			";
			$no_e3_rek = 1;

			foreach ($temuan_rekomendasi as $rek_e3)
			{
				$id  = $rek_e3->id_temuan;

				if($rek_e3->aspek == "e3" && $e3->id_temuan_aspek == $rek_e3->id_temuan_aspek)
				{
					echo "
					<div class='form-group'>
						<label class='col-sm-3 control-label no-padding-right'>Kode Rekomendasi :</label>
						<div class='col-sm-5'>
							<label class='control-label'> $rek_e3->kode_rekomendasi </label>
						</div>
					</div>
					<div class='form-group'>
						<label class='col-sm-3 control-label no-padding-right'>Uraian :</label>
						<div class='col-sm-5'>
							<label class='control-label'> $rek_e3->uraian </label>
						</div>
					</div>
					<div class='form-group'>
						<label class='col-sm-3 control-label no-padding-right'>Nilai :</label>
						<div class='col-sm-5'>
							<label class='control-label'> $rek_e3->nilai</label>
						</div>
					</div>
					";
				}

				$no_e3_rek++;
			}
			echo "</div>";
		}
		$no_e3++;
	} ?>
</div>

													</div>
													<div id="tab_kepatuhan" class="tab-pane">
														<!-- Kepatuhan -->
<div class="kategori">
	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right"></label>
		<div class="col-sm-5">
			<h3 class="header left">Kepatuhan Terhadap Peraturan</h3>
		</div>
	</div>
	<?php $no_kepatuhan = 1;
	foreach ($aspek as $kepatuhan)
	{
		$id  = $kepatuhan->id_temuan;

		if($kepatuhan->aspek == "kepatuhan")
		{
			echo "<div class='well'>";
			echo "
				<div class='form-group'>
					<label class='col-sm-3 control-label no-padding-right'>Kode Temuan :</label>
					<div class='col-sm-5'>
						<label class='control-label'> $kepatuhan->kode_temuan </label>
					</div>
				</div>

				<div class='form-group'>
					<label class='col-sm-3 control-label no-padding-right'>Temuan :</label>
					<div class='col-sm-5'>
						<label class='control-label'> $kepatuhan->judul </label>
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-3 control-label no-padding-right'>Nilai :</label>
					<div class='col-sm-5'>
						<label class='control-label'> $kepatuhan->nilai </label>
					</div>
				</div>
				<div class='form-group'><label class='col-sm-3 control-label no-padding-right'></label><div class='col-sm-5'><b>PEJABAT TERKAIT</b></div></div>
				<div class='form-group'>
					<label class='col-sm-3 control-label no-padding-right'>Nama :</label>
					<div class='col-sm-5'>
						<label class='control-label'> $kepatuhan->nm_pejabat </label>
					</div>
				</div>
				<div class='form-group'>
					<label class='col-sm-3 control-label no-padding-right'>NIP :</label>
					<div class='col-sm-5'>
						<label class='control-label'> $kepatuhan->nip </label>
					</div>
				</div>
			";

			echo "
			<div class='form-group'><label class='col-sm-3 control-label no-padding-right'></label><div class='col-sm-5'><b>REKOMENDASI</b></div></div>
			";
			$no_kepatuhan_rek = 1;

			foreach ($temuan_rekomendasi as $rek_kepatuhan)
			{
				$id  = $rek_kepatuhan->id_temuan;

				if($rek_kepatuhan->aspek == "kepatuhan" && $kepatuhan->id_temuan_aspek == $rek_kepatuhan->id_temuan_aspek)
				{
					echo "
					<div class='form-group'>
						<label class='col-sm-3 control-label no-padding-right'>Kode Rekomendasi :</label>
						<div class='col-sm-5'>
							<label class='control-label'> $rek_kepatuhan->kode_rekomendasi </label>
						</div>
					</div>

					<div class='form-group'>
						<label class='col-sm-3 control-label no-padding-right'>Uraian :</label>
						<div class='col-sm-5'>
							<label class='control-label'> $rek_kepatuhan->uraian </label>
						</div>
					</div>
					<div class='form-group'>
						<label class='col-sm-3 control-label no-padding-right'>Nilai :</label>
						<div class='col-sm-5'>
							<label class='control-label'> $rek_kepatuhan->nilai</label>
						</div>
					</div>
					";
				}

				$no_kepatuhan_rek++;
			}
			echo "</div>";
		}
		$no_kepatuhan++;
	} ?>
</div>
														
													</div>

												</div>
											</div>

											<div class="clearfix form-actions">
												&nbsp; &nbsp;
												<div class='form-group'>
													<label class='col-sm-2 control-label no-padding-right'>Usulan Penugasan :</label>
													<div class='col-sm-10'>
														<label class='control-label'> <?= $temuan->isi_usulan; ?> </label>
													</div>
												</div>
												
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

<input type="hidden" id="tgl" value="<?= date('Y-m-d H:i'); ?>" />

<!-- include data footer -->
<?php $this->load->view('layout/footer'); ?>

<!-- inline scripts related to this page -->


</body>
</html>
