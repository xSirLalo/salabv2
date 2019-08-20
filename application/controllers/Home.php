<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
	{
		parent::__construct();
        $this->load->model('model_opciones');
	}

	public function index()
	{
		$titulo = array(
			'titulo' => "Sistema de Administracion del Laboratorio de Computo "
		 );
		$this->load->view('template/header', $titulo);
		$this->load->view('home');
		$this->load->view('template/footer');

	}
	public function opciones()
	{
		$titulo = array(
			'titulo' => "Opciones de SALAB"
		 );
		$data['Opciones']      = $this->model_opciones->opt_mostrar();

		$this->load->view('template/header', $titulo);
		$this->load->view('opciones', $data);
		$this->load->view('template/footer');

	}
	public function guardar()
	{
        $this->form_validation->set_rules('idOpcion','','numeric');
        $this->form_validation->set_rules('opt_java','','numeric');
        $opciones = array(
            'idOpcion' => $this->uri->segment(3),
            'opt_java' => $this->input->post('opt_java'),
        );
		$this->model_opciones->guardar($opciones);
	}
}

?>