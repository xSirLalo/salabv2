<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Asignatura extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('pagination');
        $this->load->helper('form');
		$this->load->model('model_asignatura');
	}

	public function Index()
	{
        $titulo['titulo']          = 'Lista de asignaturas';
        
        $config['base_url']        = base_url().'asignatura/index/';
        $config['total_rows']      = $this->model_asignatura->num_asignaturas();
        $config['per_page']        = 10 ;
        $config['uri_segment']     = 3 ;
        $config['num_links']       = 10 ;
        
        $config['full_tag_open']   = '<ul class="pagination">';
        $config['full_tag_close']  = '</ul>';
        $config['first_link']      = false;
        $config['last_link']       = false;
        $config['first_tag_open']  = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link']       = '<i class="glyphicon glyphicon-arrow-left"></i>';
        $config['prev_tag_open']   = '<li class="prev">';
        $config['prev_tag_close']  = '</li>';
        $config['next_link']       = '<i class="glyphicon glyphicon-arrow-right"></i>';
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
        $result = $this->model_asignatura->buscar(trim($query));
            if($result != FALSE){
                $data['resultado'] = $result;
                $data['pagination'] = '';
            }else{
                $data['resultado'] = '';
                $data['pagination'] = '';
            }
        }else{
        $result             = $this->model_asignatura->get_pagination($config['per_page']);
        $data['resultado']  = $result;
        $data['pagination'] = $this->pagination->create_links();
            }
		$this->load->view('template/header', $titulo);
		$this->load->view('asignatura/index', $data);
		$this->load->view('template/footer');

	}

    public function agregar(){
        $titulo['titulo']   = 'Agregar asignatura';
        $data['carreras']   = $this->model_asignatura->Carreras();
        $data['profesores'] = $this->model_asignatura->Profesores();

        $this->load->view("template/header", $titulo);
        $this->load->view("asignatura/agregar", $data);
        $this->load->view("template/footer");
    }
    public function guardar(){
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        $this->form_validation->set_rules('nombre_as','Nombre de Asignatura','required|trim|strtoupper');
        $this->form_validation->set_rules('clave','Clave','required|strtoupper|is_unique[Asignatura.clave]');
        $this->form_validation->set_rules('idCarrera','Carrera','required');
        $this->form_validation->set_rules('idProfesor','Profesor','required');
        if ($this->form_validation->run() == FALSE){
            //Error
        $this->agregar();
        }else{
        $data = array(
            'nombre_as'  => $this->input->post('nombre_as'),
            'clave'      => $this->input->post('clave'),
            'idCarrera'  => $this->input->post('idCarrera'),
            'idProfesor' => $this->input->post('idProfesor'),
            'idEstatus' => 3
        );
        $this->model_asignatura->guardar($data);
        redirect( base_url(). 'asignatura');
        }
    }
    public function modificar()
    {
        $titulo['titulo']     = 'Modificar asignatura';
        $data['idAsignatura'] = $this->uri->segment(3);
        $data['carreras']     = $this->model_asignatura->Carreras();
        $data['profesores']   = $this->model_asignatura->Profesores();
        if (!$data['idAsignatura']) {
            redirect('home');
        }else{
            $data['resultados'] = $this->model_asignatura->modificar($data['idAsignatura']);
        }
        $this->load->view('template/header', $titulo);
        $this->load->view('asignatura/modificar', $data);
        $this->load->view('template/footer');
    }
    public function actualizar(){
        $id = $this->uri->segment(3);
        $this->form_validation->set_rules('nombre_as','Nombre de Asignatura','required|trim|strtoupper');
        $this->form_validation->set_rules('clave','Clave','required|strtoupper');
        $this->form_validation->set_rules('idCarrera','Clave','required');
        $this->form_validation->set_rules('idProfesor','Clave','required');
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        if ($this->form_validation->run() == FALSE){
            //Error
         $this->modificar();
        }else{
        $data = array(
            'nombre_as'  => $this->input->post('nombre_as'),
            'clave'      => $this->input->post('clave'),
            'idCarrera'  => $this->input->post('idCarrera'),
            'idProfesor' => $this->input->post('idProfesor')
        );
        $this->model_asignatura->actualizar($id, $data);
        redirect( base_url(). 'asignatura');
        }
    }
    public function baja()
    {
        $idAsignatura = $this->uri->segment(3);
        $delete       = $this->model_asignatura->eliminar($idAsignatura);
        if ($delete == false) {
            redirect('asignatura');
        }
        else{
            redirect('asignatura');
        }
    }
}

?>