<!DOCTYPE html>
<html>
  <head>
		<meta charset="utf-8" />
		<link rel="icon" type="image/png" href="<?php echo base_url(); ?>assets/images/icon.png">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

		<title> Program Kerja Audit : <?= $data->nama_op; ?> </title>

		<!-- Bootstrap -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" />
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

		<div style="float: left; width: 50%">
		<table width="100%" border='1'>
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

		<!-- <div style="float: right; width: 40%">
		<table width="100%" border='1'>
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
		</div> -->

		<div style="clear:both"></div> <br/>

		<table width="100%" rules="none" border="0">
			<tr class="bot-bor">
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
			</tr>

			<tr>
				<td class="b border-left"> 1. </td>
				<td colspan='7' class="b u border-right"> PERSIAPAN PENGAWASAN </td>
			</tr>

			<?php
				$no1 = 1;
				foreach($sub1 as $row)
				{
					if($row->kategori == "1")
					{
						echo "
						<tr>
							<td class='r border-left'> $no1). </td>
							<td class='b border-right' colspan='7'> $row->jenis_pekerjaan </td>
						</tr>

						<tr>
							<td class='border-left'></td>
							<td class='i'> A. Tujuan Pemeriksaan </td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td class='border-right'></td>
						</tr>";

						$abjadA = 'a';
						foreach($sub2 as $row3)
						{
							$tgl = date('d-m-Y', strtotime($row3->tgl_kerja));
							if($row3->kode_uraian == "$no1-A")
							{																	
								echo "
								<tr>
									<td colspan='8' class='border-left border-right'>
									<table width='100%' border='0'>
										<tr>
											<td width='7%' class='r pos-atas'> $abjadA. </td>
											<td class='pos-atas'> $row3->uraian </td>
											<td width='16%' class='f10'>";
												$no_plk = 1;
												foreach($sub3 as $row4)
												{
													if($row4->sub_no_kka == $row3->no_kka)
													{
														echo "$no_plk. $row4->nama<br/>";
														$no_plk++;
													}
												}
											echo "</td>
											<td width='15%'></td>
											<td width='9%' class='c f10 pos-atas'> $tgl </td>
											<td width='9%' class='c f10 pos-atas'> </td>
											<td width='9%' class='c pos-atas'> $row3->no_kka </td>
											<td width='7%' class='f10 pos-atas'> $row3->keterangan </td>
										</tr>
									</table>
									</td>
								</tr>
								";
								$abjadA = chr(ord($abjadA)+1);																	
							}																
						}

						echo "
						<tr>
							<td class='border-left'></td>
							<td class='i'> B. Langkah Pemeriksaan </td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td class='border-right'></td>
						</tr>";

						$abjadB = 'a';
						foreach($sub2 as $row3)
						{
							$tgl = date('d-m-Y', strtotime($row3->tgl_kerja));
							if($row3->kode_uraian == "$no1-B")
							{																	
								echo "
								<tr>
									<td colspan='8' class='border-left border-right'>
									<table width='100%' border='0'>
										<tr>
											<td width='7%' class='r pos-atas'> $abjadB. </td>
											<td class='pos-atas'> $row3->uraian </td>
											<td width='16%' class='f10'>";
												$no_plk = 1;
												foreach($sub3 as $row4)
												{
													if($row4->sub_no_kka == $row3->no_kka)
													{
														echo "$no_plk. $row4->nama<br/>";
														$no_plk++;
													}
												}
											echo "</td>
											<td width='15%'></td>
											<td width='9%' class='c f10 pos-atas'> $tgl </td>
											<td width='9%' class='c f10 pos-atas'> </td>
											<td width='9%' class='c pos-atas'> $row3->no_kka </td>
											<td width='7%' class='f10 pos-atas'> $row3->keterangan </td>
										</tr>
									</table>
									</td>
								</tr>
								";
								$abjadB = chr(ord($abjadB)+1);																	
							}																
						}

						echo "
						<tr>
							<td class='border-left'></td>
							<td class='i'> C. Buatkan kesimpulan dalam kertas kerja </td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td class='border-right'></td>
						</tr>";

						$no1++;
					}					
				}

				##########################################
				//--> BATAS KATEGORI 
				##########################################

				echo "
				<tr><td colspan='8' class='border-left border-right'>&nbsp;</td></tr>
				<tr>
					<td class='b border-left'> 2. </td>
					<td colspan='7' class='b u border-right'> PELAKSANAAN PENGAWASAN </td>
				</tr>";

				$no2 = 1;
				$nomor = 1;
				foreach($sub1 as $row)
				{
					if($row->kategori == "2")
					{
						echo "
						<tr>
							<td class='r border-left'> $nomor). </td>
							<td class='b border-right' colspan='7'> $row->jenis_pekerjaan </td>
						</tr>

						<tr>
							<td class='border-left'></td>
							<td class='i'> A. Tujuan Pemeriksaan </td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td class='border-right'></td>
						</tr>";

						$abjadA = 'a';
						foreach($sub2 as $row3)
						{
							$tgl = date('d-m-Y', strtotime($row3->tgl_kerja));
							if($row3->kode_uraian == "$no2-A")
							{																	
								echo "
								<tr>
									<td colspan='8' class='border-left border-right'>
									<table width='100%' border='0'>
										<tr>
											<td width='7%' class='r pos-atas'> $abjadA. </td>
											<td class='pos-atas'> $row3->uraian </td>
											<td width='16%' class='f10'>";
												$no_plk = 1;
												foreach($sub3 as $row4)
												{
													if($row4->sub_no_kka == $row3->no_kka)
													{
														echo "$no_plk. $row4->nama<br/>";
														$no_plk++;
													}
												}
											echo "</td>
											<td width='15%'></td>
											<td width='9%' class='c f10 pos-atas'> $tgl </td>
											<td width='9%' class='c f10 pos-atas'> </td>
											<td width='9%' class='c pos-atas'> $row3->no_kka </td>
											<td width='7%' class='f10 pos-atas'> $row3->keterangan </td>
										</tr>
									</table>
									</td>
								</tr>
								";
								$abjadA = chr(ord($abjadA)+1);																	
							}																
						}

						echo "
						<tr>
							<td class='border-left'></td>
							<td class='i'> B. Langkah Pemeriksaan </td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td class='border-right'></td>
						</tr>";

						$abjadB = 'a';
						foreach($sub2 as $row3)
						{
							$tgl = date('d-m-Y', strtotime($row3->tgl_kerja));
							if($row3->kode_uraian == "$no2-B")
							{																	
								echo "
								<tr>
									<td colspan='8' class='border-left border-right'>
									<table width='100%' border='0'>
										<tr>
											<td width='7%' class='r pos-atas'> $abjadB. </td>
											<td class='pos-atas'> $row3->uraian </td>
											<td width='16%' class='f10'>";
												$no_plk = 1;
												foreach($sub3 as $row4)
												{
													if($row4->sub_no_kka == $row3->no_kka)
													{
														echo "$no_plk. $row4->nama<br/>";
														$no_plk++;
													}
												}
											echo "</td>
											<td width='15%'></td>
											<td width='9%' class='c f10 pos-atas'> $tgl </td>
											<td width='9%' class='c f10 pos-atas'> </td>
											<td width='9%' class='c pos-atas'> $row3->no_kka </td>
											<td width='7%' class='f10 pos-atas'> $row3->keterangan </td>
										</tr>
									</table>
									</td>
								</tr>
								";
								$abjadB = chr(ord($abjadB)+1);																	
							}																
						}

						echo "
						<tr>
							<td class='border-left'></td>
							<td class='i'> C. Buatkan kesimpulan dalam kertas kerja </td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td class='border-right'></td>
						</tr>";

						$nomor++;
					}
					$no2++;
				}

				##########################################
				//--> BATAS KATEGORI 
				##########################################

				echo "
				<tr><td colspan='8' class='border-left border-right'>&nbsp;</td></tr>
				<tr>
					<td class='b border-left'> 3. </td>
					<td colspan='7' class='b u border-right'> PENYELESAIAN PENGAWASAN </td>
				</tr>";

				$no3 = 1;
				$nomor2 = 1;
				foreach($sub1 as $row)
				{
					if($row->kategori == "3")
					{
						echo "
						<tr>
							<td class='r border-left'> $nomor2). </td>
							<td class='b border-right' colspan='7'> $row->jenis_pekerjaan </td>
						</tr>

						<tr>
							<td class='border-left'></td>
							<td class='i'> A. Tujuan Pemeriksaan </td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td class='border-right'></td>
						</tr>";

						$abjadA = 'a';
						foreach($sub2 as $row3)
						{
							$tgl = date('d-m-Y', strtotime($row3->tgl_kerja));
							if($row3->kode_uraian == "$no3-A")
							{																	
								echo "
								<tr>
									<td colspan='8' class='border-left border-right'>
									<table width='100%' border='0'>
										<tr>
											<td width='7%' class='r pos-atas'> $abjadA. </td>
											<td class='pos-atas'> $row3->uraian </td>
											<td width='16%' class='f10'>";
												$no_plk = 1;
												foreach($sub3 as $row4)
												{
													if($row4->sub_no_kka == $row3->no_kka)
													{
														echo "$no_plk. $row4->nama<br/>";
														$no_plk++;
													}
												}
											echo "</td>
											<td width='15%'></td>
											<td width='9%' class='c f10 pos-atas'> $tgl </td>
											<td width='9%' class='c f10 pos-atas'> </td>
											<td width='9%' class='c pos-atas'> $row3->no_kka </td>
											<td width='7%' class='f10 pos-atas'> $row3->keterangan </td>
										</tr>
									</table>
									</td>
								</tr>
								";
								$abjadA = chr(ord($abjadA)+1);																	
							}																
						}

						echo "
						<tr>
							<td class='border-left'></td>
							<td class='i'> B. Langkah Pemeriksaan </td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td class='border-right'></td>
						</tr>";

						$abjadB = 'a';
						foreach($sub2 as $row3)
						{
							$tgl = date('d-m-Y', strtotime($row3->tgl_kerja));
							if($row3->kode_uraian == "$no3-B")
							{																	
								echo "
								<tr>
									<td colspan='8' class='border-left border-right'>
									<table width='100%' border='0'>
										<tr>
											<td width='7%' class='r pos-atas'> $abjadB. </td>
											<td class='pos-atas'> $row3->uraian </td>
											<td width='16%' class='f10'>";
												$no_plk = 1;
												foreach($sub3 as $row4)
												{
													if($row4->sub_no_kka == $row3->no_kka)
													{
														echo "$no_plk. $row4->nama<br/>";
														$no_plk++;
													}
												}
											echo "</td>
											<td width='15%'></td>
											<td width='9%' class='c f10 pos-atas'> $tgl </td>
											<td width='9%' class='c f10 pos-atas'> </td>
											<td width='9%' class='c pos-atas'> $row3->no_kka </td>
											<td width='7%' class='f10 pos-atas'> $row3->keterangan </td>
										</tr>
									</table>
									</td>
								</tr>
								";
								$abjadB = chr(ord($abjadB)+1);																	
							}																
						}

						echo "
						<tr>
							<td class='border-left'></td>
							<td class='i'> C. Buatkan kesimpulan dalam kertas kerja </td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td class='border-right'></td>
						</tr>";

						$nomor2++;
					}
					$no3++;
				}

				echo "<tr><td colspan='8' class='border-left border-right border-bot'></td></tr>"
			?>			 
		</table> <br/>

		<table width="100%" border="0">
			<tr>
				<td width="33%" class="c"> Cianjur, <?= $tgl_dn; ?> </td>
				<td></td>
				<td width="33%" class="c"> Cianjur, <?= $tgl_pka; ?> </td>
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
				<td class="c"> Cianjur, <?= $tgl_dt; ?> </td>
				<td></td>
			</tr>

			<tr>
				<td></td>
				<td class="c"> Pengendali Mutu </td>
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

		<!-- jQuery -->
		<script src="<?php echo base_url(); ?>assets/js/jquery-2.1.4.min.js"></script>
		<!-- Bootstrap -->
		<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
	</body>
</html>