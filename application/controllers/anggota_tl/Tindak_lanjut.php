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
		if($hak_akses!='anggota_tl')
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

		$kt = $this->login_model->get_pegawai($this->session->userdata('username'));

		$data = array(
				'user'     	=> $get_akun,
		        'level'	   	=> $get_akun,
		        'jml_notif' => $this->notifikasi_m->jml_notif_staff(),
		        'notif'		=> $this->notifikasi_m->notif_staff(),
		        'title'		=> 'Tindak Lanjut [KETUA TIM TL]',
				'tl' 	 	=> $this->tindak_lanjut_m->get_tugas_ag($kt->id_pegawai)
			);

		$this->load->view('anggota_tl/tindak_lanjut/list_tl', $data);
	}

	//--> detail penugasan
	public function detail_tl($id_tl, $id_tim, $no_lhp)
	{
		$get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));

		$key  = base64_decode($id_tl);
		$key2 = base64_decode($id_tim);
		$key3 = base64_decode($no_lhp);

		//-> update notif penugasan
		//$this->notifikasi_m->update_notif_staff($key);

		$cek = $this->db->get_where('tb_tindak_lanjut', array('id_tl' => $key))->row();

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
		$jml_sas   = $this->tim_m->get_jum_sasaran($key2);

		if($jml_sas->jml != 0)
			{ $get_lhp = $this->tindak_lanjut_m->get_lhp($cek->fk_tgs); }
		else
			{ $get_lhp = $this->tindak_lanjut_m->get_row_lhp($cek->fk_tgs); }

		$data = array(
			'user'      => $get_akun,
			'level'     => $get_akun,
			'jml_notif' => $this->notifikasi_m->jml_notif_staff(),
    		'notif'		=> $this->notifikasi_m->notif_staff(),
			'title'     => 'Tindak Lanjut [ANGGOTA TIM TL]',

			'data'      => $penugasan,
			'ketua_tim'	=> $ketua_tim,
			'tgl_surat' => $tgl_surat,
			'tgl_awal'	=> $tgl_awal,
			'tgl_akhir'	=> $tgl_akhir,
			'tim'      	=> $this->tim_m->get_sub_tim($key2),
			'jml_sas' 	=> $jml_sas,
			'lhp'		=> $get_lhp,
			
			'kt101'    	=> $this->tindak_lanjut_m->get_count_kode_temuan($cek->id_temuan, '101'),
			'kt102'    	=> $this->tindak_lanjut_m->get_count_kode_temuan($cek->id_temuan, '102'),
			'kt103'    	=> $this->tindak_lanjut_m->get_count_kode_temuan($cek->id_temuan, '103'),
			'kt104'    	=> $this->tindak_lanjut_m->get_count_kode_temuan($cek->id_temuan, '104'),
			'kt105'    	=> $this->tindak_lanjut_m->get_count_kode_temuan($cek->id_temuan, '105'),
			'kt201'    	=> $this->tindak_lanjut_m->get_count_kode_temuan($cek->id_temuan, '201'),
			'kt202'    	=> $this->tindak_lanjut_m->get_count_kode_temuan($cek->id_temuan, '202'),
			'kt203'    	=> $this->tindak_lanjut_m->get_count_kode_temuan($cek->id_temuan, '203'),
			'kt301'    	=> $this->tindak_lanjut_m->get_count_kode_temuan($cek->id_temuan, '301'),
			'kt302'    	=> $this->tindak_lanjut_m->get_count_kode_temuan($cek->id_temuan, '302'),
			'kt303'    	=> $this->tindak_lanjut_m->get_count_kode_temuan($cek->id_temuan, '303'),

			'jml_kt'    => $this->tindak_lanjut_m->get_count_kode_temuan_jml($cek->id_temuan),
			'aspek_spi' => $this->tindak_lanjut_m->get_count_aspek($cek->id_temuan, 'spi'),
			'aspek_e3'  => $this->tindak_lanjut_m->get_count_aspek($cek->id_temuan, 'e3'),
			'aspek_kepatuhan' => $this->tindak_lanjut_m->get_count_aspek($cek->id_temuan, 'kepatuhan'),

			'jml_1'		=> $this->tindak_lanjut_m->get_count_status_tl($cek->id_temuan, '1'),
			'jml_2'		=> $this->tindak_lanjut_m->get_count_status_tl($cek->id_temuan, '2'),
			'jml_3'		=> $this->tindak_lanjut_m->get_count_status_tl($cek->id_temuan, '3'),
			'jml_0'		=> $this->tindak_lanjut_m->get_count_status_tl($cek->id_temuan, '0'),

			'temuan'    => $this->tindak_lanjut_m->get_detail_temuan($cek->id_temuan),
            'aspek'     => $this->tindak_lanjut_m->get_detail_aspek($cek->id_temuan),
            'temuan_rekomendasi' => $this->tindak_lanjut_m->get_detail_temuan_rekomendasi($cek->id_temuan),
		);
		

		$this->load->view('anggota_tl/tindak_lanjut/detail_tl', $data);
	}

	/*public function penentuan_kat()
	{
		$id_tl  = base64_decode($this->input->post('id1'));
		$id_tim = base64_decode($this->input->post('id2'));
		$no_lhp  = base64_decode($this->input->post('id3'));
		$id_temuan_rekomendasi  = base64_decode($this->input->post('id4'));

		$data = array(
			'id_tl'      => $id_tl,
			'id_tim'     => $id_tim,
			'no_lhp'     => $no_lhp,
			'id_temuan_rekomendasi' => $id_temuan_rekomendasi,
            'temuan_rekomendasi'    => $this->tindak_lanjut_m->get_rekomendasi_by_id_rek($id_temuan_rekomendasi),
		);

		$this->load->view('anggota_tl/tindak_lanjut/penentuan_kat', $data);

		//--> jika form submit
		if($this->input->post('submit'))
		{
			$id_tl_en  = base64_encode($this->input->post('id_tl'));
			$id_tim_en = base64_encode($this->input->post('id_tim'));
			$no_lhp_en  = base64_encode($this->input->post('no_lhp'));

			$this->tindak_lanjut_m->update_status_tl();

			//--> Tampilkan notifikasi berhasil ubah
			echo $this->session->set_flashdata('sukses',
					 "<div class='alert alert-block alert-success'>
							<button type='button' class='close' data-dismiss='alert'>
								<i class='ace-icon fa fa-times'></i>
							</button>

							<p>
								<strong>
									<i class='ace-icon fa fa-check'></i>
									Berhasil Memberikan Keputusan!
								</strong>
								Kategori tindak lanjut telah ditentukan, cek data tersebut di bawah ini.
							</p>
						</div>"
				);

			redirect('anggota_tl/tindak_lanjut/detail_tl/'.$id_tl_en.'/'.$id_tim_en.'/'.$no_lhp_en);
		}
	}*/

	public function get_status()
    {
        $id_temuan_rekomendasi  = $this->input->post('id1');

        $data = array(
            'id_temuan_rekomendasi' => $id_temuan_rekomendasi,
            'temuan_rekomendasi'    => $this->tindak_lanjut_m->get_rekomendasi_by_id_rek($id_temuan_rekomendasi),
        );

        $this->load->view('anggota_tl/tindak_lanjut/get_status', $data);
    }

	public function get_upload()
	{
		$id_tl  = base64_decode($this->input->post('id1'));
		$id_tim = base64_decode($this->input->post('id2'));
		$no_lhp  = base64_decode($this->input->post('id3'));
		$id_temuan_rekomendasi  = base64_decode($this->input->post('id4'));

		$data = array(
			'id_tl'      => $id_tl,
			'id_tim'     => $id_tim,
			'no_lhp'     => $no_lhp,
			'id_temuan_rekomendasi' => $id_temuan_rekomendasi,
            'temuan_rekomendasi'    => $this->tindak_lanjut_m->get_rekomendasi_by_id_rek($id_temuan_rekomendasi),
            'data_upload' => $this->tindak_lanjut_m->get_rekomendasi_upload($id_temuan_rekomendasi),
		);

		$this->load->view('anggota_tl/tindak_lanjut/upload_file', $data);

		//--> jika form submit
		if($this->input->post('submit'))
		{
			$id_tl_en  = base64_encode($this->input->post('id_tl'));
			$id_tim_en = base64_encode($this->input->post('id_tim'));
			$no_lhp_en  = base64_encode($this->input->post('no_lhp'));

			if(empty($_FILES['file_tl']['name']))
			{
				echo $this->session->set_flashdata('sukses',
					"<div class='alert alert-block alert-danger'>
					<button type='button' class='close' data-dismiss='alert'>
					<i class='ace-icon fa fa-times'></i>
					</button>

					<p>
					<strong>
					<i class='ace-icon fa fa-times'></i>
					File gagal di upload!
					</strong>
					File tidak boleh kosong.
					</p>
					</div>"
				);
			}
			//--> jika file ada
			elseif(!empty($_FILES['file_tl']['name']))
			{
				$this->tindak_lanjut_m->upload_rekomendasi();

				echo $this->session->set_flashdata('sukses',
					"<div class='alert alert-block alert-success'>
					<button type='button' class='close' data-dismiss='alert'>
					<i class='ace-icon fa fa-times'></i>
					</button>

					<p>
					<strong>
					<i class='ace-icon fa fa-check'></i>
					File berhasil di upload!
					</strong>
					</p>
					</div>"
				);
			}

			//--> Tampilkan notifikasi berhasil ubah
			redirect('anggota_tl/tindak_lanjut/detail_tl/'.$id_tl_en.'/'.$id_tim_en.'/'.$no_lhp_en);
		}
	}

	public function upload_file()
	{
		$id_tl  = base64_decode($this->input->post('id1'));
		$id_tim = base64_decode($this->input->post('id2'));
		$no_lhp  = base64_decode($this->input->post('id3'));
		$id_temuan_rekomendasi  = base64_decode($this->input->post('id4'));

		$data = array(
			'id_tl'      => $id_tl,
			'id_tim'     => $id_tim,
			'no_lhp'     => $no_lhp,
			'id_temuan_rekomendasi' => $id_temuan_rekomendasi,
            'temuan_rekomendasi'    => $this->tindak_lanjut_m->get_rekomendasi_by_id_rek($id_temuan_rekomendasi),
		);

		$this->load->view('anggota_tl/tindak_lanjut/penentuan_kat', $data);

		//--> jika form submit
		if($this->input->post('submit'))
		{
			$id_tl_en  = base64_encode($this->input->post('id_tl'));
			$id_tim_en = base64_encode($this->input->post('id_tim'));
			$no_lhp_en  = base64_encode($this->input->post('no_lhp'));

			$this->tindak_lanjut_m->update_status_tl();

			//--> Tampilkan notifikasi berhasil ubah
			echo $this->session->set_flashdata('sukses',
					 "<div class='alert alert-block alert-success'>
							<button type='button' class='close' data-dismiss='alert'>
								<i class='ace-icon fa fa-times'></i>
							</button>

							<p>
								<strong>
									<i class='ace-icon fa fa-check'></i>
									Berhasil Memberikan Keputusan!
								</strong>
								Kategori tindak lanjut telah ditentukan, cek data tersebut di bawah ini.
							</p>
						</div>"
				);

			redirect('anggota_tl/tindak_lanjut/detail_tl/'.$id_tl_en.'/'.$id_tim_en.'/'.$no_lhp_en);
		}
	}

	public function upload_p2hp($id_p2hp, $id_pka, $id_tgs)
	{
		$key1 = base64_decode($id_p2hp);
		$key2 = base64_decode($id_pka);
		$key3 = base64_decode($id_tgs);

		//--> jika file tidak ada
		if(empty($_FILES['file_p2hp']['name']))
		{
			echo $this->session->set_flashdata('sukses',
				 "<div class='alert alert-block alert-danger'>
						<button type='button' class='close' data-dismiss='alert'>
							<i class='ace-icon fa fa-times'></i>
						</button>

						<p>
							<strong>
								<i class='ace-icon fa fa-times'></i>
								File gagal di upload!
							</strong>
							File tidak boleh kosong.
						</p>
					</div>"
			);
		}
		//--> jika file ada
		elseif(!empty($_FILES['file_p2hp']['name']))
		{
			$this->p2hp_lhp_m->upload_p2hp();

			echo $this->session->set_flashdata('sukses',
				 "<div class='alert alert-block alert-success'>
						<button type='button' class='close' data-dismiss='alert'>
							<i class='ace-icon fa fa-times'></i>
						</button>

						<p>
							<strong>
								<i class='ace-icon fa fa-check'></i>
								File berhasil di upload!
							</strong>
							Harap tunggu konfirmasi keputusan.
						</p>
					</div>"
			);
		}

		redirect('ketua_tim/p2hp_lhp/detail_p2hp_lhp/'.$id_p2hp .'/'. $id_pka);
	}

}