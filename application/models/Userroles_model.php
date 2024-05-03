<?php
class Userroles_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_userperarea() {

        $user = $this->session->userdata('user_wasp');
        extract($user);

        // Fetch the data from set_areas
        $result = $this->db->get_where('set_areas', array('id' => $area_id))->row();

        $this->db->select('set_users.email,set_users.username,set_users.id, set_users.fullname,set_users.created_by,set_users.created_at, set_areas.area, set_roles.role_name'); // Select desired columns
        $this->db->from('set_users');
        $this->db->join('set_areas', 'set_users.area_id = set_areas.id', 'left'); // Join with set_areas table
        $this->db->join('set_roles', 'set_users.role_id = set_roles.id', 'left'); // Join with set_areas table
        $this->db->where('area', $result->area);
        $query = $this->db->get();
        return $query->result_array();
    }


   
    public function get_userroles() {
        $this->db->select('set_users.email,set_users.username,set_users.id, set_users.fullname,set_users.created_by,set_users.created_at, set_areas.area, set_roles.role_name'); // Select desired columns
        $this->db->from('set_users');
        $this->db->join('set_areas', 'set_users.area_id = set_areas.id', 'left'); // Join with set_areas table
        $this->db->join('set_roles', 'set_users.role_id = set_roles.id', 'left'); // Join with set_areas table
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_userrole_by_name($username) {
        // Add your database query logic here to retrieve the item by name
        // $query = $this->db->get_where('set_lines', array('lines' => $lineName, 'area_id' => $areaName));
        $query = $this->db->get_where('set_users', array('username' => $username));
        return $query->row(); // Assuming you expect only one result
    }

    public function add_userroles($email, $fullname, $username , $password, $role_id, $area_id, $created_by) {
        // Add your logic to insert the item into the database
        $date_add = date('Y-m-d h:i');
        $active_now = 1;
        $hashed_password = md5($password);

        $data = array(
            'fullname' => $fullname,
            'username' => $username,
            'email' => $email,
            'password' => $hashed_password,
            'role_id' => $role_id,
            'area_id' => $area_id,
            'is_active' => $active_now,
            'created_at' => $date_add,
            'created_by' => $created_by
        );
        $this->db->insert('set_users', $data);
    }


    public function get_userrole_details($id) {
        // Perform a database query to get the current item details based on the ID
        $query = $this->db->get_where('set_users', ['id' => $id]);
        
        // Return the result as an array
        return $query->row_array();
    } 
    // public function update_line() {
    //     $data = array(
    //         'lines' => strtoupper($this->input->post('lines')), // Convert to uppercase
    //         // 'area_id' => $this->input->post('area_id')
    //     );
    //     $this->db->where('id', $this->input->post('id'));
    //     $this->db->update('set_lines', $data);
    // }

    public function update_userrole($id, $data) {
        $this->db->where('id', $id);
        $result = $this->db->update('set_users', $data);
        return $result;
    }
    
    

    public function delete_line() {
        $id = $this->input->post('id');
        $this->db->where('id', $id);
        $this->db->delete('set_lines');
    }
	
}

?>
