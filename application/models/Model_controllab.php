<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_ControlLab extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    //PAGINACION DE INICIO DE LA BITACORA
    function num_ControlLabs(){
        $this->db->order_by("idControlLab", "desc");
        $number = $this->db->query("select count(*) as number from ControlLab")->row()->number;
        return intval($number);
    }
    function get_pagination($number_per_page){
        $this->db->select('idControlLab, fechaInicio, fechaFin, noControl, ControlLab.comp_numero, ControlLab.idEstatus as asignado');
        $this->db->from('ControlLab');
        $this->db->join('Computadora', 'Computadora.comp_numero = ControlLab.comp_numero');
        $query = $this->db->get('', $number_per_page, $this->uri->segment(3));
        if ($query -> num_rows() > 0){
            return $query;
        }else{
            return false;
        }
    }
    // FIN DE PAGINACION
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

    function sesion_iniciada($data,$comp_numero){
        //metodo para comprobar computadoras disponibles y ponerlas ocupadas una vez ingresado el numero de control
        $control_c = array(
            'Computadora.control'     => '2' // 2 - Ocupado
        );
        $buscar = array(
            'Computadora.comp_numero' => $comp_numero,
            'Computadora.control'     => 1,
            'Computadora.idAula'      => 1,
            'Computadora.idEstatus'   => 3
        );
        $this->db->where($buscar);
        $query = $this->db->get('Computadora');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $columna_c) {
            //ping a equipos para verificar conexion al servidor de bloqueo y desbloqueo de JAVA
            //$windows = exec("ping -n 1 -w 1 $columna_c->comp_ip", $outcome, $status);
            //$linux = exec("/bin/ping -q -c1 $columna_c->comp_ip", $outcome, $status);
            //if($status==0) {
                    if ($columna_c->control == 1) {
                    $this->db->insert('ControlLab',$data);
                    $this->db->set($control_c);
                    $this->db->where('comp_numero', $comp_numero);
                    $this->db->update('Computadora');
                    $this->session->set_flashdata('success', "<div class='alert alert-info alert-dismissible fade in'>
                            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                            <strong>Bienvenid@!</strong> <p>Ocupe la <b>$columna_c->comp_numero</b></p>
                            </div>");
                            if ($this->opciones()) {
                                redirect( base_url() . '/cgi-bin/control.cgi?pc='.$columna_c->comp_numero.'&acc=1');
                            }
                        return true;
                    }
                //}
            }//Fin FOR Computadora
        }else{
        $this->session->set_flashdata('error', "<div class='alert alert-danger alert-dismissible fade in'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Advertencia!</strong> <p>No hay Computadoras Disponibles</p>
                </div>");
            return false;
        }
    }
    function sesion_terminada($noControl){
        $status_cl = array(
           'ControlLab.idEstatus' => 2, // Cambia el Estatus a Equipo Finalizaco
           'ControlLab.fechaFin'  => date('Y-m-d H:i:s')
        );
        $control_c = array(
            'Computadora.control' => 1 // 1 = Libre
        );
        $buscar = array(
            'ControlLab.noControl' => $noControl,
            'ControlLab.idEstatus' => 1
        );
        $this->db->where($buscar);
        $columnas_cl = $this->db->get('ControlLab');
        foreach ($columnas_cl->result() as $columna_cl) {// Inicio FOR para obtener los datos a partir del numero de control y el idEstatus
            if ($columna_cl->idEstatus == 1) { // Comprueba el estatus de la fila ControlLab
            $Condicion_cl = "noControl='$noControl' AND idEstatus='$columna_cl->idEstatus'";
            $Condicion_c = "comp_numero='$columna_cl->comp_numero' AND control='2'";
            //$this->db->select('ControlLab');
            $this->db->set($status_cl);
            $this->db->where($Condicion_cl);
            $this->db->update('ControlLab');

            $this->db->where($Condicion_c);
            $columnas_c = $this->db->get('Computadora');
                foreach ($columnas_c->result() as $columna_c) {// Inicio FOR para obtener los datos de la computadora a partir de la Condicion
                //$this->db->select('Computadora');
                $this->db->join('Computadoras', 'Computadora.comp_numero = ControlLab.comp_numero');
                $this->db->set($control_c);
                $this->db->where($Condicion_c);
                $this->db->update('Computadora');
                $this->session->set_flashdata('success', "<div class='alert alert-info alert-dismissible fade in'>
                        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                        <strong>¡Adios!</strong> <p>Vuelva pronto</p>
                        </div>");
                        if ($this->opciones()) {
                            redirect( base_url() . '/cgi-bin/control.cgi?pc='.$columna_c->comp_numero.'&acc=0');
                        }
                    return 'sesion_terminada';
                }// Fin FOR Computadora
            }// IF 
        }//Fin FOR ControlLab
    }
    function Tablero(){   
        $this->db->from('Computadora');
        
        $query = $this->db->get();
        if ($query->num_rows() > 0){
            return $query;
        }else{
            return false;
        }
    }
    function actualizar($Computadora){
        $off = array('control' => '2');
        $on  = array('control' => '1');
        $New = array('comp_numero' => $Computadora['NewComputer']);

        $this->db->where('comp_numero', $Computadora['PC']);
        $this->db->update('ControlLab', $New);

        $this->db->where('comp_numero', $Computadora['NewComputer']);
        $this->db->update('Computadora', $off);

        $this->db->where('comp_numero', $Computadora['OldComputer']);
        $this->db->update('Computadora', $on);

        $this->session->set_flashdata('success', "<div class='alert alert-info alert-dismissible fade in'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Correcto!</strong> <p>Cambio de Computadora.</p>
                </div>");
            if ($this->opciones()) {
                redirect( base_url() . '/cgi-bin/cambio_equipo.cgi?OldComputer='.$Computadora['OldComputer'].'&AccionO=0&NewComputer='.$Computadora['NewComputer'].'&AccionN=1');
            }else{
                redirect(base_url() . 'controllab');
            }
    }

    function modificar($comp_numero){
        $status  = array('ControlLab.idEstatus' => '1');
        $this->db->where($status);
        $this->db->where('ControlLab.comp_numero', $comp_numero);
        $query = $this->db->get('ControlLab');
        if ($query->num_rows() > 0){
            return $query;
        }else{
            return false;
        }
    }

    function opciones(){
        $this->db->from('Opciones');
        $this->db->where('opt_java', '1');
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() >= 1){
            return true;
        }else{
            return false;
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
        $this->db->order_by('comp_numero');
        $query = $this->db->get();
        return $query -> result();
    }

    function Todas_Computadoras(){ // Poco ortodoxo xd YA NO SE USA!
        $UltimoId = "idControlLab IN (SELECT MAX(idControlLab) FROM ControlLab GROUP BY comp_numero)";
        $this->db->select('*');
        $this->db->from('ControlLab');
        $this->db->join('Computadora', 'Computadora.comp_numero = ControlLab.comp_numero');
        $this->db->where($UltimoId);
        $this->db->order_by('Computadora.comp_numero');
        $query = $this->db->get();
        if ($query->num_rows() > 0){
            return $query;
        }else{
            return false;
        }
    }
    function Estatus(){
        $this->db->from('Estatus');
        $this->db->order_by("idEstatus", "asc");
        $query = $this->db->get();
        return $query -> result();
    }
    function grafica($fechaInicio,$fechaFin){
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
}
