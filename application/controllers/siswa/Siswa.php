<?php
defined("BASEPATH") OR exit("No direct script access allowed");
class Siswa extends MY_Controller{
    
    public function __construct(){
        parent::__construct();
        $this->load->model("SiswaModel");
        $this->load->model("JadwalModel");
        $this->load->model("AbsensiModel");
    }

    public function index(){
        $user_id = $this->session->userdata('user_id');

        if($this->session->userdata('role') !== 'siswa') {
            show_error('Access Denied: You are not authorized to access this page.');
        }

        $statusPresensi = $this->AbsensiModel->statusPresensi($user_id);

        // Inisialisasi array untuk menyimpan jumlah masing-masing status
        $data['presensi']['hadir'] = 0;
        $data['presensi']['izin'] = 0;
        $data['presensi']['sakit'] = 0;
        $data['presensi']['alpa'] = 0;

        // Loop untuk mengisi jumlah berdasarkan status
        foreach ($statusPresensi as $status) {
            $data['presensi'][strtolower($status['status'])] = $status['jumlah'];
        }

        $this->load->view("_partial_siswa/header");
        $this->load->view("_partial_siswa/sidebar");
        $this->load->view('siswa/dashboard', $data);  // Kirim data ke view dashboard
        $this->load->view("_partial_siswa/footer");
    }

    public function viewJadwal() {
        $id_siswa = $this->session->userdata('user_id');
        $jadwal = $this->JadwalModel->getJadwalById($id_siswa);

        $data['jadwal'] = $jadwal;
        $this->load->view("_partial_siswa/header");
        $this->load->view("_partial_siswa/sidebar");
        $this->load->view('siswa/jadwal', $data);
        $this->load->view("_partial_siswa/footer");
    }

    public function viewJadwalAktif() {
        $id_siswa = $this->session->userdata('user_id');
        $jadwal = $this->JadwalModel->getJadwalAktifBySiswa($id_siswa);

        foreach ($jadwal as &$j) {
            $presensi = $this->AbsensiModel->cekPresensi($id_siswa, $j['id_jadwal']);
            $j['presensi'] = $presensi;  // Tambahkan status presensi ke dalam array jadwal
        }

        $data['jadwal_aktif'] = $jadwal;
        $this->load->view("_partial_siswa/header");
        $this->load->view("_partial_siswa/sidebar");
        $this->load->view('siswa/absensi', $data);
        $this->load->view("_partial_siswa/footer");
    }

    public function simpanAbsensi() {
        $id_siswa = $this->session->userdata('user_id');
        $id_jadwal = $this->input->post('id_jadwal');
        $status = $this->input->post('status');
        $keterangan = $this->input->post('keterangan');

        $data = array(
            'id_siswa' => $id_siswa,
            'id_jadwal' => $id_jadwal,
            'tanggal' => date('Y-m-d'),
            'status' => $status,
            'keterangan' => $keterangan
        );

        $this->AbsensiModel->tambahAbsensi($data);
        redirect('siswa/absensi');
    }
}