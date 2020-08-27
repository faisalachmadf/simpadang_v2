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
								<a href="<?= site_url('adum/home'); ?>">Home</a>
							</li>
							<li>
								<a href="<?= site_url('adum/data_tim'); ?>">Data Tim</a>
							</li>
							<li class="active"> Tambah Tim Pemeriksa </li>
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">

						<div class="page-header">
							<h1>
								Tambah Tim Pemeriksa
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Menambahkan data tim pemeriksa baru
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->

								<form id="validasi" class="form-horizontal" role="form" action="<?php site_url('adum/data_tim/tambah_tim_pemeriksa'); ?>" method="post">
								<div class="row">
									<div class="col-md-12">

										<div class="widget-box">
											<div class="widget-header">
												<h4 class="widget-title">
													<i class="menu-icon fa fa-pencil-square-o"></i>
													Formulir Tambah Tim Pemeriksa
												</h4>

												<div class="widget-toolbar">
													<a href="#" data-action="collapse">
														<i class="ace-icon fa fa-chevron-up"></i>
													</a>
												</div>
											</div>

											<div class="widget-body">
												<div class="widget-main">

													<!-- 
														* Jenis tim
														-> untuk keterangan jenis tim yang dibuat
													-->
			                    <input type="hidden" name="kategori_tim" value="Tim Pemeriksa" />													
			                    <!-- nomor urut (untuk surat tugas) -->
			                    <input type="hidden" name="no_urut" value="<?= $no_urut; ?>">
			                    <!-- ID Penugasan -->
			                    <input type="hidden" name="id_penugasan" value="<?= $id_tgs; ?>">
													<!-- ID Tim -->
			                    <input type="text" name="id_tim" value="<?= $id_tim; ?>">

			                    <div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"></label>
														<div class="col-sm-5">
															<h4 class="header center"> Masukan data pemeriksa yang akan dibuat. </h4>
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Penanggung Jawab </label>
														<div class="col-sm-9">
															<select name="daltu" class="select2" data-placeholder="Pilih Wakil Penanggung Jawab">
																<option> &nbsp; </option>
																<?php
																	foreach($irban as $row)
																	{
																		echo "<option value='$row->id_pegawai'> $row->nama [$row->jabatan] </option>";
																	}
																?>
															</select>
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right" for="form-field-tags">
															Pengendali Teknis
															<span class="help-button" title="Dalam pembuatan tim baru ini, apakan membutuhkan Pengendali Teknis?">?</span>
														</label>
														<div class="col-sm-9">
															<div class="radio">
																<label>
																	<input type="radio" name="stat_dalnis" class="ace dalnis" value="ya" checked="" />
																	<span class="lbl"> Ya </span>
																</label>

																<label>
																	<input type="radio" name="stat_dalnis" class="ace dalnis" value="tidak" />
																	<span class="lbl"> Tidak </span>
																</label>
															</div>
														</div>
													</div>

													<div id="form-dalnis">
														<div class="form-group">
															<label class="col-sm-3 control-label no-padding-right"> Pengendali Teknis </label>
															<div class="col-sm-9">
																<select name="dalnis" class="select2" data-placeholder="Pilih Pengendali Teknis">
																	<option> &nbsp; </option>
																	<?php
																		foreach($pegawai as $row)
																		{
																			echo "<option value='$row->id_pegawai'> $row->nama </option>";
																		}
																	?>
																</select>
															</div>
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Ketua Tim </label>
														<div class="col-sm-9">
															<select name="ketua_tim" class="select2" data-placeholder="Pilih Ketua Tim">
																<option> &nbsp; </option>
																<?php
																	foreach($pegawai as $row)
																	{
																		echo "<option value='$row->id_pegawai'> $row->nama </option>";
																	}
																?>
															</select>
														</div>
													</div>

													<input type="hidden" name="jml_agt" id="ke" value="2" />

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> </label>
														<div class="col-sm-9">
															<button type="button" class="btn btn-xs btn-warning" onclick="tambahElemenAgt(); return false;" title="Tambah anggota">
																<i class="fa fa-plus"></i>
																Tambah Anggota
															</button>
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Anggota </label>
														<div class="col-sm-9">
															<select name="anggota[]" class="select2" data-placeholder="Pilih Anggota Ke-1">
																<option> &nbsp; </option>
																<?php
																	foreach($pegawai as $row)
																	{
																		echo "<option value='$row->id_pegawai'> $row->nama </option>";
																	}
																?>
															</select> <br/><br/>

															<div id="form_agt"></div>

															<div id="alert">
																<i style="color:red">
																	<i class="fa fa-exclamation-triangle"></i> Batas Maks. 20 Anggota
																</i>
															</div>
														</div>
													</div>

													<hr/>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Nama Kegiatan Pengawasan </label>
														<div class="col-sm-9">
															<textarea name="nama_auditi" rows="3" cols="74" placeholder="Nama kegiatan pengawasan"></textarea>
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Nama Objek Pengawasan </label>
														<div class="col-sm-9">
															<textarea name="nama_auditi" rows="3" cols="74" placeholder="Nama objek pengawasan"></textarea>
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Alamat Kantor </label>
														<div class="col-sm-9">
															<textarea name="alamat_audit" rows="3" cols="50" placeholder="Alamat kantor"></textarea>
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Nomor Telepon </label>
														<div class="col-sm-9">
															<input type="text" name="no_tlp" id="input-mask-phone" class="col-xs-10 col-sm-3" placeholder="Nomor telepon" />
														</div>
													</div>

													<input type="hidden" name="jml_ins" id="kee" value="2" />
													<input type="hidden" name="kondisi_sasaran" id="kondisi-sasaran" value="input" />

													<div id="tbh-sasaran">
														<div class="form-group">
															<label class="col-sm-3 control-label no-padding-right"> </label>
															<div class="col-sm-9">
																<button type="button" class="btn btn-xs btn-warning" onclick="tambahElemenIns(); return false;" title="Tambah sasaran">
																	<i class="fa fa-plus"></i>
																	Tambah Sasaran
																</button>
															</div>
														</div>
													</div>

													<hr/>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Program Pengawasan </label>
														<div class="col-sm-9">
															<input type="text" name="" class="col-xs-10 col-sm-3" placeholder="Program pengawasan" />
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Sasaran Pengawasan </label>
														<div class="col-sm-9">
															<input type="text" name="no_tlp" class="col-xs-10 col-sm-8" placeholder="Sasaran pengawasan" />
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Tujuan Pengawasan </label>
														<div class="col-sm-9">
															<textarea name="nama_auditi" rows="5" cols="74" placeholder="Tujuan pengawasan"></textarea>
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Laporan Dikirim Kepada </label>
														<div class="col-sm-9">
															<textarea name="alamat_audit" rows="3" cols="50" placeholder="Penerima laporan pemeriksaan"></textarea>
														</div>
													</div>

													<!-- <div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Sasaran </label>
														<div class="col-sm-9">
															<input type="text" name="sasaran_input[]" id="input-sasaran" class="col-xs-10 col-sm-6" placeholder="Sasaran instansi yang akan di periksa" />

															<div class="form-sasaran">
																<select name="sasaran[]" class="select2" data-placeholder="Pilih Instansi Ke-1" id="form-sasaran1">
																	<option> &nbsp; </option>
																	<?php
																		foreach($instansi as $row)
																		{
																			echo "<option value='$row->nama_instansi'> [$row->kategori] $row->nama_instansi </option>";
																		}
																	?>
																</select>
															</div>

															&nbsp;
															<label class="control-label">
																<input type="checkbox" name="file-format" id="pilih-sasaran" class="ace" />
																<span class="lbl"> Pilih Sasaran</span>
															</label> <br/><br/>

															<div id="form_ins" class="form-sasaran"></div>

															<div id="alert2">
																<i style="color:red">
																	<i class="fa fa-exclamation-triangle"></i> Batas Maks. 30 Instansi
																</i>
															</div>

														</div>
													</div> -->

													<div class="hr hr-double dotted"></div>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"></label>
														<div class="col-sm-5">
															<h4 class="header center"> Masukan data surat tugas untuk tim pemeriksa. </h4>
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Tanggal Surat </label>
														<div class="col-sm-5">
															<label class="control-label"><?= $tgl_surat; ?></label>
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Nomor Surat </label>
														<div class="col-sm-5">
															<input type="text" name="no_surat" class="col-xs-12 col-sm-5" value="705/ST-<?= $no_surat; ?>">
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Dasar Surat </label>
														<div class="col-sm-5">
															<textarea name="dasar[]" rows="3" cols="60" placeholder="Dasar surat">Dokumen Pelaksanaan Anggaran Perangkat Daerah (DPA-PD) Inspektorat Kota Pariaman Tahun Anggaran 2018 Nomor : 900/Kep.01/BPKAD/2018 Tanggal 2 Januari 2018.</textarea>
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Perihal </label>
														<div class="col-sm-8">
															<textarea name="perihal" id="ckeditor" class="ckeditor"></textarea>
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Waktu Pelaksanaan </label>
														<div class="col-sm-9">
															<div class="input-group">
																<span class="input-group-addon">
																	<i class="ace-icon fa fa-calendar bigger-110"></i>
																</span>

																<input type="text" name="tgl_awal" class="col-xs-8 col-sm-2 datepicker" placeholder="Dari Tanggal" />
															</div>
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> </label>
														<div class="col-sm-9">
															<div class="input-group">
																<span class="input-group-addon">
																	<i class="ace-icon fa fa-calendar bigger-110"></i>
																</span>

																<input type="text" name="tgl_akhir" class="col-xs-8 col-sm-2 datepicker" placeholder="Sampai Tanggal" />
															</div>
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Tembusan </label>
														<div class="col-sm-9">
															<div class="radio">
																<label>
																	<input type="radio" name="tbs" class="ace rad2" value="-" checked="" />
																	<span class="lbl"> Kosong </span>
																</label>
																<label>
																	<input type="radio" name="tbs" class="ace rad2" value="tbs_ada" />
																	<span class="lbl"> Ada </span>
																</label>
															</div> <br/>

															<div id="form-tembusan">
																<input type="hidden" name="jml_tbs" id="ke3" value="2" />

																<input type="text" name="tembusan[]" class="col-xs-10 col-sm-5" placeholder="Tembusan 1" />
																<span class="help-inline col-xs-12 col-sm-5">
																	<button type="button" class="btn btn-sm btn-warning" onclick="tambahElemenTbs(); return false;" title="Tambah">
																		<i class="fa fa-plus"></i>
																		Tambah
																	</button>
																</span>
																<br/> <br/>

 																<div id="form_tbs"></div>
 																<div id="alert3"><i style="color:red"><i class="fa fa-exclamation-triangle"></i> Batas Maks. 10 Tembusan</i></div>

															</div>
														</div>
													</div>													

													<div align="center" class="clearfix form-actions">
														<a href="<?= site_url('adum/data_tim'); ?>" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>

														&nbsp;&nbsp;

														<button class="btn btn-danger" type="reset">
															<i class="ace-icon fa fa-refresh bigger-110"></i>
															Bersihkan
														</button>

														&nbsp; &nbsp;

														<input class="btn btn-info" type="submit" name="submit" value="Tambahkan"></input>
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

