<!DOCTYPE html>
<html>
  <head>
    	<meta charset="utf-8" />
		<link rel="icon" type="image/png" href="<?php echo base_url(); ?>assets/images/icon.png">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

		<title> Cetak </title>

		<!-- Bootstrap -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" />
		<style type="text/css">
			.bg-coklat {background: #f6dca3;}
			.pad-3 {padding: 5px}
			.bot-bor {border-bottom: 1px black solid}

			.bg-color  {background-color: #f1f6a3}
			.bg-color5 {background-color: #1faeff}

			td {padding: 5px}
		</style>

		<style type="text/css">
		  body { font-family: 'Work Sans', sans-serif;}
			th {padding: 3px; text-align: center}
			td {padding: 2px; font-size: 13}

			.kop_header {margin-top:5px; border-bottom: 3px double #000}
			.j {text-align: justify}
			.c {text-align: center}
			.i {font-style: italic}
			.r {text-align: right}
			.b {font-weight: bold}
			.u {text-decoration: underline}

			.border {border: 1px solid black}
			.pad-5 {padding: 5px}
			.pad-3 {padding: 3px}
			.pad-top-10 {padding-top: 13px}
			.pad-b-5 {margin-bottom: -25px}
			.pad-l-30 {padding-left: 30px}
			.pos-atas {vertical-align: top}
			.pos-bawah {vertical-align: bottom}
			.ls-5 {letter-spacing: 5px}

			.color-bag {background-color: #bababa}

			.style-head {border:1px solid white}
			.border-top {border-top:1px solid black}
			.border-bot {border-bottom:1px solid black}
			.border-left {border-left:1px solid black}
			.border-right {border-right:1px solid black}

			.f10 {font-size: 10}
			.f15 {font-size: 15}
			.f16 {font-size: 16}
			.f18 {font-size: 18}
			.f21 {font-size: 24}
			.f23 {font-size: 23}
			.f27 {font-size: 27}
		</style>
  </head>
<body>
	<div class="border"><h6 class='c b'> MATRIKS PEMANTAUAN TINDAK LANJUT INSPEKTORAT KOTA PARIAMAN </h6></div>
<div class="main-content">
	<div class="main-content-inner">


		<div class="page-content">

			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->
					<form id="validasi" class="form-horizontal" role="form" action="<?php site_url('ketua_tim/tindak_lanjut/tambah'); ?>" method="post">
						<div class="row">
							<div class="col-md-12">

								<div class="widget-box">
									<div class="widget-body">
										<div class="widget-main">

											<div class="row">
												<div class="col-sm-6">
													<dl id="dt-list-1" class="dl-horizontal">
														<dt> Objek Pengawasan &nbsp;&nbsp;: <?= $temuan->instansi; ?></dt>
														<dt> Kategori LHP &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <?= $temuan->kategori_lhp; ?></dt>
														<dt> No LHP &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <?= $temuan->no_lhp; ?></dt>
														<dt> Tanggal LHP &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <?= $temuan->tgl_lhp; ?></dt>
													</dl>
												</div>
											</div>
											<br>
<div class="row">
		<div class="col-sm-12">
			<table width="100%" border="1">
				<thead>
					<tr>
						<td class="c b bg-color"> Kode Temuan</td>
						<td class="c b bg-color"> 101</td>
						<td class="c b bg-color"> 102</td>
						<td class="c b bg-color"> 103</td>
						<td class="c b bg-color"> 104</td>
						<td class="c b bg-color"> 105</td>
						<td class="c b bg-color"> 201</td>
						<td class="c b bg-color"> 202</td>
						<td class="c b bg-color"> 203</td>
						<td class="c b bg-color"> 301</td>
						<td class="c b bg-color"> 302</td>
						<td class="c b bg-color"> 303</td>
						<td class="c b bg-color"> Jumlah</td>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td class="c bg-color"> &nbsp;</td>
						<td class="c"> <?= $kt101->jml; ?></td>
						<td class="c"> <?= $kt102->jml; ?></td>
						<td class="c"> <?= $kt103->jml; ?></td>
						<td class="c"> <?= $kt104->jml; ?></td>
						<td class="c"> <?= $kt105->jml; ?></td>
						<td class="c"> <?= $kt201->jml; ?></td>
						<td class="c"> <?= $kt202->jml; ?></td>
						<td class="c"> <?= $kt203->jml; ?></td>
						<td class="c"> <?= $kt301->jml; ?></td>
						<td class="c"> <?= $kt302->jml; ?></td>
						<td class="c"> <?= $kt303->jml; ?></td>
						<td class="c">
							<?= $jml_kt->jml; ?>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<br>
		<div class="col-sm-12">
			<table width="100%" border="1">
				<thead>
					<tr>
						<td class="c b bg-color" width="25%"> Selesai</td>
						<td class="c b bg-color" width="25%"> Belum Selesai</td>
						<td class="c b bg-color" width="25%"> Tidak Dapat Ditindaklanjuti</td>
						<td class="c b bg-color" width="25%"> Belum Ditindaklanjuti</td>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td class="c"> <?= $jml_1->jml; ?></td>
						<td class="c"> <?= $jml_2->jml; ?></td>
						<td class="c"> <?= $jml_3->jml; ?></td>
						<td class="c"> <?= $jml_0->jml; ?></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-sm-12">
			<table width="100%" border="1">
				<thead>
					<tr>
						<td class="c b bg-color" rowspan="2"> No. </td>
						<td class="c b bg-color" rowspan="2" colspan="1"> Pejabat Terkait </td>
						<td class="c b bg-color" colspan="3"> Temuan Pemeriksaan </td>
						<td class="c b bg-color" colspan="3"> Rekomendasi </td>
						<td class="c b bg-color" rowspan="2"> Tindak Lanjut Entitas yang Diperiksa </td>
						<td class="c b bg-color" colspan="2"> Status </td>
						<td class="c b bg-color" rowspan="2"> Keterangan </td>
					</tr>
					<tr>
						<td class="c b bg-color"> Judul </td>
						<td class="c b bg-color"> Kode Temuan </td>
						<td class="c b bg-color"> Nilai </td>
						<td class="c b bg-color"> Uraian </td>
						<td class="c b bg-color"> Jml </td>
						<td class="c b bg-color"> Nilai </td>
						<td class="c b bg-color"> Status </td>
						<td class="c b bg-color"> Nilai Penyetoran Ke Kas Negara / Daerah </td>
					</tr>
					<tr>
						<td class="c b bg-color" width="5%"> 1 </td>
						<td class="c b bg-color" width="12%"> 2 </td>
						<td class="c b bg-color" width="15%"> 3 </td>
						<td class="c b bg-color" width="5%"> 4 </td>
						<td class="c b bg-color" width="5%"> 5 </td>
						<td class="c b bg-color" width="15%"> 6 </td>
						<td class="c b bg-color" width="5%"> 7 </td>
						<td class="c b bg-color" width="5%"> 8 </td>
						<td class="c b bg-color" width="10%"> 9 </td>
						<td class="c b bg-color" width="5%"> 10 </td>
						<td class="c b bg-color" width="5%"> 11 </td>
						<td class="c b bg-color" width="8%"> 12 </td>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td class="b bg-coklat" colspan="12"> I. Sistem Pengendalian Intern (<?= $aspek_spi->jml; ?>)</td>
					</tr>
					<?php $no_spi = 1;
					foreach ($aspek as $spi)
					{
						$id  = $spi->id_temuan;

						if($spi->aspek == "spi")
						{
							echo "<tr>";
							echo "
							<td class='c'> $no_spi </td>
							<td class=''> $spi->nm_pejabat <br> $spi->nip </td>
							<td class=''> $spi->judul </td>
							<td class='c'> $spi->kode_temuan </td>
							<td class='c'> $spi->nilai </td>
							";
							
							$no_spi_rek = 1;
							foreach ($temuan_rekomendasi as $rek_spi)
							{
								$id  = $rek_spi->id_temuan;
								if($rek_spi->aspek == "spi" && $spi->id_temuan_aspek == $rek_spi->id_temuan_aspek)
								{
									if($rek_spi->status_tl == '0') {
										$spi_status_tl = "<span class='label-warning label'>Belum Ditindaklanjuti</span>";
									} else if ($rek_spi->status_tl == '3') {
										$spi_status_tl = "<span class='label-danger label'>Tidak Dapat Ditindaklanjuti</span>";
									} else if ($rek_spi->status_tl == '2') {
										$spi_status_tl = "<span class='label-primary label'>Belum Selesai</span>";
									} else if ($rek_spi->status_tl == '1') {
										$spi_status_tl = "<span class='label-success label'>Selesai</span>";
									} else {

									}

									if($no_spi_rek > 1){
										echo "
										<tr>
										<td class=''> </td>
										<td class=''> </td>
										<td class=''> </td>
										<td class=''> </td>
										<td class=''> </td>";
									}
									
									$spi_uraian_tindak_lanjut = nl2br($rek_spi->uraian_tindak_lanjut);
									echo "									
									<td class=''> $rek_spi->uraian </td>
									<td class='c'> $rek_spi->kode_rekomendasi </td>
									<td class='c'> $rek_spi->nilai </td>
									<td class=''>
										$spi_uraian_tindak_lanjut
									</td>
									<td class='c'>
										$spi_status_tl
									</td>
									<td class='c'> $rek_spi->status_nilai </td>
									<td class='c'> $rek_spi->ket </td></tr>
									";
									$no_spi_rek++;
								}
							}
						}
						$no_spi++;
					} ?>
					<tr>
						<td class="b bg-coklat" colspan="12"> II. Efektif, Efisien & Ekonomis (<?= $aspek_e3->jml; ?>)</td>
					</tr>
					<?php $no_e3 = 1;
					foreach ($aspek as $e3)
					{
						$id  = $e3->id_temuan;

						if($e3->aspek == "e3")
						{
							echo "<tr>";
							echo "
							<td class='c'> $no_e3 </td>
							<td class=''> $e3->nm_pejabat <br> $e3->nip </td>
							<td class=''> $e3->judul </td>
							<td class='c'> $e3->kode_temuan </td>
							<td class='c'> $e3->nilai </td>
							";
							
							$no_e3_rek = 1;
							foreach ($temuan_rekomendasi as $rek_e3)
							{
								$id  = $rek_e3->id_temuan;
								if($rek_e3->aspek == "e3" && $e3->id_temuan_aspek == $rek_e3->id_temuan_aspek)
								{
									if($rek_e3->status_tl == '0') {
										$e3_status_tl = "<span class='label-warning label'>Belum Ditindaklanjuti</span>";
									} else if ($rek_e3->status_tl == '3') {
										$e3_status_tl = "<span class='label-danger label'>Tidak Dapat Ditindaklanjuti</span>";
									} else if ($rek_e3->status_tl == '2') {
										$e3_status_tl = "<span class='label-primary label'>Belum Selesai</span>";
									} else if ($rek_e3->status_tl == '1') {
										$e3_status_tl = "<span class='label-success label'>Selesai</span>";
									} else {

									}

									if($no_e3_rek > 1){
										echo "
										<tr>
										<td class=''> </td>
										<td class=''> </td>
										<td class=''> </td>
										<td class=''> </td>
										<td class=''> </td>";
									}
									
									$e3_uraian_tindak_lanjut = nl2br($rek_e3->uraian_tindak_lanjut);

									echo "
									
									<td class=''> $rek_e3->uraian </td>
									<td class='c'> $rek_e3->kode_rekomendasi </td>
									<td class='c'> $rek_e3->nilai </td>
									<td class=''>
										$e3_uraian_tindak_lanjut
									</td>
									<td class='c'>
										$e3_status_tl
									</td>
									<td class='c'> $rek_e3->status_nilai </td>
									<td class=''> $rek_e3->ket </td>
									";
									
									echo "</tr>";
									$no_e3_rek++;
								}

								
							}

						}
						$no_e3++;
					} ?>
					<tr>
						<td class="b bg-coklat" colspan="12"> III. Kepatuhan Terhadap Peraturan (<?= $aspek_kepatuhan->jml; ?>)</td>
					</tr>
					<?php $no_kepatuhan = 1;
					foreach ($aspek as $kepatuhan)
					{
						$id  = $kepatuhan->id_temuan;

						if($kepatuhan->aspek == "kepatuhan")
						{
							echo "<tr>";
							echo "
							<td class='c'> $no_kepatuhan </td>
							<td class=''> $kepatuhan->nm_pejabat <br> $kepatuhan->nip </td>
							<td class=''> $kepatuhan->judul </td>
							<td class='c'> $kepatuhan->kode_temuan </td>
							<td class='c'> $kepatuhan->nilai </td>
							";
							
							$no_kepatuhan_rek = 1;
							foreach ($temuan_rekomendasi as $rek_kepatuhan)
							{
								$id  = $rek_kepatuhan->id_temuan;
								if($rek_kepatuhan->aspek == "kepatuhan" && $kepatuhan->id_temuan_aspek == $rek_kepatuhan->id_temuan_aspek)
								{
									if($rek_kepatuhan->status_tl == '0') {
										$kepatuhan_status_tl = "<span class='label-warning label'>Belum Ditindaklanjuti</span>";
									} else if ($rek_kepatuhan->status_tl == '3') {
										$kepatuhan_status_tl = "<span class='label-danger label'>Tidak Dapat Ditindaklanjuti</span>";
									} else if ($rek_kepatuhan->status_tl == '2') {
										$kepatuhan_status_tl = "<span class='label-primary label'>Belum Selesai</span>";
									} else if ($rek_kepatuhan->status_tl == '1') {
										$kepatuhan_status_tl = "<span class='label-success label'>Selesai</span>";
									} else {

									}

									if($no_kepatuhan_rek > 1){
										echo "
										<tr>
										<td class=''> </td>
										<td class=''> </td>
										<td class=''> </td>
										<td class=''> </td>
										<td class=''> </td>";
									}

									$kepatuhan_uraian_tindak_lanjut = nl2br($rek_kepatuhan->uraian_tindak_lanjut);

									echo "							
									<td class=''> $rek_kepatuhan->uraian </td>
									<td class='c'> $rek_kepatuhan->kode_rekomendasi </td>
									<td class='c'> $rek_kepatuhan->nilai </td>
									<td class=''> 
										$kepatuhan_uraian_tindak_lanjut
									</td>
									<td class='c'>
										$kepatuhan_status_tl
									</td>
									<td class='c'> $rek_kepatuhan->status_nilai </td>
									<td class=''> $rek_kepatuhan->ket </td>
									";
									echo "</tr>";
									$no_kepatuhan_rek++;
								}

								
							}

						}
						$no_kepatuhan++;
					} ?>
				</tbody>
			</table>
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



<!-- inline scripts related to this page -->

</body>
</html>



