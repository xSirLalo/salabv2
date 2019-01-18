<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class main extends CI_Controller {

	public function index()
	{
		$data['contenido'] = 'template/mail_test';
		$data['asd'] = 'hola';
		$this->load->view('main', $data, FALSE);
	}

}

/* End of file main.php */
/* Location: ./application/controllers/main.php */