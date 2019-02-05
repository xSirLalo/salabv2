<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('pagination','form_validation');
        $this->load->helper('form');
		$this->load->model('model_usuario');
	}

	public function Index()
	{
        $titulo['titulo']          = 'Lista de usuarios';
        
        $config['base_url']        = base_url().'usuario/index';
        $config['total_rows']      = $this->model_usuario->num_usuarios();
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

        $query = $this->input->get('search', TRUE);
        if ($query){
            $result = $this->model_usuario->buscar(trim($query));
            if($result != FALSE){
                $data['resultado']  = $result;
                $data['pagination'] = '';
            }else{
                $data['resultado']  = '';
                $data['pagination'] = '';
            }
        }else{
        $result             = $this->model_usuario->get_pagination($config['per_page']);
        $data['resultado']  = $result;
        $data['pagination'] = $this->pagination->create_links();
            }
		$this->load->view('template/header', $titulo);
		$this->load->view('usuario/index', $data);
		$this->load->view('template/footer');
	}
	public function agregar()
	{
        $titulo['titulo']    = 'Agregar usuario';
        $data['tipoUsuario'] = $this->model_usuario->tipoUsuario();
        $data['estatus']     = $this->model_usuario->estatus();
		$this->load->view('template/header', $titulo);
		$this->load->view('usuario/agregar', $data);
		$this->load->view('template/footer');
	}
    public function guardar(){
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        $this->form_validation->set_rules('nombre_usr','Nombre','required|trim|strtoupper');
        $this->form_validation->set_rules('aPaterno_usr','Apellido Paterno','required|trim|strtoupper');
        $this->form_validation->set_rules('aMaterno_usr','Apellido Materno','required|trim|strtoupper');
        $this->form_validation->set_rules('email','Correo Electronico','required|is_unique[usuario.email]|valid_email');
        $this->form_validation->set_rules('emailconf','Repetir Correo Electronico','required|matches[email]');
        $this->form_validation->set_rules('password','Contraseña','required|min_length[6]');
        $this->form_validation->set_rules('passwordconf','Repetir contraseña','required|matches[password]');
        $this->form_validation->set_rules('telefono','Telefono','required|numeric');
        $this->form_validation->set_rules('idTipoUsuario','Tipo de Usuario','required');
        $this->form_validation->set_rules('idEstatus','Estatus','required');
        if ($this->form_validation->run() == FALSE){
            //Error
        $this->agregar();
        }else{
        $data = array(
            'nombre_usr'    => $this->input->post('nombre_usr'),
            'aPaterno_usr'  => $this->input->post('aPaterno_usr'),
            'aMaterno_usr'  => $this->input->post('aMaterno_usr'),
            'email'         => $this->input->post('email'),
                                //Contraseña encriptada en MD5
            'password'      => md5($this->input->post('password')),
            'telefono'      => $this->input->post('telefono'),
            'idTipoUsuario' => $this->input->post('idTipoUsuario'),
            'idEstatus'     => $this->input->post('idEstatus'),
            'fechaCreacion' => date('Y-m-d H:i:s')
        );
        $this->model_usuario->guardar($data);
        redirect( base_url(). 'usuario');
        }
    }
	public function modificar()
	{
        $titulo['titulo']    = 'Editar perfil';
        $data['idUsuario']   = $this->uri->segment(3);
        $data['tipoUsuario'] = $this->model_usuario->tipoUsuario();
        $data['estatus']     = $this->model_usuario->estatus();
        if ($this->session->userdata['logged_in']['idUsuario'] == $data['idUsuario']) {
            $data['resultados']  = $this->model_usuario->modificar($data['idUsuario']);    
        }else{
            redirect('home');
        }
		$this->load->view('template/header', $titulo);
		$this->load->view('usuario/modificar', $data);
		$this->load->view('template/footer');
	}
    public function actualizar()
    {
        $id = $this->uri->segment(3);
        $statusReset = $this->input->post('reset_field');
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        $this->form_validation->set_rules('nombre_usr','Nombre','required|trim|strtoupper');
        $this->form_validation->set_rules('aPaterno_usr','Apellido Paterno','required|trim|strtoupper');
        $this->form_validation->set_rules('aMaterno_usr','Apellido Materno','required|trim|strtoupper');
        $this->form_validation->set_rules('email','Correo Electronico','required|valid_email');
        $this->form_validation->set_rules('emailconf','Repetir Correo Electronico','required|matches[email]');
        $this->form_validation->set_rules('telefono','Telefono','required|numeric');
        $this->form_validation->set_rules('idTipoUsuario','Tipo de Usuario','required');
        $this->form_validation->set_rules('idEstatus','Estatus','required');
        if ($this->form_validation->run() == FALSE){
            //Error
        $this->modificar();
        }else{
        $data = array(
            'nombre_usr'    => $this->input->post('nombre_usr'),
            'aPaterno_usr'  => $this->input->post('aPaterno_usr'),
            'aMaterno_usr'  => $this->input->post('aMaterno_usr'),
            'email'         => $this->input->post('email'),
            'telefono'      => $this->input->post('telefono'),
            'idTipoUsuario' => $this->input->post('idTipoUsuario'),
            'idEstatus'     => $this->input->post('idEstatus'),
        );
        //Verifica el Checkbox si esta activo para hacer una actualizacion a la contraseña
         if($statusReset == "on")
        {
        $this->form_validation->set_rules('password','Contraseña','min_length[6]');
        $this->form_validation->set_rules('passwordconf','Repetir contraseña','matches[password]');
        $data = array(
            //Se actualiza con encriptacion MD5
            'password' => md5($this->input->post('password'))
        );
        //Actualiza la informacion del usuario
        }
        $this->model_usuario->actualizar($id, $data);
        redirect( base_url());
        }

        
    }

    public function eliminar()
    {
        $idUsuario = $this->uri->segment(3);
        $delete    = $this->model_usuario->eliminar($idUsuario);
        if ($delete == false) {
            redirect('profesor');
        }
        else{
            redirect('profesor');
        }
    }
}

?>