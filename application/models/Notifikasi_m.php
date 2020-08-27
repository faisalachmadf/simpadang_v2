<?php

class Notifikasi_m extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	/*** EVLAP ***/
	function jml_notif_evlap()
	{
		return $this->db->select("count(*) as jml_temuan")
										->from('notifikasi')	
										->like('id_terkait', 'TEMUAN')
										->where('notif_evlap', 'baru')
										->get()->row();
	}

	function notif_evlap()
	{
		return $this->db->select("*, DATE_FORMAT(tgl_tbh, '%d-%m-%Y') as tgl_tb")
						->from('tb_temuan')
						->join('notifikasi', 'notifikasi.id_terkait = CONCAT("TEMUAN_", tb_temuan.id_temuan)')
						->order_by('tgl_tb', 'desc')
						->get()->result();
	}

	function update_notif_evlap($id)
	{	
		$id_terkaits = 'TEMUAN_' . $id;
		$update_notif = array('notif_evlap' => 'lama');
		$this->db->where('id_terkait', $id_terkaits);
		$this->db->update('notifikasi', $update_notif);
	}


	/**** INSPEKTUR ****/
	#####################
	//--> ambil jumlah penugasan baru
	function jml_notif_inspektur()
	{
		return $this->db->select("count(*) as jml_tgs")
										->from('notifikasi')	
										->like('id_terkait', 'TGS')
										->where('notif_inspektur', 'baru')
										->get()->row();
	}

	//--> ambil data penugasan baru
	function notif_inspektur()
	{
		return $this->db->select("*, DATE_FORMAT(tgl_penugasan, '%d-%m-%Y') as tgl_tgs")
										->from('tb_penugasan')
										->join('notifikasi', 'notifikasi.id_terkait = tb_penugasan.id_tugas')
										->where('notif_inspektur', 'baru')
										->order_by('tgl_penugasan', 'desc')
										->get()->result();
	}

	//-> ubah status notif penugasan baru
	function update_notif_inspektur($id)
	{
		$update_notif = array('notif_inspektur' => 'lama');
		$this->db->where('id_terkait', $id);
		$this->db->update('notifikasi', $update_notif);
	}
	/**** BATAS INSPEKTUR ****/
	###########################

	/******* STAFF ADMINISTRASI ********/
	#####################################
	//--> ambil jumlah keputusan baru
	function jml_notif_staff()
	{
		return $this->db->select("count(*) as jml_tgs")
										->from('notifikasi')	
										->like('id_terkait', 'TGS')
										->where('notif_staff', 'baru')
										->get()->row();
	}

	//--> ambil data keputusan baru
	function notif_staff()
	{
		return $this->db->select("*, DATE_FORMAT(tgl_penugasan, '%d-%m-%Y') as tgl_tgs")
										->from('tb_penugasan')
										->join('notifikasi', 'notifikasi.id_terkait = tb_penugasan.id_tugas')
										->where('notif_staff', 'baru')
										->order_by('tgl_penugasan', 'desc')
										->get()->result();
	}

	//-> ubah status notif keputusan baru
	function update_notif_staff($id)
	{
		$update_notif = array('notif_staff' => 'lama');
		$this->db->where('id_terkait', $id);
		$this->db->update('notifikasi', $update_notif);
	}
	/******* BATAS STAFF ADMINISTRASI *******/
	##########################################

	/******* ADUM ********/
	#######################
	//--> ambil jumlah keputusan baru
	function jml_notif_adum()
	{
		return $this->db->select("count(*) as jml_tgs")
										->from('notifikasi')	
										->like('id_terkait', 'TGS')
										->where('notif_adum', 'baru')
										->get()->row();
	}

	//--> ambil data keputusan baru
	function notif_adum()
	{
		return $this->db->select("*, DATE_FORMAT(tgl_penugasan, '%d-%m-%Y') as tgl_tgs")
										->from('tb_penugasan')
										->join('notifikasi', 'notifikasi.id_terkait = tb_penugasan.id_tugas')
										->where('notif_adum', 'baru')
										->order_by('tgl_penugasan', 'desc')
										->get()->result();
	}

	//-> ubah status notif keputusan baru
	function update_notif_adum($id)
	{
		$update_notif = array('notif_adum' => 'lama');
		$this->db->where('id_terkait', $id);
		$this->db->update('notifikasi', $update_notif);
	}


	function jml_notif_adum_temuan()
	{
		return $this->db->select("count(*) as jml_temuan")
						->from('notifikasi')	
						->like('id_terkait', 'TEMUAN')
						->where('notif_adum', 'baru')
						->get()->row();
	}

	function notif_adum_temuan()
	{
		return $this->db->select("*, DATE_FORMAT(tgl_tbh, '%d-%m-%Y') as tgl_tb")
						->from('tb_temuan')
						->join('notifikasi', 'notifikasi.id_terkait = CONCAT("TEMUAN_", tb_temuan.id_temuan)')
						->where('notif_adum', 'baru')
						->order_by('tgl_tb', 'desc')
						->get()->result();
	}

	function update_notif_adum_temuan($id)
	{	
		$id_terkaits = 'TEMUAN_' . $id;
		$update_notif = array('notif_adum' => 'lama');
		$this->db->where('id_terkait', $id_terkaits);
		$this->db->update('notifikasi', $update_notif);
	}


	/******* BATAS ADUM *******/
	############################
	
	/******* SEKRETARIS ********/
	#######################
	//--> ambil jumlah keputusan baru
	function jml_notif_sekretaris()
	{
		return $this->db->select("count(*) as jml_tgs")
										->from('notifikasi')	
										->like('id_terkait', 'TGS')
										->where('notif_sekretaris', 'baru')
										->get()->row();
	}

	//--> ambil data keputusan baru
	function notif_sekretaris()
	{
		return $this->db->select("*, DATE_FORMAT(tgl_penugasan, '%d-%m-%Y') as tgl_tgs")
										->from('tb_penugasan')
										->join('notifikasi', 'notifikasi.id_terkait = tb_penugasan.id_tugas')
										->where('notif_sekretaris', 'baru')
										->order_by('tgl_penugasan', 'desc')
										->get()->result();
	}

	//-> ubah status notif keputusan baru
	function update_notif_sekretaris($id)
	{
		$update_notif = array('notif_sekretaris' => 'lama');
		$this->db->where('id_terkait', $id);
		$this->db->update('notifikasi', $update_notif);
	}
	/******* BATAS SEKRETARIS *******/
	##################################

	/******* KETUA TIM ********/
	############################
	//--> ambil jumlah keputusan baru
	function jml_notif_ketua($ketua_tim)
	{
		return $this->db->select("count(*) as jml_tgs")
										->from('notifikasi')
										->join('tb_penugasan', 'tb_penugasan.id_tugas = notifikasi.id_terkait')
										->join('tb_tim', 'tb_tim.id_tim = tb_penugasan.id_tim')
										->where('ketua_tim', $ketua_tim)
										->like('id_terkait', 'TGS')
										->where('notif_ketua_tim', 'baru')
										->get()->row();
	}

	//--> ambil data keputusan baru
	function notif_ketua($ketua_tim)
	{
		return $this->db->select("*, DATE_FORMAT(tgl_penugasan, '%d-%m-%Y') as tgl_tgs")
										->from('tb_penugasan')
										->join('tb_tim', 'tb_tim.id_tim = tb_penugasan.id_tim')
										->join('notifikasi', 'notifikasi.id_terkait = tb_penugasan.id_tugas')
										->where('notif_ketua_tim', 'baru')
										->where('ketua_tim', $ketua_tim)
										->order_by('tgl_penugasan', 'desc')
										->get()->result();
	}

	//--> ambil jumlah keputusan baru
	function jml_notif_ketuaAgr($ketua_tim)
	{
		return $this->db->select("count(*) as jml_agr")
										->from('notifikasi')
										->join('tb_anggaran_waktu', 'tb_anggaran_waktu.id_anggaran_wkt = notifikasi.id_terkait')
										->join('tb_penugasan', 'tb_penugasan.id_tugas = tb_anggaran_waktu.id_tgs')
										->join('tb_tim', 'tb_tim.id_tim = tb_penugasan.id_tim')
										->where('ketua_tim', $ketua_tim)
										->like('id_terkait', 'AGR')
										->where('notif_ketua_tim', 'baru')
										->get()->row();
	}

	//--> ambil data keputusan baru
	function notif_ketuaAgr($ketua_tim)
	{
		return $this->db->select("*, DATE_FORMAT(tgl_agr, '%d-%m-%Y') as tgl_agr")
										->from('tb_anggaran_waktu')
										->join('notifikasi', 'notifikasi.id_terkait = tb_anggaran_waktu.id_anggaran_wkt')
										->join('tb_penugasan', 'tb_penugasan.id_tugas = tb_anggaran_waktu.id_tgs')
										->join('tb_tim', 'tb_tim.id_tim = tb_penugasan.id_tim')										
										->where('notif_ketua_tim', 'baru')
										->where('ketua_tim', $ketua_tim)
										->order_by('tgl_agr', 'desc')
										->get()->result();
	}

	//--> ambil jumlah anggaran baru
	function jml_notif_ketuaPka($ketua_tim)
	{
		return $this->db->select("count(*) as jml_pka")
										->from('notifikasi')
										->join('tb_pka', 'tb_pka.id_pka = notifikasi.id_terkait')
										->join('tb_penugasan', 'tb_penugasan.id_tugas = tb_pka.id_tgs')
										->join('tb_tim', 'tb_tim.id_tim = tb_penugasan.id_tim')
										->where('ketua_tim', $ketua_tim)
										->like('id_terkait', 'PKA')
										->where('notif_ketua_tim', 'baru')
										->get()->row();
	}

	//--> ambil data keputusan baru
	function notif_ketuaPka($ketua_tim)
	{
		return $this->db->select("*, DATE_FORMAT(tgl_pka, '%d-%m-%Y') as tgl_pka")
										->from('tb_pka')
										->join('notifikasi', 'notifikasi.id_terkait = tb_pka.id_pka')
										->join('tb_penugasan', 'tb_penugasan.id_tugas = tb_pka.id_tgs')
										->join('tb_tim', 'tb_tim.id_tim = tb_penugasan.id_tim')										
										->where('notif_ketua_tim', 'baru')
										->where('ketua_tim', $ketua_tim)
										->order_by('tgl_pka', 'desc')
										->get()->result();
	}

	//-> ubah status notif keputusan baru
	function update_notif_ketua($id)
	{
		$update_notif = array('notif_ketua_tim' => 'lama');
		$this->db->where('id_terkait', $id);
		$this->db->update('notifikasi', $update_notif);
	}
	/******* BATAS KETUA TIM *******/
	#################################

	/******* PENGENDALI MUTU ********/
	############################
	//--> ambil jumlah anggaran baru
	function jml_notif_daltu($daltu)
	{
		return $this->db->select("count(*) as jml_agr")
										->from('notifikasi')
										->join('tb_anggaran_waktu', 'tb_anggaran_waktu.id_anggaran_wkt = notifikasi.id_terkait')
										->join('tb_penugasan', 'tb_penugasan.id_tugas = tb_anggaran_waktu.id_tgs')
										->join('tb_tim', 'tb_tim.id_tim = tb_penugasan.id_tim')
										->where('daltu', $daltu)
										->like('id_terkait', 'AGR')
										->where('notif_daltu', 'baru')
										->get()->row();
	}

	//--> ambil data keputusan baru
	function notif_daltu($daltu)
	{
		return $this->db->select("*, DATE_FORMAT(tgl_agr, '%d-%m-%Y') as tgl_agr")
										->from('tb_anggaran_waktu')
										->join('tb_penugasan', 'tb_penugasan.id_tugas = tb_anggaran_waktu.id_tgs')
										->join('tb_tim', 'tb_tim.id_tim = tb_penugasan.id_tim')
										->join('notifikasi', 'notifikasi.id_terkait = tb_anggaran_waktu.id_anggaran_wkt')
										->where('notif_daltu', 'baru')
										->where('daltu', $daltu)
										->order_by('tgl_agr', 'desc')
										->get()->result();
	}

	//--> ambil jumlah anggaran baru
	function jml_notif_daltuPka($daltu)
	{
		return $this->db->select("count(*) as jml_pka")
										->from('notifikasi')
										->join('tb_pka', 'tb_pka.id_pka = notifikasi.id_terkait')
										->join('tb_penugasan', 'tb_penugasan.id_tugas = tb_pka.id_tgs')
										->join('tb_tim', 'tb_tim.id_tim = tb_penugasan.id_tim')
										->where('daltu', $daltu)
										->like('id_terkait', 'PKA')
										->where('notif_daltu', 'baru')
										->get()->row();
	}

	//--> ambil data keputusan baru
	function notif_daltuPka($daltu)
	{
		return $this->db->select("*, DATE_FORMAT(tgl_pka, '%d-%m-%Y') as tgl_pka")
										->from('tb_pka')
										->join('notifikasi', 'notifikasi.id_terkait = tb_pka.id_pka')
										->join('tb_penugasan', 'tb_penugasan.id_tugas = tb_pka.id_tgs')
										->join('tb_tim', 'tb_tim.id_tim = tb_penugasan.id_tim')										
										->where('notif_daltu', 'baru')
										->where('daltu', $daltu)
										->order_by('tgl_pka', 'desc')
										->get()->result();
	}

	//-> ubah status notif keputusan baru
	function update_notif_daltu($id)
	{
		$update_notif = array('notif_daltu ' => 'lama');
		$this->db->where('id_terkait', $id);
		$this->db->update('notifikasi', $update_notif);
	}
	/******* BATAS DALTU *******/
	#############################

	/******* PENGENDALI TEKNIS ********/
	###################################
	//--> ambil jumlah anggaran baru
	function jml_notif_dalnis($dalnis)
	{
		return $this->db->select("count(*) as jml_agr")
										->from('notifikasi')
										->join('tb_anggaran_waktu', 'tb_anggaran_waktu.id_anggaran_wkt = notifikasi.id_terkait')
										->join('tb_penugasan', 'tb_penugasan.id_tugas = tb_anggaran_waktu.id_tgs')
										->join('tb_tim', 'tb_tim.id_tim = tb_penugasan.id_tim')
										->where('dalnis', $dalnis)
										->like('id_terkait', 'AGR')
										->where('notif_dalnis', 'baru')
										->get()->row();
	}

	//--> ambil data keputusan baru
	function notif_dalnis($dalnis)
	{
		return $this->db->select("*, DATE_FORMAT(tgl_agr, '%d-%m-%Y') as tgl_agr")
										->from('tb_anggaran_waktu')
										->join('tb_penugasan', 'tb_penugasan.id_tugas = tb_anggaran_waktu.id_tgs')
										->join('tb_tim', 'tb_tim.id_tim = tb_penugasan.id_tim')
										->join('notifikasi', 'notifikasi.id_terkait = tb_anggaran_waktu.id_anggaran_wkt')
										->where('notif_dalnis', 'baru')
										->where('dalnis', $dalnis)
										->order_by('tgl_agr', 'desc')
										->get()->result();
	}

	//--> ambil jumlah anggaran baru
	function jml_notif_dalnisPka($dalnis)
	{
		return $this->db->select("count(*) as jml_pka")
										->from('notifikasi')
										->join('tb_pka', 'tb_pka.id_pka = notifikasi.id_terkait')
										->join('tb_penugasan', 'tb_penugasan.id_tugas = tb_pka.id_tgs')
										->join('tb_tim', 'tb_tim.id_tim = tb_penugasan.id_tim')
										->where('dalnis', $dalnis)
										->like('id_terkait', 'PKA')
										->where('notif_dalnis', 'baru')
										->get()->row();
	}

	//--> ambil data keputusan baru
	function notif_dalnisPka($dalnis)
	{
		return $this->db->select("*, DATE_FORMAT(tgl_pka, '%d-%m-%Y') as tgl_pka")
										->from('tb_pka')
										->join('notifikasi', 'notifikasi.id_terkait = tb_pka.id_pka')
										->join('tb_penugasan', 'tb_penugasan.id_tugas = tb_pka.id_tgs')
										->join('tb_tim', 'tb_tim.id_tim = tb_penugasan.id_tim')										
										->where('notif_dalnis', 'baru')
										->where('dalnis', $dalnis)
										->order_by('tgl_pka', 'desc')
										->get()->result();
	}

	//-> ubah status notif keputusan baru
	function update_notif_dalnis($id)
	{
		$update_notif = array('notif_dalnis ' => 'lama');
		$this->db->where('id_terkait', $id);
		$this->db->update('notifikasi', $update_notif);
	}
	/******* BATAS DALNIS *******/
	#############################

}