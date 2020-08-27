<form class='form-horizontal' role='form' action="<?= site_url('anggota_tl/tindak_lanjut/get_upload'); ?>" method='post'  enctype='multipart/form-data'>

  <!-- ID TL -->
  <input type="hidden" name="id_tl" value="<?= $id_tl; ?>">
  <input type="hidden" name="id_tim" value="<?= $id_tim; ?>">
  <input type="hidden" name="no_lhp" value="<?= $no_lhp; ?>">
  <input type="hidden" name="id_temuan_rekomendasi" value="<?= $id_temuan_rekomendasi; ?>">

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
  <hr>
  <div class="form-group">
    <label class="col-sm-3 control-label no-padding-right"> File LHP : </label>
    <div class="col-sm-7">
      <input type='file' name='file_tl' class='id-input-file-2' />
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-3 control-label no-padding-right"> Keterangan : </label>
    <div class="col-sm-9">
      <textarea class="form-control" name="ket" rows="5"></textarea>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-3 control-label no-padding-right"> </label>
    <div class="col-sm-9">
      <input class="btn btn-info" type="submit" name="submit" value="Upload"></input>
    </div>
  </div>

  <script type="text/javascript">
      jQuery(function($)
      {
        $('.id-input-file-2').ace_file_input({
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
  
</form>