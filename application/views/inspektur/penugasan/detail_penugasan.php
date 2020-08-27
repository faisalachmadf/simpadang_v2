<?php
//--> include data header
$this->load->view('layout/header');  ?>

<style type="text/css">
	#signArea{
		width:304px;
		margin: 20px auto;
	}
	.sign-container {
		width: 60%;
		margin: auto;
	}
	.sign-preview {
		width: 150px;
		height: 50px;
		border: solid 1px #CFCFCF;
		margin: 10px 5px;
	}
	.tag-ingo {
		font-size: 12px;
		text-align: left;
		font-style: oblique;
	}

	.tag-manual {
		text-align: left;
	}
</style>

<?php
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
								<a href="<?= site_url('inspektur/home'); ?>"> Home </a>
							</li>
							<li>
								<a href="<?= site_url('inspektur/penugasan'); ?>"> Penugasan </a>
							</li>
							<li class="active"> Detail Penugasan </li>
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">

						<div class="page-header">
							<h1>
								Detail Penugasan
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Melihat rincian data tugas yang diberikan kepada tim audit
								</small>
							</h1>
						</div><!-- /.page-header -->

						<!-- notifikasi -->
						<div><?= $this->session->flashdata("sukses"); ?></div>

						<div class="row">
							<div class="col-xs-12">
							<!-- PAGE CONTENT BEGINS -->

								<div class="widget-box">
									<div class="widget-body">
										<div class="widget-main">

											<div class="row">

												<div class="col-sm-6">
													<h3 class="header">
														<i class="fa fa-file-text"></i> Data Tugas
													</h3>

													<dl id="dt-list-1" class="dl-horizontal">
														<dt> Tanggal Penugasan : </dt>
															<dd><?= $tgl_tugas; ?></dd>

														<dt> Kegiatan Pengawasan : </dt>
															<dd align="justify"><?= $data->nama_kp; ?></dd>

														<br/>

														<dt> Objek Pengawasan : </dt>
															<dd align="justify"><?= $data->nama_op; ?></dd>

														<dt> Alamat Kantor : </dt>
															<dd align="justify"><?= $data->alamat_kantor; ?></dd>

														<dt> Nomor Telepon : </dt>
															<dd><?= $data->no_tlp; ?></dd>

														<br/>

														<dt> Program Pengawasan : </dt>
															<dd align="justify"><?= $data->program_peng; ?></dd>

														<dt> Sasaran Pengawasan : </dt>
															<dd align="justify"><?= $data->sasaran_peng; ?></dd>

														<dt> Tujuan Pengawasan : </dt>
															<dd align="justify"><?= $data->tujuan_peng; ?></dd>

														<br/>

														<dt> Nomor Surat Tugas : </dt>
															<dd><?= $data->no_st; ?></dd>

														<dt> Tangal Surat Tugas : </dt>
															<dd><?= $tgl_surat; ?></dd>

														<dt> Direncanakan Mulai Tgl : </dt>
															<dd><?= $tgl_awal; ?></dd>

														<dt> Direncanakan Selesai Tgl : </dt>
															<dd><?= $tgl_akhir; ?></dd>

														<dt>Realisasi Tgl Pelaksanaan : </dt>
															<dd><?= $tgl_awal ." s/d ". $tgl_akhir; ?></dd>

														<br/>

														<dt>Dasar Surat : </dt>
															<dd align='justify'><?= $data->dasar_surat; ?></dd>

														<br/>

														<dt> Sasaran : </dt>
														<?php
															foreach($sasaran as $row)
															{
																if($row->sasaran != NULL)
																{ echo "<dd>$row->nomor. $row->sasaran</dd>"; }
															}
														?>

														<br/>

														<dt> Tembusan Surat : </dt>
														<?php
															foreach($tembusan as $row)
															{
																echo "<dd>$row->nomor. $row->tembusan</dd>";
															}
														?>
													</dl>
												</div>

												<div class="col-sm-6">
													<h3 class="header">
														<i class="fa fa-users"></i> Tim Pemeriksa
													</h3>

													<dl id="dt-list-1" class="dl-horizontal">
														<dt> Wakil Penanggung Jawab : </dt>
															<dd><?= $daltu->nama ." | ". $daltu->jabatan; ?></dd>

														<?php if($data->dalnis != NULL){ ?>
														<dt> Pengendali Teknis : </dt>
															<dd><?= $dalnis->nama; ?></dd>
															<br/>
														<?php } ?>

														<dt> Ketua Tim : </dt>
															<dd><?= $ketua_tim->nama; ?></dd>

														<dt> Anggota : </dt>
														<?php
															foreach($tim as $row)
															{
																if($row->anggota != NULL)
																{ echo "<dd>$row->nomor. $row->nama</dd>"; }
															}
														?>
													</dl>

													<h3 class="header">
														<i class="fa fa-bars"></i> Penandatanganan Surat Tugas 
													</h3>
													
													<input type="hidden" id="id_tgs" value="<?= $data->id_tugas; ?>">

													<?php if($data->tgl_persetujuan == NULL){ ?>
													<div id="signArea" >
														<label class="tag-manual">
															<input type="checkbox" name="verifyManual" value="off" class="ace manual-verify" />
															<span class="lbl"> &nbsp; Verifikasi Manual </span>
														</label>

														<center id="verifyManual">
															<a href="<?= site_url('inspektur/penugasan'); ?>" class="btn btn-sm btn-default"><i class="fa fa-arrow-left"></i> Kembali </a>
															&nbsp;
															<a href="<?= site_url('inspektur/penugasan/verifikasi_manual/'. base64_encode($data->id_tugas). '/'.base64_encode($data->id_tim)); ?>" class="btn btn-sm btn-primary" title="Verifikasi surat">
																<i class="fa fa-check-square-o"></i> Verifikasi
															</a>
														</center>

														<div id="form-signature">
															<h2 class="tag-ingo">Verifikasi Digital,</h2>
															<div class="sig sigWrapper" style="height:auto;">
																<div class="typed"></div>
																<canvas class="sign-pad pad" id="sign-pad" width="300" height="150"></canvas>
															</div> <br/>

															<center>
																<a href="<?= site_url('inspektur/penugasan'); ?>" class="btn btn-sm btn-default"><i class="fa fa-arrow-left"></i> Kembali </a>
																&nbsp;
																<a href="#clear" class="clearButton btn btn-sm btn-danger" title="Reset tanda tangan">
																	<i class="fa fa-undo"></i> Hapus
																</a>
																&nbsp;
																<button id="btnSaveSign" class="btn btn-sm btn-primary" title="Verifikasi surat">
																	<i class="fa fa-check-square-o"></i> Verifikasi
																</button>
															</center>

														</div>
													</div>
													<?php } else { ?>

													<center>
														<div class="alert alert-block alert-success">
															<p>
																<i class='ace-icon fa fa-check'></i> Surat tugas telah di verifikasi.
															</p>
														</div>

														<a href="<?= site_url('inspektur/penugasan'); ?>" class="btn btn-sm btn-default"><i class="fa fa-arrow-left"></i> Kembali </a>
													</center>
													<?php } ?>

												</div>
											</div>

										</div>
									</div>
								</div>

							<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->

					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

