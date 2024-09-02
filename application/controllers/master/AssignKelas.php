<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class AssignKelas extends MY_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->model("SiswaModel");
        $this->load->model("KelasModel");
    }

    public function tambah_siswa() {
        $data['kelas'] = $this->KelasModel->get_all_kelas();
        $this->load->view("_partial_admin/header");
		$this->load->view("_partial_admin/sidebar");
        $this->load->view("master/tambah_siswa/tambah_siswa", $data);
        $this->load->view("_partial_admin/footer");
        $this->load->view("master/tambah_siswa/tambah_siswa_js");
    }

    public function proses_tambah_siswa() {
        $id_ruang_belajar = $this->input->post('id_ruang_belajar');
        $id_siswa = $this->input->post('id_siswas');

        foreach ($id_siswa as $id) {
        log_message('debug', 'Processing siswa ID: ' . $id); // Log ID yang sedang diproses
        if (!empty($id)) {
            if($this->KelasModel->is_siswa_in_class($id_siswa)){
                $nama_siswa = $this->KelasModel->get_nama_by_id($id_siswa);
                $this->session->set_flashdata('error', 'Siswa telah terdaftar sudah terdaftar di kelas lain');
                continue;
            }
            $data = array(
                'id_siswa'         => $id,
                'id_ruang_belajar' => $id_ruang_belajar,
            );
            $this->KelasModel->tambah_siswa_ke_kelas($data);
        } else {
            log_message('error', 'ID siswa kosong ditemukan.');
        }
}

        $this->session->set_flashdata('succcess', 'Data Berhasil Ditambahkan');
        redirect('kelas/tambah_siswa');
    }

    public function cari_siswa() {
        $keyword = $this->input->get('query');
        $siswa = $this->SiswaModel->cari_siswa($keyword);
        echo json_encode($siswa);
    }
}