<!DOCTYPE html>
<html>
  <head>
		<meta charset="utf-8" />
		<link rel="icon" type="image/png" href="./assets/images/icon.png">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

		<title> Kartu Penugasan Pengawasan : <?= $data->nama_op; ?> </title>

		<!-- Bootstrap -->
		<style type="text/css">
		  body { font-family: 'Work Sans', sans-serif;}
			th {padding: 3px; text-align: center}
			td {padding: 2px; font-size: 12}

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

		<h5>INSPEKTORAT KOTA PARIAMAN</h5>

		<table width="100%" border="0">
			<tr>
				<td width="5%"></td>
				<td width="32%"></td>
				<td width="4%"></td>
				<td></td>
			</tr>

			<tr><td colspan="4" class="u c b"><h5> KARTU PENUGASAN KEGIATAN PENGAWASAN </h5></td></tr>
			<tr><td colspan="4" class="c"> Nomor : <?= $data->no_kp; ?> </td></tr>
			<tr><td colspan="4">&nbsp;</td></tr>

			<tr>
				<td class="r pos-atas"> I.</td>
				<td class="pos-atas"> Nama Kegiatan Pengawasan </td>
				<td class="c pos-atas"> : </td>
				<td class="j"> <?= $data->nama_kp; ?> </td>
			</tr>

			<tr>
				<td class="r pos-atas"> II.</td>
				<td colspan="3" class="pos-atas"> Identitas Objek Pengawasan </td>
			</tr>

			<tr>
				<td class="r pos-atas"></td>
				<td class="pos-atas"> a. Nama Objek Pengawasan </td>
				<td class="c pos-atas"> : </td>
				<td class="j"> <?= $data->nama_op; ?> </td>
			</tr>

			<tr>
				<td class="r pos-atas"></td>
				<td class="pos-atas"> b. Alamat Kantor & Nomor Telepon </td>
				<td class="c pos-atas"> : </td>
				<td class="j"> <?= $data->alamat_kantor .", ". $data->no_tlp; ?> </td>
			</tr>

			<tr>
				<td class="r pos-atas"> III.</td>
				<td class="pos-atas"> Rencna Pengawasan Nomor </td>
				<td class="c pos-atas"> : </td>
				<td class="j"> <?= $data->no_rp; ?> </td>
			</tr>

			<tr>
				<td class="r pos-atas"> IV.</td>
				<td colspan="3" class="pos-atas"> Uraian Singkat Kegiatan Pengawasan </td>
			</tr>

			<tr>
				<td class="r pos-atas"></td>
				<td class="pos-atas"> a. Program Pengawasan </td>
				<td class="c pos-atas"> : </td>
				<td class="j"> <?= $data->program_peng; ?> </td>
			</tr>

			<tr>
				<td class="r pos-atas"></td>
				<td class="pos-atas"> b. Sasaran Pengawasan </td>
				<td class="c pos-atas"> : </td>
				<td class="j"> <?= $data->sasaran_peng; ?> </td>
			</tr>

			<tr>
				<td class="r pos-atas"></td>
				<td class="pos-atas"> c. Tujuan Pengawasan </td>
				<td class="c pos-atas"> : </td>
				<td class="j"> <?= $data->tujuan_peng; ?> </td>
			</tr>

			<tr>
				<td class="r pos-atas"> V.</td>
				<td class="pos-atas"> Laporan Dikirimkan/ditunjukan Kepada </td>
				<td class="c pos-atas"> : </td>
				<td class="j"> <?= $data->tujuan_laporan; ?> </td>
			</tr>

			<tr>
				<td class="r pos-atas"> VI.</td>
				<td colspan="3" class="pos-atas"> Pelaksana Pengawasan </td>
			</tr>

			<tr>
				<td class="r pos-atas"></td>
				<td class="pos-atas"> a. Penanggung Jawab </td>
				<td class="c pos-atas"> : </td>
				<td class="j"> <?= strtoupper($daltu_tim->jabatan); ?> </td>
			</tr>

			<tr>
				<td class="r pos-atas"></td>
				<td class="pos-atas"> b. Pengendali Teknis </td>
				<td class="c pos-atas"> : </td>
				<td class="j"> <?= $dalnis_tim->nama; ?> </td>
			</tr>

			<tr>
				<td class="r pos-atas"></td>
				<td class="pos-atas"> c. Ketua Tim </td>
				<td class="c pos-atas"> : </td>
				<td class="j"> <?= $ketua_tim->nama; ?> </td>
			</tr>

			<?php 
				foreach($anggota_tim as $row)
				{
					if($row->nomor == "1")
					{
						echo "
						<tr>
							<td></td>
							<td>d. Anggota Tim</td>
							<td class='c pos-atas'> $row->nomor) </td>
							<td class='j'> $row->nama </td>
						</tr>";
					}
					else
					{
						echo "
						<tr>
							<td></td>
							<td></td>
							<td class='c pos-atas'> $row->nomor) </td>
							<td class='j'> $row->nama </td>
						</tr>";
					}
				}		
			?>

			<tr>
				<td class="r pos-atas"> VII.</td>
				<td colspan="3" class="pos-atas"> Pengawasan Dilakukan Berdasarkan Surat Tugas </td>
			</tr>

			<tr>
				<td class="r pos-atas"></td>
				<td class="pos-atas"> a. Nomor </td>
				<td class="c pos-atas"> : </td>
				<td class="j"> <?= $data->no_st; ?> </td>
			</tr>

			<tr>
				<td class="r pos-atas"></td>
				<td class="pos-atas"> b. Tanggal </td>
				<td class="c pos-atas"> : </td>
				<td class="j"> <?= $tgl_surat; ?> </td>
			</tr>

			<tr>
				<td class="r pos-atas"></td>
				<td class="pos-atas"> c. Direncanakan Mulai Pada Tanggal </td>
				<td class="c pos-atas"> : </td>
				<td class="j"> <?= $tgl_awal; ?> </td>
			</tr>

			<tr>
				<td class="r pos-atas"></td>
				<td class="pos-atas"> d. Direncanakan Selesai Pada Tanggal </td>
				<td class="c pos-atas"> : </td>
				<td class="j"> <?= $tgl_akhir; ?> </td>
			</tr>

			<tr>
				<td class="r pos-atas"></td>
				<td class="pos-atas"> e. Realisasi Tanggal Pelaksanaan </td>
				<td class="c pos-atas"> : </td>
				<td class="j"> <?= $tgl_awal ." s/d ". $tgl_akhir; ?> </td>
			</tr>

			<tr>
				<td class="r pos-atas"> VIII.</td>
				<td colspan="3" class="pos-atas"> Anggaran Waktu Hari Produktif Tim Pengawasan </td>
			</tr>
		</table>

		<?php 
			foreach($anggaran as $row)
			{
				if($row->kategori == "1")
				{
					$sh_daltu1 += $row->hari_daltu;
					$sub_jam1 += $row->jam_daltu;
					$sub_jam_daltu1 = number_format($sub_jam1,2);
					if($sh_daltu1 != "0")
					{ 
						$sub_hri_daltu1 = $sh_daltu1; 
						$sub_daltu1 = $sub_hri_daltu1 ." ( $sub_jam_daltu1 )";
					}
					else
					{ 
						$sub_hri_daltu1 = ""; 
						$sub_daltu1 = "";
					}

					$sub_hri_dalnis1 += $row->hari_dalnis;
					$sub_jam2 += $row->jam_dalnis;
					$sub_jam_dalnis1 = number_format($sub_jam2,2);

					$sub_hri_ketua1 += $row->hari_ketua;
					$sub_jam3 += $row->jam_ketua;
					$sub_jam_ketua1 = number_format($sub_jam3,2);

					$sub_hri_anggota1 += $row->hari_anggota;
					$sub_jam4 += $row->jam_anggota;
					$sub_jam_anggota1 = number_format($sub_jam4,2);
				}

				if($row->kategori == "2")
				{
					$sh_daltu2 += $row->hari_daltu;
					$sub_jam11 += $row->jam_daltu;
					$sub_jam_daltu2 = number_format($sub_jam11,2);
					if($sh_daltu2 != "0")
					{ 
						$sub_hri_daltu2 = $sh_daltu2; 
						$sub_daltu2 = $sub_hri_daltu2 ." ( $sub_jam_daltu2 )";
					}
					else
					{ 
						$sub_hri_daltu2 = ""; 
						$sub_daltu2 = "";
					}

					$sub_hri_dalnis2 += $row->hari_dalnis;
					$sub_jam22 += $row->jam_dalnis;
					$sub_jam_dalnis2 = number_format($sub_jam22,2);

					$sub_hri_ketua2 += $row->hari_ketua;
					$sub_jam33 += $row->jam_ketua;
					$sub_jam_ketua2 = number_format($sub_jam33,2);

					$sub_hri_anggota2 += $row->hari_anggota;
					$sub_jam44 += $row->jam_anggota;
					$sub_jam_anggota2 = number_format($sub_jam44,2);
				}

				if($row->kategori == "3")
				{
					$sh_daltu3 += $row->hari_daltu;
					$sub_jam111 += $row->jam_daltu;
					$sub_jam_daltu3 = number_format($sub_jam111,2);
					if($sh_daltu3 != "0")
					{ 
						$sub_hri_daltu3 = $sh_daltu3; 
						$sub_daltu3 = $sub_hri_daltu3 ." ( $sub_jam_daltu3 )";
					}
					else
					{ 
						$sub_hri_daltu3 = ""; 
						$sub_daltu3 = "";
					}

					$sub_hri_dalnis3 += $row->hari_dalnis;
					$sub_jam222 += $row->jam_dalnis;
					$sub_jam_dalnis3 = number_format($sub_jam222,2);

					$sub_hri_ketua3 += $row->hari_ketua;
					$sub_jam333 += $row->jam_ketua;
					$sub_jam_ketua3 = number_format($sub_jam333,2);

					$sub_hri_anggota3 += $row->hari_anggota;
					$sub_jam444 += $row->jam_anggota;
					$sub_jam_anggota3 = number_format($sub_jam444,2);
				}
			}

			$t_daltu  = $sub_hri_daltu1 + $sub_hri_daltu2 + $sub_hri_daltu3;
			$jm_daltu = $sub_jam_daltu1 + $sub_jam_daltu2 + $sub_jam_daltu3;
			$tot_jam_daltu = number_format($jm_daltu,2);
			if($t_daltu != "0")
			{ 
				$tot_hri_daltu = $t_daltu;
				$total_daltu = $tot_hri_daltu ." ( $tot_jam_daltu )";
			}
			else
			{ 
				$tot_hri_daltu = ""; 
				$total_daltu = "";
			}

			$tot_hri_dalnis = $sub_hri_dalnis1 + $sub_hri_dalnis2 + $sub_hri_dalnis3;
			$jm_dalnis = $sub_jam_dalnis1 + $sub_jam_dalnis2 + $sub_jam_dalnis3;
			$tot_jam_dalnis = number_format($jm_dalnis,2);

			$tot_hri_ketua = $sub_hri_ketua1 + $sub_hri_ketua2 + $sub_hri_ketua3;
			$jm_ketua = $sub_jam_ketua1 + $sub_jam_ketua2 + $sub_jam_ketua3;
			$tot_jam_ketua = number_format($jm_ketua,2);

			$tot_hri_anggota = $sub_hri_anggota1 + $sub_hri_anggota2 + $sub_hri_anggota3;
			$jm_anggota = $sub_jam_anggota1 + $sub_jam_anggota2 + $sub_jam_anggota3;
			$tot_jam_anggota = number_format($jm_anggota,2);
		?>

		<table width="100%" border="1">
			<tr>
				<td width="4%" class="c pad-5"> No </td>
				<td width="17%" class="c pad-5"> Struktur Tim </td>
				<td class="c pad-5"> Dilaksanakan Oleh </td>
				<td width="25%" colspan="2" class="c pad-5"> Anggaran Waktu </td>
				<td width="25%" colspan="2" class="c pad-5"> Realisasi</td>
			</tr>

			<tr>
				<td class="pad-5 r"> 1 </td>
				<td class="pad-5"> Wakil Penanggung Jawab </td>
				<td class="pad-5"> <?= $daltu_tim->nama; ?> </td>
				<td class="pad-5 r"> <?= $total_daltu; ?> </td>
				<td class="pad-5"> Hari/Jam </td>
				<td class="pad-5 r"> <?= $total_daltu; ?> </td>
				<td class="pad-5"> Hari/Jam </td>
			</tr>

			<tr>
				<td class="pad-5 r"> 2 </td>
				<td class="pad-5"> Pengendali Teknis </td>
				<td class="pad-5"> <?= $dalnis_tim->nama; ?> </td>
				<td class="pad-5 r"> <?= $tot_hri_dalnis ." ( $tot_jam_dalnis )"; ?> </td>
				<td class="pad-5"> Hari/Jam </td>
				<td class="pad-5 r"> <?= $tot_hri_dalnis ." ( $tot_jam_dalnis )"; ?> </td>
				<td class="pad-5"> Hari/Jam </td>
			</tr>

			<tr>
				<td class="pad-5 r"> 3 </td>
				<td class="pad-5"> Ketua Tim </td>
				<td class="pad-5"> <?= $ketua_tim->nama; ?> </td>
				<td class="pad-5 r"> <?= $tot_hri_ketua ." ( $tot_jam_ketua )"; ?> </td>
				<td class="pad-5"> Hari/Jam </td>
				<td class="pad-5 r"> <?= $tot_hri_ketua ." ( $tot_jam_ketua )"; ?> </td>
				<td class="pad-5"> Hari/Jam </td>
			</tr>

			<?php
				
				foreach($anggota_tim as $row) 
				{
					if($row->nomor == "1")
					{	$no = "4"; }
					else
					{ $no = ""; }

					echo "
						<tr>
							<td class='pad-5 r'> $no </td>
							<td class='pad-5'> Anggota Tim : $row->nomor). </td>
							<td class='pad-5'> $row->nama </td>
							<td class='pad-5 r'> $tot_hri_anggota ( $tot_jam_anggota ) </td>
							<td class='pad-5'> Hari/Jam </td>
							<td class='pad-5 r'> $tot_hri_anggota ( $tot_jam_anggota ) </td>
							<td class='pad-5'> Hari/Jam </td>
						</tr>
					";
				}
			?>
		</table> 

		<table width="100%" border="0">
			<tr>
				<td width="5%" class="r"> IX. </td>
				<td> Rencana mulai pengawasan tanggal <?= $tgl_awal; ?>, Rencana penerbitan laporan tanggal <?= $tgl_akhir; ?> </td>
			</tr>

			<tr>
				<td width="5%" class="r"> X. </td>
				<td> Konsep laporan direncanakan selesai selambat-lambatnya pada tanggal <?= $tgl_akhir; ?> </td>
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