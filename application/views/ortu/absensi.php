<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Absensi Siswa</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Absensi</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <?php if (empty($absensi)): ?>
            <div class="alert alert-warning" role="alert">
                Tidak ada data absensi untuk siswa ini.
            </div>
            <?php else: ?>
            <div class="row">
                <div class="col-lg-12">
                    <table class="table table-bordered table-bordered-secondary" id="tabelAbsensi">
                        <thead class="bg-primary text-white">
                            <tr class="text-center">
                                <th width="2%">No.</th>
                                <th>Tanggal</th>
                                <th>Nama Siswa</th>
                                
                                <th>Mapel</th>
                                
                                <th>Status</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            <?php $number = 0; foreach ($absensi as $row) { $number++; ?>
                            <tr>
                                <td width="2%"><?php echo $number . "." ?></td>
                                <td><?php echo $row["tanggal"] ?></td>
                                <td><?php echo $row["nama_siswa"] ?></td>
                                <td><?php echo $row["nama_mapel"] ?></td>
                                <td class="text-center">
                                    <?php
                                    $badge_class = '';
                                    switch ($row['status']) {
                                        case 'hadir':
                                            $badge_class = 'badge-success';
                                            break;
                                        case 'sakit':
                                            $badge_class = 'badge-danger';
                                            break;
                                        case 'izin':
                                            $badge_class = 'badge-warning';
                                            break;
                                        case 'alpa':
                                            $badge_class = 'badge-secondary';
                                            break;
                                    }
                                    ?>
                                    <span class="badge <?php echo $badge_class; ?>"><?php echo ucfirst($row['status']); ?></span>
                                </td>
                                <td><?php echo $row["keterangan"] ?></td>
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
