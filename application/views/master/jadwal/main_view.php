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
            <div class="row">
                <div class="col-lg-6">
                    <button type="button" class="btn btn-success mb-3" id="formTambah">Tambah</button>
                </div>
            </div>
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
                                <th></th>
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
                                <td><?php echo $row["nama"] ?></td>
                                <td class="text-center">
                                    <div class="dropdown dropleft">
                                        <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
                                            Aksi</button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#" id="formEdit"
                                                data-id_jadwal="<?php echo $row['id_jadwal'] ?>">Edit</a>
                                                <a class="dropdown-item" href="#" id="btnDelete"
                                                data-id_jadwal="<?php echo $row['id_jadwal'] ?>">Delete</a>
                                            </div>
                                    </div>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="modalSaya">
        
    </div>
</div>