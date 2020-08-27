<!--
  ## DETAIL SUB KKA ##
  Ditampilkan dalam modal bootstrap
-->

<table width="100%" border="0">
  <tr>
    <td width="19%" class="pos-atas"> Jenis Pekerjaan </td>
    <td width="2%" class="pos-atas"> : </td>
    <td> <?= $kka->jenis_pekerjaan; ?></td>
  </tr>

  <tr>
    <td class="pos-atas"> Uraian </td>
    <td class="pos-atas"> : </td>
    <td> <?= $kka->uraian; ?></td>
  </tr>

  <tr>
    <td class="pos-atas"> No. KKA </td>
    <td class="pos-atas"> : </td>
    <td> <?= $kka->sub_no_kka; ?></td>
  </tr>
</table> <br/>

<?php if($cek_rev > 0) { ?>
  <p class="red control-label"><i class="fa fa-recycle"></i> Riwayat Reviu Kertas Kerja Audit (KKA) <span class="pull-right"><a href='<?= site_url('anggota_tim/kka/cetak_reviu_kka/'.base64_encode($kka->sub_pka3).'/'.base64_encode($kka->sub_no_kka).'/'.base64_encode($kka->pelaksana)); ?>' class='btn btn-sm btn-danger' target="_blank" title='Cetak KKA reviu'><i class='fa fa-print'></i> Cetak Reviu</a></span></p> <br/>
  
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
            if($row->rev_kka_ketua == "-")
              { echo "<span class='green'><i class='fa fa-check'></i> Tidak ada reviu </span>"; }
            else
              { echo "<span class='red'> $row->rev_kka_ketua </span>"; }
          echo "
          </td>
          <td class='c pos-atas'>";
            if($row->rev_bukti_kka != NULL || $row->rev_bukti_kka != "")
            {
              echo "
              <div class='btn-group'>
                <button data-toggle='dropdown' class='btn btn-sm btn-primary dropdown-toggle'>
                  <i class='fa fa-download'></i>
                  <i class='ace-icon fa fa-angle-down icon-on-right'></i>
                </button>

                <ul class='dropdown-menu dropdown-primary'>
                  <li>
                    <a href='".site_url('anggota_tim/kka/download_rev_kka/'.base64_encode($row->rev_hasil_kka))."' title='Download KKA reviu'> Kertas Kerja Audit (KKA)</a>
                  </li>

                  <li>
                    <a href='".site_url('anggota_tim/kka/download_bukti_kka/'.base64_encode($row->rev_bukti_kka))."' title='Download Bukti KKA'> Bukti Pendukung KKA</a>
                  </li>
                </ul>
              </div>";
            }
            else
            {
              echo "<a href='".site_url('anggota_tim/kka/download_rev_kka/'.base64_encode($row->rev_hasil_kka))."' class='btn btn-sm btn-primary' title='Download KKA reviu'><i class='fa fa-download'></i></a>";
            }
          echo "
          </td>
        </tr>
        ";
      }
    ?>

  </table> <br/>
  <?php } ?>

<label>Berikut ini status <strong>Kertas Kerja Audit (KKA)</strong> yang telah di upload.</label> <br/>

<table width="100%" border="0">
  <tr>
    <td width="21%" class="pos-atas"> Reviu Ketua Tim </td>
    <td width="2%" class="pos-atas"> : </td>
    <td>
      <?php
        if($kka->reviu_kka_ketua == NULL)
        { echo "<i class='fa fa-spinner fa-pulse orange'></i> <strong class='orange i'> Belum Direviu </strong>"; }
        elseif($kka->reviu_kka_ketua == "-")
        { echo "<i class='fa fa-check green'><strong> Tidak ada reviu </strong></i>"; }
        else
        { echo "<span class='red'><strong> $kka->reviu_kka_ketua </strong></span>"; }
      ?>
    </td>
  </tr>

  <!-- <tr>
    <td class="pos-atas"> Reviu DALNIS </td>
    <td class="pos-atas"> : </td>
    <td>
      <?php
        if($kka->reviu_kka_dalnis == NULL)
        { echo "<i class='fa fa-spinner fa-pulse orange'></i> <strong class='orange i'> Belum Direviu </strong>"; }
        elseif($kka->reviu_kka_dalnis == "-")
        { echo "<i class='fa fa-check green'><strong> Tidak ada reviu </strong></i>"; }
        else
        { echo "<span class='red'><strong> $kka->reviu_kka_dalnis </strong></span>"; }
      ?>
    </td>
  </tr>

  <tr>
    <td class="pos-atas"> Reviu DALTU </td>
    <td class="pos-atas"> : </td>
    <td>
      <?php
        if($kka->reviu_kka_daltu == NULL)
        { echo "<i class='fa fa-spinner fa-pulse orange'></i> <strong class='orange i'> Belum Direviu </strong>"; }
        elseif($kka->reviu_kka_daltu == "-")
        { echo "<i class='fa fa-check green'><strong> Tidak ada reviu </strong></i>"; }
        else
        { echo "<span class='red'><strong> $kka->reviu_kka_daltu </strong></span>"; }
      ?>
    </td>
  </tr> -->
</table>