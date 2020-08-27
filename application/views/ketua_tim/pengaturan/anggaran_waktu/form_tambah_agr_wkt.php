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
								<a href="<?= site_url('ketua_tim/home'); ?>">Home</a>
							</li>
							<li>
								<a href="<?= site_url('ketua_tim/pengaturan/list_anggaran_waktu'); ?>">Pengaturan Anggaran Waktu</a>
							</li>
							<li class="active"> Tambah Alokasi Jenis Pekerjaan </li>
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">

						<div class="page-header">
							<h1>
								Tambah Alokasi Jenis Pekerjaan
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Mengelola jenis pekerjaan untuk alokasi anggaran waktu
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->

								<form id="validasi" class="form-horizontal" role="form" action="<?php site_url('ketua_tim/pengaturan/tambah_anggaran_waktu'); ?>" onsubmit="return cek_username(this)" method="post">
								<div class="row">
									<div class="col-md-12">

										<div class="widget-box">
											<div class="widget-header">
												<h4 class="widget-title">
													<i class="menu-icon fa fa-pencil-square-o"></i>
													Formulir Tambah Alokasi Jenis Pekerjaan
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
														<label class="col-sm-3 control-label no-padding-right"> Jenis Pekerjaan </label>
														<div class="col-sm-9">
															<textarea name="jenis_pekerjaan" rows="3" cols="50" placeholder="Masukan jenis pekerjaan"></textarea>
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Kategori Pekerjaan </label>
														<div class="col-sm-9">
															<select name="kategori">
																<option> - Pilih Kategori - </option>
																<option value="1"> PERSIAPAN </option>
																<option value="2"> PELAKSANAAN </option>
																<option value="3"> PENYELESAIAN </option>
															</select>
														</div>
													</div>

													<div align="center" class="clearfix form-actions">
														<a href="javascript:history.back()" class="btn btn-default">
															<i class="fa fa-arrow-left"></i> Kembali 
														</a>

														&nbsp;&nbsp;

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
      	$('.select2').css('width','200px').select2({allowClear:false});

				/* Validasi */
        $('#validasi').validate({
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
        });
      });
    </script>

	</body>
</html>
