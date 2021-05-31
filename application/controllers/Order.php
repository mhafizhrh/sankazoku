<?php

error_reporting(0);

class Order extends CI_Controller {

	public function __construct() {

		parent::__construct();
		$this->load->model(array('User_Model', 'Order_Model'));
		// $this->load->library();
		// $this->load->helper('maintenance-alert');

		if (!isset($this->session->user_id)) {
			
			redirect(base_url('auth/login'));

		}

		$this->Order_Model->update_status();
	}

	public function index() {

		redirect(base_url('order/new'));
	}

	public function new() {

		$services = $this->input->post('services');
		$target = $this->input->post('target');
		$custom_comments = $this->input->post('custom_comments');
		$custom_link = $this->input->post('custom_link');
		$quantity = $this->input->post('quantity');
		$submit = $this->input->post('submit');

		if (isset($submit)) {
			
			$data['message'] = $this->Order_Model->new($services, $target, $custom_comments, $custom_link, $quantity);

		} else {

			$data['message'] = null;

		}

		$data['category'] = $this->Order_Model->category();

		$user = $this->User_Model->user_data();

		$data['user_id'] 	= $user->user_id;
		$data['full_name'] 	= $user->full_name;
		$data['email'] 		= $user->email;
		$data['username'] 	= $user->username;
		$data['balance']	= $user->balance;
		$data['api_key']	= $user->api_key;

		$data['title'] = 'Pemesanan Baru';
		$data['date'] = date('Y');
		$this->load->view('header', $data);
		$this->load->view('order/new', $data);
		$this->load->view('footer', $data);
	}

	public function history() {

		$config['base_url'] = base_url('order/history/');
		$config['total_rows'] = $this->Order_Model->total_rows();
		$config['per_page'] = 15;
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

		$data['history'] = $this->Order_Model->history($config['per_page'], $start);

		$user = $this->User_Model->user_data();

		$data['user_id'] 	= $user->user_id;
		$data['full_name'] 	= $user->full_name;
		$data['email'] 		= $user->email;
		$data['username'] 	= $user->username;
		$data['balance']	= $user->balance;
		$data['api_key']	= $user->api_key;

		$data['title'] = 'Riwayat Pemesanan';
		$data['date'] = date('Y');
		$this->load->view('header', $data);
		$this->load->view('order/history', $data);
		$this->load->view('footer', $data);
	}

	public function services() {

		$category = $this->input->post('category');
		$services = $this->Order_Model->services($category);

		if ($services === false) {
			
			echo "<option value='0' disabled='' selected=''>Tidak ada Layanan</option>";

		} else {

			echo "<option value='0' disabled='' selected=''>Pilih Layanan</option>";

			foreach ($services->result() as $key => $value) {
				
				echo "<option value='".$value->id."'>".$value->name."</option>";

			}
				
		}
	}

	public function service_data() {

		$id = $this->input->post('services');

		echo $this->Order_Model->service_data($id);
	}

	public function total_price() {

		$id = $this->input->post('services');
		$quantity = $this->input->post('quantity');

		echo $this->Order_Model->total_price($id, $quantity);
	}

	public function total_price_comments() {

		$id = $this->input->post('services');
		$comments = $this->input->post('custom_comments');

		echo $this->Order_Model->total_price_comments($id, $comments);
	}
}