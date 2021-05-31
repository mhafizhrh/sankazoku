<?php

error_reporting(0);

class User extends CI_Controller {

	public function __construct() {

		parent::__construct();
		$this->load->model('User_Model');

		if (!isset($this->session->user_id)) {
			
			redirect(base_url('auth/login'));

		}

	}

	public function index() {

		redirect(base_url('user/settings'));
	}

	public function settings() {

		$user = $this->User_Model->user_data();

		$data['user_id'] 	= $user->user_id;
		$data['full_name'] 	= $user->full_name;
		$data['email'] 		= $user->email;
		$data['username'] 	= $user->username;
		$data['balance']	= $user->balance;

		$profile 			= $this->input->post('profile');
		$change_password 	= $this->input->post('change_password');
		$full_name 			= $this->input->post('full_name');
		$newpass 			= $this->input->post('newpass');
		$newpass_verify 	= $this->input->post('newpass_verify');
		$currentpass 		= $this->input->post('currentpass');

		if (isset($profile)) {
			
			$return = json_decode($this->User_Model->profile($full_name, $currentpass));

			if ($return->status === true) {
				
				$data['profile'] = $return->message;
				$data['change_password'] = false;
				$data['full_name'] = $full_name;

			} else {

				$data['profile'] = $return->message; //$this->User_Model->profile($full_name, $currentpass);
				$data['change_password'] = false;

			}

		} else if (isset($change_password)) {
			
			$data['profile'] = false;
			$data['change_password'] = $this->User_Model->change_password($newpass, $newpass_verify, $currentpass);

		} else {

			$data['profile'] = false;
			$data['change_password'] = false;
		}

		$data['date'] = date('Y');
		$data['title'] = 'Pengaturan Akun';

		$this->load->view('header', $data);
		$this->load->view('user/settings', $data);
		$this->load->view('footer', $data);

	}

	public function log_activity() {

		$user = $this->User_Model->user_data();

		$data['user_id'] 	= $user->user_id;
		$data['full_name'] 	= $user->full_name;
		$data['email'] 		= $user->email;
		$data['username'] 	= $user->username;
		$data['balance']	= $user->balance;

		$data['date'] = date('Y');
		$data['title'] = 'Catatan Aktifitas';

		$this->load->view('header', $data);
		
		$this->load->view('footer', $data);

	}

	public function balance_usage() {

		$user = $this->User_Model->user_data();

		$data['user_id'] 	= $user->user_id;
		$data['full_name'] 	= $user->full_name;
		$data['email'] 		= $user->email;
		$data['username'] 	= $user->username;
		$data['balance']	= $user->balance;

		$data['date'] = date('Y');
		$data['title'] = 'Pemakaian Saldo';

		$this->load->view('header', $data);
		
		$this->load->view('footer', $data);

	}
}