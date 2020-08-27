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
							<li>
								<a href="<?= site_url('adm/kelola_pengguna'); ?>"> Data Pengguna </a>
							</li>
							<li class="active"> Ubah Pengguna </li>
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">

						<div class="page-header">
							<h1>
								Ubah Pengguna
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Mengubah data pengguna
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->

								<form id="validasi1" class="form-horizontal" role="form" action="<?= site_url('adm/kelola_pengguna/ubah_pengguna/'. base64_encode($data->id_pegawai)); ?>" method="post">
								<div class="row">
									<div class="col-md-12">

										<div class="widget-box">
											<div class="widget-header">
												<h4 class="widget-title">
													<i class="menu-icon fa fa-pencil-square-o"></i>
													Formulir Ubah Pengguna
												</h4>

												<div class="widget-toolbar">
													<a href="#" data-action="collapse">
														<i class="ace-icon fa fa-chevron-up"></i>
													</a>
												</div>
											</div>

											<div class="widget-body">
												<div class="widget-main">

													<!-- ID Pegawai -->
			                    <input type="hidden" name="id_pegawai" value="<?= $data->id_pegawai; ?>">

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> NIP </label>
														<div class="col-sm-9">
															<input type="text" name="nip" class="col-xs-10 col-sm-3" placeholder="Nomor induk pegawai" value="<?= $data->nip; ?>" />
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Nama Lengkap </label>
														<div class="col-sm-9">
															<input type="text" name="nama" class="col-xs-10 col-sm-5" placeholder="Nama lengkap" value="<?= $data->nama; ?>" />
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Pangkat </label>
														<div class="col-sm-9">
															<input type="text" name="pangkat" class="col-xs-10 col-sm-3" placeholder="Pangkat" value="<?= $data->pangkat; ?>" />
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
																		echo "<option value='$row->isi_set'";
																		if($data->golongan == $row->isi_set)
																		{	echo "selected"; }
																		echo "> $row->isi_set </option>";
																	}
																?>
															</select>
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> No. Telepon </label>
														<div class="col-sm-9">
															<input type="text" name="no_tlp" class="col-xs-10 col-sm-3" placeholder="No telepon" value="<?= $data->no_tlp; ?>" />
														</div>
													</div>

													<?php 
														if($data->jabatan == "Inspektur") {
															echo "
															<input type='hidden' name='jabatan' value='$data->jabatan' />

															<div class='form-group'>
																<label class='col-sm-3 control-label no-padding-right'> Jabatan Pegawai </label>
																<div class='col-sm-9'>
																	<input type='text' class='col-xs-10 col-sm-3' placeholder='Jabatan pegawai' value='$data->jabatan' readOnly='' />
																</div>
															</div>";
														} else { 
													?>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Jabatan Pegawai </label>
														<div class="col-sm-9">
															<input type="text" name="jabatan" class="col-xs-10 col-sm-3" placeholder="Jabatan pegawai" value="<?= $data->jabatan; ?>" />
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Jenis Jabatan Pegawai </label>
														<div class="col-sm-5">
															<select name="jenis_jabatan" class="chosen-select form-control" id="form-field-select-3">


																<option value="<?= $data->jenis_jabatan; ?>" selected="selected"><?= $data->jenis_jabatan; ?></option>
																<option value="" style="background-color: yellow;">--Jika Revisi --</option>
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

												
													<hr/>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Jabatan Tim (saat ini) </label>
														<div class="col-sm-9">
															<select name="jabatan_tim">
																<?php 
																	foreach ($jbtn_tim as $row) 
																	{
																		echo "<option value='$row->isi_set'";
																		if($data->jabatan_tim == $row->isi_set)
																		{	echo "selected"; }
																		echo "> $row->isi_set </option>";
																	}
																?>
															</select>
														</div>
													</div>

													<?php } ?>

													<div align="center" class="clearfix form-actions">
														<a href="<?= site_url('adm/kelola_pengguna'); ?>" class="btn btn-default">
															<i class="ace-icon fa fa-arrow-left"></i>
															Kembali
														</a>

														&nbsp; &nbsp;

														<button class="btn btn-danger" type="reset">
															<i class="ace-icon fa fa-undo bigger-110"></i>
															Bersihkan
														</button>

														&nbsp; &nbsp;

														<input class="btn btn-info" type="submit" name="submit" value="Ubah"></input>
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
				/* Validasi */
        $('#validasi').validate({
          //-- Aturan karakter input --//
          rules:
          {
            nama_pengguna  : {required: true, maxlength: 50},
						cp_pengguna		 : {required: true},
						status_pengguna: {required: true}
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
            }
          },
          submitHandler: function(form) {
            form.submit();
          }
        });
      });
    </script>

	</body>
</html>
