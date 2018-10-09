<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Incidencia extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('pagination');
        $this->load->helper('form');
		$this->load->model('model_incidencia');
	}

	public function Index()
	{
        $titulo['titulo']          = 'Incidencias en Laboratorio';
        
        $config['base_url']        = base_url().'incidencia/index/';
        $config['total_rows']      = $this->model_incidencia->num_incidencias();
        $config['per_page']        = 10 ;
        $config['uri_segment']     = 3 ;
        $config['num_links']       = 10 ;
        
        $config['full_tag_open']   = '<ul class="pagination">';
        $config['full_tag_close']  = '</ul>';
        $config['first_link']      = false;
        $config['last_link']       = false;
        $config['first_tag_open']  = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link']       = '&laquo';
        $config['prev_tag_open']   = '<li class="prev">';
        $config['prev_tag_close']  = '</li>';
        $config['next_link']       = '&raquo';
        $config['next_tag_open']   = '<li>';
        $config['next_tag_close']  = '</li>';
        $config['last_tag_open']   = '<li>';
        $config['last_tag_close']  = '</li>';
        $config['cur_tag_open']    = '<li class="active"><a href="#">';
        $config['cur_tag_close']   = '</a></li>';
        $config['num_tag_open']    = '<li>';
        $config['num_tag_close']   = '</li>';
        $this->pagination->initialize($config);

        $query = $this->input->get ('search', TRUE);
        if ($query){
            $result = $this->model_incidencia->buscar(trim($query));
            if($result != FALSE){
                $data['resultado']  = $result;
                $data['pagination'] = '';
            }else{
                $data['resultado']  = '';
                $data['pagination'] = '';
            }
        }else{
        $result             = $this->model_incidencia->get_pagination($config['per_page']);
        $data['resultado']  = $result;
        $data['pagination'] = $this->pagination->create_links();
        }
		$this->load->view('template/header', $titulo);
		$this->load->view('incidencia/index', $data);
		$this->load->view('template/footer');
	}
    public function agregar(){
        $titulo['titulo'] = 'Agregar incidencia';
        $data['estatus']  = $this->model_incidencia->Estatus();
        $this->load->view("template/header", $titulo);
        $this->load->view("incidencia/agregar", $data);
        $this->load->view("template/footer");
    }

    public function ajax_ver($id)
    {
        $data = $this->model_incidencia->get_by_id($id);
        echo json_encode($data);
    }
    public function guardar(){
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        $this->form_validation->set_rules('asunto','Asunto','required|trim|strtoupper');
        $this->form_validation->set_rules('descripcion','Descripcion','required|trim|strtoupper');
        if ($this->form_validation->run() == FALSE){
            //Error
        $this->agregar();
        }else{
        $data = array(
            'asunto'      => $this->input->post('asunto'),
            'descripcion' => $this->input->post('descripcion'),
            'idUsuario'   => $this->input->post('idUsuario'),
            'fechaAlta' => date('Y-m-d H:i:s')
        );
        $this->model_incidencia->guardar($data);
        redirect( base_url(). 'incidencia');
        }
    }
    public function modificar()
    {
        $titulo['titulo']     = 'Modificar incidencia';
        $data['idIncidencia'] = $this->uri->segment(3);
        $data['estatus']      = $this->model_incidencia->Estatus();
        if (!$data['idIncidencia']) {
            redirect('home');
        }else{
            $data['resultados'] = $this->model_incidencia->modificar($data['idIncidencia']);
        }

        $this->load->view('template/header', $titulo);
        $this->load->view('incidencia/modificar', $data);
        $this->load->view('template/footer');
    }
    public function actualizar(){
        $id = $this->uri->segment(3);
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        $this->form_validation->set_rules('comentario','Comentario','required|trim|strtoupper');
        $this->form_validation->set_rules('idEstatus','Estatus','required|trim');

        if ($this->form_validation->run() == FALSE){
            //Error
        $this->modificar();
        }else{
        $data = array(
            'comentario'        => $this->input->post('comentario'),
            'idEstatus'         => $this->input->post('idEstatus'),
            'fechaModificacion' => date('Y-m-d H:i:s')
        );
        $this->model_incidencia->actualizar($id, $data);
        redirect( base_url(). 'incidencia');
        }
    }
    public function eliminar()
    {
        $idIncidencia = $this->uri->segment(3);
        $delete       = $this->model_incidencia->eliminar($idIncidencia);
        if ($delete == false) {
            redirect('incidencia');
        }
        else{
            redirect('incidencia');
        }
    }
}

?>