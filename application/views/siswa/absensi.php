<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Jadwal Aktif dan Presensi</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Jadwal</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <?php if (empty($jadwal_aktif)): ?>
            <div class="alert alert-warning" role="alert">
                Jadwal tidak ditemukan untuk siswa ini atau tidak ada presensi aktif saat ini.
            </div>
            <?php else: ?>
            <div class="row">
                <div class="col-lg-12">
                    <table class="table table-bordered table-bordered-secondary" id="tabelJadwal">
                        <thead class="bg-primary text-white">
                            <tr class="text-center">
                                <th width="2%">No.</th>
                                <th>Hari</th>
                                <th>Jam Mulai</th>
                                <th>Jam Selesai</th>
                                <th>Kelas</th>
                                <th>Mapel</th>
                                <th>Guru</th>
                                <th>Aksi</th> <!-- Kolom tambahan untuk aksi presensi -->
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            <?php $number = 0; foreach ($jadwal_aktif as $key => $row) { $number++; ?>
                            <tr>
                                <td width="2%"><?php echo $number . "." ?></td>
                                <td><?php echo $row["hari"] ?></td>
                                <td><?php echo $row["waktu_mulai"] ?></td>
                                <td><?php echo $row["waktu_selesai"] ?></td>
                                <td><?php echo $row["kode_ruang_belajar"] ?></td>
                                <td><?php echo $row["nama_mapel"] ?></td>
                                <td><?php echo $row["nama_guru"] ?></td>
                                <td>
                                    <?php if (empty($row['presensi'])): ?>
                                        <!-- Tampilkan form presensi jika belum presensi -->
                                        <form action="<?php echo site_url('siswa/simpanabsensi'); ?>" method="post">
                                            <input type="hidden" name="id_jadwal" value="<?php echo $row['id_jadwal']; ?>">
                                            <div class="form-group">
                                                <select name="status" class="form-control form-control-sm" required>
                                                    <option value="hadir">Hadir</option>
                                                    <option value="izin">Izin</option>
                                                    <option value="sakit">Sakit</option>
                                                    <option value="alpa">Alpa</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="keterangan" class="form-control form-control-sm" placeholder="Keterangan (Opsional)">
                                            </div>
                                            <button type="submit" class="btn btn-sm btn-success">Presensi</button>
                                        </form>
                                    <?php else: ?>
                                        <!-- Tampilkan status presensi jika sudah presensi -->
                                        <span class="badge badge-info"><?php echo ucfirst($row['presensi']['status']); ?></span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </section>
    <div class="modal fade" id="modalSaya">
        <!-- Konten modal dapat ditambahkan di sini jika diperlukan -->
    </div>
</div>
