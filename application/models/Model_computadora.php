<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Computadora extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
    //PAGINACION DE INICIO DE ComputadoraS
    function num_Computadoras(){
        $number = $this->db->query("select count(*) as number from Computadora")->row()->number;
        return intval($number);
    }
    function get_pagination($number_per_page){
        $this->db->from('Computadora');
        $this->db->join('Aula', 'Computadora.idAula = Aula.idAula');
        $query = $this -> db -> get('', $number_per_page, $this->uri->segment(3));
        if ($query -> num_rows() > 0){
            return $query;
        }else{
            return false;
        }
    }
    // FIN DE PAGINACION
    function guardar($data){
    if(!$this->db->insert('Computadora',$data)) {
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
    function eliminar($idComputadora){
    if(!$this->db->where('idComputadora', $idComputadora)) {
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
        $this->db->update('Computadora', array('idEstatus'=>4));
        $this->session->set_flashdata('success', "<div class='alert alert-success alert-dismissible fade in'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Success!</strong> This alert box could indicate a successful or positive
                </div>
            ");
        return true;
        }
    }
    function modificar($idComputadora){
        $this->db->where('idComputadora', $idComputadora);
        $query = $this->db->get('Computadora');
        if ($query->num_rows() > 0){
            return $query;
        }else{
            return false;
        }
    }
    function actualizar($idComputadora, $data){
        $this->db->where('idComputadora', $idComputadora);
        $this->db->update('Computadora', $data);
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
    function Computadoras(){
        $this->db->select('*, DATE_FORMAT(fechaAlta, "%d-%m-%Y %h:%i %p") as fechaIngreso');
        $this->db->from('Computadora');
        $this->db->join('Aula', 'Aula.idAula = Computadora.idAula');
        $this->db->join('Estatus', 'Estatus.idEstatus = Computadora.idEstatus', 'left');
        $this->db->order_by("idComputadora", "asc");
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
        $this->db->from('Computadora');
        $this->db->join('Aula', 'Aula.idAula = Computadora.idAula');
        $this->db->order_by("idComputadora", "desc");

        if($f_data['idAula'] !="")
           $this->db->where('Computadora.idAula',$f_data['idAula'],'both');
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