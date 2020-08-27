<?php
//--> include data header
$this->load->view('layout/header'); ?>

<style type="text/css">
	.u {text-decoration: underline}
	.b {font-weight: bold}
	.i {font-style: italic}
	.c {text-align: center}
	.r {text-align: right;}
	.j {text-align: justify}

	.pad-3 {padding: 5px}
	.bot-bor {border-bottom: 1px black solid}

	.bg-color  {background-color: #f1f6a3}
	.bg-color5 {background-color: #1faeff}

	td {padding: 5px}
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
								<a href="<?= site_url('daltu/home'); ?>"> Home </a>
							</li>
							<li>
								<a href="<?= site_url('daltu/p2hp_lhp'); ?>"> P2HP & LHP </a>
							</li>
							<li class="active"> Detail P2HP & LHP </li>
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">

						<div class="page-header">
							<h1>
								Detail P2HP & LHP
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Melihat rincian data pokok-pokok hasil pemeriksaan dan laporan hasil pemeriksaan
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
														<i class="fa fa-file-text"></i> Data Pemeriksaan
													</h3>

													<dl id="dt-list-1" class="dl-horizontal">
														<dt> Nama Objek Audit : </dt>
															<dd align="justify"><?= $data->nama_op; ?></dd>

														<dt> Masa yang diperiksa : </dt>
															<dd align="justify"><?= $data->masa_periksa; ?></dd>

														<dt> Waktu Pemeriksaan : </dt>
															<dd align="justify"><?= $tgl_awal ." s.d. ". $tgl_akhir; ?></dd>

															<br/>

														<dt> Sasaran : </dt>
															<dd align="justify"><?= strtoupper($p2hp->nm_instansi) ." KECAMATAN ". strtoupper($p2hp->nm_kec); ?></dd>

													</dl>
												</div>

												<div class="col-sm-6">
													<h3 class="header">
														<i class="fa fa-bars"></i> Aksi Pilihan
													</h3>

													<center>
														<a href="<?= site_url('daltu/p2hp_lhp'); ?>" class="btn btn-sm btn-default"><i class="fa fa-arrow-left"></i> Kembali </a>
													</center>

												</div>
											</div>

											<div class="hr hr-double dotted"></div>

											<div class="row">

												<form class='form-horizontal' role='form' action="<?= site_url('daltu/p2hp_lhp/persetujuan_p2hp/'.base64_encode($p2hp->id_p2hp).'/'.base64_encode($data->id_pka).'/'.base64_encode($data->id_tgs)); ?>" method='post'>
												<div class="col-sm-6">
													<h3 class="header">
														<i class="fa fa-book"></i> Pokok-Pokok Hasil Pemeriksaan P2HP
													</h3>

													<label> Berikut hasil <strong>P2HP</strong> yang telah dikerjakan oleh ketua tim. </label>

											      <div class="row">
											        <div class="col-sm-12">

											        	<div class="form-group">
													        <label class="col-sm-3 control-label no-padding-right"> Download : </label>
													        <div class="col-sm-8">
													        	<?php if($p2hp->keputusan_p2hp != "belum") { ?>
													        		<a href='<?= site_url('daltu/p2hp_lhp/download_p2hp/'.base64_encode($p2hp->file_p2hp)); ?>' class='btn btn-sm btn-success' title='Download file P2HP'><i class='fa fa-download'></i> File P2HP </a>
													          <?php } else
													          	{
													          		echo "<label class='control-label orange i'><i class='ace-icon fa fa-spinner fa-pulse bigger-130'></i> Belum Dibuat</label>";
													          	}
													          ?>
													        </div>
													      </div>

											        </div><!-- ./col -->
											      </div><!-- ./row -->

											      <?php
											      echo "<div class='hr hr-double hr-dotted hr18'></div>";

											      if($p2hp->keputusan_p2hp != "belum") {
											      	if($p2hp->reviu_p2hp_daltu == NULL) {
											      ?>

											      <label>Berilah keputusan hasil P2HP di atas dengan mengisi keputusan di bawah ini.</label>

											      <div class="form-group">
											        <label class="col-sm-4 control-label no-padding-right"> Keputusan : </label>
											        <div class="col-sm-7">
											          <label class="control-label">
											            <input type="radio" name="reviu" class="ace rev" value="setujui" checked="" />
											            <span class="lbl"> Setujui </span>
											          </label>

											          &nbsp;&nbsp; | &nbsp;&nbsp;

											          <label class="control-label">
											            <input type="radio" name="reviu" class="ace rev" value="reviu" />
											            <span class="lbl"> Direviu </span>
											          </label>
											        </div>
											      </div>

											      <div id="rev">
											      <div class="form-group">
											        <label class="col-sm-4 control-label no-padding-right"> &nbsp; </label>
											        <div class="col-sm-8">
											          <textarea name="catatan" cols="40" rows="3" placeholder="Isi reviu kka"></textarea>
											        </div>
											      </div>
											      </div>

											      <div class="form-group">
											        <label class="col-sm-4 control-label no-padding-right"> &nbsp; </label>
											        <div class="col-sm-8">
											         <input type='submit' class='btn btn-sm btn-info' value='Ok' />
											        </div>
											      </div>

											      <?php } } ?>

													<h3 class="header">
														<i class="fa fa-recycle"></i> Hasil Reviu P2HP
													</h3>

													<table width="100%" border="0">
														<tr>
															<td width="19%" class="pos-atas"> Reviu DALNIS </td>
															<td width="3%" class="pos-atas"> : </td>
															<td>
																<?php
																	if($p2hp->file_p2hp == NULL)
																	{
																		echo "-";
																	}
																	else
																	{
																		if($p2hp->reviu_p2hp_dalnis == NULL)
																		{ echo "<i class='fa fa-spinner fa-pulse orange'></i> <strong class='orange i'> Belum Direviu </strong>"; }
																		elseif($p2hp->reviu_p2hp_dalnis == "-")
																		{ echo "<i class='fa fa-check green'><strong> Tidak ada reviu </strong></i>"; }
																		else
																		{	echo "<span class='red'><strong> $p2hp->reviu_p2hp_dalnis </strong></span>"; }
																	}
																?>
															</td>
														</tr>

														<tr>
															<td class="pos-atas"> Reviu DALTU </td>
															<td class="pos-atas"> : </td>
															<td>
																<?php
																	if($p2hp->file_p2hp == NULL)
																	{
																		echo "-";
																	}
																	else
																	{
																		if($p2hp->reviu_p2hp_daltu == NULL)
																		{ echo "<i class='fa fa-spinner fa-pulse orange'></i> <strong class='orange i'> Belum Direviu </strong>"; }
																		elseif($p2hp->reviu_p2hp_daltu == "-")
																		{ echo "<i class='fa fa-check green'><strong> Tidak ada reviu </strong></i>"; }
																		else
																		{	echo "<span class='red'><strong> $p2hp->reviu_p2hp_daltu </strong></span>"; }
																	}
																?>
															</td>
														</tr>
													</table>

													<?php if($cek_rev_p2hp > 0) { ?>
													<h3 class="header">
														<i class="fa fa-retweet"></i> Riwayat Reviu P2HP
													</h3>

													<table width="100%" border="1">
														<tr>
															<th class="bg-color5 c" width="6%"> No </th>
															<th class="bg-color5 c"> Tanggal Reviu </th>
															<th class="bg-color5 c" width="16%"> Reviu Ke </th>
															<th class="bg-color5 c" width="12%"> Dalnis </th>
															<th class="bg-color5 c" width="12%"> Daltu </th>
															<th class="bg-color5 c" width="10%"> Aksi </th>
														</tr>

														<?php
															$no = 1;
															foreach($data_rev_p2hp as $row)
															{
																$tgl_rev = date('d', strtotime($row->rev_tgl)) ." ".
																					 get_nama_bulan(date('m', strtotime($row->rev_tgl))) ." ".
																					 date('Y', strtotime($row->rev_tgl)) ." | ". date('H:i:s', strtotime($row->rev_tgl));

																if($row->rev_p2hp_dalnis == "-")
																{ $rev_dalnis = "<i class='fa fa-check bigger-130 green' title='Tidak ada reviu'></i>"; }
																else
																{	$rev_dalnis = "<i class='fa fa-times bigger-130 red' title='Terdapat reviu'></i>"; }

																if($row->rev_p2hp_daltu == "-")
																{ $rev_daltu = "<i class='fa fa-check bigger-130 green' title='Tidak ada reviu'></i>"; }
																else
																{	$rev_daltu = "<i class='fa fa-times bigger-130 red' title='Terdapat reviu'></i>"; }

																echo "
																<tr>
																	<td class='c'> $no </td>
																	<td class='c'> $tgl_rev </td>
																	<td class='c'> $row->rev_ke </td>
																	<td class='c'> $rev_dalnis </td>
																	<td class='c'> $rev_daltu </td>
																	<td class='c'>
																		<a href='". site_url('daltu/p2hp_lhp/download_rev_p2hp/'.base64_encode($row->rev_file_p2hp))."' class='btn btn-sm btn-success' title='Download file P2HP'> <i class='fa fa-download'></i> </a>
																	</td>
																</tr>
																";
																$no++;
															}
														?>
													</table>
													<?php } ?>
												</div>
												</form>

												<?php if($p2hp->keputusan_p2hp == "selesai") { ?>
												<form class='form-horizontal' role='form' action="<?= site_url('daltu/p2hp_lhp/persetujuan_lhp/'.base64_encode($lhp->no_lhp) .'/'.base64_encode($p2hp->id_p2hp) .'/'.base64_encode($data->id_pka)); ?>" method='post'>
												<div class="col-sm-6">
													<h3 class="header">
														<i class="fa fa-book"></i> Laporan Hasil Pemeriksaan (LHP)
													</h3>

													<label> Berikut hasil <strong>LHP</strong> yang telah dikerjakan oleh ketua tim. </label>

											      <div class="row">
											        <div class="col-sm-12">

											        	<div class="form-group">
													        <label class="col-sm-3 control-label no-padding-right"> Download : </label>
													        <div class="col-sm-8">
													        	<?php if($lhp->keputusan_lhp != "belum") { ?>
													        		<a href='<?= site_url('daltu/p2hp_lhp/download_lhp/'.base64_encode($lhp->file_lhp)); ?>' class='btn btn-sm btn-success' title='Download file LHP'><i class='fa fa-download'></i> File LHP </a>
													          <?php } else
													          	{
													          		echo "<label class='control-label orange i'><i class='ace-icon fa fa-spinner fa-pulse bigger-130'></i> Belum Dibuat</label>";
													          	}
													          ?>
													        </div>
													      </div>

											        </div><!-- ./col -->
											      </div><!-- ./row -->

											      <?php
											      echo "<div class='hr hr-double hr-dotted hr18'></div>";

											      if($lhp->keputusan_lhp != "belum") {
											      	if($lhp->rev_lhp_daltu == NULL) {
											      ?>

											      <label>Berilah keputusan hasil LHP di atas dengan mengisi keputusan di bawah ini.</label>

											      <div class="form-group">
											        <label class="col-sm-4 control-label no-padding-right"> Keputusan : </label>
											        <div class="col-sm-7">
											          <label class="control-label">
											            <input type="radio" name="reviu" class="ace rev" value="setujui" checked="" />
											            <span class="lbl"> Setujui </span>
											          </label>

											          &nbsp;&nbsp; | &nbsp;&nbsp;

											          <label class="control-label">
											            <input type="radio" name="reviu" class="ace rev" value="reviu" />
											            <span class="lbl"> Direviu </span>
											          </label>
											        </div>
											      </div>

											      <div id="rev">
											      <div class="form-group">
											        <label class="col-sm-4 control-label no-padding-right"> &nbsp; </label>
											        <div class="col-sm-8">
											          <textarea name="catatan" cols="40" rows="3" placeholder="Isi reviu LHP"></textarea>
											        </div>
											      </div>
											      </div>

											      <div class="form-group">
											        <label class="col-sm-4 control-label no-padding-right"> &nbsp; </label>
											        <div class="col-sm-8">
											         <input type='submit' class='btn btn-sm btn-info' value='Ok' />
											        </div>
											      </div>

											      <?php } } ?>

													<h3 class="header">
														<i class="fa fa-recycle"></i> Hasil Reviu LHP
													</h3>

													<table width="100%" border="0">
														<tr>
															<td width="19%" class="pos-atas"> Reviu DALNIS </td>
															<td width="3%" class="pos-atas"> : </td>
															<td>
																<?php
																	if($lhp->file_lhp == NULL)
																	{
																		echo "-";
																	}
																	else
																	{
																		if($lhp->rev_lhp_dalnis == NULL)
																		{ echo "<i class='fa fa-spinner fa-pulse orange'></i> <strong class='orange i'> Belum Direviu </strong>"; }
																		elseif($lhp->rev_lhp_dalnis == "-")
																		{ echo "<i class='fa fa-check green'><strong> Tidak ada reviu </strong></i>"; }
																		else
																		{	echo "<span class='red'><strong> $lhp->rev_lhp_dalnis </strong></span>"; }
																	}
																?>
															</td>
														</tr>

														<tr>
															<td class="pos-atas"> Reviu DALTU </td>
															<td class="pos-atas"> : </td>
															<td>
																<?php
																	if($lhp->file_lhp == NULL)
																	{
																		echo "-";
																	}
																	else
																	{
																		if($lhp->rev_lhp_daltu == NULL)
																		{ echo "<i class='fa fa-spinner fa-pulse orange'></i> <strong class='orange i'> Belum Direviu </strong>"; }
																		elseif($lhp->rev_lhp_daltu == "-")
																		{ echo "<i class='fa fa-check green'><strong> Tidak ada reviu </strong></i>"; }
																		else
																		{	echo "<span class='red'><strong> $lhp->rev_lhp_daltu </strong></span>"; }
																	}
																?>
															</td>
														</tr>
													</table>

													<?php if($cek_rev_lhp > 0) { ?>
													<h3 class="header">
														<i class="fa fa-retweet"></i> Riwayat Reviu LHP
													</h3>

													<table width="100%" border="1">
														<tr>
															<th class="bg-color5 c" width="6%"> No </th>
															<th class="bg-color5 c"> Tanggal Reviu </th>
															<th class="bg-color5 c" width="16%"> Reviu Ke </th>
															<th class="bg-color5 c" width="12%"> Dalnis </th>
															<th class="bg-color5 c" width="12%"> Daltu </th>
															<th class="bg-color5 c" width="10%"> Aksi </th>
														</tr>

														<?php
															$no = 1;
															foreach($data_rev_lhp as $row)
															{
																$tgl_rev = date('d', strtotime($row->tgl_rev_lhp)) ." ".
																					 get_nama_bulan(date('m', strtotime($row->tgl_rev_lhp))) ." ".
																					 date('Y', strtotime($row->tgl_rev_lhp)) ." | ". date('H:i:s', strtotime($row->tgl_rev_lhp));

																if($row->reviu_lhp_dalnis == "-")
																{ $rev_dalnis = "<i class='fa fa-check bigger-130 green' title='Tidak ada reviu'></i>"; }
																else
																{	$rev_dalnis = "<i class='fa fa-times bigger-130 red' title='Terdapat reviu'></i>"; }

																if($row->reviu_lhp_daltu == "-")
																{ $rev_daltu = "<i class='fa fa-check bigger-130 green' title='Tidak ada reviu'></i>"; }
																else
																{	$rev_daltu = "<i class='fa fa-times bigger-130 red' title='Terdapat reviu'></i>"; }

																echo "
																<tr>
																	<td class='c'> $no </td>
																	<td class='c'> $tgl_rev </td>
																	<td class='c'> $row->rev_ke </td>
																	<td class='c'> $rev_dalnis </td>
																	<td class='c'> $rev_daltu </td>
																	<td class='c'>
																		<a href='". site_url('daltu/p2hp_lhp/download_rev_lhp/'.base64_encode($row->rev_file_lhp))."' class='btn btn-sm btn-success' title='Download file LHP'> <i class='fa fa-download'></i> </a>
																	</td>
																</tr>
																";
																$no++;
															}
														?>
													</table>
													<?php } ?>
												</div>
												</form>
												<?php } ?>

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
			$('#rev').hide();
		  $('.rev').click(function(){
		    if($(this).val() == "reviu")
		    {
		      $('#rev').slideDown('fast');
		    }
		    else
		    {
		      $('#rev').slideUp('fast');
		    }
		  });

		  jQuery(function($)
		  {
		    $('.id-input-file-2').ace_file_input({
		      no_file    : 'Tidak ada File ...',
		      btn_choose : 'Pilih',
		      btn_change : 'Ubah',
		      droppable  : false,
		      onchange   : null,
		      thumbnail  : false, //| true | large
		      //whitelist:'doc|docx',
		      //blacklist:'exe|php'
		      //onchange:''
		      //
		    });
		  });
		</script>

	</body>
</html>