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
								<a href="<?= site_url('adum/home'); ?>"> Home </a>
							</li>
							<li class="active"> Data Pegawai </li>
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">

						<div class="page-header">
							<h1>
								Data Pegawai
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Mengelola data pegawai inspektorat kota pariaman
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

										<!-- <label><a href="<?php echo site_url('adum/data_pegawai/tambah_pegawai'); ?>" class="btn btn-info" title="Tambah pegawai baru"><i class="fa fa-plus-square fa-lg"></i>&nbsp; Tambah Pegawai</a></label> -->


										<div class="table-header">
											Daftar Pegawai
										</div>

										<!-- div.table-responsive -->
										<div>
											<table width="100%" id="mytable" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th width="5%"> No </th>
														<th width="15%"> NIP </th>
														<th> Nama Lengkap </th>
														<th width="15%"> Golongan </th>
														<th width="20%"> Jabatan </th>
														<th width="12%"> Jabatan Tim </th>
														<th width="10%"> Kelola Data </th>
													</tr>
												</thead>

												<tbody>
												<?php $no = 1;
												foreach ($pegawai as $row) {

													$id = base64_encode($row->id_pegawai);

													echo "
													<tr>
														<td align='center'> $no </td>
														<td align='center'> $row->nip </td>
														<td> $row->nama </td>
														<td align='center'> $row->golongan </td>
														<td align='center'> $row->jabatan </td>
														<td align='center'> $row->jabatan_tim </td>
														<td align='center'>
															<a href='data_pegawai/ubah_pegawai/$id' class='green' title='Ubah Data'>
																<i class='ace-icon fa fa-pencil bigger-130'></i>
															</a>";
															if($row->jabatan != "Inspektur" && 
																$row->jabatan != "Sekretaris" &&
																$row->jabatan != "Irban Wilayah I" &&
																$row->jabatan != "Irban Wilayah II" &&
																$row->jabatan != "Irban Wilayah III" &&
																$row->jabatan != "Kasubag Evaluasi dan Pelaporan" &&
																$row->jabatan != "Kasubag Perencanaan" &&
																$row->jabatan != "Kasubag Administrasi dan Umum" &&
																$row->jabatan != "Pejabat Penatausahaan Penguna Barang" &&
																$row->jabatan != "Pengurus Barang" &&
																$row->jabatan != "Bendahara Pengeluaran" &&
																$row->jabatan != "Pembantu Bendahara Pencatat Dokumen" &&
																$row->jabatan != "Pembantu Bendahara Urusan Gaji"
															) { echo "
															&nbsp; | &nbsp;
															<a href='#' id='delete-row' class='delete-row red' title='Hapus Data' data-toggle='modal' data-target='#myModal' aria-hidden='true' data-id='$id'>
																<i class='ace-icon fa fa-trash-o bigger-130'></i>
															</a>";
															} echo "
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
        	window.location = 'data_pegawai/hapus_pegawai/' +id;
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
             "zeroRecords"			: "<center>Tidak ada data yang ditemukan</center>",
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