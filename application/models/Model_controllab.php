<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_ControlLab extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
    //PAGINACION DE INICIO DEL ControlLab
    function num_ControlLabs(){
        $this->db->order_by("idControlLab", "desc");
        $number = $this->db->query("select count(*) as number from ControlLab")->row()->number;
        return intval($number);
    }
    function get_pagination($number_per_page){
        $this->db->select('idControlLab, fechaInicio, fechaFin, noControl, comentarios, ControlLab.idEstatus as asignado');
        $this->db->from('ControlLab');
        $this->db->join('Computadora', 'Computadora.idComputadora = ControlLab.idComputadora');
        $query = $this->db->get('', $number_per_page, $this->uri->segment(3));
        if ($query -> num_rows() > 0){
            return $query;
        }else{
            return false;
        }
    }
    // FIN DE PAGINACION
    function guardar($data,$idComputadora){
        //metodo para comprobar computadoras disponibles y ponerlas ocupadas una vez ingresado el numero de control
        $control = array(
            'control' => '2'
            );

        $this->db->where('idComputadora', $idComputadora);
        $this->db->where('Control','1');
        $this->db->where('idAula','1');
        $this->db->where('idEstatus','3');
        $query = $this->db->get('Computadora');
        if ($query->num_rows() > 0){
        foreach ($query->result() as $fila) {
        if ($fila->control == 1) {
        $this->db->insert('ControlLab',$data);
        $this->db->where('idComputadora', $idComputadora);
        $this->db->update('Computadora', $control);
        $this->session->set_flashdata('success', "<div class='alert alert-info alert-dismissible fade in'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Info!</strong> Ocupe la $fila->comentarios
                </div>
            ");
            return false;
            }
        }
        }else{
        $this->session->set_flashdata('error', "<div class='alert alert-danger alert-dismissible fade in'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Danger!</strong> No hay Computadoras Disponibles
                </div>
            ");
            return false;
        }
    }
    function consulta_estatus($noControl){
        $status = array(
           'idEstatus' => '2'
        );
        $control = array(
            'control' => '1'
        );
        $this->db->where('noControl', $noControl);
        $this->db->where('idEstatus', 1);
        $query = $this->db->get('ControlLab');
        foreach ($query->result() as $fila) {
        if ($fila->fechaFin==NULL && $fila->idEstatus == 1) {
        $this->db->where('noControl', $noControl);
        $this->db->update('ControlLab', $status);
        $this->db->where('idComputadora', $fila->idComputadora);
        $this->db->update('Computadora', $control);
        $this->session->set_flashdata('success', "<div class='alert alert-info alert-dismissible fade in'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Info!</strong> Vuelva pronto
                </div>
            ");
                return 'cambia_status';
        } 
        }

    }
    function Computadoras(){   
        $this->db->from('Computadora');
        $this->db->where('Control','1');
        $this->db->where('idAula','1');
        $this->db->where('idEstatus','3'); //Computadoras disponibles con el estatus Alta con el ID 3
        $this->db->order_by('rand()');
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() >= 1){
            foreach ($query->result() as $fila) {
                $datos[] = $fila;
            }
            return $datos;
        }else{
            return 'error';
        }
    }
    function Computadoras_disponibles(){   
        $this->db->from('Computadora');
        $this->db->where('Control','1');
        $this->db->where('idAula','1');
        $this->db->where('idEstatus','3'); //Computadoras disponibles con el estatus Alta con el ID 3
        $query = $this->db->get();
        $count = $query->result();
            return count($count);
    }
    function consulta_alumno($noControl){
        $this->db->where('noControl', $noControl);
        $query = $this->db->get('alumno');
        if ($query->num_rows() >= 1){
            foreach ($query->result() as $fila) {
                $datos[] = $fila;
            }
            return $datos;
        }else{
            return 'no_registrado';
        }
    }
    function Estatus(){
        $this->db->from('Estatus');
        $this->db->order_by("idEstatus", "asc");
        $query = $this->db->get();
        return $query -> result();
    }
    function reporte($fechaInicio,$fechaFin){
        $this->db->select('Carrera.idCarrera, Carrera.nombre_ca, count(*) as total');
        $this->db->from('ControlLab');
        $this->db->join('alumno', 'alumno.noControl = ControlLab.noControl');
        $this->db->join('Carrera', 'Carrera.idCarrera = alumno.idCarrera');
        $this->db->where('fechaInicio >=', $fechaInicio);
        $this->db->where('fechaFin <= date_add("'.$fechaFin.'", interval 1 day)');
        $this->db->group_by('Carrera.idCarrera');
        $query = $this->db->get();
        if ($query -> num_rows() > 0){
            return $query;
        }else{
            return FALSE;
        }

    }
}

?>