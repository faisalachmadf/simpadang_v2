<!DOCTYPE html>
<html>
  <head>
		<meta charset="utf-8" />
		<link rel="icon" type="image/png" href="<?php echo base_url(); ?>assets/images/icon.png">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

		<title> Kartu Penugasan : <?= $data->nomor; ?> </title>

		<!-- Bootstrap -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" />
		<style type="text/css">
		  body { font-family: 'Work Sans', sans-serif;}
			th {padding: 3px; text-align: center}
			td {padding: 2px}

			.border {border: 2px solid #000;}
			.j {text-align: justify}
			.c {text-align: center}
			.b {font-weight: bold}
			.u {text-decoration: underline}
			.pad-3 {padding: 3px}
			.pad-r-3 {padding-right: 3px}
			.pad-b-5 {margin-bottom: -5px}
			.pad-b-7 {margin-bottom: -12px}
			.pos-atas {vertical-align: top}

			.f13 {font-size: 13}
		</style>
  </head>

	<body>

		<div class="border">
			<p class="b f13 pad-b-5 pad-r-3" align="right">KM-1</p>
			<p class="f13" align="center">
				<span class="u">KARTU PENUGASAN</span> <br/> 
				Nomor : <?= $data->nomor; ?>
			</p>
		</div>

		<p class="pad-b-7">&nbsp;</p>

		<div class="border">
		<table width="100%" border="0">
			<thead>
				<tr>
					<th width="6%"></th>
					<th width="3%"></th>
					<th width="43%"></th>
					<td></td>
					<th width="3%"></th>
					<th width="40%"></th>
				</tr>
			</thead>

			<tbody>
				<tr>
					<td align="right" class="f13">1.</td>
					<td class="f13">a.</td>
					<td colspan="2" class="f13">Nama Auditi</td>
					<td class="c f13">:</td>
					<td class="f11"><?= $data->nama_auditi; ?></td>
				</tr>

				<tr>
					<td></td>
					<td class="f13">b.</td>
					<td colspan="2" class="f13">Nomor File Permanen</td>
					<td class="c f13">:</td>
					<td class="f13"><?= $data->no_file_permanen; ?></td>
				</tr>

				<tr>
					<td></td>
					<td class="f13">c.</td>
					<td colspan="2" class="f13">Rencana Audit Nomor</td>
					<td class="c f13">:</td>
					<td class="f13"><?= $data->rencana_audit_no; ?></td>
				</tr>

				<tr>
					<td></td>
					<td class="f13">d.</td>
					<td colspan="2" class="f13">Rencana Audit Tahun</td>
					<td class="c f13">:</td>
					<td class="f13"><?= $data->thn_terakhir_audit; ?></td>
				</tr>

				<tr>
					<td align="right" class="pos-atas f13">2.</td>
					<td colspan="3" class="pos-atas f13">Alamat dan Nomor Telepon</td>
					<td class="c pos-atas f13">:</td>
					<td class="f13"><?= $data->alamat_audit .", ". $data->no_tlp_audit;; ?></td>
				</tr>

				<tr>
					<td align="right" class="f13">3.</td>
					<td colspan="3" class="f13">Tingkat Risiko Unit/Aktivitas</td>
					<td class="c f13">:</td>
					<td class="f13"><?= $data->tingkat_risiko; ?></td>
				</tr>

				<tr>
					<td align="right" class="pos-atas f13">4.</td>
					<td colspan="3" class="pos-atas f13">Tujuan Audit</td>
					<td class="c pos-atas f13">:</td>
					<td class="f13"><?= $data->tujuan_audit; ?></td>
				</tr>

				<tr>
					<td align="right" class="f13">5.</td>
					<td class="f13">a.</td>
					<td colspan="2" class="f13">Nama Ketua Tim Audit</td>
					<td class="c f13">:</td>
					<td class="f13"><?= $ketua_tim->nama; ?></td>
				</tr>

				<tr>
					<td></td>
					<td class="pos-atas f13">b.</td>
					<td colspan="2" class="pos-atas f13">Nama Anggota Tim Audit</td>
					<td class="c pos-atas f13">:</td>
					<td class="f13">
					<?php 
						foreach($tim as $row)
						{
							echo "$row->nomor. $row->nama <br/>";
						}
					?>
					</td>
				</tr>

				<tr>
					<td align="right" class="pos-atas f13">6.</td>
					<td class="pos-atas f13">a.</td>
					<td colspan="2" class="f13">Audit Dilakukan dengan Surat Tugas Nomor</td>
					<td class="c pos-atas f13">:</td>
					<td class="pos-atas f13"><?= $data->no_st; ?></td>
				</tr>

				<tr>
					<td></td>
					<td class="pos-atas f13">b.</td>
					<td colspan="2" class="f13">Audit Direncanakan Mulai Tanggal dan Selesai Tanggal</td>
					<td class="c pos-atas f13">:</td>
					<td class="pos-atas f13"><?= $tgl_awal ." s/d ". $tgl_akhir; ?></td>
				</tr>

				<tr>
					<td align="right" class="f13">7.</td>
					<td colspan="3" class="f13">Anggaran yang Diajukan</td>
					<td class="c f13">:</td>
					<td class="f13">Rp. <?= $data->anggaran_ajukan; ?>,-</td>
				</tr>

				<tr>
					<td align="right" class="f13">8.</td>
					<td colspan="3" class="f13">Anggaran yang Disetujui</td>
					<td class="c f13">:</td>
					<td class="f13">Rp. <?= $data->anggaran_setujui; ?>,-</td>
				</tr>

				<tr>
					<td align="right" class="pos-atas f13">9.</td>
					<td colspan="3" class="pos-atas f13">Catatan Penting <!-- dari Pengendali Teknis/ Pengendali Mutu --></td>
					<td class="c pos-atas f13">:</td>
					<td class="pos-atas f13"><?= $data->catatan; ?></td>
				</tr>

				<tr><td colspan="6">&nbsp;</td></tr>

				<tr>
					<td colspan="3" class="c f13">Menyetujui</td>
					<td></td>
					<td colspan="2" class="c f13">Cianjur, <?= $tgl_tugas; ?></td>
				</tr>

				<tr>
					<td colspan="3" class="c f13">Tanggal <?= $tgl_kep; ?></td>
					<td></td>
					<td colspan="2" class="c f13"><?= $data->irban; ?></td>
				</tr>

				<tr>
					<td colspan="3" class="c f13">Inspektur</td>
					<td></td>
					<td colspan="2"></td>
				</tr>

				<tr><td colspan="6">&nbsp;</td></tr>
				<tr><td colspan="6">&nbsp;</td></tr>
				<tr><td colspan="6">&nbsp;</td></tr>

				<tr>
					<td colspan="3" class="c f13 pad-3">(<?= $data->nama_inspektur; ?>)</td>
					<td></td>
					<td colspan="2" class="c f13 pad-3">(<?= $data->nama_irban; ?>)</td>
				</tr>

				<tr>
					<td colspan="3" class="c f13 pad-3">NIP. <?= $data->nip_inspektur; ?></td>
					<td></td>
					<td colspan="2" class="c f13 pad-3">NIP. <?= $data->nip_irban; ?></td>
				</tr>

				<tr><td colspan="6">&nbsp;</td></tr>
			</tbody>
		</table>
		</div>

		<!-- jQuery -->
		<script src="<?php echo base_url(); ?>assets/js/jquery-2.1.4.min.js"></script>
		<!-- Bootstrap -->
		<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
	</body>
</html>