<?php

class Pengaturan_m extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}
	
	//--> set jabatan tim
	function get_jbtn_tim()
	{
		return $this->db->select('*')
										->from('set_pengguna')		
										->where('jenis_set', 'jabatan_tim')
										->get()->result();
	}

	//--> set golongan
	function get_gol()
	{
		return $this->db->select('*')
										->from('set_pengguna')		
										->where('jenis_set', 'golongan')								
										->order_by('id_set', 'asc')
										->get()->result();
	}

	//--> set jabatan tim
	function get_jbtn()
	{
		return $this->db->select('*')
										->from('set_pengguna')		
										->where('jenis_set', 'jabatan_pegawai')
										->get()->result();
	}

	//--> set golongan
	function get_row_gol($id)
	{
		return $this->db->select('*')
										->from('set_pengguna')		
										->where('jenis_set', 'golongan')								
										->where('id_set', $id)
										->get()->row();
	}

	//--> set jabatan
	function get_row_jbt($id)
	{
		return $this->db->select('*')
										->from('set_pengguna')		
										->where('jenis_set', 'jabatan_pegawai')								
										->where('id_set', $id)
										->get()->row();
	}

	function insert_gol()
	{
		//--> tambah golongan
		$data_gol = array(
				'isi_set'	 	=> $this->input->post('golongan'),
				'jenis_set' => 'golongan'
			);
		$this->db->insert('set_pengguna', $data_gol);
	}

	function update_gol($id)
	{
		//--> tambah golongan
		$data_gol = array(
				'isi_set'	 	=> $this->input->post('golongan'),
			);
		$this->db->where('id_set', $id)
						 ->update('set_pengguna', $data_gol);
	}

	#######################################################

	function insert_jbt()
	{
		//--> tambah jabatan
		$data_gol = array(
				'isi_set'	 	=> $this->input->post('jabatan'),
				'jenis_set' => 'jabatan_pegawai'
			);
		$this->db->insert('set_pengguna', $data_gol);
	}

	function update_jbt($id)
	{
		//--> tambah jabatan
		$data_gol = array(
				'isi_set'	 	=> $this->input->post('jabatan'),
			);
		$this->db->where('id_set', $id)
						 ->update('set_pengguna', $data_gol);
	}

	#####################################################

	function delete_set($id)
	{
		//--> hapus golongan & jabatan
		return $this->db->delete('set_pengguna', array('id_set' => $id));
	}
}