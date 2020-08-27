<!--
  ## DETAIL SUB KKA IKHTISAR ##
  Ditampilkan dalam modal bootstrap
-->

<table width="100%" border="0">
  <tr>
    <td width="19%" class="pos-atas"> Jenis Pekerjaan </td>
    <td width="2%" class="pos-atas"> : </td>
    <td> <?= $kka->jenis_pekerjaan; ?></td>
  </tr>
</table> <br/>

<label>Berikut ini status <strong>Kertas Kerja Audit (KKA) Ikhtisar</strong> yang telah di upload.</label> <br/>

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

  <tr>
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
  </tr>
</table>