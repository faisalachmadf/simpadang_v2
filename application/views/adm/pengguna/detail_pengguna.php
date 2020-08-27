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
							<li class="active"> Detail Pengguna </li>													
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">		
					
						<div class="page-header">
							<h1>
								Data Pengguna
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									<?= $data->nama; ?>
								</small>
							</h1>
						</div><!-- /.page-header -->

						<!-- notifikasi -->
						<div id="sukses"><?= $this->session->flashdata("sukses"); ?></div>		

						<div class="row">
							<div class="col-xs-12">							
								<!-- PAGE CONTENT BEGINS -->

								<div class="row">
									<div class="col-sm-6">

										<div class="widget-box">		
											<div class="widget-body">
												<div class="widget-main">

													<h3 class="header">									
														
													</h3>										
																									
													<dl id="dt-list-1" class="dl-horizontal">
														<dt> NIP : </dt>
															<dd><?php if($data->nip != NULL) { echo $data->nip; } else { echo "-"; } ?></dd>

														<dt> Nama Lengkap : </dt>
															<dd><?= $data->nama; ?></dd>

															<br/>														

														<dt> Pangkat & Golongan : </dt>
															<dd><?= $data->pangkat ." ($data->golongan)"; ?></dd>	

														<dt> Jabatan Pegawai : </dt>
															<dd><?= $data->jabatan; ?></dd>

														<dt> Jenis Jabatan : </dt>
															<dd><?= $data->jenis_jabatan; ?></dd>
															
														<dt> No. Tlp : </dt>
															<dd><?php if($data->no_tlp != NULL) { echo $data->no_tlp; } else { echo "-"; } ?></dd>	

															<br/>

														<dt> Jabatan di Tim (saat ini) : </dt>
															<dd><?= $data->jabatan_tim; ?></dd>			
													</dl>

												</div>
											</div>
										</div>

									</div>

									<div class="col-sm-6">

										<div class="widget-box">		
											<div class="widget-body">
												<div class="widget-main">

													<h3 class="header">			
													</h3>

													<dl id="dt-list-1" class="dl-horizontal">
														<dt> Username : </dt>
															<dd class="xxx">XXXXX</dd>
															<dd class="userpass"><?= $data->username; ?></dd>

														<dt> Password : </dt>
															<dd class="xxx">XXXXX</dd>
															<dd class="userpass"><?= base64_decode($data->password); ?></dd>			
													</dl>

													<input type="hidden" id="nilai" value="hide" />

													<center><button id="tombol" class="btn btn-warning btn-sm"><i class="fa fa-eye fa-lg"></i> Lihat/Tutup Username & Password</button></center>

												</div>
											</div>
										</div>
										
									</div>
								</div>	

								<br/>

								<a href="<?= site_url('adm/kelola_pengguna'); ?>" class="btn">
									<i class="ace-icon fa fa-arrow-left"></i>
									Kembali
								</a>

								&nbsp;&nbsp;

								<a href="<?= site_url('adm/kelola_pengguna/ubah_pengguna/'. base64_encode($data->id_pegawai)); ?>" class="btn btn-success">
									<i class="ace-icon fa fa-edit"></i>
									Ubah Pengguna
								</a>

								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
						
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

<!-- include data footer -->
<?php $this->load->view('layout/footer'); ?>

		<script type="text/javascript">
			$('.userpass').hide();
			$('#tombol').click(function(){
				if($('#nilai').val() == "hide")
				{
					$('.userpass').show();
					$('.xxx').hide();
					document.getElementById("nilai").value = 'show';
				}
				else
				{
					$('.userpass').hide();
					$('.xxx').show();
					document.getElementById("nilai").value = 'hide';
				}
			});

		</script>

	</body>
</html>
