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
								<a href="<?= site_url('adm/home'); ?>"> Home </a>
							</li>
							<li>
								<a href="<?= site_url('adm/kelola_pengguna'); ?>"> Data Pengguna </a>
							</li>
							<li class="active"> Pengguna Non-aktif </li>
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">

						<div class="page-header">
							<h1>
								Pengguna Non-aktif
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									daftar data pengguna yang non-aktif
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
											<a href="<?php echo site_url('adm/kelola_pengguna'); ?>" class="btn btn-default"><i class="fa fa-arrow-left fa-lg"></i>&nbsp; Kembali</a>
										</label>

										<div class="table-header">
											Daftar Pengguna Non-aktif
										</div>

										<!-- div.table-responsive -->
										<div>
											<table width="100%" id="mytable" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th width="5%"> No </th>
														<th width="10%"> NIP </th>
														<th> Nama Lengkap </th>
														<th width="13%"> Pangkat </th>
														<th width="7%"> Golongan </th>
														<th width="16%"> Jabatan Pegawai </th>
														<th width="12%"> Jabatan Tim </th>
														<th width="7%"> Aksi </th>
													</tr>
												</thead>

												<tbody>
												<?php $no = 1;
												foreach ($pengguna as $row) {

													$id = base64_encode($row->id_pegawai);

													echo "
													<tr>
														<td align='center'> $no </td>
														<td align='center'> $row->nip </td>
														<td> $row->nama </td>
														<td align='center'> $row->pangkat </td>
														<td align='center'> $row->golongan </td>
														<td align='center'> $row->jabatan </td>
														<td align='center'> $row->jabatan_tim </td>
														<td align='center'>
															<a href='#' id='delete-row' class='delete-row green' title='Aktifkan akun' data-toggle='modal' data-target='#myModal' aria-hidden='true' data-id='$id'>
																<i class='ace-icon fa fa-eye bigger-130'></i>
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
				                <h4 style="color:#bf1a1a" class="modal-title" id="myModalLabel"><i class="fa fa-warning"></i> Konfirmasi Aktif Akun</h4>
				              </div>
				              <div class="modal-body">
				               	Apakah anda yakin ingin mengaktifkan akun ini ?
				              </div>
				              <div class="modal-footer">
				              	<button type="button" class="btn" data-dismiss="modal"><i class='ace-icon fa fa-times'></i> Batal </button>
				                <button type="button" id="del-row" class="btn btn-success del-row"><i class='ace-icon fa fa-eye-slash bigger-130'></i> Aktifkan </button>
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
        	window.location = 'aktif_pengguna/' +id;
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