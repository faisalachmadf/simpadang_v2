<?php

class Rev_instansi_m extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	//--> Mengecek id terakhir tb_instansi
	function get_id_max_ins()
	{
		$kode = 'INS';
		$sql  = "SELECT MAX(id_instansi) as max_id FROM tb_instansi";
		$row  = $this->db->query($sql)->row_array();
		$max_id = $row['max_id'];
		$max_no = (int) substr($max_id,4,8);
		$new_no = $max_no + 1;
		$new_id_instansi = $kode.sprintf("%05s",$new_no);
		return $new_id_instansi;
	}

	//--> ambil semua data instansi
	function get_all_instansi()
	{
		return $this->db->select('*')
										->from('tb_rev_instansi')
										->get()->result();
	}	

	function get_rev_instansi()
	{
		$this->db->select('*');
        $this->db->from('tb_rev_instansi');
        $query = $this->db->get(); 
        return $query->result();
	}

	public function get_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('tb_rev_instansi');
        $this->db->where('id', $id);
        $query = $this->db->get(); 
        return $query->row_array();
    }

    function cari_namainstansi($nama_instansi){
        $this->db->like('nama_instansi', $nama_instansi , 'both');
        $this->db->order_by('nama_instansi', 'ASC');
        $this->db->limit(10);
        return $this->db->get('tb_rev_instansi')->result();
    }

	//--> tambah instansi
	function insert_rev_instansi()
	{
        $kategori = $this->input->post('kategori');
        $nama_instansi = $this->input->post('instansi');

        $data_rev_instansi = array(
            'kategori'     => $kategori,
            'nama_instansi'     => $nama_instansi,
        );

        $this->db->insert('tb_rev_instansi', $data_rev_instansi);
    
	}
	

	//--> ubah instansi kecamatan
	function update_rev_instansi($id)
	{
		//--> ubah sub_instansi
		$data_instansi = array(
				'kategori' => $this->input->post('kategori'),
				'nama_instansi' => $this->input->post('nama_instansi')
			);
		$this->db->where('id', $this->input->post('id'));
        $this->db->update('tb_rev_instansi', $data_instansi);  
	}

	//--> ubah instansi desa
	function update_desa($id_desa, $id_kecamatan)
	{
		//--> ubah sub_instansi
		$data_instansi = array(
				'nama_desa' => $this->input->post('nama_desa')
			);
		$this->db->where('id', $id_desa)
						 ->where('sub_id_instansi', $id_kecamatan)
						 ->update('sub_instansi', $data_instansi);
	}

	//-- hapus data instansi kecamatan
	function delete_instansi($id)
	{
		//--> hapus data kecamatan
		$this->db->delete('tb_rev_instansi', array('id' => $id));

 		return true;
	}

	//-- hapus data instansi desa
	function delete_desa($id)
	{
		//--> hapus data desa
		$this->db->delete('sub_instansi', array('id' => $id));

 		return true;
	}

}