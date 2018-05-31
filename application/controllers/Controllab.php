<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controllab extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('pagination');
        $this->load->helper('form');
		$this->load->model('model_controllab');
        $this->load->model('model_alumno');
	}

	public function Index()
	{
        $titulo['titulo']          = 'Control de Computadoras en el Lab';
        
        $config['base_url']        = base_url().'controllab/index/';
        $config['total_rows']      = $this->model_controllab->num_controllabs();
        $config['per_page']        = 18 ;
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

        $result             = $this->model_controllab->get_pagination($config['per_page']);
        $data['resultado']  = $result;
        $data['pagination'] = $this->pagination->create_links();

		$this->load->view('template/header', $titulo);
		$this->load->view('controllab/index', $data);
		$this->load->view('template/footer');

	}
    public function agregar(){
        $titulo['titulo']     = 'Bienvenid@';
        $data['totaE']        = $this->model_controllab->computadoras_disponibles();
        $data['estatus']      = $this->model_controllab->Estatus();
        $data['computadoras'] = $this->model_controllab->computadoras();
        $this->load->view("template/header", $titulo);
        $this->load->view("controllab/agregar", $data);
        $this->load->view("template/footer");
    }
    public function guardar(){

        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        $this->form_validation->set_rules('noControl','Numero de Control','required|trim|numeric|min_length[8]');
        //$this->form_validation->set_rules('idComputadora','Computadora','trim');
        //Obtiene una el id de una computadora al alzar
        $consulta0 = $this->model_controllab->computadoras();
        if ($this->form_validation->run() == FALSE){
            //Error
        $this->agregar();
        }else{
        foreach ($consulta0 as $fila){
            $computadora = $fila->idComputadora;
        }
        $data = array(
            'noControl'     => $this->input->post('noControl'),
            'idComputadora' => $computadora,
            'fechaInicio'   => date('Y-m-d H:i:s'),
            'idEstatus'     => 1,
        );
        //Consulta si el alumno esta dado de alta de lo contrario se manda agregar como nuevo alumno
        $consulta1 = $this->model_controllab->consulta_alumno($data['noControl']);
        if ($consulta1 == 'no_registrado') {
            //Vista de Agregar alumno
            $titulo['titulo'] = 'Agregar alumno';
            $data['carreras'] = $this->model_alumno->carreras();
            $data['computadora'] = '';

            $this->load->view('template/header', $titulo);
            $this->load->view('alumno/agregar', $data);
            $this->load->view('template/footer');
        }else{
            //Consulta el estatus del alumno.
            $consulta2 = $this->model_controllab->consulta_estatus($data['noControl']);
            if ($consulta2 == 'cambia_status') {
                redirect('controllab/agregar');
                }else{
                $this->model_controllab->guardar($data,$data['idComputadora']);
                    redirect('controllab/agregar');
                }
            }
        }
    }
    public function modificar()
    {
        $titulo['titulo']     = 'Modificar controllab';
        $data['idControlLab'] = $this->uri->segment(3);
        $data['estatus']      = $this->model_controllab->Estatus();
        if (!$data['idControlLab']) {
            redirect('home');
        }else{
            $data['resultados'] = $this->model_controllab->modificar($data['idControlLab']);
        }
        $this->load->view('template/header', $titulo);
        $this->load->view('controllab/modificar', $data);
        $this->load->view('template/footer');
    }
    public function actualizar(){
        $id = $this->uri->segment(3);
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        $this->form_validation->set_rules('noControl','Numero de Control','required|trim|numeric');
        $this->form_validation->set_rules('idEstatus','Estatus','required|trim');
        if ($this->form_validation->run() == FALSE){
            //Error
        $this->guardar();
        }else{
        $data = array(
            'noControl' => $this->input->post('noControl'),
            'idEstatus' => $this->input->post('idEstatus'),
        );
        $this->model_controllab->actualizar($id, $data);
        redirect( base_url(). 'controllab');
        }
    }
    public function eliminar()
    {
        $idControlLab = $this->uri->segment(3);
        $delete = $this->model_controllab->eliminar($idControlLab);
        if ($delete == false) {
            redirect('controllab');
        }
        else{
            redirect('controllab');
        }
    }
    public function reporte()
    {
        $titulo['titulo'] = 'Reporte controllab';
        $this->form_validation->set_rules('fechaInicio', 'Fecha Inicial', 'trim|required');
        $this->form_validation->set_rules('fechaFin', 'Fecha Final', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
                $data['resultado'] = '';
        } else {
        $fechaInicio = $this->input->post('fechaInicio');
        $fechaFin    = $this->input->post('fechaFin');
        $result      = $this->model_controllab->reporte($fechaInicio,$fechaFin);
        //comprueba si las fechas son correctas.
            if($result != FALSE){
                $data['resultado'] = $result;
            }else{
                $data['resultado'] = '';
            }
        }
        $this->load->view('template/header', $titulo);
        $this->load->view('controllab/reporte', $data);
        $this->load->view('template/footer');
    }
}

?>