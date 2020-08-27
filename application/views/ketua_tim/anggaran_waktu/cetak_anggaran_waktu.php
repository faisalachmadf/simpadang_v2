<!DOCTYPE html>
<html>
  <head>
		<meta charset="utf-8" />
		<link rel="icon" type="image/png" href="./assets/images/icon.png">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

		<title> Anggaran Waktu Pengawasan : <?= $data->nama_op; ?> </title>

		<!-- Bootstrap -->
		<style type="text/css">
		  body { font-family: 'Work Sans', sans-serif;}
			th {padding: 3px; text-align: center}
			td {padding: 2px; font-size: 13}

			.kop_header {margin-top:5px; border-bottom: 3px double #000}
			.j {text-align: justify}
			.c {text-align: center}
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

			.f11 {font-size: 13}
			.f15 {font-size: 15}
			.f16 {font-size: 16}
			.f18 {font-size: 18}
			.f21 {font-size: 24}
			.f23 {font-size: 23}
			.f27 {font-size: 27}
		</style>
  </head>

	<body>

		<h5> INSPEKTORAT KOTA PARIAMAN </h5>

		<table width="100%" border="0">
			<tr>
				<td width="32%"></td>
				<td width="4%"></td>
				<td></td>
			</tr>

			<tr><td colspan="3" class="u c b"><h5> FORMULIR ANGGARAN WAKTU PENGAWASAN </h5></td></tr>
			<tr><td colspan="3">&nbsp;</td></tr>

			<tr>
				<td class="pos-atas"> Nama Objek Audit </td>
				<td class="c pos-atas"> : </td>
				<td class="j"> <?= $data->nama_op; ?> </td>
			</tr>

			<tr>
				<td class="pos-atas"> Kegiatan/Program yang di Audit </td>
				<td class="c pos-atas"> : </td>
				<td class="j"> <?= $data->nama_kp; ?> </td>
			</tr>
		</table> <br/>

		<table width="100%" border="1">
			<tr>
				<td width="33%" class="c b pad-5"> PERSIAPAN </td>
				<td class="c b pad-5"> PELAKSANAAN </td>
				<td width="33%" class="c b pad-5"> PENYELESAIAN </td>
			</tr>

			<tr>
				<td class="c"> <?= $tgl1_1; if($data->tgl2_persiapan != NULL) { echo " s/d $tgl2_1"; }?> </td>
				<td class="c"> <?= $tgl1_2; if($data->tgl2_pelaksanaan != NULL) { echo " s/d $tgl2_2"; }?> </td>
				<td class="c"> <?= $tgl1_3; if($data->tgl2_penyelesaian != NULL) { echo " s/d $tgl2_3"; }?> </td>
			</tr>
		</table> <br/>

		<table width="100%" border="1">
			<tr>
				<td width="5%" class="c pad-10"> No </td>
				<td class="c pad-10"> Jenis Kegiatan </td>
				<td width="12%" class="c pad-10"> Wakil Penanggung Jawab <br/> (HP/Jam) </td>
				<td width="12%" class="c pad-10"> Pengendali Teknis <br/> (HP/Jam) </td>
				<td width="11%" class="c pad-10"> Ketua Tim (HP/Jam) </td>
				<td width="11%" class="c pad-10"> Anggota (HP/Jam) </td>
				<td width="13%" class="c pad-10"> Jumlah <br/> (HP/Jam) </td>
			</tr>

			<tr><td>1.</td><td colspan="6" class="pad-3">PERSIAPAN AUDIT</td></tr>

			<?php
			$no1 = 1;
			foreach($anggaran as $row)
			{
				if($row->kategori == "1")
				{
					if($row->tugas_daltu == "aktif")
						{	$daltu = $row->hari_daltu ." ( $row->jam_daltu )"; }
					else
						{	$daltu = ""; }

					if($row->tugas_dalnis == "aktif")
						{ $dalnis = $row->hari_dalnis ." ( $row->jam_dalnis )"; }
					else
						{ $dalnis = ""; }

					if($row->tugas_ketua == "aktif")
						{	$ketua = $row->hari_ketua ." ( $row->jam_ketua )"; }
					else
						{ $ketua = ""; }

					if($row->tugas_anggota == "aktif")
						{ $anggota = $row->hari_anggota ." ( $row->jam_anggota )"; }
					else
						{ $anggota = ""; }

					echo "
					<tr>
						<td class='r pos-atas pad-3'> $no1). </td>
						<td class='pad-3'> $row->jenis_pekerjaan </td>
						<td class='pad-3 r'> $daltu </td>
						<td class='pad-3 r'> $dalnis </td>
						<td class='pad-3 r'> $ketua </td>
						<td class='pad-3 r'> $anggota </td>
						<td class='pad-3 r'> $row->jml_hari ( $row->jml_jam ) </td>
					</tr>
					";
					$no_sub = $row->kategori;

					$sh_daltu1 += $row->hari_daltu;
					$sub_jam1 += $row->jam_daltu;
					$sub_jam_daltu1 = number_format($sub_jam1,2);
					if($sh_daltu1 != "0.00")
					{ 
						//$sub_hri_daltu1 = $sh_daltu1;
						$sub_hri_daltu1 = number_format($sh_daltu1,2); 
						$sub_daltu1 = $sub_hri_daltu1 ." ( $sub_jam_daltu1 )";
					}
					else
					{ 
						$sub_hri_daltu1 = ""; 
						$sub_daltu1 = "";
					}

					$sub_hri2 += $row->hari_dalnis;
					$sub_hri_dalnis1 = number_format($sub_hri2,2);
					$sub_jam2 += $row->jam_dalnis;
					$sub_jam_dalnis1 = number_format($sub_jam2,2);

					$sub_hri3 += $row->hari_ketua;
					$sub_hri_ketua1 = number_format($sub_hri3,2);
					$sub_jam3 += $row->jam_ketua;
					$sub_jam_ketua1 = number_format($sub_jam3,2);

					$sub_hri4 += $row->hari_anggota;
					$sub_hri_anggota1 = number_format($sub_hri4,2);
					$sub_jam4 += $row->jam_anggota;
					$sub_jam_anggota1 = number_format($sub_jam4,2);
					
					$sub_hri5 = $sub_hri_daltu1 + $sub_hri_dalnis1 + $sub_hri_ketua1 + $sub_hri_anggota1;
					$sub_hri_1 = number_format($sub_hri5,2);
					$sub_jam5  = $sub_jam_daltu1 + $sub_jam_dalnis1 + $sub_jam_ketua1 + $sub_jam_anggota1;
					$sub_jam_1 = number_format($sub_jam5,2);
				}
				$no1++;														
			}

			echo "
				<tr>
					<td colspan='2' class='pad-3 c'> Sub Jumlah $no_sub </td>
					<td class='r'> $sub_daltu1 </td>
					<td class='r'> $sub_hri_dalnis1 ( $sub_jam_dalnis1 ) </td>
					<td class='r'> $sub_hri_ketua1 ( $sub_jam_ketua1 ) </td>
					<td class='r'> $sub_hri_anggota1 ( $sub_jam_anggota1 ) </td>
					<td class='r'> $sub_hri_1 ( $sub_jam_1 ) </td>
				</tr>

				<tr><td colspan='7'>&nbsp;</td></tr>
				<tr><td>2.</td><td colspan='6'>PELAKSANAAN AUDIT</td></tr>
			";

			$no2 = 1;
			foreach($anggaran as $row)
			{
				if($row->kategori == "2")
				{
					if($row->tugas_daltu == "aktif")
						{	$daltu = $row->hari_daltu ." ( $row->jam_daltu )"; }
					else
						{	$daltu = ""; }

					if($row->tugas_dalnis == "aktif")
						{ $dalnis = $row->hari_dalnis ." ( $row->jam_dalnis )"; }
					else
						{ $dalnis = ""; }

					if($row->tugas_ketua == "aktif")
						{	$ketua = $row->hari_ketua ." ( $row->jam_ketua )"; }
					else
						{ $ketua = ""; }

					if($row->tugas_anggota == "aktif")
						{ $anggota = $row->hari_anggota ." ( $row->jam_anggota )"; }
					else
						{ $anggota = ""; }

					echo "
					<tr>
						<td class='r pos-atas'> $no2). </td>
						<td>$row->jenis_pekerjaan</td>
						<td class='pad-3 r'> $daltu </td>
						<td class='pad-3 r'> $dalnis </td>
						<td class='pad-3 r'> $ketua </td>
						<td class='pad-3 r'> $anggota </td>
						<td class='pad-3 r'> $row->jml_hari ( $row->jml_jam ) </td>
					</tr>
					";
					$no_sub = $row->kategori;

					$sh_daltu2 += $row->hari_daltu;
					$sub_jam11 += $row->jam_daltu;
					$sub_jam_daltu2 = number_format($sub_jam11,2);
					if($sh_daltu2 != "0.00")
					{ 
						//$sub_hri_daltu2 = $sh_daltu2; 
						$sub_hri_daltu2 = number_format($sh_daltu2,2); 
						$sub_daltu2 = $sub_hri_daltu2 ." ( $sub_jam_daltu2 )";
					}
					else
					{ 
						$sub_hri_daltu2 = ""; 
						$sub_daltu2 = "";
					}

					$sub_hri22 += $row->hari_dalnis;
					$sub_hri_dalnis2 = number_format($sub_hri22,2);
					$sub_jam22 += $row->jam_dalnis;
					$sub_jam_dalnis2 = number_format($sub_jam22,2);

					$sub_hri33 += $row->hari_ketua;
					$sub_hri_ketua2 = number_format($sub_hri33,2);
					$sub_jam33 += $row->jam_ketua;
					$sub_jam_ketua2 = number_format($sub_jam33,2);

					$sub_hri44 += $row->hari_anggota;
					$sub_hri_anggota2 = number_format($sub_hri44,2);
					$sub_jam44 += $row->jam_anggota;
					$sub_jam_anggota2 = number_format($sub_jam44,2);

					$sub_hri55 = $sub_hri_daltu2 + $sub_hri_dalnis2 + $sub_hri_ketua2 + $sub_hri_anggota2;
					$sub_hri_2 = number_format($sub_hri55,2);
					$sub_jam55  = $sub_jam_daltu2 + $sub_jam_dalnis2 + $sub_jam_ketua2 + $sub_jam_anggota2;
					$sub_jam_2 = number_format($sub_jam55,2);

					$no2++;
				}																		
			}

			echo "
				<tr>
					<td colspan='2' class='pad-3 c'> Sub Jumlah $no_sub </td>
					<td class='r'> $sub_daltu2 </td>
					<td class='r'> $sub_hri_dalnis2 ( $sub_jam_dalnis2 ) </td>
					<td class='r'> $sub_hri_ketua2 ( $sub_jam_ketua2 ) </td>
					<td class='r'> $sub_hri_anggota2 ( $sub_jam_anggota2 ) </td>
					<td class='r'> $sub_hri_2 ( $sub_jam_2 ) </td>
				</tr>

				<tr><td colspan='7'>&nbsp;</td></tr>
				<tr><td>3.</td><td colspan='6'>PENYELESAIAN AUDIT</td></tr>
			";

			$no3 = 1;
			foreach($anggaran as $row)
			{
				if($row->kategori == "3")
				{
					if($row->tugas_daltu == "aktif")
						{	$daltu = $row->hari_daltu ." ( $row->jam_daltu )"; }
					else
						{	$daltu = ""; }

					if($row->tugas_dalnis == "aktif")
						{ $dalnis = $row->hari_dalnis ." ( $row->jam_dalnis )"; }
					else
						{ $dalnis = ""; }

					if($row->tugas_ketua == "aktif")
						{	$ketua = $row->hari_ketua ." ( $row->jam_ketua )"; }
					else
						{ $ketua = ""; }

					if($row->tugas_anggota == "aktif")
						{ $anggota = $row->hari_anggota ." ( $row->jam_anggota )"; }
					else
						{ $anggota = ""; }

					echo "
					<tr>
						<td class='r pos-atas'> $no3). </td>
						<td>$row->jenis_pekerjaan</td>
						<td class='pad-3 r'> $daltu </td>
						<td class='pad-3 r'> $dalnis </td>
						<td class='pad-3 r'> $ketua </td>
						<td class='pad-3 r'> $anggota </td>
						<td class='pad-3 r'> $row->jml_hari ( $row->jml_jam ) </td>
					</tr>
					";
					$no_sub = $row->kategori;

					$sh_daltu3 += $row->hari_daltu;
					$sub_jam111 += $row->jam_daltu;
					$sub_jam_daltu3 = number_format($sub_jam111,2);
					if($sh_daltu3 != "0.00")
					{ 
						//$sub_hri_daltu3 = $sh_daltu3; 
						$sub_hri_daltu3 = number_format($sh_daltu3,2); 
						$sub_daltu3 = $sub_hri_daltu3 ." ( $sub_jam_daltu3 )";
					}
					else
					{ 
						$sub_hri_daltu3 = ""; 
						$sub_daltu3 = "";
					}

					$sub_hri222 += $row->hari_dalnis;
					$sub_hri_dalnis3 = number_format($sub_hri222,2);
					$sub_jam222 += $row->jam_dalnis;
					$sub_jam_dalnis3 = number_format($sub_jam222,2);

					$sub_hri333 += $row->hari_ketua;
					$sub_hri_ketua3 = number_format($sub_hri333,2);
					$sub_jam333 += $row->jam_ketua;
					$sub_jam_ketua3 = number_format($sub_jam333,2);

					$sub_hri444 += $row->hari_anggota;
					$sub_hri_anggota3 = number_format($sub_hri444,2);
					$sub_jam444 += $row->jam_anggota;
					$sub_jam_anggota3 = number_format($sub_jam444,2);
					
					$sub_hri555 = $sub_hri_daltu3 + $sub_hri_dalnis3 + $sub_hri_ketua3 + $sub_hri_anggota3;
					$sub_hri_3 = number_format($sub_hri555,2);
					$sub_jam555  = $sub_jam_daltu3 + $sub_jam_dalnis3 + $sub_jam_ketua3 + $sub_jam_anggota3;
					$sub_jam_3 = number_format($sub_jam555,2);

					$no3++;
				}																		
			}

				/*$tot_hri_daltu = $sub_hri_daltu1 + $sub_hri_daltu2 + $sub_hri_daltu3;
				$jm_daltu = $sub_jam_daltu1 + $sub_jam_daltu2 + $sub_jam_daltu3;
				$tot_jam_daltu = number_format($jm_daltu,2);*/

				$t_daltu  = $sub_hri_daltu1 + $sub_hri_daltu2 + $sub_hri_daltu3;
				$jm_daltu = $sub_jam_daltu1 + $sub_jam_daltu2 + $sub_jam_daltu3;
				$tot_jam_daltu = number_format($jm_daltu,2);
				if($t_daltu != "0.00")
				{ 
					//$tot_hri_daltu = $t_daltu;
					$tot_hri_daltu = number_format($t_daltu,2);
					$total_daltu = $tot_hri_daltu ." ( $tot_jam_daltu )";
				}
				else
				{ 
					$tot_hri_daltu = ""; 
					$total_daltu = "";
				}

				$hr_dalnis = $sub_hri_dalnis1 + $sub_hri_dalnis2 + $sub_hri_dalnis3;
				$tot_hri_dalnis = number_format($hr_dalnis,2);
				$jm_dalnis = $sub_jam_dalnis1 + $sub_jam_dalnis2 + $sub_jam_dalnis3;
				$tot_jam_dalnis = number_format($jm_dalnis,2);

				$hr_ketua = $sub_hri_ketua1 + $sub_hri_ketua2 + $sub_hri_ketua3;
				$tot_hri_ketua = number_format($hr_ketua,2);
				$jm_ketua = $sub_jam_ketua1 + $sub_jam_ketua2 + $sub_jam_ketua3;
				$tot_jam_ketua = number_format($jm_ketua,2);

				$hr_anggota = $sub_hri_anggota1 + $sub_hri_anggota2 + $sub_hri_anggota3;
				$tot_hri_anggota = number_format($hr_anggota,2);
				$jm_anggota = $sub_jam_anggota1 + $sub_jam_anggota2 + $sub_jam_anggota3;
				$tot_jam_anggota = number_format($jm_anggota,2);

				$tot_hri = $tot_hri_daltu + $tot_hri_dalnis + $tot_hri_ketua + $tot_hri_anggota;
				$jml_tot_hri = number_format($tot_hri,2);
				$tot_jam = $tot_jam_daltu + $tot_jam_dalnis + $tot_jam_ketua + $tot_jam_anggota;
				$jml_tot_jam = number_format($tot_jam,2);
			?>

			<tr>
				<td colspan='2' class='pad-3 c'> <?= "Sub Jumlah ". $no_sub; ?> </td>
				<td class='r'> <?= $sub_daltu3; ?> </td>
				<td class='r'> <?= $sub_hri_dalnis3 ." ( $sub_jam_dalnis3 )"; ?> </td>
				<td class='r'> <?= $sub_hri_ketua3 ." ( $sub_jam_ketua3 )"; ?> </td>
				<td class='r'> <?= $sub_hri_anggota3 ." ( $sub_jam_anggota3 )"; ?> </td>
				<td class='r'> <?= $sub_hri_3 ." ( $sub_jam_3 )"; ?> </td>
			</tr>

			<tr>
				<td colspan="2" class="c"> JUMLAH HARI/JAM AUDIT YANG DIANGGARKAN </td>
				<td class='r'> <?= $total_daltu; ?> </td>
				<td class='r'> <?= $tot_hri_dalnis ." ( $tot_jam_dalnis )"; ?> </td>
				<td class='r'> <?= $tot_hri_ketua ." ( $tot_jam_ketua )"; ?> </td>
				<td class='r'> <?= $tot_hri_anggota ." ( $tot_jam_anggota )"; ?> </td>
				<td class='r'> <?= $jml_tot_hri ." ( $jml_tot_jam )"; ?> </td>
			</tr>
		</table> <br/>

		<table width="100%" border="0">
			<tr>
				<td width="33%" class="c"> Pariaman, <?= $tgl_dn; ?> </td>
				<td></td>
				<td width="33%" class="c"> Pariaman, <?= $tgl_agr; ?> </td>
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
				<td class="c u"> <?= $dalnis_tim->nama; ?> </td>
				<td></td>
				<td class="c u"> <?= $ketua_tim->nama; ?> </td>
			</tr>

			<tr>
				<td class="c"> NIP. <?= $dalnis_tim->nip; ?> </td>
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
				<td class="c u"> <?= $daltu_tim->nama; ?> </td>
				<td></td>
			</tr>

			<tr>
				<td></td>
				<td class="c"> NIP. <?= $daltu_tim->nip; ?> </td>
				<td></td>
			</tr>
		</table>
	</body>
</html>