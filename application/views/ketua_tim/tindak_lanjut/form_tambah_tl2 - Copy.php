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
					<a href="<?= site_url('staff/home'); ?>">Home</a>
				</li>
				<li class="active"> Tambah Temuan </li>
			</ul><!-- /.breadcrumb -->
		</div>

		<div class="page-content">
			<div class="page-header">
				<h1>Tambah Temuan
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						Menambahkan data
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
											Formulir Tambah Temuan
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
													<h4 class="header center"> Masukan Data Temuan </h4>
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-3 control-label no-padding-right"> Sasaran Pengawasan </label>
												<div class="col-sm-5">
													<input type="text" class="form-control" name="instansi" class="col-xs-12 col-sm-5" value="<?= $data->nm_instansi; ?>" readonly>
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-3 control-label no-padding-right"> No LHP </label>
												<div class="col-sm-5">
													<input type="text" class="form-control" name="no_lhp" class="col-xs-12 col-sm-5" value="<?= $data->no_lhp; ?>" readonly>
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-3 control-label no-padding-right"> Upload File LHP </label>
												<div class="col-sm-5">
													<input type='text' class='btn btn-sm btn-info' value='Upload File' />
												</div>
											</div>


											<div class="form-group">
												<label class="col-sm-3 control-label no-padding-right"> Tanggal LHP </label>
												<div class="col-sm-9">
													<div class='input-group date datepicker2'>
														<span class='input-group-addon'><i class="ace-icon fa fa-calendar bigger-110"></i></span>
														<input type='text' name='tgl_lhp' class='col-xs-8 col-sm-2' placeholder='Tanggal' />
													</div>
												</div>
											</div>


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

	
	<input type="hidden" name="jml_temuan_spi" id="temuan_spi1" value="0" />
	
	<div id="form_temuan_spi_1"></div>

	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right"> &nbsp; </label>
		<div class="col-sm-9">
			<label class="control-label">
				<button type="button" class="btn btn-sm btn-success" onclick="tbhTemuanSpi(); return false;" >
					<i class="fa fa-plus"></i>
					Tambah Temuan SPI
				</button>
			</label>
		</div>
	</div>

	<script type="text/javascript">
		function tbhTemuanSpi() {
			var temuan_spi1 = document.getElementById("temuan_spi1").value;
			var judul_temuan_spi = parseInt(temuan_spi1) + 1;

			var stre;
			stre  = "<div id='spi_trow" + temuan_spi1 + "'>";

			stre += "<div class='form-group'>";
			stre += "<label class='col-sm-3 control-label no-padding-right'>Kode Temuan</label>";
			stre += "<div class='col-sm-5'>";
			stre += "<select name='kode_temuan_spi["+ temuan_spi1+"]'>";
	        stre += "<option> - Kode Temuan - </option>";
	        stre += "<option value='101'> 101 </option>";
	        stre += "<option value='102'> 102 </option>";
	        stre += "<option value='103'> 103 </option>";
	        stre += "<option value='104'> 104 </option>";
	        stre += "<option value='105'> 105 </option>";
	        stre += "<option value='201'> 201 </option>";
	        stre += "<option value='202'> 202 </option>";
	        stre += "<option value='203'> 203 </option>";
	        stre += "<option value='301'> 301 </option>";
	        stre += "<option value='302'> 302 </option>";
	        stre += "<option value='303'> 303 </option>";
	        stre += "</select>";
			stre += "</div>";
			stre += "</div>";

			stre += "<div class='form-group'>";
			stre += "<label class='col-sm-3 control-label no-padding-right'>Temuan SPI " + judul_temuan_spi + "</label>";
			stre += "<div class='col-sm-5'>";
			stre += "<textarea rows='4' class='form-control' placeholder='Temuan'  name='judul_spi["+ temuan_spi1+"]'></textarea>";
			stre += "</div>";
			stre += "</div>";

			stre += "<div class='form-group'>";
			stre += "<label class='col-sm-3 control-label no-padding-right'>Nilai</label>";
			stre += "<div class='col-sm-5'>";
			stre += "<input type='text' class='form-control' placeholder='Nilai' name='nilai_spi[]'/>";
			stre += "</div>";
			stre += "</div>";

			stre += "<div class='form-group'>";
			stre += "<label class='col-sm-3 control-label no-padding-right'></label>";
			stre += "<div class='col-sm-5'>";
			stre += "<b>PEJABAT TERKAIT</b>";
			stre += "</div>";
			stre += "</div>";

			stre += "<div class='form-group'>";
			stre += "<label class='col-sm-3 control-label no-padding-right'>Nama</label>";
			stre += "<div class='col-sm-5'>";
			stre += "<input type='text' class='form-control' placeholder='Nama' name='nama_spi[]'/>";
			stre += "</div>";
			stre += "</div>";

			stre += "<div class='form-group'>";
			stre += "<label class='col-sm-3 control-label no-padding-right'>NIP</label>";
			stre += "<div class='col-sm-5'>";
			stre += "<input type='text' class='form-control' placeholder='NIP' name='nip_spi[]'/>";
			stre += "</div>";
			stre += "</div>";

			stre += "<div class='form-group'>";
			stre += "<label class='col-sm-3 control-label no-padding-right'></label>";
			stre += "<div class='col-sm-5'>";
			stre += "<b>REKOMENDASI</b>";
			stre += "</div>";
			stre += "</div>";

			stre += "<input type='hidden' name='jml_uraian_spi' id='spi1" + temuan_spi1 + "' value='1' />";

			stre += "<div id='form_uraian_spi_1_" + temuan_spi1 + "'></div>";

			stre += "<div class='form-group'>";
			stre += "<label class='col-sm-3 control-label no-padding-right'> Rekomendasi SPI " + judul_temuan_spi + "</label>";
			stre += "<div class='col-sm-5'>";
			stre += "<label class='control-label'><button type='button' class='btn btn-sm btn-warning' onclick='tbhUraianSpi(" + temuan_spi1 + "); return false;' title='Tambah Rekomendasi'><i class='fa fa-plus'></i> Tambah Rekomendasi </button></label>";
			stre += "</div>";
			stre += "</div>";

			stre += "<div class='form-group'><label class='col-sm-3 control-label no-padding-right'></label><div class='col-sm-5'>";
			stre += "<hr><a onclick='hpsTemuanSpi(\"#spi_trow" + temuan_spi1 + "\"); return false;' class='btn btn-sm btn-danger'> <i class='fa fa-times'></i> Hapus Temuan SPI " + judul_temuan_spi + "</a>";
			stre += "</div>";
			stre += "</div>";
			stre += "<hr></div>";
			stre += "</div>";
			stre += "</div>";
			$("#form_temuan_spi_1").append(stre);
			temuan_spi1 = (temuan_spi1-1) + 2;
			document.getElementById("temuan_spi1").value = temuan_spi1;
		}

		function hpsTemuanSpi(temuan_spi1) {
			$(temuan_spi1).remove();

			var temuan_spi4 = document.getElementById("temuan_spi1").value;
			temuan_spi5 = temuan_spi4-1;
			document.getElementById("temuan_spi1").value = temuan_spi5;
		}

		function tbhUraianSpi($ids) {
			var spi1 = document.getElementById("spi1"+$ids+"").value;

			var stre;
			stre = "<div id='spi_trow" + spi1 + $ids +"' style='display: block;'> ";

			stre += "<div class='form-group'>";
			stre += "<label class='col-sm-3 control-label no-padding-right'>Kode Rekomendasi</label>";
			stre += "<div class='col-sm-5'>";

			stre += "<select name='kode_rekomendasi_spi_"+ $ids +"[]' class='form-control'>";
	        stre += "<option>- Kode Rekomendasi -</option>";
	        stre += "<option value='00'> 00 </option>";
	        stre += "<option value='01'> 01 </option>";
	        stre += "<option value='02'> 02 </option>";
	        stre += "<option value='03'> 03 </option>";
	        stre += "<option value='04'> 04 </option>";
	        stre += "<option value='05'> 05 </option>";
	        stre += "<option value='06'> 06 </option>";
	        stre += "<option value='07'> 07 </option>";
	        stre += "<option value='08'> 08 </option>";
	        stre += "<option value='09'> 09 </option>";
	        stre += "<option value='10'> 10 </option>";
	        stre += "<option value='11'> 11 </option>";
	        stre += "<option value='12'> 12 </option>";
	        stre += "<option value='13'> 13 </option>";
	        stre += "<option value='14'> 14 </option>";
	        stre += "</select>";
			stre += "</div>";
			stre += "</div>";

			stre += "<div class='form-group'>";
			stre += "<label class='col-sm-3 control-label no-padding-right'>Uraian</label>";
			stre += "<div class='col-sm-5'>";
			stre += "<textarea name='uraian_spi_"+ $ids +"[]' placeholder='Uraian' class='form-control'></textarea>";
			stre += "</div>";
			stre += "</div>";

			stre += "<div class='form-group'>";
			stre += "<label class='col-sm-3 control-label no-padding-right'>Nilai</label>";
			stre += "<div class='col-sm-5'>";
			stre += "<input type='text' name='nilai_spi_"+ $ids +"[]' placeholder='Nilai' class='form-control'></input>";
			stre += "</div>";
			stre += "</div>";

			stre += "<div class='form-group'>";
			stre += "<label class='col-sm-3 control-label no-padding-right'></label>";
			stre += "<div class='col-sm-5'>";
			stre += "<a  onclick='hpsUraianSpi(\"#spi_trow" + spi1 + $ids +"\"); return false;' class='btn btn-sm btn-danger' title='Hapus uraian_spi_ "+ spi1 +"'> <i class='fa fa-times'></i></a>";
			stre += "</div>";
			stre += "</div>";

			stre += "<br></div>";

			$("#form_uraian_spi_1_"+$ids+"").append(stre);
			spi1 = (spi1-1) + 2;
			document.getElementById("spi1").value = spi1;
		}

		function hpsUraianSpi(spi1) {
			$(spi1).remove();

			var spi4 = document.getElementById("spi1").value;
			spi5 = spi4-1;
			document.getElementById("spi1").value = spi5;
		}
	</script>
