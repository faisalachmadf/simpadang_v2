<?php

class Instansi_m extends CI_Model
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
	
	function get_desa($id)
	{
		$output = "<option> -- Pilih Desa -- </option>";
		$desa   = $this->db->select('*')
										  ->from('sub_instansi')
										  ->where('sub_id_instansi', $id)
										  ->order_by('nama_desa', 'asc')		  
										  ->get()->result();

		foreach($desa as $row)
		{			
			$output .= "<option value='$row->nama_desa'> $row->nama_desa </option>";
		}
		return $output;
	}

	//--> ambil semua data instansi
	function get_all_instansi()
	{
		return $this->db->select('*')
										->from('tb_instansi')
										->get()->result();
	}

	function get_all_desa()
	{
		return $this->db->select('*')
		->from('sub_instansi')
		->get()->result();
	}

	//--> ambil semua data instansi
	function get_detail_desa($id)
	{
		return $this->db->select('*')
										->from('sub_instansi')
										->where('sub_id_instansi', $id)								  
										->get()->result();
	}

	function get_row_kecamatan($id)
	{
		return $this->db->select('*')
										->from('tb_instansi')
										->where('id_instansi', $id)
										->get()->row();
	}
	
	function get_row_desa($id, $id2)
	{
		return $this->db->select('*')
										->from('sub_instansi')
										->join('tb_instansi', 'tb_instansi.id_instansi = sub_instansi.sub_id_instansi')
										->where('id', $id)
										->get()->row();
	}
	
	//--> tambah kecamatan
	function insert_kecamatan()
	{
		$id      = $this->input->post('id_instansi');
		$jml_des = $this->input->post('jml_desa')-1;
		$desa    = $this->input->post('nama_desa');

		//--> tambah tb_instansi
		$data_kecamatan = array(
				'id_instansi'    => $id,
				'nama_kecamatan' => $this->input->post('nama_kecamatan')
			);
		$this->db->insert('tb_instansi', $data_kecamatan);

		//--> tambah desa
		$i = 0;
		while($i < $jml_des)
		{
			$data_desa = array(
				'sub_id_instansi' => $id,
				'nama_desa'       => $desa[$i]
			);
			$this->db->insert('sub_instansi', $data_desa);

			$i++;
		}
	}

	//--> tambah desa
	function insert_desa()
	{
		$id      = $this->input->post('kecamatan');
		$jml_des = $this->input->post('jml_desa')-1;
		$desa    = $this->input->post('nama_desa');

		//--> tambah desa
		$i = 0;
		while($i < $jml_des)
		{
			$data_desa = array(
				'sub_id_instansi' => $id,
				'nama_desa'       => $desa[$i]
			);
			$this->db->insert('sub_instansi', $data_desa);

			$i++;
		}
	}
	
	//--> ubah instansi kecamatan
	function update_kecamatan($id_kecamatan)
	{
		//--> ubah sub_instansi
		$data_instansi = array(
				'nama_kecamatan' => $this->input->post('nama_kecamatan')
			);
		$this->db->where('id_instansi', $id_kecamatan)
						 ->update('tb_instansi', $data_instansi);
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
	function delete_kecamatan($id)
	{
		//--> hapus data kecamatan
		$this->db->delete('tb_instansi', array('id_instansi' => $id));
		//--> hapus data desa
		$this->db->delete('sub_instansi', array('sub_id_instansi' => $id));

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