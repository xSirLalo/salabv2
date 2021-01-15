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
        $titulo['titulo']          = 'Equipos de Computo';

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
        $this->form_validation->set_rules('fabricante','Fabricante','trim|required|strtoupper');
        $this->form_validation->set_rules('procesador','Procesador','trim|required|strtoupper');
        $this->form_validation->set_rules('memoriaInstalada','Memoria RAM instalada','trim|required|strtoupper');
        $this->form_validation->set_rules('discoDuro','Disco Duro','trim|required|strtoupper');
        $this->form_validation->set_rules('soVersion','Sistema Operativo','trim|required|strtoupper');
        $this->form_validation->set_rules('tipoSistema','Tipo de Sistemas','trim|required|strtoupper');
        $this->form_validation->set_rules('numeroSerie','Numero de Serie','trim|required|strtoupper');
        $this->form_validation->set_rules('comentarios','Comentarios','trim|strtoupper');
        $this->form_validation->set_rules('idAula','Aula','trim|required');
        $this->form_validation->set_rules('idEstatus','Estatus','trim|required');
        $this->form_validation->set_rules('control','Control','trim|numeric');
        $this->form_validation->set_rules('comp_ip','IP','trim|valid_ip');
        $this->form_validation->set_rules('comp_numero','Computadora N°','trim|numeric');
        if ($this->form_validation->run() == FALSE){
            //Error
        $this->agregar();
        }else{
            //Si el campo control esta Vacio se pondra en 0
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
            'idEstatus'        => $this->input->post('idEstatus'),
            'control'          => $valControl,
            'comp_ip'          => $this->input->post('comp_ip'),
            'comp_numero'      => $this->input->post('comp_numero'),
            'fechaAlta'        => date('Y-m-d H:i:s'),
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
        $this->form_validation->set_rules('fabricante','Fabricante','trim|required|strtoupper');
        $this->form_validation->set_rules('procesador','Procesador','trim|required|strtoupper');
        $this->form_validation->set_rules('memoriaInstalada','Memoria RAM instalada','trim|required|strtoupper');
        $this->form_validation->set_rules('discoDuro','Disco Duro','trim|required|strtoupper');
        $this->form_validation->set_rules('soVersion','Sistema Operativo','trim|required|strtoupper');
        $this->form_validation->set_rules('tipoSistema','Tipo de Sistemas','trim|required|strtoupper');
        $this->form_validation->set_rules('numeroSerie','Numero de Serie','trim|required|strtoupper');
        $this->form_validation->set_rules('comentarios','Comentarios','trim|strtoupper');
        $this->form_validation->set_rules('idAula','Aula','trim|required');
        $this->form_validation->set_rules('idEstatus','Estatus','trim|required');
        $this->form_validation->set_rules('control','Control','trim|numeric');
        $this->form_validation->set_rules('comp_ip','IP','trim|valid_ip');
        $this->form_validation->set_rules('comp_numero','Computadora N°','trim|numeric');
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
            'idEstatus'        => $this->input->post('idEstatus'),
            'control'          => $valControl,
            'comp_ip'          => $this->input->post('comp_ip'),
            'comp_numero'      => $this->input->post('comp_numero'),
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

    public function descargarPDF(){
        //load pdf library
        $this->load->library('Pdf');

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('SALAB');
        $pdf->SetTitle('Reporte');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

        // set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' del '.date('d-m-Y'), PDF_HEADER_STRING);

        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__).'/lang/spa.php')) {
            require_once(dirname(__FILE__).'/lang/spa.php');
            $pdf->setLanguageArray($l);
        }

        // ---------------------------------------------------------

        // set font
        $pdf->SetFont('times', '', 10);

        // add a page
        $pdf->AddPage();

        // set cell padding
        $pdf->setCellPaddings(1, 1, 1, 1);

        // set cell margins
        $pdf->setCellMargins(1, 1, 1, 1);

        // set color for background
        $pdf->SetFillColor(255, 255, 127);

        // MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)
        $title = '<h1>Equipos de Computo</h1>';
        $computadorasInfo = $this->model_computadora->Computadoras();
        $pdf->writeHTMLCell(0, 0, '', '', $title, 0, 1, 0, true, 'C', true);
        $table = '<table style="border:1px solid #000; padding:6px;" class="table" >';
        $table .= ' <tr>
                        <th width="35%" style="border:1px solid #000;">SERIE</th>
                        <th width="35%" style="border:1px solid #000;">ALTA</th>
                        <th width="13%" style="border:1px solid #000;">ESTATUS</th>
                        <th width="12%" style="border:1px solid #000;">AULA</th>
                    </tr>';
        $no = 1;
        foreach ($computadorasInfo as $computadora) {
        $table .=   '<tr>
                        <td style="border:1px solid #000;">'.$computadora->numeroSerie.'</td>
                        <td style="border:1px solid #000;">'.$computadora->fechaIngreso.'</td>
                        <td style="border:1px solid #000;">'.$computadora->nombre_estatus.'</td>
                        <td style="border:1px solid #000;">'.$computadora->nombre_au.'</td>
                    </tr>';
        }
        $table .= '</table>';
        $pdf->writeHTMLCell(0, 0, '', '', $table, 0, 1, 0, true, 'C', true);

        // move pointer to last page
        $pdf->lastPage();

        // ---------------------------------------------------------

        //Close and output PDF document
        if (ob_get_contents()) ob_end_clean();
		
        //$pdf->Output('example_005.pdf', 'I');
        $pdf->Output('computadoras_'.date('dmY').'.pdf', 'D');
        //============================================================+
        // END OF FILE
        //============================================================+

    }

}

?>