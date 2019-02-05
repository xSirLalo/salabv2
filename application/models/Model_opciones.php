<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_opciones extends CI_Model {

    function opt_mostrar(){
        $query = $this->db->get('Opciones');
        return $query -> result();
    }
    function guardar($opciones)
    {
	     $cfg = array(
	            'Opciones.opt_java'     => $opciones['opt_java']
	        );

	    $this->db->set($cfg);
	    $this->db->where('idOpcion', $opciones['idOpcion']);
	    $this->db->update('Opciones');
	    redirect('controllab');
    }
}

/* End of file Model_opciones.php */
/* Location: ./application/models/Model_opciones.php */