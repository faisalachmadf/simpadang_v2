<?php

class Pengguna_m extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	//--> Mengecek id terakhir tb_pengguna
	function get_id_max_pgn()
	{
		$kode = 'PGW';
		$sql  = "SELECT MAX(id_pegawai) as max_id FROM tb_pegawai";
		$row  = $this->db->query($sql)->row_array();
		$max_id = $row['max_id'];
		$max_no = (int) substr($max_id,4,5);
		$new_no = $max_no + 1;
		$new_id_pengguna = $kode.sprintf("%05s",$new_no);
		return $new_id_pengguna;
	}

	//--> ambil semua data pengguna
	function get_all_pengguna()
	{
		return $this->db->select('*')
										->from('tb_pegawai')
										->where('status_pegawai', 'aktif')
										->order_by('id_pegawai', 'asc')
										->get()->result();
	}
	//--> ambil semua data pengguna non-aktif
	function get_all_pengguna_nonaktif()
	{
		return $this->db->select('*')
										->from('tb_pegawai')
										->where('status_pegawai', 'nonaktif')
										->order_by('id_pegawai', 'asc')
										->get()->result();
	}

	//--> ambil pengguna tertentu
	function get_row_pengguna($id_pegawai)
	{
		return $this->db->select('*')
										->from('tb_pegawai')
										->join('tb_user', 'tb_user.id_fk = tb_pegawai.id_pegawai')
										->where('id_pegawai', $id_pegawai)
										->get()->row();
	}

	//--> cek username
	function cek_username($user)
	{
		$cek = $this->db->query("SELECT username from tb_user WHERE username='$user'")->num_rows();
		return $cek;
	}

	//--> tambah pengguna
	function insert_pengguna()
	{
		//--> tambah tb_pegawai
		$data_pengguna = array(
			'id_pegawai'	=> $this->input->post('id_pegawai'),
			'nama'	 			=> $this->input->post('nama'),
			'nip'			 		=> $this->input->post('nip'),
			'pangkat'		 	=> $this->input->post('pangkat'),
			'golongan'		=> $this->input->post('golongan'),
			'jabatan' 		=> $this->input->post('jabatan'),
			'no_tlp' 		  => $this->input->post('no_tlp'),
			'jabatan_tim' => "-",
			);
		$this->db->insert('tb_pegawai', $data_pengguna);

		//--> tambah tb_user
		$data_user = array(
				'id_fk'	 	 => $this->input->post('id_pegawai'),
				'username' => $this->input->post('username'),
				'password' => base64_encode($this->input->post('password')),
				'level'		 => NULL,
				'jenis_jabatan' =>$this->input->post('jenis_jabatan'),
			);
		$this->db->insert('tb_user', $data_user);
	}

	//--> ubah pengguna
	function update_pengguna($id_pegawai)
	{
		$jbtn_tim = $this->input->post('jabatan_tim');
		$jns_jabatan = $this->input->post('jenis_jabatan');
		//--> ubah tb_pegawai
		$data_pengguna = array(
				'nama'	 			=> $this->input->post('nama'),
				'nip'			 		=> $this->input->post('nip'),
				'pangkat'		 	=> $this->input->post('pangkat'),
				'golongan'		=> $this->input->post('golongan'),
				'jabatan'			=> $this->input->post('jabatan'),
				'no_tlp'			=> $this->input->post('no_tlp'),
				'jabatan_tim' => $jbtn_tim
			);
		$this->db->where('id_pegawai', $id_pegawai)
						 ->update('tb_pegawai', $data_pengguna);

		if($jbtn_tim == "STAFF")
			{ $level = "staff"; }
		elseif($jbtn_tim == "Sekretaris")
			{ $level = "sekretaris"; }
		elseif($jbtn_tim == "ADUM")
			{ $level = "adum"; }
		elseif($jbtn_tim == "Pengendali Mutu")
			{ $level = "daltu"; }
		elseif($jbtn_tim == "Pengendali Teknis")
			{ $level = "dalnis"; }
		elseif($jbtn_tim == "Ketua Tim")
			{ $level = "ketua_tim"; }
		elseif($jbtn_tim == "Anggota Tim")
			{ $level = "anggota_tim"; }
		elseif($jbtn_tim == "Ketua TL")
			{ $level = "ketua_tl"; }
		elseif($jbtn_tim == "Anggota TL")
			{ $level = "anggota_tl"; }
		elseif($jbtn_tim == "Staff Evlap")
			{ $level = "staff_evlap"; }
		elseif($jbtn_tim == "Evlap")
			{ $level = "evlap"; }
		else
			{ $level = NULL; }

		if($jns_jabatan == "inspektur")
			{ $jenis_jabatan = "inspektur"; }
		elseif($jns_jabatan == "sekretaris")
			{ $jenis_jabatan = "sekretaris"; }
		elseif($jns_jabatan == "irban")
			{ $jenis_jabatan = "irban"; }
		elseif($jns_jabatan == "adum")
			{ $jenis_jabatan = "adum"; }
		elseif($jns_jabatan == "fungsional_umum")
			{ $jenis_jabatan = "fungsional_umum"; }
		elseif($jns_jabatan == "jafung")
			{ $jenis_jabatan = "jafung"; }
		//--> ubah tb_user
		$data_user = array(
			'level'	=> $level,
			'jenis_jabatan'	=> $jenis_jabatan
		);
		$this->db->where('id_fk', $id_pegawai)
						 ->update('tb_user', $data_user);
	}

	//-- aktifkan data pengguna
	function aktif_pengguna($id_pegawai)
	{
		//--> ubah tb_pegawai
		$data_pengguna = array('status_pegawai'	=> 'aktif');
		$this->db->where('id_pegawai', $id_pegawai)
						 ->update('tb_pegawai', $data_pengguna);
	}

	//-- non-aktifkan data pengguna
	function nonaktif_pengguna($id_pegawai)
	{
		//--> ubah tb_pegawai
		$data_pengguna = array('status_pegawai'	=> 'nonaktif');
		$this->db->where('id_pegawai', $id_pegawai)
						 ->update('tb_pegawai', $data_pengguna);
	}

}