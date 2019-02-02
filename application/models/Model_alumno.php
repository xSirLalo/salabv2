<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Alumno extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}
    //PAGINACION DE INICIO DE LOS USAURIOS
    function num_Alumnos(){
        $number = $this->db->query("select count(*) as number from Alumno")->row()->number;
        return intval($number);
    }
    
    function get_pagination($number_per_page){
        $this->db->from('Alumno as a');
        $this->db->join('Carrera pr', 'pr.idCarrera = a.idCarrera');
        $query = $this -> db -> get('', $number_per_page, $this->uri->segment(3));
        if ($query -> num_rows() > 0){
            return $query;
        }else{
            return false;
        }
    }
    // FIN DE PAGINACION
	function guardar($data)
	{
        if(!$this->db->insert('Alumno', $data)) {
        $this->session->set_flashdata('error', "<div class='alert alert-danger alert-dismissible fade in'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Danger!</strong> This alert box could indicate a dangerous or potentially
                </div>
            ");
        return false;
        } else {
        $this->session->set_flashdata('success', "<div class='alert alert-info alert-dismissible fade in'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Info!</strong> Alumno agregado correctamente.
                </div>
            ");
        $this->session->set_flashdata('noControl', $data['noControl']);
        return redirect('controllab');
        }
	}
    function actualizar($noControl, $data){
        $this->db->where('noControl', $noControl);
        $this->db->update('Alumno', $data);
        $this->session->set_flashdata('success', "<div class='alert alert-info alert-dismissible fade in'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Info!</strong> Alumno modificado correctamente.
                </div>
            ");
    }
    function eliminar($noControl){
    if (!$this->db->delete('Alumno', array('noControl'=>$noControl))) {
        # Delete Failed
        $this->session->set_flashdata('error', "<div class='alert alert-danger alert-dismissible fade in'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Danger!</strong> This alert box could indicate a dangerous or potentially
                </div>
            ");
        return false;
    }  
    else{
        # Delete Success
        $this->session->set_flashdata('success', "<div class='alert alert-success alert-dismissible fade in'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Success!</strong> This alert box could indicate a successful or positive
                </div>
            ");
        return true;
    }        
    }
    function modificar($noControl){
        $this->db->where('noControl', $noControl);
        $query = $this->db->get('Alumno');
        if ($query->num_rows() > 0){
            return $query;
        }else{
            return false;
        }
    }
    function buscar($noControl){
        $this->db->from('Alumno as a');
        $this->db->join('Carrera pr', 'pr.idCarrera = a.idCarrera');
        $this->db->where('noControl', $noControl);
        $query = $this->db->get('');
        if ($query->num_rows() > 0){
            return $query;
        }else{
            return false;
        }
    }
    function Carreras(){   
        $this->db->from('Carrera');
        $this->db->order_by("idCarrera", "desc");
        $query = $this->db->get();
        return $query -> result();
    }
    function getUserDetails(){

    $response = array();

    // Select record
    $this->db->select('noControl,nombre_al,aPaterno_al,aMaterno_al,idCarrera');
    $q = $this->db->get('Alumno');
    $response = $q->result_array();

    return $response;
    }
}

?>