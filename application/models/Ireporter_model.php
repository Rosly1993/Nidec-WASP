<?php
class Ireporter_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->database();
    }

    

	public function get_areas() {
       
        // Define the SQL expression for savings
        $savings_expr = 'CONCAT((tbl_main.before - tbl_main.after), " ", tbl_main.uom) AS savings_with_uom';

// Adding the customized level2_status expression
$customized_level2_status = '
CASE
    WHEN tbl_main.level2_status IN ("Done", "Ongoing") THEN "Ongoing"
    WHEN tbl_main.level2_status = "Plan" THEN "Plan"
    WHEN tbl_main.level2_status = "Accept" THEN "Accept"
    ELSE tbl_main.level2_status
END AS customized_level2_status';

// Start building the query with select
$this->db->select('
    tbl_main.id,
    tbl_main.area_id,
    tbl_main.type,
    tbl_main.activity,
    tbl_main.details,
    tbl_main.impact_type,
    tbl_main.before,
    tbl_main.attachment,
    tbl_main.after,
    ' . $savings_expr . ',
    tbl_main.level2_status,
    tbl_main.level2_pic,
    tbl_main.target_date,
    tbl_main.date_add,
    set_areas.area,
    set_areas.location,
    ' . $customized_level2_status . '  
');

// Specify the table to select from
$this->db->from('tbl_main');

// Perform an inner join
$this->db->join('set_areas', 'tbl_main.area_id = set_areas.id', 'inner');

// Exclude rows where level2_status is not 'Reject'
$this->db->where_not_in('level2_status', 'Reject');
$this->db->where('type', 'IREPORTER');
// Execute the query
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
        $query = $this->db->get_where('tbl_main', ['id' => $id]);
        
        // Return the result as an array
        return $query->row_array();
    } 
    
	
}
?>  