<!-- include data footer -->
<?php $this->load->view('layout/footer'); ?>

		<script type="text/javascript">

			//kondisi jenis verifikasi manual atau digital
			$('#verifyManual').hide();
			$('.manual-verify').click(function(){
				if($(this).val() == "off")
				{
					$('#form-signature').slideUp('fast');
					$('.manual-verify').val("on");
					$('#verifyManual').slideDown('fast');
				}
				else
				{
					$('#form-signature').slideDown('fast');
					$('.manual-verify').val("off");
					$('#verifyManual').slideUp('fast');
				}
			});

			$(document).ready(function() {
				$('#signArea').signaturePad({drawOnly:true, drawBezierCurves:true, lineTop:155});
			});

			$("#btnSaveSign").click(function(e){
				html2canvas([document.getElementById('sign-pad')], {
					onrendered: function (canvas) {
						var canvas_img_data = canvas.toDataURL('image/png');
						var img_data = canvas_img_data.replace(/^data:image\/(png|jpg);base64,/, "");
						//ajax call to save image inside folder
						var id_tgs = $('#id_tgs').val();
						$.ajax({
							url: '<?= site_url('inspektur/penugasan/verifikasi_digital'); ?>',
							data: {id_tgs:id_tgs, img_data:img_data},
							type: 'post',
							//dataType: 'json',
							success: function (response) {
							   window.location.reload();
							}
						});
					}
				});
			});
		</script>

	</body>
</html>