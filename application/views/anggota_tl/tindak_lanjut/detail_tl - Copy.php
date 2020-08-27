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
	/*.modal-width {width: 70%}*/

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
								<a href="<?= site_url('anggota_tl/home'); ?>"> Home </a>
							</li>
							<li>
								<a href="<?= site_url('anggota_tl/tindak_lanjut'); ?>"> Tindak Lanjut </a>
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
															<dd><?= $data->tgl_tl; ?></dd>

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
														<i class="fa fa-list"></i> Aksi Pilihan
													</h3>

													<center>
														<a href="<?= site_url('anggota_tl/tindak_lanjut'); ?>" class="btn btn-sm btn-default"><i class="fa fa-arrow-left"></i> Kembali </a>

														<!-- <?php if($cek_tl1 < 0) { ?>
														&nbsp;&nbsp;

														<a href="<?= site_url('anggota_tl/tindak_lanjut/tambah_tl/'.base64_encode($data->id_tl).'/'.base64_encode($lhp->no_lhp)); ?>" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Buat Tindak Lanjut </a>
														<?php } else { ?>

														<a href="<?= site_url('anggota_tl/tindak_lanjut/detail_tugas_tl/'.base64_encode($data->id_tl).'/'.base64_encode($lhp->no_lhp)); ?>" class="btn btn-sm btn-primary"><i class="fa fa-list"></i> Detail Tugas Tindak Lanjut </a>
														<?php } ?> -->
													</center>
												</div>

												<form id="validasi" class="form-horizontal" role="form" action="<?php site_url('ketua_tl/tindak_lanjut/tambah_tl'); ?>" method="post">
												<div class="col-sm-12">
													<div class="hr hr-double hr-dotted hr18"></div>

													<center>
														<h5> TINDAK LANJUT HASIL PEMERIKSAAN </h5>
														<label> No. LHP : <?= $data2->fk_no_lhp; ?> Tgl. <?= $tgl_lhp; ?> </label>
													</center>

													<!-- <label class="i b red"> Keterangan Kategori Tindak Lanjut : S = SELESAI; DP = DALAM PROSES; B = BELUM dan CR = CACAT REKOMENDASI. </label> <br/> -->

													<table width="100%" border="1">
														<tr>
															<td rowspan="2" width="3%" class="c bg-color"> No. </td>
															<td colspan="2" class="b c bg-color"> TEMUAN </td>
															<td colspan="2" class="b c bg-color"> REKOMENDASI </td>
															<td colspan="2" class="b c bg-color"> TINDAK LANJUT </td>
															<td rowspan="2" width="4%" class="c bg-color"> KET </td>
														</tr>

														<tr>
															<td class="c bg-color"> URAIAN </td>
															<td width="4%" class="c bg-color"> KODE </td>
															<td class="c bg-color"> URAIAN </td>
															<td width="4%" class="c bg-color"> KODE </td>
															<td class="c bg-color"> URAIAN </td>
															<td width="10%" class="c bg-color"> KATEGORI </td>
														</tr>

														<?php
															$no=1;
															foreach($sub_tl2 as $row)
															{
																echo "
																<tr>
																	<td class='c pos-atas'> $no </td>
																	<td class='pos-atas'> $row->uraian_tm </td>
																	<td class='c pos-atas'> $row->kode_tm </td>
																	<td class='pos-atas'> $row->uraian_rk </td>
																	<td class='c pos-atas'> $row->kode_rk </td>
																	<td class-'pos-atas'> $row->uraian_tl </td>
																	<td class='c pos-atas'>";
																	if($row->kategori == NULL)
																	{
																		echo "<a href='#modal-kat' role='button' class='btn btn-sm btn-danger' data-toggle='modal' data-id1='$row->sub_tl2' data-id2='$row->fk_no_lhp' data-id3='$row->nomor' title='Tentukan kategori'><i class='fa fa-edit'></i> Tentukan </a>";
																	}
																	else
																	{
																		if($row->kategori == "S")
																		{
																			echo "Selesai (S)";
																		}
																		elseif($row->kategori == "DP")
																		{
																			echo "Dalam Proses (DP)";
																		}
																		elseif($row->kategori == "B")
																		{
																			echo "Belum (B)";
																		}
																		else
																		{
																			echo "Cacat Rekomendasi (CR)";
																		}
																	}

																echo "
																	<td class='pos-atas'> $row->keterangan </td>
																</tr>
																";

																$no++;
															}
														?>
													</table>
												</div>
												</form>
											</div>

										</div>
									</div>
								</div>

								<div id="modal-kat" class="modal fade" tabindex="-1">
									<div class="modal-dialog modal-width">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h4 class="red bigger"> <i class="fa fa-edit"></i> Penentuan Kategori Tindak Lanjut</h4>
											</div>

											<div class="modal-body">
												<div class="isi-data"></div>
											</div>

											<div class="modal-footer">
												<button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><i class="fa fa-arrow-left"></i> Kembali </button>
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
			$('#modal-kat').on('show.bs.modal', function(e)
			{
	        var id1 = $(e.relatedTarget).data('id1');
	        var id2 = $(e.relatedTarget).data('id2');
	        var id3 = $(e.relatedTarget).data('id3');
	        //menggunakan fungsi ajax untuk pengambilan data
        $.ajax({
            type : 'post',
            url  : "<?= site_url('anggota_tl/tindak_lanjut/penentuan_kat'); ?>",
            data : {id1:id1, id2:id2, id3:id3}, //'rowid='+ rowid,
            success : function(data)
            {
            	$('.isi-data').html(data); //menampilkan data ke dalam modal
            }
        });
	    });
	   </script>

	</body>
</html>