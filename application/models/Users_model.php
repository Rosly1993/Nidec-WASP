<?php
	class Users_model extends CI_Model {
		function __construct(){
			parent::__construct();
			$this->load->database();
		}

		public function login($username, $password){
			$hashed_password = md5($password);

			$query = $this->db->get_where('set_users', array('username'=>$username, 'password'=>$hashed_password));
			return $query->row_array();
		}

	}
?>