<?php

error_reporting(0);

class Api_Model extends CI_Model {

	public $api_url 	= 'https://api.irvankede-smm.co.id/api/';
	public $api_key 	= '';
	public $api_id	 	= '';

	public function __construct() {

		parent::__construct();
		$this->load->database();

	}

	public function create_api_key() {

		$char = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$rand = substr(str_repeat(str_shuffle($char), 3), 1, 25);

		$this->db->where('user_id', $this->session->user_id);
		$this->db->update('tb_users', array('api_key' => md5($rand)));

		return redirect(base_url('api'));

	}

	private function connect($api_url, $post) {

		$_post = array();

		if (is_array($post)) {
			foreach ($post as $name => $value) {
				$_post[] = $name . '=' . urlencode($value);
			}
		}

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $api_url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		if (is_array($post)) {
			
			curl_setopt($ch, CURLOPT_POSTFIELDS, join('&', $_post));
		}

		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)');
		$result = curl_exec($ch);

		if (curl_errno($ch) != 0 && empty($result)) {
			
			$result = false;

		}

		curl_close($ch);
		return $result;
	}

	public function profile() {

		return json_decode($this->connect($this->api_url.'profile', array('api_id' => $this->api_id, 'api_key' => $this->api_key)));
	}

	public function order($data) {

		return json_decode($this->connect($this->api_url.'order', array_merge(array('api_id' => $this->api_id, 'api_key' => $this->api_key), $data)));

	}

	public function status($order_id) {
        return json_decode($this->connect($this->api_url.'status', array('api_id' => $this->api_id, 'api_key' => $this->api_key, 'id' => $order_id)));
    }

	public function profile_api($api_id, $api_key) {

		if (!isset($api_id, $api_key) || empty($api_id) || empty($api_key)) {
		 	
			$arr = array();
			$arr['status'] = false;
			$arr['data'] = 'Permintaan salah';
			return json_encode($arr);

		} else {

			$select = $this->db->get_where('tb_users', array('user_id' => $api_id));

			if ($select->num_rows() <= 0) {

				$arr = array();
				$arr['status'] = false;
				$arr['data'] = 'API ID Salah';
				return json_encode($arr);

			} else if ($api_key != $select->row()->api_key) {

				$arr = array();
				$arr['status'] = false;
				$arr['data'] = 'API Key Salah';
				return json_encode($arr);

			} else if ($api_key == $select->row()->api_key) {

				$arr = array();
				$arr['status'] = true;
				$arr['data'] = array(
					'username' => $select->row()->username,
					'full_name' => $select->row()->full_name,
					'balance' => $select->row()->balance
				);
				return json_encode($arr);

			} else {

				$arr = array();
				$arr['status'] = false;
				$arr['data'] = 'Permintaan salah';
				return json_encode($arr);

			}
		}
	}

	public function order_api($api_id, $api_key, $service, $target, $quantity, $custom_comments = '', $custom_link = '') {

		if (!isset($api_id, $api_key, $service, $target, $quantity) || empty($api_id) || empty($api_key) || empty($service) || empty($target) || empty($quantity)) {
			
			$arr['status'] = false;
			$arr['data'] = 'Permintaan salah';
			return json_encode($arr);

		} else {
			
			$select = $this->db->get_where('tb_users', array('user_id' => $api_id));

			if ($select->num_rows() <= 0) {
				
				$arr = array();
				$arr['status'] = false;
				$arr['data'] = 'API ID Salah';
				return json_encode($arr);

			} else if ($api_key != $select->row()->api_key) {

				$arr = array();
				$arr['status'] = false;
				$arr['data'] = 'API Key Salah';
				return json_encode($arr);

			} else {

				$services = $this->db->get_where('tb_services', array('id' => $service));

				if ($services->num_rows() <= 0 || $services->row()->status != 'Aktif') {

					$arr = array();
					$arr['status'] = false;
					$arr['data'] = 'Layanan tidak tersedia';
					return json_encode($arr);

				} else if ($quantity < $services->row()->min || $quantity > $services->row()->max) {
					
					$arr = array();
					$arr['status'] = false;
					$arr['data'] = 'Jumlah pesanan tidak sesuai';
					return json_encode($arr);

				} else if ($select->row()->balance < ($services->row()->price / 1000) * $quantity) {

					$arr = array();
					$arr['status'] = false;
					$arr['data'] = 'Saldo Anda tidak cukup';
					return json_encode($arr);

				} else {

					$order = $this->order(array(
						'service' => $service,
						'target' => $target,
						'quantity' => $quantity,
						'custom_comments' => $custom_comments,
						'custom_link' => $custom_link
					));

					if ($order->status === false) {

						$arr['status'] = false;
						$arr['data'] = 'Pesanan gagal, silahkan coba beberapa saat lagi';
						return json_encode($arr);

					} else if ($order->status === true) {

						$status = $this->status($order->data->id);

						$this->db->insert('tb_order_history', array(
							'order_id' => $order->data->id,
							'user_id' => $this->session->user_id,
							'datetime' => date('Y-m-d H:i:s'),
							'name' => $services->row()->name,
							'target' => $this->db->escape_str($target),
							'quantity' => $this->db->escape_str($quantity),
							'price' => ($services->row()->price / 1000) * $quantity,
							'price_provider' => $order->data->price,
							'start_count' => $status->data->start_count,
							'status' => $status->data->status,
							'custom_comments' => $this->db->escape_str($custom_comments),
							'custom_link' => $this->db->escape_str($custom_link),
							'remains' => $status->data->remains
						));

						$arr['status'] = true;
						$arr['data'] = array(
							'id' => $order->data->id,
							'price' => $order->data->price
						);
						return json_encode($arr);

					} else {

						$arr['status'] = false;
						$arr['data'] = 'Pesanan gagal, silahkan coba beberapa saat lagi';
						return json_encode($arr);

					}
				}
			}
		}
	}
}