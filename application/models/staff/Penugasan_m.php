<?php

class Penugasan_m extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    //--> Mengecek id terakhir tb_penugasan
    function get_id_max_tugas() {
        /* $kode 	= "TGS";
          $sql  	= "SELECT max(id_tugas) as max_id FROM tb_penugasan";
          $row  	= $this->db->query($sql)->row();
          $max_id = $row->max_id;
          $max_no = substr($max_id,3);
          $new_no = $max_no + 5;
          $id 	= $kode.$new_no;
          return $id; */

        return "TGS_" . date("dmYHis") . "_" . round(microtime(true) * 1000);
    }

    //--> Mengecek max reviu tgs
    function cek_rev_tgs($id_tugas) {
        $sql = "SELECT max(rev_ke) as no_rev FROM rev_penugasan1 WHERE rev_tugas1 = '$id_tugas'";
        $row = $this->db->query($sql)->row();
        $max_no = $row->no_rev + 1;
        return $max_no;
    }

    function cek_reviu($id_tugas) {
        return $this->db->query("SELECT * FROM rev_penugasan1 WHERE rev_tugas1 = '$id_tugas'")->num_rows();
    }

    //--> ambil nomor urut
    function get_no_urut() {
        return $this->db->select_max('no_urut')
                        ->from('tb_penugasan')
                        ->get()->row();
    }

    //--> ambil semua data penugasan
    function get_all_tugas() {
        return $this->db->select('*')
                        ->from('tb_penugasan')
                        ->join('notifikasi', 'notifikasi.id_terkait = tb_penugasan.id_tugas')
                        ->join('tb_tim', 'tb_tim.id_tim = tb_penugasan.id_tim')
                        ->join('tb_pegawai', 'tb_pegawai.id_pegawai = tb_tim.daltu')
                        ->order_by('tgl_penugasan', 'desc')
                        ->get()->result();
    }

    function get_tugas_inspektorat() {
        return $this->db->select('*')
                        ->from('tb_penugasan')
                        ->join('notifikasi', 'notifikasi.id_terkait = tb_penugasan.id_tugas')
                        ->join('tb_tim', 'tb_tim.id_tim = tb_penugasan.id_tim')
                        ->join('tb_pegawai', 'tb_pegawai.id_pegawai = tb_tim.daltu')
                        ->where('persetujuan', 'selesai')
                        ->order_by('tgl_penugasan', 'desc')
                        ->get()->result();
    }

    //--> ambil data penugasan ketua tim tertentu
    function get_tugas_kt($ketua_tim) {
        return $this->db->select('*')
                        ->from('tb_penugasan')
                        ->join('notifikasi', 'notifikasi.id_terkait = tb_penugasan.id_tugas')
                        ->join('tb_tim', 'tb_tim.id_tim = tb_penugasan.id_tim')
                        ->join('tb_pegawai', 'tb_pegawai.id_pegawai = tb_tim.daltu')
                        ->where('ketua_tim', $ketua_tim)
                        ->where('tgl_persetujuan !=', NULL)
                        ->order_by('tgl_penugasan', 'desc')
                        ->get()->result();
    }

    //--> ambil data penugasan dalnis tertentu
    function get_tugas_dn($dalnis) {
        return $this->db->select('*')
                        ->from('tb_penugasan')
                        ->join('notifikasi', 'notifikasi.id_terkait = tb_penugasan.id_tugas')
                        ->join('tb_tim', 'tb_tim.id_tim = tb_penugasan.id_tim')
                        ->where('dalnis', $dalnis)
                        ->where('persetujuan !=', NULL)
                        ->order_by('tgl_penugasan', 'desc')
                        ->get()->result();
    }

    //--> ambil data penugasan daltu tertentu
    function get_tugas_dt($daltu) {
        return $this->db->select('*')
                        ->from('tb_penugasan')
                        ->join('notifikasi', 'notifikasi.id_terkait = tb_penugasan.id_tugas')
                        ->join('tb_tim', 'tb_tim.id_tim = tb_penugasan.id_tim')
                        ->where('daltu', $daltu)
                        ->where('persetujuan !=', NULL)
                        ->order_by('tgl_penugasan', 'desc')
                        ->get()->result();
    }

    //--> ambil data penugasan
    function get_row_penugasan($id_tugas) {
        return $this->db->select('*')
            ->from('tb_penugasan')
            ->join('tb_tim', 'tb_tim.id_tim = tb_penugasan.id_tim')
            ->join('tb_surat', 'tb_surat.no_surat = tb_penugasan.no_st')
            ->join('notifikasi', 'notifikasi.id_terkait = tb_penugasan.id_tugas')
            ->where('id_tugas', $id_tugas)
            ->get()->row();
    }

    //--> ambil semua data reviu penugasan
    function get_rev_penugasan($id_tugas) {
        return $this->db->select('*')
                        ->from('rev_penugasan1')
                        ->where('rev_tugas1', $id_tugas)
                        ->order_by('rev_tgl_penugasan', 'desc')
                        ->get()->result();
    }

    //--> tambah penugasan
    function insert_penugasan() {
        $id_tim = $this->input->post('id_tim');
        $id_tgs = $this->input->post('id_penugasan');
        $no_surat = $this->input->post('no_surat');

        $inspektur = $this->db->get_where('tb_pegawai', array('jabatan' => 'Inspektur'))->row();

        if ($this->input->post('alamat_kantor') == "") {
            $alamat = "-";
        } else {
            $alamat = $this->input->post('alamat_kantor');
        }

        if ($this->input->post('no_tlp') == "") {
            $no_tlp = "-";
        } else {
            $no_tlp = $this->input->post('no_tlp');
        }

        if ($this->input->post('tujuan_lap') == "") {
            $lap = "-";
        } else {
            $lap = $this->input->post('tujuan_lap');
        }

        if ($this->input->post('kondisi_sasaran') == "pilih") {
            $kec = $this->input->post('kecamatan');
            $kec2 = "-";
        } else {
            $kec = "-";
            $kec2 = $this->input->post('kecamatan2');
        }

        //--> tambah tb_penugasan
        $data_penugasan = array(
            'id_tugas' => $id_tgs,
            'tgl_penugasan' => $this->input->post('tgl_tgs'),
            'no_urut' => $this->input->post('no_urut'),
            'no_kp' => $this->input->post('no_kp'),
            'no_rp' => $this->input->post('no_rp'),
            'nama_kp' => $this->input->post('nama_kp'),
            'nama_op' => $this->input->post('nama_op'),
            'alamat_kantor' => $alamat,
            'no_tlp' => $no_tlp,
            'program_peng' => $this->input->post('program_peng'),
            'sasaran_peng' => $this->input->post('sasaran_peng'),
            'instansi_kec' => $kec,
            'kecamatan' => $kec2,
            'tujuan_peng' => $this->input->post('tujuan_peng'),
            'tujuan_laporan' => $lap,
            'id_tim' => $id_tim,
            'no_st' => $no_surat,
            'nama_inspektur' => $inspektur->nama,
            'nip_inspektur' => $inspektur->nip
        );
        $this->db->insert('tb_penugasan', $data_penugasan);

        //--> tambah tb_tim
        $data_tim = array(
            'id_tim' => $id_tim,
            'daltu' => $this->input->post('daltu'),
            'dalnis' => $this->input->post('dalnis'),
            'ketua_tim' => $this->input->post('ketua_tim'),
            'kategori_tim' => $this->input->post('kategori_tim')
        );
        $this->db->insert('tb_tim', $data_tim);

        ##################################################
        ## UPDATE STAT JABATAN TIM & HAK AKSES PENGGUNA ##
        ##################################################
        // Daltu (Pengendali Mutu/DALTU)
        $data_daltu = array('jabatan_tim' => 'Pengendali Mutu');
        $this->db->where('id_pegawai', $this->input->post('daltu'))
                ->update('tb_pegawai', $data_daltu);

        $data_daltu2 = array('level' => 'daltu');
        $this->db->where('id_fk', $this->input->post('daltu'))
                ->update('tb_user', $data_daltu2);

        // Dalnis (Pengendali Teknis)
        $data_dalnis = array('jabatan_tim' => 'Pengendali Teknis');
        $this->db->where('id_pegawai', $this->input->post('dalnis'))
                ->update('tb_pegawai', $data_dalnis);

        $data_dalnis2 = array('level' => 'dalnis');
        $this->db->where('id_fk', $this->input->post('dalnis'))
                ->update('tb_user', $data_dalnis2);

        // Ketua Tim
        $data_ketu = array('jabatan_tim' => 'Ketua Tim');
        $this->db->where('id_pegawai', $this->input->post('ketua_tim'))
                ->update('tb_pegawai', $data_ketu);

        $data_ketu2 = array('level' => 'ketua_tim');
        $this->db->where('id_fk', $this->input->post('ketua_tim'))
                ->update('tb_user', $data_ketu2);

        ##################################################

        $jum_agt = $this->input->post('jml_agt') - 1;
        $anggota = $this->input->post('anggota');
        $jum_ins = $this->input->post('jml_ins') - 1;
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
            //--> tambah sub_tim
            $data_sub_tim = array(
                'sub_id_tim' => $id_tim,
                'nomor' => $i + 1,
                'anggota' => $anggota[$i],
                'sasaran' => $sasaran[$i]
            );

            $this->db->insert('sub_tim', $data_sub_tim);

            //--> update stat jabatan tim & hak akses pengguna
            $data_anggota = array('jabatan_tim' => 'Anggota Tim');
            $this->db->where('id_pegawai', $anggota[$i])
                    ->update('tb_pegawai', $data_anggota);

            $data_anggota2 = array('level' => 'anggota_tim');
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
            'id_terkait' => $id_tgs,
            'notif_adum' => "baru",
            'notif_sekretaris' => "baru"
        );
        $this->db->insert('notifikasi', $data_notif);

        ########## SMS GATEWAY ##########
        $sms = $this->db->get_where('set_sms', array('id' => '1'))->row();
        $sms_ad = $this->db->get_where('tb_pegawai', array('jabatan_tim' => 'ADUM'))->row();
        $sms_sk = $this->db->get_where('tb_pegawai', array('jabatan_tim' => 'Sekretaris'))->row();
        $pesan = "PEMBERITAHUAN! terdapat Pemeriksaan baru dengan NO. SURAT : $no_surat yang harus di reviu. Silahkan buka http://sipiko.pariamankota.go.id/index.php/log_in";

        //--> sms adum
        $array_sms1 = array(
            "id" => $no_surat,
            "waktu" => date("d-m-Y H:i:s"),
            "nomor" => $sms_ad->no_tlp,
            "pesan" => $pesan,
            "email" => $sms->email,
            "status" => "new"
        );
        $this->smsgateway->outbox($sms->base_url . $sms->base_path . '/data_outbox.json', $array_sms1);

        //--> sms sekretaris
        $array_sms2 = array(
            "id" => $no_surat,
            "waktu" => date("d-m-Y H:i:s"),
            "nomor" => $sms_sk->no_tlp,
            "pesan" => $pesan,
            "email" => $sms->email,
            "status" => "new"
        );
        $this->smsgateway->outbox($sms->base_url . $sms->base_path . '/data_outbox.json', $array_sms2);
        ########## /.SMS GATEWAY ##########
    }

    //--> reviu penugasan
    function reviu_penugasan() {
        $id_tgs = $this->input->post('id_penugasan');
        $id_tim = $this->input->post('id_tim');
        $no_surat = $this->input->post('no_surat');
        $no_rev = $this->input->post('no_rev');

        $get = $this->db->select('*')
                        ->from('tb_penugasan')
                        ->join('tb_tim', 'tb_tim.id_tim=tb_penugasan.id_tim')
                        ->join('tb_surat', 'tb_surat.no_surat=tb_penugasan.no_st')
                        ->where('id_tugas', $id_tgs)
                        ->get()->row();

        //--> tambah tabel rev_penugasan1
        $data_rev_penugasan1 = array(
            'rev_tugas1' => $get->id_tugas,
            'rev_tgl_penugasan' => date('Y-m-d H:i:s'),
            'rev_ke' => $no_rev,
            'rev_no_kp' => $get->no_kp,
            'rev_no_rp' => $get->no_rp,
            'rev_nama_kp' => $get->nama_kp,
            'rev_nama_op' => $get->nama_op,
            'rev_alamat_kantor' => $get->alamat_kantor,
            'rev_no_tlp' => $get->no_tlp,
            'rev_program_peng' => $get->program_peng,
            'rev_sasaran_peng' => $get->sasaran_peng,
            'rev_instansi_kec' => $get->instansi_kec,
            'rev_kecamatan' => $get->kecamatan,
            'rev_tujuan_peng' => $get->tujuan_peng,
            'rev_tujuan_laporan' => $get->tujuan_laporan,
            'rev_nama_inspektur' => $get->nama_inspektur,
            'rev_nip_inspektur' => $get->nip_inspektur,
            'rev_tgl_adum' => $get->tgl_rev_adum,
            'rev_adum' => $get->reviu_adum,
            'rev_tgl_sekretaris' => $get->tgl_rev_sekretaris,
            'rev_sekretaris' => $get->reviu_sekretaris,
            'rev_id_tim' => $get->id_tim,
            'rev_daltu' => $get->daltu,
            'rev_dalnis' => $get->dalnis,
            'rev_ketua_tim' => $get->ketua_tim,
            'rev_no_st' => $get->no_st,
            'rev_dasar_surat' => $get->dasar_surat,
            'rev_tgl_awal' => $get->tgl_awal,
            'rev_tgl_akhir' => $get->tgl_akhir
        );
        $this->db->insert('rev_penugasan1', $data_rev_penugasan1);

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

        if ($this->input->post('alamat_kantor') == "") {
            $alamat = "-";
        } else {
            $alamat = $this->input->post('alamat_kantor');
        }

        if ($this->input->post('no_tlp') == "") {
            $no_tlp = "-";
        } else {
            $no_tlp = $this->input->post('no_tlp');
        }

        if ($this->input->post('tujuan_lap') == "") {
            $lap = "-";
        } else {
            $lap = $this->input->post('tujuan_lap');
        }

        if ($this->input->post('kondisi_sasaran') == "pilih") {
            $kec = $this->input->post('kecamatan');
            $kec2 = "-";
        } else {
            $kec = "-";
            $kec2 = $this->input->post('kecamatan2');
        }

        if ($get->reviu_adum == "-") {
            $tgl_adum = $get->tgl_rev_adum;
            $rev_adum = $get->reviu_adum;
            $notif_adum = "lama";
        } else {
            $tgl_adum = NULL;
            $rev_adum = NULL;
            $notif_adum = "baru";

            ########## SMS GATEWAY ##########
            $sms = $this->db->get_where('set_sms', array('id' => '1'))->row();
            $sms_ad = $this->db->get_where('tb_pegawai', array('jabatan_tim' => 'ADUM'))->row();
            $pesan = "PEMBERITAHUAN REVIU! Pemeriksaan dengan NO. SURAT : $no_surat telah direviu. Silahkan buka http://sipiko.pariamankota.go.id/index.php/log_in";

            //--> sms adum
            $array_sms1 = array(
                "id" => $no_surat,
                "waktu" => date("d-m-Y H:i:s"),
                "nomor" => $sms_ad->no_tlp,
                "pesan" => $pesan,
                "email" => $sms->email,
                "status" => "new"
            );
            $this->smsgateway->outbox($sms->base_url . $sms->base_path . '/data_outbox.json', $array_sms1);
            ########## /.SMS GATEWAY ##########
        }

        if ($get->reviu_sekretaris == "-") {
            $tgl_sekretaris = $get->tgl_rev_sekretaris;
            $rev_sekretaris = $get->reviu_sekretaris;
            $notif_sekretaris = "lama";
        } else {
            $tgl_sekretaris = NULL;
            $rev_sekretaris = NULL;
            $notif_sekretaris = "baru";

            ########## SMS GATEWAY ##########
            $sms = $this->db->get_where('set_sms', array('id' => '1'))->row();
            $sms_sk = $this->db->get_where('tb_pegawai', array('jabatan_tim' => 'Sekretaris'))->row();
            $pesan = "PEMBERITAHUAN REVIU! Pemeriksaan dengan NO. SURAT : $no_surat telah  direviu. Silahkan buka http://sipiko.pariamankota.go.id/index.php/log_in";

            //--> sms adum
            $array_sms1 = array(
                "id" => $no_surat,
                "waktu" => date("d-m-Y H:i:s"),
                "nomor" => $sms_sk->no_tlp,
                "pesan" => $pesan,
                "email" => $sms->email,
                "status" => "new"
            );
            $this->smsgateway->outbox($sms->base_url . $sms->base_path . '/data_outbox.json', $array_sms1);
            ########## /.SMS GATEWAY ##########
        }

        //--> ubah tb_penugasan
        $data_penugasan = array(
            'nama_kp' => $this->input->post('nama_kp'),
            'nama_op' => $this->input->post('nama_op'),
            'alamat_kantor' => $alamat,
            'no_tlp' => $no_tlp,
            'program_peng' => $this->input->post('program_peng'),
            'sasaran_peng' => $this->input->post('sasaran_peng'),
            'instansi_kec' => $kec,
            'kecamatan' => $kec2,
            'tujuan_peng' => $this->input->post('tujuan_peng'),
            'tujuan_laporan' => $lap,
            'tgl_rev_adum' => $tgl_adum,
            'reviu_adum' => $rev_adum,
            'tgl_rev_sekretaris' => $tgl_sekretaris,
            'reviu_sekretaris' => $rev_sekretaris,
            'persetujuan' => 'proses'
        );
        $this->db->where('id_tugas', $id_tgs)
                ->update('tb_penugasan', $data_penugasan);

        //--> tambah tb_tim
        $data_tim = array(
            'daltu' => $this->input->post('daltu'),
            'dalnis' => $this->input->post('dalnis'),
            'ketua_tim' => $this->input->post('ketua_tim')
        );
        $this->db->where('id_tim', $id_tim)
                ->update('tb_tim', $data_tim);

        $jum_agt = $this->input->post('jml_agt') - 1;
        $anggota = $this->input->post('anggota');
        $jum_ins = $this->input->post('jml_ins') - 1;
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
            //--> tambah sub_tim
            $data_sub_tim = array(
                'sub_id_tim' => $id_tim,
                'nomor' => $i + 1,
                'anggota' => $anggota[$i],
                'sasaran' => $sasaran[$i]
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
        $this->db->where('id_terkait', $id_tgs)
                ->update('notifikasi', $data_notif);
    }

    //--> persetujuan ADUM
    function persetujuan_adum($id_tugas) {
        $cek = $this->db->get_where('tb_penugasan', array('id_tugas' => $id_tugas))->row();

        if ($this->input->post('reviu') == 'setujui') {
            $catatan = "-";
        } else {
            $catatan = $this->input->post('catatan');
        }

        if ($catatan == "-" && $cek->reviu_sekretaris == '-') {
            $keputusan = "selesai";
            $notif_staff = NULL;
            $notif_inspektur = "baru";

            ########## SMS GATEWAY ##########
            $sms = $this->db->get_where('set_sms', array('id' => '1'))->row();
            $sms_is = $this->db->get_where('tb_pegawai', array('jabatan' => 'Inspektur'))->row();
            $pesan = "PEMBERITAHUAN! terdapat Surat Tugas dengan NO. SURAT : $cek->no_st yang harus di tandatangani. Silahkan buka http://sipiko.pariamankota.go.id/index.php/log_in";

            //--> sms adum
            $array_sms1 = array(
                "id" => $cek->no_st,
                "waktu" => date("d-m-Y H:i:s"),
                "nomor" => $sms_is->no_tlp,
                "pesan" => $pesan,
                "email" => $sms->email,
                "status" => "new"
            );
            $this->smsgateway->outbox($sms->base_url . $sms->base_path . '/data_outbox.json', $array_sms1);
            ########## /.SMS GATEWAY ##########
        } elseif ($catatan == "-" && $cek->reviu_sekretaris == NULL) {
            $keputusan = "Proses";
            $notif_staff = NULL;
            $notif_inspektur = NULL;
        } else {
            $keputusan = "reviu";
            $notif_staff = "baru";
            $notif_inspektur = NULL;
        }

        //--> ubah tb_penugasan
        $data_penugasan = array(
            'tgl_rev_adum' => date('Y-m-d H:i:s'),
            'reviu_adum' => $catatan,
            'persetujuan' => $keputusan
        );
        $this->db->where('id_tugas', $id_tugas)
                ->update('tb_penugasan', $data_penugasan);

        //--> ubah notifikasi
        $data_notif = array(
            'notif_staff' => $notif_staff,
            'notif_inspektur' => $notif_inspektur
        );
        $this->db->where('id_terkait', $id_tugas)
                ->update('notifikasi', $data_notif);
    }

    //--> persetujuan ADUM
    function persetujuan_sekretaris($id_tugas) {
        $cek = $this->db->get_where('tb_penugasan', array('id_tugas' => $id_tugas))->row();

        if ($this->input->post('reviu') == 'setujui') {
            $catatan = "-";
        } else {
            $catatan = $this->input->post('catatan');
        }

        if ($catatan == "-" && $cek->reviu_adum == '-') {
            $keputusan = "selesai";
            $notif_staff = NULL;
            $notif_inspektur = "baru";

            ########## SMS GATEWAY ##########
            $sms = $this->db->get_where('set_sms', array('id' => '1'))->row();
            $sms_is = $this->db->get_where('tb_pegawai', array('jabatan' => 'Inspektur'))->row();
            $pesan = "PEMBERITAHUAN! terdapat Surat Tugas dengan NO. SURAT : $cek->no_st yang harus di tandatangani. Silahkan buka http://sipiko.pariamankota.go.id/index.php/log_in";

            //--> sms adum
            $array_sms1 = array(
                "id" => $cek->no_st,
                "waktu" => date("d-m-Y H:i:s"),
                "nomor" => $sms_is->no_tlp,
                "pesan" => $pesan,
                "email" => $sms->email,
                "status" => "new"
            );
            $this->smsgateway->outbox($sms->base_url . $sms->base_path . '/data_outbox.json', $array_sms1);
            ########## /.SMS GATEWAY ##########
        } elseif ($catatan == "-" && $cek->reviu_adum == NULL) {
            $keputusan = "Proses";
            $notif_staff = NULL;
            $notif_inspektur = NULL;
        } else {
            $keputusan = "reviu";
            $notif_staff = "baru";
            $notif_inspektur = NULL;
        }

        //--> ubah tb_penugasan
        $data_penugasan = array(
            'tgl_rev_sekretaris' => date('Y-m-d H:i:s'),
            'reviu_sekretaris' => $catatan,
            'persetujuan' => $keputusan
        );
        $this->db->where('id_tugas', $id_tugas)
                ->update('tb_penugasan', $data_penugasan);

        //--> ubah notifikasi
        $data_notif = array(
            'notif_staff' => $notif_staff,
            'notif_inspektur' => $notif_inspektur
        );
        $this->db->where('id_terkait', $id_tugas)
                ->update('notifikasi', $data_notif);
    }

    function verifikasi_digital($filename, $id_tugas) {
        $fNam = $filename . ".png";
        $data = array(
            'tgl_persetujuan' => date('Y-m-d H:i:s'),
            'ttd' => $fNam
        );
        $this->db->where('id_tugas', $id_tugas)
                ->update('tb_penugasan', $data);

        //--> ubah notifikasi
        $data_notif = array(
            'notif_staff' => "baru",
            'notif_ketua_tim' => "baru"
        );
        $this->db->where('id_terkait', $id_tugas)
                ->update('notifikasi', $data_notif);

        ########## SMS GATEWAY ##########
        $sms = $this->db->get_where('set_sms', array('id' => '1'))->row();
        $sms_st = $this->db->get_where('tb_pegawai', array('jabatan_tim' => 'STAFF'))->row();
        $tugas = $this->get_row_penugasan($id_tugas);
        $sms_kt = $this->db->get_where('tb_pegawai', array('id_pegawai' => $tugas->ketua_tim))->row();

        $pesan1 = "PEMBERITAHUAN! terdapat Surat Tugas dengan NO. SURAT : $tugas->no_st yang harus di cetak. Silahkan buka http://sipiko.pariamankota.go.id/index.php/log_in";

        $pesan2 = "PEMBERITAHUAN! terdapat Pemeriksaan baru dengan NO. SURAT : $tugas->no_st yang harus dilaksanakan. Silahkan buka http://sipiko.pariamankota.go.id/index.php/log_in";

        //--> sms staff
        $array_sms1 = array(
            "id" => $tugas->no_st,
            "waktu" => date("d-m-Y H:i:s"),
            "nomor" => $sms_st->no_tlp,
            "pesan" => $pesan1,
            "email" => $sms->email,
            "status" => "new"
        );
        $this->smsgateway->outbox($sms->base_url . $sms->base_path . '/data_outbox.json', $array_sms1);

        //--> sms staff
        $array_sms2 = array(
            "id" => $tugas->no_st,
            "waktu" => date("d-m-Y H:i:s"),
            "nomor" => $sms_kt->no_tlp,
            "pesan" => $pesan2,
            "email" => $sms->email,
            "status" => "new"
        );
        $this->smsgateway->outbox($sms->base_url . $sms->base_path . '/data_outbox.json', $array_sms2);
        ########## /.SMS GATEWAY ##########
    }

    function verifikasi_manual($id_tugas) {
        $data = array(
            'tgl_persetujuan' => date('Y-m-d H:i:s')
        );
        $this->db->where('id_tugas', $id_tugas)
                ->update('tb_penugasan', $data);

        //--> ubah notifikasi
        $data_notif = array(
            'notif_staff' => "baru",
            'notif_ketua_tim' => "baru"
        );
        $this->db->where('id_terkait', $id_tugas)
                ->update('notifikasi', $data_notif);

        ########## SMS GATEWAY ##########
        $sms = $this->db->get_where('set_sms', array('id' => '1'))->row();
        $sms_st = $this->db->get_where('tb_pegawai', array('jabatan_tim' => 'STAFF'))->row();
        $tugas = $this->get_row_penugasan($id_tugas);
        $sms_kt = $this->db->get_where('tb_pegawai', array('id_pegawai' => $tugas->ketua_tim))->row();

        $pesan1 = "PEMBERITAHUAN! terdapat Surat Tugas dengan NO. SURAT : $tugas->no_st yang harus di cetak. Silahkan buka http://sipiko.pariamankota.go.id/index.php/log_in";

        $pesan2 = "PEMBERITAHUAN! terdapat Pemeriksaan baru dengan NO. SURAT : $tugas->no_st yang harus dilaksanakan. Silahkan buka http://sipiko.pariamankota.go.id/index.php/log_in";

        //--> sms staff
        $array_sms1 = array(
            "id" => $tugas->no_st,
            "waktu" => date("d-m-Y H:i:s"),
            "nomor" => $sms_st->no_tlp,
            "pesan" => $pesan1,
            "email" => $sms->email,
            "status" => "new"
        );
        $this->smsgateway->outbox($sms->base_url . $sms->base_path . '/data_outbox.json', $array_sms1);

        //--> sms staff
        $array_sms2 = array(
            "id" => $tugas->no_st,
            "waktu" => date("d-m-Y H:i:s"),
            "nomor" => $sms_kt->no_tlp,
            "pesan" => $pesan2,
            "email" => $sms->email,
            "status" => "new"
        );
        $this->smsgateway->outbox($sms->base_url . $sms->base_path . '/data_outbox.json', $array_sms2);
        ########## /.SMS GATEWAY ##########
    }

}
