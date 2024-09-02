<?php
defined('BASEPATH') or exit('No direct script access allowed');

class KelasModel extends CI_Model
{
    private $perintah;
    private $query;
    private $result;

    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function list_kelas(){
      $this->perintah = "SELECT * FROM ruang_belajar ORDER BY kode_ruang_belajar ASC";
      $this->query = $this->db->query($this->perintah);
      $this->result = $this->query->result_array();
      return $this->result;
    }

    public function kelas_terpilih($id_kelas){
      $this->perintah = "SELECT * FROM ruang_belajar WHERE id_ruang_belajar = ?";
      $this->query = $this->db->query($this->perintah,$id_kelas);
      $this->result = $this->query->row_array();
      return $this->result;
    }

    public function tambah_kelas($data_kelas){
      $status = null;
      $this->db->trans_start();
      $this->db->insert("ruang_belajar",$data_kelas);
      $this->db->trans_complete();
      if ($this->db->trans_status() === FALSE) {
        $status = false;
      }else {
        $status = true;
      }
      return $status;
    }

    public function ubah_kelas($data_kelas,$id_kelas){
      $status = null;
      $this->db->trans_start();
      $fields = array("kode_ruang_belajar","sifat_semester","jumlah_muatan");
      for ($i=0; $i < count($fields); $i++) {
        $this->db->set($fields[$i],$data_kelas[$i]);
      }
      $this->db->where("id_ruang_belajar",$id_kelas);
      $this->db->update("ruang_belajar");
      $this->db->trans_complete();
      if ($this->db->trans_status() === FALSE) {
        $status = false;
      }else {
        $status = true;
      }
      return $status;
    }

    public function hapus_kelas($id_kelas){
      $status = null;
      $this->db->trans_start();
      $this->db->where("id_ruang_belajar",$id_kelas);
      $this->db->delete("ruang_belajar");
      $this->db->trans_complete();
      if ($this->db->trans_status() === FALSE) {
        $status = false;
      }else {
        $status = true;
      }
      return $status;
    }

    public function get_all_kelas() {
      return $this->db->get('ruang_belajar')->result();
    }

    public function get_all_kelass() {
      return $this->db->get('ruang_belajar')->result_array();
    }

    public function tambah_siswa_ke_kelas($data) {
      $this->db->insert('data_kelas', $data);
    }

    public function is_siswa_in_class($id_siswa) {
      $this->db->where_in('id_siswa', $id_siswa);
      $query = $this->db->get('data_kelas');
      return $query->num_rows() > 0;
    }

    public function get_nama_by_id($id_siswa) {
      $this->db->select('nama_siswa');
      $this->db->where_in('id_siswa', $id_siswa);
      $query = $this->db->get('siswa');

      if ($query->num_rows() > 0) {
          return $query->row()->nama_siswa;
      } else {
          return null;
      }
    }
}
