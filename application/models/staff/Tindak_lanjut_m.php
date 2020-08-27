<?php

class Tindak_lanjut_m extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    //--> Mengecek id terakhir tb_penugasan
    function get_id_max_tl() {
        /* $kode 	= "TNL";
          $sql  	= "SELECT max(id_tl) as max_id FROM tb_tindak_lanjut";
          $row  	= $this->db->query($sql)->row();
          $max_id = $row->max_id;
          $max_no = substr($max_id,3);
          $new_no = $max_no + 5;
          $id 		= $kode.$new_no;
          return $id; */

        return "TNL_" . date("dmYHis") . "_" . round(microtime(true) * 1000);
    }

    //--> Mengecek max reviu tgs
    function cek_rev_tl($id_tl) {
        $sql = "SELECT max(rev_ke) as no_rev FROM rev_tindak_lanjut WHERE rev_tl = '$id_tl'";
        $row = $this->db->query($sql)->row();
        $max_no = $row->no_rev + 1;
        return $max_no;
    }

    function cek_reviu($id_tl) {
        return $this->db->query("SELECT * FROM rev_tindak_lanjut WHERE rev_tl = '$id_tl'")->num_rows();
    }

    //--> ambil semua data tl
    function get_tl() {
        return $this->db->select('*')
            ->from('tb_tindak_lanjut')
            ->join('notifikasi', 'notifikasi.id_terkait = tb_tindak_lanjut.id_tl')
            ->order_by('tgl_tl', 'desc')
            ->get()->result();
    }

    function get_tugas_inspektorat() {
        return $this->db->select('*')
                        ->from('tb_tindak_lanjut')
                        ->join('notifikasi', 'notifikasi.id_terkait = tb_tindak_lanjut.id_tl')
                        ->join('tb_surat', 'tb_surat.no_surat = tb_tindak_lanjut.no_st')
                        ->where('persetujuan', 'selesai')
                        ->order_by('tgl_tl', 'desc')
                        ->get()->result();
    }

    //--> ambil data penugasan ketua tim tertentu
    function get_tugas_kt($ketua_tim) {
        return $this->db->select('*')
                        ->from('tb_tindak_lanjut')
                        ->join('notifikasi', 'notifikasi.id_terkait = tb_tindak_lanjut.id_tl')
                        ->join('tb_surat', 'tb_surat.no_surat = tb_tindak_lanjut.no_st')
                        ->join('tb_tim', 'tb_tim.id_tim = tb_tindak_lanjut.id_tim')
                        ->where('ketua_tim', $ketua_tim)
                        ->where('persetujuan', 'selesai')
                        ->order_by('tgl_tl', 'desc')
                        ->get()->result();
    }

    //--> ambil data penugasan ketua tim tertentu
     function get_tugas_ag($anggota) {
        return $this->db->select('*')
                        ->from('tb_temuan')
                        ->join('tb_tindak_lanjut', 'tb_tindak_lanjut.id_temuan = tb_temuan.id_temuan')
                        ->join('tb_surat', 'tb_surat.no_surat = tb_tindak_lanjut.no_st')
                        ->join('sub_tim', 'sub_tim.sub_id_tim = tb_tindak_lanjut.id_tim')
                        ->where('anggota', $anggota)
                        ->where('persetujuan', 'selesai')
                        ->order_by('tgl_tl', 'desc')
                        ->get()->result();
    }

    function get_tugas_ag2($anggota) {
        return $this->db->select('*')
                        ->from('sub_tl1')
                        ->join('tb_tindak_lanjut', 'tb_tindak_lanjut.id_tl = sub_tl1.sub_tl1')
                        ->join('tb_surat', 'tb_surat.no_surat = tb_tindak_lanjut.no_st')
                        ->join('sub_tim', 'sub_tim.sub_id_tim = tb_tindak_lanjut.id_tim')
                        ->where('anggota', $anggota)
                        ->where('persetujuan', 'selesai')
                        ->order_by('tgl_tl', 'desc')
                        ->get()->result();
    }

    //--> ambil data penugasan
    function get_sub_tl2($id_tl, $no_lhp) {
        return $this->db->select('*')
                        ->from('sub_tl2')
                        ->where('sub_tl2', $id_tl)
                        ->where('fk_no_lhp', $no_lhp)
                        ->get()->result();
    }

    //--> ambil data penugasan
    function get_sub_tl2_kat_fix($id_tl, $no_lhp) {
        return $this->db->select('count(*) as jml')
                        ->from('sub_tl2')
                        ->where('sub_tl2', $id_tl)
                        ->where('fk_no_lhp', $no_lhp)
                        ->where('kategori !=', NULL)
                        ->get()->row();
    }

    //--> ambil data penugasan
    function get_row_tl($id_tl) {
        return $this->db->select('*')
                        ->from('tb_tindak_lanjut')
                        ->join('tb_tim', 'tb_tim.id_tim = tb_tindak_lanjut.id_tim')
                        ->join('tb_surat', 'tb_surat.no_surat = tb_tindak_lanjut.no_st')
                        ->join('notifikasi', 'notifikasi.id_terkait = tb_tindak_lanjut.id_tl')
                        ->where('id_tl', $id_tl)
                        ->get()->row();
    }

    //--> ambil data penugasan
    function get_sub_row_tl1($id_tl, $no_lhp) {
        return $this->db->select('*')
                        ->from('sub_tl1')
                        ->join('tb_tindak_lanjut', 'tb_tindak_lanjut.id_tl = sub_tl1.sub_tl1')
                        ->join('tb_lhp', 'tb_lhp.no_lhp = sub_tl1.fk_no_lhp')
                        ->where('sub_tl1', $id_tl)
                        ->where('fk_no_lhp', $no_lhp)
                        ->get()->row();
    }

