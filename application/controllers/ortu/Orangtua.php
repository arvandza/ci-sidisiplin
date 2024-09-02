<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OrangTua extends MY_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('OrtuModel');
    }

    public function index() {
        $id_orang_tua = $this->session->userdata('user_id');
        $data['summary'] = $this->OrtuModel->get_absensi_summary($id_orang_tua);

        $this->load->view('_partial_siswa/header');
        $this->load->view('_partial_ortu/sidebar');
        $this->load->view('ortu/dashboard', $data);
        $this->load->view('_partial_siswa/footer');
    }

    public function viewAbsensi() {
        $id_orang_tua = $this->session->userdata('user_id');
        $data['absensi'] = $this->OrtuModel->get_absensi_ortu($id_orang_tua);

        $this->load->view("_partial_siswa/header");
        $this->load->view("_partial_ortu/sidebar");
        $this->load->view('ortu/absensi', $data);
        $this->load->view("_partial_siswa/footer");
    }

    public function viewJadwal() {
        $id_orang_tua = $this->session->userdata('user_id');
        $data['jadwal'] = $this->OrtuModel->get_jadwal_ortu($id_orang_tua);

        $this->load->view("_partial_siswa/header");
        $this->load->view("_partial_ortu/sidebar");
        $this->load->view('ortu/jadwal', $data);
        $this->load->view("_partial_siswa/footer");
    }
}
