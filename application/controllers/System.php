<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class System extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url'); // Load URL Helper
        $this->load->model('system_model');
        $this->load->model('areas_model');
    }

    public function index(){
        // Check if user session exists
        if($this->session->userdata('user_wasp')){
            // User is logged in, load the areas data
            $data['areas'] = $this->system_model->get_areas();
            
            // Load the areas view with data
            $this->load->view('System/index', $data);
        }
        else{
            // User is not logged in, redirect to login page
            redirect('login_page');
        }
    }
    public function get_areas() {
        $data = $this->system_model->get_areas();
        echo json_encode(['data' => $data]); // Wrap the data in 'data' key
    }

    public function get_area_details($id) {
        $area_details = $this->system_model->get_area_details($id);
        echo json_encode(['area_details' => $area_details]);
    }    
}    

   
 

        ?>