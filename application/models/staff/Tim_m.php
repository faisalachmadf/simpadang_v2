<?php

class Tim_m extends CI_Model
{

    public function __construct()
    {
		parent::__construct();
	}

	//--> Mengecek id terakhir tb_tim
	function get_id_max_tim()
	{
		/*$kode 	= "TIM";
		$sql  	= "SELECT max(id_tim) as max_id FROM tb_tim";
		$row  	= $this->db->query($sql)->row();
		$max_id = $row->max_id;
		$max_no = substr($max_id,3);
		$new_no = $max_no + 5;
		$id 		= $kode.$new_no;
		return $id;*/
		return "TIM_". md5(date("dmYHis")."_".round(microtime(true) * 1000));
	}

	//--> ambil sub tim pemeriksa
	function count_agt($id_tim)
	{
		return $this->db->select('count(anggota) as jml')
										->from('sub_tim')
										->where('sub_id_tim', $id_tim)
										->where('anggota !=', NULL)
										->get()->row();
	}

	//--> ambil semua data tim
	function get_all_tim()
	{
		return $this->db->select('*')
										->from('tb_tim')
										->order_by('id_tim', 'desc')
										->get()->result();
	}

	//--> ambil tim pemeriksa tertentu
	function get_row_tim($id_tim)
	{
		return $this->db->select('*')
										->from('tb_tim')
										->where('id_tim', $id_tim)
										->get()->row();
	}

	//--> ambil sub tim pemeriksa
	function get_sub_tim($id_tim)
	{
		return $this->db->select('*')
										->from('sub_tim')
										->join('tb_pegawai', 'tb_pegawai.id_pegawai = sub_tim.anggota')
										->where('sub_id_tim', $id_tim)
                                        ->order_by('nomor','asc')
										->get()->result();
	}

	//--> ambil sub sasaran dari surat tugas
	function get_sub_sasaran($id_tim)
	{
		return $this->db->select('*')
										->from('sub_tim')
										->where('sub_id_tim', $id_tim)
										->where('sasaran !=', NULL)
                                        ->order_by('nomor','asc')
										->get()->result();
	}

	//--> jumlah sasaran tim pemeriksa
	function get_jum_sasaran($id_tim)
	{
		return $this->db->select('count(sasaran) as jml')
										->from('sub_tim')
										->where('sub_id_tim', $id_tim)
										->where('sasaran !=', NULL)
										->get()->row();
	}

	//--> jumlah anggota tim
	function get_jum_anggota_tim($id_tim)
	{
		return $this->db->select('count(anggota) as jml')
										->from('sub_tim')
										->where('sub_id_tim', $id_tim)
										->where('anggota !=', NULL)
										->get()->row();
	}

	function get_all_pegawai()
	{
		return $this->db->select('*')
										->from('tb_pegawai')
										->where('jabatan !=', 'Inspektur')
										->where('status_pegawai', 'aktif')
										->get()->result();
	}

	function get_periksa_dalnis()
	{
		$jbtn = array('Pengendali Teknis', '-');

		return $this->db->select('*')
										->from('tb_pegawai')
										->where_in('jabatan_tim', $jbtn)
										->get()->result();
	}

	function get_pegawai()
	{
		return $this->db->select('*')
										->from('tb_pegawai')
										->where('jabatan !=', 'Inspektur')
										/*
										040919
										->where('jabatan_tim', '-')
										*/
										->where('status_pegawai', 'aktif')
										->get()->result();
	}

	//--> ambil inspektur
	function get_inspektur()
	{
		return $this->db->select('*')
										->from('tb_pegawai')
										->where('jabatan', 'Inspektur')
										->get()->row();
	}

	//--> ambil semua nama pengendali teknis (dalnis)
	function get_irban()
	{
		/*$jbtn = array(
							'Inspektur',
							'Inspektur Pembantu Wilayah I',
							'Inspektur Pembantu Wilayah II',
							'Inspektur Pembantu Wilayah III'
						);*/

		//$jbtn = array('Inspektur', 'Pengendali Mutu');

		return $this->db->select('*')
										->from('tb_pegawai')
										->where('jabatan_tim', 'Pengendali Mutu')
										->where('status_pegawai', 'aktif')
										->order_by('jabatan', 'asc')
										->get()->result();
	}

