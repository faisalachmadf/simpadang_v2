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
								<a href="<?= site_url('ketua_tim/home'); ?>"> Home </a>
							</li>
							<li class="active"> Pengaturan Anggaran Waktu </li>
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">

						<div class="page-header">
							<h1>
								Pengaturan Anggaran Waktu
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Mengelola jenis pekerjaan yang ada pada alokasi anggaran waktu
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
											<a href="javascript:history.back()" class="btn btn-default">
												<i class="fa fa-arrow-left"></i> Kembali 
											</a> &nbsp;

											<a href="<?php echo site_url('ketua_tim/pengaturan/tambah_anggaran_waktu'); ?>" class="btn btn-info" title="Tambah jenis pekerjaan">
												<i class="fa fa-plus-square fa-lg"></i>&nbsp; Tambah Alokasi Jenis Pekerjaan
											</a>
										</label>

										<div class="table-header">
											Daftar Alokasi Anggaran Waktu
										</div>

										<!-- div.table-responsive -->
										<div>
											<table width="100%" id="mytable" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th width="6%"> No </th>
														<th> Jenis Pekerjaan </th>
														<th width="17%"> Kategori Pekerjaan </th>
														<th width="10%"> Kelola Data </th>
													</tr>
												</thead>

												<tbody>
												<?php $no = 1;
												foreach ($anggaran as $row) {

													if($row->kategori_agr_wkt == "1")
													{	$kat = "PERSIAPAN"; }
													elseif($row->kategori_agr_wkt == "2")
													{ $kat = "PELAKSANAAN"; }
													elseif($row->kategori_agr_wkt == "3")
													{ $kat = "PENYELESAIAN"; }

													$id  = base64_encode($row->id_agr_wkt);

													echo "
													<tr>
														<td align='center'> $no </td>
														<td> $row->jenis_pekerjaan </td>
														<td align='center'> $kat </td>
														<td align='center'>
															<a href='ubah_anggaran_waktu/$id' class='green' title='Ubah Data'>
																<i class='ace-icon fa fa-pencil bigger-130'></i>
															</a>
															&nbsp; | &nbsp;
															<a href='#' id='delete-row' class='delete-row red' title='Hapus Data' data-toggle='modal' data-target='#myModal' aria-hidden='true' data-id='$id'>
																<i class='ace-icon fa fa-trash-o bigger-130'></i>
															</a>
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
        	window.location = 'hapus_anggaran_waktu/' +id;
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