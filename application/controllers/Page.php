<?php

error_reporting(0);

class Page extends CI_Controller {

	public function __construct() {

		parent::__construct();
		$this->load->model(array('User_Model', 'Page_Model'));
		$this->load->library('pagination');

		if (!isset($this->session->user_id)) {
			
			redirect(base_url('auth/login'));

		}

	}

	public function index() {
		
		$config['base_url'] = base_url('page/index/');
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


		$user = $this->User_Model->user_data();

		$data['user_id'] 	= $user->user_id;
		$data['full_name'] 	= $user->full_name;
		$data['email'] 		= $user->email;
		$data['username'] 	= $user->username;
		$data['balance']	= $user->balance;

		$data['date'] = date('Y');

		$this->load->view('header', $data);
		$this->load->view('page/dashboard', $data);
		$this->load->view('footer', $data);

	}

	public function services() {

		$category = $this->input->get('category');
		$name = $this->input->get('name');
		$start = $this->uri->segment(3);

		if (isset($category) && empty($name)) {
			
			$config['per_page'] = $this->Page_Model->services()->num_rows();
			$data['services'] = $this->Page_Model->search($config['per_page'], $start, $name, $category);
			$config['total_rows'] = $this->Page_Model->search($config['per_page'], $start, $name, $category)->num_rows();

		} else if (empty($category) && isset($name)) {
			
			$config['per_page'] = $this->Page_Model->services()->num_rows();
			$data['services'] = $this->Page_Model->search($config['per_page'], $start, $name, $category);
			$config['total_rows'] = $this->Page_Model->search($config['per_page'], $start, $name, $category)->num_rows();

		} else if (strlen($category) >= 1 && strlen($name) >= 1) {
			
			$config['per_page'] = $this->Page_Model->services()->num_rows();
			$data['services'] = $this->Page_Model->search($config['per_page'], $start, $name, $category);
			$config['total_rows'] = $this->Page_Model->search($config['per_page'], $start, $name, $category)->num_rows();

		} else {

			$config['per_page'] = 50;
			$data['services'] = $this->Page_Model->services($config['per_page'], $start);
			$config['total_rows'] = $this->Page_Model->services()->num_rows();

		}

		$config['base_url'] = base_url('page/services/');
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

		$data['select_category'] = $this->Page_Model->category();
		$data['category'] = $category;

		$user = $this->User_Model->user_data();

		$data['user_id'] 	= $user->user_id;
		$data['full_name'] 	= $user->full_name;
		$data['email'] 		= $user->email;
		$data['username'] 	= $user->username;
		$data['balance']	= $user->balance;

		$data['date'] = date('Y');

		$this->load->view('header', $data);
		$this->load->view('page/services', $data);
		$this->load->view('footer', $data);

	}

	public function about() {

		$user = $this->User_Model->user_data();

		$data['user_id'] 	= $user->user_id;
		$data['full_name'] 	= $user->full_name;
		$data['email'] 		= $user->email;
		$data['username'] 	= $user->username;
		$data['balance']	= $user->balance;

		$data['date'] = date('Y');
		$data['title'] = 'Tentang Saya';

		$this->load->view('header', $data);
		
		$this->load->view('footer', $data);

	}

	public function user_guide() {

		$user = $this->User_Model->user_data();

		$data['user_id'] 	= $user->user_id;
		$data['full_name'] 	= $user->full_name;
		$data['email'] 		= $user->email;
		$data['username'] 	= $user->username;
		$data['balance']	= $user->balance;

		$data['date'] = date('Y');
		$data['title'] = 'Panduan Pengguna';

		$this->load->view('header', $data);
		
		$this->load->view('footer', $data);

	}
}
