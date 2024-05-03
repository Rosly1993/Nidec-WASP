<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('users_model');
	}

	public function index(){
		//load session library
		$this->load->library('session');

		//restrict users to go back to login if session has been set
		if($this->session->userdata('user_wasp')){
			redirect('home');
		}
		else{
			$this->load->view('login_page');
		}
	}

	public function login() {
		// Load session library
		$this->load->library('session');
	
		// Check if it's a guest login
		if ($this->input->post('guest_login')) {
			// Set session data for guest
			$data = array(
				
				'username' => 'Guest',
				'password' => 'Guest',
				'role_id' => '4',
				'area_id' => '13',
				'fullname' => 'Guest Account',
				'email' => 'rosly.rapada@nidec.com',
				'is_active' => 1 // Assuming guest role
				// Add more guest data as needed
			);
			$this->session->set_userdata('user_wasp', $data);
			redirect('home'); // Redirect to home or guest dashboard
		} else {
			// Regular user login
			$username = $this->input->post('username');
			$password = $this->input->post('password');
	
			$data = $this->users_model->login($username, $password);
	
			if ($data) {
				$this->session->set_userdata('user_wasp', $data);
				redirect('home');
			} else {
				// Invalid login
				$this->session->set_flashdata('error', 'Invalid login. User not found');
				redirect(base_url()); // Redirect to login page
			}
		}
	}
	

	public function home(){
		//load session library
		$this->load->library('session');

		//restrict users to go to home if not logged in
		if($this->session->userdata('user_wasp')){
			$this->load->view('home');
		}
		else{
			redirect('/');
		}
		
	}

	public function logout(){
		//load session library
		$this->load->library('session');
		$this->session->unset_userdata('user_wasp');
		redirect('/');
	}

}
