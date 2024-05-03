<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Createtickets extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url'); // Load URL Helper
        $this->load->model('createtickets_model');
        $this->load->model('areas_model');
    }

    public function index(){
        // Check if user session exists
        if($this->session->userdata('user_wasp')){
            // User is logged in, load the areas data
            $data['areas'] = $this->createtickets_model->get_areas();
            
            // Load the areas view with data
            $this->load->view('Createtickets/index', $data);
        }
        else{
            // User is not logged in, redirect to login page
            redirect('login_page');
        }
    }
    public function get_areas() {
        $data = $this->createtickets_model->get_areas();
        echo json_encode(['data' => $data]); // Wrap the data in 'data' key
    }

    public function get_area_details($id) {
        $area_details = $this->createtickets_model->get_area_details($id);
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
            $attachment = $this->input->post('attachment');
            $level2_status = $this->input->post('level2_status');


             // Handle file upload
             $attachment = ''; // Default value if no file is uploaded
             if (!empty($_FILES['attachment']['name'])) {
                 $config['upload_path'] = './uploads/'; // Set your upload path
                 $config['allowed_types'] = 'pdf'; // Specify allowed file types
                 $config['max_size'] = 2048; // Specify maximum file size (in kilobytes)
                 $config['encrypt_name'] = TRUE; // Encrypt file name for security
     
                 $this->load->library('upload', $config);
     
                 if ($this->upload->do_upload('attachment')) {
                     $attachment = $this->upload->data('file_name');
                 } else {
                     $response['status'] = 'error';
                     $response['message'] = $this->upload->display_errors('', '');
     
                     // Send the JSON-encoded response
                     header('Content-Type: application/json');
                     echo json_encode($response);
                     return;
                 }
             }

    
            
           
                // If the item doesn't exist, add it to the database
                $this->createtickets_model->add_area($type, $activity, $details , $impact_type, $before, $after, $target_date,  $level2_status, $attachment);
        
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
        $attachment = $this->input->post('attachment');
        $level2_status = $this->input->post('level2_status');

        //sent email to department(Level1) 

        if ($level2_status == 'Done') {
            // Assuming the path is relative to the controller file
            include_once(APPPATH . 'views/mail/mail.php');
            
            
        }      
      
        

        if($impact_type =='WHRS'){

            $com_before = $before * 1.67 ;
            $com_after =  $after * 1.67 ;
           
    
           }else{
    
            $com_before = $before;
            $com_after =  $after ;
    
           }

            // Initialize a variable to track if any data to be updated has changed
            $has_changes = false;

            // Initialize an array to hold the response
            $response = [];

            // Handle file upload
            $attachment_uploaded = false; // Flag to check if a new attachment was uploaded
            if (!empty($_FILES['attachment']['name'])) {
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'pdf';
                $config['max_size'] = 2048;
                $config['encrypt_name'] = TRUE;

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('attachment')) {
                    $attachment = $this->upload->data('file_name');
                    $attachment_uploaded = true; // Set flag to true as new attachment was uploaded successfully
                } else {
                    $response['status'] = 'error';
                    $response['message'] = $this->upload->display_errors('', '');
                    echo json_encode($response);
                    return;
                }
            }
           
        // Fetch existing data from the database
    $this->db->where('id', $id);
    $existing_data = $this->db->get('tbl_main')->row_array();

    // Determine if there are changes excluding the attachment
    $fields_to_check = ['type', 'activity', 'details', 'before', 'after', 'target_date', 'level2_status', 'impact_type'];
    foreach ($fields_to_check as $field) {
        if ($existing_data[$field] != ${$field}) {
            $has_changes = true;
            break;
        }
    }

    // Check for attachment changes separately
    if ($attachment_uploaded && $existing_data['attachment'] != $attachment) {
        $has_changes = true; // Consider attachment change as a valid change
    }

    if (!$has_changes) {
        echo json_encode(array('status' => 'no_changes', 'message' => 'No changes detected.'));
        return;
    }

    // Proceed with data update if there are changes
    $data = array(
        'type' => $type,
        'activity' => $activity,
        'details' => $details,
        'before' => $com_before,
        'after' => $com_after,
        'target_date' => $target_date,
        'uom' => '$',
        // 'attachment' => $attachment,
        'level2_status' => $level2_status,
        'impact_type' => $impact_type
    );
    if ($attachment_uploaded) {
        $data['attachment'] = $attachment; // Add this only if a new attachment was uploaded
    }

    $this->db->where('id', $id);
    $result = $this->db->update('tbl_main', $data);

    if ($result) {
        $response = ['status' => 'success', 'message' => 'Data updated successfully.'];
    } else {
        $response = ['status' => 'error', 'message' => 'Failed to update data.'];
    }

   


    echo json_encode($response);
}
    
       
       
        
        
    
        public function delete_area() {
            $this->createtickets_model->delete_area();
            echo json_encode(['success' => true]);
        }
    }
        

        ?>