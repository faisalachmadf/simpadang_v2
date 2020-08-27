<?php
//--> include data header
$this->load->view('layout/header_public');
//--> include data top navigasi 
$this->load->view('layout/top_nav_public');
//--> include data navigasi
$this->load->view('layout/nav_public'); 
?>
		<div class="main-content">
			<div class="main-content-inner">
				<div class="page-content">

					<div class="page-header">
						<h1>
							Home
							<small>
								<i class="ace-icon fa fa-angle-double-right"></i>
								Selamat datang
							</small>
						</h1>
					</div><!-- /.page-header -->

					<div class="row">
						<div class="col-xs-12">
							<!-- PAGE CONTENT BEGINS -->
							
							<div class="col-xs-3 center">
								&nbsp;<br/>
								<img src="<?= base_url(); ?>assets/images/big-logo1.png" width="310" height="200">
							</div>

							<div class="col-xs-6" align="">
								<h1>Selamat Datang, </h1>
								<h2 class="header">Di Sistem Informasi Pengawasan Dan Tindak Lanjut Inspektorat Kota Pariaman</h2>

								<h6 align="justify">
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									Inspektorat Kota Pariaman merupakan lembaga pemerintahan ditingkat daerah yang berkedudukan dibawah dan bertanggung jawab kepada Walikota Pariaman dan secara teknis administrasi mendapat pembinaan dari sekretaris Daerah Kota Pariaman.
								</h6> 

								<h6 align="justify">
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									Inspektorat Kota Pariaman mempunyai tugas melaksanakan pengawasan terhadap pelaksanaan urusan pemerintahan di daerah Kota Pariaman, pelaksanaan pembinaan atas penyelenggaraan pemerintahan desa dan pelaksanaan urusan pemerintahan desa. Dalam melaksanakan tugasnya, inspektorat Kota Pariaman menyelenggarakan fungsi diantaranya, perencanaan program pengawasan perumusan kebijakan dan fasilitasi pengawasan dibidang pemerintahan, ekonomi dan pembangunan, kesejahteraan rakyat serta keuangan dan pendayagunaan aparatur pemeriksaan, pengusutan, pengujian, dan penilaian tugas pengawasan evaluasi dan pelaporan dibidang pengawasan pelaksanaan kesekretariatan inspektorat serta pelaksanaan tugas lain yang diberikan oleh bupati sesuai dengan tugas dan fungsinya. <!-- <a href="<?= site_url('tes/cetak'); ?>" target="_blank"> CETAK </a> -->
								</h6>
							</div>

							<div class="col-xs-3">
								<h3 class="header"><i class="fa fa-map-marker light-orange bigger-110"></i> Alamat </h3>
								<label> Jalan Rohana Kudus No. 44.</label>

								<h3 class="header"><i class="fa fa-phone light-orange bigger-110"></i> Kontak </h3>
								<label> Telp. (0751) 93652, Fax. (0751) 91557</label>

								<h3 class="header"><i class="fa fa-info-circle light-orange bigger-110"></i> Melayani </h3>
								<label> 
									Hari : Senin s/d Jum'at <br/> 
									Jam &nbsp;: 08.00 - 16.00 WIB
								</label>
							</div>

							<!-- PAGE CONTENT ENDS -->
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.page-content -->
			</div>
		</div><!-- /.main-content -->

<!-- include data footer -->
<?php $this->load->view('layout/footer_public'); ?>

	</body>
</html>