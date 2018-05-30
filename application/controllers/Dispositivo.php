<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dispositivo extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('pagination');
        $this->load->helper('form');
		$this->load->model('model_dispositivo');
	}

	public function Index()
	{
        $titulo['titulo']          = 'Lista de dispositivos';
       
        $config['base_url']        = base_url().'dispositivo/index/';
        $config['total_rows']      = $this->model_dispositivo->num_dispositivos();
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
        $data['aulas']               = $this->model_dispositivo->Aulas();
        $data['tipoDispositivo']     = $this->model_dispositivo->TipoDispositivo();
        $data['estatus']             = $this->model_dispositivo->Estatus();
        // Filtrar Lista
        $f_data['idAula']            = $this->input->post('idAula', TRUE);
        $f_data['idTipoDispositivo'] = $this->input->post('idTipoDispositivo', TRUE);
        $f_data['idEstatus']         = $this->input->post('idEstatus', TRUE);
        if ($f_data){
            $result = $this->model_dispositivo->Filtrar($f_data);
            if($result != FALSE){
                $data['resultado']  = $result;
                $data['pagination'] = '';
            }else{
                $data['resultado']  = '';
                $data['pagination'] = '';
            }
        }else{
        $result             = $this->model_dispositivo->get_pagination($config['per_page']);
        $data['resultado']  = $result;
        $data['pagination'] = $this->pagination->create_links();
            }
		$this->load->view('template/header', $titulo);
		$this->load->view('dispositivo/index', $data);
		$this->load->view('template/footer');

	}
    public function agregar(){
        $titulo['titulo']        = 'Agregar dispositivo';
        $data['estatus']         = $this->model_dispositivo->Estatus();
        $data['tipoDispositivo'] = $this->model_dispositivo->TipoDispositivo();
        $data['aulas']           = $this->model_dispositivo->Aulas();
        $this->load->view("template/header", $titulo);
        $this->load->view("dispositivo/agregar", $data);
        $this->load->view("template/footer");
    }
    public function guardar(){
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        $this->form_validation->set_rules('fabricante','Fabricante','required|strtoupper');
        $this->form_validation->set_rules('modelo','Modelo','required|strtoupper');
        $this->form_validation->set_rules('numeroSerie','Numero de Serie','required|strtoupper');
        $this->form_validation->set_rules('idTipoDispositivo','Tipo de dispositivo','required');
        $this->form_validation->set_rules('fechaIngreso','Fecha de Ingreso','required');
        $this->form_validation->set_rules('comentarios','Comentarios','strtoupper');
        $this->form_validation->set_rules('idAula','Aula','required');
        $this->form_validation->set_rules('idEstatus','Estatus','required');

        if ($this->form_validation->run() == FALSE){
            //Error
        $this->agregar();
        }else{
        $data = array(
            'fabricante'        => $this->input->post('fabricante'),
            'modelo'            => $this->input->post('modelo'),
            'numeroSerie'       => $this->input->post('numeroSerie'),
            'idTipoDispositivo' => $this->input->post('idTipoDispositivo'),
            'fechaIngreso'      => $this->input->post('fechaIngreso'),
            'comentarios'       => $this->input->post('comentarios'),
            'idAula'            => $this->input->post('idAula'),
            'idEstatus'         => $this->input->post('idEstatus'),
            'fechaAlta'         => date('Y-m-d H:i:s')
        );
        $this->model_dispositivo->guardar($data);
        redirect( base_url(). 'dispositivo');
        }
    }
    public function modificar()
    {
        $titulo['titulo']        = 'Modificar dispositivo';
        $data['idDispositivo']   = $this->uri->segment(3);
        $data['estatus']         = $this->model_dispositivo->Estatus();
        $data['tipoDispositivo'] = $this->model_dispositivo->TipoDispositivo();
        $data['aulas']           = $this->model_dispositivo->Aulas();

        if (!$data['idDispositivo']) {
            redirect('home');
        }else{
            $data['resultados'] = $this->model_dispositivo->modificar($data['idDispositivo']);
        }

        $this->load->view('template/header', $titulo);
        $this->load->view('dispositivo/modificar', $data);
        $this->load->view('template/footer');
    }
    public function actualizar(){
        $id = $this->uri->segment(3);
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        $this->form_validation->set_rules('fabricante','Fabricante','required|strtoupper');
        $this->form_validation->set_rules('modelo','Modelo','required|strtoupper');
        $this->form_validation->set_rules('numeroSerie','Numero de Serie','required|strtoupper');
        $this->form_validation->set_rules('idTipoDispositivo','Tipo de dispositivo','required');
        $this->form_validation->set_rules('fechaIngreso','Fecha de Ingreso','required');
        $this->form_validation->set_rules('comentarios','Comentarios','strtoupper');
        $this->form_validation->set_rules('idAula','Aula','required');
        $this->form_validation->set_rules('idEstatus','Estatus','required');
        if ($this->form_validation->run() == FALSE){
            //Error
        $this->modificar();
        }else{
        $data = array(
            'fabricante'        => $this->input->post('fabricante'),
            'modelo'            => $this->input->post('modelo'),
            'numeroSerie'       => $this->input->post('numeroSerie'),
            'idTipoDispositivo' => $this->input->post('idTipoDispositivo'),
            'fechaIngreso'      => $this->input->post('fechaIngreso'),
            'comentarios'       => $this->input->post('comentarios'),
            'idAula'            => $this->input->post('idAula'),
            'idEstatus'         => $this->input->post('idEstatus')
        );
        $this->model_dispositivo->actualizar($id, $data);
        redirect( base_url(). 'dispositivo');
        }
    }
    public function eliminar()
    {
        $iddispositivo = $this->uri->segment(3);
        $delete        = $this->model_dispositivo->eliminar($iddispositivo);
        if ($delete == false) {
            redirect('dispositivo');
        }
        else{
            redirect('dispositivo');
        }
    }
}

?>