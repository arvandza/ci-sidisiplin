<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class Guru extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("GuruModel");
		$this->load->database();
	}

	public function index(){
		$list_guru = $this->GuruModel->list_guru();
		$list["list_guru"] = $list_guru;
		$this->load->view("_partial_admin/header");
		$this->load->view("_partial_admin/sidebar");
		$this->load->view("master/guru/main_view",$list);
		$this->load->view("_partial_admin/footer");
		$this->load->view("master/guru/guru_js");
	}

	public function formTambah(){
		$this->load->view("master/guru/form_create");
	}

	public function tambahGuru(){
		$nama = $this->input->post("nama");
		$gelar_depan = $this->input->post("gelar_depan");
		$gelar_belakang = $this->input->post("gelar_belakang");
		$nuptk = $this->input->post("nuptk");
		$alamat = $this->input->post("alamat");
		$kelurahan = strtolower(ucwords($this->input->post("kelurahan")));
		$kecamatan = strtolower(ucwords($this->input->post("kecamatan")));
		$kota = strtolower(ucwords($this->input->post("kota")));
		$provinsi = strtolower(ucwords($this->input->post("provinsi")));
		$tempat_lahir = strtolower(ucwords($this->input->post("tempat_lahir")));
		$tanggal_lahir = $this->input->post("tanggal_lahir");
		$agama = $this->input->post("agama");
		$gender = $this->input->post("gender");
		$data_guru = array("nama" => $nama,"gelar_depan" => $gelar_depan,
		"gelar_belakang" => $gelar_belakang, "nuptk" => $nuptk,
		"alamat" => $alamat, "kelurahan" => $kelurahan, "kecamatan" => $kecamatan,
		"kota" => $kota,"provinsi" => $provinsi, "tempat_lahir" => $tempat_lahir,
		"tanggal_lahir" => $tanggal_lahir, "agama" => $agama, "gender" => $gender);
		
		$this->db->trans_start();
		$id_guru = $this->GuruModel->tambah_guru($data_guru);

		if($id_guru){
			$data_akun = array(
				'id_guru' => $id_guru,
				'username' => $nuptk,
				'password' => md5('12345678')
			);
			$this->GuruModel->addAkunGuru($data_akun);
		}

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
        	$response = json_encode(['sukses' => false, 'message' => 'Gagal menambahkan data guru dan akun.']);
		} else {
			$response = json_encode(['sukses' => true, 'message' => 'Data guru dan akun berhasil ditambahkan.']);
		}

		$this->output->set_content_type("application/json")->set_output($response);
	}

	public function formEdit(){
		$id_guru = $this->input->post("id_guru");
		$data["guru"] = $this->GuruModel->guru_terpilih($id_guru);
		$this->load->view("master/guru/form_edit",$data);
	}

	public function editGuru(){
		$id_guru = $this->input->post("id_guru");
		$nama = $this->input->post("nama");
		$gelar_depan = $this->input->post("gelar_depan");
		$gelar_belakang = $this->input->post("gelar_belakang");
		$nuptk = $this->input->post("nuptk");
		$alamat = $this->input->post("alamat");
		$kelurahan = strtolower(ucwords($this->input->post("kelurahan")));
		$kecamatan = strtolower(ucwords($this->input->post("kecamatan")));
		$kota = strtolower(ucwords($this->input->post("kota")));
		$provinsi = strtolower(ucwords($this->input->post("provinsi")));
		$tempat_lahir = strtolower(ucwords($this->input->post("tempat_lahir")));
		$tanggal_lahir = $this->input->post("tanggal_lahir");
		$agama = $this->input->post("agama");
		$gender = $this->input->post("gender");
		$data_guru = array($nama,$gelar_depan,$gelar_belakang,$nuptk,
		$alamat,$kelurahan,$kecamatan,$kota,$provinsi,$tempat_lahir,
		$tanggal_lahir,$agama,$gender);

		$data_akun_guru = array (
			'username' => $nuptk,
		);

		$infoUbah = $this->GuruModel->ubah_guru($data_guru, $data_akun_guru, $id_guru);
		if ($infoUbah === true) {
			$response = json_encode(['sukses' => true, 'message' => 'Status berhasil diperbarui']);
			$this->output->set_content_type("application/json")->set_output($response);
		}else {
			$response = json_encode(['sukses' => false, 'message' => 'Status berhasil diperbarui']);
			$this->output->set_content_type("application/json")->set_output($response);
		}
	}

	public function hapusGuru(){
		$id_guru = $this->input->post("id_guru");
		$infoHapus = $this->GuruModel->hapus_guru($id_guru);
		if ($infoHapus === true) {
			$response = json_encode(['sukses' => true, 'message' => 'Status berhasil diperbarui']);
			$this->output->set_content_type("application/json")->set_output($response);
		}else {
			$response = json_encode(['sukses' => false, 'message' => 'Status berhasil diperbarui']);
			$this->output->set_content_type("application/json")->set_output($response);
		}
	}

}
