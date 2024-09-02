<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Superadmin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('UserModel');
        $this->load->library('session');
        $this->load->library('form_validation');
    }

    public function loginSuperadmin() {
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));

        $superadmin = $this->UserModel->get_superadmin($username, $password);

        if($superadmin) {
            $session_data = array(
                'user_id' => $superadmin->id_super_user,
                'username' => $superadmin->username,
                'role'     => 'superadmin',
                'logged_in'=> TRUE
            );

            $this->session->set_userdata($session_data);
            redirect('dashboard');
        } else {
            $this->session->set_flashdata('error', 'Username atau Password Salah!');
            redirect('master/login');
        }
    }

    public function viewLoginAdmin(){
        $this->load->view('admin_login');
    }

}