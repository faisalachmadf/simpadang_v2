<!--
  ## DETAIL KKA IKHTISAR (DALTU) ##
  Ditampilkan dalam modal bootstrap
-->

<form class='form-horizontal' role='form' action="<?= site_url('daltu/pka/persetujuan_kka_ikhtisar/'.base64_encode($kka->sub_pka2).'/'.base64_encode($kka->no_kka)); ?>" method='post'>

  <table width="100%" border="0">
    <tr>
      <td width="15%" class="pos-atas"> Uraian </td>
      <td width="2%" class="pos-atas"> : </td>
      <td class="b"> <?= $kka->uraian; ?></td>
    </tr>
    
     <tr>
      <td width="15%" class="pos-atas"> No. KKA </td>
      <td width="2%" class="pos-atas"> : </td>
      <td class="b"> <?= $kka->no_kka; ?></td>
    </tr>
  </table> <br/>

  <?php if($cek_rev > 0) { ?>
  <p class="red"><i class="fa fa-recycle"></i> Riwayat Reviu Kertas Kerja Audit (KKA) Ikhtisar</p>
  <table width="100%" border="1">
    <tr>
      <td width="3%" class="c b bg-color"> Reviu </td>
      <td width="28%" class="c b bg-color"> Reviu Ketua Tim </td>
      <td width="9%" class="c b bg-color"> Aksi </td>
    </tr>

    <?php
      foreach($data_rev as $row)
      {
        echo "
        <tr>
          <td class='c pos-atas'> $row->rev_ke </td>
          <td class='pos-atas'>";
            if($row->rev_ketua == "-")
              { echo "<span class='green'><i class='fa fa-check'></i> Tidak ada reviu </span>"; }
            else
              { echo "<span class='red'> $row->rev_ketua </span>"; }
          echo "
          </td>
          <td class='c pos-atas'>";            
            echo "<a href='".site_url('daltu/pka/download_rev_kka_ikhtisar/'.base64_encode($row->rev_kka_ikhtisar))."' class='btn btn-sm btn-primary' title='Download KKA Ikhtisar reviu'><i class='fa fa-download'></i></a>";            
          echo "
          </td>
        </tr>
        ";
      }
    ?>

  </table> <br/>
  <?php } ?>

  <p>Berikut hasil <strong>Kertas Kerja Audit (KKA) Ikhtisar</strong> yang telah dikerjakan oleh anggota tim.</p>

  <div class="row">
    <div class="col-sm-12">

      <div class="form-group">
        <label class="col-sm-4 control-label no-padding-right"> Download File KKA Ikhtisar : </label>
        <div class="col-sm-8">
          <a href="<?= site_url('daltu/pka/download_kka_ikhtisar/'.base64_encode($kka->kka_ikhtisar)); ?>" class='btn btn-sm btn-success' title='Download kertas kerja audit'><i class='fa fa-download'></i> KKA Ikhtisar </a>
        </div>
      </div>
      
      <?php 
      echo "<div class='hr hr-double hr-dotted hr18'></div>";

      //if($kka->reviu_daltu == NULL) {
      ?>

      <!-- <label>Berilah keputusan hasil KKA Ikhtisar di atas dengan mengisi keputusan di bawah ini.</label>

      <div class="form-group">
        <label class="col-sm-4 control-label no-padding-right"> Keputusan : </label>
        <div class="col-sm-7">
          <label class="control-label">
            <input type="radio" name="reviu" class="ace rev" value="setujui" checked="" />
            <span class="lbl"> Setujui </span>
          </label>

          &nbsp;&nbsp; | &nbsp;&nbsp;

          <label class="control-label">
            <input type="radio" name="reviu" class="ace rev" value="reviu" />
            <span class="lbl"> Direviu </span>
          </label>
        </div>
      </div>

      <div id="rev">
      <div class="form-group">
        <label class="col-sm-4 control-label no-padding-right"> &nbsp; </label>
        <div class="col-sm-8">
          <textarea name="catatan" cols="40" rows="3" placeholder="Isi reviu kka ikhtisar"></textarea>
        </div>
      </div>
      </div>

      <div class="form-group">
        <label class="col-sm-4 control-label no-padding-right"> &nbsp; </label>
        <div class="col-sm-8">
         <input type='submit' class='btn btn-sm btn-info' value='Ok' />
        </div>
      </div>

      <div class='hr hr-double hr-dotted hr18'></div> -->

      <?php //} ?>

      <table width="100%" border="0">
        <tr>
          <td width="19%" class="pos-atas"> Reviu Ketua Tim </td>
          <td width="2%" class="pos-atas"> : </td>
          <td>
            <?php
              if($kka->reviu_ketua == NULL)
              { echo "<i class='fa fa-spinner fa-pulse orange'></i> <strong class='orange i'> Belum Direviu </strong>"; }
              elseif($kka->reviu_ketua == "-")
              { echo "<i class='fa fa-check green'><strong> Tidak ada reviu </strong></i>"; }
              else
              { echo "<span class='red'><strong> $kka->reviu_ketua </strong></span>"; }
            ?>
          </td>
        </tr>

        <!-- <tr>
          <td class="pos-atas"> Reviu DALNIS </td>
          <td class="pos-atas"> : </td>
         <td>
            <?php
              if($kka->reviu_dalnis == NULL)
              { echo "<i class='fa fa-spinner fa-pulse orange'></i> <strong class='orange i'> Belum Direviu </strong>"; }
              elseif($kka->reviu_dalnis == "-")
              { echo "<i class='fa fa-check green'><strong> Tidak ada reviu </strong></i>"; }
              else
              { echo "<span class='red'><strong> $kka->reviu_dalnis </strong></span>"; }
            ?>
          </td>
        </tr>

        <tr>
          <td class="pos-atas"> Reviu DALTU </td>
          <td class="pos-atas"> : </td>
          <td>
            <?php
              if($kka->reviu_daltu == NULL)
              { echo "<i class='fa fa-spinner fa-pulse orange'></i> <strong class='orange i'> Belum Direviu </strong>"; }
              elseif($kka->reviu_daltu == "-")
              { echo "<i class='fa fa-check green'><strong> Tidak ada reviu </strong></i>"; }
              else
              { echo "<span class='red'><strong> $kka->reviu_daltu </strong></span>"; }
            ?>
          </td>
        </tr> -->
      </table>

    </div><!-- ./col -->
  </div><!-- ./row -->
</form>

<script type="text/javascript">
  $('#rev').hide();
  $('.rev').click(function(){
    if($(this).val() == "reviu")
    {
      $('#rev').slideDown('fast');
    }
    else
    {
      $('#rev').slideUp('fast');
    }
  });
</script>