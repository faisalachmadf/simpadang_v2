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

<label>Berikut ini status <strong>Kertas Kerja Audit (KKA)</strong> yang telah di upload.</label> <br/>

<table width="100%" border="0">
  <tr>
    <td width="19%" class="pos-atas"> Reviu Ketua Tim </td>
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

  <tr>
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
  </tr>
</table>