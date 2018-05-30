<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Computadora extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('pagination');
        $this->load->helper('form');
		$this->load->model('model_computadora');
	}

	public function Index()
	{
        $titulo['titulo']          = 'Lista de computadoras';

        $config['base_url']        = base_url().'computadora/index/';
        $config['total_rows']      = $this->model_computadora->num_computadoras();
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
        // Datos para filtrar
        $data['aulas']       = $this->model_computadora->Aulas();
        $data['estatus']     = $this->model_computadora->Estatus();
        // Filtrar Lista
        $f_data['idAula']    = $this->input->post('idAula', TRUE);
        $f_data['idEstatus'] = $this->input->post('idEstatus', TRUE);

        if ($f_data){
            $result = $this->model_computadora->Filtrar($f_data);
            if($result != FALSE){
                $data['resultado']  = $result;
                $data['pagination'] = '';
            }else{
                $data['resultado']  = '';
                $data['pagination'] = '';
            }
        }else{
        $result             = $this->model_computadora->get_pagination($config['per_page']);
        $data['resultado']  = $result;
        $data['pagination'] = $this->pagination->create_links();
            }

		$this->load->view('template/header', $titulo);
		$this->load->view('computadora/index', $data);
		$this->load->view('template/footer');

	}
    public function agregar(){
        $titulo['titulo'] = 'Agregar computadora';
        $data['estatus']  = $this->model_computadora->Estatus();
        $data['aulas']    = $this->model_computadora->Aulas();
        $this->load->view("template/header", $titulo);
        $this->load->view("computadora/agregar", $data);
        $this->load->view("template/footer");
    }
    public function guardar(){
        $this->form_validation->set_error_delimiters('<div class ="text-danger">', '</div>');
        $this->form_validation->set_rules('fabricante','Fabricante','required|strtoupper');
        $this->form_validation->set_rules('procesador','Procesador','required|strtoupper');
        $this->form_validation->set_rules('memoriaInstalada','Memoria RAM instalada','required|strtoupper');
        $this->form_validation->set_rules('discoDuro','Disco Duro','required|strtoupper');
        $this->form_validation->set_rules('soVersion','Sistema Operativo','required|strtoupper');
        $this->form_validation->set_rules('tipoSistema','Tipo de Sistemas','required|strtoupper');
        $this->form_validation->set_rules('numeroSerie','Numero de Serie','required|strtoupper');
        $this->form_validation->set_rules('comentarios','Comentarios','strtoupper');
        $this->form_validation->set_rules('idAula','Aula','required');
        $this->form_validation->set_rules('control','Control','numeric');
        $this->form_validation->set_rules('idEstatus','Estatus','required');
        if ($this->form_validation->run()                        == FALSE){
            //Error
        $this->agregar();
        }else{
            //Si el campo contro esta Vacio se pondra en 0
        $valControl = $this->input->post('control');
        if($valControl==''){$valControl = 0;}

        $data = array(
            'fabricante'       => $this->input->post('fabricante'),
            'procesador'       => $this->input->post('procesador'),
            'memoriaInstalada' => $this->input->post('memoriaInstalada'),
            'discoDuro'        => $this->input->post('discoDuro'),
            'soVersion'        => $this->input->post('soVersion'),
            'tipoSistema'      => $this->input->post('tipoSistema'),
            'numeroSerie'      => $this->input->post('numeroSerie'),
            'comentarios'      => $this->input->post('comentarios'),
            'idAula'           => $this->input->post('idAula'),
            'control'          => $valControl,
            'idEstatus'        => $this->input->post('idEstatus'),
            'fechaAlta'        => date('Y-m-d H:i:s')
        );
        $this->model_computadora->guardar($data);
        redirect( base_url(). 'computadora');
        }
    }
    public function modificar()
    {
        $titulo['titulo']      = 'Modificar computadora';
        $data['idComputadora'] = $this->uri->segment(3);
        $data['estatus']       = $this->model_computadora->Estatus();
        $data['aulas']         = $this->model_computadora->Aulas();
            //Previene error si no encuentra el ID
        if (!$data['idComputadora']) {
            redirect('home');
        }else{
            $data['resultados'] = $this->model_computadora->modificar($data['idComputadora']);
        }

        $this->load->view('template/header', $titulo);
        $this->load->view('computadora/modificar', $data);
        $this->load->view('template/footer');
    }
    public function actualizar(){
        $id = $this->uri->segment(3);
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        $this->form_validation->set_rules('fabricante','Fabricante','required|strtoupper');
        $this->form_validation->set_rules('procesador','Procesador','required|strtoupper');
        $this->form_validation->set_rules('memoriaInstalada','Memoria RAM instalada','required|strtoupper');
        $this->form_validation->set_rules('discoDuro','Disco Duro','required|strtoupper');
        $this->form_validation->set_rules('soVersion','Sistema Operativo','required|strtoupper');
        $this->form_validation->set_rules('tipoSistema','Tipo de Sistemas','required|strtoupper');
        $this->form_validation->set_rules('numeroSerie','Numero de Serie','required|strtoupper');
        $this->form_validation->set_rules('comentarios','Comentarios','strtoupper');
        $this->form_validation->set_rules('idAula','Aula','required');
        $this->form_validation->set_rules('control','Control','numeric');
        $this->form_validation->set_rules('idEstatus','Estatus','required');
        if ($this->form_validation->run() == FALSE){
            //Error
        $this->modificar();
        }else{
            //Si el campo contro esta Vacio se pondra en 0
        $valControl = $this->input->post('control');
        if($valControl==''){$valControl = 0;}

        $data = array(
            'fabricante'       => $this->input->post('fabricante'),
            'procesador'       => $this->input->post('procesador'),
            'memoriaInstalada' => $this->input->post('memoriaInstalada'),
            'discoDuro'        => $this->input->post('discoDuro'),
            'soVersion'        => $this->input->post('soVersion'),
            'tipoSistema'      => $this->input->post('tipoSistema'),
            'numeroSerie'      => $this->input->post('numeroSerie'),
            'comentarios'      => $this->input->post('comentarios'),
            'idAula'           => $this->input->post('idAula'),
            'control'          => $valControl,
            'idEstatus'        => $this->input->post('idEstatus')
        );
        $this->model_computadora->actualizar($id, $data);
        redirect( base_url(). 'computadora');
        }
    }
    public function eliminar()
    {
        $idComputadora = $this->uri->segment(3);
        $delete        = $this->model_computadora->eliminar($idComputadora);
        if ($delete == false) {
            redirect('computadora');
        }
        else{
            redirect('computadora');
        }
    }
}

?>