<?php

use Restserver\Libraries\REST_Controller;
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';


class Simwasda extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('staff/Tindak_lanjut_m');
	}

	// MENAMPILKAN DATA
	public function index_get()
	{
		$id_temuan_aspek = $this->get('id_temuan_aspek');

		if ($id_temuan_aspek === null) 
		{
		$simwasda = $this->Tindak_lanjut_m->get_data_temuan_api();
		} else {
			$simwasda = $this->Tindak_lanjut_m->get_data_temuan_api($id_temuan_aspek);
		}

		if ($simwasda) {
			$this->response([
				'status' => true,
				'data' => $simwasda
			], REST_Controller::HTTP_OK);
		} else {
			$this->response([
				'status' => false,
				'message' => 'Data Tidak Ditemukan'
			], REST_Controller::HTTP_NOT_FOUND);
		}

	}


	// MENAMBAHKAN DATA
	/*public function index_post()
	{	
		// input data
		$data = [
			'tgl_tbh' => $this->post('tgl_tbh'),
			'no_lhp' => $this->post('no_lhp'),
			'kategori_lhp' => $this->post('kategori_lhp')
		];

		if ($this->Tindak_lanjut_m->create($data) > 0 ) {
			//ok
				$this->response([
				'status' => true,
				'message' => 'data telah ditambahkan'
			], REST_Controller::HTTP_CREATED;
		} else {
			$this->response([
				'status' => false,
				'message' => 'Gagal Menambahkan Data'
			], REST_Controller::HTTP_BAD_REQUEST);
		}
	}*/

	// MENGUBAH DATA
	/*public function index_put() 
	{
		$id_temuan = $this->put('id_temuan');
		$data = [
			'tgl_tbh' => $this->put('tgl_tbh'),
			'no_lhp' => $this->put('no_lhp'),
			'kategori_lhp' => $this->put('kategori_lhp')
		];

		if ($this->Tindak_lanjut_m->update($data, $id_temuan) > 0 ) {
			//ok
				$this->response([
				'status' => true,
				'message' => 'data telah diubah'
			], REST_Controller::HTTP_NO_CONTENT;
		} else {
			$this->response([
				'status' => false,
				'message' => 'Gagal Merubah Data'
			], REST_Controller::HTTP_BAD_REQUEST);
		}
	}*/

	// MENGHAPUS DATA
	/*public function index_delete()
	{
		$id_temuan = $this->delete('id_temuan');

		if ($id_temuan === null) {
			$this->response([
				'status' => true,
				'message' => 'membutuhkan id'
			], REST_Controller::HTTP_BAD_REQUEST);
		} else {
			if ( $this->Tindak_lanjut_m->delete($id_temuan) > 0) {
				//ok
				$this->response([
				'status' => true,
				'id_temuan' => $id_temuan,
				'message' => 'data telah terhapus'
			], REST_Controller::HTTP_NO_CONTENT);

			} else {

			$this->response([
				'status' => false,
				'message' => 'Data Tidak Ditemukan'
			], REST_Controller::HTTP_BAD_REQUEST);
			}
		}

	}*/
}