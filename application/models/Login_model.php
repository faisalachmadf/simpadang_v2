<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
 
	function cek_user($username="", $password="")
	{
		$query = $this->db->get_where('tb_user', array('username' => $username, 'password' => base64_encode($password)));
		$query = $query->result_array();
		return $query;
	}

	function get_user($username, $lev)
  {
     	$query = $this->db->get_where('tb_user', array('username' => $username, 'level' => $lev));
     	$query = $query->result_array();
      
      if($query){
          return $query[0];
      }
  }

  function get_pegawai($username)
  {
  	return $this->db->select('*')
  					 				->from('tb_user')
  					 				->join('tb_pegawai', 'tb_pegawai.id_pegawai = tb_user.id_fk')
  					 				->where('username', $username)
  					 				->get()->row();
  }


  function update_level($id, $level)
  {
    $data = array('level' => $level);
    $this->db->where('id_fk', $id)
             ->update('tb_user', $data);
  }

  function get_sub_tim($id_pegawai)
  {
    $this->db->select('*');
    $this->db->from('sub_tim');
    $this->db->where('anggota', $id_pegawai);
    $this->db->limit('1');
    $query = $this->db->get();
    return $query->result_array();
  }

  function get_tim_ketua($id_pegawai)
  {
    $this->db->select('*');
    $this->db->from('tb_tim');
    $this->db->where_in('ketua_tim', $id_pegawai);
    $this->db->where_in('kategori_tim', 'Tim Pemeriksa');
    $this->db->limit('1');
    $query = $this->db->get();
    return $query->result_array();
  }

  function get_tl_ketua($id_pegawai)
  {
    $this->db->select('*');
    $this->db->from('tb_tim');
    $this->db->where_in('ketua_tim', $id_pegawai);
    $this->db->where_in('kategori_tim', 'Tim Tindak Lanjut');
    $this->db->limit('1');
    $query = $this->db->get();
    return $query->result_array();
  }

  function get_nd_ketua($id_pegawai)
  {
    $this->db->select('*');
    $this->db->from('tb_tim');
    $this->db->where_in('ketua_tim', $id_pegawai);
    $this->db->where_in('kategori_tim', 'Tim Nota Dinas');
    $this->db->limit('1');
    $query = $this->db->get();
    return $query->result_array();
  }

  function get_anggota_tl($id_pegawai)
  {
    $this->db->select('*');
    $this->db->from('sub_tim as sb');
    $this->db->join('tb_tim as tim', 'tim.id_tim = sb.sub_id_tim');
    $this->db->where('sb.anggota', $id_pegawai);
    $this->db->where('tim.kategori_tim', 'Tim Tindak Lanjut');
    $query = $this->db->get();
    return $query->result_array();
  }

}