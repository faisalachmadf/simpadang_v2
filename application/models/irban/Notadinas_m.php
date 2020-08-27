<?php

class Notadinas_m extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    //--> Mengecek id terakhir tb_penugasan
    function get_id_max_tugas() {
        return "ND_". "_" . round(microtime(true) * 1000);
    }

    function get_row_penugasan($id) {
        return $this->db->select('*')
            ->from('tb_notadinas')
            ->where('notadinas_id', $id)
            ->get()->row();
    }

    function get_sub_tim($id)
    {
        return $this->db->select('*')
        ->from('tb_notadinas_anggota')
        /*->join('tb_notadinas', 'tb_notadinas.notadinas_id = tb_notadinas_anggota.notadinas_id')*/
        ->where('notadinas_id', $id)
        ->get()->result();
    }

    //--> ambil sub sasaran dari surat tugas
    function get_sub_sasaran($id)
    {
        return $this->db->select('*')
        ->from('tb_notadinas_sasaran')
        ->where('notadinas_id', $id)
        ->where('sasaran !=', NULL)
        ->order_by('notadinas_id','asc')
        ->get()->result();
    }

    function get_sub_sasaran_null($id)
    {
        return $this->db->select('*')
        ->from('tb_notadinas_sasaran')
        ->where('notadinas_id', $id)
        ->where('sasaran', NULL)
        ->get()->result();
    }

    //--> jumlah sasaran tim pemeriksa
    function get_jum_sasaran($id)
    {
        return $this->db->select('count(sasaran) as jml')
        ->from('tb_notadinas_sasaran')
        ->where('notadinas_id', $id)
        ->where('sasaran !=', NULL)
        ->get()->row();
    }

    /*function get_sub_sasaran($id)
    {
        return $this->db->select('*')
        ->from('tb_notadinas_sasaran')
        ->where('notadinas_id !=', $id)
        ->get()->result();
    }*/

    //--> jumlah sasaran tim pemeriksa
    /*function get_jum_sasaran($id)
    {
        return $this->db->select('count(sasaran) as jml')
        ->from('tb_notadinas_sasaran')
        ->where('notadinas_sasaran_id', $id)
        ->where('sasaran !=', NULL)
        ->get()->row();
    }*/



    public function get_by_id($id)
    {
        $this->db->select('tb_notadinas.*, i.nama as irban, k.nama as ketua, i.nip as nip, i.jabatan as jabatan');
        $this->db->from('tb_notadinas');
        $this->db->join('tb_notadinas_anggota', 'tb_notadinas_anggota.notadinas_id = tb_notadinas.notadinas_id');
        /* $this->db->join('tb_pegawai', 'tb_pegawai.id_pegawai = tb_notadinas_anggota.id_pegawai');*/
        $this->db->join('tb_pegawai i', 'i.id_pegawai = tb_notadinas.irban_id_pegawai');
        $this->db->join('tb_pegawai k', 'k.id_pegawai = tb_notadinas.ketua_id_pegawai');
        $this->db->where('tb_notadinas.notadinas_id', $id);
        $query = $this->db->get(); 
        return $query->row_array();

        /* return $this->db->get_where('identifikasi', ['id' => $id])->row_array();*/
    }

    function insert_notadinas() {
        $session = $this->session->userdata('username');
        $inspektur = $this->db->get_where('tb_pegawai', array('jabatan' => 'Inspektur'))->row();
        $id_fks = $this->db->get_where('tb_user', array('username' => $session))->row();
        $daltu = $this->db->get_where('tb_pegawai', array('id_pegawai' => 'Inspektur'))->row();
        $id_nd = $this->input->post('notadinas_id');
        $id_tim = $this->input->post('id_tim');

        $data_notadinas = array(
            'nomor' => $this->input->post('nomor'),
            'hal' => $this->input->post('hal'),
            'nama_objek' => $this->input->post('nama_objek'),
            'ketua_id_pegawai' => $this->input->post('ketua_tim'),
            'dalnis_id_pegawai' => $this->input->post('dalnis'),
            'daltu_id_pegawai' => $this->input->post('daltu'),
            'irban_id_pegawai' => $id_fks->id_fk,
            'tgl' => $this->input->post('tgl'),
            'sasaran_peng' => $this->input->post('sasaran_peng'),
            'lampiran' => $this->input->post('lampiran'),
            'isi_nota' => $this->input->post('isi_nota'),
            'tgl_awal' => $this->input->post('tgl_awal'),
            'tgl_akhir' => $this->input->post('tgl_akhir'),
            'status' => $this->input->post('status'),
        );

        $this->db->insert('tb_notadinas', $data_notadinas);
        $last_id = $this->db->insert_id();

        //--> tambah tb_tim
        /*$data_tim = array(
            'notadinas_id' => $last_id,
            'dalnis' => $this->input->post('dalnis'),
        );
        $this->db->insert('tb_notadinas_anggota', $data_tim);*/

        $jum_agt = $this->input->post('jml_agt') - 1;
        $anggota = $this->input->post('anggota');
        $jum_ins = $this->input->post('jml_ins') - 1;
        $kon_sas = $this->input->post('kondisi_sasaran');

        if ($kon_sas == "pilih") {
            $sasarans = $this->input->post('sasaran');
        } else {
            $sasarans = NULL;
        }

        $i = 0;
        while ($i < $jum_agt) {
            $data_sub_tim = array(
                'notadinas_id'  => $last_id,
                'id_pegawai'    => $anggota[$i]
            );
            $this->db->insert('tb_notadinas_anggota', $data_sub_tim);

            $i++;
        }
        //--> tambah tb_tim
        $data_tim = array(
            'id_tim' => $id_tim,
            'ketua_tim' => $this->input->post('ketua_tim'),
            'kategori_tim' => 'Tim Nota Dinas'
        );
        $this->db->insert('tb_tim', $data_tim);

        // Ketua Tim
        $data_ketu2 = array('level' => 'ketua_nd');
        $this->db->where('id_fk', $this->input->post('ketua_tim'))
        ->update('tb_user', $data_ketu2);

        //--> tambah notifikasi
        $data_notif = array(
            'id_terkait' => $id_nd,
            'notif_ketua_tim' => "baru",
        );
        $this->db->insert('notifikasi', $data_notif);


        $i = 0;
        while ($i < $jum_ins) {
            $data_sub_sasaran = array(
                'notadinas_id'  => $last_id,
                'sasaran'       => $sasarans[$i]
            );

            $this->db->insert('tb_notadinas_sasaran', $data_sub_sasaran);

            $i++;
        }
    }

    function update_notadinas() {
        

        $session = $this->session->userdata('username');
        $inspektur = $this->db->get_where('tb_pegawai', array('jabatan' => 'Inspektur'))->row();
        $id_fks = $this->db->get_where('tb_user', array('username' => $session))->row();
        $daltu = $this->db->get_where('tb_pegawai', array('id_pegawai' => 'Inspektur'))->row();
        $id_nd = $this->input->post('notadinas_id');
        $id_tim = $this->input->post('id_tim');

        $data_notadinas = array(
            'nomor' => $this->input->post('nomor'),
            'hal' => $this->input->post('hal'),
            'nama_objek' => $this->input->post('nama_objek'),
            'ketua_id_pegawai' => $this->input->post('ketua_tim'),
            'dalnis_id_pegawai' => $this->input->post('dalnis'),
            'daltu_id_pegawai' => $this->input->post('daltu'),
            'irban_id_pegawai' => $id_fks->id_fk,
            'tgl' => $this->input->post('tgl'),
            'sasaran_peng' => $this->input->post('sasaran_peng'),
            'lampiran' => $this->input->post('lampiran'),
            'isi_nota' => $this->input->post('isi_nota'),
            'tgl_awal' => $this->input->post('tgl_awal'),
            'tgl_akhir' => $this->input->post('tgl_akhir'),
            'status' => $this->input->post('status'),
        );
        $this->db->where('notadinas_id', $this->input->post('notadinas_id'));
        $this->db->update('tb_notadinas', $data_notadinas); 

        /*$this->db->insert('tb_notadinas', $data_notadinas);*/
        $last_id = $this->db->insert_id();

        //--> tambah tb_tim
        /*$data_tim = array(
            'notadinas_id' => $last_id,
            'dalnis' => $this->input->post('dalnis'),
        );
        $this->db->insert('tb_notadinas_anggota', $data_tim);*/

        $jum_agt = $this->input->post('jml_agt') - 1;
        $anggota = $this->input->post('anggota');
        $jum_ins = $this->input->post('jml_ins') - 1;
        $kon_sas = $this->input->post('kondisi_sasaran');

        if ($kon_sas == "pilih") {
            $sasaran = $this->input->post('sasaran');
        } else {
            $sasaran = NULL;
        }

        $i = 0;
        while ($i < $jum_agt) {
            $data_sub_tim = array(
                'notadinas_id'  => $last_id,
                'id_pegawai'    => $anggota[$i]
            );
            $this->db->where('notadinas_id', $this->input->post('notadinas_id'));
            $this->db->update('tb_notadinas_anggota', $data_sub_tim); 
            /*$this->db->insert('tb_notadinas_anggota', $data_sub_tim);*/

            $i++;
        }

        $i = 0;
        while ($i < $jum_ins) {
            $data_sub_sasaran = array(
                'notadinas_id'  => $last_id,
                'sasaran'       => $sasaran[$i]
            );
            $this->db->where('notadinas_id', $this->input->post('notadinas_id'));
            $this->db->update('tb_notadinas_sasaran', $data_sub_sasaran); 

            /*$this->db->insert('tb_notadinas_sasaran', $data_sub_sasaran);*/

            $i++;
        }

        //--> tambah tb_tim
        $data_tim = array(
            'id_tim' => $id_tim,
            'ketua_tim' => $this->input->post('ketua_tim'),
            'kategori_tim' => 'Tim Nota Dinas'
        );
        $this->db->where('id_tim', $this->input->post('id_tim'));
        $this->db->update('tb_tim', $data_tim); 
        /*$this->db->insert('tb_tim', $data_tim);*/

        // Ketua Tim
        $data_ketu2 = array('level' => 'ketua_nd');
        $this->db->where('id_fk', $this->input->post('ketua_tim'))
        ->update('tb_user', $data_ketu2);

        //--> tambah notifikasi
        $data_notif = array(
            'id_terkait' => $id_nd,
            'notif_ketua_tim' => "baru",
        );
        $this->db->where('id_terkait', $this->input->post('id_terkait'));
        $this->db->update('notifikasi', $data_tim); 

        /*  $this->db->insert('notifikasi', $data_notif);*/
    }


    function status_notadinas()
    {
        $data = [
            "status" => 1,
        ];
        $this->db->where('notadinas_id', $this->input->post('notadinas_id'));
        $this->db->update('tb_notadinas', $data);
    }


    function get_notadinas($id_pegawai) {
        return $this->db->select('*')
        ->from('tb_notadinas')
        ->join('tb_notadinas_anggota', 'tb_notadinas_anggota.notadinas_id = tb_notadinas.notadinas_id')
        ->join('tb_pegawai', 'tb_pegawai.id_pegawai = tb_notadinas_anggota.id_pegawai')
        ->where('tb_notadinas.irban_id_pegawai', $id_pegawai)
        ->or_where('tb_notadinas.irban_id_pegawai', $id_pegawai)
        ->or_where('tb_notadinas.ketua_id_pegawai', $id_pegawai)
        ->or_where('tb_notadinas.dalnis_id_pegawai', $id_pegawai)
        ->or_where('tb_notadinas.daltu_id_pegawai', $id_pegawai)
        ->or_where('tb_notadinas_anggota.id_pegawai', $id_pegawai)
        ->group_by('tb_notadinas.notadinas_id')
        ->order_by('tgl', 'desc')
        ->get()->result();
    }

    function get_notadinas_by_ketua($id_pegawai) {
        return $this->db->select('*')
        ->from('tb_notadinas')
        ->join('tb_notadinas_anggota', 'tb_notadinas_anggota.notadinas_id = tb_notadinas.notadinas_id')
        ->join('tb_pegawai', 'tb_pegawai.id_pegawai = tb_notadinas_anggota.id_pegawai')
        ->where('tb_notadinas.irban_id_pegawai', $id_pegawai)
        ->or_where('tb_notadinas.irban_id_pegawai', $id_pegawai)
        ->or_where('tb_notadinas.ketua_id_pegawai', $id_pegawai)
        ->or_where('tb_notadinas.dalnis_id_pegawai', $id_pegawai)
        ->or_where('tb_notadinas.daltu_id_pegawai', $id_pegawai)
        ->or_where('tb_notadinas_anggota.id_pegawai', $id_pegawai)
        ->group_by('tb_notadinas.notadinas_id')
        ->order_by('tgl', 'desc')
        ->get()->result();
    }



    }

