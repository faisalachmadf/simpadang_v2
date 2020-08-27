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
							<li class="active"> Instansi </li>
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">

						<div class="page-header">
							<h1>
								Instansi
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Mengelola data kecamatan dan instansi
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

										<label><a href="<?php echo site_url('staff/instansi/tambah_kecamatan'); ?>" class="btn btn-info" title="Tambah kecamatan baru"><i class="fa fa-plus-square fa-lg"></i>&nbsp; Tambah Kecamatan</a></label>

										&nbsp;&nbsp;

										<label><a href="<?php echo site_url('staff/instansi/tambah_desa'); ?>" class="btn btn-warning" title="Tambah instansi baru"><i class="fa fa-plus-square fa-lg"></i>&nbsp; Tambah Instansi</a></label>


										<div class="table-header">
											Daftar Instansi
										</div>

										<!-- div.table-responsive -->
										<div>
											<table width="100%" id="mytable" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th width="5%"> No </th>
														<th width="13%"> Detail Instansi </th>
														<th> Nama Kecamatan </th>
														<th width="10%"> Kelola Data </th>
													</tr>
												</thead>

												<tbody>
												<?php $no = 1;
												foreach ($instansi as $row) {

													$id = base64_encode($row->id_instansi);

													echo "
													<tr>
														<td align='center'> $no </td>
														<td align='center'> <a href='#modal-detail' role='button' class='btn btn-sm btn-primary' data-toggle='modal' data-id='$row->id_instansi' title='Detail instansi'><i class='fa fa-list'></i> Detail Instansi</a> </td>
														<td> $row->nama_kecamatan </td>
														<td align='center'>
															<a href='instansi/ubah_kecamatan/$id' class='green' title='Ubah Data'>
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
								
								<div id="modal-detail" class="modal fade" tabindex="-1">
									<div class="modal-dialog modal-width">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h4 class="blue bigger"> <i class="fa fa-list"></i> Detail Instansi</h4>
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

								<!-- Konfirmasi Hapus Data -->
				        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				          <div class="modal-dialog">
				            <div class="modal-content">
				              <div class="modal-header">
				                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				                <h4 style="color:#bf1a1a" class="modal-title" id="myModalLabel"><i class="fa fa-warning"></i> Konfirmasi Hapus Data</h4>
				              </div>
				              <div class="modal-body">
				                <label> Apakah anda yakin ingin menghapus data ini ? <br/>
				                <span class="red"> Kecamatan akan di hapus beserta desa-desa yang terkait dengan kecamatan ini. </span> </label>
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

      	$('#modal-detail').on('show.bs.modal', function(e)
				{
	        var id = $(e.relatedTarget).data('id');
	        //menggunakan fungsi ajax untuk pengambilan data
	        $.ajax({
	            type : 'post',
	            url  : "<?= site_url('staff/instansi/detail_instansi'); ?>",
	            data : {id:id}, //'rowid='+ rowid,
	            success : function(data)
	            {
	            	$('.isi-data').html(data); //menampilkan data ke dalam modal
	            }
	        });
		    });

      	//notifikasi hapus
        $(document).on('click', '#delete-row', function(e){
	        e.preventDefault();
	        id = $(this).data('id');
        });
        $(document).on('click', '#del-row', function(e){
        	window.location = 'instansi/hapus_kecamatan/' +id;
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
             "zeroRecords"			: "<center>Tidak ada data instansi yang ditemukan</center>",
             "emptyTable"				: "<center>Tidak ada data instansi di dalam tabel</center>",
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