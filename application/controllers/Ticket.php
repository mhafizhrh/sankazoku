<?php

class Ticket extends CI_Controller {

	public function __construct() {

		parent::__construct();
		$this->load->model(array('User_Model', 'Ticket_Model'));
		$this->load->library('pagination');

		if (!isset($this->session->user_id)) {
			
			redirect(base_url('auth/login'));

		}
	}

	// public function index() {

	// 	redirect(base_url('ticket/page/1'));
	// }

	public function page() {

		$config['base_url'] = base_url('ticket/');
		$config['total_rows'] = $this->Ticket_Model->user_ticket($this->session->user_id)->num_rows();
		$config['per_page'] = 10;

		$this->pagination->initialize($config);

		echo $config['total_rows'];
	}

	public function index() {
		
		$config['base_url'] = base_url('ticket/index/');
		$config['total_rows'] = $this->Ticket_Model->total_rows();
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

		$data['pagination'] = $this->Ticket_Model->user_ticket($config['per_page'], $start);

		$user = $this->User_Model->user_data();

		$data['user_id'] 	= $user->user_id;
		$data['full_name'] 	= $user->full_name;
		$data['email'] 		= $user->email;
		$data['username'] 	= $user->username;
		$data['balance']	= $user->balance;

		$data['date'] = date('Y');
		$data['title'] = 'Tiket';

		$this->load->view('header', $data);
		$this->load->view('ticket/index', $data);
		$this->load->view('footer', $data);
	}

	public function new() {

		$subject = $this->input->post('subject');
		$message = $this->input->post('message');
		$new = $this->input->post('new');

		if (isset($new)) {
			
			$data['message'] = $this->Ticket_Model->new($subject, $message); 

		} else {

			$data['message'] = NULL;

		}

		$user = $this->User_Model->user_data();

		$data['user_id'] 	= $user->user_id;
		$data['full_name'] 	= $user->full_name;
		$data['email'] 		= $user->email;
		$data['username'] 	= $user->username;
		$data['balance']	= $user->balance;

		$data['date'] = date('Y');
		$data['title'] = 'Tiket';

		$this->load->view('header', $data);
		$this->load->view('ticket/new', $data);
		$this->load->view('footer', $data);
	}

	public function reply($ticket_id = '') {

		$data['reply'] = $this->Ticket_Model->reply($ticket_id);
		$data['ticket_id'] = $ticket_id;

		$message = $this->input->post('message');
		$btn_send = $this->input->post('send');
		if (isset($btn_send)) {
			
			$data['message'] = $this->Ticket_Model->send($ticket_id, $message);

		} else {

			$data['message'] = NULL;
		}
		

		$user = $this->User_Model->user_data();

		$data['user_id'] 	= $user->user_id;
		$data['full_name'] 	= $user->full_name;
		$data['email'] 		= $user->email;
		$data['username'] 	= $user->username;
		$data['balance']	= $user->balance;

		$data['date'] = date('Y');
		$data['title'] = 'Tiket';

		$this->load->view('header', $data);
		$this->load->view('ticket/reply', $data);
		$this->load->view('footer', $data);
	}
}