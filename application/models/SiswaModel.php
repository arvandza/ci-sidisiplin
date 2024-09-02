<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SiswaModel extends CI_Model
{
    private $perintah;
    private $query;
    private $result;

    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function list_siswa($semester){
      if ($semester == 7) {
        $this->perintah = "SELECT * FROM siswa";
        $this->query = $this->db->query($this->perintah);
      }else {
        $this->perintah = "SELECT * FROM siswa WHERE semester = ?";
        $this->query = $this->db->query($this->perintah,$semester);
      }
      $this->result = $this->query->result_array();
      return $this->result;
    }

    public function hitung_siswa($semester){
      if ($semester == 7) {
        $this->perintah = "SELECT COUNT(id_siswa) AS jumlah_siswa FROM siswa";
        $this->query = $this->db->query($this->perintah);
      }else {
        $this->perintah = "SELECT COUNT(id_siswa) AS jumlah_siswa FROM siswa WHERE semester = ?";
        $this->query = $this->db->query($this->perintah,$semester);
      }
      $this->result = $this->query->row_array();
      return $this->result;
    }

    public function siswa_terpilih($id_siswa){
      $this->perintah = "SELECT * FROM siswa WHERE id_siswa = ?";
      $this->query = $this->db->query($this->perintah,$id_siswa);
      $this->result = $this->query->row_array();
      return $this->result;
    }

    public function perolehOrangTua($nik1,$nik2){
      $this->perintah = "SELECT id_orang_tua as id FROM orang_tua WHERE nik_suami = ? OR nik_istri = ?";
      $this->query = $this->db->query($this->perintah,array($nik1,$nik2));
      $this->result = $this->query->row_array();
      return $this->result;
    }

    public function nikAyahIbu($id_orang_tua){
      $this->perintah = "SELECT nik_suami,nik_istri FROM orang_tua WHERE id_orang_tua = ?";
      $this->query = $this->db->query($this->perintah,$id_orang_tua);
      $this->result = $this->query->row_array();
      return $this->result;
    }

    public function tambah_siswa($data_siswa){
      $this->db->insert("siswa", $data_siswa);
      return $this->db->insert_id();
    }

    public function ubah_siswa($data_siswa,$data_akun_siswa, $id_siswa){
      $status = null;
      $this->db->trans_start();
      $fields = array("nama_siswa","nisn","alamat",
      "kelurahan","kecamatan","kota","provinsi",
      "tempat_lahir","tanggal_lahir","agama","semester","id_orang_tua_siswa");
      for ($i=0; $i < count($fields); $i++) {
        $this->db->set($fields[$i],$data_siswa[$i]);
      }
      $this->db->where("id_siswa",$id_siswa);
      $this->db->update("siswa");

      $this->db->where('id_siswa', $id_siswa);
      $this->db->update('akun_siswa', $data_akun_siswa);

      $this->db->trans_complete();
      if ($this->db->trans_status() === FALSE) {
        $status = false;
      }else {
        $status = true;
      }
      return $status;
    }

    public function hapus_siswa($id_siswa){
      $status = null;
      $this->db->trans_start();
      $this->db->where('id_siswa', $id_siswa);
      $this->db->delete("akun_siswa");

      $this->db->where("id_siswa",$id_siswa);
      $this->db->delete("siswa");
      $this->db->trans_complete();
      if ($this->db->trans_status() === FALSE) {
        $status = false;
      }else {
        $status = true;
      }
      return $status;
    }

    public function addAkunSiswa($data){
      return $this->db->insert('akun_siswa', $data);
    }

    public function get_all_siswa() {
      return $this->db->get('siswa')->result();
    }

    public function cari_siswa($keyword) {
      $this->db->like('nama_siswa', $keyword);
      return $this->db->get('siswa')->result();
    }

    public function get_siswa_info($user_id) {
      $this->db->where('id_siswa', $user_id);
      $query = $this->db->get('siswa');
      return $query->row();
    }

}
