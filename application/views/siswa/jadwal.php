<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Jadwal</h1>
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
            <?php if (empty($jadwal)): ?>
            <div class="alert alert-warning" role="alert">
                Jadwal tidak ditemukan untuk siswa ini.
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
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            <?php $number = 0; foreach ($jadwal as $key => $row) { $number++;  ?>
                            <tr>
                                <td width="2%"><?php echo $number . "." ?></td>
                                <td><?php echo $row["hari"] ?></td>
                                <td><?php echo $row["waktu_mulai"] ?></td>
                                <td><?php echo $row["waktu_selesai"] ?></td>
                                <td><?php echo $row["kode_ruang_belajar"] ?></td>
                                <td><?php echo $row["nama_mapel"] ?></td>
                                <td><?php echo $row["nama_guru"] ?></td>
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
        
    </div>
</div>