<?php
class Reviewlevel2_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->database();
    }

	public function get_areas() {
        $user = $this->session->userdata('user_wasp');
        extract($user);


      
        // Start building the query with select
        $this->db->select('
            tbl_request.id,
            tbl_request.control_number,
            tbl_request.requested_by,
            tbl_request.date_add,
            tbl_request.date_ot,
            tbl_request.division,
            tbl_request.area,
            tbl_request.location,
            tbl_request.purpose
        ');

        $this->db->from('tbl_request');
        $this->db->where('status', 'Level1 Approved');
        // Group by control_number
        $this->db->group_by('tbl_request.control_number');

        $query = $this->db->get();
    
        // Return the result as an array
        return $query->result_array();
    }

	public function get_area_by_name($area_name,$location) {
		// $this->db->where('area', $area_name);
        $query = $this->db->get_where('set_areas', array('area' => $area_name, 'location' => $location));
		// $query = $this->db->get('set_areas');
		return $query->row_array(); // Assuming you expect only one row for a given area name
	}

     public function get_area_details($id) {
        // Perform a database query to get the current item details based on the ID
        $query = $this->db->get_where('tbl_request', ['id' => $id]);
        
        // Return the result as an array
        return $query->row_array();
    } 
    public function get_area_details_by_control_number($control_number) {
        // Perform a database query to get the area details based on the control number
        $query = $this->db->get_where('tbl_request', ['control_number' => $control_number, 'status' => 'Level1 Approved']);
        
        // Return the result as an array
        return $query->result_array();
    }

    public function update_status($id, $status, $remarks, $date_add, $fullname) {
       
        $this->db->where('id', $id);
        $this->db->update('tbl_request', array('status' => $status, 'remarks' => $remarks, 'level2_date' => $date_add, 'level2_approver' => $fullname));
    }
    
   
}
?>  
