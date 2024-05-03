<?php
class Rejected_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->database();
    }

	public function get_areas($division = null, $date_ot = null) {
        
        if ($division === null && $date_ot === null) {
            return []; // Return an empty array if no filters are provided
        }
        
        $this->db->select('*, time_from, time_to, ROUND(TIME_TO_SEC(TIMEDIFF(time_to, time_from)) / 3600, 2) AS hour_difference');
        $this->db->from('tbl_request');
        $this->db->where('status', 'Rejected');
    
        if (!empty($division)) {
            $this->db->where('division', $division);
        }
        if (!empty($date_ot)) {
            $this->db->where('date_ot', $date_ot);
        }
    
        $query = $this->db->get();
        return $query->result_array();
    }
    
	
}
?>  
