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
			$this->load->view('login_guest');
		}
	}

	public function login(){
		//load session library
		$this->load->library('session');

		$username = $_POST['username'];
		$password = $_POST['password'];

		$data = $this->users_model->login($username, $password);

		if($data){
			$this->session->set_userdata('user_wasp', $data);
			
			redirect('home');
		}
		else{
			header('location:'.base_url().$this->index());
			$this->session->set_flashdata('error','Invalid login. User not found');
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
