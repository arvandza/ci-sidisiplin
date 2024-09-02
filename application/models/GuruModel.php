<?php
defined('BASEPATH') or exit('No direct script access allowed');

class GuruModel extends CI_Model
{
    private $perintah;
    private $query;
    private $result;

    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function list_guru(){
      $this->perintah = "SELECT * FROM guru";
      $this->query = $this->db->query($this->perintah);
      $this->result = $this->query->result_array();
      return $this->result;
    }

    public function guru_terpilih($id_guru){
      $this->perintah = "SELECT * FROM guru WHERE id_guru = ?";
      $this->query = $this->db->query($this->perintah,$id_guru);
      $this->result = $this->query->row_array();
      return $this->result;
    }

    public function tambah_guru($data_guru){
      $this->db->insert('guru', $data_guru);
      return $this->db->insert_id();
    }

    public function ubah_guru($data_guru,$data_akun_guru, $id_guru){
      $status = null;
      $this->db->trans_start();
      $fields = array("nama","gelar_depan","gelar_belakang","nuptk",
      "alamat","kelurahan","kecamatan","kota","provinsi",
      "tempat_lahir","tanggal_lahir","agama","gender");
      for ($i=0; $i < count($fields); $i++) {
        $this->db->set($fields[$i],$data_guru[$i]);
      }

      $this->db->where("id_guru",$id_guru);
      $this->db->update("guru");

      $this->db->where('id_guru', $id_guru);
      $this->db->update('akun_guru', $data_akun_guru);
      
      $this->db->trans_complete();
      if ($this->db->trans_status() === FALSE) {
        $status = false;
      }else {
        $status = true;
      }
      return $status;
    }

    public function hapus_guru($id_guru){
      $status = null;
      $this->db->trans_start();

      $this->db->where("id_guru",$id_guru);
      $this->db->delete("akun_guru");

      $this->db->where("id_guru",$id_guru);
      $this->db->delete("guru");
      $this->db->trans_complete();
      if ($this->db->trans_status() === FALSE) {
        $status = false;
      }else {
        $status = true;
      }
      return $status;
    }

    public function addAkunGuru($data) {
      return $this->db->insert('akun_guru', $data);
    }

    public function get_all_guru() {
        $this->db->select("*");
        $this->db->from('guru');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_guru_info($user_id) {
      $this->db->where('id_guru', $user_id);
      $query = $this->db->get('guru');
      return $query->row();
    }

    public function get_all_gurus() {
        $this->db->select("*");
        $this->db->from('guru');
        $query = $this->db->get();
        return $query->result_array();
    }
}
