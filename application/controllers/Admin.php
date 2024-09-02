<?php
defined("BASEPATH") OR exit("No direct script access allowed");

use App\Models\UserModel;

class Admin extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("DashboardModel");
		$this->load->model("UserModel");
		$this->load->helper('url');
		$this->load->library('session');
	}

	public function index(){
		$this->is_siswa_logged_in();
		$hitung_siswa = $this->DashboardModel->hitung_siswa();
		$hitung_guru = $this->DashboardModel->hitung_guru();
		$hitung_ruangan = $this->DashboardModel->hitung_ruangan();
		$hitung_mapel = $this->DashboardModel->hitung_mapel();
		$data = array("jumlah_siswa" => $hitung_siswa["jumlah_siswa"],
									"jumlah_guru" => $hitung_guru["jumlah_guru"],
									"jumlah_ruangan" => $hitung_ruangan["jumlah_ruang"],
								  "jumlah_mapel" => $hitung_mapel["jumlah_mapel"]);
		$this->load->view("_partial_admin/header");
		$this->load->view("_partial_admin/sidebar");
		$this->load->view("master/dashboard",$data);
		$this->load->view("_partial_admin/footer");
	}

	public function siswa_login(){
		$this->load->view("siswa/siswa_login.php");
	}

	public function is_siswa_logged_in() {
		if(!$this->session->userdata('role')) {
			redirect('siswa/siswa_login');
		}
	}

	public function auth() {
		$username = $this->input->post('username');
        $password = $this->input->post('password');
        $role = $this->input->post('role');

        if (empty($role)) {
            $this->session->set_flashdata('error', 'Role must be selected.');
            redirect('siswa/siswa_login');
        }

        $user = $this->UserModel->validate_user($username, $password, $role);

        if ($user) {
            // Set session data
            switch ($role) {
				case 'guru':
					$this->session->set_userdata('user_id', $user['id_guru']);
					break;
				case 'siswa':
					$this->session->set_userdata('user_id', $user['id_siswa']);
					break;
				case 'orang_tua':
					$this->session->set_userdata('user_id', $user['id_orang_tua']);
					break;
				default:
					show_error('Invalid role.');
					return;
        	}

			$session = array(
				'role' => $role,
				'username' => $username,
				'logged_in' => TRUE
			);
            $this->session->set_userdata($session);

            // Redirect based on role
            switch ($role) {
                case 'guru':
                    redirect('guru/dashboard');
                    break;
                case 'siswa':
                    redirect('siswa/dashboard');
                    break;
                case 'orang_tua':
                    redirect('ortu/dashboard');
                    break;
                default:
                    show_error('Invalid role.');
            }
        } else {
            $this->session->set_flashdata('error', 'Invalid username or password.');
            redirect('siswa/siswa_login');
        }
	}

	public function logout()
    {
        $this->session->sess_destroy();
        redirect('siswa/siswa_login');
    }

}
