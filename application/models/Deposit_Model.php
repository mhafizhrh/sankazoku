<?php

class Deposit_Model extends CI_Model {

	public function __construct() {

		parent::__construct();
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

	public function deposit_auto($method, $from_number, $total_transfer) {

		if ($method == 1) {

			if (empty($method) || empty($from_number) || empty($total_transfer)) {
				
				return "<div class='alert alert-danger'>Gagal : Semua input harus diisi.</div>";

			} else if (!is_numeric($from_number) || !is_numeric($total_transfer)) {
				
				return "<div class='alert alert-danger'>Gagal : Nomor HP dan Jumlah Deposit harus berupa nomor!</div>";

			} else {

				if ($total_transfer < 5000) {
					
					return "<div class='alert alert-danger'>Gagal : Minimal Deposit Rp.5.000</div>";

				} else {

					$total_balance = ($total_transfer * 1.01);

					$data = array(
						'method' => 'TRANSFER PULSA TELKOMSEL - DEPOSIT OTOMATIS',
						'datetime' => $this->datetime(date('Y-m-d')),
						'user_id' => $this->session->user_id,
						'from_number' => $this->db->escape_str($from_number),
						'receiver' => '085314271891',
						'total_deposit' => $total_transfer,
						'total_balance' => $total_transfer,
						'note' => 'Transfer pulsa telkomsel Rp.'.number_format($total_transfer, 0, '.', '.').' ke nomor 085314271891',
						'status' => 'Pending'
					);

					$this->db->insert('tb_deposit', $data);

					return "
					<div class='alert alert-success'>
						Berhasil : Deposit saldo <br>
						Jumlah Transfer : $total_transfer <br>
						Jumlah Saldo yang didapat : $total_transfer <br>
						<b>Silahkan transfer pulsa ke nomor <h3>085314271891</h3> sesuai jumlah transfer.</b>
					</div>
					";
				}
			}

		} else {

			return "<div class='alert alert-danger'>Gagal : Pilih Metode Deposit terlebih dahulu.</div>";

		}
	}

	public function history($per_page = 10, $start = 0) {

		$this->db->where('user_id', $this->session->user_id);
		return $this->db->get('tb_deposit', $per_page, $start);
	}

	public function total_rows() {

		return $this->db->get_where('tb_deposit', array('user_id' => $this->session->user_id))->num_rows();

	}
}