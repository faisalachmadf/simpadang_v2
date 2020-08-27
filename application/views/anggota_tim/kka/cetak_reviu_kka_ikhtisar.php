<!DOCTYPE html>
<html>
  <head>
		<meta charset="utf-8" />
		<link rel="icon" type="image/png" href="<?php echo base_url(); ?>assets/images/icon.png">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

		<title> Reviu Kertas Kerja Audit Ikhtisar : <?= $kka->no_kka; ?> </title>

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

			.border {border: 1px solid black}
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
		<div class="border">
		<table width="100%" border='0'>
			<tr>
				<td width="13%"></td>
				<td width="2%"></td>
				<td width="37%"></td>
				<td></td>
				<td width="13%"></td>
				<td width="2%"></td>
				<td width="27%"></td>
			</tr>

			<tr>
				<td class='b' colspan="3"> Inspektorat Jenderal </td>
				<td></td>
				<td> No. KKA </td>
				<td> : </td>
				<td> <?= $kka->no_kka; ?> </td>
			</tr>

			<tr>
				<td class='b' colspan="3"> Pemerintah Kota Pariaman </td>
				<td></td>
				<td> Ref. PKA No. </td>
				<td> : </td>
				<td> <?= $data->no_ref_pka; ?> </td>
			</tr>

			<?php $jml_penyusun = count($penyusun); ?>

			<tr>
				<td colspan="3"></td>
				<td></td>
				<td> Disusun Oleh </td>
				<td> : </td>
				<td> 
					<?php 
            if($jml_penyusun != 1)
            {
              foreach($penyusun as $row)
              { echo $row->nama .", "; }
            } else { foreach($penyusun as $row) { echo $row->nama; } }
          ?> 
        </td>
			</tr>

			<tr>
				<td> Nama Auditan </td>
				<td> : </td>
				<td> <?= $data->nama_op; ?> </td>
				<td></td>
				<td> Tanggal </td>
				<td> : </td>
				<td> <?= $tgl_pka; ?> </td>
			</tr>

			<tr>
				<td> Sasaran Audit </td>
				<td> : </td>
				<td> <?= $data->sasaran_peng; ?> </td>
				<td></td>
				<td> Direviu Oleh </td>
				<td> : </td>
				<td> <?= $ketua_tim->nama; ?> </td>
			</tr>

			<tr>
				<td> Periode Audit </td>
				<td> : </td>
				<td> <?= $data->masa_periksa; ?> </td>
				<td></td>
				<td> Tanggal </td>
				<td> : </td>
				<td> </td>
			</tr>
		</table>
		</div>

		<div class="border"><h6 class='c b'> LEMBAR REVIU KKA IKHTISAR </h6></div>

		<table width="100%" border="1">
			<tr>
				<td class="c b pad-5" width="10%"> No. Urut </td>
				<td class="c b pad-5" width="14%"> No. KKA </td>
				<td class="c b pad-5"> Uraian Masalah </td>
				<td class="c b pad-5" width="20%"> Penjelasan dan Penyelesaian Masalah </td>
				<td class="c b pad-5" width="12%"> Stuju / Paraf </td>
			</tr>

			<?php 
				foreach($data_rev as $row)
	      {
	        echo "
	        <tr>
	          <td class='c pos-atas'> $row->rev_ke </td>
	          <td class='c pos-atas'> $row->rev_no_kka </td>
	          <td class='pos-atas'> $row->rev_ketua";
	          	/*if($row->rev_ketua != "-" && $row->rev_dalnis == '-' && $row->rev_daltu == '-')
							{ echo $row->rev_ketua; }
							elseif($row->rev_ketua == "-" && $row->rev_dalnis == '-' && $row->rev_daltu != '-')
							{ echo $row->rev_daltu; }
							elseif($row->rev_ketua == "-" && $row->rev_dalnis != '-' && $row->rev_daltu == '-')
							{ echo $row->rev_dalnis; }
							elseif($row->rev_ketua == "-" && $row->rev_dalnis != '-' && $row->rev_daltu != '-')
							{ echo $row->rev_dalnis .", ". $row->rev_daltu; }
							elseif($row->rev_ketua != "-" && $row->rev_dalnis == '-' && $row->rev_daltu != '-')
							{ echo $row->rev_ketua .", ". $row->rev_daltu; }
							elseif($row->rev_ketua != "-" && $row->rev_dalnis != '-' && $row->rev_daltu == '-')
							{ echo $row->rev_ketua .", ". $row->rev__dalnis; }*/
	          echo "</td>
	          <td class='pos-atas'> </td>
	          <td class='pos-atas'> </td>
	         </tr>";
	      }
			?>
		</table>

		<!-- jQuery -->
		<script src="<?php echo base_url(); ?>assets/js/jquery-2.1.4.min.js"></script>
		<!-- Bootstrap -->
		<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
	</body>
</html>