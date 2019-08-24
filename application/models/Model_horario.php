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
                </div>");
        return false;
        } else {
        $this->session->set_flashdata('success', "<div class='alert alert-success alert-dismissible fade in'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Success!</strong> This alert box could indicate a successful or positive
                </div>");
        return true;
        }
    }
    function guardar2($data){
    $comparar = array(
        'Horario.idAula' => $data['idAula']
    );
    $this->db->join('Aula', 'Aula.idAula = Horario.idAula');
    $this->db->join('Profesor', 'Profesor.idProfesor = Horario.idProfesor');
    $this->db->join('Asignatura', 'Asignatura.idAsignatura = Horario.idAsignatura');            
    $this->db->where($comparar);
    $query = $this->db->get('Horario');
    if ($query->num_rows() > 0) { 
        foreach ($query->result() as $key) { // INICIO foreach

            $mensajeC = "<div class='alert alert-success alert-dismissible fade in'>
                        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                        <strong>Horaro agregado!</strong> ".$data['idAsignatura']." en el ".$data['idAula']." </div>";
            $mensajeE = "<div class='alert alert-danger alert-dismissible fade in'>
                        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                        <strong>Se cruza con:</strong> ".$key->nombre_as." en el ".$key->nombre_au." </div>";

            $horaInicial = strtotime($data['horaInicio']);
            $horaFinal = strtotime($data['horaFin']);
            $horaI = strtotime($key->horaInicio);
            $horaF = strtotime($key->horaFin);

            $Hora1 = date("H:i", $horaInicial);
            $Hora2 = date("H:i", $horaFinal);
            $HoraInicio = date("H:i", $horaI);
            $HoraTermino = date("H:i", $horaF);

            // echo $Hora1."<br>";
            // echo $Hora2."<br>";
            // echo $HoraInicio."<br>";
            // echo $HoraTermino."<br>";

            if($HoraInicio >= $Hora1 AND $HoraInicio <= $Hora2 AND $HoraTermino >= $Hora1 AND $HoraTermino <= $Hora2) {
                $this->session->set_flashdata('error', $mensajeE);
                // echo '1, ';
                return false;
                    }elseif($HoraInicio < $Hora1 AND $HoraTermino > $Hora1) {
                    $this->session->set_flashdata('error', $mensajeE);
                    // echo '2, ';
                    return false;
                        }elseif($HoraInicio < $Hora2 AND $HoraTermino > $Hora2) {
                        $this->session->set_flashdata('error', $mensajeE);
                        // echo '3, ';
                        return false;
                            }else{
                            $this->db->insert('Horario',$data);
                            $this->session->set_flashdata('success', $mensajeC);
                            // echo '4';
                            return true;
            }
        }// FIN foreach
            }else{
                if(!$this->db->insert('Horario',$data)) {
                    $this->session->set_flashdata('error', $mensajeE);
                    // echo '5';
                    return false;
                        } else {
                        $this->session->set_flashdata('success', $mensajeC);
                        // echo '6';
                        return true;
                        }
            }
    }

    public function get_by_id($id)
    {   
        $response = array();
        $this->db->select('*,TIME_FORMAT(horaInicio, "%H:%i") as HI, TIME_FORMAT(horafin, "%H:%i") as HF');
        $this->db->from('horario');
        $this->db->join('Aula', 'Aula.idAula = Horario.idAula');
        $this->db->join('Profesor', 'Profesor.idProfesor = Horario.idProfesor');
        $this->db->join('Asignatura', 'Asignatura.idAsignatura = Horario.idAsignatura');
        $this->db->order_by('STR_TO_DATE(horaInicio,"%H:%i")');
        //$this->db->query('SELECT * FROM Horario WHERE horaInicio = TIME_FORMAT(CURTIME(),"%H:00:00")');
        $this->db->where('horario.idAula',$id);
        // $query = $this->db->get();
        // return $query->row();
        $q = $this->db->get();
        $response = $q->result_array();
        return $response;
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
    function Horarios(){
        $this->db->from('Horario');
        $this->db->join('Aula', 'Aula.idAula = Horario.idAula');
        $this->db->join('Profesor', 'Profesor.idProfesor = Horario.idProfesor');
        $this->db->join('Asignatura', 'Asignatura.idAsignatura = Horario.idAsignatura');
        $query = $this->db->get();
        if ($query->num_rows() > 0){
            return $query;
        }else{
            return false;
        }
    }
    function Asignaturas(){
        $this->db->select('Horario.idAsignatura');
        $this->db->from('Horario');
        $result =  $this->db->get();

        if ($result->num_rows() > 0){
            $query_result = $result->result();
            $asig_id = array();
                foreach ($query_result as $key) {
                    $asig_id[] = $key->idAsignatura;
                }
            $ignore = $asig_id;
        }else{
            $ignore = NULL;
        }
        //$room = implode(",",$room_id);
        //echo $room;
        $this->db->select("*");
        $this->db->from('Asignatura');
        $this->db->where_not_in('Asignatura.idAsignatura',$ignore);
        $this->db->where('Asignatura.idEstatus', 3 );
        $query = $this->db->get();
        return $query->result();
    }
    function Asignaturas1(){
        $ignore = array(3, 4,);
        $this->db->where_not_in('idAsignatura', $ignore);
        $this->db->where('idEstatus', 3 );
        $query = $this->db->get('Asignatura');
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
           $this->db->where('Horario.idAsignatura',$f_data['idAsignatura'],'both'); // Busqueda por Asignatura
        if($f_data['idEstatus'] !="")
           $this->db->where('Horario.idEstatus', $f_data['idEstatus'], 'both'); // Busqueda por Estatus
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