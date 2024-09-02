<?php
defined('BASEPATH') or exit('No direct script access allowed');

class OrtuModel extends CI_Model
{
    private $perintah;
    private $query;
    private $result;

    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function list_ortu(){
      $this->perintah = "SELECT * FROM orang_tua";
      $this->query = $this->db->query($this->perintah);
      $this->result = $this->query->result_array();
      return $this->result;
    }

    public function ortu_terpilih($id_ortu){
      $this->perintah = "SELECT * FROM orang_tua WHERE id_orang_tua = ?";
      $this->query = $this->db->query($this->perintah,$id_ortu);
      $this->result = $this->query->row_array();
      return $this->result;
    }

    public function tambah_ortu($data_ortu){
      $this->db->insert('orang_tua', $data_ortu);
      return $this->db->insert_id();
    }

    public function ubah_ortu($data_ortu, $data_akun_ortu, $id_ortu){
      $status = null;
      $this->db->trans_start();
      $fields = array("nama_suami","nama_istri","nik_suami","nik_istri",
      "tempat_lahir_suami","tanggal_lahir_suami","tempat_lahir_istri","tanggal_lahir_istri",
      "pekerjaan_suami","pekerjaan_istri", "alamat", "nomor_telefon");
      for ($i=0; $i < count($fields); $i++) {
        $this->db->set($fields[$i],$data_ortu[$i]);
      }
      $this->db->where("id_orang_tua",$id_ortu);
      $this->db->update("orang_tua");

      $this->db->where("id_orang_tua",$id_ortu);
      $this->db->update("akun_orang_tua", $data_akun_ortu);

      $this->db->trans_complete();
      if ($this->db->trans_status() === FALSE) {
        $status = false;
      }else {
        $status = true;
      }
      return $status;
    }

    public function hapus_ortu($id_ortu){
      $status = null;
      $this->db->trans_start();

      $this->db->where("id_orang_tua",$id_ortu);
      $this->db->delete("akun_orang_tua");

      $this->db->where("id_orang_tua",$id_ortu);
      $this->db->delete("orang_tua");
      $this->db->trans_complete();
      if ($this->db->trans_status() === FALSE) {
        $status = false;
      }else {
        $status = true;
      }
      return $status;
    }

    public function addAkunOrtu($data) {
      return $this->db->insert('akun_orang_tua', $data);
    }

    public function get_ortu_info($user_id) {
      $this->db->where('id_orang_tua', $user_id);
      $query = $this->db->get('orang_tua');
      return $query->row();
    }

    public function get_absensi_ortu($id_orang_tua) {
        $this->db->select('absensi.id_absensi, absensi.tanggal, absensi.status, absensi.keterangan, siswa.nama_siswa, jadwal.hari, jadwal.waktu_mulai, jadwal.waktu_selesai, mata_pelajaran.nama_mapel');
        $this->db->from('absensi');
        $this->db->join('siswa', 'siswa.id_siswa = absensi.id_siswa');
        $this->db->join('jadwal', 'jadwal.id_jadwal = absensi.id_jadwal');
        $this->db->join('mata_pelajaran', 'mata_pelajaran.id_mata_pelajaran = jadwal.id_mata_pelajaran');
        $this->db->where('siswa.id_orang_tua_siswa', $id_orang_tua);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_jadwal_ortu($id_orang_tua) {
        $this->db->select('jadwal.hari, jadwal.waktu_mulai, jadwal.waktu_selesai, mata_pelajaran.nama_mapel, guru.nama as nama_guru, siswa.nama_siswa, ruang_belajar.kode_ruang_belajar');
        $this->db->from('jadwal');
        $this->db->join('data_kelas', 'data_kelas.id_ruang_belajar = jadwal.id_ruang_belajar');
        $this->db->join('siswa', 'siswa.id_siswa = data_kelas.id_siswa');
        $this->db->join('mata_pelajaran', 'mata_pelajaran.id_mata_pelajaran = jadwal.id_mata_pelajaran');
        $this->db->join('guru', 'guru.id_guru = jadwal.id_guru');
        $this->db->join('ruang_belajar', 'ruang_belajar.id_ruang_belajar = jadwal.id_ruang_belajar');
        $this->db->where('siswa.id_orang_tua_siswa', $id_orang_tua);
        $this->db->order_by('jadwal.hari', 'ASC');
        $this->db->order_by('jadwal.waktu_mulai', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_absensi_summary($id_orang_tua) {
        $this->db->select('status, COUNT(*) as count');
        $this->db->from('absensi');
        $this->db->join('siswa', 'siswa.id_siswa = absensi.id_siswa');
        $this->db->where('siswa.id_orang_tua_siswa', $id_orang_tua);
        $this->db->group_by('status');

        $query = $this->db->get();
        $result = $query->result_array();

        $summary = [
          'hadir' => 0,
          'sakit' => 0,
          'izin'  => 0,
          'alpa'  => 0
        ];

        foreach($result as $row) {
          $summary[$row['status']] = $row['count'];
        }

        return $summary;
    }
}
