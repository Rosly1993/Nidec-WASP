<?php
class Apply_model extends CI_Model {
    public $db_hris; // Declare the property if you want to explicitly state it
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->database();
        $this->db_hris = $this->load->database('db_hris', TRUE);
    }
    // public function get_areas() {
    //     $query = $this->db->get('set_areas');
    //     return $query->result_array();
    // }

	public function get_employee_details($idNumber) {
    $this->db_hris->select('fnEmpId, fcEmpFName, fcEmpLName');
    $this->db_hris->from('masterdata');
    $this->db_hris->where('fnEmpId', $idNumber);
    $query = $this->db_hris->get();
    return $query->row_array();
}

public function add_request($idNumber, $firstName, $lastName, $controlNumber, $timeFrom , $timeTo, $division, $area, $location, $date_ot, $category, $purpose) {
    // Add your logic to insert the item into the database
    $user = $this->session->userdata('user_wasp');
	extract($user);

   $date_add = date('Y-m-d h:i');
   $month_add = date('Y-m-d h:i');
   $formatted_date = date('Y-m', strtotime($month_add));

    $data = array(
        'control_number' => $controlNumber, // Add the control number to the data array
        'id_number' => $idNumber,
        'fullname' => $firstName.' '.$lastName,
        'date_add' => $date_add,
        'month_add' => $formatted_date,
        'requested_by' => $fullname,
        'status' => 'For Review Level1',
        'time_from' => $timeFrom,
        'time_to' => $timeTo,
        'division' => $division,
        'area' => $area,
        'location' => $location,
        'date_ot' => $date_ot,
        'category' => $category,
        'purpose' => $purpose,

    );
    $this->db->insert('tbl_request', $data);
}



}
?>  
