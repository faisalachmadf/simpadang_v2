<?php

class Surat_m extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /*     * **** SET SURAT TUGAS ***** */
    ###############################

    function get_dasar() {
        return $this->db->get_where('set_surat_tugas', array('jenis' => 'dasar'))->row();
    }

    function get_max_tbs() {
        return $this->db->select('count(isi) as max_tbs')
                        ->from('set_surat_tugas')
                        ->where('jenis', 'tembusan')
                        ->get()->row();

    }

    function get_tembusan() {
        return $this->db->get_where('set_surat_tugas', array('jenis' => 'tembusan'))->result();
    }

    ###############################

    function count_tbs($id) {
        return $this->db->select('count(tembusan) as jml')
                        ->from('sub_surat')
                        ->where('sub_no_surat', $id)
                        ->get()->row();
    }

    //--> ambil semua data surat
    function get_all_surat() {
        return $this->db->select('*')
                        ->from('tb_surat')
                        //->join('tb_penugasan', 'tb_penugasan.no_st = tb_surat.no_surat')
                        ->join('tb_tim', 'tb_tim.id_tim = tb_surat.fk_tim')
                        //->join('notifikasi', 'notifikasi.id_terkait = tb_penugasan.id_tugas')
                        ->join('tb_pegawai', 'tb_pegawai.id_pegawai = tb_tim.ketua_tim')
                        //->where('tgl_persetujuan !=', NULL)
                        ->order_by('no_urut', 'desc')
                        ->get()->result();
    }

    //--> ambil nomor urut
    function get_no_urut() {
        return $this->db->select_max('no_urut')
                        ->from('tb_surat')
                        ->get()->row();
    }

    //--> ambil surat tugas tertentu
    function get_surat($no_surat) {
        return $this->db->select('*')
                        ->from('tb_surat')
                        ->join('tb_penugasan', 'tb_penugasan.no_st = tb_surat.no_surat')
                        ->join('tb_tim', 'tb_tim.id_tim = tb_surat.fk_tim')
                        ->where('no_surat', $no_surat)
                        ->get()->row();
    }

    //--> ambil surat tugas tertentu
    function get_surat2($no_surat) {
        return $this->db->select('*')
                        ->from('tb_surat')
                        ->join('tb_tindak_lanjut', 'tb_tindak_lanjut.no_st = tb_surat.no_surat')
                        ->join('tb_tim', 'tb_tim.id_tim = tb_surat.fk_tim')
                        ->where('no_surat', $no_surat)
                        ->get()->row();
    }

    function get_sub_surat($no_surat) {
        //cek = $this->db->get_where('tb_surat', array('fk_tim' => $id_tim))->row();

        return $this->db->select('*')
                        ->from('sub_surat')
                        ->where('sub_no_surat', $no_surat)
                        ->order_by('tes','asc')
                        ->get()->result();
    }

    //--> melengkapi data surat tugas
    function lengkapi_data($id_tugas, $id_tim) {
        //$inspektur = $this->db->get_where('tb_pegawai', array('jabatan' => 'INSPEKTUR'))->row();

        $no_surat = $this->input->post('no_surat');

        //--> ubah tb_surat
        $data_surat = array(
            'tgl_surat' => date('Y-m-d'),
            'dasar_surat' => $this->input->post('dasar'),
            'untuk' => $this->input->post('perihal')
        );
        $this->db->where('no_surat', $no_surat)
                ->update('tb_surat', $data_surat);

        //$get_surat = $this->db->get_where('sub_surat', array('sub_no_surat' => $no_surat))->row();
        $this->db->delete('sub_surat', array('sub_no_surat' => $no_surat));

        $jum_tbs = $this->input->post('jml_tbs') - 1;
        $tembusan = $this->input->post('tembusan');

        //--> cek kondisi jumlah anggaran dan jumlah tembusan
        # digunakan untuk jumlah pengulangan insert isi, tembusan dan anggaran
        /* if(1 < $jum_tbs)
          {
          $jml = $jum_tbs;
          }
          elseif(1 > $jum_tbs)
          {
          $jml = 1;
          } */

        $i = 0;
        while ($i < $jum_tbs) {
            //--> tambah sub_surat
            $data_sub_surat = array(
                'sub_no_surat' => $this->input->post('no_surat'),
                'nomor' => $i + 1,
                'tembusan' => $tembusan[$i]
            );
            $this->db->insert('sub_surat', $data_sub_surat);

            $i++;
        }

        //$get_agt = $this->db->get_where('sub_tim', array('sub_id_tim' => $id_tim))->row();
        $this->db->delete('sub_tim', array('sub_id_tim' => $id_tim));

        $jum_agt = $this->input->post('jml_agt');
        $anggota = $this->input->post('anggota');
        $kon_sas = $this->input->post('kondisi_sasaran');
        $jum_ins = $this->input->post('jml_ins') - 1;

        if ($kon_sas == "input") {
            $sasaran = $this->input->post('sasaran_input');
        } else {
            $sasaran = $this->input->post('sasaran');
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
    }

    //--> ambil semua data tim
    /* function get_all_tim()
      {
      return $this->db->select('*')
      ->from('tb_tim')
      //->join('tb_user', 'tb_user.id_pgn = tb_pengguna.id_pengguna')
      //->where('konfirmasi', 'sudah')
      ->order_by('id_tim', 'desc')
      ->get()->result();
      } */

    //--> ambil instansi tertentu
    /* function get_row_instansi($id_instansi)
      {
      return $this->db->select('*')
      ->from('tb_instansi')
      ->where('id_instansi', $id_instansi)
      ->get()->row();
      } */

    //--> ambil semua nama ketua tim
    /* function get_ketua_tim()
      {
      return $this->db->select('*')
      ->from('tb_pegawai')
      ->where('jabatan_tim', 'Ketua Tim')
      ->order_by('nama', 'asc')
      ->get()->result();
      } */

    //--> ambil semua nama pengendali teknis (dalnis)
    /* function get_dalnis()
      {
      return $this->db->select('*')
      ->from('tb_pegawai')
      ->where('jabatan_tim', 'Pengendali Teknis')
      ->order_by('nama', 'asc')
      ->get()->result();
      } */

    //--> ambil semua nama anggota
    /* function get_anggota()
      {
      return $this->db->select('*')
      ->from('tb_pegawai')
      ->where('jabatan_tim', 'Anggota Tim')
      ->order_by('nama', 'asc')
      ->get()->result();
      } */

    //--> tambah surat tim pemeriksa
    function insert_surat_tim_pemeriksa() {

        $inspektur = $this->db->get_where('tb_pegawai', array('jabatan' => 'INSPEKTUR'))->row();

        //--> tambah tb_surat
        $data_surat = array(
            'no_urut' => $this->input->post('no_urut'),
            'no_surat' => $this->input->post('no_surat'),
            'tgl_surat' => date('Y-m-d'),
            'fk_tim' => $this->input->post('id_tim'),
            'untuk' => $this->input->post('perihal'),
            'tgl_awal' => $this->input->post('tgl_awal'),
            'tgl_akhir' => $this->input->post('tgl_akhir'),
            'kategori_surat' => 'Tim Pemeriksa',
            'fk_inspektur' => $inspektur->id_pegawai
        );
        $this->db->insert('tb_surat', $data_surat);

        $dasar = $this->input->post('dasar');
        $jum_tbs = $this->input->post('jml_tbs') - 1;
        $tembusan = $this->input->post('tembusan');

        //--> cek kondisi jumlah anggaran dan jumlah tembusan
        # digunakan untuk jumlah pengulangan insert isi, tembusan dan anggaran
        /* if(1 < $jum_tbs)
          {
          $jml = $jum_tbs;
          }
          elseif(1 > $jum_tbs)
          {
          $jml = 1;
          } */

        $i = 0;
        while ($i < $jum_tbs) {
            //--> tambah sub_surat
            $data_sub_surat = array(
                'sub_no_surat' => $this->input->post('no_surat'),
                'nomor' => $i + 1,
                'dasar' => $dasar[$i],
                'tembusan' => $tembusan[$i]
            );
            $this->db->insert('sub_surat', $data_sub_surat);

            $i++;
        }
    }

    //--> ubah instansi
    function update_instansi($id_instansi) {
        //--> ubah tb_instansi
        $data_instansi = array(
            'nama_instansi' => $this->input->post('nama_instansi'),
            'kategori' => $this->input->post('kategori'),
            'alamat_instansi' => $this->input->post('alamat_instansi')
        );
        $this->db->where('id_instansi', $id_instansi)
                ->update('tb_instansi', $data_instansi);
    }

    //-- hapus data instansi
    function delete_instansi($id_instansi) {
        //--> hapus data instansi
        $this->db->delete('tb_instansi', array('id_instansi' => $id_instansi));

        return true;
    }

}