</div>
														<!-- ed tab -->
													</div>

													<div id="tab_e3" class="tab-pane">
														<!-- 3E -->
<div class="kategori">
	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right"></label>
		<div class="col-sm-5">
			<h3 class="header left">Efektif, Efisien, Ekonomis</h3>
		</div>
	</div>
	<input type="hidden" name="jml_temuan_e3" id="temuan_e31" value="0" />
	<div id="form_temuan_e3_1"></div>
	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right"> &nbsp; </label>
		<div class="col-sm-9">
			<label class="control-label">
				<button type="button" class="btn btn-sm btn-success" onclick="tbhTemuanE3(); return false;" >
					<i class="fa fa-plus"></i>
					Tambah Temuan E3
				</button>
			</label>
		</div>
	</div>

	<script type="text/javascript">
		function tbhTemuanE3() {
			var temuan_e31 = document.getElementById("temuan_e31").value;
			var judul_temuan_e3 = parseInt(temuan_e31) + 1;

			var stre;
			stre  = "<div id='e3_trow" + temuan_e31 + "'>";

			stre += "<div class='form-group'>";
			stre += "<label class='col-sm-3 control-label no-padding-right'>Kode Temuan</label>";
			stre += "<div class='col-sm-5'>";
			stre += "<select name='kode_temuan_e3["+ temuan_e31+"]'>";
	        stre += "<option> - Kode Temuan - </option>";
	        stre += "<option value='101'> 101 </option>";
	        stre += "<option value='102'> 102 </option>";
	        stre += "<option value='103'> 103 </option>";
	        stre += "<option value='104'> 104 </option>";
	        stre += "<option value='105'> 105 </option>";
	        stre += "<option value='201'> 201 </option>";
	        stre += "<option value='202'> 202 </option>";
	        stre += "<option value='203'> 203 </option>";
	        stre += "<option value='301'> 301 </option>";
	        stre += "<option value='302'> 302 </option>";
	        stre += "<option value='303'> 303 </option>";
	        stre += "</select>";
			stre += "</div>";
			stre += "</div>";

			stre += "<div class='form-group'>";
			stre += "<label class='col-sm-3 control-label no-padding-right'>Temuan E3 " + judul_temuan_e3 + "</label>";
			stre += "<div class='col-sm-5'>";
			stre += "<textarea rows='4' class='form-control' placeholder='Temuan'  name='judul_e3["+ temuan_e31+"]'></textarea>";
			stre += "</div>";
			stre += "</div>";

			stre += "<div class='form-group'>";
			stre += "<label class='col-sm-3 control-label no-padding-right'>Nilai</label>";
			stre += "<div class='col-sm-5'>";
			stre += "<input type='text' class='form-control' placeholder='Nilai' name='nilai_e3[]'/>";
			stre += "</div>";
			stre += "</div>";

			stre += "<div class='form-group'>";
			stre += "<label class='col-sm-3 control-label no-padding-right'></label>";
			stre += "<div class='col-sm-5'>";
			stre += "<b>PEJABAT TERKAIT</b>";
			stre += "</div>";
			stre += "</div>";

			stre += "<div class='form-group'>";
			stre += "<label class='col-sm-3 control-label no-padding-right'>Nama</label>";
			stre += "<div class='col-sm-5'>";
			stre += "<input type='text' class='form-control' placeholder='Nama' name='nama_e3[]'/>";
			stre += "</div>";
			stre += "</div>";

			stre += "<div class='form-group'>";
			stre += "<label class='col-sm-3 control-label no-padding-right'>NIP</label>";
			stre += "<div class='col-sm-5'>";
			stre += "<input type='text' class='form-control' placeholder='NIP' name='nip_e3[]'/>";
			stre += "</div>";
			stre += "</div>";

			stre += "<div class='form-group'>";
			stre += "<label class='col-sm-3 control-label no-padding-right'></label>";
			stre += "<div class='col-sm-5'>";
			stre += "<b>REKOMENDASI</b>";
			stre += "</div>";
			stre += "</div>";

			stre += "<input type='hidden' name='jml_uraian_e3' id='e31" + temuan_e31 + "' value='1' />";

			stre += "<div id='form_uraian_e3_1_" + temuan_e31 + "'></div>";

			stre += "<div class='form-group'>";
			stre += "<label class='col-sm-3 control-label no-padding-right'> Rekomendasi E3 " + judul_temuan_e3 + "</label>";
			stre += "<div class='col-sm-5'>";
			stre += "<label class='control-label'><button type='button' class='btn btn-sm btn-warning' onclick='tbhUraianE3(" + temuan_e31 + "); return false;' title='Tambah Rekomendasi'><i class='fa fa-plus'></i> Tambah Rekomendasi </button></label>";
			stre += "</div>";
			stre += "</div>";

			stre += "<div class='form-group'><label class='col-sm-3 control-label no-padding-right'></label><div class='col-sm-5'>";
			stre += "<hr><a onclick='hpsTemuanE3(\"#e3_trow" + temuan_e31 + "\"); return false;' class='btn btn-sm btn-danger'> <i class='fa fa-times'></i> Hapus Temuan E3 " + judul_temuan_e3 + "</a>";
			stre += "</div>";
			stre += "</div>";
			stre += "<hr></div>";
			stre += "</div>";
			stre += "</div>";
			$("#form_temuan_e3_1").append(stre);
			temuan_e31 = (temuan_e31-1) + 2;
			document.getElementById("temuan_e31").value = temuan_e31;
		}

		function hpsTemuanE3(temuan_e31) {
			$(temuan_e31).remove();

			var temuan_e34 = document.getElementById("temuan_e31").value;
			temuan_e35 = temuan_e34-1;
			document.getElementById("temuan_e31").value = temuan_e35;
		}

		function tbhUraianE3($ids) {
			var e31 = document.getElementById("e31"+$ids+"").value;

			var stre;
			stre = "<div id='e3_trow" + e31 + $ids +"' style='display: block;'> ";

			stre += "<div class='form-group'>";
			stre += "<label class='col-sm-3 control-label no-padding-right'>Kode Rekomendasi</label>";
			stre += "<div class='col-sm-5'>";

			stre += "<select name='kode_rekomendasi_e3_"+ $ids +"[]' class='form-control'>";
	        stre += "<option>- Kode Rekomendasi -</option>";
	        stre += "<option value='00'> 00 </option>";
	        stre += "<option value='01'> 01 </option>";
	        stre += "<option value='02'> 02 </option>";
	        stre += "<option value='03'> 03 </option>";
	        stre += "<option value='04'> 04 </option>";
	        stre += "<option value='05'> 05 </option>";
	        stre += "<option value='06'> 06 </option>";
	        stre += "<option value='07'> 07 </option>";
	        stre += "<option value='08'> 08 </option>";
	        stre += "<option value='09'> 09 </option>";
	        stre += "<option value='10'> 10 </option>";
	        stre += "<option value='11'> 11 </option>";
	        stre += "<option value='12'> 12 </option>";
	        stre += "<option value='13'> 13 </option>";
	        stre += "<option value='14'> 14 </option>";
	        stre += "</select>";
			stre += "</div>";
			stre += "</div>";

			stre += "<div class='form-group'>";
			stre += "<label class='col-sm-3 control-label no-padding-right'>Uraian</label>";
			stre += "<div class='col-sm-5'>";
			stre += "<textarea name='uraian_e3_"+ $ids +"[]' placeholder='Uraian' class='form-control'></textarea>";
			stre += "</div>";
			stre += "</div>";

			stre += "<div class='form-group'>";
			stre += "<label class='col-sm-3 control-label no-padding-right'>Nilai</label>";
			stre += "<div class='col-sm-5'>";
			stre += "<input type='text' name='nilai_e3_"+ $ids +"[]' placeholder='Nilai' class='form-control'></input>";
			stre += "</div>";
			stre += "</div>";

			stre += "<div class='form-group'>";
			stre += "<label class='col-sm-3 control-label no-padding-right'></label>";
			stre += "<div class='col-sm-5'>";
			stre += "<a  onclick='hpsUraianE3(\"#e3_trow" + e31 + $ids +"\"); return false;' class='btn btn-sm btn-danger' title='Hapus uraian_e3_ "+ e31 +"'> <i class='fa fa-times'></i></a>";
			stre += "</div>";
			stre += "</div>";

			stre += "<br></div>";

			$("#form_uraian_e3_1_"+$ids+"").append(stre);
			e31 = (e31-1) + 2;
			document.getElementById("e31").value = e31;
		}

		function hpsUraianE3(e31) {
			$(e31).remove();

			var e34 = document.getElementById("e31").value;
			e35 = e34-1;
			document.getElementById("e31").value = e35;
		}
	</script>
