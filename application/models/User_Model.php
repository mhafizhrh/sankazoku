<?php

class User_Model extends CI_Model {

	public function __construct() {

		parent::__construct();
		$this->load->database();

	}

	public function user_data() {

		$get_data = $this->db->get_where('tb_users', array('user_id' => $this->session->user_id));

		return $get_data->row();
	}

	public function profile($full_name, $currentpass) {

		if (!isset($this->session->user_id)) {
			
			return json_encode(array(
				'status' => false,
				'message' => "<div class='alert alert-danger'>Gagal : Sesi tidak ditemukan.</div>"
			));

		} else if (empty($full_name) || empty($currentpass)) {
		
			return json_encode(array(
				'status' => false,
				'message' => "<div class='alert alert-danger'>Gagal : Nama Lengkap & Kata Sandi Saat Ini harus diisi.</div>"
			));

		} else {

			$get_data = $this->db->get_where('tb_users', array('user_id' => $this->session->user_id));

			if (!password_verify($currentpass, $get_data->row()->password)) {

				return json_encode(array(
					'status' => false,
					'message' => "<div class='alert alert-danger'>Gagal : Kata Sandi Saat Ini salah.</div>"
				));

			} else {

				$this->db->where('user_id', $get_data->row()->user_id);
				$this->db->update('tb_users', array('full_name' => $this->db->escape_str($full_name)));

				return json_encode(array(
					'status' => true,
					'message' => "<div class='alert alert-success'>Berhasil : Nama telah diperbarui.</div>"
				));
			}
		}
	}

	public function change_password($newpass, $newpass_verify, $currentpass) {

		if (!isset($this->session->user_id)) {
			
			return "<div class='alert alert-danger'>Gagal : Sesi tidak ditemukan.</div>";

		} else if (empty($newpass) || empty($newpass_verify) || empty($currentpass)) {
				
			return "<div class='alert alert-danger'>Gagal : Lengkapi data terlebih dahulu untuk mengubah Kata Sandi.</div>";

		} else {

			$get_data = $this->db->get_where('tb_users', array('user_id' => $this->session->user_id));

			if ($newpass != $newpass_verify) {
				
				return "<div class='alert alert-danger'>Gagal : Konfirmasi Kata Sandi tidak sama.</div>";

			} else if (strlen($newpass) < 8 || strlen($newpass_verify) < 8) {
				
				return "<div class='alert alert-danger'>Gagal : Kata sandi minimal 8 karakter.</div>";

			} else if (!password_verify($currentpass, $get_data->row()->password)) {
				
				return "<div class='alert alert-danger'>Gagal : Kata Sandi Saat Ini salah.</div>";

			} else {
			
				$this->db->where('user_id', $get_data->row()->user_id);
				$this->db->update('tb_users', array('password' => password_hash($this->db->escape_str($password_verify), PASSWORD_DEFAULT)));

				return "<div class='alert alert-success'>Berhasil : Kata Sandi telah diubah.</div>";
			}
		}
	}
}