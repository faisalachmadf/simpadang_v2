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
								<a href="<?= site_url('staff/home'); ?>">Home</a>
							</li>
							<li>
								<a href="<?= site_url('staff/instansi'); ?>"> Instansi </a>
							</li>
							<li class="active"> Ubah Instansi </li>
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">

						<div class="page-header">
							<h1>
								Ubah Instansi
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Mengubah nama instansi
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->

								<form id="validasi" class="form-horizontal" role="form" action="<?= site_url('staff/instansi/ubah_desa/'. base64_encode($data->id) .'/'. base64_encode($data->id_instansi)); ?>" method="post">
								<div class="row">
									<div class="col-md-12">

										<div class="widget-box">
											<div class="widget-header">
												<h4 class="widget-title">
													<i class="menu-icon fa fa-pencil-square-o"></i>
													Formulir Ubah Instansi
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
														<label class="col-sm-3 control-label no-padding-right"> Nama Kecamatan </label>
														<div class="col-sm-9">
															<label class="control-label"> <strong><?= $data->nama_kecamatan; ?></strong> </label>
														</div>
													</div>

			                    <div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Nama Instansi </label>
														<div class="col-sm-9">
															<input type="text" name="nama_desa" class="col-xs-10 col-sm-5" placeholder="Nama instansi" value="<?= $data->nama_desa; ?>" />
														</div>
													</div>													

													<div align="center" class="clearfix form-actions">
														<a href="<?= site_url('staff/instansi'); ?>" class="btn btn-default">
															<i class="ace-icon fa fa-arrow-left"></i>
															Kembali
														</a>

														&nbsp; &nbsp;

														<button class="btn btn-danger" type="reset">
															<i class="ace-icon fa fa-undo bigger-110"></i>
															Bersihkan
														</button>

														&nbsp; &nbsp;

														<input class="btn btn-info" type="submit" name="submit" value="Ubah Data"></input>
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
      	//$('#input-mask-phone').inputmask('0899-9999-9{1,4}');
      	$('.select2').css('width','250px').select2({allowClear:false});

				/* Validasi */
       // $('#validasi').validate({
          //-- Aturan karakter input --//
         /* rules:
          {
            nama_pengguna  : {required: true, maxlength: 50},
						cp_pengguna		 : {required: true},
						status_pengguna: {required: true}
          },
*/
          //-- Pesan error --//
          /*messages:
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
          }*/
        //});
      });
    </script>

	</body>
</html>
