<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Asignatura extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}
    //PAGINACION DE INICIO DE AsignaturaS
    function num_Asignaturas(){
        $this->db->order_by("idAsignatura", "desc");
        $number = $this->db->query("select count(*) as number from Asignatura")->row()->number;
        return intval($number);
    }
    
    function get_pagination($number_per_page){
        $query = $this -> db -> get('Asignatura', $number_per_page, $this->uri->segment(3));
        if ($query -> num_rows() > 0){
            return $query;
        }else{
            return false;
        }
    }
    // FIN DE PAGINACION
    // 
    function guardar($data){
        if(!$this->db->insert('Asignatura',$data)) {
        $this->session->set_flashdata('error', "<div class='alert alert-danger alert-dismissible fade in'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Danger!</strong> This alert box could indicate a dangerous or potentially
                </div>
            ");
        return false;
        } else {
        $this->session->set_flashdata('success', "<div class='alert alert-success alert-dismissible fade in'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Success!</strong> This alert box could indicate a successful or positive
                </div>
            ");
        return false;
        }
    }
    function baja($idAsignatura){
    if(!$this->db->where('idAsignatura', $idAsignatura)) {
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
        $this->db->update('Asignatura', array('idEstatus'=>4));
        $this->session->set_flashdata('success', "<div class='alert alert-success alert-dismissible fade in'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Success!</strong> This alert box could indicate a successful or positive
                </div>
            ");
        return true;
    }
    }
    function modificar($idAsignatura){
        $this->db->where('idAsignatura', $idAsignatura);
        $query = $this->db->get('Asignatura');
        if ($query->num_rows() > 0){
            return $query;
        }else{
            return false;
        }
    }
    function actualizar($idAsignatura, $data){
        $this->db->where('idAsignatura', $idAsignatura);
        $this->db->update('Asignatura', $data);
        $this->session->set_flashdata('success', "<div class='alert alert-info alert-dismissible fade in'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Info!</strong> Indicates a neutral informative change or action.
                </div>
            ");
    }
    function buscar($nombre){
        $this->db->like('clave', $nombre);
        $this->db->or_like('nombre_as', $nombre);
        $query = $this->db->get('Asignatura');
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
    function Profesores(){   
        $this->db->from('Profesor');
        $this->db->order_by("idProfesor", "desc");
        $query = $this->db->get();
        return $query -> result();
    }
}

?>