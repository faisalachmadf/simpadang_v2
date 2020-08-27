<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tindak_lanjut extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('login_model');
		$this->auth->cek_auth(); //--> ambil auth dari library

		//--> load model
		$this->load->model('notifikasi_m');
		$this->load->model('staff/tindak_lanjut_m');
		$this->load->model('staff/penugasan_m');
		$this->load->model('staff/tim_m');
		$this->load->model('staff/surat_m');
		$this->load->model('staff/instansi_m');

		//--> hak akses
		$hak_akses = $this->session->userdata('lvl');
		if($hak_akses!='staff')
		{
			echo "<script>alert('Anda tidak berhak mengakses halaman ini!!');</script>";
			redirect('log_in','refresh');
			exit();
		}
		// ./hak akses
	}

	//--> list penugasan
	public function index()
	{
		$get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));

		$data = array(
				'user'     	=> $get_akun,
        'level'	   	=> $get_akun,
        'jml_notif' => $this->notifikasi_m->jml_notif_staff(),
        'notif'		 	=> $this->notifikasi_m->notif_staff(),
        'title'		 	=> 'Tindak Lanjut [STAFF ADMINISTRASI]',
				'tl' 	 			=> $this->tindak_lanjut_m->get_tl()
			);

		$this->load->view('staff/tindak_lanjut/list_tl', $data);
	}

	//--> detail penugasan
	public function detail_tl($id_tl, $id_tim)
	{
		$get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));

		$key  = base64_decode($id_tl);
		$key2 = base64_decode($id_tim);

		//-> update notif penugasan
		//$this->notifikasi_m->update_notif_staff($key);

		$cek = $this->db->get_where('tb_tindak_lanjut', array('id_tl' => $key))->row();

		$tgl_tl    = date('d', strtotime($cek->tgl_tl)) ." ".
							 get_nama_bulan(date('m', strtotime($cek->tgl_tl))) ." ".
							 date('Y', strtotime($cek->tgl_tl));

		$cek2 = $this->db->get_where('tb_surat', array('fk_tim' => $key2))->row();
		$tgl_surat = date('d', strtotime($cek2->tgl_surat)) ." ".
							 get_nama_bulan(date('m', strtotime($cek2->tgl_surat))) ." ".
							 date('Y', strtotime($cek2->tgl_surat));

		$tgl_awal	 = date('d', strtotime($cek2->tgl_awal)) ." ".
							 get_nama_bulan(date('m', strtotime($cek2->tgl_awal))) ." ".
							 date('Y', strtotime($cek2->tgl_awal));

		$tgl_akhir = date('d', strtotime($cek2->tgl_akhir)) ." ".
							 get_nama_bulan(date('m', strtotime($cek2->tgl_akhir))) ." ".
							 date('Y', strtotime($cek2->tgl_akhir));

		$penugasan = $this->tindak_lanjut_m->get_row_tl($key);		
		$ketua_tim = $this->db->get_where('tb_pegawai', array('id_pegawai' => $penugasan->ketua_tim))->row();

		$data = array(
				'user'      => $get_akun,
				'level'     => $get_akun,
				'jml_notif' => $this->notifikasi_m->jml_notif_staff(),
        		'notif'		=> $this->notifikasi_m->notif_staff(),
				'title'     => 'Tindak Lanjut [STAFF ADMINISTRASI]',
				'data'      => $penugasan,
				'ketua_tim'	=> $ketua_tim,
				'tgl_tl'    => $tgl_tl,
				'tim'      	=> $this->tim_m->get_sub_tim($key2),
				'tgl_surat' => $tgl_surat,
				'tgl_awal'	=> $tgl_awal,
				'tgl_akhir'	=> $tgl_akhir,
				'cek_rev' 	=> $this->tindak_lanjut_m->cek_reviu($key),
				'data_rev'  => $this->tindak_lanjut_m->get_rev_tl($key)
			);

		$this->load->view('staff/tindak_lanjut/detail_tl', $data);
	}

	//--> detail penugasan
	public function detail_reviu($id_tl, $no_rev)
	{
		$get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));

		$key  = base64_decode($id_tl);
		$key2 = base64_decode($no_rev);

		$cek = $this->db->get_where('rev_tindak_lanjut', array('rev_tl' => $key, 'rev_ke' => $key2))->row();
		$tgl_tugas = date('d', strtotime($cek->rev_tgl_tl)) ." ".
							 get_nama_bulan(date('m', strtotime($cek->rev_tgl_tl))) ." ".
							 date('Y', strtotime($cek->rev_tgl_tl));

		$tgl_awal	 = date('d', strtotime($cek->rev_tgl_awal)) ." ".
							 get_nama_bulan(date('m', strtotime($cek->rev_tgl_awal))) ." ".
							 date('Y', strtotime($cek->rev_tgl_awal));

		$tgl_akhir = date('d', strtotime($cek->rev_tgl_akhir)) ." ".
							 get_nama_bulan(date('m', strtotime($cek->rev_tgl_akhir))) ." ".
							 date('Y', strtotime($cek->rev_tgl_akhir));

		$ketua_tim = $this->db->get_where('tb_pegawai', array('id_pegawai' => $cek->rev_ketua_tim))->row();

		$get_tim = $this->db->select('*')
		                    ->from('rev_penugasan2')
		                    ->join('tb_pegawai', 'tb_pegawai.id_pegawai = rev_penugasan2.rev_anggota')
		                    ->where('rev_tugas2', $cek->rev_id_tim)
		                    ->where('rev_ke', $key2)
		                    ->get()->result();

		$data = array(
				'user'      => $get_akun,
				'level'     => $get_akun,
				'jml_notif' => $this->notifikasi_m->jml_notif_staff(),
        'notif'		 	=> $this->notifikasi_m->notif_staff(),
				'title'     => 'Tindak Lanjut [STAFF ADMINISTRASI]',
				'data'      => $cek,
				'ketua_tim'	=> $ketua_tim,
				'tgl_tugas' => $tgl_tugas,
				//'tgl_kep'		=> $tgl_kep,
				'tim'      	=> $get_tim,
				'tgl_surat' => $tgl_tugas,
				'tgl_awal'	=> $tgl_awal,
				'tgl_akhir'	=> $tgl_akhir
			);

		$this->load->view('staff/tindak_lanjut/detail_reviu', $data);
	}

	//--> tambah tindak lanjut
	public function tambah_tl($id_tgs)
	{
		$get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));

		$key = base64_decode($id_tgs);

		$nu = $this->surat_m->get_no_urut();
		$no_urut = $nu->no_urut + 1;

		//--> nomor urut surat tugas
		if ($no_urut == 1)
		{	$no = "01";	}
		elseif ($no_urut == 2)
		{ $no = "02"; }
		elseif ($no_urut == 3)
		{ $no = "03"; }
		elseif ($no_urut == 4)
		{ $no = "04"; }
		elseif ($no_urut == 5)
		{ $no = "05"; }
		elseif ($no_urut == 6)
		{ $no = "06"; }
		elseif ($no_urut == 7)
		{ $no = "07"; }
		elseif ($no_urut == 8)
		{ $no = "08"; }
		elseif ($no_urut == 9)
		{ $no = "09"; }
		else { $no = $no_urut; }

		/*$tgl = date('d') ." ". get_nama_bulan(date('m')) ." ". date('Y');*/
		$tgl = date('Y-m-d');

		$data_tgs = $this->penugasan_m->get_row_penugasan($key);

		$data = array(
			'user'    	=> $get_akun,
			'level'	  	=> $get_akun,
			'title'			=> 'Tindak Lanjut [STAFF ADMINISTRASI]',
			'tgs'       => $data_tgs,
			'id_tgs'		=> $key,
			'id_tl' 		=> $this->tindak_lanjut_m->get_id_max_tl(),
			'id_tim' 		=> $this->tim_m->get_id_max_tim(),
			'dalnis'		=> $this->tim_m->get_pegawai(),
			'pegawai'		=> $this->tim_m->get_pegawai(),
			'tgl' 			=> $tgl,
       		//'kecamatan' => $this->instansi_m->get_all_instansi(),
			'no_urut'		=> $no_urut,
			'no_surat'	=> $no ."-INSPT/". date('Y'),
			'dasar'			=> $this->surat_m->get_dasar(),
			'max_tbs'		=> $this->surat_m->get_max_tbs(),
			'tembusan'	=> $this->surat_m->get_tembusan(),
			'sasaran'   => $this->tim_m->get_sub_sasaran($data_tgs->id_tim)
			);

		$this->load->view('staff/tindak_lanjut/form_tambah_tl', $data);

		//--> jika form submit
		if($this->input->post('submit'))
		{
			//print "<pre>"; print_r($_POST); die;

			$key  = base64_encode($this->input->post('id_tl'));
			$key2 = base64_encode($this->input->post('id_tim'));

			$this->tindak_lanjut_m->insert_tl();

			//--> Tampilkan notifikasi berhasil ubah
			echo $this->session->set_flashdata('sukses',
					 "<div class='alert alert-block alert-success'>
							<button type='button' class='close' data-dismiss='alert'>
								<i class='ace-icon fa fa-times'></i>
							</button>

							<p>
								<strong>
									<i class='ace-icon fa fa-check'></i>
									Berhasil Tambah Tindak Lanjut!
								</strong>
								Data tindak lanjut telah ditambahkan, cek data tersebut di bawah ini.
							</p>
						</div>"
				);

			redirect('staff/tindak_lanjut/detail_tl/'.$key.'/'.$key2);
		}
	}

	//--> tambah penugasan
	public function reviu_tl($id_tl, $id_tim)
	{
		$get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));

		$key  = base64_decode($id_tl);
		$key2 = base64_decode($id_tim);

		$cek = $this->db->get_where('tb_tindak_lanjut', array('id_tl' => $key))->row();

		$tgl_tl = date('d', strtotime($cek->tgl_tl)) ." ".
							 get_nama_bulan(date('m', strtotime($cek->tgl_tl))) ." ".
							 date('Y', strtotime($cek->tgl_tl));

		$tgl_kep 	 = date('d', strtotime($cek->tgl_persetujuan)) ." ".
							 get_nama_bulan(date('m', strtotime($cek->tgl_persetujuan))) ." ".
							 date('Y', strtotime($cek->tgl_persetujuan));

		$cek2 = $this->db->get_where('tb_surat', array('fk_tim' => $key2))->row();
		$tgl_surat = date('d', strtotime($cek2->tgl_surat)) ." ".
							 get_nama_bulan(date('m', strtotime($cek2->tgl_surat))) ." ".
							 date('Y', strtotime($cek2->tgl_surat));

		$tgl_awal	 = date('d', strtotime($cek2->tgl_awal)) ." ".
							 get_nama_bulan(date('m', strtotime($cek2->tgl_awal))) ." ".
							 date('Y', strtotime($cek2->tgl_awal));

		$tgl_akhir = date('d', strtotime($cek2->tgl_akhir)) ." ".
							 get_nama_bulan(date('m', strtotime($cek2->tgl_akhir))) ." ".
							 date('Y', strtotime($cek2->tgl_akhir));

		$penugasan = $this->tindak_lanjut_m->get_row_tl($key);	
		$ketua_tim = $this->db->get_where('tb_pegawai', array('id_pegawai' => $penugasan->ketua_tim))->row();

		$data = array(
			'user'      => $get_akun,
			'level'     => $get_akun,
			'jml_notif' => $this->notifikasi_m->jml_notif_staff(),
			'notif'		 	=> $this->notifikasi_m->notif_staff(),
			'title'     => 'Tindak Lanjut [STAFF ADMINISTRASI]',
			'irban'    	=> $this->tim_m->get_irban(),
			'pegawai'		=> $this->tim_m->get_all_pegawai(),
				//'kecamatan' => $this->instansi_m->get_all_instansi(),
			'data'      => $penugasan,
			'ketua_tim'	=> $ketua_tim,
			'tgl_tl'    => $tgl_tl,
			'tgl_kep'		=> $tgl_kep,
			'tim'      	=> $this->tim_m->get_sub_tim($key2),
			'jml_agt'		=> $this->tim_m->count_agt($key2),
				//'sasaran'   => $this->tim_m->get_sub_sasaran($key2),
				//'jml_sas'		=> $this->tim_m->get_jum_sasaran($key2),
			'tembusan'	=> $this->surat_m->get_sub_surat($cek2->no_surat),
			'jml_tbs'		=> $this->surat_m->count_tbs($cek2->no_surat),
			'rev_ke'	  => $this->tindak_lanjut_m->cek_rev_tl($key),
			'tgl_surat' => $tgl_surat,
			'tgl_awal'	=> $tgl_awal,
			'tgl_akhir'	=> $tgl_akhir,
		);

		//print "<pre>"; print_r($data); die;

		$this->load->view('staff/tindak_lanjut/form_reviu_tl', $data);

		//--> jika form submit
		if($this->input->post('submit'))
		{
			//print "<pre>"; print_r($_POST); die;

			$key  = base64_encode($this->input->post('id_tl'));
			$key2 = base64_encode($this->input->post('id_tim'));

			$this->tindak_lanjut_m->reviu_tl();

			//--> Tampilkan notifikasi berhasil ubah
			echo $this->session->set_flashdata('sukses',
					 "<div class='alert alert-block alert-success'>
							<button type='button' class='close' data-dismiss='alert'>
								<i class='ace-icon fa fa-times'></i>
							</button>

							<p>
								<strong>
									<i class='ace-icon fa fa-check'></i>
									Berhasil Reviu Tindak Lanjut!
								</strong>
								Data reviu tindak lanjut telah ditambahkan, cek data tersebut di bawah ini.
							</p>
						</div>"
				);

			redirect('staff/tindak_lanjut/detail_tl/'.$key.'/'.$key2);
		}
	}

	public function get_no_surat_baru() {
        $no_surat = $_POST['no_surat'];
        $cek = $this->db->get_where('tb_surat', array('no_surat' => $no_surat))->result_array();        
        if (count($cek) > 0) {
            $no_urut = 0;
            $nu = $this->surat_m->get_no_urut();
            $no_urut = $nu->no_urut + 1;
            //--> nomor urut surat tugas
            if ($no_urut == 1) {
                $no = "01";
            } elseif ($no_urut == 2) {
                $no = "02";
            } elseif ($no_urut == 3) {
                $no = "03";
            } elseif ($no_urut == 4) {
                $no = "04";
            } elseif ($no_urut == 5) {
                $no = "05";
            } elseif ($no_urut == 6) {
                $no = "06";
            } elseif ($no_urut == 7) {
                $no = "07";
            } elseif ($no_urut == 8) {
                $no = "08";
            } elseif ($no_urut == 9) {
                $no = "09";
            } else {
                $no = $no_urut;
            }
//            echo json_encode(FALSE);
            echo json_encode(array('status'=>FALSE,'no'=>'705/ST-'.$no . "-INSPT/" . date('Y')));
        } else {
            echo json_encode(TRUE);
        }
    }
    public function get_no_surat() {
        $no_surat = $_POST['no_surat'];
        $cek = $this->db->get_where('tb_surat', array('no_surat' => $no_surat))->result_array();        
        if (count($cek) > 0) {
            
            echo json_encode(FALSE);
//            echo json_encode(array('status'=>FALSE,'no'=>'705/ST-'.$no . "-INSPT/" . date('Y')));
        } else {
            echo json_encode(TRUE);
        }
    }

    //--> tambah tindak lanjut
	public function tambah_tl2()
	{
		$get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));

		$nu = $this->surat_m->get_no_urut();
		$no_urut = $nu->no_urut + 1;

		//--> nomor urut surat tugas
		if ($no_urut == 1)
		{	$no = "01";	}
		elseif ($no_urut == 2)
		{ $no = "02"; }
		elseif ($no_urut == 3)
		{ $no = "03"; }
		elseif ($no_urut == 4)
		{ $no = "04"; }
		elseif ($no_urut == 5)
		{ $no = "05"; }
		elseif ($no_urut == 6)
		{ $no = "06"; }
		elseif ($no_urut == 7)
		{ $no = "07"; }
		elseif ($no_urut == 8)
		{ $no = "08"; }
		elseif ($no_urut == 9)
		{ $no = "09"; }
		else { $no = $no_urut; }

		/*$tgl = date('d') ." ". get_nama_bulan(date('m')) ." ". date('Y');*/
		$tgl = date('Y-m-d');

		$data = array(
			'user'    		=> $get_akun,
			'level'	  		=> $get_akun,
			'title'			=> 'Tindak Lanjut [STAFF ADMINISTRASI]',
			'id_tl' 		=> $this->tindak_lanjut_m->get_id_max_tl(),
			'id_tim' 		=> $this->tim_m->get_id_max_tim(),
			'dalnis'		=> $this->tim_m->get_pegawai(),
			'pegawai'		=> $this->tim_m->get_pegawai(),
			'tgl' 			=> $tgl,
        //'kecamatan' => $this->instansi_m->get_all_instansi(),
			'no_urut'		=> $no_urut,
			'no_surat'		=> $no ."-INSPT/". date('Y'),
			'dasar'			=> $this->surat_m->get_dasar(),
			'max_tbs'		=> $this->surat_m->get_max_tbs(),
			'tembusan'		=> $this->surat_m->get_tembusan(),
			'temuan'   		=> $this->tindak_lanjut_m->get_temuan(),
			'tl'   			=> $this->tindak_lanjut_m->get_temuan_in_tl()
		);

		//print "<pre>"; print_r($data); exit;

		$this->load->view('staff/tindak_lanjut/form_tambah_tl2', $data);

		//--> jika form submit
		if($this->input->post('submit'))
		{
			//print "<pre>"; print_r($_POST); die;

			$key  = base64_encode($this->input->post('id_tl'));
			$key2 = base64_encode($this->input->post('id_tim'));

			$this->tindak_lanjut_m->insert_tl4();

			//--> Tampilkan notifikasi berhasil ubah
			echo $this->session->set_flashdata('sukses',
					 "<div class='alert alert-block alert-success'>
							<button type='button' class='close' data-dismiss='alert'>
								<i class='ace-icon fa fa-times'></i>
							</button>

							<p>
								<strong>
									<i class='ace-icon fa fa-check'></i>
									Berhasil Tambah Penugasan Tindak Lanjut!
								</strong>
								Data tindak lanjut telah ditambahkan, cek data tersebut di bawah ini.
							</p>
						</div>"
				);

			redirect('staff/tindak_lanjut/detail_tl/'.$key.'/'.$key2);
		}
	}

}