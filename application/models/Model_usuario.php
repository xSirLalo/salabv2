<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Usuario extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}
    //PAGINACION DE INICIO DE LOS USAURIOS
    function num_Usuarios(){
        $this->db->order_by("idUsuario", "desc");
        $number = $this->db->query("select count(*) as number from Usuario")->row()->number;
        return intval($number);
    }
    
    function get_pagination($number_per_page){
        $id = $this->session->userdata('idUsuario'); // NO
        $this->db->where_not_in('Usuario.idUsuario', 1);
        // $this->db->where_not_in('Usuario.idUsuario', $id); 
        $query = $this->db->get('Usuario', $number_per_page, $this->uri->segment(3));
        if ($query -> num_rows() > 0){
            return $query;
        }else{
            return false;
        }
    }
    // FIN DE PAGINACION
	function guardar($data)
	{
	if(!$this->db->insert('Usuario', $data)) {
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
    function actualizar($idUsuario, $data){
        $this->db->where('idUsuario', $idUsuario);
        $this->db->update('Usuario', $data);
        $this->session->set_flashdata('success', "<div class='alert alert-info alert-dismissible fade in'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Info!</strong> Indicates a neutral informative change or action.
                </div>
            ");
    }
    function eliminar($idUsuario){
    if(!$this->db->delete('Usuario', array('idUsuario'=>$idUsuario))) {
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
    function modificar($idUsuario){
        $this->db->where('idUsuario', $idUsuario);
        $query = $this->db->get('Usuario');
        if ($query->num_rows() > 0){
            return $query;
        }else{
            return false;
        }
    }
    function buscar($idUsuario){
        $this->db->where('idUsuario', $idUsuario);
        $query = $this->db->get('');
        if ($query->num_rows() > 0){
            return $query;
        }else{
            return false;
        }
    }
    function TipoUsuario(){   
        $this->db->from('TipoUsuario');
        $this->db->where('idTipoUsuario BETWEEN 2 AND 3');
        $this->db->order_by("idTipoUsuario", "desc");
        $query = $this->db->get();
        return $query -> result();
    }
    function Estatus(){   
        $this->db->from('Estatus');
        $this->db->order_by("idEstatus", "asc");
        $query = $this->db->get();
        return $query -> result();
    }
}

?>