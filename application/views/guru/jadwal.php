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
                Jadwal tidak ditemukan untuk guru ini.
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
                                <th>Absensi</th>
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
                                <td class="text-center">
                                    <?php if ($row['status_presensi'] == 'Nonaktif'): ?>
                                        <a href="<?php echo site_url('guru/aktifpresensi/'.$row['id_jadwal']); ?>" class="btn btn-success btn-sm btn-activate">Aktifkan</a>
                                    <?php else: ?>
                                        <a href="<?php echo site_url('guru/nonaktifpresensi/'.$row['id_jadwal']); ?>" class="btn btn-danger btn-sm btn-deactivate">Nonaktifkan</a>
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
        
    </div>

    <script>
        // Check for flashdata and show SweetAlert2 notification
        <?php if ($this->session->flashdata('success')): ?>
            Swal.fire({
                icon: 'success',
                title: 'Sukses',
                text: '<?php echo $this->session->flashdata('success'); ?>'
            });
        <?php elseif ($this->session->flashdata('error')): ?>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '<?php echo $this->session->flashdata('error'); ?>'
            });
        <?php endif; ?>

        // Confirmation before navigation
        document.querySelectorAll('.btn-activate, .btn-deactivate').forEach(function (btn) {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                const url = this.href;
                const action = this.classList.contains('btn-activate') ? 'aktifkan' : 'nonaktifkan';
                
                Swal.fire({
                    title: `Anda yakin ingin ${action} presensi?`,
                    text: "Perubahan ini tidak dapat dibatalkan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, lakukan!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = url;
                    }
                });
            });
        });
    </script>
</div>