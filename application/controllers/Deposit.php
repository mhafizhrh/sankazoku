<?php

error_reporting(0);

class Deposit extends CI_Controller {

	public function __construct() {

		parent::__construct();
		$this->load->model(array('User_Model', 'Deposit_Model'));
		$this->load->library('pagination');

		if (!isset($this->session->user_id)) {
			
			redirect(base_url('auth/login'));

		}
	}

	public function index() {

		redirect(base_url('deposit/auto'));
	}

	public function manual() {

		$user = $this->User_Model->user_data();

		$data['user_id'] 	= $user->user_id;
		$data['full_name'] 	= $user->full_name;
		$data['email'] 		= $user->email;
		$data['username'] 	= $user->username;
		$data['balance']	= $user->balance;
		$data['api_key']	= $user->api_key;

		$data['date'] = date('Y');
		$this->load->view('header', $data);

		$this->load->view('footer', $data);
	}

	public function auto() {

		$submit = $this->input->post('submit');

		if (isset($submit)) {
			
			$method = $this->input->post('method');
			$from_number = $this->input->post('from');
			$total_transfer = $this->input->post('total_transfer');

			$data['message'] = $this->Deposit_Model->deposit_auto($method, $from_number, $total_transfer);

		} else {

			$data['message'] = null;

		}

		$user = $this->User_Model->user_data();

		$data['user_id'] 	= $user->user_id;
		$data['full_name'] 	= $user->full_name;
		$data['email'] 		= $user->email;
		$data['username'] 	= $user->username;
		$data['balance']	= $user->balance;
		$data['api_key']	= $user->api_key;

		$data['date'] = date('Y');
		$this->load->view('header', $data);
		$this->load->view('deposit/auto', $data);
		$this->load->view('footer', $data);
	}

	public function history() {

		$config['base_url'] = base_url('deposit/history/');
		$config['total_rows'] = $this->Deposit_Model->total_rows();
		$config['per_page'] = 10;
		$config['uri_segment'] = 3;
		$config['num_links'] = 3;

		$config['full_tag_open'] = '<nav aria-label="Page navigation example"><ul class="pagination justify-content-center">';
		$config['full_tag_close'] = '</ul></nav>'; 

		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<li class="page-item">';
		$config['first_tag_close'] = '</li>';

		$config['prev_link'] = '&lt;';
		$config['prev_tag_open'] = '<li class="page-item">';
		$config['prev_tag_close'] = '</li>';

		$config['next_link'] = '&gt;';
		$config['next_tag_open'] = '<li class="page-item">';
		$config['next_tag_close'] = '</li>';

		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<li class="page-item">';
		$config['last_tag_close'] = '</li>';

		$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link">';
		$config['cur_tag_close'] = '</a></li>';

		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';

		$config['attributes'] = array('class' => 'page-link');

		$this->pagination->initialize($config);

		$start = $this->uri->segment(3);

		$data['deposit'] = $this->Deposit_Model->history($config['per_page'], $start);

		$user = $this->User_Model->user_data();

		$data['user_id'] 	= $user->user_id;
		$data['full_name'] 	= $user->full_name;
		$data['email'] 		= $user->email;
		$data['username'] 	= $user->username;
		$data['balance']	= $user->balance;
		$data['api_key']	= $user->api_key;

		$data['date'] = date('Y');
		$this->load->view('header', $data);
		$this->load->view('deposit/history', $data);
		$this->load->view('footer', $data);
	}

	public function form() {

		$method = $this->input->post('method');

		if ($method == 1) {
			
			$this->load->view('deposit/form-tsel');

		} else {

			null;

		}
	}


	public function total_get() {

		$total_transfer = $this->input->post('total_transfer');
		$method = $this->input->post('method');

		if ($method == 1) {
			
			echo ($total_transfer * 1.02);

		} else {

			

		}
	}
}