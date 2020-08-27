<table width='100%' border='1'>
	<thead>
		<tr>
			<td class='c b bg-color'> No</td>
			<td class='c b bg-color'> Tanggal</td>
			<td class='c b bg-color'> File</td>
			<td class='c b bg-color'> Keterangan</td>
		</tr>
	</thead>
	<tbody>
	<?php $no = 1; 
	foreach ($data_upload as $row)
		{ ?>
			<tr>
				<td class='c bg-color'><?= $no ?></td>
				<td class='c'><?= $row->tgl_upload ?></td>
				<td class='c'><a target="_blank" href="<?= site_url('../assets/tl/' . $row->file)?>"><?= $row->file ?></a></td>
				<td class='c'><?= $row->ket ?></td>
			</tr>
			<?php
			$no++;
		} ?>
	</tbody>
</table>