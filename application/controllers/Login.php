<?php
    class Login extends CI_Controller{
        function __construct(){
            parent:: __construct();
            $this->load->model('model_login');
        }
        public function index() {
        $titulo['titulo']    = 'Login';
        $this->form_validation->set_rules('email', 'E-Mail', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == FALSE) {

            if(isset($this->session->userdata['logged_in'])){
            redirect('home');
            }else{
                $this->load->view('template/header-login',$titulo);
                $this->load->view('login');
                $this->load->view('template/footer-login');
            }


        } else {
            $data = array(
            'email'    => $this->input->post('email'),
            'password' => $this->input->post('password')
            );
            $result = $this->model_login->login($data);
            if ($result == TRUE) {
            $result = $this->model_login->read_user_information($data);
            $totalI = $this->model_incidencia->incidencias_no_atendidas();
            if ($result != false) {
                $session_data = array(
                    //Extrae la informacion del usuario
                'idUsuario'     => $result[0]->idUsuario,
                'nombre_usr'    => $result[0]->nombre_usr,
                'aPaterno_usr'  => $result[0]->aPaterno_usr,
                'email'         => $result[0]->email,
                'idTipoUsuario' => $result[0]->idTipoUsuario,
                );
                // Add user data in session
                $this->session->set_userdata('logged_in', $session_data);
                redirect('home');
            }

            } else {
                $data['error_message'] = 'Invalid e-mail or Password';
                $this->load->view('template/header-login',$titulo);
                $this->load->view('login',$data);
                $this->load->view('template/footer-login');
                }
            }
        }
        public function new_user_registration() {
        $titulo['titulo']    = 'Crear cuenta';
        // Check validation for user input in SignUp form
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        $this->form_validation->set_rules('nombre_usr', 'Name', 'trim|required|strtoupper');
        $this->form_validation->set_rules('aPaterno_usr', 'Last name', 'trim|required|strtoupper');
        $this->form_validation->set_rules('aMaterno_usr', 'Last name', 'trim|required|strtoupper');
        $this->form_validation->set_rules('telefono', 'telefono', 'trim|required|numeric');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
        $this->load->view('template/header-login',$titulo);
        $this->load->view('register');
        $this->load->view('template/footer-login');
            } else {
                $data = array(
                'nombre_usr'    => $this->input->post('nombre_usr'),
                'aPaterno_usr'  => $this->input->post('aPaterno_usr'),
                'aMaterno_usr'  => $this->input->post('aMaterno_usr'),
                'telefono'      => $this->input->post('telefono'),
                'email'         => $this->input->post('email'),
                'password'      => md5($this->input->post('password')),
                'fechaCreacion' => date('Y-m-d H:i:s')
                );

                $result = $this->model_login->registration_insert($data);
                if ($result == TRUE) {
                    $data['message_display'] = 'Registration Successfully !';
                    $this->load->view('template/header-login',$titulo);
                    $this->load->view('login',$data);
                    $this->load->view('template/footer-login');
                } else {
                    $data['message_display'] = 'E-Mail already exist!';
                    $this->load->view('template/header-login',$titulo);
                    $this->load->view('register',$data);
                    $this->load->view('template/footer-login');
                }
            }
        }
        public function forgot_password() {
        $titulo['titulo']    = 'Olvido de contraseña';
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('template/header-login',$titulo);
            $this->load->view('fPassword');
            $this->load->view('template/footer-login');
            } else {
                $data = array(
                'email'         => $this->input->post('email'),
                );

                $result = $this->model_login->forgot($data);
                if ($result == TRUE) {
                    $data['message_display'] = 'Contraseña restablecida !';
                    $data['link'] = $result;
                    $this->load->view('template/header-login',$titulo);
                    $this->load->view('fPassword',$data);
                    $this->load->view('template/footer-login');
                } else {
                    $data['message_display'] = 'No existe usuario en la base de datos';
                    $this->load->view('template/header-login',$titulo);
                    $this->load->view('fPassword',$data);
                    $this->load->view('template/footer-login');
                }
            }
        }
        public function reset_password() {
        $titulo['titulo']    = 'Reinicio de contraseña';
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        $this->form_validation->set_data($_GET);
        $this->form_validation->set_rules('selector', '', 'trim|required');
        $this->form_validation->set_rules('validator', '', 'trim|required');
        $this->form_validation->set_rules('password','Contraseña','required|min_length[3]|trim',array('required' => 'Escriba una contraseña'));
        $this->form_validation->set_rules('passwordconf','Repetir contraseña','matches[password]|trim');
        if ($this->form_validation->run() == FALSE) {
        $this->load->view('template/header-login',$titulo);
        $this->load->view('rPassword');
        $this->load->view('template/footer-login');
        //var_dump($this->form_validation->error_array());
            } else {
                $data = array(
                'selector'  => $this->input->get('selector'),
                'validator' => $this->input->get('validator'),
                'password'  => $this->input->get('password'),
                );
                $result = $this->model_login->valid_token($data);
                if ($result == TRUE) {
                    $data['message_display'] = 'Contraseña restablecida !';
                    $this->load->view('template/header-login',$titulo);
                    $this->load->view('rPassword',$data);
                    $this->load->view('template/footer-login');
                } else {
                    $data['message_display'] = 'El token ha expirado';
                    $this->load->view('template/header-login',$titulo);
                    $this->load->view('rPassword',$data);
                    $this->load->view('template/footer-login');
                }
                redirect('login', 'refresh');
            }
        }
        public function template_mail()
        {
            $this->load->view('template/header-login');
            $this->load->view('template/mail_test');
            $this->load->view('template/footer-login');
        }
        public function loguot(){
            // Removing session data
            $sess_array = array(
            'email' => ''
            );
            $this->session->unset_userdata('logged_in', $sess_array);
            $data['message_display'] = 'Successfully Logout';
            redirect('login', 'refresh');
        }
    } // FIN CI_Controller

    //  https://www.uno-de-piera.com/permisos-de-usuarios-en-codeigniter/
    //  https://www.formget.com/form-login-codeigniter/
?>