<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 */
class Model_login extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function login($data)
	{
		$condition = "email =" . "'" . $data['email'] . "' AND " . "password =" . "'" . md5($data['password']) . "'";
		$this->db->select('*');
		$this->db->from('Usuario');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() == 1) {
		return true;
		} else {
		return false;
		}
	}

	public function registration_insert($data) 
	{
		// Query to check whether username already exist or not
		$condition = "email =" . "'" . $data['email'] . "'";
		$this->db->select('*');
		$this->db->from('Usuario');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() == 0) {

		// Query to insert data in database
		$this->db->insert('Usuario', $data);
		if ($this->db->affected_rows() > 0) {
		return true;
		}
		} else {
		return false;
		}
	}

	// Read data from database to show data in admin page
	public function read_user_information($email) 
	{
		$condition = "email =" . "'" . $email . "'";
		$this->db->select('*');
		$this->db->from('Usuario');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() == 1) 
		{
		return $query->result();
		} else {
		return false;
		}
	}

}    
?>