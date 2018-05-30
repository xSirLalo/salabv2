<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Incidencia extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}
    //PAGINACION DE INICIO DE LOS IncidenciaS
    function num_Incidencias(){
        $this->db->join('Usuario', 'Usuario.idUsuario = Incidencia.idUsuario');
        $this->db->join('Estatus', 'Estatus.idEstatus = Incidencia.idEstatus');
        $this->db->order_by("idIncidencia", "desc");
        $number = $this->db->query("select count(*) as number from Incidencia")->row()->number;
        return intval($number);
    }
    
    function get_pagination($number_per_page){
        $query = $this -> db -> get('Incidencia', $number_per_page, $this->uri->segment(3));
        if ($query -> num_rows() > 0){
            return $query;
        }else{
            return false;
        }
    }
    // FIN DE PAGINACION
    // 
    function guardar($data){
    if(!$this->db->insert('Incidencia',$data)) {
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
    function eliminar($idIncidencia){
    if(!$this->db->where('idIncidencia', $idIncidencia)) {
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
        $this->db->update('Incidencia', array('idEstatus'=>6));
        $this->session->set_flashdata('success', "<div class='alert alert-success alert-dismissible fade in'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Success!</strong> This alert box could indicate a successful or positive
                </div>
            ");
        return true;
        }
    }
    function modificar($idIncidencia){
        $this->db->where('idIncidencia', $idIncidencia);
        $query = $this->db->get('Incidencia');
        if ($query->num_rows() > 0){
            return $query;
        }else{
            return false;
        }
    }
    function actualizar($idIncidencia, $data){
        $this->db->where('idIncidencia', $idIncidencia);
        $this->db->update('Incidencia', $data);
        $this->session->set_flashdata('success', "<div class='alert alert-info alert-dismissible fade in'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Info!</strong> Indicates a neutral informative change or action.
                </div>
            ");
    }
    function buscar($buscar){
        $this->db->where('idIncidencia', $buscar);
        $query = $this->db->get('Incidencia');
        if ($query->num_rows() > 0){
            return $query;
        }else{
            return false;
        }
    }
    function Estatus(){
        $this->db->from('Estatus');
        $this->db->order_by("idEstatus", "asc");
        $this->db->where( 'idEstatus BETWEEN 5 AND 6', NULL, FALSE );
        $query = $this->db->get();
        return $query -> result();
    }

    public function get_by_id($id)
    {
        $this->db->from('Incidencia');
        $this->db->where('idIncidencia',$id);
        $query = $this->db->get();

        return $query->row();
    }
}

?>