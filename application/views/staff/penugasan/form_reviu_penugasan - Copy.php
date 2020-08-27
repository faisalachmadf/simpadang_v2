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
								<a href="<?= site_url('staff/home'); ?>"> Home </a>
							</li>
							<li>
								<a href="<?= site_url('staff/penugasan'); ?>"> Penugasan </a>
							</li>
							<li>
								<a href="<?= site_url('staff/penugasan/detail_penugasan/'.base64_encode($data->id_tugas).'/'.base64_encode($data->id_tim)); ?>"> Detail Penugasan </a>
							</li>
							<li class="active"> Reviu Penugasan </li>
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">

						<div class="page-header">
							<h1>
								Reviu Penugasan
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Mereviu data penugasan pemeriksaan
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->

								<form id="validasi" class="form-horizontal" role="form" action="<?php site_url('staff/penugasan/reviu_penugasan/'. base64_encode($data->id_tugas) .'/'. base64_encode($data->id_tim)); ?>" method="post">
								<div class="row">
									<div class="col-md-12">

										<div class="widget-box">
											<div class="widget-header">
												<h4 class="widget-title">
													<i class="menu-icon fa fa-pencil-square-o"></i>
													Formulir Reviu Penugasan
												</h4>

												<div class="widget-toolbar">
													<a href="#" data-action="collapse">
														<i class="ace-icon fa fa-chevron-up"></i>
													</a>
												</div>
											</div>

											<div class="widget-body">
												<div class="widget-main">

													<!-- ID Penugasan -->
			                    <input type="hidden" name="id_penugasan" value="<?= $data->id_tugas; ?>">
			                    <!-- ID Tim -->
			                    <input type="hidden" name="id_tim" value="<?= $data->id_tim; ?>">
			                    
			                    <!-- NO REVIU KE -->
			                    <input type="hidden" name="no_rev" value="<?= $rev_ke; ?>">

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Tanggal Penugasan </label>
														<div class="col-sm-5">
															<label class="control-label"><?= $tgl_tugas; ?></label>
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Wakil Penanggung Jawab </label>
														<div class="col-sm-9">
															<select name="daltu" class="select2" data-placeholder="Pilih Wakil Penanggung Jawab">
																<option> &nbsp; </option>
																<?php
																	foreach($irban as $row)
																	{
																		echo "<option value='$row->id_pegawai'";
																		if($daltu->nama == $row->nama) { echo "selected"; }
																		echo "> $row->nama [$row->jabatan] </option>";
																	}
																?>
															</select>
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Pengendali Teknis </label>
														<div class="col-sm-9">
															<select name="dalnis" class="select2" data-placeholder="Pilih Pengendali Teknis">
																<option> &nbsp; </option>
																<?php
																	foreach($pegawai as $row)
																	{
																		echo "<option value='$row->id_pegawai'";
																		if($dalnis->nama == $row->nama) { echo "selected"; }
																		echo "> $row->nama </option>";
																	}
																?>
															</select>
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
																		echo "<option value='$row->id_pegawai'";
																		if($ketua_tim->nama == $row->nama) { echo "selected"; }
																		echo "> $row->nama </option>";
																	}
																?>
															</select>
														</div>
													</div>

													<input type="hidden" name="jml_agt" id="ke" value="<?= $jml_agt->jml+1; ?>" />

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
															<?php
																foreach($tim as $row)
																{
																	$keyAgt = $row->anggota;
															?>
																	<p id="t<?=$row->nomor;?>">
																		<select name="anggota[]" >
																			<option> -- Pilih Anggota -- </option>
																			<?php
																				foreach($pegawai as $rows)
																				{
																					echo "<option value='$rows->id_pegawai' ";
																					if($keyAgt == $rows->id_pegawai)
																					{	echo "selected=''"; }
																					echo "> $rows->nama </option>";
																				}
																			?>
																		</select>

																		<button type="button" class="btn btn-sm btn-danger" onclick="hapusElemenAgt('#t<?=$row->nomor; ?>'); return false;" title="Hapus anggota <?=$row->nomor; ?>"><i class="fa fa-minus"></i></button>
																	
																		<br/>
																	</p>
															<?php	} ?>

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
															<textarea name="nama_kp" rows="3" cols="74" placeholder="Nama kegiatan pengawasan"><?= $data->nama_kp; ?></textarea>
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Nama Objek Pengawasan </label>
														<div class="col-sm-9">
															<textarea name="nama_op" rows="3" cols="74" placeholder="Nama objek pengawasan"><?= $data->nama_op; ?></textarea>
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Alamat Kantor </label>
														<div class="col-sm-9">
															<textarea name="alamat_kantor" rows="3" cols="50" placeholder="Alamat kantor"><?= $data->alamat_kantor; ?></textarea>
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Nomor Telepon </label>
														<div class="col-sm-9">
															<input type="text" name="no_tlp" class="col-xs-10 col-sm-3" placeholder="Nomor telepon" value="<?= $data->no_tlp; ?>" />
														</div>
													</div>

													<hr/>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Program Pengawasan </label>
														<div class="col-sm-9">
															<input type="text" name="program_peng" class="col-xs-10 col-sm-8" placeholder="Program pengawasan" value="<?= $data->program_peng; ?>" />
														</div>
													</div>

													<input type="hidden" name="jml_ins" id="kee" value="<?= $jml_sas->jml+1; ?>" />
													<input type="hidden" name="kondisi_sasaran" id="kondisi-sasaran" />
													
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> </label>
														<div class="col-sm-9">
															<div class='alert alert-block alert-danger'>
																<p>
																	<strong>
																		<i class='ace-icon fa fa-exclamation-triangle'></i>
																		Penting!
																	</strong> <br/>
																	Jika hanya 1 (satu) sasaran pengawasan, maka tidak perlu memilih sasaran.<br/>
																	Cukup mengisi sasaran pengawasan pada form <strong>Sasaran Pengawasan</strong> berikut ini.
																</p>
															</div>
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Sasaran Pengawasan </label>
														<div class="col-sm-9">
															<input type="text" name="sasaran_peng" class="col-xs-10 col-sm-8" placeholder="Sasaran pengawasan" value="<?= $data->sasaran_peng; ?>" />

															&nbsp;

															<?php $keyKec = $data->instansi_kec; ?>

															<label class="control-label">
																<input type="checkbox" name="pilih_sasaran" id="pilih-sasaran" class="ace" <?php if($keyKec != "-") { echo "checked"; } ?> />
																<span class="lbl"> Pilih Sasaran</span>
															</label>
															<span class="help-button" title="Memilih instansi sebagai sasaran pengawasan.">?</span>
															<br/><br/>

															<div class="form-sasaran">
																<select name="kecamatan" class="select2" data-placeholder="Pilih Kecamatan" id="kecamatan">
																	<option> &nbsp; </option>
																	<?php																		
																		foreach($kecamatan as $rows)
																		{
																			echo "<option value='$rows->id_instansi' ";
																			if($keyKec == $rows->id_instansi)
																			{	echo "selected=''"; }
																			echo "> $rows->nama_kecamatan </option>";
																		}
																	?>
																</select> <br/><br/>
															</div> 

															<div id="tbh-sasaran">
															<button type="button" class="btn btn-xs btn-warning" onclick="tambahElemenIns(); return false;" title="Tambah sasaran">
																<i class="fa fa-plus"></i>
																Tambah Sasaran
															</button> <br/><br/>
															</div>
															
															<?php 
															$desa = $this->db->select('*')
																							  ->from('sub_instansi')
																							  ->where('sub_id_instansi', $keyKec)								  
																							  ->get()->result();
															?>

															<div class="form-sasaran">
																<?php
																	foreach($sasaran as $row)
																	{
																		$keyIns = $row->sasaran;
																?>
																		<p id="ss<?=$row->nomor;?>">
																			<select name="sasaran[]" class="desa">
																				<option> -- Pilih Desa -- </option>
																				<?php
																					foreach($desa as $rows)
																					{
																						echo "<option value='$rows->nama_desa' ";
																						if($keyIns == $rows->nama_desa)
																						{	echo "selected='selected'"; }
																						echo "> $rows->nama_desa </option>";
																					}
																				?>
																			</select>

																			<button type="button" class="btn btn-sm btn-danger" onclick="hapusElemenIns('#ss<?=$row->nomor; ?>'); return false;" title="Hapus instansi"><i class="fa fa-minus"></i></button>
																		
																			<br/>
																		</p>
																<?php	} ?>
															</div>

															<div id="form_ins" class="form-sasaran"></div>

															<div id="alert2">
																<i style="color:red">
																	<i class="fa fa-exclamation-triangle"></i> Batas Maks. 30 Instansi
																</i>
															</div>

														</div>
													</div>

													<div id="kec2">
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Kecamatan </label>
														<div class="col-sm-9">
															<select name="kecamatan2" class="select2" data-placeholder="Pilih Kecamatan">
																	<option> &nbsp; </option>
																	<?php																		
																		foreach($kecamatan as $rows)
																		{
																			echo "<option value='$rows->nama_kecamatan' ";
																			if($data->kecamatan == $rows->nama_kecamatan)
																			{	echo "selected=''"; }
																			echo "> $rows->nama_kecamatan </option>";
																		}
																	?>
																</select>
														</div>
													</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Tujuan Pengawasan </label>
														<div class="col-sm-9">
															<textarea name="tujuan_peng" rows="5" cols="74" placeholder="Tujuan pengawasan"><?= $data->tujuan_peng; ?></textarea>
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Laporan Dikirim Kepada </label>
														<div class="col-sm-9">
															<textarea name="tujuan_lap" rows="3" cols="50" placeholder="Penerima laporan pemeriksaan"><?= $data->tujuan_lap; ?></textarea>
														</div>
													</div>

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
															<label class="control-label"><?= date('d-m-Y', strtotime($data->tgl_surat)); ?></label>
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Nomor Surat </label>
														<div class="col-sm-5">
															<input type="text" name="no_surat" class="col-xs-12 col-sm-5" value="<?= $data->no_surat; ?>" readonly=''>
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Dasar Surat </label>
														<div class="col-sm-5">
															<textarea name="dasar_surat" rows="3" cols="60" placeholder="Dasar surat"><?= $data->dasar_surat; ?></textarea>
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Perihal </label>
														<div class="col-sm-8">
															<textarea name="perihal" id="ckeditor" class="ckeditor"><?= $data->untuk; ?></textarea>
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Waktu Pelaksanaan </label>
														<div class="col-sm-9">
															<div class='input-group date datepicker'>
																<span class='input-group-addon'><i class="ace-icon fa fa-calendar bigger-110"></i></span>
																<input type='text' name='tgl_awal' class='col-xs-8 col-sm-2' placeholder='Dari Tanggal' readonly='' value="<?= $data->tgl_awal; ?>" />
															</div>
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> </label>
														<div class="col-sm-9">
															<div class='input-group date datepicker'>
																<span class='input-group-addon'><i class="ace-icon fa fa-calendar bigger-110"></i></span>
																<input type='text' name='tgl_akhir' class='col-xs-8 col-sm-2' placeholder='Sampai Tanggal' readonly='' value="<?= $data->tgl_akhir; ?>" />
															</div>
														</div>
													</div>

													<input type="hidden" name="jml_tbs" id="ke3" value="<?= $jml_tbs->jml+1; ?>" />

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Tembusan </label>
														<div class="col-sm-9">
															<label class="control-label">
																<button type="button" class="btn btn-sm btn-warning" onclick="tambahElemenTbs(); return false;" title="Tambah tembusan">
																		<i class="fa fa-plus"></i>
																		Tambah Tembusan
																	</button>
															</label>
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> &nbsp; </label>
														<div class="col-sm-9">
															<label class="control-label">
															<?php
																foreach($tembusan as $row)
																{
																	echo "<p id='trow$row->nomor'><input type='text' name='tembusan[]' size='70' value='$row->tembusan' placeholder='Tembusan 1' />
																	<a href='#' onclick='hapusElemenTbs(\"#trow$row->nomor\"); return false;' class='btn btn-sm btn-danger' title='Hapus tembusan $row->nomor'> <i class='fa fa-minus'></i> </a></p> ";
																}
															?>

															<div id="form_tbs"></div>
															<div id="alert3"><i style="color:red"><i class="fa fa-exclamation-triangle"></i> Batas Maks. 10 Tembusan</i></div>
															</label>
														</div>
													</div>

													<div align="center" class="clearfix form-actions">
														<a href="<?= site_url('staff/penugasan/detail_penugasan/'.base64_encode($data->id_tugas).'/'.base64_encode($data->id_tim)); ?>" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>

														&nbsp;&nbsp;

														<button class="btn btn-danger" type="reset">
															<i class="ace-icon fa fa-refresh bigger-110"></i>
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
      		weekStart: 1,
					daysOfWeekDisabled: [0,6],
					language: 'id',
	        todayBtn: 1,
					autoclose: 1,
					todayHighlight: 1,
					startView: 2,
					minView: 2,
					forceParse: 0,
					startDate: tgl
			  });

				$('#input-mask-phone').inputmask('0299-9{1,4}-9{1,4}');
      	$('.select2').css('width','310px').select2({allowClear:false});

      	//dalnis
      	/*$('#form-dalnis').hide();
				if($('#not-null').is(':checked'))
				{	$('#form-dalnis').show();	}
				else
				{	$('#form-dalnis').hide();	}

				$('.dalnis').click(function(){
					if($(this).val() == "ya")
					{	$('#form-dalnis').slideDown('fast'); }
					else
					{	$('#form-dalnis').slideUp('fast'); }
				});*/

				//kondisi jumlah lampiran ada atau tidak
				//--> form lampiran ketika load awal
				if(document.getElementById('pilih-sasaran').checked)
				{
					$('#kec2').hide();
					$("#tbh-sasaran").show();
					$(".form-sasaran").show();
					document.getElementById("kondisi-sasaran").value = "pilih";
				}
				else
				{
					$('#kec2').show();
					$("#tbh-sasaran").hide();
					$(".form-sasaran").hide();
					document.getElementById("kondisi-sasaran").value = "input";
				}

				//--> kondisi sasaran
				$('#pilih-sasaran').on('change', function() {
					if(this.checked) {
						$('#kec2').slideUp();
						$('#tbh-sasaran').slideDown();
						$('.form-sasaran').slideDown();
						document.getElementById("kondisi-sasaran").value = "pilih";
					}
					else {
						$('#kec2').slideDown();
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
					stre = "<p id='arow" + ke + "'>" +
								 "	<select name='anggota[]' class='select2' data-placeholder='Pilih Pengendali Teknis'>" +
								 "		<option> -- Pilih Anggota Ke-"+ ke +" -- </option> <?php
												foreach($pegawai as $row)
												{
													echo "<option value='$row->id_pegawai'> $row->nama </option>";
												}
											?>" +
								 "	</select>" +
								 "  <a href='#' onclick='hapusElemenAgt(\"#arow" + ke + "\"); return false;' class='btn btn-sm btn-danger' title='Hapus anggota ke-"+ ke +"'> <i class='fa fa-minus'></i> </a>" +
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
					stre = "<p id='irow" + kee + "'>" +
								 "	<select name='sasaran[]' class='desa'>" +
								 "		<option> -- Pilih Desa -- </option> <?php
												foreach($instansi as $row)
												{
													echo "<option value='$row->nama_instansi'> $row->nama_instansi  </option>";
												}
											?>" +
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
					stre = "<p id='trow" + ke3 + "'> <input type='text' size='70' name='tembusan[]' placeholder='Tembusan "+ ke3 +"' /> <a href='#' onclick='hapusElemenTbs(\"#trow" + ke3 + "\"); return false;' class='btn btn-sm btn-danger' title='Hapus tembusan "+ ke3 +"'> <i class='fa fa-minus'></i> </a> </p>";
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
	          url  : "<?= site_url('staff/penugasan/get_desa'); ?>",
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
