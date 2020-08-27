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
								<a href="<?= site_url('inspektur/tindak_lanjut'); ?>"> Tindak Lanjut </a>
							</li>
							<li class="active"> Detail Tindak Lanjut </li>
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">

						<div class="page-header">
							<h1>
								Detail Tindak Lanjut
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Melihat rincian data tugas yang diberikan kepada tim tindak lanjut
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
														<i class="fa fa-file-text"></i> Data Tindak Lanjut
													</h3>

													<dl id="dt-list-1" class="dl-horizontal">
														<dt> Tanggal : </dt>
															<dd><?= $tgl_tl; ?></dd>

														<dt> Objek Pengawasan : </dt>
															<dd align="justify"><?= $data->sasaran_peng; ?></dd>

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
													</dl>
												</div>

												<div class="col-sm-6">
													<h3 class="header">
														<i class="fa fa-users"></i> Tim Tindak Lanjut
													</h3>

													<dl id="dt-list-1" class="dl-horizontal">
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
														<i class="fa fa-bars"></i> Penandatanganan Surat Tugas Tindak Lanjut
													</h3>
													
													<input type="hidden" id="id_tl" value="<?= $data->id_tl; ?>">

													<?php if($data->tgl_persetujuan == NULL){ ?>
													<div id="signArea" >
														<label class="tag-manual">
															<input type="checkbox" name="verifyManual" value="off" class="ace manual-verify" />
															<span class="lbl"> &nbsp; Verifikasi Manual </span>
														</label>

														<center id="verifyManual">
															<a href="<?= site_url('inspektur/tindak_lanjut'); ?>" class="btn btn-sm btn-default"><i class="fa fa-arrow-left"></i> Kembali </a> <a href="<?= site_url('inspektur/temuan/detail_temuan/'.$data->id_temuan.''); ?>" class="btn btn-sm btn-primary"> Detail Temuan </a>
															&nbsp;
															<br><br>
															<a href="<?= site_url('inspektur/tindak_lanjut/verifikasi_manual/'. base64_encode($data->id_tl). '/'.base64_encode($data->id_tim)); ?>" class="btn btn-sm btn-primary" title="Verifikasi surat">
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
																<a href="<?= site_url('inspektur/tindak_lanjut'); ?>" class="btn btn-sm btn-default"><i class="fa fa-arrow-left"></i> Kembali </a> <a href="<?= site_url('inspektur/temuan/detail_temuan/'.$data->id_temuan.''); ?>" class="btn btn-sm btn-primary"> Detail Temuan </a>
																<br><br>
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

														<a href="<?= site_url('inspektur/tindak_lanjut'); ?>" class="btn btn-sm btn-default"><i class="fa fa-arrow-left"></i> Kembali </a> <a href="<?= site_url('inspektur/temuan/detail_temuan/'.$data->id_temuan.''); ?>" class="btn btn-sm btn-primary"> Detail Temuan </a>
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
						var id_tl = $('#id_tl').val();
						$.ajax({
							url: '<?= site_url('inspektur/tindak_lanjut/verifikasi_digital'); ?>',
							data: {id_tl:id_tl, img_data:img_data},
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