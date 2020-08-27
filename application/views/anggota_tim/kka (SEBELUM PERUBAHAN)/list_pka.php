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
								<a href="<?= site_url('anggota_tim/home'); ?>"> Home </a>
							</li>
							<li class="active"> Kertas Kerja Audit </li>
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">

						<div class="page-header">
							<h1>
								Kertas Kerja Audit
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Mengelola KKA yang telah ditugaskan
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

										<div class="table-header">
											Daftar Kertas Kerja Audit
										</div>

										<!-- div.table-responsive -->
										<div>
											<table width="100%" id="mytable" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th width="5%"> No </th>
														<th width="9%"> Tanggal </th>
														<th> Nama Objek Pengawasan </th>
														<th width="25%"> Program Pengawasan </th>
														<th width="17%"> Masa Periksa </th>
														<th width="10%"> No. REF. PKA </th>
													</tr>
												</thead>

												<tbody>
												<?php $no = 1;
												foreach ($pka as $row)
												{
													$id  = base64_encode($row->id_pka);
													$tgl = date('d-m-Y', strtotime($row->tgl_pka));

													echo "
													<tr>
														<td align='center'> $no </td>
														<td align='center'> $tgl </td>
														<td>";
														if($row->notif_dalnis == "baru")
															{ echo "<i class='red ace-icon fa fa-asterisk'></i>";	}
													echo "
															$row->nama_op
															<a href='kka/detail_kka/$id' title='Detail kertas kerja audit'>
																<span class='pull-right'> <i class='ace-icon fa fa-list bigger-130'></i> </span>
															</a>
														</td>
														<td> $row->program_peng </td>
														<td align='center'> $row->masa_periksa </td>
														<td align='center'> $row->no_ref_pka </td>
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
      $(function()
      {
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