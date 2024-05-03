<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Apply extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url'); // Load URL Helper
        $this->load->model('apply_model');
        // $this->load->model('areas_model');
        
    }

    public function index(){
        // Check if user session exists
        if($this->session->userdata('user_wasp')){

        //     $this->load->model('Areas_model'); // Load the Areas_model
        //     $data['areas'] = $this->Areas_model->get_areas();
        // //     print_r($data['areas']);
        // // exit; // Stop execution after printing data
            $this->load->view('Apply/index');
        }
        else{
            // User is not logged in, redirect to login page
            redirect('login_page');
        }
    }
    
    public function get_employee_details() {
        $idNumber = $this->input->get('id_number');
        $data = $this->apply_model->get_employee_details($idNumber);
        echo json_encode(['data' => $data]);
    }
    public function add_request() {
        // Check if it's an AJAX request
        if ($this->input->is_ajax_request()) {
            // Decode the JSON string into an array
            $requestData = json_decode($this->input->post('requestData'), true);

            // Generate a unique control number
            $controlNumber = 'REQ' . date('YmdHis') . mt_rand(1000, 9999); // Example: REQ202204081702453681

    
            if (is_array($requestData)) {
                $successCount = 0;
                foreach ($requestData as $item) {
                    // Extract id_number and fullname1 from each object
                    $idNumber = $item['idNumber'];
                    $firstName = $item['firstName'];
                    $lastName = $item['lastName'];
                    $timeFrom = $item['timeFrom'];
                    $timeTo = $item['timeTo'];
                    $division = $item['division'];
                    $area = $item['area'];
                    $location = $item['location'];
                    $date_ot = $item['date_ot'];
                    $category = $item['category'];
                    $purpose = $item['purpose'];
    
                    // Insert each item into the database
                    $insertResult = $this->apply_model->add_request($idNumber, $firstName, $lastName, $controlNumber, $timeFrom, $timeTo, $division, $area, $location, $date_ot, $category, $purpose);
                    if ($insertResult) {
                        $successCount++;
                    } else {
                        // Handle insertion failure
                        // You might log the error or take other appropriate action
                    }
                }
    
                // Determine the overall success or failure
                if ($successCount == count($requestData)) {
                    $response['status'] = 'success';
                    $response['message'] = 'All items added successfully!';
                } else {
                    $response['status'] = 'error';
                    $response['message'] = 'Some items could not be added.';
                }
            } else {
                // Handle error, in case requestData is not an array
                $response['status'] = 'error';
                $response['message'] = 'Invalid data format!';
            }
    
            // Send the JSON-encoded response
            echo json_encode($response);
        } else {
            // Handle non-AJAX request error
            show_error('No direct script access allowed');
        }
    }
    

}

   
        

        ?>