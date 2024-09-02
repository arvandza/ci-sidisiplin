<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guru extends MY_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('GuruModel');
        $this->load->model('JadwalModel');
    }

    public function index() {
        $id_guru = $this->session->userdata('user_id');
        $total_jadwal = $this->JadwalModel->countJadwalByIdGuru($id_guru);

        $data['total_jadwal'] = $total_jadwal;
        $this->load->view("_partial_siswa/header");
        $this->load->view("_partial_guru/sidebar");
        $this->load->view('guru/dashboard', $data);
        $this->load->view("_partial_siswa/footer");
    }

    public function viewJadwal() {
        $id_guru = $this->session->userdata('user_id');
        $jadwal = $this->JadwalModel->getJadwalByIdGuru($id_guru);

        $data['jadwal'] = $jadwal;
        $this->load->view("_partial_siswa/header");
        $this->load->view("_partial_guru/sidebar");
        $this->load->view('guru/jadwal', $data);
        $this->load->view("_partial_siswa/footer");
    }

   public function activate_presensi($id_jadwal)
    {
        if ($this->JadwalModel->aktivasiPresensi($id_jadwal)) {
            $this->session->set_flashdata('success', 'Presensi berhasil diaktifkan.');
        } else {
            $this->session->set_flashdata('error', 'Gagal mengaktifkan presensi.');
        }
        redirect('guru/jadwal'); // Redirect to a relevant page
    }

    // Function to deactivate presensi
    public function deactivate_presensi($id_jadwal)
    {
        if ($this->JadwalModel->nonaktifkanPresensi($id_jadwal)) {
            $this->session->set_flashdata('success', 'Presensi berhasil dinonaktifkan.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menonaktifkan presensi.');
        }
        redirect('guru/jadwal'); // Redirect to a relevant page
    }
}