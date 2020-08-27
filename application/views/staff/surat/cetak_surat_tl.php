<!DOCTYPE html>
<html>
  <head>
		<meta charset="utf-8" />
		<link rel="icon" type="image/png" href="./assets/images/icon.png">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

		<title> Surat Tugas Tindak Lanjut : <?= $data->no_surat; ?> </title>

		<!-- Bootstrap -->
		<style type="text/css">
		  body { font-family: 'Work Sans', sans-serif;}
			th {padding: 3px; text-align: center}
			td {padding: 2px}

			.kop_header {margin-top:5px; border-bottom: 3px double #000}
			.j {text-align: justify}
			.c {text-align: center}
			.b {font-weight: bold}
			.u {text-decoration: underline}
			.pad-10 {padding: 10px}
			.pad-top-10 {padding-top: 13px}
			.pad-b-5 {margin-bottom: -25px}
			.pad-l-30 {padding-left: 30px}
			.pos-atas {vertical-align: top}
			.pos-bawah {vertical-align: bottom}
			.ls-5 {letter-spacing: 5px}

			.f11 {font-size: 13}
			.f15 {font-size: 15}
			.f16 {font-size: 16}
			.f18 {font-size: 18}
			.f21 {font-size: 24}
			.f23 {font-size: 23}
			.f27 {font-size: 27}
		</style>
  </head>

<?php function Terbilang($x)
{
  $bil = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
  if ($x < 12)
    return "" . $bil[$x];
  elseif ($x < 20)
    return Terbilang($x - 10) . "belas";
  elseif ($x < 100)
    return Terbilang($x / 10) . " puluh" . Terbilang($x % 10);
  elseif ($x < 200)
    return " seratus" . Terbilang($x - 100);
  elseif ($x < 1000)
    return Terbilang($x / 100) . " ratus" . Terbilang($x % 100);
  elseif ($x < 2000)
    return " seribu" . Terbilang($x - 1000);
  elseif ($x < 1000000)
    return Terbilang($x / 1000) . " ribu" . Terbilang($x % 1000);
  elseif ($x < 1000000000)
    return Terbilang($x / 1000000) . " juta" . Terbilang($x % 1000000);
}
?>

	<body>
		<table width="100%">
			<thead>
				<tr>
					<th width="16%"></th>
					<th></th>
				</tr>
			</thead>

			<tbody>
				<tr>
					<td class="c"><img src="./assets/images/logo2.png" width="85" height="91"></td>
					<td class="c b">
						<p class="f21"> PEMERINTAH KOTA PARIAMAN </p>
						<p class="f27"> INSPEKTORAT </p>
						<p class="f11"> Jalan Rohana Kudus No. 44. Telp. (0751) 93652, Fax. (0751) 91557 </p>
					</td>
				</tr>
			</tbody>
		</table>

		<div class="kop_header"></div> 

		<p class="f16 b c u pad-b-5"> SURAT PERINTAH TINDAK LANJUT </p> <br/>
		<p class="f15 c">Nomor : <?= $data->no_surat; ?></p>

		<p class="f16 c"> INSPEKTUR KOTA PARIAMAN </p>

		<table width="100%" border="0">
			<thead>
				<tr>
					<th width="13%"></th>
					<th width="4%" ></th>
					<th></th>
					<th width="3%"></th>
					<th></th>
					<th width="35%"></th>
					<th width="10%"></th>
				</tr>
			</thead>

			<tbody>
				<tr>
					<td class="pos-atas"> Berdasarkan </td>
					<td class="pos-atas">:</td>
					<td colspan="5" align="justify"><?= $data->dasar_surat; ?></td>
				</tr>

				<tr>
					<td colspan="7" class="c pad-10"> MEMERINTAHKAN : </td>
				</tr>

				<tr>
					<td class="pos-atas"> Kepada </td>
					<td class="pos-atas">:</td>
					<td colspan="5">
						<table width="100%" border="0">
							
							<tr>
								<td width="3%">1. </td>
								<td><?= $ketua_tim->nama; ?></td>
								<td width="5%"> : </td>
								<td width="25%" class="c"> Ketua Tim </td>
							</tr>

							<?php
								foreach($tim as $row)
								{
									$no = $row->nomor+1;
									if($row->anggota != NULL)
									{ echo "
										<tr>
											<td width='3%'> $no. </td>
											<td> $row->nama </td>
											<td width='5%'> : </td>
											<td width='25%' class='c'> Anggota Tim </td>
										</tr>";
									}
								}
							?>
						</table>
					</td>
				</tr>

				<tr><td colspan="7">&nbsp;</td></tr>

				<tr>
					<td class="pos-atas"> Untuk </td>
					<td class="pos-atas">:</td>
					<td colspan="5" align="justify"><?= $data->untuk; ?></td>
				</tr>
				
				<tr><td colspan="7">&nbsp;</td></tr>

				<tr>
					<td class="pos-atas"> Sasaran </td>
					<td class="pos-atas">:</td>
					<td colspan="5" align="justify">
						<table width="100%" border="0">
							<?php
								if($data->stat_sasaran == "pilih")
								{
									if($jml_sas->jml < 6)
									{
										foreach($sasaran as $row)
										{
											if($row->sasaran != NULL)
											{
												echo "
												<tr>
													<td width='3%'> $row->nomor. </td>
													<td> $row->sasaran </td>
												</tr>";
											}
										}
									}
									else
									{
										echo "
										<tr>
											<td colspan='2'> $data->sasaran_peng </td>
										</tr>";
									}
								} 
								else
								{
									echo "
									<tr>
										<td colspan='2'> $data->sasaran_peng </td>
									</tr>";
								}
							?>
						</table>
					</td>
				</tr>
				
				<tr><td colspan="7">&nbsp;</td></tr>

				<?php $lma = Terbilang($lama_wkt); $lama = ucwords($lma) ?>
				<tr>
					<td class="pos-atas"> Waktu </td>
					<td class="pos-atas">:</td>
					<td colspan="5" align="justify">Tanggal <?= $tgl_awal ." - ". $tgl_akhir ." $lama_wkt ($lama) "; ?> Hari Kerja.</td>
				</tr>

				<tr><td colspan="7">&nbsp;</td></tr>
				<tr><td colspan="7">&nbsp;</td></tr>
				
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td>DIKELUARKAN DI : P A R I A M A N</td>
					<td></td>
				</tr>

				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td class="u">PADA TANGGAL &nbsp;&nbsp;  : <?= $tgl_surat; ?></td>
					<td></td>
				</tr>

				<tr><td colspan="7">&nbsp;</td></tr>

				<tr>
					<td colspan="5"></td>
					<td colspan="2" class="c">INSPEKTUR,</td>
				</tr>

				<?php if($data->ttd==NULL){ ?>
				<tr><td colspan="7">&nbsp;</td></tr>
				<tr><td colspan="7">&nbsp;</td></tr>
				<tr><td colspan="7">&nbsp;</td></tr>
				<?php } else { ?>
				<tr>
					<td colspan="5"></td>
					<td class="c"><img src="./assets/verifikasi/<?= $data->ttd; ?>" width="210" height="90"></td>
					<td></td>
				</tr>
				<?php } ?>			

				<tr>
					<td colspan="5"></td>
					<td colspan="2" class="c u b"><?= $data->nama_inspektur; ?></td>
				</tr>

				<tr>
					<td colspan="5"></td>
					<td colspan="2" class="c">NIP. <?= $data->nip_inspektur; ?></td>
				</tr>

				<?php
					foreach($tembusan as $row)
					{
						if(($row->nomor == "1") && ($row->tembusan != NULL))
						{
							echo "
								<tr>
									<td colspan='7' class='b'>Tembusan :</td>
								</tr>

								<tr>
									<td></td>
									<td colspan='6' class='u'></td>
								</tr>
							";
						}

						if($row->tembusan != NULL)
						{
						echo "
							<tr>
								<td colspan='7'>$row->nomor. $row->tembusan</td>
							</tr>
						";
						}
					}
				?>
			</tbody>
		</table>

		<!-- ################## -->
		<!-- #### NEW PAGE #### -->
		<!-- ################## -->

		<?php
			if($data->stat_sasaran == "pilih")
			{
				if($jml_sas->jml > 5)
				{ 
		?>

		<pagebreak resetpagenum="1" pagenumstyle="1" suppress="" />

		<table width="100%" border="0">
			<tr>
				<td></td>
				<td width="24%">&nbsp;</td>
				<td width="24%"></td>
			</tr>

			<tr>
				<td class="b u">LAMPIRAN</td>
				<td colspan="2" align="right">Nomor Surat Tugas : <?= $data->no_surat; ?></td>
			</tr>

			<tr><td colspan="3">&nbsp;</td></tr>

			<tr><td colspan="3">Berikut nama-nama instansi yang menjadi sasaran pengawasan :</td></tr>

			<tr>
				<?php 
				foreach($sasaran as $row)
				{
					if($row->sasaran != NULL)
					{
						echo "
						<tr><td colspan='3' class='pad-l-30'> $row->nomor. $row->sasaran </td></tr>";
					}
				} ?>
			</tr>

			<tr><td colspan="3">&nbsp;</td></tr>

			<tr>
				<td></td>
				<td colspan="2">DIKELUARKAN DI : P A R I A M A N</td>
			</tr>

			<tr>
				<td></td>
				<td colspan="2" class="u">PADA TANGGAL &nbsp;&nbsp;  : <?= $tgl_surat; ?></td>
			</tr>

			<tr><td colspan="3">&nbsp;</td></tr>

			<tr>
				<td></td>
				<td colspan="2" class="c">INSPEKTUR,</td>
			</tr>

			<?php if($data->ttd==NULL){ ?>
				<tr><td colspan="3">&nbsp;</td></tr>
				<tr><td colspan="3">&nbsp;</td></tr>
				<tr><td colspan="3">&nbsp;</td></tr>
				<?php } else { ?>
				<tr>
					<td></td>
					<td colspan="2" class="c"><img src="./assets/verifikasi/<?= $data->ttd; ?>" width="210" height="80"></td>
				</tr>
				<?php } ?>

			<tr>
				<td></td>
				<td colspan="2" class="c u b"><?= $data->nama_inspektur; ?></td>
			</tr>

			<tr>
				<td></td>
				<td colspan="2" class="c">NIP. <?= $data->nip_inspektur; ?></td>
			</tr>
		</table>

		<?php	}	}	?>		

		<!-- jQuery -->
		<script src="<?php echo base_url(); ?>assets/js/jquery-2.1.4.min.js"></script>
		<!-- Bootstrap -->
		<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
	</body>
</html>