<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profesor extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('pagination');
        $this->load->helper('form');
		$this->load->model('model_profesor');
	}

	public function Index()
	{
        $titulo['titulo']          = 'Lista de profesores';
        
        $config['base_url']        = base_url().'profesor/index/';
        $config['total_rows']      = $this->model_profesor->num_profesores();
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
            $result = $this->model_profesor->buscar(trim($query));
            if($result != FALSE){
                $data['resultado']  = $result;
                $data['pagination'] = '';
            }else{
                $data['resultado']  = '';
                $data['pagination'] = '';
            }
        }else{
        $result             = $this->model_profesor->get_pagination($config['per_page']);
        $data['resultado']  = $result;
        $data['pagination'] = $this->pagination->create_links();
            }
		$this->load->view('template/header', $titulo);
		$this->load->view('profesor/index', $data);
		$this->load->view('template/footer');
	}
    public function agregar(){
        $titulo['titulo'] = 'Agregar profesor';
        $this->load->view("template/header", $titulo);
        $this->load->view("profesor/agregar");
        $this->load->view("template/footer");
    }
    public function guardar(){
        $this->form_validation->set_rules('nombre_pr','Nombre','required|trim|strtoupper|alpha');
        $this->form_validation->set_rules('aPaterno_pr','Apellido Paterno','required|trim|strtoupper|alpha');
        $this->form_validation->set_rules('aMaterno_pr','Apellido Materno','required|trim|strtoupper|alpha');
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        if ($this->form_validation->run() == FALSE){
            //Error
        $this->agregar();
        }else{
        $data = array(
            'nombre_pr'   => $this->input->post('nombre_pr'),
            'aPaterno_pr' => $this->input->post('aPaterno_pr'),
            'aMaterno_pr' => $this->input->post('aMaterno_pr')
        );
        $this->model_profesor->guardar($data);
        redirect( base_url(). 'profesor');
        }
    }
    public function modificar()
    {
        $titulo['titulo']   = 'Modificar profesor';
        $data['idProfesor'] = $this->uri->segment(3);
        if (!$data['idProfesor']) {
            redirect('home');
        }else{
        $data['resultados1'] = $this->model_profesor->modificar($data['idProfesor']);
        }
        $this->load->view('template/header', $titulo);
        $this->load->view('profesor/modificar', $data);
        $this->load->view('template/footer');
    }
    public function actualizar(){
        $id = $this->uri->segment(3);
        $this->form_validation->set_rules ('nombre_pr','Nombre','required|strtoupper|alpha');
        $this->form_validation->set_rules('aPaterno_pr','Apellido Paterno','required|strtoupper|alpha');
        $this->form_validation->set_rules('aMaterno_pr','Apellido Materno','required|strtoupper|alpha');
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        if ($this->form_validation->run() == FALSE){
            //Error
        $this->modificar();
        }else{
        $data = array(
            'nombre_pr'   => $this->input->post('nombre_pr'),
            'aPaterno_pr' => $this->input->post('aPaterno_pr'),
            'aMaterno_pr' => $this->input->post('aMaterno_pr')
        );
        $this->model_profesor->actualizar($id, $data);
        redirect( base_url(). 'profesor');
        }
    }
    public function eliminar()
    {
        $idProfesor = $this->uri->segment(3);
        $delete     = $this->model_profesor->eliminar($idProfesor);
        if ($delete == false) {
            redirect('profesor');
        }
        else{
            redirect('profesor');
        }
    }
}

?>