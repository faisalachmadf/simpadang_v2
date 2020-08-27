<!--
  ## DETAIL INSTANSI ##
  Ditampilkan dalam modal bootstrap
-->

<p>Berikut detail instansi dengan rincian nama kecamatan beserta nama instansinya.</p>

<table width="100%" border="0">
  <tr>
    <td width="23%"> Nama Kecamatan </td>
    <td width="3%"> : </td>
    <td> <?= $kecamatan->nama_kecamatan; ?></td>
  </tr>
</table> <br/>

<table width="100%" border="1">
  <tr>
    <td width="10%" align="center" style="background-color: #f1f6a3"> Nomor </td>
    <td align="center" style="background-color: #f1f6a3"> Nama Instansi </td>
    <td width="18%" align="center" style="background-color: #f1f6a3"> Kelola Data </td>
  </tr>

  <?php
    $no=1;
    foreach($desa as $row)
    {
      $id  = base64_encode($row->id);
      $id2 = base64_encode($row->sub_id_instansi);

      echo "
        <tr>
          <td align='center'> $no </td>
          <td> $row->nama_desa </td>
          <td align='center'>
            <a href='instansi/ubah_desa/$id/$id2' class='green' title='Ubah Data'>
              <i class='ace-icon fa fa-pencil bigger-130'></i>
            </a>
            &nbsp; | &nbsp;
            <a href='instansi/hapus_desa/$id' class='delete-row red' title='Hapus Data'>
              <i class='ace-icon fa fa-trash-o bigger-130'></i>
            </a>
          </td>
        </tr>
      ";
      $no++;
    }
  ?>
</table>