</div>

													</div>
													<div id="tab_kepatuhan" class="tab-pane">
														<!-- Kepatuhan -->
<div class="kategori">
	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right"></label>
		<div class="col-sm-5">
			<h3 class="header left">Kepatuhan</h3>
		</div>
	</div>
	<input type="hidden" name="jml_temuan_kepatuhan" id="temuan_kepatuhan1" value="0" />
	<div id="form_temuan_kepatuhan_1"></div>
	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right"> &nbsp; </label>
		<div class="col-sm-9">
			<label class="control-label">
				<button type="button" class="btn btn-sm btn-success" onclick="tbhTemuanKepatuhan(); return false;" >
					<i class="fa fa-plus"></i>
					Tambah Temuan KEPATUHAN
				</button>
			</label>
		</div>
	</div>

	<script type="text/javascript">
		function tbhTemuanKepatuhan() {
			var temuan_kepatuhan1 = document.getElementById("temuan_kepatuhan1").value;
			var judul_temuan_kepatuhan = parseInt(temuan_kepatuhan1) + 1;

			var stre;
			stre  = "<div id='kepatuhan_trow" + temuan_kepatuhan1 + "'>";

			stre += "<div class='form-group'>";
			stre += "<label class='col-sm-3 control-label no-padding-right'>Kode Temuan</label>";
			stre += "<div class='col-sm-5'>";
			stre += "<select name='kode_temuan_kepatuhan["+ temuan_kepatuhan1+"]'>";
	        stre += "<option> - Kode Temuan - </option>";
	        stre += "<option value='101'> 101 </option>";
	        stre += "<option value='102'> 102 </option>";
	        stre += "<option value='103'> 103 </option>";
	        stre += "<option value='104'> 104 </option>";
	        stre += "<option value='105'> 105 </option>";
	        stre += "<option value='201'> 201 </option>";
	        stre += "<option value='202'> 202 </option>";
	        stre += "<option value='203'> 203 </option>";
	        stre += "<option value='301'> 301 </option>";
	        stre += "<option value='302'> 302 </option>";
	        stre += "<option value='303'> 303 </option>";
	        stre += "</select>";
			stre += "</div>";
			stre += "</div>";

			stre += "<div class='form-group'>";
			stre += "<label class='col-sm-3 control-label no-padding-right'>Temuan KEPATUHAN " + judul_temuan_kepatuhan + "</label>";
			stre += "<div class='col-sm-5'>";
			stre += "<textarea rows='4' class='form-control' placeholder='Temuan'  name='judul_kepatuhan["+ temuan_kepatuhan1+"]'></textarea>";
			stre += "</div>";
			stre += "</div>";

			stre += "<div class='form-group'>";
			stre += "<label class='col-sm-3 control-label no-padding-right'>Nilai</label>";
			stre += "<div class='col-sm-5'>";
			stre += "<input type='text' class='form-control' placeholder='Nilai' name='nilai_kepatuhan[]'/>";
			stre += "</div>";
			stre += "</div>";

			stre += "<div class='form-group'>";
			stre += "<label class='col-sm-3 control-label no-padding-right'></label>";
			stre += "<div class='col-sm-5'>";
			stre += "<b>PEJABAT TERKAIT</b>";
			stre += "</div>";
			stre += "</div>";

			stre += "<div class='form-group'>";
			stre += "<label class='col-sm-3 control-label no-padding-right'>Nama</label>";
			stre += "<div class='col-sm-5'>";
			stre += "<input type='text' class='form-control' placeholder='Nama' name='nama_kepatuhan[]'/>";
			stre += "</div>";
			stre += "</div>";

			stre += "<div class='form-group'>";
			stre += "<label class='col-sm-3 control-label no-padding-right'>NIP</label>";
			stre += "<div class='col-sm-5'>";
			stre += "<input type='text' class='form-control' placeholder='NIP' name='nip_kepatuhan[]'/>";
			stre += "</div>";
			stre += "</div>";

			stre += "<div class='form-group'>";
			stre += "<label class='col-sm-3 control-label no-padding-right'></label>";
			stre += "<div class='col-sm-5'>";
			stre += "<b>REKOMENDASI</b>";
			stre += "</div>";
			stre += "</div>";

			stre += "<input type='hidden' name='jml_uraian_kepatuhan' id='kepatuhan1" + temuan_kepatuhan1 + "' value='1' />";

			stre += "<div id='form_uraian_kepatuhan_1_" + temuan_kepatuhan1 + "'></div>";

			stre += "<div class='form-group'>";
			stre += "<label class='col-sm-3 control-label no-padding-right'> Rekomendasi KEPATUHAN " + judul_temuan_kepatuhan + "</label>";
			stre += "<div class='col-sm-5'>";
			stre += "<label class='control-label'><button type='button' class='btn btn-sm btn-warning' onclick='tbhUraianKepatuhan(" + temuan_kepatuhan1 + "); return false;' title='Tambah Rekomendasi'><i class='fa fa-plus'></i> Tambah Rekomendasi </button></label>";
			stre += "</div>";
			stre += "</div>";

			stre += "<div class='form-group'><label class='col-sm-3 control-label no-padding-right'></label><div class='col-sm-5'>";
			stre += "<hr><a onclick='hpsTemuanKepatuhan(\"#kepatuhan_trow" + temuan_kepatuhan1 + "\"); return false;' class='btn btn-sm btn-danger'> <i class='fa fa-times'></i> Hapus Temuan KEPATUHAN " + judul_temuan_kepatuhan + "</a>";
			stre += "</div>";
			stre += "</div>";
			stre += "<hr></div>";
			stre += "</div>";
			stre += "</div>";
			$("#form_temuan_kepatuhan_1").append(stre);
			temuan_kepatuhan1 = (temuan_kepatuhan1-1) + 2;
			document.getElementById("temuan_kepatuhan1").value = temuan_kepatuhan1;
		}

		function hpsTemuanKepatuhan(temuan_kepatuhan1) {
			$(temuan_kepatuhan1).remove();

			var temuan_kepatuhan4 = document.getElementById("temuan_kepatuhan1").value;
			temuan_kepatuhan5 = temuan_kepatuhan4-1;
			document.getElementById("temuan_kepatuhan1").value = temuan_kepatuhan5;
		}

		function tbhUraianKepatuhan($ids) {
			var kepatuhan1 = document.getElementById("kepatuhan1"+$ids+"").value;

			var stre;
			stre = "<div id='kepatuhan_trow" + kepatuhan1 + $ids +"' style='display: block;'> ";

			stre += "<div class='form-group'>";
			stre += "<label class='col-sm-3 control-label no-padding-right'>Kode Rekomendasi</label>";
			stre += "<div class='col-sm-5'>";

			stre += "<select name='kode_rekomendasi_kepatuhan_"+ $ids +"[]' class='form-control'>";
	        stre += "<option>- Kode Rekomendasi -</option>";
	        stre += "<option value='00'> 00 </option>";
	        stre += "<option value='01'> 01 </option>";
	        stre += "<option value='02'> 02 </option>";
	        stre += "<option value='03'> 03 </option>";
	        stre += "<option value='04'> 04 </option>";
	        stre += "<option value='05'> 05 </option>";
	        stre += "<option value='06'> 06 </option>";
	        stre += "<option value='07'> 07 </option>";
	        stre += "<option value='08'> 08 </option>";
	        stre += "<option value='09'> 09 </option>";
	        stre += "<option value='10'> 10 </option>";
	        stre += "<option value='11'> 11 </option>";
	        stre += "<option value='12'> 12 </option>";
	        stre += "<option value='13'> 13 </option>";
	        stre += "<option value='14'> 14 </option>";
	        stre += "</select>";
			stre += "</div>";
			stre += "</div>";

			stre += "<div class='form-group'>";
			stre += "<label class='col-sm-3 control-label no-padding-right'>Uraian</label>";
			stre += "<div class='col-sm-5'>";
			stre += "<textarea name='uraian_kepatuhan_"+ $ids +"[]' placeholder='Uraian' class='form-control'></textarea>";
			stre += "</div>";
			stre += "</div>";

			stre += "<div class='form-group'>";
			stre += "<label class='col-sm-3 control-label no-padding-right'>Nilai</label>";
			stre += "<div class='col-sm-5'>";
			stre += "<input type='text' name='nilai_kepatuhan_"+ $ids +"[]' placeholder='Nilai' class='form-control'></input>";
			stre += "</div>";
			stre += "</div>";

			stre += "<div class='form-group'>";
			stre += "<label class='col-sm-3 control-label no-padding-right'></label>";
			stre += "<div class='col-sm-5'>";
			stre += "<a  onclick='hpsUraianKepatuhan(\"#kepatuhan_trow" + kepatuhan1 + $ids +"\"); return false;' class='btn btn-sm btn-danger' title='Hapus uraian_kepatuhan_ "+ kepatuhan1 +"'> <i class='fa fa-times'></i></a>";
			stre += "</div>";
			stre += "</div>";

			stre += "<br></div>";

			$("#form_uraian_kepatuhan_1_"+$ids+"").append(stre);
			kepatuhan1 = (kepatuhan1-1) + 2;
			document.getElementById("kepatuhan1").value = kepatuhan1;
		}

		function hpsUraianKepatuhan(kepatuhan1) {
			$(kepatuhan1).remove();

			var kepatuhan4 = document.getElementById("kepatuhan1").value;
			kepatuhan5 = kepatuhan4-1;
			document.getElementById("kepatuhan1").value = kepatuhan5;
		}
	</script>
</div>
														
													</div>


												</div>
											</div>



											<div align="center" class="clearfix form-actions">
												&nbsp; &nbsp;
												<input class="btn btn-info" type="submit" name="submit" value="Simpan"></input>
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
<script type="text/javascript">
		$(document).ready(function()
      	{
      		var tgl = document.getElementById("tgl").value;
      		
      		$('.datepicker2').datetimepicker({
      			weekStart: 1,
      			daysOfWeekDisabled: [0,6],
      			language: 'id',
      			todayBtn: 1,
      			autoclose: 1,
      			todayHighlight: 1,
      			startView: 2,
      			minView: 2,
      			forceParse: 0
      		}); 
      	});
	</script>
<!-- inline scripts related to this page -->


</body>
</html>
