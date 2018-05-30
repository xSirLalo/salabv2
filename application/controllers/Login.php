<?php
    class Login extends CI_Controller{
        function __construct(){
            parent:: __construct();
            $this -> load -> model('model_login');
        }
        public function index() {

        $this->form_validation->set_rules('email', 'E-Mail', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == FALSE) {

            if(isset($this->session->userdata['logged_in'])){
            redirect('home');
            }else{
            $this->load->view('login');
            }


        } else {
            $data = array(
            'email'    => $this->input->post('email'),
            'password' => $this->input->post('password')
            );
            $result = $this->model_login->login($data);
            if ($result == TRUE) {
            $email  = $this->input->post('email');
            $result = $this->model_login->read_user_information($email);
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
                $data = array(
                'error_message' => 'Invalid e-mail or Password'
                );
                $this->load->view('login',$data);
                }
            }
        }
        public function new_user_registration() {
        // Check validation for user input in SignUp form
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        $this->form_validation->set_rules('nombre_usr', 'Name', 'trim|required|strtoupper');
        $this->form_validation->set_rules('aPaterno_usr', 'Last name', 'trim|required|strtoupper');
        $this->form_validation->set_rules('aMaterno_usr', 'Last name', 'trim|required|strtoupper');
        $this->form_validation->set_rules('telefono', 'telefono', 'trim|required|numeric');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
        $this->load->view('register');
            } else {
                $data = array(
                'nombre_usr' => $this->input->post('nombre_usr'),
                'aPaterno_usr' => $this->input->post('aPaterno_usr'),
                'aMaterno_usr' => $this->input->post('aMaterno_usr'),
                'telefono' => $this->input->post('telefono'),
                'email' => $this->input->post('email'),
                'password' => md5($this->input->post('password'))
                );

                $result = $this->model_login->registration_insert($data);
                if ($result == TRUE) {
                    $data['message_display'] = 'Registration Successfully !';
                    $this->load->view('login', $data);
                } else {
                    $data['message_display'] = 'Username already exist!';
                    $this->load->view('register', $data);
                }
            }
        }

        public function loguot(){
            // Removing session data
            $sess_array = array(
            'email' => ''
            );
            $this->session->unset_userdata('logged_in', $sess_array);
            $data['message_display'] = 'Successfully Logout';
            $this->load->view('login', $data);
        }
    } // FIN CI_Controller

    //  https://www.uno-de-piera.com/permisos-de-usuarios-en-codeigniter/
    //  https://www.formget.com/form-login-codeigniter/
?>