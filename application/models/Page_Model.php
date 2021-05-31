<?php

class Page_Model extends CI_Model {

	public function __construct() {

		parent::__construct();
		$this->load->database();

	}



	public function user_data() {

		$get_data = $this->db->get_where('tb_users', array('user_id' => $this->session->user_id));

		return $get_data->row();
	}



	public function services($per_page = 0, $start = 0) {

		$this->db->where('status', 'Aktif');
		$this->db->order_by('id', 'ASC');
		return $this->db->get('tb_services', $per_page, $start);
	}



	public function info($per_page = 0, $start = 0) {

		$this->db->order_by('id', 'DESC');
		return $this->db->get('tb_info', $per_page, $start);
	}



	public function category() {

		$this->db->group_by('category');
		return $this->db->get('tb_services');
	}

	public function search($per_page = 0, $start = 0, $name, $category) {

		if (strlen($category) >= 1 && strlen($name) <= 0) {
			$this->db->where(array('status' => 'Aktif', 'category' => $category));
			$this->db->order_by('id', 'ASC');
			return $this->db->get('tb_services', $per_page, $start);
		} else if (strlen($category) <= 0 && strlen($name) >= 1) {
			$this->db->like('name', $name);
			$this->db->order_by('id', 'ASC');
			return $this->db->get('tb_services', $per_page, $start);
		} else if (strlen($category) >= 1 && strlen($name) >= 1) {
			$this->db->where(array('status' => 'Aktif', 'category' => $category));
			$this->db->like('name', $name);
			$this->db->order_by('id', 'ASC');
			return $this->db->get('tb_services', $per_page, $start);
		} else  {
			$this->db->where('status', 'Aktif');
			$this->db->order_by('id', 'ASC');
			return $this->db->get('tb_services', $per_page, $start);
		}
	}
}