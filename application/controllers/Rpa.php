<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rpa extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url'); // Load URL Helper
        $this->load->model('rpa_model');
        $this->load->model('userroles_model'); 
        $this->load->model('areas_model');
    }

    public function index(){
        // Check if user session exists
        if($this->session->userdata('user_wasp')){
            // User is logged in, load the areas data
            $data['userroles'] = $this->userroles_model->get_userperarea();
            $data['areas'] = $this->rpa_model->get_areas();
            
            // Load the areas view with data
            $this->load->view('Rpa/index', $data);
        }
        else{
            // User is not logged in, redirect to login page
            redirect('login_page');
        }
    }


    public function get_areas() {
        $division = $this->input->get('division');
        $date_ot = $this->input->get('date_ot');
    
        $data = $this->rpa_model->get_areas($division, $date_ot);
        echo json_encode(['data' => $data]);
    }

    public function get_area_details($id) {
        $area_details = $this->rpa_model->get_area_details($id);
        echo json_encode(['area_details' => $area_details]);
    }    

   


    }
        

        ?>