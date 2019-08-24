<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;

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
	public function Index(){
        $titulo['titulo']          = 'Lista de alumnos';

        $config['base_url']        = base_url().'alumno/index';
        $config['total_rows']      = $this->model_alumno->num_alumnos();
        $config['per_page']        = 50 ;
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
	public function agregar(){
		$titulo['titulo'] = 'Agregar alumno';
        $data['carreras'] = $this->model_alumno->Carreras();

		$this->load->view('template/header', $titulo);
		$this->load->view('alumno/agregar', $data);
		$this->load->view('template/footer');
	}
    public function guardar(){
        $this->form_validation->set_error_delimiters('<div class ="text-danger">', '</div>');
        $this->form_validation->set_rules('noControl','Numero de Control','required|trim|is_unique[Alumno.noControl]|min_length[6]|max_length[12]');
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
        $data['resultado']  = $this->model_controllab->Todas_Computadoras();
        $this->load->view("template/header", $titulo);
        $this->load->view("controllab/index", $data);
        $this->load->view("template/footer");
        }
    }
	public function modificar(){
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

    public function actualizar(){
        $id = $this->uri->segment(3);
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        $this->form_validation->set_rules('noControl','Numero de Control','required|trim|min_length[6]|max_length[12]');
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
    public function eliminar(){
        $noControl = $this->uri->segment(3);
        $delete    = $this->model_alumno->eliminar($noControl);
        if ($delete == false) {
            redirect('alumno');
        }
        else{
            redirect('alumno');
        }
    }
    
    public function descargarEXCEL(){
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Alumnos Registrados');
        //$sheet->getDefaultStyle()->getFont()->setName('Times New Roman');
        $sheet->setCellValue('A1', 'Alumnos Registrados');
        $sheet->getStyle("A1")->getFont()->setSize(16);
        $sheet->getStyle('A3:E3')->applyFromArray(
           array(
              'fill' => array(
                  'type' => Fill::FILL_SOLID,
                  'color' => array('rgb' => 'E5E4E2' )
              ),
              'font'  => array(
                  'bold'  =>  true
              )
           )
         );
        // get data
        $alumnoData = $this->model_alumno->getStudentDetails();
        $sheet->setCellValue('A3', 'noControl');
        $sheet->setCellValue('B3', 'Nombre');
        $sheet->setCellValue('C3', 'Apellido Paterno');
        $sheet->setCellValue('D3', 'Apellido Materno');
        $sheet->setCellValue('E3', 'Carrera');
        $rows = 4;
        foreach ($alumnoData as $val){
            $sheet->setCellValue('A' . $rows, $val['noControl']);
            $sheet->setCellValue('B' . $rows, $val['nombre_al']);
            $sheet->setCellValue('C' . $rows, $val['aPaterno_al']);
            $sheet->setCellValue('D' . $rows, $val['aMaterno_al']);
            $sheet->setCellValue('E' . $rows, $val['nombre_ca']);
            $rows++;
        foreach (range('B','E') as $col) {
          $sheet->getColumnDimension($col)->setAutoSize(true);  
        }
        } 




        $writer = new Xlsx($spreadsheet);
        // file name
        $filename = 'alumnos_'.date('dmY');

        // file creation
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment;filename=$filename"); 
        header("Cache-Control: max-age=0");

        ob_end_clean();
        $writer->save('php://output'); // download file 
        exit;
    }
}

?>