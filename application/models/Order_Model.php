<?php

date_default_timezone_set('Asia/Jakarta');

class Order_Model extends CI_Model {

	public $api_url 	= 'https://api.irvankede-smm.co.id/api/';
	public $api_key 	= '';
	public $api_id	 	= '';

	public function __construct() {

		parent::__construct();
		$this->load->database();
	}

	public function datetime($str) {

		$bulan = array(
			1 => 'Januari',
			'Februari',
			'Maret',
			'April',
			'Mei',
			'Juni',
			'Juli',
			'Agustus',
			'September',
			'Oktober',
			'November',
			'Desember'
		);

		$explode = explode('-', $str);

		return $explode[2] . ' ' . $bulan[ (int)$explode[1]] . ' ' . $explode[0] . ' | ' . date('H:i:s');
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

	public function order($data) {

		return json_decode($this->connect($this->api_url.'order', array_merge(array('api_id' => $this->api_id, 'api_key' => $this->api_key), $data)));

	}

	public function status($order_id) {
        return json_decode($this->connect($this->api_url.'status', array('api_id' => $this->api_id, 'api_key' => $this->api_key, 'id' => $order_id)));
    }

	public function category() {

		$this->db->group_by('category');
		return $this->db->get('tb_services');
	}

	public function services($category) {

		if (empty($category)) {
			
			return false;

		} else {

			$get = $this->db->get_where('tb_services', array('category' => $category, 'status' => 'Aktif'));

			if ($get->num_rows() <= 0) {
				
				return false;

			} else {

				return $get;

			}
		}
	}

	public function service_data($id) {

		$get = $this->db->get_where('tb_services', array('id' => $id));

		if ($get->num_rows() <= 0) {
				
			return "Tidak Layanan";

		} else {

			$custom_array = array(749, 861, 873, 876, 952);

			if (in_array($id, $custom_array, true)) {
				$custom_comments = 'yes';
			} else {
				$custom_comments = in_array($id, $custom_array, true);
			}

			$data = array(
				'msg' => array(
					'price' => $get->row()->price,
					'min' => $get->row()->min,
					'max' => $get->row()->max,
					'note' => $get->row()->note,
					'custom' => $get->row()->custom
				)
			);
			
			return json_encode($data);
		}
	}

	public function total_price($id, $quantity) {

		$get = $this->db->get_where('tb_services', array('id' => $id));

		if ($get->num_rows() <= 0 || $id == 0) {
			
			return json_encode(array('total_price' => 0));

		} else {

			$price = $get->row()->price;

			$total_price = (($price / 1000 * $quantity) * 1.10);

			return json_encode(array('total_price' => round($total_price)));
		}
	}

	public function new($services, $target, $custom_comments = null, $custom_link = null, $quantity) {

		if (empty($services) || empty($target) || empty($quantity)) {
			
			return "<div class='alert alert-danger'>Gagal : Semua Input harus diisi.</div>";

		} else {

			$check_services = $this->db->get_where('tb_services', array('id' => $services));
			$check_user = $this->db->get_where('tb_users', array('user_id' => $this->session->user_id));

			$price = ((($check_services->row()->price / 1000) * $quantity) * 1.10);

			if ($quantity < $check_services->row()->min) {

				return "<div class='alert alert-danger'>Gagal : Minimal pemesanan ".$check_services->row()->min." .</div>";

			} else if ($quantity > $check_services->row()->max) {
				
				return "<div class='alert alert-danger'>Gagal : Maksimal pemesanan ".$check_services->row()->max." .</div>";

			} else if ($check_user->row()->balance < $price) {
				
				return "<div class='alert alert-danger'>Gagal : Saldo anda tidak mencukupi.</div>";

			} else {

				$order = $this->order(array(
					'service' => $services,
					'target' => $target,
					'quantity' => $quantity,
					'custom_comments' => $custom_comments,
					'custom_link' => $custom_link
				));

				if ($order->status == false) {
					
					return "<div class='alert alert-danger'>Gagal : Silahkan coba beberapa saat lagi.</div>";

				} else {

					$status = $this->status($order->data->id);

					$data = array(
						'order_id' => $order->data->id,
						'user_id' => $this->session->user_id,
						'datetime' => $this->datetime(date('Y-m-d')),
						'name' => $check_services->row()->name,
						'target' => $this->db->escape_str($target),
						'quantity' => $this->db->escape_str($quantity),
						'price' => ($check_services->row()->price / 1000 * $quantity) * 1.10,
						'price_provider' => $order->data->price,
						'start_count' => $status->data->start_count,
						'status' => $status->data->status,
						'custom_comments' => $this->db->escape_str($custom_comments),
						'custom_link' => $this->db->escape_str($custom_link),
						'remains' => $status->data->remains
					);

					$this->db->insert('tb_order_history', $data);

					$this->db->where('user_id', $this->session->user_id);
					$this->db->update('tb_users', array('balance' => ($check_user->row()->balance - $price)));
					
					return "
						<div class='alert alert-success'>
							<h3>Berhasil : Pemesanan telah diterima</h3><br>
							Layanan : ".$check_services->row()->name."<br>
							Target : ".$target."<br>
							Jumlah Pesan : ".$quantity."<br>
							Link/Url Post : ".$custom_link."<br>
							Komentar :<br>".nl2br($custom_comments)."
						</div>
					";

				}
			}
		}
	}

	public function history($per_page = 15, $start = 0) {

		$this->db->where(array('user_id' => $this->session->user_id));
		return $this->db->get('tb_order_history', $per_page, $start);
	}

	public function total_rows() {

		$this->db->where('user_id', $this->session->user_id);
		return $this->db->get('tb_order_history')->num_rows();
	}

	public function update_status() {

		$get_data = $this->db->get_where('tb_order_history', array('user_id' => $this->session->user_id));

		foreach ($get_data->result() as $key => $value) {
			
			$get_status = $this->status($value->order_id);

			$update = array(
				'status' => $get_status->data->status,
				'start_count' => $get_status->data->start_count,
				'remains' => $get_status->data->remains
			);

			$this->db->where('order_id', $value->order_id);
			return $this->db->update('tb_order_history', $update);
		}
	}
}