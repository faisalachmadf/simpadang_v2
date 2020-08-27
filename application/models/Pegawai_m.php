<?php

class Pegawai_m extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	//--> ambil profil pegawai
	function get_profil_admin($user)
	{
		return $this->db->select('*')
										->from('tb_user')
										->where('username', $user)
										->get()->row();
	}

	//--> ambil profil pegawai
	function get_profil_pegawai($user)
	{
		return $this->db->select('*')
										->from('tb_user')
										->join('tb_pegawai', 'tb_pegawai.id_pegawai = tb_user.id_fk')
										->where('username', $user)
										->get()->row();
	}

	//--> ubah data pegawai login (profil)
	function update_pegawai_login($id_pegawai)
	{
		//-- tambah tb_pegawai
		/*$data_pegawai = array(
				'NIP'			 			 => $this->input->post('nip'),
				'nama_pegawai'	 => $this->input->post('nama_pegawai'),
				'jk_pegawai'		 => $this->input->post('jk_pegawai'),
				'alamat_pegawai' => strtoupper($this->input->post('alamat_pegawai')),
				'cp_pegawai' 		 => strtoupper($this->input->post('cp_pegawai'))
			);
		$this->db->where('id_pegawai', $id_pegawai);
		$this->db->update('tb_pegawai', $data_pegawai);*/

		//-- tambah tb_user
		$data_user = array(
				'username' => $this->input->post('username'),
				'password' => base64_encode($this->input->post('password'))
			);
		$this->db->where('id_fk', $id_pegawai);
		$this->db->update('tb_user', $data_user);
	}
	//
	//************* BATA PEGAWAI ************//

}