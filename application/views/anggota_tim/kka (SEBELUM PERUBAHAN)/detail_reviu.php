<!--
  ## DETAIL REVIU KKA ##
  Ditampilkan dalam modal bootstrap
-->

<table width="100%" border="0">
  <tr>
    <td width="19%" class="pos-atas"> Jenis Pekerjaan </td>
    <td width="2%" class="pos-atas"> : </td>
    <td> <?= $kka->jenis_pekerjaan; ?> </td>
  </tr>

  <tr>
    <td class="pos-atas"> Uraian </td>
    <td class="pos-atas"> : </td>
    <td> <?= $kka->uraian; ?> </td>
  </tr>

  <tr>
    <td class="pos-atas"> No. KKA </td>
    <td class="pos-atas"> : </td>
    <td> <?= $kka->sub_no_kka; ?> </td>
  </tr>
</table> <br/>

<p> Terdapat reviu dalam pengerjaan <strong>Kertas Kerja Audit (KKA)</strong>, upload file KKA yang telah di reviu dibawah ini.</p>

<?php
if(($kka->reviu_kka_ketua != NULL) && ($kka->reviu_kka_dalnis != NULL) && ($kka->reviu_kka_daltu != NULL))
{
  if(($kka->reviu_kka_ketua == "-") && ($kka->reviu_kka_dalnis == "-") && ($kka->reviu_kka_daltu == "-"))
  {
    echo "KETUA, DALNIS, DALTU = TIDAK ADA REVIU";
  }
  else
  {
?>
    <form class='form-horizontal' role='form' action="<?= site_url('anggota_tim/kka/upload_reviu_kka/'.base64_encode($kka->sub_pka3).'/'.base64_encode($kka->sub_no_kka).'/'.base64_encode($kka->pelaksana)); ?>" method='post' enctype='multipart/form-data'>

      <input type="hidden" name="no_rev" value="<?= $rev; ?>">

      <div class="row">
        <div class="col-sm-12">

          <div class="form-group">
            <label class="col-sm-4 control-label no-padding-right"> Upload File Reviu KKA : </label>
            <div class="col-sm-7">
              <input type='file' name='file_rev_kka' id='id-input-file-2' />
            </div>
          </div>

          <!-- <div class="form-group">
            <label class="col-sm-4 control-label no-padding-right"> Upload Bukti Temuan : <br/> <i>(Jika ada)</i> </label>
            <div class="col-sm-7">
              <input type='file' name='file_rev_bukti' id='id-input-file-3' />
            </div>
          </div> -->

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
  if($kka->reviu_kka_ketua != NULL)
    { $no1 = 1; } else { $no1 = 0; }
  if($kka->reviu_kka_dalnis != NULL)
    { $no2 = 1; } else { $no2 = 0; }
  if($kka->reviu_kka_daltu != NULL)
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

    $('#id-input-file-3').ace_file_input({
      style      : 'well',
      btn_choose : 'Geser gambar/file kesini atau klik untuk memilih',
      btn_change : null,
      no_icon    : 'ace-icon fa fa-cloud-upload',
      droppable  : true,
      thumbnail  : 'small'//large | fit
      //,icon_remove:null//set null, to hide remove/reset button
      /**,before_change:function(files, dropped) {
        //Check an example below
        //or examples/file-upload.html
        return true;
      }*/
      /**,before_remove : function() {
        return true;
      }*/
      ,
      preview_error : function(filename, error_code) {
        //name of the file that failed
        //error_code values
        //1 = 'FILE_LOAD_FAILED',
        //2 = 'IMAGE_LOAD_FAILED',
        //3 = 'THUMBNAIL_FAILED'
        //alert(error_code);
      }

    }).on('change', function(){
      //console.log($(this).data('ace_input_files'));
      //console.log($(this).data('ace_input_method'));
    });
  });
</script>