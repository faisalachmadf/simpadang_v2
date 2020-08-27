<!--
  ## PENENTUAN KATEGORI TINDAK LANJUT (ANGGOTA TIM TL) ##
  Ditampilkan dalam modal bootstrap
-->

<form class='form-horizontal' role='form'>
<div class="form-group">
    <label class="col-sm-3 control-label no-padding-right"> Nilai : </label>
    <div class="col-sm-9">
      <label class="control-label"><?= $temuan_rekomendasi->status_nilai; ?></label>
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-3 control-label no-padding-right"> Status : </label>
    <div class="col-sm-9">
      <label class="control-label">
        <?php if($temuan_rekomendasi->status_tl == '0') { ?>
          <span class='label-warning label'>Belum Ditindaklanjuti</span>
        <?php } else if ($temuan_rekomendasi->status_tl == '3') { ?>
          <span class='label-danger label'>Tidak Dapat Ditindaklanjuti</span>
        <?php } else if ($temuan_rekomendasi->status_tl == '2') { ?>
          <span class='label-primary label'>Belum Selesai</span>
        <?php } else if ($temuan_rekomendasi->status_tl == '1') { ?>
          <span class='label-success label'>Selesai</span>
        <?php } else { ?>

        <?php } ?>
      </label>
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-3 control-label no-padding-right"> Keterangan : </label>
    <div class="col-sm-9">
      <label class="control-label"><?= $temuan_rekomendasi->ket; ?></label>
    </div>
  </div>
</form>