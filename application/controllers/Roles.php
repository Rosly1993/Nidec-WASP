<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Roles extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url'); // Load URL Helper
        $this->load->model('roles_model');
    }

    
    public function get_roles() {
        $data = $this->roles_model->get_roles();
        echo json_encode(['data' => $data]); // Wrap the data in 'data' key
    }

   
    }
        

        ?>