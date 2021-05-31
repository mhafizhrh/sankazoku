<?php

error_reporting(0);

class Auth extends CI_Controller {

	public function __construct() {

		parent::__construct();
		$this->load->model('Auth_Model');

	}

	public function index() {

		redirect('auth/login');

	}

	public function login() {

		if ($this->session->user_id) {
			
			redirect('/');
		}

		$data['title'] = 'Masuk';

		$username 	= $this->input->post('username');
		$password 	= $this->input->post('password');
		$login_btn 	= $this->input->post('login_btn');

		if (isset($login_btn)) {
			
			$data['message'] = $this->Auth_Model->login($username, $password);

		} else {

			$data['message'] = false;

		}

		$this->load->view('auth/login', $data);

	}

	public function register() {

		if ($this->session->user_id) {
			
			redirect('/');
		}

		$data['title'] = 'Daftar';


		$full_name  		= $this->input->post('full_name');
		$email 				= $this->input->post('email');
		$username 			= $this->input->post('username');
		$password 			= $this->input->post('password');
		$password_verify 	= $this->input->post('password_verify');
		$register_btn 		= $this->input->post('register_btn');

		$data['full_name'] 	= $full_name;
		$data['email']		= $email;
		$data['username']	= $username;

		if (isset($register_btn)) {
			
			$data['message'] = $this->Auth_Model->register($full_name, $email, $username, $password, $password_verify);

		} else {

			$data['message'] = false;

		}

		$this->load->view('auth/register', $data);
	}
}