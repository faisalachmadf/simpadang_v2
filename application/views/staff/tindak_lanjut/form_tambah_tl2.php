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
							<li class="active"> Tambah Tindak Lanjut </li>
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">

						<div class="page-header">
							<h1>
								Tambah Tindak Lanjut
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Menambahkan data penugasan tindak lanjut
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->

								<form id="validasi" class="form-horizontal" role="form" action="<?php site_url('staff/tindak_lanjut/tambah_tl2'); ?>" method="post">
								<div class="row">
									<div class="col-md-12">

										<div class="widget-box">
											<div class="widget-header">
												<h4 class="widget-title">
													<i class="menu-icon fa fa-pencil-square-o"></i>
													Formulir Tambah Tindak Lanjut
												</h4>

												<div class="widget-toolbar">
													<a href="#" data-action="collapse">
														<i class="ace-icon fa fa-chevron-up"></i>
													</a>
												</div>
											</div>

											<div class="widget-body">
												<div class="widget-main">

													<!-- ID Tidak lanjut -->
			                    <input type="hidden" name="id_tl" value="<?= $id_tl; ?>">
			                    
			                    <!-- ID Tim -->
			                    <input type="hidden" name="id_tim" value="<?= $id_tim; ?>">

			                    <!-- nomor urut (untuk surat tugas, rp & kp) -->
			                    <input type="hidden" name="no_urut" value="<?= $no_urut; ?>">
			                    <!-- kategori tim -->
			                    <input type="hidden" name="kategori_tim" value="Tim Tindak Lanjut" />

			                    <div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"></label>
														<div class="col-sm-5">
															<h4 class="header center"> Masukan data kegiatan tindak lanjut </h4>
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Tanggal </label>
														<div class="col-sm-9">
															<div class='input-group date datepicker'>
																<span class='input-group-addon'><i class="ace-icon fa fa-calendar bigger-110"></i></span>
																<input type='text' name='tgl_tl' class='col-xs-8 col-sm-2' placeholder='Tanggal' required value='<?= $tgl; ?>' />
															</div>
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Ketua Tim </label>
														<div class="col-sm-9">
															<select required name="ketua_tim" class="select2 required" data-placeholder="Pilih Ketua Tim">
																<option disabled selected></option>
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
														<label class="col-sm-3 control-label no-padding-right"> Anggota </label>
														<div class="col-sm-9">
															<select required name="anggota[]" class="select2 required" data-placeholder="Pilih Anggota Ke-1">
																<option disabled selected></option>
																<?php
																	foreach($pegawai as $row)
																	{
																		echo "<option value='$row->id_pegawai'> $row->nama </option>";
																	}
																?>
															</select>
															<br/>
															<br/>
															<div id="form_agt"></div>

															<div id="alert">
																<i style="color:red">
																	<i class="fa fa-exclamation-triangle"></i> Batas Maks. 20 Anggota
																</i>
															</div>
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> </label>
														<div class="col-sm-9">
															<button type="button" class="btn btn-xs btn-warning" onclick="tambahElemenAgt(); return false;" title="Tambah anggota">
																<i class="fa fa-plus"></i>
																Tambah Anggota
															</button>
														</div>
													</div>

													<input type="hidden" name="jml_ins" value="" id="jml-check" />

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Sasaran Tindak Lanjut </label>
														<div class="col-sm-9">
															<select required name="sasaran_peng" class="select2 required" data-placeholder="Pilih Sasaran Tindak Lanjut">
																<option disabled selected></option>
																<?php
																	foreach($temuan as $row)
																	{
																		echo "<option value='$row->id_temuan'> $row->no_lhp - $row->instansi </option>";
																	}
																?>
															</select>
														</div>
													</div>


													<div class="hr hr-double dotted"></div>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"></label>
														<div class="col-sm-5">
															<h4 class="header center"> Masukan data surat tugas untuk tim tindak lanjut </h4>
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Tanggal Surat </label>
														<div class="col-sm-9">
															<div class='input-group date datepicker'>
																<span class='input-group-addon'><i class="ace-icon fa fa-calendar bigger-110"></i></span>
																<input required type='text' name='tgl_surat' class='col-xs-8 col-sm-2' placeholder='Tanggal Surat' required value='<?= $tgl; ?>' />
															</div>
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Nomor Surat </label>
														<div class="col-sm-9">
															<input required type="text" name="no_surat" class="col-xs-12 col-sm-5" value="705/ST-<?= $no_surat; ?>">
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Dasar Surat </label>
														<div class="col-sm-5">
															<textarea required name="dasar_surat" rows="3" cols="60" placeholder="Dasar surat"><?= $dasar->isi; ?></textarea>
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
															<div class='input-group date datepicker'>
																<span class='input-group-addon'><i class="ace-icon fa fa-calendar bigger-110"></i></span>
																<input required type='text' name='tgl_awal' class='col-xs-8 col-sm-2' placeholder='Dari Tanggal' required />
															</div>
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> </label>
														<div class="col-sm-9">
															<div class='input-group date datepicker'>
																<span class='input-group-addon'><i class="ace-icon fa fa-calendar bigger-110"></i></span>
																<input required type='text' name='tgl_akhir' class='col-xs-8 col-sm-2' placeholder='Sampai Tanggal' required />
															</div>
														</div>
													</div>

													<input type="hidden" name="jml_tbs" id="ke3" value="<?= $max_tbs->max_tbs+1; ?>" />

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Tembusan </label>
														<div class="col-sm-9">
															<label class="control-label">
															<?php
																foreach($tembusan as $row)
																{
																	echo "<p id='trow$row->nomor'><input required type='text' name='tembusan[]' size='70' value='$row->isi' placeholder='Tembusan 1' />
																	<a href='#' onclick='hapusElemenTbs(\"#trow$row->nomor\"); return false;' class='btn btn-sm btn-danger' title='Hapus tembusan $row->nomor'> <i class='fa fa-minus'></i> </a></p> ";
																}
															?>

															<div id="form_tbs"></div>
															<div id="alert3"><i style="color:red"><i class="fa fa-exclamation-triangle"></i> Batas Maks. 10 Tembusan</i></div>
															</label>
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> &nbsp; </label>
														<div class="col-sm-9">
															<label class="control-label">
																<button type="button" class="btn btn-sm btn-warning" onclick="tambahElemenTbs(); return false;" title="Tambah tembusan">
																		<i class="fa fa-plus"></i>
																		Tambah Tembusan
																	</button>
															</label>
														</div>
													</div>

													<div align="center" class="clearfix form-actions">
														<a href="<?= site_url('staff/penugasan'); ?>" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>

														&nbsp;&nbsp;

														<a href="<?php site_url('staff/tindak_lanjut/tambah_tl2'); ?>" class="btn btn-danger"><i class="ace-icon fa fa-refresh bigger-110"></i> Bersihkan</a>

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

			<input type="hidden" id="tgl" value="<?= date('Y-m-d H:i'); ?>" />

