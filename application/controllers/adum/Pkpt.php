<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pkpt extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('login_model');
		$this->auth->cek_auth(); //--> ambil auth dari library
		$this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'url'));
		//--> load model
		$this->load->model('notifikasi_m');
		$this->load->model('staff/pkpt_m');

		//--> hak akses
		$hak_akses = $this->session->userdata('lvl');
		if($hak_akses!='adum')
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
		$get_akun  = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));

		$data = array(
			'user'     	=> $get_akun,
	        'level'	   	=> $get_akun,
	        'jml_notif' => $this->notifikasi_m->jml_notif_adum(),
	        'notif'		=> $this->notifikasi_m->notif_adum(),
            'jml_notif_temuan' => $this->notifikasi_m->jml_notif_adum_temuan(),
            'notif_temuan'     => $this->notifikasi_m->notif_adum_temuan(),
	        'title'		=> 'PKPT [ADUM]pkpt',
			'pkpt' 	 	=> $this->pkpt_m->get_pkpt()
		);

		$this->load->view('adum/pkpt/list_pkpt', $data);
	}

	    //--> tambah penugasan
    public function tambah_pkpt() {
    	
    	$get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));
    	$data = array(
            'user'     	=> $get_akun,
	        'level'	   	=> $get_akun,
	        'jml_notif' => $this->notifikasi_m->jml_notif_adum(),
	        'notif'		=> $this->notifikasi_m->notif_adum(),
            'jml_notif_temuan' => $this->notifikasi_m->jml_notif_adum_temuan(),
            'notif_temuan'     => $this->notifikasi_m->notif_adum_temuan(),
	        'title'		=> 'PKPT [ADUM]pkpt',
	        'error'		=> 'File gagal diupload',
        );

    	$this->validasi();

    	if ($this->form_validation->run() == FALSE) {
    		$get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));
    		$data = array(
    			'user'     	=> $get_akun,
    			'level'	   	=> $get_akun,
    			'jml_notif' => $this->notifikasi_m->jml_notif_adum(),
    			'notif'		=> $this->notifikasi_m->notif_adum(),
                'jml_notif_temuan' => $this->notifikasi_m->jml_notif_adum_temuan(),
                'notif_temuan'     => $this->notifikasi_m->notif_adum_temuan(),
    			'title'		=> 'PKPT [ADUM]pkpt',
    			'error'		=> 'File gagal diupload',
    		);
    		$this->load->view('adum/pkpt/form_tambah_pkpt', $data);

    	} else {
    		$config['upload_path']          = './assets/pkpt/';
    		$config['allowed_types']        = 'pdf|PDF|doc|docx|xsl|xsls';
    		
    		$this->load->library('upload', $config);

    		if(!$this->upload->do_upload('file_upload')) 
    		{
    			$get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));
    			$data = array(
    				'user'     	=> $get_akun,
    				'level'	   	=> $get_akun,
    				'jml_notif' => $this->notifikasi_m->jml_notif_adum(),
    				'notif'		=> $this->notifikasi_m->notif_adum(),
                    'jml_notif_temuan' => $this->notifikasi_m->jml_notif_adum_temuan(),
                    'notif_temuan'     => $this->notifikasi_m->notif_adum_temuan(),
    				'title'		=> 'PKPT [ADUM]pkpt',
    				'error'		=> 'File gagal diupload',
    			);
    			$error = array('error' => $this->upload->display_errors());
    			$this->load->view('adum/pkpt/form_tambah_pkpt',array('error' => '' ), $data);

    		} else {

    			$this->pkpt_m->insert_pkpt();
    			//--> Tampilkan notifikasi berhasil ubah
    			echo $this->session->set_flashdata('sukses', "<div class='alert alert-block alert-success'>
    				<button type='button' class='close' data-dismiss='alert'>
    				<i class='ace-icon fa fa-times'></i>
    				</button>

    				<p>
    				<strong>
    				<i class='ace-icon fa fa-check'></i>
    				Berhasil Tambah Data PKPT!
    				</strong>
    				Data penugasan telah ditambahkan, cek data tersebut di bawah ini.
    				</p>
    				</div>"
    			);
    			redirect('adum/pkpt');
    		}

    	}
    }

	//--> form ubah pkpt
	public function ubah_pkpt($id)
	{
		$get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));
    	$data = array(
            'user'     	=> $get_akun,
	        'level'	   	=> $get_akun,
	        'jml_notif' => $this->notifikasi_m->jml_notif_adum(),
	        'notif'		=> $this->notifikasi_m->notif_adum(),
            'jml_notif_temuan' => $this->notifikasi_m->jml_notif_adum_temuan(),
            'notif_temuan'     => $this->notifikasi_m->notif_adum_temuan(),
	        'title'		=> 'PKPT [ADUM]pkpt',
	        'error'		=> 'File gagal diupload', 
	        'data_pkpt_id' => $this->pkpt_m->get_by_id($id),

        );

		$this->validasiedit();

		if ($this->form_validation->run() == FALSE)
        {
        	
            $get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));
    		$data = array(
    			'user'     	=> $get_akun,
    			'level'	   	=> $get_akun,
    			'jml_notif' => $this->notifikasi_m->jml_notif_adum(),
    			'notif'		=> $this->notifikasi_m->notif_adum(),
                'jml_notif_temuan' => $this->notifikasi_m->jml_notif_adum_temuan(),
                'notif_temuan'     => $this->notifikasi_m->notif_adum_temuan(),
    			'title'		=> 'PKPT [ADUM]pkpt',
    			'error'		=> 'File gagal diupload',
    			'data_pkpt_id' => $this->pkpt_m->get_by_id($id),
    		);
    		$this->load->view('adum/pkpt/form_ubah_pkpt', $data);
        
        }
        else
        {
        	// cek jika ada file yang akan diupload

        	$upload_file = $_FILES['file_upload']['name'];

        	if ($upload_file) {
        		
        		$config['upload_path']          = './assets/pkpt/';
        		$config['allowed_types']        = 'pdf|PDF|doc|docx|jpg|JPG|png|PNG';
        		$this->load->library('upload', $config);

        		if (!$this->upload->do_upload('file_upload')) 
        		{
        			$get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));
        			$data = array(
        				'user'     	=> $get_akun,
        				'level'	   	=> $get_akun,
        				'jml_notif' => $this->notifikasi_m->jml_notif_adum(),
        				'notif'		=> $this->notifikasi_m->notif_adum(),
                        'jml_notif_temuan' => $this->notifikasi_m->jml_notif_adum_temuan(),
                        'notif_temuan'     => $this->notifikasi_m->notif_adum_temuan(),
        				'title'		=> 'PKPT [ADUM]pkpt',
        				'error'		=> 'File gagal diupload',
        			);
        			$error = array('error' => $this->upload->display_errors());
        			$this->load->view('adum/pkpt/form_edit_pkpt',array('error' => '' ), $data);
        			

        		} else {
        			
        			$new_file = $this->upload->data('file_name');
        			$this->db->set('nama_file', $new_file);
        		} 

        	}
            
        	$this->pkpt_m->update_data();
            
        	echo $this->session->set_flashdata('sukses', "<div class='alert alert-block alert-success'>
        		<button type='button' class='close' data-dismiss='alert'>
        		<i class='ace-icon fa fa-times'></i>
        		</button>

        		<p>
        		<strong>
        		<i class='ace-icon fa fa-check'></i>
        		Berhasil Merubah Data PKPT!
        		</strong>
        		Data penugasan telah ditambahkan, cek data tersebut di bawah ini.
        		</p>
        		</div>"
        	);
        	redirect('adum/pkpt');
        }

        /*{
            $this->M_identifikasi->update_data();
            $this->session->set_flashdata('flash', 'Dirubah');
            redirect('admin/identifikasi/Produk_daerah');
        }*/	
	}

	public function delete($id)
	{
		$this->pkpt_m->delete_data($id);
		echo $this->session->set_flashdata('sukses', "<div class='alert alert-block alert-warning'>
    				<button type='button' class='close' data-dismiss='alert'>
    				<i class='ace-icon fa fa-times'></i>
    				</button>

    				<p>
    				<strong>
    				<i class='ace-icon fa fa-check'></i>
    				Data PKPT Berhasil dihapus
    				</strong>
    				</p>
    				</div>"
    			);
		redirect('adum/pkpt');
	}

	public function validasi()
    {
        
    	$this->form_validation->set_rules('tahun', 'Tahun PKPT', 'trim|required|min_length[3]');
    	$this->form_validation->set_rules('judul', 'Judul PKPT', 'trim|required|min_length[3]');
    	if (empty($_FILES['file_upload']['name']))
    	{
    		$this->form_validation->set_rules('file_upload', 'File Upload PKPT', 'required');
    	} 

    }

    public function validasiedit()
    {
        
    	$this->form_validation->set_rules('tahun', 'Tahun PKPT', 'trim|required|min_length[3]');
    	$this->form_validation->set_rules('judul', 'Judul PKPT', 'trim|required|min_length[3]');

    }


}