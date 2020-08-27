<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('login_model');
		$this->auth->cek_auth(); //--> ambil auth dari library

		//--> hak akses
		$hak_akses = $this->session->userdata('lvl');
		if($hak_akses!='ketua_tim' && $hak_akses!='anggota_tim' && $hak_akses!='ketua_tl' && $hak_akses!='anggota_tl' && $hak_akses!='ketua_nd')
		{
			echo "<script>alert('Anda tidak berhak mengakses halaman ini!!');</script>";
			redirect('log_in','refresh');
			exit();
		}
		// ./hak akses

		$this->load->model('pegawai_m');
	}

	public function index()
	{
		$get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));

		$ag = $this->login_model->get_pegawai($this->session->userdata('username'));

		$data = array(
			'user'   	=> $get_akun,
	        'title'		=> 'Homepkpt',
	        'anggota'   => $this->login_model->get_sub_tim($ag->id_pegawai),
	        'anggota_tl'=> $this->login_model->get_anggota_tl($ag->id_pegawai),
	        'ketua'     => $this->login_model->get_tim_ketua($ag->id_pegawai),
	        'ketua_tl'  => $this->login_model->get_tl_ketua($ag->id_pegawai),
	        'ketua_nd'  => $this->login_model->get_nd_ketua($ag->id_pegawai),
	        
		);

		//print "<pre>"; print_r($data); exit;
		

		$this->load->view('home', $data);
	}

	public function get($level)
	{
		$get_akun = $this->login_model->get_user($this->session->userdata('username'));

		$ag = $this->login_model->get_pegawai($this->session->userdata('username'));

		$this->login_model->update_level($ag->id_pegawai, $level);

		$this->session->unset_userdata('lvl');

		$this->session->set_userdata('lvl', $level);

		$stat = $this->session->userdata('lvl');
      
		if($stat=='ketua_tim')
		{
			redirect('ketua_tim/home');
		}
		elseif($stat=='anggota_tim')
		{
			redirect('anggota_tim/home');
		}
		elseif($stat=='ketua_tl')
		{
			redirect('ketua_tl/home');
		}
		elseif($stat=='anggota_tl')
		{
			redirect('anggota_tl/home');
		}
		elseif($stat=='ketua_nd')
		{
			redirect('ketua_nd/home');
		}
		else
		{
			redirect('home');
		}
		
	}


	
}
