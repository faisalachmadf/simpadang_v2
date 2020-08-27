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
								<a href="<?= site_url('staff/home'); ?>"> Home </a>
							</li>
							<li class="active"> Tindak Lanjut </li>
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">

						<div class="page-header">
							<h1>
								Tindak Lanjut
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Mengelola penugasan tim tindak lanjut
								</small>
							</h1>
						</div><!-- /.page-header -->

						<!-- notifikasi -->
						<div><?= $this->session->flashdata("sukses"); ?></div>

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								
											
								<div class="row">
									<div class="col-xs-12">
										<label>
											<a href="<?php echo site_url('staff/tindak_lanjut/tambah_tl2'); ?>" class="btn btn-info" title="Tambah penugasan"><i class="fa fa-plus-square fa-lg"></i>&nbsp; Tambah Penugasan Baru</a>
										</label>

										<div class="table-header">
											Daftar Tindak Lanjut
										</div>

										<!-- div.table-responsive -->
										<div>
											<table width="100%" id="mytable" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th width="5%"> No </th>
														<th width="9%"> Tanggal </th>
														<th> Objek Pengawasan </th>
														<th width="10%"> Reviu ADUM  </th>
														<th width="11%"> Reviu Sekretaris </th>
														<th width="8%"> Persetujuan </th>
													</tr>
												</thead>

												<tbody>
												<?php $no = 1; 
												foreach ($tl as $row)
												{
													$id  = base64_encode($row->id_tl);
													$id2 = base64_encode($row->id_tim);
													$tgl = date('d-m-Y', strtotime($row->tgl_tl));

													echo "
													<tr>
														<td align='center'> $no </td>
														<td align='center'> $tgl </td>
														<td> ";
															if($row->notif_staff == "baru")
															{	echo "<i class='red ace-icon fa fa-asterisk'></i>"; }
													echo "
															$row->sasaran_peng
															<a href='tindak_lanjut/detail_tl/$id/$id2' title='Detail tindak lanjut'>
																<span class='pull-right'> <i class='ace-icon fa fa-list bigger-130'></i> </span>
															</a>
														</td>
														<td align='center'>";
															if($row->reviu_adum == NULL)
																{ echo "<i class='ace-icon fa fa-spinner fa-pulse bigger-130 orange' title='Belum direviu'></i>"; }
															elseif($row->reviu_adum != "-")
																{ echo "<i class='ace-icon fa fa-times bigger-130 red' title='Ada direviu'></i>"; }
															else
																{	echo "<i class='ace-icon fa fa-check bigger-130 green' title='Sudah disetujui'></i>"; }
														echo"
														</td>
														<td align='center'>";
															if($row->reviu_sekretaris == NULL)
																{ echo "<i class='ace-icon fa fa-spinner fa-pulse bigger-130 orange' title='Belum direviu'></i>"; }
															elseif($row->reviu_sekretaris != "-")
																{ echo "<i class='ace-icon fa fa-times bigger-130 red' title='Ada direviu'></i>"; }
															else
																{	echo "<i class='ace-icon fa fa-check bigger-130 green' title='Sudah disetujui'></i>"; }
														echo"
														</td>
														<td align='center'>";
														if($row->persetujuan == "belum")
															{ echo "-"; }
														elseif($row->persetujuan == "proses")
															{ echo "-"; }
														elseif($row->persetujuan == "reviu")
															{ echo "<i class='ace-icon fa fa-times bigger-130 red' title='Ada direviu'></i>"; }
														else
															{ echo "<i class='ace-icon fa fa-check bigger-130 green' title='Sudah disetujui'></i>"; }
														echo "
														</td>
													</tr>";

													$no++;
												}	?>

												</tbody>
											</table>
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

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
      $(function(){

        //datatables
        $('#mytable').DataTable({
        	 "paginate" 	: true,
	         "sort"				: false,
           "lengthMenu"	: [[10, 25, 50, 100], [10, 25, 50, 100]],
           "language"		:
           {
             "lengthMenu" 			: "Lihat _MENU_ data",
             "search"						: "Cari data : ",
             "searchPlaceholder": "Cari ...",
             "zeroRecords"			: "Tidak ada data yang ditemukan",
             "emptyTable"				: "<center>Tidak ada data di dalam tabel</center>",
             "infoEmpty"				: "Tidak ada data yang ditampilkan",
             "info"							: "Menampilkan _START_ - _END_ dari _TOTAL_ data ",
             "infoFiltered"			: "(Hasil filter dari _MAX_ data)",
             oPaginate 	:
             {
           		sPrevious	: "<i class='fa fa-angle-left'><i/>",
				      sNext			: "<i class='fa fa-angle-right'><i/>"
				     }
           }
        });
        //.dattables

      });
    </script>

	</body>
</html>