//--> ambil data penugasan
    function get_row_sub_tl2($id_tl, $no_lhp, $nomor) {
        return $this->db->select('*')
                        ->from('sub_tl2')
                        ->where('sub_tl2', $id_tl)
                        ->where('fk_no_lhp', $no_lhp)
                        ->where('nomor', $nomor)
                        ->get()->row();
    }

    //--> ambil semua data reviu penugasan
    function get_rev_tl($id_tl) {
        return $this->db->select('*')
                        ->from('rev_tindak_lanjut')
                        ->where('rev_tl', $id_tl)
                        ->order_by('rev_tgl_tl', 'desc')
                        ->get()->result();
    }

    function get_lhp($id_tgs) {
        return $this->db->select('*')
                        ->from('tb_lhp')
                        ->where('fk_tgs', $id_tgs)
                        ->get()->result();
    }

    function get_row_lhp($id_tgs) {
        return $this->db->select('*')
                        ->from('tb_lhp')
                        ->where('fk_tgs', $id_tgs)
                        ->get()->row();
    }

    function get_row_lhp2($id_tl, $no_lhp) {
        return $this->db->select('*')
                        ->from('tb_lhp')
                        ->join('tb_tindak_lanjut', 'tb_tindak_lanjut.fk_tgs=tb_lhp.fk_tgs')
                        //->join('tb_tim', 'tb_tim.id_tim=tb_tindak_lanjut.id_tim')
                        ->where('id_tl', $id_tl)
                        ->where('no_lhp', $no_lhp)
                        ->get()->row();
    }

    function get_row_lhp3($no_lhp) {
        return $this->db->select('*')
                        ->from('tb_lhp')
                        ->where('no_lhp', $no_lhp)
                        ->get()->row();
    }

    //--> tambah tindak lanjut
    function insert_tl() {
        $id_tl = $this->input->post('id_tl');
        $id_tgs = $this->input->post('id_tgs');
        $id_tim = $this->input->post('id_tim');
        $no_surat = $this->input->post('no_surat');

        $inspektur = $this->db->get_where('tb_pegawai', array('jabatan' => 'Inspektur'))->row();

        //--> tambah tb_tindak_lanjut
        $data_tl = array(
            'id_tl' => $id_tl,
            'tgl_tl' => $this->input->post('tgl_tl'),
            'fk_tgs' => $id_tgs,
            'id_tim' => $id_tim,
            'no_st' => $no_surat,
            'sasaran_peng' => $this->input->post('sasaran_peng'),
            'instansi_kec' => $this->input->post('kecamatan'),
            'kecamatan' => $this->input->post('kecamatan2'),
            'nama_inspektur' => $inspektur->nama,
            'nip_inspektur' => $inspektur->nip
        );

        $this->db->insert('tb_tindak_lanjut', $data_tl);

        //--> tambah tb_tim
        $data_tim = array(
            'id_tim' => $id_tim,
            'ketua_tim' => $this->input->post('ketua_tim'),
            'kategori_tim' => $this->input->post('kategori_tim')
        );
        $this->db->insert('tb_tim', $data_tim);

        ##################################################
        ## UPDATE STAT JABATAN TIM & HAK AKSES PENGGUNA ##
        ##################################################
        // Ketua Tim
        $data_ketua = array('jabatan_tim' => 'Ketua TL');
        $this->db->where('id_pegawai', $this->input->post('ketua_tim'))
                ->update('tb_pegawai', $data_ketua);

        $data_ketu2 = array('level' => 'ketua_tl');
        $this->db->where('id_fk', $this->input->post('ketua_tim'))
                ->update('tb_user', $data_ketu2);

        ##################################################

        $jum_agt = $this->input->post('jml_agt') - 1;
        $anggota = $this->input->post('anggota');
        $jum_ins = $this->input->post('jml_ins');
        $kon_sas = $this->input->post('kondisi_sasaran');

        if ($kon_sas == "pilih") {
            $sasaran = $this->input->post('sasaran');
        } else {
            $sasaran = NULL;
        }

        //--> cek kondisi jumlah anggota dan jumlah sasaran
        # digunakan untuk jumlah pengulangan insert anggota dan sasaran
        if ($jum_agt < $jum_ins) {
            $jml = $jum_ins;
        } elseif ($jum_agt > $jum_ins) {
            $jml = $jum_agt;
        } else {
            $jml = $jum_agt;
        }

        $i = 0;
        while ($i < $jml) {
            if (!empty($sasaran[$i])) {
                $sas = $sasaran[$i];
            }
            //--> tambah sub_tim
            $data_sub_tim = array(
                'sub_id_tim' => $id_tim,
                'nomor' => $i + 1,
                'anggota' => $anggota[$i],
                'sasaran' => $sas
            );
            $this->db->insert('sub_tim', $data_sub_tim);

            //--> update stat jabatan tim & hak akses pengguna
            $data_anggota = array('jabatan_tim' => 'Anggota TL');
            $this->db->where('id_pegawai', $anggota[$i])
                    ->update('tb_pegawai', $data_anggota);

            $data_anggota2 = array('level' => 'anggota_tl');
            $this->db->where('id_fk', $anggota[$i])
                    ->update('tb_user', $data_anggota2);

            $i++;
        }

        //--> tambah tb_surat
        $data_surat = array(
            'no_urut' => $this->input->post('no_urut'),
            'no_surat' => $no_surat,
            'tgl_surat' => $this->input->post('tgl_surat'),
            'dasar_surat' => $this->input->post('dasar_surat'),
            'fk_tim' => $id_tim,
            'untuk' => $this->input->post('perihal'),
            'tgl_awal' => $this->input->post('tgl_awal'),
            'tgl_akhir' => $this->input->post('tgl_akhir'),
            'stat_sasaran' => $kon_sas,
            'kategori_surat' => $this->input->post('kategori_tim')
        );
        $this->db->insert('tb_surat', $data_surat);

        $jum_tbs = $this->input->post('jml_tbs') - 1;
        $tembusan = $this->input->post('tembusan');

        $i = 0;
        while ($i < $jum_tbs) {
            //--> tambah sub_surat
            $data_sub_surat = array(
                'sub_no_surat' => $no_surat,
                'nomor' => $i + 1,
                'tembusan' => $tembusan[$i]
            );
            $this->db->insert('sub_surat', $data_sub_surat);

            $i++;
        }

        //--> tambah notifikasi
        $data_notif = array(
            'id_terkait' => $id_tl,
            'notif_adum' => "lama",
            'notif_sekretaris' => "lama"
        );
        $this->db->insert('notifikasi', $data_notif);
    }

    function insert_tl4() {
        $temuan = $this->db->get_where('tb_temuan', array('id_temuan' => $this->input->post('sasaran_peng')))->row();

        $id_tl = $this->input->post('id_tl');
        $id_tim = $this->input->post('id_tim');
        $no_surat = $this->input->post('no_surat');

        $inspektur = $this->db->get_where('tb_pegawai', array('jabatan' => 'Inspektur'))->row();

        //--> tambah tb_tindak_lanjut
        $data_tl = array(
            'id_tl' => $id_tl,
            'tgl_tl' => $this->input->post('tgl_tl'),
            'id_tim' => $id_tim,
            'id_temuan' => $temuan->id_temuan,
            'no_st' => $no_surat,
            'sasaran_peng' => $temuan->instansi,
            'instansi_kec' => $this->input->post('kecamatan'),
            'kecamatan' => $this->input->post('kecamatan2'),
            'nama_inspektur' => $inspektur->nama,
            'nip_inspektur' => $inspektur->nip
        );

        $this->db->insert('tb_tindak_lanjut', $data_tl);

        //--> tambah tb_tim
        $data_tim = array(
            'id_tim' => $id_tim,
            'ketua_tim' => $this->input->post('ketua_tim'),
            'kategori_tim' => $this->input->post('kategori_tim')
        );
        $this->db->insert('tb_tim', $data_tim);

        ##################################################
        ## UPDATE STAT JABATAN TIM & HAK AKSES PENGGUNA ##
        ##################################################
        // Ketua Tim
        $data_ketua = array('jabatan_tim' => 'Ketua TL');
        $this->db->where('id_pegawai', $this->input->post('ketua_tim'))
                ->update('tb_pegawai', $data_ketua);

        $data_ketu2 = array('level' => 'ketua_tl');
        $this->db->where('id_fk', $this->input->post('ketua_tim'))
                ->update('tb_user', $data_ketu2);

        ##################################################

        $jum_agt = $this->input->post('jml_agt') - 1;
        $anggota = $this->input->post('anggota');
        $jum_ins = $this->input->post('jml_ins');
        $kon_sas = $this->input->post('kondisi_sasaran');

        if ($kon_sas == "pilih") {
            $sasaran = $this->input->post('sasaran');
        } else {
            $sasaran = NULL;
        }

        //--> cek kondisi jumlah anggota dan jumlah sasaran
        # digunakan untuk jumlah pengulangan insert anggota dan sasaran
        if ($jum_agt < $jum_ins) {
            $jml = $jum_ins;
        } elseif ($jum_agt > $jum_ins) {
            $jml = $jum_agt;
        } else {
            $jml = $jum_agt;
        }

        $i = 0;
        while ($i < $jml) {
            if (!empty($sasaran[$i])) {
                $sas = $sasaran[$i];
            }
            //--> tambah sub_tim
            $data_sub_tim = array(
                'sub_id_tim' => $id_tim,
                'nomor' => $i + 1,
                'anggota' => $anggota[$i],
                'sasaran' => $sas
            );
            $this->db->insert('sub_tim', $data_sub_tim);

            //--> update stat jabatan tim & hak akses pengguna
            $data_anggota = array('jabatan_tim' => 'Anggota TL');
            $this->db->where('id_pegawai', $anggota[$i])
                    ->update('tb_pegawai', $data_anggota);

            $data_anggota2 = array('level' => 'anggota_tl');
            $this->db->where('id_fk', $anggota[$i])
                    ->update('tb_user', $data_anggota2);

            $i++;
        }

        //--> tambah tb_surat
        $data_surat = array(
            'no_urut' => $this->input->post('no_urut'),
            'no_surat' => $no_surat,
            'tgl_surat' => $this->input->post('tgl_surat'),
            'dasar_surat' => $this->input->post('dasar_surat'),
            'fk_tim' => $id_tim,
            'untuk' => $this->input->post('perihal'),
            'tgl_awal' => $this->input->post('tgl_awal'),
            'tgl_akhir' => $this->input->post('tgl_akhir'),
            'stat_sasaran' => $kon_sas,
            'kategori_surat' => $this->input->post('kategori_tim')
        );
        $this->db->insert('tb_surat', $data_surat);

        $jum_tbs = $this->input->post('jml_tbs') - 1;
        $tembusan = $this->input->post('tembusan');

        $i = 0;
        while ($i < $jum_tbs) {
            //--> tambah sub_surat
            $data_sub_surat = array(
                'sub_no_surat' => $no_surat,
                'nomor' => $i + 1,
                'tembusan' => $tembusan[$i]
            );
            $this->db->insert('sub_surat', $data_sub_surat);

            $i++;
        }

        //--> tambah notifikasi
        $data_notif = array(
            'id_terkait' => $id_tl,
            'notif_adum' => "lama",
            'notif_sekretaris' => "lama"
        );
        $this->db->insert('notifikasi', $data_notif);
    }

    //--> reviu penugasan
    function reviu_tl() {
        $id_tl = $this->input->post('id_tl');
        $id_tim = $this->input->post('id_tim');
        $id_temuan = $this->input->post('id_temuan');
        $no_surat = $this->input->post('no_surat');
        $no_rev = $this->input->post('no_rev');

        $get = $this->db->select('*')
                        ->from('tb_tindak_lanjut')
                        ->join('tb_tim', 'tb_tim.id_tim=tb_tindak_lanjut.id_tim')
                        ->join('tb_surat', 'tb_surat.no_surat=tb_tindak_lanjut.no_st')
                        ->where('id_tl', $id_tl)
                        ->get()->row();

        //--> tambah tabel rev_penugasan1
        $data_rev_tl = array(
            'rev_tl' => $get->id_tl,
            'rev_tgl_tl' => date('Y-m-d H:i:s'),
            'rev_ke' => $no_rev,
            'rev_fk_tgs' => $get->fk_tgs,
            'rev_id_temuan' => $get->id_temuan,
            'rev_id_tim' => $get->id_tim,
            'rev_no_st' => $get->no_st,
            'rev_sasaran_peng' => $get->sasaran_peng,
            'rev_instansi_kec' => $get->instansi_kec,
            'rev_kecamatan' => $get->kecamatan,
            'rev_nama_inspektur' => $get->nama_inspektur,
            'rev_nip_inspektur' => $get->nip_inspektur,
            'rev_tgl_adum' => $get->tgl_rev_adum,
            'rev_adum' => $get->reviu_adum,
            'rev_tgl_sekretaris' => $get->tgl_rev_sekretaris,
            'rev_sekretaris' => $get->reviu_sekretaris,
            'rev_ketua_tim' => $get->ketua_tim,
            'rev_dasar_surat' => $get->dasar_surat,
            'rev_tgl_awal' => $get->tgl_awal,
            'rev_tgl_akhir' => $get->tgl_akhir
        );
        $this->db->insert('rev_tindak_lanjut', $data_rev_tl);

        $get2 = $this->db->get_where('sub_tim', array('sub_id_tim' => $id_tim))->result();

        //--> tambah tabel rev_penugasan2
        foreach ($get2 as $row) {
            $data_rev_penugasan2 = array(
                'rev_tugas2' => $id_tim,
                'rev_ke' => $no_rev,
                'rev_nomor' => $row->nomor,
                'rev_anggota' => $row->anggota,
                'rev_sasaran' => $row->sasaran
            );
            $this->db->insert('rev_penugasan2', $data_rev_penugasan2);
        }

        $get3 = $this->db->get_where('sub_surat', array('sub_no_surat' => $no_surat))->result();

        //--> tambah tabel rev_penugasan3
        foreach ($get3 as $row) {
            $data_rev_penugasan3 = array(
                'rev_tugas3' => $row->sub_no_surat,
                'rev_ke' => $no_rev,
                'rev_nomor' => $row->nomor,
                'rev_tembusan' => $row->tembusan
            );
            $this->db->insert('rev_penugasan3', $data_rev_penugasan3);
        }

        #############################################################
        //--> hapus data sub_tim dan sub_surat
        $this->db->delete('sub_tim', array('sub_id_tim' => $id_tim));
        $this->db->delete('sub_surat', array('sub_no_surat' => $no_surat));

        #############################################################

        if ($get->reviu_adum == "-") {
            $tgl_adum = $get->tgl_rev_adum;
            $rev_adum = $get->reviu_adum;
            $notif_adum = "lama";
        } else {
            $tgl_adum = NULL;
            $rev_adum = NULL;
            $notif_adum = "lama";
        }

        if ($get->reviu_sekretaris == "-") {
            $tgl_sekretaris = $get->tgl_rev_sekretaris;
            $rev_sekretaris = $get->reviu_sekretaris;
            $notif_sekretaris = "lama";
        } else {
            $tgl_sekretaris = NULL;
            $rev_sekretaris = NULL;
            $notif_sekretaris = "lama";
        }

        //--> ubah tb_penugasan
        $data_tl = array(
            'sasaran_peng' => $this->input->post('sasaran_peng'),
            'instansi_kec' => $this->input->post('kecamatan'),
            'kecamatan' => $this->input->post('kecamatan2'),
            'tgl_rev_adum' => $tgl_adum,
            'reviu_adum' => $rev_adum,
            'tgl_rev_sekretaris' => $tgl_sekretaris,
            'reviu_sekretaris' => $rev_sekretaris,
            'persetujuan' => 'proses'
        );
        $this->db->where('id_tl', $id_tl)
                ->update('tb_tindak_lanjut', $data_tl);

        //--> tambah tb_tim
        $data_tim = array(
            'ketua_tim' => $this->input->post('ketua_tim')
        );
        $this->db->where('id_tim', $id_tim)
                ->update('tb_tim', $data_tim);

        $jum_agt = $this->input->post('jml_agt') - 1;
        $anggota = $this->input->post('anggota');
        $jum_ins = $this->input->post('jml_ins');
        $kon_sas = $this->input->post('kondisi_sasaran');

        if ($kon_sas == "pilih") {
            $sasaran = $this->input->post('sasaran');
        } else {
            $sasaran = NULL;
        }

        //--> cek kondisi jumlah anggota dan jumlah sasaran
        # digunakan untuk jumlah pengulangan insert anggota dan sasaran
        if ($jum_agt < $jum_ins) {
            $jml = $jum_ins;
        } elseif ($jum_agt > $jum_ins) {
            $jml = $jum_agt;
        } else {
            $jml = $jum_agt;
        }

        $i = 0;
        while ($i < $jml) {
            if (!empty($sasaran[$i])) {
                $sas = $sasaran[$i];
            }

            //--> tambah sub_tim
            $data_sub_tim = array(
                'sub_id_tim' => $id_tim,
                'nomor' => $i + 1,
                'anggota' => $anggota[$i],
                'sasaran' => $sas
            );
            $this->db->insert('sub_tim', $data_sub_tim);

            $i++;
        }

        //--> tambah tb_surat
        $data_surat = array(
            'dasar_surat' => $this->input->post('dasar_surat'),
            'untuk' => $this->input->post('perihal'),
            'tgl_awal' => $this->input->post('tgl_awal'),
            'tgl_akhir' => $this->input->post('tgl_akhir'),
            'stat_sasaran' => $kon_sas
        );
        $this->db->where('no_surat', $no_surat)
                ->update('tb_surat', $data_surat);

        $jum_tbs = $this->input->post('jml_tbs') - 1;
        $tembusan = $this->input->post('tembusan');

        $j = 0;
        while ($j < $jum_tbs) {
            //--> tambah sub_surat
            $data_sub_surat = array(
                'sub_no_surat' => $no_surat,
                'nomor' => $j + 1,
                'tembusan' => $tembusan[$j]
            );
            $this->db->insert('sub_surat', $data_sub_surat);

            $j++;
        }

        //--> tambah notifikasi
        $data_notif = array(
            'notif_adum' => $notif_adum,
            'notif_sekretaris' => $notif_sekretaris
        );
        $this->db->where('id_terkait', $id_tl)
                ->update('notifikasi', $data_notif);
    }

    //--> persetujuan ADUM
    function persetujuan_adum($id_tl) {
        $cek = $this->db->get_where('tb_tindak_lanjut', array('id_tl' => $id_tl))->row();

        if ($this->input->post('reviu') == 'setujui') {
            $catatan = "-";
        } else {
            $catatan = $this->input->post('catatan');
        }

        if ($catatan == "-" && $cek->reviu_sekretaris == '-') {
            $keputusan = "selesai";
        } elseif ($catatan == "-" && $cek->reviu_sekretaris == NULL) {
            $keputusan = "Proses";
        } else {
            $keputusan = "reviu";
        }

        //--> ubah tb_penugasan
        $data_tl = array(
            'tgl_rev_adum' => date('Y-m-d H:i:s'),
            'reviu_adum' => $catatan,
            'persetujuan' => $keputusan
        );
        $this->db->where('id_tl', $id_tl)
                ->update('tb_tindak_lanjut', $data_tl);

        //--> ubah notifikasi
        $data_notif = array(
            'notif_staff' => "lama"
        );
        $this->db->where('id_terkait', $id_tl)
                ->update('notifikasi', $data_notif);
    }

    //--> persetujuan ADUM
    function persetujuan_sekretaris($id_tl) {
        $cek = $this->db->get_where('tb_tindak_lanjut', array('id_tl' => $id_tl))->row();

        if ($this->input->post('reviu') == 'setujui') {
            $catatan = "-";
        } else {
            $catatan = $this->input->post('catatan');
        }

        if ($catatan == "-" && $cek->reviu_adum == '-') {
            $keputusan = "selesai";
        } elseif ($catatan == "-" && $cek->reviu_adum == NULL) {
            $keputusan = "Proses";
        } else {
            $keputusan = "reviu";
        }

        //--> ubah tb_penugasan
        $data_tl = array(
            'tgl_rev_sekretaris' => date('Y-m-d H:i:s'),
            'reviu_sekretaris' => $catatan,
            'persetujuan' => $keputusan
        );
        $this->db->where('id_tl', $id_tl)
                ->update('tb_tindak_lanjut', $data_tl);

        //--> ubah notifikasi
        $data_notif = array(
            'notif_staff' => "lama"
        );
        $this->db->where('id_terkait', $id_tl)
                ->update('notifikasi', $data_notif);
    }

    function verifikasi_digital($filename, $id_tl) {
        $fNam = $filename . ".png";
        $data = array(
            'tgl_persetujuan' => date('Y-m-d H:i:s'),
            'ttd' => $fNam
        );
        $this->db->where('id_tl', $id_tl)
                ->update('tb_tindak_lanjut', $data);
    }

    function verifikasi_manual($id_tl) {
        $data = array(
            'tgl_persetujuan' => date('Y-m-d H:i:s')
        );
        $this->db->where('id_tl', $id_tl)
                ->update('tb_tindak_lanjut', $data);
    }

    ####################################################
    ### KETUA TIM TINDAK LANJUT

    function cek_sub_tl1($id_tl) {
        return $this->db->query("SELECT * FROM sub_tl1 WHERE sub_tl1 = '$id_tl'")->num_rows();
    }

    //--> tambah tindak lanjut
    function insert_tl2() {
        $id_tl = $this->input->post('id_tl');
        $id_tgs = $this->input->post('id_tgs');
        $id_tim = $this->input->post('id_tim');
        $no_lhp = $this->input->post('no_lhp');

        $jml1 = str_replace(".", "", $this->input->post('jml_kas_negara'));
        $set1 = str_replace(".", "", $this->input->post('setor_kas_negara'));
        $jml2 = str_replace(".", "", $this->input->post('jml_kas_daerah'));
        $set2 = str_replace(".", "", $this->input->post('setor_kas_daerah'));
        $jml3 = str_replace(".", "", $this->input->post('jml_kas_desa'));
        $set3 = str_replace(".", "", $this->input->post('setor_kas_desa'));
        $nm = $this->input->post('nama_pejabat');
        $nip = $this->input->post('nip_pejabat');

        $jmlUri = $this->input->post('jml_uri') - 1;
        $uriTm = $this->input->post('uraian_temuan');
        $kdTm = $this->input->post('kode_temuan');
        $uriRk = $this->input->post('uraian_rekomendasi');
        $kdRk = $this->input->post('kode_rekomendasi');
        $uriTl = $this->input->post('uraian_tl');
        $ket = $this->input->post('keterangan');

        $i = 0;

        /* $katS  = 0;
          $katDP = 0;
          $katB  = 0;
          $katCR = 0; */

        //--> kode temuan
        $kod101 = 0;
        $kod102 = 0;
        $kod103 = 0;
        $kod104 = 0;
        $kod105 = 0;
        $kod201 = 0;
        $kod202 = 0;
        $kod203 = 0;
        $kod301 = 0;
        $kod302 = 0;
        $kod303 = 0;

        //--> kode rekomendasi
        $kod00 = 0;
        $kod01 = 0;
        $kod02 = 0;
        $kod03 = 0;
        $kod04 = 0;
        $kod05 = 0;
        $kod06 = 0;
        $kod07 = 0;
        $kod08 = 0;
        $kod09 = 0;
        $kod10 = 0;
        $kod11 = 0;
        $kod12 = 0;
        $kod13 = 0;
        $kod14 = 0;

        while ($i < $jmlUri) {
            /* if($kdTl[$i] == "S")
              { $katS += 1; }
              if($kdTl[$i] == "DP")
              { $katDP += 1; }
              if($kdTl[$i] == "B")
              { $katB += 1; }
              if($kdTl[$i] == "CR")
              { $katCR += 1; } */

            // kode temuan
            if ($kdTm[$i] == "101") {
                $kod101 += 1;
            }
            if ($kdTm[$i] == "102") {
                $kod102 += 1;
            }
            if ($kdTm[$i] == "103") {
                $kod103 += 1;
            }
            if ($kdTm[$i] == "104") {
                $kod104 += 1;
            }
            if ($kdTm[$i] == "105") {
                $kod105 += 1;
            }
            if ($kdTm[$i] == "201") {
                $kod201 += 1;
            }
            if ($kdTm[$i] == "202") {
                $kod202 += 1;
            }
            if ($kdTm[$i] == "203") {
                $kod203 += 1;
            }
            if ($kdTm[$i] == "301") {
                $kod301 += 1;
            }
            if ($kdTm[$i] == "302") {
                $kod302 += 1;
            }
            if ($kdTm[$i] == "303") {
                $kod303 += 1;
            }

            // kode rekomendasi
            if ($kdRk[$i] == "00") {
                $kod00 += 1;
            }
            if ($kdRk[$i] == "01") {
                $kod01 += 1;
            }
            if ($kdRk[$i] == "02") {
                $kod02 += 1;
            }
            if ($kdRk[$i] == "03") {
                $kod03 += 1;
            }
            if ($kdRk[$i] == "04") {
                $kod04 += 1;
            }
            if ($kdRk[$i] == "05") {
                $kod05 += 1;
            }
            if ($kdRk[$i] == "06") {
                $kod06 += 1;
            }
            if ($kdRk[$i] == "07") {
                $kod07 += 1;
            }
            if ($kdRk[$i] == "08") {
                $kod08 += 1;
            }
            if ($kdRk[$i] == "09") {
                $kod09 += 1;
            }
            if ($kdRk[$i] == "10") {
                $kod10 += 1;
            }
            if ($kdRk[$i] == "11") {
                $kod11 += 1;
            }
            if ($kdRk[$i] == "12") {
                $kod12 += 1;
            }
            if ($kdRk[$i] == "13") {
                $kod13 += 1;
            }
            if ($kdRk[$i] == "14") {
                $kod14 += 1;
            }

            //--> tambah sub_tim
            $data_sub_tl2 = array(
                'sub_tl2' => $id_tl,
                'fk_tgs' => $id_tgs,
                'fk_tim' => $id_tim,
                'fk_no_lhp' => $no_lhp,
                'nomor' => $i + 1,
                'uraian_tm' => $uriTm[$i],
                'kode_tm' => $kdTm[$i],
                'uraian_rk' => $uriRk[$i],
                'kode_rk' => $kdRk[$i],
                'uraian_tl' => $uriTl[$i],
                'keterangan' => $ket[$i]
            );
            $this->db->insert('sub_tl2', $data_sub_tl2);

            $i++;
        }

        $jml_kode_tm = $kod101 + $kod102 + $kod103 + $kod104 + $kod105 + $kod201 + $kod202 + $kod203 + $kod301 + $kod302 + $kod303;
        $jml_kode_rk = $kod00 + $kod01 + $kod02 + $kod03 + $kod05 + $kod06 + $kod07 + $kod08 + $kod09 + $kod10 + $kod11 + $kod12 + $kod13 + $kod14;

        $sisa1 = $jml1 - $set1;
        $sisa2 = $jml2 - $set2;
        $sisa3 = $jml3 - $set3;

        //--> tambah sub_tim
        $data_sub_tl1 = array(
            'sub_tl1' => $id_tl,
            'fk_tgs' => $id_tgs,
            'fk_tim' => $id_tim,
            'fk_no_lhp' => $no_lhp,
            'tgl_tl1' => date('Y-m-d H:i:s'),
            'jml_temuan' => $jmlUri,
            'jml_rekomendasi' => $jmlUri,
            /* 'jml_s'           => ,
              'jml_dp'          => ,
              'jml_b'           => ,
              'jml_cr'          => , */
            'jml_tm_101' => $kod101,
            'jml_tm_102' => $kod102,
            'jml_tm_103' => $kod103,
            'jml_tm_104' => $kod104,
            'jml_tm_105' => $kod105,
            'jml_tm_201' => $kod201,
            'jml_tm_202' => $kod202,
            'jml_tm_203' => $kod203,
            'jml_tm_301' => $kod301,
            'jml_tm_302' => $kod302,
            'jml_tm_303' => $kod303,
            'jml_tm' => $jml_kode_tm,
            'jml_rk_00' => $kod00,
            'jml_rk_01' => $kod01,
            'jml_rk_02' => $kod02,
            'jml_rk_03' => $kod03,
            'jml_rk_04' => $kod04,
            'jml_rk_05' => $kod05,
            'jml_rk_06' => $kod06,
            'jml_rk_07' => $kod07,
            'jml_rk_08' => $kod08,
            'jml_rk_09' => $kod09,
            'jml_rk_10' => $kod10,
            'jml_rk_11' => $kod11,
            'jml_rk_12' => $kod12,
            'jml_rk_13' => $kod13,
            'jml_rk_14' => $kod14,
            'jml_rk' => $jml_kode_rk,
            'jml_kas_negara' => $jml1,
            'str_kas_negara' => $set1,
            'sis_kas_negara' => $sisa1,
            'jml_kas_daerah' => $jml2,
            'str_kas_daerah' => $set2,
            'sis_kas_daerah' => $sisa2,
            'jml_kas_desa' => $jml3,
            'str_kas_desa' => $set3,
            'sis_kas_desa' => $sisa3,
            'nama_pejabat' => $nm,
            'nip_pejabat' => $nip
        );
        $this->db->insert('sub_tl1', $data_sub_tl1);
    }

    function insert_tl3() {
        $id_tl = $this->input->post('id_tl');
        $id_tgs = $this->input->post('id_tgs');
        $id_tim = $this->input->post('id_tim');
        $no_lhp = $this->input->post('no_lhp');

        $jml1 = str_replace(".", "", $this->input->post('jml_kas_negara'));
        $set1 = str_replace(".", "", $this->input->post('setor_kas_negara'));
        $jml2 = str_replace(".", "", $this->input->post('jml_kas_daerah'));
        $set2 = str_replace(".", "", $this->input->post('setor_kas_daerah'));
        $jml3 = str_replace(".", "", $this->input->post('jml_kas_desa'));
        $set3 = str_replace(".", "", $this->input->post('setor_kas_desa'));
        $nm = $this->input->post('nama_pejabat');
        $nip = $this->input->post('nip_pejabat');

        $jmlUri = $this->input->post('jml_uri') - 1;
        $uriTm = $this->input->post('uraian_temuan');
        $kdTm = $this->input->post('kode_temuan');
        $uriRk = $this->input->post('uraian_rekomendasi');
        $kdRk = $this->input->post('kode_rekomendasi');
        $uriTl = $this->input->post('uraian_tl');
        $ket = $this->input->post('keterangan');

        $i = 0;

        /* $katS  = 0;
          $katDP = 0;
          $katB  = 0;
          $katCR = 0; */

        //--> kode temuan
        $kod101 = 0;
        $kod102 = 0;
        $kod103 = 0;
        $kod104 = 0;
        $kod105 = 0;
        $kod201 = 0;
        $kod202 = 0;
        $kod203 = 0;
        $kod301 = 0;
        $kod302 = 0;
        $kod303 = 0;

        //--> kode rekomendasi
        $kod00 = 0;
        $kod01 = 0;
        $kod02 = 0;
        $kod03 = 0;
        $kod04 = 0;
        $kod05 = 0;
        $kod06 = 0;
        $kod07 = 0;
        $kod08 = 0;
        $kod09 = 0;
        $kod10 = 0;
        $kod11 = 0;
        $kod12 = 0;
        $kod13 = 0;
        $kod14 = 0;

        while ($i < $jmlUri) {
            /* if($kdTl[$i] == "S")
              { $katS += 1; }
              if($kdTl[$i] == "DP")
              { $katDP += 1; }
              if($kdTl[$i] == "B")
              { $katB += 1; }
              if($kdTl[$i] == "CR")
              { $katCR += 1; } */

            // kode temuan
            if ($kdTm[$i] == "101") {
                $kod101 += 1;
            }
            if ($kdTm[$i] == "102") {
                $kod102 += 1;
            }
            if ($kdTm[$i] == "103") {
                $kod103 += 1;
            }
            if ($kdTm[$i] == "104") {
                $kod104 += 1;
            }
            if ($kdTm[$i] == "105") {
                $kod105 += 1;
            }
            if ($kdTm[$i] == "201") {
                $kod201 += 1;
            }
            if ($kdTm[$i] == "202") {
                $kod202 += 1;
            }
            if ($kdTm[$i] == "203") {
                $kod203 += 1;
            }
            if ($kdTm[$i] == "301") {
                $kod301 += 1;
            }
            if ($kdTm[$i] == "302") {
                $kod302 += 1;
            }
            if ($kdTm[$i] == "303") {
                $kod303 += 1;
            }

            // kode rekomendasi
            if ($kdRk[$i] == "00") {
                $kod00 += 1;
            }
            if ($kdRk[$i] == "01") {
                $kod01 += 1;
            }
            if ($kdRk[$i] == "02") {
                $kod02 += 1;
            }
            if ($kdRk[$i] == "03") {
                $kod03 += 1;
            }
            if ($kdRk[$i] == "04") {
                $kod04 += 1;
            }
            if ($kdRk[$i] == "05") {
                $kod05 += 1;
            }
            if ($kdRk[$i] == "06") {
                $kod06 += 1;
            }
            if ($kdRk[$i] == "07") {
                $kod07 += 1;
            }
            if ($kdRk[$i] == "08") {
                $kod08 += 1;
            }
            if ($kdRk[$i] == "09") {
                $kod09 += 1;
            }
            if ($kdRk[$i] == "10") {
                $kod10 += 1;
            }
            if ($kdRk[$i] == "11") {
                $kod11 += 1;
            }
            if ($kdRk[$i] == "12") {
                $kod12 += 1;
            }
            if ($kdRk[$i] == "13") {
                $kod13 += 1;
            }
            if ($kdRk[$i] == "14") {
                $kod14 += 1;
            }

            //--> tambah sub_tim
            $data_sub_tl2 = array(
                'sub_tl2' => $id_tl,
                'fk_tgs' => $id_tgs,
                'fk_tim' => $id_tim,
                'fk_no_lhp' => $no_lhp,
                'nomor' => $i + 1,
                'uraian_tm' => $uriTm[$i],
                'kode_tm' => $kdTm[$i],
                'uraian_rk' => $uriRk[$i],
                'kode_rk' => $kdRk[$i],
                'uraian_tl' => $uriTl[$i],
                'keterangan' => $ket[$i]
            );

            $this->db->insert('sub_tl2', $data_sub_tl2);

            $i++;
        }

        $jml_kode_tm = $kod101 + $kod102 + $kod103 + $kod104 + $kod105 + $kod201 + $kod202 + $kod203 + $kod301 + $kod302 + $kod303;
        $jml_kode_rk = $kod00 + $kod01 + $kod02 + $kod03 + $kod05 + $kod06 + $kod07 + $kod08 + $kod09 + $kod10 + $kod11 + $kod12 + $kod13 + $kod14;

        $sisa1 = $jml1 - $set1;
        $sisa2 = $jml2 - $set2;
        $sisa3 = $jml3 - $set3;

        //--> tambah sub_tim
        $data_sub_tl1 = array(
            'sub_tl1' => $id_tl,
            'fk_tgs' => $id_tgs,
            'fk_tim' => $id_tim,
            'fk_no_lhp' => $no_lhp,
            'tgl_tl1' => date('Y-m-d H:i:s'),
            'jml_temuan' => $jmlUri,
            'jml_rekomendasi' => $jmlUri,
            /* 'jml_s'           => ,
              'jml_dp'          => ,
              'jml_b'           => ,
              'jml_cr'          => , */
            'jml_tm_101' => $kod101,
            'jml_tm_102' => $kod102,
            'jml_tm_103' => $kod103,
            'jml_tm_104' => $kod104,
            'jml_tm_105' => $kod105,
            'jml_tm_201' => $kod201,
            'jml_tm_202' => $kod202,
            'jml_tm_203' => $kod203,
            'jml_tm_301' => $kod301,
            'jml_tm_302' => $kod302,
            'jml_tm_303' => $kod303,
            'jml_tm' => $jml_kode_tm,
            'jml_rk_00' => $kod00,
            'jml_rk_01' => $kod01,
            'jml_rk_02' => $kod02,
            'jml_rk_03' => $kod03,
            'jml_rk_04' => $kod04,
            'jml_rk_05' => $kod05,
            'jml_rk_06' => $kod06,
            'jml_rk_07' => $kod07,
            'jml_rk_08' => $kod08,
            'jml_rk_09' => $kod09,
            'jml_rk_10' => $kod10,
            'jml_rk_11' => $kod11,
            'jml_rk_12' => $kod12,
            'jml_rk_13' => $kod13,
            'jml_rk_14' => $kod14,
            'jml_rk' => $jml_kode_rk,
            'jml_kas_negara' => $jml1,
            'str_kas_negara' => $set1,
            'sis_kas_negara' => $sisa1,
            'jml_kas_daerah' => $jml2,
            'str_kas_daerah' => $set2,
            'sis_kas_daerah' => $sisa2,
            'jml_kas_desa' => $jml3,
            'str_kas_desa' => $set3,
            'sis_kas_desa' => $sisa3,
            'nama_pejabat' => $nm,
            'nip_pejabat' => $nip
        );

        $this->db->insert('sub_tl1', $data_sub_tl1);
    }

    

    //--> tambah tindak lanjut
    function penentuan_kategori() {
        $id_tl = $this->input->post('id_tl');
        $id_tim = $this->input->post('id_tim');
        $no_lhp = $this->input->post('no_lhp');
        $nomor = $this->input->post('nomor');

        $kat = $this->input->post('kategori');

        //--> ubah tb_penugasan
        $data_kep = array(
            'kategori' => $kat
        );
        $this->db->where('sub_tl2', $id_tl)
                ->where('fk_no_lhp', $no_lhp)
                ->where('nomor', $nomor)
                ->update('sub_tl2', $data_kep);

        $get = $this->db->get_where('sub_tl2', array('sub_tl2' => $id_tl, 'fk_no_lhp' => $no_lhp))->result();

        $katS = 0;
        $katDP = 0;
        $katB = 0;
        $katCR = 0;

        foreach ($get as $row) {
            if ($row->kategori == "S") {
                $katS += 1;
            }
            if ($row->kategori == "DP") {
                $katDP += 1;
            }
            if ($row->kategori == "B") {
                $katB += 1;
            }
            if ($row->kategori == "CR") {
                $katCR += 1;
            }
        }

        $jml_kat = $this->get_sub_tl2($id_tl, $no_lhp);
        $kat_fix = $this->get_sub_tl2_kat_fix($id_tl, $no_lhp);

        $cn = count($jml_kat);

        if ($cn == $kat_fix->jml) {
            $hasil_kat = "selesai";
        } else {
            $hasil_kat = "belum";
        }

        $data_tl1 = array(
            'jml_s' => $katS,
            'jml_dp' => $katDP,
            'jml_b' => $katB,
            'jml_cr' => $katCR,
            'semua_kat' => $hasil_kat
        );
        $this->db->where('sub_tl1', $id_tl)
                ->where('fk_no_lhp', $no_lhp)
                ->update('sub_tl1', $data_tl1);
    }

    function upload_rekomendasi() {
        $filetl = str_replace(' ', '_', $_FILES['file_tl']['name']);
        $path = './assets/tl/' . $filetl;

        $data_temuan = array(
            'id_temuan_rekomendasi' => $this->input->post('id_temuan_rekomendasi'),
            'file'          => $filetl,
            'ket'           => $this->input->post('ket'),
            'tgl_upload'    => date('Y-m-d H:i:s'),
        );

        $this->db->insert('tb_temuan_rekomendasi_upload', $data_temuan);

        move_uploaded_file($_FILES['file_tl']['tmp_name'], $path);
    }

    // MULAI TEMUAN
    function insert_temuan_ketua_tim() {
        $filelhp = str_replace(' ', '_', $_FILES['file_lhp']['name']);
        $path = './assets/lhp/mnl/' . $filelhp;

        $data_temuan = array(
            'no_lhp' => $this->input->post('no_lhp'),
            'tgl_lhp' => $this->input->post('tgl_lhp'),
            'kategori_lhp' => 'LHP APIP Kota Pariaman',
            'instansi' => $this->input->post('instansi'),
            'file_lhp' => $filelhp,
            'by' => 'ketua_tim',
            'status_usulan' => '0',
            'tgl_tbh' => date('Y-m-d H:i:s'),
        );

        $this->db->insert('tb_temuan', $data_temuan);

        move_uploaded_file($_FILES['file_lhp']['tmp_name'], $path);

        $last_id_temuan = $this->db->insert_id();

        $i = 0;
        $aspek = $this->input->post('aspek');
        $nip = $this->input->post('nip');
        $nama = $this->input->post('nama');
        $temuan = $this->input->post('temuan');
        $kode_temuan = $this->input->post('kode_temuan');
        $nilaitemuan = $this->input->post('nilaitemuan');
        $rekomendasi = $this->input->post('rekomendasi');
        $kode_rekomendasi = $this->input->post('kode_rekomendasi');
        $nilairekomendasi = $this->input->post('nilairekomendasi');        
        foreach ($nip as $value) {
            $data_aspek = array(
                'id_temuan' => $last_id_temuan,
                'aspek' => $aspek[$i],
                'no_urut' => $i + 1,
                'judul' => $temuan[$i],
                'nilai' => $nilaitemuan[$i],
                'kode_temuan' => $kode_temuan[$i],
                'nm_pejabat' => $nama[$i],
                'nip' => $nip[$i],
            );       
           $this->db->insert('tb_temuan_aspek', $data_aspek);
           $last_id_aspek_spi = $this->db->insert_id();
           $ii = 0;
           foreach ($rekomendasi[$i] as $val) {
                $data_rekomendasi = array(
                    'id_temuan' => $last_id_temuan,
                    'id_temuan_aspek' => $last_id_aspek_spi,
                    'aspek' => $aspek[$i],
                    'no_urut' => $ii + 1,
                    'uraian' => $val,
                    'kode_rekomendasi' => $kode_rekomendasi[$i][$ii],
                    'nilai' => $nilairekomendasi[$i][$ii],
                );
                $this->db->insert('tb_temuan_rekomendasi', $data_rekomendasi);
                $ii++;
            }
            $i++;
        }

        //--> tambah notifikasi
        $data_notif = array(
            'id_terkait' => 'TEMUAN_' . $last_id_temuan,
            'notif_evlap' => "baru"
        );
        $this->db->insert('notifikasi', $data_notif);

    }

    function insert_temuan_staff_evlap() {

        $filelhp = str_replace(' ', '_', $_FILES['file_lhp']['name']);
        $path = './assets/lhp/mnl/' . $filelhp;

        $data_temuan = array(
            'no_lhp' => $this->input->post('no_lhp'),
            'tgl_lhp' => $this->input->post('tgl_lhp'),
            'kategori_lhp' => $this->input->post('kategori_lhp'),
            'instansi' => $this->input->post('instansi'),
            'file_lhp' => $filelhp,
            'by' => 'ketua_tim',
            'status_usulan' => '0',
            'tgl_tbh' => date('Y-m-d H:i:s'),
        );

        $this->db->insert('tb_temuan', $data_temuan);

        move_uploaded_file($_FILES['file_lhp']['tmp_name'], $path);

        $last_id_temuan = $this->db->insert_id();

        $i = 0;
        $aspek = $this->input->post('aspek');
        $nip = $this->input->post('nip');
        $nama = $this->input->post('nama');
        $temuan = $this->input->post('temuan');
        $kode_temuan = $this->input->post('kode_temuan');
        $nilaitemuan = $this->input->post('nilaitemuan');
        $rekomendasi = $this->input->post('rekomendasi');
        $kode_rekomendasi = $this->input->post('kode_rekomendasi');
        $nilairekomendasi = $this->input->post('nilairekomendasi');        
        foreach ($nip as $value) {
            $data_aspek = array(
                'id_temuan' => $last_id_temuan,
                'aspek' => $aspek[$i],
                'no_urut' => $i + 1,
                'judul' => $temuan[$i],
                'nilai' => $nilaitemuan[$i],
                'kode_temuan' => $kode_temuan[$i],
                'nm_pejabat' => $nama[$i],
                'nip' => $nip[$i],
            );       
           $this->db->insert('tb_temuan_aspek', $data_aspek);
           $last_id_aspek_spi = $this->db->insert_id();
           $ii = 0;
           foreach ($rekomendasi[$i] as $val) {
                $data_rekomendasi = array(
                    'id_temuan' => $last_id_temuan,
                    'id_temuan_aspek' => $last_id_aspek_spi,
                    'aspek' => $aspek[$i],
                    'no_urut' => $ii + 1,
                    'uraian' => $val,
                    'kode_rekomendasi' => $kode_rekomendasi[$i][$ii],
                    'nilai' => $nilairekomendasi[$i][$ii],
                );
                $this->db->insert('tb_temuan_rekomendasi', $data_rekomendasi);
                $ii++;
            }
            $i++;
        }


        //--> tambah notifikasi
        $data_notif = array(
            'id_terkait' => 'TEMUAN_' . $last_id_temuan,
            'notif_evlap' => "baru"
        );
        $this->db->insert('notifikasi', $data_notif);
    }
    
    function get_temuan() {
        return $this->db->select('*')
            ->from('tb_temuan')
            ->order_by('tgl_tbh', 'desc')
            ->get()->result();
    }

    function get_temuan_in_tl() {
        return $this->db->select('*')
            ->from('tb_tindak_lanjut')
            ->get()->result();
    }

    function get_tbl_tl($id_tl) {
        return $this->db->select('*')
                ->from('tb_tindak_lanjut')
                ->where('id_tl', $id_tl)
                ->get()->row();
    }

    function get_file_lhp_in_lhp($no_lhp) {
        return $this->db->select('*')
                        ->from('tb_lhp')
                        ->where('no_lhp', $no_lhp)
                        ->get()->row();
    }

    function get_detail_temuan($id_temuan) {
        return $this->db->select('*')
                        ->from('tb_temuan')
                        ->where('id_temuan', $id_temuan)
                        ->get()->row();
    }

    function get_detail_aspek($id_temuan) {
        return $this->db->select('*')
                        ->from('tb_temuan_aspek')
                        ->where('id_temuan', $id_temuan)
                        ->order_by('no_urut', 'asc')
                        ->get()->result();
    }

    function get_rekomendasi_by_id_rek($id_temuan_rekomendasi) {
        return $this->db->select('*')
                        ->from('tb_temuan_rekomendasi')
                        ->where('id_temuan_rekomendasi', $id_temuan_rekomendasi)
                        ->get()->row();
    }

    function get_detail_temuan_rekomendasi($id_temuan) {
        return $this->db->select('*')
                        ->from('tb_temuan_rekomendasi')
                        ->where('id_temuan', $id_temuan)
                        ->order_by('no_urut', 'asc')
                        ->get()->result();
    }

    function get_rekomendasi_upload($id_temuan_rekomendasi) {
        return $this->db->select('*')
                        ->from('tb_temuan_rekomendasi_upload')
                        ->where('id_temuan_rekomendasi', $id_temuan_rekomendasi)
                        ->get()->result();
    }

    function get_data_temuan() {
        return $this->db->select('*')
                ->from('tb_temuan')
                ->join('notifikasi', 'notifikasi.id_terkait = CONCAT("TEMUAN_", tb_temuan.id_temuan)')
                ->order_by('tgl_tbh', 'desc')
                ->get()->result();
    }

    function update_usulan_evlap($id_temuan) {
        $data = array(
            'status_usulan' => '1',
            'isi_usulan' => $this->input->post('isi_usulan'),
        );

        $this->db->where('id_temuan', $id_temuan)
                ->update('tb_temuan', $data);


        //--> tambah notifikasi
        $data_notif = array(
            'notif_adum'  => "baru",
            'notif_staff' => "baru",
        );
        $this->db->where('id_terkait', 'TEMUAN_' . $id_temuan)
                ->update('notifikasi', $data_notif);
    }

    function update_status_tl() {
        $data = array(
            'status_tl'     => $this->input->post('status_tl'),
            'status_nilai'  => $this->input->post('status_nilai'),
            'ket'           => $this->input->post('ket'),
            'tgl_status_tl' => date('Y-m-d H:i:s'),
        );

        $this->db->where('id_temuan_rekomendasi', $this->input->post('id_temuan_rekomendasi'))
                ->update('tb_temuan_rekomendasi', $data);
    }

    function get_tl_by_temuan($id_temuan) {
        return $this->db->select('*')
                        ->from('tb_tindak_lanjut')
                        ->where('id_temuan', $id_temuan)
                        ->get()->row();
    }

    function get_data_temuan_status_usulan_true() {
        return $this->db->select('*')
                        ->from('tb_temuan')
                        ->join('notifikasi', 'notifikasi.id_terkait = CONCAT("TEMUAN_", tb_temuan.id_temuan)')
                        ->where('status_usulan', '1')
                        ->order_by('tgl_tbh', 'desc')
                        ->get()->result();
    }

    function update_input_ketua_tl($id_temuan) {
        $data = array(
            'input_ketua_tl' => '1',
        );

        $this->db->where('id_temuan', $id_temuan)
                ->update('tb_temuan', $data);
    }

    // AKHIR TEMUAN
    // START TINDAK LANJUT
    //--> tambah tindak lanjut
    function insert_tl_staff($id_temuan) {
        /* $temuan = $this->db->get_where('tb_temuan', array('id_temuan' => $this->input->post('id_temuan')))->row(); */

        $id_tl = $this->input->post('id_tl');
        $id_tim = $this->input->post('id_tim');
        $no_surat = $this->input->post('no_surat');
        $id_temuan = $this->input->post('id_temuan');

        $inspektur = $this->db->get_where('tb_pegawai', array('jabatan' => 'Inspektur'))->row();

        //--> tambah tb_tindak_lanjut
        $data_tl = array(
            'id_tl' => $id_tl,
            'id_temuan' => $id_temuan,
            'tgl_tl' => $this->input->post('tgl_tl'),
            'id_tim' => $id_tim,
            'no_st' => $no_surat,
            'sasaran_peng' => $this->input->post('sasaran_peng'),
            'instansi_kec' => $this->input->post('kecamatan'),
            'kecamatan' => $this->input->post('kecamatan2'),
            'nama_inspektur' => $inspektur->nama,
            'nip_inspektur' => $inspektur->nip
        );

        $this->db->insert('tb_tindak_lanjut', $data_tl);

        //--> tambah tb_tim
        $data_tim = array(
            'id_tim' => $id_tim,
            'ketua_tim' => $this->input->post('ketua_tim'),
            'kategori_tim' => $this->input->post('kategori_tim')
        );

        $this->db->insert('tb_tim', $data_tim);

        ##################################################
        ## UPDATE STAT JABATAN TIM & HAK AKSES PENGGUNA ##
        ##################################################
        // Ketua Tim
        $data_ketua = array('jabatan_tim' => 'Ketua TL');
        $this->db->where('id_pegawai', $this->input->post('ketua_tim'))
                ->update('tb_pegawai', $data_ketua);

        $data_ketu2 = array('level' => 'ketua_tl');
        $this->db->where('id_fk', $this->input->post('ketua_tim'))
                ->update('tb_user', $data_ketu2);

        ##################################################

        $jum_agt = $this->input->post('jml_agt') - 1;
        $anggota = $this->input->post('anggota');
        $jum_ins = $this->input->post('jml_ins');
        $kon_sas = $this->input->post('kondisi_sasaran');

        if ($kon_sas == "pilih") {
            $sasaran = $this->input->post('sasaran');
        } else {
            $sasaran = NULL;
        }

        //--> cek kondisi jumlah anggota dan jumlah sasaran
        # digunakan untuk jumlah pengulangan insert anggota dan sasaran
        if ($jum_agt < $jum_ins) {
            $jml = $jum_ins;
        } elseif ($jum_agt > $jum_ins) {
            $jml = $jum_agt;
        } else {
            $jml = $jum_agt;
        }

        $i = 0;
        while ($i < $jml) {
            if (!empty($sasaran[$i])) {
                $sas = $sasaran[$i];
            }
            //--> tambah sub_tim
            $data_sub_tim = array(
                'sub_id_tim' => $id_tim,
                'nomor' => $i + 1,
                'anggota' => $anggota[$i],
                'sasaran' => $sas
            );
            $this->db->insert('sub_tim', $data_sub_tim);

            //--> update stat jabatan tim & hak akses pengguna
            $data_anggota = array('jabatan_tim' => 'Anggota TL');
            $this->db->where('id_pegawai', $anggota[$i])
                    ->update('tb_pegawai', $data_anggota);

            $data_anggota2 = array('level' => 'anggota_tl');
            $this->db->where('id_fk', $anggota[$i])
                    ->update('tb_user', $data_anggota2);

            $i++;
        }

        //--> tambah tb_surat
        $data_surat = array(
            'no_urut' => $this->input->post('no_urut'),
            'no_surat' => $no_surat,
            'tgl_surat' => $this->input->post('tgl_surat'),
            'dasar_surat' => $this->input->post('dasar_surat'),
            'fk_tim' => $id_tim,
            'untuk' => $this->input->post('perihal'),
            'tgl_awal' => $this->input->post('tgl_awal'),
            'tgl_akhir' => $this->input->post('tgl_akhir'),
            'stat_sasaran' => $kon_sas,
            'kategori_surat' => $this->input->post('kategori_tim')
        );

        $this->db->insert('tb_surat', $data_surat);

        $jum_tbs = $this->input->post('jml_tbs') - 1;
        $tembusan = $this->input->post('tembusan');

        $i = 0;
        while ($i < $jum_tbs) {
            //--> tambah sub_surat
            $data_sub_surat = array(
                'sub_no_surat' => $no_surat,
                'nomor' => $i + 1,
                'tembusan' => $tembusan[$i]
            );
            $this->db->insert('sub_surat', $data_sub_surat);

            $i++;
        }

        //--> tambah notifikasi
        $data_notif = array(
            'id_terkait' => $id_tl,
            'notif_adum' => "lama",
            'notif_sekretaris' => "lama"
        );

        $this->db->insert('notifikasi', $data_notif);
    }

    function update_temuan_ketua_tl() {

        /* Aspek SPI */
        $i_spi = $this->input->post('jml_temuan_spi');

        $judul_spi = $this->input->post('judul_spi');
        $nilai_spi = $this->input->post('nilai_spi');
        $nama_spi = $this->input->post('nama_spi');
        $kode_temuan_spi = $this->input->post('kode_temuan_spi');
        $nip_spi = $this->input->post('nip_spi');

        $i = 0;

        while ($i < $i_spi) {
            $data_aspek_spi = array(
                'id_temuan' => $last_id_temuan,
                'aspek' => 'spi',
                'no_urut' => $i + 1,
                'judul' => $judul_spi[$i],
                'nilai' => $nilai_spi[$i],
                'kode_temuan' => $kode_temuan_spi[$i],
                'nm_pejabat' => $nama_spi[$i],
                'nip' => $nip_spi[$i],
            );

            $this->db->insert('tb_temuan_aspek', $data_aspek_spi);

            $last_id_aspek_spi = $this->db->insert_id();
            $uraian_spi = $this->input->post('uraian_spi_' . $i . '');
            $nilai_spi = $this->input->post('nilai_spi_' . $i . '');
            $kode_rekomendasi_spi = $this->input->post('kode_rekomendasi_spi_' . $i . '');

            $ii = 0;

            while ($ii < count($uraian_spi)) {
                $data_rekomendasi_spi = array(
                    'id_temuan' => $last_id_temuan,
                    'id_temuan_aspek' => $last_id_aspek_spi,
                    'aspek' => 'spi',
                    'no_urut' => $ii + 1,
                    'uraian' => $uraian_spi[$ii],
                    'kode_rekomendasi' => $kode_rekomendasi_spi[$ii],
                    'nilai' => $nilai_spi[$ii],
                );

                $this->db->insert('tb_temuan_rekomendasi', $data_rekomendasi_spi);
                $ii++;
            }
            $i++;
        }


        /* Aspek 3E */
        $i_e3 = $this->input->post('jml_temuan_e3');

        $judul_e3 = $this->input->post('judul_e3');
        $nilai_e3 = $this->input->post('nilai_e3');
        $nama_e3 = $this->input->post('nama_e3');
        $kode_temuan_e3 = $this->input->post('kode_temuan_e3');
        $nip_e3 = $this->input->post('nip_e3');

        $i = 0;

        while ($i < $i_e3) {
            $data_aspek_e3 = array(
                'id_temuan' => $last_id_temuan,
                'aspek' => 'e3',
                'no_urut' => $i + 1,
                'judul' => $judul_e3[$i],
                'nilai' => $nilai_e3[$i],
                'kode_temuan' => $kode_temuan_e3[$i],
                'nm_pejabat' => $nama_e3[$i],
                'nip' => $nip_e3[$i],
            );

            $this->db->insert('tb_temuan_aspek', $data_aspek_e3);

            $last_id_aspek_e3 = $this->db->insert_id();
            $uraian_e3 = $this->input->post('uraian_e3_' . $i . '');
            $nilai_e3 = $this->input->post('nilai_e3_' . $i . '');
            $kode_rekomendasi_e3 = $this->input->post('kode_rekomendasi_e3_' . $i . '');

            $ii = 0;

            while ($ii < count($uraian_e3)) {
                $data_rekomendasi_e3 = array(
                    'id_temuan' => $last_id_temuan,
                    'id_temuan_aspek' => $last_id_aspek_e3,
                    'aspek' => 'e3',
                    'no_urut' => $ii + 1,
                    'uraian' => $uraian_e3[$ii],
                    'kode_rekomendasi' => $kode_rekomendasi_e3[$ii],
                    'nilai' => $nilai_e3[$ii],
                );

                $this->db->insert('tb_temuan_rekomendasi', $data_rekomendasi_e3);
                $ii++;
            }
            $i++;
        }

        /* Aspek Kepatuhan */
        $i_kepatuhan = $this->input->post('jml_temuan_kepatuhan');

        $judul_kepatuhan = $this->input->post('judul_kepatuhan');
        $nilai_kepatuhan = $this->input->post('nilai_kepatuhan');
        $nama_kepatuhan = $this->input->post('nama_kepatuhan');
        $kode_temuan_kepatuhan = $this->input->post('kode_temuan_kepatuhan');
        $nip_kepatuhan = $this->input->post('nip_kepatuhan');

        $i = 0;

        while ($i < $i_kepatuhan) {
            $data_aspek_kepatuhan = array(
                'id_temuan' => $last_id_temuan,
                'aspek' => 'kepatuhan',
                'no_urut' => $i + 1,
                'judul' => $judul_kepatuhan[$i],
                'nilai' => $nilai_kepatuhan[$i],
                'kode_temuan' => $kode_temuan_kepatuhan[$i],
                'nm_pejabat' => $nama_kepatuhan[$i],
                'nip' => $nip_kepatuhan[$i],
            );

            $this->db->insert('tb_temuan_aspek', $data_aspek_kepatuhan);

            $last_id_aspek_kepatuhan = $this->db->insert_id();
            $uraian_kepatuhan = $this->input->post('uraian_kepatuhan_' . $i . '');
            $nilai_kepatuhan = $this->input->post('nilai_kepatuhan_' . $i . '');
            $kode_rekomendasi_kepatuhan = $this->input->post('kode_rekomendasi_kepatuhan_' . $i . '');

            $ii = 0;

            while ($ii < count($uraian_kepatuhan)) {
                $data_rekomendasi_kepatuhan = array(
                    'id_temuan' => $last_id_temuan,
                    'id_temuan_aspek' => $last_id_aspek_kepatuhan,
                    'aspek' => 'kepatuhan',
                    'no_urut' => $ii + 1,
                    'uraian' => $uraian_kepatuhan[$ii],
                    'kode_rekomendasi' => $kode_rekomendasi_kepatuhan[$ii],
                    'nilai' => $nilai_kepatuhan[$ii],
                );

                $this->db->insert('tb_temuan_rekomendasi', $data_rekomendasi_kepatuhan);
                $ii++;
            }
            $i++;
        }
    }

    function get_count_kode_temuan($id_temuan, $kode_temuan) {
        return $this->db->select('count(*) as jml')
                        ->from('tb_temuan_aspek')
                        ->where('id_temuan', $id_temuan)
                        ->where('kode_temuan', $kode_temuan)
                        ->get()->row();
    }

    function get_count_kode_temuan_2($kode_temuan) {
        return $this->db->select('count(*) as jml')
                        ->from('tb_temuan_aspek')
                        ->where('kode_temuan', $kode_temuan)
                        ->get()->row();
    }

    function get_count_kode_temuan_jml($id_temuan) {
        return $this->db->select('count(*) as jml')
                        ->from('tb_temuan_aspek')
                        ->where('id_temuan', $id_temuan)
                        ->get()->row();
    }

    function get_count_kode_temuan_jml_2() {
        return $this->db->select('count(*) as jml')
                        ->from('tb_temuan_aspek')
                        ->get()->row();
    }

    function get_count_aspek($id_temuan, $aspek) {
        return $this->db->select('count(*) as jml')
                        ->from('tb_temuan_aspek')
                        ->where('id_temuan', $id_temuan)
                        ->where('aspek', $aspek)
                        ->get()->row();
    }

    function get_count_aspek_2($aspek) {
        return $this->db->select('count(*) as jml')
                        ->from('tb_temuan_aspek')
                        ->where('aspek', $aspek)
                        ->get()->row();
    }

    function get_count_kategori_lhp($kategori_lhp) {
        return $this->db->select('count(*) as jml')
                        ->from('tb_temuan')
                        ->where('kategori_lhp', $kategori_lhp)
                        ->get()->row();
    }

    function get_count_status_tl($id_temuan, $status_tl) {
        return $this->db->select('count(*) as jml')
                        ->from('tb_temuan_rekomendasi')
                        ->where('id_temuan', $id_temuan)
                        ->where('status_tl', $status_tl)
                        ->get()->row();
    }

    function get_count_status_tl_2($status_tl) {
        return $this->db->select('count(*) as jml')
                        ->from('tb_temuan_rekomendasi')
                        ->where('status_tl', $status_tl)
                        ->get()->row();
    }

    // UNTUK API
    function get_data_temuan_api($id_temuan_aspek = null) {
        if ($id_temuan_aspek === null ) {
        return $this->db->select('*')
                        ->from('tb_temuan_aspek')
                        ->join('tb_temuan_rekomendasi', 'tb_temuan_rekomendasi.id_temuan = tb_temuan_aspek.id_temuan')
                        ->order_by('id_temuan_rekomendasi', 'asc')
                        ->get()->result_array();   
        } else { 
        return $this->db->get_where('tb_temuan_aspek', ['id_temuan_aspek' => $id_temuan_aspek])->result_array();
        }
       
    }

}
