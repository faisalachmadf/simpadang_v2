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
							<li class="active">
								<i class="ace-icon fa fa-home home-icon"></i>
								Home
							</li>							
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">		

						<div class="page-header">
							<h1>
								Home
								
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
							<!-- PAGE CONTENT BEGINS -->

								

								<h1>Selamat Datang!</h1>
								<h3>Di Sistem Informasi Pengawasan Dan Tindak Lanjut Inspektorat Kota Pariaman.</h3>
								<h5>Anda berada di halaman <strong style="color:red">Kasubag Evaluasi dan Pelaporan.</strong> <small>Gunakan sistem ini dengan bijak, dan gunakan data dengan sebaik-baiknya.</small></h5>
								
								<br/>
								<p>Login sebagai : <strong><?=$user['username']; ?></strong></p>

							<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
							<div class='col-xs-6'>
								<div class="widget-box">
								<div class="widget-header widget-header-flat widget-header-small">
									<h5 class="widget-title">
										<i class="ace-icon fa fa-signal"></i>
										Status Temuan
									</h5>
								</div>

								<div class="widget-body">
									<div class="widget-main">
										<div id="piechart-placeholder"></div>

									</div><!-- /.widget-main -->
								</div><!-- /.widget-body -->
							</div><!-- /.widget-box -->
							</div>
							<div class='col-xs-6'>
								<div class="widget-box">
									<div class="widget-header widget-header-flat widget-header-small">
										<h5 class="widget-title">
											<i class="ace-icon fa fa-signal"></i>
											Jumlah Temuan Berdasarkan Aspek Temuan
										</h5>
									</div>

									<div class="widget-body">
										<div class="widget-main">
											<div id="piechart-placeholder2"></div>

										</div><!-- /.widget-main -->
									</div><!-- /.widget-body -->
								</div><!-- /.widget-box -->
							</div>

							<div class='col-xs-6'>
								<div class="widget-box">
									<div class="widget-header widget-header-flat widget-header-small">
										<h5 class="widget-title">
											<i class="ace-icon fa fa-signal"></i>
											Jumlah Temuan Berdasarkan Kategori LHP
										</h5>
									</div>

									<div class="widget-body">
										<div class="widget-main">
											<div id="piechart-placeholder3"></div>

										</div><!-- /.widget-main -->
									</div><!-- /.widget-body -->
								</div><!-- /.widget-box -->
							</div>

						</div><!-- /.row -->
						
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->
			

<!-- include data footer -->
<?php $this->load->view('layout/footer'); ?>
<script type="text/javascript">
			jQuery(function($) {
			
			  var placeholder = $('#piechart-placeholder').css({'width':'90%' , 'min-height':'150px'});
			  var data = [
				{ label: "Selesai (<?= $jml_1->jml ?>)",  data: <?= $jml_1->jml ?>, color: "#68BC31"},
				{ label: "Belum Selesai (<?= $jml_2->jml ?>)",  data: <?= $jml_2->jml ?>, color: "#AF4E96"},
				{ label: "Tidak Dapat Ditindaklanjuti (<?= $jml_3->jml ?>)",  data: <?= $jml_3->jml ?>, color: "#DA5430"},
				{ label: "Belum Ditindaklanjuti (<?= $jml_0->jml ?>)",  data: <?= $jml_0->jml ?>, color: "#FEE074"}
			  ]
			  
		
				var placeholder2 = $('#piechart-placeholder2').css({'width':'90%' , 'min-height':'150px'});
				var data2 = [
					{ label: "Sistem Pengendalian Intern (<?= $aspek_spi->jml ?>)",  data: <?= $aspek_spi->jml ?>, color: "#68BC31"},
					{ label: "Efektif, Efisien & Ekonomis (<?= $aspek_e3->jml ?>)",  data: <?= $aspek_e3->jml ?>, color: "#2091CF"},
					{ label: "Kepatuhan Terhadap Peraturan (<?= $aspek_kepatuhan->jml ?>)",  data: <?= $aspek_kepatuhan->jml ?>, color: "#AF4E96"},
				  ]
				drawPieChart(placeholder2, data2);

				var placeholder3 = $('#piechart-placeholder3').css({'width':'90%' , 'min-height':'150px'});
				var data3 = [
					{ label: "LHP BPK (<?= $lhp_bpk->jml ?>)",  data: <?= $lhp_bpk->jml ?>, color: "#68BC31"},
					{ label: "LHP BPKP (<?= $lhp_bpkp->jml ?>)",  data: <?= $lhp_bpkp->jml ?>, color: "#E02360"},
					{ label: "LHP APIP Kementerian (<?= $lhp_apip_kementerian->jml ?>)",  data: <?= $lhp_apip_kementerian->jml ?>, color: "#F9DC27"},
					{ label: "LHP APIP Provinsi (<?= $lhp_apip_provinsi->jml ?>)",  data: <?= $lhp_apip_provinsi->jml ?>, color: "#5920CF"},
					{ label: "LHP APIP Kota Pariaman (<?= $lhp_apip_kota_pariaman->jml ?>)",  data: <?= $lhp_apip_kota_pariaman->jml ?>, color: "#2091CF"},
				  ]
				drawPieChart(placeholder3, data3);

			  function drawPieChart(placeholder, data, position) {
			 	  $.plot(placeholder, data, {
					series: {
						pie: {
							show: true,
							tilt:0.8,
							highlight: {
								opacity: 0.25
							},
							stroke: {
								color: '#fff',
								width: 2
							},
							startAngle: 2
						}
					},
					legend: {
						show: true,
						position: position || "ne", 
						labelBoxBorderColor: null,
						margin:[-30,15]
					}
					,
					grid: {
						hoverable: true,
						clickable: true
					}
				 })
			 }
			 drawPieChart(placeholder, data);
			 var $tooltip = $("<div class='tooltip top in'><div class='tooltip-inner'></div></div>").hide().appendTo('body');
			  var previousPoint = null;
			
			  placeholder.on('plothover', function (event, pos, item) {
				if(item) {
					if (previousPoint != item.seriesIndex) {
						previousPoint = item.seriesIndex;
						var tip = item.series['label'] + " : " + item.series['percent']+'%';
						$tooltip.show().children(0).text(tip);
					}
					$tooltip.css({top:pos.pageY + 10, left:pos.pageX + 10});
				} else {
					$tooltip.hide();
					previousPoint = null;
				}
			});
			placeholder2.on('plothover', function (event, pos, item) {
				if(item) {
					if (previousPoint != item.seriesIndex) {
						previousPoint = item.seriesIndex;
						var tip = item.series['label'] + " : " + item.series['percent']+'%';
						$tooltip.show().children(0).text(tip);
					}
					$tooltip.css({top:pos.pageY + 10, left:pos.pageX + 10});
				} else {
					$tooltip.hide();
					previousPoint = null;
				}
			});

			placeholder3.on('plothover', function (event, pos, item) {
				if(item) {
					if (previousPoint != item.seriesIndex) {
						previousPoint = item.seriesIndex;
						var tip = item.series['label'] + " : " + item.series['percent']+'%';
						$tooltip.show().children(0).text(tip);
					}
					$tooltip.css({top:pos.pageY + 10, left:pos.pageX + 10});
				} else {
					$tooltip.hide();
					previousPoint = null;
				}
			});
				
			
			
			})
		</script>

	</body>
</html>