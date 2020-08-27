<!--
  ## DETAIL REVIU KKA IKHTISAR ##
  Ditampilkan dalam modal bootstrap
-->

<table width="100%" border="0">
  <tr>
    <td width="19%" class="pos-atas"> Jenis Pekerjaan </td>
    <td width="2%" class="pos-atas"> : </td>
    <td> <?= $kka->jenis_pekerjaan; ?> </td>
  </tr>
</table> <br/>

<p> Terdapat reviu dalam pengerjaan <strong>Kertas Kerja Audit (KKA) Ikhtisar</strong>, upload file KKA Ikhtisar yang telah di reviu dibawah ini.</p>

<?php
if(($kka->reviu_ketua != NULL) && ($kka->reviu_dalnis != NULL) && ($kka->reviu_daltu != NULL))
{
  if(($kka->reviu_ketua == "-") && ($kka->reviu_dalnis == "-") && ($kka->reviu_daltu == "-"))
  {
    echo "KETUA, DALNIS, DALTU = TIDAK ADA REVIU";
  }
  else
  {
?>
    <form class='form-horizontal' role='form' action="<?= site_url('anggota_tim/kka/upload_reviu_kka_ikhtisar/'.base64_encode($kka->sub_pka1).'/'.base64_encode($kka->kode_pekerjaan)); ?>" method='post' enctype='multipart/form-data'>

      <input type="hidden" name="no_rev" value="<?= $rev; ?>">

      <div class="row">
        <div class="col-sm-12">

          <div class="form-group">
            <label class="col-sm-4 control-label no-padding-right"> Upload File Reviu KKA : </label>
            <div class="col-sm-7">
              <input type='file' name='file_rev_kka_ikhtisar' id='id-input-file-2' />
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-4 control-label no-padding-right"> &nbsp; </label>
            <div class="col-sm-7">
              <input type='submit' class='btn btn-sm btn-info' value='Upload File' />
            </div>
          </div>

        </div><!-- ./col -->
      </div><!-- ./row -->
    </form>
<?php
  }
}
else
{
  if($kka->reviu_ketua != NULL)
    { $no1 = 1; } else { $no1 = 0; }
  if($kka->reviu_dalnis != NULL)
    { $no2 = 1; } else { $no2 = 0; }
  if($kka->reviu_daltu != NULL)
    { $no3 = 1; } else { $no3 = 0; }

  $jml = $no1+$no2+$no3;

  echo "<center><h5 class='orange' title='Sedang diproses'><i class='fa fa-spinner fa-pulse bigger-130'></i> Menunggu semua reviu selesai, $jml dari 3 </h5></center>";
}
?>

<script type="text/javascript">
  jQuery(function($)
  {
    $('#id-input-file-2').ace_file_input({
      no_file    : 'Tidak ada File ...',
      btn_choose : 'Pilih',
      btn_change : 'Ubah',
      droppable  : false,
      onchange   : null,
      thumbnail  : false, //| true | large
      //whitelist:'doc|docx',
      //blacklist:'exe|php'
      //onchange:''
      //
    });
  });
</script>