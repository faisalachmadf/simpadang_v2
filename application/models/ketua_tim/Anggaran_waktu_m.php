<?php

error_reporting(E_ALL ^ (E_WARNING | E_NOTICE));

class Anggaran_waktu_m extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    ##############################################################
    //*************** SET ALOKASI ANGGARAN WAKTU ***************\\
    ##############################################################
    //--> ambil jenis pekerajaan

    function get_set_anggaran() {
        return $this->db->query('SELECT jenis_pekerjaan,kategori_agr_wkt as kategori,(select count(kategori_agr_wkt) as jumlah from `set_anggaran_waktu` where kategori_agr_wkt=kategori) as jumlah FROM `set_anggaran_waktu` order by kategori')->result();
         
    }

    //--> total jenis pekerjaan
    function count_set_anggaran() {
        return $this->db->select('count(id_agr_wkt) as jml')
                        ->from('set_anggaran_waktu')
                        ->get()->row();
    }

    //--> ambil jenis pekerajaan
    function get_row_set_anggaran($id_agr) {
        return $this->db->select('*')
                        ->from('set_anggaran_waktu')
                        ->where('id_agr_wkt', $id_agr)
                        ->get()->row();
    }

    //--> tambah jenis pekerjaan
    function insert_set_anggaran() {
        //--> tambah set_anggaran_waktu
        $data_agr = array(
            'jenis_pekerjaan' => $this->input->post('jenis_pekerjaan'),
            'kategori_agr_wkt' => $this->input->post('kategori')
        );
        $this->db->insert('set_anggaran_waktu', $data_agr);
    }

    //--> ubah jenis pekerjaan
    function update_set_anggaran($id_agr) {
        //--> tambah set_anggaran_waktu
        $data_agr = array(
            'jenis_pekerjaan' => $this->input->post('jenis_pekerjaan'),
            'kategori_agr_wkt' => $this->input->post('kategori')
        );
        $this->db->where('id_agr_wkt', $id_agr)
                ->update('set_anggaran_waktu', $data_agr);
    }

    //-- hapus jenis pekerjaan
    function delete_set_anggaran($id_agr) {
        return $this->db->delete('set_anggaran_waktu', array('id_agr_wkt' => $id_agr));
        ;
    }

    ####################################################################
    //*************** BATAS SET ALOKASI ANGGARAN WAKTU ***************\\
    ####################################################################
    //--> Mengecek id terakhir tb_anggaran_waktu

    function get_id_max_agr() {
        /* $kode     = "AGR";
          $sql  	= "SELECT max(id_anggaran_wkt) as max_id FROM tb_anggaran_waktu";
          $row  	= $this->db->query($sql)->row();
          $max_id = $row->max_id;
          $max_no = substr($max_id,3);
          $new_no = $max_no + 5;
          $id 		= $kode.$new_no;
          return $id; */

        return "AGR_" . date("dmYHis") . "_" . round(microtime(true) * 1000);
    }

    //--> Mengecek max reviu anggaran
    function cek_rev_agr($id_agr) {
        $sql = "SELECT max(rev_ke) as no_rev FROM rev_anggaran_waktu1 WHERE rev_agr1 = '$id_agr'";
        $row = $this->db->query($sql)->row();
        $max_no = $row->no_rev + 1;
        return $max_no;
    }

    function cek_reviu($id_agr) {
        return $this->db->query("SELECT * FROM rev_anggaran_waktu1 WHERE rev_agr1 = '$id_agr'")->num_rows();
    }

    //--> total jenis pekerjaan di sub_anggaran_waktu
    function count_agr($id_agr) {
        return $this->db->select('count(sub_anggaran_wkt) as jml')
                        ->from('sub_anggaran_waktu')
                        ->where('sub_anggaran_wkt', $id_agr)
                        ->get()->row();
    }

    //--> total jenis pekerjaan di sub_anggaran_waktu
    function count_agr_temp($id_agr) {
        return $this->db->select('count(sub_anggaran_wkt) as jml')
                        ->from('temp_aw2')
                        ->where('sub_anggaran_wkt', $id_agr)
                        ->get()->row();
    }

    //--> ambil alokasi anggaran waktu
    function get_anggaran_waktu($ketua_tim) {
        return $this->db->select('*')
                        ->from('tb_anggaran_waktu')
                        ->join('notifikasi', 'notifikasi.id_terkait = tb_anggaran_waktu.id_anggaran_wkt')
                        ->join('tb_penugasan', 'tb_penugasan.id_tugas = tb_anggaran_waktu.id_tgs')
                        ->join('tb_tim', 'tb_tim.id_tim = tb_penugasan.id_tim')
                        ->where('ketua_tim', $ketua_tim)
                        ->order_by('id_anggaran_wkt', 'desc')
                        ->get()->result();
    }

    //--> ambil alokasi anggaran waktu (daltu)
    function get_anggaran_waktu_dt($daltu) {
        return $this->db->select('*')
                        ->from('tb_anggaran_waktu')
                        ->join('notifikasi', 'notifikasi.id_terkait = tb_anggaran_waktu.id_anggaran_wkt')
                        ->join('tb_penugasan', 'tb_penugasan.id_tugas = tb_anggaran_waktu.id_tgs')
                        ->join('tb_tim', 'tb_tim.id_tim = tb_penugasan.id_tim')
                        ->where('daltu', $daltu)
                        ->order_by('id_anggaran_wkt', 'desc')
                        ->get()->result();
    }

    //--> ambil alokasi anggaran waktu (dalnis)
    function get_anggaran_waktu_dn($dalnis) {
        return $this->db->select('*')
                        ->from('tb_anggaran_waktu')
                        ->join('notifikasi', 'notifikasi.id_terkait = tb_anggaran_waktu.id_anggaran_wkt')
                        ->join('tb_penugasan', 'tb_penugasan.id_tugas = tb_anggaran_waktu.id_tgs')
                        ->join('tb_tim', 'tb_tim.id_tim = tb_penugasan.id_tim')
                        ->where('dalnis', $dalnis)
                        ->order_by('id_anggaran_wkt', 'desc')
                        ->get()->result();
    }

    //--> ambil alokasi anggaran waktu
    function get_rev_anggaran_waktu($id_agr) {
        return $this->db->select('*')
                        ->from('rev_anggaran_waktu1')/*
                          ->join('tb_anggaran_waktu', 'tb_anggaran_waktu.id_anggaran_wkt = rev_anggaran_waktu1.rev_agr1')
                          ->join('tb_penugasan', 'tb_penugasan.id_tugas = tb_anggaran_waktu.id_tgs')
                          ->join('tb_tim', 'tb_tim.id_tim = tb_penugasan.id_tim')
                          ->where('ketua_tim', $ketua_tim) */
                        ->where('rev_agr1', $id_agr)
                        ->order_by('rev_agr1', 'asc')
                        ->get()->result();
    }

    //--> ambil alokasi anggaran waktu tertentu
    function get_row_aw_temp($id_agr) {
        return $this->db->select('*')
                        ->from('temp_aw1')
                        ->join('tb_penugasan', 'tb_penugasan.id_tugas = temp_aw1.id_tgs')
                        ->join('tb_tim', 'tb_tim.id_tim = tb_penugasan.id_tim')
                        ->where('id_anggaran_wkt', $id_agr)
                        ->get()->row();
    }

    //--> ambil alokasi anggaran waktu tertentu
    function get_row_anggaran_waktu($id_agr) {
        return $this->db->select('*')
                        ->from('tb_anggaran_waktu')
                        ->join('tb_penugasan', 'tb_penugasan.id_tugas = tb_anggaran_waktu.id_tgs')
                        ->join('tb_tim', 'tb_tim.id_tim = tb_penugasan.id_tim')
                        ->where('id_anggaran_wkt', $id_agr)
                        ->get()->row();
    }

    //--> ambil sub alokasi anggaran waktu
    function get_sub_aw_temp($id_agr) {
        return $this->db->select('*')
                        ->from('temp_aw2')
                        ->where('sub_anggaran_wkt', $id_agr)
                        ->order_by('kategori', 'asc')
                        ->order_by('tes', 'asc')
                        ->get()->result();
    }

    //--> ambil sub alokasi anggaran waktu
    function get_sub_anggaran_waktu($id_agr) {
        return $this->db->select('*')
                        ->from('sub_anggaran_waktu')
                        ->where('sub_anggaran_wkt', $id_agr)
                        ->order_by('kategori', 'asc')
                        ->order_by('tes', 'asc')
                        ->get()->result();
    }

    //--> ambil reviu anggaran waktu1
    function get_row_rev_anggaran_waktu($id_agr, $no_rev) {
        return $this->db->select('*')
                        ->from('rev_anggaran_waktu1')
                        ->where('rev_agr1', $id_agr)
                        ->where('rev_ke', $no_rev)
                        ->get()->row();
    }

    //--> ambil reviu alokasi anggaran waktu2
    function get_rev_anggaran_waktu2($id_agr, $no_rev) {
        return $this->db->select('*')
                        ->from('rev_anggaran_waktu2')
                        ->where('rev_agr2', $id_agr)
                        ->where('reviu_ke', $no_rev)
                        ->order_by('kategori', 'asc')
                        ->order_by('tes', 'asc')
                        ->get()->result();
    }

    //--> simpan temporary anggaran waktu
    function insert_temp_aw() {
        $id_agr = $this->input->post('id_agr');
        $id_tgs = $this->input->post('id_tgs');
        $id_tim = $this->input->post('id_tim');        
        $this->db->delete('temp_aw1',array('id_anggaran_wkt'=>$id_agr));
        $this->db->delete('temp_aw2',array('sub_anggaran_wkt'=>$id_agr));
        
        //--> total jenis pekerjaan
        $tot = $this->input->post('total');

        $kta = $this->input->post('kategori');
        $kod = $this->input->post('kode_pekerjaan');
        $jen = $this->input->post('jenis_pekerjaan');

        $tgl2_1 = $this->input->post('tgl2_persiapan');
        $tgl2_2 = $this->input->post('tgl2_pelaksanaan');
        $tgl2_3 = $this->input->post('tgl2_penyelesaian');

        if ($tgl2_1 == "") {
            $tgl2_persiapan = NULL;
        } else {
            $tgl2_persiapan = $tgl2_1;
        }

        if ($tgl2_2 == "") {
            $tgl2_pelaksanaan = NULL;
        } else {
            $tgl2_pelaksanaan = $tgl2_2;
        }

        if ($tgl2_3 == "") {
            $tgl2_penyelesaian = NULL;
        } else {
            $tgl2_penyelesaian = $tgl2_3;
        }

        //--> tambah tb_anggaran_waktu
        $data_agr = array(
            'id_anggaran_wkt' => $id_agr,
            'id_tgs' => $id_tgs,
            'tgl_agr' => date('Y-m-d H:i:s'),
            'tgl1_persiapan' => $this->input->post('tgl1_persiapan'),
            'tgl2_persiapan' => $tgl2_persiapan,
            'tgl1_pelaksanaan' => $this->input->post('tgl1_pelaksanaan'),
            'tgl2_pelaksanaan' => $tgl2_pelaksanaan,
            'tgl1_penyelesaian' => $this->input->post('tgl1_penyelesaian'),
            'tgl2_penyelesaian' => $tgl2_penyelesaian
        );
        $this->db->insert('temp_aw1', $data_agr);

        $hri1 = $this->input->post('hari_daltu');
        $hri2 = $this->input->post('hari_dalnis');
        $hri3 = $this->input->post('hari_ketua');
        $hri4 = $this->input->post('hari_anggota');

        $jam1 = $this->input->post('jam_daltu');
        $jam2 = $this->input->post('jam_dalnis');
        $jam3 = $this->input->post('jam_ketua');
        $jam4 = $this->input->post('jam_anggota');

        $i = 0;
        while ($i <$tot) {
            $no = $i + 1;

            if ($this->input->post('daltu_' . $no) == 'aktif') {
                $daltu = $this->input->post('daltu_' . $no);
                $hri_daltu = number_format($hri1[$i], 2);
                $jam_daltu = number_format($jam1[$i], 2);
            } else {
                $daltu = $this->input->post('daltu_' . $no);
                $hri_daltu = NULL;
                $jam_daltu = NULL;
            }

            if ($this->input->post('dalnis_' . $no) == 'aktif') {
                $dalnis = $this->input->post('dalnis_' . $no);
                $hri_dalnis = number_format($hri2[$i], 2);
                $jam_dalnis = number_format($jam2[$i], 2);
            } else {
                $dalnis = $this->input->post('dalnis_' . $no);
                $hri_dalnis = NULL;
                $jam_dalnis = NULL;
            }

            if ($this->input->post('ketua_' . $no) == 'aktif') {
                $ketua = $this->input->post('ketua_' . $no);
                $hri_ketua = number_format($hri3[$i], 2);
                $jam_ketua = number_format($jam3[$i], 2);
            } else {
                $ketua = $this->input->post('ketua_' . $no);
                $hri_ketua = NULL;
                $jam_ketua = NULL;
            }

            if ($this->input->post('anggota_' . $no) == 'aktif') {
                $anggota = $this->input->post('anggota_' . $no);
                $hri_anggota = number_format($hri4[$i], 2);
                $jam_anggota = number_format($jam4[$i], 2);
            } else {
                $anggota = $this->input->post('anggota_' . $no);
                $hri_anggota = NULL;
                $jam_anggota = NULL;
            }

            $jml_1 = $hri_daltu + $hri_dalnis + $hri_ketua + $hri_anggota;
            $jml_hri = number_format($jml_1, 2);
            $jml_2 = $jam_daltu + $jam_dalnis + $jam_ketua + $jam_anggota;
            $jml_jam = number_format($jml_2, 2);

            $data_sub_agr = array(
                'sub_anggaran_wkt' => $id_agr,
                'nomor' => $i + 1,
                'kategori' => $kta[$i],
                'kode_pekerjaan' => $kod[$i],
                'jenis_pekerjaan' => $jen[$i],
                'tugas_daltu' => $daltu,
                'hari_daltu' => $hri_daltu,
                'jam_daltu' => $jam_daltu,
                'tugas_dalnis' => $dalnis,
                'hari_dalnis' => $hri_dalnis,
                'jam_dalnis' => $jam_dalnis,
                'tugas_ketua' => $ketua,
                'hari_ketua' => $hri_ketua,
                'jam_ketua' => $jam_ketua,
                'tugas_anggota' => $anggota,
                'hari_anggota' => $hri_anggota,
                'jam_anggota' => $jam_anggota,
                'jml_hari' => $jml_hri,
                'jml_jam' => $jml_jam
            );
            $this->db->insert('temp_aw2', $data_sub_agr);

            $i++;
        }

        $data_tugas = array('fk_agr' => "temp_" . $id_agr);
        $this->db->where('id_tugas', $id_tgs)
                ->update('tb_penugasan', $data_tugas);
    }

    //--> ubah temporary anggaran waktu
    function update_temp_aw() {
        $id_agr = $this->input->post('id_agr');
        $id_tgs = $this->input->post('id_tgs');
        $id_tim = $this->input->post('id_tim');

        //--> total jenis pekerjaan
        $tot = $this->input->post('total');

        $kta = $this->input->post('kategori');
        $kod = $this->input->post('kode_pekerjaan');
        $jen = $this->input->post('jenis_pekerjaan');

        $tgl2_1 = $this->input->post('tgl2_persiapan');
        $tgl2_2 = $this->input->post('tgl2_pelaksanaan');
        $tgl2_3 = $this->input->post('tgl2_penyelesaian');

        if ($tgl2_1 == "") {
            $tgl2_persiapan = NULL;
        } else {
            $tgl2_persiapan = $tgl2_1;
        }

        if ($tgl2_2 == "") {
            $tgl2_pelaksanaan = NULL;
        } else {
            $tgl2_pelaksanaan = $tgl2_2;
        }

        if ($tgl2_3 == "") {
            $tgl2_penyelesaian = NULL;
        } else {
            $tgl2_penyelesaian = $tgl2_3;
        }

        //--> tambah tb_anggaran_waktu
        $data_agr = array(
            'tgl_agr' => date('Y-m-d H:i:s'),
            'tgl1_persiapan' => $this->input->post('tgl1_persiapan'),
            'tgl2_persiapan' => $tgl2_persiapan,
            'tgl1_pelaksanaan' => $this->input->post('tgl1_pelaksanaan'),
            'tgl2_pelaksanaan' => $tgl2_pelaksanaan,
            'tgl1_penyelesaian' => $this->input->post('tgl1_penyelesaian'),
            'tgl2_penyelesaian' => $tgl2_penyelesaian
        );
        $this->db->where('id_anggaran_wkt', $id_agr)
                ->update('temp_aw1', $data_agr);

        //hapus temp_aw2
        $this->db->delete('temp_aw2', array('sub_anggaran_wkt' => $id_agr));

        $hri1 = $this->input->post('hari_daltu');
        $hri2 = $this->input->post('hari_dalnis');
        $hri3 = $this->input->post('hari_ketua');
        $hri4 = $this->input->post('hari_anggota');

        $jam1 = $this->input->post('jam_daltu');
        $jam2 = $this->input->post('jam_dalnis');
        $jam3 = $this->input->post('jam_ketua');
        $jam4 = $this->input->post('jam_anggota');

        $i = 0;
        while ($i < $tot) {
            $no = $i + 1;

            if ($this->input->post('daltu_' . $no) == 'aktif') {
                $daltu = $this->input->post('daltu_' . $no);
                $hri_daltu = number_format($hri1[$i], 2);
                $jam_daltu = number_format($jam1[$i], 2);
            } else {
                $daltu = $this->input->post('daltu_' . $no);
                $hri_daltu = NULL;
                $jam_daltu = NULL;
            }

            if ($this->input->post('dalnis_' . $no) == 'aktif') {
                $dalnis = $this->input->post('dalnis_' . $no);
                $hri_dalnis = number_format($hri2[$i], 2);
                $jam_dalnis = number_format($jam2[$i], 2);
            } else {
                $dalnis = $this->input->post('dalnis_' . $no);
                $hri_dalnis = NULL;
                $jam_dalnis = NULL;
            }

            if ($this->input->post('ketua_' . $no) == 'aktif') {
                $ketua = $this->input->post('ketua_' . $no);
                $hri_ketua = number_format($hri3[$i], 2);
                $jam_ketua = number_format($jam3[$i], 2);
            } else {
                $ketua = $this->input->post('ketua_' . $no);
                $hri_ketua = NULL;
                $jam_ketua = NULL;
            }

            if ($this->input->post('anggota_' . $no) == 'aktif') {
                $anggota = $this->input->post('anggota_' . $no);
                $hri_anggota = number_format($hri4[$i], 2);
                $jam_anggota = number_format($jam4[$i], 2);
            } else {
                $anggota = $this->input->post('anggota_' . $no);
                $hri_anggota = NULL;
                $jam_anggota = NULL;
            }

            $jml_1 = $hri_daltu + $hri_dalnis + $hri_ketua + $hri_anggota;
            $jml_hri = number_format($jml_1, 2);
            $jml_2 = $jam_daltu + $jam_dalnis + $jam_ketua + $jam_anggota;
            $jml_jam = number_format($jml_2, 2);

            $data_sub_agr = array(
                'sub_anggaran_wkt' => $id_agr,
                'nomor' => $i + 1,
                'kategori' => $kta[$i],
                'kode_pekerjaan' => $kod[$i],
                'jenis_pekerjaan' => $jen[$i],
                'tugas_daltu' => $daltu,
                'hari_daltu' => $hri_daltu,
                'jam_daltu' => $jam_daltu,
                'tugas_dalnis' => $dalnis,
                'hari_dalnis' => $hri_dalnis,
                'jam_dalnis' => $jam_dalnis,
                'tugas_ketua' => $ketua,
                'hari_ketua' => $hri_ketua,
                'jam_ketua' => $jam_ketua,
                'tugas_anggota' => $anggota,
                'hari_anggota' => $hri_anggota,
                'jam_anggota' => $jam_anggota,
                'jml_hari' => $jml_hri,
                'jml_jam' => $jml_jam
            );
            $this->db->insert('temp_aw2', $data_sub_agr);

            $i++;
        }
    }

    //--> tambah alokasi anggaran waktu
    function insert_anggaran_waktu() {
        $id_agr = $this->input->post('id_agr');
        $id_tgs = $this->input->post('id_tgs');
        $id_tim = $this->input->post('id_tim');

        //--> total jenis pekerjaan
        $tot = $this->input->post('total');

        $kta = $this->input->post('kategori');
        $kod = $this->input->post('kode_pekerjaan');
        $jen = $this->input->post('jenis_pekerjaan');
        $nmr_pkj = $this->input->post('nomor_jenis_pekerjaan');

        $tgl2_1 = $this->input->post('tgl2_persiapan');
        $tgl2_2 = $this->input->post('tgl2_pelaksanaan');
        $tgl2_3 = $this->input->post('tgl2_penyelesaian');

        if ($tgl2_1 == "") {
            $tgl2_persiapan = NULL;
        } else {
            $tgl2_persiapan = $tgl2_1;
        }

        if ($tgl2_2 == "") {
            $tgl2_pelaksanaan = NULL;
        } else {
            $tgl2_pelaksanaan = $tgl2_2;
        }

        if ($tgl2_3 == "") {
            $tgl2_penyelesaian = NULL;
        } else {
            $tgl2_penyelesaian = $tgl2_3;
        }

        //--> tambah tb_anggaran_waktu
        $data_agr = array(
            'id_anggaran_wkt' => $id_agr,
            'id_tgs' => $id_tgs,
            'tgl_agr' => date('Y-m-d H:i:s'),
            'tgl1_persiapan' => $this->input->post('tgl1_persiapan'),
            'tgl2_persiapan' => $tgl2_persiapan,
            'tgl1_pelaksanaan' => $this->input->post('tgl1_pelaksanaan'),
            'tgl2_pelaksanaan' => $tgl2_pelaksanaan,
            'tgl1_penyelesaian' => $this->input->post('tgl1_penyelesaian'),
            'tgl2_penyelesaian' => $tgl2_penyelesaian
        );
        $this->db->insert('tb_anggaran_waktu', $data_agr);

        $hri1 = $this->input->post('hari_daltu');
        $hri2 = $this->input->post('hari_dalnis');
        $hri3 = $this->input->post('hari_ketua');
        $hri4 = $this->input->post('hari_anggota');

        $jam1 = $this->input->post('jam_daltu');
        $jam2 = $this->input->post('jam_dalnis');
        $jam3 = $this->input->post('jam_ketua');
        $jam4 = $this->input->post('jam_anggota');

        $i = 0;
        while ($i < $tot) {
            $no = $i + 1;

            if ($this->input->post('daltu_' . $no) == 'aktif') {
                $daltu = $this->input->post('daltu_' . $no);
                $hri_daltu = number_format($hri1[$i], 2);
                $jam_daltu = number_format($jam1[$i], 2);
            } else {
                $daltu = $this->input->post('daltu_' . $no);
                $hri_daltu = NULL;
                $jam_daltu = NULL;
            }

            if ($this->input->post('dalnis_' . $no) == 'aktif') {
                $dalnis = $this->input->post('dalnis_' . $no);
                $hri_dalnis = number_format($hri2[$i], 2);
                $jam_dalnis = number_format($jam2[$i], 2);
            } else {
                $dalnis = $this->input->post('dalnis_' . $no);
                $hri_dalnis = NULL;
                $jam_dalnis = NULL;
            }

            if ($this->input->post('ketua_' . $no) == 'aktif') {
                $ketua = $this->input->post('ketua_' . $no);
                $hri_ketua = number_format($hri3[$i], 2);
                $jam_ketua = number_format($jam3[$i], 2);
            } else {
                $ketua = $this->input->post('ketua_' . $no);
                $hri_ketua = NULL;
                $jam_ketua = NULL;
            }

            if ($this->input->post('anggota_' . $no) == 'aktif') {
                $anggota = $this->input->post('anggota_' . $no);
                $hri_anggota = number_format($hri4[$i], 2);
                $jam_anggota = number_format($jam4[$i], 2);
            } else {
                $anggota = $this->input->post('anggota_' . $no);
                $hri_anggota = NULL;
                $jam_anggota = NULL;
            }

            $jml_1 = $hri_daltu + $hri_dalnis + $hri_ketua + $hri_anggota;
            $jml_hri = number_format($jml_1, 2);
            $jml_2 = $jam_daltu + $jam_dalnis + $jam_ketua + $jam_anggota;
            $jml_jam = number_format($jml_2, 2);

            $data_sub_agr = array(
                'sub_anggaran_wkt' => $id_agr,
                'nomor' => $nmr_pkj[$i],
                'kategori' => $kta[$i],
                'kode_pekerjaan' => $kod[$i],
                'jenis_pekerjaan' => $jen[$i],
                'tugas_daltu' => $daltu,
                'hari_daltu' => $hri_daltu,
                'jam_daltu' => $jam_daltu,
                'tugas_dalnis' => $dalnis,
                'hari_dalnis' => $hri_dalnis,
                'jam_dalnis' => $jam_dalnis,
                'tugas_ketua' => $ketua,
                'hari_ketua' => $hri_ketua,
                'jam_ketua' => $jam_ketua,
                'tugas_anggota' => $anggota,
                'hari_anggota' => $hri_anggota,
                'jam_anggota' => $jam_anggota,
                'jml_hari' => $jml_hri,
                'jml_jam' => $jml_jam
            );
            $this->db->insert('sub_anggaran_waktu', $data_sub_agr);

            $i++;
        }

        $data_tugas = array('fk_agr' => $id_agr);
        $this->db->where('id_tugas', $id_tgs)
                ->update('tb_penugasan', $data_tugas);

        $data_notif = array(
            'id_terkait' => $id_agr,
            'notif_daltu' => "baru",
            'notif_dalnis' => "baru"
        );
        $this->db->insert('notifikasi', $data_notif);

        ########## SMS GATEWAY ##########
        $sms = $this->db->get_where('set_sms', array('id' => '1'))->row();
        $tugas = $this->penugasan_m->get_row_penugasan($id_tgs);
        $sms_dn = $this->db->get_where('tb_pegawai', array('id_pegawai' => $tugas->dalnis))->row();
        $sms_dt = $this->db->get_where('tb_pegawai', array('id_pegawai' => $tugas->daltu))->row();

        $pesan = "PEMBERITAHUAN! terdapat Perencanaan Anggaran Waktu dengan NO. SURAT : $tugas->no_st yang harus direviu. Silahkan buka http://sipiko.pariamankota.go.id/index.php/log_in";

        //--> sms staff
        $array_sms1 = array(
            "id" => $tugas->no_st,
            "waktu" => date("d-m-Y H:i:s"),
            "nomor" => $sms_dn->no_tlp,
            "pesan" => $pesan,
            "email" => $sms->email,
            "status" => "new"
        );
        $this->smsgateway->outbox($sms->base_url . $sms->base_path . '/data_outbox.json', $array_sms1);

        //--> sms staff
        $array_sms2 = array(
            "id" => $tugas->no_st,
            "waktu" => date("d-m-Y H:i:s"),
            "nomor" => $sms_dt->no_tlp,
            "pesan" => $pesan,
            "email" => $sms->email,
            "status" => "new"
        );
        $this->smsgateway->outbox($sms->base_url . $sms->base_path . '/data_outbox.json', $array_sms2);
        ########## /.SMS GATEWAY ##########
    }

    //--> reviu alokasi anggaran waktu
    function reviu_anggaran_waktu() {
        $id_agr = $this->input->post('id_agr');
        $id_tgs = $this->input->post('id_tgs');

        $no_rev = $this->input->post('rev_ke'); // nomor reviu ke-n.
        $tot = $this->input->post('total'); // total jenis pekerjaan

        $get_agr1 = $this->db->get_where('tb_anggaran_waktu', array('id_anggaran_wkt' => $id_agr))->row();

        if ($get_agr1->reviu_dalnis == "-") {
            $tgl_dalnis = $get_agr1->tgl_dalnis;
            $rev_dalnis = $get_agr1->reviu_dalnis;
            $notif_dalnis = "lama";
        } else {
            $tgl_dalnis = NULL;
            $rev_dalnis = NULL;
            $notif_dalnis = "baru";

            ########## SMS GATEWAY ##########
            $sms = $this->db->get_where('set_sms', array('id' => '1'))->row();
            $tugas = $this->penugasan_m->get_row_penugasan($id_tgs);
            $sms_dn = $this->db->get_where('tb_pegawai', array('id_pegawai' => $tugas->dalnis))->row();

            $pesan = "PEMBERITAHUAN! Perencanaan Anggaran Waktu dengan NO. SURAT : $tugas->no_st telah diperbaiki. Silahkan buka http://sipiko.pariamankota.go.id/index.php/log_in";

            //--> sms staff
            $array_sms = array(
                "id" => $tugas->no_st,
                "waktu" => date("d-m-Y H:i:s"),
                "nomor" => $sms_dn->no_tlp,
                "pesan" => $pesan,
                "email" => $sms->email,
                "status" => "new"
            );
            $this->smsgateway->outbox($sms->base_url . $sms->base_path . '/data_outbox.json', $array_sms);
            ########## /.SMS GATEWAY ##########
        }

        if ($get_agr1->reviu_daltu == "-") {
            $tgl_daltu = $get_agr1->tgl_daltu;
            $rev_daltu = $get_agr1->reviu_daltu;
            $notif_daltu = "lama";
        } else {
            $tgl_daltu = NULL;
            $rev_daltu = NULL;
            $notif_daltu = "baru";

            ########## SMS GATEWAY ##########
            $sms = $this->db->get_where('set_sms', array('id' => '1'))->row();
            $tugas = $this->penugasan_m->get_row_penugasan($id_tgs);
            $sms_dt = $this->db->get_where('tb_pegawai', array('id_pegawai' => $tugas->daltu))->row();

            $pesan = "PEMBERITAHUAN! Perencanaan Anggaran Waktu dengan NO. SURAT : $tugas->no_st telah diperbaiki. Silahkan buka http://sipiko.pariamankota.go.id/index.php/log_in";

            //--> sms staff
            $array_sms = array(
                "id" => $tugas->no_st,
                "waktu" => date("d-m-Y H:i:s"),
                "nomor" => $sms_dt->no_tlp,
                "pesan" => $pesan,
                "email" => $sms->email,
                "status" => "new"
            );
            $this->smsgateway->outbox($sms->base_url . $sms->base_path . '/data_outbox.json', $array_sms);
            ########## /.SMS GATEWAY ##########
        }

        //--> memindahkan data sebelumnya ke tabel rev_anggaran_waktu1
        $data_agr1 = array(
            'rev_agr1' => $get_agr1->id_anggaran_wkt,
            'tgl_reviu' => date('Y-m-d H:i:s'),
            'rev_ke' => $no_rev,
            'rev_tgl1_persiapan' => $get_agr1->tgl1_persiapan,
            'rev_tgl2_persiapan' => $get_agr1->tgl2_persiapan,
            'rev_tgl1_pelaksanaan' => $get_agr1->tgl1_pelaksanaan,
            'rev_tgl2_pelaksanaan' => $get_agr1->tgl2_pelaksanaan,
            'rev_tgl1_penyelesaian' => $get_agr1->tgl1_penyelesaian,
            'rev_tgl2_penyelesaian' => $get_agr1->tgl2_penyelesaian,
            'tgl_rev_dalnis' => $get_agr1->tgl_dalnis,
            'tgl_rev_daltu' => $get_agr1->tgl_daltu,
            'rev_dalnis' => $get_agr1->reviu_dalnis,
            'rev_daltu' => $get_agr1->reviu_daltu
        );
        $this->db->insert('rev_anggaran_waktu1', $data_agr1);

        $get_agr2 = $this->db->get_where('sub_anggaran_waktu', array('sub_anggaran_wkt' => $id_agr))->result();
        foreach ($get_agr2 as $row) {
            $data_agr2 = array(
                'rev_agr2' => $row->sub_anggaran_wkt,
                'reviu_ke' => $no_rev,
                'nomor' => $row->nomor,
                'kategori' => $row->kategori,
                'kode_pekerjaan' => $row->kode_pekerjaan,
                'jenis_pekerjaan' => $row->jenis_pekerjaan,
                'tugas_daltu' => $row->tugas_daltu,
                'hari_daltu' => $row->hari_daltu,
                'jam_daltu' => $row->jam_daltu,
                'tugas_dalnis' => $row->tugas_dalnis,
                'hari_dalnis' => $row->hari_dalnis,
                'jam_dalnis' => $row->jam_dalnis,
                'tugas_ketua' => $row->tugas_ketua,
                'hari_ketua' => $row->hari_ketua,
                'jam_ketua' => $row->jam_ketua,
                'tugas_anggota' => $row->tugas_anggota,
                'hari_anggota' => $row->hari_anggota,
                'jam_anggota' => $row->jam_anggota,
                'jml_hari' => $row->jml_hari,
                'jml_jam' => $row->jml_jam
            );
            $this->db->insert('rev_anggaran_waktu2', $data_agr2);
        }

        //--> hapus data tb_anggaran_waktu & sub_anggaran_waktu
        $this->db->delete('tb_anggaran_waktu', array('id_anggaran_wkt' => $id_agr));
        $this->db->delete('sub_anggaran_waktu', array('sub_anggaran_wkt' => $id_agr));

        $kta = $this->input->post('kategori');
        $kod = $this->input->post('kode_pekerjaan');
        $jen = $this->input->post('jenis_pekerjaan');

        $tgl2_1 = $this->input->post('tgl2_persiapan');
        $tgl2_2 = $this->input->post('tgl2_pelaksanaan');
        $tgl2_3 = $this->input->post('tgl2_penyelesaian');

        if ($tgl2_1 == "") {
            $tgl2_persiapan = NULL;
        } else {
            $tgl2_persiapan = $tgl2_1;
        }

        if ($tgl2_2 == "") {
            $tgl2_pelaksanaan = NULL;
        } else {
            $tgl2_pelaksanaan = $tgl2_2;
        }

        if ($tgl2_3 == "") {
            $tgl2_penyelesaian = NULL;
        } else {
            $tgl2_penyelesaian = $tgl2_3;
        }

        //--> tambah tb_anggaran_waktu
        $data_agr = array(
            'id_anggaran_wkt' => $id_agr,
            'id_tgs' => $id_tgs,
            'tgl_agr' => $this->input->post('tgl_agr'),
            'tgl1_persiapan' => $this->input->post('tgl1_persiapan'),
            'tgl2_persiapan' => $tgl2_persiapan,
            'tgl1_pelaksanaan' => $this->input->post('tgl1_pelaksanaan'),
            'tgl2_pelaksanaan' => $tgl2_pelaksanaan,
            'tgl1_penyelesaian' => $this->input->post('tgl1_penyelesaian'),
            'tgl2_penyelesaian' => $tgl2_penyelesaian,
            'tgl_dalnis' => $tgl_dalnis,
            'tgl_daltu' => $tgl_daltu,
            'reviu_dalnis' => $rev_dalnis,
            'reviu_daltu' => $rev_daltu,
        );
        $this->db->insert('tb_anggaran_waktu', $data_agr);

        $hri1 = $this->input->post('hari_daltu');
        $hri2 = $this->input->post('hari_dalnis');
        $hri3 = $this->input->post('hari_ketua');
        $hri4 = $this->input->post('hari_anggota');

        $jam1 = $this->input->post('jam_daltu');
        $jam2 = $this->input->post('jam_dalnis');
        $jam3 = $this->input->post('jam_ketua');
        $jam4 = $this->input->post('jam_anggota');

        $i = 0;
        while ($i < $tot) {
            $no = $i + 1;

            if ($this->input->post('daltu_' . $no) == 'aktif') {
                $daltu = $this->input->post('daltu_' . $no);
                $hri_daltu = number_format($hri1[$i], 2);
                $jam_daltu = number_format($jam1[$i], 2);
            } else {
                $daltu = $this->input->post('daltu_' . $no);
                $hri_daltu = NULL;
                $jam_daltu = NULL;
            }

            if ($this->input->post('dalnis_' . $no) == 'aktif') {
                $dalnis = $this->input->post('dalnis_' . $no);
                $hri_dalnis = number_format($hri2[$i], 2);
                $jam_dalnis = number_format($jam2[$i], 2);
            } else {
                $dalnis = $this->input->post('dalnis_' . $no);
                $hri_dalnis = NULL;
                $jam_dalnis = NULL;
            }

            if ($this->input->post('ketua_' . $no) == 'aktif') {
                $ketua = $this->input->post('ketua_' . $no);
                $hri_ketua = number_format($hri3[$i], 2);
                $jam_ketua = number_format($jam3[$i], 2);
            } else {
                $ketua = $this->input->post('ketua_' . $no);
                $hri_ketua = NULL;
                $jam_ketua = NULL;
            }

            if ($this->input->post('anggota_' . $no) == 'aktif') {
                $anggota = $this->input->post('anggota_' . $no);
                $hri_anggota = number_format($hri4[$i], 2);
                $jam_anggota = number_format($jam4[$i], 2);
            } else {
                $anggota = $this->input->post('anggota_' . $no);
                $hri_anggota = NULL;
                $jam_anggota = NULL;
            }

            $jml_1 = $hri_daltu + $hri_dalnis + $hri_ketua + $hri_anggota;
            $jml_hri = number_format($jml_1, 2);
            $jml_2 = $jam_daltu + $jam_dalnis + $jam_ketua + $jam_anggota;
            $jml_jam = number_format($jml_2, 2);

            $data_sub_agr = array(
                'sub_anggaran_wkt' => $id_agr,
                'nomor' => $i + 1,
                'kategori' => $kta[$i],
                'kode_pekerjaan' => $kod[$i],
                'jenis_pekerjaan' => $jen[$i],
                'tugas_daltu' => $daltu,
                'hari_daltu' => $hri_daltu,
                'jam_daltu' => $jam_daltu,
                'tugas_dalnis' => $dalnis,
                'hari_dalnis' => $hri_dalnis,
                'jam_dalnis' => $jam_dalnis,
                'tugas_ketua' => $ketua,
                'hari_ketua' => $hri_ketua,
                'jam_ketua' => $jam_ketua,
                'tugas_anggota' => $anggota,
                'hari_anggota' => $hri_anggota,
                'jam_anggota' => $jam_anggota,
                'jml_hari' => $jml_hri,
                'jml_jam' => $jml_jam
            );
            $this->db->insert('sub_anggaran_waktu', $data_sub_agr);

            $i++;
        }

        $data_notif = array(
            'notif_daltu' => $notif_daltu,
            'notif_dalnis' => $notif_dalnis
        );
        $this->db->where('id_terkait', $id_agr)
                ->update('notifikasi', $data_notif);
    }

    function persetujuan_dalnis($id_agr) {
        $cek = $this->db->get_where('tb_anggaran_waktu', array('id_anggaran_wkt' => $id_agr))->row();
        if ($this->input->post('reviu') == 'setujui') {
            $catatan = "-";
        } else {
            $catatan = $this->input->post('catatan');
        }

        if ($catatan == "-") { //&& $cek->reviu_daltu == '-')
            $keputusan = "selesai";
        } else {
            $keputusan = "belum";
        }

        //--> ubah tb_anggaran_waktu
        $data_agr = array(
            'tgl_dalnis' => date('Y-m-d H:i:s'),
            'reviu_dalnis' => $catatan,
            'keputusan_agr' => $keputusan
        );
        $this->db->where('id_anggaran_wkt', $id_agr)
                ->update('tb_anggaran_waktu', $data_agr);

        if ($catatan != NULL) { //&& $cek->reviu_daltu != NULL)
            //--> ubah notifikasi
            $data_notif = array(
                'notif_ketua_tim' => "baru"
            );
            $this->db->where('id_terkait', $id_agr)
                    ->update('notifikasi', $data_notif);

            ########## SMS GATEWAY ##########
            $sms = $this->db->get_where('set_sms', array('id' => '1'))->row();
            $tugas = $this->penugasan_m->get_row_penugasan($cek->id_tgs);
            $sms_kt = $this->db->get_where('tb_pegawai', array('id_pegawai' => $tugas->ketua_tim))->row();

            $pesan = "PEMBERITAHUAN! Recana Anggaran Waktu dengan NO. SURAT : $tugas->no_st telah direviu. Silahkan buka http://sipiko.pariamankota.go.id/index.php/log_in";

            //--> sms staff
            $array_sms1 = array(
                "id" => $tugas->no_st,
                "waktu" => date("d-m-Y H:i:s"),
                "nomor" => $sms_kt->no_tlp,
                "pesan" => $pesan,
                "email" => $sms->email,
                "status" => "new"
            );
            $this->smsgateway->outbox($sms->base_url . $sms->base_path . '/data_outbox.json', $array_sms1);
            ########## /.SMS GATEWAY ##########
        }
    }

    function persetujuan_daltu($id_agr) {
        $cek = $this->db->get_where('tb_anggaran_waktu', array('id_anggaran_wkt' => $id_agr))->row();

        if ($this->input->post('reviu') == 'setujui') {
            $catatan = "-";
        } else {
            $catatan = $this->input->post('catatan');
        }

        if ($cek->reviu_dalnis == '-' && $catatan == "-") {
            $keputusan = "selesai";
        } else {
            $keputusan = "belum";
        }

        //--> ubah tb_anggaran_waktu
        $data_agr = array(
            'tgl_daltu' => date('Y-m-d H:i:s'),
            'reviu_daltu' => $catatan,
            'keputusan_agr' => $keputusan
        );
        $this->db->where('id_anggaran_wkt', $id_agr)
                ->update('tb_anggaran_waktu', $data_agr);

        if ($cek->reviu_dalnis != NULL && $catatan != NULL) {
            //--> ubah notifikasi
            $data_notif = array(
                'notif_ketua_tim' => "baru"
            );
            $this->db->where('id_terkait', $id_agr)
                    ->update('notifikasi', $data_notif);

            ########## SMS GATEWAY ##########
            $sms = $this->db->get_where('set_sms', array('id' => '1'))->row();
            $tugas = $this->penugasan_m->get_row_penugasan($cek->id_tgs);
            $sms_kt = $this->db->get_where('tb_pegawai', array('id_pegawai' => $tugas->ketua_tim))->row();

            $pesan = "PEMBERITAHUAN! Recana Anggaran Waktu dengan NO. SURAT : $tugas->no_st telah direviu. Silahkan buka http://sipiko.pariamankota.go.id/index.php/log_in";

            //--> sms staff
            $array_sms1 = array(
                "id" => $tugas->no_st,
                "waktu" => date("d-m-Y H:i:s"),
                "nomor" => $sms_kt->no_tlp,
                "pesan" => $pesan,
                "email" => $sms->email,
                "status" => "new"
            );
            $this->smsgateway->outbox($sms->base_url . $sms->base_path . '/data_outbox.json', $array_sms1);
            ########## /.SMS GATEWAY ##########
        }
    }
     public function get_id_pka($id_tgs){
        $this->db->select('id_pka');
        $this->db->from('tb_pka');
        $this->db->where("id_tgs='$id_tgs'");
        $data = $this->db->get()->result_array();
        if(count($data)>0){
            return $data[0]['id_pka'];
        }
    }

}
