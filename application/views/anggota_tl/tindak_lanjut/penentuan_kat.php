
<form class='form-horizontal' role='form' action="<?= site_url('anggota_tl/tindak_lanjut/penentuan_kat'); ?>" method='post'>

  <!-- ID TL -->
  <input type="hidden" name="id_tl" value="<?= $id_tl; ?>">
  <input type="hidden" name="id_tim" value="<?= $id_tim; ?>">
  <input type="hidden" name="no_lhp" value="<?= $no_lhp; ?>">
  <input type="hidden" name="id_temuan_rekomendasi" value="<?= $id_temuan_rekomendasi; ?>">

  <div class="form-group">
    <label class="col-sm-3 control-label no-padding-right"> Nilai : </label>
    <div class="col-sm-9">
      <input type="text" class="form-control" name="status_nilai" value="<?= $temuan_rekomendasi->status_nilai; ?>">
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-3 control-label no-padding-right"> Status : </label>
    <div class="col-sm-9">
      <div class="radio">
        <label>
          <input type="radio" name="status_tl" class="ace" value="1" <?php if($temuan_rekomendasi->status_tl == '1') { ?> checked="" <?php } ?> />
          <span class="lbl"> Selesai</span>
        </label>
      </div>

      <div class="radio">
        <label>
          <input type="radio" name="status_tl" class="ace" value="2" <?php if($temuan_rekomendasi->status_tl == '2') { ?> checked="" <?php } ?> />
          <span class="lbl"> Belum Selesai </span>
        </label>
      </div>

      <div class="radio">
        <label>
          <input type="radio" name="status_tl" class="ace" value="3" <?php if($temuan_rekomendasi->status_tl == '3') { ?> checked="" <?php } ?> />
          <span class="lbl"> Tidak Dapat Ditindaklanjuti</span>
        </label>
      </div>

      <div class="radio">
        <label>
          <input type="radio" name="status_tl" class="ace" value="0" <?php if($temuan_rekomendasi->status_tl == '0') { ?> checked="" <?php } ?> />
          <span class="lbl"> Belum Ditindaklanjuti</span>
        </label>
      </div>

    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-3 control-label no-padding-right"> Keterangan : </label>
    <div class="col-sm-9">
      <textarea class="form-control" name="ket" rows="5"><?= $temuan_rekomendasi->ket; ?></textarea>
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-3 control-label no-padding-right"> </label>
    <div class="col-sm-9">
      <input class="btn btn-info" type="submit" name="submit" value="Simpan"></input>
    </div>
  </div>
</form>