	//--> ambil semua nama pengendali teknis (dalnis)
	function get_dalnis()
	{
		return $this->db->select('*')
										->from('tb_pegawai')
										->where('jabatan_tim', 'Pengendali Teknis')
										->where('status_pegawai', 'aktif')
										->order_by('nama', 'asc')
										->get()->result();
	}

	//--> ambil semua nama ketua tim
	function get_ketua_tim()
	{
		return $this->db->select('*')
										->from('tb_pegawai')
										->where('jabatan_tim', 'Ketua Tim')
										->where('status_pegawai', 'aktif')
										->order_by('nama', 'asc')
										->get()->result();
	}

	//--> ambil semua nama anggota
	function get_anggota()
	{
		return $this->db->select('*')
										->from('tb_pegawai')
										->where('jabatan_tim', 'Anggota Tim')
										->where('status_pegawai', 'aktif')
										->order_by('nama', 'asc')
										->get()->result();
	}

	//--> tambah tim pemeriksa
	/*function insert_tim_pemeriksa()
	{
		$jenis_tim = $this->input->post('jenis_tim');

		$kon_dalnis = $this->input->post('stat_dalnis');
		if($kon_dalnis == "ya")
		{
			$dalnis = $this->input->post('dalnis');
		}
		else
		{
			$dalnis = NULL;
		}

		//--> tambah tb_tim
		$data_tim = array(
				'id_tim'       => $this->input->post('id_tim'),
				'ketua_tim'    => $this->input->post('ketua_tim'),
				'dalnis'       => $dalnis,
				'kategori_tim' => $jenis_tim
			);
		$this->db->insert('tb_tim', $data_tim);

		$jum_agt = $this->input->post('jml_agt')-1;
		$anggota = $this->input->post('anggota');
		$kon_sas = $this->input->post('kondisi_sasaran');
		$jum_ins = $this->input->post('jml_ins')-1;

		if($kon_sas == "input")
		{
			$sasaran = $this->input->post('sasaran_input');
		}
		else
		{
			$sasaran = $this->input->post('sasaran');
		}

		//--> cek kondisi jumlah anggota dan jumlah sasaran
				# digunakan untuk jumlah pengulangan insert anggota dan sasaran
		if($jum_agt < $jum_ins)
		{
			$jml = $jum_ins;
		}
		elseif($jum_agt > $jum_ins)
		{
			$jml = $jum_agt;
		}
		else
		{
			$jml = $jum_agt;
		}

		$i=0;
		while($i < $jml)
		{
			//--> tambah sub_tim
			$data_sub_tim = array(
					'sub_id_tim' => $this->input->post('id_tim'),
					'nomor'      => $i+1,
					'anggota'    => $anggota[$i],
					'sasaran'    => $sasaran[$i]
				);
			$this->db->insert('sub_tim', $data_sub_tim);

			$i++;
		}

	}*/

	//--> ubah instansi
	/*function update_instansi($id_instansi)
	{
		//--> ubah tb_instansi
		$data_instansi = array(
				'nama_instansi'   => $this->input->post('nama_instansi'),
				'kategori'        => $this->input->post('kategori'),
				'alamat_instansi' => $this->input->post('alamat_instansi')
			);
		$this->db->where('id_instansi', $id_instansi)
						 ->update('tb_instansi', $data_instansi);
	}*/

	//-- hapus data tim
	/*function delete_tim($id_tim)
	{
		//--> hapus data tim
		$this->db->delete('tb_tim', array('id_tim' => $id_tim));
		$this->db->delete('sub_tim', array('sub_id_tim' => $id_tim));

		$get = $this->db->get_where('tb_surat', array('fk_tim' => $id_tim))->row();

		//--> hapus data surat
		$this->db->delete('tb_surat', array('no_surat' => $get->no_surat));
		$this->db->delete('sub_surat', array('sub_no_surat' => $get->no_surat));

 		return true;
	}*/

}
