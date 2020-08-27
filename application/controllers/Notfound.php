<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notfound extends CI_Controller {


	//--> not found
	public function index()
	{
		$data['title'] = "Error 404pkpt";
		$this->load->view('error404.php', $data);
	}

}