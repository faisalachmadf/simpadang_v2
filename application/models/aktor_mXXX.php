<?php

class Aktor_m extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	//--> mengambil data ka. staff_jurusan
	function get_ka_staff_jurusan()
	{
		return $this->db->select('nama')
										->from('tb_aktor')
										->where('jabatan', 'ka_staff_jurusan')
										->get()->row();
	}

	//--> mengambil data ka. staff_fakultas
	function get_ka_staff_fakultas()
	{
		return $this->db->select('nama')
										->from('tb_aktor')
										->where('jabatan', 'staff_fakultas')
										->get()->row();
	}

}