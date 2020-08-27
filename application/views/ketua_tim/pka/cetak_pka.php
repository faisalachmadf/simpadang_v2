<!DOCTYPE html>
<html>
  <head>
		<meta charset="utf-8" />
		<link rel="icon" type="image/png" href="./assets/images/icon.png">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

		<title> Program Kerja Audit : <?= $data->nama_op; ?> </title>

		<!-- Bootstrap -->
		<style type="text/css">
		  body { font-family: 'Work Sans', sans-serif;}
			th {padding: 3px; text-align: center}
			td {padding: 2px; font-size: 13}

			.kop_header {margin-top:5px; border-bottom: 3px double #000}
			.j {text-align: justify}
			.c {text-align: center}
			.i {font-style: italic}
			.r {text-align: right}
			.b {font-weight: bold}
			.u {text-decoration: underline}
			.pad-5 {padding: 5px}
			.pad-3 {padding: 3px}
			.pad-top-10 {padding-top: 13px}
			.pad-b-5 {margin-bottom: -25px}
			.pad-l-30 {padding-left: 30px}
			.pos-atas {vertical-align: top}
			.pos-bawah {vertical-align: bottom}
			.ls-5 {letter-spacing: 5px}

			.color-bag {background-color: #bababa}

			.style-head {border:1px solid white}
			.border-top {border-top:1px solid black}
			.border-bot {border-bottom:1px solid black}
			.border-left {border-left:1px solid black}
			.border-right {border-right:1px solid black}

			.f10 {font-size: 10}
			.f15 {font-size: 15}
			.f16 {font-size: 16}
			.f18 {font-size: 18}
			.f21 {font-size: 24}
			.f23 {font-size: 23}
			.f27 {font-size: 27}
		</style>
  </head>

	<body>

		<table width="35%" border='1'>
			<tr>
				<td class='c'>PEMERINTAH KOTA PARIAMAN</td>
			</tr>
			<tr>
				<td class='c'>INSPEKTORAT</td>
			</tr>
		</table>

		<h5 class='u c b'> PROGRAM KERJA PEMERIKSAAN </h5>

		<div style="float: left; width: 55%">
		<table width="100%" border='0'>
			<tr>
				<td width="30%" class="pos-atas"> Nama Objek Pemeriksaan </td>
				<td width="3%" class="c pos-atas"> : </td>
				<td class="j pos-atas"> <?= $data->nama_op; ?> </td>
			</tr>

			<tr>
				<td class="pos-atas"> Sasaran </td>
				<td class="c pos-atas"> : </td>
				<td class="j pos-atas"> <?= $data->sasaran_peng; ?> </td>
			</tr>

			<tr>
				<td class="pos-atas"> Masa yang diperiksa </td>
				<td class="c pos-atas"> : </td>
				<td class="j pos-atas"> <?= $data->masa_periksa; ?> </td>
			</tr>

			<tr>
				<td class="pos-atas"> Waktu Pemeriksaan </td>
				<td class="c pos-atas"> : </td>
				<td class="j pos-atas"> <?= $tgl_awal ." s.d. ". $tgl_akhir; ?> </td>
			</tr>
		</table>
		</div>

		<div style="float: right; width: 40%">
		<table width="100%" border='0'>
			<tr>
				<td width="32%" class="pos-atas"> Ref. PKP No. </td>
				<td width="3%" class="c pos-atas"> : </td>
				<td class="j pos-atas"> <?= $data->no_ref_pka; ?> </td>
			</tr>

			<tr>
				<td class="pos-atas"> Disusun Oleh </td>
				<td class="c pos-atas"> : </td>
				<td> <?= $ketua_tim->nama; ?> </td>
			</tr>
		</table>
		</div>

		<div style="clear:both"></div> <br/>

		<table width="100%" rules="none" border="1" cellspacing="0">
			<tr class="bot-bor">
				<td width="8%" class="c pad-10 color-bag style-head border-left border-top border-bot" rowspan="2"> No </td>
				<td width="30%" class="c pad-10 color-bag style-head border-top border-bot" rowspan="2"> U r a i a n </td>
				<td class="c pad-10 color-bag style-head border-top" colspan="2"> Dilaksanakan Oleh </td>
				<td class="c pad-10 color-bag style-head border-top" colspan="2"> Waktu Pemeriksaan </td>
				<td width="9%" class="c pad-10 color-bag style-head border-top border-bot" rowspan="2"> No. KKP </td>
				<td width="7%" class="c pad-10 color-bag style-head border-right border-top border-bot" rowspan="2"> KET </td>
			</tr>

			<tr>
				<td width="15%" class="c pad-10 color-bag style-head border-bot"> Rencana </td>
				<td width="15%" class="c pad-10 color-bag style-head border-bot"> Realisasi </td>
				<td width="9%" class="c pad-10 color-bag style-head border-bot"> Rencana </td>
				<td width="9%" class="c pad-10 color-bag style-head border-bot"> Realisasi </td>
			</tr>
		</table>

		<table width="100%" rules="none" border="1" cellspacing="0">
			<!-- <tr class="bot-bor">
				<td width="4%" class="c pad-10 color-bag style-head border-left border-top border-bot" rowspan="2"> No </td>
				<td width="30%" class="c pad-10 color-bag style-head border-top border-bot" rowspan="2"> U r a i a n </td>
				<td width="30%" class="c pad-10 color-bag style-head border-top" colspan="2"> Dilaksanakan Oleh </td>
				<td width="12%" class="c pad-10 color-bag style-head border-top" colspan="2"> Waktu Pemeriksaan </td>
				<td width="9%" class="c pad-10 color-bag style-head border-top border-bot" rowspan="2"> No. KKP </td>
				<td width="7%" class="c pad-10 color-bag style-head border-right border-top border-bot" rowspan="2"> KET </td>
			</tr>

			<tr>
				<td width="15%" class="c pad-10 color-bag style-head border-bot"> Rencana </td>
				<td width="15%" class="c pad-10 color-bag style-head border-bot"> Realisasi </td>
				<td width="9%" class="c pad-10 color-bag style-head border-bot"> Rencana </td>
				<td width="9%" class="c pad-10 color-bag style-head border-bot"> Realisasi </td>
			</tr> -->

			<tr>
				<td width="4%"></td>
				<td width="4%"></td>
				<td></td>
				<td width="15%"></td>
				<td width="15%"></td>
				<td width="9%"></td>
				<td width="8%"></td>
				<td width="9%"></td>
				<td width="7%"></td>
			</tr>
			
			<tr>
				<td class="b border-left"> </td>
				<td class="b u border-right" colspan="2" > TUJUAN PROGRAM KERJA AUDIT </td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>

			<?php 
				$no = 1;
				foreach($sub1 as $row)
				{
					if($row->tujuan_pka != NULL)
					{
						echo "
						<tr>
							<td class='r pos-atas'> $no. </td>
							<td colspan='8'> $row->tujuan_pka </td>
						</tr>";
						$no++;
					}														
				}
			?>
			
			<tr><td colspan='9' class='border-left border-right'>&nbsp;</td></tr>

			<tr>
				<td class="b border-left"> 1. </td>
				<td class="b u border-right" colspan="2" > PERSIAPAN PENGAWASAN </td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>

			<?php
				//-> KONDISI LEBIH DARI 1 INSTANSI
				if(count($sasaran) != 0)
				{
					$abj_ins1 = 'A';
					$no_ins1  = 1;
					foreach ($ins as $key)
					{
						echo "
						<tr>
							<td class='b r border-left'> $abj_ins1). </td>
							<td class='b border-right' colspan='2'> $key->nama_instansi </td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>";

						$no1 = 1;
						foreach($sub1 as $row)
						{
							if($row->kategori == "1" && $row->nama_instansi == $key->nama_instansi)
							{
								echo "
								<tr>
									<td> </td>
									<td class='b pos-atas'> $no1). </td>
									<td class='b'> $row->jenis_pekerjaan </td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>

								<tr>
									<td></td>
									<td class='i c'> A. </td>
									<td class='i'> Tujuan Pemeriksaan </td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								";

								$abjadA = 'a';
								foreach($sub2 as $row3)
								{
									if($row3->kode_uraian == "$no_ins1-$no1-A")
									{
										echo "
										<tr>
											<tr>
												<td></td>
												<td class='r pos-atas'> $abjadA. </td>
												<td> $row3->uraian </td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
											</tr>
										</tr>
										";
										$abjadA = chr(ord($abjadA)+1);
									}
								}

								echo "
								<tr>
									<td></td>
									<td class='i c'> B. </td>
									<td class='i'> Langkah Pemeriksaan </td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								";

								$abjadB = 'a';
								foreach($sub2 as $row3)
								{
									$tgl = date('d-m-Y', strtotime($row3->tgl_kerja));
									if($row3->kode_uraian == "$no_ins1-$no1-B")
									{
										echo "
										<tr>
											<tr>
												<td></td>
												<td class='r pos-atas'> $abjadB. </td>
												<td class='pos-atas'> $row3->uraian </td>
												<td class='f10'>";
													$no_plk = 1;
													foreach($sub3 as $row4)
													{
														if($row4->sub_no_kka == $row3->no_kka)
														{
															echo "$no_plk. $row4->nama <br/>";
															$no_plk++;
														}
													}
												echo "</td>
												<td></td>
												<td class='c f10 pos-atas'> $tgl </td>
												<td></td>
												<td class='c f10 pos-atas'> $row3->no_kka </td>
												<td class='f10 pos-atas'> $row3->keterangan </td>
											</tr>
										</tr>
										";
										$abjadB = chr(ord($abjadB)+1);
									}
								}

								$no1++;
								$no2 = $no1;
							}
						}

						echo "<tr><td colspan='9' class='border-left border-right'>&nbsp;</td></tr>";

						$abj_ins1 = chr(ord($abj_ins1)+1);
						$no_ins1++;
					}
				}

				//-> KONDISI 1 INSTANSI
				else
				{
					$no1 = 1;
					foreach($sub1 as $row)
					{
						if($row->kategori == "1")
						{
							echo "
							<tr>
								<td class='b r pos-atas'> $no1). </td>
								<td class='b' colspan='2'> $row->jenis_pekerjaan </td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>

							<tr>
								<td></td>
								<td class='i c'> A. </td>
								<td class='i'> Tujuan Pemeriksaan </td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							";

							$abjadA = 'a';
							foreach($sub2 as $row3)
							{
								if($row3->kode_uraian == "$no1-A")
								{
									echo "
									<tr>
										<tr>
											<td></td>
											<td class='r pos-atas'> $abjadA. </td>
											<td> $row3->uraian </td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
										</tr>
									</tr>
									";
									$abjadA = chr(ord($abjadA)+1);
								}
							}

							echo "
							<tr>
								<td></td>
								<td class='i c'> B. </td>
								<td class='i'> Langkah Pemeriksaan </td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							";

							$abjadB = 'a';
							foreach($sub2 as $row3)
							{
								$tgl = date('d-m-Y', strtotime($row3->tgl_kerja));
								if($row3->kode_uraian == "$no1-B")
								{
									echo "
									<tr>
										<tr>
											<td></td>
											<td class='r pos-atas'> $abjadB. </td>
											<td class='pos-atas'> $row3->uraian </td>
											<td class='f10'>";
												$no_plk = 1;
												foreach($sub3 as $row4)
												{
													if($row4->sub_no_kka == $row3->no_kka)
													{
														echo "$no_plk. $row4->nama <br/>";
														$no_plk++;
													}
												}
											echo "</td>
											<td></td>
											<td class='c f10 pos-atas'> $tgl </td>
											<td></td>
											<td class='c f10 pos-atas'> $row3->no_kka </td>
											<td class='f10 pos-atas'> $row3->keterangan </td>
										</tr>
									</tr>
									";
									$abjadB = chr(ord($abjadB)+1);
								}
							}

							$no1++;
							$no2 = $no1;
						}
					}
				}

				##########################################
				//--> BATAS KATEGORI 
				##########################################

				echo "
				<tr><td colspan='9'> &nbsp; </td></tr>
				<tr>
					<td class='b'> 2. </td>
					<td colspan='8' class='b u'> PELAKSANAAN PENGAWASAN </td>
				</tr>";

				//-> KONDISI LEBIH DARI 1 INSTANSI
				if(count($sasaran) != 0)
				{
					$abj_ins1 = 'A';
					$no_ins1  = 1;
					foreach ($ins as $key)
					{
						echo "
						<tr>
							<td class='b r border-left'> $abj_ins1). </td>
							<td class='b border-right' colspan='2'> $key->nama_instansi </td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>";

						$no1 = 1;
						foreach($sub1 as $row)
						{
							if($row->kategori == "2" && $row->nama_instansi == $key->nama_instansi)
							{
								echo "
								<tr>
									<td> </td>
									<td class='b pos-atas'> $no1). </td>
									<td class='b'> $row->jenis_pekerjaan </td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>

								<tr>
									<td></td>
									<td class='i c'> A. </td>
									<td class='i'> Tujuan Pemeriksaan </td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								";

								$abjadA = 'a';
								foreach($sub2 as $row3)
								{
									if($row3->kode_uraian == "$no_ins1-$no2-A")
									{
										echo "
										<tr>
											<tr>
												<td></td>
												<td class='r pos-atas'> $abjadA. </td>
												<td> $row3->uraian </td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
											</tr>
										</tr>
										";
										$abjadA = chr(ord($abjadA)+1);
									}
								}

								echo "
								<tr>
									<td></td>
									<td class='i c'> B. </td>
									<td class='i'> Langkah Pemeriksaan </td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								";

								$abjadB = 'a';
								foreach($sub2 as $row3)
								{
									$tgl = date('d-m-Y', strtotime($row3->tgl_kerja));
									if($row3->kode_uraian == "$no_ins1-$no2-B")
									{
										echo "
										<tr>
											<tr>
												<td></td>
												<td class='r pos-atas'> $abjadB. </td>
												<td class='pos-atas'> $row3->uraian </td>
												<td class='f10'>";
													$no_plk = 1;
													foreach($sub3 as $row4)
													{
														if($row4->sub_no_kka == $row3->no_kka)
														{
															echo "$no_plk. $row4->nama <br/>";
															$no_plk++;
														}
													}
												echo "</td>
												<td></td>
												<td class='c f10 pos-atas'> $tgl </td>
												<td></td>
												<td class='c f10 pos-atas'> $row3->no_kka </td>
												<td class='f10 pos-atas'> $row3->keterangan </td>
											</tr>
										</tr>
										";
										$abjadB = chr(ord($abjadB)+1);
									}
								}

								$no1++;
								$no2++;
								$no3 = $no2;
							}
						}

						echo "<tr><td colspan='9' class='border-left border-right'>&nbsp;</td></tr>";

						$abj_ins1 = chr(ord($abj_ins1)+1);
						$no_ins1++;
					}
				}

				//-> KONDISI 1 INSTANSI
				else
				{
					$no1 = 1;
					foreach($sub1 as $row)
					{
						if($row->kategori == "2")
						{
							echo "
							<tr>
								<td class='b r pos-atas'> $no1). </td>
								<td class='b' colspan='2'> $row->jenis_pekerjaan </td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>

							<tr>
								<td></td>
								<td class='i c'> A. </td>
								<td class='i'> Tujuan Pemeriksaan </td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							";

							$abjadA = 'a';
							foreach($sub2 as $row3)
							{
								if($row3->kode_uraian == "$no2-A")
								{
									echo "
									<tr>
										<tr>
											<td></td>
											<td class='r pos-atas'> $abjadA. </td>
											<td> $row3->uraian </td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
										</tr>
									</tr>
									";
									$abjadA = chr(ord($abjadA)+1);
								}
							}

							echo "
							<tr>
								<td></td>
								<td class='i c'> B. </td>
								<td class='i'> Langkah Pemeriksaan </td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							";

							$abjadB = 'a';
							foreach($sub2 as $row3)
							{
								$tgl = date('d-m-Y', strtotime($row3->tgl_kerja));
								if($row3->kode_uraian == "$no2-B")
								{
									echo "
									<tr>
										<tr>
											<td></td>
											<td class='r pos-atas'> $abjadB. </td>
											<td class='pos-atas'> $row3->uraian </td>
											<td class='f10'>";
												$no_plk = 1;
												foreach($sub3 as $row4)
												{
													if($row4->sub_no_kka == $row3->no_kka)
													{
														echo "$no_plk. $row4->nama <br/>";
														$no_plk++;
													}
												}
											echo "</td>
											<td></td>
											<td class='c f10 pos-atas'> $tgl </td>
											<td></td>
											<td class='c f10 pos-atas'> $row3->no_kka </td>
											<td class='f10 pos-atas'> $row3->keterangan </td>
										</tr>
									</tr>
									";
									$abjadB = chr(ord($abjadB)+1);
								}
							}

							$no1++;
							$no2++;
							$no3 = $no2;
						}
					}
				}

				##########################################
				//--> BATAS KATEGORI 
				##########################################

				echo "
				<tr><td colspan='9'> &nbsp; </td></tr>
				<tr>
					<td class='b'> 3. </td>
					<td colspan='8' class='b u'> PENYELESAIAN PENGAWASAN </td>
				</tr>";

				//-> KONDISI LEBIH DARI 1 INSTANSI
				if(count($sasaran) != 0)
				{
					$abj_ins1 = 'A';
					$no_ins1  = 1;
					foreach ($ins as $key)
					{
						echo "
						<tr>
							<td class='b r border-left'> $abj_ins1). </td>
							<td class='b border-right' colspan='2'> $key->nama_instansi </td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>";

						$no1 = 1;
						foreach($sub1 as $row)
						{
							if($row->kategori == "3" && $row->nama_instansi == $key->nama_instansi)
							{
								echo "
								<tr>
									<td> </td>
									<td class='b pos-atas'> $no1). </td>
									<td class='b'> $row->jenis_pekerjaan </td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>

								<tr>
									<td></td>
									<td class='i c'> A. </td>
									<td class='i'> Tujuan Pemeriksaan </td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								";

								$abjadA = 'a';
								foreach($sub2 as $row3)
								{
									if($row3->kode_uraian == "$no_ins1-$no3-A")
									{
										echo "
										<tr>
											<tr>
												<td></td>
												<td class='r pos-atas'> $abjadA. </td>
												<td> $row3->uraian </td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
											</tr>
										</tr>
										";
										$abjadA = chr(ord($abjadA)+1);
									}
								}

								echo "
								<tr>
									<td></td>
									<td class='i c'> B. </td>
									<td class='i'> Langkah Pemeriksaan </td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								";

								$abjadB = 'a';
								foreach($sub2 as $row3)
								{
									$tgl = date('d-m-Y', strtotime($row3->tgl_kerja));
									if($row3->kode_uraian == "$no_ins1-$no3-B")
									{
										echo "
										<tr>
											<tr>
												<td></td>
												<td class='r pos-atas'> $abjadB. </td>
												<td class='pos-atas'> $row3->uraian </td>
												<td class='f10'>";
													$no_plk = 1;
													foreach($sub3 as $row4)
													{
														if($row4->sub_no_kka == $row3->no_kka)
														{
															echo "$no_plk. $row4->nama <br/>";
															$no_plk++;
														}
													}
												echo "</td>
												<td></td>
												<td class='c f10 pos-atas'> $tgl </td>
												<td></td>
												<td class='c f10 pos-atas'> $row3->no_kka </td>
												<td class='f10 pos-atas'> $row3->keterangan </td>
											</tr>
										</tr>
										";
										$abjadB = chr(ord($abjadB)+1);
									}
								}

								$no1++;
								$no3++;
							}
						}

						echo "<tr><td colspan='9' class='border-left border-right'>&nbsp;</td></tr>";

						$abj_ins1 = chr(ord($abj_ins1)+1);
						$no_ins1++;
					}
				}

				//-> KONDISI 1 INSTANSI
				else
				{
					$no1 = 1;
					foreach($sub1 as $row)
					{
						if($row->kategori == "3")
						{
							echo "
							<tr>
								<td class='b r pos-atas'> $no1). </td>
								<td class='b' colspan='2'> $row->jenis_pekerjaan </td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>

							<tr>
								<td></td>
								<td class='i c'> A. </td>
								<td class='i'> Tujuan Pemeriksaan </td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							";

							$abjadA = 'a';
							foreach($sub2 as $row3)
							{
								if($row3->kode_uraian == "$no3-A")
								{
									echo "
									<tr>
										<tr>
											<td></td>
											<td class='r pos-atas'> $abjadA. </td>
											<td> $row3->uraian </td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
										</tr>
									</tr>
									";
									$abjadA = chr(ord($abjadA)+1);
								}
							}

							echo "
							<tr>
								<td></td>
								<td class='i c'> B. </td>
								<td class='i'> Langkah Pemeriksaan </td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							";

							$abjadB = 'a';
							foreach($sub2 as $row3)
							{
								$tgl = date('d-m-Y', strtotime($row3->tgl_kerja));
								if($row3->kode_uraian == "$no3-B")
								{
									echo "
									<tr>
										<tr>
											<td></td>
											<td class='r pos-atas'> $abjadB. </td>
											<td class='pos-atas'> $row3->uraian </td>
											<td class='f10'>";
												$no_plk = 1;
												foreach($sub3 as $row4)
												{
													if($row4->sub_no_kka == $row3->no_kka)
													{
														echo "$no_plk. $row4->nama <br/>";
														$no_plk++;
													}
												}
											echo "</td>
											<td></td>
											<td class='c f10 pos-atas'> $tgl </td>
											<td></td>
											<td class='c f10 pos-atas'> $row3->no_kka </td>
											<td class='f10 pos-atas'> $row3->keterangan </td>
										</tr>
									</tr>
									";
									$abjadB = chr(ord($abjadB)+1);
								}
							}

							$no1++;
							$no3++;
						}
					}
				}
			?>			 
		</table> <br/>

		<table width="100%" border="0">
			<tr>
				<td width="33%" class="c"> Pariaman, <?= $tgl_dn; ?> </td>
				<td></td>
				<td width="33%" class="c"> Pariaman, <?= $tgl_pka; ?> </td>
			</tr>

			<tr>
				<td class="c"> Pengendali Teknis </td>
				<td></td>
				<td class="c"> Ketua Tim </td>
			</tr>

			<tr><td colspan="3">&nbsp;</td></tr>
			<tr><td colspan="3">&nbsp;</td></tr>
			<tr><td colspan="3">&nbsp;</td></tr>

			<tr>
				<td class="c u"> <?= $dalnis->nama; ?> </td>
				<td></td>
				<td class="c u"> <?= $ketua_tim->nama; ?> </td>
			</tr>

			<tr>
				<td class="c"> NIP. <?= $dalnis->nip; ?> </td>
				<td></td>
				<td class="c"> NIP. <?= $ketua_tim->nip; ?> </td>
			</tr>

			<tr>
				<td></td>
				<td class="c"> Pariaman, <?= $tgl_dn; ?> </td>
				<td></td>
			</tr>

			<tr>
				<td></td>
				<td class="c"> Wakil Penanggung Jawab </td>
				<td></td>
			</tr>

			<tr><td colspan="3">&nbsp;</td></tr>
			<tr><td colspan="3">&nbsp;</td></tr>
			<tr><td colspan="3">&nbsp;</td></tr>

			<tr>
				<td></td>
				<td class="c u"> <?= $daltu->nama; ?> </td>
				<td></td>
			</tr>

			<tr>
				<td></td>
				<td class="c"> NIP. <?= $daltu->nip; ?> </td>
				<td></td>
			</tr>
		</table>
	</body>
</html>