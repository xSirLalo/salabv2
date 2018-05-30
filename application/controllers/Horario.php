<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Horario extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('pagination');
        $this->load->helper('form');
		$this->load->model('model_horario');
	}

	public function Index()
	{
        $titulo['titulo']          = 'Lista de horarios';
        
        $config['base_url']        = base_url().'horario/index/';
        $config['total_rows']      = $this->model_horario->num_horarios();
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
        // Datos para filtrar
        $data['aulas']               = $this->model_horario->Aulas();
        $data['asignaturas']         = $this->model_horario->Asignaturas();
        $data['estatus']             = $this->model_horario->Estatus();
        // Filtrar Lista
        $f_data['idAula']            = $this->input->post('idAula', TRUE);
        $f_data['idAsignatura']      = $this->input->post('idAsignatura', TRUE);
        $f_data['idEstatus']         = $this->input->post('idEstatus', TRUE);
        if ($f_data){
            $result = $this->model_horario->Filtrar($f_data);
            if($result != FALSE){
                $data['resultado']  = $result;
                $data['pagination'] = '';
            }else{
                $data['resultado']  = '';
                $data['pagination'] = '';
            }
        }else{
        $result             = $this->model_horario->get_pagination($config['per_page']);
        $data['resultado']  = $result;
        $data['pagination'] = $this->pagination->create_links();
            }

		$this->load->view('template/header', $titulo);
		$this->load->view('horario/index', $data);
		$this->load->view('template/footer');

	}
    public function agregar(){
        $titulo['titulo']   = 'Agregar horario';
        $data['aulas']      = $this->model_horario->Aulas();
        $data['asignaturas'] = $this->model_horario->Asignaturas();
        $this->load->view("template/header", $titulo);
        $this->load->view("horario/agregar", $data);
        $this->load->view("template/footer");
    }
    public function guardar(){
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        $this->form_validation->set_rules('horaInicio','Hora Inicial','required');
        $this->form_validation->set_rules('horaFin','Hora Final','required');
        $this->form_validation->set_rules('dia[]','Dia','required');
        $this->form_validation->set_rules('idAula','Aula','required');
        $this->form_validation->set_rules('idAsignatura','Asignatura','required');
        if ($this->form_validation->run() == FALSE){
            //Error
        $this->agregar();
        }else{
        //Los dias se guardan en un array seprado con comas y un espacio
        $dias = implode(", ",$this->input->post('dia'));
        // Se asigna profesor y carrera de manera que autimatica al seleccionar una asignatura
        $idAs = $this->input->post('idAsignatura');
        $consulta0 = $this->model_horario->asig($idAs);
        foreach ($consulta0->result() as $fila){
            $profesor = $fila->idProfesor;
            $carrera = $fila->idCarrera;
        }
        $data = array(
            'horaInicio'   => $this->input->post('horaInicio'),
            'horaFin'      => $this->input->post('horaFin'),
            'dia'          => $dias,
            'idAula'       => $this->input->post('idAula'),
            'idAsignatura' => $this->input->post('idAsignatura'),
            'idCarrera'    => $carrera,
            'idProfesor'   => $profesor,
        );
        $this->model_horario->guardar($data);
        redirect( base_url(). 'horario');
        }
    }
    public function modificar()
    {
        $titulo['titulo']   = 'Modificar horario';
        $data['idHorario']  = $this->uri->segment(3);
        $data['aulas']      = $this->model_horario->Aulas();
        $data['asignaturas'] = $this->model_horario->Asignaturas();
        if (!$data['idHorario']) {
            redirect('home');
        }else{
            $data['resultados'] = $this->model_horario->modificar($data['idHorario']);
        }
        $this->load->view('template/header', $titulo);
        $this->load->view('horario/modificar', $data);
        $this->load->view('template/footer');
    }
    public function actualizar(){
        $id = $this->uri->segment(3);
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        $this->form_validation->set_rules('horaInicio','Hora Inicial','required');
        $this->form_validation->set_rules('horaFin','Hora Final','required');
        $this->form_validation->set_rules('dia[]','Dia','required');
        $this->form_validation->set_rules('idAula','Aula','required');
        $this->form_validation->set_rules('idAsignatura','Asignatura','required');
        if ($this->form_validation->run() == FALSE){
            //Error
        $this->modificar();
        }else{
        //Los dias se guarda en un array seprado con comas y un espacio
        $dias = implode(", ",$this->input->post('dia'));
        $idAs = $this->input->post('idAsignatura');
        $consulta0 = $this->model_horario->asig($idAs);
        foreach ($consulta0->result() as $fila){
            $profesor = $fila->idProfesor;
            $carrera = $fila->idCarrera;
        }
        $data = array(
            'horaInicio' => $this->input->post('horaInicio'),
            'horaFin'    => $this->input->post('horaFin'),
            'dia'        => $dias,
            'idAula'     => $this->input->post('idAula'),
            'idAsignatura' => $this->input->post('idAsignatura'),
            'idCarrera' => $carrera,
            'idProfesor' => $profesor,
        );
        $this->model_horario->actualizar($id, $data);
        redirect( base_url(). 'horario');
        }
    }
    public function eliminar()
    {
        $idhorario = $this->uri->segment(3);
        $delete    = $this->model_horario->eliminar($idhorario);
        if ($delete == false) {
            redirect('horario');
        }
        else{
            redirect('horario');
        }
    }
}

?>