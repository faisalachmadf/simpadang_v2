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
								<a href="<?= site_url('dalnis/home'); ?>"> Home </a>
							</li>
							<li class="active"> P2HP & LHP </li>
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">

						<div class="page-header">
							<h1>
								P2HP & LHP
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Membuat dan mengelola pokok-pokok hasil pemeriksaan & laporan hasil pemeriksaan
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
											Daftar P2HP & LHP
										</div>

										<!-- div.table-responsive -->
										<div>
											<table width="100%" id="mytable" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th width="5%"> No </th>
														<th> Nama Objek Pengawasan </th>
														<th width="25%"> Instansi </th>
														<th width="17%"> Kecamatan </th>
														<th width="8%"> P2HP </th>
													</tr>
												</thead>

												<tbody>
												<?php $no = 1;
												foreach ($p2hp_lhp as $row) 
												{
													$id  = base64_encode($row->id_p2hp);
													$id2 = base64_encode($row->fk_pka);

													echo "
													<tr>
														<td align='center'> $no </td>
														<td> 
															$row->nama_op
															<a href='p2hp_lhp/detail_p2hp_lhp/$id/$id2' title='Detail P2HP & LHP'>
																<span class='pull-right'> <i class='ace-icon fa fa-list bigger-130'></i> </span>
															</a>
														</td>
														<td> $row->nm_instansi </td>
														<td align='center'> $row->nm_kec </td>
														<td align='center'>";
														if($row->keputusan_p2hp == "belum")
															{ echo "-"; }
														elseif($row->keputusan_p2hp == "proses")
															{ echo "<i class='ace-icon fa fa-spinner fa-pulse bigger-130 orange' title='Belum direviu'></i>"; }
														elseif($row->keputusan_p2hp == "reviu")
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

								<!-- Konfirmasi Hapus Data -->
				        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				          <div class="modal-dialog">
				            <div class="modal-content">
				              <div class="modal-header">
				                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				                <h4 style="color:#bf1a1a" class="modal-title" id="myModalLabel"><i class="fa fa-warning"></i> Konfirmasi Hapus Data</h4>
				              </div>
				              <div class="modal-body">
				                Apakah anda yakin ingin menghapus data ini ?
				              </div>
				              <div class="modal-footer">
				              	<button type="button" class="btn" data-dismiss="modal"><i class='ace-icon fa fa-times'></i> Batal </button>
				                <button type="button" id="del-row" class="btn btn-danger del-row"><i class='ace-icon fa fa-trash-o bigger-130'></i> Hapus </button>
				              </div>
				            </div>
				          </div>
				        </div>
				        <!-- /konfirmasi -->

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
        	window.location = 'anggaran_waktu/hapus_anggaran_waktu/' +id;
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