<!-- include data footer -->
<?php $this->load->view('layout/footer'); ?>

		<!-- inline scripts related to this page -->
    <script type="text/javascript">
      $(document).ready(function()
      {
      	//datepicker
				$(".datepicker").datepicker({
					format 						: 'yyyy-mm-dd',
					showOtherMonths		: true,
					selectOtherMonths	: false,
					autoclose 				: true,
					todayHighlight 		: true
				});
				//.datepicker      	

				$('#input-mask-phone').inputmask('0299-9{1,4}-9{1,4}');
      	$('.select2').css('width','250px').select2({allowClear:false});

      	//dalnis
				$('.dalnis').click(function(){
					if($(this).val() == "ya")
					{
						$('#form-dalnis').slideDown('fast');
					}
					else
					{
						$('#form-dalnis').slideUp('fast');
					}
				});

				$("#tbh-sasaran").hide();
				$(".form-sasaran").hide();

				//--> kondisi sasaran
				$('#pilih-sasaran').removeAttr('checked').on('change', function() {
					if(this.checked) {
						$('#input-sasaran').hide();
						$('#tbh-sasaran').slideDown();
						$('.form-sasaran').slideDown();
						document.getElementById("kondisi-sasaran").value = "pilih";
					}
					else {
						$('#input-sasaran').show();
						$('#tbh-sasaran').slideUp();
						$('.form-sasaran').slideUp();
						document.getElementById("kondisi-sasaran").value = "input";
					}
				});

				//tembusan
				$('#form-tembusan').hide();
				$('.rad2').click(function(){
					if($(this).val() == "tbs_ada")
					{
						$('#form-tembusan').slideDown('fast');
					}
					else
					{
						$('#form-tembusan').slideUp('fast');
					}
				});

				/* Validasi */
        //$('#validasi').validate({
          //-- Aturan karakter input --//
         /* rules:
          {
						nama  : {required: true, maxlength: 70},
						cp_pengguna		 : {required: true},
						status_pengguna: {required: true},
						username			 : {required: true, maxlength: 20},
						password			 : {required: true, maxlength: 20}
          },*/

          //-- Pesan error --//
         /* messages:
          {
            namaa:
            {
              required  : "&nbsp;<label style='color:red' class='control-label'> <i class='fa fa-exclamation-triangle'></i> <i>Tidak boleh kosong</i></label>",
              maxlength : "<div style='color:red'>Tidak boleh lebih dari 50 huruf</div>"
            },
            cp_pengguna:
            {
            	required  : "&nbsp;<label style='color:red' class='control-label'> <i class='fa fa-exclamation-triangle'></i> <i>Tidak boleh kosong</i></label>"
            },
            status_pengguna:
            {
            	required  : "&nbsp;<label style='color:red' class='control-label'> <i class='fa fa-exclamation-triangle'></i> <i>Tidak boleh kosong</i></label>"
            }
          },
          submitHandler: function(form) {
            form.submit();
          }
        });*/
      });

      //Jumlah anggota
			$("#alert").hide();
			function tambahElemenAgt() {
			  var ke = document.getElementById("ke").value;

			  if(ke > 20)
			  {
			  	$("#alert").show();
			  }
			  else
			  {
			  	var stre;
					stre = "<p id='srow" + ke + "'>" +
								 "	<select name='anggota[]' class='select2' data-placeholder='Pilih Pengendali Teknis'>" +
								 "		<option> -- Pilih Anggota Ke-"+ ke +" -- </option> <?php
												foreach($pegawai as $row)
												{
													echo "<option value='$row->id_pegawai'> $row->nama </option>";
												}
											?>" +
								 "	</select>" +
								 "  <a href='#' onclick='hapusElemenAgt(\"#srow" + ke + "\"); return false;' class='btn btn-sm btn-danger' title='Hapus anggota ke-"+ ke +"'> <i class='fa fa-minus'></i> </a>" +
								 "</p>";

			  	$("#form_agt").append(stre);
			  	ke = (ke-1) + 2;
			  	document.getElementById("ke").value = ke;

			  	$("#alert").hide();
			  }
			}

			function hapusElemenAgt(ke) {
				$("#alert").hide();
			  $(ke).remove();

			  var ke2 = document.getElementById("ke").value;
			  ke3 = ke2-1;
			  document.getElementById("ke").value = ke3;
			}
			//.jumlah anggota

			//Jumlah instansi
			$("#alert2").hide();
			function tambahElemenIns() {
			  var kee = document.getElementById("kee").value;

			  if(kee > 30)
			  {
			  	$("#alert2").show();
			  }
			  else
			  {
			  	var stre;
					stre = "<p id='ssrow" + kee + "'>" +
								 "	<select name='sasaran[]' class='select2' data-placeholder='Pilih Sasaran'>" +
								 "		<option> -- Pilih Instansi Ke-"+ kee +" -- </option> <?php
												foreach($instansi as $row)
												{
													echo "<option value='$row->nama_instansi'> [$row->kategori] $row->nama_instansi  </option>";
												}
											?>" +
								 "	</select>" +
								 "  <a href='#' onclick='hapusElemenIns(\"#ssrow" + kee + "\"); return false;' class='btn btn-sm btn-danger' title='Hapus instansi ke-"+ kee +"'> <i class='fa fa-minus'></i> </a>" +
								 "</p>";

			  	$("#form_ins").append(stre);
			  	kee = (kee-1) + 2;
			  	document.getElementById("kee").value = kee;

			  	$("#alert2").hide();
			  }
			}

			function hapusElemenIns(kee) {
				$("#alert2").hide();
			  $(kee).remove();

			  var kee2 = document.getElementById("kee").value;
			  kee3 = kee2-1;
			  document.getElementById("kee").value = kee3;
			}
			//.jumlah anggota

			//Tembusan
			$("#alert3").hide();
			function tambahElemenTbs() {
			  var ke3 = document.getElementById("ke3").value;

			  if(ke3 > 10)
			  {
			  	$("#alert3").show();
			  }
			  else
			  {
			  	var stre;
					stre = "<p id='srow" + ke3 + "'> <input type='text' size='40' name='tembusan[]' placeholder='Tembusan "+ ke3 +"' /> <a href='#' onclick='hapusElemenTbs(\"#srow" + ke3 + "\"); return false;' class='btn btn-sm btn-danger' title='Hapus tembusan "+ ke3 +"'> <i class='fa fa-minus'></i> </a> </p>";
			  	$("#form_tbs").append(stre);
			  	ke3 = (ke3-1) + 2;
			  	document.getElementById("ke3").value = ke3;

			  	$("#alert3").hide();
			  }
			}

			function hapusElemenTbs(ke3) {
				$("#alert3").hide();
			  $(ke3).remove();

			  var ke4 = document.getElementById("ke3").value;
			  ke5 = ke4-1;
			  document.getElementById("ke3").value = ke5;
			}
			//.Tembusan
    </script>

	</body>
</html>
