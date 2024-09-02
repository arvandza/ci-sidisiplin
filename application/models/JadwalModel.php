<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class JadwalModel extends CI_Model{
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function tambah_jadwal($data) {
        return $this->db->insert('jadwal', $data);
    }

    public function get_all_jadwal() {
        $this->db->select("*");
        $this->db->from('jadwal');
        $this->db->join('ruang_belajar', 'jadwal.id_ruang_belajar = ruang_belajar.id_ruang_belajar');
        $this->db->join('guru', 'jadwal.id_guru = guru.id_guru');
        $this->db->join('mata_pelajaran', 'jadwal.id_mata_pelajaran = mata_pelajaran.id_mata_pelajaran');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function jadwal_terpilih($id_jadwal) {
        $this->db->select('*');
        $this->db->from("jadwal");
        $this->db->where('id_jadwal', $id_jadwal);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function check_jadwal($id_kelas, $hari, $jam_mulai, $jam_selesai) {
        $this->db->select("*");
        $this->db->from('jadwal');
        $this->db->where('id_ruang_belajar', $id_kelas);
        $this->db->where('hari', $hari);
        $this->db->group_start()
            ->where('waktu_mulai <', $jam_mulai)
            ->where('waktu_selesai >', $jam_selesai)
            ->group_end();
        $query = $this->db->get();
        return query->num_rows();    
    }

    public function get_jadwal_by_guru($id_guru) {
        $this->db->select("*");
        $this->db->from('jadwal');
        $this->db->join('ruang_belajar', 'jadwal.id_ruang_belajar = ruang_belajar.id_ruang_belajar');
        $this->db->join('guru', 'jadwal.id_guru = guru.id_guru');
        $this->db->where('jadwal.id_guru', $id_guru);
        $query = $this->db->get();
        return $query->result();
    }

    public function update_jadwal($id_jadwal, $data) {
        $this->db->where('id_jadwal', $id_jadwal);
        return $this->db->update('jadwal', $data);
    }

    public function delete_jadwal($id_jadwal) {
        $this->db->where('id_jadwal', $id_jadwal);
        return $this->db->delete('jadwal');
    }

    public function getJadwalById($id_siswa) {
        $this->db->select('
        j.id_jadwal,
        j.hari,
        j.waktu_mulai,
        j.waktu_selesai,
        rb.kode_ruang_belajar,
        mp.nama_mapel,
        g.nama AS nama_guru
        ');
        $this->db->from('data_kelas dk');
        $this->db->join('ruang_belajar rb', 'dk.id_ruang_belajar = rb.id_ruang_belajar');
        $this->db->join('jadwal j', 'rb.id_ruang_belajar = j.id_ruang_belajar');
        $this->db->join('mata_pelajaran mp', 'j.id_mata_pelajaran = mp.id_mata_pelajaran');
        $this->db->join('guru g', 'j.id_guru = g.id_guru');
        $this->db->where('dk.id_siswa', $id_siswa);

        $query = $this->db->get();
        return $query->result_array();
    }

    public function getJadwalByIdGuru($id_guru) {
        $this->db->select('jadwal.*, ruang_belajar.kode_ruang_belajar, mata_pelajaran.nama_mapel');
        $this->db->from('jadwal');
        $this->db->join('ruang_belajar', 'jadwal.id_ruang_belajar = ruang_belajar.id_ruang_belajar');
        $this->db->join('mata_pelajaran', 'jadwal.id_mata_pelajaran = mata_pelajaran.id_mata_pelajaran');
        $this->db->where('jadwal.id_guru', $id_guru);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getJadwalAktifBySiswa($id_siswa) {
    // Mendapatkan waktu saat ini
    $current_time = date('H:i:s');  

        $this->db->select('
            j.id_jadwal,
            j.hari,
            j.waktu_mulai,
            j.waktu_selesai,
            rb.kode_ruang_belajar,
            mp.nama_mapel,
            g.nama AS nama_guru
        ');
        $this->db->from('data_kelas dk');
        $this->db->join('ruang_belajar rb', 'dk.id_ruang_belajar = rb.id_ruang_belajar');
        $this->db->join('jadwal j', 'rb.id_ruang_belajar = j.id_ruang_belajar');
        $this->db->join('mata_pelajaran mp', 'j.id_mata_pelajaran = mp.id_mata_pelajaran');
        $this->db->join('guru g', 'j.id_guru = g.id_guru');
        $this->db->where('dk.id_siswa', $id_siswa);

        // Menambahkan filter berdasarkan status presensi
        $this->db->where('j.status_presensi', 'Aktif');  

        $query = $this->db->get();
        return $query->result_array();
    }


    public function aktivasiPresensi($id_jadwal){
        $this->db->set('status_presensi', 'Aktif');
        $this->db->where('id_jadwal', $id_jadwal);
        return $this->db->update('jadwal');
    }

    public function nonaktifkanPresensi($id_jadwal) {
        $this->db->set('status_presensi', 'Nonaktif');
        $this->db->where('id_jadwal', $id_jadwal);
        return $this->db->update('jadwal');
    }

    public function countJadwalByIdGuru($id_guru)
    {
        $this->db->where('id_guru', $id_guru);
        $this->db->from('jadwal'); // Tentukan tabel yang ingin di-query
        return $this->db->count_all_results(); // Menghitung jumlah baris yang sesuai
    }
}