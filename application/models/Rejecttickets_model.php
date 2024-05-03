<?php
class Rejecttickets_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->database();
    }

	public function get_areas() {
        $user = $this->session->userdata('user_wasp');
        extract($user);
        // Define the SQL expression for savings
        $savings_expr = 'CONCAT((tbl_main.before - tbl_main.after), " ", tbl_main.uom) AS savings_with_uom';
    
        // Start building the query with select
        $this->db->select('
            tbl_main.id,
            tbl_main.area_id,
            tbl_main.type,
            tbl_main.activity,
            tbl_main.details,
            tbl_main.impact_type,
            tbl_main.before,
            tbl_main.after,
            ' . $savings_expr . ',
            tbl_main.level2_status,
            tbl_main.level1_pic,
            tbl_main.level1_remarks,
            tbl_main.level2_pic,
            tbl_main.target_date,
            tbl_main.date_add,
            set_areas.area,
            set_areas.location
        ');
    
        // Specify the table to select from
        $this->db->from('tbl_main');
    
        // Perform an inner join
        $this->db->join('set_areas', 'tbl_main.area_id = set_areas.id', 'inner');

        // Exclude rows where level2_status is 'Done'
        $this->db->where('level2_pic', $fullname);
        $this->db->where('level2_status','Reject');
        // Execute the query
        $query = $this->db->get();
    
        // Return the result as an array
        return $query->result_array();
    }
    
    
	public function add_area($type, $activity, $details , $impact_type, $before, $after, $target_date, $uom, $level2_status) {
        // Add your logic to insert the item into the database
       $user = $this->session->userdata('user');
       extract($user);

      
     
       $date_add = date('Y-m-d h:i');
       //get area and location of user 


        $data = array(
            'type' => $type,
            'activity' => $activity,
            'details' => $details,
            'impact_type' => $impact_type,
            'before' => $before,
            'after' => $after,
            'target_date' => $target_date,
            'uom' => $uom,
            'level2_status' => $level2_status,
            'level2_pic' => $fullname,
            'area_id' => $area_id,
            'date_add' => $date_add,
            

        );
        $this->db->insert('tbl_main', $data);
    }
	public function get_area_by_name($area_name,$location) {
		// $this->db->where('area', $area_name);
        $query = $this->db->get_where('set_areas', array('area' => $area_name, 'location' => $location));
		// $query = $this->db->get('set_areas');
		return $query->row_array(); // Assuming you expect only one row for a given area name
	}

     public function get_area_details($id) {
        // Perform a database query to get the current item details based on the ID
        $query = $this->db->get_where('tbl_main', ['id' => $id]);
        
        // Return the result as an array
        return $query->row_array();
    } 
    public function delete_area() {
        $id = $this->input->post('id');
        $this->db->where('id', $id);
        $this->db->delete('set_areas');
    }
	
}
?>  
