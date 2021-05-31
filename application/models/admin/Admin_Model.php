<?php

date_default_timezone_set('Asia/Jakarta');

class Admin_Model extends CI_Model {

	public function __construct() {

		parent::__construct();
		$this->load->database();
		$this->load->helper('typography');
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



	public function admin_data() {

		$get_data = $this->db->get_where('tb_admins', array('admin_id' => $this->session->admin_id));

		return $get_data->row();
	}



	public function total_user() {

		$get = $this->db->get('tb_users');
		return $get->num_rows();
	}



	public function total_rows() {

		$this->db->group_by('ticket_id');
		return $this->db->get('tb_ticket')->num_rows();
	}


	public function services($per_page = 0, $start = 0) {

		$this->db->where('status', 'Aktif');
		$this->db->order_by('id', 'ASC');
		return $this->db->get('tb_services', $per_page, $start);
	}


	public function ticket($per_page = 0, $start = 0) {

		$this->db->select('*');
		$this->db->select('UNIX_TIMESTAMP(datetime) AS DATE_TIME');
		$this->db->from('tb_ticket');
		$this->db->join('tb_users', 'tb_ticket.user_id = tb_users.user_id');
		$this->db->group_by('ticket_id');
		$this->db->order_by('id', 'DESC');
		return $this->db->get('', $per_page, $start);
	}



	public function reply($ticket_id) {

		if (empty($ticket_id)) {
			
			return redirect(base_url('admin/ticket'));

		} else {

			$get_ticket = $this->db->get_where('tb_ticket', array('ticket_id' => $ticket_id));

			if ($get_ticket->num_rows() <= 0) {

				return redirect(base_url('ticket'));

			} else {

				$this->db->select('*');
				$this->db->from('tb_ticket');
				$this->db->join('tb_users', 'tb_users.user_id = tb_ticket.user_id', 'left');
				$this->db->join('tb_admins', 'tb_admins.admin_id = tb_admins.admin_id', 'left');
				$this->db->where(array('ticket_id' => $get_ticket->row()->ticket_id));
				$this->db->order_by('id', 'DESC');
				$get = $this->db->get();
				return $get;

			}
		}
	}



	public function send($ticket_id, $message) {

		if (empty($ticket_id)) {

			return redirect(base_url('admin/ticket'));

		} else {

			if (empty($message)) {				

				return "<div class='alert alert-danger'>Gagal : Pesan harus diisi</div>";

			} else {

				$get = $this->db->get_where('tb_ticket', array('ticket_id' => $ticket_id));

				$data = array(
					'ticket_id' => $ticket_id,
					'admin_id' => $this->session->admin_id,
					'subject' => $get->row()->subject,
					'message' => nl2br_except_pre(strip_tags($message)),
					'datetime' => $this->datetime(date('Y-m-d')),
					'status' => 'RESPONDED'
				);

				$this->db->where('ticket_id', $ticket_id);
				$this->db->update('tb_ticket', array('status' => 'RESPONDED'));
				$this->db->insert('tb_ticket', $data);

				return redirect(base_url('admin/ticket/reply/'.$ticket_id));
			}
		}
	}



	public function login($username, $password) {

		if (empty($username) || empty($password)) {
			
			return "<div class='alert alert-danger'>Gagal : Nama Pengguna dan Kata Sandi harus diisi.</div>";

		} else {

			$get_data = $this->db->get_where('tb_admins', array('username' => $this->db->escape_str($username)));

			if ($get_data->num_rows() <= 0) {
				
				return "<div class='alert alert-danger'>Gagal : Nama Pengguna atau Kata Sandi salah.</div>";

			} else {

				if (password_verify($this->db->escape_str($password), $get_data->row()->password)) {
				
					$data = array(
						'admin_id' => $get_data->row()->admin_id,
						'ip_address' => $this->input->ip_address()
					);

					$this->session->set_userdata($data);
					$this->db->where('admin_id', $get_data->row()->admin_id);
					$this->db->update('tb_admins', array('ip_address' => $this->input->ip_address()));

					return redirect('admin/dashboard');

				} else {

					return "<div class='alert alert-danger'>Gagal : Nama Pengguna atau Kata Sandi salah.</div>";

				}
			}
		}
	}



	public function info($per_page = 0, $start = 0) {

		$this->db->order_by('id', 'DESC');
		return $this->db->get('tb_info', $per_page, $start);
	}



	public function newInfo($category, $contents) {

		if (empty($category) || empty($contents)) {
			
			return "<div class='alert alert-danger'>Gagal : KATEGORI dan ISI harus diisi.</div>";

		} else {

			$data = array(
				'date_time' => $this->datetime(date('Y-m-d')),
				'category' => $this->db->escape_str(strip_tags($category)),
				'contents' => nl2br_except_pre(strip_tags($contents)),
			);

			$this->db->insert('tb_info', $data);

			return "<div class='alert alert-success'>Berhasil : Informasi telah dibuat.</div>";
		}
	}



	public function deleteInfo($id) {

		$check = $this->db->get_where('tb_info', array('id' => $id));

		if ($check->num_rows() <= 0) {
			
			return "<div class='alert alert-danger'>Gagal : Informasi tidak ada</div>";

		} else {

			$this->db->where('id', $id);
			$this->db->delete('tb_info');

			return "<div class='alert alert-success'>Berhasil : Informasi telah dihapus</div>";

		}
	}



	public function users($per_page = 0, $start = 0) {

		$this->db->order_by('cast(balance as int)', 'DESC');
		return $this->db->get('tb_users', $per_page, $start);
	}

	public function deleteUser($user_id) {

		$check = $this->db->get_where('tb_users', array('user_id' => $user_id));

		if ($check->num_rows() <= 0) {
			
			return "<div class='alert alert-danger'>Gagal : Pengguna tidak ada</div>";

		} else {

			$this->db->where('user_id', $user_id);
			$this->db->delete('tb_users');

			return "<div class='alert alert-success'>Berhasil : Pengguna telah dihapus</div>";

		}

		//return "<div class='alert alert-danger'></div>"; //"<script>alert('Pengguna telah dihapus');window.location='" . base_url('admin/users/') . "'</script>";
	}
}