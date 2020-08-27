<?php
//--> include data header
$this->load->view('layout/header');
//--> include data top navigasi
$this->load->view('layout/top_nav');
//--> include data sidebar navigasi
$this->load->view('layout/nav_sidebar');
?>
<div class="main-content">
    <div class="main-content-inner">

        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="<?= site_url('ketua_tim/home'); ?>"> Home </a>
                </li>
                <li class="active"> Anggaran Waktu </li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content">

            <div class="page-header">
                <h1>
                    Anggaran Waktu
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Membuat dan mengelola alokasi anggaran waktu audit
                    </small>
                </h1>
            </div><!-- /.page-header -->

            <!-- notifikasi -->
            <div><?= $this->session->flashdata("sukses"); ?></div>

            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->

                    <div class="row">
                        <div class="col-xs-12">

                            <div class="table-header">
                                Daftar Alokasi Anggaran Waktu
                            </div>

                            <!-- div.table-responsive -->
                            <div>
                                <table width="100%" id="mytable" class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th width="5%"> No </th>
                                            <th width="9%"> Tanggal </th>
                                            <th> Nama Objek Pengawasan </th>
                                            <th width="25%"> Program Pengawasan </th>
                                            <th width="10%"> Reviu DALNIS </th>
                                            <!-- <th width="10%"> Reviu DALTU </th> -->
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($anggaran as $row) {
                                            $id = base64_encode($row->id_anggaran_wkt);
                                            $tgl = date('d-m-Y', strtotime($row->tgl_agr));

                                            echo "
													<tr>
														<td align='center'> $no </td>
														<td align='center'> $tgl </td>
														<td>";
                                            if ($row->notif_ketua_tim == "baru") {
                                                echo "<i class='red ace-icon fa fa-asterisk'></i>";
                                            }
                                            echo "	
															$row->nama_op
															<a href='anggaran_waktu/detail_anggaran_waktu/$id' title='Detail alokasi anggaran waktu'>
																<span class='pull-right'> <i class='ace-icon fa fa-list bigger-130'></i> </span>
															</a>
														</td>
														<td> $row->program_peng </td>";
                                            if ($row->reviu_dalnis == NULL) {
                                                echo "<td align='center'> <i class='ace-icon fa fa-spinner fa-pulse bigger-130 orange' title='Belum direviu'></i> </td>";
                                            } elseif ($row->reviu_dalnis != "-") {
                                                echo "<td align='center'> <a href='anggaran_waktu/detail_anggaran_waktu/$id'> <i class='ace-icon fa fa-times bigger-130 red' title='Ada direviu'></i> </a> </td>";
                                            } else {
                                                echo "<td align='center'> <i class='ace-icon fa fa-check bigger-130 green' title='Sudah disetujui'></i> </td>";
                                            }

                                            /* if($row->reviu_daltu == NULL)
                                              { echo "<td align='center'> <i class='ace-icon fa fa-spinner fa-pulse bigger-130 orange' title='Belum direviu'></i> </td>"; }
                                              elseif($row->reviu_daltu != "-")
                                              { echo "<td align='center'> <a href='anggaran_waktu/detail_anggaran_waktu/$id'> <i class='ace-icon fa fa-times bigger-130 red' title='Ada direviu'></i> </a> </td>"; }
                                              else
                                              { echo "<td align='center'> <i class='ace-icon fa fa-check bigger-130 green' title='Sudah disetujui'></i> </td>"; } */
                                            echo "														
													</tr>";

                                            $no++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Konfirmasi Hapus Data -->
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 style="color:#bf1a1a" class="modal-title" id="myModalLabel"><i class="fa fa-warning"></i> Konfirmasi Hapus Data</h4>
                                </div>
                                <div class="modal-body">
                                    Apakah anda yakin ingin menghapus data ini ?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn" data-dismiss="modal"><i class='ace-icon fa fa-times'></i> Batal </button>
                                    <button type="button" id="del-row" class="btn btn-danger del-row"><i class='ace-icon fa fa-trash-o bigger-130'></i> Hapus </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /konfirmasi -->

                    <!-- PAGE CONTENT ENDS -->
                </div><!-- /.col -->
            </div><!-- /.row -->

        </div><!-- /.page-content -->

    </div>
</div><!-- /.main-content -->

<!-- include data footer -->
<?php $this->load->view('layout/footer'); ?>

<!-- inline scripts related to this page -->
<script type="text/javascript">
    $(function () {

        //notifikasi hapus
        $(document).on('click', '#delete-row', function (e) {
            e.preventDefault();
            id = $(this).data('id');
        });
        $(document).on('click', '#del-row', function (e) {
            window.location = 'anggaran_waktu/hapus_anggaran_waktu/' + id;
        });
        //.notifikasi hapus

        //datatables
        $('#mytable').DataTable({
            "paginate": true,
            "sort": false,
            "lengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]],
            "language":
                    {
                        "lengthMenu": "Lihat _MENU_ data",
                        "search": "Cari data : ",
                        "searchPlaceholder": "Cari ...",
                        "zeroRecords": "Tidak ada data yang ditemukan",
                        "emptyTable": "<center>Tidak ada data di dalam tabel</center>",
                        "infoEmpty": "Tidak ada data yang ditampilkan",
                        "info": "Menampilkan _START_ - _END_ dari _TOTAL_ data ",
                        "infoFiltered": "(Hasil filter dari _MAX_ data)",
                        oPaginate:
                                {
                                    sPrevious: "<i class='fa fa-angle-left'><i/>",
                                    sNext: "<i class='fa fa-angle-right'><i/>"
                                }
                    }
        });
        //.dattables

    });
</script>

</body>
</html>