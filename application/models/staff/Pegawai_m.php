<?php

class Pegawai_m extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	//--> Mengecek id terakhir tb_pegawai
	function get_id_max_pgw()
	{
		$kode = 'PGW';
		$sql  = "SELECT MAX(id_pegawai) as max_id FROM tb_pegawai";
		$row  = $this->db->query($sql)->row_array();
		$max_id = $row['max_id'];
		$max_no = (int) substr($max_id,4,8);
		$new_no = $max_no + 1;
		$new_id_pegawai = $kode.sprintf("%05s",$new_no);
		return $new_id_pegawai;
	}

	//--> ambil semua data pengguna
	function get_all_pegawai()
	{
		return $this->db->select('*')
										->from('tb_pegawai')
										//->join('tb_user', 'tb_user.id_pgn = tb_pengguna.id_pengguna')
										//->where('konfirmasi', 'sudah')
										->order_by('id_pegawai', 'asc')
										->get()->result();
	}

	
	//--> ambil pegawai tertentu
	function get_row_pegawai($id_pegawai)
	{
		return $this->db->select('*')
										->from('tb_pegawai')
										//->join('tb_user', 'tb_user.id_pgn = tb_pengguna.id_pengguna')
										->where('id_pegawai', $id_pegawai)
										->get()->row();
	}

	function get_inspektur()
	{
		return $this->db->select('*')
										->from('tb_pegawai')
										->where('jabatan', 'Inspektur')
										->get()->row();
	}

	//--> cek username
	function cek_username($user)
	{
		$cek = $this->db->query("SELECT username from tb_user WHERE username='$user'")->num_rows();
		return $cek;
	}

	//--> tambah pegawai
	function insert_pegawai()
	{
		/*$status = $this->input->post('status_pengguna');
		if($status == "STAFF FAKULTAS")
		{
			$level = "staff fakultas";
		}
		else
		{
			$level = "staff jurusan";
		}*/

		//--> tambah tb_pengguna
		$data_pegawai = array(
				'id_pegawai'	=> $this->input->post('id_pegawai'),
				'nip'			 		=> $this->input->post('nip'),
				'nama'	 			=> $this->input->post('nama'),
				'golongan'		=> $this->input->post('golongan'),
				'jabatan' 		=> $this->input->post('jabatan'),
				'jabatan_tim' => $this->input->post('jabatan_tim')
			);
		$this->db->insert('tb_pegawai', $data_pegawai);

		//--> tambah tb_user
		/*$data_user = array(
				'id_pgn'	 => $this->input->post('id_pengguna'),
				'username' => $this->input->post('usrname'),
				'password' => base64_encode($this->input->post('password')),
				'level'		 => $level
			);
		$this->db->insert('tb_user', $data_user);*/
	}

	//--> ubah pegawai
	function update_pegawai($id_pegawai)
	{
		/*$status = $this->input->post('status_pengguna');
		if($status == "KETUA JURUSAN" || $status == "SEKERTARIS JURUSAN")
		{
			$level = "kajur";
		}
		elseif($status == "STAFF FAKULTAS")
		{
			$level = "staff fakultas";
		}
		elseif($status == "STAFF JURUSAN")
		{
			$level = "staff jurusan";
		}
		else
		{
			$level = "pimpinan";
		}*/

		//--> ubah tb_pegawai
		$data_pegawai = array(
				'nama'        => $this->input->post('nama'),
				'nip'         => $this->input->post('nip'),
				'pangkat'     => $this->input->post('pangkat'),				
				'golongan'    => $this->input->post('golongan'),
				'jabatan'     => $this->input->post('jabatan'),
				'jabatan_tim' => $this->input->post('jabatan_tim')
			);
		$this->db->where('id_pegawai', $id_pegawai)
						 ->update('tb_pegawai', $data_pegawai);

		//--> ubah tb_user
		//$data_user = array(
				/*'username' => $this->input->post('username'),
				'password' => $this->input->post('password'),*/
				//'level'		 => $level
		/*	);
		$this->db->where('id_pgn', $id_pengguna)
						 ->update('tb_user', $data_user);*/
	}

	//-- hapus data pegawai
	function delete_pegawai($id_pegawai)
	{
		//--> hapus data pegawai
		$this->db->delete('tb_pegawai', array('id_pegawai' => $id_pegawai));

		//--> hapus data user
		//$this->db->delete('tb_user', array('id_fk' => $id_pegawai));

 		return true;
	}

}