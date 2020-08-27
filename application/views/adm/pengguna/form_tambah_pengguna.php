<?php
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
								<a href="<?= site_url('adm/home'); ?>">Home</a>
							</li>
							<li class="active"> Tambah Pengguna </li>
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">

						<div class="page-header">
							<h1>
								Tambah Pengguna
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Menambahkan data pengguna
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->

								<form id="validasi" class="form-horizontal" role="form" action="<?php site_url('adm/kelola_pengguna/tambah_pengguna'); ?>" onsubmit="return cek_username(this)" method="post">
								<div class="row">
									<div class="col-md-12">

										<div class="widget-box">
											<div class="widget-header">
												<h4 class="widget-title">
													<i class="menu-icon fa fa-pencil-square-o"></i>
													Formulir Tambah Pengguna
												</h4>

												<div class="widget-toolbar">
													<a href="#" data-action="collapse">
														<i class="ace-icon fa fa-chevron-up"></i>
													</a>
												</div>
											</div>

											<div class="widget-body">
												<div class="widget-main">

													<!-- ID Pengguna -->
			                    <input type="hidden" name="id_pegawai" value="<?= $id_max_pgn; ?>">

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> NIP </label>
														<div class="col-sm-9">
															<input type="text" name="nip" class="col-xs-10 col-sm-3" placeholder="Nomor induk pegawai" />
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Nama Lengkap </label>
														<div class="col-sm-9">
															<input type="text" name="nama" class="col-xs-10 col-sm-7" placeholder="Nama lengkap" />
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Pangkat </label>
														<div class="col-sm-9">
															<input type="text" name="pangkat" class="col-xs-10 col-sm-3" placeholder="Pangkat" />
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Golongan </label>
														<div class="col-sm-9">
															<select name="golongan">
																<option> - Pilih Gol - </option>
																<?php 
																	foreach ($gol as $row) 
																	{
																		echo "<option value='$row->isi_set'> $row->isi_set </option>";
																	}
																?>
															</select>
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Jabatan </label>
														<div class="col-sm-9">
															<select name="jabatan" class="select2" data-placeholder="Pilih Jabatan">
																<option> &nbsp; </option>
																<option value="Inspektur Pembantu Bidang Ekonomi & Pembangunan"> Inspektur Pembantu Bidang Ekonomi & Pembangunan </option>
																<option value="Inspektur Pembantu Bidang Keuangan & Pendayagunaan Aparatur"> Inspektur Pembantu Bidang Keuangan & Pendayagunaan Aparatur </option>
																<option value="Inspektur Pembantu Bidang Kesejahteraan Rakyat"> Inspektur Pembantu Bidang Kesejahteraan Rakyat </option>
																<option value="Inspektur Pembantu Bidang Pemerintahan"> Inspektur Pembantu Bidang Pemerintahan </option>
																<option value="Fungsional Umum"> Fungsional Umum </option>
																<option value="Fungsional Perencanaan Madya"> Fungsional Perencanaan Madya </option>
																<option value="Kasubag Evaluasi dan Pelaporan"> Kasubag Evaluasi dan Pelaporan </option>
																<option value="Kasubag Perencanaan"> Kasubag Perencanaan </option>
																<option value="Kasubag Kasubag Administrasi dan umum"> Kasubag Administrasi dan umum </option>
																<option value="P2UPD Madya"> P2UPD Madya </option>
																<option value="P2UPD Pertama"> P2UPD Pertama </option>
																<option value="P2UPD Muda"> P2UPD Muda </option>
																<option value="Auditor Madya"> Auditor Madya </option>
																<option value="Auditor Pertama"> Auditor Pertama </option>
																<option value="Auditor Muda"> Auditor Muda </option>
																<option value="Auditor Penyelia"> Auditor Penyelia </option>
																<option value="Auditor Pelaksana Lanjutan"> Auditor Pelaksana Lanjutan </option>
																<option value="Perencana Madya"> Perencana Madya </option>
																<option value="Perencana Muda"> Perencana Muda </option>
																<option value="Audiwan Pertama"> Audiwan Pertama </option>
																<option value="Audiwan Muda"> Audiwan Muda </option>
																<option value="TKS"> TKS </option>
															</select>
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Jenis Jabatan</label>
														<div class="col-sm-9">
															<div class="input-group">
																<select class="form-control" name="jenis_jabatan">
																	<option value="">--Pilih Jenis Jabatan--</option>
																	<option value="inspektur">Inspektur</option>
																	<option value="sekretaris">Sekretaris</option>
																	<option value="irban">Irban</option>
																	<option value="adum">Administrasi Umum</option>
																	<option value="fungsional_umum">Fungsional Umum</option>
																	<option value="jafung">Fungsional Tertentu</option>

																</select>
																<small class="form-text text-danger"> <?= form_error('jenis_jabatan'); ?></small>
															</div>
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> No. Telepon </label>
														<div class="col-sm-9">
															<input type="text" name="no_tlp" class="col-xs-10 col-sm-3" placeholder="No. telepon" />
														</div>
													</div>

													<!-- <div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Jabatan </label>
														<div class="col-sm-9">
															<input type="text" name="jabatan" class="col-xs-10 col-sm-3" placeholder="Jabatan pegawai" />
														</div>
													</div> -->

													<hr/>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Username </label>
														<div class="col-sm-9">
															<input type="text" name="username" class="col-xs-10 col-sm-2" id="username" placeholder="Username" />
															<label class="control-label" id="pesan"></label>
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Password </label>
														<div class="col-sm-9">
															<input type="text" name="password" class="col-xs-10 col-sm-2" value="jago" placeholder="Kata Sandi" />
														</div>
													</div>

													<!-- <div class="well">
		                        <label style="color: blue; font-style: italic;">
		                        	* Status PIMPINAN : Untuk mendefinisikan Dekan, Wakil Dekan I, Wakil Dekan II dan Wakil Dekan III atau jajarannya.
		                        </label>
		                      </div> -->

													<div align="center" class="clearfix form-actions">
														<button class="btn btn-danger" type="reset">
															<i class="ace-icon fa fa-undo bigger-110"></i>
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
      	$('.select2').css('width','330px').select2({allowClear:false});

      	/* Ajax cek username */
      	$.ajaxSetup({
					type 	: "POST",
					url 	: "<?= site_url('adm/kelola_pengguna/cek_username') ?>",
					cache	: false,
				});

				$("#username").change(function(){
					$("#pesan").html("&nbsp; <i class='fa fa-spinner fa-pulse'></i> <i>Memeriksa ...</i>");

					var value=$(this).val();
					$.ajax({
						data: {modul:'user', id:value},
						success: function(data){
							if(data==0) {
								$("#pesan").html("&nbsp; <i class='fa fa-check'></i> <i>Username tersedia</i>");
								$('#pesan').css("color", "#090");
								$('#username').attr('title', 'sukses');
								//$('#username').css("border", "2px #090 solid");
							}
							else {
								$("#pesan").html("&nbsp; <i class='fa fa-close'></i> <i>Username sudah digunakan!</i>");
								$('#pesan').css("color", "#C33");
								$('#username').attr('title', 'gagal');
								//$('#username').css('border', '2px #C33 solid');
							}
						}
					});
				});

				/* Validasi */
        /*$('#validasi').validate({
          //-- Aturan karakter input --//
          rules:
          {
						nama_pengguna  : {required: true, maxlength: 50},
						cp_pengguna		 : {required: true},
						status_pengguna: {required: true},
						username			 : {required: true, maxlength: 20},
						password			 : {required: true, maxlength: 20}
          },

          //-- Pesan error --//
          messages:
          {
            nama_pengguna:
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
            },
            username:
            {
            	required  : "&nbsp;<label style='color:red' class='control-label'> <i class='fa fa-exclamation-triangle'></i> <i>Tidak boleh kosong</i></label>",
            	maxlength : "<div style='color:red'>Tidak boleh lebih dari 20 karakter</div>"
            },
            password:
            {
            	required  : "&nbsp;<label style='color:red' class='control-label'> <i class='fa fa-exclamation-triangle'></i> <i>Tidak boleh kosong</i></label>",
            	maxlength : "<div style='color:red'>Tidak boleh lebih dari 20 karakter</div>"
            }
          },
          submitHandler: function(form) {
            form.submit();
          }
        });*/
      });

      /* Cek kondisi username. jika duplikat form tidak di proses */
      function cek_username(form){
				var value=$("#username").attr('title');
				if(value == "gagal"){
					alert("Perhatian! Username sudah di gunakan, Harap ganti username.");
					form.username.focus();
					return (false);
				}
				else {
					return (true);
				}
			}
    </script>

	</body>
</html>
