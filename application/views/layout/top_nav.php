	</head>
	<body class="no-skin">
		<div id="navbar" class="navbar navbar-default ace-save-state">
			<div class="navbar-container ace-save-state" id="navbar-container">
				<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
					<span class="sr-only">Toggle sidebar</span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>
				</button>

				<div class="navbar-header pull-left">
					<a class="navbar-brand">
						<small>
							<img src="<?= base_url(); ?>assets/images/logo.png" width="24" height="25">
							PEMERINTAH KOTA PARIAMAN
						</small>
					</a>
				</div>

				<div class="navbar-buttons navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">

					<!-- notifikasi -->
						<!-- Inspektur -->
						<?php if($level['level']=='inspektur') { ?>
						<li class="grey dropdown-modal">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<!-- jika tidak ada notifikasi -->
								<?php if($jml_notif->jml_tgs < 1) { ?>
									<i class="ace-icon fa fa-envelope"></i>
								<!-- jika ada notifikasi penugasan baru -->
								<?php } else { ?>
									<i class="ace-icon fa fa-envelope faa-tada animated"></i>
									<span class="badge badge-important"><?= $jml_notif->jml_tgs; ?></span>
								<?php } ?>
							</a>

							<ul class="dropdown-menu-right dropdown-navbar navbar-grey dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header red">
									<i class="ace-icon fa fa-exclamation-triangle red"></i>
									<?= $jml_notif->jml_tgs ." Penugasan baru"; ?>
								</li>

								<li class="dropdown-content">
									<ul class="dropdown-menu dropdown-navbar">
									<?php
										//-> jika tidak ada penugasan baru
										if($jml_notif->jml_tgs < 1) {
											echo "<center>Tidak ada penugasan baru!</center>";
										}
										//-> jika ada penugasan baru
										else
										{
											foreach($notif as $row) {
												$isi  = substr($row->program_peng,0,17);
												$key  = base64_encode($row->id_tugas);
												$key2 = base64_encode($row->id_tim);

												echo "
													<li>
														<a href='"; echo site_url('inspektur/penugasan/detail_penugasan/'.$key.'/'.$key2). "' title='$row->program_peng'>
															<div class='clearfix'>
																<span class='pull-left'>
																	<i class='fa fa-hand-o-right'></i>
																	$isi..
																</span>
																<span class='pull-right'> $row->tgl_tgs </span>
															</div>
														</a>
													</li>
												";
											}
										}
									?>
									</ul>
								</li>

								<li class="dropdown-footer">
									<a href="<?= site_url('inspektur/penugasan'); ?>">
										Lihat semua penugasan
										<i class="ace-icon fa fa-arrow-right"></i>
									</a>
								</li>
							</ul>
						</li>

						<!-- STAFF ADMINISTRASI -->
						<?php } elseif($level['level']=='staff') { ?>
						<li class="grey dropdown-modal">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<!-- jika tidak ada notifikasi -->
								<?php if($jml_notif->jml_tgs < 1) { ?>
									<i class="ace-icon fa fa-envelope"></i>
								<!-- jika ada notifikasi penugasan baru -->
								<?php } else { ?>
									<i class="ace-icon fa fa-envelope faa-tada animated"></i>
									<span class="badge badge-important"><?= $jml_notif->jml_tgs; ?></span>
								<?php } ?>
							</a>

							<ul class="dropdown-menu-right dropdown-navbar navbar-grey dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header red">
									<i class="ace-icon fa fa-exclamation-triangle red"></i>
									<?= $jml_notif->jml_tgs ." Hasil keputusan baru"; ?>
								</li>

								<li class="dropdown-content">
									<ul class="dropdown-menu dropdown-navbar">
									<?php
										//-> jika tidak ada penugasan baru
										if($jml_notif->jml_tgs < 1) {
											echo "<center>Tidak ada penugasan baru!</center>";
										}
										//-> jika ada penugasan baru
										else
										{
											foreach($notif as $row) {
												$isi  = substr($row->program_peng,0,17);
												$key  = base64_encode($row->id_tugas);
												$key2 = base64_encode($row->id_tim);

												echo "
													<li>
														<a href='"; echo site_url('staff/penugasan/detail_penugasan/'.$key.'/'.$key2). "' title='$row->program_peng'>
															<div class='clearfix'>
																<span class='pull-left'>
																	<i class='fa fa-hand-o-right'></i>
																	$isi..
																</span>
																<span class='pull-right'> $row->tgl_tgs </span>
															</div>
														</a>
													</li>
												";
											}
										}
									?>
									</ul>
								</li>

								<li class="dropdown-footer">
									<a href="<?= site_url('staff/penugasan'); ?>">
										Lihat semua penugasan
										<i class="ace-icon fa fa-arrow-right"></i>
									</a>
								</li>
							</ul>
						</li>

						<!-- ADUM -->
						<?php } elseif($level['level']=='adum') { ?>

						<!-- NOTIF TEMUAN -->
						<li class="purple dropdown-modal">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#" title="Notifikasi Anggaran Waktu">
								<?php if($jml_notif_temuan->jml_temuan < 1) { ?>
									<i class="ace-icon fa fa-envelope"></i>
								<?php } else { ?>
									<i class="ace-icon fa fa-envelope faa-tada animated"></i>
									<span class="badge badge-important"><?= $jml_notif_temuan->jml_temuan; ?></span>
								<?php } ?>
							</a>

							<ul class="dropdown-menu-right dropdown-navbar navbar-grey dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header red">
									<i class="ace-icon fa fa-exclamation-triangle red"></i>
									<?= $jml_notif_temuan->jml_temuan ." Temuan baru"; ?>
								</li>

								<li class="dropdown-content">
									<ul class="dropdown-menu dropdown-navbar">
									<?php
										if($jml_notif_temuan->jml_temuan < 1) {
											echo "<center>Tidak ada temuan baru!</center>";
										}
										else
										{
											foreach($notif_temuan as $row) {
												$isi  = substr($row->instansi,0,17);
												$key  = $row->id_temuan;

												echo "
													<li>
														<a href='"; echo site_url('adum/temuan/detail_temuan/'.$key). "' title='$row->instansi'>
															<div class='clearfix'>
																<span class='pull-left'>
																	<i class='fa fa-hand-o-right'></i>
																	$isi..
																</span>
																<span class='pull-right'> $row->tgl_tbh </span>
															</div>
														</a>
													</li>
												";
											}
										}
									?>
									</ul>
								</li>

								<li class="dropdown-footer">
									<a href="<?= site_url('ketua_tim/anggaran_waktu'); ?>">
										Lihat semua anggaran waktu
										<i class="ace-icon fa fa-arrow-right"></i>
									</a>
								</li>
							</ul>
						</li>

						<li class="grey dropdown-modal">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<!-- jika tidak ada notifikasi -->
								<?php if($jml_notif->jml_tgs < 1) { ?>
									<i class="ace-icon fa fa-envelope"></i>
								<!-- jika ada notifikasi penugasan baru -->
								<?php } else { ?>
									<i class="ace-icon fa fa-envelope faa-tada animated"></i>
									<span class="badge badge-important"><?= $jml_notif->jml_tgs; ?></span>
								<?php } ?>
							</a>
							<ul class="dropdown-menu-right dropdown-navbar navbar-grey dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header red">
									<i class="ace-icon fa fa-exclamation-triangle red"></i>
									<?= $jml_notif->jml_tgs ." Penugasan baru"; ?>
								</li>

								<li class="dropdown-content">
									<ul class="dropdown-menu dropdown-navbar">
									<?php
										//-> jika tidak ada penugasan baru
										if($jml_notif->jml_tgs < 1) {
											echo "<center>Tidak ada penugasan baru!</center>";
										}
										//-> jika ada penugasan baru
										else
										{
											foreach($notif as $row) {
												$isi  = substr($row->program_peng,0,17);
												$key  = base64_encode($row->id_tugas);
												$key2 = base64_encode($row->id_tim);

												echo "
													<li>
														<a href='"; echo site_url('adum/penugasan/detail_penugasan/'.$key.'/'.$key2). "' title='$row->program_peng'>
															<div class='clearfix'>
																<span class='pull-left'>
																	<i class='fa fa-hand-o-right'></i>
																	$isi..
																</span>
																<span class='pull-right'> $row->tgl_tgs </span>
															</div>
														</a>
													</li>
												";
											}
										}
									?>
									</ul>
								</li>

								<li class="dropdown-footer">
									<a href="<?= site_url('adum/penugasan'); ?>">
										Lihat semua penugasan
										<i class="ace-icon fa fa-arrow-right"></i>
									</a>
								</li>
							</ul>
						</li>

						<!-- SEKRETARIS -->
						<?php } elseif($level['level']=='sekretaris') { ?>
						<li class="grey dropdown-modal">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<!-- jika tidak ada notifikasi -->
								<?php if($jml_notif->jml_tgs < 1) { ?>
									<i class="ace-icon fa fa-envelope"></i>
								<!-- jika ada notifikasi penugasan baru -->
								<?php } else { ?>
									<i class="ace-icon fa fa-envelope faa-tada animated"></i>
									<span class="badge badge-important"><?= $jml_notif->jml_tgs; ?></span>
								<?php } ?>
							</a>

							<ul class="dropdown-menu-right dropdown-navbar navbar-grey dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header red">
									<i class="ace-icon fa fa-exclamation-triangle red"></i>
									<?= $jml_notif->jml_tgs ." Penugasan baru"; ?>
								</li>

								<li class="dropdown-content">
									<ul class="dropdown-menu dropdown-navbar">
									<?php
										//-> jika tidak ada penugasan baru
										if($jml_notif->jml_tgs < 1) {
											echo "<center>Tidak ada penugasan baru!</center>";
										}
										//-> jika ada penugasan baru
										else
										{
											foreach($notif as $row) {
												$isi  = substr($row->program_peng,0,17);
												$key  = base64_encode($row->id_tugas);
												$key2 = base64_encode($row->id_tim);

												echo "
													<li>
														<a href='"; echo site_url('sekretaris/penugasan/detail_penugasan/'.$key.'/'.$key2). "' title='$row->program_peng'>
															<div class='clearfix'>
																<span class='pull-left'>
																	<i class='fa fa-hand-o-right'></i>
																	$isi..
																</span>
																<span class='pull-right'> $row->tgl_tgs </span>
															</div>
														</a>
													</li>
												";
											}
										}
									?>
									</ul>
								</li>

								<li class="dropdown-footer">
									<a href="<?= site_url('sekretaris/penugasan'); ?>">
										Lihat semua penugasan
										<i class="ace-icon fa fa-arrow-right"></i>
									</a>
								</li>
							</ul>
						</li>

						<!-- KETUA TIM -->
						<?php } elseif($level['level']=='ketua_tim') { ?>

						<!-- NOTIF PENUGASAN -->
						<li class="grey dropdown-modal">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#" title="Notifikasi Penugasan">
								<!-- jika tidak ada notifikasi -->
								<?php if($jml_notif->jml_tgs < 1) { ?>
									<i class="ace-icon fa fa-envelope"></i>
								<!-- jika ada notifikasi penugasan baru -->
								<?php } else { ?>
									<i class="ace-icon fa fa-envelope faa-tada animated"></i>
									<span class="badge badge-grey"><?= $jml_notif->jml_tgs; ?></span>
								<?php } ?>
							</a>

							<ul class="dropdown-menu-right dropdown-navbar navbar-grey dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header red">
									<i class="ace-icon fa fa-exclamation-triangle red"></i>
									<?= $jml_notif->jml_tgs ." Penugasan baru"; ?>
								</li>

								<li class="dropdown-content">
									<ul class="dropdown-menu dropdown-navbar">
									<?php
										//-> jika tidak ada penugasan baru
										if($jml_notif->jml_tgs < 1) {
											echo "<center>Tidak ada penugasan baru!</center>";
										}
										//-> jika ada penugasan baru
										else
										{
											foreach($notif as $row) {
												$isi  = substr($row->program_peng,0,17);
												$key  = base64_encode($row->id_tugas);
												$key2 = base64_encode($row->id_tim);

												echo "
													<li>
														<a href='"; echo site_url('ketua_tim/penugasan/detail_penugasan/'.$key.'/'.$key2). "' title='$row->program_peng'>
															<div class='clearfix'>
																<span class='pull-left'>
																	<i class='fa fa-hand-o-right'></i>
																	$isi..
																</span>
																<span class='pull-right'> $row->tgl_tgs </span>
															</div>
														</a>
													</li>
												";
											}
										}
									?>
									</ul>
								</li>

								<li class="dropdown-footer">
									<a href="<?= site_url('ketua_tim/penugasan'); ?>">
										Lihat semua penugasan
										<i class="ace-icon fa fa-arrow-right"></i>
									</a>
								</li>
							</ul>
						</li>

						<!-- NOTIF ANGGARAN WAKTU -->
						<li class="purple dropdown-modal">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#" title="Notifikasi Anggaran Waktu">
								<!-- jika tidak ada notifikasi -->
								<?php if($jml_notifAgr->jml_agr < 1) { ?>
									<i class="ace-icon fa fa-envelope"></i>
								<!-- jika ada notifikasi penugasan baru -->
								<?php } else { ?>
									<i class="ace-icon fa fa-envelope faa-tada animated"></i>
									<span class="badge badge-important"><?= $jml_notifAgr->jml_agr; ?></span>
								<?php } ?>
							</a>

							<ul class="dropdown-menu-right dropdown-navbar navbar-grey dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header red">
									<i class="ace-icon fa fa-exclamation-triangle red"></i>
									<?= $jml_notifAgr->jml_agr ." Anggaran Waktu baru"; ?>
								</li>

								<li class="dropdown-content">
									<ul class="dropdown-menu dropdown-navbar">
									<?php
										//-> jika tidak ada penugasan baru
										if($jml_notifAgr->jml_agr < 1) {
											echo "<center>Tidak ada anggaran waktu baru!</center>";
										}
										//-> jika ada penugasan baru
										else
										{
											foreach($notifAgr as $row) {
												$isi  = substr($row->program_peng,0,17);
												$key  = base64_encode($row->id_anggaran_wkt);

												echo "
													<li>
														<a href='"; echo site_url('ketua_tim/anggaran_waktu/detail_anggaran_waktu/'.$key). "' title='$row->program_peng'>
															<div class='clearfix'>
																<span class='pull-left'>
																	<i class='fa fa-hand-o-right'></i>
																	$isi..
																</span>
																<span class='pull-right'> $row->tgl_agr </span>
															</div>
														</a>
													</li>
												";
											}
										}
									?>
									</ul>
								</li>

								<li class="dropdown-footer">
									<a href="<?= site_url('ketua_tim/anggaran_waktu'); ?>">
										Lihat semua anggaran waktu
										<i class="ace-icon fa fa-arrow-right"></i>
									</a>
								</li>
							</ul>
						</li>

						<!-- NOTIF PKA -->
						<li class="green dropdown-modal">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#" title="Notifikasi Program Kerja Audit">
								<!-- jika tidak ada notifikasi -->
								<?php if($jml_notifPka->jml_pka < 1) { ?>
									<i class="ace-icon fa fa-envelope"></i>
								<!-- jika ada notifikasi penugasan baru -->
								<?php } else { ?>
									<i class="ace-icon fa fa-envelope faa-tada animated"></i>
									<span class="badge badge-success"><?= $jml_notifPka->jml_pka; ?></span>
								<?php } ?>
							</a>

							<ul class="dropdown-menu-right dropdown-navbar navbar-grey dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header red">
									<i class="ace-icon fa fa-exclamation-triangle red"></i>
									<?= $jml_notifPka->jml_pka ." PKA baru"; ?>
								</li>

								<li class="dropdown-content">
									<ul class="dropdown-menu dropdown-navbar">
									<?php
										//-> jika tidak ada penugasan baru
										if($jml_notifPka->jml_pka < 1) {
											echo "<center>Tidak ada PKA baru!</center>";
										}
										//-> jika ada penugasan baru
										else
										{
											foreach($notifPka as $row) {
												$isi  = substr($row->program_peng,0,17);
												$key  = base64_encode($row->id_pka);

												echo "
													<li>
														<a href='"; echo site_url('ketua_tim/pka/detail_pka/'.$key). "' title='$row->program_peng'>
															<div class='clearfix'>
																<span class='pull-left'>
																	<i class='fa fa-hand-o-right'></i>
																	$isi..
																</span>
																<span class='pull-right'> $row->tgl_pka </span>
															</div>
														</a>
													</li>
												";
											}
										}
									?>
									</ul>
								</li>

								<li class="dropdown-footer">
									<a href="<?= site_url('ketua_tim/pka'); ?>">
										Lihat semua PKA
										<i class="ace-icon fa fa-arrow-right"></i>
									</a>
								</li>
							</ul>
						</li>

						<!-- DALTU -->
						<?php //} elseif($level['level']=='daltu') { ?>

						<!-- NOTIF ANGGARAN WAKTU -->
						<!-- <li class="grey dropdown-modal">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#" title="Notifikasi Anggaran Waktu">
								<?php if($jml_notif->jml_agr < 1) { ?>
									<i class="ace-icon fa fa-envelope"></i>
								<?php } else { ?>
									<i class="ace-icon fa fa-envelope faa-tada animated"></i>
									<span class="badge badge-grey"><?= $jml_notif->jml_agr; ?></span>
								<?php } ?>
							</a>

							<ul class="dropdown-menu-right dropdown-navbar navbar-grey dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header red">
									<i class="ace-icon fa fa-exclamation-triangle red"></i>
									<?= $jml_notif->jml_agr ." Anggaran baru"; ?>
								</li>

								<li class="dropdown-content">
									<ul class="dropdown-menu dropdown-navbar">
									<?php
										if($jml_notif->jml_agr < 1) {
											echo "<center>Tidak ada anggaran baru!</center>";
										}
										else
										{
											foreach($notif as $row) {
												$isi  = substr($row->program_peng,0,17);
												$key  = base64_encode($row->id_anggaran_wkt);

												echo "
													<li>
														<a href='"; echo site_url('daltu/anggaran_waktu/detail_anggaran_waktu/'.$key). "' title='$row->program_peng'>
															<div class='clearfix'>
																<span class='pull-left'>
																	<i class='fa fa-hand-o-right'></i>
																	$isi..
																</span>
																<span class='pull-right'> $row->tgl_agr </span>
															</div>
														</a>
													</li>
												";
											}
										}
									?>
									</ul>
								</li>

								<li class="dropdown-footer">
									<a href="<?= site_url('daltu/anggaran_waktu'); ?>">
										Lihat semua anggaran waktu
										<i class="ace-icon fa fa-arrow-right"></i>
									</a>
								</li>
							</ul>
						</li> -->

						<!-- NOTIF PKA -->
						<!-- <li class="purple dropdown-modal">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#" title="Notifikasi Program Kerja Audit">
								<?php if($jml_notifPka->jml_pka < 1) { ?>
									<i class="ace-icon fa fa-envelope"></i>
								<?php } else { ?>
									<i class="ace-icon fa fa-envelope faa-tada animated"></i>
									<span class="badge badge-important"><?= $jml_notifPka->jml_pka; ?></span>
								<?php } ?>
							</a>

							<ul class="dropdown-menu-right dropdown-navbar navbar-grey dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header red">
									<i class="ace-icon fa fa-exclamation-triangle red"></i>
									<?= $jml_notifPka->jml_pka ." PKA baru"; ?>
								</li>

								<li class="dropdown-content">
									<ul class="dropdown-menu dropdown-navbar">
									<?php
										if($jml_notifPka->jml_pka < 1) {
											echo "<center>Tidak ada PKA baru!</center>";
										}
										else
										{
											foreach($notifPka as $row) {
												$isi  = substr($row->program_peng,0,17);
												$key  = base64_encode($row->id_pka);

												echo "
													<li>
														<a href='"; echo site_url('daltu/pka/detail_pka/'.$key). "' title='$row->program_peng'>
															<div class='clearfix'>
																<span class='pull-left'>
																	<i class='fa fa-hand-o-right'></i>
																	$isi..
																</span>
																<span class='pull-right'> $row->tgl_pka </span>
															</div>
														</a>
													</li>
												";
											}
										}
									?>
									</ul>
								</li>

								<li class="dropdown-footer">
									<a href="<?= site_url('daltu/pka'); ?>">
										Lihat semua PKA
										<i class="ace-icon fa fa-arrow-right"></i>
									</a>
								</li>
							</ul>
						</li> -->

						<!-- DALNIS -->
						<?php } elseif($level['level']=='dalnis') { ?>

						<!-- NOTIF ANGGARAN WAKTU -->
						<li class="grey dropdown-modal">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#" title="Notifikasi Anggaran Waktu">
								<!-- jika tidak ada notifikasi -->
								<?php if($jml_notif->jml_agr < 1) { ?>
									<i class="ace-icon fa fa-envelope"></i>
								<!-- jika ada notifikasi penugasan baru -->
								<?php } else { ?>
									<i class="ace-icon fa fa-envelope faa-tada animated"></i>
									<span class="badge badge-grey"><?= $jml_notif->jml_agr; ?></span>
								<?php } ?>
							</a>

							<ul class="dropdown-menu-right dropdown-navbar navbar-grey dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header red">
									<i class="ace-icon fa fa-exclamation-triangle red"></i>
									<?= $jml_notif->jml_agr ." Anggaran baru"; ?>
								</li>

								<li class="dropdown-content">
									<ul class="dropdown-menu dropdown-navbar">
									<?php
										//-> jika tidak ada penugasan baru
										if($jml_notif->jml_agr < 1) {
											echo "<center>Tidak ada anggaran baru!</center>";
										}
										//-> jika ada penugasan baru
										else
										{
											foreach($notif as $row) {
												$isi  = substr($row->program_peng,0,17);
												$key  = base64_encode($row->id_anggaran_wkt);

												echo "
													<li>
														<a href='"; echo site_url('dalnis/anggaran_waktu/detail_anggaran_waktu/'.$key). "' title='$row->program_peng'>
															<div class='clearfix'>
																<span class='pull-left'>
																	<i class='fa fa-hand-o-right'></i>
																	$isi..
																</span>
																<span class='pull-right'> $row->tgl_agr </span>
															</div>
														</a>
													</li>
												";
											}
										}
									?>
									</ul>
								</li>

								<li class="dropdown-footer">
									<a href="<?= site_url('dalnis/anggaran_waktu'); ?>">
										Lihat semua anggaran waktu
										<i class="ace-icon fa fa-arrow-right"></i>
									</a>
								</li>
							</ul>
						</li>

						<!-- NOTIF PKA -->
						<li class="purple dropdown-modal">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#" title="Notifikasi Program Kerja Audit">
								<!-- jika tidak ada notifikasi -->
								<?php if($jml_notifPka->jml_pka < 1) { ?>
									<i class="ace-icon fa fa-envelope"></i>
								<!-- jika ada notifikasi penugasan baru -->
								<?php } else { ?>
									<i class="ace-icon fa fa-envelope faa-tada animated"></i>
									<span class="badge badge-important"><?= $jml_notifPka->jml_pka; ?></span>
								<?php } ?>
							</a>

							<ul class="dropdown-menu-right dropdown-navbar navbar-grey dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header red">
									<i class="ace-icon fa fa-exclamation-triangle red"></i>
									<?= $jml_notifPka->jml_pka ." PKA baru"; ?>
								</li>

								<li class="dropdown-content">
									<ul class="dropdown-menu dropdown-navbar">
									<?php
										//-> jika tidak ada penugasan baru
										if($jml_notifPka->jml_pka < 1) {
											echo "<center>Tidak ada PKA baru!</center>";
										}
										//-> jika ada penugasan baru
										else
										{
											foreach($notifPka as $row) {
												$isi  = substr($row->program_peng,0,17);
												$key  = base64_encode($row->id_pka);

												echo "
													<li>
														<a href='"; echo site_url('dalnis/pka/detail_pka/'.$key). "' title='$row->program_peng'>
															<div class='clearfix'>
																<span class='pull-left'>
																	<i class='fa fa-hand-o-right'></i>
																	$isi..
																</span>
																<span class='pull-right'> $row->tgl_pka </span>
															</div>
														</a>
													</li>
												";
											}
										}
									?>
									</ul>
								</li>

								<li class="dropdown-footer">
									<a href="<?= site_url('dalnis/pka'); ?>">
										Lihat semua PKA
										<i class="ace-icon fa fa-arrow-right"></i>
									</a>
								</li>
							</ul>
						</li>

						<?php } elseif($level['level']=='evlap') { ?>
						<li class="grey dropdown-modal">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<?php if($jml_notif->jml_temuan < 1) { ?>
									<i class="ace-icon fa fa-envelope"></i>
								<?php } else { ?>
									<i class="ace-icon fa fa-envelope faa-tada animated"></i>
									<span class="badge badge-important"><?= $jml_notif->jml_temuan; ?></span>
								<?php } ?>
							</a>

							<ul class="dropdown-menu-right dropdown-navbar navbar-grey dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header red">
									<i class="ace-icon fa fa-exclamation-triangle red"></i>
									<?= $jml_notif->jml_temuan ." Temuan baru"; ?>
								</li>

								<li class="dropdown-content">
									<ul class="dropdown-menu dropdown-navbar">
									<?php
										//-> jika tidak ada penugasan baru
										if($jml_notif->jml_temuan < 1) {
											echo "<center>Tidak ada temuan baru!</center>";
										}
										//-> jika ada penugasan baru
										else
										{
											foreach($notif as $row) {
												$isi  = substr($row->instansi,0,17);
												$key  = $row->id_temuan;

												echo "
													<li>
														<a href='"; echo site_url('evlap/temuan/detail_temuan/'.$row->id_temuan). "' title='$row->instansi'>
															<div class='clearfix'>
																<span class='pull-left'>
																	<i class='fa fa-hand-o-right'></i>
																	$isi..
																</span>
																<span class='pull-right'> $row->tgl_tbh </span>
															</div>
														</a>
													</li>
												";
											}
										}
									?>
									</ul>
								</li>

								<li class="dropdown-footer">
									<a href="<?= site_url('evlap/temuan'); ?>">
										Lihat semua temuan
										<i class="ace-icon fa fa-arrow-right"></i>
									</a>
								</li>
							</ul>
						</li>

						<?php } ?>
					<!-- ./notifikasi -->

						<li class="light-blue dropdown-modal">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<img class="nav-user-photo" src="<?php echo base_url(); ?>assets/images/user.png" alt="Jason's Photo" />
								<span class="user-info">
									<small>Selamat Datang,</small>
									<?php echo $user['username']; ?>
								</span>

								<i class="ace-icon fa fa-caret-down"></i>
							</a>

							<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">

								<!-- profil -->

								<!-- ADMIN -->
								<?php if($level['level']=='adm') { ?>
								<li>
									<a href="<?= site_url('adm/home/profil/'. base64_encode($user['username'])); ?>">
										<i class="ace-icon fa fa-user"></i>
										Profil
									</a>
								</li>

								<li class="divider"></li>
								<?php } ?>

								<!-- Inspektur -->
								<?php if($level['level']=='inspektur') { ?>
								<!-- <li>
									<a href="<?php echo site_url('inspektur/home/profil/'.$user['username']); ?>">
										<i class="ace-icon fa fa-user"></i>
										Profile
									</a>
								</li> -->

								<li>
									<a href="<?= site_url('inspektur/home/profil/'. base64_encode($user['username'])); ?>">
										<i class="ace-icon fa fa-user"></i>
										Profil
									</a>
								</li>

								<li class="divider"></li>
								<?php } ?>

								<!-- STAFF ADMIISTRASI -->
								<?php if($level['level']=='staff') { ?>
								<li>
									<a href="<?= site_url('staff/home/profil/'. base64_encode($user['username'])); ?>">
										<i class="ace-icon fa fa-user"></i>
										Profil
									</a>
								</li>

								<li class="divider"></li>
								<?php } ?>

								<!-- ADUM -->
								<?php if($level['level']=='adum') { ?>
								<li>
									<a href="<?= site_url('adum/home/profil/'. base64_encode($user['username'])); ?>">
										<i class="ace-icon fa fa-user"></i>
										Profil
									</a>
								</li>

								<li class="divider"></li>
								<?php } ?>

								<!-- SEKRETARIS -->
								<?php if($level['level']=='sekretaris') { ?>
								<li>
									<a href="<?= site_url('sekretaris/home/profil/'. base64_encode($user['username'])); ?>">
										<i class="ace-icon fa fa-user"></i>
										Profil
									</a>
								</li>

								<li class="divider"></li>
								<?php } ?>

								<!-- DALNIS -->
								<?php if($level['level']=='dalnis') { ?>
								<li>
									<a href="<?= site_url('dalnis/home/profil/'. base64_encode($user['username'])); ?>">
										<i class="ace-icon fa fa-user"></i>
										Profil
									</a>
								</li>

								<li class="divider"></li>
								<?php } ?>

								<!-- DALTU-->
								<?php if($level['level']=='daltu') { ?>
								<li>
									<a href="<?= site_url('daltu/home/profil/'. base64_encode($user['username'])); ?>">
										<i class="ace-icon fa fa-user"></i>
										Profil
									</a>
								</li>

								<li class="divider"></li>
								<?php } ?>

								<!-- KETUA TIM -->
								<?php if($level['level']=='ketua_tim') { ?>
								<li>
									<a href="<?= site_url('ketua_tim/home/profil/'. base64_encode($user['username'])); ?>">
										<i class="ace-icon fa fa-user"></i>
										Profil
									</a>
								</li>

								<li class="divider"></li>
								<?php } ?>

								<!-- ANGGOTA TIM -->
								<?php if($level['level']=='anggota_tim') { ?>
								<li>
									<a href="<?= site_url('anggota_tim/home/profil/'. base64_encode($user['username'])); ?>">
										<i class="ace-icon fa fa-user"></i>
										Profil
									</a>
								</li>

								<li class="divider"></li>
								<?php } ?>

								<!-- KETUA TL -->
								<?php if($level['level']=='ketua_tl') { ?>
								<li>
									<a href="<?= site_url('ketua_tl/home/profil/'. base64_encode($user['username'])); ?>">
										<i class="ace-icon fa fa-user"></i>
										Profil
									</a>
								</li>

								<li class="divider"></li>
								<?php } ?>

								<!-- ANGGOTA TL -->
								<?php if($level['level']=='anggota_tl') { ?>
								<li>
									<a href="<?= site_url('anggota_tl/home/profil/'. base64_encode($user['username'])); ?>">
										<i class="ace-icon fa fa-user"></i>
										Profil
									</a>
								</li>

								<li class="divider"></li>
								<?php } ?>


								<!-- Staff Evlap -->
								<?php if($level['level']=='staff_evlap') { ?>
								<li>
									<a href="<?= site_url('staff_evlap/home/profil/'. base64_encode($user['username'])); ?>">
										<i class="ace-icon fa fa-user"></i>
										Profil
									</a>
								</li>

								<li class="divider"></li>
								<?php } ?>

								<!-- Evlap -->
								<?php if($level['level']=='evlap') { ?>
								<li>
									<a href="<?= site_url('evlap/home/profil/'. base64_encode($user['username'])); ?>">
										<i class="ace-icon fa fa-user"></i>
										Profil
									</a>
								</li>

								<li class="divider"></li>
								<?php } ?>

								<li>
									<a href="<?php echo site_url('log_in/logout'); ?>">
										<i class="ace-icon fa fa-sign-out"></i>
										Logout
									</a>
								</li>

							</ul>
						</li>
					</ul>
				</div>
			</div><!-- /.navbar-container -->
		</div>