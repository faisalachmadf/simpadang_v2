<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Temuan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('login_model');
		$this->auth->cek_auth();

		$this->load->model('notifikasi_m');
		$this->load->model('staff/tindak_lanjut_m');
		$this->load->model('staff/penugasan_m');
        $this->load->model('staff/tim_m');
        $this->load->model('staff/surat_m');
        $this->load->model('staff/instansi_m');

		$hak_akses = $this->session->userdata('lvl');
		if($hak_akses!='staff')
		{
			echo "<script>alert('Anda tidak berhak mengakses halaman ini!!');</script>";
			redirect('log_in','refresh');
			exit();
		}
	}

	public function index()
	{
		$get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));
		$kt = $this->login_model->get_pegawai($this->session->userdata('username'));

		$data = array(
			'user'        	=> $get_akun,
			'level'       	=> $get_akun,
			'jml_notif' => $this->notifikasi_m->jml_notif_staff(),
            'notif' => $this->notifikasi_m->notif_staff(),
			'title'        	=> 'TINDAK LANJUT [Staff Evaluasi dan Pelaporan]',
			'tl'			=> $this->tindak_lanjut_m->get_data_temuan_status_usulan_true()
		);

		//print "<pre>"; print_r($this->tindak_lanjut_m->get_tl($kt->id_pegawai)); die;

		$this->load->view('staff/temuan/list_temuan', $data);
	}

	public function detail_temuan($id_temuan)
	{
		$get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));

		$kt = $this->login_model->get_pegawai($this->session->userdata('username'));

		$data = array(
			'user'          => $get_akun,
			'level'         => $get_akun,
			'jml_notif' => $this->notifikasi_m->jml_notif_staff(),
            'notif' => $this->notifikasi_m->notif_staff(),
			'title'			=> 'Detail Temuan [Staff Evaluasi dan Pelaporan]',

			'kt101'     => $this->tindak_lanjut_m->get_count_kode_temuan($id_temuan, '101'),
            'kt102'     => $this->tindak_lanjut_m->get_count_kode_temuan($id_temuan, '102'),
            'kt103'     => $this->tindak_lanjut_m->get_count_kode_temuan($id_temuan, '103'),
            'kt104'     => $this->tindak_lanjut_m->get_count_kode_temuan($id_temuan, '104'),
            'kt105'     => $this->tindak_lanjut_m->get_count_kode_temuan($id_temuan, '105'),
            'kt201'     => $this->tindak_lanjut_m->get_count_kode_temuan($id_temuan, '201'),
            'kt202'     => $this->tindak_lanjut_m->get_count_kode_temuan($id_temuan, '202'),
            'kt203'     => $this->tindak_lanjut_m->get_count_kode_temuan($id_temuan, '203'),
            'kt301'     => $this->tindak_lanjut_m->get_count_kode_temuan($id_temuan, '301'),
            'kt302'     => $this->tindak_lanjut_m->get_count_kode_temuan($id_temuan, '302'),
            'kt303'     => $this->tindak_lanjut_m->get_count_kode_temuan($id_temuan, '303'),

            'jml_kt'    => $this->tindak_lanjut_m->get_count_kode_temuan_jml($id_temuan),
            'aspek_spi' => $this->tindak_lanjut_m->get_count_aspek($id_temuan, 'spi'),
            'aspek_e3'  => $this->tindak_lanjut_m->get_count_aspek($id_temuan, 'e3'),
            'aspek_kepatuhan' => $this->tindak_lanjut_m->get_count_aspek($id_temuan, 'kepatuhan'),

            'jml_1'     => $this->tindak_lanjut_m->get_count_status_tl($id_temuan, '1'),
            'jml_2'     => $this->tindak_lanjut_m->get_count_status_tl($id_temuan, '2'),
            'jml_3'     => $this->tindak_lanjut_m->get_count_status_tl($id_temuan, '3'),
            'jml_0'     => $this->tindak_lanjut_m->get_count_status_tl($id_temuan, '0'),

			'temuan'	=> $this->tindak_lanjut_m->get_detail_temuan($id_temuan),
			'aspek'		=> $this->tindak_lanjut_m->get_detail_aspek($id_temuan),
			'temuan_rekomendasi' => $this->tindak_lanjut_m->get_detail_temuan_rekomendasi($id_temuan),
			'tl'		=> $this->tindak_lanjut_m->get_tl_by_temuan($id_temuan),
		);

		$this->load->view('staff/temuan/detail_temuan', $data);
	}

	public function tambah_tl($id_temuan)
	{
		$get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));

		$key = $id_temuan;

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
			'user'    		=> $get_akun,
			'level'	  		=> $get_akun,
			'jml_notif' => $this->notifikasi_m->jml_notif_staff(),
            'notif' => $this->notifikasi_m->notif_staff(),
			'title'			=> 'Tindak Lanjut [STAFF ADMINISTRASI]',
			'tgs'       	=> $data_tgs,
			
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
			'sasaran'   	=> $this->tindak_lanjut_m->get_detail_temuan($id_temuan)
			);

		$this->load->view('staff/temuan/form_tambah_tl', $data);

		//--> jika form submit
		if($this->input->post('submit'))
		{	
			//print "<pre>"; print_r($_POST); die;

			$key  = base64_encode($this->input->post('id_tl'));
			$key2 = base64_encode($this->input->post('id_tim'));

			$this->tindak_lanjut_m->insert_tl_staff();

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

	public function get_status()
    {
        $id_temuan_rekomendasi  = $this->input->post('id1');

        $data = array(
            'id_temuan_rekomendasi' => $id_temuan_rekomendasi,
            'temuan_rekomendasi'    => $this->tindak_lanjut_m->get_rekomendasi_by_id_rek($id_temuan_rekomendasi),
        );

        $this->load->view('staff/temuan/get_status', $data);
    }


    public function get_upload()
    {
        $id_temuan_rekomendasi  = $this->input->post('id1');

        $data = array(
            'id_temuan_rekomendasi' => $id_temuan_rekomendasi,
            'temuan_rekomendasi'    => $this->tindak_lanjut_m->get_rekomendasi_by_id_rek($id_temuan_rekomendasi),
            'data_upload' => $this->tindak_lanjut_m->get_rekomendasi_upload($id_temuan_rekomendasi),
        );

        $this->load->view('staff/temuan/get_upload', $data);
    }


}