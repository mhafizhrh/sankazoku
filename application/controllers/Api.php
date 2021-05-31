<?php

error_reporting(0);

class Api extends CI_Controller {

	public function __construct() {

		parent::__construct();
		$this->load->model(array('User_Model', 'Api_Model'));
		$this->load->helper(array('string', 'url', 'text'));

		if (!isset($this->session->user_id)) {
			
			redirect(base_url('auth/login'));

		}

		redirect(base_url());
	}

	public function index() {

		$create_api_key = $this->input->post('create_api_key');

		 //implode('-', str_split($rand, 5));

		$user = $this->User_Model->user_data();

		$data['user_id'] 	= $user->user_id;
		$data['full_name'] 	= $user->full_name;
		$data['email'] 		= $user->email;
		$data['username'] 	= $user->username;
		$data['balance']	= $user->balance;
		$data['api_key']	= $user->api_key;

		$data['title'] = 'Dokumentasi API';
		$data['date'] = date('Y');

		$this->load->view('header', $data);
		$this->load->view('api/index', $data);
		$this->load->view('footer', $data);
	}

	public function create_api_key() {

		$this->Api_Model->create_api_key();

	}

	public function example() {

		$no = 1;
		while ($data = $this->User_Model->user_data()) {
			echo $no++;
			echo "<br>";
			echo $data->user_id;
			echo "<br>";
		}
	}

	public function profile() {

		$api_id = $this->input->post('api_id');
		$api_key = $this->input->post('api_key');

		echo $this->Api_Model->profile_api($api_id, $api_key);

	}

	public function order() {

		$api_id = $this->input->post('api_id');
		$api_key = $this->input->post('api_key');
		$service = $this->input->post('service');
		$target = $this->input->post('target');
		$quantity = $this->input->post('quantity');
		
		echo $this->Api_Model->order_api($api_id, $api_key, $service, $target, $quantity);

	}
}