<?php
error_reporting(E_ALL ^ (E_WARNING | E_NOTICE));
//--> include data header
$this->load->view('layout/header');
?>

<style type="text/css">
	.u {text-decoration: underline}
	.b {font-weight: bold}
	.i {font-style: italic}
	.c {text-align: center}
	.r {text-align: right}
	.j {text-align: justify}

	.bor-top {border-top: 1px solid #000}
	.pos-atas {vertical-align: top}

	.pad-3 {padding: 5px}
	.pad-10 {padding: 10px}
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
					<a href="<?= site_url('ketua_tl/home'); ?>"> Home </a>
				</li>
				<li>
					<a href="<?= site_url('ketua_tl/tindak_lanjut'); ?>"> Tindak Lanjut </a>
				</li>
				<li>
					<a href="<?= site_url('ketua_tl/tindak_lanjut/detail_tl/' . base64_encode($data->id_tl) . '/' . base64_encode($data->id_tim)); ?>"> Detail Tindak Lanjut </a>
				</li>
				<li class="active"> Tambah Tindak Lanjut </li>
			</ul><!-- /.breadcrumb -->
		</div>
		<div class="page-content">
			<div class="page-header">
				<h1>Tambah Temuan
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						Menambahkan data
					</small>
				</h1>
			</div><!-- /.page-header -->

			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->
					<form id="validasi" class="form-horizontal" role="form" action="<?php echo site_url('ketua_tl/tindak_lanjut/submit_tl/') ?>" method="post">
						<div class="row">
							<input type="hidden" name="id_temuan" value="<?= $temuan->id_temuan; ?>">
							<div class="col-md-12">

								<div class="widget-box">
									<div class="widget-header">
										<h4 class="widget-title">
											<i class="menu-icon fa fa-pencil-square-o"></i>
											Formulir Tambah Temuan
										</h4>

										<div class="widget-toolbar">
											<a href="#" data-action="collapse">
												<i class="ace-icon fa fa-chevron-up"></i>
											</a>
										</div>
									</div>

									<div class="widget-body" style="display: block; overflow: hidden;">
										<div class="widget-main">

											<div class="form-group">
												<label class="col-sm-3 control-label no-padding-right"></label>
												<div class="col-sm-5">
													<h4 class="header center"> Masukan Data Temuan </h4>
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-3 control-label no-padding-right"> Objek Pengawasan </label>
												<div class="col-sm-5">
													<input type="text" class="form-control" class="col-xs-12 col-sm-5" value="<?= $temuan->instansi; ?>" readonly>
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-3 control-label no-padding-right"> No LHP </label>
												<div class="col-sm-5">
													<input type="text" class="form-control" class="col-xs-12 col-sm-5" value="<?= $temuan->no_lhp; ?>" readonly>
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-3 control-label no-padding-right"> Upload File LHP </label>
												<div class="col-sm-5">
													<a target="_blank" href="<?= site_url('../assets/lhp/mnl/'.$temuan->file_lhp.''); ?>" class="btn btn-sm btn-success" title="Download file LHP"><i class="fa fa-download"></i> File LHP </a>
												</div>
											</div>


											<div class="form-group">
												<label class="col-sm-3 control-label no-padding-right"> Tanggal LHP </label>
												<div class="col-sm-9">
													<div class='input-group date datepicker2'>
														<span class='input-group-addon'><i class="ace-icon fa fa-calendar bigger-110"></i></span>
														<input type='text' class='col-xs-8 col-sm-2' value="<?php echo date('Y-m-d')?>" placeholder='Tanggal' />
													</div>
												</div>
											</div>


										</div>
										<hr>

										<?php $no_spi = 1;
										foreach ($aspek as $spi)
											{?>



												<div class="col-md-12 list list-temuan-1" style="border: 1px solid #cdd8e3;min-height: 250px;padding: 10px;margin-top: 10px;margin-bottom:10px;">
													<center><span>TEMUAN <span class="no"><?php echo $no_spi ?></span></span></center>
													<hr>
													<div class="col-md-12 no-padding">

														<div class="col-md-3 no-padding-left">
															

															<select  class="form-control">
																<option value="spi" <?php ($spi->aspek==='spi')?'selected':'' ?>>Sistem Pengendalian Internal (SPI)</option>
																<option value="e3" <?php ($spi->aspek==='e3')?'selected':'' ?>>Efektif, Efisien, Ekonomis(EEE)</option>
																<option value="kepatuhan" <?php ($spi->aspek==='kepatuhan')?'selected':'' ?>>Kepatuhan</option>
															</select>
														</div>                                                    
														<div class="col-md-3 no-padding-left">
															<div class="input-group">
																<span class="input-group-addon">
																	NIP
																</span>
																<input type="text" readonly class="form-control" value="<?php echo $spi->nip ?>" required placeholder="Masukkan NIP">
															</div>
														</div>
														<div class="col-md-3">
															<div class="input-group">
																<span class="input-group-addon">
																	<i class="ace-icon fa fa-user"></i>
																</span>
																<input type="text" readonly value="<?php echo $spi->nm_pejabat ?>" required class="form-control" placeholder="Masukkan Nama">
															</div>
														</div>

														<div class="col-md-3"><span style="margin: 12px;display: block;width: 100%;">&nbsp;</span></div>

													</div>

													<div class="col-md-12" style="border:1px solid #cdd8e3;min-height: 170px;padding: 10px">  
														<div id="temuan" style="min-height:60px;border-bottom: 1px solid #080808"> 
															<div class="col-md-6 no-padding">
																<textarea style="" class="form-control autosize-transition " readonly placeholder="Uraian"><?php echo $spi->judul;?></textarea>
															</div>
															<div class="col-md-2">
																<div class="input-group">
																	<span class="input-group-addon">
																		<i class="ace-icon fa fa-user"></i>
																	</span>
																	<input type="text" readonly value="<?php echo $spi->kode_temuan ?>" required class="form-control" placeholder="Masukkan Nama">
																</div>
															</div>
															<div class="col-md-4 no-padding-right">
																<div class="input-group">
																	<span class="input-group-addon">
																		<i class="ace-icon fa fa-money"></i>
																	</span>
																	<input class="form-control" type="text" readonly value="<?php echo $spi->nilai ?>" placeholder="Nilai Uang">
																</div>
															</div>
														</div>
					<?php 
					$i = 1;
					foreach ($temuan_rekomendasi as $rek_spi)
					{?>
						<?php if($spi->id_temuan_aspek == $rek_spi->id_temuan_aspek)
						{ ?>
						<div class=" col-md-12 list-rekomendasi" style="min-height:72px; padding-top: 10px; border-bottom: 1px solid #cdd8e3">
							<div class="form-group">
								<label class="col-md-2 control-label no-padding-right no-padding-left" for="rk-1"> Rekomendasi <span class='no_rekom'><?php echo $no_spi ?>.<?php echo $i ?> </span> :</label>
								<div class="col-md-10 no-padding-right">
									<div class="col-md-6">
										<textarea placeholder="Rekomendasi" class="rekom autosize-transition form-control" readonly><?php echo $rek_spi->uraian?></textarea>            
									</div>
									<div class="col-md-2 no-padding-left">  
										<div class="input-group">
											<span class="input-group-addon">
												<i class="ace-icon fa fa-money"></i>
											</span>
											<input readonly class="form-control" type="text" readonly value="<?php echo $rek_spi->kode_rekomendasi ?>" placeholder="Kode rekomendasi">
										</div>
									</div>
									<div class="col-md-4 no-padding">
										<div class="input-group">
											<span class="input-group-addon">
												<i class="ace-icon fa fa-money"></i>
											</span>
											<input readonly class="form-control" readonly type="text"  value="<?php echo $rek_spi->nilai ?>" placeholder="Nilai Uang">
										</div>
									</div>
								</div>

							</div>
							<div class="form-group">
								<label class="col-md-2 control-label no-padding-right no-padding-left" for="rk-1"> Tindak Lanjut Entitas yang Diperiksa <span class='no_rekom'><?php echo $no_spi ?>.<?php echo $i ?></span> :</label>
								<div class="col-md-10 no-padding-right ">
									<div class="col-sm-12 no-padding-right ">
										<input type="hidden" name="id_temuan_rekomendasi[]" value="<?php echo $rek_spi->id_temuan_rekomendasi ?>">
										<textarea name="uraian_tindak_lanjut[]" placeholder="Tindak Lanjut" class="autosize-transition rekom form-control"><?php echo $rek_spi->uraian_tindak_lanjut ?></textarea>
									</div>
								</div>
								
							</div>

						</div>
					
					<?php  } ?> 

					<?php 
					$i++;
				} ?>  
														</div>

													</div>


												<?php
												$no_spi++;
												 }?>
												
												<div class="text-right">
													<button class="btn btn-sm btn-success no-radius" name="submit" value="Simpan" type="submit">
														<i class="ace-icon fa fa-save"></i>
														Submit
													</button>
												</div>
											</div><!-- /.widget-main -->


										</div>

									</div>
								</div><!-- /.page-content -->
							</div>
						</form>
					</div>
				</div><!-- /.main-content -->

				<input type="hidden" id="tgl" value="<?= date('Y-m-d H:i'); ?>" />

				<!-- include data footer -->
				<?php $this->load->view('layout/footer'); ?>

				<script type="text/javascript">
					$(document).ready(function ()
					{
						var tgl = document.getElementById("tgl").value;

						$('.datepicker2').datetimepicker({
							weekStart: 1,
							daysOfWeekDisabled: [0, 6],
							language: 'id',
							todayBtn: 1,
							autoclose: 1,
							todayHighlight: 1,
							startView: 2,
							minView: 2,
							forceParse: 0
						});

					});
					
				</script>
</body>
</html>
