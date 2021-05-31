<?php

error_reporting(0);

date_default_timezone_set('Asia/Jakarta');

class Auth_Model extends CI_Model {

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



	public function login($username, $password) {

		if (empty($username) || empty($password)) {
			
			return "<div class='alert alert-danger'>Gagal : Nama Pengguna atau Kata Sandi harus diisi.</div>";

		} else {

			$get_data = $this->db->get_where('tb_users', array('username' => $this->db->escape_str($username)));

			if ($get_data->num_rows() <= 0) {
				
				return "<div class='alert alert-danger'>Gagal : Nama Pengguna atau Kata Sandi salah.</div>";

			} else {

				if (password_verify($this->db->escape_str($password), $get_data->row()->password)) {
				
					$data = array(
						'user_id' => $get_data->row()->user_id,
						'ip_address' => $this->input->ip_address()
					);

					$this->session->set_userdata($data);
					$this->db->where('user_id', $get_data->row()->user_id);
					$this->db->update('tb_users', array('ip_address' => $this->input->ip_address()));

					return redirect('/');

				} else {

					return "<div class='alert alert-danger'>Gagal : Nama Pengguna atau Kata Sandi salah.</div>";

				}
			}
		}
	}

	public function register($full_name, $email, $username, $password, $password_verify) {

		
		if (empty($full_name) || empty($email) || empty($username) || empty($password) || empty($password_verify)) {
			
			return "<div class='alert alert-danger'>Gagal : Semua Input harus diisi. </div>";

		} else {

			$check_email = $this->db->get_where('tb_users', array('email' => $this->db->escape_str($email)));
			$check_uname = $this->db->get_where('tb_users', array('username' => $this->db->escape_str($username)));

			if (strlen($full_name) > 100 || strlen($username) > 100) {
			 	
				return "<div class='alert alert-danger'>Gagal : Nama Lengkap dan Nama Pengguna maksimal 100 karakter.</div>";

			} else if (strlen($password) < 8 || strlen($password_verify) < 8) {
				
				return "<div class='alert alert-danger'>Gagal : Kata Sandi minimal 8 karakter.</div>";

			} else if ($password != $password_verify) {
				
				return "<div class='alert alert-danger'>Gagal : Input Konfirmasi Kata Sandi harus sama dengan Input Kata Sandi.</div>";

			} else if ($check_email->num_rows() > 0) {

				return "<div class='alert alert-danger'>Gagal : Email sudah digunakan.</div>";

			} else if ($check_uname->num_rows() > 0) {
				
				return "<div class='alert alert-danger'>Gagal : Nama Pengguna sudah digunakan.</div>";
				
			} else {

				$data = array(
					'full_name' => $this->db->escape_str($full_name),
					'email' => $this->db->escape_str($email),
					'username' => $this->db->escape_str($username),
					'password' => password_hash($this->db->escape_str($password), PASSWORD_DEFAULT),
					'reg_date' => $this->datetime(date('Y-m-d'))
				);

				$this->db->insert('tb_users', $data);
				
				return "<div class='alert alert-success'>Berhasil : Akun telah terdaftar.<br>Silahkan <a href='login'>Masuk</a> untuk melanjutkan.</div>";

			}
		}
	}
}