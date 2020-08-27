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
								<a href="<?= site_url('evlap/home'); ?>"> Home </a>
							</li>
							<li class="active"> PKPT TAHUNAN </li>
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">



						<div class="page-header">
							<h1>
								PKPT TAHUNAN
							</h1>
						</div><!-- /.page-header -->
						
						
						<label>
							<a href="<?php echo site_url('adum/pkpt/tambah_pkpt'); ?>" class="btn btn-info" title="Tambah PKPT"><i class="fa fa-plus-square fa-lg"></i>&nbsp; Tambah PKPT Baru</a>
						</label>

						<!-- notifikasi -->
						<div><?= $this->session->flashdata("sukses"); ?></div>

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->

								<div class="row">
									<div class="col-xs-12">
										<div class="table-header">
											PKPT Tahunan
										</div>

										<!-- div.table-responsive -->
										<div>
											<table width="100%" id="mytable" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th width="5%"> No </th>
														<th> Tahun</th>
														<th> PKPT Tahunan</th>
														<th> File Upload</th>
														<th width="11%"> Kelola Data </th>	
													</tr>
												</thead>

												<tbody>
												<?php $no = 1;
												foreach ($pkpt as $row)
												{
													$id  = $row->id;

													echo "
													<tr>
														<td align='center'> $no </td>
														
														<td>$row->tahun</td>
														<td>$row->judul</td>
														<td>$row->nama_file 
															<a href='". base_url('/assets/pkpt/').$row->nama_file. "' title='Download File' download>
															<span class='pull-right'> <i class='ace-icon fa fa-download bigger-130'></i> </span>
															</a>
														</td>
														<td align='center'>
															<a href='pkpt/ubah_pkpt/$id' class='green' title='Ubah Data'>
																<i class='ace-icon fa fa-pencil bigger-130'></i>
															</a> 
															&nbsp; | &nbsp
															<a href='pkpt/delete/$id' class='red' onclick='return confirm(\"Anda yakin hapus data ini?\") ;' title='Hapus Data'>
																<i class='ace-icon fa fa-warning bigger-130'></i>
															</a>
															" ;"
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

      	//notifikasi hapus
        $(document).on('click', '#delete-row', function(e){
	        e.preventDefault();
	        id = $(this).data('id');
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