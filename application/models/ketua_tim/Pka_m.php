<?php

error_reporting(E_ALL ^ (E_WARNING | E_NOTICE));

class Pka_m extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    //--> Mengecek id terakhir tb_pka
    function get_id_max_pka() {
        /* $kode     = "PKA";
          $sql  	= "SELECT max(id_pka) as max_id FROM tb_pka";
          $row  	= $this->db->query($sql)->row();
          $max_id = $row->max_id;
          $max_no = substr($max_id,3);
          $new_no = $max_no + 5;
          $id 		= $kode.$new_no;
          return $id; */

        return "PKA_" . date("dmYHis") . "_" . round(microtime(true) * 1000);
    }

    function get_abjad_plus($id) {
        return chr(ord($id) + 1);
    }

    function get_abjad_minus($id) {
        return chr(ord($id) - 1);
    }

    //--> Mengecek max reviu pka
    function cek_rev_pka($id_pka) {
        $sql = "SELECT max(rev_ke) as no_rev FROM rev_pka1 WHERE rev_pka1 = '$id_pka'";
        $row = $this->db->query($sql)->row();
        $max_no = $row->no_rev + 1;
        return $max_no;
    }

    function cek_reviu($id_pka) {
        return $this->db->query("SELECT * FROM rev_pka1 WHERE rev_pka1 = '$id_pka'")->num_rows();
    }

    //--> Mengecek max reviu kka
    function cek_rev_kka($id_pka, $no_kka, $anggota) {
        $sql = "SELECT max(rev_ke) as no_rev FROM rev_kka WHERE rev_sub_pka='$id_pka' AND rev_no_kka='$no_kka' AND rev_pelaksana='$anggota'";
        $row = $this->db->query($sql)->row();
        $max_no = $row->no_rev + 1;
        return $max_no;
    }

    function cek_reviu_kka($id_pka, $no_kka, $anggota) {
        return $this->db->query("SELECT * FROM rev_kka WHERE rev_sub_pka='$id_pka' AND rev_no_kka='$no_kka' AND rev_pelaksana='$anggota'")->num_rows();
    }

    //--> Mengecek max reviu kka ikhtisar
    function cek_rev_kka_ikhtisar($id_pka, $no_kka) {
        $sql = "SELECT max(rev_ke) as no_rev FROM rev_kka_ikhtisar WHERE rev_sub_pka='$id_pka' AND rev_no_kka='$no_kka'";
        $row = $this->db->query($sql)->row();
        $max_no = $row->no_rev + 1;
        return $max_no;
    }

    function cek_reviu_kka_ikhtisar($id_pka, $no_kka) {
        return $this->db->query("SELECT * FROM rev_kka_ikhtisar WHERE rev_sub_pka='$id_pka' AND rev_no_kka='$no_kka'")->num_rows();
    }

    //--> total pelaksana di sub_pka3
    function count_temp_pka2($id_pka) {
        return $this->db->select('count(sub_pka1) as jml')
                        ->from('temp_pka2')
                        ->where('sub_pka1', $id_pka)
                        ->get()->row();
    }

    //--> total uraian di sub_pka2 B. Langkah
    function count_temp_pka2tjnPKA($id_pka) {
        return $this->db->select('count(sub_pka1) as jml')
                        ->from('temp_pka2')
                        ->where('tujuan_pka !=', NULL)
                        ->where('sub_pka1', $id_pka)
                        ->get()->row();
    }

    //--> total uraian di sub_pka2 A. Tujuan
    function count_temp_pka3tjn($id_pka) {
        return $this->db->select('count(sub_pka2) as jml')
                        ->from('temp_pka3')
                        ->where('sub_pka2', $id_pka)
                        ->like('kode_uraian', 'A')
                        ->get()->row();
    }

    //--> total uraian di sub_pka2 B. Langkah
    function count_temp_pka3lkh($id_pka) {
        return $this->db->select('count(sub_pka2) as jml')
                        ->from('temp_pka3')
                        ->where('sub_pka2', $id_pka)
                        ->like('kode_uraian', 'B')
                        ->get()->row();
    }

    //--> total pelaksana di sub_pka3
    function count_temp_pka4($id_pka) {
        return $this->db->select('count(sub_pka3) as jml')
                        ->from('temp_pka4')
                        ->where('sub_pka3', $id_pka)
                        ->get()->row();
    }

    #################
    //--> total pelaksana di sub_pka3

    function count_sub_pka1($id_pka) {
        return $this->db->select('count(sub_pka1) as jml')
                        ->from('sub_pka1')
                        ->where('sub_pka1', $id_pka)
                        ->get()->row();
    }

    //--> total uraian di sub_pka2 B. Langkah
    function count_sub_pka1tjnPKA($id_pka) {
        return $this->db->select('count(sub_pka1) as jml')
                        ->from('sub_pka1')
                        ->where('tujuan_pka !=', NULL)
                        ->where('sub_pka1', $id_pka)
                        ->get()->row();
    }

    //--> total uraian di sub_pka2 A. Tujuan
    function count_sub_pka2tjn($id_pka) {
        return $this->db->select('count(sub_pka2) as jml')
                        ->from('sub_pka2')
                        ->where('sub_pka2', $id_pka)
                        ->like('kode_uraian', 'A')
                        ->get()->row();
    }

    //--> total uraian di sub_pka2 B. Langkah
    function count_sub_pka2lkh($id_pka) {
        return $this->db->select('count(sub_pka2) as jml')
                        ->from('sub_pka2')
                        ->where('sub_pka2', $id_pka)
                        ->like('kode_uraian', 'B')
                        ->get()->row();
    }

    //--> total pelaksana di sub_pka3
    function count_sub_pka3($id_pka) {
        return $this->db->select('count(sub_pka3) as jml')
                        ->from('sub_pka3')
                        ->where('sub_pka3', $id_pka)
                        ->get()->row();
    }

    //--> ambil data pka di tb_pka sesuai tugas untuk ketua tim tertentu
    function get_pka($ketua_tim) {
        return $this->db->select('*')
                        ->from('tb_pka')
                        ->join('notifikasi', 'notifikasi.id_terkait = tb_pka.id_pka')
                        ->join('tb_penugasan', 'tb_penugasan.id_tugas = tb_pka.id_tgs')
                        ->join('tb_tim', 'tb_tim.id_tim = tb_penugasan.id_tim')
                        ->where('ketua_tim', $ketua_tim)
                        ->order_by('id_pka', 'desc')
                        ->get()->result();
    }

    //--> ambil data pka di tb_pka sesuai tugas untuk daltu tertentu
    function get_pka_dt($daltu) {
        return $this->db->select('*')
                        ->from('tb_pka')
                        ->join('notifikasi', 'notifikasi.id_terkait = tb_pka.id_pka')
                        ->join('tb_penugasan', 'tb_penugasan.id_tugas = tb_pka.id_tgs')
                        ->join('tb_tim', 'tb_tim.id_tim = tb_penugasan.id_tim')
                        ->where('daltu', $daltu)
                        ->order_by('id_pka', 'desc')
                        ->get()->result();
    }

    //--> ambil data pka di tb_pka sesuai tugas untuk dalnis tertentu
    function get_pka_dn($dalnis) {
        return $this->db->select('*')
                        ->from('tb_pka')
                        ->join('notifikasi', 'notifikasi.id_terkait = tb_pka.id_pka')
                        ->join('tb_penugasan', 'tb_penugasan.id_tugas = tb_pka.id_tgs')
                        ->join('tb_tim', 'tb_tim.id_tim = tb_penugasan.id_tim')
                        ->where('dalnis', $dalnis)
                        ->order_by('id_pka', 'desc')
                        ->get()->result();
    }

    //--> ambil data pka di tb_pka sesuai tugas untuk anggota tertentu
    function get_pka_ag($anggota) {
        return $this->db->select('*')
                        ->from('tb_pka')
                        ->join('tb_penugasan', 'tb_penugasan.id_tugas = tb_pka.id_tgs')
                        ->join('sub_tim', 'sub_tim.sub_id_tim = tb_penugasan.id_tim')
                        ->where('anggota', $anggota)
                        ->get()->result();
    }

    //--> ambil tb_pka (per-baris)
    function get_row_pka($id_pka) {
        return $this->db->select('*')
                        ->from('tb_pka')
                        ->join('tb_penugasan', 'tb_penugasan.id_tugas = tb_pka.id_tgs')
                        ->join('tb_tim', 'tb_tim.id_tim = tb_penugasan.id_tim')
                        ->join('tb_surat', 'tb_surat.no_surat = tb_penugasan.no_st')
                        ->where('id_pka', $id_pka)
                        ->get()->row();
    }

    //--> ambil tb_pka (per-baris)
    function get_row_temp_pka($id_pka) {
        return $this->db->select('*')
                        ->from('temp_pka1')
                        ->join('tb_penugasan', 'tb_penugasan.id_tugas = temp_pka1.id_tgs')
                        ->join('tb_tim', 'tb_tim.id_tim = tb_penugasan.id_tim')
                        ->join('tb_surat', 'tb_surat.no_surat = tb_penugasan.no_st')
                        ->where('id_pka', $id_pka)
                        ->get()->row();
    }

    //--> ambil data row pka di sub_pka1 (sesuai id & kode pekerjaan)
    /* function get_row_sub_pka1($id_pka, $kode_pekerjaan)
      {
      return $this->db->select('*')
      ->from('sub_pka1')
      ->where('sub_pka1', $id_pka)
      ->where('kode_pekerjaan', $kode_pekerjaan)
      ->get()->row();
      } */

    //--> ambil data row pka di sub_pka1 (sesuai id & kode pekerjaan)
    function get_row_sub_pka2($id_pka, $no_kka) {
        return $this->db->select('*')
                        ->from('sub_pka2')
                        ->where('sub_pka2', $id_pka)
                        ->where('no_kka', $no_kka)
                        ->get()->row();
    }

    //--> ambil data pka di sub_pka1 (sesuai id)
    function get_temp_pka2_instansi($id_pka) {
        return $this->db->select('nama_instansi')
                        ->from('temp_pka2')
                        ->where('sub_pka1', $id_pka)
                        ->group_by('nama_instansi')
                        ->get()->result();
    }

    //--> ambil data pka di sub_pka1 (sesuai id)
    function get_sub_pka1_instansi($id_pka) {
        return $this->db->select('nama_instansi')
                        ->from('sub_pka1')
                        ->where('sub_pka1', $id_pka)
                        ->group_by('nama_instansi')
                        ->get()->result();
    }

    //--> ambil data pka di sub_pka1 (sesuai id)
    function get_sub_temp_pka2($id_pka) {
        return $this->db->select('*')
                        ->from('temp_pka2')
                        ->where('sub_pka1', $id_pka)
                        ->order_by('kategori', 'asc')
                        ->order_by('tes', 'asc')
                        ->get()->result();
    }

    //--> ambil data pka di sub_pka2 (sesuai id)
    function get_sub_temp_pka3($id_pka) {
        return $this->db->select('*')
                        ->from('temp_pka3')
                        ->where('sub_pka2', $id_pka)
                        ->get()->result();
    }

    //--> ambil data pka di sub_pka3 (sesuai id)
    function get_sub_temp_pka4($id_pka) {
        return $this->db->select('*')
                        ->from('temp_pka4')
                        ->join('tb_pegawai', 'tb_pegawai.id_pegawai = temp_pka4.pelaksana')
                        ->where('sub_pka3', $id_pka)
                        ->get()->result();
    }

    //--> ambil data pka di sub_pka1 (sesuai id)
    function get_sub_pka1($id_pka) {
        return $this->db->select('*')
                        ->from('sub_pka1')
                        ->where('sub_pka1', $id_pka)
                        ->order_by('kategori', 'asc')
                        ->order_by('tes', 'asc')
                        ->get()->result();
    }

    //--> ambil data pka di sub_pka2 (sesuai id)
    function get_sub_pka2($id_pka) {
        return $this->db->select('*')
                        ->from('sub_pka2')
                        ->where('sub_pka2', $id_pka)
                        ->get()->result();
    }

    //--> ambil data pka di sub_pka3 (sesuai id)
    function get_sub_pka3($id_pka) {
        return $this->db->select('*')
                        ->from('sub_pka3')
                        ->join('tb_pegawai', 'tb_pegawai.id_pegawai = sub_pka3.pelaksana')
                        ->where('sub_pka3', $id_pka)
                        ->get()->result();
    }

    //--> ambil data reviu pka di rev_pka1
    function get_rev_pka($id_pka) {
        return $this->db->select('*')
                        ->from('rev_pka1')
                        ->where('rev_pka1', $id_pka)
                        ->order_by('rev_ke', 'asc')
                        ->get()->result();
    }

    //--> ambil data reviu di tabel rev_pka1
    function get_rev_pka1($id_pka, $no_rev) {
        return $this->db->select('*')
                        ->from('rev_pka1')
                        ->where('rev_pka1', $id_pka)
                        ->where('rev_ke', $no_rev)
                        ->get()->row();
    }

    //--> ambil data reviu di tabel rev_pka2
    function get_rev_pka2($id_pka, $no_rev) {
        return $this->db->select('*')
                        ->from('rev_pka2')
                        ->where('rev_pka2', $id_pka)
                        ->where('rev_ke', $no_rev)
                        ->order_by('kategori', 'asc')
                        ->order_by('tes', 'asc')
                        ->get()->result();
    }

    //--> ambil data pka di sub_pka1 (sesuai id)
    function get_rev_pka2_instansi($id_pka, $no_rev) {
        return $this->db->select('nama_instansi')
                        ->from('rev_pka2')
                        ->where('rev_pka2', $id_pka)
                        ->where('rev_ke', $no_rev)
                        ->group_by('nama_instansi')
                        ->get()->result();
    }

    //--> ambil data reviu di tabel rev_pka3
    function get_rev_pka3($id_pka, $no_rev) {
        return $this->db->select('*')
                        ->from('rev_pka3')
                        ->where('rev_pka3', $id_pka)
                        ->where('rev_ke', $no_rev)
                        ->get()->result();
    }

    //--> ambil data reviu di tabel rev_pka4
    function get_rev_pka4($id_pka, $no_rev) {
        return $this->db->select('*')
                        ->from('rev_pka4')
                        ->where('rev_pka4', $id_pka)
                        ->join('tb_pegawai', 'tb_pegawai.id_pegawai = rev_pka4.pelaksana')
                        ->where('rev_ke', $no_rev)
                        ->get()->result();
    }

    //--> ambil data kka tertentu di tabel sub_pka3 untuk ketua tim, dalnis dan daltu (Yang MEREVIU)
    function get_kka($id_pka) {
        return $this->db->select('*')
                        ->from('sub_pka3')
                        ->join('sub_pka2', 'sub_pka2.no_kka = sub_pka3.sub_no_kka')
                        ->join('sub_pka1', 'sub_pka1.kode_pekerjaan = sub_pka2.kode_pekerjaan')
                        ->join('tb_pegawai', 'tb_pegawai.id_pegawai = sub_pka3.pelaksana')
                        ->where('sub_pka3', $id_pka)
                        ->where('jbtn_tim', 'Anggota Tim')
                        ->like('kode_uraian', 'B')
                        ->get()->result();
    }

    //--> ambil data kka tertentu di tabel sub_pka3 (sesuai id dan anggota) untuk anggota tertentu
    function get_kka_agt($id_pka, $anggota) {
        return $this->db->select('*')
                        ->from('sub_pka3')
                        ->join('sub_pka2', 'sub_pka2.no_kka = sub_pka3.sub_no_kka')
                        ->join('sub_pka1', 'sub_pka1.kode_pekerjaan = sub_pka2.kode_pekerjaan')
                        ->where('sub_pka1', $id_pka)
                        ->where('sub_pka2', $id_pka)
                        ->where('sub_pka3', $id_pka)
                        ->where('pelaksana', $anggota)
                        //->like('kode_uraian', 'B')
                        //->group_by('sub_no_kka')
                        ->get()->result();
    }

    function get_kka_ikhtisar($id_pka) {
        return $this->db->select('*')
                        ->from('sub_pka2')
                        ->join('sub_pka1', 'sub_pka1.kode_pekerjaan = sub_pka2.kode_pekerjaan')
                        ->where('sub_pka1', $id_pka)
                        //->where('jbtn_tim', 'Anggota Tim')
                        ->like('kode_uraian', 'B')
                        ->get()->result();
    }

    //--> ambil data kka tertentu di tabel sub_pka3 (sesuai id dan anggota) untuk anggota tertentu
    function get_kka_ikhtisar_agt($id_pka, $anggota) {
        return $this->db->select('*')
                        ->from('sub_pka3')
                        ->join('sub_pka2', 'sub_pka2.no_kka = sub_pka3.sub_no_kka')
                        ->join('sub_pka1', 'sub_pka1.kode_pekerjaan = sub_pka2.kode_pekerjaan')
                        ->where('sub_pka3', $id_pka)
                        ->where('pelaksana', $anggota)
                        ->like('kode_uraian', 'B')
                        //->group_by('jenis_pekerjaan')
                        ->order_by('sub_pka1', 'asc')
                        ->get()->result();
    }

    //--> ambil data kka tertentu di tabel sub_pka3 (sesuai id dan anggota) untuk anggota tertentu
    function get_penyusun_ikhtisar($id_pka, $no_kka) {
        return $this->db->select('*')
                        ->from('sub_pka3')
                        ->join('sub_pka2', 'sub_pka2.no_kka = sub_pka3.sub_no_kka')
                        ->join('tb_pegawai', 'tb_pegawai.id_pegawai = sub_pka3.pelaksana')
                        ->where('sub_pka3', $id_pka)
                        ->where('sub_no_kka', $no_kka)
                        ->get()->result();
    }

    //--> ambil data kka tertentu di tabel sub_pka3 (sesuai id dan anggota)
    function get_row_kka($no_kka, $anggota, $id_pka) {
        return $this->db->select('*')
                        ->from('sub_pka3')
                        ->join('sub_pka2', 'sub_pka2.no_kka = sub_pka3.sub_no_kka')
                        ->join('sub_pka1', 'sub_pka1.kode_pekerjaan = sub_pka2.kode_pekerjaan')
                        ->join('tb_pegawai', 'tb_pegawai.id_pegawai = sub_pka3.pelaksana')
                        ->where('sub_pka1', $id_pka)
                        ->where('sub_pka2', $id_pka)
                        ->where('sub_pka3', $id_pka)
                        ->where('sub_no_kka', $no_kka)
                        ->where('pelaksana', $anggota)
                        ->get()->row();
    }

    //--> ambil data reviu kka tertentu di tabel rev_kka (sesuai id dan anggota)
    function get_rev_kka($id_pka, $no_kka, $anggota) {
        return $this->db->select('*')
                        ->from('rev_kka')
                        ->where('rev_sub_pka', $id_pka)
                        ->where('rev_no_kka', $no_kka)
                        ->where('rev_pelaksana', $anggota)
                        ->get()->result();
    }

    //--> ambil data reviu kka tertentu di tabel rev_kka (sesuai id dan anggota)
    function get_rev_kka_ikhtisar($id_pka, $no_kka) {
        return $this->db->select('*')
                        ->from('rev_kka_ikhtisar')
                        ->where('rev_sub_pka', $id_pka)
                        ->where('rev_no_kka', $no_kka)
                        ->get()->result();
    }

    //--> simpan temporary pka
    function insert_temp_pka() {
        $id_pka = $this->input->post('id_pka');
        $id_tgs = $this->input->post('id_tgs');
        $id_tim = $this->input->post('id_tim');

        $jml_ins = $this->input->post('jml_ins');
        $jml_jp = $this->input->post('jml_jp');
        $jml_tjn = $this->input->post('jml_tjn');
        $jml_lkh = $this->input->post('jml_lkh');
        $jml_2 = $jml_tjn + $jml_lkh;
        $jml_agt = $this->input->post('jml_agt');
        $jml_tjn_pka = $this->input->post('jml_tjnPKA') - 1;

        $kta = $this->input->post('kategori');
        $kod = $this->input->post('kode_pekerjaan');
        $jen = $this->input->post('jenis_pekerjaan');
        $ins = $this->input->post('nama_instansi');
        $tjn_pka = $this->input->post('tjn_pka');

        $no_ins = $this->input->post('no_ins');
        $no_kat = $this->input->post('no_kat');
        $nama_periksa = $this->input->post('nama_periksa');
        $kode_periksa = $this->input->post('kode_periksa');
        $tanggal = $this->input->post('tanggal');
        $no_kka = $this->input->post('no_kka');
        $keterangan = $this->input->post('keterangan');

        $pelaksana = $this->input->post('pelaksana');
        $no_kka2 = $this->input->post('no_kka2');
        $nomor = $this->input->post('nomor');

        //--> tambah temp_pka1
        $data_pka = array(
            'id_pka' => $id_pka,
            'id_tgs' => $id_tgs,
            'tgl_pka' => date('Y-m-d H:i:s'),
            'masa_periksa' => $this->input->post('masa_periksa'),
            'no_ref_pka' => $this->input->post('no_ref_pka')
        );
        $this->db->insert('temp_pka1', $data_pka);

        //--> tambah temp_pka2
        if ($jml_jp > $jml_tjn_pka) {
            $jml_sub1 = $jml_jp;
        } else {
            $jml_sub1 = $jml_tjn_pka;
        }

        $i = 0;
        while ($i < $jml_sub1) {
            if ($jml_ins != "1") {
                $instansi = $ins[$i];
            } else {
                $instansi = "-";
            }

            $data_sub_pka1 = array(
                'sub_pka1' => $id_pka,
                'nomor' => $i + 1,
                'kategori' => $kta[$i],
                'kode_pekerjaan' => $kod[$i],
                'jenis_pekerjaan' => $jen[$i],
                'nama_instansi' => $instansi,
                'tujuan_pka' => $tjn_pka[$i]
            );
            $this->db->insert('temp_pka2', $data_sub_pka1);

            $i++;
        }

        //--> tambah temp_pka3
        $j = 0;
        while ($j < $jml_2) {
            if ($jml_ins != "1") {
                $kode_uraian = "$no_ins[$j]-$no_kat[$j]-$kode_periksa[$j]";
                $kode_pekerjaan = "$id_pka-$no_ins[$j]-$no_kat[$j]";
                $nomor_kka = $no_kka[$j];
            } else {
                $kode_pekerjaan = "$id_pka-$no_kat[$j]";
                $kode_uraian = "$no_kat[$j]-$kode_periksa[$j]";
                $nomor_kka = str_replace('..', '.', $no_kka[$j]);
            }

            if ($tanggal[$j] == "") {
                $tgl_krj = NULL;
            } else {
                $tgl_krj = $tanggal[$j];
            }

            if ($nama_periksa[$j] == "-" && $nomor_kka != "a") {
                $kep_kka_ikhtisar = "selesai";
            } else {
                $kep_kka_ikhtisar = "belum";
            } //update

            $data_sub_pka2 = array(
                'sub_pka2' => $id_pka,
                'kode_pekerjaan' => $kode_pekerjaan,
                'kode_uraian' => $kode_uraian,
                'uraian' => $nama_periksa[$j],
                'tgl_kerja' => $tgl_krj,
                'no_kka' => $nomor_kka,
                'keterangan' => $keterangan[$j],
                'keputusan_kka_ikhtisar' => $kep_kka_ikhtisar //update
            );
            $this->db->insert('temp_pka3', $data_sub_pka2);

            $j++;
        }

        //--> tambah temp_pka4
        $k = 0;
        while ($k < $jml_agt) {
            if ($jml_ins != "1") {
                $nomor_kka2 = $no_kka2[$k];
            } else {
                $nomor_kka2 = str_replace('..', '.', $no_kka2[$k]);
            }

            $getPelaksana = substr($pelaksana[$k], 0, 8);
            $getKode = substr($pelaksana[$k], 9, 1);

            $query = $this->db->query("SELECT * FROM tb_tim WHERE id_tim = '$id_tim' AND daltu = '$getPelaksana'");
            if ($query->num_rows() > 0) {
                $jbtn = "Pengendali Mutu";
            }

            $query2 = $this->db->query("SELECT * FROM tb_tim WHERE id_tim = '$id_tim' AND dalnis = '$getPelaksana'");
            if ($query2->num_rows() > 0) {
                $jbtn = "Pengendali Teknis";
            }

            $query3 = $this->db->query("SELECT * FROM tb_tim WHERE id_tim = '$id_tim' AND ketua_tim = '$getPelaksana'");
            if ($query3->num_rows() > 0) {
                $jbtn = "Ketua Tim";
            }

            $query4 = $this->db->query("SELECT * FROM sub_tim WHERE sub_id_tim = '$id_tim' AND anggota = '$getPelaksana'");
            if ($query4->num_rows() > 0) {
                $jbtn = "Anggota Tim";
            }

            $id_pegawai = $this->input->post('id_pegawai');
            if ($getPelaksana == "-- Pilih") {
                $plksna = $id_pegawai;
            } else {
                $plksna = $getPelaksana;
            }

            if ($getPelaksana == "KOSONG**") {
                $kep_kka = "selesai";
            } else {
                $kep_kka = "belum";
            } //update

            $data_sub_pka3 = array(
                'sub_pka3' => $id_pka,
                'sub_no_kka' => $nomor_kka2,
                'nomor' => $nomor[$k],
                'pelaksana' => $plksna,
                'jbtn_tim' => $jbtn,
                'keputusan_kka' => $kep_kka //update
            );
            $this->db->insert('temp_pka4', $data_sub_pka3);

            $k++;
        }

        $data_tugas = array('fk_pka' => "temp_" . $id_pka);
        $this->db->where('id_tugas', $id_tgs)
                ->update('tb_penugasan', $data_tugas);
    }

    //--> ubah temporary pka
    function update_temp_pka() {
        $id_pka = $this->input->post('id_pka');
        $id_tgs = $this->input->post('id_tgs');
        $id_tim = $this->input->post('id_tim');

        $jml_ins = $this->input->post('jml_ins');
        $jml_jp = $this->input->post('jml_jp');
        $jml_tjn = $this->input->post('jml_tjn');
        $jml_lkh = $this->input->post('jml_lkh');
        $jml_2 = $jml_tjn + $jml_lkh;
        $jml_agt = $this->input->post('jml_agt');
        $jml_tjn_pka = $this->input->post('jml_tjnPKA') - 1;

        $kta = $this->input->post('kategori');
        $kod = $this->input->post('kode_pekerjaan');
        $jen = $this->input->post('jenis_pekerjaan');
        $ins = $this->input->post('nama_instansi');
        $tjn_pka = $this->input->post('tjn_pka');

        $no_ins = $this->input->post('no_ins');
        $no_kat = $this->input->post('no_kat');
        $nama_periksa = $this->input->post('nama_periksa');
        $kode_periksa = $this->input->post('kode_periksa');
        $tanggal = $this->input->post('tanggal');
        $no_kka = $this->input->post('no_kka');
        $keterangan = $this->input->post('keterangan');

        $pelaksana = $this->input->post('pelaksana');
        $no_kka2 = $this->input->post('no_kka2');
        $nomor = $this->input->post('nomor');

        //--> tambah temp_pka1
        $data_pka = array(
            'tgl_pka' => date('Y-m-d H:i:s'),
            'masa_periksa' => $this->input->post('masa_periksa'),
            'no_ref_pka' => $this->input->post('no_ref_pka')
        );
        $this->db->where('id_pka', $id_pka)
                ->update('temp_pka1', $data_pka);

        //hapus temp_pka2
        $this->db->delete('temp_pka2', array('sub_pka1' => $id_pka));

        //--> tambah temp_pka2
        if ($jml_jp > $jml_tjn_pka) {
            $jml_sub1 = $jml_jp;
        } else {
            $jml_sub1 = $jml_tjn_pka;
        }

        $i = 0;
        while ($i < $jml_sub1) {
            if ($jml_ins != "1") {
                $instansi = $ins[$i];
            } else {
                $instansi = "-";
            }

            $data_sub_pka1 = array(
                'sub_pka1' => $id_pka,
                'nomor' => $i + 1,
                'kategori' => $kta[$i],
                'kode_pekerjaan' => $kod[$i],
                'jenis_pekerjaan' => $jen[$i],
                'nama_instansi' => $instansi,
                'tujuan_pka' => $tjn_pka[$i]
            );
            $this->db->insert('temp_pka2', $data_sub_pka1);

            $i++;
        }

        //hapus temp_pka3
        $this->db->delete('temp_pka3', array('sub_pka2' => $id_pka));

        //--> tambah temp_pka3
        $j = 0;
        while ($j < $jml_2) {
            if ($jml_ins != "1") {
                $kode_uraian = "$no_ins[$j]-$no_kat[$j]-$kode_periksa[$j]";
                $kode_pekerjaan = "$id_pka-$no_ins[$j]-$no_kat[$j]";
                $nomor_kka = $no_kka[$j];
            } else {
                $kode_pekerjaan = "$id_pka-$no_kat[$j]";
                $kode_uraian = "$no_kat[$j]-$kode_periksa[$j]";
                $nomor_kka = str_replace('..', '.', $no_kka[$j]);
            }

            if ($tanggal[$j] == "") {
                $tgl_krj = NULL;
            } else {
                $tgl_krj = $tanggal[$j];
            }

            if ($nama_periksa[$j] == "-" && $nomor_kka != "a") {
                $kep_kka_ikhtisar = "selesai";
            } else {
                $kep_kka_ikhtisar = "belum";
            } //update

            $data_sub_pka2 = array(
                'sub_pka2' => $id_pka,
                'kode_pekerjaan' => $kode_pekerjaan,
                'kode_uraian' => $kode_uraian,
                'uraian' => $nama_periksa[$j],
                'tgl_kerja' => $tgl_krj,
                'no_kka' => $nomor_kka,
                'keterangan' => $keterangan[$j],
                'keputusan_kka_ikhtisar' => $kep_kka_ikhtisar //update
            );
            $this->db->insert('temp_pka3', $data_sub_pka2);

            $j++;
        }

        //hapus temp_pka4
        $this->db->delete('temp_pka4', array('sub_pka3' => $id_pka));

        //--> tambah temp_pka4
        $k = 0;
        while ($k < $jml_agt) {
            if ($jml_ins != "1") {
                $nomor_kka2 = $no_kka2[$k];
            } else {
                $nomor_kka2 = str_replace('..', '.', $no_kka2[$k]);
            }

            $getPelaksana = substr($pelaksana[$k], 0, 8);
            $getKode = substr($pelaksana[$k], 9, 1);

            $query = $this->db->query("SELECT * FROM tb_tim WHERE id_tim = '$id_tim' AND daltu = '$getPelaksana'");
            if ($query->num_rows() > 0) {
                $jbtn = "Pengendali Mutu";
            }

            $query2 = $this->db->query("SELECT * FROM tb_tim WHERE id_tim = '$id_tim' AND dalnis = '$getPelaksana'");
            if ($query2->num_rows() > 0) {
                $jbtn = "Pengendali Teknis";
            }

            $query3 = $this->db->query("SELECT * FROM tb_tim WHERE id_tim = '$id_tim' AND ketua_tim = '$getPelaksana'");
            if ($query3->num_rows() > 0) {
                $jbtn = "Ketua Tim";
            }

            $query4 = $this->db->query("SELECT * FROM sub_tim WHERE sub_id_tim = '$id_tim' AND anggota = '$getPelaksana'");
            if ($query4->num_rows() > 0) {
                $jbtn = "Anggota Tim";
            }

            $id_pegawai = $this->input->post('id_pegawai');
            if ($getPelaksana == "-- Pilih") {
                $plksna = $id_pegawai;
            } else {
                $plksna = $getPelaksana;
            }

            if ($getPelaksana == "KOSONG**") {
                $kep_kka = "selesai";
            } else {
                $kep_kka = "belum";
            } //update

            $data_sub_pka3 = array(
                'sub_pka3' => $id_pka,
                'sub_no_kka' => $nomor_kka2,
                'nomor' => $nomor[$k],
                'pelaksana' => $plksna,
                'jbtn_tim' => $jbtn,
                'keputusan_kka' => $kep_kka //update
            );
            $this->db->insert('temp_pka4', $data_sub_pka3);

            $k++;
        }
    }

    //--> tambah pka
    function insert_pka() {
        $id_pka = $this->input->post('id_pka');
        $id_tgs = $this->input->post('id_tgs');
        $id_tim = $this->input->post('id_tim');

        $jml_ins = $this->input->post('jml_ins');
        $jml_jp = $this->input->post('jml_jp');
        $jml_tjn = $this->input->post('jml_tjn');
        $jml_lkh = $this->input->post('jml_lkh');
        $jml_2 = $jml_tjn + $jml_lkh;
        $jml_agt = $this->input->post('jml_agt');
        $jml_tjn_pka = $this->input->post('jml_tjnPKA') - 1;

        $kta = $this->input->post('kategori');
        $kod = $this->input->post('kode_pekerjaan');
        $jen = $this->input->post('jenis_pekerjaan');
        $ins = $this->input->post('nama_instansi');
        $tjn_pka = $this->input->post('tjn_pka');

        $no_ins = $this->input->post('no_ins');
        $no_kat = $this->input->post('no_kat');
        $nama_periksa = $this->input->post('nama_periksa');
        $kode_periksa = $this->input->post('kode_periksa');
        $tanggal = $this->input->post('tanggal');
        $no_kka = $this->input->post('no_kka');
        $keterangan = $this->input->post('keterangan');

        $pelaksana = $this->input->post('pelaksana');
        $no_kka2 = $this->input->post('no_kka2');
        $nomor = $this->input->post('nomor');

        //--> tambah tb_pka
        $data_pka = array(
            'id_pka' => $id_pka,
            'id_tgs' => $id_tgs,
            'tgl_pka' => date('Y-m-d H:i:s'),
            'masa_periksa' => $this->input->post('masa_periksa'),
            'no_ref_pka' => $this->input->post('no_ref_pka')
        );
        $this->db->insert('tb_pka', $data_pka);

        //--> tambah sub_pka1
        if ($jml_jp > $jml_tjn_pka) {
            $jml_sub1 = $jml_jp;
        } else {
            $jml_sub1 = $jml_tjn_pka;
        }

        $i = 0;
        while ($i < $jml_sub1) {
            if ($jml_ins != "1") {
                $instansi = $ins[$i];
            } else {
                $instansi = "-";
            }

            $data_sub_pka1 = array(
                'sub_pka1' => $id_pka,
                'nomor' => $i + 1,
                'kategori' => $kta[$i],
                'kode_pekerjaan' => $kod[$i],
                'jenis_pekerjaan' => $jen[$i],
                'nama_instansi' => $instansi,
                'tujuan_pka' => $tjn_pka[$i]
            );
            $this->db->insert('sub_pka1', $data_sub_pka1);

            $i++;
        }

        //--> tambah sub_pka2
        $j = 0;
        while ($j < $jml_2) {
            if ($jml_ins != "1") {
                $kode_uraian = "$no_ins[$j]-$no_kat[$j]-$kode_periksa[$j]";
                $kode_pekerjaan = "$id_pka-$no_ins[$j]-$no_kat[$j]";
                $nomor_kka = $no_kka[$j];
            } else {
                $kode_pekerjaan = "$id_pka-$no_kat[$j]";
                $kode_uraian = "$no_kat[$j]-$kode_periksa[$j]";
                $nomor_kka = str_replace('..', '.', $no_kka[$j]);
            }

            if ($nama_periksa[$j] == "-" && $nomor_kka != "a") {
                $kep_kka_ikhtisar = "selesai";
            } else {
                $kep_kka_ikhtisar = "belum";
            } //update

            $data_sub_pka2 = array(
                'sub_pka2' => $id_pka,
                'kode_pekerjaan' => $kode_pekerjaan,
                'kode_uraian' => $kode_uraian,
                'uraian' => $nama_periksa[$j],
                'tgl_kerja' => $tanggal[$j],
                'no_kka' => $nomor_kka,
                'keterangan' => $keterangan[$j],
                'keputusan_kka_ikhtisar' => $kep_kka_ikhtisar //update
            );
            $this->db->insert('sub_pka2', $data_sub_pka2);

            $j++;
        }

        //--> tambah sub_pka3
        $k = 0;
        while ($k < $jml_agt) {
            if ($jml_ins != "1") {
                $nomor_kka2 = $no_kka2[$k];
            } else {
                $nomor_kka2 = str_replace('..', '.', $no_kka2[$k]);
            }

            $getPelaksana = substr($pelaksana[$k], 0, 8);
            $getKode = substr($pelaksana[$k], 9, 1);

            $query = $this->db->query("SELECT * FROM tb_tim WHERE id_tim = '$id_tim' AND daltu = '$getPelaksana'");
            if ($query->num_rows() > 0) {
                $jbtn = "Pengendali Mutu";
            }

            $query2 = $this->db->query("SELECT * FROM tb_tim WHERE id_tim = '$id_tim' AND dalnis = '$getPelaksana'");
            if ($query2->num_rows() > 0) {
                $jbtn = "Pengendali Teknis";
            }

            $query3 = $this->db->query("SELECT * FROM tb_tim WHERE id_tim = '$id_tim' AND ketua_tim = '$getPelaksana'");
            if ($query3->num_rows() > 0) {
                $jbtn = "Ketua Tim";
            }

            $query4 = $this->db->query("SELECT * FROM sub_tim WHERE sub_id_tim = '$id_tim' AND anggota = '$getPelaksana'");
            if ($query4->num_rows() > 0) {
                $jbtn = "Anggota Tim";
            }

            if ($getPelaksana == "KOSONG**") {
                $kep_kka = "selesai";
            } else {
                $kep_kka = "belum";
            } //update

            $data_sub_pka3 = array(
                'sub_pka3' => $id_pka,
                'sub_no_kka' => $nomor_kka2,
                'nomor' => $nomor[$k],
                'pelaksana' => $getPelaksana,
                'jbtn_tim' => $jbtn,
                'keputusan_kka' => $kep_kka //update
            );
            $this->db->insert('sub_pka3', $data_sub_pka3);

            $k++;
        }

        $data_tugas = array('fk_pka' => $id_pka);
        $this->db->where('id_tugas', $id_tgs)
                ->update('tb_penugasan', $data_tugas);

        $data_notif = array(
            'id_terkait' => $id_pka,
            'notif_daltu' => "baru",
            'notif_dalnis' => "baru"
        );
        $this->db->insert('notifikasi', $data_notif);

        ########## SMS GATEWAY ##########
        $sms = $this->db->get_where('set_sms', array('id' => '1'))->row();
        $tugas = $this->penugasan_m->get_row_penugasan($id_tgs);
        $sms_dn = $this->db->get_where('tb_pegawai', array('id_pegawai' => $tugas->dalnis))->row();
        $sms_dt = $this->db->get_where('tb_pegawai', array('id_pegawai' => $tugas->daltu))->row();

        $pesan = "PEMBERITAHUAN! terdapat Program Kerja Audit dengan NO. SURAT : $tugas->no_st yang harus direviu. Silahkan buka http://sipiko.pariamankota.go.id/index.php/log_in";

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

    function reviu_pka() {
        $id_pka = $this->input->post('id_pka');
        $no_rev = $this->input->post('rev_ke'); // nomor reviu ke-n.

        $get_pka = $this->db->get_where('tb_pka', array('id_pka' => $id_pka))->row();

        if ($get_pka->reviu_dalnis == "-") {
            $tgl_dalnis = $get_pka->tgl_dalnis;
            $rev_dalnis = $get_pka->reviu_dalnis;
            $notif_dalnis = "lama";
        } else {
            $tgl_dalnis = NULL;
            $rev_dalnis = NULL;
            $notif_dalnis = "baru";

            ########## SMS GATEWAY ##########
            $sms = $this->db->get_where('set_sms', array('id' => '1'))->row();
            $tugas = $this->penugasan_m->get_row_penugasan($get_pka->id_tgs);
            $sms_dn = $this->db->get_where('tb_pegawai', array('id_pegawai' => $tugas->dalnis))->row();

            $pesan = "PEMBERITAHUAN! Program Kerja Audit dengan NO. SURAT : $tugas->no_st telah diperbaiki. Silahkan buka http://sipiko.pariamankota.go.id/index.php/log_in";

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

        if ($get_pka->reviu_daltu == "-") {
            $tgl_daltu = $get_pka->tgl_daltu;
            $rev_daltu = $get_pka->reviu_daltu;
            $notif_daltu = "lama";
        } else {
            $tgl_daltu = NULL;
            $rev_daltu = NULL;
            $notif_daltu = "baru";

            ########## SMS GATEWAY ##########
            $sms = $this->db->get_where('set_sms', array('id' => '1'))->row();
            $tugas = $this->penugasan_m->get_row_penugasan($get_pka->id_tgs);
            $sms_dt = $this->db->get_where('tb_pegawai', array('id_pegawai' => $tugas->daltu))->row();

            $pesan = "PEMBERITAHUAN! Program Kerja Audit dengan NO. SURAT : $tugas->no_st telah diperbaiki. Silahkan buka http://sipiko.pariamankota.go.id/index.php/log_in";

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

        //--> memindahkan data dari tb_pka ke rev_pka1
        $data_rev_pka1 = array(
            'rev_pka1' => $get_pka->id_pka,
            'tgl_reviu' => date('Y-m-d H:i:s'),
            'rev_ke' => $no_rev,
            'rev_masa_periksa' => $get_pka->masa_periksa,
            'rev_no_ref_pka' => $get_pka->no_ref_pka,
            'tgl_rev_dalnis' => $get_pka->tgl_dalnis,
            'tgl_rev_daltu' => $get_pka->tgl_daltu,
            'rev_dalnis' => $get_pka->reviu_dalnis,
            'rev_daltu' => $get_pka->reviu_daltu
        );
        $this->db->insert('rev_pka1', $data_rev_pka1);

        $get_sub_pka1 = $this->db->get_where('sub_pka1', array('sub_pka1' => $id_pka))->result();
        //--> memindahkan data dari sub_pka1 ke rev_pka2
        foreach ($get_sub_pka1 as $row) {
            $data_rev_pka2 = array(
                'rev_pka2' => $row->sub_pka1,
                'rev_ke' => $no_rev,
                'nomor' => $row->nomor,
                'kategori' => $row->kategori,
                'kode_pekerjaan' => $row->kode_pekerjaan,
                'jenis_pekerjaan' => $row->jenis_pekerjaan,
                'nama_instansi' => $row->nama_instansi,
                'tujuan_pka' => $row->tujuan_pka
            );
            $this->db->insert('rev_pka2', $data_rev_pka2);
        }

        $get_sub_pka2 = $this->db->get_where('sub_pka2', array('sub_pka2' => $id_pka))->result();
        //--> memindahkan data dari sub_pka2 ke rev_pka3
        foreach ($get_sub_pka2 as $row) {
            $data_rev_pka3 = array(
                'rev_pka3' => $row->sub_pka2,
                'rev_ke' => $no_rev,
                'kode_pekerjaan' => $row->kode_pekerjaan,
                'kode_uraian' => $row->kode_uraian,
                'uraian' => $row->uraian,
                'tgl_kerja' => $row->tgl_kerja,
                'no_kka' => $row->no_kka,
                'keterangan' => $row->keterangan
            );
            $this->db->insert('rev_pka3', $data_rev_pka3);
        }

        $get_sub_pka3 = $this->db->get_where('sub_pka3', array('sub_pka3' => $id_pka))->result();
        //--> memindahkan data dari sub_pka3 ke rev_pka4
        foreach ($get_sub_pka3 as $row) {
            $data_rev_pka4 = array(
                'rev_pka4' => $row->sub_pka3,
                'rev_ke' => $no_rev,
                'sub_no_kka' => $row->sub_no_kka,
                'nomor' => $row->nomor,
                'pelaksana' => $row->pelaksana,
                'jbtn_tim' => $row->jbtn_tim
            );
            $this->db->insert('rev_pka4', $data_rev_pka4);
        }

        //--> hapus data tb_pka, sub_pka1, sub_pka2 dan sub_pka3
        $this->db->delete('tb_pka', array('id_pka' => $id_pka));
        $this->db->delete('sub_pka1', array('sub_pka1' => $id_pka));
        $this->db->delete('sub_pka2', array('sub_pka2' => $id_pka));
        $this->db->delete('sub_pka3', array('sub_pka3' => $id_pka));

        //--> data inputan dari form reviu pka
        $id_tgs = $this->input->post('id_tgs');
        $id_tim = $this->input->post('id_tim');

        $jml_ins = $this->input->post('jml_ins');
        $jml_jp = $this->input->post('jml_jp');
        $jml_tjn = $this->input->post('jml_tjn');
        $jml_lkh = $this->input->post('jml_lkh');
        $jml_2 = $jml_tjn + $jml_lkh;
        $jml_agt = $this->input->post('jml_agt');
        $jml_tjn_pka = $this->input->post('jml_tjnPKA') - 1;

        $kta = $this->input->post('kategori');
        $kod = $this->input->post('kode_pekerjaan');
        $jen = $this->input->post('jenis_pekerjaan');
        $ins = $this->input->post('nama_instansi');
        $tjn_pka = $this->input->post('tjn_pka');

        $no_ins = $this->input->post('no_ins');
        $no_kat = $this->input->post('no_kat');
        $nama_periksa = $this->input->post('nama_periksa');
        $kode_periksa = $this->input->post('kode_periksa');
        $tanggal = $this->input->post('tanggal');
        $no_kka = $this->input->post('no_kka');
        $keterangan = $this->input->post('keterangan');

        $pelaksana = $this->input->post('pelaksana');
        $no_kka2 = $this->input->post('no_kka2');
        $nomor = $this->input->post('nomor');

        //--> tambah tb_pka
        $data_pka = array(
            'id_pka' => $id_pka,
            'id_tgs' => $id_tgs,
            'tgl_pka' => $this->input->post('tgl_pka'),
            'masa_periksa' => $this->input->post('masa_periksa'),
            'no_ref_pka' => $this->input->post('no_ref_pka'),
            'tgl_dalnis' => $tgl_dalnis,
            'tgl_daltu' => $tgl_daltu,
            'reviu_dalnis' => $rev_dalnis,
            'reviu_daltu' => $rev_daltu
        );
        $this->db->insert('tb_pka', $data_pka);

        //--> tambah sub_pka1
        if ($jml_jp > $jml_tjn_pka) {
            $jml_sub1 = $jml_jp;
        } else {
            $jml_sub1 = $jml_tjn_pka;
        }

        $i = 0;
        while ($i < $jml_sub1) {
            if ($jml_ins != "1") {
                $instansi = $ins[$i];
            } else {
                $instansi = "-";
            }

            $data_sub_pka1 = array(
                'sub_pka1' => $id_pka,
                'nomor' => $i + 1,
                'kategori' => $kta[$i],
                'kode_pekerjaan' => $kod[$i],
                'jenis_pekerjaan' => $jen[$i],
                'nama_instansi' => $instansi,
                'tujuan_pka' => $tjn_pka[$i],
            );
            $this->db->insert('sub_pka1', $data_sub_pka1);

            $i++;
        }

        //--> tambah sub_pka2
        $j = 0;
        while ($j < $jml_2) {
            if ($jml_ins != "1") {
                $kode_uraian = "$no_ins[$j]-$no_kat[$j]-$kode_periksa[$j]";
                $kode_pekerjaan = "$id_pka-$no_ins[$j]-$no_kat[$j]";
                $nomor_kka = $no_kka[$j];
            } else {
                $kode_pekerjaan = "$id_pka-$no_kat[$j]";
                $kode_uraian = "$no_kat[$j]-$kode_periksa[$j]";
                $nomor_kka = str_replace('..', '.', $no_kka[$j]);
            }

            if ($nama_periksa[$j] == "-" && $nomor_kka != "a") {
                $kep_kka_ikhtisar = "selesai";
            } else {
                $kep_kka_ikhtisar = "belum";
            } //update

            $data_sub_pka2 = array(
                'sub_pka2' => $id_pka,
                'kode_pekerjaan' => $kode_pekerjaan,
                'kode_uraian' => $kode_uraian,
                'uraian' => $nama_periksa[$j],
                'tgl_kerja' => $tanggal[$j],
                'no_kka' => $nomor_kka,
                'keterangan' => $keterangan[$j],
                'keputusan_kka_ikhtisar' => $kep_kka_ikhtisar //update
            );
            $this->db->insert('sub_pka2', $data_sub_pka2);

            $j++;
        }

        //--> tambah sub_pka3
        $k = 0;
        while ($k < $jml_agt) {
            if ($jml_ins != "1") {
                $nomor_kka2 = $no_kka2[$k];
            } else {
                $nomor_kka2 = str_replace('..', '.', $no_kka2[$k]);
            }

            $getPelaksana = substr($pelaksana[$k], 0, 8);
            $getKode = substr($pelaksana[$k], 9, 1);

            $query = $this->db->query("SELECT * FROM tb_tim WHERE id_tim = '$id_tim' AND daltu = '$getPelaksana'");
            if ($query->num_rows() > 0) {
                $jbtn = "Pengendali Mutu";
            }

            $query2 = $this->db->query("SELECT * FROM tb_tim WHERE id_tim = '$id_tim' AND dalnis = '$getPelaksana'");
            if ($query2->num_rows() > 0) {
                $jbtn = "Pengendali Teknis";
            }

            $query3 = $this->db->query("SELECT * FROM tb_tim WHERE id_tim = '$id_tim' AND ketua_tim = '$getPelaksana'");
            if ($query3->num_rows() > 0) {
                $jbtn = "Ketua Tim";
            }

            $query4 = $this->db->query("SELECT * FROM sub_tim WHERE sub_id_tim = '$id_tim' AND anggota = '$getPelaksana'");
            if ($query4->num_rows() > 0) {
                $jbtn = "Anggota Tim";
            }

            if ($getPelaksana == "KOSONG**") {
                $kep_kka = "selesai";
            } else {
                $kep_kka = "belum";
            } //update

            $data_sub_pka3 = array(
                'sub_pka3' => $id_pka,
                'sub_no_kka' => $nomor_kka2,
                'nomor' => $nomor[$k],
                'pelaksana' => $getPelaksana,
                'jbtn_tim' => $jbtn,
                'keputusan_kka' => $kep_kka //update
            );
            $this->db->insert('sub_pka3', $data_sub_pka3);

            $k++;
        }

        $data_notif = array(
            'notif_daltu' => $notif_daltu,
            'notif_dalnis' => $notif_dalnis
        );
        $this->db->where('id_terkait', $id_pka)
                ->update('notifikasi', $data_notif);
    }

    #############################################
    ############# PERSETUJUAN PKA ###############
    #############################################

    function persetujuan_dalnis($id_pka) {
        $cek = $this->db->get_where('tb_pka', array('id_pka' => $id_pka))->row();
        if ($this->input->post('reviu') == 'setujui') {
            $catatan = "-";
        } else {
            $catatan = $this->input->post('catatan');
        }

        if ($catatan == "-") { // && $cek->reviu_daltu == '-')
            $keputusan = "selesai";

            ########## SMS GATEWAY ##########
            $sms = $this->db->get_where('set_sms', array('id' => '1'))->row();
            $tugas = $this->penugasan_m->get_row_penugasan($cek->id_tgs);
            $tim = $this->tim_m->get_sub_tim($tugas->id_tim);

            $pesan = "PEMBERITAHUAN! buatkan Kertas Kerja Audit (KKA) dengan NO. SURAT : $tugas->no_st. Silahkan buka http://sipiko.pariamankota.go.id/index.php/log_in";

            foreach ($tim as $row) {
                //--> sms staff
                $array_sms = array(
                    "id" => $tugas->no_st,
                    "waktu" => date("d-m-Y H:i:s"),
                    "nomor" => $row->no_tlp,
                    "pesan" => $pesan,
                    "email" => $sms->email,
                    "status" => "new"
                );
                $this->smsgateway->outbox($sms->base_url . $sms->base_path . '/data_outbox.json', $array_sms);
            }
            ########## /.SMS GATEWAY ##########
        } else {
            $keputusan = "belum";
        }

        //--> ubah tb_pka
        $data_pka = array(
            'tgl_dalnis' => date('Y-m-d H:i:s'),
            'reviu_dalnis' => $catatan,
            'keputusan_pka' => $keputusan
        );
        $this->db->where('id_pka', $id_pka)
                ->update('tb_pka', $data_pka);

        if ($catatan != NULL) { //&& $cek->reviu_daltu != NULL)
            //--> ubah notifikasi
            $data_notif = array(
                'notif_ketua_tim' => "baru"
            );
            $this->db->where('id_terkait', $id_pka)
                    ->update('notifikasi', $data_notif);

            ########## SMS GATEWAY ##########
            $sms = $this->db->get_where('set_sms', array('id' => '1'))->row();
            $tugas = $this->penugasan_m->get_row_penugasan($cek->id_tgs);
            $sms_kt = $this->db->get_where('tb_pegawai', array('id_pegawai' => $tugas->ketua_tim))->row();

            $pesan = "PEMBERITAHUAN! Program Kerja Audit dengan NO. SURAT : $tugas->no_st telah direviu. Silahkan buka http://sipiko.pariamankota.go.id/index.php/log_in";

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

    function persetujuan_daltu($id_pka) {
        $cek = $this->db->get_where('tb_pka', array('id_pka' => $id_pka))->row();
        if ($this->input->post('reviu') == 'setujui') {
            $catatan = "-";
        } else {
            $catatan = $this->input->post('catatan');
        }

        if ($cek->reviu_dalnis == '-' && $catatan == "-") {
            $keputusan = "selesai";

            ########## SMS GATEWAY ##########
            $sms = $this->db->get_where('set_sms', array('id' => '1'))->row();
            $tugas = $this->penugasan_m->get_row_penugasan($cek->id_tgs);
            $tim = $this->tim_m->get_sub_tim($tugas->id_tim);

            $pesan = "PEMBERITAHUAN! buatkan Kertas Kerja Audit (KKA) dengan NO. SURAT : $tugas->no_st. Silahkan buka http://sipiko.pariamankota.go.id/index.php/log_in";

            foreach ($tim as $row) {
                //--> sms staff
                $array_sms = array(
                    "id" => $tugas->no_st,
                    "waktu" => date("d-m-Y H:i:s"),
                    "nomor" => $row->no_tlp,
                    "pesan" => $pesan,
                    "email" => $sms->email,
                    "status" => "new"
                );
                $this->smsgateway->outbox($sms->base_url . $sms->base_path . '/data_outbox.json', $array_sms);
            }
            ########## /.SMS GATEWAY ##########
        } else {
            $keputusan = "belum";
        }

        //--> ubah tb_pka
        $data_pka = array(
            'tgl_daltu' => date('Y-m-d H:i:s'),
            'reviu_daltu' => $catatan,
            'keputusan_pka' => $keputusan
        );
        $this->db->where('id_pka', $id_pka)
                ->update('tb_pka', $data_pka);

        if ($catatan != NULL && $cek->reviu_dalnis != NULL) {
            //--> ubah notifikasi
            $data_notif = array(
                'notif_ketua_tim' => "baru"
            );
            $this->db->where('id_terkait', $id_pka)
                    ->update('notifikasi', $data_notif);

            ########## SMS GATEWAY ##########
            $sms = $this->db->get_where('set_sms', array('id' => '1'))->row();
            $tugas = $this->penugasan_m->get_row_penugasan($cek->id_tgs);
            $sms_kt = $this->db->get_where('tb_pegawai', array('id_pegawai' => $tugas->ketua_tim))->row();

            $pesan = "PEMBERITAHUAN! Program Kerja Audit dengan NO. SURAT : $tugas->no_st telah direviu. Silahkan buka http://sipiko.pariamankota.go.id/index.php/log_in";

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

    ###################################################
    ############# BATAS PERSETUJUAN PKA ###############
    ###################################################

    function upload_kka($id_pka, $no_kka, $anggota) {
        $nmkka = str_replace(' ', '_', $_FILES['file_kka']['name']);
        $tempatkka = './assets/kka/' . $nmkka;

        $nmbukti = str_replace(' ', '_', $_FILES['file_bukti']['name']);
        $tempatbukti = './assets/kka_bukti/' . $nmbukti;

        if (!empty($_FILES['file_bukti']['name'])) {
            $data_kka = array(
                'hasil_kka' => $nmkka,
                'bukti_kka' => $nmbukti,
                'keputusan_kka' => 'proses'
            );
            $this->db->where('sub_pka3', $id_pka)
                    ->where('sub_no_kka', $no_kka)
                    ->where('pelaksana', $anggota)
                    ->update('sub_pka3', $data_kka);
        } elseif (empty($_FILES['file_bukti']['name'])) {
            $data_kka = array(
                'hasil_kka' => $nmkka,
                'keputusan_kka' => 'proses'
            );
            $this->db->where('sub_pka3', $id_pka)
                    ->where('sub_no_kka', $no_kka)
                    ->where('pelaksana', $anggota)
                    ->update('sub_pka3', $data_kka);
        }

        //--> proses upload
        move_uploaded_file($_FILES['file_kka']['tmp_name'], $tempatkka);
        move_uploaded_file($_FILES['file_bukti']['tmp_name'], $tempatbukti);
    }

    function upload_reviu_kka($id_pka, $no_kka, $anggota) {
        $no_rev = $this->input->post('no_rev');
        $get = $this->db->get_where('sub_pka3', array('sub_pka3' => $id_pka, 'sub_no_kka' => $no_kka, 'pelaksana' => $anggota))->row();

        $renameKKA = str_replace('[' . $get->sub_no_kka . ']-', '[' . $get->sub_no_kka . ']-REV_' . $no_rev . '-', $get->hasil_kka);
        $pathAwal = './assets/kka/' . $get->hasil_kka;
        $pathTujuan = './assets/kka/reviu/' . $renameKKA;

        if (file_exists($pathAwal)) {
            copy($pathAwal, $pathTujuan); // salin file KKA dari folder /kka ke folder /kka/reviu
            unlink($pathAwal); // hapus file kka di folder kka
        }

        /* if(!empty($_FILES['file_rev_bukti']['name']))
          {
          $nameBukti = 'REV_'. $no_rev .'_'. $get->bukti_kka;
          }
          else
          {
          $nameBukti = $get->bukti_kka;
          } */

        //--> tambahkan tabel rev_kka
        $data_rev_kka = array(
            'rev_sub_pka' => $id_pka,
            'rev_no_kka' => $get->sub_no_kka,
            'rev_pelaksana' => $get->pelaksana,
            'rev_ke' => $no_rev,
            'rev_jbtn_tim' => $get->jbtn_tim,
            'rev_hasil_kka' => $renameKKA,
            'rev_bukti_kka' => $get->bukti_kka,
            'tgl_rev_ketua' => $get->tgl_rev_ketua,
            'rev_kka_ketua' => $get->reviu_kka_ketua,
            'tgl_rev_dalnis' => $get->tgl_rev_dalnis,
            'rev_kka_dalnis' => $get->reviu_kka_dalnis,
            'tgl_rev_daltu' => $get->tgl_rev_daltu,
            'rev_kka_daltu' => $get->reviu_kka_daltu
        );
        $this->db->insert('rev_kka', $data_rev_kka);

        /*
          ubah data di tabel sub_pka3 sesuai dengan hasil inputan
         */

        // cek reviu ketua (ada reviu/tidak)
        if ($get->reviu_kka_ketua == "-") {
            $tgl_ketua = $get->tgl_rev_ketua;
            $rev_ketua = $get->reviu_kka_ketua;
        } else {
            $tgl_ketua = NULL;
            $rev_ketua = NULL;
        }

        // cek reviu dalnis (ada reviu/tidak)
        if ($get->reviu_kka_dalnis == "-") {
            $tgl_dalnis = $get->tgl_rev_dalnis;
            $rev_dalnis = $get->reviu_kka_dalnis;
        } else {
            $tgl_dalnis = NULL;
            $rev_dalnis = NULL;
        }

        // cek reviu daltu (ada reviu/tidak)
        if ($get->reviu_kka_daltu == "-") {
            $tgl_daltu = $get->tgl_rev_daltu;
            $rev_daltu = $get->reviu_kka_daltu;
        } else {
            $tgl_daltu = NULL;
            $rev_daltu = NULL;
        }

        $nmkka = str_replace(' ', '_', $_FILES['file_rev_kka']['name']);
        $tempatkka = './assets/kka/' . $nmkka;

        /* if(!empty($_FILES['file_rev_bukti']['name']))
          {
          $renameBukti = 'REV_'. $no_rev .'_'. $get->bukti_kka;
          $namaAwal2   = './assets/kka_bukti/'. $get->bukti_kka;
          $namaBaru2   = './assets/kka_bukti/'. $renameBukti;
          $pathTujuan2 = './assets/kka_bukti/reviu/'. $renameBukti;

          if(file_exists($namaAwal2))
          {
          rename($namaAwal2, $namaBaru2); // ubah nama file kka di folder kka
          copy($namaBaru2, $pathTujuan2); // pindahkan file KKA dari folder /kka ke folder /kka/reviu
          unlink($namaBaru2); // hapus file kka di folder kka
          }

          $nmbukti = str_replace(' ', '_', $_FILES['file_rev_bukti']['name']);
          $tempatbukti = './assets/kka_bukti/'. $nmbukti;

          $data_kka = array(
          'hasil_kka'        => $nmkka,
          'bukti_kka'        => $nmbukti,
          'tgl_rev_ketua'    => NULL,
          'reviu_kka_ketua'  => NULL,
          'tgl_rev_dalnis'   => NULL,
          'reviu_kka_dalnis' => NULL,
          'tgl_rev_daltu'    => NULL,
          'reviu_kka_daltu'  => NULL,
          'keputusan_kka'    => 'proses'
          );
          $this->db->where('sub_pka3', $id_pka)
          ->where('sub_no_kka', $no_kka)
          ->where('pelaksana', $anggota)
          ->update('sub_pka3', $data_kka);
          }
          elseif(empty($_FILES['file_rev_bukti']['name']))
          { */
        $data_kka = array(
            'hasil_kka' => $nmkka,
            'tgl_rev_ketua' => $tgl_ketua,
            'reviu_kka_ketua' => $rev_ketua,
            'tgl_rev_dalnis' => $tgl_dalnis,
            'reviu_kka_dalnis' => $rev_dalnis,
            'tgl_rev_daltu' => $tgl_daltu,
            'reviu_kka_daltu' => $rev_daltu,
            'keputusan_kka' => 'proses'
        );
        $this->db->where('sub_pka3', $id_pka)
                ->where('sub_no_kka', $no_kka)
                ->where('pelaksana', $anggota)
                ->update('sub_pka3', $data_kka);
        //}
        //--> proses upload
        move_uploaded_file($_FILES['file_rev_kka']['tmp_name'], $tempatkka);
        //move_uploaded_file($_FILES['file_rev_bukti']['tmp_name'], $tempatbukti);
    }

    function upload_kka_ikhtisar($id_pka, $no_kka) {
        $nmkkaikhtisar = str_replace(' ', '_', $_FILES['file_kka_ikhtisar']['name']);
        $pathkkaikhtisar = './assets/kka_ikhtisar/' . $nmkkaikhtisar;

        $data_kka_ikhtisar = array(
            'kka_ikhtisar' => $nmkkaikhtisar,
            'keputusan_kka_ikhtisar' => 'proses'
        );
        $this->db->where('sub_pka2', $id_pka)
                ->where('no_kka', $no_kka)
                ->update('sub_pka2', $data_kka_ikhtisar);

        //--> proses upload
        move_uploaded_file($_FILES['file_kka_ikhtisar']['tmp_name'], $pathkkaikhtisar);
    }

    function upload_reviu_kka_ikhtisar($id_pka, $no_kka) {
        $no_rev = $this->input->post('no_rev');
        $get = $this->db->get_where('sub_pka2', array('sub_pka2' => $id_pka, 'no_kka' => $no_kka))->row();

        $renameKKA = str_replace('[' . $get->no_kka . ']-', '[' . $get->no_kka . ']-REV_' . $no_rev . '-', $get->kka_ikhtisar);

        /* $upperJP		= strtoupper($get->jenis_pekerjaan);
          $renameJP1  = str_replace(' ', '_', $upperJP);
          $renameJP2  = str_replace('/', '_', $renameJP1);
          $renameKKA  = str_replace('['.$renameJP2.']-', '['.$renameJP2.']-REV_'.$no_rev.'-', $get->kka_ikhtisar); */
        $pathAwal = './assets/kka_ikhtisar/' . $get->kka_ikhtisar;
        $pathTujuan = './assets/kka_ikhtisar/reviu/' . $renameKKA;

        if (file_exists($pathAwal)) {
            copy($pathAwal, $pathTujuan); // salin file KKA dari folder /kka ke folder /kka/reviu
            unlink($pathAwal); // hapus file kka di folder kka
        }

        //--> tambahkan tabel rev_kka_ikhtisar
        $data_rev_kka_ikhtisar = array(
            'rev_sub_pka' => $id_pka,
            'rev_ke' => $no_rev,
            'rev_kode_pekerjaan' => $get->kode_pekerjaan,
            'rev_uraian' => $get->uraian,
            'rev_no_kka' => $get->no_kka,
            'rev_kka_ikhtisar' => $renameKKA,
            'tgl_rev_ketua' => $get->tgl_rev_ketua,
            'rev_ketua' => $get->reviu_ketua,
            'tgl_rev_dalnis' => $get->tgl_rev_dalnis,
            'rev_dalnis' => $get->reviu_dalnis,
            'tgl_rev_daltu' => $get->tgl_rev_daltu,
            'rev_daltu' => $get->reviu_daltu
        );
        $this->db->insert('rev_kka_ikhtisar', $data_rev_kka_ikhtisar);

        // cek reviu ketua (ada reviu/tidak)
        if ($get->reviu_ketua == "-") {
            $tgl_ketua = $get->tgl_rev_ketua;
            $rev_ketua = $get->reviu_ketua;
        } else {
            $tgl_ketua = NULL;
            $rev_ketua = NULL;
        }

        // cek reviu dalnis (ada reviu/tidak)
        if ($get->reviu_dalnis == "-") {
            $tgl_dalnis = $get->tgl_rev_dalnis;
            $rev_dalnis = $get->reviu_dalnis;
        } else {
            $tgl_dalnis = NULL;
            $rev_dalnis = NULL;
        }

        // cek reviu daltu (ada reviu/tidak)
        if ($get->reviu_daltu == "-") {
            $tgl_daltu = $get->tgl_rev_daltu;
            $rev_daltu = $get->reviu_daltu;
        } else {
            $tgl_daltu = NULL;
            $rev_daltu = NULL;
        }

        $nmkka = str_replace(' ', '_', $_FILES['file_rev_kka_ikhtisar']['name']);
        $tempatkka = './assets/kka_ikhtisar/' . $nmkka;

        $data_kka_ikhtisar = array(
            'kka_ikhtisar' => $nmkka,
            'tgl_rev_ketua' => $tgl_ketua,
            'reviu_ketua' => $rev_ketua,
            'tgl_rev_dalnis' => $tgl_dalnis,
            'reviu_dalnis' => $rev_dalnis,
            'tgl_rev_daltu' => $tgl_daltu,
            'reviu_daltu' => $rev_daltu,
            'keputusan_kka_ikhtisar' => 'proses'
        );
        $this->db->where('sub_pka2', $id_pka)
                ->where('no_kka', $no_kka)
                ->update('sub_pka2', $data_kka_ikhtisar);

        //--> proses upload
        move_uploaded_file($_FILES['file_rev_kka_ikhtisar']['tmp_name'], $tempatkka);
    }

    #####################################################
    ##############                      #################
    ##############   PERSETUJUAN KKA    #################
    ##############                      #################
    #####################################################

    function persetujuan_kka_ketua($id_pka, $no_kka, $anggota) {
        $cek = $this->db->get_where('sub_pka3', array('sub_pka3' => $id_pka, 'sub_no_kka' => $no_kka, 'pelaksana' => $anggota))->row();

        if ($this->input->post('reviu') == 'setujui') {
            $catatan = "-";
            $keputusan = "selesai";
        } else {
            $catatan = $this->input->post('catatan');
            $keputusan = "reviu";
        }

        /* if($catatan == "-" && $cek->reviu_kka_dalnis == '-' && $cek->reviu_kka_daltu == '-')
          { $keputusan = "selesai"; }
          elseif($catatan == "-" && $cek->reviu_kka_dalnis == '-' && $cek->reviu_kka_daltu == NULL)
          { $keputusan = "Proses"; }
          elseif($catatan == "-" && $cek->reviu_kka_dalnis == NULL && $cek->reviu_kka_daltu == '-')
          { $keputusan = "Proses"; }
          elseif($catatan == "-" && $cek->reviu_kka_dalnis == NULL && $cek->reviu_kka_daltu == NULL)
          { $keputusan = "Proses"; }
          else
          { $keputusan = "reviu"; } */

        //--> ubah data sub_pka3 sesuai id tertentu
        $data_kka = array(
            'tgl_rev_ketua' => date('Y-m-d H:i:s'),
            'reviu_kka_ketua' => $catatan,
            'keputusan_kka' => $keputusan
        );
        $this->db->where('sub_pka3', $id_pka)
                ->where('sub_no_kka', $no_kka)
                ->where('pelaksana', $anggota)
                ->update('sub_pka3', $data_kka);
    }

    /* function persetujuan_kka_dalnis($id_pka, $no_kka, $anggota)
      {
      $cek = $this->db->get_where('sub_pka3', array('sub_pka3' => $id_pka, 'sub_no_kka' => $no_kka, 'pelaksana' => $anggota))->row();

      if($this->input->post('reviu') == 'setujui')
      {
      $catatan = "-";
      }
      else
      {
      $catatan = $this->input->post('catatan');
      }

      if($catatan == "-" && $cek->reviu_kka_ketua == '-' && $cek->reviu_kka_daltu == '-')
      { $keputusan = "selesai"; }
      elseif($catatan == "-" && $cek->reviu_kka_ketua == '-' && $cek->reviu_kka_daltu == NULL)
      { $keputusan = "Proses"; }
      elseif($catatan == "-" && $cek->reviu_kka_ketua == NULL && $cek->reviu_kka_daltu == '-')
      { $keputusan = "Proses"; }
      elseif($catatan == "-" && $cek->reviu_kka_ketua == NULL && $cek->reviu_kka_daltu == NULL)
      { $keputusan = "Proses"; }
      else
      { $keputusan = "reviu"; }

      //--> ubah data sub_pka3 sesuai id tertentu
      $data_kka = array(
      'tgl_rev_dalnis'   => date('Y-m-d H:i:s'),
      'reviu_kka_dalnis' => $catatan,
      'keputusan_kka'    => $keputusan
      );
      $this->db->where('sub_pka3', $id_pka)
      ->where('sub_no_kka', $no_kka)
      ->where('pelaksana', $anggota)
      ->update('sub_pka3', $data_kka);
      }

      function persetujuan_kka_daltu($id_pka, $no_kka, $anggota)
      {
      $cek = $this->db->get_where('sub_pka3', array('sub_pka3' => $id_pka, 'sub_no_kka' => $no_kka, 'pelaksana' => $anggota))->row();

      if($this->input->post('reviu') == 'setujui')
      {
      $catatan = "-";
      }
      else
      {
      $catatan = $this->input->post('catatan');
      }

      if($catatan == "-" && $cek->reviu_kka_ketua == '-' && $cek->reviu_kka_dalnis == '-')
      { $keputusan = "selesai"; }
      elseif($catatan == "-" && $cek->reviu_kka_ketua == '-' && $cek->reviu_kka_dalnis == NULL)
      { $keputusan = "Proses"; }
      elseif($catatan == "-" && $cek->reviu_kka_ketua == NULL && $cek->reviu_kka_dalnis == '-')
      { $keputusan = "Proses"; }
      elseif($catatan == "-" && $cek->reviu_kka_ketua == NULL && $cek->reviu_kka_dalnis == NULL)
      { $keputusan = "Proses"; }
      else
      { $keputusan = "reviu"; }

      //--> ubah data sub_pka3 sesuai id tertentu
      $data_kka = array(
      'tgl_rev_daltu'   => date('Y-m-d H:i:s'),
      'reviu_kka_daltu' => $catatan,
      'keputusan_kka'   => $keputusan
      );
      $this->db->where('sub_pka3', $id_pka)
      ->where('sub_no_kka', $no_kka)
      ->where('pelaksana', $anggota)
      ->update('sub_pka3', $data_kka);
      } */

    #############################################################
    ##############                              #################
    ##############   PERSETUJUAN KKA IKHTISAR   #################
    ##############                              #################
    #############################################################

    function persetujuan_kka_ikhtisar_ketua($id_pka, $no_kka) {
        $cek = $this->db->get_where('sub_pka2', array('sub_pka2' => $id_pka, 'no_kka' => $no_kka))->row();

        if ($this->input->post('reviu') == 'setujui') {
            $catatan = "-";
            $keputusan = "selesai";
        } else {
            $catatan = $this->input->post('catatan');
            $keputusan = "reviu";
        }

        /* if($catatan == "-" && $cek->reviu_dalnis == '-' && $cek->reviu_daltu == '-')
          { $keputusan = "selesai"; }
          elseif($catatan == "-" && $cek->reviu_dalnis == '-' && $cek->reviu_daltu == NULL)
          { $keputusan = "Proses"; }
          elseif($catatan == "-" && $cek->reviu_dalnis == NULL && $cek->reviu_daltu == '-')
          { $keputusan = "Proses"; }
          elseif($catatan == "-" && $cek->reviu_dalnis == NULL && $cek->reviu_daltu == NULL)
          { $keputusan = "Proses"; }
          else
          { $keputusan = "reviu"; } */

        //--> ubah data sub_pka1 sesuai id & kode pekerjaan tertentu
        $data_kka_ikhtisar = array(
            'tgl_rev_ketua' => date('Y-m-d H:i:s'),
            'reviu_ketua' => $catatan,
            'keputusan_kka_ikhtisar' => $keputusan
        );
        $this->db->where('sub_pka2', $id_pka)
                ->where('no_kka', $no_kka)
                ->update('sub_pka2', $data_kka_ikhtisar);

        $this->cek_p2hp($id_pka, $no_kka);
    }

    /* function persetujuan_kka_ikhtisar_dalnis($id_pka, $no_kka)
      {
      $cek = $this->db->get_where('sub_pka2', array('sub_pka2' => $id_pka, 'no_kka' => $no_kka))->row();

      if($this->input->post('reviu') == 'setujui')
      {
      $catatan = "-";
      }
      else
      {
      $catatan = $this->input->post('catatan');
      }

      if($catatan == "-" && $cek->reviu_ketua == '-' && $cek->reviu_daltu == '-')
      { $keputusan = "selesai"; }
      elseif($catatan == "-" && $cek->reviu_ketua == '-' && $cek->reviu_daltu == NULL)
      { $keputusan = "Proses"; }
      elseif($catatan == "-" && $cek->reviu_ketua == NULL && $cek->reviu_daltu == '-')
      { $keputusan = "Proses"; }
      elseif($catatan == "-" && $cek->reviu_ketua == NULL && $cek->reviu_daltu == NULL)
      { $keputusan = "Proses"; }
      else
      { $keputusan = "reviu"; }

      //--> ubah data sub_pka3 sesuai id tertentu
      $data_kka_ikhtisar = array(
      'tgl_rev_dalnis'         => date('Y-m-d H:i:s'),
      'reviu_dalnis'           => $catatan,
      'keputusan_kka_ikhtisar' => $keputusan
      );
      $this->db->where('sub_pka2', $id_pka)
      ->where('no_kka', $no_kka)
      ->update('sub_pka2', $data_kka_ikhtisar);

      $this->cek_p2hp($id_pka, $no_kka);
      }

      function persetujuan_kka_ikhtisar_daltu($id_pka, $no_kka)
      {
      $cek = $this->db->get_where('sub_pka2', array('sub_pka2' => $id_pka, 'no_kka' => $no_kka))->row();

      if($this->input->post('reviu') == 'setujui')
      {
      $catatan = "-";
      }
      else
      {
      $catatan = $this->input->post('catatan');
      }

      if($catatan == "-" && $cek->reviu_ketua == '-' && $cek->reviu_dalnis == '-')
      { $keputusan = "selesai"; }
      elseif($catatan == "-" && $cek->reviu_ketua == '-' && $cek->reviu_dalnis == NULL)
      { $keputusan = "Proses"; }
      elseif($catatan == "-" && $cek->reviu_ketua == NULL && $cek->reviu_dalnis == '-')
      { $keputusan = "Proses"; }
      elseif($catatan == "-" && $cek->reviu_ketua == NULL && $cek->reviu_dalnis == NULL)
      { $keputusan = "Proses"; }
      else
      { $keputusan = "reviu"; }

      //--> ubah data sub_pka3 sesuai id tertentu
      $data_kka_ikhtisar = array(
      'tgl_rev_daltu'          => date('Y-m-d H:i:s'),
      'reviu_daltu'            => $catatan,
      'keputusan_kka_ikhtisar' => $keputusan
      );
      $this->db->where('sub_pka2', $id_pka)
      ->where('no_kka', $no_kka)
      ->update('sub_pka2', $data_kka_ikhtisar);

      $this->cek_p2hp($id_pka, $no_kka);
      } */

    function cek_p2hp($id_pka, $no_kka) {
        $data_pka = $this->get_row_pka($id_pka);
        $sasaran = $this->tim_m->get_sub_sasaran($data_pka->id_tim);
        $pka = $this->db->select('nama_instansi')
                        ->from('sub_pka2')
                        ->join('sub_pka1', 'sub_pka1.kode_pekerjaan = sub_pka2.kode_pekerjaan')
                        ->where('sub_pka1.sub_pka1', $id_pka)
                        ->limit(1)
                        ->get()->row();
//        print_r($this->db);exit;

        $tugas = $this->penugasan_m->get_row_penugasan($data_pka->id_tgs);

        //-> KONDISI LEBIH DARI 1 INSTANSI
        if (count($sasaran) != 0) {
            //--> mengambil jumlah KKA Ikhtis di setiap no. KKA
            $cek1 = $this->db->select('count(sub_pka2) as jml_ikhtisar')
                            ->from('sub_pka2')
                            ->join('sub_pka1', 'sub_pka1.kode_pekerjaan = sub_pka2.kode_pekerjaan')
                            ->where('nama_instansi', $pka->nama_instansi)
                            ->like('kode_uraian', 'B')
                            ->get()->row();

            //--> mengambil jumlah KKA Ikhtisar yang telah selesai (TIDAK ADA REVIU) di setiap no. KKA
            $cek2 = $this->db->select('count(sub_pka2) as jml_ikhtisar_fix')
                            ->from('sub_pka2')
                            ->join('sub_pka1', 'sub_pka1.kode_pekerjaan = sub_pka2.kode_pekerjaan')
                            ->where('nama_instansi', $pka->nama_instansi)
                            ->like('kode_uraian', 'B')
                            ->where('keputusan_kka_ikhtisar', 'selesai')
                            ->get()->row();

            $kec = $this->instansi_m->get_row_kecamatan($tugas->instansi_kec);
            $nama_instansi = $pka->nama_instansi;
            $nama_kecamatan = $kec->nama_kecamatan;
        }

        //-> KONDISI 1 INSTANSI
        else {
            //--> mengambil jumlah KKA Ikhtis di setiap no. KKA
            $cek1 = $this->db->select('count(sub_pka2) as jml_ikhtisar')
                            ->from('sub_pka2')
                            ->join('sub_pka1', 'sub_pka1.kode_pekerjaan = sub_pka2.kode_pekerjaan')
                            ->where('sub_pka1', $pka->sub_pka2)
                            ->like('kode_uraian', 'B')
                            ->get()->row();

            //--> mengambil jumlah KKA Ikhtisar yang telah selesai (TIDAK ADA REVIU) di setiap no. KKA
            $cek2 = $this->db->select('count(sub_pka2) as jml_ikhtisar_fix')
                            ->from('sub_pka2')
                            ->join('sub_pka1', 'sub_pka1.kode_pekerjaan = sub_pka2.kode_pekerjaan')
                            ->where('sub_pka1', $pka->sub_pka2)
                            ->like('kode_uraian', 'B')
                            ->where('keputusan_kka_ikhtisar', 'selesai')
                            ->get()->row();

            $nama_instansi = $tugas->sasaran_peng;
            $nama_kecamatan = $tugas->kecamatan;
        }

        //echo "$cek2->jml_ikhtisar_fix dari $cek1->jml_ikhtisar";
        if ($cek1->jml_ikhtisar == $cek2->jml_ikhtisar_fix) {
            // Cek apakah sudah ada atau belum. 

            $p2hpRow = $this->db->query("SELECT * FROM tb_p2hp WHERE fk_pka = '$id_pka'");
            if ($p2hpRow->num_rows() < 1) {
                //--> tambahkan P2HP
                $data_p2hp = array(
                    'fk_pka' => $data_pka->id_pka,
                    'fk_tgs' => $data_pka->id_tgs,
                    'nm_instansi' => $nama_instansi,
                    'nm_kec' => $nama_kecamatan
                );
                $this->db->insert('tb_p2hp', $data_p2hp);

                ########## SMS GATEWAY ##########
                $sms = $this->db->get_where('set_sms', array('id' => '1'))->row();
                $sms_kt = $this->db->get_where('tb_pegawai', array('id_pegawai' => $tugas->ketua_tim))->row();

                $pesan = "PEMBERITAHUAN! P2HP $nama_instansi, dengan NO. SURAT : $tugas->no_st telah siap Dibuat. Silahkan buka http://sipiko.pariamankota.go.id/index.php/log_in";

                //--> sms staff
                $array_sms = array(
                    "id" => $tugas->no_st,
                    "waktu" => date("d-m-Y H:i:s"),
                    "nomor" => $sms_kt->no_tlp,
                    "pesan" => $pesan,
                    "email" => $sms->email,
                    "status" => "new"
                );
                $this->smsgateway->outbox($sms->base_url . $sms->base_path . '/data_outbox.json', $array_sms);
                ########## /.SMS GATEWAY ##########
            }
        }
    }
   

}
