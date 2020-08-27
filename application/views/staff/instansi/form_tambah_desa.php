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
								<a href="<?= site_url('staff/instansi'); ?>">Instansi</a>
							</li>
							<li class="active"> Tambah Instansi </li>
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">

						<div class="page-header">
							<h1>
								Tambah Instansi
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Menambahkan data instansi baru
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->

								<form id="validasi" class="form-horizontal" role="form" action="<?php site_url('staff/instansi/tambah_desa'); ?>" method="post">
								<div class="row">
									<div class="col-md-12">

										<div class="widget-box">
											<div class="widget-header">
												<h4 class="widget-title">
													<i class="menu-icon fa fa-pencil-square-o"></i>
													Formulir Tambah Instansi
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
														<label class="col-sm-3 control-label no-padding-right"> Kecamatan </label>
														<div class="col-sm-9">
															<select name="kecamatan" class="select2" data-placeholder="Pilih Kecamatan">
																<option> &nbsp; </option>
																<?php
																	foreach($kecamatan as $row)
																	{
																		echo "<option value='$row->id_instansi'> $row->nama_kecamatan </option>";
																	}
																?>
															</select>
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right" for="form-field-tags"> Nama Instansi </label>
														<div class="col-sm-9">
															
															<input type="hidden" name="jml_desa" id="des" value="2" />

															<button type="button" class="btn btn-xs btn-warning" onclick="tambahElemenDesa(); return false;" title="Tambah instansi">
																<i class="fa fa-plus"></i>
																Tambah Instansi
															</button>															

														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> &nbsp; </label>
														<div class="col-sm-9">
															<input type="text" name="nama_desa[]" class="col-xs-10 col-sm-5" placeholder="Nama Instansi" /> <br/><br/>

															<div id="form_desa"></div>
														</div>
													</div>													
													
													<div align="center" class="clearfix form-actions">
														<a href="<?= site_url('staff/instansi'); ?>" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>

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
      	//$('#input-mask-phone').inputmask('0899-9999-9{1,4}');
      	$('.select2').css('width','250px').select2({allowClear:false});

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

     	// DESA
			function tambahElemenDesa()
			{
			  var des = document.getElementById("des").value;

		  	var stre;
				stre = "<p id='trow" + des + "'> <input type='text' size='43' name='nama_desa[]' placeholder='Nama Instansi' /> <a href='#' onclick='hapusElemenDesa(\"#trow" + des + "\"); return false;' class='btn btn-sm btn-danger' title='Hapus instansi'> <i class='fa fa-minus'></i> </a> </p>";
		  	$("#form_desa").append(stre);
		  	des = (des-1) + 2;
		  	document.getElementById("des").value = des;
			}

			function hapusElemenDesa(des)
			{
			  $(des).remove();

			  var des1 = document.getElementById("des").value;
			  des2 = des1-1;
			  document.getElementById("des").value = des2;
			}
			//.DESA
    </script>

	</body>
</html>
