<!--
  ## FORM UPLOAD HASIL KKA IKHTISAR ##
  Ditampilkan dalam modal bootstrap
-->

<table width="100%" border="0">
  <tr>
    <td width="17%" class="pos-atas"> Jenis Pekerjaan </td>
    <td width="2%" class="pos-atas"> : </td>
    <td class="b"> <?= $kka->jenis_pekerjaan; ?></td>
  </tr>
</table> <br/>

<form class='form-horizontal' role='form' action="<?= site_url('anggota_tim/kka/upload_kka_ikhtisar/'.base64_encode($kka->sub_pka1).'/'.base64_encode($kka->kode_pekerjaan)); ?>" method='post' enctype='multipart/form-data'>

  <label>Upload File <strong>Kertas Kerja Audit Ikhtisar (KKA Ikhtisar)</strong> yang telah selesai dikerjakan oleh <strong>Semua Anggota</strong> yang sama dalam perihal <strong>Jenis Pekerjaan</strong> nya.</label> <br/><br/>

  <div class="row">
    <div class="col-sm-12">

      <div class="form-group">
        <label class="col-sm-4 control-label no-padding-right"> Upload File KKA Ikhtisar : </label>
        <div class="col-sm-7">
          <input type='file' name='file_kka_ikhtisar' class='id-input-file-2' />
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-4 control-label no-padding-right"> &nbsp; </label>
        <div class="col-sm-7">
          <button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><i class="fa fa-arrow-left"></i> Kembali </button>
          
          &nbsp;&nbsp;&nbsp;

          <input type='submit' class='btn btn-sm btn-info' value='Upload File' />
        </div>
      </div>

    </div>
  </div>

  <label class="i red">Catatan : KKA Ikhtisar dapat di upload oleh salah satu anggota yang sama dalam perihal Jenis Pekerjaannya (hanya satu kali upload).</label>

</form>

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