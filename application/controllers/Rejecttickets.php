<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rejecttickets extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url'); // Load URL Helper
        $this->load->model('rejecttickets_model');
        $this->load->model('areas_model');
    }

    public function index(){
        // Check if user session exists
        if($this->session->userdata('user_wasp')){
            // User is logged in, load the areas data
            $data['areas'] = $this->rejecttickets_model->get_areas();
            
            // Load the areas view with data
            $this->load->view('Rejecttickets/index', $data);
        }
        else{
            // User is not logged in, redirect to login page
            redirect('login_page');
        }
    }
    public function get_areas() {
        $data = $this->rejecttickets_model->get_areas();
        echo json_encode(['data' => $data]); // Wrap the data in 'data' key
    }

    public function get_area_details($id) {
        $area_details = $this->rejecttickets_model->get_area_details($id);
        echo json_encode(['area_details' => $area_details]);
    }    

    public function add_area() {
        // Check if it's an AJAX request
        if ($this->input->is_ajax_request()) {
            // Get form data
            $type = $this->input->post('type');
            $activity = strtoupper($this->input->post('activity'));
            $details = strtoupper($this->input->post('details'));
            $impact_type = $this->input->post('impact_type');
            $before = $this->input->post('before');
            $after = $this->input->post('after');
            $target_date = $this->input->post('target_date');
            $uom = $this->input->post('uom');
            $level2_status = $this->input->post('level2_status');

    
            // Check if the area already exists
            // $existing_area = $this->rejecttickets_model->get_area_by_name($area,$location);
            // if ($existing_area) {
            //     // Area already exists, return error response
            //     $response['status'] = 'error';
            //     $response['message'] = 'Area already exists!';
            // }else{

           
                // If the item doesn't exist, add it to the database
                $this->rejecttickets_model->add_area($type, $activity, $details , $impact_type, $before, $after, $target_date, $uom, $level2_status);
        
                // Return a success response
                $response['status'] = 'success';
                $response['message'] = 'Successfully added successfully!';
            // }
        
            // Send the JSON-encoded response
            header('Content-Type: application/json');
            echo json_encode($response);
        }
    }


    public function update_area() {
        $id = $this->input->post('id');
        $type = $this->input->post('type');
        $activity = strtoupper($this->input->post('activity'));
        $details = strtoupper($this->input->post('details'));
        $impact_type = $this->input->post('impact_type');
        $before = $this->input->post('before');
        $after = $this->input->post('after');
        $target_date = $this->input->post('target_date');
        $uom = $this->input->post('uom');
        $level2_status = $this->input->post('level2_status');
        

        //sent email to department(Level1) 

        if ($level2_status == 'Done') {
            // Assuming the path is relative to the controller file
            include_once(APPPATH . 'views/mail/mail.php');
            
            
        }      
    
        // Fetch existing data from the database
        $this->db->where('id', $id);
        $existing_data = $this->db->get('tbl_main')->row_array();
    
        // Compare existing data with POST data
        if (
            $existing_data['type'] == $type &&
            $existing_data['activity'] == $activity &&
            $existing_data['details'] == $details &&
            $existing_data['before'] == $before &&
            $existing_data['after'] == $after &&
            $existing_data['target_date'] == $target_date &&
            $existing_data['uom'] == $uom &&
            $existing_data['level2_status'] == $level2_status &&
            $existing_data['impact_type'] == $impact_type
        ) {
            // No changes
            echo json_encode(array('status' => 'no_changes', 'message' => 'No changes'));
        } else {
            // Update data
            $data = array(
                'type' => $type,
                'activity' => $activity,
                'details' => $details,
                'before' => $before,
                'after' => $after,
                'target_date' => $target_date,
                'uom' => $uom,
                'level2_status' => $level2_status,
                'impact_type' => $impact_type
            );
    
            $this->db->where('id', $id);
            $result = $this->db->update('tbl_main', $data);
            if ($result) {
                echo json_encode(array('status' => 'success', 'message' => 'Data updated successfully'));
            } else {
                echo json_encode(array('status' => 'error', 'message' => 'Failed to update data'));
            }
        }
    }
    
        
        
       
        
        
    
        public function delete_area() {
            $this->rejecttickets_model->delete_area();
            echo json_encode(['success' => true]);
        }
    }
        

        ?>