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
    function sesion_iniciada($data,$idComputadora){
        //metodo para comprobar computadoras disponibles y ponerlas ocupadas una vez ingresado el numero de control
        $c_control = array(
            'control' => '2' // 2 - Ocupado
        );
        $buscar = array(
            'idComputadora' => $idComputadora,
            'Control' => 1,
            'idAula' => 1,
            'idEstatus' => 3
        );
        $this->db->where($buscar);
        $query = $this->db->get('Computadora');
        if ($query->num_rows() > 0){
        foreach ($query->result() as $columna) {
        if ($columna->control == 1) {
        $this->db->insert('ControlLab',$data);

        $this->db->set($c_control);
        $this->db->where('idComputadora', $idComputadora);
        $this->db->update('Computadora');
        $this->session->set_flashdata('success', "<div class='alert alert-info alert-dismissible fade in'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <h4 class='alert-heading'>Info!</h4> <p>Ocupe la <b>$columna->comentarios</b></p>
                </div>
            ");
            return false;
            }
        }
        }else{
        $this->session->set_flashdata('error', "<div class='alert alert-danger alert-dismissible fade in'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <h4 class='alert-heading'>Advertencia!</h4> <p>No hay Computadoras Disponibles</p>
                </div>
            ");
            return false;
        }
    }
    function sesion_terminada($noControl){
        $c_status = array(
           'idEstatus'   => 2, // Cambia el Estatus a Equipo Finalizaco
           'fechaFin'    => date('Y-m-d H:i:s')
        );
        $c_control = array(
            'control' => 1 // 1 = Libre
        );
        $buscar = array(
            'noControl' => $noControl,
            'idEstatus' => 1
        );
        $this->db->where($buscar);
        $columnas = $this->db->get('ControlLab');
        foreach ($columnas->result() as $columna) {// Inicio For para obtener los datos a partir del numero de control y el idEstatus
        if ($columna->idEstatus == 1) { // Se actualizan las dos tablas ligadas ControlLab y Computadora
        $Condicion = "noControl='$noControl' AND idEstatus='$columna->idEstatus'";
        $Condicion2 = "idComputadora='$columna->idComputadora' AND control='2'";
        //$this->db->select('ControlLab');
        $this->db->set($c_status);
        $this->db->where($Condicion);
        $this->db->update('ControlLab');

        //$this->db->select('Computadora');
        $this->db->set($c_control);
        $this->db->where($Condicion2);
        $this->db->update('Computadora');
        $this->session->set_flashdata('success', "<div class='alert alert-info alert-dismissible fade in'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <h4 class='alert-heading'>Info!</h4> <p>Vuelva pronto</p>
                </div>
            ");
                return 'sesion_terminada';
        }

        }//Fin For

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
    function Total_Computadoras(){   // Sinceramente este es algo tonto pero en el boton de asignar computadora muestra el total de computadoras disponibles
        $this->db->from('Computadora');
        $this->db->where('Control','1');
        $this->db->where('idAula','1');
        $this->db->where('idEstatus','3'); //Computadoras disponibles con el estatus Alta con el ID 3
        $query = $this->db->get();
        $count = $query->result();
            return count($count);
    }

    function Computadoras_Disponibles(){   
        $this->db->from('Computadora');
        $this->db->where('Control','1');
        $this->db->where('idAula','1');
        $this->db->where('idEstatus','3'); //Computadoras disponibles con el estatus Alta con el ID 3
        $this->db->order_by('comentarios');
        $query = $this->db->get();
        return $query -> result();
    }

    function Todas_Computadoras(){
        $UltimoId = "idControlLab IN (SELECT MAX(idControlLab) FROM ControlLab GROUP BY idComputadora)";
        $this->db->select('*');
        $this->db->from('ControlLab');
        $this->db->join('Computadora', 'Computadora.idComputadora = ControlLab.idComputadora');
        $this->db->where($UltimoId);
        $this->db->order_by('comentarios');
        $query = $this->db->get();
        if ($query->num_rows() > 0){
            return $query;
        }else{
            return false;
        }
    }

    function actualizar($idControlLab, $NewComputer, $OldComputer){
        $off = array('control' => '2');
        $on = array('control' => '1');

        $this->db->where('idControlLab', $idControlLab);
        $this->db->update('ControlLab', $NewComputer);

        $this->db->where('idComputadora', $NewComputer['idComputadora']);
        $this->db->update('Computadora', $off);

        $this->db->where('idComputadora', $OldComputer['idComputadora']);
        $this->db->update('Computadora', $on);
        $this->session->set_flashdata('success', "<div class='alert alert-info alert-dismissible fade in'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <h4 class='alert-heading'>Info!</h4> <p>Cambio de Computadora Correctamente!</p>
                </div>
            ");
    }
    function consulta_alumno($noControl){
        $this->db->where('noControl', $noControl);
        $query = $this->db->get('Alumno');
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
        $this->db->join('Alumno', 'Alumno.noControl = ControlLab.noControl');
        $this->db->join('Carrera', 'Carrera.idCarrera = Alumno.idCarrera');
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
    function modificar($idControlLab){
        $this->db->where('idControlLab', $idControlLab);
        $this->db->join('Computadora', 'Computadora.idComputadora = ControlLab.idComputadora');
        $query = $this->db->get('ControlLab');
        if ($query->num_rows() > 0){
            return $query;
        }else{
            return false;
        }
    }
    function getUserDetails(){

    $response = array();

    // Select record
    $this->db->select('idControlLab,fechaInicio,fechaFin,noControl,idComputadora');
    $q = $this->db->get('ControlLab');
    $response = $q->result_array();

    return $response;
    }
}

?>