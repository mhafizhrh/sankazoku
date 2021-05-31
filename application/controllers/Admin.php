<?php

class Admin extends CI_Controller {



	public function __construct() {

		parent::__construct();
		$this->load->model((array('Page_Model', 'admin/Admin_Model')));
		$this->load->library('pagination');
	}



	public function index() {

		if (!isset($this->session->admin_id)) {
			
			redirect(base_url('admin/login'));

		} else {

			redirect(base_url('admin/dashboard'));

		}
	}



	public function login() {

		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$BtnLogin = $this->input->post('BtnLogin');

		if (isset($BtnLogin)) {
			
			$data['message'] = $this->Admin_Model->login($username, $password);

		} else {

			$data['message'] = NULL;

		}

		$this->session->sess_destroy();

		$this->load->view('admin/login', $data);
	}



	public function dashboard() {

		$config['base_url'] = base_url('admin/dashboard/');
		$config['total_rows'] = $this->Page_Model->info()->num_rows();
		$config['per_page'] = 10;
		$config['uri_segment'] = 3;

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

		$data['info'] = $this->Page_Model->info($config['per_page'], $start);

		if (!isset($this->session->admin_id)) {
			
			redirect(base_url('admin/login'));
		}

		// Other

		$data['total_user'] = $this->Admin_Model->total_user();

		// Data Admin

		$admin = $this->Admin_Model->admin_data();

		$data['admin_id'] = $admin->admin_id;
		$data['full_name'] = $admin->full_name;
		$data['email'] = $admin->email;
		$data['username'] = $admin->username;

		$this->load->view('admin/header', $data);
		$this->load->view('admin/dashboard', $data);
		$this->load->view('admin/footer', $data);
	}



	public function users($start = 0, $user_id = NULL, $page = NULL) {

		if ($page == 'delete') {
			
			$data['message'] = $this->Admin_Model->deleteUser($user_id);

		} else {

			$data['message'] = NULL;

		}

		$config['base_url'] = base_url('admin/users/');
		$config['total_rows'] = $this->Admin_Model->users()->num_rows();
		$config['per_page'] = 20;
		$config['uri_segment'] = 3;

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

		//$start = $this->uri->segment(3);

		$data['users'] = $this->Admin_Model->users($config['per_page'], $start);

		$data['total_user'] = $this->Admin_Model->users()->num_rows();
		$data['start'] = $start;

		// Data Admin

		$admin = $this->Admin_Model->admin_data();

		$data['admin_id'] = $admin->admin_id;
		$data['full_name'] = $admin->full_name;
		$data['email'] = $admin->email;
		$data['username'] = $admin->username;

		$this->load->view('admin/header', $data);
		$this->load->view('admin/users', $data);
		$this->load->view('admin/footer', $data);
	}



	public function manage_info($start = 0, $id = NULL, $page = NULL) {

		if (!isset($this->session->admin_id)) {
			
			redirect(base_url('admin/login'));
		}

		if ($this->uri->segment(3) == 'new') {
			
			$category = $this->input->post('category');
			$contents = $this->input->post('contents');
			$BtnNew = $this->input->post('BtnNew');

			if (isset($BtnNew)) {
				
				$data['message'] = $this->Admin_Model->newInfo($category, $contents);

			} else {

				$data['message'] = NULL;

			}

			// Data Admin

			$admin = $this->Admin_Model->admin_data();

			$data['admin_id'] = $admin->admin_id;
			$data['full_name'] = $admin->full_name;
			$data['email'] = $admin->email;
			$data['username'] = $admin->username;

			$this->load->view('admin/header', $data);
			$this->load->view('admin/new-info', $data);
			$this->load->view('admin/footer', $data);

		} else {

			if ($page == 'delete') {
				
				$data['message'] = $this->Admin_Model->deleteInfo($id);

			} else {

				$data['message'] = NULL;

			}

			$data['start'] = $start;

			$config['base_url'] = base_url('admin/information/');
			$config['total_rows'] = $this->Admin_Model->info()->num_rows();
			$config['per_page'] = 5;
			$config['uri_segment'] = 3;

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

			$data['info'] = $this->Admin_Model->info($config['per_page'], $start);

			// Data Admin

			$admin = $this->Admin_Model->admin_data();

			$data['admin_id'] = $admin->admin_id;
			$data['full_name'] = $admin->full_name;
			$data['email'] = $admin->email;
			$data['username'] = $admin->username;

			$this->load->view('admin/header', $data);
			$this->load->view('admin/information', $data);
			$this->load->view('admin/footer', $data);
		}
	}


	public function services() {

		$config['base_url'] = base_url('admin/services/');
		$config['total_rows'] = $this->Admin_Model->services()->num_rows();
		$config['per_page'] = 50;
		$config['uri_segment'] = 3;

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

		$data['services'] = $this->Admin_Model->services($config['per_page'], $start);

		$data['total_service'] = $this->Admin_Model->services()->num_rows();

		// Data Admin

		$admin = $this->Admin_Model->admin_data();

		$data['admin_id'] = $admin->admin_id;
		$data['full_name'] = $admin->full_name;
		$data['email'] = $admin->email;
		$data['username'] = $admin->username;

		$this->load->view('admin/header', $data);
		$this->load->view('admin/services', $data);
		$this->load->view('admin/footer', $data);
	}


	public function ticket($reply = '', $ticket_id = '') {

		if (!isset($this->session->admin_id)) {
			
			redirect(base_url('admin/login'));
		}

		$config['base_url'] = base_url('admin/ticket/');
		$config['total_rows'] = $this->Admin_Model->total_rows();
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

		$data['pagination'] = $this->Admin_Model->ticket($config['per_page'], $start);

		// Data Admin

		$admin = $this->Admin_Model->admin_data();

		$data['admin_id'] = $admin->admin_id;
		$data['full_name'] = $admin->full_name;
		$data['email'] = $admin->email;
		$data['username'] = $admin->username;

		// Kelola Tiket

		$data['ticket'] = $this->Admin_Model->ticket();

		if ($reply == 'reply') {

			$message = $this->input->post('message');
			$send = $this->input->post('send');

			if (isset($send)) {
				
				$data['message'] = $this->Admin_Model->send($ticket_id, $message);

			} else {

				$data['message'] = NULL;

			}

			$data['reply'] = $this->Admin_Model->reply($ticket_id);
			$data['ticket_id'] = $ticket_id;

			$this->load->view('admin/header', $data);
			$this->load->view('admin/ticket-reply', $data);
			$this->load->view('admin/footer', $data);

		} else {

			$this->load->view('admin/header', $data);
			$this->load->view('admin/ticket', $data);
			$this->load->view('admin/footer', $data);

		}
	}
}