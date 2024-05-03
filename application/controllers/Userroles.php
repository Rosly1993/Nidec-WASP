<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Userroles extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url'); // Load URL Helper
        // $this->load->model('lines_model');
        $this->load->model('areas_model'); // Load the areas model for dropdown
        $this->load->model('roles_model'); 
        $this->load->model('userroles_model'); 
    }

    public function index(){
        // Check if user session exists
        if($this->session->userdata('user_wasp')){

     
            // User is logged in, load the areas data
            $data['areas'] = $this->areas_model->get_areas(); // Fetch areas data
           
            $data['roles'] = $this->roles_model->get_roles();

            $data['userroles'] = $this->userroles_model->get_userroles();
            
            // Load the areas view with data
            $this->load->view('Userroles/index', $data);
        }
        else{
            // User is not logged in, redirect to login page
            redirect('login_page');
        }
    }

    public function get_userroles() {
        $data = $this->userroles_model->get_userroles();
        echo json_encode(['data' => $data]); // Wrap the data in 'data' key
    }

    public function get_userrole_details($id) {
        $userrole_details = $this->userroles_model->get_userrole_details($id);
        echo json_encode(['userrole_details' => $userrole_details]);
    }    

    // Function to add item
    public function add_userroles() {
        // Get data from the AJAX request
       
        $fullname = $this->input->post('fullname');
        $email = $this->input->post('email');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $role_id = $this->input->post('role_id');
        $area_id = $this->input->post('area_id');
        $created_by = $this->input->post('userdata');
    
        // Check if the item already exists
        $existingItem = $this->userroles_model->get_userrole_by_name($username);
    
        if ($existingItem) {
            // Item already exists, return an error response
            $response['status'] = 'error';
            $response['message'] = 'Username already exists!';
        } else {
            // If the item doesn't exist, add it to the database
            $this->userroles_model->add_userroles($email, $fullname, $username , $password, $role_id, $area_id, $created_by);
    
            // Return a success response
            $response['status'] = 'success';
            $response['message'] = 'User added successfully!';
        }
    
        // Send the JSON-encoded response
        header('Content-Type: application/json');
        echo json_encode($response);
    }


    public function update_userrole() {
        $id = $this->input->post('id');
        // $lines = strtoupper($this->input->post('lines')); // Convert to uppercase
        $fullname = $this->input->post('fullname');
        $email = $this->input->post('email');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $role_id = $this->input->post('role_id');
        $area_id = $this->input->post('area_id');
        $userdata = $this->input->post('userdata');
        $updated_at =date('Y-m-d h:i');
        $hashed_password = md5($password);
        // Fetch the existing data from the database
        $existing_data = $this->db->get_where('set_users', array('id' => $id))->row_array();
    
        // Check if there are changes
        if ($existing_data['fullname'] === $fullname && $existing_data['username'] == $username && $existing_data['password'] == $password && $existing_data['role_id'] == $role_id && $existing_data['area_id'] == $area_id && $existing_data['email'] == $email) {
            // No changes, return a response indicating no changes
            echo json_encode(array('status' => 'no_changes', 'message' => 'No changes detected.'));
            return;
        }
    
        // Check if the combination of lines and area_id already exists in the database
        $existing_combination = $this->db->get_where('set_users', array('username' => $username))->row_array();
        if ($existing_combination && $existing_combination['id'] != $id) {
            // Combination already exists, return a response indicating duplicate data
            echo json_encode(array('status' => 'duplicate', 'message' => 'Username already exists.'));
            return;
        }
    
        // Changes detected and no duplicate combination, proceed with updating the data
        $data = array(
            'fullname' => $fullname,
            'username' => $username,
            'email' => $email,
            // 'password' => $hashed_password,
            'role_id' => $role_id,
            'area_id' => $area_id,
            'created_by' => $userdata,
            'updated_at' => $updated_at
        );
    
        $this->db->where('id', $id);
        $result = $this->db->update('set_users', $data);
        if ($result) {
            echo json_encode(array('status' => 'success', 'message' => 'Data updated successfully'));
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Failed to update data'));
        }
    }
    
    
   
    
    

    public function delete_line() {
        $this->lines_model->delete_line();
        echo json_encode(['success' => true]);
    }
}
    

?>