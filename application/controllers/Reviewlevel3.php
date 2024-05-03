<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reviewlevel3 extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url'); // Load URL Helper
        $this->load->model('reviewlevel3_model');
        $this->load->model('userroles_model'); 
        $this->load->model('areas_model');
    }

    public function index(){
        // Check if user session exists
        if($this->session->userdata('user_wasp')){
            // User is logged in, load the areas data
            $data['userroles'] = $this->userroles_model->get_userperarea();
            $data['areas'] = $this->reviewlevel3_model->get_areas();
            
            // Load the areas view with data
            $this->load->view('Reviewlevel3/index', $data);
        }
        else{
            // User is not logged in, redirect to login page
            redirect('login_page');
        }
    }



    public function get_areas() {
        $data = $this->reviewlevel3_model->get_areas();
        echo json_encode(['data' => $data]); // Wrap the data in 'data' key
    }

    public function get_area_details($id) {
        // Fetch area details where id is $id
        $area_details = $this->reviewlevel3_model->get_area_details($id);
    
        // Get the control_number from the area_details
        $control_number = $area_details['control_number'];
    
        // Fetch area details based on control_number
        $filtered_area_details = $this->reviewlevel3_model->get_area_details_by_control_number($control_number);
    
        // Output JSON response
        echo json_encode(['area_details' => $filtered_area_details]);
    }
    
    public function update_status() {
        // Get data from POST request
        $status_updates = $this->input->post('status_updates');
        
        // Loop through each status update and update the database
        foreach ($status_updates as $update) {
            $date_add = date('Y-m-d H:i');
            $user = $this->session->userdata('user_wasp');
            extract($user);
            $id = $update['id'];
            $status = $update['status'];
            $remarks = $update['remarks'];
            if($status=='Rejected'){
                $remarks = 'Rejected  By: '.$fullname.' - '.$remarks;

            }
            $this->reviewlevel3_model->update_status($id, $status, $remarks, $date_add, $fullname);
        }

        // include_once(APPPATH . 'views/PDF/approved.php');
        // Return response
        echo json_encode(['success' => true]);
    }
    
    
   

    }
        

        ?>