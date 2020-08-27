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
								<a href="<?= site_url('adum/home'); ?>">Home</a>
							</li>
							<li>
								<a href="<?= site_url('adum/data_pegawai'); ?>"> Data Pegawai </a>
							</li>
							<li class="active"> Ubah Pegawai </li>
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">

						<div class="page-header">
							<h1>
								Ubah Pegawai
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Mengubah data pegawai
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->

								<form id="validasi" class="form-horizontal" role="form" action="<?= site_url('adum/data_pegawai/ubah_pegawai/'. base64_encode($data->id_pegawai)); ?>" method="post">
								<div class="row">
									<div class="col-md-12">

										<div class="widget-box">
											<div class="widget-header">
												<h4 class="widget-title">
													<i class="menu-icon fa fa-pencil-square-o"></i>
													Formulir Ubah Pegawai
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
															<input type="text" name="nip" class="col-xs-10 col-sm-3" placeholder="Nomor Induk Pegawai" value="<?= $data->nip; ?>" />
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Nama Lengkap </label>
														<div class="col-sm-9">
															<input type="text" name="nama" class="col-xs-10 col-sm-7" placeholder="Nama Lengkap" value="<?= $data->nama; ?>" />
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
																<option value="-"> - Pilih Gol - </option>
																<?php 
																	foreach ($gol as $row) 
																	{
																		echo "<option value='$row->nama_gol'";
																		if($data->golongan == $row->nama_gol)
																		{	echo "selected"; }
																		echo "> $row->nama_gol </option>";
																	}
																?>
															</select>
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Jabatan </label>
														<div class="col-sm-9">
															<input type="text" name="jabatan" class="col-xs-10 col-sm-3" placeholder="Jabatan" value="<?= $data->jabatan; ?>" />
														</div>
													</div>

													<?php //$jbtn = $data->jabatan; ?>
													<!-- <div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Jabatan </label>
														<div class="col-sm-9">
															<select name="jabatan" id="jabatan" class="select2" data-placeholder="Pilih Jabatan">
																<option> &nbsp; </option>
																<option value="Inspektur Pembantu Bidang Ekonomi & Pembangunan" <?php if($jbtn == "Inspektur Pembantu Bidang Ekonomi & Pembangunan"){ echo "selected"; } ?>> Inspektur Pembantu Bidang Ekonomi & Pembangunan </option>
																<option value="Inspektur Pembantu Bidang Keuangan & Pendayagunaan Aparatur" <?php if($jbtn == "Inspektur Pembantu Bidang Keuangan & Pendayagunaan Aparatur"){ echo "selected"; } ?>> Inspektur Pembantu Bidang Keuangan & Pendayagunaan Aparatur </option>
																<option value="Inspektur Pembantu Bidang Kesejahteraan Rakyat" <?php if($jbtn == "Inspektur Pembantu Bidang Kesejahteraan Rakyat"){ echo "selected"; } ?>> Inspektur Pembantu Bidang Kesejahteraan Rakyat </option>
																<option value="Inspektur Pembantu Bidang Pemerintahan" <?php if($jbtn == "Inspektur Pembantu Bidang Pemerintahan"){ echo "selected"; } ?>> Inspektur Pembantu Bidang Pemerintahan </option>
																<option value="Fungsional Umum" <?php if($jbtn == "Fungsional Umum"){ echo "selected"; } ?>> Fungsional Umum </option>
																<option value="Fungsional Perencanaan Madya" <?php if($jbtn == "Fungsional Perencanaan Madya"){ echo "selected"; } ?>> Fungsional Perencanaan Madya </option>
																<option value="Kasubag Evaluasi dan Pelaporan" <?php if($jbtn == "Kasubag Evaluasi dan Pelaporan"){ echo "selected"; } ?>> Kasubag Evaluasi dan Pelaporan </option>
																<option value="Kasubag Perencanaan" <?php if($jbtn == "Kasubag Perencanaan"){ echo "selected"; } ?>> Kasubag Perencanaan </option>
																<option value="Kasubag Kasubag Administrasi dan umum" <?php if($jbtn == "Kasubag Kasubag Administrasi dan umum"){ echo "selected"; } ?>> Kasubag Administrasi dan umum </option>
																<option value="P2UPD Madya" <?php if($jbtn == "P2UPD Madya"){ echo "selected"; } ?>> P2UPD Madya </option>
																<option value="P2UPD Pertama" <?php if($jbtn == "P2UPD Pertama"){ echo "selected"; } ?>> P2UPD Pertama </option>
																<option value="P2UPD Muda" <?php if($jbtn == "P2UPD Muda"){ echo "selected"; } ?>> P2UPD Muda </option>
																<option value="Auditor Madya" <?php if($jbtn == "Auditor Madya"){ echo "selected"; } ?>> Auditor Madya </option>
																<option value="Auditor Pertama" <?php if($jbtn == "Auditor Pertama"){ echo "selected"; } ?>> Auditor Pertama </option>
																<option value="Auditor Muda" <?php if($jbtn == "Auditor Muda"){ echo "selected"; } ?>> Auditor Muda </option>
																<option value="Auditor Penyelia" <?php if($jbtn == "Auditor Penyelia"){ echo "selected"; } ?>> Auditor Penyelia </option>
																<option value="Auditor Pelaksana Lanjutan" <?php if($jbtn == "Auditor Pelaksana Lanjutan"){ echo "selected"; } ?>> Auditor Pelaksana Lanjutan </option>
																<option value="Perencana Madya" <?php if($jbtn == "Perencana Madya"){ echo "selected"; } ?>> Perencana Madya </option>
																<option value="Perencana Muda" <?php if($jbtn == "Perencana Muda"){ echo "selected"; } ?>> Perencana Muda </option>
																<option value="Audiwan Pertama" <?php if($jbtn == "Audiwan Pertama"){ echo "selected"; } ?>> Audiwan Pertama </option>
																<option value="Audiwan Muda" <?php if($jbtn == "Audiwan Muda"){ echo "selected"; } ?>> Audiwan Muda </option>
																<option value="TKS" <?php if($jbtn == "TKS"){ echo "selected"; } ?>> TKS </option>
															</select>
														</div>
													</div> -->

													<?php $jbtn_tim = $data->jabatan_tim; ?>
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right" for="form-field-tags"> Jabatan Tim </label>
														<div class="col-sm-9">
															<div class="radio">
																<label>
																	<input type="radio" name="jabatan_tim" class="ace" value="Pengendali Teknis" <?php if($jbtn_tim == "Pengendali Teknis"){ echo "checked"; } ?> />
																	<span class="lbl"> Pengendali Teknis </span>
																</label>
															</div>

															<div class="radio">
																<label>
																	<input type="radio" name="jabatan_tim" class="ace" value="Ketua Tim" <?php if($jbtn_tim == "Ketua Tim"){ echo "checked"; } ?> />
																	<span class="lbl"> Ketua Tim </span>
																</label>
															</div>															

															<div class="radio">
																<label>
																	<input type="radio" name="jabatan_tim" class="ace" value="Anggota Tim" <?php if($jbtn_tim == "Anggota Tim"){ echo "checked"; } ?> />
																	<span class="lbl"> Anggota Tim </span>
																</label>
															</div>
														</div>
													</div>

													<div align="center" class="clearfix form-actions">
														<a href="<?= site_url('adum/data_pegawai'); ?>" class="btn btn-default">
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
