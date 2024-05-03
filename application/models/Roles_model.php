<?php
class Roles_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->database();
    }

	public function get_roles() {
        $query = $this->db->get('set_roles');
        return $query->result_array();
    }
	
	
}
?>  
