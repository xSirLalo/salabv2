<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Profesor extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}
    //PAGINACION DE INICIO DE LOS ProfesorES
    function num_Profesores(){
        //$this->db->order_by("idProfesor", "desc");
        $number = $this->db->query("select count(*) as number from Profesor")->row()->number;
        return intval($number);
    }
    
    function get_pagination($number_per_page){
        $query = $this->db->get('Profesor', $number_per_page, $this->uri->segment(3));
        if ($query->num_rows() > 0){
            return $query;
        }else{
            return false;
        }
    }
    // FIN DE PAGINACION
    // 
    function guardar($data){
    if(!$this->db->insert('Profesor',$data)) {
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
    function eliminar($idProfesor){
    if(!$this->db->delete('Profesor', array('idProfesor'=>$idProfesor))) {
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
    function modificar($idProfesor){
        $this->db->where('idProfesor', $idProfesor);
        $query = $this->db->get('Profesor');
        if ($query->num_rows() > 0){
            return $query;
        }else{
            return false;
        }
    }
    function actualizar($idProfesor, $data){
        $this->db->where('idProfesor', $idProfesor);
        $this->db->update('Profesor', $data);
        $this->session->set_flashdata('success', "<div class='alert alert-info alert-dismissible fade in'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Info!</strong> Indicates a neutral informative change or action.
                </div>
            ");
    }
    function buscar($nombre){
        $this->db->like('nombre_pr', $nombre);
        $this->db->or_like('aPaterno_pr', $nombre);
        $this->db->or_like('aMaterno_pr', $nombre);
        $query = $this->db->get('Profesor');
        if ($query->num_rows() > 0){
            return $query;
        }else{
            return false;
        }
    }
}

?>