<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AbsensiModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function tambahAbsensi($data){
        return $this->db->insert('absensi', $data);
    }

    public function cekPresensi($id_siswa, $id_jadwal) {
        $this->db->select('status');
        $this->db->from('absensi');
        $this->db->where('id_siswa', $id_siswa);
        $this->db->where('id_jadwal', $id_jadwal);
        $this->db->where('tanggal', date('Y-m-d'));  // Mengecek presensi untuk hari ini
        $query = $this->db->get();

        return $query->row_array();  // Mengembalikan status presensi jika ada
    }

    public function statusPresensi($id_siswa) {
        $this->db->select('status, COUNT(*) as jumlah');
        $this->db->from('absensi');
        $this->db->where('id_siswa', $id_siswa);
        $this->db->group_by('status');  // Kelompokkan berdasarkan status
        $query = $this->db->get();

        return $query->result_array();  // Mengembalikan array dengan jumlah tiap status
    }
}