<?php

date_default_timezone_set('Asia/Jakarta');

class Ticket_Model extends CI_Model {

	public function __construct() {

		parent::__construct();
		$this->load->database();
		$this->load->helper(array('typography', 'date'));
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

	public function user_ticket($offset, $start = 0) {

		$this->db->select('*');
		$this->db->where('user_id', $this->session->user_id);
		$this->db->group_by('ticket_id');
		$this->db->order_by('id', 'DESC');
		return $this->db->get('tb_ticket', $offset, $start);
	}

	public function total_rows() {

		$this->db->where('user_id', $this->session->user_id);
		$this->db->group_by('ticket_id');
		return $this->db->get('tb_ticket')->num_rows();
	}

	public function new($subject, $message) {

		if (empty($subject) || empty($message)) {
			
			return "<div class='alert alert-danger'>Input Subjek dan Pesan harus diisi</div>";

		} else {

			$this->db->select_max('ticket_id');
			$max = $this->db->get('tb_ticket');
			$ticket_id = ($max->row()->ticket_id + 1);
			$data = array(
				'ticket_id' => $ticket_id,
				'user_id' => $this->session->user_id,
				'subject' => $this->db->escape_str(strip_tags($subject)),
				'message' => nl2br_except_pre(strip_tags($message)),
				'datetime' => $this->datetime(date('Y-m-d')),
				'Status' => 'PENDING'
			);

			$this->db->insert('tb_ticket', $data);

			return redirect(base_url('ticket/reply/'.$ticket_id));
		}
	}

	public function reply($ticket_id) {

		if (empty($ticket_id)) {
			
			return redirect(base_url('ticket'));

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

			return redirect(base_url('ticket'));

		} else {

			if (empty($message)) {				

				return "<div class='alert alert-danger'>Gagal : Pesan harus diisi</div>";

			} else {

				$get = $this->db->get_where('tb_ticket', array('ticket_id' => $ticket_id));

				$data = array(
					'ticket_id' => $ticket_id,
					'user_id' => $this->session->user_id,
					'subject' => $get->row()->subject,
					'message' => nl2br_except_pre(strip_tags($message)),
					'datetime' => $this->datetime(date('Y-m-d')),
					'status' => 'PENDING'
				);

				$this->db->where('ticket_id', $ticket_id);
				$this->db->update('tb_ticket', array('status' => 'PENDING'));
				$this->db->insert('tb_ticket', $data);

				return redirect(base_url('ticket/reply/'.$ticket_id));
			}
		}
	}
}