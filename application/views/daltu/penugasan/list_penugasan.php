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
								<a href="<?= site_url('daltu/home'); ?>"> Home </a>
							</li>
							<li class="active"> Penugasan </li>
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">

						<div class="page-header">
							<h1>
								Penugasan
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Melihat tugas yang diberikan irban kepada ketua tim
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
											Daftar Penugasan
										</div>

										<!-- div.table-responsive -->
										<div>
											<table width="100%" id="mytable" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th width="5%"> No </th>
														<th width="9%"> Tanggal </th>
														<th> Nama Objek Pengawasan </th>
														<th width="19%"> Program Pengawasan </th>
														<th width="11%"> No. Telepon  </th>
														<th width="6%"> Anggaran Waktu </th>
														<th width="5%"> PKA </th>
													</tr>
												</thead>

												<tbody>
												<?php $no = 1;
												foreach ($tugas as $row)
												{
													$id  = base64_encode($row->id_tugas);
													$id2 = base64_encode($row->id_tim);

													$tgl = date('d-m-Y', strtotime($row->tgl_penugasan));

													echo "
													<tr>
														<td align='center'> $no </td>
														<td align='center'> $tgl </td>
														<td>";
														if($row->notif_ketua_tim == "baru")
															{ echo "<i class='red ace-icon fa fa-asterisk'></i>";	}
													echo "															
															$row->nama_op 
															<a href='penugasan/detail_penugasan/$id/$id2' title='Detail penugasan'>
																<span class='pull-right'> <i class='ace-icon fa fa-list bigger-130'></i> </span>
															</a>
														</td>
														<td> $row->program_peng </td>
														<td align='center'> $row->no_tlp </td>";
														if($row->fk_agr == NULL)
															{ echo "<td align='center'> <i class='ace-icon fa fa-spinner fa-pulse bigger-130 orange' title='Belum dibuat'></i> </td>"; }
														else
															{ echo "<td align='center'> <i class='ace-icon fa fa-check bigger-130 green' title='Sudah dibuat'></i> </td>"; }

														if($row->fk_pka == NULL)
															{ echo "<td align='center'> <i class='ace-icon fa fa-spinner fa-pulse bigger-130 orange' title='Belum dibuat'></i> </td>"; }
														else
															{ echo "<td align='center'> <i class='ace-icon fa fa-check bigger-130 green' title='Sudah dibuat'></i> </td>"; }
													echo "
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

      	//notifikasi hapus
        $(document).on('click', '#delete-row', function(e){
	        e.preventDefault();
	        id = $(this).data('id');
        });
        $(document).on('click', '#del-row', function(e){
        	window.location = 'kelola_pengguna/hapus_pengguna/' +id;
        });
        //.notifikasi hapus

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