<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Horario extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
    //PAGINACION DE INICIO DE LOS HorarioS
    function num_Horarios(){
        $number = $this->db->query("select count(*) as number from Horario")->row()->number;
        return intval($number);
    }
    function get_pagination($number_per_page){
        $query = $this->db->get('Horario', $number_per_page, $this->uri->segment(3));
        if ($query -> num_rows() > 0){
            return $query;
        }else{
            return false;
        }
    }
    // FIN DE PAGINACION
    function guardar($data){
    if(!$this->db->insert('Horario',$data)) {
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
    function eliminar($idHorario){
    if(!$this->db->where('idHorario', $idHorario)) {
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
        $this->db->update('Horario', array('idEstatus'=>4));
        $this->session->set_flashdata('success', "<div class='alert alert-success alert-dismissible fade in'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Success!</strong> This alert box could indicate a successful or positive
                </div>
            ");
        return true;
        }
    }
    function modificar($idHorario){
        $this->db->where('idHorario', $idHorario);
        $query = $this->db->get('Horario');
        if ($query->num_rows() > 0){
            return $query;
        }else{
            return false;
        }
    }
    function actualizar($idHorario, $data){
        $this->db->where('idHorario', $idHorario);
        $this->db->update('Horario', $data);
        $this->session->set_flashdata('success', "<div class='alert alert-info alert-dismissible fade in'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Info!</strong> Indicates a neutral informative change or action.
                </div>
            ");
    }
    function buscar($diaoAula){
        $this->db->from('Horario as h');
        $this->db->join('Aula as a', 'a.idAula = h.idAula');
        $this->db->join('Profesor pr', 'pr.idProfesor = h.idProfesor');
        $this->db->like('dia', $diaoAula);
        $this->db->or_like('nombre_au', $diaoAula);
        $query = $this->db->get();
        if ($query->num_rows() > 0){
            return $query;
        }else{
            return false;
        }
    }
    function Aulas(){   
        $this->db->from('Aula');
        //$this->db->order_by("idAula", "desc");
        $query = $this->db->get();
        return $query -> result();
    }
    function Asignaturas(){   
        $this->db->from('Asignatura');
        $this->db->where('idEstatus', 3, FALSE ); // Solo mostrar asignaturas con el status ALTA
        //$this->db->order_by("idAsignatura", "asc");
        $query = $this->db->get();
        return $query -> result();
    }
    function Estatus(){   
        $this->db->from('Estatus');
        $this->db->where('idEstatus BETWEEN 3 AND 4', NULL, FALSE );
        //$this->db->order_by("idEstatus", "asc");
        $query = $this->db->get();
        return $query -> result();
    }
    function Filtrar($f_data){
        $this->db->select('*, Horario.idEstatus as EstatusH');
        $this->db->from('Horario');
        $this->db->join('Aula', 'Aula.idAula = Horario.idAula');
        $this->db->join('Profesor', 'Profesor.idProfesor = Horario.idProfesor');
        $this->db->join('Asignatura', 'Asignatura.idAsignatura = Horario.idAsignatura');
        $this->db->order_by("Horario.idHorario", "desc");

        if($f_data['idAula'] !="")
           $this->db->where('Horario.idAula',$f_data['idAula'],'both');
        if($f_data['idAsignatura'] !="")
           $this->db->where('Horario.idAsignatura',$f_data['idAsignatura'],'both');
        if($f_data['idEstatus'] !="")
           $this->db->where('Horario.idEstatus', $f_data['idEstatus'], 'both');
        $query = $this->db->get('');
        if ($query->num_rows() > 0){
            return $query;
        }else{
            return false;
        }
    }
    function asig($id){
        $this->db->where('idAsignatura', $id);
        $query = $this->db->get('Asignatura');
        if ($query->num_rows() > 0){
            return $query;
        }else{
            return false;
        }
    }
}

?>