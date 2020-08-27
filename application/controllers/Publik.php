<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Publik extends CI_Controller {

	public function __construct()
	{       
		parent::__construct();
		$this->load->library('Datatables');

		ini_set('memory_limit', '2024M');
	}

	public function index()
	{
		$data = array(
			'title' => 'Inspektorat Kota Pariaman'
		);
		$this->load->view('publik', $data);
	}

}