<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('JadwalModel');
        $this->load->model('KelasModel');
        $this->load->model('GuruModel');
        $this->load->model('MapelModel');
        $this->load->database();
    }

    public function index() {
        $data['jadwal'] = $this->JadwalModel->get_all_jadwal();
        $this->load->view("_partial_admin/header");
		$this->load->view("_partial_admin/sidebar");
		$this->load->view("master/jadwal/main_view", $data);
        $this->load->view("_partial_admin/footer");
		$this->load->view("master/jadwal/jadwal_js");
    }

    public function formTambah() {
        $data['kelas'] = $this->KelasModel->get_all_kelas();
        $data['guru'] = $this->GuruModel->get_all_guru();
        $data['mata_pelajaran'] = $this->MapelModel->get_all_mata_pelajaran();
        $this->load->view('master/jadwal/form_create', $data);
    }

    public function proses_tambah_jadwal() {
     // Retrieve form data
     $id_kelas = $this->input->post('id_kelas');
     $mata_pelajaran = $this->input->post('mata_pelajaran');
     $id_guru = $this->input->post('id_guru');
     $hari = $this->input->post('hari');
     $jam_mulai = $this->input->post('jam_mulai');
     $jam_selesai = $this->input->post('jam_selesai');
     
     // Validate input data
     if (!$id_kelas || !$mata_pelajaran || !$id_guru || !$hari || !$jam_mulai || !$jam_selesai) {
         $response = json_encode(['sukses' => false, 'message' => 'Data tidak boleh kosong!']);
         $this->output->set_content_type("application/json")->set_output($response);
         return;
     }

     // Prepare data for insertion
     $data = [
         'id_ruang_belajar' => $id_kelas,
         'id_mata_pelajaran' => $mata_pelajaran,
         'id_guru' => $id_guru,
         'hari' => $hari,
         'waktu_mulai' => $jam_mulai,
         'waktu_selesai' => $jam_selesai,
     ];
     
     // Insert into database
     if($this->JadwalModel->tambah_jadwal($data)) {
         $response = json_encode(['sukses' => true, 'message' => 'Berhasil menambahkan data Jadwal!']);
     } else {
         $response = json_encode(['sukses' => false, 'message' => 'Gagal menambahkan data Jadwal!']);
     }
     
     $this->output->set_content_type("application/json")->set_output($response);    
    }

   public function deleteJadwal() {
    // Retrieve the id_jadwal from the POST request
    $id_jadwal = $this->input->post('id_jadwal');
    
    // Validate the input data
    if (!$id_jadwal) {
        $response = json_encode(['sukses' => false, 'message' => 'ID Jadwal tidak valid!']);
        $this->output->set_content_type("application/json")->set_output($response);
        return;
    }
    
    // Attempt to delete the jadwal
    if ($this->JadwalModel->delete_jadwal($id_jadwal)) {
        $response = json_encode(['sukses' => true, 'message' => 'Berhasil menghapus data Jadwal!']);
    } else {
        $response = json_encode(['sukses' => false, 'message' => 'Gagal menghapus data Jadwal!']);
    }
    
    // Send the JSON response
    $this->output->set_content_type("application/json")->set_output($response);
    }

    public function formEdit() {
        $id_jadwal = $this->input->post("id_jadwal");
        $data["jadwal"] = $this->JadwalModel->jadwal_terpilih($id_jadwal);
        $data['ruang_belajar'] = $this->KelasModel->get_all_kelass();
        $data['guru'] = $this->GuruModel->get_all_gurus();
        $data['mata_pelajaran'] = $this->MapelModel->get_all_mata_pelajarans();
        $this->load->view("master/jadwal/form_edit", $data);
    }

    public function editJadwal() {
    // Mengambil data dari permintaan POST
        $id_jadwal = $this->input->post('id_jadwal');
        $id_kelas = $this->input->post('id_kelas');
        $mata_pelajaran = $this->input->post('mata_pelajaran');
        $id_guru = $this->input->post('id_guru');
        $hari = $this->input->post('hari');
        $jam_mulai = $this->input->post('jam_mulai');
        $jam_selesai = $this->input->post('jam_selesai');

        // Memvalidasi data (cek apakah semua field terisi)
        if (empty($id_jadwal) || empty($id_kelas) || empty($mata_pelajaran) || empty($id_guru) || empty($hari) || empty($jam_mulai) || empty($jam_selesai)) {
            echo json_encode(array('sukses' => false, 'pesan' => 'Semua field harus diisi!'));
            return;
        }

        // Menyiapkan data untuk update
        $data_update = array(
            'id_ruang_belajar' => $id_kelas,
            'id_mata_pelajaran' => $mata_pelajaran,
            'id_guru' => $id_guru,
            'hari' => $hari,
            'waktu_mulai' => $jam_mulai,
            'waktu_selesai' => $jam_selesai
        );

        // Mengupdate data di database
        $this->db->where('id_jadwal', $id_jadwal);
        $result = $this->db->update('jadwal', $data_update);

        // Mengembalikan respon JSON
        if ($result) {
            echo json_encode(array('sukses' => true, 'pesan' => 'Jadwal berhasil diperbarui.'));
        } else {
            echo json_encode(array('sukses' => false, 'pesan' => 'Gagal memperbarui jadwal. Coba lagi.'));
        }
    }
}