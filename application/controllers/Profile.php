<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url'); // Load URL Helper
        $this->load->model('profile_model');
    }

    public function index(){
        // Check if user session exists
        if($this->session->userdata('user_wasp')){
            // User is logged in, load the areas data
            $data['areas'] = $this->profile_model->get_areas();
            
            // Load the areas view with data
            $this->load->view('Profile/index', $data);
        }
        else{
            // User is not logged in, redirect to login page
            redirect('login_page');
        }
    }
    public function add_lot() {
        if ($this->input->is_ajax_request()) {
            $userid = $this->input->post('userid');
            $email = $this->input->post('email');
            $username = $this->input->post('username');
            $password = $this->input->post('password');
           
    
            $result = $this->profile_model->add_lot($userid, $email, $username, $password);
    
            $response['status'] = $result === 'success' ? 'success' : 'error';
            $response['message'] = $result === 'success' ? 'Lot Created successfully!' : 'Please Update Password!';
            
            header('Content-Type: application/json');
            echo json_encode($response);
        }
    }
    
    }
        

        ?>