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

		$hak_akses = $this->session->userdata('lvl');
		if($hak_akses!='staff_evlap')
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
			'jml_notif'    	=> $this->notifikasi_m->jml_notif_ketua($kt->id_pegawai),
			'notif'        	=> $this->notifikasi_m->notif_ketua($kt->id_pegawai),
			'title'        	=> 'TINDAK LANJUT [Staff Evaluasi dan Pelaporan]',
			'tl'			=> $this->tindak_lanjut_m->get_data_temuan()
		);

		//print "<pre>"; print_r($this->tindak_lanjut_m->get_tl($kt->id_pegawai)); die;

		$this->load->view('staff_evlap/temuan/list_temuan', $data);
	}

	public function detail_temuan($id_temuan)
	{
		$get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));

		$kt = $this->login_model->get_pegawai($this->session->userdata('username'));

		$data = array(
			'user'          => $get_akun,
			'level'         => $get_akun,
			'jml_notif'     => $this->notifikasi_m->jml_notif_ketua($kt->id_pegawai),
			'notif'         => $this->notifikasi_m->notif_ketua($kt->id_pegawai),
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

			'temuan'		=> $this->tindak_lanjut_m->get_detail_temuan($id_temuan),
			'aspek'			=> $this->tindak_lanjut_m->get_detail_aspek($id_temuan),
			'temuan_rekomendasi' => $this->tindak_lanjut_m->get_detail_temuan_rekomendasi($id_temuan),
		);

		$this->load->view('staff_evlap/temuan/detail_temuan', $data);
	}

	public function cetak_temuan($id_temuan)
	{
		$get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));

		$kt = $this->login_model->get_pegawai($this->session->userdata('username'));

		$data = array(
			'user'          => $get_akun,
			'level'         => $get_akun,
			'jml_notif'     => $this->notifikasi_m->jml_notif_ketua($kt->id_pegawai),
			'notif'         => $this->notifikasi_m->notif_ketua($kt->id_pegawai),
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

			'temuan'		=> $this->tindak_lanjut_m->get_detail_temuan($id_temuan),
			'aspek'			=> $this->tindak_lanjut_m->get_detail_aspek($id_temuan),
			'temuan_rekomendasi' => $this->tindak_lanjut_m->get_detail_temuan_rekomendasi($id_temuan),
		);

		/*$this->load->view('staff_evlap/temuan/detail_temuan', $data);*/
		
		$pdf = $this->pdf->load_landscape();
		
		$html = $this->load->view('staff_evlap/temuan/cetak_temuan', $data, TRUE);
	    //--> render the view into HTML
	    $pdf->AddPage('L', // L - landscape, P - portrait
            '', '', '', '',
            8, // margin_left
            8, // margin right
            5, // margin top
            5, // margin bottom
            9, // margin header
            9); // margin footer
	    $pdf->WriteHTML($html);
	    //--> write the HTML into the PDF
	    $output = 'Temuan_'. $id_temuan .'_.pdf';
	    $pdf->Output("$output", 'I');
	}

	public function get_status()
    {
        $id_temuan_rekomendasi  = $this->input->post('id1');

        $data = array(
            'id_temuan_rekomendasi' => $id_temuan_rekomendasi,
            'temuan_rekomendasi'    => $this->tindak_lanjut_m->get_rekomendasi_by_id_rek($id_temuan_rekomendasi),
        );

        $this->load->view('staff_evlap/temuan/get_status', $data);
    }


    public function get_upload()
    {
        $id_temuan_rekomendasi  = $this->input->post('id1');

        $data = array(
            'id_temuan_rekomendasi' => $id_temuan_rekomendasi,
            'temuan_rekomendasi'    => $this->tindak_lanjut_m->get_rekomendasi_by_id_rek($id_temuan_rekomendasi),
            'data_upload' => $this->tindak_lanjut_m->get_rekomendasi_upload($id_temuan_rekomendasi),
        );

        $this->load->view('staff_evlap/temuan/get_upload', $data);
    }

	public function tambah_tl() {
        $get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));
        $kt = $this->login_model->get_pegawai($this->session->userdata('username'));

        $data = array(
            'user'          => $get_akun,
            'level'         => $get_akun,
            'jml_notif'     => $this->notifikasi_m->jml_notif_ketua($kt->id_pegawai),
			'notif'         => $this->notifikasi_m->notif_ketua($kt->id_pegawai),
            'title'			=> 'Tambah Temuan [Staff Evaluasi dan Pelaporan]',
        );

        $this->load->view('staff_evlap/temuan/form_tambah_temuan', $data);

        //--> jika form submit
        if ($this->input->post('submit')) {

        	//print "<pre>"; print_r($_POST); die;

            /*$key2 = base64_encode($this->input->post('no_lhp'));*/

            $this->tindak_lanjut_m->insert_temuan_staff_evlap();

            //--> Tampilkan notifikasi berhasil ubah
            echo $this->session->set_flashdata('sukses', "<div class='alert alert-block alert-success'>
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

            /*redirect('ketua_tim/tindak_lanjut/detail_tugas_tl/' . $key . '/' . $key2);*/

            redirect('staff_evlap/temuan');
        }
    }

}