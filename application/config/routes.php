<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route["default_controller"] = "Admin";
$route["404_override"] = "";
$route["translate_uri_dashes"] = FALSE;

$route["dashboard"] = "Admin";
$route["admin/login"] = "Admin/admin_login";
$route["auth"] = "Admin/auth";
$route["logout"] = "Admin/logout";
$route["siswa/siswa_login"] = "Admin/siswa_login";
$route["master/guru"] = "master/Guru";
$route["master/guru/form-tambah"] = "master/Guru/formTambah";
$route["master/guru/form-edit"] = "master/Guru/formEdit";
$route["master/guru/tambah-guru"] = "master/Guru/tambahGuru";
$route["master/guru/edit-guru"] = "master/Guru/editGuru";
$route["master/guru/hapus-guru"] = "master/Guru/hapusGuru";

$route["master/siswa"] = "master/Siswa";
$route["master/list-siswa/(:num)"] = "master/Siswa/listSiswa/$1";
$route["master/siswa/form-tambah"] = "master/Siswa/formTambah";
$route["master/siswa/form-edit"] = "master/Siswa/formEdit";
$route["master/siswa/tambah-siswa"] = "master/Siswa/tambahSiswa";
$route["master/siswa/edit-siswa"] = "master/Siswa/editSiswa";
$route["master/siswa/hapus-siswa"] = "master/Siswa/hapusSiswa";

$route["master/kelas"] = "master/Kelas";
$route["master/kelas/form-tambah"] = "master/Kelas/formTambah";
$route["master/kelas/form-edit"] = "master/Kelas/formEdit";
$route["master/kelas/tambah-kelas"] = "master/Kelas/tambahKelas";
$route["master/kelas/edit-kelas"] = "master/Kelas/editKelas";
$route["master/kelas/hapus-kelas"] = "master/Kelas/hapusKelas";

$route["master/mata-pelajaran"] = "master/Mapel";
$route["master/mata-pelajaran/(:any)/(:any)"] = "master/Mapel/listMapel/$1/$2";
$route["master/mata-pelajaran/form-tambah"] = "master/Mapel/formTambah";
$route["master/mata-pelajaran/form-edit"] = "master/Mapel/formEdit";
$route["master/mata-pelajaran/tambah-data"] = "master/Mapel/tambahMapel";
$route["master/mata-pelajaran/edit-data"] = "master/Mapel/editMapel";
$route["master/mata-pelajaran/hapus-data"] = "master/Mapel/hapusMapel";

$route["master/orang-tua"] = "master/Ortu";
$route["master/orang-tua/form-tambah"] = "master/Ortu/formTambah";
$route["master/orang-tua/form-edit"] = "master/Ortu/formEdit";
$route["master/orang-tua/tambah-data"] = "master/Ortu/tambahOrtu";
$route["master/orang-tua/edit-data"] = "master/Ortu/editOrtu";
$route["master/orang-tua/hapus-data"] = "master/Ortu/hapusOrtu";

$route['kelas/cari_siswa'] = "master/AssignKelas/cari_siswa";
$route['kelas/tambah_siswa'] = "master/AssignKelas/tambah_siswa";
$route['kelas/proses_tambah_siswa'] = "master/AssignKelas/proses_tambah_siswa";

$route['master/jadwal'] = "master/Jadwal";
$route["master/jadwal/form-edit"] = "master/Jadwal/formEdit";
$route["master/jadwal/edit-jadwal"] = "master/Jadwal/editJadwal";
$route['master/jadwal/form-tambah'] = "master/Jadwal/formTambah";
$route['master/jadwal/hapus-jadwal'] = "master/Jadwal/deleteJadwal";
$route['master/jadwal/tambah-jadwal'] = "master/Jadwal/proses_tambah_jadwal";

// Siswa
$route['siswa/dashboard'] = 'siswa/Siswa';
$route['siswa/jadwal'] = 'siswa/Siswa/viewJadwal';
$route['siswa/absensi'] = 'siswa/Siswa/viewJadwalAktif';
$route['siswa/simpanabsensi'] = 'siswa/Siswa/simpanAbsensi';

// Guru
$route['guru/dashboard'] = 'guru/Guru';
$route['guru/jadwal'] = 'guru/Guru/viewJadwal';
$route['guru/aktifpresensi/(:num)'] = 'guru/Guru/activate_presensi/$1';
$route['guru/nonaktifpresensi/(:num)'] = 'guru/Guru/deactivate_presensi/$1';

// Orang Tua
$route['ortu/dashboard'] = 'ortu/Orangtua';
$route['ortu/jadwal'] = 'ortu/OrangTua/viewJadwal';
$route['ortu/absensi'] = 'ortu/OrangTua/viewAbsensi';

$route['changepassword'] = 'User/viewchangepass';
$route['user/changepassword'] = 'User/ganti_password';

$route['master/login'] = 'Superadmin/viewLoginAdmin';
$route['master/authadmin'] = 'Superadmin/loginSuperadmin';