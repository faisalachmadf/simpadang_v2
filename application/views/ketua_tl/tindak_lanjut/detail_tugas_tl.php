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
				<h1>Detail Temuan
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						Detail data
					</small>
				</h1>
			</div><!-- /.page-header -->

			<!-- notifikasi -->
			<div><?= $this->session->flashdata("sukses"); ?></div>
						
<style type="text/css">
	.u {text-decoration: underline}
	.b {font-weight: bold}
	.i {font-style: italic}
	.c {text-align: center}
	.r {text-align: right;}
	.j {text-align: justify}
	.bg-coklat {background: #f6dca3;}
	.pad-3 {padding: 5px}
	.bot-bor {border-bottom: 1px black solid}

	.bg-color  {background-color: #f1f6a3}
	.bg-color5 {background-color: #1faeff}

	td {padding: 5px}
</style>

			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->
					<form id="validasi" class="form-horizontal" role="form" action="<?php site_url('ketua_tl/tindak_lanjut/tambah'); ?>" method="post">
						<div class="row">
							<div class="col-md-12">

								<div class="widget-box">

									<div class="widget-body">
										<div class="widget-main">
											<div class="row">
												<div class="col-sm-6">
													<h3 class="header">
														<i class="fa fa-file-text"></i> Data Temuan
													</h3>
													<dl id="dt-list-1" class="dl-horizontal">
														<dt> Objek Pengawasan : </dt>
														<dd><?= $temuan->instansi; ?></dd>

														<dt> Kategori LHP : </dt>
														<dd><?= $temuan->kategori_lhp; ?></dd>

														<dt> No LHP : </dt>
														<dd><?= $temuan->no_lhp; ?></dd>

														<dt> Tanggal LHP : </dt>
														<dd><?= $temuan->tgl_lhp; ?></dd>

														<dt> File LHP : </dt>
														<dd><a target="_blank" href="<?= site_url('../assets/lhp/mnl/'.$temuan->file_lhp.''); ?>" class="btn btn-sm btn-success" title="Download file LHP"><i class="fa fa-download"></i> File LHP </a></dd>
													</dl>
												</div>
												<div class="col-sm-6">
													<h3 class="header">
														<i class="fa fa-list"></i> Aksi Pilihan
													</h3>
													<center>
														<a href="javascript:history.back()" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali </a>

														<a target="_blank" href="<?= site_url('ketua_tl/tindak_lanjut/cetak_temuan/'. $temuan->id_temuan .' '); ?>" class="btn btn-primary"><i class="fa fa-print"></i> Cetak Temuan </a>
													</center>
												</div>
											</div>

											

											<br>
											<br>



	<div class="row">
		<div class="col-sm-6">
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
				</tbody>
			</table>
		</div>

		<div class="col-sm-6">
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
					<td class="c"> <?= $jml_1->jml; ?></td>
					<td class="c"> <?= $jml_2->jml; ?></td>
					<td class="c"> <?= $jml_3->jml; ?></td>
					<td class="c"> <?= $jml_0->jml; ?></td>
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
					</tr>
					<tr>
						<td class="c b bg-color"> Judul </td>
						<td class="c b bg-color"> Kode Temuan </td>
						<td class="c b bg-color"> Nilai </td>
						<td class="c b bg-color"> Uraian </td>
						<td class="c b bg-color"> Jml </td>
						<td class="c b bg-color"> Nilai </td>
						<td class="c b bg-color"> Status </td>
						<td class="c b bg-color"> Nilai </td>
					</tr>
					<tr>
						<td class="c b bg-color" width="1%"> 1 </td>
						<td class="c b bg-color" width="3%"> 2 </td>
						<td class="c b bg-color" width="15%"> 3 </td>
						<td class="c b bg-color" width="2%"> 4 </td>
						<td class="c b bg-color" width="3%"> 5 </td>
						<td class="c b bg-color" width="15%"> 6 </td>
						<td class="c b bg-color" width="2%"> 7 </td>
						<td class="c b bg-color" width="3%"> 8 </td>
						<td class="c b bg-color" width="15%"> 9 </td>
						<td class="c b bg-color" width="3%"> 10 </td>
						<td class="c b bg-color" width="3%"> 11 </td>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td class="b bg-coklat"colspan="11"> I. Sistem Pengendalian Intern (<?= $aspek_spi->jml; ?>)</td>
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
							<td class=''> $spi->nilai </td>
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
									<td class=''> $rek_spi->nilai </td>
									<td class=''>
										<a href='#modal-upload' role='button' class='' data-toggle='modal'  data-id1='".$rek_spi->id_temuan_rekomendasi."' > $spi_uraian_tindak_lanjut </a>
									</td>
									<td class='c'>
										$spi_status_tl <br><br>
										<a href='#modal-kat' role='button' class='' data-toggle='modal' data-id1='".base64_encode($data->id_tl)."' data-id2='".base64_encode($data->id_tim)."' data-id3='".base64_encode($rek_spi->id_temuan_rekomendasi)."' title='Ubah'> Ubah </a>

									</td>
									<td class=''> $rek_spi->status_nilai </td>
									";

									echo "</tr>";
									$no_spi_rek++;
								}
							}
						}
						$no_spi++;
					} ?>
					<tr>
						<td class="b bg-coklat" colspan="11"> II. Efektif, Efisien & Ekonomis (<?= $aspek_e3->jml; ?>)</td>
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
							<td class=''> $e3->nilai </td>
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
									<td class=''> $rek_e3->nilai </td>
									<td class=''>
										<a href='#modal-upload' role='button' class='' data-toggle='modal'  data-id1='".$rek_e3->id_temuan_rekomendasi."' > $e3_uraian_tindak_lanjut </a>

									</td>
									<td class='c'>
										$e3_status_tl <br><br>
										<a href='#modal-kat' role='button' class='' data-toggle='modal' data-id1='".base64_encode($data->id_tl)."' data-id2='".base64_encode($data->id_tim)."' data-id3='".base64_encode($rek_e3->id_temuan_rekomendasi)."' title='Ubah'> Ubah </a>

									</td>
									<td class=''> $rek_e3->status_nilai </td>
									";
									
									echo "</tr>";
									$no_e3_rek++;
								}
							}
						}
						$no_e3++;
					} ?>
					<tr>
						<td class="b bg-coklat" colspan="11"> III. Kepatuhan Terhadap Peraturan (<?= $aspek_kepatuhan->jml; ?>)</td>
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
							<td class=''> $kepatuhan->nilai </td>
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

									if($no_kepatuhan_rek > 1 ){
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
									<td class=''> $rek_kepatuhan->nilai </td>
									<td class=''> 
										<a href='#modal-upload' role='button' class='' data-toggle='modal'  data-id1='".$rek_kepatuhan->id_temuan_rekomendasi."' > $kepatuhan_uraian_tindak_lanjut </a>
									</td>
									<td class='c'>
										$kepatuhan_status_tl <br><br>

										<a href='#modal-kat' role='button' class='' data-toggle='modal' data-id1='".base64_encode($data->id_tl)."' data-id2='".base64_encode($data->id_tim)."' data-id3='".base64_encode($rek_kepatuhan->id_temuan_rekomendasi)."' title='Ubah'> Ubah </a>

									</td>
									<td class=''> $rek_kepatuhan->status_nilai </td>
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


<!-- <div class='row'>
	<div class='col-sm-12'>
		<a style="" href="<?= site_url('evlap/temuan'); ?>" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali </a>
	</div>
</div> -->

											

											

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


<div id="modal-kat" class="modal fade" tabindex="-1">
	<div class="modal-dialog modal-width">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="red bigger"> <i class="fa fa-edit"></i> Status</h4>
			</div>

			<div class="modal-body">
				<div class="isi-data"></div>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><i class="fa fa-arrow-left"></i> Kembali </button>
			</div>
		</div>
	</div>
</div>


<div id="modal-upload" class="modal fade" tabindex="-1">
	<div class="modal-dialog modal-width">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="red bigger"> <i class="fa fa-edit"></i> Data Upload</h4>
			</div>

			<div class="modal-body">
				<div class="isi-data"></div>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><i class="fa fa-arrow-left"></i> Kembali </button>
			</div>
		</div>
	</div>
</div>

<input type="hidden" id="tgl" value="<?= date('Y-m-d H:i'); ?>" />

<!-- include data footer -->
<?php $this->load->view('layout/footer'); ?>

<script type="text/javascript">
	$('#modal-kat').on('show.bs.modal', function(e)
	{
		var id1 = $(e.relatedTarget).data('id1');
        var id2 = $(e.relatedTarget).data('id2');
        var id3 = $(e.relatedTarget).data('id3');
        $.ajax({
            type : 'post',
            url  : "<?= site_url('ketua_tl/tindak_lanjut/penentuan_kat'); ?>",
            data : {id1:id1, id2:id2, id3:id3},
            success : function(data)
            {
            	$('.isi-data').html(data);
            }
        });
	});
</script>

<script type="text/javascript">
	$('#modal-upload').on('show.bs.modal', function(e)
	{
		var id1 = $(e.relatedTarget).data('id1');
		$.ajax({
			type : 'post',
			url  : "<?= site_url('ketua_tl/tindak_lanjut/get_upload'); ?>",
			data : {id1:id1},
			success : function(data)
			{
				$('.isi-data').html(data);
			}
		});
	});
</script>
<!-- inline scripts related to this page -->


</body>
</html>