<!-- include data footer -->
<?php $this->load->view('layout/footer'); ?>

		<!-- inline scripts related to this page -->
    <script type="text/javascript">
      $(document).ready(function()
      {
      	var tgl = document.getElementById("tgl").value;
      	//datepicker
      	$('.datepicker').datetimepicker({
      		language: 'id',
	        todayBtn: 1,
					autoclose: 1,
					todayHighlight: 1,
					startView: 2,
					minView: 2,
					forceParse: 0,
			  });

				$('#input-mask-phone').inputmask('0299-9{1,4}-9{1,4}');
      	$('.select2').css('width','310px').select2({allowClear:false});

      	//dalnis
				/*$('.dalnis').click(function(){
					if($(this).val() == "ya")
					{
						$('#form-dalnis').slideDown('fast');
					}
					else
					{
						$('#form-dalnis').slideUp('fast');
					}
				});*/


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

      });

			function check(no)
			{
      	//$('#checkbox-value').text($('#checkbox1').val());
      	var jml = document.getElementById("jml-check").value;

				$("#check"+no).on('change', function() {
				  if($(this).is(':checked')) 
				  {
				    jml = (jml-1) + 2;
			  		document.getElementById("jml-check").value = jml;
				  } 
				  else 
				  {
				    jml = jml-1;
			  		document.getElementById("jml-check").value = jml;
				  }
				  
				  //$('#checkbox-value').text($('#checkbox1').val());
				});
			}

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
			  	stre = "<p id='arow" + ke + "'>" +
			  	"	<select id='tbh_agt" + ke + "' required name='anggota[]' class='select2 required' data-placeholder='-- Pilih Anggota Ke-" + ke + " --'>" +
			  	"	<option value=''>-- Pilih Anggota Ke-" + ke + " --</option><?php
			  	foreach($pegawai as $row)
			  	{
			  		echo "<option value='$row->id_pegawai'> $row->nama </option>";
			  	}
			  	?>" +
			  	"	</select>" +
			  	"  <a href='#' onclick='hapusElemenAgt(\"#arow" + ke + "\"); return false;' class='btn btn-sm btn-danger' title='Hapus anggota ke-"+ ke +"'> <i class='fa fa-minus'></i> </a>" +
			  	"</p>";

			  	$("#form_agt").append(stre);
			  	$('#tbh_agt'+ ke).select2();
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
					stre = "<p id='irow" + kee + "'>" +
								 "	<select name='sasaran[]' class='desa'>" +
								 "		<option> -- Pilih Instansi Ke-"+ kee +" -- </option>" +
								 "		<option>&nbsp;</option>" +
								 "	</select>" +
								 "  <a href='#' onclick='hapusElemenIns(\"#irow" + kee + "\"); return false;' class='btn btn-sm btn-danger' title='Hapus instansi ke-"+ kee +"'> <i class='fa fa-minus'></i> </a>" +
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
					stre = "<p id='trow" + ke3 + "'> <input required type='text' size='70' name='tembusan[]' placeholder='Tembusan "+ ke3 +"' /> <a href='#' onclick='hapusElemenTbs(\"#trow" + ke3 + "\"); return false;' class='btn btn-sm btn-danger' title='Hapus tembusan "+ ke3 +"'> <i class='fa fa-minus'></i> </a> </p>";
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

			$(document).ready(function()
      {
      	$("#kecamatan").change(function(){
					var value=$(this).val();

					$.ajax({
	          type : 'post',
	          url  : "<?= site_url('staff/tindak_lanjut/get_desa'); ?>",
	          data : {id:value}, //'rowid='+ rowid,
	          success : function(data)
	          {
	          	$('.desa').html(data); //menampilkan data ke dalam modal
	          }
	      	});
				});
      });
    </script>

	</body>
</html>
