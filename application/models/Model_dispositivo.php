<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Dispositivo extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}
    //PAGINACION DE INICIO DE DispositivoS
    function num_Dispositivos(){
        $number = $this->db->query("select count(*) as number from Dispositivo")->row()->number;
        return intval($number);
    }
    
    function get_pagination($number_per_page){
        $query = $this->db->get('Dispositivo', $number_per_page, $this->uri->segment(3));
        if ($query -> num_rows() > 0){
            return $query;
        }else{
            return false;
        }
    }
    // FIN DE PAGINACION
    // 
    function guardar($data){
    if(!$this->db->insert('Dispositivo',$data)) {
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
    function eliminar($idDispositivo){
    if(!$this->db->where('idDispositivo', $idDispositivo)) {
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
        $this->db->update('Dispositivo', array('idEstatus'=>4));
        $this->session->set_flashdata('success', "<div class='alert alert-success alert-dismissible fade in'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Success!</strong> This alert box could indicate a successful or positive
                </div>
            ");
        return true;
        }
    }
    function modificar($idDispositivo){
        $this->db->where('idDispositivo', $idDispositivo);
        $query = $this->db->get('Dispositivo');
        if ($query->num_rows() > 0){
            return $query;
        }else{
            return false;
        }
    }
    function actualizar($idDispositivo, $data){
        $this->db->where('idDispositivo', $idDispositivo);
        $this->db->update('Dispositivo', $data);
        $this->session->set_flashdata('success', "<div class='alert alert-info alert-dismissible fade in'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Info!</strong> Indicates a neutral informative change or action.
                </div>
            ");
    }
    function Aulas(){
        $this->db->from('Aula');
        $this->db->order_by("idAula", "asc");
        $query = $this->db->get();
        return $query -> result();
    }
    function TipoDispositivo(){   
        $this->db->from('TipoDispositivo');
        $this->db->order_by("idTipoDispositivo", "asc");
        $query = $this->db->get();
        return $query -> result();
    }
    function Estatus(){   
        $this->db->from('Estatus');
        $this->db->where( 'idEstatus BETWEEN 3 AND 4', NULL, FALSE );
        $this->db->order_by("idEstatus", "asc");
        $query = $this->db->get();
        return $query -> result();
    }
    function Filtrar($f_data){
        $this->db->select('*');
        $this->db->from('Dispositivo');
        $this->db->order_by("idDispositivo", "desc");

        if($f_data['idAula'] !="")
           $this->db->where('idAula',$f_data['idAula'],'both');
        if($f_data['idTipoDispositivo'] !="")
           $this->db->where('idTipoDispositivo',$f_data['idTipoDispositivo'],'both');
        if($f_data['idEstatus'] !="")
           $this->db->where('idEstatus', $f_data['idEstatus'], 'both');
        $query = $this->db->get('');
        if ($query->num_rows() > 0){
            return $query;
        }else{
            return false;
        }
    }
}

?>