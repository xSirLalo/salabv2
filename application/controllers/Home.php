<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$titulo = array(
			'titulo' => "SALAB "
		 );
		$this->load->view('template/header', $titulo);
		$this->load->view('home');
		$this->load->view('template/footer');

	}
}

?>