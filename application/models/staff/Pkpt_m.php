<?php

class Pkpt_m extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    //--> ambil semua data pkpt
    function get_pkpt() {
        return $this->db->select('*')
            ->from('tb_pkpt')
            ->order_by('tahun', 'desc')
            ->get()->result();
    }

    public function get_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('tb_pkpt');
        $this->db->where('id', $id);
        $query = $this->db->get(); 
        return $query->row_array();
    }

    //--> tambah pkpt
    function insert_pkpt() {
        $tahun = $this->input->post('tahun');
        $judul = $this->input->post('judul');
        $created_at = date('Y-m-d');

        // upload file

        //--> tambah tb_pkpt
        $data_pkpt = array(
            'tahun'     => $tahun,
            'judul'     => $judul,
            "nama_file"       => $this->upload->data('file_name'),
            'created_at' => $created_at,
        );

        $this->db->insert('tb_pkpt', $data_pkpt);
    }


    public function update_data()
    {
        $tahun = $this->input->post('tahun');
        $judul = $this->input->post('judul');

        $data_pkpt = array(
            'tahun'     => $tahun,
            'judul'     => $judul,
            //file 
        );

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('tb_pkpt', $data_pkpt);     
    }

    public function delete_data($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('tb_pkpt');
        $row = $query->row();
        unlink("./assets/pkpt/$row->nama_file");
        $this->db->delete('tb_pkpt', array('id' => $id));
        return true;

    }

}
