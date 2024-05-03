<?php
class Dashboards_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->database();
    }

	public function get_areas($division = null, $date_ot = null) {
        // Return an empty array if no filters are provided
        if ($division === null && $date_ot === null) {
            return [];
        }
    
        $this->db->select('*, time_from, time_to, ROUND(TIME_TO_SEC(TIMEDIFF(time_to, time_from)) / 3600, 2) AS hour_difference');
        $this->db->from('tbl_request');
        $this->db->where('status', 'Level4 Approved');
    
        // Apply division filter only if not null
        if ($division !== null) {
            $this->db->where('division', $division);
        }
    
        // Apply date_ot filter only if not null
        if ($date_ot !== null) {
            $this->db->where('month_add', $date_ot);
        }
    
        $query = $this->db->get();
        return $query->result_array();
    }
    
    
    
	
}
?>  
