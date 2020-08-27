<?php

class P2hp_lhp_m extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    //--> Mengecek max reviu kka ikhtisar
    function cek_rev_p2hp($id_p2hp) {
        $sql = "SELECT max(rev_ke) as no_rev FROM rev_p2hp WHERE rev_p2hp='$id_p2hp'";
        $row = $this->db->query($sql)->row();
        $max_no = $row->no_rev + 1;
        return $max_no;
    }

    function cek_reviu_p2hp($id_p2hp) {
        return $this->db->query("SELECT * FROM rev_p2hp WHERE rev_p2hp = '$id_p2hp'")->num_rows();
    }

    //--> ambil data pka di tb_pka sesuai tugas untuk ketua tim tertentu
    function get_rev_p2hp($id_p2hp) {
        return $this->db->select('*')
                        ->from('rev_p2hp')
                        ->where('rev_p2hp', $id_p2hp)
                        ->order_by('rev_ke', 'asc')
                        ->get()->result();
    }

    //--> ambil data pka di tb_pka sesuai tugas untuk ketua tim tertentu
    function get_p2hp_lhp($ketua_tim) {
        return $this->db->select('*')
                        ->from('tb_p2hp')
                        //->join('tb_lhp', 'tb_lhp.fk_p2hp = tb_p2hp.id_p2hp')
                        ->join('tb_penugasan', 'tb_penugasan.id_tugas = tb_p2hp.fk_tgs')
                        ->join('tb_tim', 'tb_tim.id_tim = tb_penugasan.id_tim')
                        ->where('ketua_tim', $ketua_tim)
                        //->order_by('fk_pka', 'desc')
                        ->get()->result();
    }

    //--> ambil data pka di tb_pka sesuai tugas untuk ketua tim tertentu
    function get_p2hp_dn($dalnis) {
        return $this->db->select('*')
                        ->from('tb_p2hp')
                        //->join('tb_pka', 'tb_pka.id_pka = tb_p2hp.id_pka')
                        ->join('tb_penugasan', 'tb_penugasan.id_tugas = tb_p2hp.fk_tgs')
                        ->join('tb_tim', 'tb_tim.id_tim = tb_penugasan.id_tim')
                        ->where('dalnis', $dalnis)
                        //->order_by('id_p2hp', 'desc')
                        ->get()->result();
    }

    //--> ambil data pka di tb_pka sesuai tugas untuk ketua tim tertentu
    function get_p2hp_dt($daltu) {
        return $this->db->select('*')
                        ->from('tb_p2hp')
                        //->join('tb_pka', 'tb_pka.id_pka = tb_p2hp.id_pka')
                        ->join('tb_penugasan', 'tb_penugasan.id_tugas = tb_p2hp.fk_tgs')
                        ->join('tb_tim', 'tb_tim.id_tim = tb_penugasan.id_tim')
                        ->where('daltu', $daltu)
                        //->order_by('id_p2hp', 'desc')
                        ->get()->result();
    }

    //--> ambil data pka di tb_pka sesuai tugas untuk ketua tim tertentu
    function get_row_p2hp($id_p2hp) {
        return $this->db->select('*')
                        ->from('tb_p2hp')
                        ->where('id_p2hp', $id_p2hp)
                        ->get()->row();
    }

    function upload_p2hp($id_p2hp, $id_pka, $id_tgs) {
        
        $nmp2hp = str_replace(' ', '_', $_FILES['file_p2hp']['name']);
        $tempatp2hp = './assets/p2hp/' . $nmp2hp;

        $data_p2hp = array(
            'tgl_p2hp' => date('Y-m-d H:i:s'),
            'file_p2hp' => $nmp2hp,
            'keputusan_p2hp' => 'proses'
        );
        $this->db->where('id_p2hp', $id_p2hp)
                ->where('fk_pka', $id_pka)
                ->update('tb_p2hp', $data_p2hp);

        //--> proses upload
        move_uploaded_file($_FILES['file_p2hp']['tmp_name'], $tempatp2hp);

        $get_p2hp = $this->get_row_p2hp($id_p2hp);
        $ins = strtoupper($get_p2hp->nm_instansi);
        $kec = strtoupper($get_p2hp->nm_kec);

        ########## SMS GATEWAY ##########
        $sms = $this->db->get_where('set_sms', array('id' => '1'))->row();
        $tugas = $this->penugasan_m->get_row_penugasan($id_tgs);
        $sms_dn = $this->db->get_where('tb_pegawai', array('id_pegawai' => $tugas->dalnis))->row();
        $sms_dt = $this->db->get_where('tb_pegawai', array('id_pegawai' => $tugas->daltu))->row();

        $pesan = "PEMBERITAHUAN! P2HP $ins KECAMATAN $kec sudah dibuat. Berikan tanggapan hasil pembuatannya. Silahkan buka http://sipiko.pariamankota.go.id/index.php/log_in";

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

    function upload_reviu_p2hp($id_p2hp, $id_pka, $id_tgs) {
        $no_rev = $this->input->post('no_rev');
        $get = $this->db->get_where('tb_p2hp', array('id_p2hp' => $id_p2hp, 'fk_pka' => $id_pka))->row();

        $renamep2hp = str_replace('P2HP-', 'P2HP-REV_' . $no_rev . '-', $get->file_p2hp);
        $pathAwal = './assets/p2hp/' . $get->file_p2hp;
        $pathTujuan = './assets/p2hp/reviu/' . $renamep2hp;

        if (file_exists($pathAwal)) {
            copy($pathAwal, $pathTujuan); // salin file KKA dari folder /kka ke folder /kka/reviu
            unlink($pathAwal); // hapus file kka di folder kka
        }

        //--> tambahkan tabel rev_kka_ikhtisar
        $data_rev_p2hp = array(
            'rev_p2hp' => $get->id_p2hp,
            'rev_ke' => $no_rev,
            'rev_id_pka' => $get->fk_pka,
            'rev_id_tgs' => $get->fk_tgs,
            'rev_tgl' => date('Y-m-d H:i:s'),
            'rev_nm_instansi' => $get->nm_instansi,
            'rev_nm_kec' => $get->nm_kec,
            'rev_file_p2hp' => $renamep2hp,
            'rev_tgl_p2hp_dalnis' => $get->tgl_p2hp_dalnis,
            'rev_p2hp_dalnis' => $get->reviu_p2hp_dalnis,
            'rev_tgl_p2hp_daltu' => $get->tgl_p2hp_daltu,
            'rev_p2hp_daltu' => $get->reviu_p2hp_daltu
        );
        $this->db->insert('rev_p2hp', $data_rev_p2hp);

        $ins = strtoupper($get->nm_instansi);
        $kec = strtoupper($get->nm_kec);

        // cek reviu dalnis (ada reviu/tidak)
        if ($get->reviu_p2hp_dalnis == "-") {
            $tgl_dalnis = $get->tgl_p2hp_dalnis;
            $rev_dalnis = $get->reviu_p2hp_dalnis;
        } else {
            $tgl_dalnis = NULL;
            $rev_dalnis = NULL;

            ########## SMS GATEWAY ##########
            $sms = $this->db->get_where('set_sms', array('id' => '1'))->row();
            $tugas = $this->penugasan_m->get_row_penugasan($id_tgs);
            $sms_dn = $this->db->get_where('tb_pegawai', array('id_pegawai' => $tugas->dalnis))->row();

            $pesan = "PEMBERITAHUAN! P2HP $ins KECAMATAN $kec telah diperbaiki. Periksa hasil pekerjaannya. Silahkan buka http://sipiko.pariamankota.go.id/index.php/log_in";

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

        // cek reviu daltu (ada reviu/tidak)
        if ($get->reviu_p2hp_daltu == "-") {
            $tgl_daltu = $get->tgl_p2hp_daltu;
            $rev_daltu = $get->reviu_p2hp_daltu;
        } else {
            $tgl_daltu = NULL;
            $rev_daltu = NULL;

            ########## SMS GATEWAY ##########
            $sms = $this->db->get_where('set_sms', array('id' => '1'))->row();
            $tugas = $this->penugasan_m->get_row_penugasan($id_tgs);
            $sms_dt = $this->db->get_where('tb_pegawai', array('id_pegawai' => $tugas->daltu))->row();

            $pesan = "PEMBERITAHUAN! P2HP $ins KECAMATAN $kec telah diperbaiki. Periksa hasil pekerjaannya. Silahkan buka http://sipiko.pariamankota.go.id/index.php/log_in";

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

        $nmp2hp = str_replace(' ', '_', $_FILES['file_rev_p2hp']['name']);
        $tempatp2hp = './assets/p2hp/' . $nmp2hp;

        $data_p2hp = array(
            'file_p2hp' => $nmp2hp,
            'tgl_p2hp_dalnis' => $tgl_dalnis,
            'reviu_p2hp_dalnis' => $rev_dalnis,
            'tgl_p2hp_daltu' => $tgl_daltu,
            'reviu_p2hp_daltu' => $rev_daltu,
            'keputusan_p2hp' => 'proses'
        );
        $this->db->where('id_p2hp', $id_p2hp)
                ->where('fk_pka', $id_pka)
                ->update('tb_p2hp', $data_p2hp);

        //--> proses upload
        move_uploaded_file($_FILES['file_rev_p2hp']['tmp_name'], $tempatp2hp);
    }

    function persetujuan_p2hp_dalnis($id_p2hp, $id_pka, $id_tgs) {
        $cek = $this->db->get_where('tb_p2hp', array('id_p2hp' => $id_p2hp))->row();
        $ins = strtoupper($cek->nm_instansi);
        $kec = strtoupper($cek->nm_kec);

        if ($this->input->post('reviu') == 'setujui') {
            $catatan = "-";
        } else {
            $catatan = $this->input->post('catatan');
        }

        if ($catatan == "-" && $cek->reviu_p2hp_daltu == '-') {
            $keputusan = "selesai";

            ########## SMS GATEWAY ##########
            $sms = $this->db->get_where('set_sms', array('id' => '1'))->row();
            $tugas = $this->penugasan_m->get_row_penugasan($id_tgs);
            $sms_kt = $this->db->get_where('tb_pegawai', array('id_pegawai' => $tugas->ketua_tim))->row();

            $pesan = "PEMBERITAHUAN! P2HP $ins KECAMATAN $kec telah Selesai, Buatkan LHP instansi tersebut. Silahkan buka http://sipiko.pariamankota.go.id/index.php/log_in";

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
        } elseif ($catatan == "-" && $cek->reviu_p2hp_daltu == NULL) {
            $keputusan = "Proses";
        } else {
            $keputusan = "reviu";

            ########## SMS GATEWAY ##########
            $sms = $this->db->get_where('set_sms', array('id' => '1'))->row();
            $tugas = $this->penugasan_m->get_row_penugasan($id_tgs);
            $sms_kt = $this->db->get_where('tb_pegawai', array('id_pegawai' => $tugas->ketua_tim))->row();

            $pesan = "PEMBERITAHUAN! Terdapat REVIU P2HP $ins KECAMATAN $kec, harap perbaiki dan upload kembali. Silahkan buka http://sipiko.pariamankota.go.id/index.php/log_in";

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

        //--> ubah data sub_pka3 sesuai id tertentu
        $data_p2hp = array(
            'tgl_p2hp_dalnis' => date('Y-m-d H:i:s'),
            'reviu_p2hp_dalnis' => $catatan,
            'keputusan_p2hp' => $keputusan
        );
        $this->db->where('id_p2hp', $id_p2hp)
                ->where('fk_pka', $id_pka)
                ->update('tb_p2hp', $data_p2hp);

        // kondisi insert LHP
        if ($keputusan == "selesai") {
            $this->insert_lhp($id_p2hp, $id_pka, $id_tgs, $cek->nm_instansi);
        }
    }

    function persetujuan_p2hp_daltu($id_p2hp, $id_pka, $id_tgs) {
        $cek = $this->db->get_where('tb_p2hp', array('id_p2hp' => $id_p2hp))->row();
        $ins = strtoupper($cek->nm_instansi);
        $kec = strtoupper($cek->nm_kec);

        if ($this->input->post('reviu') == 'setujui') {
            $catatan = "-";
        } else {
            $catatan = $this->input->post('catatan');
        }

        if ($catatan == "-" && $cek->reviu_p2hp_dalnis == '-') {
            $keputusan = "selesai";

            ########## SMS GATEWAY ##########
            $sms = $this->db->get_where('set_sms', array('id' => '1'))->row();
            $tugas = $this->penugasan_m->get_row_penugasan($id_tgs);
            $sms_kt = $this->db->get_where('tb_pegawai', array('id_pegawai' => $tugas->ketua_tim))->row();

            $pesan = "PEMBERITAHUAN! P2HP $ins KECAMATAN $kec telah Selesai, Buatkan LHP instansi tersebut. Silahkan buka http://sipiko.pariamankota.go.id/index.php/log_in";

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
        } elseif ($catatan == "-" && $cek->reviu_p2hp_dalnis == NULL) {
            $keputusan = "Proses";
        } else {
            $keputusan = "reviu";

            ########## SMS GATEWAY ##########
            $sms = $this->db->get_where('set_sms', array('id' => '1'))->row();
            $tugas = $this->penugasan_m->get_row_penugasan($id_tgs);
            $sms_kt = $this->db->get_where('tb_pegawai', array('id_pegawai' => $tugas->ketua_tim))->row();

            $pesan = "PEMBERITAHUAN! Terdapat REVIU P2HP $ins KECAMATAN $kec, harap perbaiki dan upload kembali. Silahkan buka http://sipiko.pariamankota.go.id/index.php/log_in";

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

        //--> ubah data sub_pka3 sesuai id tertentu
        $data_p2hp = array(
            'tgl_p2hp_daltu' => date('Y-m-d H:i:s'),
            'reviu_p2hp_daltu' => $catatan,
            'keputusan_p2hp' => $keputusan
        );
        $this->db->where('id_p2hp', $id_p2hp)
                ->where('fk_pka', $id_pka)
                ->update('tb_p2hp', $data_p2hp);

        // kondisi insert LHP
        if ($keputusan == "selesai") {
            $this->insert_lhp($id_p2hp, $id_pka, $id_tgs, $cek->nm_instansi, $cek->nm_kec);
        }
    }

    ###################################################
    #################    LHP    #######################
    ###################################################

    function insert_lhp($id_p2hp, $id_pka, $id_tgs, $instansi, $kec) {

         /*$nu = $this->db->select_max('no_urut')
          ->from('tb_lhp')
          ->get()->row();  $no_surat;

          $no = $nu->no_urut+1;
          $no_lhp = "713/LHP-". $no ."-INSPT/". date('Y');*/ 

        //--> tambahkan LHP
        $data_lhp = array(
            'no_urut' => '',
            'no_lhp' => 'NULL',
            'fk_p2hp' => $id_p2hp,
            'fk_pka' => $id_pka,
            'fk_tgs' => $id_tgs,
            'nm_instansi' => $instansi,
            'nm_kec' => $kec
        );

        $this->db->insert('tb_lhp', $data_lhp);

        $last_id = $this->db->insert_id();

        $no_lhp = "713/LHP-" . $last_id . "-INSPT/" . date('m') . "/" . date('Y');

        $data = array(
            'no_lhp' => $no_lhp,
        );

        $this->db->where('no_urut', $last_id);
        $this->db->update('tb_lhp', $data);
    }

    function get_row_lhp($id_p2hp) {
        return $this->db->select('*')
            ->from('tb_lhp')
            ->join('tb_p2hp', 'tb_p2hp.id_p2hp = tb_lhp.fk_p2hp')
            ->where('id_p2hp', $id_p2hp)
            ->get()->row();
    }

    function cek_temuan($lhp) {
        return $this->db->select('*')
            ->from('tb_temuan')
            ->where('no_lhp', $lhp)
            ->get()->row();
    }

    //--> Mengecek max reviu kka ikhtisar
    function cek_rev_lhp($id_p2hp) {
        $sql = "SELECT max(rev_ke) as no_rev FROM rev_lhp WHERE rev_fk_p2hp='$id_p2hp'";
        $row = $this->db->query($sql)->row();
        $max_no = $row->no_rev + 1;
        return $max_no;
    }

    function cek_reviu_lhp($id_p2hp) {
        return $this->db->query("SELECT * FROM rev_lhp WHERE rev_fk_p2hp = '$id_p2hp'")->num_rows();
    }

    //--> ambil data pka di tb_pka sesuai tugas untuk ketua tim tertentu
    function get_rev_lhp($id_p2hp) {
        return $this->db->select('*')
                        ->from('rev_lhp')
                        ->where('rev_fk_p2hp', $id_p2hp)
                        ->order_by('rev_ke', 'asc')
                        ->get()->result();
    }

    function upload_lhp($no_lhp) {
        $nmlhp = str_replace(' ', '_', $_FILES['file_lhp']['name']);
        $tempatlhp = './assets/lhp/' . $nmlhp;

         $data_lhp = array(
            'tgl_lhp' => date('Y-m-d H:i:s'),
            'file_lhp' => $nmlhp,
            'keputusan_lhp' => 'proses'
        );
        $this->db->where('no_lhp', $no_lhp)
                ->update('tb_lhp', $data_lhp);

        //--> proses upload
        move_uploaded_file($_FILES['file_lhp']['tmp_name'], $tempatlhp);

        $get_lhp = $this->db->get_where('tb_lhp', array('no_lhp' => $no_lhp))->row();
        $ins = strtoupper($get_lhp->nm_instansi);
        $kec = strtoupper($get_lhp->nm_kec);

        ########## SMS GATEWAY ##########
        $sms = $this->db->get_where('set_sms', array('id' => '1'))->row();
        $tugas = $this->penugasan_m->get_row_penugasan($get_lhp->fk_tgs);
        $sms_dn = $this->db->get_where('tb_pegawai', array('id_pegawai' => $tugas->dalnis))->row();
        $sms_dt = $this->db->get_where('tb_pegawai', array('id_pegawai' => $tugas->daltu))->row();

        $pesan = "PEMBERITAHUAN! LHP $ins KECAMATAN $kec sudah dibuat. Berikan tanggapan hasil pembuatannya. Silahkan buka http://sipiko.pariamankota.go.id/index.php/log_in";

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

    function upload_reviu_lhp($no_lhp) {
        
        $no_rev = $this->input->post('no_rev');
        $get = $this->db->get_where('tb_lhp', array('no_lhp' => $no_lhp))->row();

        $renamelhp = str_replace('LHP-', 'LHP-REV_' . $no_rev . '-', $get->file_lhp);
        $pathAwal = './assets/lhp/' . $get->file_lhp;
        $pathTujuan = './assets/lhp/reviu/' . $renamelhp;

        if (file_exists($pathAwal)) {
            copy($pathAwal, $pathTujuan); // salin file KKA dari folder /kka ke folder /kka/reviu
            unlink($pathAwal); // hapus file kka di folder kka
        }

        //--> tambahkan tabel rev_kka_ikhtisar
        $data_rev_lhp = array(
            'rev_no_lhp' => $get->no_lhp,
            'rev_ke' => $no_rev,
            'tgl_rev_lhp' => date('Y-m-d H:i:s'),
            'rev_fk_p2hp' => $get->fk_p2hp,
            'rev_fk_pka' => $get->fk_pka,
            'rev_fk_tgs' => $get->tgs,
            'rev_nm_instansi' => $get->nm_instansi,
            'rev_file_lhp' => $renamelhp,
            'rev_tgl_dalnis' => $get->tgl_dalnis,
            'reviu_lhp_dalnis' => $get->rev_lhp_dalnis,
            'rev_tgl_daltu' => $get->tgl_daltu,
            'reviu_lhp_daltu' => $get->rev_lhp_daltu
        );
        $this->db->insert('rev_lhp', $data_rev_lhp);

        $get_lhp = $this->db->get_where('tb_lhp', array('no_lhp' => $no_lhp))->row();
        $ins = strtoupper($get_lhp->nm_instansi);
        $kec = strtoupper($get_lhp->nm_kec);

        // cek reviu dalnis (ada reviu/tidak)
        if ($get->rev_lhp_dalnis == "-") {
            $tgl_dalnis = $get->tgl_dalnis;
            $rev_dalnis = $get->rev_lhp_dalnis;
        } else {
            $tgl_dalnis = NULL;
            $rev_dalnis = NULL;

            ########## SMS GATEWAY ##########
            $sms = $this->db->get_where('set_sms', array('id' => '1'))->row();
            $tugas = $this->penugasan_m->get_row_penugasan($get_lhp->fk_tgs);
            $sms_dn = $this->db->get_where('tb_pegawai', array('id_pegawai' => $tugas->dalnis))->row();

            $pesan = "PEMBERITAHUAN! LHP $ins KECAMATAN $kec telah diperbaiki. Periksa hasil pekerjaannya. Silahkan buka http://sipiko.pariamankota.go.id/index.php/log_in";

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

        // cek reviu daltu (ada reviu/tidak)
        if ($get->rev_lhp_daltu == "-") {
            $tgl_daltu = $get->tgl_daltu;
            $rev_daltu = $get->rev_lhp_daltu;
        } else {
            $tgl_daltu = NULL;
            $rev_daltu = NULL;

            ########## SMS GATEWAY ##########
            $sms = $this->db->get_where('set_sms', array('id' => '1'))->row();
            $tugas = $this->penugasan_m->get_row_penugasan($get_lhp->fk_tgs);
            $sms_dt = $this->db->get_where('tb_pegawai', array('id_pegawai' => $tugas->daltu))->row();

            $pesan = "PEMBERITAHUAN! LHP $ins KECAMATAN $kec telah diperbaiki. Periksa hasil pekerjaannya. Silahkan buka http://sipiko.pariamankota.go.id/index.php/log_in";

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

        $nmp2hp = str_replace(' ', '_', $_FILES['file_rev_lhp']['name']);
        $tempatp2hp = './assets/lhp/' . $nmp2hp;

        $data_lhp = array(
            'file_lhp' => $nmp2hp,
            'tgl_dalnis' => $tgl_dalnis,
            'rev_lhp_dalnis' => $rev_dalnis,
            'tgl_daltu' => $tgl_daltu,
            'rev_lhp_daltu' => $rev_daltu,
            'keputusan_lhp' => 'proses'
        );
        $this->db->where('no_lhp', $no_lhp)
                ->update('tb_lhp', $data_lhp);

        //--> proses upload
        move_uploaded_file($_FILES['file_rev_lhp']['tmp_name'], $tempatp2hp);
    }

    function persetujuan_lhp_dalnis($no_lhp, $id_pka) {
        $cek = $this->db->get_where('tb_lhp', array('no_lhp' => $no_lhp))->row();
        $ins = strtoupper($cek->nm_instansi);
        $kec = strtoupper($cek->nm_kec);

        if ($this->input->post('reviu') == 'setujui') {
            $catatan = "-";
        } else {
            $catatan = $this->input->post('catatan');
        }

        if ($catatan == "-" && $cek->rev_lhp_daltu == '-') {
            $keputusan = "selesai";

            ########## SMS GATEWAY ##########
            $sms = $this->db->get_where('set_sms', array('id' => '1'))->row();
            $tugas = $this->penugasan_m->get_row_penugasan($cek->fk_tgs);
            $sms_kt = $this->db->get_where('tb_pegawai', array('id_pegawai' => $tugas->ketua_tim))->row();

            $pesan = "PEMBERITAHUAN! LHP $ins KECAMATAN $kec telah selesai dilaksanakan. Selamat dan Terima Kasih atas kerjasaanya.";

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
        } elseif ($catatan == "-" && $cek->rev_lhp_daltu == NULL) {
            $keputusan = "Proses";
        } else {
            $keputusan = "reviu";

            ########## SMS GATEWAY ##########
            $sms = $this->db->get_where('set_sms', array('id' => '1'))->row();
            $tugas = $this->penugasan_m->get_row_penugasan($cek->fk_tgs);
            $sms_kt = $this->db->get_where('tb_pegawai', array('id_pegawai' => $tugas->ketua_tim))->row();

            $pesan = "PEMBERITAHUAN! Terdapat REVIU LHP $ins KECAMATAN $kec, harap perbaiki dan upload kembali. Silahkan buka http://sipiko.pariamankota.go.id/index.php/log_in";

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

        //--> ubah data sub_pka3 sesuai id tertentu
        $data_lhp = array(
            'tgl_dalnis' => date('Y-m-d H:i:s'),
            'rev_lhp_dalnis' => $catatan,
            'keputusan_lhp' => $keputusan
        );
        $this->db->where('no_lhp', $no_lhp)
                ->update('tb_lhp', $data_lhp);

        $this->cek_fix_lhp($id_pka);
    }

    function persetujuan_lhp_daltu($no_lhp, $id_pka) {
        $cek = $this->db->get_where('tb_lhp', array('no_lhp' => $no_lhp))->row();
        $ins = strtoupper($cek->nm_instansi);
        $kec = strtoupper($cek->nm_kec);

        if ($this->input->post('reviu') == 'setujui') {
            $catatan = "-";
        } else {
            $catatan = $this->input->post('catatan');
        }

        if ($catatan == "-" && $cek->rev_lhp_dalnis == '-') {
            $keputusan = "selesai";

            ########## SMS GATEWAY ##########
            $sms = $this->db->get_where('set_sms', array('id' => '1'))->row();
            $tugas = $this->penugasan_m->get_row_penugasan($cek->fk_tgs);
            $sms_kt = $this->db->get_where('tb_pegawai', array('id_pegawai' => $tugas->ketua_tim))->row();

            $pesan = "PEMBERITAHUAN! LHP $ins KECAMATAN $kec telah selesai dilaksanakan. Selamat dan Terima Kasih atas kerjasamanya.";

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
        } elseif ($catatan == "-" && $cek->rev_lhp_dalnis == NULL) {
            $keputusan = "Proses";
        } else {
            $keputusan = "reviu";

            ########## SMS GATEWAY ##########
            $sms = $this->db->get_where('set_sms', array('id' => '1'))->row();
            $tugas = $this->penugasan_m->get_row_penugasan($cek->fk_tgs);
            $sms_kt = $this->db->get_where('tb_pegawai', array('id_pegawai' => $tugas->ketua_tim))->row();

            $pesan = "PEMBERITAHUAN! Terdapat REVIU LHP $ins KECAMATAN $kec, harap perbaiki dan upload kembali. Silahkan buka http://sipiko.pariamankota.go.id/index.php/log_in";

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

        //--> ubah data sub_pka3 sesuai id tertentu
        $data_lhp = array(
            'tgl_daltu' => date('Y-m-d H:i:s'),
            'rev_lhp_daltu' => $catatan,
            'keputusan_lhp' => $keputusan
        );
        $this->db->where('no_lhp', $no_lhp)
                ->update('tb_lhp', $data_lhp);


        $this->cek_fix_lhp($id_pka);
    }

    function cek_fix_lhp($id_pka) {
        $data_pka = $this->pka_m->get_row_pka($id_pka);
        $sasaran = $this->tim_m->get_sub_sasaran($data_pka->id_tim);
        $anggota = $this->tim_m->get_sub_tim($data_pka->id_tim);
        $tim = $this->tim_m->get_row_tim($data_pka->id_tim);

        //--> mengambil jumlah KKA Ikhtis di setiap no. KKA
        $cek = $this->db->select('count(fk_pka) as jml_lhp')
                        ->from('tb_lhp')
                        ->where('fk_pka', $id_pka)
                        ->where('keputusan_lhp', 'selesai')
                        ->get()->row();

        /*if (count($sasaran) != 0) {
            if (count($sasaran) == $cek->jml_lhp) {
                foreach ($anggota as $row) {
                    //--> ubah hak akses
                    ########### ANGGOTA ###########
                    $data_pgw = array(
                        'jabatan_tim' => "-"
                    );
                    $this->db->where('id_pegawai', $row->anggota)
                            ->update('tb_pegawai', $data_pgw);

                    $data_usr = array(
                        'level' => NULL
                    );
                    $this->db->where('id_fk', $row->anggota)
                            ->update('tb_user', $data_usr);
                    ###### BATAS ANGGOTA ########
                }

                ########### KETUA ###########
                $data_ketua_pgw = array(
                    'jabatan_tim' => "-"
                );
                $this->db->where('id_pegawai', $tim->ketua_tim)
                        ->update('tb_pegawai', $data_ketua_pgw);

                $data_ketua_usr = array(
                    'level' => NULL
                );
                $this->db->where('id_fk', $tim->ketua_tim)
                        ->update('tb_user', $data_ketua_usr);
                ####### BATAS KETUA #########
            }
        } else {
            if ($cek->jml_lhp == 1) {
                foreach ($anggota as $row) {
                    //--> ubah hak akses
                    ########### ANGGOTA ###########
                    $data_pgw = array(
                        'jabatan_tim' => "-"
                    );
                    $this->db->where('id_pegawai', $row->anggota)
                            ->update('tb_pegawai', $data_pgw);

                    $data_usr = array(
                        'level' => NULL
                    );
                    $this->db->where('id_fk', $row->anggota)
                            ->update('tb_user', $data_usr);
                    ###### BATAS ANGGOTA ########
                }

                ########### KETUA ###########
                $data_ketua_pgw = array(
                    'jabatan_tim' => "-"
                );
                $this->db->where('id_pegawai', $tim->ketua_tim)
                        ->update('tb_pegawai', $data_ketua_pgw);

                $data_ketua_usr = array(
                    'level' => NULL
                );
                $this->db->where('id_fk', $tim->ketua_tim)
                        ->update('tb_user', $data_ketua_usr);
                ####### BATAS KETUA #########	
            }
        }*/
    }

}
