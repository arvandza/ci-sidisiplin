<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('UserModel');
        $this->load->library('session');
        $this->load->library('form_validation');
    }

    public function viewchangepass(){
        $role = $this->session->userdata('role');

        if($role == 'guru') {
            $this->load->view('_partial_admin/header');
            $this->load->view('_partial_guru/sidebar');
            $this->load->view('changepass');
            $this->load->view('_partial_guru/footer');
        }else if($role == 'siswa') {
            $this->load->view('_partial_admin/header');
            $this->load->view('_partial_siswa/sidebar');
            $this->load->view('changepass');
            $this->load->view('_partial_siswa/footer');
        }else if($role == 'orang_tua') {
            $this->load->view('_partial_admin/header');
            $this->load->view('_partial_ortu/sidebar');
            $this->load->view('changepass');
            $this->load->view('_partial_siswa/footer');
        }
    }

    public function ganti_password() {
        $this->form_validation->set_rules('current_password', 'Password Lama', 'required');
        $this->form_validation->set_rules('new_password', 'Password Baru', 'required|min_length[6]');
        $this->form_validation->set_rules('confirm_password', 'Konfirmasi Password Baru', 'required|matches[new_password]');

        if($this->form_validation->run() == FALSE) {
            redirect('changepassword');
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password');
            $role = $this->session->userdata('role');
            $user_id = $this->session->userdata('user_id');

            // Debugging
            log_message('info', 'Role: ' . $role);
            log_message('info', 'User ID: ' . $user_id);

            $user_data = $this->UserModel->validate_user($this->session->userdata('username'), $current_password, $role);

            if($user_data) {
                $update = $this->UserModel->update_password($user_id, $role, $new_password);
                if($update) {
                    $this->session->set_flashdata('success', 'Password berhasil diperbarui');
                } else {
                    $this->session->set_flashdata('error', 'Gagal memperbarui password.');
                }
            } else {
                $this->session->set_flashdata('error', 'Password lama salah.');
            }

            redirect('changepassword');
        }
    }
}