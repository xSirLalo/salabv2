<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alumno extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('pagination');
        $this->load->helper('form');
		$this->load->model('model_alumno');
        $this->load->model('model_controllab');
	}

	public function Index()
	{
        $titulo['titulo']          = 'Lista de alumnos';

        $config['base_url']        = base_url().'alumno/index';
        $config['total_rows']      = $this->model_alumno->num_alumnos();
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
        // Resultado de la busqueda
        $query = $this->input->get('search', TRUE);

        if ($query){
            $result = $this->model_alumno->buscar(trim($query));
            //Comprueba si la busqueda es verdadera te mostrara los datos.
            if($result != FALSE){
                $data['resultado'] = $result;
                $data['pagination'] = '';
            }else{
                $data['resultado'] = '';
                $data['pagination'] = '';
            }
        }else{
        $result             = $this->model_alumno->get_pagination($config['per_page']);
        $data['resultado']  = $result;
        $data['pagination'] = $this->pagination->create_links();
            }
		$this->load->view('template/header', $titulo);
		$this->load->view('alumno/index', $data);
		$this->load->view('template/footer');

	}
    // Export data in CSV format
    public function exportCSV(){
    // file name
    $filename = 'alumnos_'.date('Ymd').'.csv';
    header("Content-Description: File Transfer");
    header("Content-Disposition: attachment; filename=$filename");
    header("Content-Type: application/csv; ");
    // get data
    $usersData = $this->model_alumno->getUserDetails();

    // file creation
    $file = fopen('php://output', 'w');

    $header = array("noControl","nombre_al","aPaterno_al","aMaterno_al","idCarrera");
    fputcsv($file, $header);
    foreach ($usersData as $key=>$line){
     fputcsv($file,$line);
    }
    fclose($file);
    exit;
    }
	public function agregar()
	{
		$titulo['titulo'] = 'Agregar alumno';
        $data['carreras'] = $this->model_alumno->Carreras();

		$this->load->view('template/header', $titulo);
		$this->load->view('alumno/agregar', $data);
		$this->load->view('template/footer');
	}
    public function guardar(){
        $this->form_validation->set_error_delimiters('<div class ="text-danger">', '</div>');
        $this->form_validation->set_rules('noControl','Numero de Control','required|numeric|min_length[8]|is_unique[Alumno.noControl]');
        $this->form_validation->set_rules('nombre_al','Nombre','required|trim|strtoupper');
        $this->form_validation->set_rules('aPaterno_al','Apellido Paterno','required|trim|strtoupper');
        $this->form_validation->set_rules('aMaterno_al','Apellido Materno','required|trim|strtoupper');
        $this->form_validation->set_rules('idCarrera','Carrera','required');
        if ($this->form_validation->run() == FALSE){
            //Error
        $this->agregar();
        }else{
        $data = array(
            'noControl'   => $this->input->post('noControl'),
            'nombre_al'   => $this->input->post('nombre_al'),
            'aPaterno_al' => $this->input->post('aPaterno_al'),
            'aMaterno_al' => $this->input->post('aMaterno_al'),
            'idCarrera'   => $this->input->post('idCarrera')
        );
        $this->model_alumno->guardar($data);
        $titulo['titulo'] = 'Agregar alumno';
        //Se muestran los equpos disponibles
        $data['totaE']    = $this->model_controllab->Total_Computadoras();
        $data['estatus']  = $this->model_controllab->estatus();
        $this->load->view("template/header", $titulo);
        $this->load->view("controllab/index", $data);
        $this->load->view("template/footer");
        }
    }
	public function modificar()
	{
        $titulo['titulo']  = 'Modificar alumno';
        $data['noControl'] = $this->uri->segment(3);
        $data['carreras']  = $this->model_alumno->Carreras();

        if (!$data['noControl']) {
            redirect('home');
        }else{
        $data['resultados'] = $this->model_alumno->modificar($data['noControl']);
        }

		$this->load->view('template/header', $titulo);
		$this->load->view('alumno/modificar', $data);
		$this->load->view('template/footer');
	}

    public function actualizar()
    {
        $id = $this->uri->segment(3);
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        $this->form_validation->set_rules('noControl','Numero de Control','required|numeric|min_length[8]');
        $this->form_validation->set_rules('nombre_al','Nombre','required|trim|strtoupper');
        $this->form_validation->set_rules('aPaterno_al','Apellido Paterno','required|trim|strtoupper');
        $this->form_validation->set_rules('aMaterno_al','Apellido Materno','required|trim|strtoupper');
        $this->form_validation->set_rules('idCarrera','Carrera','required');
        if ($this->form_validation->run() == FALSE){
            //Error
        $this->modificar();
        }else{
        $data = array(
            'noControl'   => $this->input->post('noControl'),
            'nombre_al'   => $this->input->post('nombre_al'),
            'aPaterno_al' => $this->input->post('aPaterno_al'),
            'aMaterno_al' => $this->input->post('aMaterno_al'),
            'idCarrera'   => $this->input->post('idCarrera')
        );
        $this->model_alumno->actualizar($id, $data);
        redirect( base_url(). 'alumno');
        }
    }

    public function eliminar()
    {
        $noControl = $this->uri->segment(3);
        $delete    = $this->model_alumno->eliminar($noControl);
        if ($delete == false) {
            redirect('alumno');
        }
        else{
            redirect('alumno');
        }
    }
}

?>