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
								<a href="<?= site_url('adum/data_surat'); ?>">Surat Tugas</a>
							</li>
							<li class="active"> Lengkapi Surat Tugas </li>
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">

						<div class="page-header">
							<h1>
								Lengkapi Surat Tugas
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Melengkapi data surat tugas
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->

								<form id="validasi" class="form-horizontal" role="form" action="<?php site_url('adum/data_surat/lengkapi_data/'.base64_encode($data->id_tugas).'/'. base64_encode($data->id_tim)); ?>" method="post">
								<div class="row">
									<div class="col-md-12">

										<div class="widget-box">
											<div class="widget-header">
												<h4 class="widget-title">
													<i class="menu-icon fa fa-pencil-square-o"></i>
													Formulir Surat Tugas
												</h4>

												<div class="widget-toolbar">
													<a href="#" data-action="collapse">
														<i class="ace-icon fa fa-chevron-up"></i>
													</a>
												</div>
											</div>

											<div class="widget-body">
												<div class="widget-main">

													<!-- ID tugas -->
			                    <input type="hidden" name="id_tugas" value="<?= $data->id_tugas; ?>" />
													<!-- ID Tim -->
			                    <input type="hidden" name="id_tim" value="<?= $data->id_tim; ?>">
			                    <!-- Nomor surat -->
			                    <input type="hidden" name="no_surat" value="<?= $data->no_surat; ?>">

			                    <div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"></label>
														<div class="col-sm-6">
															<h4 class="header center"><i class="fa fa-users fa-lg"></i>&nbsp; Data Tim Pemeriksa/Audit </h4>
														</div>
													</div>

													<?php if($data->dalnis != NULL) { ?>
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right" for="form-field-tags"> Pengendali Teknis : </label>
														<div class="col-sm-9">
															<label class="control-label"><strong><?= $dalnis->nama; ?></strong></label>
														</div>
													</div>
													<?php } ?>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right" for="form-field-tags"> Ketua Tim : </label>
														<div class="col-sm-9">															
															<label class="control-label"><strong><?= $ketua_tim->nama; ?></strong></label>
														</div>
													</div>

													<input type='hidden' name='jml_agt' value='<?= $jml_agt->jml; ?>' />

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right" for="form-field-tags"> Anggota Tim : </label>
														<div class="col-sm-9">
															<?php
																foreach($tim as $row)
																{
																	if($row->anggota != NULL)
																	{ 
																		echo "
																		<label class='control-label'>
																			<strong>$row->nomor. $row->nama </strong>
																		</label>
																		<input type='hidden' name='anggota[]' value='$row->anggota' /> <br/>"; 
																	}
																}
															?>
														</div>
													</div>													

													<div class="hr hr-double dotted"></div>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"></label>
														<div class="col-sm-6">
															<h4 class="header center"><i class="fa fa-envelope fa-lg"></i>&nbsp; Data Surat Tugas </h4>
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Tanggal Surat :</label>
														<div class="col-sm-5">
															<label class="control-label"><strong><?= $tgl_surat; ?></strong></label>
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Nomor Surat : </label>
														<div class="col-sm-5">
															<label class="control-label"><strong><?= $data->no_st; ?></strong></label>
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Waktu Pelaksanaan : </label>
														<div class="col-sm-5">
															<label class="control-label"><strong><?= $tgl_awal ." s/d ". $tgl_akhir; ?></strong></label>
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Dasar Surat </label>
														<div class="col-sm-5">
															<textarea name="dasar" rows="3" cols="100" placeholder="Dasar surat"><?= $data->dasar_surat; ?></textarea>
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Perihal </label>
														<div class="col-sm-8">
															<textarea name="perihal" id="ckeditor" class="ckeditor"></textarea>
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

													<div class="form-group">
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
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> </label>
														<div class="col-sm-9">
															<button type="button" class="btn btn-xs btn-warning" onclick="tambahElemenTbs(); return false;" title="Tambah tembusan">
																<i class="fa fa-plus"></i>
																Tambah Tembusan
															</button>
														</div>
													</div>

													<input type="hidden" name="jml_tbs" id="ke3" value="<?= $jml_tbs->max_tbs+1; ?>" />

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Tembusan </label>
														<div class="col-sm-9">
															<?php
																foreach($tembusan as $row)
																{
																	echo "<p id='t$row->nomor'><input type='text' name='tembusan[]'' class='col-xs-10 col-sm-7' value='$row->tembusan' placeholder='Tembusan $row->nomor' /> &nbsp; <a href='#' onclick='hapusElemenTbs(\"#t$row->nomor\"); return false;' class='btn btn-sm btn-danger' title='Hapus tembusan $row->nomor'> <i class='fa fa-minus'></i> </a> <p/> ";
																}
															?>														

															<div id="form_tbs"></div>
															<div id="alert3"><i style="color:red"><i class="fa fa-exclamation-triangle"></i> Batas Maks. 10 Tembusan</i></div>

														</div>
													</div>													

													<div align="center" class="clearfix form-actions">
														<a href="<?= site_url('adum/data_surat'); ?>" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>

														&nbsp;&nbsp;

														<button class="btn btn-danger" type="reset">
															<i class="ace-icon fa fa-refresh bigger-110"></i>
															Bersihkan
														</button>

														&nbsp; &nbsp;

														<input class="btn btn-info" type="submit" name="submit" value="Lengkapi"></input>
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
				/*$('#form-tembusan').hide();
				$('.rad2').click(function(){
					if($(this).val() == "tbs_ada")
					{
						$('#form-tembusan').slideDown('fast');
					}
					else
					{
						$('#form-tembusan').slideUp('fast');
					}
				});*/

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
			//.jumlah instansi

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
					stre = "<p id='srow" + ke3 + "'> <input type='text' size='64' name='tembusan[]' placeholder='Tembusan "+ ke3 +"' /> <a href='#' onclick='hapusElemenTbs(\"#srow" + ke3 + "\"); return false;' class='btn btn-sm btn-danger' title='Hapus tembusan "+ ke3 +"'> <i class='fa fa-minus'></i> </a> </p>";
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
